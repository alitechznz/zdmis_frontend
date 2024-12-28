
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
                <h3>Manage Implementation Report</h3>
            </div>
            <div class="col-sm-6 p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                            <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a>
                    </li>
                    <li class="breadcrumb-item">Implementation Report</li>
                </ol>
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
                               placeholder="Search resource tracking...">
                    </div>
                </div>
                

                   
                <div class="col-6">


                    <div class="float-end">
                        @can('add resource')
                        <a href="{{ route('add-resource-tracking') }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-plus"></i> Add New
                        </a>
                        @endcan
                       
                        @can('print resource')
                        <a href="{{ route('add-resource-tracking') }}" class="btn btn-sm btn-light text-dark active">
                            <i class="fa fa-print"></i> Print Report
                        </a>
                        @endcan
                       

                    </div>
                </div>
               
            </div>
            <table class="table table-bordered table-sm table-hover table-striped compact">
                <thead class="table-light">
                <tr class="text-uppercase">
                    <th @click="sortByColumn" class="cursor-pointer select-none">SN <span class="float-end text-secondary">&#8645;</span>
                        <th @click="sortByColumn" class="cursor-pointer select-none">Project_Title <span class="float-end text-secondary">&#8645;</span>
                    </th>
                    
                    <th @click="sortByColumn" class="cursor-pointer select-none">Quartely_Period <span class="float-end text-secondary">&#8645;</span>
                    </th>
                    
                    <th @click="sortByColumn" class="cursor-pointer select-none">Resource_Tracking <span class="float-end text-secondary">&#8645;</span>
                    </th>
                   

                    <th width="220">Actions</th>
                </tr>
                </thead>
                <tbody x-ref="tbody">
             
                <tr>
                    <td>1</td>
                    <td>Construction</td>
                    <td>Annually</td>
                    <td>Tracked</td>
                 
                    <td>
                       @can('view resource')
                        <a href="{{ route('resource-tracking') }}"
                        class="btn btn-sm btn-info">View </a>
                       @endcan
                       
                              
                    </td>
                </tr>
             
                </tbody>
            </table>
        </div>
    </div>
</div>







 
    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-resourcetracking" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Add Resource Tracking</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div  class="row">
                        


                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="finance_particular">Finance Particular</label>
                            <select wire:model="finance_particular" class="form-control @error("finance_particular") is-invalid @enderror" id="finance_particular">
                                <option value="">--Choose--</option>
                                @foreach ($finance_particulars as $finance_particular)
                                    <option value="{{ $finance_particular->id }}">{{ $finance_particular->name }}</option>
                                @endforeach
                            </select>
                            @error("finance_particular")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        
                  

                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="source_financing">Source Financing</label>
                            <select wire:model="source_financing" class="form-control @error("source_financing") is-invalid @enderror" id="source_financing">
                                <option value="">--Choose--</option>
                                @foreach ($source_finances as $source_finance)
                                    <option value="{{ $source_finance->id }}">{{ $source_finance->name }}</option>
                                @endforeach
                            </select>
                            @error("source_financing")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="project">Project</label>
                            <select wire:model="project" class="form-control @error("project") is-invalid @enderror" id="project">
                                <option value="">--Choose--</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                            @error("project")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        

                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="period">Period</label>
                            <select wire:model="period" class="form-control @error("period") is-invalid @enderror" id="period">
                                <option value="">--Choose--</option>
                                <option value="Q1">Q1</option>
                                <option value="Q2">Q2</option>
                            </select>
                            @error("period")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="currency_unit">Currency Unit</label>
                            <select wire:model="currency_unit" class="form-control @error("currency_unit") is-invalid @enderror" id="currency_unit">
                                <option value="">--Choose--</option>
                                <option value="Tsh">Tsh</option>
                            </select>
                            @error("currency_unit")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                      
                        
                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="amount">Amount</label>
                            <input type="number" wire:model="amount" class="form-control @error("amount") is-invalid @enderror" id="amount" placeholder="Enter Amount">
                            @error("amount")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal">Close</button>
                            <button type="button" wire:click.prevent="store" class="btn btn-secondary"> Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModalresourcetracking" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
                </div>
                <div class="modal-body">
                    {{-- <p>Are you sure want to delete <strong>{{ $delete_confirm? $delete_confirm->name: ''  }}</strong> ?</p> --}}
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
                    $('#modal-resourcetracking').modal('hide')
                });
                });
    </script>
    @endpush
</div>
