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
    </style>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 p-0">
                    <h3>Manage Inventory transaction</h3>
                </div>
                {{-- <div class="col-sm-6 p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg>
                            </a></li>
                        <li class="breadcrumb-item">Ministries</li>
                    </ol>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <div class="input-group">
                        <input type="search" wire:model.live="search_keyword"
                            class="form-control form-control-sm w-auto" placeholder="Search inventory...">
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-end">

                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modal-inventory" wire:click='create'><i class="fa fa-plus"></i> Add New </a>


                    </div>

                </div>
            </div>
            <div class="table-responsive custom-scrollbar">
                <table
                    class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                    <thead class="table-light">
                        <tr class="text-capitalize">
                            <th scope="col">SN
                            <th scope="col">Transaction_Type
                            <th scope="col">Quantity
                            <th scope="col">Transaction_Date
                            <th scope="col">Notes
                            <th scope="col" width="220">Actions</th>
                        </tr>
                    </thead>
                    <tbody x-ref="tbody">
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaction->transactionType }}</td>
                                <td>{{ $transaction->quantity }}</td>
                                <td>{{ $transaction->transactionDate }}</td>
                                <td>{{ $transaction->notes }}</td>
                                <td style="display: flex; gap: 5px;">
                                        <a href="#" wire:click="edit({{ $transaction->id }})"
                                            class="btn btn-sm btn-success" data-bs-toggle="modal"
                                            data-bs-target="#modal-inventory">
                                            Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger"
                                            wire:click="deleteConfirm({{ $transaction->id }})" data-bs-toggle="modal"
                                            data-bs-target="#deleteModalInventory">
                                            Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-danger text-center"> No inventory transaction Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if($transactions->count())
                    {{ $transactions->links() }}
                @else
                    {{-- <tr>
                        <td colspan="6" class="text-center">No institutions found.</td>
                    </tr> --}}
                @endif
            </div>
        </div>
    </div>
    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-inventory" tabindex="-1" role="dialog"
        aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">
                        @if ($update)
                            Update
                        @else
                            Add
                        @endif Inventory transaction
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="item">Item Name <span class="text-danger">*</span></label>
                            <select wire:model="item" class="form-control @error('item') is-invalid @enderror"
                                id="item">
                                <option value="">--Choose--</option>
                                @foreach ($inventories as $inventory)
                                    <option value="{{ $inventory->id }}">{{ $inventory->name }}</option> 
                                @endforeach
                            </select>
                            @error('item')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                       
                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="transaction_type">Transaction Type <span class="text-danger">*</span></label>
                            <select wire:model="transaction_type" class="form-control @error('transaction_type') is-invalid @enderror"
                                id="transaction_type">
                                <option value="">--Choose--</option>
                                <option value="IN">IN</option>
                                <option value="OUT">OUT</option>
                            </select>
                            @error('transaction_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="quantity">Quantity <span class="text-danger">*</span></label>
                            <input type="number" wire:model="quantity"
                                class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                                placeholder="Enter quantity">
                            @error('quantity')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="transaction_date">Transaction Date <span class="text-danger">*</span></label>
                            <input type="date" wire:model="transaction_date"
                                class="form-control @error('transaction_date') is-invalid @enderror" id="transaction_date"
                                placeholder="Enter current stock level">
                            @error('transaction_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-md-12 col-sm-12 col-lg-12" xmlns="http://www.w3.org/1999/html">
                            <label for="notes">Notes <span class="text-danger">*</span></label>
                            <textarea wire:model="notes" class="form-control @error('notes') is-invalid @enderror" id="notes"
                                placeholder="Enter notes" rows="4">
                            </textarea>
                            @error('notes')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link text-gray-600 ms-auto"
                                data-bs-dismiss="modal">
                                Close
                            </button>

                            <button type="button" wire:click.prevent="store"
                                class="{{ $update ? 'btn btn-success' : 'btn btn-primary' }}">
                                {{ $update ? 'Update' : 'Add' }}</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModalInventory" data-backdrop="false" tabindex="-1"
        role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" wire:click.prevent="destroy()" class="btn btn-danger close-modal"
                        data-bs-dismiss="modal">Yes, Delete
                    </button>
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
                                !isNaN(row2) ?
                                row1 - row2 :
                                row1.toString().localeCompare(row2);
                        })(
                            this.getCellValue(this.sortAsc ? a : b, index),
                            this.getCellValue(this.sortAsc ? b : a, index)
                        );
                }
            };
        }
    </script>

    <script>
        document.getElementById('phone').addEventListener('input', function() {
            var phoneInput = this.value.slice(0, 10); // Limit characters to 10 digits
            this.value = phoneInput;
        });
    </script>


    @push('scripts')
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.
                on('closeModal', (event) => {
                    $('#modal-inventory').modal('hide')
                });
            });
        </script>
    @endpush
</div>
