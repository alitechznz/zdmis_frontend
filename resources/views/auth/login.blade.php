@extends('layouts.guest')
@section('content')

<style>
    /* General Carousel Styling */
    #login-main {
        /* margin: 0 auto; */
        height: 480px; /* Default height */
    }

    /* Adjustments for Medium Screens */
    @media (max-width: 768px) {
        #login-main {
            height: 430px; /* Reduced height for tablets */
        }
    }

    /* Adjustments for Small Screens */
    @media (max-width: 576px) {
        #login-main {
            height: 400px; /* Reduced height for mobile devices */
            margin: 10px; /* Add some margin for spacing */
        }
    }

    /* Carousel Images */
    #login-main {
        height: 100%;
        object-fit: cover; /* Ensure the image scales correctly */
    }
</style>
    <!-- login page start-->
    <div class="container-fluid p-0">
        <div class="row m-0">
            <!-- Government Banner -->
            <div class="col-12 p-0">
                <!-- Disaster Warning Messages Above the Login Card -->
                {{-- @if(session('disaster_warning')) --}}
                    <div class="alert alert-danger" role="alert" style="text-align: center;">
                        <strong>Warning!</strong>
                        {{-- {{ session('disaster_warning') }} --}}
                        High wind alert issued for coastal areas through this evening
                    </div>
                {{-- @endif --}}
            </div>

            <div class="col-12 p-0">
                <div class="login-card login-dark">
                    <div class="row">

                        <div class="col-md-12 col-12 col-sm-12 col-lg-12">
                            <div class="login-main" style="width:70%;height:480px;" id="login-main">
                                <div class="row">
                                    <div class="col-6 col-lg-6" style="color: black;">
                                        <!-- Bootstrap Carousel -->
                                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img src="{{ asset('assets/images/slide6.jpg') }}" class="d-block w-100" alt="..." style="width:60%; height:400px;">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="{{ asset('assets/images/slide5.jpg') }}" class="d-block w-100" alt="...">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="{{ asset('assets/images/slide6.jpg') }}" class="d-block w-100" alt="..." style="width:60%; height:400px;">
                                                </div>

                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev" style="margin-top:-100%;">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next" style="margin-top:-100%;">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>

                                    </div>

                                    <div class="col-6 col-lg-6">
                                        <div style="margin-top:-30px;"><a class="logo" href=""><img class="img-fluid for-light" style="width:30%;" src="{{  asset('assets/images/smzlogo.jpg') }}"><img class="img-fluid for-dark" src="{{  asset('assets/images/zpc_logo.png') }}" style="width:30%;"></a></div>
                                        <form class="theme-form" action="{{ 'login' }}" method="POST">
                                            @csrf
                                            <h3 style="text-align:center;">Zanzibar Disaster Management Commission</h3>
                                            <h2 style="text-align:center;">ZDMIS System</h2>
                                            <div class="form-group" >
                                                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required="" placeholder="Enter your email">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">

                                                <div class="form-input position-relative">
                                                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required="" placeholder="Enter your password">
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                    <div class="show-hide"><span class="show"></span></div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-0">

                                                <div class="text-end mt-3">
                                                    <button class="btn btn-success btn-block w-40" type="submit">Sign in</button>
                                                    <button class="btn btn-info btn-block w-40" type="button">Register</button>
                                                    <button class="btn btn-primary btn-block w-40" type="button">Report Incident</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12" style="text-align:center;">
                            <p> For any Technical inquiry, Please contact your ICT Support Team at : info@maafaznz.go.tz<br />
                                Copyright © 2025 ZDMC. All Rights Reserved | ZDMIS Version 1.0.0</p>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
