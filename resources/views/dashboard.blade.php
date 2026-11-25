@extends('layouts.app')

@section('title', 'Dashboard E-Farming')
@section('page-title', 'Dashboard E-Farming')

@push('styles')
<style>
/* GRID GRAFIK KONDISI TANAH */
.dashboard-chart-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 22px;
    width: 100%;
}

.dashboard-chart-card {
    background: #ffffff;
    border: 1px solid #e4ebe6;
    border-radius: 14px;
    padding: 22px;
    min-width: 0;
    box-shadow: 0 3px 15px rgba(18,59,42,.04);
}

.dashboard-chart-container {
    position: relative;
    width: 100%;
    height: 300px;
}

.dashboard-chart-card h4 {
    color: #173e2a;
    margin: 0 0 8px;
}

.dashboard-chart-card p {
    color: #718078;
    font-size: 12px;
    margin-bottom: 16px;
}

@media (max-width: 786px) {
    .dashboard-chart-grid {
        grid-template-columns: 1fr;
    }
}


    .dashboard-container {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    /* WELCOME BANNER */

    .dashboard-welcome {
        position: relative;
        overflow: hidden;
        background: linear-gradient(
            120deg,
            #123b2a 0%,
            #237a4b 100%
        );
        color: white;
        border-radius: 16px;
        padding: 32px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .dashboard-welcome::after {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        right: -70px;
        top: -110px;
        border: 45px solid rgba(255,255,255,.05);
        border-radius: 50%;
        pointer-events: none;
    }

    .welcome-content {
        position: relative;
        z-index: 1;
    }

    .welcome-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.5px;
        color: #b4e2bf;
        margin-bottom: 12px;
    }

    .dashboard-welcome h2 {
        font-size: 26px;
        margin: 0 0 12px;
        font-weight: 750;
    }

    .dashboard-welcome p {
        color: #d7ebdc;
        font-size: 14px;
        line-height: 1.7;
        margin: 0;
        max-width: 550px;
    }

    .welcome-symbol {
        font-size: 75px;
        line-height: 1;
        opacity: .85;
        flex-shrink: 0;
    }

    /* SECTION HEADER */

    .dashboard-section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        gap: 12px;
    }

    .dashboard-section-header h3 {
        margin: 0;
        font-size: 18px;
        color: #173e2a;
    }

    .dashboard-section-header p {
        margin: 6px 0 0;
        font-size: 12px;
        color: #718078;
    }

    /* STATISTICS */

    .dashboard-stats {
        display: grid;
        grid-template-columns:
            repeat(auto-fit, minmax(210px, 1fr));
        gap: 18px;
    }

    .stat-card {
        background: white;
        border: 1px solid #e4ebe6;
        border-radius: 14px;
        padding: 22px;
        box-shadow: 0 3px 15px rgba(18,59,42,.04);
        transition: transform .2s, box-shadow .2s;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(18,59,42,.09);
    }

    .stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
    }

    .stat-label {
        color: #718078;
        font-size: 13px;
        font-weight: 600;
    }

    .stat-icon {
        width: 43px;
        height: 43px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 12px;
        background: #e9f5ec;
        color: #237a4b;
        font-size: 22px;
    }

    .stat-value {
        margin-top: 16px;
        font-size: 34px;
        font-weight: 800;
        color: #173e2a;
        line-height: 1.2;
    }

    .stat-footer {
        font-size: 11px;
        color: #8b9b91;
        margin-top: 10px;
    }

    /* QUICK ACTIONS */

    .dashboard-quick-actions {
        background: white;
        border: 1px solid #e4ebe6;
        border-radius: 14px;
        padding: 24px;
    }

    .quick-actions-grid {
        display: grid;
        grid-template-columns:
            repeat(auto-fit, minmax(190px, 1fr));
        gap: 14px;
    }

    .quick-action {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 17px;
        border: 1px solid #e4ebe6;
        border-radius: 11px;
        text-decoration: none;
        color: #173e2a;
        background: #fbfdfb;
        transition: all .2s;
    }

    .quick-action:hover {
        background: #e9f5ec;
        border-color: #a9dbb4;
        transform: translateY(-2px);
    }

    .quick-action-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: #e1f2e5;
        color: #237a4b;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .quick-action-title {
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .quick-action-desc {
        font-size: 11px;
        color: #718078;
    }

    /* FOOTER */

    .dashboard-footer {
        text-align: center;
        font-size: 11px;
        color: #8b9b91;
        padding: 5px 0 15px;
    }

    @media (max-width: 768px) {
        .dashboard-welcome {
            padding: 24px;
        }

        .dashboard-welcome h2 {
            font-size: 21px;
        }

        .welcome-symbol {
            font-size: 45px;
        }

        .dashboard-stats {
            grid-template-columns:
                repeat(auto-fit, minmax(160px, 1fr));
            gap: 12px;
        }

        .stat-card {
            padding: 16px;
        }

        .stat-value {
            font-size: 28px;
        }

        .dashboard-quick-actions {
            padding: 18px;
        }
    }

    @media (max-width: 420px) {
        .dashboard-stats {
            grid-template-columns: 1fr;
        }

        .welcome-symbol {
            display: none;
        }
    }
