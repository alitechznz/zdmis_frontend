<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="row mt-3" style="padding-left: 10px; padding-right: 10px;">
        <div class="col-lg-12">
            <h2 style="text-align: center; color: #4CAF50; font-size: 35px;"><i class="fas fa-bell icon" style="color: #b3e64d;"></i> Jiunge Nasi kwa Taarifa za Maafa 24/7</h2>
            <p style="text-align:center;font-family: 'Open Sans', sans-serif;line-height: 1.6;">Karibu Kupata taarifa mbali mbali za maafa kwa muda husika ikiwemo tahadhari, matukio, elimu ya kujikinga kwa kupitia barua pepe au ujumbe wa simu au mfumo wa simu janja. <b>Karibu kujiunga!</b> </p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <h2><i class="fas fa-envelope icon" style="color: #4CAF50;"></i> Barua Pepe</h2>
                    <form wire:submit.prevent="createSubscriber">
                        <div class="form-group">
                            <input class="form-control @error('email') is-invalid @enderror" type="text" wire:model="email" required="" placeholder="Weka barua yako ya pepe" style="background-color:rgb(234, 244, 245);">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <div class="text-end mt-3">
                                <button class="btn-success btn-block w-40 subscribe-button" type="button" data-bs-toggle="modal" data-bs-target="#confirmationModal">
                                    Jiunge
                                </button>
                                <!-- Loading and success indicators -->
                                <span wire:loading wire:target="confirmSubscription" class="loader"></span>
                                @if($isCompleted)
                                    <i class="fas fa-check" style="color: green;"></i>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <h2><i class="fas fa-phone icon" style="color: #4CAF50;"></i> Simu ya Mkononi</h2>
                    <form wire:submit.prevent="createSubscriber_phone">
                        <div class="form-group">
                            <input class="form-control" type="text" wire:model="phone" required="" placeholder="Weka nambari yako ya simu">
                        </div>
                        <div class="form-group mb-0">
                            <div class="text-end mt-3">
                                <button class="btn-success btn-block w-40 subscribe-button" type="button" data-bs-toggle="modal" data-bs-target="#confirmationModal">
                                    Jiunge
                                </button>
                                <!-- Loading and success indicators -->
                                <span wire:loading wire:target="confirmSubscription" class="loader"></span>
                                @if($isCompleted)
                                    <i class="fas fa-check" style="color: green;"></i>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <h2><i class="fas fa-mobile-alt icon" style="color: #4CAF50;"></i> Pakua Mfumo</h2>
                    <div>
                        <i class="fab fa-google-play google"></i> Get it on Google Play
                        <i class="fab fa-app-store-ios apple"></i> Download on the App Store
                    </div>
                    <img src="{{ asset('assets/images/apk.png') }}" class="d-block w-50 mx-auto my-2" alt="App Download" style="width: 55%; padding-left: 10%;">
                </div>
            </div>
        </div>
    </div>
</div>
