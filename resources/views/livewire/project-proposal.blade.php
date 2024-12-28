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

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                  <h3>Project Proposal</h3>
                </div>

                <div class="col-sm-6 p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Project Proposal List</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive custom-scrollbar">
                            <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                                <thead class="table-light">
                                <tr class="text-capitalize">
                                    <th width="70">SN</th>
                                    <th class="text-nowrap">Project Title</th>
                                    <th class="text-nowrap">Project Time Frame </th>
                                    <th class="text-nowrap">Project Code </th>
                                    {{--                                        <th>Project<small class="text-light">_</small>GFS<small class="text-light">_</small>Code </th>--}}
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody x-ref="tbody">
                                @forelse ($conceptNotes as $conceptnote_item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td class="text-nowrap" title="{{ $conceptnote_item->projectname }}">{{ Str::limit($conceptnote_item->projectname, 80, ' ...') }}</td>
                                        <td class="text-nowrap">{{ date('Y-m-d', strtotime($conceptnote_item->startdate)) }} - {{ date('Y-m-d', strtotime($conceptnote_item->enddate)) }}</td>
                                        {{--                                            <td>loading...</td>--}}
                                        <td>loading...</td>
                                        <td>
                                            @if($conceptnote_item->process_status == 0)
                                                <span class="badge badge-light-success"> Initiated</span>
                                            @elseif($conceptnote_item->process_status == 1)
                                                <span class="badge badge-light-success">Verified</span>
                                            @elseif($conceptnote_item->process_status == 2)
                                                <span class="badge badge-light-success">Submitted</span>
                                            @elseif($conceptnote_item->process_status == 3)
                                                <span class="badge badge-light-success">Accepted</span>
                                            @elseif($conceptnote_item->process_status == 4)
                                                <span class="badge badge-light-success">Approved</span>
                                            @elseif($conceptnote_item->process_status == 5)
                                                <span class="badge badge-light-success">Rejected</span>
                                            @endif
                                        </td>
                                        <td style="display: flex; gap: 5px;">
                                            <!-- Link to the View page -->
                                            <a href="{{ route('concept-notes.view', $conceptnote_item->id) }}" class="btn btn-sm btn-primary">View</a>
                                            <!-- Link to the Edit page -->
                                            <a href="{{ route('concept-notes.edit', $conceptnote_item->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                                            <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$conceptnote_item->id}})" data-bs-toggle="modal" data-bs-target="#deleteConceptNote">Delete</a>
                                            <a href="#" wire:click="Initiate({{ $conceptnote_item->id }})" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-initiateconcept">Initiate </a>
                                            <a href="#" wire:click="Initiate({{ $conceptnote_item->id }})" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-verifyconcept">Verify </a>
                                            <a href="#" wire:click="Initiate({{ $conceptnote_item->id }})" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modal-submitconcept">Submit </a>
                                            <a href="#" wire:click="Initiate({{ $conceptnote_item->id }})" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-receiveconcept">Receive </a>
                                            <a href="#" wire:click="Initiate({{ $conceptnote_item->id }})" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modal-approveconcept">Approve </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-danger text-center"> No Appraisal Question Found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-projectquestion" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h2 class="h6 modal-title">@if($update) Update @else Add @endif Appraisal Question</h2> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div  class="row">

                        <div class="modal-footer">
                            {{-- <button type="button" wire:click.prevent="store" class="btn btn-secondary"> @if($update) Update @else Add @endif</button> --}}
                            <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteConceptNote" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="deleteConceptNote" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete <strong>{{ $delete_confirm? $delete_confirm->projectname: ''  }}</strong> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" wire:click.prevent="destroy()" class="btn btn-danger close-modal" data-bs-dismiss="modal">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Structure for Initiate -->
    <div wire:ignore.self class="modal fade" id="modal-initiateconcept" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="modal-initiateconcept" aria-hidden="true">
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
                            <textarea class="form-control" id="initiateComment" wire:model.defer="initiateComment" rows="4"></textarea>
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
    <div wire:ignore.self class="modal fade" id="modal-verifyconcept" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="modal-verifyconcept" aria-hidden="true">
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
                        <select class="form-control" id="action" wire:model.defer="action">
                            <option value="" selected>Select Action</option>
                            <option value="accept">Accept</option>
                            <option value="reject">Reject</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="remark" class="form-label">Remark</label>
                        <textarea class="form-control" id="remark" wire:model.defer="remark" rows="4" placeholder="Add your remark"></textarea>
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
    <div wire:ignore.self class="modal fade" id="modal-submitconcept" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="modal-submitconcept" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="initiateModalLabel"><b>Submit Project:</b> {{ $concept_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="verifyConcept">
                        <div class="mb-3">
                            <input type="hidden" class="form-control" wire:model="conceptID"/>
                            <label for="action" class="form-label">Action</label>
                            <select class="form-control" id="action" wire:model.defer="action">
                                <option value="" selected>Select Action</option>
                                <option value="accept">Accept</option>
                                <option value="reject">Reject</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="remark" class="form-label">Remark</label>
                            <textarea class="form-control" id="remark" wire:model.defer="remark" rows="4" placeholder="Add your remark"></textarea>
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
    <div wire:ignore.self class="modal fade" id="modal-receiveconcept" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="modal-receiveconcept" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="initiateModalLabel"><b>Receive Project:</b> {{ $concept_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="verifyConcept">
                        <div class="mb-3">
                            <input type="hidden" class="form-control" wire:model="conceptID"/>
                            <label for="action" class="form-label">Action</label>
                            <select class="form-control" id="action" wire:model.defer="action">
                                <option value="" selected>Select Action</option>
                                <option value="accept">Accept</option>
                                <option value="reject">Reject</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="remark" class="form-label">Remark</label>
                            <textarea class="form-control" id="remark" wire:model.defer="remark" rows="4" placeholder="Add your remark"></textarea>
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
                    @this.on('closeModal', (event) => {
                        $('#modal-projectquestion').modal('hide')
                    });
                    });
        </script>
    @endpush
</div>
