@extends('backend.layouts.master')

@section('title', 'Instructors List')

@section('content')
<div class="row column_title">
   <div class="col-md-12">
      <div class="page_title">
         <h2>Our Instructors</h2>
      </div>
   </div>
</div>

<div class="row mb-4">
   <div class="col-md-12">
      <div class="white_shd full graph_head p-4">
         <div class="row align-items-center">
            <div class="col-md-6">
               <h4 class="m-0 text-dark">Discover Experts</h4>
            </div>
            <div class="col-md-6">
               <form action="{{ route('instructor.index') }}" method="GET" class="d-flex align-items-center">
                  <input type="text" name="search" class="form-control rounded-pill mr-2 shadow-sm" placeholder="Search by name..." value="{{ request('search') }}">
                  <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm"><i class="fa fa-search"></i> Search</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="row">
   @forelse($instructors as $instructor)
   <div class="col-md-3 col-sm-6 mb-4">
      <div class="white_shd full margin_bottom_30 text-center instructor_card_box p-4 border rounded shadow-sm bg-white h-100">
         <div class="profile_img mb-3">
            <img class="img-responsive rounded-circle border p-1 shadow-sm" src="{{ $instructor->profile_image }}" alt="#" style="width: 120px; height: 120px; object-fit: cover;" />
         </div>
         <div class="instructor_info">
            <h5 class="font-weight-bold text-dark mb-1">{{ $instructor->name }}</h5>
            <p class="text-muted small mb-2"><i class="fa fa-envelope-o mr-1"></i> {{ $instructor->email }}</p>
            <div class="mb-3">
               <span class="badge badge-info-soft badge-pill py-1 px-3">Expert Instructor</span>
            </div>
            <p class="small text-muted mb-4">{{ Str::limit($instructor->bio ?? 'Passionate educator with years of industry experience.', 60) }}</p>
            <div class="d-flex justify-content-center">
               <a href="{{ route('instructor.show', $instructor->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-4"><i class="fa fa-user-circle mr-1"></i> Profile</a>
            </div>
         </div>
      </div>
   </div>
   @empty
   <div class="col-md-12">
      <div class="alert alert-info text-center">No instructors found.</div>
   </div>
   @endforelse
</div>

<div class="row mt-4">
   <div class="col-md-12 d-flex justify-content-center">
      {{ $instructors->links() }}
   </div>
</div>

<style>
.badge-info-soft {
    background-color: #e3f2fd;
    color: #1976d2;
}
.instructor_card_box {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.instructor_card_box:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}
</style>
@endsection
