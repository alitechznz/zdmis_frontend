<div x-data="data()" class="m-2">

<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 p-0">
                <h3>Manage Sectors</h3>
            </div>
            {{-- <div class="col-sm-6 p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                    <li class="breadcrumb-item">Sectors</li>
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
                               placeholder="Search sector...">
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-end">
                        @can('add sector')
                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-sector" wire:click='create'
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
                        <th @click="sortByColumn" class="cursor-pointer select-none">Sector_Name <span class="float-end text-secondary">&#8645;</span>
                        <th @click="sortByColumn" class="cursor-pointer select-none">Ministry <span class="float-end text-secondary">&#8645;</span>
                        </th><th @click="sortByColumn" class="cursor-pointer select-none">Status <span class="float-end text-secondary">&#8645;</span>
                        </th>
                        <th width="220">Actions</th>
                    </tr>
                    </thead>
                    <tbody x-ref="tbody">
                    @forelse ($sectors as $sector)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $sector->name }}</td>
                            <td>{{ $sector->responsibleUser?->name }}</td>
                            <td>
                                <span class="badge {{ $sector->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($sector->status) }}
                                </span>
                            </td>
                            <td style="display: flex; gap:5px;">
                                @can('edit sector')
                                <a href="#" wire:click="edit({{ $sector->id }})"
                                    class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-sector">
                                     Edit </a>
                                @endcan

                                @can('delete sector')
                                <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$sector->id}})"
                                    data-bs-toggle="modal" data-bs-target="#deleteModalsector">
                                     Delete </a>
                                @endcan
                               
                               
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-danger text-center"> No Sector Found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $sectors->links() }}
            </div>
        </div>
    </div>

</div>







    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-sector" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">@if($update) Update @else Add @endif Sector</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div  class="row">
                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="name">Sector Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" class="form-control @error("name") is-invalid @enderror" id="name" placeholder="Enter sector name">
                            @error("name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div><div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="ministry">Ministry <span class="text-danger">*</span></label>
                            <select wire:model="ministry" class="form-control @error("ministry") is-invalid @enderror" id="ministry">
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
    <div wire:ignore.self class="modal fade" id="deleteModalsector" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                    $('#modal-sector').modal('hide')
                });
            });
        </script>
    @endpush
</div>
