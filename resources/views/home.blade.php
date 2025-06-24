@extends('layout/template')

@section('styles')
<style>
/* CONTAINER GLOBAL PENYESUAIAN */
.container,
.carousel-info,
.chart-container,
.info-section,
.praktikum-card {
    max-width: 1140px;
    margin-left: auto;
    margin-right: auto;
    padding-left: 15px;
    padding-right: 15px;
}

/* HERO STYLING */
.hero {
    position: relative;
    background: linear-gradient(to right, rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.75)),
                url("{{ asset('storage/background/bg-stunting2.png') }}") center/cover no-repeat;
    color: white;
    padding: 130px 30px;
    text-align: center;
    border-radius: 20px;
    margin: 0 auto 60px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    overflow: hidden;
}

.hero h1 {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 20px;
    animation: fadeInDown 1s ease-out;
    text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.6);
}

.hero p {
    font-size: 1.35rem;
    font-weight: 400;
    animation: fadeInUp 1.2s ease-out;
    opacity: 0.95;
}

.hero .cta-btn {
    margin-top: 30px;
    padding: 14px 32px;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 50px;
    background: linear-gradient(135deg, #3f51b5, #5c6bc0);
    border: none;
    color: white;
    transition: all 0.4s ease;
    animation: fadeInUp 1.4s ease-out;
    box-shadow: 0 4px 12px rgba(0, 188, 212, 0.3);
}

.hero .cta-btn:hover {
    transform: translateY(-2px);
    background: linear-gradient(135deg, #3f51b5, #5c6bc0);
    box-shadow: 0 6px 16px rgba(0, 188, 212, 0.4);
}


/* INFO SECTION */
.info-section {
    padding: 60px 40px;
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(8px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
    margin-bottom: 50px;
}

.info-section:hover {
    transform: translateY(-4px);
}

.info-btn-center {
    display: inline-block;
    padding: 14px 34px;
    background: linear-gradient(135deg, #3f51b5, #5c6bc0);
    color: white;
    border-radius: 40px;
    font-weight: 600;
    border: none;
    transition: all 0.4s ease;
    margin-bottom: 35px;
    animation: pulse 1.8s infinite;
    box-shadow: 0 5px 15px rgba(255, 111, 97, 0.4);
}

.info-btn-center:hover {
    background: linear-gradient(135deg, #3f51b5, #5c6bc0);
    transform: scale(1.05);
}


/* SLIDE DESCRIPTION */
.slide-box {
    display: flex;
    justify-content: center;
    position: relative;
    overflow: hidden;
    max-width: 100%;
    transition: all 0.5s ease;
}

.description-box {
    transform: translateX(100%);
    opacity: 0;
    transition: all 0.6s ease-in-out;
    position: relative;
    background: #ffffff;
    border: none;
    padding: 30px;
    border-radius: 16px;
    font-size: 1.08rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    max-width: 800px;
    width: 100%;
    line-height: 1.75;
}

.description-box.active {
    transform: translateX(0);
    opacity: 1;
}


/* KARTU PROFIL */
.praktikum-card .card-body .border {
    border-radius: 14px;
    background: #ffffff;
    transition: all 0.3s ease-in-out;
    cursor: default;
}

.praktikum-card .card-body .border:hover {
    transform: translateY(-4px) scale(1.02);
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
}

.praktikum-card .card-header {
    background: linear-gradient(135deg, #3f51b5, #5c6bc0);
    color: white;
    border-radius: 12px 12px 0 0;
    box-shadow: 0 4px 12px rgba(63, 81, 181, 0.3);
}


/* RESPONSIF */
@media (max-width: 768px) {
    .hero {
        padding: 80px 20px;
    }

    .hero h1 {
        font-size: 2.2rem;
    }

    .hero p {
        font-size: 1.05rem;
    }

    .description-box {
        font-size: 0.95rem;
        padding: 20px;
    }

    .info-btn-center {
        padding: 12px 26px;
    }
}


/* PULSE ANIMATION */
@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(255, 111, 97, 0.6); }
    70% { box-shadow: 0 0 0 14px rgba(255, 111, 97, 0); }
    100% { box-shadow: 0 0 0 0 rgba(255, 111, 97, 0); }
}


/* CAROUSEL INFO */
.carousel-info {
    background: rgba(255, 255, 255, 0.8);
    border-radius: 20px;
    padding: 30px 60px; /* ditambahkan padding samping agar tidak tabrak panah */
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    backdrop-filter: blur(6px);
    margin-bottom: 50px;
    position: relative;
    overflow: hidden;
}

.carousel-inner {
    padding-right: 40px;
    padding-left: 40px;
}

.carousel-item h5 {
    font-weight: 700;
    color: #0d6efd;
}

.carousel-item p {
    font-size: 1.05rem;
    color: #343a40;
}

.carousel-control-prev,
.carousel-control-next {
    width: 5%;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
}


/* CHART */
.chart-container {
    background: white;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    margin-top: 40px;
    margin-bottom: 60px;
}
</style>


@endsection

@section('content')
<div class="container mt-4">

<!-- Hero Section -->
<div class="hero">
    <h1>SITIMAN - Siaga Stunting Kota Manado</h1>
    <p>Layanan Informasi Interaktif untuk Monitor Kasus Stunting di Kota Manado, Sulawesi Utara</p>
    <a href="#info-section" class="cta-btn">Pelajari Lebih Lanjut</a>
</div>


<!-- Interaktif Informasi -->
<div class="info-section text-center" id="info-section">
    <h3 class="mb-4 text-dark fw-bold"><i class="fas fa-info-circle me-2"></i>Pelajari Tentang Stunting</h3>

    <button class="info-btn-center" onclick="toggleInfoPanel()">Klik untuk Mulai Interaksi</button>

    <div id="infoPanel" style="display:none;">
        <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
            <button class="btn info-btn btn-light border shadow-sm" onclick="showDescription('geografis')">
                <i class="fas fa-child me-2 text-primary"></i> Apa itu Stunting?
            </button>
            <button class="btn info-btn btn-light border shadow-sm" onclick="showDescription('pengguna')">
                <i class="fas fa-stethoscope me-2 text-success"></i> Gejala Stunting
            </button>
            <button class="btn info-btn btn-light border shadow-sm" onclick="showDescription('analisis')">
                <i class="fas fa-chart-line me-2 text-danger"></i> Data Stunting Manado
            </button>
        </div>

        <div class="slide-box">
            <div class="description-box mx-auto" id="descriptionBox">
                <em>Klik salah satu tombol di atas untuk melihat informasi.</em>
            </div>
        </div>
    </div>
</div>

<!-- CAROUSEL INFO -->
<div class="carousel-info mx-auto" style="max-width: 900px;">
    <div id="stuntingCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner text-start px-3">
            <div class="carousel-item active">
                <h5>Gizi Buruk dan Dampaknya</h5>
                <p>Kekurangan nutrisi pada masa kehamilan dan awal kehidupan anak berdampak pada stunting jangka panjang.</p>
            </div>
            <div class="carousel-item">
                <h5>Pola Asuh dan Edukasi</h5>
                <p>Pendidikan orang tua dalam memberi makanan bergizi serta akses sanitasi sangat memengaruhi risiko stunting.</p>
            </div>
            <div class="carousel-item">
                <h5>Kebijakan Pemerintah</h5>
                <p>Pemerintah Kota Manado gencar melakukan intervensi dengan program 1000 HPK, posyandu digital, dan pemetaan wilayah rawan stunting.</p>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#stuntingCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#stuntingCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
        </button>
    </div>
</div>

<!-- CHART SECTION -->
<div class="chart-container mx-auto" style="max-width: 900px;">
    <h5 class="text-center mb-4 fw-bold text-primary">Tren Penurunan Stunting (2020 - 2024)</h5>
    <canvas id="stuntingChart" height="100"></canvas>
</div>


    <!-- Kartu Praktikum -->
<div class="card praktikum-card mb-5">
    <div class="card-header text-white d-flex align-items-center" style="background: linear-gradient(45deg, #1D2671, #C33764);">
        <i class="fas fa-user-graduate fa-2x me-3"></i>
        <div>
            <h5 class="card-title mb-0">Informasi Praktikum</h5>
            <small>Geospasial Website Lanjut</small>
        </div>
    </div>
    <div class="card-body">
        <div class="row text-center">
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="border rounded p-3 h-100 shadow-sm bg-light hover-scale">
                    <i class="fas fa-user fa-2x text-primary mb-2"></i>
                    <h6 class="fw-bold mb-1">Nama</h6>
                    <p class="mb-0">Garini Ulima Laksmihita</p>
                </div>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="border rounded p-3 h-100 shadow-sm bg-light hover-scale">
                    <i class="fas fa-id-card fa-2x text-success mb-2"></i>
                    <h6 class="fw-bold mb-1">NIM</h6>
                    <p class="mb-0">23/512729/SV/22772</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="border rounded p-3 h-100 shadow-sm bg-light hover-scale">
                    <i class="fas fa-users fa-2x text-danger mb-2"></i>
                    <h6 class="fw-bold mb-1">Kelas</h6>
                    <p class="mb-0">B</p>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
@endsection

@section('scripts')
<!-- Load Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Toggle panel
    function toggleInfoPanel() {
        const panel = document.getElementById('infoPanel');
        panel.style.display = panel.style.display === "none" ? "block" : "none";
    }

    // Animasi Description Box
    function showDescription(type) {
        let description = '';
        if (type === 'geografis') {
            description = `
                <strong>Apa itu Stunting?</strong>
                Stunting adalah kondisi gagal tumbuh pada anak diakibatkan oleh kekurangan nutrisi kronis.
                Stunting dapat memengaruhi perkembangan fisik dan mental, sehingga penting untuk memahami
                faktor penyebabnya dan mencegahnya sejak dini.
            `;
        } else if (type === 'pengguna') {
            description = `
                <strong>Gejala Stunting</strong>
                Gejala stunting meliputi berat badan yang stagnan, tinggi badan lebih pendek dibanding anak seusianya,
                serta penurunan aktivitas fisik. Pencegahan melibatkan nutrisi yang cukup dan lingkungan yang sehat.
            `;
        } else if (type === 'analisis') {
            description = `
                <strong>Data Stunting Kota Manado</strong>
                Tren stunting di Kota Manado menunjukkan penurunan yang signifikan, dari 1,54% pada 2021
                menjadi hanya 0,42% pada 2024. Upaya intervensi pemerintah berperan besar dalam pencapaian ini.
            `;
        }

        const box = document.getElementById('descriptionBox');
        box.classList.remove('active');
        setTimeout(() => {
            box.innerHTML = description;
            box.classList.add('active');
        }, 200);
    }

    // Inisialisasi Chart
    const ctx = document.getElementById('stuntingChart').getContext('2d');
    const stuntingChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['2020', '2021', '2022', '2023', '2024'],
            datasets: [{
                label: 'Persentase Stunting',
                data: [2.14, 1.54, 1.12, 0.74, 0.42],
                backgroundColor: 'rgba(13, 110, 253, 0.1)',
                borderColor: 'rgba(13, 110, 253, 1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointBackgroundColor: '#0d6efd'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => value + '%'
                    }
                }
            }
        }
    });
</script>
@endsection
