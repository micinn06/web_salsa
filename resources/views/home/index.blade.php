@extends('layouts.app')

@section('content')
<div class="container my-5">
    <!-- Judul Halaman -->
    <h1 class="text-center mb-4 animate__animated animate__fadeInDown">
        <i class="fas fa-home"></i> Welcome to Our Website
    </h1>

    <!-- Pesan Selamat Datang -->
    <div class="text-center mb-5">
        <p class="lead">{{ $welcomeMessage }}</p>
        <p class="text-muted">
            This is the homepage for all users, where you can explore various sections and stay updated with the latest information.
        </p>
    </div>

    <!-- Highlight Grid -->
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 text-center p-3 highlight-card">
                <div class="card-body">
                    <h5 class="card-title text-primary"><i class="fas fa-images fa-2x"></i></h5>
                    <p class="card-text">Explore our gallery for beautiful images and memorable moments.</p>
                    <a href="{{ route('gallery.index') }}" class="btn btn-outline-primary">View Gallery</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 text-center p-3 highlight-card">
                <div class="card-body">
                    <h5 class="card-title text-success"><i class="fas fa-info-circle fa-2x"></i></h5>
                    <p class="card-text">Stay informed with the latest news and announcements.</p>
                    <a href="{{ route('info.index') }}" class="btn btn-outline-success">Learn More</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 text-center p-3 highlight-card">
                <div class="card-body">
                    <h5 class="card-title text-warning"><i class="fas fa-calendar-alt fa-2x"></i></h5>
                    <p class="card-text">Check our upcoming events and mark your calendar.</p>
                    <a href="{{ route('agenda.index') }}" class="btn btn-outline-warning">View Agenda</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Google Maps Section -->
    <div class="maps-section mt-5">
        <h2 class="text-center mb-4"><i class="fas fa-map-marker-alt"></i> Our Location</h2>
        <div class="d-flex justify-content-center">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31704.398742240563!2d106.824694!3d-6.640733000000001!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c8b16ee07ef5%3A0x14ab253dd267de49!2sSMK%20Negeri%204%20Bogor%20(Nebrazka)!5e0!3m2!1sid!2sid!4v1730346764050!5m2!1sid!2sid" 
                    width="100%" height="450" style="border:0; max-width: 100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>
@endsection

<style>
    /* Animasi dan Efek Hover */
    h1.text-center {
        color: #ff8e3c;
    }

    .card.highlight-card:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
    }

    .btn-outline-success:hover {
        background-color: #28a745;
        color: white;
    }

    .btn-outline-warning:hover {
        background-color: #ffc107;
        color: white;
    }

    /* Responsiveness for Google Maps */
    .maps-section {
        margin-top: 2rem;
    }

    .maps-section iframe {
        max-width: 100%;
        height: 450px;
    }

    /* Animasi Icon */
    .card-title i {
        transition: transform 0.3s ease;
    }

    .highlight-card:hover .card-title i {
        transform: scale(1.1);
    }
</style>
