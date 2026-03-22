@extends('backend.layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="row column_title">
<div class="col-md-12">
   <div class="page_title">
      <h2>Dashboard</h2>
   </div>
</div>
</div>
<div class="row column1">
<div class="col-md-6 col-lg-3">
   <div class="full counter_section margin_bottom_30">
      <div class="couter_icon">
         <div> 
            <i class="fa fa-user yellow_color"></i>
         </div>
      </div>
      <div class="counter_no">
         <div>
            <p class="total_no">{{ $total_students }}</p>
            <p class="head_couter">Total Students</p>
         </div>
      </div>
   </div>
</div>
<div class="col-md-6 col-lg-3">
   <div class="full counter_section margin_bottom_30">
      <div class="couter_icon">
         <div> 
            <i class="fa fa-users blue1_color"></i>
         </div>
      </div>
      <div class="counter_no">
         <div>
            <p class="total_no">{{ $total_instructors }}</p>
            <p class="head_couter">Instructors</p>
         </div>
      </div>
   </div>
</div>
<div class="col-md-6 col-lg-3">
   <div class="full counter_section margin_bottom_30">
      <div class="couter_icon">
         <div> 
            <i class="fa fa-book green_color"></i>
         </div>
      </div>
      <div class="counter_no">
         <div>
            <p class="total_no">{{ $total_courses }}</p>
            <p class="head_couter">Total Courses</p>
         </div>
      </div>
   </div>
</div>
<div class="col-md-6 col-lg-3">
   <div class="full counter_section margin_bottom_30">
      <div class="couter_icon">
         <div> 
            <i class="fa fa-briefcase red_color"></i>
         </div>
      </div>
      <div class="counter_no">
         <div>
            <p class="total_no">{{ $total_admins }}</p>
            <p class="head_couter">Staffs</p>
         </div>
      </div>
   </div>
</div>
</div>
<div class="row column1 social_media_section">
<div class="col-md-6 col-lg-3">
   <div class="full socile_icons fb margin_bottom_30">
      <div class="social_icon">
         <i class="fa fa-facebook"></i>
      </div>
      <div class="social_cont">
         <ul>
            <li>
               <span><strong>35k</strong></span>
               <span>Friends</span>
            </li>
            <li>
               <span><strong>128</strong></span>
               <span>Feeds</span>
            </li>
         </ul>
      </div>
   </div>
</div>
<div class="col-md-6 col-lg-3">
   <div class="full socile_icons tw margin_bottom_30">
      <div class="social_icon">
         <i class="fa fa-twitter"></i>
      </div>
      <div class="social_cont">
         <ul>
            <li>
               <span><strong>584k</strong></span>
               <span>Followers</span>
            </li>
            <li>
               <span><strong>978</strong></span>
               <span>Tweets</span>
            </li>
         </ul>
      </div>
   </div>
</div>
<div class="col-md-6 col-lg-3">
   <div class="full socile_icons linked margin_bottom_30">
      <div class="social_icon">
         <i class="fa fa-linkedin"></i>
      </div>
      <div class="social_cont">
         <ul>
            <li>
               <span><strong>758+</strong></span>
               <span>Contacts</span>
            </li>
            <li>
               <span><strong>365</strong></span>
               <span>Feeds</span>
            </li>
         </ul>
      </div>
   </div>
</div>
<div class="col-md-6 col-lg-3">
   <div class="full socile_icons google_p margin_bottom_30">
      <div class="social_icon">
         <i class="fa fa-google-plus"></i>
      </div>
      <div class="social_cont">
         <ul>
            <li>
               <span><strong>450</strong></span>
               <span>Followers</span>
            </li>
            <li>
               <span><strong>57</strong></span>
               <span>Circles</span>
            </li>
         </ul>
      </div>
   </div>
</div>
</div>
<!-- graph -->
<div class="row column2 graph margin_bottom_30">
<div class="col-md-l2 col-lg-12">
   <div class="white_shd full">
      <div class="full graph_head">
         <div class="heading1 margin_0">
            <h2>Extra Area Chart</h2>
         </div>
      </div>
      <div class="full graph_revenue">
         <div class="row">
            <div class="col-md-12">
               <div class="content">
                  <div class="area_chart">
                     <canvas height="120" id="canvas"></canvas>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<!-- end graph -->
<div class="row column3">
<!-- testimonial -->
<div class="col-md-6">
   <div class="dark_bg full margin_bottom_30">
      <div class="full graph_head">
         <div class="heading1 margin_0">
            <h2>Testimonial</h2>
         </div>
      </div>
      <div class="full graph_revenue">
         <div class="row">
            <div class="col-md-12">
               <div class="content testimonial">
                  <div id="testimonial_slider" class="carousel slide" data-ride="carousel">
                     <!-- Wrapper for carousel items -->
                     <div class="carousel-inner">
                        <div class="item carousel-item active">
                           <div class="img-box"><img src="{{ asset('backend/images/layout_img/user_img.jpg') }}" alt=""></div>
                           <p class="testimonial">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae..</p>
                           <p class="overview"><b>Michael Stuart</b>Seo Founder</p>
                        </div>
                        <div class="item carousel-item">
                           <div class="img-box"><img src="{{ asset('backend/images/layout_img/user_img.jpg') }}" alt=""></div>
                           <p class="testimonial">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae..</p>
                           <p class="overview"><b>Michael Stuart</b>Seo Founder</p>
                        </div>
                        <div class="item carousel-item">
                           <div class="img-box"><img src="{{ asset('backend/images/layout_img/user_img.jpg') }}" alt=""></div>
                           <p class="testimonial">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae..</p>
                           <p class="overview"><b>Michael Stuart</b>Seo Founder</p>
                        </div>
                     </div>
                     <!-- Carousel controls -->
                     <a class="carousel-control left carousel-control-prev" href="#testimonial_slider" data-slide="prev">
                     <i class="fa fa-angle-left"></i>
                     </a>
                     <a class="carousel-control right carousel-control-next" href="#testimonial_slider" data-slide="next">
                     <i class="fa fa-angle-right"></i>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end testimonial -->
<!-- progress bar -->
<div class="col-md-6">
   <div class="white_shd full margin_bottom_30">
      <div class="full graph_head">
         <div class="heading1 margin_0">
            <h2>Progress Bar</h2>
         </div>
      </div>
      <div class="full progress_bar_inner">
         <div class="row">
            <div class="col-md-12">
               <div class="progress_bar">
                  <!-- Skill Bars -->
                  <span class="skill" style="width:73%;">Facebook <span class="info_valume">73%</span></span>                  
                  <div class="progress skill-bar ">
                     <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100" style="width: 73%;">
                     </div>
                  </div>
                  <span class="skill" style="width:62%;">Twitter <span class="info_valume">62%</span></span>   
                  <div class="progress skill-bar">
                     <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%;">
                     </div>
                  </div>
                  <span class="skill" style="width:54%;">Instagram <span class="info_valume">54%</span></span>
                  <div class="progress skill-bar">
                     <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100" style="width: 54%;">
                     </div>
                  </div>
                  <span class="skill" style="width:82%;">Google plus <span class="info_valume">82%</span></span>
                  <div class="progress skill-bar">
                     <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100" style="width: 82%;">
                     </div>
                  </div>
                  <span class="skill" style="width:48%;">Other <span class="info_valume">48%</span></span>
                  <div class="progress skill-bar">
                     <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100" style="width: 48%;">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end progress bar -->
</div>
<div class="row column4 graph">
<div class="col-md-6">
   <div class="dash_blog">
      <div class="dash_blog_inner">
         <div class="dash_head">
            <h3><span><i class="fa fa-calendar"></i> {{ date('d F Y') }}</span><span class="plus_green_bt"><a href="#">+</a></span></h3>
         </div>
         <div class="list_cont">
            <p>Today Tasks</p>
         </div>
         <div class="task_list_main">
            <ul class="task_list">
               <li><a href="#">Setup LMS Project</a><br><strong>09:00 AM</strong></li>
               <li><a href="#">Configure Roles & Permissions</a><br><strong>10:00 AM</strong></li>
               <li><a href="#">Design Backend Layout</a><br><strong>11:00 AM</strong></li>
               <li><a href="#">Integrate Auth System</a><br><strong>12:00 PM</strong></li>
            </ul>
         </div>
         <div class="read_more">
            <div class="center"><a class="main_bt read_bt" href="#">Read More</a></div>
         </div>
      </div>
   </div>
</div>
<div class="col-md-6">
   <div class="dash_blog">
      <div class="dash_blog_inner">
         <div class="dash_head">
            <h3><span><i class="fa fa-history"></i> Recent Login History</span><span class="plus_green_bt"><a href="#">+</a></span></h3>
         </div>
         <div class="list_cont">
            <p>User Analytics</p>
         </div>
         <div class="msg_list_main">
            <ul class="msg_list">
               @forelse($recent_logins as $login)
               <li>
                  <span><img src="{{ $login->user->profile_image }}" class="img-responsive rounded-circle" alt="#" style="width: 40px; height: 40px; object-fit: cover;" /></span>
                  <span>
                  <span class="name_user">{{ $login->user->name }}</span>
                  <span class="msg_user">Logged in from <strong>{{ $login->ip_address }}</strong></span>
                  <span class="time_ago">{{ $login->login_at->diffForHumans() }}</span>
                  </span>
               </li>
               @empty
               <li class="text-center p-3">No login history found.</li>
               @endforelse
            </ul>
         </div>
         <div class="read_more">
            <div class="center"><a class="main_bt read_bt" href="#">View All</a></div>
         </div>
      </div>
   </div>
</div>
</div>
@endsection
