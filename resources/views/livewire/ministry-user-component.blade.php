<div x-data="data()" class="m-2">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 p-0">
                    <h3>Manage Ministry Users </h3>
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
                               class="form-control form-control-sm w-auto"
                               placeholder="Search ministry user...">
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-end">
                        @can('add user ministry')
                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modal-ministryuser" wire:click='create'
                     ><i class="fa fa-plus"></i> Add New </a>
                        @endcan

                    </div>
                </div>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive custom-scrollbar">
                        <table class="display border table table-bordered table-hover table-striped table-responsive custom-scrollbar-sm">
                            <thead class="table-light">
                                <tr class="text-capitalize">
                                    <th scope="col" width="50">SN</th>
                                    <th scope="col">Full_name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Payroll_Number</th>
                                    <th scope="col">Ministry</th>
                                    <th scope="col" width="220">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($ministry_users as $ministryuser)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td class="text-nowrap">{{ $ministryuser->full_name }}</td>
                                    <td>{{ $ministryuser->phone }}</td>
                                    <td>{{ $ministryuser->employmentID }}</td>
                                    <td class="text-nowrap">{{ $ministryuser->ministry?->name  }}</td>
                                    <td style="display: flex; gap: 5px;">
                                        @can('edit user ministry')
                                        <a href="#" wire:click="edit({{ $ministryuser->id }})"
                                            class="btn btn-sm btn-success" data-bs-toggle="modal"
                                            data-bs-target="#modal-ministryuser">
                                                Edit
                                            </a>
                                        @endcan

                                        @can('delete user ministry')
                                        <a href="#" class="btn btn-sm btn-danger"
                                        wire:click="deleteConfirm({{$ministryuser->id}})" data-bs-toggle="modal"
                                        data-bs-target="#deleteModalministryuser">
                                            Delete
                                        </a>
                                        @endcan


                                    </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-danger text-center"> No Institution User Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $ministry_users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-ministryuser" tabindex="-1" role="dialog"
         aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">@if($update)
                            Update
                        @else
                            Add
                        @endif Ministry User</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="full_name">Full name</label>
                            <input type="text" wire:model="full_name"
                                   class="form-control @error("full_name") is-invalid @enderror" id="full_name"
                                   placeholder="Enter fullname">
                            @error("full_name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="email">Email</label>
                            <input type="email" wire:model="email"
                                   class="form-control @error("email") is-invalid @enderror" id="email"
                                   placeholder="Enter email address">
                            @error("email")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="phone">Phone</label>
                            <input type="text" wire:model="phone"
                                   class="form-control @error("phone") is-invalid @enderror" id="phone"
                                   placeholder="Enter phone number">
                            @error("phone")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="employmentid">Payroll Number</label>
                            <input type="text" wire:model="employmentid"
                                   class="form-control @error("employmentid") is-invalid @enderror" id="employmentid"
                                   placeholder="Enter Payroll Number">
                            @error("employmentid")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-md-6 col-sm-12 col-lg-6">
                            <label for="ministry">Ministry</label>
                            <select wire:model="ministry" class="form-control @error("ministry") is-invalid @enderror"
                                    id="ministry">
                                <option value="">--Choose--</option>
                                @foreach($ministries as $ministry)
                                    <option value="{{ $ministry->id }}">{{ $ministry->name }}</option>
                                @endforeach
                            </select>
                            @error("ministry")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-md-6">
                            <label for="role">Role</label>
                            <select wire:model="role" class="form-control @error("role") is-invalid @enderror" id="role">
                                <option value="">--Role--</option>
                                @forelse($roles as $rol)
                                    <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                                @empty
                                @endforelse
                            </select>
                            @error("role")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-md-12 col-sm-12 col-lg-12" xmlns="http://www.w3.org/1999/html">
                            <label for="address">Address</label>
                            <textarea wire:model="address" class="form-control @error("address") is-invalid @enderror"
                                      id="address" placeholder="Enter Address">
                            </textarea>
                            @error("address")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" wire:click.prevent="store" class="{{ $update ? 'btn btn-success' : 'btn btn-primary' }}">  {{ $update ? 'Update' : 'Add' }}</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModalministryuser" data-backdrop="false" tabindex="-1"
         role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete <strong>{{ $delete_confirm? $delete_confirm->full_name: ''  }}</strong> ?
                    </p>
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
                    $('#modal-ministryuser').modal('hide')
                });
            });
        </script>
    @endpush
</div>
