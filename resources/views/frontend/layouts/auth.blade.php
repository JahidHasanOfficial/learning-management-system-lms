<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name') }}</title>
    
    <!-- Favicon -->
    <link href="{{ asset('frontend/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(rgba(24, 29, 56, .1), rgba(24, 29, 56, .1)), url('{{ asset('frontend/img/carousel-1.jpg') }}') center center no-repeat;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 450px;
            padding: 40px;
        }
        .auth-logo {
            font-weight: 800;
            color: #06BBCC;
            text-decoration: none;
            font-size: 2rem;
            display: block;
            text-align: center;
            margin-bottom: 30px;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 20px;
            border: 1px solid #eee;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(6, 187, 204, .25);
            border-color: #06BBCC;
        }
        .btn-primary {
            background-color: #06BBCC;
            border-color: #06BBCC;
            border-radius: 10px;
            padding: 12px;
            font-weight: 700;
        }
        .btn-primary:hover {
            background-color: #05a6b5;
            border-color: #05a6b5;
        }
        .social-btn {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <div class="auth-card animated zoomIn">
        <a href="{{ route('home') }}" class="auth-logo">
            <i class="fa fa-book me-3"></i>LMS
        </a>
        
        <h4 class="text-center mb-4 fw-bold">@yield('heading')</h4>

        @yield('content')

        <div class="mt-4 pt-3 border-top">
            <p class="text-center small text-muted mb-3">Or continue with</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('social.redirect', 'google') }}" class="social-btn btn btn-outline-danger"><i class="fab fa-google"></i></a>
                <a href="{{ route('social.redirect', 'facebook') }}" class="social-btn btn btn-outline-primary"><i class="fab fa-facebook-f"></i></a>
                <a href="{{ route('social.redirect', 'linkedin') }}" class="social-btn btn btn-outline-info"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>

        <div class="mt-4 text-center">
            @yield('footer')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
