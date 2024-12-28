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
                <h3>Manage Project Calender</h3>
            </div>
            {{-- <div class="col-sm-6 p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                    <li class="breadcrumb-item">Project Calender</li>
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
                               placeholder="Search project calender...">
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-end">
                        @can('add zpc calendar')
                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-projectcalender" wire:click='create'
                        ><i class="fa fa-plus"></i> Add New </a>
                        @endcan
                       
                    </div>
        
                </div>
    
               
            </div>

            <div class="table-responsive custom-scrollbar">
                <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                    <thead class="table-light">
                    <tr class="text-capitalize">
                        <th @click="sortByColumn" class="cursor-pointer select-none">SN <span class="float-end text-secondary">&#8645;</span>
                        </th>
                        <th @click="sortByColumn" class="cursor-pointer select-none">Calender_Activity <span class="float-end text-secondary">&#8645;</span>
                        </th>
    
                        <th @click="sortByColumn" class="cursor-pointer select-none">Start_date <span class="float-end text-secondary">&#8645;</span>
                        </th>
    
                        <th @click="sortByColumn" class="cursor-pointer select-none">End_date <span class="float-end text-secondary">&#8645;</span>
                        </th>
                        
                        <th width="220">Actions</th>
                    </tr>
                    </thead>
                    <tbody x-ref="tbody">
                    @forelse ($projectcalenders as $projectcalender)
            
                    <tr>
                        
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $projectcalender->activity }}</td>
                        <td>{{ $projectcalender->startdate }}</td>
                        <td>{{ $projectcalender->enddate }}</td>
                       
                        <td style="display: flex; gap:5px;">
                            @can('edit zpc calendar')
                            <a href="#" wire:click="edit({{ $projectcalender->id }})"
                                class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-projectcalender">
                                 Edit </a>
                            @endcan

                            @can('delete zpc calendar')
                            <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$projectcalender->id}})"
                                data-bs-toggle="modal" data-bs-target="#deleteModalprojectcalender">
                                 Delete </a>
                            @endcan
                            
                           
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-danger text-center"> No Project Calender Found</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $projectcalenders->links() }}
            </div>

        </div>
    </div>
 
</div>




  
    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-projectcalender" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">@if($update) Update @else Add @endif Project Calender</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div  class="row">
                        

                        <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                            <label for="plan">Calender Activity <span class="text-danger">*</span></label>
                            <select wire:model="activity" class="form-control @error("activity") is-invalid @enderror" id="activity">
                                <option value="">--Choose--</option>
                                <option value="Concept Note Submission">Concept Note Submission</option>
                                <option value="Concept Note Screening">Concept Note Screening</option>
                                <option value="Project Proposal Submission">Project Proposal Submission</option>
                                <option value="Project Appraisal">Project Appraisal</option>
                                <option value="Re-Submission">Re-Submission</option>
                                <option value="Re-appraisal">Re-appraisal</option>
                                <option value="Release of List Approved">Release of List Approved</option>
                                <option value="Quarter 1 M & E Report">Quarter 1 M & E Report</option>
                                <option value="Quarter 2 M & E Report">Quarter 2 M & E Report</option>
                                <option value="Quarter 3 M & E Report">Quarter 3 M & E Report</option>
                                <option value="Quarter 4 M & E Report">Quarter 4 M & E Report</option>
                            </select>
                            </select>
                            @error("activity")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                       <!-- Start Date Field -->
                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="start_date">Start date <span class="text-danger">*</span></label>
                            <input type="date" wire:model="startdate" class="form-control @error('startdate') is-invalid @enderror" id="start_date" placeholder="Choose Start Date">
                            @error("startdate")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

        

                        <!-- End Date Field -->
                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="end_date">End date <span class="text-danger">*</span></label>
                            <input type="date" wire:model="enddate" class="form-control @error('enddate') is-invalid @enderror" id="end_date" placeholder="Choose End Date">
                            @error("enddate")
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
    <div wire:ignore.self class="modal fade" id="deleteModalprojectcalender" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
        var startDateInput = document.getElementById('startdate');
        var endDateInput = document.getElementById('enddate');
        startDateInput.setAttribute('min', today);
        endDateInput.setAttribute('min', today);
    });
    </script>

        
    @push('scripts')
    <script>
       document.addEventListener('livewire:initialized', () => {
                @this.on('closeModal', (event) => {
                    $('#modal-projectcalender').modal('hide')
                });
                });
    </script>
    @endpush
</div>
