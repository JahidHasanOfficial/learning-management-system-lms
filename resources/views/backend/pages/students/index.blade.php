@extends('backend.layouts.master')

@section('title', 'Student List')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <h2>Student Management</h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                    <h2>Enrolled Students</h2>
                </div>
            </div>
            <div class="table_section padding_infor_info">
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Courses</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ $student->profile_image }}" class="rounded-circle" width="35" height="35" style="object-fit: cover;">
                                    </td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->phone }}</td>
                                    <td><span class="badge badge-info">{{ $student->enrolled_courses_count }} Enrollments</span></td>
                                    <td>
                                        <span class="badge {{ $student->status == 'active' ? 'badge-success' : 'badge-danger' }}">
                                            {{ ucfirst($student->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('student.show_backend', $student->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View Courses</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No students found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="pagination_section mt-3">
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
