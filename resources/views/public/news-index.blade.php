@extends('layouts.app')

@section('title', 'Berita - Portal RW 05')

@section('content')
<!-- Header Carousel -->
<div id="newsCarousel" class="carousel slide mb-5 shadow-lg" data-bs-ride="carousel" data-bs-interval="4000" style="border-radius: 24px; overflow: hidden;">
    <div class="carousel-indicators">
        @foreach ($news->take(3) as $key => $item)
        <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="{{ $key }}"
            class="{{ $key === 0 ? 'active' : '' }}" aria-current="{{ $key === 0 ? 'true' : 'false' }}"
            aria-label="Slide {{ $key + 1 }}"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach ($news->take(3) as $key => $item)
        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
            <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://source.unsplash.com/1200x600/?community,news&random=' . $key }}"
                class="d-block w-100" alt="{{ $item->title }}" />
            <div class="carousel-caption d-none d-md-block pb-5 px-5">
                <a href="{{ route('news.detail', $item->id) }}" class="text-decoration-none text-white d-inline-block text-start">
                    <span class="badge bg-primary px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm">TERBARU</span>
                    <span class="d-block h5 fw-bold">{{ $item->title }}</span>
                    <span class="d-none d-lg-block mb-3" style="max-width: 800px;">{!! nl2br(e(Str::limit($item->content, 120))) !!}</span>
                    <span class="d-flex align-items-center gap-2 opacity-75 text-white-50 small">
                        <i class="bi bi-person-circle"></i> {{ $item->author ?? 'Admin' }}
                        <span class="mx-2">•</span>
                        <i class="bi bi-clock"></i> {{ $item->created_at->format('d M Y') }}
                    </span>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon shadow-sm" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon shadow-sm" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="row g-5">
    <div class="col-lg-8">
        <!-- Jadwal Posyandu (Priority Block) -->
        <div class="card border-0 shadow-lg mb-5 overflow-hidden" style="border-radius: 24px; background: linear-gradient(135deg, #059669, #10B981, #34D399);">
            <div class="card-body p-4 p-md-5 text-white position-relative">
                <div class="position-absolute top-0 end-0 m-4 opacity-10 d-none d-md-block">
                    <i class="bi bi-heart-pulse-fill" style="font-size: 8rem;"></i>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="bg-white bg-opacity-20 p-2 rounded-circle shadow-sm">
                                <i class="bi bi-bell-fill fs-4"></i>
                            </div>
                            <span class="fw-bold text-uppercase" style="letter-spacing: 2px; font-size: 0.85rem;">PENGUMUMAN PENTING</span>
                        </div>
                        <h3 class="h2 fw-800 mb-4">Jadwal Posyandu Terdekat</h3>
                        @if($nextPosyandu)
                        <div class="row g-4 mb-4">
                            <div class="col-6 col-sm-4">
                                <div class="bg-white bg-opacity-10 p-3 rounded-4 border border-white border-opacity-10">
                                    <span class="d-block small opacity-75 mb-1">HARI / TANGGAL</span>
                                    <span class="h5 fw-bold mb-0 text-white d-block">{{ \Carbon\Carbon::parse($nextPosyandu->date)->translatedFormat('l, d M Y') }}</span>
                                </div>
                            </div>
                            <div class="col-6 col-sm-4">
                                <div class="bg-white bg-opacity-10 p-3 rounded-4 border border-white border-opacity-10">
                                    <span class="d-block small opacity-75 mb-1">WAKTU</span>
                                    <span class="h5 fw-bold mb-0 text-white d-block">{{ \Carbon\Carbon::parse($nextPosyandu->time)->format('H:i') }} WIB</span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="bg-white bg-opacity-10 p-3 rounded-4 border border-white border-opacity-10 h-100">
                                    <span class="d-block small opacity-75 mb-1">LOKASI</span>
                                    <span class="h5 fw-bold mb-0 text-white d-block">{{ $nextPosyandu->location }}</span>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="bg-white bg-opacity-10 p-4 rounded-4 mb-4">
                            <p class="h5 opacity-75 mb-0 font-italic">Belum ada jadwal posyandu mendatang yang terdaftar. Hubungi pengurus RT/RW untuk info lebih lanjut.</p>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-5 text-md-end">
                        <div class="d-flex flex-column gap-3 align-items-md-end">
                            <a href="{{ route('schedule.index') }}" class="btn btn-white btn-lg rounded-pill fw-bold px-5 py-3 shadow-lg hover-scale" style="background: white; color: #059669; border: none;">
                                Lihat Semua Jadwal <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                            <span class="small opacity-75 pe-3 d-none d-md-block">* Berlaku untuk Balita, Bumil & Lansia</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="section-title">Berita Terkini</h2>
        <div class="row g-4">
            @foreach ($news as $item)
            @continue($loop->first)
            <div class="col-md-6">
                <div class="card card-news h-100 flex-column d-flex">
                    <div class="position-relative overflow-hidden w-100">
                        <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://source.unsplash.com/600x400/?news&random=' . $item->id }}"
                            class="card-img-top" alt="Gambar Berita" />
                        <div class="position-absolute bottom-0 start-0 m-3">
                            <span class="badge bg-white text-dark shadow-sm px-3 py-1 rounded-pill">
                                {{ $item->created_at->format('d M') }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-truncate-2">{{ $item->title }}</h5>
                        <p class="card-text flex-grow-1">{!! nl2br(e(Str::limit($item->content, 85))) !!}</p>
                        
                        <a href="{{ route('news.detail', $item->id) }}" class="btn btn-primary w-100 mt-2 text-center text-white">
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
            <div class="bg-white p-4 rounded-4 shadow-lg border-0 mb-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h2 class="section-title mb-0" style="font-size: 1.5rem;">Agenda Warga</h2>
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill">Baru</span>
                </div>

                @forelse ($announcements as $event)
                @php
                    $isKerjaBakti = Str::contains(Str::lower($event->title), 'kerja bakti');
                    $cardClass = $isKerjaBakti ? 'border-orange' : 'border-primary';
                    $icon = $isKerjaBakti ? 'bi-tools' : 'bi-calendar-event';
                    $color = $isKerjaBakti ? '#f97316' : 'var(--bs-primary)';
                @endphp
                <a href="{{ route('agenda.index') }}" class="announcement-card text-decoration-none" style="border-left-color: {{ $color }}; background: linear-gradient(to right, {{ $color }}08, transparent);">
                    <div class="d-flex align-items-start gap-3">
                        <div class="bg-light p-2 rounded-3 text-center" style="min-width: 50px;">
                            <span class="d-block fw-bold lh-1">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                            <span class="small text-uppercase opacity-75" style="font-size: 0.65rem;">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                        </div>
                        <div>
                            <span class="d-block fw-bold mb-1" style="color: {{ $color }};">{{ $event->title }}</span>
                            <p class="mb-2 text-secondary small line-clamp-2">{{ Str::limit($event->description, 90) }}</p>
                            <span class="d-flex align-items-center text-muted gap-2 fw-medium small">
                                <i class="bi {{ $icon }} opacity-75"></i>
                                <span>{{ $event->location ?? 'RW 05' }}</span>
                            </span>
                        </div>
                    </div>
                </a>
                @empty
                <div class="text-center p-4 bg-light rounded-3" style="border: 2px dashed var(--border-color);">
                    <i class="bi bi-bell text-muted fs-2 mb-2 d-block"></i>
                    <p class="text-muted small mb-0">Belum ada agenda terdekat.</p>
                </div>
                @endforelse
                <div class="text-center mt-3 pt-3 border-top">
                    <a href="{{ route('agenda.index') }}" class="text-decoration-none fw-bold text-primary">Lihat Seluruh Agenda <i class="bi bi-arrow-right fs-6 align-middle ms-1"></i></a>
                </div>
            </div>

            <!-- Layanan Cepat -->
            <!-- <div class="row g-2">
                <div class="col-6">
                    <a href="{{ route('schedule.index') }}" class="btn btn-light w-100 text-start p-3 rounded-4 shadow-sm border-0 h-100 d-flex flex-column align-items-start justify-content-center gap-2 hover-primary transition-all text-decoration-none">
                        <div class="bg-success bg-opacity-10 text-success p-2 rounded-circle hover-icon-container">
                            <i class="bi bi-heart-pulse-fill fs-5 hover-icon"></i>
                        </div>
                        <span class="fw-bold text-dark hover-text">Jadwal Posyandu</span>
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ route('report.create') }}" class="btn btn-light w-100 text-start p-3 rounded-4 shadow-sm border-0 h-100 d-flex flex-column align-items-start justify-content-center gap-2 hover-primary transition-all text-decoration-none">
                        <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-circle hover-icon-container">
                            <i class="bi bi-megaphone-fill fs-5 hover-icon"></i>
                        </div>
                        <span class="fw-bold text-dark hover-text">Lapor Aduan</span>
                    </a>
                </div>
            </div> -->
        </div>
    </div>
