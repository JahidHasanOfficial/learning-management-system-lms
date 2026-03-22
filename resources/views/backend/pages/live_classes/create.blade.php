@extends('backend.layouts.master')

@section('title', 'Schedule Live Class')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                    <h2>Schedule New Live Session</h2>
                </div>
            </div>
            <div class="padding_infor_info">
                <form action="{{ route('live-class.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Course</label>
                            <select name="course_id" id="course_id" class="form-control" required>
                                <option value="">Select Course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Batch (Optional)</label>
                            <select name="batch_id" id="batch_id" class="form-control">
                                <option value="">No Batch</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. Q&A Session" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Start Date & Time</label>
                            <input type="datetime-local" name="start_time" class="form-control" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Duration (Minutes)</label>
                            <input type="number" name="duration" class="form-control" value="60" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Platform/Provider</label>
                            <select name="provider" class="form-control" required>
                                <option value="zoom">Zoom</option>
                                <option value="jitsi">Jitsi (WebRTC)</option>
                                <option value="google_meet">Google Meet</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Join URL (Optional)</label>
                            <input type="url" name="join_url" class="form-control" placeholder="Enter session URL if generated manually">
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Short Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm">Schedule Session</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('course_id').onchange = function() {
        const val = this.value;
        const batchSelect = document.getElementById('batch_id');
        batchSelect.innerHTML = '<option value="">Loading...</option>';
        if(val) {
            fetch(`/api/course/${val}/batches`)
                .then(res => res.json())
                .then(data => {
                    batchSelect.innerHTML = '<option value="">No Batch</option>';
                    data.forEach(batch => {
                        batchSelect.innerHTML += `<option value="${batch.id}">${batch.name}</option>`;
                    });
                });
        }
    }
</script>
@endsection
