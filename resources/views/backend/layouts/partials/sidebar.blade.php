<nav id="sidebar">
   <div class="sidebar_blog_1">
      <div class="sidebar-header">
         <div class="logo_section">
            <a href="{{ route('dashboard') }}"><img class="logo_icon img-responsive" src="{{ asset('backend/images/logo/logo_icon.png') }}" alt="#" /></a>
         </div>
      </div>
      <div class="sidebar_user_info">
         <div class="icon_setting"></div>
         <div class="user_profle_side">
            <div class="user_img"><img class="img-responsive" src="{{ asset('backend/images/layout_img/user_img.jpg') }}" alt="#" /></div>
            <div class="user_info">
               <h6>{{ Auth::user()->name ?? 'Guest' }}</h6>
               <p><span class="online_animation"></span> Online</p>
            </div>
         </div>
      </div>
   </div>
   <div class="sidebar_blog_2">
      <h4>General</h4>
      <ul class="list-unstyled components">
         <li class="active">
            <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard yellow_color"></i> <span>Dashboard</span></a>
         </li>
         <!-- Course Management -->
         <li>
            <a href="#courses" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-book purple_color"></i> <span>Courses</span></a>
            <ul class="collapse list-unstyled" id="courses">
               <li><a href="{{ route('course.index') }}">> <span>All Courses</span></a></li>
               <li><a href="#">> <span>Categories</span></a></li>
               <li><a href="{{ route('course.create') }}">> <span>Add New Course</span></a></li>
            </ul>
         </li>
         
         <!-- Subscription System -->
         <li><a href="#"><i class="fa fa-credit-card orange_color"></i> <span>Subscriptions</span></a></li>
         
         <!-- Student Learning System -->
         <li>
            <a href="#students" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-users blue2_color"></i> <span>Students</span></a>
            <ul class="collapse list-unstyled" id="students">
               <li><a href="#">> <span>Student List</span></a></li>
               <li><a href="#">> <span>Learning Progress</span></a></li>
            </ul>
         </li>
         
         <!-- Job Placement -->
         <li><a href="#"><i class="fa fa-briefcase blue1_color"></i> <span>Job Placement</span></a></li>
         
         <!-- User & Role Management (Admin only) -->
         @role('Super Admin|Admin')
         <li>
            <a href="#user_mgmt" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-cog yellow_color"></i> <span>Management</span></a>
            <ul class="collapse list-unstyled" id="user_mgmt">
               <li><a href="#">> <span>Users</span></a></li>
               <li><a href="#">> <span>Roles & Permissions</span></a></li>
            </ul>
         </li>
         @endrole
         <li><a href="#"><i class="fa fa-cog yellow_color"></i> <span>Settings</span></a></li>
      </ul>
   </div>
</nav>
