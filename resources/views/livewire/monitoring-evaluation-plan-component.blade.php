
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
                <h3>M & E Plan</h3>
            </div>

        </div>
    </div>
</div>

    <!-- Aspiration filter -->
    <div class="mb-1"  style="display: flex; align-items: center; gap:20px">
        <input type="search" wire:model.live="search_keyword" class="form-control" placeholder="Search me...">
        
    </div>

    <div class="table-responsive custom-scrollbar">
        <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                <thead class="table-light">
                <tr class="text-capitalize">
                    <th scope="col">SN</th>
                        <th scope="col">Organiztaion</th>
                        <th scope="col">Proposal_Title</th>
                        <th scope="col">Status</th>
                        <th scope="col">Start_Date</th>
                        <th scope="col">End_Date</th>
                        <th scope="col" width="220">Actions</th>
                </tr>
                </thead>
                <tbody x-ref="tbody">
               
               <tr>
                    <td>1</td>
                    <td>ZFDA</td>
                    <td>Health</td>
                    <td>Active</td>
                    <td>2024-12-5</td>
                    <td>2024-12-30</td>
                    
                    <td style="display: flex; gap: 5px;">
                        @can('view monitoring')
                        <a href="{{ route('m-e-plan-summaries') }}"
                        class="btn btn-sm btn-info">
                            View </a>
                        @endcan
                       
                        @can('comment project monitoring')
                        <a href="#" class="btn btn-sm btn-success"
                        data-bs-toggle="modal" data-bs-target="#modal-me-comment">
                            Comment </a>
                        @endcan
                       
                    </td>
               </tr>
                </tbody>
            </table>
            
        </div>



           <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-me-comment" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Add Comment</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                            <label for="action">Action</label>
                            <select wire:model="action" class="form-control @error("action") is-invalid @enderror" id="action">
                                <option value="">--Choose--</option>
                                <option value="accepted">Accepted</option>
                                <option value="rejected">Rejetcetd</option>
                            </select>
                            </select>
                            @error("action")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4 ol-md-12 col-sm-12 col-lg-12">
                            <label for="remark">Comment</label>
                            <textarea wire:model="remark" cols="4" rows="6" class="form-control @error('remark') is-invalid @enderror" id="remark" placeholder="Type your Comment"></textarea>
                            @error("remark")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal">Close</button>
                        <button type="button" wire:click.prevent="store" class="btn btn-secondary">Add</button>
                        {{-- <button type="button" wire:click.prevent="store" class="{{ $update ? 'btn btn-success' : 'btn btn-primary' }}">  {{ $update ? 'Update' : 'Add' }}</button> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->




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
    @push('scripts')
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.on('closeModal', (event) => {
                    $('#modal-comment').modal('hide')
                });
            });
        </script>
    @endpush
</div>

