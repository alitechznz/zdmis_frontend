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
        .card-footer.bg-white {
            border-top: 1px solid #dee2e6;
            background-color: #fff;
            padding: 1rem;
        }

    </style>
    <div class="card mb-5">
        <div class="card-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-6 p-0">
                            <h3>Project Information</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="project">Project <span class="text-danger">*</span></label>
                    <select wire:model="project" class="form-control @error("project") is-invalid @enderror" id="project">
                        <option value="">--Choose--</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->projectname }}</option>
                        @endforeach
                    </select>
                    @error("project")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="project_code">Project Code <span class="text-danger">*</span></label>
                    <input type="text" wire:model="project_code" class="form-control @error("project_code") is-invalid @enderror" id="project_code" readonly disabled>
                    @error("project_code")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                    <label for="report_period">Reporting report_Period <span class="text-danger">*</span></label>
                    <select wire:model="report_period" class="form-control @error("report_period") is-invalid @enderror" id="report_period">
                        <option value="">--Choose--</option>
                        <option value="Annually">Annually</option>
                        <option value="Quarter 1">Quarter 1</option>
                        <option value="Quarter 2">Quarter 2</option>
                        <option value="Quarter 3">Quarter 3</option>
                        <option value="Quarter 4">Quarter 4</option>
                    </select>
                    @error("report_period")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
{{--            <div class="row">--}}
{{--                <div class="col-12 text-end">--}}
{{--                    <button type="button" wire:click.prevent="store" class="{{ $update ? 'btn btn-success' : 'btn btn-primary' }}">  {{ $update ? 'Update' : 'Add' }}</button>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="table-responsive custom-scrollbar my-5">--}}
{{--                <div class="col-6 mb-2">--}}
{{--                    <div class="input-group">--}}
{{--                        <input type="search" wire:model.live="search_keyword" class="form-control form-control-sm w-auto"--}}
{{--                               placeholder="Search project info...">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <table class="table table-bordered table-sm table-hover table-striped compact">--}}
{{--                    <thead class="table-light">--}}
{{--                    <tr class="text-capitalize">--}}
{{--                        <th @click="sortByColumn" class="cursor-pointer select-none">SN <span class="float-end text-secondary">&#8645;</span>--}}
{{--                        <th @click="sortByColumn" class="cursor-pointer select-none">Project_Name <span class="float-end text-secondary">&#8645;</span>--}}
{{--                        </th>--}}

{{--                        <th @click="sortByColumn" class="cursor-pointer select-none">Project_Report <span class="float-end text-secondary">&#8645;</span>--}}
{{--                        </th>--}}

{{--                        <th width="220">Actions</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}

{{--                    <tbody x-ref="tbody">--}}
{{--                    @forelse ($projectInformations as $data)--}}
{{--                        <tr>--}}
{{--                            <td>{{ $loop->iteration }}</td>--}}
{{--                            <td>{{ $data->conceptNote->projectname }}</td>--}}
{{--                            <td>{{ $data->report_period }}</td>--}}
{{--                            <td style="display: flex; gap: 5px;">--}}
{{--                                @can('edit plan')--}}
{{--                                    <a href="#" wire:click="edit({{ $data->id }})"--}}
{{--                                       class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="">--}}
{{--                                        Edit </a>--}}
{{--                                @endcan--}}
{{--                                @can('delete plan')--}}
{{--                                    <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$data->id}})"--}}
{{--                                       data-bs-toggle="modal" data-bs-target="#deleteModalProjectInfo">--}}
{{--                                        Delete </a>--}}
{{--                                @endcan--}}


{{--                            </td>--}}
{{--                        </tr>--}}

{{--                    @empty--}}
{{--                        <tr>--}}
{{--                            <td colspan="8" class="text-danger text-center"> No Data Found</td>--}}
{{--                        </tr>--}}
{{--                    @endforelse--}}
{{--                    </tbody>--}}

{{--                </table>--}}
{{--                {{ $projectInformations->links() }}--}}
{{--            </div>--}}

        </div>
    </div>


    <!-- Delete Modal Project Info -->
    <div wire:ignore.self class="modal fade" id="deleteModalProjectInfo" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
                </div>
                <div class="modal-body">
                    {{-- <p>Are you sure want to delete <strong>{{ $delete_confirm? $delete_confirm->name: ''  }}</strong> ?</p> --}}
                    <p>Are you sure want to delete ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" wire:click.prevent="destroy()" class="btn btn-danger close-modal" data-bs-dismiss="modal">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
