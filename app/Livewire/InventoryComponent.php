<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class InventoryComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $name, $description, $optimal_stock_level, $current_stock_level, $inventory_id = null;

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
            'description' => 'required',
            'optimal_stock_level' => 'required',
            'current_stock_level' => 'required',
        ]);

        // Determine if this is a create or update operation based on $this->region_id
        $baseUrl = $this->getBaseUrl();
        $url = $this->inventory_id ? "{$baseUrl}/inventory-items/{$this->inventory_id}" : "{$baseUrl}/inventory-items";
        $method = $this->inventory_id ? 'put' : 'post';

        $token = session('token');

        // API request to external endpoint
        $payload = [
            'itemName' => $this->name,
            'description' => $this->description,
            'optimalStockLevel' => $this->optimal_stock_level,
            'currentStockLevel' => $this->current_stock_level,
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->$method($url, $payload);



        if ($response->successful()) {
            logger()->info("URL requested: {$url}");
            logger()->info("Data sent: ", ['itemName' => $this->name, 'optimalStockLevel' => $this->optimal_stock_level]);
            $this->dispatch('swal:info', title: $this->inventory_id ? 'Inventory Updated.' : 'Inventory Created');
            $this->resetField();
            $this->dispatch('closeModal'); // Ensure you have the listeners set up for this event
        } else {
            logger()->error("Failed to update or create the Inventory: {$response->body()}");
            session()->flash('error', 'Failed to create or update the Inventory on the external server.');
            $this->dispatch('swal:info', title: $this->inventory_id ? 'Error while updating Inventory.' : 'Error while creating Inventory');
        }
    }



    public function edit($inventory_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->inventory_id = $inventory_id;

        // Construct the URL for the API request
        $baseUrl = $this->getBaseUrl();
        $url = "{$baseUrl}/inventory-items/{$inventory_id}";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get($url);

        if ($response->successful()) {
            $responseBody = $response->json();
            // logger()->info('Ministry Data:', $responseBody);

            if (!empty($responseBody['data']) && is_array($responseBody['data'])) {
                $inventoryData = $responseBody['data']; // Assuming the first element is what you want
                $this->name = $inventoryData['itemName'] ?? 'No ministry name provided';
                $this->description = $inventoryData['description'] ?? 'No description provided';
                $this->optimal_stock_level = $inventoryData['optimalStockLevel'] ?? 'No optimal Stock Level  provided';
                $this->current_stock_level = $inventoryData['currentStockLevel'] ?? 'No current stock level provided';

                // logger()->info('ministry Data:', [
                //     'ministryName' => $this->name,
                //     'address' => $this->address,
                //     'voteNumber' => $this->vote_number,
                //     'status' => $this->status,
                // ]);
            } else {
                logger()->error("Failed to load load ministry: {$response->body()}");
                session()->flash('error', 'No Inventory data found or structure is incorrect.');
            }
        } else {
            logger()->error("Failed to load ministry: {$response->body()}");
            session()->flash('error', 'Failed to fetch Inventory details. Error: ' . $response->body());
        }
    }



    public function deleteConfirm($inventoryId)
    {
        $this->delete_confirm = $inventoryId;
        // $this->dispatch('show-delete-modal');
    }

    public function destroy()
    {
        if ($this->delete_confirm) {
            $baseUrl = $this->getBaseUrl();
            $url = "{$baseUrl}/inventory-items/{$this->delete_confirm}";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . session('token'),
                'Accept' => 'application/json'
            ])->delete($url);

            if ($response->successful()) {
                $this->dispatch('swal:info', title: 'Inventory Deleted');
                $this->reset('delete_confirm');
            } else {
                logger()->error("Failed to delete Inventory: " . $response->body());
                $this->dispatch('swal:info', title: 'Failed to delete the Inventory.');
            }
        }
        $this->dispatch('closeModal');
    }



    private function resetField()
    {
        $this->reset('name', 'description', 'optimal_stock_level', 'current_stock_level', 'inventory_id', 'update');
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
            return view('livewire.inventory-component', ['ministries' => collect([])])->layout('layouts.app');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/inventory-items", $query);

        $inventories = collect([]);

        if ($response->successful()) {
            $inventoriesData = $response->json()['data'];
            // logger()->info('Fetched inventories:', $inventoriesData);
            $inventories = collect($inventoriesData)->map(function ($inventory) {
                return (object) [
                    'id' => $inventory['id'],
                    'name' => $inventory['itemName'],
                    'description' => $inventory['description'],
                    'optimalStockLevel' => $inventory['optimalStockLevel'],
                    'currentStockLevel' => $inventory['currentStockLevel'],
                ];
            });

            // Apply pagination
            $inventories = $this->paginateCollection($inventories, 10);
        } else {
            session()->flash('error', 'Failed to fetch ministries from the server.');
            // logger()->error('Error Fetching inventories:', ['response' => $response->body()]);
        }


        return view('livewire.inventory-component', [
            'inventories' => $inventories
        ])->layout('layouts.app');
    }
}