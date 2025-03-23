<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="row mt-3" style="padding-left: 10px; padding-right: 10px;">
        <div class="col-lg-12">
            <h2 style="text-align: center; color: #4CAF50; font-size: 35px;"><i class="fas fa-bell icon" style="color: #b3e64d;"></i> Jiunge Nasi kwa Taarifa za Maafa 24/7</h2>
            <p style="text-align:center;font-family: 'Open Sans', sans-serif;line-height: 1.6;">Karibu Kupata taarifa mbali mbali za maafa kwa muda husika ikiwemo tahadhari, matukio, elimu ya kujikinga kwa kupitia barua pepe au ujumbe wa simu au mfumo wa simu janja. <b>Karibu kujiunga!</b> </p>
        </div>
        <div class="row">
                                 @if(session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <h2><i class="fas fa-envelope icon" style="color: #4CAF50;"></i> Barua Pepe</h2>
                    <form  id="emailForm" class="card">
                        <div class="form-group">
                            <input class="form-control @error('email') is-invalid @enderror" type="text" wire:model="email"  required="" placeholder="Weka barua yako ya pepe" style="background-color:rgb(234, 244, 245);">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <div class="text-end mt-3">
                                <!-- <button class="btn-success btn-block w-40 subscribe-button" type="button" wire:click="validateAndShowModal('email')">
                                    Jiunge
                                </button> -->
                                <button type="submit" class="btn-success btn-block w-40 subscribe-button">Jiunge</button>
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
                    <h2><i class="fas fa-sms icon" style="color: #4CAF50;"></i> Simu ya Mkononi</h2>
                    <form id="phoneForm" class="card">
                        <div class="form-group">
                            <input class="form-control" type="text" wire:model="phone" required="" placeholder="Weka nambari yako ya simu">
                        </div>
                        <div class="form-group mb-0">
                            <div class="text-end mt-3">
                                <!-- <button class="btn-success btn-block w-40 subscribe-button" type="button" wire:click="validateAndShowModal('phone')">
                                    Jiunge
                                </button> -->
                                <button type="submit" class="btn-success btn-block w-40 subscribe-button">Jiunge</button>

                                <!-- Loading and success indicators -->
                                <span wire:loading wire:target="confirmSubscription_p" class="loader"></span>
                                @if($isCompleted_p)
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
                        
                        <i class="fab fa-google-play google"></i> Get it on Google Play <br />
                        <i class="fab fa-app-store-ios apple"></i> Download on the App Store
                    </div>
                    <a href="{{ asset('assets/images/MAAFA APPv11.apk') }}" download="MaafaApp.apk" class="btn btn-primary">
                            <i class="fas fa-download"></i> Download APK
                            <img src="{{ asset('assets/images/apk.png') }}" class="d-block w-50 mx-auto my-2" alt="App Download" style="width: 100%; padding-left: 0%;">
                    </a><br />
                    
                </div>
            </div>
        </div>
    </div>

        <!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="confirmationModalLabel">Hakiki kujiandikisha</h5>
      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
        Je, una uhakika unataka kujiandikisha kwa kutumia barua pepe hii?
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hapana</button>
      <button type="button" class="btn btn-primary" wire:click="confirmSubscription">Ndio, Niunganishe</button>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="confirmationModal_p" tabindex="-1" aria-labelledby="confirmationModalLabel_p" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="confirmationModalLabel_p">Hakiki kujiandikisha</h5>
      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
        Je, una uhakika unataka kujiandikisha kwa kutumia meseji ya simu?
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hapana</button>
      <button type="button" class="btn btn-primary" wire:click="confirmSubscription_p">Ndio, Niunganishe</button>
    </div>
  </div>
</div>
</div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('loginSuccess', () => {
                window.location.href = '/home'; // JavaScript-based redirection
            });
        });

       // script.js
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-list a');

            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    navLinks.forEach(node => node.style.backgroundColor = '');
                    this.style.backgroundColor = '#e2e2e2'; // Update to match hover color
                });
            });
        });

       
    </script>
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('show-confirmation-modal', () => {
                $('#confirmationModal').modal('show');
            });

            Livewire.on('close-confirmation-modal', () => {
                $('#confirmationModal').modal('hide');
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const emailForm = document.getElementById('emailForm');
            const phoneForm = document.getElementById('phoneForm');
            const emailModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            const phoneModal = new bootstrap.Modal(document.getElementById('confirmationModal_p'));

            emailForm.addEventListener('submit', function(event) {
                event.preventDefault();
                // Simple email validation
                const emailInput = emailForm.querySelector('input[type="text"]');
                if (/^\S+@\S+\.\S+$/.test(emailInput.value)) {
                    emailModal.show();
                } else {
                    alert('Tafadhali weka barua pepe sahihi');
                }
            });

            phoneForm.addEventListener('submit', function(event) {
                event.preventDefault();
                // Simple phone validation
                const phoneInput = phoneForm.querySelector('input[type="text"]');
                if (/^\d{10}$/.test(phoneInput.value)) {
                    phoneModal.show();
                } else {
                    alert('Tafadhali weka numbari ya simu sahihi');
                }
            });
        });
    </script>
    <script>
       
       document.addEventListener('DOMContentLoaded', function() {
           window.addEventListener('livewire:load', function () {
               Livewire.on('refreshPage', function () {
                   setTimeout(function () {
                       window.location.reload();  // Reload the page
                   }, 2000);  // Delay the reload by 2000 milliseconds if needed
               });
           });
       });
   
       </script>
    @endpush
    @push('styles')
    <style type="text/css">
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loader {
            border: 4px solid #f3f3f3; /* Light grey */
            border-top: 4px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 12px;
            height: 12px;
            animation: spin 2s linear infinite;
        }
    </style>
@endpush
</div>