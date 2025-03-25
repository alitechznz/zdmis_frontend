<div>
    <div class="container-fluid py-3" style="background-color: rgb(234, 244, 245);">
        <div class="card border-light mb-3 mx-auto">
            <h2 class="text-center pt-3">Wasilisha Tukio</h2>
            <p class="text-center" style="font-family: 'Montserrat', sans-serif; font-size: 15px;">Karibu kuwasilisha
                taarifa za tukio</p>

            <div class="container" wire:ignore.self>
                <form wire:submit.prevent="submitWasilisha">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="contact_person" class="form-label">Jina lako Kamili<span class="text-danger"> *</span></label>
                            <input type="text" wire:model="contact_person" class="form-control @error('contact_person') is-invalid @enderror" placeholder="Andika jina lako kamili">
                            @error('contact_person')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="phone_number" class="form-label">Nambari ya Simu<span class="text-danger"> *</span></label>
                            <input type="text" wire:model="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Andika nambari yako ya simu">
                            @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="selectedTukio" class="form-label">Chagua Tukio<span class="text-danger"> *</span></label>
                            <select wire:model="selectedTukio" class="form-control @error('selectedTukio') is-invalid @enderror">
                                <option value="">--Choose--</option>
                                @foreach ($ainaTukio as $type)
                                    <option value="{{ $type['id'] }}">{{ $type['aina_name'] }}</option>
                                @endforeach
                                <!-- Add dynamic options here -->
                            </select>
                            @error('tukio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="tukiosababu" class="form-label">Chagua Tukio sababu<span class="text-danger"> *</span></label>
                            <select wire:model="tukiosababu" class="form-control @error('tukiosababu') is-invalid @enderror">
                                <option value="">--Choose--</option>
                                @foreach($sababu as $type)
                                    <option value="{{ $type['id'] }}">{{ $type['sababu'] }}</option>
                                @endforeach
                                <!-- Add dynamic options here -->
                            </select>
                            @error('tukiosababu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="selectedMkoa" class="form-label">Chagua Mkoa <span class="text-danger"> *</span></label>
                            <select wire:model="selectedMkoa" class="form-control @error('selectedMkoa') is-invalid @enderror">
                                <option value="">--Choose--</option>
                                @foreach ($mkoas as $region)
                                    <option value="{{ $region['mkoa'] }}">{{ $region['mkoa'] }}</option>
                                @endforeach
                                <!-- Add dynamic options here -->
                            </select>
                            @error('selectedMkoa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="selectedWilaya" class="form-label">Chagua Wilaya <span class="text-danger"> *</span></label>
                            {{-- @if (!empty($wilayas)) --}}
                                <select wire:model="selectedWilaya" class="form-control @error('selectedWilaya') is-invalid @enderror">
                                    <option value="">--Choose--</option>
                                    @foreach ($wilayas as $wilaya)
                                        <option value="{{ $wilaya['id'] }}">{{ $wilaya['jina'] }}</option>
                                    @endforeach
                                    <!-- Add dynamic options here -->
                                </select>
                            {{-- @endif --}}
                            @error('selectedWilaya')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="shehia" class="form-label">Chagua Shehia <span class="text-danger"> *</span></label>
                            {{-- @if (!empty($shehias)) --}}
                                <select wire:model="shehia" class="form-control @error('shehia') is-invalid @enderror">
                                    <option value="">--Choose--</option>
                                    @foreach ($shehias as $shehia)
                                        <option value="{{ $shehia['id'] }}">{{ $shehia['jina'] }}</option>
                                    @endforeach
                                    <!-- Add dynamic options here -->
                                </select>
                            {{-- @endif --}}
                            @error('shehia')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                                <label for="eneo" class="form-label">Andika Mtaa/Kijiji/Eneo <span class="text-danger"> *</span></label>
                                <input type="text" wire:model="eneo" class="form-control">
                        </div>
                        <div class="col-md-12">
                                <!-- <label for="latitude" class="form-label">Latitude</label> -->
                                <input type="hidden" wire:model="latitude" class="form-control">
                        </div>
                        <div class="col-md-12">
                                <!-- <label for="longitude" class="form-label">Longitude</label> -->
                                <input type="hidden" wire:model="longitude" class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="contact_detail" class="form-label">Maelezo ya Tukio <span class="text-danger"> *</span></label>
                            <textarea wire:model="contact_detail" rows="3" class="form-control @error('contact_detail') is-invalid @enderror"></textarea>
                            @error('contact_detail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-0">

            <div class="container">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="contact_person" class="form-label">Jina lako Kamili</label>
                        <input type="text" wire:model="contact_person"
                            class="form-control @error('contact_person') is-invalid @enderror" id="contact_person"
                            placeholder="Andika jina lako kamili">
                        @error('contact_person')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="phone_number" class="form-label">Nambari ya Simu</label>
                        <input type="text" wire:model="phone_number"
                            class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                            placeholder="Andika nambari yako ya simu">
                        @error('phone_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="municipal_council" class="form-label">Chagua Tukio</label>
                        <select wire:model="municipal_council"
                            class="form-control @error('municipal_council') is-invalid @enderror"
                            id="municipal_council">
                            <option value="">--Choose--</option>
                            <!-- Add dynamic options here -->
                        </select>
                        @error('municipal_council')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="contact_detail" class="form-label">Maelezo ya Tukio</label>
                        <textarea wire:model="contact_detail" id="contact_detail" rows="3"
                            class="form-control @error('contact_detail') is-invalid @enderror"></textarea>
                        @error('contact_detail')
                            <div class="invalid-feedback">
                                {{ $message }}


                            <div class="text-end mt-3">

                                <button type="submit" class="btn-success w-40 subscribe-button">Wasilisha</button>

                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-0">

                        <div class="text-end mt-3">
                            <button class="btn-success btn-block w-40 subscribe-button" type="button"
                                wire:click.prevent='submit'>Wasilisha</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @include('../page-za-nje.jiunge-component') --}}
    {{-- @livewire('page-za-nje.jiunge-component') --}}
    {{-- @livewire('page-za-nje.footer-component')  --}}
</div>

