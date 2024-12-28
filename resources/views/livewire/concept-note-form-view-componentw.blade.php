<div>
    <div>
        <div class="page-title">
          <div class="row">
            <div class="col-sm-6 ps-0">
              <h3>Concept Note</h3>
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
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-view-concept-note-label">Concept Note Details</h5>
                    <div class="modal-footer">
                        @can('concept note print view')
                            <button wire:click="printReport" class="btn btn-secondary float-end">
                                <i class="fa fa-print"></i> Print
                            </button>
                            {{-- <button type="button" class="btn  btn-secondary" data-bs-dismiss="modal"><i class="fa fa-print"></i>Print</button> --}}
                        @endcan

                    </div>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body" style="padding-left:2%;">
                    <!-- Dynamic Concept Note Details -->
                    <h2>1. General Details</h2>
                    @if($conceptNote)
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Project Class</th>
                                    <td>{{ $conceptNote->class }}</td>
                                </tr>
                                <tr>
                                    <th>Project Name</th>
                                    <td>{{ $conceptNote->projectname }}</td>
                                </tr>
                                <tr>
                                    <th>Project Code</th>
                                    <td>{{ $conceptNote->project_code }}</td>
                                </tr>
                                <tr>
                                    <th>Total Cost (TZS)</th>
                                    <td>{{ number_format($total_project_cost, 2) }}/= TZS</td>
                                </tr>
                                <tr>
                                    <th>Time Frame</th>
                                    <td>
                                        {{ date('d-m-Y', strtotime($conceptNote->startdate)) }} - {{ date('d-m-Y', strtotime($conceptNote->enddate)) }}

                                    </td>
                                </tr>
                                <tr>
                                    <th>Region</th>
                                    <td>
                                        <ul>
                                            @foreach ($this->conceptNote->projectLocations as $location)
                                                <li>{{ $location->location_name }} - {{ $location->location_level }}</li> <!-- Adjust these fields based on your actual location attributes -->
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Main Sector</th>
                                    <td>{{ $sector_name }}</td>
                                </tr>
                                <tr>
                                    <th>Outcome</th>
                                    <td>{{ $outcome }}</td>
                                </tr>

                                <tr>
                                    <th>Sector Policy and Plan</th>
                                    <td>{{ $conceptNote->contribution_sector }}</td>
                                </tr>
                                <tr>
                                    <th>Responsible Officer</th>
                                    <td>{{ $responsible_officer }}</td>
                                </tr>
                                <tr>
                                    <th>Administrative Unit</th>
                                    <td>{{ $conceptNote->administrative_unit }}</td>
                                </tr>
                            </tbody>
                        </table>
                         <br />
                        <h2>Project Background</h2>
                        <p style="text-align:justify;">{{ $project_background }}</p>
                        <br />
                        <h2>Project Justification</h2>
                        <p style="text-align:justify;">{{ $project_justification }}</p>
                        <br />
                        <h2>Proposed Outcomes</h2>
                        <p style="text-align:justify;">{{ $proposed_outcomes }}</p>
                        <br />
                        <h2>Project Outline</h2>
                        <br />
                        <p style="text-align:justify;"><strong>Overall Approach:</strong> {{ $project_outline_approach }}</p>
                        <br />
                        <p style="text-align:justify;"><strong>Outputs:</strong> {{ $project_outline_outputs }}</p>
                        <br />
                        <p style="text-align:justify;"><strong>Inputs:</strong> {{ $project_outline_inputs }}</p>
                        <br />
                        <p style="text-align:justify;"><strong>Sustainability & Risks:</strong> {{ $project_outline_sustainabilityRisk }}</p>

                        <h2>Tentative Financing Arrangement</h2>
                        <p>Source of Fund(s): {{ $financing_modality  }}</p>
                        <p>{{ $tentative_financing_arrangement  }}</p>
                    @else
                        <p>Loading concept note details...</p>
                    @endif
                </div>

            </div>
        </div>
      </div> {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
</div>

<script>
    document.addEventListener('livewire:load', function () {
        window.livewire.on('printReport', function () {
            window.print();
        });
    });
</script>
