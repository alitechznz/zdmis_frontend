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
                <h3>Monitoring Form</h3>
            </div>
            {{-- <div class="col-sm-6 p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                            <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a>
                    </li>
                    <li class="breadcrumb-item">Monitoring Form</li>
                </ol>
            </div> --}}
        </div>
    </div>
</div>

<div class="container-fluid default-dashboard">


    <div class="card">
        <div class="card-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-6 p-0">
                            <h3>Monitoring</h3>
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="project">Project Title <span class="text-danger">*</span></label>
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
                    <label for="amount">Responsible Ministry/Instituition <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error("amount") is-invalid @enderror" id="amount" readonly disabled>
                    @error("amount")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="amount">Project Financing (Total Project Cost) Tsh <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error("amount") is-invalid @enderror" id="amount" readonly disabled>
                    @error("amount")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="ministry">Reporting Period <span class="text-danger">*</span></label>
                    <select wire:model="ministry" class="form-control @error("ministry") is-invalid @enderror" id="ministry">
                        <option value="">--Choose--</option>
                            <option value="Annually">Annually</option>
                            <option value="Quarter 1">Quarter 1</option>
                            <option value="Quarter 2">Quarter 2</option>
                            <option value="Quarter 3">Quarter 3</option>
                            <option value="Quarter 4">Quarter 4</option>
                    </select>
                    @error("ministry")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="mb-4 col-12">
                    <label for="remark">Project Commencement Date <span class="text-danger">*</span></label>
                    <textarea wire:model="remark"  cols="4" rows="8" class="form-control @error('remark') is-invalid @enderror" id="remark" placeholder="Enter the Project Commencement"></textarea>
                    @error("remark")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="amount">Project Expected Ending Date (as per Contract) <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error("amount") is-invalid @enderror" id="amount" placeholder="Enter Project Expected Ending Date (as per Contract)">
                    @error("amount")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="amount">Name of Contractor (if Construction Project) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error("amount") is-invalid @enderror" id="amount" placeholder="Enter Name of Contractor (if Construction Project)">
                    @error("amount")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="amount">Name of Consultants/Consulting Company <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error("amount") is-invalid @enderror" id="amount" placeholder="Enter Name of Consultants/Consulting Company">
                    @error("amount")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="amount">Date of Award of all project <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error("amount") is-invalid @enderror" id="amount" placeholder="Enter Date of Award of all project">
                    @error("amount")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="amount">Total amount Disbursed Unit <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error("amount") is-invalid @enderror" id="amount" oninput="formatNumber(this)" onkeypress="return isNumberKey(event)" placeholder="Enter Total amount Disbursed Unit">
                    @error("amount")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>



                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="amount">The Amount you Planned request for January - March 2022 <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error("amount") is-invalid @enderror" id="amount" oninput="formatNumber(this)" onkeypress="return isNumberKey(event)" placeholder="Enter The Amount you Planned request for January - March 2022">
                    @error("amount")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                    <label for="amount">Total Amount Disbursed for January - March 2022 <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error("amount") is-invalid @enderror" id="amount" oninput="formatNumber(this)" onkeypress="return isNumberKey(event)" placeholder="Enter Total Amount Disbursed for January - March 2022">
                    @error("amount")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


            </div>
            <div class="row">
                <div class="col-12 text-end">
                    <button type="button" wire:click.prevent="store" class="btn btn-primary">Save</button>
                </div>
            </div>


           
                <div class="table-responsive custom-scrollbar my-3">
                    <table class="table table-bordered table-sm table-hover table-striped compact">
                        <thead class="table-light">
                        <tr class="text-capitalize">
                            <th @click="sortByColumn" class="cursor-pointer select-none">SN <span class="float-end text-secondary">&#8645;</span>
                                <th @click="sortByColumn" class="cursor-pointer select-none">Project_Title<span class="float-end text-secondary">&#8645;</span>
                            </th>
                            
                            <th @click="sortByColumn" class="cursor-pointer select-none">Responsible_Ministry <span class="float-end text-secondary">&#8645;</span>
                            </th>
                            
                            <th @click="sortByColumn" class="cursor-pointer select-none">Project_Financing <span class="float-end text-secondary">&#8645;</span>
                            </th>
        
                            <th @click="sortByColumn" class="cursor-pointer select-none">Reporting_Period <span class="float-end text-secondary">&#8645;</span>
                            </th>
    
                            <th @click="sortByColumn" class="cursor-pointer select-none">Project_Commencement <span class="float-end text-secondary">&#8645;</span>
                            </th>
                           
        
                            <th width="220">Actions</th>
                        </tr>
                        </thead>
                        <tbody x-ref="tbody">
                     
                        <tr>
                            <td>1</td>
                            <td>Title A</td>
                            <td>ZFDA</td>
                            <td>20, 000, 000, 000</td>
                            <td>Annually</td>
                            <td>Comment A</td>
                         
                            <td style="display: flex; gap: 5px;">
                               @can('edit monitoring')
                                <a href=""
                                class="btn btn-sm btn-success">Edit </a>
                               @endcan
                               

                                   @can('delete monitoring')
                                    <a href="" class="btn btn-sm btn-danger">
                                        Delete</a>
                                   @endcan
                           
                            </td>
                        </tr>
                     
                        </tbody>
                    </table>
                </div>
        </div>
    </div>





   
    <div class="card mt-5">
        <div class="card-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-6 p-0">
                            <h3>Implementation Checking</h3>
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="row">
                
                <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                    <label for="source_financing">Planned Activities <span class="text-danger">*</span></label>
                    <select wire:model="source_financing" class="form-control @error("source_financing") is-invalid @enderror" id="source_financing">
                        <option value="">--Choose--</option>
                            <option value="Activity One">Activity One</option>
                            <option value="Activity Two">Activity Two</option>
                            <option value="Activity Three">Activity Thee</option>
                    </select>
                    @error("source_financing")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        {{-- <label for="implemented">Implemented</label> --}}
                        <div class="d-flex align-items-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="implemented_yes" value="Implemented" wire:model="implemented">
                                <label class="form-check-label" for="implemented_yes">Implemented</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="implemented_no" value="Not Implemented" wire:model="not_implemented">
                                <label class="form-check-label" for="implemented_no">Not Implemented</label>
                            </div>
                        </div>
                    </div>
                </div>

               

                  
                <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                    <label for="amount">% of Implementation <span class="text-danger">*</span></label>
                    <input type="text" wire:model="amount" class="form-control @error("amount") is-invalid @enderror" id="amount" placeholder="Enter % of Implementation">
                    @error("amount")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-12">
                    <label for="remark">Implementation Remark <span class="text-danger">*</span></label>
                    <textarea wire:model="remark" cols="4" rows="6" class="form-control @error('remark') is-invalid @enderror" id="remark" placeholder="Enter the Implementation Remark"></textarea>
                    @error("remark")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

               
                <div class="row mb-3">
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <label>Result Led to the Planned Output? <span class="text-danger">*</span></label>
                        <div class="d-flex align-items-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="yesCheck" value="Yes"  wire:model="result_output_yes">
                                <label class="form-check-label" for="result_output_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="noCheck" value="No" wire:model="result_output_no">
                                <label class="form-check-label" for="result_output_no">No</label>
                            </div>
                        </div>
                    </div>
                </div>

                   

                <div class="mb-4 col-12">
                    <label for="remark">Evidence Result <span class="text-danger">*</span></label>
                    <textarea wire:model="remark" cols="4" rows="6" class="form-control @error('remark') is-invalid @enderror" id="remark" placeholder="Enter the Evidence Result"></textarea>
                    @error("remark")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="row my-3">
                    <div class="col-12 text-end">
                        <button type="button" wire:click.prevent="store" class="btn btn-primary">Save</button>
                    </div>
                </div>
                
                <div class="table-responsive custom-scrollbar">
                    <table class="table table-bordered table-sm table-hover table-striped compact">
                        <thead class="table-light">
                        <tr class="text-capitalize">
                            <th @click="sortByColumn" class="cursor-pointer select-none">SN <span class="float-end text-secondary">&#8645;</span>
                                <th @click="sortByColumn" class="cursor-pointer select-none">Annual_Planned_Activities <span class="float-end text-secondary">&#8645;</span>
                            </th>
                            
                            <th @click="sortByColumn" class="cursor-pointer select-none">Planned Activities_for_the_Quarter <span class="float-end text-secondary">&#8645;</span>
                            </th>
                            
                            <th @click="sortByColumn" class="cursor-pointer select-none">Actual_Implementation <span class="float-end text-secondary">&#8645;</span>
                            </th>
        
                            <th @click="sortByColumn" class="cursor-pointer select-none">Indicator <span class="float-end text-secondary">&#8645;</span>
                            </th>
    
                            <th @click="sortByColumn" class="cursor-pointer select-none">Baseline <span class="float-end text-secondary">&#8645;</span>
                            </th>
                           
        
                            <th width="220">Actions</th>
                        </tr>
                        </thead>
                        <tbody x-ref="tbody">
                     
                        <tr>
                            <td>1</td>
                            <td>Particular A</td>
                            <td>Source A</td>
                            <td>Quertely</td>
                            <td>Amount</td>
                            <td>Baseline</td>
                         
                            <td style="display: flex; gap: 5px;">
                               @can('edit implementation checking')
                                <a href=""
                                class="btn btn-sm btn-success">Edit </a>
                               @endcan
                                

                                   @can('delete implementation checking')
                                    <a href="" class="btn btn-sm btn-danger">
                                        Delete</a>
                                   @endcan
                               
                            </td>
                        </tr>
                     
                        </tbody>
                    </table>
                  

                </div>

            </div>
          
        </div>
    </div>


    <div class="card mt-5">
        <div class="card-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-6 p-0">
                            <h3>Challenges & Recommendations</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-4 col-12">
                        <label for="remark">What are Challenges Faced the Project? <span class="text-danger">*</span></label>
                        <textarea wire:model="remark" cols="4" rows="6" class="form-control @error('remark') is-invalid @enderror" id="remark" placeholder="Enter project Challenges...."></textarea>
                        @error("remark")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="mb-4 col-12">
                        <label for="remark">Which Measures taken to overcome those Challenges? <span class="text-danger">*</span></label>
                        <textarea wire:model="remark" cols="4" rows="6" class="form-control @error('remark') is-invalid @enderror" id="remark" placeholder="Enter Measures take to overcome challenges....."></textarea>
                        @error("remark")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="row">
                    <div class="mb-4 col-12">
                        <label for="remark">What lesson learnt before and during the implementation of the project? <span class="text-danger">*</span></label>
                        <textarea wire:model="remark" cols="4" rows="6" class="form-control @error('remark') is-invalid @enderror" id="remark" placeholder="Enter lesson learnt....."></textarea>
                        @error("remark")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="row">
                    <div class="mb-4 col-12">
                        <label for="remark">What is your Recommendation? <span class="text-danger">*</span></label>
                        <textarea wire:model="remark" cols="4" rows="6" class="form-control @error('remark') is-invalid @enderror" id="remark" placeholder="Enter your Recommendation......"></textarea>
                        @error("remark")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="row">
                    <!-- Buttons with Icons -->
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-primary">
                            Save
                            {{-- <i class="fa fa-paper-plane"></i> Save --}}
                        </button>
                    </div>
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
    function isNumberKey(evt) {
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      // Allow only numeric keys and backspace, delete, left & right arrows, enter and tab
      if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode < 96 || charCode > 105) && [8, 37, 39, 46, 9, 13].indexOf(charCode) === -1)
          return false;
      return true;
  }
  
  function formatNumber(input) {
      let value = input.value.replace(/,/g, '');
      let formatted = Number(value).toLocaleString();
      if (!isNaN(parseFloat(value)) && isFinite(value)) {
          input.value = formatted;
      }
  }
  
  </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var yesCheckbox = document.getElementById('yesCheck');
        var noCheckbox = document.getElementById('noCheck');
    
        yesCheckbox.addEventListener('change', function() {
            if (this.checked) {
                noCheckbox.checked = false;
            }
        });
    
        noCheckbox.addEventListener('change', function() {
            if (this.checked) {
                yesCheckbox.checked = false;
            }
        });
    });
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
