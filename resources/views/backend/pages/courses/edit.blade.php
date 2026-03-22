@extends('backend.layouts.master')

@section('title', 'Edit Course')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <h2>Edit Course</h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                    <h2>Course Details: {{ $course->title }}</h2>
                </div>
            </div>
            <div class="padding_infor_info">
                <form action="{{ route('course.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Course Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter course title" value="{{ old('title', $course->title) }}" required>
                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="10" placeholder="Enter course description">{{ old('description', $course->description) }}</textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" name="price" class="form-control" placeholder="0.00" value="{{ old('price', $course->price) }}" required step="0.01">
                                @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label>Current Thumbnail</label>
                                @if($course->thumbnail)
                                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="thumb" width="100" class="d-block mb-2">
                                @endif
                                <input type="file" name="thumbnail" class="form-control">
                                @error('thumbnail') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <select name="category_id" class="form-control" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Assign Instructors (Multiple)</label>
                                <select name="instructor_ids[]" class="form-control" multiple style="height: 100px;">
                                    @foreach($instructors as $instructor)
                                        <option value="{{ $instructor->id }}" 
                                            {{ (is_array(old('instructor_ids')) && in_array($instructor->id, old('instructor_ids'))) || (!old('instructor_ids') && $course->instructors->contains($instructor->id)) ? 'selected' : '' }}>
                                            {{ $instructor->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted text-info">Hold Ctrl (Windows) or Cmd (Mac) to select multiple.</small>
                            </div>
                            <div class="form-group">
                                <label>Career Path</label>
                                <input type="text" name="career_path" class="form-control" value="{{ old('career_path', $course->career_path) }}">
                            </div>
                            <div class="form-group">
                                <label>Tags (Comma separated)</label>
                                <input type="text" name="tags" class="form-control" value="{{ old('tags', is_array($course->tags) ? implode(',', $course->tags) : $course->tags) }}">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="draft" {{ old('status', $course->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status', $course->status) == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="pending_approval" {{ old('status', $course->status) == 'pending_approval' ? 'selected' : '' }}>Pending Approval</option>
                                </select>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="is_featured" class="custom-control-input" id="is_featured" value="1" {{ old('is_featured', $course->is_featured) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_featured">Is Featured?</label>
                                </div>
                            </div>
                            <div class="form-group mt-5">
                                <button type="submit" class="btn btn-primary btn-block">Update Course</button>
                                <a href="{{ route('course.index') }}" class="btn btn-secondary btn-block">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
