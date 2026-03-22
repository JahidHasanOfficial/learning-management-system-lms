@extends('frontend.layouts.master')

@section('title', 'Modern Learning Platform')

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('frontend/img/carousel-1.jpg') }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Best Online Courses</h5>
                                <h1 class="display-3 text-white animated slideInDown">The Best Online Learning Platform</h1>
                                <p class="fs-5 text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea sanctus eirmod elitr.</p>
                                <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read More</a>
                                <a href="" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Join Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('frontend/img/carousel-2.jpg') }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Best Online Courses</h5>
                                <h1 class="display-3 text-white animated slideInDown">Get Educated Online From Your Home</h1>
                                <p class="fs-5 text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea sanctus eirmod elitr.</p>
                                <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read More</a>
                                <a href="" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Join Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center pt-3 shadow-sm modern-card">
                        <div class="p-4">
                            <i class="fa fa-3x fa-graduation-cap text-primary mb-4"></i>
                            <h5 class="mb-3">Skilled Instructors</h5>
                            <p class="text-muted small">Learn from world-class experts with industry experience.</p>
                        </div>
                    </div>
                </div>
                <!-- Other services similarly updated -->
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center pt-3 shadow-sm modern-card">
                        <div class="p-4">
                            <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                            <h5 class="mb-3">Online Classes</h5>
                            <p class="text-muted small">Join live and pre-recorded sessions from anywhere.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item text-center pt-3 shadow-sm modern-card">
                        <div class="p-4">
                            <i class="fa fa-3x fa-home text-primary mb-4"></i>
                            <h5 class="mb-3">Home Projects</h5>
                            <p class="text-muted small">Hands-on projects to apply your skills in real life.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item text-center pt-3 shadow-sm modern-card">
                        <div class="p-4">
                            <i class="fa fa-3x fa-book-open text-primary mb-4"></i>
                            <h5 class="mb-3">Book Library</h5>
                            <p class="text-muted small">Access a wide range of academic and professional resources.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Categories Start -->
    <div class="container-xxl py-5 category">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Categories</h6>
                <h1 class="mb-5">Top Courses Categories</h1>
            </div>
            <div class="row g-4">
                @foreach($categories as $category)
                <div class="col-lg-3 col-md-6 wow zoomIn" data-wow-delay="0.1s">
                    <a href="#" class="category-item d-block shadow-sm">
                        <img src="{{ asset('frontend/img/cat-1.jpg') }}" alt="">
                        <div class="category-overlay">
                            <h4 class="text-white mb-1 fw-bold">{{ $category->name }}</h4>
                            <p class="text-white-50 mb-0"><i class="fa fa-book-open me-2"></i>{{ $category->courses_count }} Courses</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>


    <!-- Courses Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
                <h1 class="mb-5">Popular Featured Courses</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($featuredCourses as $course)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="modern-card shadow-sm h-100 d-flex flex-column border">
                        <div class="position-relative">
                            <img class="img-fluid w-100" src="{{ $course->thumbnail }}" style="height: 220px; object-fit: cover;">
                            <div class="position-absolute top-0 start-0 m-3 px-2 py-1 bg-white text-primary rounded-pill small fw-bold">
                                {{ $course->category->name }}
                            </div>
                        </div>
                        <div class="p-4 flex-grow-1">
                            <h5 class="mb-3 line-clamp-2">{{ $course->title }}</h5>
                            <div class="d-flex align-items-center mb-4 text-warning small">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span class="text-muted ms-2">(4.5)</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="text-primary mb-0">${{ number_format($course->price, 2) }}</h4>
                                <a href="{{ route('course.details', $course->slug) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 shadow-sm">Details</a>
                            </div>
                        </div>
                        <div class="p-3 bg-light border-top d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="{{ $course->instructor->profile_image }}" class="rounded-circle me-2" width="30" height="30">
                                <small class="text-dark fw-bold">{{ $course->instructor->name }}</small>
                            </div>
                            <small class="text-muted"><i class="fa fa-users me-1"></i>150</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>


    <!-- Instructors Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Experts</h6>
                <h1 class="mb-5">Learn From Our Instructors</h1>
            </div>
            <div class="row g-4">
                @foreach($topInstructors as $instructor)
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="modern-card shadow-sm text-center bg-light">
                        <div class="p-4 pt-5">
                            <img src="{{ $instructor->profile_image }}" class="rounded-circle mb-4 border border-white border-4 shadow-sm" width="130" height="130" style="object-fit:cover;">
                            <h5 class="mb-1">{{ $instructor->name }}</h5>
                            <p class="text-primary small mb-3">Senior Instructor</p>
                            <div class="d-flex justify-content-center gap-2">
                                <a class="btn btn-sm-square btn-outline-primary rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-sm-square btn-outline-primary rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-sm-square btn-outline-primary rounded-circle" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="p-3 bg-white">
                            <a href="#" class="btn btn-sm btn-primary rounded-pill w-100">View Profile</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
