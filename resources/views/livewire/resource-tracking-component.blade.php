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
        .card-footer.bg-white {
            border-top: 1px solid #dee2e6;
            background-color: #fff;
            padding: 1rem;
        }

    </style>

<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 p-0">
                <h3>Resource Tracking</h3>
            </div>
            <div class="col-sm-6 p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                            <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a>
                    </li>
                    <li class="breadcrumb-item">Resource Tracking</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid default-dashboard">

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 text-end">
                    <button type="button"  class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>
            <div class="row">


                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="finance_particular">Finance Particular</label>
                    <input type="number" wire:model="finance_particular" class="form-control @error("finance_particular") is-invalid @enderror" id="finance_particular" placeholder="Enter finance Particular" readonly disabled>
                    @error("finance_particular")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="source_financing">Financing Source</label>
                    <input type="number" wire:model="source_financing" class="form-control @error("source_financing") is-invalid @enderror" id="source_financing" placeholder="Enter source Financing" readonly disabled>
                    @error("source_financing")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


             

                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="project">Project</label>
                    <input type="number" wire:model="project" class="form-control @error("project") is-invalid @enderror" id="project" placeholder="Enter project" readonly disabled>
                    @error("project")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                


                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="period">Period</label>
                    <input type="number" wire:model="period" class="form-control @error("period") is-invalid @enderror" id="period" placeholder="Enter period" readonly disabled>
                    @error("period")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>



                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="currency_unit">Currency Unit</label>
                    <input type="number" wire:model="currency_unit" class="form-control @error("currency_unit") is-invalid @enderror" id="currency_unit" placeholder="Enter currency Unit" readonly disabled>
                    @error("currency_unit")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                
              
                
                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="amount">Amount</label>
                    <input type="number" wire:model="amount" class="form-control @error("amount") is-invalid @enderror" id="amount" value="20000" placeholder="Enter Amount" readonly disabled>
                    @error("amount")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-1">
                <div class="col-6">
                    <div class="input-group">
                        <input type="search" wire:model.live="search_keyword" class="form-control form-control-sm w-auto"
                               placeholder="Search resourcetracking...">
                    </div>
                </div>
              
            </div>
                  <!-- Summary Section -->
        <div class="card-footer bg-white mt-3 mb-5">
            <div class="row text-dark">
                <div class="col-md-4">
                    <h5>Total Amount: Government</h5>
                    <p>{{ $totalGovernmentAmount }}</p>
                </div>
                <div class="col-md-4">
                    <h5>Total Amount: Donor</h5>
                    <p>{{ $totalDonorAmount }}</p>
                </div>
                <div class="col-md-4">
                    <h5>Total Amount: All</h5>
                    <p>{{ $totalAmount }}</p>
                </div>
            </div>
        </div>
            <table class="table table-bordered table-sm table-hover table-striped compact">
                <thead class="table-light">
                <tr class="text-uppercase">
                    <th @click="sortByColumn" class="cursor-pointer select-none">SN <span class="float-end text-secondary">&#8645;</span>
                        <th @click="sortByColumn" class="cursor-pointer select-none">Finance Particular <span class="float-end text-secondary">&#8645;</span>
                    </th><th @click="sortByColumn" class="cursor-pointer select-none">Source Financing <span class="float-end text-secondary">&#8645;</span>
                    </th><th @click="sortByColumn" class="cursor-pointer select-none">Project <span class="float-end text-secondary">&#8645;</span>
                    </th><th @click="sortByColumn" class="cursor-pointer select-none">Period <span class="float-end text-secondary">&#8645;</span>
                    </th><th @click="sortByColumn" class="cursor-pointer select-none">Currency Unit <span class="float-end text-secondary">&#8645;</span>
                    </th><th @click="sortByColumn" class="cursor-pointer select-none">Amount <span class="float-end text-secondary">&#8645;</span>
                    </th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody x-ref="tbody">
                @forelse ($resourcetrackings as $resourcetracking)
        
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $resourcetracking->financeParticular->name }}</td>
                    <td>{{ $resourcetracking->sourceFinancing->name }}</td>
                    <td>{{ $resourcetracking->project->project_name }}</td>
                    <td>{{ $resourcetracking->period }}</td>
                    <td>{{ $resourcetracking->currency_unit }}</td>
                    <td>{{ $resourcetracking->amount }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> </a>
                        <a href="#" wire:click="edit({{ $resourcetracking->id }})"
                           class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-resourcetracking">
                            Edit </a>
                        <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$resourcetracking->id}})"
                           data-bs-toggle="modal" data-bs-target="#deleteModalresourcetracking">
                            Delete </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-danger text-center"> No Resource Tracking Found</td>
                </tr>
                @endforelse
                </tbody>
            </table>
      
            {{ $resourcetrackings->links() }}
        </div>
    </div>





    <!-- Implementation Report -->
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 p-0">
                    <h3>Implementation Report</h3>
                </div>
               
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 text-end">
                    <button type="button"  class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>
            <div class="row">


                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="finance_particular">Report</label>
                    <input type="number" wire:model="finance_particular" class="form-control @error("finance_particular") is-invalid @enderror" id="finance_particular" readonly disabled>
                    @error("finance_particular")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="source_financing">Planned</label>
                    <input type="number" wire:model="source_financing" class="form-control @error("source_financing") is-invalid @enderror" id="source_financing" readonly disabled>
                    @error("source_financing")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


             

                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="project">Indicator</label>
                    <input type="number" wire:model="project" class="form-control @error("project") is-invalid @enderror" id="project" readonly disabled>
                    @error("project")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                


                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="period">% of Implementation</label>
                    <input type="number" wire:model="period"  class="form-control @error("period") is-invalid @enderror" id="period" readonly disabled>
                    @error("period")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>



                <div class="mb-4 col-12">
                    <label for="remark">Actual Implementation</label>
                    <textarea wire:model="remark" cols="4" rows="8" class="form-control @error('remark') is-invalid @enderror" id="remark" readonly disabled></textarea>
                    @error("remark")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-12">
                    <label for="remark">Activity which were not Implemented</label>
                    <textarea wire:model="remark" cols="4" rows="8" class="form-control @error('remark') is-invalid @enderror" id="remark" readonly disabled></textarea>
                    @error("remark")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>



                <div class="mb-4 col-12">
                    <label for="remark">Remark</label>
                    <textarea wire:model="remark" cols="4" rows="8" class="form-control @error('remark') is-invalid @enderror" id="remark" readonly disabled></textarea>
                    @error("remark")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="mb-4 col-12">
                    <label for="remark">Write Challenges during the implementation of the program/project for the period of repor</label>
                    <textarea wire:model="remark" cols="4" rows="8" class="form-control @error('remark') is-invalid @enderror" id="remark" readonly disabled></textarea>
                    @error("remark")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="mb-4 col-12">
                    <label for="remark">Rcommendations</label>
                    <textarea wire:model="remark" cols="4" rows="8" class="form-control @error('remark') is-invalid @enderror" id="remark" readonly disabled></textarea>
                    @error("remark")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                
            </div>
            
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-1">
                <div class="col-6">
                    <div class="input-group">
                        <input type="search" wire:model.live="search_keyword" class="form-control form-control-sm w-auto"
                               placeholder="Search resourcetracking...">
                    </div>
                </div>
              
            </div>
       
            <table class="table table-bordered table-sm table-hover table-striped compact">
                <thead class="table-light">
                <tr class="text-uppercase">
                    <th @click="sortByColumn" class="cursor-pointer select-none">SN <span class="float-end text-secondary">&#8645;</span>
                        <th @click="sortByColumn" class="cursor-pointer select-none">Annual Planned Activities <span class="float-end text-secondary">&#8645;</span>
                    </th><th @click="sortByColumn" class="cursor-pointer select-none">Planned Activities for the Quarter <span class="float-end text-secondary">&#8645;</span>
                    </th><th @click="sortByColumn" class="cursor-pointer select-none">Actual Implementation <span class="float-end text-secondary">&#8645;</span>
                    </th><th @click="sortByColumn" class="cursor-pointer select-none">Indicator <span class="float-end text-secondary">&#8645;</span>
                    </th><th @click="sortByColumn" class="cursor-pointer select-none">Baseline <span class="float-end text-secondary">&#8645;</span>
                    </th>
                    
                </tr>
                </thead>
                <tbody x-ref="tbody">
                @forelse ($resourcetrackings as $resourcetracking)
        
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $resourcetracking->financeParticular->name }}</td>
                    <td>{{ $resourcetracking->sourceFinancing->name }}</td>
                    <td>{{ $resourcetracking->project->project_name }}</td>
                    <td>{{ $resourcetracking->period }}</td>
                    <td>{{ $resourcetracking->currency_unit }}</td>
                   
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-danger text-center"> No Resource Tracking Found</td>
                </tr>
                @endforelse
                </tbody>
            </table>
      
            {{ $resourcetrackings->links() }}
        </div>
    </div>





    <!-- Decision Report -->
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 p-0">
                    <h3>Decision Report</h3>
                </div>
                
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 text-end">
                    <button type="button"  class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>
            <div class="row">


                <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                    <label for="finance_particular">Action</label>
                    <input type="number" wire:model="finance_particular" class="form-control @error("finance_particular") is-invalid @enderror" id="finance_particular" readonly disabled>
                    @error("finance_particular")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-12">
                    <label for="remark">Remark</label>
                    <textarea wire:model="remark" cols="4" rows="8" class="form-control @error('remark') is-invalid @enderror" id="remark" readonly disabled></textarea>
                    @error("remark")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
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
