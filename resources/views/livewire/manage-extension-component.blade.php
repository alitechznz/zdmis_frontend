<div x-data="{ tab: 'new' }" class="m-2">
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
                    <h3>Manage Request Extension</h3>
                </div>
               
            </div>
        </div>
    </div>

    <div class="container-fluid default-dashboard">
        <div class="card">
            
            <div class="card-body">
                <div class="container-fluid">
                      <!-- Tab Navigation -->
                 <div class="col-sm-6 text-right">
                    <button @click="tab = 'new'" :class="{ 'btn-primary': tab === 'new', 'btn-default': tab !== 'new' }" class="btn">New Request</button>
                    <button @click="tab = 'approved'" :class="{ 'btn-primary': tab === 'approved', 'btn-default': tab !== 'approved' }" class="btn">Approved Request</button>
                </div>
                    <div class="table-responsive custom-scrollbar">
                        <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm mt-3">
                            <thead class="table-light">
                                <tr class="text-capitalize">
                                    <th scope="col">SN</th>
                                    <th scope="col">Project_Title</th>
                                    <th scope="col">Project_Code</th>
                                    <th scope="col">Requested_Type</th>
                                    <th scope="col">Requested_Date</th>
                                    <th scope="col" width="220">Actions</th>
                                </tr>
                            </thead>
                            <tbody x-ref="tbody">
                                <!-- Dynamic rows injected by Livewire -->
                                @forelse ($requestExtensions as $requestExtension)
                                    <tr x-show="tab === '{{ $requestExtension->requested_status == 0 ? 'new' : 'approved' }}'">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $requestExtension->conceptNote->projectname ?? 'N/A' }}</td>
                                        <td>{{ $requestExtension->conceptNote->project_code ?? 'N/A' }}</td>
                                        <td>{{ $requestExtension->extension_type }}</td>
                                        <td>{{ $requestExtension->created_at->format('d F, Y') }}</td>
                                        <td style="display: flex; gap:5px;">
                                            <a href="#" wire:click.prevent="loadRequestDetails({{ $requestExtension->id }})" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modal-view-extension-details">View</a>
                                            <a href="#" class="btn btn-sm btn-primary" wire:click="deleteConfirm({{$requestExtension->id}})" data-bs-toggle="modal" data-bs-target="#deleteModalFinancial">Manage</a>
                                            <a href="#" class="btn btn-sm btn-success" wire:click="deleteConfirm({{$requestExtension->id}})" data-bs-toggle="modal" data-bs-target="#deleteModalFinancial">Feedback</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-danger text-center">No Data Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $requestExtensions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- View Modal Content -->
<div class="modal fade" wire:ignore.self id="modal-view-extension-details" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                @if ($selectedRequest)
                <h2 class="h6 modal-title">Extension Details For {{ $selectedRequest->extension_type  }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- @if ($selectedRequest) --}}
                <div class="table-responsive custom-scrollbar">
                    <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm mt-5">
                        <thead class="table-light">
                            <tr class="text-capitalize">
                                <th>Project_Title</th>
                                <th>Project_Code</th>
                                <th>Requested_Type</th>
                                <th>Outcome</th>
                                <th>Output</th>
                                <th>Activity</th>
                                <th>Planning_Amount</th>
                                <th>Requested_Amount</th>
                                <th>Requested_Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $selectedRequest->conceptNote->projectname ?? 'N/A' }}</td>
                                <td>{{ $selectedRequest->conceptNote->project_code ?? 'N/A' }}</td>
                                <td>{{ $selectedRequest->extension_type ?? 'N/A' }}</td>
                                <td>{{ $selectedRequest->outcome ? Str::limit($selectedRequest->outcome->name, 30) : 'N/A' }}</td>
                                <td>{{ $selectedRequest->output ? Str::limit($selectedRequest->output->output, 30) : 'N/A' }}</td>
                                <td>{{ $selectedRequest->proposalActivity ? $selectedRequest->proposalActivity->activity_name : 'N/A' }}</td>
                                <td>
                                    {{ $selectedRequest->proposalActivity && $selectedRequest->proposalActivity->planning_amount !== null 
                                        ? number_format($selectedRequest->proposalActivity->planning_amount, 2, '.', ',') . ' TZS' 
                                        : 'N/A' }}
                                </td>
                                <td>
                                    {{ $selectedRequest->new_requested_amount !== null 
                                        ? number_format($selectedRequest->new_requested_amount, 2, '.', ',') . ' TZS' 
                                        : 'N/A' }}
                                </td>                                
                                <td>{{ $selectedRequest->created_at->format('d F, Y') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-danger text-center">No Data Found</p>
                @endif
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of View Modal Content -->

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModalFinancial" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" wire:click.prevent="destroy()" class="btn btn-danger close-modal" data-bs-dismiss="modal">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
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
    });
</script>
</div>
