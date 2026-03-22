@extends('backend.layouts.master')

@section('title', $user->name . ' - Profile')

@section('content')
<div class="row column_title">
   <div class="col-md-12">
      <div class="page_title">
         <h2>Instructor Profile</h2>
      </div>
   </div>
</div>

<div class="row">
   <!-- Profile Sidebar -->
   <div class="col-md-4">
      <div class="white_shd full margin_bottom_30 p-4 text-center">
         <div class="profile_img mb-4">
            <img class="rounded-circle border p-2 shadow-sm" src="{{ $user->profile_image }}" alt="#" style="width: 150px; height: 150px; object-fit: cover;" />
         </div>
         <h4 class="font-weight-bold text-dark">{{ $user->name }}</h4>
         <p class="text-muted small"><i class="fa fa-envelope-o mr-1"></i> {{ $user->email }}</p>
         <div class="mb-4">
            <span class="badge badge-success-soft badge-pill py-1 px-4">Verified Instructor</span>
         </div>
         <hr>
         <div class="row text-center mt-3">
            <div class="col-6">
               <h5 class="m-0 font-weight-bold">{{ $user->courses->count() }}</h5>
               <p class="small text-muted">Courses</p>
            </div>
            <div class="col-6">
               <h5 class="m-0 font-weight-bold">4.9</h5>
               <p class="small text-muted">Avg Rating</p>
            </div>
         </div>
         <div class="mt-4">
            <a href="mailto:{{ $user->email }}" class="btn btn-primary btn-block rounded-pill shadow-sm py-2">Contact Instructor</a>
         </div>
      </div>
   </div>

   <!-- Instructor details & Courses -->
   <div class="col-md-8">
      <div class="white_shd full margin_bottom_30 p-4">
         <h3 class="mb-4 border-bottom pb-3">Expertise & Bio</h3>
         <p class="lead text-dark">{{ $user->bio ?? 'Highly skilled and experienced educator committed to empowering students through practical knowledge.' }}</p>
         
         <h4 class="mt-5 mb-4">Courses by {{ $user->name }}</h4>
         <div class="row">
            @forelse($user->courses as $course)
            <div class="col-md-6 mb-4">
               <div class="course_card border rounded shadow-sm h-100 overflow-hidden bg-white">
                  <img src="{{ $course->thumbnail }}" class="img-fluid" style="height: 180px; width: 100%; object-fit: cover;">
                  <div class="p-3">
                     <h6 class="font-weight-bold text-dark mb-2">{{ $course->title }}</h6>
                     <div class="d-flex justify-content-between align-items-center">
                        <span class="text-primary font-weight-bold">${{ number_format($course->price, 2) }}</span>
                        <a href="{{ route('course.show', $course->id) }}" class="btn btn-sm btn-link p-0">View Course</a>
                     </div>
                  </div>
               </div>
            </div>
            @empty
            <div class="col-md-12">
               <div class="alert alert-light border">No courses published yet.</div>
            </div>
            @endforelse
         </div>
      </div>
   </div>
</div>

<style>
.badge-success-soft {
    background-color: #e8f5e9;
    color: #2e7d32;
}
.course_card {
    transition: transform 0.2s ease;
}
.course_card:hover {
    transform: scale(1.02);
}
</style>
@endsection
