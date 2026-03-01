<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
// routes/web.php
use App\Http\Controllers\ReportController;

Route::get('/aduan', [ReportController::class, 'create'])->name('report.create');
Route::post('/aduan', [ReportController::class, 'store'])->name('report.store');


// Jika kamu mau homepage ke newsIndex:
Route::get('/', [PublicController::class, 'newsIndex'])->name('home');
Route::get('/news', [PublicController::class, 'newsIndex'])->name('news.index');
Route::get('/news/{id}', [PublicController::class, 'newsDetail'])->name('news.detail');
Route::get('/berita-nasional', [PublicController::class, 'nationalNews'])->name('news.national');
Route::get('/jadwal', [PublicController::class, 'scheduleIndex'])->name('schedule.index');
Route::post('/news/{news}/comment', [PublicController::class, 'storeComment'])->name('news.comment.store');



Route::get('/agenda', [EventController::class, 'index'])->name('agenda.index');
Route::get('/agenda/{event}', [EventController::class, 'show'])->name('agenda.show');

//Galery

Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri.index');
Route::get('/galeri/{gallery}', [GalleryController::class, 'show'])->name('galeri.show');
