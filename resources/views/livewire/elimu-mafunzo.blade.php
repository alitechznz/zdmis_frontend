<div>
    @livewire('page-za-nje.heade-component')

        <div class="container" style="border: 1px solid lightgray; 650px: auto;background-color:rgb(234, 244, 245);">
            <div class="col-lg-12">
                <div class="col-3 col-lg-3 card" style="border: 1px solid lightgray !important; height: 600px; margin-left:-6px; ">
                    <h2 style="font-size: 20px;">ELIMU & MAFUNZO </h2>
                    <ul class="menu">
                        <li id="menu-maafa" class="active" onclick="showSection('maafa')"><i class="fas fa-arrow-right"></i> Kuhusu Maafa</li>
                        <li onclick="showSection('documentation')"><i class="fas fa-arrow-right"></i> Documentation</li>
                        <li onclick="showSection('reporting')"><i class="fas fa-arrow-right"></i> Reports</li>
                        <li onclick="showSection('video')"><i class="fas fa-arrow-right"></i> Video</li>
                        <li onclick="showSection('audio')"><i class="fas fa-arrow-right"></i> Audio</li>
                        <li onclick="showSection('animation')"><i class="fas fa-arrow-right"></i> Animation</li>
                    </ul>
                </div>
                <div class="col-9 col-lg-9 card login-main" style="border: 1px solid gray; height: 600px; margin: -615px 0px 0px 25%; " id="login-main">
                        <!-- Bootstrap Carousel -->
                        <div id="maafa" class="content active-content">
                            <h2>Kuhusu Maafa</h2>
                            <p>Details about Maafa...</p>
                            <div id="folderList"></div>
                        </div>
                        <div id="documentation" class="content">
                            <h2>Documentation</h2>
                            <p>Details about Documentation...</p>
                        </div>
                        <div id="reporting" class="content">
                            <h2>Reporting</h2>
                            <p>Details about Reporting...</p>
                        </div>
                        <div id="video" class="content">
                            <h2>Video</h2>
                            <p>Details about Video...</p>
                        </div>
                        <div id="audio" class="content">
                            <h2>Audio</h2>
                            <p>Details about Audio...</p>
                        </div>
                        <div id="animation" class="content">
                            <h2>Animation</h2>
                            <p>Details about Animation...</p>
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
