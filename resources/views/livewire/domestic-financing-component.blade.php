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
                <h3>Manage Domestic Financing</h3>
            </div>
            {{-- <div class="col-sm-6 p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                            <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a>
                    </li>
                    <li class="breadcrumb-item">Domestic Financing</li>
                </ol>
            </div> --}}
        </div>
    </div>
</div>

<div class="container-fluid default-dashboard">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-6">
                        <div class="input-group">
                            <input type="search" wire:model="search_keyword" class="form-control form-control-sm w-auto" placeholder="Search domestic financing...">
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    {{-- <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6 p-0">
                                <h3>Domestic Financing</h3>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                    

                        <div class="table-responsive custom-scrollbar">
                            <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                                <thead class="table-light">
                                <tr class="text-capitalize">
                                    <th scope="col">SN </th>
                                    <th scope="col">Project </th>
                                    <th scope="col">Project_Code </th>
                                    <th scope="col">Current_Requested_Date </th>
                                    <th scope="col">Last_Disbursed_Date </th>
                                    <th scope="col">Last_Disbursed_Amount(Tz) </th>
                                    <th scope="col">Balance </th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody x-ref="tbody">
                                {{-- @forelse ($financingAgreementDisburbasments as $financingAgreementDisburbasment) --}}
                                    <tr>
                                        {{-- <td>{{ $loop->iteration }}</td> --}}
                                        <td>1</td>
                                        <td>Project Sample</td>
                                        <td>Project Code Sample</td>
                                        <td>8/12/2024</td>
                                        <td>7/12/2024</td>
                                        <td>4,000,000</td>
                                        <td>20, 000, 000</td>
                                        <td style="display: flex; gap:5px;">
                                            @can('add disbursing')
                                            <a href="{{ route('disbursings') }}" wire:click="" class="btn btn-sm btn-info">
                                                Disbursing
                                            </a>
                                            @endcan
                                           
                                        
                                        </td>
                                    </tr>
                                {{-- @empty
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
        </div>




                 <!-- Delete Modal finacing agreement -->
                {{-- <div wire:ignore.self class="modal fade" id="deleteModalFinancingAgreement" data-backdrop="false" tabindex="-1" role="dialog"
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
             </div> --}}




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
    function formatNumber(input) {
        // Remove commas from current input value to avoid errors in formatting
        let value = input.value.replace(/,/g, '');
        // Convert the cleaned value to a number and then back to a string with commas
        let formatted = Number(value).toLocaleString();
        // If the input is purely numeric or empty, update the input with the formatted number
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