</div>

<!-- Section Berita Nasional (Warta Indonesia) -->
<div class="mt-5 pt-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-bold mb-2 d-inline-block" style="letter-spacing: 1px;">UPDATE NASIONAL</span>
            <h2 class="section-title mb-0" style="font-size: 2.25rem;">Warta Indonesia</h2>
        </div>
        <a href="https://www.antaranews.com" target="_blank" class="btn btn-outline-dark rounded-pill px-4 fw-bold">Lihat Semua <i class="bi bi-box-arrow-up-right ms-2"></i></a>
    </div>
    
    <div class="row g-4">
        @forelse ($nationalNews as $item)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-lg" style="border-radius: 20px; transition: all 0.3s ease; overflow: hidden;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                <div class="position-relative" style="height: 220px;">
                    <img src="{{ $item['thumbnail'] ?? 'https://via.placeholder.com/400x250?text=Antara+News' }}" class="w-100 h-100 object-fit-cover" alt="{{ $item['title'] }}">
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-primary text-white shadow-sm px-3 py-1 rounded-pill small">Antara News</span>
                    </div>
                </div>
                <div class="card-body p-4 bg-white d-flex flex-column">
                    <h5 class="card-title fw-bold text-dark mb-3" style="font-size: 1.15rem; line-height: 1.5; height: 3.4em; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">{{ $item['title'] }}</h5>
                    <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                        <span class="text-muted small">
                            <i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($item['pubDate'])->diffForHumans() }}
                        </span>
                        <a href="{{ $item['link'] }}" target="_blank" class="btn btn-primary btn-sm rounded-pill px-3 fw-bold shadow-sm">Baca <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center p-5 bg-white rounded-4 shadow-sm border-dashed" style="border: 2px dashed #ddd;">
                <p class="text-muted mb-0">Sedang memuat berita nasional...</p>
            </div>
        </div>
        @endforelse
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
</style>
@endpush
@endsection