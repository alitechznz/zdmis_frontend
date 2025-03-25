<div x-data="data()" class="m-2">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 p-0">
                    <h3>Manage Department </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <div class="input-group">
                        <input type="search" wire:model.live="search_keyword"
                            class="form-control form-control-sm w-auto" placeholder="Search department...">
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-end">

                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modal-department" wire:click='create'>
                            <i class="fa fa-plus"></i> Add New </a>
                    </div>
                </div>
            </div>
            <div class="table-responsive custom-scrollbar">
                <table
                    class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                    <thead class="table-light">
                        <tr class="text-capitalize">
                            <th scope="col">SN</th>
                            <th scope="col">Department_Name</th>
                            <th scope="col">Institution_Name</th>
                            <th scope="col">Status</th>
                            <th width="220">Actions</th>
                        </tr>
                    </thead>

                    <tbody x-ref="tbody">
                        @forelse ($departments as $department)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->instituteName }}</td>
                                <td>
                                    <span
                                        class="badge {{ $department->status ? 'badge-light-success' : 'badge-light-danger' }}">
                                        {{ $department->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td style="display: flex; gap: 5px;">
                                   
                                        <a href="#" wire:click="edit({{ $department->id }})"
                                            class="btn btn-sm btn-success" data-bs-toggle="modal"
                                            data-bs-target="#modal-department">
                                            Edit </a>
                                   
                                
                                        <a href="#" class="btn btn-sm btn-danger"
                                            wire:click="deleteConfirm({{ $department->id }})" data-bs-toggle="modal"
                                            data-bs-target="#deleteModaldepartment">
                                            Delete </a>
                                  

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-danger text-center"> No department Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if($departments->count())
                    {{ $departments->links() }}
                @else
                    {{-- <tr>
                        <td colspan="6" class="text-center">No institutions found.</td>
                    </tr> --}}
                @endif
            </div>
        </div>
    </div>
    <!-- Modal Content -->


    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-department" tabindex="-1" role="dialog"
        aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">{{ $update ? 'Update' : 'Add' }} Department</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="name">Department Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name"
                                class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="Enter Department Name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="institution">Institution name <span class="text-danger">*</span></label>
                            <select wire:model="institution" class="form-control @error('institution') is-invalid @enderror"
                                id="institution">
                                <option value="">--Choose--</option>
                                @foreach ($institutions as $institution)
                                    <option value="{{ $institution->id }}">{{ $institution->name }}</option>
                                @endforeach
                            </select>
                            @error('institution')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-sm-12 col-md-12 col-lg-12">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select id="status" class="form-control @error('status') is-invalid @enderror" wire:model='status'>
                                <option value="">--Choose--</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="under">Under <span class="text-danger">*</span></label>
                            <select id="under" class="form-control @error('under') is-invalid @enderror"
                                onchange="toggleDropdowns()" wire:model='under'>
                                <option value="">--Choose--</option>
                                <option value="Ministry">Ministry</option>
                                <option value="Institution">Institution</option>
                            </select>
                            @error('under')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        <!-- Institution Dropdown -->

                        {{-- <div class="mb-4 col-sm-12 col-md-12 col-lg-12" id="institution-dropdown"
                            style="display: none;">
                            <label for="institution">Institution</label>
                            <select id="institution" class="form-control" wire:model="institution">
                                <option value="">--Select Institution--</option>
                                @foreach ($institutions as $institution)
                                    <option value="{{ $institution->id }}">{{ $institution->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}


                        <!-- Ministry Dropdown -->
                        {{-- <div class="mb-4 col-sm-12 col-md-12 col-lg-12" id="ministry-dropdown" style="display: none;">
                            <label for="ministry">Ministry</label>
                            <select id="ministry" class="form-control" wire:model="ministry">
                                <option value="">--Select Ministry--</option>
                                @foreach ($ministries as $ministry)
                                    <option value="{{ $ministry->id }}">{{ $ministry->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}

                        {{-- <div class="mb-4 col-sm-12">
                            <label for="address">Address <span class="text-danger">*</span></label>
                            <textarea id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter Address"
                                wire:model='address'></textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal"
                        wire:click='create'>Close</button>
                    <button type="button" wire:click.prevent="store"
                        class="{{ $update ? 'btn btn-success' : 'btn btn-primary' }}">
                        {{ $update ? 'Update' : 'Add' }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModaldepartment" data-backdrop="false" tabindex="-1"
        role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" wire:click.prevent="destroy()" class="btn btn-danger close-modal"
                        data-bs-dismiss="modal">Yes, Delete
                    </button>
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
                                !isNaN(row2) ?
                                row1 - row2 :
                                row1.toString().localeCompare(row2);
                        })(
                            this.getCellValue(this.sortAsc ? a : b, index),
                            this.getCellValue(this.sortAsc ? b : a, index)
                        );
                }
            };
        }
    </script>

    {{-- <script>
        function toggleDropdowns() {
            var underValue = document.getElementById('under').value;
            document.getElementById('institution-dropdown').style.display = (underValue === 'Institution') ? 'block' :
                'none';
            document.getElementById('ministry-dropdown').style.display = (underValue === 'Ministry') ? 'block' : 'none';
        }
    </script> --}}

    @push('scripts')
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.
                on('closeModal', (event) => {
                    $('#modal-department').modal('hide')
                });
            });
        </script>
    @endpush
</div>
