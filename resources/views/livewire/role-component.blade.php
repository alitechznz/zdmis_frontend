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
                    <h3>Usimamizi wa Majukumu na Ruhusa</h3>
                </div>
                <div class="col-sm-6 p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg>
                            </a></li>
                        <li class="breadcrumb-item">Jukumu</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col mb-4">
                    <label for="role_name">Jina La Jukumu <span class="text-danger">*</span></label>
                    <input type="text" wire:model.defer="role_name"
                        class="form-control @error('role_name') is-invalid @enderror" id="role_name"
                        placeholder="Ingiza jukumu">
                    @error('role_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4 col-md-4">
                    <label for="municipal_council">Hali <span class="text-danger">*</span></label>
                    <select wire:model.defer="status"
                        class="form-control @error('municipal_council') is-invalid @enderror" id="municipal_council">
                        <option value="">--Chagua--</option>
                        <option value="true">Hai</option>
                        <option value="false">Sio Hai</option>
                    </select>
                    @error('municipal_council')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="col mb-4 text-end" style="margin-top: 7px;">
                    <a wire:click="storeRole" class="btn btn-secondary mt-4">
                        <i class="fa fa-plus"></i>
                        @if ($update)
                            Badilisha
                        @else
                            Sajili
                        @endif
                        Jukumu
                    </a>
                </div>
            </div>
            <div class="table-responsive custom-scrollbar">
                <table
                    class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                    <tr class="text-uppercase">
                        <th width="35">#</th>
                        <th scope="col">Jukumu</th>
                        <th scope="col">Hali</th>
                        <th width="400">Kitendo</th>
                    </tr>

                    @forelse($roles as $r)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $r['roleName'] }}</td>
                            <td>
                                @if ($r['status'])
                                    <i class="fa fa-check" aria-hidden="true" style="color: green;"></i>
                                @else
                                    <i class="fa fa-times" aria-hidden="true" style="color: red;"></i>
                                @endif
                            </td>
                            <td class="text-end" style="display: flex; gap: 5px;">
                                <div class="btn-group-sm">

                                    <a href="#" class="btn btn-sm btn-warning"
                                        wire:click="$dispatch('perms', {role: {{ $r['id'] }}})"
                                        data-bs-toggle="modal" data-bs-target="#modal-permission">
                                        <i class="fa fa-lock"></i> Ruhusa
                                    </a>


                                    {{-- @if ($r->roleName != 'Super admin' and $r->roleName != 'Admin' and $r->roleName != 'ZPC Officer' and $r->roleName != 'Minister' and $r->name != 'DPPR' and $r->name != 'PS' and $r->name != 'Chairman ZPS') --}}
                                    {{-- @can('edit role') --}}
                                    <a wire:click="editRole({{ $r['id'] }})" class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i> Badilisha
                                    </a>
                                    {{-- @endcan --}}
                                    {{-- @can('delete role') --}}
                                    <a href="#" class="btn btn-sm btn-danger"
                                        wire:click="deleteConfirm({{ $r['id'] }})" data-bs-toggle="modal"
                                        data-bs-target="#deleteModalrole">
                                        <i class="fa fa-trash"></i> Futa
                                    </a>
                                    {{-- @endcan --}}
                                    {{-- @endif --}}
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
        aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Usimamizi Ruhusa</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-light" style="max-height: 75vh; overflow-y: auto;">
                    {{-- @livewire('permission-component') --}}
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
                    <h5 class="modal-title" id="exampleModalLabel">Hakiki Kufuta </h5>
                </div>
                <div class="modal-body">
                    <p>Je unataka kufuta <strong>{{ $delete_confirm ? $delete_confirm->name : '' }}</strong> ?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Ondosha
                    </button>
                    <button type="button" wire:click.prevent="destroy()" class="btn btn-danger close-modal"
                        data-bs-dismiss="modal">Ndio, Futa
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
    @push('scripts')
        <script>
            document.addEventListener('closeModal', () => {
                $('#modal-user').modal('hide')
            });
        </script>
    @endpush
</div>
