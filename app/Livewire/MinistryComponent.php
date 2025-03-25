<?php

namespace App\Livewire;

use App\Models\Ministry;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class MinistryComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $name, $short_name, $vote_number, $status, $address, $ministry_id = null;

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
            'vote_number' => 'required',
            'short_name' => 'required',
            'status' => 'required',
        ]);

        // Determine if this is a create or update operation based on $this->region_id
        $baseUrl = $this->getBaseUrl();
        $url = $this->ministry_id ? "{$baseUrl}/ministry/{$this->ministry_id}" : "{$baseUrl}/ministry";
        $method = $this->ministry_id ? 'put' : 'post';

        $token = session('token');

        // API request to external endpoint
        $payload = [
            'ministryName' => $this->name,
            'address' => $this->address,
            'voteNumber' => $this->vote_number,
            'shortName' => $this->short_name,
            'status' => in_array(strtolower($this->status), ['active', 'true', '1']), // safely cast to true/false
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->$method($url, $payload);



        if ($response->successful()) {
            logger()->info("URL requested: {$url}");
            logger()->info("Data sent: ", ['ministryName' => $this->name, 'status' => $this->status]);
            $this->dispatch('swal:info', title: $this->ministry_id ? 'Ministry Updated.' : 'Ministry Created');
            $this->resetField();
            $this->dispatch('closeModal'); // Ensure you have the listeners set up for this event
        } else {
            logger()->error("Failed to update or create the Ministry: {$response->body()}");
            session()->flash('error', 'Failed to create or update the Ministry on the external server.');
            $this->dispatch('swal:info', title: $this->ministry_id ? 'Error while updating Ministry.' : 'Error while creating Ministry');
        }
    }



    public function edit($ministry_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->ministry_id = $ministry_id;

        // Construct the URL for the API request
        $baseUrl = $this->getBaseUrl();
        $url = "{$baseUrl}/ministry/{$ministry_id}";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get($url);

        if ($response->successful()) {
            $responseBody = $response->json();
            // logger()->info('Ministry Data:', $responseBody);

            if (!empty($responseBody['data']) && is_array($responseBody['data'])) {
                $ministryData = $responseBody['data']; // Assuming the first element is what you want
                $this->name = $ministryData['ministryName'] ?? 'No ministry name provided';
                $this->address = $ministryData['address'] ?? 'No address provided';
                $this->vote_number = $ministryData['voteNumber'] ?? 'No vote number  provided';
                $this->short_name = $ministryData['shortName'] ?? 'No short name provided';
                $this->status = $ministryData['status'] ?? 'No status provided';

                // logger()->info('ministry Data:', [
                //     'ministryName' => $this->name,
                //     'address' => $this->address,
                //     'voteNumber' => $this->vote_number,
                //     'status' => $this->status,
                // ]);
            } else {
                logger()->error("Failed to load load ministry: {$response->body()}");
                session()->flash('error', 'No ministry data found or structure is incorrect.');
            }
        } else {
            logger()->error("Failed to load ministry: {$response->body()}");
            session()->flash('error', 'Failed to fetch ministry details. Error: ' . $response->body());
        }
    }



    public function deleteConfirm($ministryId)
    {
        $this->delete_confirm = $ministryId;
        // $this->dispatch('show-delete-modal');
    }

    public function destroy()
    {
        if ($this->delete_confirm) {
            $baseUrl = $this->getBaseUrl();
            $url = "{$baseUrl}/ministry/{$this->delete_confirm}";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . session('token'),
                'Accept' => 'application/json'
            ])->delete($url);

            if ($response->successful()) {
                $this->dispatch('swal:info', title: 'Ministry Deleted');
                $this->reset('delete_confirm');
            } else {
                logger()->error("Failed to delete Ministry: " . $response->body());
                $this->dispatch('swal:info', title: 'Failed to delete the Ministry.');
            }
        }
        $this->dispatch('closeModal');
    }



    private function resetField()
    {
        $this->reset('name', 'short_name', 'status', 'vote_number', 'address', 'ministry_id', 'update');
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
        $query = [];
        if ($this->search_keyword) {
            $query['search'] = $this->search_keyword;
        }

        $baseUrl = $this->getBaseUrl();
        // Assuming the token is stored in the session, you can retrieve it like this:
        $token = session('token'); // Ensure you have set this session variable when you login

        if (!$token) {
            session()->flash('error', 'No authentication token available. Please login again.');
            return view('livewire.ministry-component', ['ministries' => collect([])])->layout('layouts.app');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/ministry", $query);

        $ministries = collect([]);

        if ($response->successful()) {
            $ministriesData = $response->json()['data'];
            // logger()->info('Fetched ministries:', $ministriesData);
            $ministries = collect($ministriesData)->map(function ($ministry) {
                return (object) [
                    'id' => $ministry['id'],
                    'name' => $ministry['ministryName'],
                    'address' => $ministry['address'],
                    'voteNumber' => $ministry['voteNumber'],
                    'shortName' => $ministry['shortName'],
                    'status' => $ministry['status'],
                ];
            });

            // Apply pagination
            $ministries = $this->paginateCollection($ministries, 10);
        } else {
            session()->flash('error', 'Failed to fetch ministries from the server.');
            // logger()->error('Error Fetching ministries:', ['response' => $response->body()]);
        }


        return view('livewire.ministry-component', [
            'ministries' => $ministries
        ])->layout('layouts.app');
    }
}