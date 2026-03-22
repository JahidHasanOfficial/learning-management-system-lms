@extends('backend.layouts.master')

@section('title', 'Edit Category')

@section('content')
<div class="row column_title">
   <div class="col-md-12">
      <div class="page_title">
         <h2>Edit Category: {{ $category->name }}</h2>
      </div>
   </div>
</div>

<div class="row">
   <!-- table section -->
   <div class="col-md-12">
      <div class="white_shd full margin_bottom_30">
         <div class="padding_infor_info">
            <form action="{{ route('category.update', $category->id) }}" method="POST">
               @csrf @method('PUT')
               <div class="row">
                  <div class="col-md-12 form-group">
                     <label>Category Name</label>
                     <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control" placeholder="e.g. Graphic Design" required>
                  </div>
                  <div class="col-md-12 form-group">
                     <label>Description</label>
                     <textarea name="description" class="form-control" rows="4">{{ old('description', $category->description) }}</textarea>
                  </div>
               </div>
               <div class="text-right mt-3">
                  <button type="submit" class="btn btn-primary rounded-pill px-5 shadow-sm">Update Category</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