</style>
@endpush

@section('content')

<div class="dashboard-container">

    {{-- WELCOME BANNER --}}
    <section class="dashboard-welcome">

        <div class="welcome-content">
            <div class="welcome-label">
                SMART AGRICULTURE MANAGEMENT
            </div>

            <h2>
                Selamat Datang,
                {{ Auth::user()->nama_user }}!
            </h2>

            <p>
                Pantau dan kelola aktivitas pertanian
                melalui sistem informasi E-Farming.
                Akses data pertanian, analisis FSA,
                dan informasi kelayakan lahan
                dalam satu dashboard.
            </p>
        </div>

        <div class="welcome-symbol"
             aria-hidden="true">
            🌱
        </div>

    </section>

    {{-- STATISTICS --}}
    <section>

        <h3 class="dashboard-section-title">
    Grafik Analisis Pertanian
</h3>

<div class="dashboard-chart">

    <div class="dashboard-chart-card" >

        <h4>Statistik Data Pertanian</h4>

        <p>
            Perbandingan jumlah data setiap modul E-Farming.
        </p>

        <div class="dashboard-chart-container">
            <canvas id="statisticsChart"></canvas>
        </div>

    </div>

</div>
        <div class="dashboard-section-header">
            <div>
                <h3>Ringkasan Data Pertanian</h3>
                <p>
                    Statistik data yang tersimpan
                    dalam sistem E-Farming.
                </p>
            </div>
        </div>

        <div class="dashboard-stats">

            @if(Auth::user()->isSuperAdmin())
                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">
                            Total Petani
                        </span>
                        <div class="stat-icon">♙</div>
                    </div>

                    <div class="stat-value">
                        {{ number_format($totalPetani, 0, ',', '.') }}
                    </div>

                    <div class="stat-footer">
                        Petani terdaftar
                    </div>
                </div>
            @endif

            <div class="stat-card">
                <div class="stat-top">
                    <span class="stat-label">
                        Perhitungan FSA
                    </span>
                    <div class="stat-icon">∑</div>
                </div>

                <div class="stat-value">
                    {{ number_format($totalFsa, 0, ',', '.') }}
                </div>

                <div class="stat-footer">
                    Total perhitungan tersimpan
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <span class="stat-label">
                        Penilaian Lahan
                    </span>
                    <div class="stat-icon">☷</div>
                </div>

                <div class="stat-value">
                    {{ number_format($totalPenilaian, 0, ',', '.') }}
                </div>

                <div class="stat-footer">
                    Total penilaian tersimpan
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <span class="stat-label">
                        Kelayakan
                    </span>
                    <div class="stat-icon">✓</div>
                </div>

                <div class="stat-value">
                    {{ number_format($totalKelayakan, 0, ',', '.') }}
                </div>

                <div class="stat-footer">
                    Total analisis kelayakan
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <span class="stat-label">
                        Total Solusi
                    </span>
                    <div class="stat-icon">✦</div>
                </div>

                <div class="stat-value">
                    {{ number_format($totalSolusi, 0, ',', '.') }}
                </div>

                <div class="stat-footer">
                    Rekomendasi dan solusi
                </div>
            </div>

        </div>
    </section>


    <div class="dashboard-footer">
        E-Farming · Smart Agriculture Management
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const canvas = document.getElementById('statisticsChart');

    if (!canvas) return;

    new Chart(canvas, {
        type: 'bar',

        data: {
            labels: @json($chartLabels),

            datasets: [{
                label: 'Jumlah Data',
                data: @json($chartTotals),

                backgroundColor: [
                    '#16a34a',
                    '#0ea5e9',
                    '#8b5cf6',
                    '#ec4899'
                ],

                borderRadius: 8,
                maxBarThickness: 55
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            plugins: {
                legend: {
                    display: false
                }
            },

            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });

});

document.addEventListener('DOMContentLoaded', function () {

    const soilCharts = @json($soilCharts);

    const colors = [
        '#16a34a',
        '#0ea5e9',
        '#f59e0b',
        '#8b5cf6',
        '#ec4899',
        '#14b8a6'
    ];

    Object.keys(soilCharts).forEach(function (key) {

        const chart = soilCharts[key];

        const canvas = document.getElementById(
            'soilChart' + key
        );

        if (!canvas || chart.labels.length === 0) {
            return;
        }

        new Chart(canvas, {

            type: 'doughnut',

            data: {
                labels: chart.labels,

                datasets: [{
                    label: 'Jumlah Penilaian',
                    data: chart.values,

                    backgroundColor: colors.slice(
                        0,
                        chart.labels.length
                    ),

                    borderColor: '#ffffff',
                    borderWidth: 3,
                    hoverOffset: 8
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        position: 'bottom',

                        labels: {
                            usePointStyle: true,
                            padding: 18
                        }
                    },

                    tooltip: {
                        callbacks: {
                            label: function (context) {

                                const total = context.dataset.data
                                    .reduce((a, b) => a + b, 0);

                                const percentage = total > 0
                                    ? (
                                        context.raw / total * 100
                                    ).toFixed(1)
                                    : 0;

                                return context.label + ': ' +
                                    context.raw + ' data (' +
                                    percentage + '%)';
                            }
                        }
                    }
                }
            }

        });

    });

});

</script>

{{-- GRAFIK PENGUKURAN KONDISI TANAH --}}

<h3 class="dashboard-section-title">
    Analisis Pengukuran Kondisi Tanah
</h3>

<p style="color:#64748b; font-size:13px; margin-top:-10px; margin-bottom:20px;">
    Distribusi hasil penilaian kondisi tanah berdasarkan data E-Farming.
</p>

<div class="dashboard-chart-grid">

    @foreach($soilCharts as $key => $chart)

        <div class="dashboard-chart-card">

            <h4>{{ $chart['title'] }}</h4>

            <p>
                Distribusi kategori hasil pengukuran tanah.
            </p>

            @if(count($chart['labels']) > 0)

                <div class="dashboard-chart-container">
                    <canvas id="soilChart{{ $key }}"></canvas>
                </div>

            @else

                <div style="
                    height: 260px;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    color:#94a3b8;
                    font-size:13px;
                ">
                    Belum ada data pengukuran.
                </div>

            @endif

        </div>

    @endforeach

     {{-- QUICK ACTIONS --}}
    <section class="dashboard-quick-actions">

        <div class="dashboard-section-header">
            <div>
                <h3>Menu Cepat</h3>
                <p>
                    Akses fitur utama E-Farming
                    dengan lebih mudah.
                </p>
            </div>
        </div>

        <div class="quick-actions-grid">

            @if(Auth::user()->isSuperAdmin())
                <a href="{{ route('perhitungan-fsa.create') }}"
                   class="quick-action">
                    <div class="quick-action-icon">∑</div>
                    <div>
                        <div class="quick-action-title">
                            Hitung FSA
                        </div>
                        <div class="quick-action-desc">
                            Buat perhitungan baru
                        </div>
                    </div>
                </a>
            @endif

            <a href="{{ route('perhitungan-fsa.index') }}"
               class="quick-action">
                <div class="quick-action-icon">▤</div>
                <div>
                    <div class="quick-action-title">
                        Riwayat FSA
                    </div>
                    <div class="quick-action-desc">
                        Lihat hasil perhitungan
                    </div>
                </div>
            </a>

            <a href="{{ route('analisis.index') }}"
               class="quick-action">
                <div class="quick-action-icon">◉</div>
                <div>
                    <div class="quick-action-title">
                        Hasil Analisis
                    </div>
                    <div class="quick-action-desc">
                        Ringkasan hasil pertanian
                    </div>
                </div>
            </a>

            <a href="{{ route('peta.index') }}"
               class="quick-action">
                <div class="quick-action-icon">⌖</div>
                <div>
                    <div class="quick-action-title">
                        Peta Lahan
                    </div>
                    <div class="quick-action-desc">
                        Lihat lokasi lahan
                    </div>
                </div>
            </a>

                

        </div>

        

    </section>

</div>


@endsection