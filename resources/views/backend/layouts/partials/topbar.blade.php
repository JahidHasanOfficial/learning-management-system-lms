<div class="topbar">
   <nav class="navbar navbar-expand-lg navbar-light">
      <div class="full">
         <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
         <div class="logo_section">
            <a href="{{ route('dashboard') }}"><img class="img-responsive" src="{{ asset('backend/images/logo/logo.png') }}" alt="#" /></a>
         </div>
         <div class="right_topbar">
            <div class="icon_info">
               <ul>
                  <li><a href="#"><i class="fa fa-bell-o"></i><span class="badge">2</span></a></li>
                  <li><a href="#"><i class="fa fa-question-circle"></i></a></li>
                  <li><a href="#"><i class="fa fa-envelope-o"></i><span class="badge">3</span></a></li>
               </ul>
               <ul class="user_profile_dd">
                  <li>
                     <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" src="{{ asset('backend/images/layout_img/user_img.jpg') }}" alt="#" /><span class="name_user">{{ Auth::user()->name ?? 'Guest' }}</span></a>
                     <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">My Profile</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Help</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <span>Log Out</span> <i class="fa fa-sign-out"></i>
                            </a>
                        </form>
                     </div>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </nav>
</div>
