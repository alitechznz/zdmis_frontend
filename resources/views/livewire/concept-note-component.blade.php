<div x-data="data()" class="m-2">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 p-0">
                    <h3>Forecast Monitoring</h3>
                </div>
                <div class="col-sm-6 p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg>
                            </a></li>
                        <li class="breadcrumb-item">Forecast Monitoring</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid default-dashboard">
        <div class="card">
            <div class="card-body">

                <div class="table-responsive custom-scrollbar">
                    <div class="col-xl-12 col-md-12 box-col-70">
                        <div class="file-content">
                          <div class="card">
                            <div class="card-header">
                              <div class="d-md-flex d-sm-block">
                                <form class="form-inline" action="#" method="get">
                                  <div class="form-group d-flex align-items-center mb-0">                                      <i class="fa fa-search"></i>
                                    <input class="form-control-plaintext" type="text" placeholder="Search...">
                                  </div>
                                </form>
                                <div class="flex-grow-1 text-end">
                                  <form class="d-inline-flex" action="#" method="POST" enctype="multipart/form-data" name="myForm">
                                    <a class="btn btn-primary" href="{{ route('reporting-data')}}"> <i data-feather="plus-square"></i>Data Reporting</a>
                                    <a class="btn btn-warning" href="{{ route('reporting-alerts')}}"> <i data-feather="plus-square"></i>Generate Alert</a>
                                    <a class="btn btn-secondary" href="{{ route('import-tma-pdf')}}"> <i data-feather="plus-square"></i>Import TMA PDF</a>
                                    <div style="height: 0px;width: 0px; overflow:hidden;">
                                      <input id="upfile" type="file" onchange="sub(this)">
                                    </div>
                                  </form>
                                  <a class="btn btn-outline-primary ms-2" href="{{ route('tma-dashboard')}}"><i data-feather="upload">   </i>TMA Dashboard   </a>
                                </div>
                              </div>
                            </div>
                            <div class="card-body file-manager">
                              <h5 class="mb-2">Fire Alert Satellite Visualization</h5>
                              <ul class="quick-file d-flex flex-row">
                                <li>
                                    <a href="https://afis.co.za/" target="_blank">
                                        <div class="quick-box"><i class="fa fa-fire font-danger"></i></div>
                                        <h6>Advanced Fire Information System (AFISA)</h6>
                                    </a>

                                </li>
                                <li>
                                    <a href="https://firms.modaps.eosdis.nasa.gov/map/#d:24hrs;@39.43,-6.27,10.54z" target="_blank">
                                        <div class="quick-box"><i class="fa fa-fire font-danger"></i></div>
                                        <h6>FIRMS NASA (Fire Information Rapid Management System)</h6>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://gwis.jrc.ec.europa.eu/apps/gwis_current_situation/index.html" target="_blank">
                                        <div class="quick-box"><i class="fa fa-fire font-danger"></i></div>
                                        <h6>Global Wildfire Information System (GWIS)</h6>
                                    </a>
                                </li>

                              </ul><br /><br />
                              <h5 class="mb-2">Weather Satellite Visualization</h5>
                              <ul class="quick-file d-flex flex-row">
                                <li>
                                    <a href="https://zoom.earth/maps/pressure/#view=-6.2713,34.759,7z/model=icon" target="_blank">
                                        <div class="quick-box"><i class="fa fa-cloud font-warning"></i></div>
                                        <h6>ZOOM EARTH</h6>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://open-meteo.com/en/docs/air-quality-api#hourly=pm10,pm2_5,dust,uv_index" target="_blank">
                                        <div class="quick-box"><i class="fa fa-cloud font-warning"></i></div>
                                        <h6>Air Quality(Open Meteo)</h6>
                                    </a>

                                </li>
                                <li>
                                    <a href="https://open-meteo.com/en/docs/marine-weather-api" target="_blank">
                                        <div class="quick-box"><i class="fa fa-cloud font-warning"></i></div>
                                        <h6>Marine Weather(Open Meteo)</h6>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://open-meteo.com/en/docs#latitude=-6.1639&longitude=39.1979&current=temperature_2m&hourly=temperature_2m&daily=weather_code&timezone=auto&past_days=92" target="_blank">
                                        <div class="quick-box"><i class="fa fa-cloud font-warning"></i></div>
                                        <h6>Weather Forecast(Open Meteo)</h6>
                                    </a>
                                </li>

                                <li>
                                    <a href="https://dashboard.openweather.co.uk/dashboard" target="_blank">
                                        <div class="quick-box"><i class="fa fa-cloud font-warning"></i></div>
                                        <h6>Weather Forecast(Open Weather Map)</h6>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://satellites.pro/carte_de_la_Tanzanie#-5.777234,38.133545,8" target="_blank">
                                        <div class="quick-box"><i class="fa fa-cloud font-warning"></i></div>
                                        <h6>Early Warning System(DE-WETRA)</h6>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.mydewetra.world/" target="_blank">
                                        <div class="quick-box"><i class="fa fa-cloud font-warning"></i></div>
                                        <h6>Early Warning System(myDEWETRA)</h6>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://rsoe-edis.org/eventMap" target="_blank">
                                        <div class="quick-box"><i class="fa fa-cloud font-warning"></i></div>
                                        <h6> EDIS System</h6>
                                    </a>
                                </li>

                              </ul>
                              <br /><br />
                              <h5 class="mb-2">Ocean Satellite Visualization</h5>
                              <ul class="quick-file d-flex flex-row">
                                <li>
                                    <a href="https://open-meteo.com/en/docs/air-quality-api#hourly=pm10,pm2_5,dust,uv_index" target="_blank">
                                        <div class="quick-box"><i class="fa fa-anchor font-success"></i></div>
                                        <h6>IORIS Emergency reporting & Disaster Alert</h6>
                                    </a>

                                </li>

                                <li>
                                    <a href="https://seavision.volpe.dot.gov/auth/login" target="_blank">
                                        <div class="quick-box"><i class="fa fa-anchor font-success"></i></div>
                                        <h6>SEA VISION</h6>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.marinetraffic.com/en/ais/home/centerx:-12.0/centery:25.0/zoom:4#google_vignette" target="_blank">
                                        <div class="quick-box"><i class="fa fa-anchor font-success"></i></div>
                                        <h6>MARINE TRAFFIC</h6>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://open-meteo.com/en/docs#latitude=-6.1639&longitude=39.1979&current=temperature_2m&hourly=temperature_2m&daily=weather_code&timezone=auto&past_days=92" target="_blank">
                                        <div class="quick-box"><i class="fa fa-anchor font-success"></i></div>
                                        <h6>FULCRUM</h6>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.vesselfinder.com/vessels/details/9790971" target="_blank">
                                        <div class="quick-box"><i class="fa fa-anchor font-success"></i></div>
                                        <h6>VESSEL FINDER</h6>
                                    </a>
                                </li>
                              </ul>
                              <br /><br />
                              <h5 class="mb-2">Health Visualization</h5>
                              <ul class="quick-file d-flex flex-row">
                                <li>
                                    <a href="https://open-meteo.com/en/docs/air-quality-api#hourly=pm10,pm2_5,dust,uv_index" target="_blank">
                                        <div class="quick-box"><i class="fa fa-heartbeat font-primary"></i></div>
                                        <h6>SORMAS (Surveillance Outbreak Response Management and Analysis System)</h6>
                                    </a>

                                </li>
                                <li>
                                    <a href="https://open-meteo.com/en/docs/marine-weather-api" target="_blank">
                                        <div class="quick-box"><i class="fa fa-heartbeat font-primary"></i></div>
                                        <h6>DHIS2 (District Health Information Software 2)</h6>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://open-meteo.com/en/docs#latitude=-6.1639&longitude=39.1979&current=temperature_2m&hourly=temperature_2m&daily=weather_code&timezone=auto&past_days=92" target="_blank">
                                        <div class="quick-box"><i class="fa fa-heartbeat font-primary"></i></div>
                                        <h6>TerraMA² ( environmental and public health risks)</h6>
                                    </a>
                                </li>

                                <li>
                                    <a href="https://dashboard.openweather.co.uk/dashboard" target="_blank">
                                        <div class="quick-box"><i class="fa fa-heartbeat font-primary"></i></div>
                                        <h6>EIOS (Epidemic Intelligence from Open Sources)</h6>
                                    </a>
                                </li>


                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    {{-- {{ $appraisalquestions->links() }} --}}
                </div>
            </div>
        </div>

    </div>

    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-projectquestion" tabindex="-1" role="dialog"
         aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h2 class="h6 modal-title">@if($update) Update @else Add @endif Appraisal Question</h2> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="modal-footer">
                            {{-- <button type="button" wire:click.prevent="store" class="btn btn-secondary"> @if($update) Update @else Add @endif</button> --}}
                            <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteConceptNote" data-backdrop="false" tabindex="-1" role="dialog"
         aria-labelledby="deleteConceptNote" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete
                        <strong>{{ $delete_confirm? $delete_confirm->projectname: ''  }}</strong> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" wire:click.prevent="destroy()" class="btn btn-danger close-modal"
                            data-bs-dismiss="modal">Yes, Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Structure for Initiate -->
    <div wire:ignore.self class="modal fade" id="modal-initiateconcept" data-backdrop="false" tabindex="-1"
         role="dialog" aria-labelledby="modal-initiateconcept" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="initiateModalLabel"><b>Initiate Project:</b> {{ $concept_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for initiation with textarea for comments -->
                    <form wire:submit.prevent="initiateConcept">
                        <div class="mb-3">
                            <input type="hidden" class="form-control" wire:model="conceptID"/>
                            <label for="initiateComment" class="form-label">Comments</label>
                            <textarea class="form-control" id="initiateComment" wire:model.defer="initiateComment"
                                      rows="4"></textarea>
                        </div>
                        <p>Are you sure you want to initiate this project?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Initiate</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Structure for Verify -->
    <div wire:ignore.self class="modal fade" id="modal-verifyconcept" data-backdrop="false" tabindex="-1" role="dialog"
         aria-labelledby="modal-verifyconcept" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="initiateModalLabel"><b>Verify Project:</b> {{ $concept_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="verifyConcept">
                        <div class="mb-3">
                            <input type="hidden" class="form-control" wire:model="conceptID"/>
                            <label for="action" class="form-label">Action</label>
                            <select class="form-control" id="action" wire:model.defer="cn_action_v1">
                                <option value="" selected>Select Action</option>
                                <option value="accept">Accept</option>
                                <option value="reject">Reject</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="remark" class="form-label">Remark</label>
                            <textarea class="form-control" id="remark" wire:model.defer="cn_remark_v1" rows="4"
                                      placeholder="Add your remark"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Structure for Verify -->
    <div wire:ignore.self class="modal fade" id="modal-submitconcept" data-backdrop="false" tabindex="-1" role="dialog"
         aria-labelledby="modal-submitconcept" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="initiateModalLabel"><b>Submit Project:</b> {{ $concept_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="submitConcept">
                        <div class="mb-3">
                            <input type="hidden" class="form-control" wire:model="conceptID"/>
                            <label for="action" class="form-label">Action</label>
                            <select class="form-control" id="action" wire:model.defer="cn_action_v2">
                                <option value="" selected>Select Action</option>
                                <option value="accept">Accept</option>
                                <option value="reject">Reject</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="remark" class="form-label">Remark</label>
                            <textarea class="form-control" id="remark" wire:model.defer="cn_remark_v2" rows="4"
                                      placeholder="Add your remark"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Structure for Verify -->
    <div wire:ignore.self class="modal fade" id="modal-receiveconcept" data-backdrop="false" tabindex="-1" role="dialog"
         aria-labelledby="modal-receiveconcept" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="initiateModalLabel"><b>Receive Project:</b> {{ $concept_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="ReceiveConcept">
                        <div class="mb-3">
                            <input type="hidden" class="form-control" wire:model="conceptID"/>
                            <label for="action" class="form-label">Action</label>
                            <select class="form-control" id="action" wire:model.defer="cn_action_v3">
                                <option value="" selected>Select Action</option>
                                <option value="accept">Accept</option>
                                <option value="reject">Reject</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="remark" class="form-label">Remark</label>
                            <textarea class="form-control" id="remark" wire:model.defer="cn_remark_v3" rows="4"
                                      placeholder="Add your remark"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modal-approveconcept" data-backdrop="false" tabindex="-1" role="dialog"
         aria-labelledby="modal-approveconcept" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="initiateModalLabel"><b>Approve Project:</b> {{ $concept_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="ApproveConcept">
                        <div class="mb-3">
                            <input type="hidden" class="form-control" wire:model="conceptID"/>
                            <label for="action" class="form-label">Action</label>
                            <select class="form-control" id="action" wire:model.defer="cn_action_v5">
                                <option value="" selected>Select Action</option>
                                <option value="accept">Accept</option>
                                <option value="reject">Reject</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="remark" class="form-label">Remark</label>
                            <textarea class="form-control" id="remark" wire:model.defer="cn_remark_v5" rows="4"
                                      placeholder="Add your remark"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modal-open" data-backdrop="false" tabindex="-1" role="dialog"
         aria-labelledby="modal-open" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="initiateModalLabel"><b> Project:</b> {{ $concept_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="openConcept">
                        <div class="mb-3">
                            <input type="hidden" class="form-control" wire:model="conceptID"/>
                            <label for="action" class="form-label">Action</label>
                            <select class="form-control" id="action" wire:model.defer="cn_action_v4">
                                <option value="" selected>Select Action</option>
                                <option value="accept">Accept</option>
                                <option value="reject">Reject</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="remark" class="form-label">Remark</label>
                            <textarea class="form-control" id="remark" wire:model.defer="cn_remark_v4" rows="4"
                                      placeholder="Add your remark"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function data() {
            return {
                sortBy: "",
                sortAsc: false,
                sortByColumn($event) {
                    if (this.sortBy === $event.target.innerText) {
                        if (this.sortAsc) {
                            this.sortBy = "";
                            this.sortAsc = false;
                        } else {
                            this.sortAsc = !this.sortAsc;
                        }
                    } else {
                        this.sortBy = $event.target.innerText;
                    }

                    this.getTableRows()
                        .sort(
                            this.sortCallback(
                                Array.from($event.target.parentNode.children).indexOf(
                                    $event.target
                                )
                            )
                        )
                        .forEach((tr) => {
                            this.$refs.tbody.appendChild(tr);
                        });
                },
                getTableRows() {
                    return Array.from(this.$refs.tbody.querySelectorAll("tr"));
                },
                getCellValue(row, index) {
                    return row.children[index].innerText;
                },
                sortCallback(index) {
                    return (a, b) =>
                        ((row1, row2) => {
                            return row1 !== "" &&
                            row2 !== "" &&
                            !isNaN(row1) &&
                            !isNaN(row2)
                                ? row1 - row2
                                : row1.toString().localeCompare(row2);
                        })(
                            this.getCellValue(this.sortAsc ? a : b, index),
                            this.getCellValue(this.sortAsc ? b : a, index)
                        );
                }
            };
        }
    </script>
    @push('scripts')
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.
                on('closeModal', (event) => {
                    $('#modal-initiateconcept').modal('hide')
                    $('#modal-open').modal('hide')
                    $('#modal-verifyconcept').modal('hide')
                    $('#modal-submitconcept').modal('hide')
                    $('#modal-receiveconcept').modal('hide')
                    $('#modal-approveconcept').modal('hide')
                });
            });
        </script>
    @endpush

</div>
