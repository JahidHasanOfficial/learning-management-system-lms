@extends('backend.layouts.master')

@section('title', $course->title)

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <h2>Course Details: {{ $course->title }}</h2>
        </div>
    </div>
</div>

<div class="row">
    <!-- Course Overview -->
    <div class="col-md-8">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                    <h2>Course Overview</h2>
                </div>
            </div>
            <div class="padding_infor_info">
                <div class="course_content_box">
                    <img src="{{ $course->thumbnail }}" class="img-fluid rounded mb-4" style="max-height: 400px; width: 100%; object-fit: cover;">
                    <h3>Description</h3>
                    <p>{!! nl2br(e($course->description)) !!}</p>
                    
                    <h3 class="mt-5">Curriculum</h3>
                    <div class="accordion" id="curriculumAccordion">
                        @foreach($course->sections as $section)
                        <div class="card border-0 mb-2 shadow-sm rounded">
                            <div class="card-header bg-white" id="heading{{ $section->id }}">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left text-dark font-weight-bold" type="button" data-toggle="collapse" data-target="#collapse{{ $section->id }}" aria-expanded="true">
                                        <i class="fa fa-folder-open-o mr-2 text-primary"></i> {{ $section->title }}
                                        <span class="float-right badge badge-primary p-2">{{ $section->lessons->count() }} Lessons</span>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapse{{ $section->id }}" class="collapse {{ $loop->first ? 'show' : '' }}" data-parent="#curriculumAccordion">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush">
                                        @foreach($section->lessons as $lesson)
                                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-3 px-4">
                                            <div>
                                                <i class="fa {{ $lesson->type == 'video' ? 'fa-play-circle-o' : ($lesson->type == 'pdf' ? 'fa-file-pdf-o' : 'fa-file-text-o') }} text-muted mr-3"></i>
                                                {{ $lesson->title }}
                                            </div>
                                            <span class="text-muted small">{{ $lesson->video_duration ?? 'Reading' }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <h4 class="mt-5 mb-3">Course Instructors</h4>
                    <div class="row">
                        @php
                            $displayInstructors = $course->instructors->count() > 0 ? $course->instructors : collect([$course->instructor]);
                        @endphp
                        @foreach($displayInstructors as $instructor)
                        <div class="col-md-4 mb-3">
                            <div class="instructor_card text-center p-3 border rounded shadow-sm bg-white h-100">
                                <img src="{{ $instructor->profile_image }}" class="rounded-circle mb-2 border shadow-sm" style="width: 70px; height: 70px; object-fit: cover;">
                                <h6 class="m-0 font-weight-bold text-dark">{{ $instructor->name }}</h6>
                                <p class="small text-muted mb-1">{{ $loop->first ? 'Lead Instructor' : 'Co-Instructor' }}</p>
                                <a href="{{ route('instructor.show', $instructor->id) }}" class="btn btn-link btn-sm p-0">View Profile</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Sidebar Info -->
    <div class="col-md-4">
        <div class="white_shd full margin_bottom_30">
            <div class="padding_infor_info">
                <div class="price_box text-center py-4 bg-light rounded mb-4">
                    <h2 class="text-primary font-weight-bold">${{ number_format($course->price, 2) }}</h2>
                    <p class="text-muted m-0">One-time payment</p>
                </div>
                


                <ul class="list-group list-group-flush mb-4 mt-4">
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Category:</strong>
                        <span>{{ $course->category->name ?? 'Uncategorized' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Status:</strong>
                        <span class="badge badge-{{ $course->status == 'published' ? 'success' : 'warning' }} px-2 py-1">
                            {{ ucfirst($course->status) }}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Enrollments:</strong>
                        <span>{{ $course->students->count() }} Students</span>
                    </li>
                </ul>

                <h4 class="mb-3">Batches</h4>
                @foreach($course->batches as $batch)
                <div class="batch_info p-3 border rounded mb-2 shadow-sm">
                    <h6 class="m-0 font-weight-bold text-dark">{{ $batch->name }}</h6>
                    <p class="small text-muted m-0">Starts: {{ $batch->start_date?->format('d M, Y') ?? 'TBA' }}</p>
                </div>
                @endforeach

                <div class="mt-4">
                    <a href="{{ route('course.edit', $course->id) }}" class="btn btn-primary btn-block rounded-pill shadow-sm py-2">
                        <i class="fa fa-edit mr-2"></i> Edit Course
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
