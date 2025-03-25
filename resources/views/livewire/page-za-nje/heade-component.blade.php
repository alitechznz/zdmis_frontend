<div>
    {{-- Because she competes with no one, no one can compete with her. --}}


    <style>
        /* General Carousel Styling */
        #login-main {
            border: 1px solid rgb(188, 212, 182);
            height: 400px;
            overflow: hidden;
            /* Ensures no overflow if images are larger/taller */
            position: relative;
            /* For proper button placement */
        }

        .carousel-item img {
            width: 100%;
            /* Full width of the carousel */
            height: 300px;
            /* Fixed height for all images */
        }

        .carousel-control-prev,
        .carousel-control-next {
            color: #3ec058;
            /* Adjust button color if needed */
        }

        /* Adjustments for Medium Screens */
        @media (max-width: 768px) {
            #login-main {
                height: 430px;
                /* Reduced height for tablets */
            }
        }

        /* Adjustments for Small Screens */
        @media (max-width: 576px) {
            #login-main {
                height: 400px;
                /* Reduced height for mobile devices */
                margin: 10px;
                /* Add some margin for spacing */
            }
        }



        /* Container class to hold columns */
        .container {
            width: 100%;
            /* Full width container */
        }

        .navbar {
            overflow: hidden;
        }

        .nav-list {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .nav-item {
            float: left;
        }

        .nav-item a {
            display: block;
            text-align: center;
            padding: 0px 60px;
            text-decoration: none;
        }

        /* .nav-item a:hover {
            background-color: #555;
        } */

        .nav-item a i {
            margin-right: 8px;
            /* Space between icon and text */
        }

        .nav-item a:hover,
        .btn:hover {
            background-color: #2d2a2a;
            color: #000;
            border-radius: 5%;
        }

        .btn {
            border: none;
            background-color: white !important;
            color: #333;
            padding: 0px 30px;
            cursor: pointer;
            font-family: Arial, sans-serif;
            font-size: 16px;
        }

        .right {

            position: absolute;
            /* Positioning the button group absolutely */
            right: 20px;
            /* Aligns the group to the right edge */
            top: 8px;
            /* Aligns the group to the top, adjust if needed */
        }

        .emergency-contact {
            margin-top: 20px;
            font-family: Arial, sans-serif;
        }

        .contact-item {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f8f9fa;
        }

        .contact-item h3 {
            margin: 0;
            font-size: 1.5em;
        }

        .emergency-icon {
            margin-right: 10px;
        }

        .number {
            font-weight: bold;
            color: #d63384;
        }

        .description {
            color: #495057;
        }

        /* Specific colors for each service */
        .fire-rescue .number {
            color: #dc3545;
        }

        .police-emergency .number {
            color: #007bff;
        }

        h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 30px;
            /* Large font size for emphasis */
            color: hsl(101, 67%, 52%), 67%, 52%);
            /* Magenta color */
            text-shadow: 2px 2px 4px #000000FF;
            /* Subtle shadow for depth */
            font-weight: bold;
            /* Bold font weight */
            text-align: center;
            /* Center align text */
            margin-bottom: 10px;
            padding-bottom: 2px;
            /* Padding for spacing between text and border */
        }

        .card {
            background-color: Canvas;
            /* Background color */
            border-radius: 10px;
            /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
            /* 3D shadow effect */
            padding: 20px;
            /* Inner spacing */
            margin: 20px;
            /* Outer spacing */
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            /* Smooth transitions for hover effects */
        }

        .card:hover {
            transform: translateY(-5px);
            /* Lift card up slightly on hover */
            box-shadow: 0 10px 16px rgba(0, 0, 0, 0.2), 0 12px 24px rgba(0, 0, 0, 0.2);
            /* Enhance shadow on hover */
        }

        .fa-phone {
            font-size: 35px;
            /* Large size for the icon */
            color: #4CAF50;
            /* Green color for visibility and thematic relevance to calling */
        }

        /* Style for the Subscribe Button */
        .subscribe-button {
            background-color: #007bff;
            /* Primary blue color */
            color: white;
            /* Text color */
            border: none;
            /* No border for a cleaner look */
            border-radius: 20px;
            /* Rounded corners */
            padding: 10px 20px;
            /* Top/bottom and left/right padding */
            font-size: 16px;
            /* Text size */
            font-weight: bold;
            /* Bold text */
            cursor: pointer;
            /* Cursor changes to pointer to indicate button */
            transition: background-color 0.3s, transform 0.2s;
            /* Smooth transition for hover effects */
        }

        /* Hover effect for the Subscribe Button */
        .subscribe-button:hover {
            background-color: #0056b3;
            /* Darker shade of blue on hover */
            transform: scale(1.05);
            /* Slightly increase size */
        }

        /* Focus and active styles for better accessibility and UX */
        .subscribe-button:focus,
        .subscribe-button:active {
            outline: none;
            /* Removes outline to maintain the design integrity */
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.5);
            /* Adds a glow effect for focus */
        }

        .google {
            color: #34A853;
            /* Google brand color */
        }

        .apple {
            color: #A3AAAE;
            /* Apple brand color */
        }

        .marquee {
            width: 100%;
            background-color: #fff;
            /* Light gray background */
            color: #333;
            /* Dark text for contrast */
            overflow: hidden;
            white-space: nowrap;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            /* Optional: adds shadow for better separation */
        }

        .marquee p {
            display: inline-block;
            padding-left: 100%;
            /* Start offscreen to the right */
            animation: slide 20s linear infinite;
            /* Adjust timing as needed */
        }

        @keyframes slide {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-100%);
            }
        }

        .tahadhari-button {
            margin-left: 20px;
            padding: 10px 20px;
            background-color: #dc3545;
            /* Red button for warnings */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            outline: none;
        }

        .is-invalid {
            border-color: #dc3545;
            /* Bootstrap default for danger/red */
        }
    </style>
    @stack('styles')
    @livewireStyles
    <!-- login page start-->
    <div class="container-fluid" style="padding-left: 10px; padding-right: 10px;">
        <!-- Header Section -->
        <div class="row bg-dark text-white text-center py-3" style="height: 140px;">
            <div class="col-md-2">
                {{-- <img src="{{ asset('assets/images/smzlogoe.png') }}" class="d-block" alt="..." style="width: 70%;" /> --}}
                <img src="{{ asset('assets/images/smzlogoe.png') }}" alt="Logo" class="img-fluid">
            </div>
            <div class="col-md-8">
                <h3 style="color: white;">AFISI YA MAKAMO WA PILI WA RAIS</h2>
                    <h1 style="color: white;">KAMISHENI YA KUKABILIANA NA MAAFA ZANZIBAR</h1>
                    <h3 style="color: white;">MFUMO WA MAAFA (EARLY WARNING SYSTEM)</h3>
            </div>
            <div class="col-md-2">
                {{-- <img src="{{ asset('assets/images/smzlogoe.png') }}" class="d-block" alt="..." style="width: 70%; margin-right:60%;" /> --}}
                <img src="{{ asset('assets/images/smzlogoe.png') }}" alt="Logo" class="img-fluid">
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark"
        style="background-color: darkolivegreen; padding-left: 10px; padding-right: 10px;">
        <div class="container-fluid" style="background-color: darkolivegreen;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav" style="background-color: darkolivegreen;">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('/') }}"><i
                                class="fas fa-home"></i> Nyumbani</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('tukio') }}"><i
                                class="fas fa-exclamation-triangle"></i>Wasilisha Tukio</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('elimu') }}"><i
                                class="fas fa-tools"></i>Elimu & Mafunzo</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('nje') }}"><i
                                class="fas fa-tachometer-alt"></i>Dashibodi</a></li>
                </ul>

                <div class="d-flex">
                    <a href="{{ route('login') }}" class="btn btn-success">Staff Login</a>
                </div>
    </nav>
</div>
</div>
</nav>

<div class="row">
    <div class="col-lg-2">
        <button class="tahadhari-button">TAHADHARI >> </button>
    </div>
    <div class="col-lg-10">
        <div class="marquee">
            <p>✶ March 2025 - Mvua Kubwa za masika zinatarajiwa; ✶ ✶ 2025 - Chemsa Maji na safisha mazingira
                yaliyokuzunga ✶ Maradhi ya MPOX yapo Epuka kugusana na kupeyana mikono na kukusanyika ✶</p>
        </div>
    </div>

</div>

</div>
