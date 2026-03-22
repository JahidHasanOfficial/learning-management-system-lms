@extends('backend.layouts.master')

@section('title', 'My Enrolled Courses')

@section('content')
<div class="row column_title">
   <div class="col-md-12">
      <div class="page_title">
         <h2>My Enrolled Courses</h2>
      </div>
   </div>
</div>

<div class="row">
    @forelse($courses as $course)
    <div class="col-md-4 mb-4">
        <div class="white_shd full h-100 shadow-sm border-0">
            <div class="full graph_head p-0">
                <img src="{{ $course->thumbnail }}" class="img-fluid rounded-top" style="height: 200px; width: 100%; object-fit: cover;">
            </div>
            <div class="padding_infor_info">
                <h4>{{ $course->title }}</h4>
                <p class="text-muted mb-2">By {{ $course->instructor->name }}</p>
                <div class="progress mb-3" style="height: 8px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $course->pivot->progress }}%" aria-valuenow="{{ $course->pivot->progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="small font-weight-bold">{{ $course->pivot->progress }}% Completed</span>
                    <a href="{{ route('student.player', $course->slug) }}" class="btn btn-sm btn-primary rounded-pill px-3">
                        {{ $course->pivot->progress > 0 ? 'Continue Learning' : 'Start Learning' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <div class="white_shd full p-5">
            <i class="fa fa-graduation-cap fa-5x text-muted mb-4"></i>
            <h3>You haven't enrolled in any courses yet.</h3>
            <p>Explore our catalog and start your learning journey today!</p>
            <a href="{{ route('course.index') }}" class="btn btn-primary mt-3">Browse Courses</a>
        </div>
    </div>
    @endforelse
</div>
@endsection
