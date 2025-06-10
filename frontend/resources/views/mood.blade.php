@extends('layout')

@section('title', 'Mood Harian')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body text-center">
            <h4 class="fw-bold mb-2">🧠 Mood Harian Kamu</h4>
            <p class="text-muted mb-0">Ungkapkan suasana hatimu hari ini dan dapatkan analisis dari <strong>Si Pandji</strong>.</p>
        </div>
    </div>

    <!-- Penjelasan -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h5 class="fw-semibold mb-2">📘 Apa Itu Fitur Ini?</h5>
            <p class="text-muted mb-3">
                Fitur ini dirancang untuk mengenali <strong>emosi</strong> atau <strong>sikap mental</strong> dari kalimat yang kamu tulis.
                Dengan bantuan AI, sistem akan membaca dan menafsirkan apakah mood kamu bersifat
                <span class="text-success fw-semibold">positif</span>,
                <span class="text-warning fw-semibold">netral</span>,
                atau <span class="text-danger fw-semibold">negatif</span>.
            </p>

            <h6 class="fw-semibold">🔍 Contoh Input:</h6>
            <ul class="text-muted">
                <li>“Aku sangat <strong>bahagia</strong> hari ini, semuanya berjalan lancar.”</li>
                <li>“Tidak ada hal istimewa, biasa saja.”</li>
                <li>“Aku <strong>kesal</strong> karena semua rencana gagal.”</li>
            </ul>

            <h6 class="fw-semibold mt-4">✅ Contoh Hasil Analisis:</h6>
            <div class="row g-3 text-center">
                <div class="col-md-4">
                    <div class="alert alert-success shadow-sm">
                        <div class="display-1">😊</div>
                        <strong>Positif</strong><br>
                        <small class="text-muted">Mood bahagia, optimis, semangat</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-warning shadow-sm">
                        <div class="display-1">😐</div>
                        <strong>Netral</strong><br>
                        <small class="text-muted">Mood biasa, datar, tidak menonjol</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-danger shadow-sm">
                        <div class="display-1">😠</div>
                        <strong>Negatif</strong><br>
                        <small class="text-muted">Mood sedih, kesal, cemas, marah</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Input -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form id="moodForm" class="d-flex flex-column flex-md-row gap-3 align-items-stretch">
                <input type="text" id="moodText" name="moodText" class="form-control form-control-lg rounded-pill px-4"
                       placeholder="Contoh: Aku merasa tenang setelah berjalan-jalan." required>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Kirim</button>
            </form>
        </div>
    </div>

    <!-- Hasil Analisis -->
    <div id="response" class="alert d-none shadow-sm text-center" role="alert"></div>
</div>

<style>
    #response {
        transition: all 0.3s ease-in-out;
        font-size: 1.1rem;
    }
</style>

<script>
    const form = document.getElementById('moodForm');
    const responseEl = document.getElementById('response');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        const moodText = document.getElementById('moodText').value;

        // Show loading
        responseEl.className = 'alert alert-info shadow-sm text-center';
        responseEl.innerHTML = `<div class="spinner-border spinner-border-sm me-2" role="status"></div> Menganalisis...`;
        responseEl.classList.remove('d-none');

        try {
            const res = await fetch('http://localhost:3001/api/mood', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ moodText })
            });

            const data = await res.json();
            const label = data.label || 'Tidak diketahui';

            let emoji = '😐';
            let colorClass = 'alert-secondary';
            let explanation = 'Mood tidak dikenali atau netral.';

            if (label.toLowerCase() === 'positif') {
                emoji = '😊';
                colorClass = 'alert-success';
                explanation = 'Kamu tampaknya sedang dalam suasana hati yang baik dan penuh semangat!';
            } else if (label.toLowerCase() === 'negatif') {
                emoji = '😠';
                colorClass = 'alert-danger';
                explanation = 'Kamu mungkin sedang mengalami tekanan emosional atau suasana hati kurang baik.';
            } else if (label.toLowerCase() === 'netral') {
                emoji = '😐';
                colorClass = 'alert-warning';
                explanation = 'Suasana hatimu tampak stabil atau datar tanpa emosi berlebihan.';
            }

            responseEl.className = `alert ${colorClass} shadow-sm text-center`;
            responseEl.innerHTML = `
                <div class="display-1">${emoji}</div>
                <div class="fw-semibold mt-2">Mood kamu terdeteksi sebagai: <strong>${label}</strong></div>
                <small class="text-muted d-block mt-1">${explanation}</small>
            `;
        } catch (err) {
            responseEl.className = 'alert alert-danger shadow-sm text-center';
            responseEl.innerText = '❌ Terjadi kesalahan saat mengirim data. Coba lagi nanti.';
        }
    });
</script>
@endsection
