@extends('backend.layouts.master')

@section('title', 'Add Category')

@section('content')
<div class="row column_title">
   <div class="col-md-12">
      <div class="page_title">
         <h2>Add Category</h2>
      </div>
   </div>
</div>

<div class="row">
   <!-- table section -->
   <div class="col-md-12">
      <div class="white_shd full margin_bottom_30">
         <div class="padding_infor_info">
            <form action="{{ route('category.store') }}" method="POST">
               @csrf
               <div class="row">
                  <div class="col-md-12 form-group">
                     <label>Category Name</label>
                     <input type="text" name="name" class="form-control" placeholder="e.g. Graphic Design" required>
                  </div>
                  <div class="col-md-12 form-group">
                     <label>Description</label>
                     <textarea name="description" class="form-control" rows="4"></textarea>
                  </div>
               </div>
               <div class="text-right mt-3">
                  <button type="submit" class="btn btn-primary rounded-pill px-5 shadow-sm">Save Category</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
