@extends('layouts.app')

@section('title', $news->title . ' - Portal RW 05')

@section('content')
<div class="row g-5 animate-fade-in">
    <div class="col-lg-8">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('news.index') }}" class="text-decoration-none">Berita</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>

        <article class="bg-white p-4 p-md-5 rounded-4 shadow-sm border border-light overflow-hidden">
            <h1 class="fw-800 text-dark mb-4 display-6" style="line-height: 1.3;">{{ $news->title }}</h1>
            
            <div class="d-flex align-items-center gap-3 mb-4 py-3 border-top border-bottom">
                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                    <i class="bi bi-person-fill text-primary fs-5"></i>
                </div>
                <div>
                    <span class="d-block fw-bold text-dark small">{{ $news->author ?? 'Admin RW 05' }}</span>
                    <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i> {{ $news->created_at->translatedFormat('d F Y') }}</span>
                </div>
                <div class="ms-auto d-none d-sm-block">
                    <span class="badge bg-light text-muted border px-3 py-2 rounded-pill"><i class="bi bi-eye me-1"></i> {{ rand(100, 500) }} dibaca</span>
                </div>
            </div>

            @if($news->image)
            <figure class="mb-5 text-center position-relative">
                <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="img-fluid rounded-4 shadow-sm w-100" style="max-height: 500px; object-fit: cover;">
                <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-gradient-dark rounded-bottom-4 d-md-none text-white text-start">
                    <small>Dokumentasi Kegiatan RW 05</small>
                </div>
            </figure>
            @endif

            <div class="article-body" style="font-size: 1.15rem; line-height: 1.9; color: #334155; text-align: justify;">
                {!! nl2br(e($news->content)) !!}
            </div>

            <div class="mt-5 pt-4 border-top">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <span class="fw-bold text-dark me-2 small uppercase">Bagikan:</span>
                        <a href="#" class="social-btn facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-btn twitter"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-btn whatsapp"><i class="bi bi-whatsapp"></i></a>
                    </div>
                    <a href="{{ route('news.index') }}" class="btn btn-light rounded-pill px-4 border small fw-bold"><i class="bi bi-arrow-left me-2"></i> Kembali ke Berita</a>
                </div>
            </div>
        </article>

        <!-- Section Komentar -->
        <section class="mt-5 p-4 p-md-5 bg-white rounded-4 shadow-sm border border-light">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h3 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-chat-left-dots-fill text-primary"></i>
                    Aspirasi Warga
                </h3>
                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-bold" style="font-size: 0.9rem;">{{ $news->comments->count() }} Komentar</span>
            </div>

            @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show rounded-4 p-3 mb-4" role="alert">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white rounded-circle p-2 text-success shadow-sm d-flex">
                        <i class="bi bi-check-lg fs-5"></i>
                    </div>
                    <div>
                        <span class="fw-bold d-block">Terima Kasih!</span>
                        <small>{{ session('success') }}</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form action="{{ route('news.comment.store', $news->id) }}" method="POST" class="mb-5 bg-light p-4 rounded-4 transition-all border border-transparent focus-within-border-primary">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-bold text-dark small">NAMA LENGKAP</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-0 rounded-start-pill ps-3"><i class="bi bi-person text-muted"></i></span>
                            <input type="text" id="name" name="name" class="form-control bg-white border-0 py-3 rounded-end-pill @error('name') is-invalid @enderror" placeholder="Contoh: Bpk. Kurniawan" required maxlength="50" value="{{ old('name') }}">
                        </div>
                        @error('name') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label for="comment" class="form-label fw-bold text-dark small">PESAN / KOMENTAR</label>
                        <textarea id="comment" name="comment" rows="4" class="form-control bg-white border-0 p-4 rounded-4 @error('comment') is-invalid @enderror" placeholder="Sampaikan pendapat atau tanggapan Anda..." required maxlength="500">{{ old('comment') }}</textarea>
                        @error('comment') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary px-5 py-3 rounded-pill fw-bold shadow-lg hover-scale">Post Komentar <i class="bi bi-send-fill ms-2"></i></button>
                    </div>
                </div>
            </form>

            <div class="comment-list mt-5">
                @forelse($news->comments as $comment)
                <div class="d-flex gap-3 mb-4 p-4 rounded-4 bg-light bg-opacity-50 border border-transparent hover-border-light transition-all">
                    <div class="bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 54px; height: 54px;">
                        <i class="bi bi-person-circle text-primary opacity-50 fs-3"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6 class="fw-bold text-dark mb-0">{{ $comment->name }}</h6>
                            <span class="text-muted small"><i class="bi bi-clock me-1"></i> {{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-secondary mb-0" style="line-height: 1.6;">{{ $comment->comment }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-5 bg-light rounded-4 border-dashed">
                    <div class="bg-white rounded-circle p-3 d-inline-flex mb-3 shadow-sm text-muted">
                        <i class="bi bi-chat-quote fs-2"></i>
                    </div>
                    <p class="text-muted small mb-0">Belum ada komentar dari warga. Ayo berikan tanggapan pertama!</p>
                </div>
                @endforelse
            </div>
        </section>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <div class="sticky-top" style="top: 100px;">
            <div class="bg-white p-4 rounded-4 shadow-sm border border-light mb-4">
                <h5 class="fw-bold text-dark mb-4 pb-2 border-bottom d-flex align-items-center gap-2">
                    <span class="bg-primary p-1 rounded-circle" style="width: 8px; height: 8px;"></span>
                    Berita Lainnya
                </h5>
                <div class="d-flex flex-column gap-4">
                    @forelse($relatedNews as $related)
                    <a href="{{ route('news.detail', $related->id) }}" class="text-decoration-none d-flex gap-3 align-items-center group">
                        <div class="flex-shrink-0 position-relative overflow-hidden rounded-3" style="width: 85px; height: 85px;">
                            <img src="{{ $related->image ? asset('storage/' . $related->image) : 'https://source.unsplash.com/200x200/?community,vibrant&random=' . $related->id }}" class="w-100 h-100 object-fit-cover transition-all group-hover-scale">
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold text-dark mb-1 line-clamp-2 transition-all group-hover-text-primary small" style="line-height: 1.4;">{{ $related->title }}</h6>
                            <small class="text-muted opacity-75 d-flex align-items-center gap-2">
                                <i class="bi bi-calendar2-event"></i> {{ $related->created_at->translatedFormat('d M Y') }}
                            </small>
                        </div>
                    </a>
                    @empty
                    <p class="text-muted small italic mb-0">Tidak ada berita terbaru.</p>
                    @endforelse
                </div>
            </div>

            <!-- Kartu Laporan -->
            <div class="bg-dark p-4 rounded-4 shadow-lg text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #1e293b, #0f172a);">
                <div class="position-absolute top-0 end-0 m-4 opacity-10">
                    <i class="bi bi-megaphone-fill" style="font-size: 5rem;"></i>
                </div>
                <div class="position-relative z-index-1">
                    <h5 class="fw-bold mb-3 mt-1">Layanan Pengaduan</h5>
                    <p class="small text-white text-opacity-75 mb-4">Mari bersama bangun RW 05 yang lebih baik. Sampaikan saran, keluhan, atau laporan Anda secara langsung.</p>
                    <a href="{{ route('report.create') }}" class="btn btn-primary w-100 rounded-pill fw-bold py-3 shadow">Buat Laporan <i class="bi bi-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .fw-800 { font-weight: 800; }
    .display-6 { font-weight: 800; letter-spacing: -0.03em; }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .group:hover .group-hover-scale { transform: scale(1.1); }
    .group:hover .group-hover-text-primary { color: var(--bs-primary) !important; }
    .social-btn {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f5f9;
        color: #64748b;
        transition: all 0.3s ease;
        text-decoration: none;
        font-size: 1rem;
    }
    .social-btn:hover { transform: translateY(-3px); color: white; }
    .social-btn.facebook:hover { background: #1877f2; }
    .social-btn.twitter:hover { background: #000000; }
    .social-btn.whatsapp:hover { background: #25d366; }
    .border-dashed { border: 2px dashed #e2e8f0 !important; }
    .focus-within-border-primary:focus-within { border-color: var(--bs-primary) !important; }
    .bg-gradient-dark { background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); }
</style>
@endpush
@endsection