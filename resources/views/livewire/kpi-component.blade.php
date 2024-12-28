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

    <!-- Aspiration filter -->
    <div class="mb-3"  style="display: flex; align-items: center; gap:20px; width: 100%">
        <input type="search" wire:model.live="search_keyword" class="form-control" placeholder="Search here..." style="flex-grow: 0; flex-shrink: 0; flex-basis: 25%;">
        <select id="aspirationSelector" class="form-select" wire:model.live="search_aspiration" wire:click.prevent="fetchFilter" style="flex-grow: 0; flex-shrink: 0; flex-basis: 58%;">
            <option value="">--- Select ---</option>
            @foreach ($aspirations as $aspiration)
                <option value="{{ $aspiration->id }}">{{ $aspiration->name }}</option>
            @endforeach
        </select>
        @if($search_aspiration)
            <div class="float-end" style="flex-grow: 0; flex-shrink: 0; flex-basis: 13%;">
                @can('add kpi')
                <a wire:click.prevent="create" href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-kpi" wire:click='create'>
                    <i class="fa fa-plus"></i> Add New
                </a>
                @endcan

            </div>
        @endif
    </div>

    <div class="table-responsive custom-scrollbar">
        <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                <thead class="table-light">
                <tr class="text-capitalize">
                    <th scope="col">SN</th>
                    <th scope="col">Indicator_Name</th>
                    <th scope="col">Definition</th>
                    <th width="220">Actions</th>
                </tr>
                </thead>
                <tbody x-ref="tbody">
                @forelse ($kpis as $kpi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td title="{{ $kpi->name }}">{{ Str($kpi->name, 40, '...') }}</td>
                        <td title="{{ $kpi->kpi_definition }}">{{ Str::limit($kpi->kpi_definition, 45, '...') }}</td>
                        <td style="display: flex; gap: 5px;">
                            @can('edit kpi')
                            <a href="#" wire:click="edit({{ $kpi->id }})"
                                class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-kpi">
                                Edit </a>
                            @endcan
                            @can('delete kpi')
                            <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$kpi->id}})"
                                data-bs-toggle="modal" data-bs-target="#deleteModalkpi">
                                 Delete </a>
                            @endcan


                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-danger text-center"> No KPI Found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{ $kpis->links() }}
        </div>

    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-kpi" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">@if($update) Update @else Add @endif Indicator</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div  class="row">
                        <div class="mb-4 col-sm-12 col-md-12 col-lg-12">
                            <label for="name">KPI Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" class="form-control @error("name") is-invalid @enderror" id="name" placeholder="Enter KPI Name">
                            @error("name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-sm-12 col-md-12 col-lg-12" xmlns="http://www.w3.org/1999/html">
                            <label for="kpi_definition">KPI Definition</label>
                            <textarea wire:model="kpi_definition" class="form-control @error("kpi_definition") is-invalid @enderror" id="kpi_definition" placeholder="Enter KPI Definition">
                            </textarea>
                            @error("kpi_definition")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        @if($type == "International")
                            <div class="mb-4">
                                <label for="priority_area">Priority area <span class="text-danger">*</span></label>
                                <select wire:model.live="priority" class="form-control @error("priority") is-invalid @enderror" id="priority_area">
                                    <option value="">-- Choose --</option>
                                    @foreach($priority_areas as $pa)
                                        <option value="{{ $pa->id }}">{{ $pa->name }}</option>
                                    @endforeach
                                </select>
                                @error("priority")
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        @endif
                        @if($category == "middle term" or $category == "short term" or $type == "International")
                            <div class="mb-4">
                                <label for="pillar_link">Link <span class="text-danger">*</span></label>
                                <select wire:model="link_id" class="form-control @error("link_id") is-invalid @enderror" id="pillar_link">
                                    <option value="">-- Choose --</option>
                                    @foreach($links as $link)
                                        <option value="{{ $link->id }}">{{ $link->name }}</option>
                                    @endforeach
                                </select>
                                @error("link_id")
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        @endif

                        <div class="modal-footer">
                            <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal" wire:click='create'>Close</button>
                            <button type="button" wire:click.prevent="store" class="{{ $update ? 'btn btn-success' : 'btn btn-primary' }}">  {{ $update ? 'Update' : 'Add' }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->
    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModalkpi" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete <strong>{{ $delete_confirm? $delete_confirm->name: ''  }}</strong> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" wire:click.prevent="destroy()" class="btn btn-danger close-modal" data-bs-dismiss="modal">Yes, Delete</button>
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
            document.addEventListener('livewire:initialized', () => {
                @this.on('closeModal', (event) => {
                    $('#modal-kpi').modal('hide')
                });
            });
        </script>
    @endpush
</div>
