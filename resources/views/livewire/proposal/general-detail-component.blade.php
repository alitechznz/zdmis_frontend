<div>
    <form wire:submit.prevent="SaveGeneralDetail" class="row g-3 needs-validation custom-input" novalidate="">
        <div class="col-xxl-12 col-sm-12">
          <label class="form-label" for="validationCustom0-a">Project Title<span class="txt-danger">*</span></label>
          <input class="form-control" id="validationCustom0-a" wire:model="project_title" type="text" placeholder="Enter Project Title" required="">
          <div class="valid-feedback">Looks good!</div>
        </div>

        <div class="col-xxl-4 col-sm-6">
          <label class="form-label" for="validationemail-b">Project Start date<span class="txt-danger">*</span></label>
          <input class="form-control" id="validationemail-b" type="date" wire:model="start_date" required="" placeholder="Project Start date">
          <div class="valid-feedback">Looks good!</div>
        </div>
        <div class="col-xxl-4 col-sm-6">
            <label class="form-label" for="validationemail-b1">Project end date<span class="txt-danger">*</span></label>
            <input class="form-control" id="validationemail-b1" type="date" required="" wire:model="end_date" placeholder="Project end date">
            <div class="valid-feedback">Looks good!</div>
        </div>
        <div class="col-xxl-12 col-sm-12">
            <label class="form-label" for="validationCustom04"> Project Category </label>
            <select class="form-select" id="validationCustom04" required="" wire:model="project_category">
              <option selected="" disabled="" value="">Choose...</option>
              <option value="A:Strategic">Strategic</option>
              <option value="B:Others">Others</option>
            </select>
            <div class="invalid-feedback">Please select a project category.</div>
        </div>

        <div class="col-xxl-12 col-sm-12">
            <label class="form-label" for="validationCustom04">Main Sector</label>
            <select class="form-select select2" id="validationCustom04" required="" wire:model="main_sector">
                <option value="">Select...</option>
                @foreach ($sectors as $sector)
                    <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">Please select a valid Main Sector.</div>
        </div>
        <div class="col-xxl-12 col-sm-12">
          <label class="form-label" for="validationCustom05">Project Outcome</label>
          <input class="form-control" id="validationCustom05" type="text" required="" wire:model="project_outcome">
          <div class="invalid-feedback">Please provide a valid Project Outcome.</div>
        </div>

        @if($selected_class == 'Project')
            <div class="col-xxl-12 col-sm-12">
                <label class="form-label" for="validationCustom04">Medium-Term Development plan </label>
                <select class="form-select" id="validationCustom04" required="" wire:model="plan_id" wire:change="planChanged($event.target.value)">
                <option value="">--- Choose ---</option>
                    @foreach ($middle_term_plans as $middle_term_plan)
                        <option value="{{$middle_term_plan->id }}">{{$middle_term_plan->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xxl-12 col-sm-12">
                <label class="form-label" for="validationCustom041">Strategic Area </label>
                <select class="form-select" id="validationCustom041" required="" wire:model="strategic_area" wire:change="strategicAreaChanged($event.target.value)">
                <option value="">--- Choose ---</option>
                    @foreach ($middle_term_strategic_area as $mt_strategic_area)
                        <option value="{{$mt_strategic_area->id }}">{{$mt_strategic_area->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xxl-12 col-sm-12">
                <label class="form-label" for="validationCustom043">Priority Area </label>
                <select class="form-select" id="validationCustom043" required="" wire:model="priority_area">
                <option value="">--- Choose ---</option>
                    @foreach ($middle_term_priority_area as $mt_term_priority_area)
                        <option value="{{$mt_term_priority_area->id }}">{{$mt_term_priority_area->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="col-xxl-12 col-sm-12">
            <label class="form-label" for="validationCustom04">Sector Policy and Plan</label>
            <input class="form-control" id="validationCustom05" type="text"  wire:model="contribution_sector">
            <div class="invalid-feedback">Please select a valid Sector Policy and Plan.</div>
        </div>
        <div class="col-xxl-12 col-sm-12">
            <label class="form-label" for="validationemail-b11">Administrative Unit</label>
            <input class="form-control" id="validationemail-b11" type="text" wire:model="organization_name" value="{{ $organization_name }}" readonly>
            <div class="invalid-feedback">Please select a valid Administrative Unit.</div>
        </div>

        <div class="col-xxl-12 col-sm-12">
            <label class="form-label" for="validationCustom04">Responsible Officer</label>
            <select class="form-select" id="validationCustom04" required="" wire:model="responsible_user">
              <option selected=""  value="">Choose...</option>
                @forelse ($selected_ministry_user as $user)
                    <option value="{{$user->id }}">{{$user->full_name }}</option>
                @empty
                        <option value="">Select...</option>
                @endforelse
            </select>
            <div class="invalid-feedback">Please select a valid Responsible Officer</div>
        </div>
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> Save
            </button>
        </div>
      </form>
</div>

