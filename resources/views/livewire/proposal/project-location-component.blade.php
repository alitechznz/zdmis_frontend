<div>
    <form class="row g-3 needs-validation custom-input" novalidate="">
        <div class="col-md-12">
          <div class="card-wrapper border rounded-3 checkbox-checked">
            <h3 class="sub-title">Select your location level</h3>
            <div class="radio-form">
              <div class="form-check">
                <input class="form-check-input" id="flexRadioDefault1" type="radio" name="flexRadioDefault-a" wire:model.live="selectedLocationLevel" value="Region">
                <label class="form-check-label" for="flexRadioDefault1">Region</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" id="flexRadioDefault2" type="radio" name="flexRadioDefault-a" checked="" wire:model.live="selectedLocationLevel" value="District">
                <label class="form-check-label" for="flexRadioDefault2">District</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" id="flexRadioDefault3" type="radio" name="flexRadioDefault-a" checked="" wire:model.live="selectedLocationLevel" value="Shehia">
                <label class="form-check-label" for="flexRadioDefault3">Shehia</label>
              </div>
            </div>
              @error($selectedLocationLevel)
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
              @enderror
          </div>
        </div>
        <input class="form-control" type="hidden" wire:model="concept_note_id">
          @if($selectedLocationLevel == "Region")
              <div class="col-md-12 col-sm-12">
                  <label class="form-label" for="validationCustom04">Region</label>
                  <select class="form-select @error('selectedRegion') is-invalid @enderror" id="validationCustom04" required="" wire:model="selectedRegion">
                      <option value="">--- Choose ---</option>

                      @foreach ($regions as $reg)
                          <option value="{{$reg->id }}">{{$reg->name }}</option>
                      @endforeach
                  </select>
                  @error($selectedRegion)
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
          @elseif($selectedLocationLevel == "District")
              <div class="col-md-6 col-sm-12">
                  <label class="form-label" for="validationCustom04">Region</label>
                  <select class="form-select @error('selectedRegion') is-invalid @enderror" id="validationCustom04" required="" wire:model.live="selectedRegion">
                      <option value="">--- Choose ---</option>

                      @foreach ($regions as $reg)
                          <option value="{{$reg->id }}">{{$reg->name }}</option>
                      @endforeach
                  </select>
                  @error($selectedRegion)
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
              <div class="col-md-6 col-sm-12">
                  <label class="form-label" for="validationCustom04">District</label>
                  <select class="form-select @error('selectedDistrict') is-invalid @enderror" id="validationCustom04" required="" wire:model="selectedDistrict">
                      <option value="">--- Choose ---</option>

                      @foreach ($districts as $district)
                          <option value="{{$district->id }}">{{$district->name }}</option>
                      @endforeach
                  </select>
                  @error($selectedDistrict)
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
          @else
              <div class="col-md-4 col-sm-12">
                  <label class="form-label" for="validationCustom04">Region</label>
                  <select class="form-select @error('selectedRegion') is-invalid @enderror" id="validationCustom04" required="" wire:model.live="selectedRegion">
                      <option value="">--- Choose ---</option>
                      @foreach ($regions as $reg)
                          <option value="{{$reg->id }}">{{$reg->name }}</option>
                      @endforeach
                  </select>
                  @error($selectedRegion)
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
              <div class="col-md-4 col-sm-12">
                  <label class="form-label" for="validationCustom04">District</label>
                  <select class="form-select @error('selectedDistrict') is-invalid @enderror" id="validationCustom04" required="" wire:model.live="selectedDistrict">
                      <option value="">--- Choose ---</option>
                      @foreach ($districts as $dist)
                          <option value="{{$dist->id }}">{{$dist->name }}</option>
                      @endforeach
                  </select>
                  @error($selectedDistrict)
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
              <div class="col-md-4 col-sm-12">
                  <label class="form-label" for="validationCustom04">Shehia</label>
                  <select class="form-select @error('selectedShehia') is-invalid @enderror" id="validationCustom04" required="" wire:model="selectedShehia">
                      <option value="">--- Choose ---</option>
                      @foreach ($shehias as $shs)
                          <option value="{{$shs->id }}">{{$shs->name }}</option>
                      @endforeach
                  </select>
                  @error($selectedShehia)
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
          @endif

        <div class="col-12 text-end mb-3">
          <button type="submit" class="btn btn-primary" wire:click.prevent="saveProjectLocation">
              <i class="fa fa-save"></i> Save
          </button>
        </div>
      </form>

    <div class="table-responsive custom-scrollbar">
        <table class="table table-dashed">
            <thead>
            <tr>
                <th scope="col">Id </th>
                <th scope="col">location_Level</th>
                <th scope="col">Location</th>
                <th width="120"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($cn_project_location_list as $location)
                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>{{ $location->location_level }}</td>
                    <td>{{ $location->location_name }}</td>
                    <td>
                        <button type="button" class="btn btn-danger" wire:click.prevent="deleteProjectLocation({{ $location->id }})" wire:confirm="Are you sure you want to delete this location?">
                            Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-danger text-center">
                        No location found
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
