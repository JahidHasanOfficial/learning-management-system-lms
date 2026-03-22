@extends('frontend.layouts.master')

@section('title', $course->title)

@section('content')
<!-- Header Start -->
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">{{ $course->title }}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="#">Courses</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">{{ $course->category->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->

<!-- Course Details Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                <img class="img-fluid w-100 rounded mb-4 shadow" src="{{ $course->thumbnail }}" alt="{{ $course->title }}" style="max-height: 450px; object-fit: cover;">
                
                <div class="d-flex align-items-center mb-4 p-3 bg-light rounded shadow-sm">
                    <img class="rounded-circle me-3 border border-primary border-2" src="{{ $course->instructor->profile_image }}" width="60" height="60" style="object-fit: cover;">
                    <div>
                        <p class="mb-0 text-muted small">Instructor</p>
                        <h5 class="mb-0">{{ $course->instructor->name }}</h5>
                    </div>
                </div>

                <h3 class="mb-4">Course Description</h3>
                <div class="mb-5 text-muted">
                    {!! nl2br(e($course->description)) !!}
                </div>

                <h3 class="mb-4">Course Curriculum</h3>
                <div class="accordion modern-accordion mb-5" id="courseCurriculum">
                    @forelse($course->sections as $index => $section)
                    <div class="accordion-item border mb-3 rounded overflow-hidden shadow-sm">
                        <h2 class="accordion-header" id="heading{{ $section->id }}">
                            <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }} fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $section->id }}">
                                <span class="bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">{{ $index + 1 }}</span>
                                {{ $section->title }}
                            </button>
                        </h2>
                        <div id="collapse{{ $section->id }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" data-bs-parent="#courseCurriculum">
                            <div class="accordion-body p-0">
                                <ul class="list-group list-group-flush">
                                    @forelse($section->lessons as $lesson)
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fa fa-play-circle text-primary me-3"></i>
                                            <span>{{ $lesson->title }}</span>
                                        </div>
                                        @if($lesson->is_free)
                                            <span class="badge bg-success rounded-pill">Preview</span>
                                        @else
                                            <i class="fa fa-lock text-muted"></i>
                                        @endif
                                    </li>
                                    @empty
                                    <li class="list-group-item text-muted small">No lessons in this section.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted">Curriculum not available yet.</p>
                    @endforelse
                </div>
            </div>

            <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="card border-0 shadow-lg sticky-top" style="top: 100px;">
                    <div class="card-body p-4 text-center">
                        <h2 class="text-primary mb-4 fw-bold">${{ number_format($course->price, 2) }}</h2>
                        
                        @guest
                            <div class="alert alert-info small mb-4">
                                <i class="fa fa-info-circle me-2"></i> Please login to enroll in this course.
                            </div>
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg w-100 rounded-pill mb-3">Login to Enroll</a>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg w-100 rounded-pill">Create Account</a>
                        @else
                            @if(auth()->user()->enrolledCourses()->where('course_id', $course->id)->exists())
                                <div class="alert alert-success d-flex align-items-center justify-content-center py-3">
                                    <i class="fa fa-check-circle me-2"></i> You are enrolled!
                                </div>
                                <a href="{{ route('student.my-courses') }}" class="btn btn-success btn-lg w-100 rounded-pill">Continue Learning</a>
                            @else
                                <form action="{{ route('course.enroll', $course->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill mb-3 shadow">Enroll Now</button>
                                </form>
                            @endif
                        @endguest

                        <hr class="my-4">
                        
                        <div class="text-start">
                            <h6 class="mb-3">This course includes:</h6>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2"><i class="fa fa-video text-primary me-3"></i>{{ $course->lessons->count() }} HD Lessons</li>
                                <li class="mb-2"><i class="fa fa-file-alt text-primary me-3"></i>Downloadable Resources</li>
                                <li class="mb-2"><i class="fa fa-infinity text-primary me-3"></i>Life-time access</li>
                                <li class="mb-2"><i class="fa fa-certificate text-primary me-3"></i>Certificate of completion</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .modern-accordion .accordion-button:not(.collapsed) {
        background-color: transparent;
        color: var(--primary-modern);
        box-shadow: none;
    }
    .modern-accordion .accordion-button:focus {
        box-shadow: none;
    }
    .page-header {
        background: linear-gradient(rgba(24, 29, 56, .7), rgba(24, 29, 56, .7)), url({{ $course->thumbnail }}) center center no-repeat;
        background-size: cover;
    }
</style>
@endpush
