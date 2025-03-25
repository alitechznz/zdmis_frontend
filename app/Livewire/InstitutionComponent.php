<?php

namespace App\Livewire;

use App\Models\Institution;
use App\Models\Ministry;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class InstitutionComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $name, $ministry, $address, $short_name, $status, $institution_id = null;

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
            'address' => 'required',
            'ministry' => 'required',
            'short_name' => 'required',
            'status' => 'required',
        ]);

        // Determine if this is a create or update operation based on $this->region_id
        $baseUrl = $this->getBaseUrl();
        $url = $this->institution_id ? "{$baseUrl}/institution/{$this->institution_id}" : "{$baseUrl}/institution";
        $method = $this->institution_id ? 'put' : 'post';

        $token = session('token');

        // API request to external endpoint
        $payload = [
            'instituteName' => $this->name,
            'address' => $this->address,
            'shortName' => $this->short_name,
            // 'ministry' => $this->ministry,
            'ministry' => ['id' => (int) $this->ministry],  // Wrap the ministry ID inside an object
            'status' => in_array(strtolower($this->status), ['active', 'true', '1']), // safely cast to true/false
        ];


        // logger()->info("Preparing to send payload:", $payload);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->$method($url, $payload);


        if ($response->successful()) {
            // logger()->info("URL requested: {$url}");
            // logger()->info("Data sent: ", ['Institution Name' => $this->name, 'status' => $this->status]);
            $this->dispatch('swal:info', title: $this->institution_id ? 'Institution Updated.' : 'Institution Created');
            $this->resetField();
            $this->dispatch('closeModal'); // Ensure you have the listeners set up for this event
        } else {
            logger()->error("Failed to update or create the Institution: {$response->body()}");
            session()->flash('error', 'Failed to create or update the Institution on the external server.');
            $this->dispatch('swal:info', title: $this->institution_id ? 'Error while updating Institution.' : 'Error while creating Institution');
        }
    }



    public function edit($institution_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->institution_id = $institution_id;

        // Construct the URL for the API request
        $baseUrl = $this->getBaseUrl();
        $url = "{$baseUrl}/institution/{$institution_id}";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get($url);

        if ($response->successful()) {
            $responseBody = $response->json();
            logger()->info('Institution Data:', $responseBody);

            if (!empty($responseBody['data']) && is_array($responseBody['data'])) {
                $institutionData = $responseBody['data']; // Assuming the first element is what you want
                $this->name = $institutionData['instituteName'] ?? 'No institution name provided';
                $this->address = $institutionData['address'] ?? 'No address provided';
                $this->short_name = $institutionData['shortName'] ?? 'No short name provided';
                $this->status = $institutionData['status'] ?? 'No status provided';

                logger()->info('institution Data:', [
                    'instituteName' => $this->name,
                    'address' => $this->address,
                    'Short name' => $this->short_name,
                    'status' => $this->status,
                ]);
            } else {
                logger()->error("Failed to load Institution: {$response->body()}");
                session()->flash('error', 'No Institution data found or structure is incorrect.');
            }
        } else {
            logger()->error("Failed to load Institution: {$response->body()}");
            session()->flash('error', 'Failed to fetch Institution details. Error: ' . $response->body());
        }
    }



    public function deleteConfirm($institutionId)
    {
        $this->delete_confirm = $institutionId;
        // $this->dispatch('show-delete-modal');
    }

    public function destroy()
    {
        if ($this->delete_confirm) {
            $baseUrl = $this->getBaseUrl();
            $url = "{$baseUrl}/institution/{$this->delete_confirm}";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . session('token'),
                'Accept' => 'application/json'
            ])->delete($url);

            if ($response->successful()) {
                $this->dispatch('swal:info', title: 'Institution Deleted');
                $this->reset('delete_confirm');
            } else {
                logger()->error("Failed to delete Institution: " . $response->body());
                $this->dispatch('swal:info', title: 'Failed to delete the Institution.');
            }
        }
        $this->dispatch('closeModal'); // This will close the modal
    }



    private function resetField()
    {
        $this->reset('name', 'ministry', 'status', 'address', 'institution_id', 'update');
    }

    public function paginateCollection($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator(
            $items->forPage($page, $perPage)->all(), // Ensure items are an array
            $items->count(), // Total number of items
            $perPage,
            $page,
            $options
        );
    }

    public function render()
    {

        $baseUrl = $this->getBaseUrl();
        $query = [];
        if ($this->search_keyword) {
            $query['search'] = $this->search_keyword;
        }


        // Assuming the token is stored in the session, you can retrieve it like this:
        $token = session('token'); // Ensure you have set this session variable when you login

        if (!$token) {
            session()->flash('error', 'No authentication token available. Please login again.');
            return view('livewire.institution-component', ['institutions' => collect([])])->layout('layouts.app');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/institution", $query);

        $institutions = collect([]);

        if ($response->successful()) {
            $institutionsData = $response->json()['data'];
            // logger()->info('Fetched institutions:', $institutionsData);
            $institutions = collect($institutionsData)->map(function ($institute) {
                return (object) [
                    'id' => $institute['id'],
                    'name' => $institute['instituteName'],
                    'ministryName' => $institute['ministry']['ministryName'], // Extracting ministry name
                    'address' => $institute['address'],
                    'short_name' => $institute['shortName'],
                    'status' => $institute['status'],
                ];
            });

            // Apply pagination
            $institutions = $this->paginateCollection($institutions, 10);
        } else {
            session()->flash('error', 'Failed to fetch ministries from the server.');
            // logger()->error('Error Fetching ministries:', ['response' => $response->body()]);
        }


        $ministryResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/ministry");

        $ministries = collect([]);
        if ($ministryResponse->successful()) {
            $ministryData = $ministryResponse->json()['data'];
            $ministries = collect($ministryData)->map(function ($ministry) {
                return (object) [
                    'id' => $ministry['id'],
                    'name' => $ministry['ministryName'],
                ];
            });
        } else {
            logger()->error('Error Fetching ministry Types:', ['response' => $ministryResponse->body()]);
        }

        return view('livewire.institution-component', [
            'institutions' => $institutions,
            'ministries' => $ministries,
        ])->layout('layouts.app');
    }
}
