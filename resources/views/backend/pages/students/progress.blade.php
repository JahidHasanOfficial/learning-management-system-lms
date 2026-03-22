@extends('backend.layouts.master')

@section('title', 'Learning Progress Tracking')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <h2>Overall Learning Progress</h2>
        </div>
    </div>
</div>

<div class="row">
    @forelse($students as $student)
        <div class="col-md-6 mb-4">
            <div class="white_shd full h-100">
                <div class="full graph_head">
                    <div class="d-flex align-items-center">
                        <img src="{{ $student->profile_image }}" class="rounded-circle mr-3" width="45" height="45" style="object-fit: cover;">
                        <div class="heading1 margin_0">
                            <h2 class="mb-0">{{ $student->name }}</h2>
                            <small class="text-muted">{{ $student->email }}</small>
                        </div>
                    </div>
                </div>
                <div class="padding_infor_info">
                    <h6 class="mb-3 small font-weight-bold text-uppercase">Enrollments ({{ $student->enrolledCourses->count() }})</h6>
                    <div class="enrolled-list" style="max-height: 250px; overflow-y: auto;">
                        @forelse($student->enrolledCourses as $course)
                            <div class="mb-4">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="small font-weight-bold">{{ $course->title }}</span>
                                    <span class="small text-primary">{{ $course->pivot->progress }}%</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $course->pivot->progress }}%" aria-valuenow="{{ $course->pivot->progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between mt-1">
                                    <small class="text-muted xsmall">Started: {{ \Carbon\Carbon::parse($course->pivot->enrolled_at)->format('d M, Y') }}</small>
                                    <small class="badge badge-pill {{ $course->pivot->status == 'completed' ? 'badge-success' : 'badge-warning' }} xsmall" style="font-size: 9px;">{{ ucfirst($course->pivot->status) }}</small>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted small py-3">No course enrollments found.</p>
                        @endforelse
                    </div>
                    <div class="text-right mt-3">
                        <a href="{{ route('student.show_backend', $student->id) }}" class="btn btn-outline-primary btn-xs">View Full Profile</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">No student data available to track.</div>
        </div>
    @endforelse
</div>

<div class="row">
    <div class="col-md-12">
        <div class="pagination_section">
            {{ $students->links() }}
        </div>
    </div>
</div>

<style>
    .btn-xs { padding: 2px 8px; font-size: 11px; }
    .xsmall { font-size: 11px; }
    .enrolled-list::-webkit-scrollbar { width: 4px; }
    .enrolled-list::-webkit-scrollbar-thumb { background: #eee; border-radius: 10px; }
</style>
@endsection
