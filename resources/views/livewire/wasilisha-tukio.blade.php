<div>
    @livewire('page-za-nje.heade-component')

    <div class="container-fluid py-3" style="background-color: rgb(234, 244, 245);">
        <div class="card border-light mb-3 mx-auto">
            <h2 class="text-center pt-3">Wasilisha Tukio</h2>
            <p class="text-center" style="font-family: 'Montserrat', sans-serif; font-size: 15px;">Karibu kuwasilisha
                taarifa za tukio</p>

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

    @livewire('page-za-nje.jiunge-component')
    @livewire('page-za-nje.footer-component')
</div>
