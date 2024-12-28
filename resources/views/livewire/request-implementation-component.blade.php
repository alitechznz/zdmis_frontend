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
                <h3>Request Implementation</h3>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid default-dashboard">


        <!-- Add Financing agreement Attachment Form -->
        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6 p-0">
                                <h3>Add Request Implementation</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="project_name">Project Name <span class="text-danger">*</span></label>
                            <select wire:model="project_name" class="form-control @error('project_name') is-invalid @enderror" id="project_name">
                                <option value="">--Select Project Name--</option>
                                @foreach ($projects as $data)
                                    <option value="{{ $data->id }}">{{ $data->projectname }}</option>
                                @endforeach
                            </select>
                            @error("project_name")
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="file_type">File Type <span class="text-danger">*</span></label>
                            <select wire:model="file_type" class="form-control @error('file_type') is-invalid @enderror" id="file_type">
                                <option value="">--Select file_type--</option>
                                <option value="Invoice">Invoice</option>
                                <option value="IPC">IPC</option>
                                <option value="BoQ">BoQ</option>
                                <option value="Contract">Contract</option>
                                <option value="Application Letter">Application Letter</option>
                                <option value="AG Letter">AG Letter</option>
                                <option value="Construction Drawing">Construction Drawing</option>
                            </select>
                            @error("file_type")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Agreement Reference -->
                        <div class="mb-4 col-sm-12 col-md-12 col-lg-12">
                            <label for="attachment">Attach File <span class="text-danger">*</span></label>
                            <input type="file" wire:model="attachment" class="form-control @error('attachment') is-invalid @enderror" id="attachment">
                            @error("attachment")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
{{--                        <div class="col-12 text-end">--}}

{{--                            <button type="button" wire:click.prevent="store" class="{{ $update ? 'btn btn-success' : 'btn btn-primary' }}">  {{ $update ? 'Update' : 'Add' }}</button>--}}
{{--                            --}}
{{--                        </div>--}}

                        <div class="col-12 text-end">
                            <button type="button" wire:click.prevent="store" class="btn {{ $update ? 'btn-success' : 'btn-primary' }}">
                                {{ $update ? 'Update' : 'Add' }}
                            </button>
                        </div>

                    </div>
                </div>



                <div class="table-responsive custom-scrollbar">
                    <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm mt-5">
                        <thead class="table-light">
                        <tr class="text-capitalize">
                            <th scope="col">SN </th>
                            <th scope="col">File_Type </th>
                             <th scope="col">File </th>
                            <th scope="col" width="220">Actions</th>
                        </tr>
                        </thead>
                        <tbody x-ref="tbody">
                        @forelse ($requestImplementations as $requestImplementation)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $requestImplementation->file_type }}</td>
                                <td>
                                    <a href="{{ Storage::url($requestImplementation->attachment) }}" target="_blank">View {{ $requestImplementation->file_type }}</a>
                                    <button wire:click.prevent="downloadAttachment({{ $requestImplementation->id }})" class="btn btn-link">Download {{ $requestImplementation->file_type }}</button>
                                </td>
                                <td style="display: flex; gap:5px;">
                                    <a href="#" wire:click="edit({{ $requestImplementation->id }})"
                                       class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-sponsor">
                                        Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirmAttachment({{$requestImplementation->id}})"
                                       data-bs-toggle="modal" data-bs-target="#deleteModalAttachment">
                                        Delete</a>
                                </td>
                            </tr>
                         @empty
                            <tr>
                                <td colspan="8" class="text-danger text-center"> No Request Found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                     {{ $requestImplementations->links() }}
                </div>

            </div>
        </div>




        <!-- Add Financing  Form -->

        @livewire('financial-implementation-component')
       
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
