@extends('backend.layouts.master')

@section('title', $lesson->title . ' - Learning')

@section('content')
<div class="row">
    <div class="col-md-9 main-content">
        <div class="video-container mb-4">
            @if($lesson->type == 'video')
            <div class="embed-responsive embed-responsive-16by9 bg-dark">
                <iframe class="embed-responsive-item" id="player" src="{{ $lesson->video_url }}" allowfullscreen></iframe>
            </div>
            @else
            <div class="card p-4">
                <h3>{{ $lesson->title }}</h3>
                <div class="lesson-content">
                   {!! $lesson->content !!}
                </div>
            </div>
            @endif
        </div>
        <div class="lesson-header d-flex justify-content-between align-items-center mb-4">
            <div>
               <h2>{{ $lesson->title }}</h2>
               <p class="text-muted">Section: {{ $lesson->section->title }}</p>
            </div>
            <button class="btn btn-success rounded-pill" onclick="completeLesson({{ $lesson->id }})">
               <i class="fa fa-check-circle mr-1"></i> Mark as Completed
            </button>
        </div>
        
        <div class="tabs-control">
            <ul class="nav nav-tabs" id="lessonTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#notes">Notes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#resources">Resources</a>
                </li>
            </ul>
            <div class="tab-content card p-3 border-top-0 rounded-bottom">
                <div class="tab-pane fade show active" id="notes">
                    <textarea class="form-control" rows="4" placeholder="Take notes for this lesson..."></textarea>
                    <button class="btn btn-primary mt-2">Save Note</button>
                </div>
                <div class="tab-pane fade" id="resources">
                    <ul class="list-unstyled">
                        <li><a href="#"><i class="fa fa-file-pdf-o"></i> Lesson Slides.pdf</a></li>
                        <li><a href="#"><i class="fa fa-code"></i> Source Code.zip</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 curriculum-sidebar">
        <div class="card">
            <div class="card-header bg-dark text-white">
               Course Content
            </div>
            <div id="accordion" class="accordion">
                @foreach($course->sections as $section)
                <div class="card border-0">
                    <div class="card-header p-2 pointer" data-toggle="collapse" data-target="#collapse{{ $section->id }}">
                        <strong>{{ $section->title }}</strong>
                    </div>
                    <div id="collapse{{ $section->id }}" class="collapse show" data-parent="#accordion">
                        <ul class="list-group list-group-flush small">
                            @foreach($section->lessons as $lec)
                            <a href="{{ route('student.player', [$course->slug, $lec->id]) }}" class="list-group-item d-flex justify-content-between {{ $lesson->id == $lec->id ? 'bg-light' : '' }}">
                                <div>
                                    <i class="fa fa-{{ $lec->type == 'video' ? 'play-circle' : 'file-text' }} mr-2"></i>
                                    {{ $lec->title }}
                                </div>
                                @if(isset($progress[$lec->id]) && $progress[$lec->id]->is_completed)
                                    <i class="fa fa-check text-success"></i>
                                @endif
                            </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    function completeLesson(id) {
        fetch(`/lesson/${id}/complete`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(res => res.json()).then(data => {
            if(data.status == 'success') {
                location.reload();
            }
        });
    }
</script>
@endsection
