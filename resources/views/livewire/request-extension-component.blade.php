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
                <h3>Request Extension</h3>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid default-dashboard">
    <div class="card">
        <div class="card-body">
        <div class="container-fluid">
            <div class="row" wire:ignore>

                <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                    <label for="concept_note">Project Name <span class="text-danger">*</span></label>
                    <select wire:model="concept_note" class="form-control @error('concept_note') is-invalid @enderror" id="concept_note">
                        <option value="">--Select Project Name--</option>
                        @foreach ($projects as $data)
                            <option value="{{ $data->id }}">{{ $data->projectname }}</option>
                        @endforeach
                    </select>
                    @error("concept_note")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                   <!-- Project code -->
                <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                    <label for="project_code">Project Code<span class="text-danger">*</span></label>
                    <input type="text" wire:model="project_code" class="form-control @error('project_code') is-invalid @enderror" id="project_code" readonly disabled>
                    @error("project_code")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>



                <div class="mb-4 col-sm-12 col-md-12 col-lg-12 extension_type">
                    <label for="extension_type">Extension Type <span class="text-danger">*</span></label>
                    <select wire:model="extension_type" class="form-control @error('extension_type') is-invalid @enderror" id="extension_type">
                        <option value="">--Select Extension Type--</option>
                        <option value="Scope">Scope</option>
                        <option value="Budget">Budget</option>
                        <option value="Time">Time</option>
                    </select>
                    @error("extension_type")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                    <!-- Outcomes Dropdown -->
                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6 outcome-div">
                        <label for="outcome">Outcome <span class="text-danger">*</span></label>
                        <select id="outcome" wire:model='outcome' class="form-control @error('outcome') is-invalid @enderror">
                            <option value="">--Choose--</option>
                            @foreach ($outcomes as $outcome)
                                <option value="{{ $outcome->id }}">{{ $outcome->name }}</option>
                            @endforeach
                        </select>
                        @error("outcome")
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Outputs Dropdown -->
                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6 output-div">
                        <label for="output">Output <span class="text-danger">*</span></label>
                        <select id="output" wire:model='output' class="form-control @error('output') is-invalid @enderror">
                            <option value="">--Choose--</option>
                        </select>
                        @error("output")
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Activities Dropdown -->
                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6 activity-div">
                        <label for="activity">Activity <span class="text-danger">*</span></label>
                        <select id="activity" wire:model='activity' class="form-control @error('activity') is-invalid @enderror">
                            <option value="">--Choose--</option>
                        </select>
                        @error("activity")
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Agreement Reference -->
                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6 planned-amount-div">
                        <label for="amount">Planned Amount (TZS)<span class="text-danger">*</span></label>
                        <input type="text" wire:model="amount" class="form-control @error('amount') is-invalid @enderror" id="amount" readonly disabled>
                        @error("amount")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                <div class="mb-4 col-sm-6 col-md-6 col-lg-6 extended-type-div">
                    <label for="extended_type">Extended Type <span class="text-danger">*</span></label>
                    <select wire:model="extended_type" class="form-control @error('extended_type') is-invalid @enderror" id="extended_type">
                        <option value="">--Select Extended Type--</option>
                        <option value="Incresement">Incresement</option>
                        <option value="Decresement">Decresement</option>
                    </select>
                    @error("extended_type")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6 new-requested-amount-div">
                        <label for="new_requested_amount">New Requested Amount TZS<span class="text-danger">*</span></label>
                        <input type="text" wire:model="new_requested_amount" class="form-control @error('new_requested_amount') is-invalid @enderror" id="new_requested_amount" oninput="formatNumber(this)" onkeypress="return isNumberKey(event)" placeholder="Enter Requested Amount">
                        @error("new_requested_amount")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6 supporting-document-div">
                        <label for="supporting_document">Supporting Document </label>
                        <input type="file" wire:model="supporting_document" class="form-control @error('supporting_document') is-invalid @enderror" id="supporting_document">
                        @error("supporting_document")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6 expected-end-date-div">
                        <label for="expected_end_date">Expected End Date <span class="text-danger">*</span></label>
                        <input type="date" wire:model="expected_end_date" class="form-control @error('expected_end_date') is-invalid @enderror" id="expected_end_date" placeholder="Choose Date">
                        @error("expected_end_date")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 col-sm-12 col-md-12 col-lg-12 remark-div">
                        <label for="remark">Remark </label>
                        <textarea  wire:model="remark" rows="4" class="form-control @error('remark') is-invalid @enderror" id="remark" placeholder="Enter Remark"></textarea>
                        @error("remark")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                   

                    <!-- Submit Button -->
                    <div class="col-12 text-end">
                        <button type="button" wire:click.prevent="store" class="{{ $update ? 'btn btn-success' : 'btn btn-primary' }}">  {{ $update ? 'Update' : 'Add' }}</button>
                    </div>

                </div>
            </div>



            <div class="table-responsive custom-scrollbar">
                <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm mt-5">
                    <thead class="table-light">
                    <tr class="text-capitalize">
                        <th scope="col">SN </th>
                        <th scope="col">Project_Name </th>
                        <th scope="col">Outcome </th>
                        <th scope="col">Output </th>
                        <th scope="col">Activity </th>
                        <th scope="col">Planned_Amount (TZS) </th>
                        <th scope="col">Requested_Amount  (TZS)</th>
                        <th scope="col">Extension_Type </th>
                        <th scope="col">Remark </th>
                        <th scope="col" width="220">Actions</th>
                    </tr>
                    </thead>
                    <tbody x-ref="tbody">
                    @forelse ($requestExtensions as $requestExtension)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $requestExtension->conceptNote->projectname ?? 'N/A' }}</td>
                            <td>{{ $requestExtension->outcome ? Str::limit($requestExtension->outcome->name, 30) : 'N/A' }}</td>
                            <td>{{ $requestExtension->output ? Str::limit($requestExtension->output->output, 30) : 'N/A' }}</td>
                            <td>{{ $requestExtension->proposalActivity ? $requestExtension->proposalActivity->activity_name : 'N/A' }}</td>
                            <td>{{ number_format($requestExtension->proposalActivity ? $requestExtension->proposalActivity->planning_amount : 0, 2, '.', ',') }} TZS</td>
                            <td>{{ number_format($requestExtension->new_requested_amount ?? 0, 2, '.', ',') }} TZS</td>
                            <td>{{ $requestExtension->extension_type }}</td>
                            <td title="{{ $requestExtension->remark ? Str::limit($requestExtension->remark , 30) : 'N/A' }}">{{ Str::limit($requestExtension->remark , 30) }}</td>                            
                            <td style="display: flex; gap:5px;">
                                <a href="#" wire:click="edit({{ $requestExtension->id }})"
                                   class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-sponsor">
                                    Edit</a>

                                    
                                <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$requestExtension->id}})"
                                   data-bs-toggle="modal" data-bs-target="#deleteModalFinancial">
                                    Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-danger text-center"> No Data Found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $requestExtensions->links() }}
            </div>

        </div>
    </div>


        <!-- Delete Modal finacing agreement attachement-->
        <div wire:ignore.self class="modal fade" id="deleteModalFinancial" data-backdrop="false" tabindex="-1" role="dialog"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
                </div>
                <div class="modal-body">
                    {{-- <p>Are you sure want to delete <strong>{{ $delete_confirm? $delete_confirm->attachment_title: ''  }}</strong> ?
                    </p> --}}
                    <p>Are you sure want to delete ?</p>
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
   document.addEventListener('DOMContentLoaded', function() {
    const extensionTypeSelect = document.getElementById('extension_type');
    const conceptNoteSelect = document.getElementById('concept_note');
    const projectCodeInput = document.getElementById('project_code');
    const remarkDiv = document.querySelector('.remark-div');
    const supportingDocumentDiv = document.querySelector('.supporting-document-div');
    const newRequestedAmountDiv = document.querySelector('.new-requested-amount-div');
    const outcomeDiv = document.querySelector('.outcome-div');
    const outputDiv = document.querySelector('.output-div');
    const activityDiv = document.querySelector('.activity-div');
    const plannedAmountDiv = document.querySelector('.planned-amount-div');
    const extendedTypeDiv = document.querySelector('.extended-type-div');
    const expectedEndDateDiv = document.querySelector('.expected-end-date-div');

   
    // Hide all fields initially
    function hideAllFields() {
        remarkDiv.style.display = 'none';
        supportingDocumentDiv.style.display = 'none';
        newRequestedAmountDiv.style.display = 'none';
        outcomeDiv.style.display = 'none';
        outputDiv.style.display = 'none';
        activityDiv.style.display = 'none';
        plannedAmountDiv.style.display = 'none';
        extendedTypeDiv.style.display = 'none';
        expectedEndDateDiv.style.display = 'none';
    }

    // Show fields based on extension type selected
    function showFieldsBasedOnType(extensionType) {
        hideAllFields(); // Ensure all fields are hidden before showing relevant ones
        remarkDiv.style.display = '';
        supportingDocumentDiv.style.display = '';

        switch(extensionType) {
            case 'Scope':
                break;
            case 'Budget':
                newRequestedAmountDiv.style.display = '';
                outcomeDiv.style.display = '';
                outputDiv.style.display = '';
                activityDiv.style.display = '';
                plannedAmountDiv.style.display = '';
                break;
            case 'Time':
                extendedTypeDiv.style.display = '';
                expectedEndDateDiv.style.display = '';
                break;
        }
    }

    // Listen for changes in the extension type and adjust fields
    extensionTypeSelect.addEventListener('change', function() {
        showFieldsBasedOnType(this.value);
    });

    // Ensure proper handling of fields when Livewire re-renders parts of the component
    document.body.addEventListener('livewire:update', function() {
        showFieldsBasedOnType(extensionTypeSelect.value);
    });

    // Fetch project code when a concept note is selected
    conceptNoteSelect.addEventListener('change', function() {
        const conceptNoteId = this.value;
        fetch(`get-project-code/${conceptNoteId}`)
            .then(response => response.json())
            .then(data => {
                projectCodeInput.value = data.project_code || 'Not Available';
            })
            .catch(error => {
                console.error('Error fetching project code:', error);
                projectCodeInput.value = 'Error loading code';
            });
    });

    // Re-evaluate fields initially on page load
    if (extensionTypeSelect.value) {
        showFieldsBasedOnType(extensionTypeSelect.value);
    } else {
        hideAllFields();
    }



    const outcomeSelect = document.getElementById('outcome');
    const outputSelect = document.getElementById('output');
    const activitySelect = document.getElementById('activity');
    const amountInput = document.getElementById('amount');
    const requestedAmountInput = document.getElementById('requested_amount');
    const percentRequestedInput = document.getElementById('percent_requested');


    outcomeSelect.addEventListener('change', function() {
              fetch(`outcomes/${this.value}/outputs`)
                  .then(response => response.json())
                  .then(data => {
                      outputSelect.innerHTML = '<option value="">--Choose--</option>';
                      data.forEach(output => {
                          outputSelect.innerHTML += `<option value="${output.id}">${output.output}</option>`;
                      });
                  });
          });
      
          outputSelect.addEventListener('change', function() {
              fetch(`outputs/${this.value}/activities`)
                  .then(response => {
                      if (!response.ok) {
                          throw new Error('Network response was not ok');
                      }
                      return response.json();
                  })
                  .then(data => {
                      activitySelect.innerHTML = '<option value="">--Choose--</option>';
                      data.forEach(activity => {
                          activitySelect.innerHTML += `<option value="${activity.id}" data-planning-amount="${activity.planning_amount}">${activity.activity_name}</option>`;
                      });
                  })
                  .catch(error => {
                      console.error('Error fetching activities:', error);
                      activitySelect.innerHTML = '<option value="">Error loading activities</option>';
                  });
          });
      
          // Listener for activity select change
          activitySelect.addEventListener('change', function() {
              const selectedOption = this.options[this.selectedIndex];
              const planningAmount = selectedOption.getAttribute('data-planning-amount') || '0';
              amountInput.value = planningAmount;
              calculatePercentRequested();  // Recalculate percentage when activity changes
          });
      
          // Listener for changes in requested amount
          requestedAmountInput.addEventListener('input', calculatePercentRequested);
      
          // Function to calculate and update percent requested
          function calculatePercentRequested() {
    const plannedAmount = parseFloat(amountInput.value.replace(/,/g, ''));
    const requestedAmount = parseFloat(requestedAmountInput.value);
    if (!isNaN(plannedAmount) && !isNaN(requestedAmount) && plannedAmount > 0) {
        const percentRequested = (requestedAmount / plannedAmount) * 100;
        // percentRequestedInput.value = percentRequested.toFixed(2);
        percentRequestedInput.value = percentRequested;
        // Trigger change event
        percentRequestedInput.dispatchEvent(new Event('input'));
    } else {
        percentRequestedInput.value = '';
        // Ensure to also trigger the change event when clearing the value
        percentRequestedInput.dispatchEvent(new Event('input'));
    }
}

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

