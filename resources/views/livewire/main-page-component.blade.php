<div>
    @livewire('page-za-nje.heade-component')
        <!-- Content -->
        <div class="row" style="padding-left: 10px; padding-right: 10px;">
            <div class="col-lg-7">
                <div class="card my-3 mx-auto p-4">
                    <div class="row">
                        <h2 style="text-align: center; padding-top: 30px;">Karibu Mfumo wa Maafa!</h2>
                        <p style="text-align: center; font-family: 'Montserrat', sans-serif;font-size: 15px;">Mfumo huu kwa ajili ya kurahisisha taarifa za maafa za wali kwa ajili ya kukinga majanga au kupunguza athari. Karibu kushirikiana na sisi</p>
                        <br />
                    </div>
                    <div class="row">
                        <h2><i class="fas fa-phone"></i> Piga Simu</h2>
                        <div class="contact-item disaster-call">
                            <h3><i class="fas fa-exclamation-triangle emergency-icon" style="color:hsl(128, 47%, 13%);"></i> <span class="number">190</span> - <span class="description"><b>Maafa / Disaster</b></span></h3>
                        </div>
                        <div class="contact-item fire-rescue">
                            <h3><i class="fas fa-fire-extinguisher emergency-icon" style="color:#dc3545;"></i> <span class="number">114</span> - <span class="description"><b>Zimamoto / Fire Rescue</b></span></h3>
                        </div>
                        <div class="contact-item police-emergency">
                            <h3><i class="fas fa-shield-alt emergency-icon" style="color:#007bff;"></i> <span class="number">112</span> - <span class="description"><b>Polisi /Police Emergency</b></span></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card my-3 mx-auto" style="padding: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <h2>Maafa Matukio</h2>
                    <!-- Bootstrap Carousel -->
                    <div id="disasterEventsCarousel" class="carousel slide" data-bs-ride="carousel" style="height: 280px;">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('assets/images/slide6.jpg') }}" class="d-block w-100" alt="Disaster Event 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/images/slide7.jpg') }}" class="d-block w-100" alt="Disaster Event 2">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/images/slide8.jpg') }}" class="d-block w-100" alt="Disaster Event 3">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#disasterEventsCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#disasterEventsCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <p>Overview of flood events that occurred today...</p>
                    <button class="btn btn-primary mt-2">Soma zaidi...</button>
                </div>
            </div>
        </div>


        @livewire('page-za-nje.jiunge-component')

        @livewire('page-za-nje.footer-component')
</div>
