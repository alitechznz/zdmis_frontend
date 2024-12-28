<div x-data="data()" class="m-2">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 p-0">
                    <h3>Manage LGA Concept Note</h3>
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
                            <input type="search" wire:model="search_keyword" class="form-control form-control-sm w-auto" placeholder="Search concept...">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="float-end">
                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-lga-concept-note" wire:click='create'>
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
                            <th>Project_Name</th>
                            <th>Project_Code</th>
                            <th>Sector</th>
                            <th>Start_Date</th>
                            <th>End_Date</th>
                            <th width="220">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($all_data as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td title="{{ $data->projectname }}">{{ Str::limit($data->projectname, 10) ?? 'Not Assigned' }}</td>
                                <td>{{ $data->project_code ?? 'Not Assigned' }}</td>
                                <td>{{ $data->sector->name ?? 'Not Assigned' }}</td>
                                <td>
                                    {{ $data->startdate ? $data->startdate->format('d F, Y') : 'Not Assigned' }}
                                </td>
                                <td>
                                    {{ $data->enddate ? $data->enddate->format('d F, Y') : 'Not Assigned' }}
                                </td>
                                <td style="display: flex; gap:5px;">
                                    @can('edit budget form')
                                        <a href="#" wire:click="edit({{ $data->id }})" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-lga-concept-note">Edit</a>
                                    @endcan

                                    @can('delete budget form')
                                        <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{ $data->id }})" data-bs-toggle="modal" data-bs-target="#delete-lga-concept-note-modal">Delete</a>
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
    <div class="modal fade" wire:ignore.self id="modal-lga-concept-note" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">{{ $update ? 'Update' : 'Add' }} Challenge</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="projectname">Project Name<span class="text-danger">*</span></label>
                            <input type="text" wire:model="projectname" class="form-control @error('projectname') is-invalid @enderror" id="projectname" placeholder="Enter Project Name">
                            @error('projectname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="project_code">Project Code <span class="text-danger">*</span></label>
                            <input type="text" wire:model="project_code" class="form-control @error('project_code') is-invalid @enderror" id="project_code" placeholder="Enter Project Code">
                            @error('project_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="shortname">Shortname <span class="text-danger">*</span></label>
                            <input type="text" wire:model="shortname" class="form-control @error('shortname') is-invalid @enderror" id="shortname" placeholder="Enter shortname">
                            @error('shortname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="sector">Sector <span class="text-danger">*</span></label>
                            <select wire:model="sector" class="form-control @error("sector") is-invalid @enderror" id="sector">
                                <option value="">--Choose--</option>

                                @foreach($sectors as $sector)
                                    <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                @endforeach
                            </select>
                            @error("sector")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="startdate">Start Date <span class="text-danger">*</span></label>
                            <input type="date" wire:model="startdate" class="form-control @error('startdate') is-invalid @enderror" id="startdate" placeholder="Choose start date">
                            @error('startdate')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="enddate">End Date <span class="text-danger">*</span></label>
                            <input type="date" wire:model="enddate" class="form-control @error('enddate') is-invalid @enderror" id="enddate" placeholder="Choose end date">
                            @error('enddate')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="mb-4 col-12">
                            <label for="description">Description </label>
                            <textarea wire:model="description" rows="3" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Enter description"></textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2">Characters: {{ $characterCount }}</div>
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
    <div wire:ignore.self class="modal fade" id="delete-lga-concept-note-modal" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
            $('#modal-lga-concept-note').modal('hide')
        })
    </script>
    @endpush
    </div>
