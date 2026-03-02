@extends('layouts.app')

@section('title', 'Berita - Portal RW 05')

@section('content')


</div>

<!-- Wide Banner Slideshow (Full Width) -->
<div id="bannerCarousel" class="carousel slide mb-5" data-bs-ride="carousel" data-bs-interval="3500">
    <div class="carousel-inner shadow-lg" style="border-radius: 20px;">
        @foreach ($allNews->where('type', 'national')->take(5) as $item)
        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
            <a href="{{ $item['link'] }}" target="_blank" class="text-decoration-none">
                <div class="position-relative w-100" style="height: 220px;">
                    <img src="{{ $item['image'] }}" class="w-100 h-100 object-fit-cover" alt="{{ $item['title'] }}" style="filter: brightness(0.6);">
                    <div class="position-absolute top-50 start-0 translate-middle-y ps-4 ps-md-5 text-white w-75">
                        <span class="badge bg-danger mb-2">NASIONAL</span>
                        <h3 class="fw-bold mb-1 text-truncate" style="font-size: 1.5rem;">{{ $item['title'] }}</h3>
                        <p class="small mb-0 opacity-75 d-none d-md-block">Berita terbaru hari ini dari sumber nasional.</p>
                    </div>
                    <div class="position-absolute bottom-0 end-0 m-4">
                        <span class="btn btn-light rounded-pill px-4 fw-bold shadow">Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i></span>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

<div class="row g-5">
    <div class="col-lg-8">
        <h2 class="section-title mb-4">Semua Berita</h2>
        <div class="row g-4">
            @foreach ($news as $item)
            <div class="col-md-6">
                <div class="card card-news h-100 flex-column d-flex border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
                    <div class="position-relative overflow-hidden w-100" style="height: 220px;">
                        <img src="{{ $item['image'] }}"
                            class="card-img-top w-100 h-100 object-fit-cover transition-all" alt="Gambar Berita" />
                        <div class="position-absolute bottom-0 start-0 m-3 d-flex gap-2">
                            <span class="badge bg-white text-dark shadow-sm px-3 py-1 rounded-pill">
                                {{ $item['created_at']->format('d M') }}
                            </span>
                            <span class="badge bg-primary text-white shadow-sm px-3 py-1 rounded-pill">
                                {{ $item['badge'] }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column p-4">
                        <h5 class="card-title fw-bold text-dark mb-3 line-clamp-2">{{ $item['title'] }}</h5>
                        <p class="card-text text-muted flex-grow-1 mb-4" style="font-size: 0.95rem;">{!! nl2br(e(Str::limit($item['content'], 100))) !!}</p>
                        
                        <a href="{{ $item['link'] }}" {{ $item['type'] === 'national' ? 'target="_blank"' : '' }} class="btn btn-outline-primary w-100 rounded-pill fw-bold py-2">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{ $news->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <div class="col-lg-4">
        <div class="sticky-top" style="top: 100px;">
            <!-- Jadwal Posyandu (Sidebar Card - No Empty Space) -->
            <div class="card border-0 shadow-lg mb-4 overflow-hidden" style="border-radius: 20px; background: linear-gradient(135deg, #059669, #10B981);">
                <div class="card-body p-4 text-white">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <i class="bi bi-heart-pulse-fill fs-4"></i>
                        <span class="fw-bold small text-uppercase" style="letter-spacing: 1px;">Jadwal Posyandu</span>
                    </div>
                    @if($nextPosyandu)
                        <h5 class="fw-bold mb-2">{{ \Carbon\Carbon::parse($nextPosyandu->date)->translatedFormat('l, d M Y') }}</h5>
                        <div class="bg-white p-3 rounded-4 mb-3 border border-white shadow-sm">
                            <div class="d-flex align-items-center gap-2 mb-2 text-success">
                                <i class="bi bi-clock-fill"></i>
                                <span class="small fw-bold">{{ $nextPosyandu->time ? \Carbon\Carbon::parse($nextPosyandu->time)->format('H:i') . ' WIB' : 'Jam belum diatur' }}</span>
                            </div>
                            <div class="d-flex align-items-baseline gap-2 text-success">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span class="small fw-bold" style="font-size: 0.85rem;">{{ $nextPosyandu->location ?? 'Lokasi belum diatur' }}</span>
                            </div>
                        </div>
                    @else
                        <div class="bg-white bg-opacity-10 p-3 rounded-4 mb-3 text-center">
                            <p class="small mb-0 opacity-75">Belum ada jadwal terdaftar.</p>
                        </div>
                    @endif
                    <a href="{{ route('schedule.index') }}" class="btn btn-white btn-sm w-100 rounded-pill fw-bold text-success py-2 mt-auto" style="background: white; border: none;">
                        Lihat Seluruh Jadwal <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <div class="bg-white p-4 rounded-4 shadow-lg border-0 mb-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h2 class="section-title mb-0" style="font-size: 1.5rem;">Agenda Warga</h2>
                </div>

                @forelse ($announcements as $event)
                @php
                    $isKerjaBakti = Str::contains(Str::lower($event->title), 'kerja bakti');
                    $color = $isKerjaBakti ? '#f97316' : 'var(--bs-primary)';
                @endphp
                <a href="{{ route('agenda.index') }}" class="announcement-card text-decoration-none mb-3 d-block" style="border-left: 4px solid {{ $color }}; background: #f8f9fa; padding: 15px; border-radius: 0 12px 12px 0;">
                    <div class="d-flex align-items-start gap-3">
                        <div>
                            <span class="d-block fw-bold mb-1" style="color: {{ $color }};">{{ $event->title }}</span>
                            <span class="d-block text-muted small"><i class="bi bi-calendar-event me-1"></i> {{ \Carbon\Carbon::parse($event->date)->translatedFormat('d M Y') }}</span>
                        </div>
                    </div>
                </a>
                @empty
                <div class="text-center p-3 bg-light rounded-3">
                    <p class="text-muted small mb-0">Belum ada agenda.</p>
                </div>
                @endforelse
                <div class="text-center mt-3 pt-3 border-top">
                    <a href="{{ route('agenda.index') }}" class="text-decoration-none fw-bold text-primary small">Lihat Seluruh Agenda <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.text-truncate-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;  
    overflow: hidden;
}
.hover-primary {
    transition: all 0.3s ease;
}
.hover-primary:hover {
    background-color: var(--bs-primary) !important;
    transform: translateY(-3px);
}
.hover-primary:hover .hover-text {
    color: white !important;
}
.hover-primary:hover .hover-icon {
    color: white !important;
}
.hover-primary:hover .hover-icon-container {
    background-color: rgba(255,255,255,0.2) !important;
}
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.hover-scale {
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.hover-scale:hover {
    transform: scale(1.05);
}
    .news-ticker-container {
        display: flex;
        white-space: nowrap;
        animation: ticker 30s linear infinite;
        padding-left: 100%;
    }
    .news-ticker-item {
        display: inline-block;
        font-weight: 500;
        font-size: 0.95rem;
    }
    .news-ticker-container:hover {
        animation-play-state: paused;
    }
    @keyframes ticker {
        0% { transform: translateX(0); }
        100% { transform: translateX(-100%); }
    }
</style>
@endpush
@endsection