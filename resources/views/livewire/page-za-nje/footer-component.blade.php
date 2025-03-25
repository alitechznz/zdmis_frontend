<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="bg-dark text-white text-center py-3">
        <div class="col-12 col-lg-12" style="text-align:center; margin-top: 30px;">
            <p> For any Technical inquiry, Please contact your ICT Support Team at : info@maafaznz.go.tz<br />
                Copyright © 2025 ZDMC. All Rights Reserved | ZDMIS Version 1.0.0</p>
            <div>
            </div>
        </div>
    </div>


    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
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
                    <button type="button" class="btn btn-primary" wire:click="confirmSubscription">Ndio,
                        Niunganishe</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmationModal_p" tabindex="-1" aria-labelledby="confirmationModalLabel_p"
        aria-hidden="true">
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
                    <button type="button" class="btn btn-primary" wire:click="confirmSubscription_p">Ndio,
                        Niunganishe</button>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function() {
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
            document.addEventListener('livewire:load', function() {
                Livewire.on('show-confirmation-modal', () => {
                    $('#confirmationModal').modal('show');
                });

                Livewire.on('close-confirmation-modal', () => {
                    $('#confirmationModal').modal('hide');
                });
            });
        </script>
    @endpush
    @push('styles')
        <style type="text/css">
            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }

            .loader {
                border: 4px solid #f3f3f3;
                /* Light grey */
                border-top: 4px solid #3498db;
                /* Blue */
                border-radius: 50%;
                width: 12px;
                height: 12px;
                animation: spin 2s linear infinite;
            }
        </style>
    @endpush
    @stack('scripts')
    @livewireScripts
</div>
