<div>
    {{-- Do your work, then step back. --}}
    <form class="row g-3 needs-validation custom-input" novalidate="">
        <div class="col-md-12">
            <label for="project_name">Project Name</label>
            <input wire:model="project_name" type="text" class="form-control @error('project_name') is-invalid @enderror" placeholder="Project name">
            @error($project_name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-xxl-12 col-sm-12">
            <label class="form-label" for="validationCustom04">Medium-Term Development plan </label>
            <select class="form-select @error('plan_id') is-invalid @enderror" id="validationCustom04" required="" wire:model="plan_id">
                <option value="">--- Choose ---</option>
                @foreach ($middle_term_plans as $middle_term_plan)
                    <option value="{{$middle_term_plan->id }}">{{$middle_term_plan->name }}</option>
                @endforeach
            </select>
            @error($plan_id)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-xxl-12 col-sm-12">
            <label class="form-label" for="validationCustom041">Strategic Area </label>
            <select class="form-select @error('strategic_area') is-invalid @enderror" id="validationCustom041" required="" wire:model="strategic_area">
                <option value="">--- Choose ---</option>
                @foreach ($middle_term_strategic_area as $mt_strategic_area)
                    <option value="{{$mt_strategic_area->id }}">{{$mt_strategic_area->name }}</option>
                @endforeach
            </select>
            @error($strategic_area)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-xxl-12 col-sm-12">
            <label class="form-label" for="validationCustom043">Priority Area </label>
            <select class="form-select @error('priority_area') is-invalid @enderror" id="validationCustom043" required="" wire:model="priority_area">
                <option value="">--- Choose ---</option>
                @foreach ($middle_term_priority_area as $mt_term_priority_area)
                    <option value="{{$mt_term_priority_area->id }}">{{$mt_term_priority_area->name }}</option>
                @endforeach
            </select>
            @error($priority_area)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

      <div class="col-12 text-end mb-3">
        <button type="submit" class="btn btn-success" wire:click.prevent="saveProgramProject">
            <i class="fa fa-save"></i> Save
        </button>
      </div>
    </form>


    <div class="table-responsive custom-scrollbar">
        <table class="table table-dashed">
                    <thead>
                    <tr>
                        <th scope="col">Id </th>
                        <th scope="col">Project_Name </th>
                        <th scope="col">Plan</th>
                        <th scope="col">Strategic_Area</th>
                        <th scope="col">Priority_Area</th>
                        <th width="120"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($program_projects as $program_project)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td title="{{ $program_project->project_name }}">
                                {{ Str::limit($program_project->project_name, 30, '...') }}
                            </td>
                            <td title ="{{ $program_project->plan->name }}">
                                {{ Str::limit($program_project->plan->name, 30, '...') }}
                            </td>
                            <td title="{{ $program_project->strategicArea->name }}">
                                {{ Str::limit($program_project->strategicArea->name, 30, '...') }}
                            </td>
                            <td title ="{{ $program_project->priorityArea->name }}">
                                {{ Str::limit($program_project->priorityArea->name, 30, '...') }}
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" wire:click.prevent="deleteProgramProject({{ $program_project->id }})" wire:confirm="Are you sure you want to delete this project?">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-danger text-center">
                                No project found
                            </td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
    </div>
</div>
