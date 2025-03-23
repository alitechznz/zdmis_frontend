<?php

namespace App\Livewire;

use App\Models\Region;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class RegionComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $name, $status, $region_id = null;

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
            'status' => 'required',
        ]);

        // Determine if this is a create or update operation based on $this->region_id
        $baseUrl = $this->getBaseUrl();
        $url = $this->region_id ? "{$baseUrl}/region/{$this->region_id}" : "{$baseUrl}/region";
        $method = $this->region_id ? 'put' : 'post';

        $token = session('token');

        // API request to external endpoint
        $payload = [
            'regionName' => $this->name,
            'status' => in_array(strtolower($this->status), ['active', 'true', '1']), // safely cast to true/false
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->$method($url, $payload);



        if ($response->successful()) {
            // logger()->info("URL requested: {$url}");
            // logger()->info("Data sent: ", ['regionName' => $this->name, 'status' => $this->status]);
            $this->dispatch('swal:info', title: $this->region_id ? 'Region Updated.' : 'Region Created');
            $this->resetField();
            $this->dispatch('closeModal'); // Ensure you have the listeners set up for this event
        } else {
            // logger()->error("Failed to update or create the region: {$response->body()}");
            session()->flash('error', 'Failed to create or update the region on the external server.');
            $this->dispatch('swal:info', title: $this->region_id ? 'Error while updating region.' : 'Error while creating region');
        }
    }




    public function edit($region_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->region_id = $region_id;

        // Construct the URL for the API request
        $baseUrl = $this->getBaseUrl();
        $url = "{$baseUrl}/region/{$region_id}";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get($url);

        if ($response->successful()) {
            $responseBody = $response->json();
            logger()->info('Region Data:', $responseBody);

            if (!empty($responseBody['data']) && is_array($responseBody['data'])) {
                $regionData = $responseBody['data']; // Assuming the first element is what you want

                $this->name = $regionData['regionName'] ?? 'No region name provided';
                $this->status = $regionData['status'] ?? 'No status provided';

                logger()->info('Region Data:', [
                    'regionName' => $this->name,
                    'status' => $this->status,
                ]);
            } else {
                logger()->error("Failed to load load region: {$response->body()}");
                session()->flash('error', 'No region data found or structure is incorrect.');
            }
        } else {
            logger()->error("Failed to load region: {$response->body()}");
            session()->flash('error', 'Failed to fetch region details. Error: ' . $response->body());
        }
    }




    public function destroy($regionId)
    {
        $baseUrl = $this->getBaseUrl();
        $url = "{$baseUrl}/region/{$regionId}";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->delete($url);

        if ($response->successful()) {
            $this->dispatch('swal:info', title: 'Region Deleted');
        } else {
            logger()->error("Failed to delete Region: " . $response->body());
            $this->dispatch('swal:info', title: 'Failed to delete the Region.');
        }
    }



    private function resetField()
    {
        $this->reset('name', 'status', 'region_id', 'update');
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

        $query = [];
        if ($this->search_keyword) {
            $query['search'] = $this->search_keyword;
        }

        $baseUrl = $this->getBaseUrl();
        // Assuming the token is stored in the session, you can retrieve it like this:
        $token = session('token'); // Ensure you have set this session variable when you login

        if (!$token) {
            session()->flash('error', 'No authentication token available. Please login again.');
            return view('livewire.region-component', ['regions' => collect([])])->layout('layouts.app');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/region", $query);

        $regions = collect([]);

        if ($response->successful()) {
            $regionsData = $response->json()['data'];
            logger()->info('Fetched regions:', $regionsData);
            $regions = collect($regionsData)->map(function ($region) {
                return (object) [
                    'id' => $region['id'],
                    'name' => $region['regionName'],
                    'status' => $region['status'],
                ];
            });

            // Apply pagination
            $regions = $this->paginateCollection($regions, 10);
        } else {
            session()->flash('error', 'Failed to fetch regions from the server.');
            logger()->error('Error Fetching regions:', ['response' => $response->body()]);
        }

        return view('livewire.region-component', [
            'regions' => $regions
        ])->layout('layouts.app');
    }
}
