@extends('backend.layouts.master')

@section('title', 'Student Profile: ' . $user->name)

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <h2>Student Learning Profile</h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                    <h2>{{ $user->name }}</h2>
                </div>
            </div>
            <div class="padding_infor_info text-center">
                <img src="{{ $user->profile_image }}" class="rounded-circle mb-3 shadow" width="120" height="120" style="object-fit: cover; border: 3px solid #eee;">
                <h4>{{ $user->name }}</h4>
                <p class="text-muted"><i class="fa fa-envelope mr-2"></i>{{ $user->email }}</p>
                <p class="text-muted"><i class="fa fa-phone mr-2"></i>{{ $user->phone }}</p>
                <hr>
                <div class="row text-center mt-3">
                    <div class="col-6">
                        <h6 class="mb-0">{{ $user->enrolledCourses->count() }}</h6>
                        <small>Courses</small>
                    </div>
                    <div class="col-6">
                        <h6 class="mb-0">{{ $user->enrolledCourses->where('pivot.status', 'completed')->count() }}</h6>
                        <small>Completed</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                    <h2>Enrolled Courses</h2>
                </div>
            </div>
            <div class="table_section padding_infor_info">
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Course Title</th>
                                <th>Enrolled Date</th>
                                <th>Progress</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($user->enrolledCourses as $course)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ $course->title }}</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($course->pivot->enrolled_at)->format('d M, Y') }}</td>
                                    <td>
                                        <div class="progress" style="height: 10px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $course->pivot->progress }}%" aria-valuenow="{{ $course->pivot->progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>{{ $course->pivot->progress }}% complete</small>
                                    </td>
                                    <td>
                                        <span class="badge {{ $course->pivot->status == 'completed' ? 'badge-success' : 'badge-warning' }}">
                                            {{ ucfirst($course->pivot->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No active enrollments for this student.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
