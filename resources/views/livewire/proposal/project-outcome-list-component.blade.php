<div>
    <form wire:submit.prevent="saveProjectProposalOutcome" class="row g-3 needs-validation" novalidate="">
        <div class="col-md-12">
            <h3 class="sub-title">Project Outcome</h3>
        </div>
        <div class="col-md-10">
            <input type="text" wire:model="project_outcome_name" class="form-control @error('outcome') is-invalid @enderror" placeholder="Enter outcome">
            @error('project_outcome_name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-2 text-end">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-plus"></i> Add
            </button>
        </div>
    </form>

    <div class="mt-3 table-responsive custom-scrollbar">
        <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
            <thead class="table-light">
            <tr class="text-capitalize">
                <th scope="col" width="70">SN</th>
                <th scope="col">Name </th>
                <th width="120">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($project_proposal_outcomes as $project_proposal_outcome)
                <tr>
                    <td>{{ $loop->index + 1}}</td>
                    <td class="text-nowrap" title="{{ $project_proposal_outcome->name }}">{{ Str::limit($project_proposal_outcome->name, 120, '...') }}</td>
                    <th>
                        <button wire:confirm="Are you sure you want to delete this outcome?" wire:click.prevent="deleteProjectProposalOutcome({{$project_proposal_outcome->id}})" class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </th>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-danger">
                        No outcome in this list
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
