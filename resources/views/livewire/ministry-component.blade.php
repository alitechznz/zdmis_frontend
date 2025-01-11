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
                    <h3>Manage Ministry </h3>
                </div>
                {{-- <div class="col-sm-6 p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg>
                            </a></li>
                        <li class="breadcrumb-item">Ministries</li>
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
                               placeholder="Search ministry...">
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-end">
                        @can('add ministry')
                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modal-ministry" wire:click='create'
                     ><i class="fa fa-plus"></i> Add New </a>
                        @endcan
                      
                    </div>

                </div>
            </div>
            <div class="table-responsive custom-scrollbar">
                <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                    <thead class="table-light">
                    <tr class="text-capitalize">
                        <th scope="col">SN
                        <th scope="col">Ministry_Name
                        <th scope="col">Short_Name
                        <th scope="col">Phone
                        <th scope="col">Email
                        <th scope="col">Address
                        <th scope="col" width="220">Actions</th>
                    </tr>
                    </thead>
                    <tbody x-ref="tbody">
                    @forelse ($ministries as $ministry)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ministry->name }}</td>
                            <td>{{ $ministry->short_name }}</td>
                            <td>{{ $ministry->phone }}</td>
                            <td>{{ $ministry->email }}</td>
                            <td>{{ $ministry->address }}</td>
                            <td style="display: flex; gap: 5px;">
                                @can('edit ministry')
                                <a href="#" wire:click="edit({{ $ministry->id }})"
                                    class="btn btn-sm btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modal-ministry">
                                     Edit</a>
                                @endcan
                                @can('delete ministry')
                                <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$ministry->id}})"
                                    data-bs-toggle="modal" data-bs-target="#deleteModalministry">
                                     Delete</a>
                                @endcan
                                
                               
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-danger text-center"> No Ministry Found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $ministries->links() }}
            </div>
        </div>
    </div>
    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-ministry" tabindex="-1" role="dialog"
         aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">@if($update)
                            Update
                        @else
                            Add
                        @endif Ministry</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="name">Ministry Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name"
                                   class="form-control @error("name") is-invalid @enderror" id="name" placeholder="Enter Ministry Name">
                            @error("name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="mb-4  col-md-6 col-sm-6 col-lg-6">
                            <label for="short_name">Short Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="short_name"
                                   class="form-control @error("short_name") is-invalid @enderror" id="short_name" placeholder="Enter Short Name">
                            @error("short_name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="awamu">Vote Number <span class="text-danger">*</span></label>
                            <input type="text" wire:model="vote_number"
                                   class="form-control @error("vote_number") is-invalid @enderror" id="vote_number" placeholder="Enter Vote Number">
                            @error("vote_number")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="phone">Phone <span class="text-danger">*</span></label>
                            <input type="number" wire:model="phone"
                                   class="form-control @error("phone") is-invalid @enderror" id="phone" placeholder="Enter Phone Number" pattern="\d{10}" title="Phone number must be exactly 10 digits.">
                            @error("phone")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>




                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="text" wire:model="email"
                                   class="form-control @error("email") is-invalid @enderror" id="email" placeholder="Enter Email Address">
                            @error("email")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="web_url">Website Link </label>
                            <input type="text" wire:model="web_url"
                                   class="form-control @error("web_url") is-invalid @enderror" id="web_url" placeholder="eg www.zips.co.tz">
                            @error("web_url")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="mb-4 col-md-12 col-sm-12 col-lg-12" xmlns="http://www.w3.org/1999/html">
                            <label for="address">Address <span class="text-danger">*</span></label>
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
    <div wire:ignore.self class="modal fade" id="deleteModalministry" data-backdrop="false" tabindex="-1" role="dialog"
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

<script>
    document.getElementById('phone').addEventListener('input', function () {
        var phoneInput = this.value.slice(0, 10); // Limit characters to 10 digits
        this.value = phoneInput;
    });
    </script>


    @push('scripts')
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.
                on('closeModal', (event) => {
                    $('#modal-ministry').modal('hide')
                });
            });
        </script>
    @endpush
</div>
