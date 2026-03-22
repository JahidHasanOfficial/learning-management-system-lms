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
            <div class="user_img"><img class="img-responsive rounded-circle" src="{{ Auth::user()->profile_image }}" alt="#" style="width: 45px; height: 45px; object-fit: cover;" /></div>
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
         <li class="{{ Route::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard yellow_color"></i> <span>Dashboard</span></a>
         </li>
         <!-- Course Management -->
         @role('Instructor|Admin|Super Admin')
         <li class="{{ request()->is('course*') || request()->is('category*') || request()->is('live-class*') ? 'active' : '' }}">
            <a href="#courses" data-toggle="collapse" aria-expanded="{{ request()->is('course*') || request()->is('category*') ? 'true' : 'false' }}" class="dropdown-toggle"><i class="fa fa-book purple_color"></i> <span>Courses</span></a>
            <ul class="collapse list-unstyled {{ request()->is('course*') || request()->is('category*') || request()->is('live-class*') ? 'show' : '' }}" id="courses">
               <li class="{{ request()->is('course') ? 'active' : '' }}"><a href="{{ route('course.index') }}">> <span>All Courses</span></a></li>
               <li class="{{ request()->is('category*') ? 'active' : '' }}"><a href="{{ route('category.index') }}">> <span>Categories</span></a></li>
               <li class="{{ request()->is('live-class*') ? 'active' : '' }}"><a href="{{ route('live-class.index') }}">> <span>Live Classes</span></a></li>
               <li class="{{ request()->is('course/create') ? 'active' : '' }}"><a href="{{ route('course.create') }}">> <span>Add New Course</span></a></li>
            </ul>
         </li>
         @endrole
         
         <!-- Subscription System -->
         @role('Admin|Super Admin')
         <li><a href="#"><i class="fa fa-credit-card orange_color"></i> <span>Subscriptions</span></a></li>
         @endrole
         
         @role('Student')
         <li class="{{ request()->is('my-courses*') ? 'active' : '' }}">
            <a href="{{ route('student.my-courses') }}"><i class="fa fa-graduation-cap blue2_color"></i> <span>My Learning</span></a>
         </li>
         @endrole

         @role('Instructor|Admin|Super Admin')
         <li>
            <a href="#students" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-users blue2_color"></i> <span>Students</span></a>
            <ul class="collapse list-unstyled {{ request()->is('students*') ? 'show' : '' }}" id="students">
               <li class="{{ request()->is('students') ? 'active' : '' }}"><a href="{{ route('student.index') }}">> <span>All Students</span></a></li>
               <li class="{{ request()->is('students/enrollments') ? 'active' : '' }}"><a href="{{ route('student.enrollments') }}">> <span>Enrolled Students</span></a></li>
               <li class="{{ request()->is('students/progress') ? 'active' : '' }}"><a href="{{ route('student.progress') }}">> <span>Learning Progress</span></a></li>
            </ul>
         </li>
         @endrole
         
         <!-- Job Placement -->
         @role('Admin|Super Admin')
         <li><a href="#"><i class="fa fa-briefcase blue1_color"></i> <span>Job Placement</span></a></li>
         @endrole
         
         <!-- User & Role Management (Admin only) -->
         @role('Super Admin|Admin')
         <li class="{{ request()->is('user*') || request()->is('role*') ? 'active' : '' }}">
            <a href="#user_mgmt" data-toggle="collapse" aria-expanded="{{ request()->is('user*') || request()->is('role*') ? 'true' : 'false' }}" class="dropdown-toggle"><i class="fa fa-cog yellow_color"></i> <span>Management</span></a>
            <ul class="collapse list-unstyled {{ request()->is('user*') || request()->is('role*') ? 'show' : '' }}" id="user_mgmt">
               <li class="{{ request()->is('user*') ? 'active' : '' }}"><a href="{{ route('user.index') }}">> <span>Users</span></a></li>
               <li class="{{ request()->is('role*') ? 'active' : '' }}"><a href="{{ route('role.index') }}">> <span>Roles & Permissions</span></a></li>
            </ul>
         </li>
         @endrole
         @role('Admin|Super Admin')
         <li><a href="#"><i class="fa fa-cog yellow_color"></i> <span>Settings</span></a></li>
         @endrole
      </ul>
   </div>
</nav>
