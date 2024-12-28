<div>
    <div class="card">
        <div class="card-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-6 p-0">
                            <h3>Add Financial Disbursing</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                      <!-- Concept Note ID Dropdown -->
                {{-- <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                    <label for="conceptNote">Project Name <span class="text-danger">*</span></label>
                    <input type="text" wire:model="conceptNote" class="form-control @error('conceptNote') is-invalid @enderror" id="conceptNote" value="" readonly disabled>
                    @error("conceptNote")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

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

                    <!-- Outcomes Dropdown -->
                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
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
                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                        <label for="output">Output <span class="text-danger">*</span></label>
                        <select id="output" wire:model='output' class="form-control @error('output') is-invalid @enderror">
                            <option value="">--Choose--</option>
                        </select>
                        @error("output")
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Activities Dropdown -->
                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                        <label for="activity">Activity <span class="text-danger">*</span></label>
                        <select id="activity" wire:model='activity' class="form-control @error('activity') is-invalid @enderror">
                            <option value="">--Choose--</option>
                        </select>
                        @error("activity")
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                        <label for="report_type">Report Type <span class="text-danger">*</span></label>
                        <select id="report_type" wire:model='report_type' class="form-control @error('report_type') is-invalid @enderror">
                            <option value="">--Choose--</option>
                            <option value="Quarter 1">Quarter 1</option>
                            <option value="Quarter 2">Quarter 2</option>
                            <option value="Quarter 3">Quarter 3</option>
                            <option value="Quarter 4">Quarter 4</option>
                        </select>
                        @error("report_type")
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Agreement Reference -->
                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                        <label for="amount">Planned Amount (TZS)<span class="text-danger">*</span></label>
                        <input type="text" wire:model="amount" class="form-control @error('amount') is-invalid @enderror" id="amount" readonly disabled>
                        @error("amount")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                        <label for="total_disburesement">Total Disbursement (TZS)<span class="text-danger">*</span></label>
                        <input type="text" wire:model="total_disburesement" class="form-control @error('total_disburesement') is-invalid @enderror" id="total_disburesement" readonly disabled>
                        @error("total_disburesement")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                        <label for="remained_amount">Remained remained_amount (TZS)<span class="text-danger">*</span></label>
                        <input type="text" wire:model="remained_amount" class="form-control @error('remained_amount') is-invalid @enderror" id="remained_amount" readonly disabled>
                        @error("remained_amount")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                        <label for="requested_amount">Requested Amount TZS<span class="text-danger">*</span></label>
                        <input type="text" wire:model="requested_amount" class="form-control @error('requested_amount') is-invalid @enderror" id="requested_amount" placeholder="Enter Requested Amount">
                        @error("requested_amount")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                        <label for="percent_requested">% Requested <span class="text-danger">*</span></label>
                        <input type="text" wire:model="percent_requested" class="form-control @error('percent_requested') is-invalid @enderror" id="percent_requested" readonly disabled>
                        @error("percent_requested")
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
                        <th scope="col">Project Name </th>
                        <th scope="col">Output </th>
                        <th scope="col">Planned_Amount (TZS) </th>
                        <th scope="col">Requested_Amount  (TZS)</th>
                        <th scope="col">% Requested </th>
                        <th scope="col" width="220">Actions</th>
                    </tr>
                    </thead>
                    <tbody x-ref="tbody">
                    @forelse ($financialImplementations as $financialImplementation)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $financialImplementation->conceptNote->projectname }}</td>
                            <td title="{{ $financialImplementation->output->output }}">{{ Str::limit($financialImplementation->output->output , 30)}}</td>
                            <td>{{ number_format($financialImplementation->proposalActivity->planning_amount, 2, '.', ',') }} TZS</td>
                            <td>{{ number_format($financialImplementation->requested_amount, 2, '.', ',') }} TZS</td>                            
                            <td>{{ $financialImplementation->percent_requested }}%</td>
                            <td style="display: flex; gap:5px;">
                                <a href="#" wire:click="edit({{ $financialImplementation->id }})"
                                   class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-sponsor">
                                    Edit</a>
                                <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$financialImplementation->id}})"
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
                {{ $financialImplementations->links() }}
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


    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

</div>
