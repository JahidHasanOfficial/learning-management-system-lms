<!DOCTYPE html>
<html lang="en">
   <head>
      @include('backend.layouts.partials.head')
      @stack('styles')
   </head>
   <body class="dashboard dashboard_1">
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
            @include('backend.layouts.partials.sidebar')
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
               <!-- topbar -->
               @include('backend.layouts.partials.topbar')
               <!-- end topbar -->
               <!-- dashboard inner -->
               <div class="midde_cont">
                  <div class="container-fluid">
                     @yield('content')
                  </div>
                  <!-- footer -->
                  @include('backend.layouts.partials.footer')
               </div>
               <!-- end dashboard inner -->
            </div>
         </div>
      </div>
      @include('backend.layouts.partials.scripts')
      @stack('scripts')
   </body>
</html>
