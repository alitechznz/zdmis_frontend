<?php

namespace App\Livewire;

use App\Models\District;
use App\Models\Region;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Livewire\WithPagination;

class DistrictComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;



    public $name, $region, $status, $district_id = null;

    public function create()
    {
        $this->resetField();
    }

    private function getBaseUrl()
    {
        return config('services.api.base_url');
    }


    public function store()
    {
        $this->validate([
            'name' => 'required',
            'region' => 'required',
            'status' => 'required',
        ]);

        // Determine if this is a create or update operation based on $this->region_id
        $baseUrl = $this->getBaseUrl();
        $url = $this->district_id ? "{$baseUrl}/district/{$this->district_id}" : "{$baseUrl}/district";
        $method = $this->district_id ? 'put' : 'post';

        $token = session('token');

        $payload = [
            'districtName' => $this->name,
            'region' => $this->region,
            'status' => in_array(strtolower($this->status), ['active', 'true', '1']), // safely cast to true/false
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->$method($url, $payload);


        if ($response->successful()) {
            logger()->info("URL requested: {$url}");
            logger()->info("Data sent: ", ['districtName' => $this->name, 'status' => $this->status]);

            $this->dispatch('swal:info', title: $this->district_id ? 'District Updated.' : 'District Created');
            $this->resetField();
            $this->dispatch('closeModal'); // Ensure you have the listeners set up for this event
        } else {
            logger()->error("Failed to update or create the district: {$response->body()}");
            $this->dispatch('swal:info', title: $this->district_id ? 'Error while updating District.' : 'Error while creating District');
            session()->flash('error', 'Failed to create or update the region on the external server.');
        }
    }


    public function edit($district_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->district_id = $district_id;

        // Construct the URL for the API request
        $baseUrl = $this->getBaseUrl();
        $url = "{$baseUrl}/district/{$district_id}";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get($url);


        if ($response->successful()) {
            $responseBody = $response->json();
            logger()->info('Districts Data:', $responseBody);

            if (!empty($responseBody['data']) && is_array($responseBody['data'])) {
                $districtData = $responseBody['data']; // Assuming the first element is what you want

                $this->name = $districtData['districtName'] ?? 'No district name provided';
                $this->name = $districtData['region'] ?? 'No region provided';
                $this->status = $districtData['status'] ?? 'No status provided';

                logger()->info('Districts Data:', [
                    'districtName' => $this->name,
                    'region' => $this->region,
                    'status' => $this->status,
                ]);
            } else {
                logger()->error("Failed to load load district: {$response->body()}");
                session()->flash('error', 'No district data found or structure is incorrect.');
            }
        } else {
            logger()->error("Failed to load region: {$response->body()}");
            session()->flash('error', 'Failed to fetch district details. Error: ' . $response->body());
        }
    }




    public function destroy($districtId)
    {
        $baseUrl = $this->getBaseUrl();
        $url = "{$baseUrl}/district/{$districtId}";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->delete($url);

        if ($response->successful()) {
            $this->dispatch('swal:info', title: 'District Deleted');
        } else {
            logger()->error("Failed to delete district: " . $response->body());
            $this->dispatch('swal:info', title: 'Failed to delete the district.');
        }
    }



    private function resetField()
    {
        $this->reset('name', 'region', 'status', 'district_id', 'update');
    }




    public function paginateCollection($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator(
            $items->forPage($page, $perPage),
            $items->count(),
            $perPage,
            $page,
            $options
        );
    }

    public function render()
    {
        $baseUrl = $this->getBaseUrl();

        $regionResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/region");

        $regions = collect([]);
        if ($regionResponse->successful()) {
            $regionData = $regionResponse->json()['data'];
            $regions = collect($regionData)->map(function ($region) {
                return (object) [
                    'id' => $region['id'],
                    'name' => $region['regionName'],
                ];
            });
        } else {
            logger()->error('Error Fetching region Types:', ['response' => $regionResponse->body()]);
        }




        $query = [];
        if ($this->search_keyword) {
            $query['search'] = $this->search_keyword;
        }


        // Assuming the token is stored in the session, you can retrieve it like this:
        $token = session('token'); // Ensure you have set this session variable when you login

        if (!$token) {
            session()->flash('error', 'No authentication token available. Please login again.');
            return view('livewire.district-component', ['regions' => collect([])])->layout('layouts.app');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/district", $query);

        $districts = collect([]);

        if ($response->successful()) {
            $districtsData = $response->json()['data'];
            logger()->info('Fetched districts:', $districtsData);
            $districts = collect($districtsData)->map(function ($district) {
                return (object) [
                    'id' => $district['id'],
                    'name' => $district['districtName'],
                    'status' => $district['status'],
                ];
            });

            // Apply pagination
            $districts = $this->paginateCollection($districts, 10);
        } else {
            session()->flash('error', 'Failed to fetch districts from the server.');
            logger()->error('Error Fetching districts:', ['response' => $response->body()]);
        }


        return view('livewire.district-component', [
            'districts' => $districts,
            'regions' => $regions,
        ])->layout('layouts.app');
    }
}
