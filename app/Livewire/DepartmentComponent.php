<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Institution;
use App\Models\Ministry;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class DepartmentComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;
    public $ministry_address = null;

    // public $name, $institution, $address, $department_id = null;
    public $name, $under, $institution_id, $vote_number, $web_url, $status, $institution, $ministry, $address, $department_id = null;
    // public $institutions = [], $ministries = [];




    public function mount()
    {
        // $this->ministries = Ministry::all();
        // $this->institutions = Institution::all();
    }


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
            'institution' => 'required',
            'status' => 'required',
        ]);

        $baseUrl = $this->getBaseUrl();
        $url = $this->department_id ? "{$baseUrl}/department/{$this->department_id}" : "{$baseUrl}/department";
        $method = $this->department_id ? 'put' : 'post';

        $token = session('token');

        // API request to external endpoint
        $payload = [
            'departmentName' => $this->name,
            'institution' => ['id' => (int) $this->institution],  // Wrap the institution ID inside an object
            'status' => in_array(strtolower($this->status), ['active', 'true', '1']), // safely cast to true/false
        ];


        logger()->info("Preparing to send payload:", $payload);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->$method($url, $payload);


        if ($response->successful()) {
            logger()->info("URL requested: {$url}");
            logger()->info("Data sent: ", ['Department Name' => $this->name, 'status' => $this->status]);
            $this->dispatch('swal:info', title: $this->department_id ? 'Department Updated.' : 'Department Created');
            $this->resetField();
            $this->dispatch('closeModal');
        } else {
            logger()->error("Failed to update or create the Department: {$response->body()}");
            session()->flash('error', 'Failed to create or update the Department on the external server.');
            $this->dispatch('swal:info', title: $this->department_id ? 'Error while updating Department.' : 'Error while creating Department');
        }
    }



    public function edit($department_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->department_id = $department_id;

        // Construct the URL for the API request
        $baseUrl = $this->getBaseUrl();
        $url = "{$baseUrl}/department/{$department_id}";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get($url);

        if ($response->successful()) {
            $responseBody = $response->json();
            logger()->info('Department Data:', $responseBody);

            if (!empty($responseBody['data']) && is_array($responseBody['data'])) {
                $departmentData = $responseBody['data']; // Assuming the first element is what you want
                $this->name = $departmentData['departmentName'] ?? 'No department name provided';
                $this->status = $departmentData['status'] ?? 'No status provided';

                logger()->info('department Data:', [
                    'departmentName' => $this->name,
                    'status' => $this->status,
                ]);
            } else {
                logger()->error("Failed to load department: {$response->body()}");
                session()->flash('error', 'No department data found or structure is incorrect.');
            }
        } else {
            logger()->error("Failed to load department: {$response->body()}");
            session()->flash('error', 'Failed to fetch department details. Error: ' . $response->body());
        }
    }



    public function deleteConfirm($departmentId)
    {
        $this->delete_confirm = $departmentId;
    }

    public function destroy()
    {
        if ($this->delete_confirm) {
            $baseUrl = $this->getBaseUrl();
            $url = "{$baseUrl}/department/{$this->delete_confirm}";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . session('token'),
                'Accept' => 'application/json'
            ])->delete($url);

            if ($response->successful()) {
                $this->dispatch('swal:info', title: 'Department Deleted');
                $this->reset('delete_confirm');
            } else {
                logger()->error("Failed to delete Department: " . $response->body());
                $this->dispatch('swal:info', title: 'Failed to delete the Department.');
            }
        }
        $this->dispatch('closeModal');
    }

    private function resetField()
    {
        $this->reset('name', 'institution', 'address', 'ministry', 'department_id', 'update', 'web_url', 'under', 'status', 'vote_number');
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
            return view('livewire.department-component', ['departments' => collect([])])->layout('layouts.app');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/department", $query);

        $departments = collect([]);

        if ($response->successful()) {
            $departmentsData = $response->json()['data'];
            logger()->info('Fetched departments:', $departmentsData);
            $departments = collect($departmentsData)->map(function ($department) {
                return (object) [
                    'id' => $department['id'],
                    'name' => $department['departmentName'],
                    'instituteName' => $department['institution']['instituteName'], // Extracting instituteName
                    'status' => $department['status'],
                ];
            });

            // Apply pagination
            $departments = $this->paginateCollection($departments, 10);
        } else {
            session()->flash('error', 'Failed to fetch departments from the server.');
            logger()->error('Error Fetching departments:', ['response' => $response->body()]);
        }


        $institutionResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/institution");

        $institutions = collect([]);
        if ($institutionResponse->successful()) {
            $institutionData = $institutionResponse->json()['data'];
            logger()->info('Fetched institutions:', $institutionData);
            $institutions = collect($institutionData)->map(function ($institution) {
                return (object) [
                    'id' => $institution['id'],
                    'name' => $institution['instituteName'],
                ];
            });
        } else {
            logger()->error('Error Fetching departments:', ['response' => $institutionResponse->body()]);
        }


        return view('livewire.department-component', [
            'departments' => $departments,
            'institutions' => $institutions,
            // 'ministries' => Ministry::all(),
        ])->layout('layouts.app');
    }
}
