@extends('layouts.app')

@section('title', 'Galeri - Portal RW 05')

@section('content')
<div class="row mb-5 pb-3">
    <div class="col-12 text-center mt-4">
        <div class="mb-3">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold" style="letter-spacing: 2px; font-size: 0.8rem;">DOKUMENTASI VISUAL</span>
        </div>
        <h1 class="section-title text-center" style="font-size: 3.5rem; margin-bottom: 0px; display: inline-block;">Galeri Kegiatan Kegiatan</h1>
        <p class="text-secondary mt-3 mx-auto" style="max-width: 600px; font-size: 1.25rem;">Mengabadikan setiap momen kebersamaan dan kerja keras warga RW 05.</p>
    </div>
</div>

<div class="d-flex justify-content-center flex-wrap gap-2 mb-5 pb-2 animate-fade-in" style="animation-delay: 0.2s;">
    <a href="{{ route('galeri.index') }}" class="btn {{ request('category') == null ? 'btn-primary shadow-sm' : 'btn-white shadow-sm border text-muted' }} rounded-pill px-4 fw-bold">Semua Momen</a>
    <a href="{{ route('galeri.index', ['category' => 'kerja_bakti']) }}" class="btn {{ request('category') == 'kerja_bakti' ? 'btn-primary shadow-sm' : 'btn-white shadow-sm border text-muted' }} rounded-pill px-4 fw-bold">Kerja Bakti</a>
    <a href="{{ route('galeri.index', ['category' => 'rapat']) }}" class="btn {{ request('category') == 'rapat' ? 'btn-primary shadow-sm' : 'btn-white shadow-sm border text-muted' }} rounded-pill px-4 fw-bold">Rapat Warga</a>
    <a href="{{ route('galeri.index', ['category' => 'perayaan']) }}" class="btn {{ request('category') == 'perayaan' ? 'btn-primary shadow-sm' : 'btn-white shadow-sm border text-muted' }} rounded-pill px-4 fw-bold">Perayaan</a>
</div>

<div class="row g-4 animate-fade-in" style="animation-delay: 0.4s;">
    @forelse($galleries as $item)
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="card h-100 border-0 shadow-lg overflow-hidden group gallery-card" style="border-radius: 24px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#galleryModal{{ $item->id }}">
            <div class="position-relative overflow-hidden w-100" style="height: 280px;">
                @if($item->type == 'photo')
                <div class="w-100 h-100 position-relative overflow-hidden">
                    <img src="{{ asset('storage/'.$item->file_path) }}" class="w-100 h-100 object-fit-cover transition-all group-hover-scale" alt="{{ $item->title }}" />
                </div>
                @else
                <div class="w-100 h-100 position-relative overflow-hidden">
                    <video class="w-100 h-100 object-fit-cover">
                        <source src="{{ asset('storage/'.$item->file_path) }}" type="video/mp4" />
                    </video>
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <div class="bg-white bg-opacity-75 rounded-circle d-flex align-items-center justify-content-center shadow-lg transition-all group-hover-translate-up" style="width: 70px; height: 70px; backdrop-filter: blur(8px);">
                            <i class="bi bi-play-circle-fill text-primary" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-gradient-dark-transparent opacity-0 group-hover-opacity-100 transition-all">
                    <small class="text-white fw-bold d-flex align-items-center gap-2">
                        <i class="bi bi-tag-fill text-primary"></i> {{ ucfirst(str_replace('_',' ',$item->category)) }}
                    </small>
                </div>
            </div>
            
            <div class="card-body p-4 bg-white">
                <h5 class="card-title fw-bold mb-1 text-dark line-clamp-2" style="font-size: 1.15rem; line-height: 1.4;">{{ $item->title }}</h5>
                <p class="text-muted small mb-0"><i class="bi bi-clock me-1"></i> {{ $item->created_at->translatedFormat('d M Y') }}</p>
            </div>
        </div>
    </div>

    {{-- Modal detail Premium --}}
    <div class="modal fade" id="galleryModal{{ $item->id }}" tabindex="-1" aria-hidden="true" style="backdrop-filter: blur(20px);">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bg-transparent border-0 shadow-none">
                <div class="modal-header border-0 pb-0 justify-content-end p-2 mt-4">
                    <button type="button" class="btn-close shadow-none bg-white rounded-circle p-3" data-bs-dismiss="modal" aria-label="Close" style="opacity: 1;"></button>
                </div>
                <div class="modal-body p-0 text-center position-relative mt-2">
                    <div class="bg-white rounded-5 shadow-2xl p-3 mx-auto overflow-hidden animate-zoom-in" style="max-width: 95%;">
                        <div class="rounded-4 overflow-hidden shadow-sm">
                            @if($item->type == 'photo')
                            <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ $item->title }}" class="img-fluid w-100" style="max-height: 80vh; object-fit: contain;" />
                            @else
                            <div class="ratio ratio-16x9">
                                <video controls class="w-100 h-100 bg-black">
                                    <source src="{{ asset('storage/'.$item->file_path) }}" type="video/mp4" />
                                </video>
                            </div>
                            @endif
                        </div>
                        <div class="text-start mt-4 p-4 border-top">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                                <h3 class="fw-800 text-dark mb-0">{{ $item->title }}</h3>
                                <span class="badge bg-primary bg-opacity-10 text-primary px-4 py-2 rounded-pill fw-bold">{{ ucfirst(str_replace('_',' ',$item->category)) }}</span>
                            </div>
                            <p class="text-secondary small mb-0 d-flex align-items-center gap-2 font-italic">
                                <i class="bi bi-info-circle-fill"></i> Momen berharga di abadikan pada {{ $item->created_at->translatedFormat('d F Y') }} di lingkungan RW 05.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="text-center p-5 bg-white shadow-lg border-dashed" style="border-radius: 30px; border: 2px dashed #e2e8f0;">
            <div class="bg-light rounded-circle d-inline-flex p-5 mb-4 shadow-sm text-muted">
                <i class="bi bi-images" style="font-size: 5rem; opacity: 0.15;"></i>
            </div>
            <h4 class="text-dark fw-bold h4">Belum Ada Dokumentasi</h4>
            <p class="text-secondary mb-0 mx-auto" style="max-width: 400px;">Foto dan video kegiatan warga RW 05 akan segera kami tampilkan di sini.</p>
        </div>
    </div>
    @endforelse
</div>

<div class="mt-5 d-flex justify-content-center">
    {{ $galleries->links('pagination::bootstrap-5') }}
</div>

@push('styles')
<style>
    .fw-800 { font-weight: 800; }
    .gallery-card { transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    .gallery-card:hover { transform: translateY(-10px); }
    .group-hover-scale { transition: transform 0.6s ease; }
    .group:hover .group-hover-scale { transform: scale(1.1); }
    .group-hover-translate-up { transition: all 0.4s ease; }
    .group:hover .group-hover-translate-up { transform: translateY(-30px) scale(1.1); }
    .group-hover-opacity-100 { transition: opacity 0.4s ease; }
    .group:hover .group-hover-opacity-100 { opacity: 1; }
    .bg-gradient-dark-transparent { background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); }
    .btn-white { background: white; color: var(--bs-primary); border-color: rgba(0,0,0,0.05); }
    .btn-white:hover { background-color: #f8fafc; color: var(--bs-primary); }
    .shadow-2xl { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); }
    
    @keyframes zoomIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    .animate-zoom-in {
        animation: zoomIn 0.3s ease-out forwards;
    }
</style>
@endpush
@endsection