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
                <h3>Manage Financing Agreements</h3>
            </div>
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
                               placeholder="Search financing agreement...">
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-end">
                        {{-- <a href="{{ route('add-financing-agreements') }}" class="btn btn-sm btn-primary" ><i class="fa fa-plus"></i> Add Financing Agreement </a> --}}
                    </div>
        
                </div>
            </div>

            <div class="table-responsive custom-scrollbar">
                <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                    <thead class="table-light">
                    <tr class="text-capitalize">
                        <th scope="col">SN </th>
                        <th scope="col">Concept_Note_itle </th>
                        <th scope="col">Project_Code </th>
                        <th scope="col">Submitted_Date </th>
                        <th scope="col">Financing_Status </th>
                        <th scope="col">Funding_Agency </th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody x-ref="tbody">
                    @forelse ($conceptNotes as $conceptNote)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $conceptNote->projectname ?? 'Not added' }}</td>
                        <td>{{ $conceptNote->projectcode ?? 'Not added' }}</td>
                        <td>{{ $conceptNote->created_at ?? 'Not added' }}</td>
                        <td>{{ $conceptNote->finacing_status ?? 'Not Assigned' }}</td>
                        <td>{{ $conceptNote->funding_agency ?? 'Not Assigned' }}</td>
                        <td style="display: flex; gap:5px;">
                            @can('add financing agreement')
                            <a href="{{ route('add-financing-agreements', ['conceptNoteId' => $conceptNote->id]) }}" class="btn btn-sm btn-success">
                                Add Financing Agreement
                            </a> 
                            @endcan
                            
                            @can('view financing agreement')
                            <a href="#" class="btn btn-sm btn-info" wire:click="deleteConfirm({{$conceptNote->id}})">
                                View</a>
                            @endcan
                           
                        </td>
                    </tr>
                    
                    @empty
                        <tr>
                            <td colspan="8" class="text-danger text-center"> No Data Found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{-- {{ $sponsors->links() }} --}}
            </div>

        </div>
    </div>
</div>
   

    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-sponsor" tabindex="-1" role="dialog"
         aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">@if($update)
                            Update
                        @else
                            Add
                        @endif Sponsor</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="org_name">Organization name</label>
                            <input type="text" wire:model="org_name"
                                   class="form-control @error("org_name") is-invalid @enderror" id="org_name" placeholder="Enter Organization Name">
                            @error("org_name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="short_name">Short Name</label>
                            <input type="text" wire:model="short_name"
                                   class="form-control @error("short_name") is-invalid @enderror" id="short_name" placeholder="Enter Short Name">
                            @error("short_name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="country">Country</label>
                            <select wire:model="country" class="form-control @error("country") is-invalid @enderror"
                                    id="country">
                                <option value="">--Choose--</option>
                                {{-- @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach --}}
                            </select>
                            @error("country")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="organization_category">Organization Category</label>
                            <select wire:model="organization_category" class="form-control @error("organization_category") is-invalid @enderror"
                                    id="organization_category">
                                <option value="">--Choose--</option>
                                <option value="Non Governement Organization (NGO)">Non Governement Organization (NGO)</option>
                                <option value="Private Sector">Private Sector</option>
                                <option value="Donor Agency">Donor Agency</option>
                                <option value="Government">Government</option>
                            </select>
                            @error("organization_category")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="mb-4 col-sm-12 col-md-12 col-lg-12">
                            <label for="contact_person">Contact person</label>
                            <input type="text" wire:model="contact_person"
                                   class="form-control @error("contact_person") is-invalid @enderror"
                                   id="contact_person" placeholder="Enter Contact Person Name">
                            @error("contact_person")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="mb-4 col-sm-12 col-md-12 col-lg-12" xmlns="http://www.w3.org/1999/html">
                            <label for="contact_details">Contact details</label>
                            <textarea wire:model="contact_details"
                                      class="form-control @error("contact_details") is-invalid @enderror"
                                      id="contact_details" cols="4" rows="6" placeholder="Enter Contact details">
                            </textarea>
                            @error("contact_details")
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
    <div wire:ignore.self class="modal fade" id="deleteModalsponsor" data-backdrop="false" tabindex="-1" role="dialog"
         aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete <strong>{{ $delete_confirm? $delete_confirm->org_name: ''  }}</strong> ?
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
                    $('#modal-sponsor').modal('hide')
                });
            });
        </script>
    @endpush
</div>
