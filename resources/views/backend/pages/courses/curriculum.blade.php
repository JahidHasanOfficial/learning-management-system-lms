@extends('backend.layouts.master')

@section('title', 'Curriculum Builder - ' . $course->title)

@section('content')
<div class="row column_title">
   <div class="col-md-12">
      <div class="page_title">
         <h2>Curriculum Builder: {{ $course->title }}</h2>
      </div>
   </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                    <h2>Add New Section</h2>
                </div>
            </div>
            <div class="padding_infor_info">
                <form action="{{ route('course.section.store', $course->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Section Title</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. Introduction to PHP" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-3">Add Section</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="curriculum-list">
            @forelse($course->sections as $section)
            <div class="white_shd full margin_bottom_30 section-card" data-id="{{ $section->id }}">
                <div class="full graph_head d-flex justify-content-between align-items-center">
                    <div class="heading1 margin_0">
                        <h2>Section: {{ $section->title }}</h2>
                    </div>
                    <button class="btn btn-sm btn-info rounded-pill" data-toggle="modal" data-target="#addLessonModal{{ $section->id }}">
                        <i class="fa fa-plus"></i> Add Lesson
                    </button>
                </div>
                <div class="padding_infor_info">
                    <ul class="list-group lesson-list" data-section-id="{{ $section->id }}">
                        @forelse($section->lessons as $lesson)
                        <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $lesson->id }}">
                            <div>
                                <i class="fa fa-{{ $lesson->type == 'video' ? 'play-circle' : ($lesson->type == 'pdf' ? 'file-pdf-o' : 'file-text-o') }} mr-2"></i>
                                {{ $lesson->title }}
                                @if($lesson->is_preview)
                                    <span class="badge badge-success ml-2">Preview</span>
                                @endif
                            </div>
                            <div>
                                <button class="btn btn-sm text-warning"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm text-danger"><i class="fa fa-trash"></i></button>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item text-center text-muted">No lessons in this section.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <!-- Add Lesson Modal -->
            <div class="modal fade" id="addLessonModal{{ $section->id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('course.lesson.store', $section->id) }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Lesson to {{ $section->title }}</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Lesson Title</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Lesson Type</label>
                                    <select name="type" class="form-control" required>
                                        <option value="video">Video</option>
                                        <option value="text">Text Content</option>
                                        <option value="pdf">PDF Document</option>
                                        <option value="quiz">Quiz</option>
                                        <option value="assignment">Assignment</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Video URL / Content</label>
                                    <input type="text" name="video_url" class="form-control" placeholder="YouTube/Vimeo URL or content summary">
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="is_preview" value="1" class="form-check-input" id="previewCheck{{ $section->id }}">
                                    <label class="form-check-label" for="previewCheck{{ $section->id }}">Enable for Preview</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Lesson</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @empty
            <div class="alert alert-info text-center">No sections created for this course yet. Start by adding a section.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
