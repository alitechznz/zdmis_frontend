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

    <div class="card mb-5">
        <div class="card-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-6 p-0">
                            <h3>Project Information</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="project">Project <span class="text-danger">*</span></label>
                    <select wire:model="project" class="form-control @error("project") is-invalid @enderror" id="project">
                        <option value="">--Choose--</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->projectname }}</option>
                        @endforeach
                    </select>
                    @error("project")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="project_code">Project Code <span class="text-danger">*</span></label>
                    <input type="text" wire:model="project_code" class="form-control @error("project_code") is-invalid @enderror" id="project_code" readonly disabled>
                    @error("project_code")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                    <label for="select_report_period">Reporting Period <span class="text-danger">*</span></label>
                    <select class="form-control @error('report_period') is-invalid @enderror" id="select_report_period" wire:model="report_period">
                        <option value="">--Choose--</option>
                        <option value="Annually">Annually</option>
                        <option value="Quarter 1">Quarter 1</option>
                        <option value="Quarter 2">Quarter 2</option>
                        <option value="Quarter 3">Quarter 3</option>
                        <option value="Quarter 4">Quarter 4</option>
                    </select>
                    @error("report_period")
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
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-6 p-0">
                            <h3>Add Resource Tracking</h3>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">

                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="finance_particular">Finance Particular <span class="text-danger">*</span></label>
                    <input type="text" wire:model="finance_particular" class="form-control @error('finance_particular') is-invalid @enderror" id="finance_particular" readonly disabled>
                    @error('finance_particular')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="source_financing">Financing Source <span class="text-danger">*</span></label>
                    <select wire:model="source_financing" class="form-control @error("source_financing") is-invalid @enderror" id="source_financing">
                        <option value="">--Choose--</option>
                        @foreach ($source_finances as $source_finance)
                            <option value="{{ $source_finance->id }}">{{ $source_finance->name }} {{ $source_finance->category }}</option>
                        @endforeach
                    </select>
                    @error("source_financing")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="amount">Amount (TZS) <span class="text-danger">*</span></label>
{{--                    <input type="text" wire:model="amount" class="form-control @error("amount") is-invalid @enderror" id="amount" placeholder="Enter Amount">--}}
                    <input type="text" wire:model.lazy="amount" class="form-control @error('amount') is-invalid @enderror" id="amount" placeholder="Enter Amount">
                    @error("amount")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="input_report_period">Report Period <span class="text-danger">*</span></label>
                    <input type="text" wire:model="project_code" class="form-control @error('report_period') is-invalid @enderror" id="input_report_period" readonly disabled>
                    @error("report_period")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                    <label for="attachment">Attachment <span class="text-danger">*</span></label>
                    <input type="file" wire:model="attachment" class="form-control @error("attachment") is-invalid @enderror" id="attachment">
                    @error("attachment")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


            </div>
            <div class="row">
                <div class="col-12 text-end">
                    <button type="button" wire:click.prevent="store" class="{{ $update ? 'btn btn-success' : 'btn btn-primary' }}">  {{ $update ? 'Update' : 'Add' }}</button>
                </div>
            </div>


            <div class="table-responsive custom-scrollbar my-5">
                <div class="col-6 mb-2">
                    <div class="input-group">
                        <input type="search" wire:model.live="search_keyword" class="form-control form-control-sm w-auto"
                               placeholder="Search resource tracking...">
                    </div>
                </div>
                <table class="table table-bordered table-sm table-hover table-striped compact">
                    <thead class="table-light">
                    <tr class="text-capitalize">
                        <th @click="sortByColumn" class="cursor-pointer select-none">SN <span class="float-end text-secondary">&#8645;</span>
                            <th @click="sortByColumn" class="cursor-pointer select-none">Period <span class="float-end text-secondary">&#8645;</span>
                        </th>

                        <th @click="sortByColumn" class="cursor-pointer select-none">Source_Of_Fund <span class="float-end text-secondary">&#8645;</span>
                        </th>

                        <th @click="sortByColumn" class="cursor-pointer select-none">Amount (TZS) <span class="float-end text-secondary">&#8645;</span>
                        </th>

                        <th @click="sortByColumn" class="cursor-pointer select-none">Attachment <span class="float-end text-secondary">&#8645;</span>
                        </th>

                        <th width="220" scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody x-ref="tbody">
                    @forelse ($resourceTrackings as $resourceTracking)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $resourceTracking->report_period }}</td>
                            <td>{{ $resourceTracking->sourceFinance->name }} {{ $resourceTracking->sourceFinance->category }}</td>
{{--                            <td>{{ number_format($resourceTracking->amount, 0, '.', ',') }} TZS</td>--}}
                            <td class="amount">{{ $resourceTracking->amount }} TZS</td>
                            <td>
                                <a href="{{ Storage::url($resourceTracking->attachment) }}" target="_blank">View File</a>
                                <button wire:click.prevent="downloadAttachment({{ $resourceTracking->id }})" class="btn btn-link">Download File</button>
                            </td>
                            <td style="display: flex; gap: 5px;">
                                @can('edit plan')
                                    <a href="#" wire:click="edit({{ $resourceTracking->id }})"
                                       class="btn btn-sm btn-success">
                                        Edit </a>
                                @endcan
                                @can('delete plan')
                                    <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$resourceTracking->id}})"
                                       data-bs-toggle="modal" data-bs-target="#deleteModalResourceTracking">
                                        Delete </a>
                                @endcan
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8" class="text-danger text-center"> No Data Found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $resourceTrackings->links() }}
            </div>

            <div class="table-responsive custom-scrollbar my-5">

                <table class="table table-bordered table-sm table-hover table-striped compact">
                    <thead class="table-light">
                    <tr class="text-capitalize">
                        <th @click="sortByColumn" class="cursor-pointer select-none">SN <span class="float-end text-secondary">&#8645;</span>
                        <th @click="sortByColumn" class="cursor-pointer select-none">Date <span class="float-end text-secondary">&#8645;</span>
                        </th>

                        <th @click="sortByColumn" class="cursor-pointer select-none">Source_Of_Fund <span class="float-end text-secondary">&#8645;</span>
                        </th>

                        <th @click="sortByColumn" class="cursor-pointer select-none">Amount (TZS) <span class="float-end text-secondary">&#8645;</span>
                        </th>

                        <th @click="sortByColumn" class="cursor-pointer select-none">Created By / Organization (TZS) <span class="float-end text-secondary">&#8645;</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody x-ref="tbody">
{{--                    @forelse ($resourceTrackings as $resourceTracking)--}}
{{--                        <tr>--}}
{{--                            <td>{{ $loop->iteration }}</td>--}}
{{--                            <td>{{ $resourceTracking->report_period }}</td>--}}
{{--                            <td>{{ $resourceTracking->sourceFinance->name }} {{ $resourceTracking->sourceFinance->category }}</td>--}}
{{--                                                        <td>{{ number_format($resourceTracking->amount, 0, '.', ',') }} TZS</td>--}}
{{--                            <td class="amount">{{ $resourceTracking->amount }} TZS</td>--}}
{{--                            <td style="display: flex; gap: 5px;">--}}
{{--                                @can('edit plan')--}}
{{--                                    <a href="#" wire:click="edit({{ $resourceTracking->id }})"--}}
{{--                                       class="btn btn-sm btn-success">--}}
{{--                                        Edit </a>--}}
{{--                                @endcan--}}
{{--                                @can('delete plan')--}}
{{--                                    <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$resourceTracking->id}})"--}}
{{--                                       data-bs-toggle="modal" data-bs-target="#deleteModalResourceTracking">--}}
{{--                                        Delete </a>--}}
{{--                                @endcan--}}


