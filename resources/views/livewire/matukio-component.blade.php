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
                                    <span class="badge {{ $incident->status == 'closed' ? 'badge-light-success' : 'badge-light-danger' }}">
                                        {{ ucfirst($incident->status) }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-success" wire:click="edit({{ $incident->id }})"
                                        data-bs-toggle="modal" data-bs-target="#modal-matukio">Badilisha</button>
                                    <button class="btn btn-sm btn-danger"
                                        wire:click="destroy({{ $incident->id }})">Futa</button>
                                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-shehia" wire:click='create'
                                        ><i class="fa fa-plus"></i> Weka Taarifa </a>
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
    <div class="modal fade" wire:ignore.self id="modal-matukio" tabindex="-1" role="dialog"
        aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">{{ $update ? 'Badili' : 'Weka' }} Taarifa</h2>
                    {{-- <h2 class="h6 modal-title">{{ $update ? 'Update' : 'Add' }} </h2> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">


                        <div class="mb-4">
                            <label for="incident">Aina ya tukio <span class="text-danger">*</span></label>
                            <select wire:model="incident" class="form-control @error('incident') is-invalid @enderror"
                                id="incident">
                                <option value="">--Chagua--</option>
                                @foreach ($incidentTypes as $incident)
                                    <option value="{{ $incident->id }}">{{ $incident->title }}</option>
                                @endforeach
                            </select>
                            @error('incident')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="location">Location <span class="text-danger">*</span></label>
                            <input type="text" wire:model="location"
                                class="form-control @error('location') is-invalid @enderror" id="location"
                                placeholder="Andika Mahala">
                            @error('location')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-md-12 col-sm-12 col-lg-12" xmlns="http://www.w3.org/1999/html">
                            <label for="description">Maelezo <span class="text-danger">*</span></label>
                            <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" id="description"
                                placeholder="Enter description" rows="4">
                            </textarea>
                            @error('descriptioKuna moto Fuoni Mambosasa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status">Hali <span class="text-danger">*</span></label>
                            <select wire:model="status" class="form-control @error('status') is-invalid @enderror"
                                id="status">
                                <option value="">--Chagua--</option>
                                <option value="Imeanzishwa">Imeanzishwa </option>
                                <option value="Inaendelea">Inaendelea</option>
                                <option value="Imetatuliwa">Imetatuliwa</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal"
                                wire:click='create'>Close</button>
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
