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
                    <h3>Manage Region </h3>
                </div>
                {{-- <div class="col-sm-6 p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Regions</li>
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
                            class="form-control form-control-sm w-auto" placeholder="Search region ...">
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-end">

                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modal-region" wire:click='create'><i class="fa fa-plus"></i> Add New </a>


                    </div>

                </div>
            </div>
            <div class="table-responsive">
                <table
                    class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                    <thead class="table-light">
                        <tr class="text-capitalize">
                            <th>SN</th>
                            <th @click="sortByColumn" class="cursor-pointer select-none">Region Name <span
                                    class="float-end text-secondary">&#8645;</span>
                            </th>
                            <th @click="sortByColumn" class="cursor-pointer select-none">Status <span
                                    class="float-end text-secondary">&#8645;</span>
                            </th>
                            <th width="220">Actions</th>
                        </tr>
                    </thead>
                    <tbody x-ref="tbody">
                        @php $sn = 1; @endphp
                        @forelse ($regions as $region)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $region->regionName }}</td>
                                <td>
                                    <span
                                        class="badge {{ $region->status == 'active' ? 'badge-light-success' : 'badge-light-danger' }}">
                                        {{ ucfirst($region->status) }}
                                    </span>
                                </td>

                                <td style="display: flex; gap: 5px;">

                                    <a href="#" wire:click="edit({{ $region->id }})"
                                        class="btn btn-sm btn-success" data-bs-toggle="modal"
                                        data-bs-target="#modal-region">
                                        Edit </a>
                                    <a href="#" class="btn btn-sm btn-danger"
                                        wire:click="destroy({{ $region->id }})" data-bs-toggle="modal"
                                        data-bs-target="">
                                        Delete </a>
                                </td>
                            </tr>
                            @php $sn++; @endphp
                        @empty
                            <tr>
                                <td colspan="3" class="text-danger text-center"> No Region Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $regions->links() }}
            </div>
        </div>
    </div>
    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-region" tabindex="-1" role="dialog"
        aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">
                        @if ($update)
                            Update
                        @else
                            Add
                        @endif Region
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-4">
                            <label for="name">Region Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name"
                                class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="Enter Region Name">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select wire:model="status" class="form-control @error('status') is-invalid @enderror"
                                id="status">
                                <option value="">--Choose--</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
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
    <div wire:ignore.self class="modal fade" id="deleteModalregion" data-backdrop="false" tabindex="-1" role="dialog"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete <strong>{{ $delete_confirm ? $delete_confirm->name : '' }}</strong>
                        ?
                    </p>
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

    @push('scripts')
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.on('closeModal', (event) => {
                    $('#modal-region').modal('hide')
                });
            });
        </script>
    @endpush
</div>
