<?php

namespace App\Livewire\Standard;

use App\Models\District;
use App\Models\Region;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Livewire\WithPagination;


class StandardComponent extends Component
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


    public function store()
    {
        $this->validate([
            'name' => 'required',
            'region' => 'required',
            'status' => 'required',
        ]);

        // Determine if this is a create or update operation based on $this->region_id
        $url = $this->district_id ? "http://41.59.105.130:3000/districts/{$this->district_id}" : 'http://41.59.105.130:3000/districts';
        $method = $this->district_id ? 'put' : 'post';

        // API request to external endpoint
        $response = Http::$method($url, [
            'districtName' => $this->name,
            'regionId' => $this->region,
            'status' => $this->status,
        ]);

        if ($response->successful()) {
            logger()->info("URL requested: {$url}");
            logger()->info("Data sent: ", ['districtName' => $this->name, 'status' => $this->status]);

            $this->dispatch('swal:info', title: $this->district_id ? 'District Updated.' : 'District Created');
            $this->resetField();
            $this->dispatch('closeModal'); // Ensure you have the listeners set up for this event
        } else {
            session()->flash('error', 'Failed to create or update the region on the external server.');
        }
    }


    public function edit($district_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->district_id = $district_id;

        // Construct the URL for the API request
        $url = "http://41.59.105.130:3000/districts/{$district_id}";
        $response = Http::get($url);

        if ($response->successful()) {
            $districtData = $response->json();

            // Check if the array is not empty and the keys exist
            if (!empty($districtData) && isset($districtData[0]['districtName'], $districtData[0]['status'], $districtData[0]['regionId'])) {
                $this->name = $districtData[0]['districtName'];
                $this->region = $districtData[0]['regionId'];
                $this->status = $districtData[0]['status'];
            } else {
                // Handle the case where the expected keys are not present or the array is empty
                session()->flash('error', 'The expected data keys are not present in the API response.');
                return; // Stop further execution if the necessary data is missing
            }
        } else {
            // Log error or handle the situation when the region is not found or the API call fails
            session()->flash('error', 'Failed to fetch district details. Error: ' . $response->body());
            return; // Stop further execution if the API call was unsuccessful
        }
    }

    public function deleteConfirm(District $district)
    {
        $this->delete_confirm = $district;
    }

    public function destroy($districtId)
    {
        $url = "http://41.59.105.130:3000/districts/{$districtId}";
        $response = Http::delete($url);

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
        // $districts = District::query()->with('region')->latest();
        // if ($this->search_keyword) {
        //     $districts->where('id', $this->search_keyword)
        //         ->orWhere('name', 'like', '%' . $this->search_keyword . '%')->orWhere('region_id', 'like', '%' . $this->search_keyword . '%')->orWhere('status', 'like', '%' . $this->search_keyword . '%');
        // }

        // $districts = $districts->paginate();


        // Fetch regions from the API
        $response = Http::get('http://41.59.105.130:3000/regions');
        $regions = collect([]);

        if ($response->successful()) {
            $regionsData = $response->json();
            // Assuming the API returns an array of regions
            $regions = collect($regionsData)->map(function ($region) {
                return (object)[
                    'id' => $region['id'], // Adjust keys based on the actual API response
                    'name' => $region['regionName']
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

        $response = Http::get('http://41.59.105.130:3000/districts', $query);
        $districts = collect([]);

        if ($response->successful()) {
            $districtsData = $response->json();
            $districts = collect($districtsData)->map(function ($district) {
                return (object)$district;
            });
            // Now paginate the collection
            $districts = $this->paginateCollection($districts, 10); // Adjust '10' to however many items per page you want
        }

        return view('livewire.standard.standard-component', [
            'districts' => $districts,
            'regions' => $regions,
        ])->layout('layouts.app');
    }
}
