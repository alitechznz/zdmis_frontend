<div>
    @livewire('page-za-nje.heade-component')
      
        <div class="container" style="border: 1px solid lightgray;background-color:rgb(234, 244, 245);">
            <div class="col-lg-12">
                {{-- <div class="col-3 col-lg-3 card" style="border: 1px solid lightgray !important; height: 600px; margin-left:-6px; ">
                    <h2 style="font-size: 20px;">DASHIBODI </h2>
                    <ul class="menu">
                        <li id="menu-maafa" class="active" onclick="showSection('maafa')">Hali ya Hewa <i class="fas fa-arrow-right" style="margin-left:42%;"></i></li>
                        <li onclick="showSection('documentation')">Matukio <i class="fas fa-arrow-right" style="margin-left:60%;"></i></li>
                        <li onclick="showSection('reporting')">Vituo Vya Dharura <i class="fas fa-arrow-right" style="margin-left:24%;"></i></li>
                        <li onclick="showSection('video')">Tahadhari <i class="fas fa-arrow-right" style="margin-left:52%;"></i></li>

                    </ul>
                </div> --}}
                <div class="col-12 col-lg-12 card login-main" style="border: 1px solid gray; height: 900px; margin: 0px 0px 0px 0%; " id="login-main">
                        <!-- Bootstrap Carousel -->
                        <div id="maafa" class="content active-content">
                            <h2>Hali Hewa</h2>
                            <div class="col-sm-12">

                                <div class="row" style="height: auto; border: 1px solid black;">
                                    <!-- Weather Cards -->
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <i class="fas fa-thermometer-half fa-2x"></i>
                                                <h5 class="card-title">Temperature</h5>
                                                <p class="card-text" id="temperature">24°C</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <i class="fas fa-wind fa-2x"></i>
                                                <h5 class="card-title">Winds</h5>
                                                <p class="card-text" id="winds">10 km/h</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <i class="fas fa-cloud-rain fa-2x"></i>
                                                <h5 class="card-title">Rainfall</h5>
                                                <p class="card-text" id="rainfall">2 mm</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <i class="fas fa-tachometer-alt fa-2x"></i>
                                                <h5 class="card-title">Pressure</h5>
                                                <p class="card-text" id="pressure">1013 hPa</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="height: auto; border: 1px solid black;">
                                    <!-- Weather Cards -->
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <i class="fas fa-thermometer-half fa-2x"></i>
                                                <h5 class="card-title">Jumla ya Matukio</h5>
                                                <p class="card-text" id="temperature">8</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <i class="fas fa-wind fa-2x"></i>
                                                <h5 class="card-title">Matukio Yaliyo hakikiwa</h5>
                                                <p class="card-text" id="winds">8</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <i class="fas fa-cloud-rain fa-2x"></i>
                                                <h5 class="card-title">Matukio Yaliyothibitishwa </h5>
                                                <p class="card-text" id="rainfall">6 </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <i class="fas fa-tachometer-alt fa-2x"></i>
                                                <h5 class="card-title">Yanayo shughulikiwa</h5>
                                                <p class="card-text" id="pressure">2</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Graph Section -->
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="mb-3">Weather Trends</h4>
                                        <canvas id="weatherChart"></canvas>
                                    </div>
                                </div>
                                <script>
                                    const ctx = document.getElementById('weatherChart').getContext('2d');
                                    const weatherChart = new Chart(ctx, {
                                        type: 'bar', // or 'line'
                                        data: {
                                            labels: ['January', 'February', 'March', 'April'],
                                            datasets: [{
                                                label: 'Temperature °C',
                                                data: [20, 21, 22, 23],
                                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                                borderColor: 'rgba(255, 99, 132, 1)',
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>

                        <script>
                            function showSection(sectionId) {
                                // Reset active class for all menu items
                                var items = document.querySelectorAll('.menu li');
                                items.forEach(function(item) {
                                    item.classList.remove('active');
                                });

                                // Hide all content
                                var sections = document.querySelectorAll('.content');
                                sections.forEach(function(section) {
                                    section.style.display = 'none';
                                });

                                // Show the selected content and highlight the menu item
                                document.getElementById(sectionId).style.display = 'block';
                                document.querySelector('.menu li[id="'+ sectionId +'"]').classList.add('active');
                            }

                            // Initialize the page with the Maafa section visible
                            document.addEventListener("DOMContentLoaded", function() {
                                showSection('maafa');
                            });


                        </script>

                </div>
            </div>
        </div>
    @livewire('page-za-nje.footer-component')   
</div>