{{--                                @if ($resourceTracking->attachment)--}}
{{--                                    <a href="#" wire:click="downloadAttachment({{ $resourceTracking->id }})" class="btn btn-sm btn-success">Download</a>--}}
{{--                                                                        @else--}}
{{--                                                                            <p class="text-center">Non</p>--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                        </tr>--}}

{{--                    @empty--}}
{{--                        <tr>--}}
{{--                            <td colspan="8" class="text-danger text-center"> No Data Found</td>--}}
{{--                        </tr>--}}
{{--                    @endforelse--}}
                    </tbody>
                </table>
{{--                {{ $resourceTrackings->links() }}--}}
            </div>


            <!-- Delete Modal Resource Tracking -->
            <div wire:ignore.self class="modal fade" id="deleteModalResourceTracking" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
                        </div>
                        <div class="modal-body">
                            {{-- <p>Are you sure want to delete <strong>{{ $delete_confirm? $delete_confirm->name: ''  }}</strong> ?</p> --}}
                            <p>Are you sure want to delete ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" wire:click.prevent="destroy()" class="btn btn-danger close-modal" data-bs-dismiss="modal">Yes, Delete</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const amountInput = document.getElementById('amount');

            // Function to format input
            function formatInput(value) {
                // Remove all characters except digits and decimal point
                let cleanValue = value.replace(/[^0-9.]/g, '');
                // Split the input into parts before and after the decimal
                let parts = cleanValue.split('.');
                // Format the first part with commas
                parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                // Restrict to only two decimal places
                if (parts[1]) {
                    parts[1] = parts[1].substring(0, 2);
                }
                return parts.join('.');
            }

            // Event listener for handling input
            amountInput.addEventListener('input', function() {
                const cursorPosition = this.selectionStart;
                const originalLength = this.value.length;
                const beforeLength = this.value.slice(0, this.selectionStart).replace(/\D/g, '').length;

                this.value = formatInput(this.value);

                const newLength = this.value.length;
                const newBeforeLength = this.value.slice(0, cursorPosition).replace(/\D/g, '').length;
                this.selectionStart = this.selectionEnd = cursorPosition + (newBeforeLength - beforeLength);
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Function to add commas to numbers
            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            // Select all elements with the class 'amount'
            const amounts = document.querySelectorAll('.amount');

            // Format each element
            amounts.forEach(function(el) {
                let content = el.textContent.trim();
                // Assume the format is like "1234567 TZS", split by space
                let parts = content.split(' ');
                let number = parts[0]; // the numeric part
                let currency = parts[1]; // the 'TZS' part

                // Format the number and set back to element's text content
                el.textContent = numberWithCommas(number) + ' ' + currency;
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectElement = document.getElementById('select_report_period');
            const inputElement = document.getElementById('input_report_period');

            selectElement.addEventListener('change', function() {
                inputElement.value = this.value; // Update the input field with the selected value
            });
        });
    </script>


</div>



