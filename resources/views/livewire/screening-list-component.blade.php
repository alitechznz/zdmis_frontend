<div>
    <div>
        <!-- Page Sidebar Ends-->
        <div>
          <div>
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6 ps-0">
                  <h3>Concept Note Screening Report</h3>
                </div>
                <div class="col-sm-6 pe-0">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-xxl-3 col-xl-4 box-col-4e">
                <div class="md-sidebar"><a class="btn btn-primary email-aside-toggle md-sidebar-toggle">Project Info</a>
                  <div class="md-sidebar-aside job-sidebar">
                    <div class="default-according style-1 faq-accordion job-accordion" id="accordionoc">
                      <div class="row">
                        <div class="col-xl-12">
                          <div class="card">
                            <div class="card-header">
                              <h5 class="mb-0">
                                <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseicon" aria-expanded="true" aria-controls="collapseicon">Project Details</button>
                              </h5>
                            </div>
                            <div class="collapse show" id="collapseicon" aria-labelledby="collapseicon" data-bs-parent="#accordion">
                              <div class="card-body filter-cards-view animate-chk">
                                <div class="job-filter mb-2">
                                  <div class="faq-form">
                                    <input class="form-control" type="text" placeholder="Project Name" value="{{ $conceptNote->projectname }}" readonly>
                                  </div>
                                </div>
                                <div class="job-filter">
                                  <div class="faq-form">
                                    <input class="form-control" type="text" placeholder="Project Code" value="{{ $conceptNote->project_code}}" readonly>
                                  </div>
                                </div><br /><br />
                                <br /><br />
                                <!-- View Concept Button -->
                                {{-- <button class="btn btn-primary text-center" type="button" data-bs-toggle="modal" data-bs-target="#modal-view-concept-note"
                                    wire:click="loadConceptNote({{ $conceptNote->id }})">View Concept</button><br /> --}}
                                <button class="btn btn-warning text-center" type="button" data-bs-toggle="modal" data-bs-target="#modal-view-concept-note"
                                    wire:click="loadConceptNote({{ $conceptNote->id }})" style="margin-top:2%;">Print Screening Report</button>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-9 col-xl-8 box-col-8">
                <div class="card">
                  <div class="job-search">
                    <div class="card-body">
                      <div class="d-flex"><img class="img-40 img-fluid m-r-20" src="../assets/images/job-search/1.jpg" alt="">
                        <div class="flex-grow-1">
                          <h1 class="f-w-600"><a href="#">Screening Section</a><span class="badge badge-primary pull-right"><span wire:loading wire:target="saveProjectDetails">Saving...</span></span></h1>

                        </div>
                      </div>
                        <form style="margin-top: 40px;" wire:submit.prevent="saveProjectDetails" method="post">
                            @csrf
                            @php $currentSection = null; @endphp

                                @foreach ($questions as $question)
                                    @if ($question->section != $currentSection)
                                        <h6 class="f-w-600">Section: {{ $question->section }}</h6>
                                        @php $currentSection = $question->section; @endphp
                                    @endif

                                    <div class="mb-3">
                                        <label class="form-label">{{ $question->title }}</label>
                                        <div>
                                            <input type="radio" wire:model="answers[{{ $question->id }}]" value="yes"  id="question{{ $question->id }}_yes" required>
                                            <label for="question{{ $question->id }}_yes">Yes</label>
                                            <input type="radio" wire:model="answers[{{ $question->id }}]" value="no" id="question{{ $question->id }}_no"  required>
                                            <label for="question{{ $question->id }}_no">No</label>
                                        </div>
                                        <textarea class="form-control" wire:model="comments[{{ $question->id }}]" id="comment{{ $question->id }}" placeholder="Enter comment" required></textarea>
                                            <!-- Input for score marks -->
                                        <!-- Input for score marks -->
                                        <div class="mt-2">
                                            <label class="form-label">Score (Maximum: {{ $question->score_weight }})</label>
                                            <input
                                                type="number"
                                                class="form-control @error('scores.' . $question->id) is-invalid @enderror"
                                                wire:model.defer="scores[{{ $question->id }}]"
                                                id="score{{ $question->id }}"
                                                placeholder="Enter score"
                                                min="0"
                                                max="{{ $question->score_weight }}"
                                                wire:model.defer="scores.{{ $question->id }}"
                                            >
                                            @error('scores.' . $question->id)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach

                            {{-- <button type="submit" class="btn btn-success">Submit Screening</button> --}}
                        </form>
                    </div>
                  </div>
                </div>


              </div>
            </div>

            <div wire:ignore.self class="modal fade" id="modal-view-concept-note" tabindex="-1" role="dialog" aria-labelledby="modal-view-concept-note-label" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-view-concept-note-label">Concept Note Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="padding-left:2%;">
                            <!-- Dynamic Concept Note Details -->
                            <h2>General Details</h2>
                            @if($selectedConceptNote)
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Project Class</th>
                                            <td>{{ $selectedConceptNote->class }}</td>
                                        </tr>
                                        <tr>
                                            <th>Project Name</th>
                                            <td>{{ $selectedConceptNote->projectname }}</td>
                                        </tr>
                                        <tr>
                                            <th>Project Code</th>
                                            <td>{{ $selectedConceptNote->project_code }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Cost</th>
                                            <td>{{ $total_project_cost }}</td>
                                        </tr>
                                        <tr>
                                            <th>Time Frame</th>
                                            <td>{{ $selectedConceptNote->startdate }} - {{ $selectedConceptNote->enddate }}</td>
                                        </tr>
                                        <tr>
                                            <th>Region</th>
                                            <td>{{ $selectedConceptNote->region }}</td>
                                        </tr>
                                        <tr>
                                            <th>Main Sector</th>
                                            <td>{{ $selectedConceptNote->main_sector }}</td>
                                        </tr>
                                        <tr>
                                            <th>Outcome</th>
                                            <td>{{ $selectedConceptNote->outcome }}</td>
                                        </tr>

                                        <tr>
                                            <th>Sector Policy and Plan</th>
                                            <td>{{ $selectedConceptNote->contribution_sector }}</td>
                                        </tr>
                                        <tr>
                                            <th>Responsible Officer</th>
                                            <td>{{ $selectedConceptNote->responsible_officer }}</td>
                                        </tr>
                                        <tr>
                                            <th>Administrative Unit</th>
                                            <td>{{ $selectedConceptNote->administrative_unit }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h2>Project Background</h2>
                                <p>{{ $project_background }}</p>

                                <h2>Project Justification</h2>
                                <p>{{ $project_justification }}</p>

                                <h2>Proposed Outcomes</h2>
                                <p>{{ $proposed_outcomes }}</p>

                                <h2>Project Outline</h2>
                                <p><strong>Overall Approach:</strong> {{ $project_outline_approach }}</p>
                                <p><strong>Outputs:</strong> {{ $project_outline_outputs }}</p>
                                <p><strong>Inputs:</strong> {{ $project_outline_inputs }}</p>
                                <p><strong>Sustainability & Risks:</strong> {{ $project_outline_sustainabilityRisk }}</p>

                                <h2>Tentative Financing Arrangement</h2>
                                <p>{{ $selectedConceptNote->financing_arrangement }}</p>
                            @else
                                <p>Loading concept note details...</p>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


          </div>
          <!-- Container-fluid Ends-->
        </div>
  </div>

</div>
