@extends('backend.layouts.master')

@section('title', 'Student Dashboard')

@section('content')
<div class="row column_title">
   <div class="col-md-12">
      <div class="page_title">
         <h2>Student Dashboard</h2>
      </div>
   </div>
</div>

<div class="row column1">
   <div class="col-md-6 col-lg-6">
      <div class="full counter_section margin_bottom_30">
         <div class="couter_icon">
            <div> 
               <i class="fa fa-book green_color"></i>
            </div>
         </div>
         <div class="counter_no">
            <div>
               <p class="total_no">{{ $enrolled_courses }}</p>
               <p class="head_couter">Enrolled Courses</p>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-6 col-lg-6">
      <div class="full counter_section margin_bottom_30">
         <div class="couter_icon">
            <div> 
               <i class="fa fa-check-circle blue1_color"></i>
            </div>
         </div>
         <div class="counter_no">
            <div>
               <p class="total_no">{{ $completed_courses }}</p>
               <p class="head_couter">Completed Courses</p>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                    <h2>Continue Learning</h2>
                </div>
            </div>
            <div class="padding_infor_info">
                <div class="row">
                    <div class="col-md-12 text-center py-5">
                       <i class="fa fa-graduation-cap fa-5x text-muted mb-3"></i>
                       <h4>No courses joined yet!</h4>
                       <p>Start your learning journey by exploring our available courses.</p>
                       <a href="#" class="main_bt mt-3">Browse Courses</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
