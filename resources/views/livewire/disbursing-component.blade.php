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
                <h3>Manage Disbursing</h3>
            </div>
            {{-- <div class="col-sm-6 p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                            <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a>
                    </li>
                    <li class="breadcrumb-item">Disbursing</li>
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
                        {{-- <div class="row">
                            <div class="col-sm-6 p-0">
                                <h3>Financing Agreement Disbursement</h3>
                            </div>
                        </div> --}}
                    </div>
                    <div class="row">
                         <!-- Concept Note ID Dropdown -->
                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                        <label for="conceptNote">Project <span class="text-danger">*</span></label>
                        <input type="text" wire:model="conceptNote" class="form-control @error('conceptNote') is-invalid @enderror" id="conceptNoteId"  readonly disabled>
                        @error("conceptNote")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                        <label for="conceptNote">Actual Date <span class="text-danger">*</span></label>
                        <input type="date" wire:model="conceptNote" class="form-control @error('conceptNote') is-invalid @enderror" id="conceptNoteId">
                        @error("conceptNote")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                        <label for="installment_type">Installment Type <span class="text-danger">*</span></label>
                        <select wire:model="installment_type" class="form-control @error('installment_type') is-invalid @enderror" id="installment_type">
                            <option value="">--Select Installment Type--</option>
                            <option value="1st Installment">1st Installment</option>
                            <option value="2nd Installment">2nd Installment</option>
                            <option value="3rd Installment">3rd Installment</option>
                            <option value="4th Installment">4th Installment</option>
                            <option value="5th Installment">5th Installment</option>
                        </select>
                        @error("installment_type")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                        <label for="amount">Amount <span class="text-danger">*</span></label>
                        <input type="text" wire:model="amount" class="form-control @error('amount') is-invalid @enderror" id="amount" oninput="formatNumber(this)" onkeypress="return isNumberKey(event)" placeholder="Enter amount">
                        @error("amount")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                        <label for="amount">% of Total <span class="text-danger">*</span></label>
                        <input type="number" wire:model="amount" class="form-control @error('amount') is-invalid @enderror" id="amount" placeholder="Enter % of Total">
                        @error("amount")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                        <label for="financing_agreement_dis">Current Disbursement Status <span class="text-danger">*</span></label>
                        <select wire:model="financing_agreement_dis" class="form-control @error('financing_agreement_dis') is-invalid @enderror" id="financing_agreement_dis">
                            <option value="">--Select Status--</option>
                            <option value="Pending">Pending</option>
                            <option value="Released">Released</option>
                            <option value="Delayed">Delayed</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                        @error("financing_agreement_dis")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                        <label for="amount">Certificate Number <span class="text-danger">*</span></label>
                        <input type="text" wire:model="amount" class="form-control @error('amount') is-invalid @enderror" id="amount" placeholder="Enter Certificate Number">
                        @error("amount")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                        <label for="amount">E-Office Reference Number <span class="text-danger">*</span></label>
                        <input type="text" wire:model="amount" class="form-control @error('amount') is-invalid @enderror" id="amount" placeholder="Enter E-Office Reference No">
                        @error("amount")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                        <label for="amount">Disbursement Condition <span class="text-danger">*</span></label>
                        <input type="text" wire:model="amount" class="form-control @error('amount') is-invalid @enderror" id="amount" placeholder="Enter Disbursement Condition">
                        @error("amount")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                        <label>Is it available in e-office attachment?</label>
                        <div class="d-flex align-items-center">
                            <!-- Checkbox for Yes -->
                            <div class="form-check me-3">
                                <input type="checkbox" class="form-check-input" id="yesAvailable" value="yes">
                                <label class="form-check-label" for="yesAvailable">Yes</label>
                            </div>
                            
                            <!-- Checkbox for No -->
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="noAvailable" value="no">
                                <label class="form-check-label" for="noAvailable">No</label>
                            </div>
                        </div>
                        @error("eOfficeAttachmentAvailable")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    

                    <div class="mb-4 col-sm-12 col-md-12 col-lg-12">
                        <label for="milestone_type">Verification Status <span class="text-danger">*</span></label>
                        <select wire:model="milestone_type" class="form-control @error('milestone_type') is-invalid @enderror" id="milestone_type">
                            <option value="">--Select Verification Status--</option>
                            <option value="Verified">Verified</option>
                            <option value="Not Verified">Not Verified</option>
                        </select>
                        @error("milestone_type")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                        
                        
                        <!-- Submit Button -->
                        <div class="col-12 text-end">
                            <button type="button" wire:click.prevent="storeDisbursementSchedule" class="btn btn-success">
                                 Add
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive custom-scrollbar">
                    <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm mt-5">
                        <thead class="table-light">
                        <tr class="text-capitalize">
                            <th scope="col">SN </th>
                            <th scope="col">Project </th>
                            <th scope="col">Actual_Date </th>
                            <th scope="col">%_of_Total </th>
                            <th scope="col">Amount </th>
                            <th scope="col">Certificate_No </th>
                            <th scope="col">Current_Disbursement_Status </th>
                            <th scope="col">Certificate_No </th>
                            <th scope="col">E-Office_Reference_No </th>
                            <th scope="col">Verification_Status </th>
                            <th scope="col" width="220">Actions</th>
                            
                        </tr>
                        </thead>
                        <tbody x-ref="tbody">
                        {{-- @forelse ($financingAgreementDisburbasments as $financingAgreementDisburbasment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $financingAgreementDisburbasment->conceptNote->projectname }}</td>
                                <td>{{ $financingAgreementDisburbasment->financeAgreement->agreement_title }}</td>
                                <td>{{ $financingAgreementDisburbasment->milestone_type }}</td>
                                <td>{{ $financingAgreementDisburbasment->schedule_date ?? 'Not Set' }}</td>
                                <td>{{ $financingAgreementDisburbasment->condition ?? 'Not set' }}</td>
                                <td>{{ $financingAgreementDisburbasment->installment_type }}</td>
                                <td>{{ $financingAgreementDisburbasment->amount }}</td>
                                
                                 <td style="display: flex; gap:5px;">
                                   
                                    <a href="#" wire:click="editDisbursementSchedule({{ $financingAgreementDisburbasment->id }})" class="btn btn-sm btn-success">
                                        Edit
                                    </a>                                
                                    <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirmDisbursement({{$financingAgreementDisburbasment->id}})"
                                       data-bs-toggle="modal" data-bs-target="#deleteModalDisbursement">
                                        Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-danger text-center"> No Data Found</td>
                            </tr>
                        @endforelse --}}
                        </tbody>
                    </table>
                    {{-- {{ $financingAgreementDisburbasments->links() }} --}}
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
        var yesCheckbox = document.getElementById('yesAvailable');
        var noCheckbox = document.getElementById('noAvailable');
    
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



<script>
    $(document).ready(function () {
        $('#milestone_type').change(function () {
            var selectedType = $(this).val();
            // Hide all fields initially
            $('#scheduled_date_container').hide();
            $('#condition_container').hide();

            // Show the appropriate field based on the selection
            if (selectedType === 'time') {
                $('#scheduled_date_container').show();
            } else if (selectedType === 'condition') {
                $('#condition_container').show();
            }
        });
    });
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
