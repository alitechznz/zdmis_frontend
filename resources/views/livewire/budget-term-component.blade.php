<div x-data="data()" class="m-2">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 p-0">
                    <h3>Manage Budget Terms</h3>
                </div>
                {{-- <div class="col-sm-6 p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a>
                        </li>
                        <li class="breadcrumb-item">Budget Term</li>
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
                            <input type="search" wire:model="search_keyword" class="form-control form-control-sm w-auto" placeholder="Search budget term...">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="float-end">
                            @can('view budget form')
                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-budgetterm" wire:click="create">
                                <i class="fa fa-plus"></i> Add New
                            </a>
                            @endcan
                          
                        </div>
                    </div>
                </div>

                <div class="table-responsive custom-scrollbar">
                    <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                        <thead class="table-light">
                            <tr class="text-capitalize">
                                <th>SN</th>
                                <th>Year</th>
                                <th>Start_Date</th>
                                <th>End_Date</th>
                                <th>Status</th>
                                <th width="220">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($budgetterms as $budgetterm)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $budgetterm->year }}</td>
                                    <td>{{ $budgetterm->start_date }}</td>
                                    <td>{{ $budgetterm->end_date }}</td>
                                    <td>
                                        <span class="badge {{ $budgetterm->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($budgetterm->status) }}
                                        </span>
                                    </td>
                                    <td style="display: flex; gap:5px;">
                                        @can('edit budget form')
                                            <a href="#" wire:click="edit({{ $budgetterm->id }})" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-budgetterm">Edit</a>
                                        @endcan

                                        @can('delete budget form')
                                            <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{ $budgetterm->id }})" data-bs-toggle="modal" data-bs-target="#deleteModalbudgetterm">Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center text-danger">No Budget Term Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $budgetterms->links() }}
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-budgetterm" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">{{ $update ? 'Update' : 'Add' }} Budget Term</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                            <label for="year">Year <span class="text-danger">*</span></label>
                            <select wire:model="year" class="form-control @error("year") is-invalid @enderror" id="year">
                                <option value="">--Choose--</option>
                                <option value="2024/25">2024/25</option>
                                <option value="2025/26">2025/26</option>
                                <option value="2026/27">2026/27</option>
                                <option value="2027/28">2027/28</option>
                                <option value="2028/29">2028/29</option>
                                <option value="2029/30">2029/30</option>
                                <option value="2030/31">2030/31</option>
                                <option value="2031/32">2031/32</option>
                                <option value="2032/33">2032/33</option>
                                <option value="2033/34">2033/34</option>
                                <option value="2034/35">2034/35</option>

                                <option value="2035/36">2035/36</option>
                                <option value="2036/37">2036/37</option>
                                <option value="2037/38">2037/38</option>
                                <option value="2038/39">2038/39</option>

                                <option value="2039/40">2039/40</option>
                                <option value="2040/41">2040/41</option>
                                <option value="2041/42">2041/41</option>
                                <option value="2042/43">2042/43</option>
                                <option value="2043/44">2043/44</option>
                                <option value="2044/45">2044/45</option>
                                <option value="2045/46">2045/46</option>
                                <option value="2046/47">2046/47</option>
                                <option value="2047/48">2047/48</option>
                                <option value="2048/49">2048/49</option>
                                <option value="2049/50">2049/50</option>

                            </select>
                            </select>
                            @error("year")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-12">
                            <label for="start_date">Start Date <span class="text-danger">*</span></label>
                            <input type="date" wire:model="start_date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" placeholder="Choose Start Date">
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 col-12">
                            <label for="end_date">End Date <span class="text-danger">*</span></label>
                            <input type="date" wire:model="end_date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" placeholder="Choose End Date">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select wire:model="status" class="form-control @error("status") is-invalid @enderror" id="status">
                                <option value="">--Choose--</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error("status")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal" wire:click='create'>Close</button>
                        <button type="button" wire:click.prevent="store" class="{{ $update ? 'btn btn-success' : 'btn btn-primary' }}">  {{ $update ? 'Update' : 'Add' }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModalbudgetterm" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div the="modal-header">
                    <h5 class="modal-title">Delete Confirm</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete <strong>{{ $delete_confirm ? $delete_confirm->year : '' }}</strong>?</p>
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
       window.livewire.on('closeModal', () => {
                    $('#modal-budgetterm').modal('hide')
                })
    </script>
    @endpush
</div>
