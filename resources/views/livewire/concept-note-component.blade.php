<div x-data="data()" class="m-2">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 p-0">
                    <h3>Concept Note list</h3>
                </div>
                <div class="col-sm-6 p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg>
                            </a></li>
                        <li class="breadcrumb-item">Concept Note</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid default-dashboard">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">

                    <div class="col-6">
                        <div class="input-group">
                            <input type="search" wire:model.live="search_keyword"
                                   class="form-control form-control-sm w-auto"
                                   placeholder="Search concept note....">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="float-end">
                            @can('add  concept note')
                                <a href="{{ route('concept-note-form') }}" class="btn btn-sm btn-primary" wire:click='create'
                                ><i class="fa fa-plus"></i> Add New </a>
                            @endcan
                        </div>

                    </div>


                </div>
                <div class="table-responsive custom-scrollbar">
                    <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                        <thead class="table-light">
                        <tr class="text-capitalize">
                            <th width="70">SN</th>
                            <th>Project<small class="text-light">_</small>Title</th>
                            <th>Project<small class="text-light">_</small>Time<small class="text-light">_</small>Frame</th>
                            <th>Project<small class="text-light">_</small>Code</th>
                            {{-- <th>Project<small class="text-light">_</small>GFS<small class="text-light">_</small>Code</th> --}}
                            <th>Created<small class="text-light">_</small>Date</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($conceptnote as $conceptnote_item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td class="text-nowrap" title="{{ $conceptnote_item->projectname }}">{{ Str::limit($conceptnote_item->projectname, 50, ' ...') }}</td>
                                <td class="text-nowrap">{{ date('Y-m-d', strtotime($conceptnote_item->startdate)) }}
                                    - {{ date('Y-m-d', strtotime($conceptnote_item->enddate)) }}
                                </td>
                                <td>{{ $conceptnote_item->project_code }}</td>
                                <td class="text-nowrap">{{ $conceptnote_item->created_at->format('d-m-Y H:i:s') }}</td>
                                <td >
                                    @if($conceptnote_item->process_status == 1)
                                        @foreach ($conceptnote_item->decisionFlows as $decisionFlow)
                                            @if($decisionFlow->status =="Initiated" && $decisionFlow->action=="accept")
                                                <span class="badge badge-success"> Initiated</span>
                                            @elseif($decisionFlow->status =="Initiated" && $decisionFlow->action=="reject")
                                                <span class="badge badge-danger"> Initiated</span>
                                            @endif
                                        @endforeach
                                    @elseif($conceptnote_item->process_status == 2)
                                        @foreach ($conceptnote_item->decisionFlows as $decisionFlow)
                                            @if($decisionFlow->status =="Verified" && $decisionFlow->action=='accept')
                                                <span class="badge badge-success">Verified</span>
                                            @elseif($decisionFlow->status =='Verified' && $decisionFlow->action=='reject')
                                                <span class="badge badge-danger">Verified</span>
                                            @endif
                                        @endforeach

                                    @elseif($conceptnote_item->process_status == 3)
                                        @foreach ($conceptnote_item->decisionFlows as $decisionFlow)
                                            @if($decisionFlow->status =='Submitted' && $decisionFlow->action=='accept')
                                                <span class="badge badge-success">Submitted</span>
                                            @elseif($decisionFlow->status =='Submitted' && $decisionFlow->action=='reject')
                                                <span class="badge badge-danger">Submitted</span>
                                            @endif
                                        @endforeach

                                    @elseif($conceptnote_item->process_status == 4)
                                        @foreach ($conceptnote_item->decisionFlows as $decisionFlow)
                                            @if($decisionFlow->status =='ZPC Received' && $decisionFlow->action=='accept')
                                                <span class="badge badge-success">ZPC-Received</span>
                                            @elseif($decisionFlow->status =='ZPC Received' && $decisionFlow->action=='reject')
                                                <span class="badge badge-danger">ZPC-Received</span>
                                            @endif
                                        @endforeach

                                    @elseif($conceptnote_item->process_status == 5)
                                        @foreach ($conceptnote_item->decisionFlows as $decisionFlow)
                                            @if($decisionFlow->status =='ZPC Process' && $decisionFlow->action=='accept')
                                                <span class="badge badge-success">ZPC-Process</span>
                                            @elseif($decisionFlow->status =='ZPC Process' && $decisionFlow->action=='reject')
                                                <span class="badge badge-danger">ZPC-Process</span>
                                            @endif
                                        @endforeach

                                    @elseif($conceptnote_item->process_status == 6)
                                        <span class="badge badge-success">Approved</span>
                                    @else
                                        <span class="badge badge-warning">Created</span>
                                    @endif
                                </td>

                                <td style="display: flex; gap: 5px;">
                                    <!-- Link to the View page -->
                                    @can('view concept note')
                                        <a href="{{ route('concept-note-view', $conceptnote_item->id) }}" class="btn btn-sm btn-info">View</a>
                                    @endcan

                                    <!-- Link to the Edit page -->
                                    @can('edit  concept note')
                                        @if($conceptnote_item->process_status == 0 ||  $conceptnote_item->process_status == 10 || $conceptnote_item->return_status ==1)
                                            <a href="{{ route('concept-note-edit', $conceptnote_item->id) }}" class="btn btn-sm btn-success">Edit</a>
                                        @endif
                                    @endcan

                                    @can('delete  concept note')
                                        @if($conceptnote_item->process_status == 0 ||  $conceptnote_item->process_status == 10 || $conceptnote_item->return_status ==1)
                                            <a href="#" class="btn btn-sm btn-danger"
                                            wire:click="deleteConfirm({{$conceptnote_item->id}})"
                                            data-bs-toggle="modal" data-bs-target="#deleteConceptNote">
                                                Delete </a>
                                        @endif
                                    @endcan

                                    @can('initiate concept note')
                                        @if($conceptnote_item->process_status == 0 ||  $conceptnote_item->process_status == 10 || $conceptnote_item->return_status ==1)
                                            <a href="#" wire:click="Initiate({{ $conceptnote_item->id }})"
                                                class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modal-initiateconcept">
                                                Initiate </a>
                                        @endif
                                    @endcan

                                    @can('verify concept note')
                                        @if($conceptnote_item->process_status == 1)
                                            <a href="#" wire:click="Initiate({{ $conceptnote_item->id }})"
                                                class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#modal-verifyconcept">
                                                Verify </a>
                                        @endif
                                    @endcan

                                    @can('submit concept note')
                                        @if($conceptnote_item->process_status == 2)
                                            <a href="#" wire:click="Initiate({{ $conceptnote_item->id }})"
                                                class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#modal-submitconcept">
                                                Submit </a>
                                        @endif
                                    @endcan

                                    @can('receive concept note')
                                        @if($conceptnote_item->process_status == 3)
                                            <a href="#" wire:click="Initiate({{ $conceptnote_item->id }})"
                                                class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                data-bs-target="#modal-receiveconcept">
                                                Receive </a>
                                        @endif
                                    @endcan

                                    @can('open concept note')
                                        @if($conceptnote_item->process_status == 4)
                                        <a href="#" wire:click="Initiate({{ $conceptnote_item->id }})"
                                            class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#modal-open">
                                            Open </a>
                                        @endif
                                    @endcan

                                     @can('approve concept note')
                                        @if($conceptnote_item->process_status == 50)
                                            <a href="#" wire:click="Initiate({{ $conceptnote_item->id }})"
                                                class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#modal-approveconcept">
                                                Approve </a>
                                        @endif
                                     @endcan

                                     @can('screening concept note')
                                        @if($conceptnote_item->process_status == 5)
                                        <a href="{{ route('concept-note-screening', $conceptnote_item->id) }}"
                                            class="btn btn-sm btn-info">Screening</a>
                                        @endif
                                    @endcan

                                    @can('screening concept note')
                                            <a href="{{ route('concept-note-decision', $conceptnote_item->id) }}"
                                                class="btn btn-sm btn-warning">Feedback</a>

                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-danger text-center"> No Concept Note Found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
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
