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
                <h3>Manage Source Of Financing</h3>
            </div>
            {{-- <div class="col-sm-6 p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                    <li class="breadcrumb-item">Source Of Financing</li>
                </ol>
            </div> --}}
        </div>
    </div>
</div>

<div class="container-fluid default-dashboard">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <div class="input-group">
                        <input type="search" wire:model.live="search_keyword" class="form-control form-control-sm w-auto"
                               placeholder="Search source of financing...">
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-end">
                        @can('add source of finance')
                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-sourcefinancing" wire:click='create'
                        ><i class="fa fa-plus"></i> Add New </a>
                        @endcan

                    </div>

                </div>


            </div>

            <div class="table-responsive custom-scrollbar">
                <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                    <thead class="table-light">
                    <tr class="text-capitalize">
                        <th scope="col">SN </th>
                        <th scope="col">Source_Of_Finance </th>
                        <th scope="col">Category </th>
                        <th scope="col">Level </th>
                        <th scope="col">Source_Status </th>
                        <th width="220">Actions</th>
                    </tr>
                    </thead>
                    <tbody x-ref="tbody">
                    @forelse ($sourcefinancings as $sourcefinancing)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sourcefinancing->name }}</td>
                        <td>{{ $sourcefinancing->category }}</td>
                        <td>{{ $sourcefinancing->level }}</td>
                        <td>
                            <span class="badge {{ $sourcefinancing->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($sourcefinancing->status) }}
                            </span>
                        </td>

                        <td style="display: flex; gap:5px;">
                            @can('edit source of finance')
                            <a href="#" wire:click="edit({{ $sourcefinancing->id }})"
                                class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-sourcefinancing">
                                 Edit </a>
                            @endcan

                            @can('delete source of finance')
                            <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$sourcefinancing->id}})"
                                data-bs-toggle="modal" data-bs-target="#deleteModalsourcefinancing">
                                 Delete </a>
                            @endcan


                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-danger text-center"> No Source of Financing Found</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $sourcefinancings->links() }}
            </div>
        </div>
    </div>
</div>

    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-sourcefinancing" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">@if($update) Update @else Add @endif Source Of Financing</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div  class="row">

                        <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                            <label for="name">Source Of Financing <span class="text-danger">*</span></label>
                            <select wire:model="name" class="form-control @error("name") is-invalid @enderror" id="name">
                                <option value="">--Choose--</option>
                                <option value="SMZ">SMZ</option>
                                <option value="Donor">Donor</option>
                                <option value="SMT">SMT</option>
                                <option value="Others">Others</option>

                            </select>
                            @error("name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                            <label for="category">Category <span class="text-danger">*</span></label>
                            <input type="text" wire:model="category" class="form-control @error("category") is-invalid @enderror" id="category" placeholder="eg. Grant/Loan">
                            @error("category")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                            <label for="level">Level <span class="text-danger">*</span></label>
                            <select wire:model="level" class="form-control @error("level") is-invalid @enderror" id="level">
                                <option value="">--Choose--</option>
                                <option value="National">National</option>
                                <option value="LGAs">LGAs</option>
                            </select>
                            @error("level")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>



                        <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select wire:model="status" class="form-control @error("status") is-invalid @enderror" id="status">
                                <option value="">--Choose--</option>
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
                            <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal" wire:click='create'>Close</button>
                            <button type="button" wire:click.prevent="store" class="{{ $update ? 'btn btn-success' : 'btn btn-primary' }}">  {{ $update ? 'Update' : 'Add' }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModalsourcefinancing" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete <strong>{{ $delete_confirm? $delete_confirm->name: ''  }}</strong> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" wire:click.prevent="destroy()" class="btn btn-danger close-modal" data-bs-dismiss="modal">Yes, Delete</button>
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
                    $('#modal-sourcefinancing').modal('hide')
                });
                });
    </script>
    @endpush
</div>
