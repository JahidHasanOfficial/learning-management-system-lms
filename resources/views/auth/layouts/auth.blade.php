<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>@yield('title', 'LMS Login')</title>
      <!-- site icon -->
      <link rel="icon" href="{{ asset('backend/images/fevicon.png') }}" type="image/png" />
      <!-- bootstrap css -->
      <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}" />
      <!-- site css -->
      <link rel="stylesheet" href="{{ asset('backend/style.css') }}" />
      <!-- responsive css -->
      <link rel="stylesheet" href="{{ asset('backend/css/responsive.css') }}" />
      <!-- color css -->
      <link rel="stylesheet" href="{{ asset('backend/css/colors.css') }}" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="{{ asset('backend/css/bootstrap-select.css') }}" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="{{ asset('backend/css/perfect-scrollbar.css') }}" />
      <!-- custom css -->
      <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}" />
      <!-- calendar file css -->
      <link rel="stylesheet" href="{{ asset('backend/js/semantic.min.css') }}" />
   </head>
   <body class="inner_page login">
      <div class="full_container">
         <div class="container">
            <div class="center verticle_center full_height">
               <div class="login_section">
                  <div class="logo_login">
                     <div class="center">
                        <img width="210" src="{{ asset('backend/images/logo/logo.png') }}" alt="#" />
                     </div>
                  </div>
                  <div class="login_form">
                     @yield('content')
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- jQuery -->
      <script src="{{ asset('backend/js/jquery.min.js') }}"></script>
      <script src="{{ asset('backend/js/popper.min.js') }}"></script>
      <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
      <!-- wow animation -->
      <script src="{{ asset('backend/js/animate.js') }}"></script>
      <!-- select country -->
      <script src="{{ asset('backend/js/bootstrap-select.js') }}"></script>
      <!-- nice scrollbar -->
      <script src="{{ asset('backend/js/perfect-scrollbar.min.js') }}"></script>
      <!-- custom js -->
      <script src="{{ asset('backend/js/custom.js') }}"></script>
   </body>
</html>
