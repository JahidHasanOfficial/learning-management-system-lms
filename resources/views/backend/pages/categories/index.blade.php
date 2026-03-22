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
         <div class="full graph_head">
            <div class="row w-100 align-items-center m-0">
               <div class="col-md-3 p-0">
                  <div class="heading1 margin_0">
                     <h2>Course Categories</h2>
                  </div>
               </div>
               <div class="col-md-6 p-0">
                  <form action="{{ route('category.index') }}" method="GET" class="d-flex align-items-center">
                     <input type="text" name="search" class="form-control rounded-pill mr-2" placeholder="Search by name..." value="{{ request('search') }}">
                     <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="fa fa-search"></i></button>
                  </form>
               </div>
               <div class="col-md-3 text-right p-0">
                  <a href="{{ route('category.create') }}" class="btn btn-primary rounded-pill px-4"><i class="fa fa-plus"></i> Add New</a>
               </div>
            </div>
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
