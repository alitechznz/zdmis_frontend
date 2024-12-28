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
                    <h3>Manage Municipal Council </h3>
                </div>
                {{-- <div class="col-sm-6 p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg>
                            </a></li>
                        <li class="breadcrumb-item">Municipal Council</li>
                    </ol>
                </div> --}}
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
                               placeholder="Search municipal council...">
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-end">
                        @can('view municipal council')
                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modal-municipalcouncil" wire:click='create'
                     ><i class="fa fa-plus"></i> Add New </a>
                        @endcan
                      
                    </div>

                </div>
            </div>
            <div class="table-responsive custom-scrollbar">
                <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                    <thead class="table-light">
                    <tr class="text-capitalize">
                        <th scope="col">SN</th>
                        <th scope="col">Municipal_Council_Name</th>
                        <th scope="col">Regional_Authority</th>
                        <th scope="col">Status</th>
                        <th width="220">Actions</th>
                    </tr>
                    </thead>
                    <tbody x-ref="tbody">
                    @forelse ($municipal_councils as $municipalcouncil)

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $municipalcouncil->name }}</td>
                            <td>{{ $municipalcouncil->regionalAuthority->name }}</td>
                            <td>
                                <span class="badge {{ $municipalcouncil->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($municipalcouncil->status) }}
                                </span>
                            </td>
                            <td style="display: flex; gap: 5px;">
                                @can('edit municipal council')
                                <a href="#" wire:click="edit({{ $municipalcouncil->id }})"
                                    class="btn btn-sm btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modal-municipalcouncil">
                                     Edit </a>
                                @endcan
                                @can('delete municipal council')
                                <a href="#" class="btn btn-sm btn-danger"
                                wire:click="deleteConfirm({{$municipalcouncil->id}})"
                                data-bs-toggle="modal" data-bs-target="#deleteModalmunicipalcouncil">
                                 Delete </a>
                                @endcan
                               
                               
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-danger text-center"> No Municipal Council Found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $municipal_councils->links() }}
            </div>
        </div>
    </div>
    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-municipalcouncil" tabindex="-1" role="dialog"
         aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">@if($update)
                            Update
                        @else
                            Add
                        @endif Municipal Council</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-4 col-sm-12 col-md-12 col-lg-12">
                            <label for="name">Municipal Council Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name"
                                   class="form-control @error("name") is-invalid @enderror" id="name" placeholder="Enter Municipal Council Name">
                            @error("name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-sm-12 col-md-12 col-lg-12">
                            <label for="regional_authority">Regional authority <span class="text-danger">*</span></label>
                            <select wire:model="regional_authority"
                                    class="form-control @error("regional_authority") is-invalid @enderror"
                                    id="regional_authority">
                                <option value="">--Choose--</option>
                                @foreach($regional_authorities as $regional_authority)
                                    <option
                                        value="{{ $regional_authority->id }}">{{ $regional_authority->name }}</option>
                                @endforeach
                            </select>
                            @error("regional_authority")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-sm-12 col-md-12 col-lg-12">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select wire:model="status" class="form-control @error("status") is-invalid @enderror"
                                    id="status">
                                <option value="">--Choose--</option>
                                <option value="active">active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error("status")
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
    <div wire:ignore.self class="modal fade" id="deleteModalmunicipalcouncil" data-backdrop="false" tabindex="-1"
         role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                    $('#modal-municipalcouncil').modal('hide')
                });
            });
        </script>
    @endpush
</div>
