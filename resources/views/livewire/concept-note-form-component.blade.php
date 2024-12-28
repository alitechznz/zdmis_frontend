
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
                                    </div>
                                </div>
                                @livewire('proposal.general-detail-component', [$concept_note_id, "National Concept Note", $selected_class])
                            </div>
                            <div class="tab-pane fade {{ $active_tab == 'program_project' ? 'show active' : '' }}" id="wizard-project-program" role="tabpanel" aria-labelledby="wizard-cart-project-program">
                              @livewire('proposal.program-project-component', [$concept_note_id, "National Concept Note"])
                            </div>
                            <div class="tab-pane fade {{ $active_tab == 'project_locations' ? 'show active' : '' }}" id="wizard-cart1" role="tabpanel" aria-labelledby="wizard-cart-tab1">
                              @livewire('proposal.project-location-component', [$concept_note_id, "National Concept Note"])
                            </div>
                            <div class="tab-pane fade {{ $active_tab == 'project_details' ? 'show active' : '' }}" id="wizard-cart" role="tabpanel" aria-labelledby="wizard-cart-tab">
                              @livewire('proposal.project-detail-component', [$concept_note_id, "National Concept Note"])
                            </div>
                            <div class="tab-pane fade custom-input {{ $active_tab == 'project_outlines' ? 'show active' : '' }} " id="wizard-banking" role="tabpanel" aria-labelledby="wizard-banking-tab">
                              @livewire('proposal.project-outline-component', [$concept_note_id, "National Concept Note"])
                            </div>
                            <div class="tab-pane fade custom-input {{ $active_tab == 'financial_arrangements' ? 'show active' : '' }}" id="wizard-banking1" role="tabpanel" aria-labelledby="wizard-banking-tab1">
                              @livewire('proposal.financial-arrangement-component', [$concept_note_id, "National Concept Note"])
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
