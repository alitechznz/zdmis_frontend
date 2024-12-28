<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <form wire:submit.prevent="SaveProjectDetails" class="row g-3 needs-validation custom-input" novalidate="">
        <div class="col-12">
          <label class="form-label" for="txtCardNumber1">Project background*</label>
          <textarea class="form-control @error('background') is_invalid @enderror" wire:model="background" id="validationTextarea24" placeholder="Give a short briefing on the project context A few paragraphs on Zanzibar as it relates to the project. Then move into more detail on the sector that the project is located in. Include information on previous or forthcoming initiatives in this sector or other initiatives relevant for the project. (350 words maximum)" required="" rows="8"></textarea>
            @error('background')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-12">
          <label class="form-label" for="txtCardNumber1">Project justification*</label>
          <textarea class="form-control @error('justification') is_invalid @enderror" wire:model="justification" id="validationTextarea24" placeholder="Give justifications for the project. A justification should present a problem, challenge, need or opportunity - i.e. why the project is needed. Justifications must relate to the national medium-term development plan (e.g. ZADEP), specific sector problems, sector or district plans or policies. Make sure to explain how the project fits with and contributes to these plans. It is an advantage if the suggested intervention is designed based on research and evidence
          (200 words maximum)" required="" rows="8"></textarea>
            @error('justification')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-12">
          <label class="form-label" for="txtCardNumber1">Proposed objective*</label>
          <textarea class="form-control @error('objective') is_invalid @enderror" wire:model="objective" id="validationTextarea24" placeholder="Project objectives should describe what the project intends to achieve within the specified time frame. A good project objective should contribute toward the project target, outcome or impact-oriented and not output-oriented, and should be SMART.
              (200 words maximum)" required="" rows="8"></textarea>
            @error('objective')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-12">
          <label class="form-label" for="txtCardNumber1">Proposed outcomes*</label>
          <textarea class="form-control @error('outcomes') is_invalid @enderror" wire:model="outcomes" id="validationTextarea24" placeholder="Describe the proposed outcomes of the project. Make sure to link the outcome of the project (what the project will deliver) with the justification. Also try to specify who the project will target as well as who and how many people will benefit from it. Try to make the outcomes as SMART (Specific, Measurable, Achievable, Relevant and Time-bound) as possible. They should be as clear and concrete as possible at this stage of project development.
              (200 words maximum)" required="" rows="8"></textarea>
            @error('outcomes')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-12 text-end">
          <button type="submit" class="btn btn-primary">
              <i class="fa fa-save"></i> Save
          </button>
        </div>

      </form>
</div>
