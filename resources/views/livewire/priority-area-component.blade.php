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

    <!-- Plan filter -->
    <div class="my-3"  style="display: flex; align-items: center; gap:25px; width:100%">
        <input type="search" wire:model.live="search_keyword" class="form-control" placeholder="Search ..." style="flex-grow: 0; flex-shrink: 0; flex-basis: 25%;">
        <select id="planSelector" class="form-select" wire:model.live="search_pillar" wire:click.prevent="fetchFilter" style="flex-grow: 0; flex-shrink: 0; flex-basis: 58%;">
            <option value="">Select @if($category == "long term") Pillar @else Strategic area @endif</option>
            @foreach ($pillars as $pillar)
                <option value="{{ $pillar->id }}">{{ $pillar->name }}</option>
            @endforeach
        </select>
        @if($search_pillar)
            <div class="float-end" style="flex-grow: 0; flex-shrink: 0; flex-basis: 13%;">
                @can('add priority area')
                <a wire:click.prevent="create" href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-priorityarea" wire:click='create'>
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
                    <th scope="col">SN </th>
                    <th scope="col">Priority_Area </th>
                    <th scope="col">Description </th>
                    <th width="220">Actions</th>
                </tr>
            </thead>
            <tbody x-ref="tbody">
                @forelse ($priorityareas as $priorityarea)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td title="{{ $priorityarea->name }}">{{ Str::limit($priorityarea->name, 40, '...') }}</td>
                        <td title="{{ $priorityarea->description }}">{{ Str::limit($priorityarea->description, 40, '...') }}</td>
                        <td style="display:flex; gap:5px">
                            @can('edit priority area')
                            <a href="#" wire:click="edit({{ $priorityarea->id }})"
                                class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-priorityarea">
                                 Edit </a>
                            @endcan
                            @can('delete priority area')
                            <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$priorityarea->id}})"
                                data-bs-toggle="modal" data-bs-target="#deleteModalpriorityarea">
                                 Delete</a>
                            @endcan
                          
                           
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-danger text-center"> No PriorityArea Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $priorityareas->links() }}
    </div>

    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-priorityarea" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">@if($update) Update @else Add @endif Priority Area</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div  class="row">
                        <div class="mb-4">
                            <label for="name">Priority Area Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" class="form-control @error("name") is-invalid @enderror" id="name" placeholder="Enter Priority Area">
                            @error("name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        @if($category == "middle term" or $category == "short term")
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
                        <div class="mb-4" xmlns="http://www.w3.org/1999/html">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea wire:model="description" class="form-control @error("description") is-invalid @enderror" id="description" placeholder="Enter description">
                            </textarea>
                            @error("description")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
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
    <div wire:ignore.self class="modal fade" id="deleteModalpriorityarea" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                    $('#modal-priorityarea').modal('hide')
                });
            });
        </script>
    @endpush
</div>
