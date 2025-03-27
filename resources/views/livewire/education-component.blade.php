<div x-data="data()" class="m-2">
    <style>
        .compact .btn {
            padding-bottom: 1.3pt;
            padding-top: 1.3pt;
        }

        .compact td {
            padding-bottom: 1.3pt;
            padding-top: 1.3pt;
        }
    </style>
      <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 p-0">
                    <h3>Education & Training </h3>
                </div>
                {{-- <div class="col-sm-6 p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg>
                            </a></li>
                        <li class="breadcrumb-item">Ministries</li>
                    </ol>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header pb-0">
          {{-- <h4>Vertical validation wizard </h4> --}}
          <p class="f-m-light mt-1">
             Fill up your details and next proceed.</p>
        </div>
        <div class="card-body">
          <div class="vertical-main-wizard">
            <div class="row g-3">    
              <div class="col-xxl-3 col-xl-4 col-12">
                <div class="nav flex-column header-vertical-wizard" id="wizard-tab" role="tablist" aria-orientation="vertical"><a class="nav-link {{ $activeTab == 'wizard-contact' ? 'active' : '' }}" id="wizard-contact-tab" data-bs-toggle="pill" href="#wizard-contact" role="tab" aria-controls="wizard-contact" aria-selected="true"> 
                    <div class="vertical-wizard">
                      <div class="stroke-icon-wizard"><i class="fa fa-book"></i></div>
                      <div class="vertical-wizard-content"> 
                        <h3> Disaster Education</h3>
                        {{-- <p>Add your details </p> --}}
                      </div>
                    </div></a><a class="nav-link {{ $activeTab == 'wizard-cart' ? 'active' : '' }}" id="wizard-cart-tab" data-bs-toggle="pill" href="#wizard-cart" role="tab" aria-controls="wizard-cart" aria-selected="false"> 
                    <div class="vertical-wizard">
                      <div class="stroke-icon-wizard"><i class="fa fa-paperclip"></i></div>
                      <div class="vertical-wizard-content"> 
                        <h3>Education Attachments</h3>
                        {{-- <p>Add your a/c details</p> --}}
                      </div>
                    </div></a><a class="nav-link" id="wizard-banking-tab" data-bs-toggle="pill" href="#wizard-banking" role="tab" aria-controls="wizard-banking" aria-selected="false"> 
                  </a></div>
              </div>
              <div class="col-xxl-9 col-xl-8 col-12">
                <div class="tab-content" id="wizard-tabContent">
                  <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab" wire:ignore.self>
                    <form class="row g-3 needs-validation custom-input" novalidate="">


                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="disaster">Disaster Type <span class="text-danger">*</span></label>
                            <select wire:model="disaster" class="form-control @error('disaster') is-invalid @enderror"
                                id="disaster">
                                <option value="">--Choose--</option>
                                @foreach ($incidentTypes as $incident)
                                    <option value="{{ $incident->id }}">{{ $incident->title }}</option>
                                @endforeach
                            </select>
                            @error('disaster')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" wire:model="title"
                            class="form-control @error('title') is-invalid @enderror" id="title"
                            placeholder="Enter title">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                        <label for="audience">Audience Type <span class="text-danger">*</span></label>
                        <select wire:model="audience" class="form-control @error('audience') is-invalid @enderror"
                            id="audience">
                            <option value="">--Choose--</option>
                            <option value="public">Public</option>
                            <option value="private">Private</option>
                        </select>
                        @error('audience')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                        <label for="contentUrl">content url <span class="text-danger">*</span></label>
                        <input type="text" wire:model="contentUrl"
                            class="form-control @error('contentUrl') is-invalid @enderror" id="contentUrl"
                            placeholder="Enter conten url">
                        @error('contentUrl')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                        <label for="description">Description  <span class="text-danger">*</span></label>
                        <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" id="description"
                            placeholder="Enter description" rows="4">{{ old('description') }}
                        </textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> --}}

                    <div class="mb-3 col-md-12 col-sm-12 col-lg-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="disasterEdu" required>{{ old('description') }}</textarea>
                        @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                      <div class="col-12 text-end">
                        <button type="button" wire:click.prevent="store"
                        class="{{ $update ? 'btn btn-success' : 'btn btn-primary' }}">
                        {{ $update ? 'Update' : 'Add' }}</button>

                        <button class="btn btn-primary">Next</button>
                      </div>

                    </form>


                    <div class="row my-3">
                        <div class="col-6">
                            <div class="input-group">
                                <input type="search" wire:model.live="search_keyword"
                                    class="form-control form-control-sm w-auto" placeholder="Search disaster education...">
                            </div>
                        </div>
                        <div class="col-6">
                            {{-- <div class="float-end">
        
                                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modal-ministry" wire:click='create'><i class="fa fa-plus"></i> Add New </a>
                            </div> --}}
        
                        </div>
                    </div>
                    <div class="table-responsive custom-scrollbar">
                        <table
                            class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                            <thead class="table-light">
                                <tr class="text-capitalize">
                                    <th scope="col">SN
                                    <th scope="col">Disaster_Type
                                    <th scope="col">Title
                                    <th scope="col">Audience
                                    <th scope="col">Description
                                    <th scope="col">Url
                                    <th scope="col" width="220">Actions</th>
                                </tr>
                            </thead>
                            <tbody x-ref="tbody">
                                @forelse ($disasters as $disaster)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $disaster->disasterType }}</td>
                                        <td title="{{ $disaster->description }}">{{ $disaster->title }}</td>
                                        <td>{{ $disaster->audience }}</td>
                                        <td title="{{ $disaster->description }}">{{ Str::limit($disaster->description, 20, '...') }}</td>
                                        <td>
                                            <a href="{{ $disaster->contentUrl }}" target="_blank">{{ $disaster->contentUrl }}</a>
                                        </td>                                        
                                        <td style="display: flex; gap: 5px;">
                                                <a href="#" wire:click="edit({{ $disaster->id }})"
                                                    class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                    data-bs-target="">
                                                    Edit</a>
                                                <a href="#" class="btn btn-sm btn-danger"
                                                    wire:click="deleteConfirm({{ $disaster->id }})" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModalDisasterEducation">
                                                    Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-danger text-center"> No disaster education Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if($disasters->count())
                            {{ $disasters->links() }}
                        @else
                            {{-- <tr>
                                <td colspan="6" class="text-center">No institutions found.</td>
                            </tr> --}}
                        @endif
                    </div>


                  </div>
                  <div class="tab-pane fade" id="wizard-cart" role="tabpanel" aria-labelledby="wizard-cart-tab" wire:ignore.self>
                    <form class="row g-3 needs-validation custom-input" novalidate="">
                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="attachment_type">Attachment Type <span class="text-danger">*</span></label>
                            <select wire:model="attachment_type" class="form-control @error('attachment_type') is-invalid @enderror"
                                id="attachment_type">
                                <option value="">--Choose--</option>
                                <option value="file">File</option>
                                <option value="video">Video</option>
                                <option value="audio">Audio</option>
                                <option value="document">Document</option>
                            </select>
                            @error('attachment_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="disaster_education">Disaster Education <span class="text-danger">*</span></label>
                            <select wire:model="disaster_education" class="form-control @error('disaster_education') is-invalid @enderror"
                                id="disaster_education">
                                <option value="">--Choose--</option>
                                @foreach ($disasters as $disaster)
                                    <option value="{{ $disaster->id }}">{{ $disaster->disasterType }}</option>
                                @endforeach
                            </select>
                            @error('disaster_education')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                            <label for="file">Attachment <span class="text-danger">*</span></label>
                            <input type="file" wire:model="file"
                                class="form-control @error('file') is-invalid @enderror" id="file">
                            @error('file')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>



                    <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                        <label for="attachment_description">Description  <span class="text-danger">*</span></label>
                        <textarea wire:model="attachment_description" class="form-control @error('attachment_description') is-invalid @enderror" id="eduAttachment"
                            placeholder="Enter description" rows="4">
                        </textarea>
                        @error('attachment_description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                      
                      <div class="col-12 text-end">
                        <button type="button" wire:click.prevent="storeEducationAttachment"
                        class="{{ $update ? 'btn btn-success' : 'btn btn-primary' }}">
                        {{ $update ? 'Update' : 'Add' }}</button>

                        <button class="btn btn-primary">Previous</button>
                        <button class="btn btn-primary">Next</button>
                      </div>
                    </form>


                    <div class="row my-3">
                        <div class="col-6">
                            <div class="input-group">
                                <input type="search" wire:model.live="search_keyword"
                                    class="form-control form-control-sm w-auto" placeholder="Search disaster education...">
                            </div>
                        </div>
                        <div class="col-6">
                            {{-- <div class="float-end">
        
                                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modal-ministry" wire:click='create'><i class="fa fa-plus"></i> Add New </a>
                            </div> --}}
        
                        </div>
                    </div>
                    <div class="table-responsive custom-scrollbar">
                        <table
                            class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                            <thead class="table-light">
                                <tr class="text-capitalize">
                                    <th scope="col">SN
                                    <th scope="col">Attachment_Type
                                    <th scope="col">Disaster_Type
                                    {{-- <th scope="col">Description --}}
                                    <th scope="col" width="220">Actions</th>
                                </tr>
                            </thead>
                            <tbody x-ref="tbody">
                                @forelse ($attachments as $attachment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $attachment->attachmentType }}</td>
                                        <td>{{ $attachment->disasterEducation }}</td>
                                        {{-- <td title="{{ $attachment->description }}">{{ Str::limit($attachment->description, 20, '...') }}</td> --}}
                                        <td style="display: flex; gap: 5px;">
                                                <a href="#" wire:click="editEducationAttachment({{ $attachment->id }})"
                                                    class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                    data-bs-target="">
                                                    Edit</a>
                                                <a href="#" class="btn btn-sm btn-danger"
                                                    wire:click="deleteConfirm({{ $attachment->id }})" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModalAttachment">
                                                    Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-danger text-center"> No attachment education Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if($attachments->count())
                            {{ $attachments->links() }}
                        @else
                            {{-- <tr>
                                <td colspan="6" class="text-center">No institutions found.</td>
                            </tr> --}}
                        @endif
                    </div>

                  </div>

                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


          <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModalDisasterEducation" data-backdrop="false" tabindex="-1"
    role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="button" wire:click.prevent="destroy()" class="btn btn-danger close-modal"
                    data-bs-dismiss="modal">Yes, Delete
                </button>
            </div>
        </div>
    </div>
</div>



          <!-- Delete Modal -->
          <div wire:ignore.self class="modal fade" id="deleteModalAttachment" data-backdrop="false" tabindex="-1"
          role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
                  </div>
                  <div class="modal-body">
                      <p>Are you sure want to delete ?</p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary close-btn"
                          data-bs-dismiss="modal">Cancel</button>
                      <button type="button" wire:click.prevent="destroyEducationAttachment()" class="btn btn-danger close-modal"
                          data-bs-dismiss="modal">Yes, Delete
                      </button>
                  </div>
              </div>
          </div>
      </div>

</div>


<script>
document.addEventListener('livewire:load', function () {
    // Attach event listener to file input
    const fileInput = document.getElementById('file');
    fileInput.addEventListener('change', function (event) {
        event.preventDefault(); // Prevent form submission on file select
    });
});
</script>
