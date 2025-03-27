<?php

namespace App\Livewire;

use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Livewire\WithFileUploads;

class EducationComponent extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $search_keyword = null;
    public $update = false;
    public $delete_confirm = null;
    public $activeTab = 'wizard-contact';
    // public $currentTab = 'wizard-contact';

    public $disaster, $title, $audience, $contentUrl, $attachment_type, $disaster_education, $file, $attachment_description, $description, $disaster_id = null, $disaster_attachment_id = null;

    public function create()
    {
        $this->resetField();
    }

    public function updatedFile()
    {
        $this->activeTab = 'wizard-cart'; // Set to the attachments tab
    }

    // public function nextTab()
    // {
    //     if ($this->currentTab === 'wizard-contact') {
    //         $this->currentTab = 'wizard-cart';
    //     } elseif ($this->currentTab === 'wizard-cart') {
    //         // Add other conditions for more tabs
    //     }
    // }

    // public function previousTab()
    // {
    //     if ($this->currentTab === 'wizard-cart') {
    //         $this->currentTab = 'wizard-contact';
    //     } elseif ($this->currentTab === 'wizard-banking') {
    //         // Add other conditions for more tabs
    //     }
    // }


    private function getBaseUrl()
    {
        return config('services.api.base_url');
    }

    public function store()
    {
        $this->validate([
            'disaster' => 'required',
            'title' => 'required',
            'audience' => 'required',
            'contentUrl' => 'required',
            'description' => 'required',
        ]);

        // Determine if this is a create or update operation based on $this->region_id
        $baseUrl = $this->getBaseUrl();
        $url = $this->disaster_id ? "{$baseUrl}/disaster-education/{$this->disaster_id}" : "{$baseUrl}/disaster-education";
        $method = $this->disaster_id ? 'put' : 'post';

        $token = session('token');

        // API request to external endpoint
        $payload = [
            'disasterType' => $this->disaster,
            'title' => $this->title,
            'audience' => $this->audience,
            'contentUrl' => $this->contentUrl,
            'description' => $this->description,
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->$method($url, $payload);



        if ($response->successful()) {
            logger()->info("URL requested: {$url}");
            logger()->info("Data sent: ", ['disaster' => $this->disaster, 'audience' => $this->audience]);
            $this->dispatch('swal:info', title: $this->disaster_id ? 'Disaster education Updated.' : 'Disaster education Created');
            $this->resetField();
            $this->dispatch('closeModal'); // Ensure you have the listeners set up for this event
        } else {
            logger()->error("Failed to update or create the Disaster education: {$response->body()}");
            session()->flash('error', 'Failed to create or update the Disaster education on the external server.');
            $this->dispatch('swal:info', title: $this->disaster_id ? 'Error while updating Disaster education.' : 'Error while creating Disaster education');
        }
    }



    public function edit($disaster_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->disaster_id = $disaster_id;

        // Construct the URL for the API request
        $baseUrl = $this->getBaseUrl();
        $url = "{$baseUrl}/disaster-education/{$disaster_id}";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get($url);

        if ($response->successful()) {
            $responseBody = $response->json();
            logger()->info('Disaster education Data:', $responseBody);

            if (!empty($responseBody['data']) && is_array($responseBody['data'])) {
                $disasterEducationData = $responseBody['data']; // Assuming the first element is what you want
                $this->disaster = $disasterEducationData['disasterType'] ?? 'No disaster type provided';
                $this->title = $disasterEducationData['title'] ?? 'No title provided';
                $this->audience = $disasterEducationData['audience'] ?? 'No audience  provided';
                $this->contentUrl = $disasterEducationData['contentUrl'] ?? 'No content Url provided';
                $this->description = $disasterEducationData['description'] ?? 'No description provided';

                // logger()->info('ministry Data:', [
                //     'ministryName' => $this->name,
                //     'address' => $this->address,
                //     'voteNumber' => $this->vote_number,
                //     'status' => $this->status,
                // ]);
            } else {
                logger()->error("Failed to load load disaster education: {$response->body()}");
                session()->flash('error', 'No Disaster education data found or structure is incorrect.');
            }
        } else {
            logger()->error("Failed to load Disaster education: {$response->body()}");
            session()->flash('error', 'Failed to fetch Disaster education details. Error: ' . $response->body());
        }
    }



    public function deleteConfirm($id)
    {
        $this->delete_confirm = $id;
        // $this->dispatch('show-delete-modal');
    }

    public function destroy()
    {
        if ($this->delete_confirm) {
            $baseUrl = $this->getBaseUrl();
            $url = "{$baseUrl}/disaster-education/{$this->delete_confirm}";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . session('token'),
                'Accept' => 'application/json'
            ])->delete($url);

            if ($response->successful()) {
                $this->dispatch('swal:info', title: 'Disaster education Deleted');
                $this->reset('delete_confirm');
            } else {
                logger()->error("Failed to delete Ministry: " . $response->body());
                $this->dispatch('swal:info', title: 'Failed to delete the Disaster education.');
            }
        }
        $this->dispatch('closeModal');
    }



    private function resetField()
    {
        $this->reset('disaster', 'title', 'audience', 'contentUrl', 'description', 'disaster_id', 'update', 'attachment_description', 'file', 'disaster_education', 'attachment_type', 'disaster_attachment_id');
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



    public function storeEducationAttachment()
    {
        $this->validate([
            'attachment_type' => 'required',
            'file' => 'required|file', // Ensures the file input is validated properly
            'disaster_education' => 'required',
            'attachment_description' => 'required',
        ]);

        $baseUrl = $this->getBaseUrl();

        $url = $this->disaster_attachment_id ? "{$baseUrl}/education-attachments/{$this->disaster_attachment_id}" : "{$baseUrl}/education-attachments";
        $method = $this->disaster_attachment_id ? 'put' : 'post';

        $token = session('token');

        try {
            // Prepare the file upload request
            $response = Http::withToken($token)->attach(
                'file',
                file_get_contents($this->file->getRealPath()),
                $this->file->getClientOriginalName()
            )->{$method}($url, [
                'description' => $this->attachment_description,
                'attachmentType' => $this->attachment_type,
                'educationId' => $this->disaster_education,
            ]);


            if ($response->successful()) {
                logger()->info("URL requested: {$url}");
                logger()->info("Data sent: ", ['educationId' => $this->disaster_education, 'attachmentType' => $this->attachment_type]);
                $this->dispatch('swal:info', title: $this->disaster_attachment_id ? 'Attachment Updated.' : 'Attachment Created');
                $this->resetField();
                $this->dispatch('closeModal'); // Ensure you have the listeners set up for this event
            } else {
                throw new Exception("HTTP Error: " . $response->body());
                logger()->error("Failed to update or create the Disaster education: {$response->body()}");
                $this->dispatch('swal:info', title: $this->disaster_attachment_id ? 'Error while updating Attachment education.' : 'Error while creating Attachment education');
            }
        } catch (Exception $e) {
            logger()->error("Failed to update or create the Attachment: " . $e->getMessage());
            session()->flash('error', 'Failed to create or update the Attachment on the external server.');
            $this->dispatch('swal:info', 'Error while creating or updating Attachment.');
        }
    }






    public function editEducationAttachment($disaster_attachment_id)
    {
        $this->resetErrorBag();
        $this->update = true;
        $this->disaster_attachment_id = $disaster_attachment_id;

        // Construct the URL for the API request
        $baseUrl = $this->getBaseUrl();
        $url = "{$baseUrl}/education-attachments/{$disaster_attachment_id}";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get($url);

        if ($response->successful()) {
            $responseBody = $response->json();
            logger()->info('Attachments Data:', $responseBody);

            if (!empty($responseBody['data']) && is_array($responseBody['data'])) {
                $educationAttachmentData = $responseBody['data']; // Assuming the first element is what you want
                $this->attachment_description = $educationAttachmentData['description'] ?? 'No description provided';
                $this->attachment_type = $educationAttachmentData['attachmentType'] ?? 'No attachmentType provided';
                $this->disaster_education = $educationAttachmentData['educationId'] ?? 'No audience  provided';
                $this->file = $educationAttachmentData['file'] ?? 'No file  provided';

                // logger()->info('ministry Data:', [
                //     'ministryName' => $this->name,
                //     'address' => $this->address,
                //     'voteNumber' => $this->vote_number,
                //     'status' => $this->status,
                // ]);
            } else {
                logger()->error("Failed to load load disaster education: {$response->body()}");
                session()->flash('error', 'No Disaster education data found or structure is incorrect.');
            }
        } else {
            logger()->error("Failed to load Disaster education: {$response->body()}");
            session()->flash('error', 'Failed to fetch Disaster education details. Error: ' . $response->body());
        }
    }



    public function destroyEducationAttachment()
    {
        if ($this->delete_confirm) {
            $baseUrl = $this->getBaseUrl();
            $url = "{$baseUrl}/education-attachments/{$this->delete_confirm}";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . session('token'),
                'Accept' => 'application/json'
            ])->delete($url);

            if ($response->successful()) {
                $this->dispatch('swal:info', title: 'Attachment Deleted');
                $this->reset('delete_confirm');
            } else {
                logger()->error("Failed to delete Attachment: " . $response->body());
                $this->dispatch('swal:info', title: 'Failed to delete the Attachment.');
            }
        }
        $this->dispatch('closeModal');
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
            return view('livewire.education-component', ['disasterEducations' => collect([])])->layout('layouts.app');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/disaster-education", $query);

        $disasterEducations = collect([]);

        if ($response->successful()) {
            $disasterEducationsData = $response->json()['data'];
            // logger()->info('Fetched Disaster education:', $disasterEducationsData);
            $disasterEducations = collect($disasterEducationsData)->map(function ($disaster) {
                return (object) [
                    'id' => $disaster['id'],
                    'disasterType' => $disaster['disasterType'],
                    'title' => $disaster['title'],
                    'audience' => $disaster['audience'],
                    'contentUrl' => $disaster['contentUrl'],
                    'description' => $disaster['description'],
                ];
            });

            // Apply pagination
            $disasterEducations = $this->paginateCollection($disasterEducations, 10);
        } else {
            session()->flash('error', 'Failed to fetch disaster Educations from the server.');
            // logger()->error('Error Fetching disaster Educations:', ['response' => $response->body()]);
        }


        $queryAttachment = [];
        if ($this->search_keyword) {
            $queryAttachment['search'] = $this->search_keyword;
        }

        if (!$token) {
            session()->flash('error', 'No authentication token available. Please login again.');
            return view('livewire.education-component', ['attachments' => collect([])])->layout('layouts.app');
        }

        $attachmentResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/education-attachments", $query);

        $attachmentEducations = collect([]);

        if ($attachmentResponse->successful()) {
            $attachmentEducationsData = $attachmentResponse->json()['data'];
            // logger()->info('Fetched Disaster education:', $attachmentEducationsData);
            $attachmentEducations = collect($attachmentEducationsData)->map(function ($attachment) {
                return (object) [
                    'id' => $attachment['id'],
                    'attachmentType' => $attachment['attachmentType'],
                    'disasterEducation' => $attachment['disasterEducation']['disasterType'],
                    // 'description' => $attachment['description'],
                ];
            });

            // Apply pagination
            $attachmentEducations = $this->paginateCollection($attachmentEducations, 10);
        } else {
            session()->flash('error', 'Failed to fetch disaster Educations from the server.');
            // logger()->error('Error Fetching disaster Educations:', ['response' => $response->body()]);
        }


        $incidentTypesResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get("{$baseUrl}/incident-type");

        $incidentTypes = collect([]);
        if ($incidentTypesResponse->successful()) {
            $incidentTypeData = $incidentTypesResponse->json()['data'];
            $incidentTypes = collect($incidentTypeData)->map(function ($incidentType) {
                return (object) [
                    'id' => $incidentType['id'],
                    'title' => $incidentType['title'],
                ];
            });
        } else {
            logger()->error('Error Fetching incident Types Types:', ['response' => $incidentTypesResponse->body()]);
        }


        return view('livewire.education-component', [
            'disasters' => $disasterEducations,
            'attachments' => $attachmentEducations,
            'incidentTypes' => $incidentTypes
        ])->layout('layouts.app');
    }
}
