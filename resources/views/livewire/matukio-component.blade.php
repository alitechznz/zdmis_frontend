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
                    <h3>Orodha ya Matukio </h3>
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
                </div>
                <div class="col-6">
                    <div class="float-end">

                        {{-- <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modal-matukio" wire:click='create'><i class="fa fa-plus"></i> Weka Taarifa
                        </a> --}}


                    </div>

                </div>
            </div>
            <div class="table-responsive custom-scrollbar">
                <table
                    class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                    <thead class="table-light">
                        <tr class="text-capitalize">
                            <th>SN</th>
                            <th @click="sortByColumn" class="cursor-pointer select-none">Aina ya Tukio <span
                                    class="float-end text-secondary">&#8645;</span>
                            </th>

                            <th @click="sortByColumn" class="cursor-pointer select-none">Mahala <span
                                    class="float-end text-secondary">&#8645;</span>
                            </th>

                            <th @click="sortByColumn" class="cursor-pointer select-none">Maelezo <span
                                    class="float-end text-secondary">&#8645;</span>
                            </th>

                            <th @click="sortByColumn" class="cursor-pointer select-none">Tarehe iliyowasilishwa <span
                                    class="float-end text-secondary">&#8645;</span>
                            </th>
                            <th @click="sortByColumn" class="cursor-pointer select-none">Imewasilishwa <span
                                    class="float-end text-secondary">&#8645;</span>
                            </th>
                            <th @click="sortByColumn" class="cursor-pointer select-none">Hali (status) <span
                                    class="float-end text-secondary">&#8645;</span>
                            </th>
                            <th width="220">Hatua</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($incidents as $index => $incident)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $incident->title }}</td>
                                <td>{{ $incident->location }}</td>
                                <td title="{{ $incident->description }}">
                                    {{ Str::limit($incident->description, 40, '...') }}</td>
                                <td>{{ $incident->createdAt }}</td>
                                <td>{{ $incident->reportedBy }}</td>
                                <td>
                                    <span class="badge {{ $incident->status == 'Imetatuliwa' ? 'badge-light-success' : 'badge-light-danger' }}">
                                        {{ ucfirst($incident->status) }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-success" wire:click="edit({{ $incident->id }})"
                                        data-bs-toggle="modal" data-bs-target="#modal-matukio">Badilisha</button>
                                    <button class="btn btn-sm btn-danger"
                                        wire:click="destroy({{ $incident->id }})">Futa</button>
                                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-shehia"  wire:click="taarifa({{ $incident->id }})"><i class="fa fa-plus"></i> Weka Taarifa </a>
                                    <button class="btn btn-sm btn-warning" wire:click="">Fuatilia</button>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-danger">No Incidents Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $incidents->links() }}
            </div>
        </div>
    </div>

     <!-- Modal Content -->
     <div class="modal fade" wire:ignore.self id="modal-shehia" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title"> Weka Taarifa ya Tukio. </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div  class="row">
                        <div class="mb-4">
                            <label for="taarifa_tukio">Chanzo cha Taarifa <span class="text-danger">*</span></label>
                            <input type="text" wire:model="taarifa_tukio" class="form-control @error("taarifa_tukio") is-invalid @enderror" id="name" placeholder="Andika chanzo cha taarifa" readonly>
                            @error("taarifa_tukio")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="chanzo">Chanzo cha Taarifa <span class="text-danger">*</span></label>
                            <input type="text" wire:model="chanzo" class="form-control @error("chanzo") is-invalid @enderror" id="name" placeholder="Andika chanzo cha taarifa">
                            @error("chanzo")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <input type="hidden" wire:model="tukio_id" class="form-control" readonly>    
                        <input type="hidden" wire:model="user_aliengia_id" class="form-control" readonly>

                        <div class="mb-4">
                            <label for="maelezo">Maelezo ya Taarifa <span class="text-danger">*</span></label>
                            <textarea wire:model="maelezo" rows="3" class="form-control @error('maelezo') is-invalid @enderror"></textarea>
                            @error("maelezo")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                       
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal" wire:click='create'>Close</button>
                            <button type="button" wire:click.prevent="wekaTaarifa"> Wasilisha</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->
    <!-- Modal Content -->
     <!-- Modal Content -->
   
    <!-- End of Modal Content -->
    <!-- End of Modal Content -->

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModalshehia" data-backdrop="false" tabindex="-1"
        role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete <strong></strong> ?</p>
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
