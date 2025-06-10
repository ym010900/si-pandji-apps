@extends('layout')

@section('title', 'Beranda - Si Pandji')

@section('content')
<style>
    .btn-hover-blue {
        transition: all 0.3s ease;
    }
    .btn-hover-blue:hover {
        background-color: #0d6efd !important;
        color: #fff !important;
        border-color: #0d6efd !important;
    }

    .equal-height {
        display: flex;
        flex-direction: column;
        height: 100%;
    }
</style>

<div class="card shadow-sm">
    <div class="card-body">
        <h3 class="text-primary fw-bold text-center mb-4">
            👋 Selamat Datang di Aplikasi <span class="text-dark">Si Pandji</span>
        </h3>

        <p class="text-muted fs-6">
            <strong>Si Pandji</strong> (<em>Pantau dan Jaga Jiwa</em>) adalah platform digital berbasis AI yang bertujuan untuk membantu masyarakat 
            memahami dan menjaga kondisi kesehatan mental mereka. Aplikasi ini dikembangkan sebagai solusi terhadap meningkatnya kasus 
            gangguan jiwa yang dipicu oleh tekanan sosial, khususnya akibat dampak negatif <strong>judi online</strong>.
        </p>

        <p class="text-muted fs-6">
            Dengan menggabungkan teknologi analisis teks dan model kecerdasan buatan, Si Pandji memungkinkan pengguna untuk merefleksikan 
            kondisi emosinya melalui fitur <strong>Mood Harian</strong>, mendapatkan analisis terhadap tulisan melalui <strong>Sentimen Emosi</strong>, serta 
            berinteraksi langsung dengan <strong>Chatbot Konseling</strong> sebagai dukungan awal.
        </p>

        <hr>

        <div class="row mt-4 g-3">
            <div class="col-md-6 d-flex">
                <div class="alert alert-primary rounded-3 equal-height w-100">
                    <h6 class="fw-bold"><i class="bi bi-emoji-smile me-2"></i>Mood Harian</h6>
                    <p class="mb-1 text-muted">Catat dan pantau suasana hatimu setiap hari untuk refleksi diri secara emosional.</p>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="alert alert-info rounded-3 equal-height w-100">
                    <h6 class="fw-bold"><i class="bi bi-graph-up-arrow me-2"></i>Analisis Sentimen</h6>
                    <p class="mb-1 text-muted">Masukkan komentar atau curhatan dan biarkan Si Pandji mendeteksi sentimen dan emosi di dalamnya.</p>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="alert alert-secondary rounded-3 equal-height w-100">
                    <h6 class="fw-bold"><i class="bi bi-chat-dots me-2"></i>Chatbot Konseling</h6>
                    <p class="mb-1 text-muted">Berinteraksi dengan chatbot untuk mendapatkan dukungan emosional secara instan.</p>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="alert alert-warning rounded-3 equal-height w-100">
                    <h6 class="fw-bold"><i class="bi bi-lightbulb me-2"></i>Tujuan Aplikasi</h6>
                    <p class="mb-1 text-muted">Mendukung Tujuan Pembangunan Berkelanjutan (SDG 3) dalam menjaga kesehatan mental masyarakat digital.</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <div class="d-flex justify-content-center flex-wrap gap-2">
                <a href="/mood" class="btn btn-outline-primary px-4 rounded-pill btn-hover-blue">
                    <i class="bi bi-emoji-smile me-2"></i>Mood Harian
                </a>
                <a href="/sentiment" class="btn btn-outline-primary px-4 rounded-pill btn-hover-blue">
                    <i class="bi bi-search-heart me-2"></i>Analisis Sentimen
                </a>
                <a href="/chat" class="btn btn-outline-primary px-4 rounded-pill btn-hover-blue">
                    <i class="bi bi-chat-dots me-2"></i>Chatbot
                </a>
            </div>
        </div>

        <hr>

        <div class="mt-4">
            <h5 class="text-primary fw-bold">Kenapa Si Pandji Penting?</h5>
            <ul class="text-muted">
                <li>📌 Menyediakan pendekatan preventif terhadap gangguan mental melalui pelacakan suasana hati.</li>
                <li>📌 Membantu pengguna mengenali dan memahami emosi negatif yang mungkin tidak disadari.</li>
                <li>📌 Memberikan informasi edukatif tentang bahaya kecanduan judi daring dan dampaknya.</li>
                <li>📌 Menyediakan chatbot sebagai media ekspresi awal bagi pengguna yang enggan konsultasi langsung.</li>
            </ul>
        </div>
    </div>
</div>
@endsection
