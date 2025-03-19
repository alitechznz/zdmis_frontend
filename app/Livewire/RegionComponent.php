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

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        // Determine if this is a create or update operation based on $this->region_id
        $url = $this->region_id ? "http://41.59.105.130:3000/regions/{$this->region_id}" : 'http://41.59.105.130:3000/regions';
        $method = $this->region_id ? 'put' : 'post';

        // API request to external endpoint
        $response = Http::$method($url, [
            'regionName' => $this->name,
            'status' => $this->status,
        ]);

        if ($response->successful()) {
            // Sync with local database
            // Region::updateOrCreate(['id' => $this->region_id], [
            //     'regionName' => $this->name,
            //     'status' => $this->status,
            // ]);
            logger()->info("URL requested: {$url}");
            logger()->info("Data sent: ", ['regionName' => $this->name, 'status' => $this->status]);


            // session()->flash('message', $this->region_id ? 'Region Updated Successfully.' : 'Region Created Successfully.');
            $this->dispatch('swal:info', title: $this->region_id ? 'Region Updated.' : 'Region Created');
            $this->resetField();
            $this->dispatch('closeModal'); // Ensure you have the listeners set up for this event
        } else {
            session()->flash('error', 'Failed to create or update the region on the external server.');
        }
    }



    public function edit($region_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->region_id = $region_id;

        // Construct the URL for the API request
        $url = "http://41.59.105.130:3000/regions/{$region_id}";
        $response = Http::get($url);

        if ($response->successful()) {
            $regionData = $response->json();

            // Check if the array is not empty and the keys exist
            if (!empty($regionData) && isset($regionData[0]['regionName'], $regionData[0]['status'])) {
                $this->name = $regionData[0]['regionName'];
                $this->status = $regionData[0]['status'];
            } else {
                // Handle the case where the expected keys are not present or the array is empty
                session()->flash('error', 'The expected data keys are not present in the API response.');
                return; // Stop further execution if the necessary data is missing
            }
        } else {
            // Log error or handle the situation when the region is not found or the API call fails
            session()->flash('error', 'Failed to fetch region details. Error: ' . $response->body());
            return; // Stop further execution if the API call was unsuccessful
        }
    }






    public function deleteConfirm(Region $region)
    {
        $this->delete_confirm = $region;
    }



    public function destroy($regionId)
    {
        $url = "http://41.59.105.130:3000/regions/{$regionId}";
        $response = Http::delete($url);

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

    // public function render()
    // {
    //     $regions = Region::query()->latest();
    //     if ($this->search_keyword) {
    //         $regions->where('id', $this->search_keyword)
    //             ->orWhere('name', 'like', '%' . $this->search_keyword . '%')->orWhere('status', 'like', '%' . $this->search_keyword . '%');
    //     }

    //     $regions = $regions->paginate();


    //     return view('livewire.region-component', [
    //         'regions' => $regions
    //     ])->layout('layouts.app');
    // }


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

    // public function render()
    // {
    //     $query = [];

    //     // Check if there's a search keyword and prepare the query parameters
    //     if ($this->search_keyword) {
    //         $query['search'] = $this->search_keyword; // Assuming the API uses 'search' query param for filtering
    //     }

    //     // Fetch regions from the external API with search query if present
    //     $response = Http::get('http://41.59.105.130:3000/regions', $query);
    //     $regions = collect([]);

    //     if ($response->successful()) {
    //         $regionsData = $response->json();
    //         // Convert the response to a collection for easier handling in Blade
    //         $regions = collect($regionsData)->map(function ($region) {
    //             return (object)$region; // Convert each array to an object
    //         });
    //     } else {
    //         // Optionally handle errors or log them
    //     }

    //     return view('livewire.region-component', [
    //         'regions' => $regions
    //     ])->layout('layouts.app');
    // }

    public function render()
    {
        $query = [];

        if ($this->search_keyword) {
            $query['search'] = $this->search_keyword;
        }

        $response = Http::get('http://41.59.105.130:3000/regions', $query);
        $regions = collect([]);

        if ($response->successful()) {
            $regionsData = $response->json();
            $regions = collect($regionsData)->map(function ($region) {
                return (object)$region;
            });
            // Now paginate the collection
            $regions = $this->paginateCollection($regions, 10); // Adjust '10' to however many items per page you want
        }

        return view('livewire.region-component', [
            'regions' => $regions
        ])->layout('layouts.app');
    }
}
