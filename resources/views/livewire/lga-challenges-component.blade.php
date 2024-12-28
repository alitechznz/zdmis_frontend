<div x-data="data()" class="m-2">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 p-0">
                    <h3>Manage Challenges</h3>
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
                            <input type="search" wire:model="search_keyword" class="form-control form-control-sm w-auto" placeholder="Search challenges...">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="float-end">
                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-budgetterm" wire:click='create'>
                                <i class="fa fa-plus"></i> Add New
                            </a>

                        </div>
                    </div>
                </div>

                <div class="table-responsive custom-scrollbar">
                    <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                        <thead class="table-light">
                        <tr class="text-capitalize">
                            <th>SN</th>
                            <th>Title</th>
                            <th>District</th>
                            <th>Shehia</th>
                            <th>Reported_Date</th>
                            <th>Priority</th>
                            <th>Sector</th>
                            <th>Status</th>
                            <th width="220">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($lga_challenges as $lga_challenge)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $lga_challenge->title }}</td>
                                <td>{{ $lga_challenge->district->name }}</td>
                                <td>{{ $lga_challenge->shehia->name }}</td>
                                <td>{{ $lga_challenge->date_identified->format('d F, Y') }}</td>
                                <td>{{ $lga_challenge->priority_level }}</td>
                                <td>{{ $lga_challenge->sector->name }}</td>
                                <td>
                                    {{ ucfirst($lga_challenge->status) }}
                                </td>
                                <td style="display: flex; gap:5px;">

                                    @can('edit budget form')
                                        <a href="#" wire:click="edit({{ $lga_challenge->id }})" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-budgetterm">Edit</a>
                                    @endcan

                                    @can('delete budget form')
                                        <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{ $lga_challenge->id }})" data-bs-toggle="modal" data-bs-target="#deleteModalbudgetterm">Delete</a>
                                    @endcan

                                        @can('edit budget form')
                                            <a href="#" wire:click="downloadAttachment({{ $lga_challenge->id }})" class="btn btn-sm btn-success">Download</a>
                                        @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-danger">No Budget Term Found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $lga_challenges->links() }}
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-budgetterm" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">{{ $update ? 'Update' : 'Add' }} Challenge</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">


                        <div class="mb-4 col-12">
                            <label for="title">Title <span class="text-danger">*</span></label>
                            <textarea wire:model="title"  rows="3" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter Title"></textarea>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="date_identified">Date Identified<span class="text-danger">*</span></label>
                            <input type="date" wire:model="date_identified" class="form-control @error('date_identified') is-invalid @enderror" id="date_identified" placeholder="Choose  Date">
                            @error('date_identified')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="identified_by">Identified By <span class="text-danger">*</span></label>
                            <input type="text" wire:model="identified_by_name" class="form-control @error('identified_by_id') is-invalid @enderror" id="identified_by" placeholder="Enter identified by" readonly disabled>
                            @error('identified_by_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="district">District <span class="text-danger">*</span></label>
                            <select wire:model="district" id="district" class="form-control @error('district') is-invalid @enderror">
                                <option value="">--Choose--</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                            @error('district')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="shehia">Shehia <span class="text-danger">*</span></label>
                            <select wire:model="shehia" id="shehia" class="form-control @error('shehia') is-invalid @enderror">
                                <option value="">--Choose--</option>
                            </select>
                            @error('shehia')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="priority_level">Priority Level <span class="text-danger">*</span></label>
                            <select wire:model="priority_level" class="form-control @error("priority_level") is-invalid @enderror" id="priority_level">
                                <option value="">--Choose--</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                            @error("priority_level")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select wire:model="status" class="form-control @error("status") is-invalid @enderror" id="status">
                                <option value="">--Choose--</option>
                                <option value="Identified">Identified</option>
                                <option value="Under Review">Under Review</option>
                                <option value="Approved For Project Development">Approved For Project Development</option>
                                <option value="Declined">Declined</option>
                            </select>
                            @error("status")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="sector">Sector/Impact Area <span class="text-danger">*</span></label>
                            <select wire:model="sector" class="form-control @error("sector") is-invalid @enderror" id="sector">
                                <option value="">--Choose--</option>

                                @foreach($sectors as $sector)
                                    <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                @endforeach
                            </select>
                            @error("sector")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="attachment">Attachement <span class="text-danger">*</span></label>
                            <input type="file" wire:model="attachment" class="form-control @error('attachment') is-invalid @enderror" id="attachment" placeholder="Choose File">
                            @error('attachment')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-4 col-12">
                            <label for="potential_solution">Potential Solution <span class="text-danger">*</span></label>
                            <textarea wire:model="potential_solution" rows="3" class="form-control @error('potential_solution') is-invalid @enderror" id="potential_solution" placeholder="Enter potential solution"></textarea>
                            @error('potential_solution')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-4 col-12">
                            <label for="resource_needed">Resource Needed <span class="text-danger">*</span></label>
                            <textarea wire:model="resource_needed"  rows="3" class="form-control @error('resource_needed') is-invalid @enderror" id="resource_needed" placeholder="Enter Resources Needed. e.g Finacial, Human, Material"></textarea>
                            @error('resource_needed')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 col-12">
                            <label for="community_feedback">Community Feedback <span class="text-danger">*</span></label>
                            <textarea wire:model="community_feedback"  rows="3" class="form-control @error('community_feedback') is-invalid @enderror" id="community_feedback" placeholder="Enter Community Feedback"></textarea>
                            @error('community_feedback')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>




                        <div class="mb-4 col-12">
                            <label for="expected_outcome">Expected Outcome <span class="text-danger">*</span></label>
                            <textarea wire:model="expected_outcome"  rows="3" class="form-control @error('expected_outcome') is-invalid @enderror" id="expected_outcome" placeholder="Enter Expected Outcome"></textarea>
                            @error('expected_outcome')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 col-12">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea wire:model="description"  rows="3" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Enter description"></textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal">Close</button>
                        <button type="button" wire:click.prevent="store" class="{{ $update ? 'btn btn-success' : 'btn btn-primary' }}">  {{ $update ? 'Update' : 'Add' }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModalbudgetterm" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div the="modal-header">
                    <h5 class="modal-title">Delete Confirm</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete <strong>{{ $delete_confirm ? $delete_confirm->year : '' }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" wire:click.prevent="destroy()" class="btn btn-danger close-modal" data-bs-dismiss="modal">Yes, Delete</button>
                </div>
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
    document.addEventListener('DOMContentLoaded', function () {
        const districtSelect = document.getElementById('district');
        const shehiaSelect = document.getElementById('shehia');

        districtSelect.addEventListener('change', function() {
            const districtId = this.value;
            shehiaSelect.innerHTML = '<option value="">Loading...</option>';

            fetch(`shehias/${districtId}`)  // Make sure to provide the correct route
                .then(response => response.json())
                .then(data => {
                    let options = '<option value="">--Choose--</option>';
                    data.forEach(shehia => {
                        options += `<option value="${shehia.id}">${shehia.name}</option>`;
                    });
                    shehiaSelect.innerHTML = options;
                })
                .catch(error => {
                    console.error('Error fetching shehias:', error);
                    shehiaSelect.innerHTML = '<option value="">--Choose--</option>';
                });
        });
    });
</script>

@push('scripts')
    <script>
        window.livewire.on('closeModal', () => {
            $('#modal-budgetterm').modal('hide')
        })
    </script>
    @endpush
    </div>
