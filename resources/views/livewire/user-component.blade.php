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
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 p-0">
                    <h3>Manage User </h3>
                </div>
                <div class="col-sm-6 p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg>
                            </a></li>
                        <li class="breadcrumb-item">users</li>
                    </ol>
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
                               placeholder="Search user...">
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-end">
                        @can('add user authentication')
                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-user" wire:click="create"
                            ><i class="fas fa-plus"></i> Add user </a>
                        @endcan
                    </div>

                </div>
            </div>
            <div class="table-responsive custom-scrollbar">
                <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                    <thead class="table-light">
                    <tr class="text-capitalize">
                        <th scope="col">SN </th>
                        <th scope="col">Name </th>
                        <th scope="col">Email </th>
                        <th scope="col">Role </th>
                        <th scope="col">Status </th>
                        <th scope="col">Created At</th>
                        <th scope="col" width="220">Actions</th>
                    </tr>
                    </thead>
                    <tbody x-ref="tbody">
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->getRoleNames()[0] ?? 'None' }}</td>
                            <td>
                                @if($user->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('d F, Y') }}</td>
                            <td style="display: flex; gap: 5px;">
                                @can('edit user authentication')
                                    <a href="#" wire:click="edit({{ $user->id }})"
                                       class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-user">
                                        Edit </a>
                                @endcan

                                @can('delete user authentication')
                                    <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$user->id}})"
                                       data-bs-toggle="modal" data-bs-target="#deleteModaluser">
                                        Delete </a>
                                @endcan

                                <a href="#" class="btn btn-sm btn-primary" wire:click="extendTimeConfirm({{ $user->id }})"
                                    data-bs-toggle="modal" data-bs-target="#extendTimeTokenModel">
                                     Reset
                                 </a>


                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-danger text-center"> No User Found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-user" tabindex="-1" role="dialog" aria-labelledby="modal-default"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">@if($update)
                            Update
                        @else
                            Add
                        @endif User</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @if(!$update)
                            <div class="mb-4">
                                <label for="username">Username</label>
                                <input type="text" wire:model="username"
                                       class="form-control @error("username") is-invalid @enderror" id="username">
                                @error("username")
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        @endif

                        <div class="mb-4">
                            <label for="name">FullName</label>
                            <input type="text" wire:model="name"
                                   class="form-control @error("name") is-invalid @enderror" id="name">
                            @error("name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-md-6">
                            <label for="email">Email</label>
                            <input type="text" wire:model="email" @if($update) disabled @endif
                            class="form-control @error("email") is-invalid @enderror" id="email">
                            @error("email")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-md-6">
                            <label for="role">Role</label>
                            <select wire:model="role"
                                    class="form-control @error("role") is-invalid @enderror" id="role">
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

                        @if($update)
                            <div class="mb-4">
                                <label for="change_password">Change Password</label>
                                <input type="checkbox" id="change_password" wire:model.live="change_password" class="form-check-input">
                            </div>
                        @endif

                        <div class="mb-4 col-6">
                            <label for="password">Password</label>
                            <input type="password" wire:model="password" @if($update && !$change_password) disabled @endif
                            class="form-control @error("password") is-invalid @enderror" id="password">
                            @error("password")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-6">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" wire:model="password_confirmation" @if($update && !$change_password) disabled @endif
                            class="form-control @error("password_confirmation") is-invalid @enderror" id="password_confirmation">
                            @error("password_confirmation")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="status">Status</label>
                            <select wire:model="status"
                                    class="form-control @error("status") is-invalid @enderror" id="status">
                                <option value="">--Status--</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error("status")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click.prevent="store" class="btn btn-secondary"> @if($update)
                                    Update
                                @else
                                    Add
                                @endif</button>
                            <button type="button" class="btn btn-link text-gray-600 ms-auto"
                                    data-bs-dismiss="modal">Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->



        <!-- Extend Time Modal -->
        <div wire:ignore.self class="modal fade" id="extendTimeTokenModel" data-backdrop="false" tabindex="-1" role="dialog"
        aria-labelledby="extendModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Extend Token Time Confirm </h5>
               </div>
               <div class="modal-body">
                   <p>Are you sure want to extend Time ?</strong>
                   </p>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cancel
                   </button>
                   <button type="button" wire:click.prevent="extendTokenTime" class="btn btn-danger close-modal"
                           data-bs-dismiss="modal">Yes, Extend Time
                   </button>
               </div>
           </div>
       </div>
   </div>

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModaluser" data-backdrop="false" tabindex="-1" role="dialog"
         aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete <strong>{{ $delete_confirm? $delete_confirm->name: ''  }}</strong> ?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cancel
                    </button>
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
            document.addEventListener('closeModal', () => {
                $('#modal-user').modal('hide')
            });
        </script>
    @endpush
</div>
