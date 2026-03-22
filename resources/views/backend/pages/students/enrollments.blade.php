@extends('backend.layouts.master')

@section('title', 'Enrollment History')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <h2>Course Enrollments</h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                    <h2>Filter & Search</h2>
                </div>
            </div>
            <div class="padding_infor_info">
                <form action="{{ route('student.enrollments') }}" method="GET" class="row gx-4">
                    <div class="col-md-2 form-group">
                        <label class="small text-muted mb-1">Search</label>
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Name/Email..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="small text-muted mb-1">Select Course</label>
                        <select name="course_id" class="form-control form-control-sm">
                            <option value="">All Courses</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="small text-muted mb-1">Select Batch</label>
                        <select name="batch_id" class="form-control form-control-sm">
                            <option value="">All Batches</option>
                            @foreach($batches as $batch)
                                <option value="{{ $batch->id }}" {{ request('batch_id') == $batch->id ? 'selected' : '' }}>{{ $batch->name }} ({{ $batch->course->title }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="small text-muted mb-1">From Date</label>
                        <input type="date" name="from_date" class="form-control form-control-sm" value="{{ request('from_date') }}">
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="small text-muted mb-1">To Date</label>
                        <input type="date" name="to_date" class="form-control form-control-sm" value="{{ request('to_date') }}">
                    </div>
                    <div class="col-md-1 form-group d-flex align-items-end mb-3">
                        <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="fa fa-filter"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                    <h2>Active Enrollment Records</h2>
                </div>
            </div>
            <div class="table_section padding_infor_info">
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student</th>
                                <th>Course</th>
                                <th>Batch</th>
                                <th>Enrollment Date</th>
                                <th>Status</th>
                                <th>Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($enrollments as $enrollment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ $enrollment->user_name }}</strong><br>
                                        <small class="text-muted">{{ $enrollment->user_email }}</small>
                                    </td>
                                    <td><span class="text-primary fw-bold">{{ $enrollment->course_title }}</span></td>
                                    <td>
                                        @if($enrollment->batch_name)
                                            <span class="badge badge-secondary">{{ $enrollment->batch_name }}</span>
                                        @else
                                            <span class="text-muted small italic">Not Assigned</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($enrollment->enrolled_at)->format('d M, Y h:i A') }}</td>
                                    <td>
                                        <span class="badge {{ $enrollment->status == 'completed' ? 'badge-success' : 'badge-warning' }}">
                                            {{ ucfirst($enrollment->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-success" style="width:{{ $enrollment->progress }}%"></div>
                                        </div>
                                        <small>{{ $enrollment->progress }}%</small>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No enrollment records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="pagination_section mt-3">
                    {{ $enrollments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
