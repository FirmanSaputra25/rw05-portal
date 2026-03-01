@extends('layouts.app')

@section('title', 'Lapor Aduan - Portal RW 05')

@section('content')
<div class="row justify-content-center animate-fade-in">
    <div class="col-lg-6 col-md-8">
        <div class="text-center mb-5">
            <div class="mb-3">
                <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-bold" style="letter-spacing: 2px; font-size: 0.8rem;">LAYANAN PENGADUAN</span>
            </div>
            <h1 class="section-title text-center" style="font-size: 3.5rem; margin-bottom: 0px; display: inline-block;">Sampaikan Aspirasi Anda</h1>
            <p class="text-secondary mt-3 mx-auto" style="max-width: 500px; font-size: 1.1rem; line-height: 1.6;">Butuh bantuan atau ingin melaporkan sesuatu? Kami siap mendengarkan untuk RW 05 yang lebih baik.</p>
        </div>

        <div class="card border-0 shadow-lg overflow-hidden position-relative" style="border-radius: 30px;">
            <div class="bg-primary p-4 text-white d-flex align-items-center gap-3">
                <div class="bg-white bg-opacity-20 rounded-circle p-2 d-flex align-items-center justify-content-center shadow-sm" style="width: 54px; height: 54px;">
                    <i class="bi bi-megaphone-fill fs-3"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold">Formulir Pengaduan Resmi</h5>
                    <p class="mb-0 text-white text-opacity-75 small">Laporan Anda akan kami proses sesegera mungkin.</p>
                </div>
            </div>

            <div class="card-body p-4 p-md-5">
                @if($errors->any())
                <div class="alert alert-danger border-0 shadow-sm rounded-4 p-4 mb-5" role="alert">
                    <div class="d-flex align-items-start gap-3">
                        <div class="bg-white rounded-circle p-2 text-danger shadow-sm d-flex">
                            <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                        </div>
                        <div>
                            <span class="fw-bold d-block mb-1 text-dark">Mohon periksa kembali inputan Anda:</span>
                            <ul class="mb-0 small ps-3">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                <form action="{{ route('report.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="row g-4">
                        <div class="col-12">
                            <label for="name" class="form-label fw-bold text-dark small">NAMA LENGKAP <span class="text-primary">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 px-3"><i class="bi bi-person text-muted"></i></span>
                                <input type="text" id="name" name="name" class="form-control bg-light border-0 py-3 rounded-end-3 @error('name') is-invalid @enderror" placeholder="Contoh: Bpk. Heru" required maxlength="50" value="{{ old('name') }}">
                            </div>
                            <div class="form-text small mt-2">Nama pengirim akan kami jaga kerahasiannya (jika diminta).</div>
                        </div>

                        <div class="col-12">
                            <label for="phone" class="form-label fw-bold text-dark small">NOMOR HP / WHATSAPP (OPSIONAL)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 px-3"><i class="bi bi-whatsapp text-muted"></i></span>
                                <input type="tel" id="phone" name="phone" class="form-control bg-light border-0 py-3 rounded-end-3" placeholder="08xxxxxxxxx (Untuk konfirmasi)" value="{{ old('phone') }}">
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="message" class="form-label fw-bold text-dark small">DETAIL ADUAN ATAU SARAN <span class="text-primary">*</span></label>
                            <textarea id="message" name="message" rows="6" class="form-control bg-light border-0 p-4 rounded-4 @error('message') is-invalid @enderror" placeholder="Sampaikan keluhan, saran, atau ide Anda dengan detail..." required maxlength="1000">{{ old('message') }}</textarea>
                            <div class="form-text small mt-2 d-flex justify-content-between">
                                <span>Gunakan bahasa yang sopan dan jelas.</span>
                                <span>Maks. 1000 karakter</span>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-lg hover-scale">
                                Kirim Aduan Sekarang <i class="bi bi-send-fill ms-2"></i>
                            </button>
                            <p class="text-center mt-3 mb-0 small text-muted">Aduan Anda akan diteruskan ke Pengurus RW 05.</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-5 text-center bg-white p-4 rounded-4 shadow-sm border border-light animate-fade-in" style="animation-delay: 0.3s;">
            <div class="row g-4 align-items-center">
                <div class="col-md-7 text-md-start">
                    <h6 class="fw-bold mb-1">Butuh respon cepat?</h6>
                    <p class="text-muted small mb-0">Hubungi nomor darurat atau Hotline Pengurus RW di (021) xxxxxxx</p>
                </div>
                <div class="col-md-5 text-md-end">
                    <a href="https://wa.me/xxxxxxxxxxx" target="_blank" class="btn btn-success rounded-pill fw-bold px-4 py-2 shadow-sm border-0">
                        <i class="bi bi-whatsapp me-2"></i> WhatsApp RW 05
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .hover-scale { transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    .hover-scale:hover { transform: scale(1.02); }
    .form-control:focus {
        background-color: #fff !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border-color: rgba(79, 70, 229, 0.2) !important;
    }
    .input-group-text { border-radius: 12px 0 0 12px !important; }
    .rounded-end-3 { border-radius: 0 12px 12px 0 !important; }
</style>
@endpush
@endsection