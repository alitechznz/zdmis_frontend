<div>
    <form wire:submit.prevent="saveProjectProposalIndicator" class="mb-4">
        <div class="row">
            <!-- Activity ID Dropdown -->
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label for="activity_id">Output :</label>
                    <select wire:model="project_proposal_output" class="form-control @error('project_proposal_output') is_invalid @enderror">
                        <option value="">--- choose ---</option>
                        @foreach($project_proposal_outputs as $_output)
                            <option value="{{ $_output['id'] }}">{{ $_output['output'] }}</option>
                        @endforeach
                    </select>
                    @error('project_proposal_output')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- Priority Area ID Dropdown -->
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label for="priority_area_id">Priority Area :</label>
                    <select wire:model.live="project_proposal_indicator_priority_area" class="form-control @error('project_proposal_indicator_priority_area') is_invalid @enderror">
                        <option value="">--- choose ---</option>
                        @foreach($project_proposal_m_priority_areas as $area)
                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </select>
                    @error('project_proposal_indicator_priority_area') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <!-- Indicator ID Dropdown -->
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label for="indicator_id">Linked Indicator :</label>
                    <select wire:model="project_proposal_m_indicator" class="form-control @error('project_proposal_m_indicator') is_invalid @enderror">
                        <option value="">--- choose ---</option>
                        @foreach($project_proposal_m_indicators as $_indicator)
                            <option value="{{ $_indicator->id }}">{{ $_indicator->name }}</option>
                        @endforeach
                    </select>
                    @error('project_proposal_m_indicator') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <!-- Indicator Name Input -->
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label>Indicator Name :</label>
                    <input wire:model="project_proposal_indicator_name" type="text" class="form-control @error('project_proposal_indicator_name') is_invalid @enderror" placeholder="Indicator Name">
                    @error('project_proposal_indicator_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <!-- KPI Definition Input -->
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label>KPI Definition :</label>
                    <input wire:model="project_proposal_indicator_kpi_definition" type="text" class="form-control @error('project_proposal_indicator_kpi_definition') is_invalid @enderror" placeholder="KPI Definition">
                    @error('project_proposal_indicator_kpi_definition') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <!-- Baseline Value Input -->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label>Baseline Value :</label>
                    <input wire:model="project_proposal_indicator_baseline_value" type="text" class="form-control @error('project_proposal_indicator_baseline_value') is_invalid @enderror" placeholder="Baseline Value">
                    @error('project_proposal_indicator_baseline_value') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <!-- Baseline Unit Input -->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label>Baseline Unit :</label>
                    <select wire:model="project_proposal_indicator_baseline_unit" class="form-select @error('project_proposal_indicator_baseline_unit') is_invalid @enderror">
                        <option value="">--- Select ---</option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->unit_name }}">{{ $unit->unit_name }}</option>
                        @endforeach
                    </select>
                    @error('project_proposal_indicator_baseline_unit') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label>Baseline Year :</label>
                    <input wire:model="project_proposal_indicator_baseline_year" type="year" class="form-control @error('project_proposal_indicator_baseline_year') is_invalid @enderror" placeholder="Baseline Year">
                    @error('project_proposal_indicator_baseline_year') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <!-- Target Value Input -->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label>Target Value :</label>
                    <input wire:model="project_proposal_indicator_target_value" type="text" class="form-control @error('project_proposal_indicator_target_value') is_invalid @enderror" placeholder="Target Value">
                    @error('project_proposal_indicator_target_value') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <!-- Target Unit Input -->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label>Target Unit :</label>
                    <select wire:model="project_proposal_indicator_target_unit" class="form-select @error('project_proposal_indicator_target_unit') is_invalid @enderror">
                        <option value="">--- Select ---</option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->unit_name }}">{{ $unit->unit_name }}</option>
                        @endforeach
                    </select>
                    @error('project_proposal_indicator_target_unit') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label>Target Year :</label>
                    <input wire:model="project_proposal_indicator_baseline_year" type="year" class="form-control @error('project_proposal_indicator_baseline_year') is_invalid @enderror" placeholder="Baseline Year">
                    @error('project_proposal_indicator_baseline_year') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <!-- Means of Verification Textarea -->
            {{--                                          <div class="col-md-12">--}}
            {{--                                              <div class="form-group">--}}
            {{--                                                  <label>Means of Verification:</label>--}}
            {{--                                                  <textarea wire:model="project_proposal_indicator_means_verification" class="form-control @error('project_proposal_indicator_means_verification') is_invalid @enderror" placeholder="Describe how this will be measured"></textarea>--}}
            {{--                                                  @error('project_proposal_indicator_means_verification') <span class="text-danger">{{ $message }}</span> @enderror--}}
            {{--                                              </div>--}}
            {{--                                          </div>--}}
            <!-- Assumptions and Risks Textarea -->
            {{--                                          <div class="col-md-12">--}}
            {{--                                              <div class="form-group">--}}
            {{--                                                  <label>Assumptions and Risks:</label>--}}
            {{--                                                  <textarea wire:model="project_proposal_indicator_assumption_risk" class="form-control @error('project_proposal_indicator_assumption_risk') is_invalid @enderror" placeholder="List any assumptions or risks"></textarea>--}}
            {{--                                                  @error('project_proposal_indicator_assumption_risk') <span class="text-danger">{{ $message }}</span> @enderror--}}
            {{--                                              </div>--}}
            {{--                                          </div>--}}
            <!-- Submit Button -->
            <div class="col-md-12 text-end mt-3">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> Save
                </button>
            </div>
        </div>
    </form>

    <div class="table-responsive custom-scrollbar">
        <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Outcome</th>
                <th scope="col">Priority<small class="text-white">_</small>Area</th>
                <th scope="col">Linked<small class="text-white">_</small>Indicator</th>
                <th scope="col">Indicator<small class="text-white">_</small>Name</th>
                <th scope="col">KPI<small class="text-white">_</small>Definition</th>
                <th scope="col">Baseline</th>
                <th scope="col">Target</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($project_proposal_indicators as $indicator)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td class="text-nowrap" title="{{ $indicator->projectProposalOutput->output }}">{{ Str::limit($indicator->projectProposalOutput->output, 100, '...') }}</td>
                    <td class="text-nowrap" title="{{ $indicator->priorityArea->name }}">{{ Str::limit($indicator->priorityArea->name, 80, '...') }}</td>
                    <td class="text-nowrap" title="{{ $indicator->indicator->name }}">{{ Str::limit($indicator->indicator->name, 80, '...') }}</td>
                    <td class="text-nowrap" title="{{ $indicator->indicator_name }}">{{ Str::limit($indicator->indicator_name, 80, '...') }}</td>
                    <td class="text-nowrap" title="{{ $indicator->kpi_definition }}">{{ Str::limit($indicator->kpi_definition, 80, '...') }}</td>
                    <td>{{ $indicator->baseline_value }} {{ $indicator->baseline_unit }}</td>
                    <td>{{ $indicator->target_value }} {{ $indicator->target_unit }}</td>
                    <td>
                        <button wire:confirm="Are you sure you want to delete indicator" wire:click="deleteProjectProposalIndicator({{ $indicator->id }})" class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-12 text-end mt-3">
            <button type="button" class="btn btn-info" wire:click="proposalFinish">Finish</button>
        </div>
    </div>
</div>
