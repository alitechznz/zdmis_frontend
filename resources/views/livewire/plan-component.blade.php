<div x-data="data()" class="m-0">
    <div class="row my-3">
        <div class="col-md-6">
            <div class="input-group">
                <input type="search" wire:model.live="search_keyword" class="form-control form-control-sm w-auto" placeholder="Search plan...">
            </div>
        </div>
        <div class="col-md-6">
            <div class="float-end">
                @can('view plan')
                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-plan" wire:click.prevent="create">
                    <i class="fa fa-plus"></i> Add New
                </a>
                @endcan

            </div>
        </div>
    </div>


    <div class="table-responsive custom-scrollbar">
        <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
            <thead class="table-light">
            <tr class="text-capitalize">
                <th scope="col">SN </th>
                <th scope="col">Plan_Name </th>
                <th scope="col">Short_Name </th>
                <th scope="col">Start_date</th>
                <th scope="col">End_date</th>
                <th scope="col">Status </th>
                <th scope="col">Description </th>
                <th width="220">Actions</th>
            </tr>
            </thead>
            <tbody x-ref="tbody">
            @forelse ($plans as $plan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td title="{{ $plan->name }}">{{ Str::limit($plan->name, 35, '...') }}</td>
                <td>{{ $plan->code }}</td>
                <td>{{ $plan->start_date->format('d F, Y') }}</td>
                <td>{{ $plan->end_date->format('d F, Y') }}</td>
                <td>
                    <span class="badge {{ $plan->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                        {{ $plan->status }}
                    </span>
                </td>
                <td title="{{ $plan->description }}">{{ Str::limit($plan->description, 35, '...') }}</td>
                <td style="display: flex; gap: 5px;">
                    @can('edit plan')
                    <a href="#" wire:click="edit({{ $plan->id }})"
                        class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-plan">
                         Edit </a>
                    @endcan
                    @can('delete plan')
                    <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$plan->id}})"
                        data-bs-toggle="modal" data-bs-target="#deleteModalplan">
                         Delete </a>
                    @endcan


                </td>
            </tr>

            @empty
                <tr>
                    <td colspan="8" class="text-danger text-center"> No Plan Found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ $plans->links() }}
    </div>

    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-plan" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">@if($update) Update @else Add @endif Plan</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div  class="row">
                        <div class="mb-4  col-6">
                            <label for="name">Plan Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" class="form-control @error("name") is-invalid @enderror" id="name" placeholder="Enter name">
                            @error("name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-6">
                            <label for="code">Short name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="code" class="form-control @error("code") is-invalid @enderror" id="code" placeholder="Enter code">
                            @error("code")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-6">
                            <label for="start_date">Start  <span class="text-danger">*</span></label>
                            <input type="date" wire:model="start_date" class="form-control @error("start_date") is-invalid @enderror" id="start_date" placeholder="Choose Start date">
                            @error("start_date")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div><div class="mb-4 col-6">
                            <label for="end_date">End date <span class="text-danger">*</span></label>
                            <input type="date" wire:model="end_date" class="form-control @error("end_date") is-invalid @enderror" id="end_date" placeholder="Choose End date">
                            @error("end_date")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-12" xmlns="http://www.w3.org/1999/html">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea wire:model="description" class="form-control @error("description") is-invalid @enderror" id="description" placeholder="Type your description">
                            </textarea>
                            @error("description")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="modal-footer float-end">
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
    <div wire:ignore.self class="modal fade" id="deleteModalplan" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var today = new Date(); // Get today's date
        var dd = String(today.getDate()).padStart(2, '0'); // Add leading zero if needed
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based, add 1 and leading zero
        var yyyy = today.getFullYear(); // Get full year
        today = yyyy + '-' + mm + '-' + dd; // Format date as YYYY-MM-DD

        // Set the min attribute for the date input field
        var startDateInput = document.getElementById('start_date');
        var endDateInput = document.getElementById('end_date');
        startDateInput.setAttribute('min', today);
        endDateInput.setAttribute('min', today);
    });
    </script>


    @push('scripts')
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.on('closeModal', (event) => {
                    $('#modal-plan').modal('hide')
                });
            });
        </script>
    @endpush
</div>
