<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class InventoryTransactionComponent extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $item, $transaction_type, $quantity, $transaction_date, $notes, $transaction_id = null;

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
            'item' => 'required',
            'quantity' => 'required',
            'transaction_type' => 'required',
            'transaction_date' => 'required',
            'notes' => 'required',
        ]);

        // Determine if this is a create or update operation based on $this->region_id
        $baseUrl = $this->getBaseUrl();
        $url = $this->transaction_id ? "{$baseUrl}/inventory-transactions/{$this->transaction_id}" : "{$baseUrl}/inventory-transactions";
        $method = $this->transaction_id ? 'put' : 'post';

        $token = session('token');

        // API request to external endpoint
        $payload = [
            'itemId' => $this->item,
            'transactionType' => $this->transaction_type,
            'quantity' => $this->quantity,
            'transactionDate' => $this->transaction_date,
            'notes' => $this->notes,
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->$method($url, $payload);



        if ($response->successful()) {
            logger()->info("URL requested: {$url}");
            logger()->info("Data sent: ", ['transaction_type' => $this->transaction_type, 'notes' => $this->notes]);
            $this->dispatch('swal:info', title: $this->transaction_id ? 'Transaction Updated.' : 'Transaction Created');
            $this->resetField();
            $this->dispatch('closeModal'); // Ensure you have the listeners set up for this event
        } else {
            logger()->error("Failed to update or create the Transaction: {$response->body()}");
            session()->flash('error', 'Failed to create or update the Transaction on the external server.');
            $this->dispatch('swal:info', title: $this->transaction_id ? 'Error while updating Transaction.' : 'Error while creating Transaction');
        }
    }



    public function edit($transaction_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->transaction_id = $transaction_id;

        // Construct the URL for the API request
        $baseUrl = $this->getBaseUrl();
        $url = "{$baseUrl}/inventory-transactions/{$transaction_id}";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get($url);

        if ($response->successful()) {
            $responseBody = $response->json();
            // logger()->info('Ministry Data:', $responseBody);

            if (!empty($responseBody['data']) && is_array($responseBody['data'])) {
                $transactionData = $responseBody['data']; // Assuming the first element is what you want
                $this->item = $transactionData['itemId'] ?? 'No item provided';
                $this->transaction_type = $transactionData['transactionType'] ?? 'No description provided';
                $this->quantity = $transactionData['quantity'] ?? 'No quantity  provided';
                $this->transaction_date = $transactionData['transactionDate'] ?? 'No date provided';
                $this->notes = $transactionData['notes'] ?? 'No notes provided';

                // logger()->info('ministry Data:', [
                //     'ministryName' => $this->name,
                //     'address' => $this->address,
                //     'voteNumber' => $this->vote_number,
                //     'status' => $this->status,
                // ]);
            } else {
                logger()->error("Failed to load load transaction: {$response->body()}");
                session()->flash('error', 'No transaction data found or structure is incorrect.');
            }
        } else {
            logger()->error("Failed to load ministry: {$response->body()}");
            session()->flash('error', 'Failed to fetch transaction details. Error: ' . $response->body());
        }
    }



    public function deleteConfirm($transactionId)
    {
        $this->delete_confirm = $transactionId;
        // $this->dispatch('show-delete-modal');
    }

    public function destroy()
    {
        if ($this->delete_confirm) {
            $baseUrl = $this->getBaseUrl();
            $url = "{$baseUrl}/inventory-transactions/{$this->delete_confirm}";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . session('token'),
                'Accept' => 'application/json'
            ])->delete($url);

            if ($response->successful()) {
                $this->dispatch('swal:info', title: 'Transaction Deleted');
                $this->reset('delete_confirm');
            } else {
                logger()->error("Failed to delete Transaction: " . $response->body());
                $this->dispatch('swal:info', title: 'Failed to delete the Transaction.');
            }
        }
        $this->dispatch('closeModal');
    }



    private function resetField()
    {
        $this->reset('item', 'notes', 'transaction_type', 'quantity', 'transaction_date', 'transaction_id', 'update');
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
            return view('livewire.inventory-transaction-component', ['ministries' => collect([])])->layout('layouts.app');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/inventory-transactions", $query);

        $transactions = collect([]);

        if ($response->successful()) {
            $transactionsData = $response->json()['data'];
            // logger()->info('Fetched transactions:', $transactionsData);
            $transactions = collect($transactionsData)->map(function ($transaction) {
                return (object) [
                    'id' => $transaction['id'],
                    'transactionType' => $transaction['transactionType'],
                    'quantity' => $transaction['quantity'],
                    'transactionDate' => $transaction['transactionDate'],
                    'notes' => $transaction['notes'],
                ];
            });

            // Apply pagination
            $transactions = $this->paginateCollection($transactions, 10);
        } else {
            session()->flash('error', 'Failed to fetch ministries from the server.');
            // logger()->error('Error Fetching inventories:', ['response' => $response->body()]);
        }


        $inventoryResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/inventory-items");

        $inventories = collect([]);
        if ($inventoryResponse->successful()) {
            $inventoryData = $inventoryResponse->json()['data'];
            $inventories = collect($inventoryData)->map(function ($inventory) {
                return (object) [
                    'id' => $inventory['id'],
                    'name' => $inventory['itemName'],
                ];
            });
        } else {
            logger()->error('Error Fetching item:', ['response' => $inventoryResponse->body()]);
        }

        return view('livewire.inventory-transaction-component', [
            'transactions' => $transactions,
            'inventories' => $inventories
        ])->layout('layouts.app');
    }
}