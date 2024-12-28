<div>
    <form wire:submit.prevent="saveProjectProposalAttachment" class="row g-3 needs-validation" novalidate="" enctype="multipart/form-data">
        <div class="col-md-12">
            <h3 class="sub-title">Project Attachments</h3>
        </div>
        <div class="col-md-12">
            <input type="text" wire:model="proposal_attachment_name" class="form-control @error('proposal_attachment_name') is-invalid @enderror" placeholder="Enter attachment name">
            @error('proposal_attachment_name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6">
            <select wire:model="proposal_attachment_type" class="form-select @error('proposal_attachment_type') is-invalid @enderror">
                <option value="">--- Select Type ---</option>
                <option value="TSH">EIA</option>
                <option value="Dollar">HIA</option>
                <option value="Dollar">Feasibility study</option>
                <option value="Dollar">HIV prevention plan</option>
                <option value="Dollar">Other relevant documentation</option>
            </select>
            @error('proposal_attachment_type')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6">
            <input type="file" wire:model="proposal_attachment_file" class="form-control @error('proposal_attachment_file') is-invalid @enderror" placeholder="Planning Amount">
            @error('proposal_attachment_file')
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
                <th scope="col">TYpe</th>
                <th width="150"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($project_proposal_attachments as $attachment)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td class="text-nowrap" title="{{ $attachment->attachment_name }}">{{ Str::limit($attachment->attachment_name, 100, '...') }}</td>
                    <td>{{ $attachment->type }}</td>
                    <td>
                        <button wire:confirm="Are you sure you want to delete attachment" wire:click="deleteAttachment({{ $attachment->id }})" class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center text-danger">No attachment found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
