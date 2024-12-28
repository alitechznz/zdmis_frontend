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

    <!-- Baseline filter -->
    <div class="mb-3"  style="display: flex; align-items: center; gap:20px; width:100%;">
        <input type="search" wire:model.live="search_keyword" class="form-control" placeholder="Search target..." style="flex-grow: 0; flex-shrink: 0; flex-basis: 25%;">
        <select id="indicatorSelector" class="form-select" wire:model.live="search_baseline" wire:click.prevent="fetchFilter" style="flex-grow: 0; flex-shrink: 0; flex-basis: 58%;">
            <option value="">--- Select ---</option>
            @foreach ($baselines as $baseline)
                <option value="{{ $baseline->id }}">{{ $baseline->name }}</option>
            @endforeach
        </select>
        @if($search_baseline)
            <div class="float-end" style="flex-grow: 0; flex-shrink: 0; flex-basis: 13%;">
                @can('add target')
                <a wire:click.prevent="create" href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-target" wire:click='create'>
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
                <th scope="col">Target_Name</th>
                <th scope="col">Unit</th>
                <th scope="col">Value</th>
                <th scope="col">Year</th>
                <th width="220">Actions</th>
            </tr>
            </thead>
            <tbody x-ref="tbody">
            @forelse ($targets as $target)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $target->name }}</td>
                    <td>{{ $target->unitValue?->unit_name }}</td>
                    <td>{{ $target->value }}</td>
                    <td>{{ $target->year }}</td>
                    <td style="display: flex; gap: 5px;">
                        @can('edit target')
                        <a href="#" wire:click="edit({{ $target->id }})"
                            class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-target"> Edit</a>
                        @endcan
                        @can('delete target')
                        <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$target->id}})"
                            data-bs-toggle="modal" data-bs-target="#deleteModaltarget">Delete</a>
                        @endcan


                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-danger text-center"> No Target Found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ $targets->links() }}
    </div>




    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-target" tabindex="-1" role="dialog"
         aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">@if($update)
                            Update
                        @else
                            Add
                        @endif Target</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-4">
                            <label for="name">Target Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name"
                                   class="form-control @error("name") is-invalid @enderror" id="name" placeholder="Enter Target Name">
                            @error("name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="unit">Unit <span class="text-danger">*</span></label>
                            <select wire:model="unit" class="form-control @error("unit") is-invalid @enderror"
                                    id="unit">
                                <option value="">--Choose--</option>
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                @endforeach
                            </select>
                            @error("unit")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-sm-12 col-md-3">
                            <label for="value">Value <span class="text-danger">*</span></label>
                            <input type="text" wire:model="value"
                                   class="form-control @error("value") is-invalid @enderror" id="value" placeholder="Enter Target Value">
                            @error("value")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-sm-12 col-md-3">
                            <label for="year">Year <span class="text-danger">*</span></label>
                            <input type="number" wire:model="year"
                                   class="form-control @error("year") is-invalid @enderror" id="year" placeholder="YYYY">
                            @error("year")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
{{--                        @if($category == "middle term" or $category == "short term")--}}
{{--                            <div class="mb-4">--}}
{{--                                <label for="pillar_link">Link</label>--}}
{{--                                <select wire:model="link_id" class="form-control @error("link_id") is-invalid @enderror" id="pillar_link">--}}
{{--                                    <option value="">-- Choose --</option>--}}
{{--                                    @foreach($links as $link)--}}
{{--                                        <option value="{{ $link->id }}">{{ $link->name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                @error("link_id")--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    {{ $message }}--}}
{{--                                </div>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        @endif--}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal" wire:click='create'>
                                Close
                            </button>
                            <button type="button" wire:click.prevent="store" class="{{ $update ? 'btn btn-success' : 'btn btn-primary' }}">  {{ $update ? 'Update' : 'Add' }}</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModaltarget" data-backdrop="false" tabindex="-1" role="dialog"
         aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete <strong>{{ $delete_confirm? $delete_confirm->name: ''  }}</strong> ?
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
    </div>

    @push('scripts')
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.
                on('closeModal', (event) => {
                    $('#modal-target').modal('hide')
                });
            });
        </script>
    @endpush
</div>
