<div>
    {{-- Success is as dangerous as failure. --}}
    <form wire:submit.prevent="saveProjectOutline" class="row g-3 needs-validation" novalidate="">
        <div class="col-12">
            <label class="form-label" for="txtCardNumber1">Overall approach*</label>
            <textarea class="form-control @error('overallApproach') is_invalid @enderror" wire:model="overallApproach" id="validationTextarea24" placeholder="Analyse the possible solutions/approaches that could be adopted to address the problem, need or opportunity outlined in the justification and give reasons for why the approach/methodology you have chosen is better than the others (for example through cost-benefit analysis). After this justification please describe the approach/methodology of the project in more detail. " required="" rows="8"></textarea>
            @error('overallApproach')
                <span class="text-center"></span>
            @enderror
        </div>
        <div class="col-12">
            <label class="form-label" for="txtCardNumber1">Outputs*</label>
            <textarea class="form-control @error('output') is_invalid @enderror" wire:model="output" id="validationTextarea24" placeholder="A good idea is to break the desired outcome of the project down into outputs that the project will deliver. Make sure that the proposed outcome(s) and outputs are defined as clearly as possible. Outputs can be new policies, guidelines, capacities, products (e.g. buildings or systems) and services. For each of these outputs, list the main activities needed to produce them." required="" rows="8"></textarea>
            @error('output')
            <span class="text-center"></span>
            @enderror
        </div>
        <div class="col-12">
            <label class="form-label" for="txtCardNumber1">Inputs *</label>
            <textarea class="form-control @error('inputs') is_invalid @enderror" wire:model="inputs" id="validationTextarea24" placeholder="Discuss the required inputs (capacity, procurement, technical assistance, funds, materials, etc.) for the project. Try to make a clear link between inputs, activities, outputs and how these relate to the overall outcome." required="" rows="8"></textarea>
            @error('inputs')
            <span class="text-center"></span>
            @enderror
        </div>
        <div class="col-12">
            <label class="form-label" for="txtCardNumber1">Timeframe & Responsibility *</label>
            <textarea class="form-control @error('responsibility') is_invalid @enderror" wire:model="responsibility" id="validationTextarea24" placeholder="Put forward a proposed timeline and give a brief description of the roles and responsibilities in the project." required="" rows="8"></textarea>
            @error('responsibility')
            <span class="text-center"></span>
            @enderror
        </div>
        <div class="col-12">
            <label class="form-label" for="txtCardNumber1">Sustainability & Risk *</label>
            <textarea class="form-control @error('risk') is_invalid @enderror" wire:model="risk" id="validationTextarea24" placeholder="Discuss how stakeholders and beneficiaries will be involved in the planning and implementation of the project. Discuss any other things that will help make the project sustainable.
            Identify the potential risks associated with the project and what can be done to manage these risks. To identify risks, think about what things that could potentially jeopardise or undermine the successful implementation of the project.  Different types of risk include:
            " required="" rows="8"></textarea>
            @error('risk')
            <span class="text-center"></span>
            @enderror
        </div>

        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> Save
            </button>

        </div>
      </form>
</div>
