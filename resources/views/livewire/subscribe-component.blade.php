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
                    <h3>Orodha ya Subscribers </h3>
                </div>
                {{-- <div class="col-sm-6 p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Shehia</li>
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
                            class="form-control form-control-sm w-auto" placeholder="Tafuta taarifa...">
                    </div>

                    {{-- <div class="input-group">
                        <input type="search" wire:model.debounce.300ms="search_keyword"
                            class="form-control form-control-sm w-auto" placeholder="Search information...">
                    </div> --}}
                    
                </div>
                <div class="col-6">
                    <div class="float-end">
                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modal-notify" wire:click='create'><i class="fa fa-plus"></i> Send alert
                        </a>
                    </div>

                </div>
            </div>
            <div class="table-responsive custom-scrollbar">
                <table
                    class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                    <thead class="table-light">
                        <tr class="text-capitalize">
                            <th>SN</th>
                            <th @click="sortByColumn" class="cursor-pointer select-none">Contact <span
                                    class="float-end text-secondary">&#8645;</span>
                            </th>

                            <th @click="sortByColumn" class="cursor-pointer select-none">Subscription_Type <span
                                    class="float-end text-secondary">&#8645;</span>
                            </th>

                            <th @click="sortByColumn" class="cursor-pointer select-none">Status <span
                                    class="float-end text-secondary">&#8645;</span>
                            </th>

                            <th width="220">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subscribers as $subscriber)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $subscriber->contact }}</td>
                                <td>{{ $subscriber->subscription_type }}</td>
                                <td>
                                    <span
                                        class="badge {{ $subscriber->status == 'active' ? 'badge-light-success' : 'badge-light-danger' }}">
                                        {{ ucfirst($subscriber->status) }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger"
                                        wire:click="deleteConfirm({{ $subscriber->id }})" data-bs-toggle="modal"
                                        data-bs-target="#deleteModalSubscriber">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-danger">No subscribers Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if($subscribers->count())
                    {{ $subscribers->links() }}
                @else
                    {{-- <tr>
                        <td colspan="6" class="text-center">No institutions found.</td>
                    </tr> --}}
                @endif
            </div>
        </div>
    </div>
    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-notify" tabindex="-1" role="dialog"
        aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Notify</h2>
                    {{-- <h2 class="h6 modal-title">{{ $update ? 'Update' : 'Add' }} </h2> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="mb-4 col-md-12 col-sm-12 col-lg-12" xmlns="http://www.w3.org/1999/html">
                            <label for="subject">Subject <span class="text-danger">*</span></label>
                            <textarea wire:model="subject" class="form-control @error('subject') is-invalid @enderror" id="subject"
                                placeholder="Enter subject" rows="4">
                            </textarea>
                            @error('subject')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-4 col-md-12 col-sm-12 col-lg-12" xmlns="http://www.w3.org/1999/html">
                            <label for="message">Message <span class="text-danger">*</span></label>
                            <textarea wire:model="message" class="form-control @error('message') is-invalid @enderror" id="message"
                                placeholder="Enter message" rows="4">
                            </textarea>
                            @error('message')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal"
                                wire:click='create'>Close</button>
                            <button type="button" wire:click.prevent="notifyAll"
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
    <div wire:ignore.self class="modal fade" id="deleteModalSubscriber" data-backdrop="false" tabindex="-1"
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
                        data-bs-dismiss="modal">Yes, Delete</button>
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
    @push('scripts')
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.on('closeModal', (event) => {
                    $('#modal-matukio').modal('hide')
                });
            });
        </script>
    @endpush
</div>
