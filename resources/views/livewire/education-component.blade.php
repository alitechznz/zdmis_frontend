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
                <div class="nav flex-column header-vertical-wizard" id="wizard-tab" role="tablist" aria-orientation="vertical"><a class="nav-link active" id="wizard-contact-tab" data-bs-toggle="pill" href="#wizard-contact" role="tab" aria-controls="wizard-contact" aria-selected="true"> 
                    <div class="vertical-wizard">
                      <div class="stroke-icon-wizard"><i class="fa fa-bolt"></i></div>
                      <div class="vertical-wizard-content"> 
                        <h3> Disaster Education</h3>
                        {{-- <p>Add your details </p> --}}
                      </div>
                    </div></a><a class="nav-link" id="wizard-cart-tab" data-bs-toggle="pill" href="#wizard-cart" role="tab" aria-controls="wizard-cart" aria-selected="false"> 
                    <div class="vertical-wizard">
                      <div class="stroke-icon-wizard"><i class="fa fa-paperclip"></i></div>
                      <div class="vertical-wizard-content"> 
                        <h3>Disaster Attachments</h3>
                        {{-- <p>Add your a/c details</p> --}}
                      </div>
                    </div></a><a class="nav-link" id="wizard-banking-tab" data-bs-toggle="pill" href="#wizard-banking" role="tab" aria-controls="wizard-banking" aria-selected="false"> 
                  </a></div>
              </div>
              <div class="col-xxl-9 col-xl-8 col-12">
                <div class="tab-content" id="wizard-tabContent">
                  <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                    <form class="row g-3 needs-validation custom-input" novalidate="">


                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="disaster_type">Disaster Type <span class="text-danger">*</span></label>
                            <select wire:model="disaster_type" class="form-control @error('disaster_type') is-invalid @enderror"
                                id="disaster_type">
                                <option value="">--Choose--</option>
                                <option value="earthquake">Earthquake</option>
                                <option value="flood">Flood</option>
                            </select>
                            @error('disaster_type')
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
                        <label for="content_url">content url <span class="text-danger">*</span></label>
                        <input type="text" wire:model="content_url"
                            class="form-control @error('content_url') is-invalid @enderror" id="content_url"
                            placeholder="Enter conten url">
                        @error('content_url')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                        <label for="description">Description  <span class="text-danger">*</span></label>
                        <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" id="description"
                            placeholder="Enter description">
                        </textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                      <div class="col-12 text-end"> 
                        <button class="btn btn-primary">Next</button>
                      </div>

                    </form>
                  </div>
                  <div class="tab-pane fade" id="wizard-cart" role="tabpanel" aria-labelledby="wizard-cart-tab">
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
                            <label for="attachment">Attachment <span class="text-danger">*</span></label>
                            <input type="file" wire:model="attachment"
                                class="form-control @error('attachment') is-invalid @enderror" id="attachment">
                            @error('attachment')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                      
                      <div class="col-12 text-end"> 
                        <button class="btn btn-primary">Previous</button>
                        <button class="btn btn-primary">Next</button>
                      </div>
                    </form>
                  </div>

                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
