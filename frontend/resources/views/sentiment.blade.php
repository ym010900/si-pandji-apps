@extends('layout')

@section('title', 'Analisis Sentimen Judi Online')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <!-- Penjelasan -->
        <div class="mb-4">
            <h4 class="text-primary fw-bold mb-3 text-center">
                <i class="bi bi-exclamation-triangle me-2"></i>Analisis Sentimen Terkait Judi Online
            </h4>
            <p class="text-muted fs-6">
                Sistem ini dirancang untuk <strong>mendeteksi emosi dan opini publik</strong> dari komentar media sosial
                yang berkaitan dengan topik <strong>kecanduan judi online</strong>.
                Dengan bantuan <strong>Rekan Pintar Si Pandji</strong>, sistem akan mengkategorikan
                sentimen ke dalam tiga kelas utama:
                <span class="text-success fw-semibold">Positif</span>,
                <span class="text-warning fw-semibold">Netral</span>, dan
                <span class="text-danger fw-semibold">Negatif</span>.
            </p>
            <p class="text-muted">
                Tujuannya adalah untuk membantu memahami dampak emosional judi online terhadap masyarakat dan menyediakan data yang berguna
                untuk <strong>kampanye kesadaran kesehatan mental</strong>, intervensi dini, serta rekomendasi kebijakan.
            </p>
            <ul class="text-muted">
                <li>🧠 Menangkap keluhan, frustrasi, atau curhatan publik terkait judi online</li>
                <li>📉 Mendeteksi pola keputusasaan atau kecanduan dalam teks</li>
                <li>📲 Mengumpulkan opini publik dari komentar TikTok, Twitter, Facebook, dan platform lain</li>
                <li>📊 Mendukung riset SDG 3: Kesehatan & Kesejahteraan</li>
            </ul>
            <p class="text-muted fs-6 mb-0">
                Cukup masukkan teks dari media sosial atau curhatan yang berkaitan dengan judi online, dan sistem akan memberikan
                analisis sentimen beserta <strong>ikon emosi</strong> dan <strong>penjelasan makna emosional</strong>.
            </p>
        </div>

        <!-- Contoh Kalimat -->
        <div class="mb-4">
            <h6 class="fw-bold text-secondary">🔍 Contoh Kalimat dan Analisis:</h6>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="alert alert-danger text-center rounded-3 h-100">
                        <div class="fs-1">😞</div>
                        <strong>"Gara-gara judi online, aku kehilangan semua tabungan."</strong><br>
                        <small class="text-muted">Sentimen: <strong>Negatif</strong> — emosi sedih, kecewa, dan putus asa.</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-warning text-center rounded-3 h-100">
                        <div class="fs-1">😐</div>
                        <strong>"Temanku main slot tiap malam, tapi aku biasa aja."</strong><br>
                        <small class="text-muted">Sentimen: <strong>Netral</strong> — tidak ada sikap emosional yang kuat.</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-success text-center rounded-3 h-100">
                        <div class="fs-1">😌</div>
                        <strong>"Akhirnya bisa lepas dari judi online, hidupku terasa lebih ringan."</strong><br>
                        <small class="text-muted">Sentimen: <strong>Positif</strong> — emosi lega, harapan, dan pemulihan.</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Input -->
        <form id="sentimentForm" class="mb-3">
            <label for="text" class="form-label fw-semibold">Masukkan Kalimat Terkait Judi Online:</label>
            <textarea id="text" name="text" rows="6"
                      class="form-control rounded-3 shadow-sm mb-3 fs-6"
                      placeholder="Contoh: Saya kecanduan judi online dan sekarang merasa sangat terpuruk."
                      style="resize: none;" required></textarea>
            <button type="submit" class="btn btn-primary rounded-pill px-4 w-100">
                <i class="bi bi-search-heart me-1"></i> Analisa Sekarang
            </button>
        </form>

        <!-- Hasil Analisis -->
        <div id="sentimentResult" class="mt-4" style="min-height: 60px;"></div>
    </div>
</div>

<script>
    document.getElementById('sentimentForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        const text = document.getElementById('text').value;
        const resultContainer = document.getElementById('sentimentResult');

        resultContainer.innerHTML = `<div class="text-muted text-center"><i class="bi bi-hourglass-split"></i> Menganalisis sentimen...</div>`;

        try {
            const res = await fetch('http://localhost:3001/api/sentiment', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ text })
            });

            const data = await res.json();
            const label = data.label.toLowerCase();

            let color = 'secondary';
            let icon = '😐';
            let explanation = 'Kalimat ini bersifat netral, tidak mengekspresikan emosi dominan.';
            let labelDisplay = 'Netral';

            if (label === 'positif') {
                color = 'success';
                icon = '😌';
                explanation = 'Mengandung harapan, kebebasan dari kecanduan, atau perasaan positif.';
                labelDisplay = 'Positif';
            } else if (label === 'negatif') {
                color = 'danger';
                icon = '😞';
                explanation = 'Mengindikasikan emosi negatif seperti stres, frustasi, atau dampak buruk dari judi.';
                labelDisplay = 'Negatif';
            }

            resultContainer.innerHTML = `
                <div class="alert alert-${color} rounded-4 text-center py-4">
                    <div class="display-1 mb-2">${icon}</div>
                    <h5 class="fw-bold text-capitalize mb-1">Sentimen: ${labelDisplay}</h5>
                    <p class="text-muted mb-0">${explanation}</p>
                </div>`;
        } catch {
            resultContainer.innerHTML = `<div class="text-danger text-center"><i class="bi bi-x-circle"></i> Gagal menganalisis sentimen.</div>`;
        }
    });
</script>
@endsection
