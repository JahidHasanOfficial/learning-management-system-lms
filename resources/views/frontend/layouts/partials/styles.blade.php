<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="{{ asset('frontend/lib/animate/animate.min.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

<!-- Customized Bootstrap Stylesheet -->
<link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">

<!-- Custom Dynamic Styles -->
<style>
    :root {
        --primary-modern: #06BBCC;
        --secondary-modern: #181d38;
        --soft-bg: #f0fbfc;
    }

    body {
        font-family: 'Nunito', sans-serif;
    }

    /* Modern Card Scaling */
    .modern-card {
        border: none;
        border-radius: 15px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        overflow: hidden;
        background: #fff;
    }

    .modern-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
    }

    /* Category Card Enhancement */
    .category-item {
        position: relative;
        height: 200px;
        border-radius: 15px;
        overflow: hidden;
    }

    .category-item img {
        transition: transform 0.6s ease;
        object-fit: cover;
        width: 100%;
        height: 100%;
    }

    .category-item:hover img {
        transform: scale(1.1);
    }

    .category-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to top, rgba(24, 29, 56, 0.9) 0%, rgba(24, 29, 56, 0.2) 100%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 20px;
        transition: background 0.3s ease;
    }

    .category-item:hover .category-overlay {
        background: linear-gradient(to top, var(--primary-modern) 0%, rgba(6, 187, 204, 0.4) 100%);
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Custom Buttons */
    .btn-modern {
        border-radius: 50px;
        padding: 12px 30px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    .section-title {
        position: relative;
        display: inline-block;
        text-transform: uppercase;
    }

    .section-title::before {
        position: absolute;
        content: "";
        width: 45px;
        height: 2px;
        top: 50%;
        left: -55px;
        margin-top: -1px;
        background: var(--primary-modern);
    }

    .section-title::after {
        position: absolute;
        content: "";
        width: 45px;
        height: 2px;
        top: 50%;
        right: -55px;
        margin-top: -1px;
        background: var(--primary-modern);
    }
</style>
