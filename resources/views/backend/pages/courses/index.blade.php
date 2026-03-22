@extends('backend.layouts.master')

@section('title', 'Courses')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <h2>Course List</h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="row w-100 align-items-center m-0">
                    <div class="col-md-3">
                        <div class="heading1 margin_0">
                            <h2>All Courses</h2>
                        </div>
                    </div>
                    <div class="col-md-6 p-0">
                        <form action="{{ route('course.index') }}" method="GET" class="d-flex align-items-center">
                            <input type="text" name="search" class="form-control rounded-pill mr-2" placeholder="Search by title..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="col-md-3 text-right p-0">
                        <a href="{{ route('course.create') }}" class="btn btn-primary rounded-pill px-4"><i class="fa fa-plus"></i> Add New</a>
                    </div>
                </div>
            </div>
            <div class="table_section padding_infor_info">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Thumbnail</th>
                                <th>Title</th>
                                <th>Instructor</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($courses as $course)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ $course->thumbnail }}" alt="thumb" class="rounded-circle" width="50" height="50" style="object-fit:cover;">
                                    </td>
                                    <td>{{ $course->title }}</td>
                                    <td>{{ $course->instructor->name ?? 'N/A' }}</td>
                                    <td>{{ number_format($course->price, 2) }}</td>
                                    <td>
                                        <span class="badge {{ $course->status == 'published' ? 'badge-success' : 'badge-warning' }}">
                                            {{ ucfirst($course->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('course.show', $course->id) }}" class="btn btn-primary btn-sm rounded-left" title="View Details"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('course.edit', $course->id) }}" class="btn btn-info btn-sm" title="Edit Course"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('course.curriculum', $course->id) }}" class="btn btn-secondary btn-sm" title="Manage Curriculum"><i class="fa fa-list"></i></a>
                                            <a href="{{ route('live-class.create', ['course_id' => $course->id]) }}" class="btn btn-warning btn-sm" title="Schedule Live Class"><i class="fa fa-video-camera"></i></a>
                                            <form action="{{ route('course.destroy', $course->id) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" title="Delete Course"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No courses found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="pagination_section mt-3">
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
