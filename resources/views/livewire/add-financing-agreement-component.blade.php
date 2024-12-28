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
                <h3>Financing Agreements</h3>
            </div>
            {{-- <div class="col-sm-6 p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                            <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a>
                    </li>
                    <li class="breadcrumb-item">Financing Agreements</li>
                </ol>
            </div> --}}
        </div>
    </div>
</div>

<div class="container-fluid default-dashboard">

    <!-- Add Financing agreement Form -->

    <div class="container-fluid default-dashboard">
        <div class="card">
            <div class="card-body">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6 p-0">
                                <h3>Add Financing Agreement</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Concept Note ID Dropdown -->
                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="concept_note">Concept Note <span class="text-danger">*</span></label>
                            <input type="text" wire:model="conceptNote" class="form-control @error('conceptNote') is-invalid @enderror" id="concept_note" value="{{ $conceptNote }}" readonly disabled>
                            @error("conceptNote")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Agreement Title -->
                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="agreement_title">Agreement Title <span class="text-danger">*</span></label>
                            <input type="text" wire:model="agreement_title" class="form-control @error('agreement_title') is-invalid @enderror" id="agreement_title" placeholder="Enter Agreement Title">
                            @error("agreement_title")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Agreement Reference -->
                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="agreement_reference">Agreement Reference <span class="text-danger">*</span></label>
                            <input type="text" wire:model="agreement_reference" class="form-control @error('agreement_reference') is-invalid @enderror" id="agreement_reference" placeholder="Enter Agreement Reference">
                            @error("agreement_reference")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Funding Agency -->
                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="funding_agency">Funding Agency <span class="text-danger">*</span></label>
                            <input type="text" wire:model="funding_agency" class="form-control @error('funding_agency') is-invalid @enderror" id="funding_agency" placeholder="Enter Funding Agency">
                            @error("funding_agency")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                      <!-- Total Funding Amount -->
                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="total_funding_amount">Total Funding Amount <span class="text-danger">*</span></label>
                            <input type="text" wire:model="total_funding_amount" class="form-control @error('total_funding_amount') is-invalid @enderror"
                                id="total_funding_amount" placeholder="Enter Total Funding Amount" oninput="formatNumber(this)" onkeypress="return isNumberKey(event)">
                            @error("total_funding_amount")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Currency -->

                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="currency">Currency <span class="text-danger">*</span></label>
                            <select wire:model="currency" class="form-control @error('currency') is-invalid @enderror" id="currency">
                                <option value="">--Select Currency--</option>
                                <option value="Tzs">TZS</option>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                                <option value="Others">Others</option>
                            </select>
                            @error("currency")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Terms Agreement Start Date -->
                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="terms_agreement_start_date">Terms Agreement Start Date <span class="text-danger">*</span></label>
                            <input type="date" wire:model="terms_agreement_start_date" class="form-control @error('terms_agreement_start_date') is-invalid @enderror" id="terms_agreement_start_date">
                            @error("terms_agreement_start_date")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Terms Agreement End Date -->
                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="terms_agreement_end_date">Terms Agreement End Date <span class="text-danger">*</span></label>
                            <input type="date" wire:model="terms_agreement_end_date" class="form-control @error('terms_agreement_end_date') is-invalid @enderror" id="terms_agreement_end_date">
                            @error("terms_agreement_end_date")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Interest Rate -->
                        <div class="mb-4 col-sm-12 col-md-12 col-lg-12">
                            <label for="interest_rate">Interest Rate <span class="text-danger">*</span></label>
                            <input type="text" wire:model="interest_rate" class="form-control @error('interest_rate') is-invalid @enderror" id="interest_rate" placeholder="Enter Interest Rate">
                            @error("interest_rate")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                            <!-- Conditions Precedent -->
                        <div class="mb-4 col-sm-12 col-md-12 col-lg-12">
                            <label for="conditions_precedent">Conditions Precedent <span class="text-danger">*</span></label>
                            <textarea wire:model="conditions_precedent" id="conditions_precedent" cols="30" rows="4" class="form-control @error('conditions_precedent') is-invalid @enderror" placeholder="Enter Conditions Precedent"></textarea>
                            @error("conditions_precedent")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                          <!-- Repayment Terms -->
                          <div class="mb-4 col-sm-12 col-md-12 col-lg-12">
                            <label for="repayment_terms">Repayment Terms <span class="text-danger">*</span></label>
                            <textarea wire:model="repayment_terms" id="repayment_terms" cols="30" rows="4" class="form-control @error('repayment_terms') is-invalid @enderror" placeholder="Enter Repayment Terms"></textarea>
                            @error("repayment_terms")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Termination Clause -->
                        <div class="mb-4 col-sm-12 col-md-12 col-lg-12">
                            <label for="termination_clause">Termination Clause <span class="text-danger">*</span></label>
                            <textarea wire:model="termination_clause" id="termination_clause" cols="30" rows="4" class="form-control @error('termination_clause') is-invalid @enderror" placeholder="Enter Termination Clause"></textarea>
                            @error("termination_clause")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->

                        <div class="col-12 text-end">
                            <button type="button" wire:click.prevent="store" class="{{ $update ? 'btn btn-success' : 'btn btn-primary' }}">  {{ $update ? 'Update' : 'Add' }}</button>
                        </div>
                    </div>


                        <div class="table-responsive custom-scrollbar">
                            <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm mt-5">
                                <thead class="table-light">
                                <tr class="text-capitalize">
                                    <th scope="col">SN </th>
                                    <th scope="col">Concept_Note </th>
                                    <th scope="col">Agreement_Title </th>
                                    <th scope="col">Agreement_Reference </th>
                                    <th scope="col">Funding_Agency </th>
                                    <th scope="col">Total_Funding_Amount </th>
                                    <th scope="col">Currency </th>
                                    <th scope="col">Start_Date</th>
                                    <th scope="col">End_Date</th>
                                    <th scope="col" width="220">Actions</th>
                                </tr>
                                </thead>
                                <tbody x-ref="tbody">
                                @forelse ($financingAgreements as $financingAgreement)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $financingAgreement->conceptNote->projectname }}</td>
                                        <td>{{ $financingAgreement->agreement_title }}</td>
                                        <td>{{ $financingAgreement->agreement_reference }}</td>
                                        <td>{{ $financingAgreement->funding_agency }}</td>
                                        <td>{{ number_format($financingAgreement->total_funding_amount, 0, '.', ',') }}</td>
                                        <td>{{ $financingAgreement->currency }}</td>
                                        <td>
                                            {{ $financingAgreement->formatted_terms_agreement_start_date }}
                                        </td>
                                        <td>
                                            {{ $financingAgreement->formatted_terms_agreement_end_date }}
                                        </td>
                                        <td style="display: flex; gap:5px;">
                                            @can('edit financing agreement')
                                            <a href="#" wire:click="edit({{ $financingAgreement->id }})"
                                                class="btn btn-sm btn-success">
                                                 Edit</a>
                                            @endcan

                                                @can('delete financing agreement')
                                                <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$financingAgreement->id}})"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModalFinancingAgreement">
                                                     Delete</a>
                                                @endcan

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-danger text-center"> No Financing Agreement Found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            {{ $financingAgreements->links() }}
                        </div>

            </div>
        </div>

    </div>


        <!-- Add Financing agreement Attachment Form -->
        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6 p-0">
                                <h3>Add Financing Agreement Attachments</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                          <!-- Concept Note ID Dropdown -->
                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                        <label for="conceptNote">Concept Note <span class="text-danger">*</span></label>
                        <input type="text" wire:model="conceptNote" class="form-control @error('conceptNote') is-invalid @enderror" id="conceptNote" value="{{ $conceptNote }}" readonly disabled>
                        @error("conceptNote")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                        <!-- Agreement Title -->
                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="attachment_title">Attachment Title <span class="text-danger">*</span></label>
                            <input type="text" wire:model="attachment_title" class="form-control @error('attachment_title') is-invalid @enderror" id="attachment_title" placeholder="Enter Agreement Title">
                            @error("attachment_title")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="financing_agreement">Financing Agreement <span class="text-danger">*</span></label>
                            <select wire:model="financing_agreement" class="form-control @error('financing_agreement') is-invalid @enderror" id="financing_agreement">
                                <option value="">--Select Financing Agreement--</option>
                                @foreach ($financing_agreements as $financing_agreement)
                                <option value="{{ $financing_agreement->id }}">{{ $financing_agreement->agreement_title }}</option>
                                @endforeach
                            </select>
                            @error("financing_agreement")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <!-- Agreement Reference -->
                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="attachment">Attach File <span class="text-danger">*</span></label>
                            <input type="file" wire:model="attachment" class="form-control @error('attachment') is-invalid @enderror" id="attachment">
                            @error("attachment")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 text-end">
                            <button type="button" wire:click.prevent="storeFinancingAgreementAttachment" class="btn btn-success">
                                {{-- <i class="fa fa-paper-plane"></i> {{ $finance_doc_id ? 'Update' : 'Submit' }} --}}
                               {{ $finance_doc_id ? 'Update' : 'Add' }}
                            </button>
                        </div>

                    </div>
                </div>



                <div class="table-responsive custom-scrollbar">
                    <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm mt-5">
                        <thead class="table-light">
                        <tr class="text-capitalize">
                            <th scope="col">SN </th>
                            <th scope="col">Concept_Note </th>
                            <th scope="col">Financing_Agreement </th>
                            <th scope="col">Attachment_Title </th>
                            <th scope="col">Attachment </th>
                            <th scope="col" width="220">Actions</th>
                        </tr>
                        </thead>
                        <tbody x-ref="tbody">
                        @forelse ($financingAgreementAttachments as $financingAgreementAttachment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $financingAgreementAttachment->conceptNote->projectname }}</td>
                                <td>{{ $financingAgreementAttachment->financeAgreement->agreement_title }}</td>
                                <td>{{ $financingAgreementAttachment->attachment_title }}</td>
                                <td>{{ $financingAgreementAttachment->status }}</td>
                                <td style="display: flex; gap:5px;">
                                    <a href="#" wire:click="editFinancingAgreementAttachment({{ $financingAgreementAttachment->id }})"
                                       class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-sponsor">
                                        Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirmAttachment({{$financingAgreementAttachment->id}})"
                                       data-bs-toggle="modal" data-bs-target="#deleteModalAttachment">
                                        Delete</a>

                                    <a href="#" wire:click="downloadAttachment({{ $financingAgreementAttachment->id }})" class="btn btn-sm btn-success">Download</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-danger text-center"> No Financing Agreement Attachment Found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $financingAgreementAttachments->links() }}
                </div>

            </div>
        </div>









        <!-- Add Financing agreement disbursement Form -->
        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6 p-0">
                                <h3>Add Financing Agreement Disbursement</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                         <!-- Concept Note ID Dropdown -->
                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                        <label for="conceptNote">Concept Note <span class="text-danger">*</span></label>
                        <input type="text" wire:model="conceptNote" class="form-control @error('conceptNote') is-invalid @enderror" id="conceptNoteId" value="{{ $conceptNote }}" readonly disabled>
                        @error("conceptNote")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                        <label for="financing_agreement_dis">Financing Agreement <span class="text-danger">*</span></label>
                        <select wire:model="financing_agreement_dis" class="form-control @error('financing_agreement_dis') is-invalid @enderror" id="financing_agreement_dis">
                            <option value="">--Select Financing Agreement--</option>
                            @foreach ($financing_agreements as $financing_agreement)
                            <option value="{{ $financing_agreement->id }}">{{ $financing_agreement->agreement_title }}</option>
                            @endforeach
                        </select>
                        @error("financing_agreement_dis")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                        <div class="mb-4 col-sm-12 col-md-12 col-lg-12">
                            <label for="milestone_type">Milestone Type <span class="text-danger">*</span></label>
                            <select wire:model="milestone_type" class="form-control @error('milestone_type') is-invalid @enderror" id="milestone_type">
                                <option value="">--Select Milestone Type--</option>
                                <option value="time">Time</option>
                                <option value="condition">Condition</option>
                            </select>
                            @error("milestone_type")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Scheduled Date, initially hidden -->
                        <div class="mb-4 col-sm-12 col-md-12 col-lg-12" id="scheduled_date_container" style="display: none;">
                            <label for="schedule_date">Scheduled Date</label>
                            <input type="date" wire:model="schedule_date" class="form-control @error('schedule_date') is-invalid @enderror" id="schedule_date" placeholder="Enter Scheduled date">
                            @error("schedule_date")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <!-- Condition, initially hidden -->
                        <div class="mb-4 col-sm-12 col-md-12 col-lg-12" id="condition_container" style="display: none;">
                            <label for="condition">Condition</label>
                            <input type="text" wire:model="condition" class="form-control @error('condition') is-invalid @enderror" id="condition" placeholder="Enter Condition">
                            @error("condition")
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
                            <label for="amount">Amount</label>
                            <input type="text" wire:model="amount" class="form-control @error('amount') is-invalid @enderror" id="amount" oninput="formatNumber(this)" onkeypress="return isNumberKey(event)" placeholder="Enter amount">
                            @error("amount")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 text-end">
                            <button type="button" wire:click.prevent="storeDisbursementSchedule" class="btn btn-success">
                                {{-- <i class="fa fa-paper-plane"></i> {{ $disburse_id ? 'Update' : 'Submit' }} --}}
                                {{ $disburse_id ? 'Update' : 'Add' }}
                            </button>
                        </div>
                    </div>
                </div>


                <div class="table-responsive custom-scrollbar">
                    <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm mt-5">
                        <thead class="table-light">
                        <tr class="text-capitalize">
                            <th scope="col">SN </th>
                            <th scope="col">Concept_Note </th>
                            <th scope="col">Financing_Agreement </th>
                            <th scope="col">Milestone </th>
                            <th scope="col">Scheduled_Date </th>
                            <th scope="col">Condition </th>
                            <th scope="col">Installment </th>
                            <th scope="col">Amount </th>
                            <th scope="col" width="220">Actions</th>
                        </tr>
                        </thead>
                        <tbody x-ref="tbody">
                        @forelse ($financingAgreementDisburbasments as $financingAgreementDisburbasment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $financingAgreementDisburbasment->conceptNote->projectname }}</td>
                                <td>{{ $financingAgreementDisburbasment->financeAgreement->agreement_title }}</td>
                                <td>{{ $financingAgreementDisburbasment->milestone_type }}</td>
                                <td>{{ $financingAgreementDisburbasment->schedule_date ?? 'Not Set' }}</td>
                                <td>{{ $financingAgreementDisburbasment->condition ?? 'Not set' }}</td>
                                <td>{{ $financingAgreementDisburbasment->installment_type }}</td>
                                <td>{{ number_format($financingAgreementDisburbasment->amount, 0, '.', ',') }}</td>

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
                        @endforelse
                        </tbody>
                    </table>
                    {{ $financingAgreementDisburbasments->links() }}
                </div>

            </div>
        </div>




                 <!-- Delete Modal finacing agreement -->
                <div wire:ignore.self class="modal fade" id="deleteModalFinancingAgreement" data-backdrop="false" tabindex="-1" role="dialog"
                 aria-labelledby="deleteModalLabel" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
                         </div>
                         <div class="modal-body">
                             <p>Are you sure want to delete <strong>{{ $delete_confirm? $delete_confirm->agreement_title: ''  }}</strong> ?
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

                   <!-- Delete Modal finacing agreement attachement-->
                <div wire:ignore.self class="modal fade" id="deleteModalAttachment" data-backdrop="false" tabindex="-1" role="dialog"
                   aria-labelledby="deleteModalLabel" aria-hidden="true">
                   <div class="modal-dialog" role="document">
                       <div class="modal-content">
                           <div class="modal-header">
                               <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
                           </div>
                           <div class="modal-body">
                               <p>Are you sure want to delete <strong>{{ $delete_confirm? $delete_confirm->attachment_title: ''  }}</strong> ?
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

                     <!-- Delete Modal finacing agreement Disbursement -->
                <div wire:ignore.self class="modal fade" id="deleteModalDisbursement" data-backdrop="false" tabindex="-1" role="dialog"
                     aria-labelledby="deleteModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
                             </div>
                             <div class="modal-body">
                                 <p>Are you sure want to delete <strong>{{ $delete_confirm? $delete_confirm->installment_type: ''  }}</strong> ?
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
        var milestoneTypeSelect = document.getElementById('milestone_type'); // Get the select element
        var scheduledDateContainer = document.getElementById('scheduled_date_container'); // Get the scheduled date container
        var conditionContainer = document.getElementById('condition_container'); // Get the condition container

        // Function to handle the change event
        function handleMilestoneChange() {
            var selectedValue = milestoneTypeSelect.value; // Get the selected value from the dropdown
            // Hide both containers initially
            scheduledDateContainer.style.display = 'none';
            conditionContainer.style.display = 'none';

            // Check the selected value and display the corresponding container
            if (selectedValue === 'time') {
                scheduledDateContainer.style.display = 'block'; // Show the scheduled date container
            } else if (selectedValue === 'condition') {
                conditionContainer.style.display = 'block'; // Show the condition container
            }
        }

        // Attach the event listener to the select element
        milestoneTypeSelect.addEventListener('change', handleMilestoneChange);

        // Initialize the visibility based on the current selected value on page load
        handleMilestoneChange(); // Call the function to set the correct display on initial load
    });
    </script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var today = new Date(); // Get today's date
        var dd = String(today.getDate()).padStart(2, '0'); // Add leading zero if needed
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based, add 1 and leading zero
        var yyyy = today.getFullYear(); // Get full year
        today = yyyy + '-' + mm + '-' + dd; // Format date as YYYY-MM-DD

        // Set the min attribute for the date input field
        var scheduleDateInput = document.getElementById('schedule_date');
        var startDateInput = document.getElementById('terms_agreement_start_date');
        var endDateInput = document.getElementById('terms_agreement_end_date');
        scheduleDateInput.setAttribute('min', today);
        startDateInput.setAttribute('min', today);
        endDateInput.setAttribute('min', today);
    });
    </script>


{{-- <script>
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
</script> --}}

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
