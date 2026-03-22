@extends('backend.layouts.master')

@section('title', 'Instructor Dashboard')

@section('content')
<div class="row column_title">
   <div class="col-md-12">
      <div class="page_title">
         <h2>Instructor Dashboard</h2>
      </div>
   </div>
</div>

<div class="row column1">
   <div class="col-md-6 col-lg-4">
      <div class="full counter_section margin_bottom_30">
         <div class="couter_icon">
            <div> 
               <i class="fa fa-book green_color"></i>
            </div>
         </div>
         <div class="counter_no">
            <div>
               <p class="total_no">{{ $total_courses }}</p>
               <p class="head_couter">My Courses</p>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-6 col-lg-4">
      <div class="full counter_section margin_bottom_30">
         <div class="couter_icon">
            <div> 
               <i class="fa fa-users blue1_color"></i>
            </div>
         </div>
         <div class="counter_no">
            <div>
               <p class="total_no">0</p>
               <p class="head_couter">Total Enrolled</p>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-6 col-lg-4">
      <div class="full counter_section margin_bottom_30">
         <div class="couter_icon">
            <div> 
               <i class="fa fa-money yellow_color"></i>
            </div>
         </div>
         <div class="counter_no">
            <div>
               <p class="total_no">$0.00</p>
               <p class="head_couter">Earnings</p>
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
                    <h2>My Recent Courses</h2>
                </div>
            </div>
            <div class="padding_infor_info">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Students</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" class="text-center">No courses found.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
