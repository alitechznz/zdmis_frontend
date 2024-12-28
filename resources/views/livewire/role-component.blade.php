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
                    <h3>Manage Role and Permission</h3>
                </div>
                <div class="col-sm-6 p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg>
                            </a></li>
                        <li class="breadcrumb-item">roles</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col mb-4">
                    <label for="role_name">Role Name <span class="text-danger">*</span></label>
                    <input type="text" wire:model.defer="role_name"
                           class="form-control @error("role_name") is-invalid @enderror" id="role_name" placeholder="Enter role">
                    @error("role_name")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col mb-4 text-end" style="margin-top: 7px;">
                    <a wire:click="storeRole" class="btn btn-secondary mt-4">
                        <i class="fa fa-plus"></i>
                        @if($update) Edit @else Add @endif
                        Role
                    </a>
                </div>
            </div>
            <div class="table-responsive custom-scrollbar">
                <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                    <tr class="text-uppercase">
                        <th width="35">#</th>
                        <th scope="col">Role Title</th>
                        <th width="400">Actions</th>
                    </tr>

                    @forelse($roles as $r)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $r->name }}</td>
                            <td class="text-end" style="display: flex; gap: 5px;">
                                <div class="btn-group-sm">
                                    @can('permission role')
                                        <a href="#" class="btn btn-sm btn-warning" wire:click="$dispatch('perms', {role: {{ $r->id }}})" data-bs-toggle="modal" data-bs-target="#modal-permission">
                                            <i class="fa fa-lock"></i> Permissions
                                        </a>
                                    @endcan

                                    @if($r->name != "Super admin" and $r->name != "Admin" and $r->name != "ZPC Officer" and $r->name != "Minister" and $r->name != "DPPR" and $r->name != "PS" and $r->name != "Chairman ZPS")
                                        @can('edit role')
                                            <a wire:click="editRole({{ $r->id }})" class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        @endcan
                                        @can('delete role')
                                            <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$r->id}})" data-bs-toggle="modal" data-bs-target="#deleteModalrole">
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                        @endcan
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </table>
            </div>
        </div>
    </div>

    <!-- Permission Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-permission" tabindex="-1" role="dialog"
         aria-labelledby="modal-default"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Permissions Manager</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-light" style="max-height: 75vh; overflow-y: auto;">
                    @livewire('permission-component')
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModalrole" data-backdrop="false" tabindex="-1" role="dialog"
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
