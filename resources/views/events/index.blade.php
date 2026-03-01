@extends('layouts.app')

@section('title', 'Agenda - Portal RW 05')

@section('content')
<div class="row mb-5 pb-3">
    <div class="col-12 text-center mt-4">
        <div class="mb-3">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold" style="letter-spacing: 2px; font-size: 0.8rem;">KALENDER KOMUNITAS</span>
        </div>
        <h1 class="section-title text-center" style="font-size: 3.5rem; margin-bottom: 0px; display: inline-block;">Agenda Kegiatan RW 05</h1>
        <p class="text-secondary mt-3 mx-auto" style="max-width: 700px; font-size: 1.25rem; line-height: 1.6;">Ikuti dan berpartisipasilah dalam berbagai kegiatan positif di lingkungan kita. Kebersamaan adalah kekuatan kita.</p>
    </div>
</div>

<div class="row gy-4 justify-content-center">
    <div class="col-lg-10">
        @forelse ($events as $event)
        @php
            $isKerjaBakti = Str::contains(Str::lower($event->title), 'kerja bakti');
            $accentColor = $isKerjaBakti ? '#f97316' : 'var(--bs-primary)';
            $lightAccent = $isKerjaBakti ? '#fff7ed' : 'rgba(79, 70, 229, 0.05)';
        @endphp
        <div class="card event-card mb-5 border-0 p-0 shadow-lg overflow-hidden" style="border-radius: 28px; transition: transform 0.3s ease;">
            <div class="card-body p-0">
                <div class="row g-0">
                    <div class="col-md-3 d-flex flex-column align-items-center justify-content-center text-center p-4 text-white" style="background: {{ $accentColor }};">
                        <span class="d-block small text-uppercase fw-bold opacity-75 mb-1" style="letter-spacing: 1px;">{{ $event->date->translatedFormat('F') }}</span>
                        <span class="d-block display-4 fw-800 lh-1">{{ $event->date->format('d') }}</span>
                        <span class="d-block h5 mb-0 opacity-90">{{ $event->date->format('Y') }}</span>
                        <div class="mt-3 bg-white bg-opacity-20 rounded-pill px-3 py-1 small fw-bold">
                            {{ $event->date->translatedFormat('l') }}
                        </div>
                    </div>
                    <div class="col-md-9 p-4 p-md-5 d-flex flex-column">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                            @if($isKerjaBakti)
                            <span class="badge bg-warning text-dark rounded-pill px-3 py-2 fw-bold"><i class="bi bi-tools me-1"></i> KERJA BAKTI</span>
                            @else
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-bold"><i class="bi bi-info-circle me-1"></i> ACARA WARGA</span>
                            @endif
                            <span class="badge bg-light text-muted rounded-pill px-3 py-2 fw-medium border">Terbuka untuk Umum</span>
                        </div>
                        
                        <h3 class="fw-800 text-dark mb-3 h2">{{ $event->title }}</h3>
                        <p class="text-secondary mb-4" style="font-size: 1.15rem; line-height: 1.7;">{{ $event->description }}</p>
                        
                        <div class="mt-auto pt-4 border-top">
                            <div class="row g-3">
                                @if($event->time)
                                <div class="col-sm-6 col-md-4">
                                    <div class="d-flex align-items-center text-muted gap-3">
                                        <div class="bg-light rounded-circle p-2 text-primary d-flex">
                                            <i class="bi bi-clock-fill fs-5"></i>
                                        </div>
                                        <div>
                                            <span class="d-block small fw-bold text-uppercase opacity-50">WAKTU</span>
                                            <span class="fw-bold text-dark">{{ \Carbon\Carbon::parse($event->time)->format('H:i') }} WIB</span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if($event->location)
                                <div class="col-sm-6 col-md-5">
                                    <div class="d-flex align-items-center text-muted gap-3">
                                        <div class="bg-light rounded-circle p-2 text-danger d-flex">
                                            <i class="bi bi-geo-alt-fill fs-5"></i>
                                        </div>
                                        <div>
                                            <span class="d-block small fw-bold text-uppercase opacity-50">LOKASI</span>
                                            <span class="fw-bold text-dark">{{ $event->location }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center p-5 bg-white shadow-lg border-dashed" style="border-radius: 30px; border: 2px dashed #e2e8f0;">
            <div class="bg-light rounded-circle d-inline-flex p-4 mb-4">
                <i class="bi bi-calendar-x text-muted opacity-40" style="font-size: 5rem;"></i>
            </div>
            <h3 class="text-dark fw-bold h4">Belum Ada Agenda Mendatang</h3>
            <p class="text-secondary mb-0 mx-auto" style="max-width: 400px;">Jadwal kegiatan warga belum ditambahkan oleh pengurus. Silakan cek kembali dalam waktu dekat.</p>
        </div>
        @endforelse
    </div>
</div>

@push('styles')
<style>
    .fw-800 { font-weight: 800; }
    .event-card:hover {
        transform: translateY(-10px);
    }
</style>
@endpush
@endsection
