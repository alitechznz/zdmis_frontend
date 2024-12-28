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
                <h3>Manage Projects</h3>
            </div>
            <div class="col-sm-6 p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                            <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a>
                    </li>
                    <li class="breadcrumb-item">Manage Projects</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid default-dashboard">
    <div class="card">
        <div class="card-body">
            <div class="row mb-1">
                <div class="col-6">
                    <div class="input-group">
                        <input type="search" wire:model.live="search_keyword" class="form-control form-control-sm w-auto"
                               placeholder="Search project...">
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-end">
                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-project"
                        ><i class="fa fa-plus"></i> Add project </a>
                    </div>
        
                </div>
            </div>
            <table class="table table-bordered table-sm table-hover table-striped compact">
                <thead class="table-light">
                <tr class="text-uppercase">
                    <th @click="sortByColumn" class="cursor-pointer select-none">Selected Plans <span class="float-end text-secondary">&#8645;</span>
                    </th><th @click="sortByColumn" class="cursor-pointer select-none">Project Proposal <span class="float-end text-secondary">&#8645;</span>
                    </th><th @click="sortByColumn" class="cursor-pointer select-none">Project Name <span class="float-end text-secondary">&#8645;</span>
                    </th><th @click="sortByColumn" class="cursor-pointer select-none">Short Name <span class="float-end text-secondary">&#8645;</span>
                    </th><th @click="sortByColumn" class="cursor-pointer select-none">Sector<span class="float-end text-secondary">&#8645;</span>
                    </th><th @click="sortByColumn" class="cursor-pointer select-none">Star Date <span class="float-end text-secondary">&#8645;</span>
                    </th><th @click="sortByColumn" class="cursor-pointer select-none">End Date <span class="float-end text-secondary">&#8645;</span>
                    </th><th @click="sortByColumn" class="cursor-pointer select-none">Description <span class="float-end text-secondary">&#8645;</span>
                    </th><th @click="sortByColumn" class="cursor-pointer select-none">Status <span class="float-end text-secondary">&#8645;</span>
                    </th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody x-ref="tbody">
                @forelse ($projects as $project)
        
                <tr>
                    <td>{{ $project->selected_plans }}</td><td>{{ $project->project_proposal_id }}</td><td>{{ $project->project_name }}</td><td>{{ $project->short_name }}</td><td>{{ $project->sector_id }}</td><td>{{ $project->start_date }}</td><td>{{ $project->end_date }}</td><td>{{ $project->description }}</td><td>{{ $project->status }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> </a>
                        <a href="#" wire:click="edit({{ $project->id }})"
                           class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-project">
                            Edit </a>
                        <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$project->id}})"
                           data-bs-toggle="modal" data-bs-target="#deleteModalproject">
                            Delete </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-danger text-center"> No Project Found</td>
                </tr>
                @endforelse
                </tbody>
            </table>
            {{ $projects->links() }}
        </div>
    </div>
</div>




    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-project" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">@if($update) Update @else Add @endif Project</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div  class="row">
                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="selected_plans">Selected Plans</label>
                            <input type="text" wire:model="selected_plans" class="form-control @error("selected_plans") is-invalid @enderror" id="selected_plans" placeholder="Selected Plans">
                            @error("selected_plans")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                     


                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="project_proposal">Project proposal</label>
                            <select wire:model="project_proposal" class="form-control @error("project_proposal") is-invalid @enderror" id="project_proposal">
                                <option value="">--Choose--</option>
                                @foreach ($project_proposals as $project_proposal)
                                    <option value="{{ $project_proposal->id }}">{{ $project_proposal->name }}</option>
                                @endforeach
                            </select>
                            @error("project_proposal")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="project_name">Project Name</label>
                            <input type="text" wire:model="project_name" class="form-control @error("project_name") is-invalid @enderror" id="project_name" placeholder="Enter Project Name">
                            @error("project_name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="short_name">Short Name</label>
                            <input type="text" wire:model="short_name" class="form-control @error("short_name") is-invalid @enderror" id="short_name" placeholder="Enter Short Name">
                            @error("short_name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                       

                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="sector">Sector</label>
                            <select wire:model="sector" class="form-control @error("sector") is-invalid @enderror" id="sector">
                                <option value="">--Choose--</option>
                                @foreach ($sectors as $sector)
                                    <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                @endforeach
                            </select>
                            @error("sector")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="start_date">Start Date</label>
                            <input type="date" wire:model="start_date" class="form-control @error("start_date") is-invalid @enderror" id="start_date" placeholder="Enter Start Date">
                            @error("start_date")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="mb-4 col-sm-6 col-md-6 col-lg-6">
                            <label for="end_date">End Date</label>
                            <input type="date" wire:model="end_date" class="form-control @error("end_date") is-invalid @enderror" id="end_date" placeholder="Enter End Date">
                            @error("end_date")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="status">Status</label>
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
                        
                   


                        <div class="mb-4" xmlns="http://www.w3.org/1999/html">
                            <label for="description">Description</label>
                            <textarea wire:model="description" class="form-control @error("description") is-invalid @enderror" id="description" placeholder="Enter description">
                            </textarea>
                            @error("description")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal">Close</button>
                            <button type="button" wire:click.prevent="store" class="btn btn-secondary"> @if($update) Update @else Add @endif</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModalproject" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                    $('#modal-project').modal('hide')
                });
                });
    </script>
    @endpush
</div>
