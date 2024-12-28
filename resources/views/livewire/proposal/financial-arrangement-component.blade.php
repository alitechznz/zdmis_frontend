<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <form wire:submit.prevent="SaveProjectFinance" class="row g-3 needs-validation" novalidate="">
        <div class="col-xxl-12">
            <div class="card-wrapper border rounded-3 checkbox-checked">
              <h3 class="sub-title">Select your Financing Modality</h3>
              <div class="radio-form">
                <div class="form-check">
                  <input class="form-check-input" wire:model="financingModality" id="flexRadioDefault1" type="radio" value="SMZ Central" name="flexRadioDefault-a">
                  <label class="form-check-label" for="flexRadioDefault1">Zanzibar Government (SMZ Central)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" wire:model="financingModality" id="flexRadioDefault1" type="radio" value="SMZ LGAs" name="flexRadioDefault-a">
                    <label class="form-check-label" for="flexRadioDefault1">Zanzibar Government (SMZ LGAs)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" wire:model="financingModality" id="flexRadioDefault1" type="radio" value="SMZ & Donor Loan" name="flexRadioDefault-a">
                    <label class="form-check-label" for="flexRadioDefault1">Zanzibar Government & Donor (DP)-Loan</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" wire:model="financingModality" id="flexRadioDefault1" type="radio" value="SMZ & Donor Grant" name="flexRadioDefault-a">
                    <label class="form-check-label" for="flexRadioDefault1">Zanzibar Government & Donor (DP)- Grant</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" wire:model="financingModality" id="flexRadioDefault2" type="radio" value="Donor Grant" name="flexRadioDefault-a" checked="">
                  <label class="form-check-label" for="flexRadioDefault2">Donors’ Funds (Grant)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" wire:model="financingModality" id="flexRadioDefault2" type="radio" value="Donor Loan" name="flexRadioDefault-a" checked="">
                    <label class="form-check-label" for="flexRadioDefault2">Donors’ Funds (Loan)</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" wire:model="financingModality" id="flexRadioDefault3" type="radio" value="Investment" name="flexRadioDefault-a" checked="">
                  <label class="form-check-label" for="flexRadioDefault3">Private Sector Investment</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" wire:model="financingModality" id="flexRadioDefault3" type="radio" value="PPP" name="flexRadioDefault-a" checked="">
                    <label class="form-check-label" for="flexRadioDefault3">Public-Private Partnership (PPP)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" wire:model="financingModality" id="flexRadioDefault3" type="radio" value="NGO" name="flexRadioDefault-a" checked="">
                    <label class="form-check-label" for="flexRadioDefault3">Private Foundations (NGO)</label>
                </div>
              </div>
            </div>
        </div>
        {{-- <div class="col-xxl-12 col-sm-12">
            <label class="form-label" for="validationCustom05">Project GFS Code</label>
            <input class="form-control @error('gfsCode') is_invalid @enderror" id="validationCustom05" type="text" wire:model="gfsCode" required="">
            @error('gfsCode')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div> --}}
        <div class="col-xxl-12 col-sm-12">
            <label class="form-label" for="validationCustom-b">Total Project Cost (TZS)<span class="txt-danger">*</span></label>
            <input class="form-control @error('totalProjectCost') is_invalid @enderror" id="validationCustom-b" wire:model="totalProjectCost" type="text" placeholder="Enter Total Project Cost" required="">
            @error('totalProjectCost')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
      <div class="col-12">
          <label class="form-label" for="txtCardNumber1">Tentative Financing Arrangement</label>
{{--          <textarea id="editor1" name="editor1" cols="30" rows="10"></textarea>--}}
          <textarea class="form-control @error('tentativeFinancingArrangement') is_invalid @enderror" id="validationTextarea24" wire:model.defer="tentativeFinancingArrangement" placeholder="State and justify the proposed budget. Try to give a summary breakdown of costs - e.g. training component, procurement component, construction component, etc. A full breakdown is not needed at this stage try to be as detailed as possible.
            Suggest how you expect the project to be financed:  Zanzibar Government funds, donors’ funds, private sector investment, public-private partnership, private foundations, etc.
            (350 words maximum)
            " required="" rows="8"></textarea>
          @error('tentativeFinancingArrangement')
          <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>


      <div class="col-12 text-end">
          <button type="submit" class="btn btn-primary">
              <i class="fa fa-save"></i> Save
          </button>
          @if($type == "National Concept Note")
            <button type="button" class="btn btn-info" wire:click="ConceptFinish">Finish</button>
          @endif
      </div>
    </form>
</div>

@push('scripts')
    <script src="{{ asset('assets/js/editor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/js/editor/ckeditor/adapters/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/editor/ckeditor/styles.js') }}"></script>
    <script src="{{ asset('assets/js/editor/ckeditor/ckeditor.custom.js') }}"></script>

    <script>
        document.addEventListener('livewire:load', function () {
            CKEDITOR.replace('validationTextarea24');
            CKEDITOR.instances['validationTextarea24'].on('change', function() {
                @this.set('tentativeFinancingArrangement', this.getData());
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
        const inputElement = document.getElementById('validationCustom-b');

        inputElement.addEventListener('input', updateValue);

        function updateValue(e) {
            let value = e.target.value;
            // Remove all non-digits and then format
            value = value.replace(/\D/g, '');
            value = parseInt(value, 10);

            // Check if value is a number
            if (!isNaN(value)) {
                // Format the number with commas and convert back to string
                e.target.value = value.toLocaleString();
            } else {
                e.target.value = '';
            }
        }
        });
    </script>

@endpush
