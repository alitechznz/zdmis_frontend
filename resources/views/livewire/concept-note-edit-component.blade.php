
<div>
    <style type="text/css">
      textarea::placeholder {
            color: #666; /* Ensure there is enough contrast */
            opacity: 1; /* Ensures that the placeholder is fully visible */
        }
    </style>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div >
            <div class="row">
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header pb-0">
                    <h4>Concept Note Form </h4>
                    <p class="f-m-light mt-1">
                       Fill up your true details and next proceed.</p>
                  </div>
                  <div class="card-body">
                    <div class="vertical-main-wizard">
                      <div class="row g-3">
                        <div class="col-xxl-3 col-xl-4 col-12">
                          <div class="nav flex-column header-vertical-wizard" id="wizard-tab" role="tablist" aria-orientation="vertical">
                              <a wire:click.prevent="switchTab('general_details')" class="nav-link {{ $active_tab == 'general_details' ? 'active' : '' }}" id="wizard-contact-tab" data-bs-toggle="pill" href="#wizard-contact" role="tab" aria-controls="wizard-contact" aria-selected="true">
                                <div class="vertical-wizard">
                                @if($is_step1)
                                    <div class="stroke-icon-wizard" style="background-color:cadetblue;">
                                        <i class="fa fa-check"></i>
                                    </div>
                                @else
                                    <div class="stroke-icon-wizard">
                                        <i class="fa fa-times"></i>
                                    </div>
                                @endif

                                <div class="vertical-wizard-content">
                                  <h3>General Details</h3>
                                  {{-- <p>Add your details </p> --}}
                                </div>
                              </div>
                              </a>
                              @if($selected_class === 'Program')
                              <a wire:click.prevent="switchTab('program_project')" class="nav-link {{ $active_tab == 'program_project' ? 'active' : '' }} @if($concept_note_id == null) disabled @endif" id="wizard-cart-project-program" data-bs-toggle="pill" href="#wizard-project-program" role="tab" aria-controls="wizard-project-program" aria-selected="false">
                                <div class="vertical-wizard">
                                @if($is_step21)
                                    <div class="stroke-icon-wizard" style="background-color:cadetblue;">
                                        <i class="fa fa-check"></i>
                                    </div>
                                @else
                                    <div class="stroke-icon-wizard">
                                        <i class="fa fa-times"></i>
                                    </div>
                                @endif
                                <div class="vertical-wizard-content">
                                  <h3>Program Project</h3>
                                  {{-- <p>Add your details</p> --}}
                                </div>
                              </div>
                              </a>
                              @endif
                              <a wire:click.prevent="switchTab('project_locations')" class="nav-link {{ $active_tab == 'project_locations' ? 'active' : '' }} @if($concept_note_id == null) disabled @endif" id="wizard-cart-tab1" data-bs-toggle="pill" href="#wizard-cart1" role="tab" aria-controls="wizard-car1" aria-selected="false">
                                <div class="vertical-wizard">
                                @if($is_step2)
                                    <div class="stroke-icon-wizard" style="background-color:cadetblue;">
                                        <i class="fa fa-check"></i>
                                    </div>
                                @else
                                    <div class="stroke-icon-wizard">
                                        <i class="fa fa-times"></i>
                                    </div>
                                @endif
                                <div class="vertical-wizard-content">
                                  <h3>Project Location</h3>
                                  {{-- <p>Add your details</p> --}}
                                </div>
                              </div>
                              </a>
                              <a wire:click.prevent="switchTab('project_details')" class="nav-link {{ $active_tab == 'project_details' ? 'active' : '' }} @if($concept_note_id == null) disabled @endif" id="wizard-cart-tab" data-bs-toggle="pill" href="#wizard-cart" role="tab" aria-controls="wizard-cart" aria-selected="false">
                                <div class="vertical-wizard">
                                @if($is_step3)
                                    <div class="stroke-icon-wizard" style="background-color:cadetblue;">
                                        <i class="fa fa-check"></i>
                                    </div>
                                @else
                                    <div class="stroke-icon-wizard">
                                        <i class="fa fa-times"></i>
                                    </div>
                                @endif
                                <div class="vertical-wizard-content">
                                  <h3>Project Details</h3>
                                  {{-- <p>Add your details</p> --}}
                                </div>
                              </div>
                              </a>
                              <a wire:click.prevent="switchTab('project_outlines')" class="nav-link {{ $active_tab == 'project_outlines' ? 'active' : '' }} @if($concept_note_id == null) disabled @endif" id="wizard-banking-tab" data-bs-toggle="pill" href="#wizard-banking" role="tab" aria-controls="wizard-banking" aria-selected="false">
                                <div class="vertical-wizard">
                                @if($is_step4)
                                    <div class="stroke-icon-wizard" style="background-color:cadetblue;">
                                        <i class="fa fa-check"></i>
                                    </div>
                                @else
                                    <div class="stroke-icon-wizard">
                                        <i class="fa fa-times"></i>
                                    </div>
                                @endif
                                <div class="vertical-wizard-content">
                                  <h3>Project Outline</h3>
                                  {{-- <p>Choose your bank</p> --}}
                                </div>
                              </div>
                              </a>
                              <a wire:click.prevent="switchTab('financial_arrangements')" class="nav-link {{ $active_tab == 'financial_arrangements' ? 'active' : '' }} @if($concept_note_id == null) disabled @endif" id="wizard-banking-tab" data-bs-toggle="pill" href="#wizard-banking1" role="tab" aria-controls="wizard-banking1" aria-selected="false">
                                <div class="vertical-wizard">
                                @if($is_step5)
                                    <div class="stroke-icon-wizard" style="background-color:cadetblue;">
                                        <i class="fa fa-check"></i>
                                    </div>
                                @else
                                    <div class="stroke-icon-wizard">
                                        <i class="fa fa-times"></i>
                                    </div>
                                @endif
                                <div class="vertical-wizard-content">
                                  <h3>Financing Arrangement</h3>
                                  {{-- <p>Choose your bank</p> --}}
                                </div>
                              </div>
                              </a>
                          </div>
                        </div>
                        <div class="col-xxl-9 col-xl-8 col-12">
                          <div class="tab-content" id="wizard-tabContent">
                            <div class="tab-pane fade {{ $active_tab == 'general_details' ? 'show active' : '' }}" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                              <form wire:submit.prevent="SaveGeneralDetail" class="row g-3 needs-validation custom-input" novalidate="">
                                <div class="col-xxl-12">
                                    <div class="card-wrapper border rounded-3 checkbox-checked">
                                      <h3 class="sub-title">Class</h3>
                                      <div class="radio-form">
                                        <div class="form-check">
                                          <input class="form-check-input" id="flexRadioDefault11" type="radio" name="flexRadioDefault-a" checked="" wire:model.live="selected_class" value="Project">
                                          <label class="form-check-label" for="flexRadioDefault11">Project</label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" id="flexRadioDefault21" type="radio" name="flexRadioDefault-a"  wire:model.live="selected_class" value="Program">
                                          <label class="form-check-label" for="flexRadioDefault21">Program</label>
                                        </div>

                                      </div>
                                        @error($selectedLocationLevel)
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xxl-12 col-sm-12">
                                  <label class="form-label" for="validationCustom0-a">Project Title<span class="txt-danger">*</span></label>
                                  <input class="form-control" id="validationCustom0-a" wire:model="project_title" type="text" placeholder="Enter Project Title" required="">
                                  <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="col-xxl-4 col-sm-6">
                                  <label class="form-label" for="validationemail-b">Project Start date<span class="txt-danger">*</span></label>
                                  <input class="form-control" id="validationemail-b" type="date" wire:model="start_date" required="" placeholder="Project Start date">
                                  <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-xxl-4 col-sm-6">
                                    <label class="form-label" for="validationemail-b1">Project end date<span class="txt-danger">*</span></label>
                                    <input class="form-control" id="validationemail-b1" type="date" required="" wire:model="end_date" placeholder="Project end date">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-xxl-12 col-sm-12">
                                    <label class="form-label" for="validationCustom04"> Project Category </label>
                                    <select class="form-select" id="validationCustom04" required="" wire:model="project_category">
                                      <option selected="" disabled="" value="">Choose...</option>
                                      <option value="A:Strategic">Strategic</option>
                                      <option value="B:Others">Others</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a project category.</div>
                                </div>

                                <div class="col-xxl-12 col-sm-12">
                                    <label class="form-label" for="validationCustom04">Main Sector</label>
                                    <select class="form-select select2" id="validationCustom04" required="" wire:model="main_sector">
                                        <option selected="" disabled="" value="">Choose...</option>
                                        @forelse ($sectors as $sectors_item)
                                            <option value="{{$sectors_item->id }}">{{$sectors_item->name }}</option>
                                        @empty
                                                <option value="">Select...</option>
                                        @endforelse
                                    </select>
                                    <div class="invalid-feedback">Please select a valid Main Sector.</div>
                                </div>
                                <div class="col-xxl-12 col-sm-12">
                                  <label class="form-label" for="validationCustom05">Project Outcome</label>
                                  <input class="form-control" id="validationCustom05" type="text" required="" wire:model="project_outcome">
                                  <div class="invalid-feedback">Please provide a valid Project Outcome.</div>
                                </div>
                                @if($selected_class === 'Project')
                                    <div class="col-xxl-12 col-sm-12">
                                        <label class="form-label" for="validationCustom04">Medium-Term Development plan </label>
                                        <select class="form-select" id="validationCustom04" required="" wire:model="plan_id">
                                        <option value="">--- Choose ---</option>
                                            @foreach ($middle_term_plans as $middle_term_plan)
                                                <option value="{{$middle_term_plan->id }}">{{$middle_term_plan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xxl-12 col-sm-12">
                                        <label class="form-label" for="validationCustom041">Strategic Area </label>
                                        <select class="form-select" id="validationCustom041" required="" wire:model="strategic_area">
                                        <option value="">--- Choose ---</option>
                                            @foreach ($middle_term_strategic_area as $mt_strategic_area)
                                                <option value="{{$mt_strategic_area->id }}">{{$mt_strategic_area->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xxl-12 col-sm-12">
                                        <label class="form-label" for="validationCustom043">Priority Area </label>
                                        <select class="form-select" id="validationCustom043" required="" wire:model="priority_area">
                                        <option value="">--- Choose ---</option>
                                            @foreach ($middle_term_priority_area as $mt_term_priority_area)
                                                <option value="{{$mt_term_priority_area->id }}">{{$mt_term_priority_area->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                <div class="col-xxl-12 col-sm-12">
                                    <label class="form-label" for="validationCustom04">Sector Policy and Plan</label>
                                    <input class="form-control" id="validationCustom05" type="text"  wire:model="contribution_sector">
                                    <div class="invalid-feedback">Please select a valid Sector Policy and Plan.</div>
                                </div>
                                <div class="col-xxl-12 col-sm-12">
                                    <label class="form-label" for="validationemail-b11">Administrative Unit</label>
                                    <input class="form-control" id="validationemail-b11" type="text" wire:model="organization_name" value="{{ $organization_name }}" readonly>
                                    <div class="invalid-feedback">Please select a valid Administrative Unit.</div>
                                </div>

                                <div class="col-xxl-12 col-sm-12">
                                    <label class="form-label" for="validationCustom04">Responsible Officer</label>
                                    <select class="form-select" id="validationCustom04" required="" wire:model="responsible_user">
                                      <option selected=""  value="">Choose...</option>
                                        @forelse ($selected_ministry_user as $user)
                                            <option value="{{$user->id }}">{{$user->full_name }}</option>
                                        @empty
                                                <option value="">Select...</option>
                                        @endforelse
                                    </select>
                                    <div class="invalid-feedback">Please select a valid Responsible Officer</div>
                                </div>
                                {{-- <form class="row g-3 mb-3 needs-validation" novalidate="">
                                    <div class="col-md-12">
                                      <div class="accordion dark-accordion" id="accordionExample-a">
                                        <div class="accordion-item">
                                          <h2 class="accordion-header" id="headingOne-a">
                                            <button class="accordion-button collapsed accordion-light-primary txt-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-a" aria-expanded="true" aria-controls="collapseOne-a">NET BANKING<i class="svg-color" data-feather="chevron-down"></i></button>
                                          </h2>
                                          <div class="accordion-collapse collapse" id="collapseOne-a" aria-labelledby="headingOne-a" data-bs-parent="#accordionExample-a">
                                            <div class="accordion-body weight-title card-wrapper">
                                              <h3 class="sub-title f-14">SELECT YOUR BANK</h3>
                                              <div class="row choose-bank">
                                                <div class="col-sm-6">
                                                  <div class="form-check radio radio-primary">
                                                    <input class="form-check-input" id="flexRadioDefault-z" type="radio" name="flexRadioDefault-v">
                                                    <label class="form-check-label" for="flexRadioDefault-z">Industrial & Commercial Bank</label>
                                                  </div>
                                                  <div class="form-check radio radio-primary">
                                                    <input class="form-check-input" id="flexRadioDefault-y" type="radio" name="flexRadioDefault-v">
                                                    <label class="form-check-label" for="flexRadioDefault-y">Agricultural Bank</label>
                                                  </div>
                                                  <div class="form-check radio radio-primary">
                                                    <input class="form-check-input" id="flexRadioDefault-x" type="radio" name="flexRadioDefault-v" checked="">
                                                    <label class="form-check-label" for="flexRadioDefault-x">JPMorgan Chase & Co.</label>
                                                  </div>
                                                </div>
                                                <div class="col-sm-6">
                                                  <div class="form-check radio radio-primary">
                                                    <input class="form-check-input" id="flexRadioDefault-w" type="radio" name="flexRadioDefault-v">
                                                    <label class="form-check-label" for="flexRadioDefault-w">Construction Bank Corp.</label>
                                                  </div>
                                                  <div class="form-check radio radio-primary">
                                                    <input class="form-check-input" id="flexRadioDefault-v" type="radio" name="flexRadioDefault-v">
                                                    <label class="form-check-label" for="flexRadioDefault-v">Bank of America</label>
                                                  </div>
                                                  <div class="form-check radio radio-primary">
                                                    <input class="form-check-input" id="flexRadioDefault-u" type="radio" name="flexRadioDefault-v">
                                                    <label class="form-check-label" for="flexRadioDefault-u">HDFC Bank</label>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </form> --}}

                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-success">Save</button>
                                  <button class="btn btn-primary">Next</button>
                                </div>
                              </form>
                            </div>
                            <div class="tab-pane fade {{ $active_tab == 'program_project' ? 'show active' : '' }}" id="wizard-project-program" role="tabpanel" aria-labelledby="wizard-cart-project-program">
                                <form class="row g-3 needs-validation custom-input" novalidate="">
                                    <div class="col-md-12">
                                        <label for="project_name">Project Name</label>
                                        <input wire:model="project_name" type="text" class="form-control @error('project_name') is-invalid @enderror" placeholder="Project name">
                                        @error($project_name)
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-xxl-12 col-sm-12">
                                        <label class="form-label" for="validationCustom04">Medium-Term Development plan </label>
                                        <select class="form-select @error('plan_id') is-invalid @enderror" id="validationCustom04" required="" wire:model="plan_id">
                                            <option value="">--- Choose ---</option>
                                            @foreach ($middle_term_plans as $middle_term_plan)
                                                <option value="{{$middle_term_plan->id }}">{{$middle_term_plan->name }}</option>
                                            @endforeach
                                        </select>
                                        @error($plan_id)
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-xxl-12 col-sm-12">
                                        <label class="form-label" for="validationCustom041">Strategic Area </label>
                                        <select class="form-select @error('strategic_area') is-invalid @enderror" id="validationCustom041" required="" wire:model="strategic_area">
                                            <option value="">--- Choose ---</option>
                                            @foreach ($middle_term_strategic_area as $mt_strategic_area)
                                                <option value="{{$mt_strategic_area->id }}">{{$mt_strategic_area->name }}</option>
                                            @endforeach
                                        </select>
                                        @error($strategic_area)
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-xxl-12 col-sm-12">
                                        <label class="form-label" for="validationCustom043">Priority Area </label>
                                        <select class="form-select @error('priority_area') is-invalid @enderror" id="validationCustom043" required="" wire:model="priority_area">
                                            <option value="">--- Choose ---</option>
                                            @foreach ($middle_term_priority_area as $mt_term_priority_area)
                                                <option value="{{$mt_term_priority_area->id }}">{{$mt_term_priority_area->name }}</option>
                                            @endforeach
                                        </select>
                                        @error($priority_area)
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                  <div class="col-12 text-end mb-3">
                                    <button type="submit" class="btn btn-success" wire:click.prevent="saveProgramProject">Save</button>
                                    {{-- <button class="btn btn-primary">Next</button> --}}
                                  </div>
                                </form>
                                <div class="card-block row">
                                  <div class="col-sm-12 col-lg-12 col-xl-12">
                                    <div class="table-responsive custom-scrollbar">
                                      <table class="table table-dashed">
                                        <thead>
                                          <tr>
                                            <th scope="col">Id </th>
                                            <th scope="col">Project_Name </th>
                                            <th scope="col">Plan</th>
                                            <th scope="col">Strategic_Area</th>
                                            <th scope="col">Priority_Area</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @forelse($program_projects as $program_project)
                                          <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td title="{{ $program_project->project_name }}">
                                                {{ Str::limit($program_project->project_name, 30, '...') }}
                                            </td>
                                            <td title ="{{ $program_project->plan->name }}">
                                                {{ Str::limit($program_project->plan->name, 30, '...') }}
                                            </td>
                                            <td title="{{ $program_project->strategicArea->name }}">
                                                {{ Str::limit($program_project->strategicArea->name, 30, '...') }}
                                            </td>
                                            <td title ="{{ $program_project->priorityArea->name }}">
                                                {{ Str::limit($program_project->priorityArea->name, 30, '...') }}
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger" wire:click.prevent="deleteProgramProject({{ $program_project->id }})" wire:confirm="Are you sure you want to delete this project?">Delete</button>
                                            </td>
                                          </tr>
                                          @empty
                                             <tr>
                                                 <td colspan="7" class="text-danger text-center">
                                                     No project found
                                                 </td>
                                             </tr>
                                          @endforelse

                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-12 text-end mt-3">
                                  <button class="btn btn-primary">Previous</button>
                                  <button class="btn btn-primary">Next</button>
                                </div>
                            </div>
                            {{-- location --}}
                            <div class="tab-pane fade {{ $active_tab == 'project_locations' ? 'show active' : '' }}" id="wizard-cart1" role="tabpanel" aria-labelledby="wizard-cart-tab1">
                              <form class="row g-3 needs-validation custom-input" novalidate="">
                                <div class="col-md-12">
                                  <div class="card-wrapper border rounded-3 checkbox-checked">
                                    <h3 class="sub-title">Select your location level</h3>
                                    <div class="radio-form">
                                      <div class="form-check">
                                        <input class="form-check-input" id="flexRadioDefault1" type="radio" name="flexRadioDefault-a" wire:model.live="selectedLocationLevel" value="Region">
                                        <label class="form-check-label" for="flexRadioDefault1">Region</label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" id="flexRadioDefault2" type="radio" name="flexRadioDefault-a" checked="" wire:model.live="selectedLocationLevel" value="District">
                                        <label class="form-check-label" for="flexRadioDefault2">District</label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" id="flexRadioDefault3" type="radio" name="flexRadioDefault-a" checked="" wire:model.live="selectedLocationLevel" value="Shehia">
                                        <label class="form-check-label" for="flexRadioDefault3">Shehia</label>
                                      </div>
                                    </div>
                                      @error($selectedLocationLevel)
                                      <div class="invalid-feedback">
                                          {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                </div>
                                <input class="form-control" type="hidden" wire:model="concept_note_id">
                                  @if($selectedLocationLevel == "Region")
                                      <div class="col-md-12 col-sm-12">
                                          <label class="form-label" for="validationCustom04">Region</label>
                                          <select class="form-select @error('selectedRegion') is-invalid @enderror" id="validationCustom04" required="" wire:model="selectedRegion">
                                              <option value="">--- Choose ---</option>

                                              @foreach ($regions as $reg)
                                                  <option value="{{$reg->id }}">{{$reg->name }}</option>
                                              @endforeach
                                          </select>
                                          @error($selectedRegion)
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                          @enderror
                                      </div>
                                  @elseif($selectedLocationLevel == "District")
                                      <div class="col-md-6 col-sm-12">
                                          <label class="form-label" for="validationCustom04">Region</label>
                                          <select class="form-select @error('selectedRegion') is-invalid @enderror" id="validationCustom04" required="" wire:model.live="selectedRegion">
                                              <option value="">--- Choose ---</option>

                                              @foreach ($regions as $reg)
                                                  <option value="{{$reg->id }}">{{$reg->name }}</option>
                                              @endforeach
                                          </select>
                                          @error($selectedRegion)
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                          @enderror
                                      </div>
                                      <div class="col-md-6 col-sm-12">
                                          <label class="form-label" for="validationCustom04">District</label>
                                          <select class="form-select @error('selectedDistrict') is-invalid @enderror" id="validationCustom04" required="" wire:model="selectedDistrict">
                                              <option value="">--- Choose ---</option>

                                              @foreach ($districts as $district)
                                                  <option value="{{$district->id }}">{{$district->name }}</option>
                                              @endforeach
                                          </select>
                                          @error($selectedDistrict)
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                          @enderror
                                      </div>
                                  @else
                                      <div class="col-md-4 col-sm-12">
                                          <label class="form-label" for="validationCustom04">Region</label>
                                          <select class="form-select @error('selectedRegion') is-invalid @enderror" id="validationCustom04" required="" wire:model.live="selectedRegion">
                                              <option value="">--- Choose ---</option>
                                              @foreach ($regions as $reg)
                                                  <option value="{{$reg->id }}">{{$reg->name }}</option>
                                              @endforeach
                                          </select>
                                          @error($selectedRegion)
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                          @enderror
                                      </div>
                                      <div class="col-md-4 col-sm-12">
                                          <label class="form-label" for="validationCustom04">District</label>
                                          <select class="form-select @error('selectedDistrict') is-invalid @enderror" id="validationCustom04" required="" wire:model.live="selectedDistrict">
                                              <option value="">--- Choose ---</option>
                                              @foreach ($districts as $dist)
                                                  <option value="{{$dist->id }}">{{$dist->name }}</option>
                                              @endforeach
                                          </select>
                                          @error($selectedDistrict)
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                          @enderror
                                      </div>
                                      <div class="col-md-4 col-sm-12">
                                          <label class="form-label" for="validationCustom04">Shehia</label>
                                          <select class="form-select @error('selectedShehia') is-invalid @enderror" id="validationCustom04" required="" wire:model="selectedShehia">
                                              <option value="">--- Choose ---</option>
                                              @foreach ($shehias as $shs)
                                                  <option value="{{$shs->id }}">{{$shs->name }}</option>
                                              @endforeach
                                          </select>
                                          @error($selectedShehia)
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                          @enderror
                                      </div>
                                  @endif

                                <div class="col-12 text-end mb-3">
                                  <button type="submit" class="btn btn-success" wire:click.prevent="saveProjectLocation">Save</button>

                                  {{-- <button class="btn btn-primary">Next</button> --}}
                                </div>
                              </form>
                              <div class="card-block row">
                                <div class="col-sm-12 col-lg-12 col-xl-12">
                                  <div class="table-responsive custom-scrollbar">
                                    <table class="table table-dashed">
                                      <thead>
                                        <tr>
                                          <th scope="col">Id </th>
                                          <th scope="col">location_Level</th>
                                          <th scope="col">Location</th>
                                          <th scope="col">Action</th>

                                        </tr>
                                      </thead>
                                      <tbody>
                                        @forelse($cn_project_location_list as $location)
                                        <tr>
                                          <th scope="row">{{ $loop->index + 1 }}</th>
                                          <td>{{ $location->location_level }}</td>
                                          <td>{{ $location->location_name }}</td>
                                          <td>
                                              <button type="button" class="btn btn-danger" wire:click.prevent="deleteProjectLocation({{ $location->id }})" wire:confirm="Are you sure you want to delete this location?">
                                                  Delete
                                              </button>
                                          </td>
                                        </tr>
                                        @empty
                                           <tr>
                                               <td colspan="7" class="text-danger text-center">
                                                   No location found
                                               </td>
                                           </tr>
                                        @endforelse

                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                              <div class="col-12 text-end mt-3">
                                <button class="btn btn-primary">Previous</button>
                                <button class="btn btn-primary">Next</button>
                              </div>
                            </div>
                            <div class="tab-pane fade {{ $active_tab == 'project_details' ? 'show active' : '' }}" id="wizard-cart" role="tabpanel" aria-labelledby="wizard-cart-tab">
                                <form wire:submit.prevent="SaveProjectDetails" class="row g-3 needs-validation custom-input" novalidate="">
                                  <div class="col-12">
                                    <label class="form-label" for="txtCardNumber1">Project background*</label>
                                    <textarea class="form-control" wire:model="background" id="validationTextarea24" placeholder="Give a short briefing on the project context A few paragraphs on Zanzibar as it relates to the project. Then move into more detail on the sector that the project is located in. Include information on previous or forthcoming initiatives in this sector or other initiatives relevant for the project. (350 words maximum)" required="" rows="8"></textarea>
                                    <div class="invalid-feedback">Please enter a message in the textarea.</div>
                                  </div>
                                  <div class="col-12">
                                    <label class="form-label" for="txtCardNumber1">Project justification*</label>
                                    <textarea class="form-control" wire:model="justification" id="validationTextarea24" placeholder="Give justifications for the project. A justification should present a problem, challenge, need or opportunity - i.e. why the project is needed. Justifications must relate to the national medium-term development plan (e.g. ZADEP), specific sector problems, sector or district plans or policies. Make sure to explain how the project fits with and contributes to these plans. It is an advantage if the suggested intervention is designed based on research and evidence
                                    (200 words maximum)" required="" rows="8"></textarea>
                                    <div class="invalid-feedback">Please enter a message in the textarea.</div>
                                  </div>
                                  <div class="col-12">
                                    <label class="form-label" for="txtCardNumber1">Proposed objective*</label>
                                    <textarea class="form-control" wire:model="objective" id="validationTextarea24" placeholder="Project objectives should describe what the project intends to achieve within the specified time frame. A good project objective should contribute toward the project target, outcome or impact-oriented and not output-oriented, and should be SMART.
                                        (200 words maximum)" required="" rows="8"></textarea>
                                    <div class="invalid-feedback">Please enter a message in the textarea.</div>
                                  </div>
                                  <div class="col-12">
                                    <label class="form-label" for="txtCardNumber1">Proposed outcomes*</label>
                                    <textarea class="form-control" wire:model="outcomes" id="validationTextarea24" placeholder="Describe the proposed outcomes of the project. Make sure to link the outcome of the project (what the project will deliver) with the justification. Also try to specify who the project will target as well as who and how many people will benefit from it. Try to make the outcomes as SMART (Specific, Measurable, Achievable, Relevant and Time-bound) as possible. They should be as clear and concrete as possible at this stage of project development.
                                        (200 words maximum)" required="" rows="8"></textarea>
                                    <div class="invalid-feedback">Please enter a message in the textarea.</div>
                                  </div>
                                  <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <button class="btn btn-primary">Previous</button>
                                    <button class="btn btn-primary">Next</button>
                                  </div>

                                </form>
                            </div>
                            <div class="tab-pane fade custom-input {{ $active_tab == 'project_outlines' ? 'show active' : '' }} " id="wizard-banking" role="tabpanel" aria-labelledby="wizard-banking-tab">
                              <form wire:submit.prevent="SaveProjectOutline" class="row g-3 needs-validation" novalidate="">
                                <div class="col-12">
                                    <label class="form-label" for="txtCardNumber1">Overall approach*</label>
                                    <textarea class="form-control" id="validationTextarea24" placeholder="Analyse the possible solutions/approaches that could be adopted to address the problem, need or opportunity outlined in the justification and give reasons for why the approach/methodology you have chosen is better than the others (for example through cost-benefit analysis). After this justification please describe the approach/methodology of the project in more detail. " required="" rows="8"></textarea>
                                    <div class="invalid-feedback">Please enter a message in the textarea.</div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="txtCardNumber1">Outputs*</label>
                                    <textarea class="form-control" wire:model="output" id="validationTextarea24" placeholder="A good idea is to break the desired outcome of the project down into outputs that the project will deliver. Make sure that the proposed outcome(s) and outputs are defined as clearly as possible. Outputs can be new policies, guidelines, capacities, products (e.g. buildings or systems) and services. For each of these outputs, list the main activities needed to produce them." required="" rows="8"></textarea>
                                    <div class="invalid-feedback">Please enter a message in the textarea.</div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="txtCardNumber1">Inputs *</label>
                                    <textarea class="form-control" wire:model="Inputs" id="validationTextarea24" placeholder="Discuss the required inputs (capacity, procurement, technical assistance, funds, materials, etc.) for the project. Try to make a clear link between inputs, activities, outputs and how these relate to the overall outcome." required="" rows="8"></textarea>
                                    <div class="invalid-feedback">Please enter a message in the textarea.</div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="txtCardNumber1">Timeframe & Responsibility *</label>
                                    <textarea class="form-control" wire:model="responsibility" id="validationTextarea24" placeholder="Put forward a proposed timeline and give a brief description of the roles and responsibilities in the project." required="" rows="8"></textarea>
                                    <div class="invalid-feedback">Please enter a message in the textarea.</div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="txtCardNumber1">Sustainability & Risk *</label>
                                    <textarea class="form-control" wire:model="risk" id="validationTextarea24" placeholder="Discuss how stakeholders and beneficiaries will be involved in the planning and implementation of the project. Discuss any other things that will help make the project sustainable.
                                    Identify the potential risks associated with the project and what can be done to manage these risks. To identify risks, think about what things that could potentially jeopardise or undermine the successful implementation of the project.  Different types of risk include:
                                    " required="" rows="8"></textarea>
                                    <div class="invalid-feedback">Please enter a message in the textarea.</div>
                                </div>

                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <button class="btn btn-primary">Previous</button>
                                    <button class="btn btn-primary">Next</button>

                                </div>
                              </form>
                            </div>
                            <div class="tab-pane fade custom-input {{ $active_tab == 'financial_arrangements' ? 'show active' : '' }}" id="wizard-banking1" role="tabpanel" aria-labelledby="wizard-banking-tab1">
                                <form wire:submit.prevent="SaveProjectFinance" class="row g-3 needs-validation" novalidate="">
                                    <div class="col-xxl-12">
                                        <div class="card-wrapper border rounded-3 checkbox-checked">
                                          <h3 class="sub-title">Select your Financing Modality</h3>
                                          <div class="radio-form">
                                            <div class="form-check">
                                              <input class="form-check-input" wire:model="financingModality" id="flexRadioDefault1" type="radio" value="SMZ Central" name="flexRadioDefault-a">
                                              <label class="form-check-label" for="flexRadioDefault1">Zanzibar Government (SMZ Central)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" wire:model="financingModality" id="flexRadioDefault1" type="radio" value="SMZ LGAs" name="flexRadioDefault-a">
                                                <label class="form-check-label" for="flexRadioDefault1">Zanzibar Government (SMZ LGAs)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" wire:model="financingModality" id="flexRadioDefault1" type="radio" value="SMZ & Donor" name="flexRadioDefault-a">
                                                <label class="form-check-label" for="flexRadioDefault1">Zanzibar Government & Donor (DP)</label>
                                            </div>
                                            <div class="form-check">
                                              <input class="form-check-input" wire:model="financingModality" id="flexRadioDefault2" type="radio" value="Donor Grant" name="flexRadioDefault-a" checked="">
                                              <label class="form-check-label" for="flexRadioDefault2">Donors’ Funds (Grant)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" wire:model="financingModality" id="flexRadioDefault2" type="radio" value="Donor Loan" name="flexRadioDefault-a" checked="">
                                                <label class="form-check-label" for="flexRadioDefault2">Donors’ Funds (Loan)</label>
                                            </div>
                                            <div class="form-check">
                                              <input class="form-check-input" wire:model="financingModality" id="flexRadioDefault3" type="radio" value="Investment" name="flexRadioDefault-a" checked="">
                                              <label class="form-check-label" for="flexRadioDefault3">Private Sector Investment</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" wire:model="financingModality" id="flexRadioDefault3" type="radio" value="PPP" name="flexRadioDefault-a" checked="">
                                                <label class="form-check-label" for="flexRadioDefault3">Public-Private Partnership (PPP)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" wire:model="financingModality" id="flexRadioDefault3" type="radio" value="NGO" name="flexRadioDefault-a" checked="">
                                                <label class="form-check-label" for="flexRadioDefault3">Private Foundations (NGO)</label>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-12 col-sm-12">
                                        <label class="form-label" for="validationCustom05">Project GFS Code</label>
                                        <input class="form-control" id="validationCustom05" type="text" wire:model="gfsCode" required="">
                                        <div class="invalid-feedback">Please provide a valid GFS Code.</div>
                                      </div>
                                    <div class="col-xxl-12 col-sm-12">
                                        <label class="form-label" for="validationCustom-b">Total Project Cost<span class="txt-danger">*</span></label>
                                        <input class="form-control" id="validationCustom-b" wire:model="totalProjectCost" type="text" placeholder="Enter Total Project Cost" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                  <div class="col-12">
                                      <label class="form-label" for="txtCardNumber1">Tentative Financing Arrangement</label>
                                      <textarea class="form-control" id="validationTextarea24" wire:model="tentativeFinancingArrangement" placeholder="State and justify the proposed budget. Try to give a summary breakdown of costs - e.g. training component, procurement component, construction component, etc. A full breakdown is not needed at this stage try to be as detailed as possible.
                                        Suggest how you expect the project to be financed:  Zanzibar Government funds, donors’ funds, private sector investment, public-private partnership, private foundations, etc.
                                        (350 words maximum)
                                        " required="" rows="8"></textarea>
                                        <div class="invalid-feedback">Please enter a message in the textarea.</div>
                                  </div>

                                  <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <button class="btn btn-success" wire:click="ConceptFinish">Finish</button>
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
        </div>
    </div>
</div>
