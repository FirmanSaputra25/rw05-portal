@extends('layouts.app')

@section('title', 'Galeri - Portal RW 05')

@section('content')
<div class="row mb-5 pb-3">
    <div class="col-12 text-center mt-4">
        <div class="mb-3">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold" style="letter-spacing: 2px; font-size: 0.8rem;">DOKUMENTASI VISUAL</span>
        </div>
        <h1 class="section-title text-center" style="font-size: 3.5rem; margin-bottom: 0px; display: inline-block;">Galeri Kegiatan</h1>
        <p class="text-secondary mt-3 mx-auto" style="max-width: 600px; font-size: 1.25rem;">Mengabadikan setiap momen kebersamaan dan kerja keras warga RW 05.</p>
    </div>
</div>

<div class="d-flex justify-content-center flex-wrap gap-2 mb-5 pb-2 animate-fade-in" style="animation-delay: 0.2s;">
    <a href="{{ route('galeri.index') }}" class="btn {{ request('category') == null ? 'btn-primary shadow-sm' : 'btn-white shadow-sm border text-muted' }} rounded-pill px-4 fw-bold">Semua Momen</a>
    <a href="{{ route('galeri.index', ['category' => 'kerja_bakti']) }}" class="btn {{ request('category') == 'kerja_bakti' ? 'btn-primary shadow-sm' : 'btn-white shadow-sm border text-muted' }} rounded-pill px-4 fw-bold">Kerja Bakti</a>
    <a href="{{ route('galeri.index', ['category' => 'rapat']) }}" class="btn {{ request('category') == 'rapat' ? 'btn-primary shadow-sm' : 'btn-white shadow-sm border text-muted' }} rounded-pill px-4 fw-bold">Rapat Warga</a>
    <a href="{{ route('galeri.index', ['category' => 'perayaan']) }}" class="btn {{ request('category') == 'perayaan' ? 'btn-primary shadow-sm' : 'btn-white shadow-sm border text-muted' }} rounded-pill px-4 fw-bold">Perayaan</a>
</div>

<div class="row g-4">
    @forelse($galleries as $item)
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="card h-100 border-0 shadow-sm gallery-card" style="border-radius: 20px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#galleryModal{{ $item->id }}">
            <div class="position-relative overflow-hidden w-100" style="height: 250px; border-radius: 20px 20px 0 0;">
                @if($item->type == 'photo')
                <img src="{{ asset('storage/'.$item->file_path) }}" class="w-100 h-100 object-fit-cover transition-all" alt="{{ $item->title }}" />
                @else
                <div class="w-100 h-100 bg-dark d-flex align-items-center justify-content-center">
                    <i class="bi bi-play-circle-fill text-white fs-1"></i>
                    <video class="w-100 h-100 object-fit-cover position-absolute opacity-50">
                        <source src="{{ asset('storage/'.$item->file_path) }}" type="video/mp4" />
                    </video>
                </div>
                @endif
            </div>
            <div class="card-body p-3">
                <h6 class="fw-bold mb-1 text-dark text-truncate">{{ $item->title }}</h6>
                <p class="text-muted small mb-0"><i class="bi bi-calendar-event me-1"></i> {{ $item->created_at->format('d M Y') }}</p>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 py-5 text-center">
        <i class="bi bi-images fs-1 text-muted opacity-25"></i>
        <p class="text-secondary mt-3">Belum ada dokumentasi tersedia.</p>
    </div>
    @endforelse
</div>

{{-- Standard Bootstrap Modals --}}
@foreach($galleries as $item)
<div class="modal fade" id="galleryModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content shadow-lg border-0" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">{{ $item->title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="bg-black rounded-3 overflow-hidden d-flex align-items-center justify-content-center" style="min-height: 300px;">
                    @if($item->type == 'photo')
                    <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ $item->title }}" class="img-fluid" style="max-height: 80vh;" />
                    @else
                    <div class="ratio ratio-16x9">
                        <video controls class="w-100 h-100">
                            <source src="{{ asset('storage/'.$item->file_path) }}" type="video/mp4" />
                        </video>
                    </div>
                    @endif
                </div>
                <div class="mt-3">
                    <span class="badge bg-primary rounded-pill px-3">{{ ucfirst($item->category) }}</span>
                    <span class="text-muted small ms-2"><i class="bi bi-calendar3 me-1"></i> {{ $item->created_at->translatedFormat('d F Y') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="mt-5 d-flex justify-content-center">
    {{ $galleries->links('pagination::bootstrap-5') }}
</div>

@push('styles')
<style>
    .gallery-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .gallery-card:hover { transform: translateY(-5px); box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important; }
    .gallery-card img { transition: transform 0.5s ease; }
    .gallery-card:hover img { transform: scale(1.05); }
</style>
@endpush
@endsection