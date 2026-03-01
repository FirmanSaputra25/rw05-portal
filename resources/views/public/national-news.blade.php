@extends('layouts.app')

@section('title', 'Berita Nasional - Portal RW 05')

@section('content')
<div class="row mb-5 pb-3 animate-fade-in">
    <div class="col-12 text-center mt-4">
        <div class="mb-3">
            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-bold" style="letter-spacing: 2px; font-size: 0.8rem;">UPDATE TERKINI</span>
        </div>
        <h1 class="section-title text-center" style="font-size: 3.5rem; margin-bottom: 0px; display: inline-block;">Warta Indonesia</h1>
        <p class="text-secondary mt-3 mx-auto" style="max-width: 600px; font-size: 1.25rem;">Menampilkan berita terbaru dari seluruh penjuru nusantara via Antara News.</p>
    </div>
</div>

<div class="row g-4 animate-fade-in" style="animation-delay: 0.2s;">
    @forelse ($news as $item)
    <div class="col-md-6 col-lg-4">
        <article class="card h-100 border-0 shadow-lg group overflow-hidden" style="border-radius: 24px; transition: all 0.3s ease;">
            <div class="position-relative" style="height: 240px; overflow: hidden;">
                <img src="{{ $item['thumbnail'] ?? 'https://via.placeholder.com/600x400?text=Antara+News' }}" class="w-100 h-100 object-fit-cover transition-all group-hover:scale-110" alt="{{ $item['title'] }}">
                <div class="position-absolute top-0 end-0 m-3">
                    <span class="badge bg-primary text-white shadow-sm px-3 py-2 rounded-pill small">Antara News</span>
                </div>
            </div>
            <div class="card-body p-4 bg-white d-flex flex-column">
                <div class="d-flex align-items-center gap-2 mb-3 text-muted small fw-medium">
                    <i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($item['pubDate'])->translatedFormat('d M Y, H:i') }} WIB
                </div>
                <h3 class="card-title fw-800 text-dark mb-3" style="font-size: 1.25rem; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $item['title'] }}</h3>
                <p class="text-secondary small mb-4 line-clamp-3" style="font-size: 0.95rem;">{{ strip_tags($item['description'] ?? 'Tidak ada deskripsi tersedia.') }}</p>
                <div class="mt-auto">
                    <a href="{{ $item['link'] }}" target="_blank" class="btn btn-outline-primary w-100 rounded-pill fw-bold py-2 border-2 hover-scale">
                        Baca Selengkapnya <i class="bi bi-box-arrow-up-right ms-2"></i>
                    </a>
                </div>
            </div>
        </article>
    </div>
    @empty
    <div class="col-12 py-5 text-center">
        <div class="bg-light rounded-circle p-5 d-inline-flex mb-4 shadow-sm text-muted">
            <i class="bi bi-rss-fill" style="font-size: 6rem; opacity: 0.1;"></i>
        </div>
        <h4 class="fw-bold text-dark">Data berita sedang tidak tersedia</h4>
        <p class="text-secondary">Mohon maaf, saat ini kami tidak dapat terhubung ke server berita pusat. Silakan coba beberapa saat lagi.</p>
        <button onclick="window.location.reload()" class="btn btn-primary rounded-pill px-4 py-2 fw-bold mt-3">Segarkan Halaman</button>
    </div>
    @endforelse
</div>

@push('styles')
<style>
    .fw-800 { font-weight: 800; }
    .hover-scale:hover { transform: translateY(-3px); background-color: var(--bs-primary); color: white; }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .group:hover img { transform: scale(1.05); }
</style>
@endpush
@endsection
