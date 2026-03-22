@extends('backend.layouts.master')

@section('title', 'Category Management')

@section('content')
<div class="row column_title">
   <div class="col-md-12">
      <div class="page_title">
         <h2>Category Management</h2>
      </div>
   </div>
</div>

<div class="row">
   <!-- table section -->
   <div class="col-md-12">
      <div class="white_shd full margin_bottom_30">
         <div class="full graph_head d-flex justify-content-between">
            <div class="heading1 margin_0">
               <h2>Course Categories</h2>
            </div>
            <a href="{{ route('category.create') }}" class="btn btn-primary rounded-pill"><i class="fa fa-plus"></i> Add New</a>
         </div>
         <div class="table_section padding_infor_info">
            <div class="table-responsive-sm">
               <table class="table table-hover">
                  <thead class="thead-dark">
                     <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($categories as $category)
                     <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                           <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                           <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline">
                              @csrf @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')"><i class="fa fa-trash"></i></button>
                           </form>
                        </td>
                     </tr>
                     @empty
                     <tr>
                        <td colspan="5" class="text-center">No categories found.</td>
                     </tr>
                     @endforelse
                  </tbody>
               </table>
               {{ $categories->links() }}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
