<div x-data="data()" class="m-2">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-12 p-0">
                    <h3>Manage Municipal User </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <div class="input-group">
                        <input type="search" wire:model.live="search_keyword" class="form-control form-control-sm w-auto"
                               placeholder="Search municipal user...">
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-end">
                        @can('add user municipal')
                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modal-municipal_user" wire:click='create'
                     ><i class="fa fa-plus"></i> Add New </a>
                        @endcan
                       
                    </div>

                </div>
            </div>
            <div class="table-responsive custom-scrollbar">
                <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                    <thead class="table-light">
                    <tr class="text-capitalize">
                        <th>SN</th>
                        <th>Full_Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Payroll_Number</th>
                        <th>Municipal</th>
                        <th>Address</th>
                        <th width="220">Actions</th>
                    </tr>
                    </thead>
                    <tbody x-ref="tbody">
                    @forelse ($municipal_users as $municipal_user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $municipal_user->full_name }}</td>
                            <td>{{ $municipal_user->phone }}</td>
                            <td>{{ $municipal_user->employementID }}</td>
                            <td>{{ $municipal_user->municipal->name }}</td>
                            <td>{{ $municipal_user->address }}</td>
                            <td style="display: flex; gap: 5px;">
                                @can('edit user municipal')
                                <a href="#" wire:click="edit({{ $municipal_user->id }})"
                                    class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-municipal_user">
                                     Edit </a>
                                @endcan
                                @can('delete user municipal')
                                <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$municipal_user->id}})"
                                    data-bs-toggle="modal" data-bs-target="#deleteModalmunicipal_user">
                                     Delete </a>
                                @endcan
                               
                                
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-danger text-center"> No Municipal User Found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $municipal_users->links() }}
            </div>
        </div>
    </div>
    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-municipal_user" tabindex="-1" role="dialog"
         aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">@if($update)
                            Update
                        @else
                            Add
                        @endif Municipal User</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-4">
                            <label for="full_name">Full name</label>
                            <input type="text" wire:model="full_name"
                                   class="form-control @error("full_name") is-invalid @enderror" id="full_name"
                                   placeholder="Enter full name">
                            @error("full_name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-md-6">
                            <label for="email">Email</label>
                            <input type="text" wire:model="email"
                                   class="form-control @error("email") is-invalid @enderror" id="email"
                                   placeholder="Enter email">
                            @error("email")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-md-6">
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
                        <div class="mb-4 col-md-3 col-sm-12">
                            <label for="employeeid">Payroll Number</label>
                            <input type="text" wire:model="employeeId"
                                   class="form-control @error("employeeId") is-invalid @enderror" id="employeeid"
                                   placeholder="Enter Payroll Number"">
                            @error("employeeId")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-md-3 col-sm-6 col-lg-3">
                            <label for="role">Role</label>
                            <select wire:model="role"
                                    class="form-select @error("role") is-invalid @enderror" id="role">
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
                        <div class="mb-4 col-md-6">
                            <label for="municipal">Municipal</label>
                            <select wire:model="municipal" class="form-select @error("municipal") is-invalid @enderror"
                                    id="municipal">
                                <option value="">--Choose--</option>
                                @foreach($municipals as $municipal)
                                    <option value="{{ $municipal->id }}">{{ $municipal->name }}</option>
                                @endforeach
                            </select>
                            @error("municipal")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4" xmlns="http://www.w3.org/1999/html">
                            <label for="address">Address</label>
                            <textarea wire:model="address" class="form-control @error("address") is-invalid @enderror"
                                      id="address">
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
    <div wire:ignore.self class="modal fade" id="deleteModalmunicipal_user" data-backdrop="false" tabindex="-1"
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
                    $('#modal-municipal_user').modal('hide')
                });
            });
        </script>
    @endpush
</div>
