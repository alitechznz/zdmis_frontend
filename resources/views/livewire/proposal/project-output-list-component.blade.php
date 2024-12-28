<div>
    <form wire:submit.prevent="saveProjectProposalOutput" class="row g-3 needs-validation" novalidate="">
        <div class="col-md-12">
            <h3 class="sub-title">Project Output</h3>
        </div>
        <div class="col-md-12">
            <input type="text" wire:model="proposal_output_name" class="form-control @error('proposal_output_name') is-invalid @enderror" placeholder="Enter output">
            @error('proposal_output_name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-9">
            <select wire:model="proposal_outcome_name" class="form-select @error('proposal_outcome_name') is-invalid @enderror">
                <option value="">--- Choose Proposal Outcome ---</option>
                @foreach($project_proposal_outcomes as $project_outcome_name)
                    <option value="{{ $project_outcome_name['id'] }}">{{ $project_outcome_name['name'] }}</option>
                @endforeach
            </select>
            @error('proposal_outcome_name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-3">
            <select wire:model="proposal_output_period" class="form-select @error('proposal_output_period') is-invalid @enderror">
                <option value="">--- Choose Period ---</option>
                <option value="Quarter 1">Quarter 1</option>
                <option value="Quarter 2">Quarter 2</option>
                <option value="Quarter 3">Quarter 3</option>
                <option value="Quarter 4">Quarter 4</option>
            </select>
            @error('proposal_output_period')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 text-end">
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
                <th scope="col">Outcome </th>
                <th scope="col">Report_Period </th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($project_proposal_outputs as $project_proposal_output)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td class="text-nowrap" title="{{ $project_proposal_output->output }}">{{ Str::limit($project_proposal_output->output, 100, '...') }}</td>
                    <td class="text-nowrap" title="{{ $project_proposal_output?->projectOutcome?->name }}">{{ Str::limit($project_proposal_output?->projectOutcome?->name, 100, '...') }}</td>
                    <td>{{ $project_proposal_output->reporting_period }}</td>
                    <th>
                        <button wire:confirm="Are you sure you want to delete this output?" wire:click.prevent="deleteProjectProposalOutput({{ $project_proposal_output->id }})" class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </th>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-danger">
                        No output in this list
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
