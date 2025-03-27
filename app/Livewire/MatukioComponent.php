<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Livewire\WithPagination;
use Carbon\Carbon;

class MatukioComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;

    public $description, $location, $status, $incident, $incident_id = null;



    private function getBaseUrl()
    {
        return config('services.api.base_url');
    }

    public function create()
    {
        $this->resetField();
    }


    public function store()
    {
        $this->validate([
            'description' => 'required',
            'location' => 'required',
            'status' => 'required',
            'incident' => 'required', // Ensure this is correctly capturing an incident type ID
        ]);

        $baseUrl = $this->getBaseUrl();
        $url = $this->incident_id ? "{$baseUrl}/incidents/{$this->incident_id}" : "{$baseUrl}/incidents";
        $method = $this->incident_id ? 'put' : 'post';

        $token = session('token'); // Retrieve the auth token

        // First, generate the incident code
        $incidentCode = $this->generateIncidentCode($this->incident);

        // Adjusted payload with correct field names and structures
        $payload = [
            'description' => $this->description,
            'location' => $this->location,
            'status' => $this->status,
            'incidentCode' => $incidentCode, // Include the generated incident code
            'incidentType' => [
                'id' => $this->incident, // Assuming this is the ID of the incident type
            ],
            'reportedBy' => [
                'id' => 3, // Example ID, adjust based on your application's logic
            ],
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->$method($url, $payload);

        if ($response->successful()) {
            // logger()->info("Incidents updated or created successfully.");
            $this->dispatch('swal:info', title: $this->incident_id ? 'Incident updated successfully.' : 'Incident successfully Created');
            $this->resetField();
        } else {
            // logger()->error("Failed to update or create the incident: {$response->body()}");
            $this->dispatch('swal:info', title: 'Failed to create or update the incident on the external server.');
            session()->flash('error', 'Failed to create or update the incident on the external server.');
        }
    }

    private function generateIncidentCode($incidentTypeId)
    {
        $currentYear = now()->year;
        $baseUrl = $this->getBaseUrl();
        $token = session('token');  // Assuming the token is stored in the session

        // Endpoint to get incident type details
        $incidentTypeResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/incidents/{$incidentTypeId}");

        if ($incidentTypeResponse->failed()) {
            throw new \Exception('Failed to fetch incident type');
        }
        $incidentType = $incidentTypeResponse->json();

        // Fetch all incidents
        $incidentsResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/api/incidents");

        if ($incidentsResponse->failed()) {
            throw new \Exception('Failed to fetch incidents');
        } 
            $incidents = $incidentsResponse->json();
            $token = $incidents['data']['incidentType']['title'];
       

        // Count the number of incidents of the specified type and year
        $incidentCount = 0;
        foreach ($incidents as $incident) {
            if (isset($incident['incidentType_id']) && $incident['incidentType_id'] == $incidentTypeId &&
                Carbon::parse($incident['created_at'])->year == $currentYear) {
                $incidentCount++;
            }
        }

        $incidentCount = $incidentCount + 1;
        $code_incident = $incidentType['title'].'/'.$currentYear.'/'.$incidentCount;
    
        return $code_incident;
    }

    private function generateIncidentCode1($incidentTypeId)
    {
        $currentYear = now()->year;
    
        // Endpoint to get incident type details
        $incidentTypeResponse = Http::get("https://yourapi.com/api/incident-types/{$incidentTypeId}");
        if ($incidentTypeResponse->failed()) {
            throw new \Exception('Failed to fetch incident type');
        }
        $incidentType = $incidentTypeResponse->json();
    
        // Fetch all incidents (this might need pagination or other handling if there are many incidents)
        $incidentsResponse = Http::get("https://yourapi.com/api/incidents");
        if ($incidentsResponse->failed()) {
            throw new \Exception('Failed to fetch incidents');
        }
        $incidents = $incidentsResponse->json();
    
        // Count the number of incidents of the specified type and year
        $incidentCount = 0;
        foreach ($incidents as $incident) {
            if ($incident['incidentType_id'] == $incidentTypeId && 
                Carbon::parse($incident['created_at'])->year == $currentYear) {
                $incidentCount++;
            }
        }
        $incidentCount = $incidentCount + 1;
        $code_incident = $incidentType['title'].'/'.$currentYear.'/'.$incidentCount;
    
        return $code_incident;
    }

    public function edit($incident_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->incident_id = $incident_id;

        // Construct the URL for the API request
        $baseUrl = $this->getBaseUrl();
        $url = "{$baseUrl}/incidents/{$incident_id}";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get($url);

        if ($response->successful()) {
            $responseBody = $response->json();
            // logger()->info('Incident Data:', $responseBody);

            if (!empty($responseBody['data']) && is_array($responseBody['data'])) {
                $incidentData = $responseBody['data']; // Assuming the first element is what you want

                $this->description = $incidentData['description'] ?? 'No description provided';
                $this->location = $incidentData['location'] ?? 'No location provided';
                $this->status = $incidentData['status'] ?? 'No status provided';
                $this->incident = $incidentData['incidentType']['id'] ?? null; // Adjusted to fetch from nested incidentType

                // logger()->info('Assigned Data:', [
                //     'description' => $this->description,
                //     'location' => $this->location,
                //     'status' => $this->status,
                //     'incidentTypeId' => $this->incident,
                // ]);
            } else {
                session()->flash('error', 'No incident data found or structure is incorrect.');
            }
        } else {
            session()->flash('error', 'Failed to fetch incident details. Error: ' . $response->body());
        }
    }

    public function taarifa($incident_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->incident_id = $incident_id;

        // Construct the URL for the API request
        $baseUrl = $this->getBaseUrl();
        $url = "{$baseUrl}/incidents/{$incident_id}";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get($url);

        if ($response->successful()) {
            $responseBody = $response->json();
            // logger()->info('Incident Data:', $responseBody);

            if (!empty($responseBody['data']) && is_array($responseBody['data'])) {
                $incidentData = $responseBody['data']; // Assuming the first element is what you want

                $this->description = $incidentData['description'] ?? 'No description provided';
                $this->location = $incidentData['location'] ?? 'No location provided';
                $this->status = $incidentData['status'] ?? 'No status provided';
                $this->incident = $incidentData['incidentType']['id'] ?? null; // Adjusted to fetch from nested incidentType

            } else {
                session()->flash('error', 'No incident data found or structure is incorrect.');
            }
        } else {
            session()->flash('error', 'Failed to fetch incident details. Error: ' . $response->body());
        }
    }


    public function destroy($incidentId)
    {
        $baseUrl = $this->getBaseUrl();
        $url = "{$baseUrl}/incidents/{$incidentId}";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->delete($url);

        if ($response->successful()) {
            $this->dispatch('swal:info', title: 'Incident Deleted');
        } else {
            logger()->error("Failed to delete Incident: " . $response->body());
            $this->dispatch('swal:info', title: 'Failed to delete the Incident.');
        }
    }

    private function resetField()
    {
        $this->reset('description', 'location', 'incident', 'status', 'incident_id', 'update');
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
            return view('livewire.matukio-component', ['incidents' => collect([])])->layout('layouts.app');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/incidents", $query);

        $incidents = collect([]);

        if ($response->successful()) {
            $incidentsData = $response->json()['data'];
            // logger()->info('Fetched Incidents:', $incidentsData);
            $incidents = collect($incidentsData)->map(function ($incident) {
                return (object) [
                    'id' => $incident['id'],
                    'title' => $incident['incidentType']['title'],
                    'reportedBy' => $incident['reportedBy']['fullName'],
                    'description' => $incident['description'],
                    'location' => $incident['location'],
                    'status' => $incident['status'],
                    'reportedBy' => $incident['reportedBy']['fullName'] ?? 'N/A',
                    'createdAt' => date('Y-m-d', strtotime($incident['createdAt'])),
                    'updatedAt' => $incident['updatedAt'],
                ];
            });

            // Apply pagination
            $incidents = $this->paginateCollection($incidents, 10);
        } else {
            session()->flash('error', 'Failed to fetch incidents from the server.');
            // logger()->error('Error Fetching Incidents:', ['response' => $response->body()]);
        }


        // Fetch incident types if necessary, or handle other data fetching here
        $typeResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/incident-type");

        $incidentTypes = collect([]);
        if ($typeResponse->successful()) {
            $typesData = $typeResponse->json()['data'];
            $incidentTypes = collect($typesData)->map(function ($type) {
                return (object) [
                    'id' => $type['id'],
                    'title' => $type['title'],
                ];
            });
        } else {
            logger()->error('Error Fetching Incident Types:', ['response' => $typeResponse->body()]);
        }
        return view('livewire.matukio-component', [
            'incidents' => $incidents,
            'incidentTypes' => $incidentTypes,
        ])->layout('layouts.app');
    }
}