<div>
    <form wire:submit.prevent="saveProjectProposalActivity" class="row g-3 needs-validation" novalidate="">
        <div class="col-md-12">
            <h3 class="sub-title">Project Activities</h3>
        </div>
        <div class="col-md-12">
            <input type="text" wire:model="proposal_activity_name" class="form-control @error('proposal_activity_name') is-invalid @enderror" placeholder="Enter activity name">
            @error('proposal_activity_name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6">
            <input type="date" wire:model="proposal_activity_start_date" class="form-control @error('proposal_activity_start_date') is-invalid @enderror">
            @error('proposal_activity_start_date')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6">
            <input type="date" wire:model="proposal_activity_end_date" class="form-control @error('proposal_activity_end_date') is-invalid @enderror">
            @error('proposal_activity_end_date')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6">
            <input type="number" wire:model="proposal_activity_planning_amount" class="form-control @error('proposal_activity_planning_amount') is-invalid @enderror" placeholder="Planning Amount">
            @error('proposal_activity_planning_amount')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6">
            <select wire:model="proposal_activity_currency" class="form-select @error('proposal_activity_currency') is-invalid @enderror">
                <option value="">--- Select Currency ---</option>
                <option value="TZS">TZS</option>
                <option value="Dollar">Dollar ($)</option>
            </select>
            @error('proposal_activity_currency')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6">
            <select wire:model="proposal_activity_funding_modality" class="form-select select2 @error('proposal_activity_funding_modality') is-invalid @enderror">
                <option value="">--- Select Funding Modality ---</option>
                @foreach($source_of_financial as $source)
                    <option value="{{ $source->id }}">{{ $source->name . ' ' . $source->category }}</option>
                @endforeach
            </select>
            @error('proposal_activity_funding_modality')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6">
            <select wire:model="proposal_activity_output" class="form-select @error('proposal_activity_output') is-invalid @enderror">
                <option value="">--- Link to Project Proposal Output ---</option>
                @foreach($project_proposal_outputs as $output)
                    <option value="{{ $output['id'] }}">{{ $output['output'] }}</option>
                @endforeach
            </select>
            @error('proposal_activity_output')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12">
            <textarea wire:model="proposal_activity_resource" class="form-control @error('proposal_activity_resource') is-invalid @enderror" placeholder="Enter resources of the activity"></textarea>
            @error('proposal_activity_resource')
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
                <th scope="col">Name</th>
                <th scope="col">Funding_Modality</th>
                <th scope="col">Amount</th>
                <th scope="col">Currency</th>
                <th scope="col">Reason</th>
                <th scope="col">Start_Date</th>
                <th scope="col">End_Date</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($project_proposal_activities as $activity)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td class="text-nowrap" title="{{ $activity->activity_name }}">{{ Str::limit($activity->activity_name, 100, '...') }}</td>
                    <td>{{ $activity->sourceFinancing->name }}</td>
                    <td>{{ $activity->planning_amount }}</td>
                    <td>{{ $activity->currency }}</td>
                    <td class="text-nowrap" title="{{ $activity->activity_reason }}">{{ Str::limit($activity->activity_reason, 100, '...') }}</td>
                    <td class="text-nowrap">{{ $activity->start_date }}</td>
                    <td class="text-nowrap">{{ $activity->end_date }}</td>
                    <td>
                        <button wire:confirm="Are you sure you want to delete activity" wire:click="deleteActivity({{ $activity->id }})" class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center text-danger">No activities found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
