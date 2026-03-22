<!DOCTYPE html>
<html lang="en">
   <head>
      @include('backend.layouts.partials.head')
      @stack('styles')
   </head>
   <body class="dashboard dashboard_1 {{ session('dark_mode') ? 'dark_mode' : '' }}">
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
      <script>
          // Simple dark mode toggle logic
          document.addEventListener('DOMContentLoaded', () => {
              if (localStorage.getItem('theme') === 'dark') {
                  document.body.classList.add('dark_mode');
              }
          });
          
          window.toggleDarkMode = function() {
              document.body.classList.toggle('dark_mode');
              localStorage.setItem('theme', document.body.classList.contains('dark_mode') ? 'dark' : 'light');
          }
      </script>
      @stack('scripts')
   </body>
</html>
