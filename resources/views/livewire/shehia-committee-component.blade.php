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
                    <h3>Manage Shehia Committee </h3>
                </div>
                <div class="col-sm-6 p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg>
                            </a></li>
                        <li class="breadcrumb-item">Shehia Committees</li>
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
                               placeholder="Search shehia committee...">
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-end">
                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                           data-bs-target="#modal-shehiacommittee"
                        ><i class="fa fa-plus"></i> Add shehia committee </a>
                    </div>
                </div>
            </div>
            <div class="table-responsive custom-scrollbar">
                <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                    <thead class="table-light">
                    <tr class="text-capitalize">
                        <th scope="col">SN</th>
                        <th scope="col">Contact person</th>
                        <th scope="col">Municipal council</th>
                        <th scope="col">Shehia</th>
                        <th scope="col">Contact detail</th>
                        <th scope="col">Status</th>
                        <th width="220">Actions</th>
                    </tr>
                    </thead>
                    <tbody x-ref="tbody">
                    @forelse ($shehia_committees as $shehiacommittee)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $shehiacommittee->contact_person }}</td>
                            <td>{{ $shehiacommittee->municipalCouncil->name }}</td>
                            <td>{{ $shehiacommittee->shehia->name }}</td>
                            <td>{{ $shehiacommittee->contact_detail }}</td>
                            <td>
                                <span class="badge {{ $shehiacommittee->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($shehiacommittee->status) }}
                                </span>
                            </td>
                            <td style="display: flex; gap: 5px;">
                                <a href="#" wire:click="edit({{ $shehiacommittee->id }})"
                                   class="btn btn-sm btn-success" data-bs-toggle="modal"
                                   data-bs-target="#modal-shehiacommittee">
                                    Edit </a>
                                <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$shehiacommittee->id}})"
                                   data-bs-toggle="modal" data-bs-target="#deleteModalshehiacommittee">
                                    Delete </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-danger text-center"> No Shehia Committee Found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $shehia_committees->links() }}
            </div>
        </div>
    </div>
    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-shehiacommittee" tabindex="-1" role="dialog"
         aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">@if($update)
                            Update
                        @else
                            Add
                        @endif Shehia Committee</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-4">
                            <label for="contact_person">Contact person</label>
                            <input type="text" wire:model="contact_person"
                                   class="form-control @error("contact_person") is-invalid @enderror"
                                   id="contact_person" placeholder="Enter contact person">
                            @error("contact_person")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-md-6">
                            <label for="municipal_council">Municipal council</label>
                            <select wire:model="municipal_council"
                                    class="form-control @error("municipal_council") is-invalid @enderror"
                                    id="municipal_council">
                                <option value="">--Choose--</option>
                                @foreach($municipal_councils as $municipal_council)
                                    <option value="{{ $municipal_council->id }}">{{ $municipal_council->name }}</option>
                                @endforeach
                            </select>
                            @error("municipal_council")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-md-6">
                            <label for="shehia">Shehia</label>
                            <select wire:model="shehia" class="form-control @error("shehia") is-invalid @enderror"
                                    id="shehia">
                                <option value="">--Choose--</option>
                                @foreach($shehias as $shehia)
                                    <option value="{{ $shehia->id }}">{{ $shehia->name }}</option>
                                @endforeach
                            </select>
                            @error("shehia")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="contact_detail">Contact detail</label>
                            <textarea wire:model="contact_detail" id="contact_detail" rows="2"
                                      class="form-control @error("contact_detail") is-invalid @enderror"></textarea>
                            @error("contact_detail")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="status">Status</label>
                            <select wire:model="status" class="form-control @error("status") is-invalid @enderror"
                                    id="status">
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

                            <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" wire:click.prevent="store" class="btn btn-secondary"> @if($update)
                                    Update
                                @else
                                    Add
                                @endif</button>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModalshehiacommittee" data-backdrop="false" tabindex="-1"
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
                    $('#modal-shehiacommittee').modal('hide')
                });
            });
        </script>
    @endpush
</div>
