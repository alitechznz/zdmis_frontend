<?php

namespace App\Livewire;

use App\Models\District;
use App\Models\Shehia;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class ShehiaComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $name, $district, $status, $shehia_id = null;

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
            'district' => 'required',
            'status' => 'required',
        ]);

        $baseUrl = $this->getBaseUrl();
        $url = $this->shehia_id ? "{$baseUrl}/shehia/{$this->shehia_id}" : "{$baseUrl}/shehia";
        $method = $this->shehia_id ? 'put' : 'post';

        $token = session('token');

        $payload = [
            'shehiaName' => $this->name,
            'district' => $this->district,
            'status' => in_array(strtolower($this->status), ['active', 'true', '1']), // safely cast to true/false
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->$method($url, $payload);


        if ($response->successful()) {
            logger()->info("URL requested: {$url}");
            logger()->info("Data sent: ", ['shehiaName' => $this->name, 'status' => $this->status]);

            $this->dispatch('swal:info', title: $this->shehia_id ? 'Shehia Updated.' : 'Shehia Created');
            $this->resetField();
            $this->dispatch('closeModal'); // Ensure you have the listeners set up for this event
        } else {
            logger()->error("Failed to update or create the district: {$response->body()}");
            $this->dispatch('swal:info', title: $this->shehia_id ? 'Error while updating Shehia.' : 'Error while creating Shehia');
            session()->flash('error', 'Failed to create or update the region on the external server.');
        }
    }


    public function edit($shehia_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->shehia_id = $shehia_id;

        // Construct the URL for the API request
        $baseUrl = $this->getBaseUrl();
        $url = "{$baseUrl}/shehia/{$shehia_id}";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get($url);


        if ($response->successful()) {
            $responseBody = $response->json();
            logger()->info('Shehia Data:', $responseBody);

            if (!empty($responseBody['data']) && is_array($responseBody['data'])) {
                $districtData = $responseBody['data']; // Assuming the first element is what you want

                $this->name = $districtData['shehiaName'] ?? 'No shehia name provided';
                $this->district = $districtData['district'] ?? 'No district provided';
                $this->status = $districtData['status'] ?? 'No status provided';

                logger()->info('Districts Data:', [
                    'shehiaName' => $this->name,
                    'district' => $this->district,
                    'status' => $this->status,
                ]);
            } else {
                logger()->error("Failed to load load shehia: {$response->body()}");
                session()->flash('error', 'No shehia data found or structure is incorrect.');
            }
        } else {
            logger()->error("Failed to load shehia: {$response->body()}");
            session()->flash('error', 'Failed to fetch shehia details. Error: ' . $response->body());
        }
    }


    public function destroy($districtId)
    {
        $baseUrl = $this->getBaseUrl();
        $url = "{$baseUrl}/shehia/{$districtId}";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->delete($url);

        if ($response->successful()) {
            $this->dispatch('swal:info', title: 'Shehia Deleted');
        } else {
            logger()->error("Failed to delete Shehia: " . $response->body());
            $this->dispatch('swal:info', title: 'Failed to delete the Shehia.');
        }
    }

    private function resetField()
    {
        $this->reset('name', 'district', 'status', 'shehia_id', 'update');
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

        $districtResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/district");

        $districts = collect([]);
        if ($districtResponse->successful()) {
            $districtData = $districtResponse->json()['data'];
            $districts = collect($districtData)->map(function ($district) {
                return (object) [
                    'id' => $district['id'],
                    'name' => $district['districtName'],
                ];
            });
        } else {
            logger()->error('Error Fetching district Types:', ['response' => $districtResponse->body()]);
        }


        $query = [];
        if ($this->search_keyword) {
            $query['search'] = $this->search_keyword;
        }


        // Assuming the token is stored in the session, you can retrieve it like this:
        $token = session('token'); // Ensure you have set this session variable when you login

        if (!$token) {
            session()->flash('error', 'No authentication token available. Please login again.');
            return view('livewire.shehia-component', ['shehias' => collect([])])->layout('layouts.app');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/shehia", $query);

        $shehias = collect([]);

        if ($response->successful()) {
            $shehiasData = $response->json()['data'];
            logger()->info('Fetched shehias:', $shehiasData);
            $shehias = collect($shehiasData)->map(function ($shehia) {
                return (object) [
                    'id' => $shehia['id'],
                    'name' => $shehia['shehiaName'],
                    'status' => $shehia['status'],
                ];
            });

            // Apply pagination
            $shehias = $this->paginateCollection($shehias, 10);
        } else {
            session()->flash('error', 'Failed to fetch shehias from the server.');
            logger()->error('Error Fetching shehias:', ['response' => $response->body()]);
        }


        return view('livewire.shehia-component', [
            'shehias' => $shehias,
            'districts' => $districts,
        ])->layout('layouts.app');
    }
}
