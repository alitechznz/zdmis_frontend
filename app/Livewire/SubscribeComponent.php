<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Livewire\WithPagination;

class SubscribeComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;
    public $description, $location, $status, $incident, $subject, $contact, $message, $notify_id, $incident_id = null;
    public $selectedContact;


    private function getBaseUrl()
    {
        return config('services.api.base_url');
    }

    public function setContact($contact)
    {
        // $this->selectedContact = $contact;
        $this->selectedContact = '+255' . substr($contact, 1);
        $this->reset(['subject', 'message']); // Optional: Reset these fields if you have them in the form
    }


    public function create()
    {
        $this->resetField();
    }


    public function notify()
    {
        $this->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $baseUrl = $this->getBaseUrl();
        $url = $this->notify_id ? "{$baseUrl}/subscriber/alert/{$this->notify_id}" : "{$baseUrl}/subscriber/alert";
        $method = $this->notify_id ? 'put' : 'post';

        $token = session('token'); // Retrieve the auth token

        // Adjusted payload with correct field names and structures
        $payload = [
            'contact' => $this->selectedContact,
            'subject' => $this->subject,
            'message' => $this->message,
        ];

        logger()->info("Sending notification with payload:", $payload);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->$method($url, $payload);
        // logger()->info("Sending notification with payload:", $payload);
        if ($response->successful()) {
            logger()->info("Notification updated or created successfully.");
            $this->dispatch('swal:info', title: $this->incident_id ? 'Notification updated successfully.' : 'Notification successfully Created');
            $this->resetField();
        } else {
            logger()->error("Failed to update or create the Notification: {$response->body()}");
            $this->dispatch('swal:info', title: 'Failed to create or update the Notification on the external server.');
            session()->flash('error', 'Failed to create or update the Notification on the external server.');
        }
    }


    public function notifyAll()
    {
        $this->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $baseUrl = $this->getBaseUrl();
        $token = session('token');

        $subscriberResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/subscriber");

        $subscribers = collect([]);
        if ($subscriberResponse->successful()) {
            $subscriberData = $subscriberResponse->json()['data'];
            $subscribers = collect($subscriberData)->map(function ($subscriber) {
                return (object) [
                    'id' => $subscriber['id'],
                    'contact' => $subscriber['contact'],
                    'subscription_type' => $subscriber['subscription_type'],
                    'status' => $subscriber['status'],
                ];
            });
        } else {
            logger()->error('Error Fetching subscribers:', ['response' => $subscriberResponse->body()]);
        }

        foreach ($subscribers as $subscriber) {
            if ($subscriber->status == 'active' && $subscriber->subscription_type == 'phone') {
                $url = "{$baseUrl}/subscriber/alert";
                $payload = [
                    'contact' => $subscriber->contact,
                    'subject' => $this->subject,
                    'message' => $this->message,
                ];

                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json'
                ])->post($url, $payload);

                if (!$response->successful()) {
                    logger()->error("Failed to send notification to {$subscriber->contact}: {$response->body()}");
                    // Handle error appropriately, e.g., by breaking out of the loop or logging the error
                }
            }
        }

        $this->dispatch('swal:info', title: 'Notifications sent successfully.');
        $this->reset(['subject', 'message', 'selectedContact']); // Reset fields after sending
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

        // Adjusted payload with correct field names and structures
        $payload = [
            'description' => $this->description,
            'location' => $this->location,
            'status' => $this->status,
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


    public function deleteConfirm($subscriberId)
    {
        $this->delete_confirm = $subscriberId;
    }

    public function destroy()
    {
        if ($this->delete_confirm) {
            $baseUrl = $this->getBaseUrl();
            $url = "{$baseUrl}/subscriber/{$this->delete_confirm}";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . session('token'),
                'Accept' => 'application/json'
            ])->delete($url);

            if ($response->successful()) {
                $this->dispatch('swal:info', title: 'Subscriber Deleted');
                $this->reset('delete_confirm');
            } else {
                logger()->error("Failed to delete Subscriber: " . $response->body());
                $this->dispatch('swal:info', title: 'Failed to delete the Subscriber.');
            }
        }
        $this->dispatch('closeModal');
    }

    private function resetField()
    {
        $this->reset('description', 'location', 'incident', 'status', 'incident_id', 'update', 'message', 'subject');
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
        $token = session('token');

        // Check for the authentication token
        if (!$token) {
            session()->flash('error', 'No authentication token available. Please login again.');
            return view('livewire.subscribe-component', ['subscribers' => collect([])])->layout('layouts.app');
        }

        // Preparing the query
        $query = [];
        if ($this->search_keyword) {
            $query['search'] = $this->search_keyword;
        }

        // Make the HTTP GET request with the search query
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/subscriber", $query);

        // Initialize an empty collection for subscribers
        $subscribers = collect([]);

        if ($response->successful()) {
            $subscribersData = $response->json()['data'];
            // logger()->info('Fetched subscribers:', $subscribersData);
            $subscribers = collect($subscribersData)->map(function ($subscriber) {
                return (object) [
                    'id' => $subscriber['id'],
                    'contact' => $subscriber['contact'],
                    'subscription_type' => $subscriber['subscription_type'],
                    'status' => $subscriber['status'],
                ];
            });

            // Apply pagination if necessary
            $subscribers = $this->paginateCollection($subscribers, 10);
        } else {
            session()->flash('error', 'Failed to fetch subscribers from the server.');
            // logger()->error('Error Fetching subscribers:', ['response' => $response->body()]);
        }

        return view('livewire.subscribe-component', [
            'subscribers' => $subscribers,
        ])->layout('layouts.app');
    }
}
