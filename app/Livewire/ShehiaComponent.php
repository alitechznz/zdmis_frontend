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


    public function store()
    {
        $this->validate([
            'name' => 'required',
            'district' => 'required',
            'status' => 'required',
        ]);

        // Determine if this is a create or update operation based on $this->region_id
        $url = $this->shehia_id ? "http://41.59.105.130:3000/shehias/{$this->shehia_id}" : 'http://41.59.105.130:3000/shehias';
        $method = $this->shehia_id ? 'put' : 'post';

        // API request to external endpoint
        $response = Http::$method($url, [
            'shehiaName' => $this->name,
            'districtId' => $this->district,
            'status' => $this->status,
        ]);

        if ($response->successful()) {
            logger()->info("URL requested: {$url}");
            logger()->info("Data sent: ", ['shehiaName' => $this->name, 'status' => $this->status]);

            $this->dispatch('swal:info', title: $this->shehia_id ? 'Shehia Updated.' : 'Shehia Created');
            $this->resetField();
            $this->dispatch('closeModal'); // Ensure you have the listeners set up for this event
        } else {
            session()->flash('error', 'Failed to create or update the Shehia on the external server.');
        }
    }

    // public function edit($shehia_id)
    // {
    //     $this->resetErrorBag();
    //     $this->update  = true;
    //     $this->shehia_id = $shehia_id;

    //     $shehia = Shehia::findOrFail($shehia_id);
    //     $this->name = $shehia->name;
    //     $this->district = $shehia->district_id;
    //     $this->status = $shehia->status;
    // }

    public function edit($shehia_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->shehia_id = $shehia_id;

        // Construct the URL for the API request
        $url = "http://41.59.105.130:3000/shehias/{$shehia_id}";
        $response = Http::get($url);

        if ($response->successful()) {
            $shehiaData = $response->json();

            // Check if the array is not empty and the keys exist
            if (!empty($shehiaData) && isset($shehiaData[0]['shehiaName'], $shehiaData[0]['status'], $shehiaData[0]['districtId'])) {
                $this->name = $shehiaData[0]['shehiaName'];
                $this->district = $shehiaData[0]['districtId'];
                $this->status = $shehiaData[0]['status'];
            } else {
                // Handle the case where the expected keys are not present or the array is empty
                session()->flash('error', 'The expected data keys are not present in the API response.');
                return; // Stop further execution if the necessary data is missing
            }
        } else {
            // Log error or handle the situation when the region is not found or the API call fails
            session()->flash('error', 'Failed to fetch shehia details. Error: ' . $response->body());
            return; // Stop further execution if the API call was unsuccessful
        }
    }

    public function deleteConfirm(Shehia $shehia)
    {
        $this->delete_confirm = $shehia;
    }

    // public function destroy()
    // {
    //     $this->delete_confirm->delete();
    //     $this->dispatch('swal:info', title: 'Shehia Deleted');
    // }

    public function destroy($shehiaId)
    {
        $url = "http://41.59.105.130:3000/shehias/{$shehiaId}";
        $response = Http::delete($url);

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
        $response = Http::get('http://41.59.105.130:3000/districts');
        $districts = collect([]);

        if ($response->successful()) {
            $districtsData = $response->json();
            // Assuming the API returns an array of districts
            $districts = collect($districtsData)->map(function ($district) {
                return (object)[
                    'id' => $district['id'], // Adjust keys based on the actual API response
                    'name' => $district['districtName']
                ];
            });
        } else {
            // Handle the error or log it
            session()->flash('error', 'Failed to fetch regions.');
        }

        $query = [];

        if ($this->search_keyword) {
            $query['search'] = $this->search_keyword;
        }

        $response = Http::get('http://41.59.105.130:3000/shehias', $query);
        $shehias = collect([]);

        if ($response->successful()) {
            $shehiasData = $response->json();
            $shehias = collect($shehiasData)->map(function ($shehia) {
                return (object)$shehia;
            });
            // Now paginate the collection
            $shehias = $this->paginateCollection($shehias, 10); // Adjust '10' to however many items per page you want
        }

        // $shehias = Shehia::query()->latest();
        // if ($this->search_keyword) {
        //     $shehias->where('id', $this->search_keyword)
        //         ->orWhere('name', 'like', '%' . $this->search_keyword . '%')->orWhere('district_id', 'like', '%' . $this->search_keyword . '%')->orWhere('status', 'like', '%' . $this->search_keyword . '%');
        // }

        // $shehias = $shehias->paginate();


        return view('livewire.shehia-component', [
            'shehias' => $shehias,
            'districts' => $districts,
        ])->layout('layouts.app');
    }
}
