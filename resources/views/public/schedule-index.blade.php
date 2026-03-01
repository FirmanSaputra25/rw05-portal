@extends('layouts.app')

@section('title', 'Jadwal - Portal RW 05')

@section('content')
<div class="row mb-5 pb-3">
    <div class="col-12 text-center">
        <div class="mb-3 mt-4">
            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-bold" style="letter-spacing: 2px; font-size: 0.8rem;">LAYANAN KESEHATAN RW 05</span>
        </div>
        <h1 class="section-title text-center" style="font-size: 3.5rem; margin-bottom: 0px; display: inline-block;">Jadwal Posyandu & Posbindu</h1>
        <p class="text-secondary mt-3 mx-auto" style="max-width: 700px; font-size: 1.25rem; line-height: 1.6;">Pusat informasi kegiatan kesehatan bulanan warga. Pastikan keluarga mendapatkan pelayanan kesehatan terbaik di lingkungan kita.</p>
    </div>
</div>

<div class="row g-5 mb-5">
    {{-- Jadwal Posyandu --}}
    <div class="col-lg-6">
        <div class="card border-0 shadow-lg overflow-hidden h-100" style="border-radius: 30px;">
            <div class="card-header border-0 p-4 d-flex align-items-center gap-3" style="background: linear-gradient(135deg, #059669, #10B981);">
                <div class="bg-white bg-opacity-25 rounded-circle p-2 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px;">
                    <i class="bi bi-heart-pulse-fill fs-2 text-white"></i>
                </div>
                <div>
                    <h3 class="mb-0 fw-bold text-white h4">Posyandu Balita</h3>
                    <p class="mb-0 text-white text-opacity-75 small">Ibu Hamil & Anak (0-5 Tahun)</p>
                </div>
            </div>
            <div class="card-body p-0">
                @if($posyanduSchedules->count())
                @foreach($posyanduSchedules as $schedule)
                <div class="p-4 border-bottom hover-light transition-all">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="fw-bold mb-1" style="color: var(--dark-text); font-size: 1.3rem;">{{ $schedule->title }}</h5>
                            <p class="text-muted small mb-0"><i class="bi bi-info-circle me-1"></i> Rutin setiap bulan di lingkungan RW 05</p>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-bold">Penting</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-4">
                                <div class="bg-white shadow-sm rounded-circle p-2 text-success d-flex">
                                    <i class="bi bi-calendar-check fs-5"></i>
                                </div>
                                <div>
                                    <span class="d-block text-muted small fw-bold">TANGGAL</span>
                                    <span class="fw-bold text-dark">{{ $schedule->date->translatedFormat('d F Y') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-4">
                                <div class="bg-white shadow-sm rounded-circle p-2 text-success d-flex">
                                    <i class="bi bi-clock fs-5"></i>
                                </div>
                                <div>
                                    <span class="d-block text-muted small fw-bold">WAKTU</span>
                                    <span class="fw-bold text-dark">{{ $schedule->time->format('H:i') }} WIB</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-4">
                                <div class="bg-white shadow-sm rounded-circle p-2 text-danger d-flex">
                                    <i class="bi bi-geo-alt-fill fs-5"></i>
                                </div>
                                <div>
                                    <span class="d-block text-muted small fw-bold">LOKASI PELAKSANAAN</span>
                                    <span class="fw-bold text-dark">{{ $schedule->location ?? 'RW 05' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="p-5 text-center bg-white">
                    <div class="bg-light rounded-circle d-inline-flex p-4 mb-4">
                        <i class="bi bi-calendar-x text-muted opacity-50" style="font-size: 4rem;"></i>
                    </div>
                    <h4 class="text-muted fw-bold">Belum Ada Jadwal</h4>
                    <p class="text-muted mb-0">Jadwal Posyandu akan segera diperbarui.</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Jadwal Posbindu --}}
    <div class="col-lg-6">
        <div class="card border-0 shadow-lg overflow-hidden h-100" style="border-radius: 30px;">
            <div class="card-header border-0 p-4 d-flex align-items-center gap-3" style="background: linear-gradient(135deg, #2563EB, #3B82F6);">
                <div class="bg-white bg-opacity-25 rounded-circle p-2 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px;">
                    <i class="bi bi-person-hearts fs-2 text-white"></i>
                </div>
                <div>
                    <h3 class="mb-0 fw-bold text-white h4">Posbindu PTM</h3>
                    <p class="mb-0 text-white text-opacity-75 small">Lansia & Usia Produktif (>15 Tahun)</p>
                </div>
            </div>
            <div class="card-body p-0">
                @if($posbinduSchedules->count())
                @foreach($posbinduSchedules as $schedule)
                <div class="p-4 border-bottom hover-light transition-all">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="fw-bold mb-1" style="color: var(--dark-text); font-size: 1.3rem;">{{ $schedule->title }}</h5>
                            <p class="text-muted small mb-0"><i class="bi bi-shield-check me-1"></i> Skrining kesehatan & faktor risiko penyakit</p>
                        </div>
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-bold">Terjadwal</span>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-4">
                                <div class="bg-white shadow-sm rounded-circle p-2 text-primary d-flex">
                                    <i class="bi bi-calendar-event fs-5"></i>
                                </div>
                                <div>
                                    <span class="d-block text-muted small fw-bold">TANGGAL</span>
                                    <span class="fw-bold text-dark">{{ $schedule->date->translatedFormat('d F Y') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-4">
                                <div class="bg-white shadow-sm rounded-circle p-2 text-primary d-flex">
                                    <i class="bi bi-clock fs-5"></i>
                                </div>
                                <div>
                                    <span class="d-block text-muted small fw-bold">WAKTU</span>
                                    <span class="fw-bold text-dark">{{ $schedule->time->format('H:i') }} WIB</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-4">
                                <div class="bg-white shadow-sm rounded-circle p-2 text-danger d-flex">
                                    <i class="bi bi-geo-alt-fill fs-5"></i>
                                </div>
                                <div>
                                    <span class="d-block text-muted small fw-bold">LOKASI PELAKSANAAN</span>
                                    <span class="fw-bold text-dark">{{ $schedule->location ?? 'RW 05' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="p-5 text-center bg-white">
                    <div class="bg-light rounded-circle d-inline-flex p-4 mb-4">
                        <i class="bi bi-person-x text-muted opacity-50" style="font-size: 4rem;"></i>
                    </div>
                    <h4 class="text-muted fw-bold">Belum Ada Jadwal</h4>
                    <p class="text-muted mb-0">Jadwal Posbindu akan segera diumumkan.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mb-5" style="border-radius: 24px; background-color: #f8fafc; border: 1px dashed #e2e8f0 !important;">
    <div class="card-body p-4 text-center">
        <h5 class="fw-bold text-dark mb-2">Punya Pertanyaan Seputar Jadwal?</h5>
        <p class="text-secondary mb-0">Silakan hubungi Kader Kesehatan atau Pengurus RW 05 untuk informasi lebih mendalam.</p>
    </div>
</div>

@push('styles')
<style>
    .transition-all {
        transition: all 0.3s ease;
    }
    .hover-light:hover {
        background-color: #f8fafc;
        transform: scale(1.005);
    }
</style>
@endpush
@endsection
