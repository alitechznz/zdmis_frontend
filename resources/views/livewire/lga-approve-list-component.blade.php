<div x-data="data()" class="m-2">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 p-0">
                    <h3>Manage Approve List</h3>
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
                            <input type="search" wire:model="search_keyword" class="form-control form-control-sm w-auto" placeholder="Search challenges...">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="float-end">
                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-budgetterm" wire:click='create'>
                                <i class="fa fa-plus"></i> Add New
                            </a>

                        </div>
                    </div>
                </div>

                <div class="table-responsive custom-scrollbar">
                    <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                        <thead class="table-light">
                            <tr class="text-capitalize">
                                <th>SN</th>
                                <th>Title</th>
                                <th>Code</th>
                                <th>Locator_Level</th>
{{--                                <th>Location_Name</th>--}}
                                <th>Total_Cost(Tzs)</th>
                                <th>Start_Time_Period</th>
                                <th>End_Time_Period</th>
                                <th>Source_of_Fund</th>
                                <th>Implementation_Status</th>
                                <th width="220">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($all_data as $approve)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $approve->conceptNote->projectname }}</td>
                                    <td>{{ $approve->conceptNote->project_code ?? 'Not Specified' }}</td>
                                    <td>{{ $approve->location_level }}</td>
                                    <td>{{ $approve->project_cost }}</td>
                                    <td>{{ $approve->start_time_period->format('d F, Y') }}</td>
                                    <td>{{ $approve->end_time_period->format('d F, Y') }}</td>
                                    <td>{{ $approve->sourceFinancing->name }}</td>
                                    <td>{{ $approve->implementation_status }}</td>

                                    <td style="display: flex; gap:5px;">
                                        @can('edit budget form')
                                            <a href="#" wire:click="edit({{ $approve->id }})" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-budgetterm">Edit</a>
                                        @endcan

                                        @can('delete budget form')
                                            <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{ $approve->id }})" data-bs-toggle="modal" data-bs-target="#deleteModalbudgetterm">Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center text-danger">No Data Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                     {{ $all_data->links() }}
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-budgetterm" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">{{ $update ? 'Update' : 'Add' }} Challenge</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">



                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="concept_note">Concept Note <span class="text-danger">*</span></label>
                            <select wire:model="concept_note" class="form-control @error("concept_note") is-invalid @enderror" id="concept_note">
                                <option value="">--Choose--</option>
                                @foreach($conceptNote as $concept)
                                    <option value="{{ $concept->id }}">{{ $concept->projectname }}</option>
                                @endforeach


                            </select>
                            @error("concept_note")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="location_level">Location Level <span class="text-danger">*</span></label>
                            <select wire:model="location_level" class="form-control @error("location_level") is-invalid @enderror" id="location_level">
                                <option value="">--Choose--</option>
                                <option value="Region">Region</option>
                                <option value="District">District</option>
                                <option value="Shehia">Shehia</option>
                            </select>
                            @error("location_level")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="project_cost">Project Cost<span class="text-danger">*</span></label>
                            <input type="number" wire:model="project_cost" class="form-control @error('project_cost') is-invalid @enderror" id="project_cost" placeholder="Enter Project Cost">
                            @error('project_cost')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="start_time_period">Start Time Period<span class="text-danger">*</span></label>
                            <input type="date" wire:model="start_time_period" class="form-control @error('start_time_period') is-invalid @enderror" id="start_time_period" placeholder="Choose  Date">
                            @error('start_time_period')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="end_time_period">End Time Period<span class="text-danger">*</span></label>
                            <input type="date" wire:model="end_time_period" class="form-control @error('end_time_period') is-invalid @enderror" id="end_time_period" placeholder="Choose  Date">
                            @error('end_time_period')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                         <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="source_of_fund">Source of Fund <span class="text-danger">*</span></label>
                            <select wire:model="source_of_fund" class="form-control @error("source_of_fund") is-invalid @enderror" id="source_of_fund">
                                <option value="">--Choose--</option>
                                @foreach($sourceFinancings as $sourceFinancing)
                                    <option value="{{ $sourceFinancing->id }}">{{ $sourceFinancing->name }}</option>
                                @endforeach


                            </select>
                            @error("source_of_fund")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-sm-12 col-md-12 col-lg-12">
                            <label for="implementation_status">Implementation Status <span class="text-danger">*</span></label>
                            <select wire:model="implementation_status" class="form-control @error("implementation_status") is-invalid @enderror" id="implementation_status">
                                <option value="">--Choose--</option>
                                <option value="Completed">Completed</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Suspended">Suspended</option>
                            </select>
                            @error("implementation_status")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal">Close</button>
                        <button type="button" wire:click.prevent="store" class="{{ $update ? 'btn btn-success' : 'btn btn-primary' }}">  {{ $update ? 'Update' : 'Add' }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModalbudgetterm" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div the="modal-header">
                    <h5 class="modal-title">Delete Confirm</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete <strong>{{ $delete_confirm ? $delete_confirm->year : '' }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" wire:click.prevent="destroy()" class="btn btn-danger close-modal" data-bs-dismiss="modal">Yes, Delete</button>
                </div>
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
       window.livewire.on('closeModal', () => {
                    $('#modal-budgetterm').modal('hide')
                })
    </script>
    @endpush
</div>
