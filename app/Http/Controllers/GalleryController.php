<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    // Tampilkan daftar galeri
    public function index(Request $request)
    {
        $category = $request->query('category');
        $galleries = Gallery::when($category, fn($q) => $q->where('category', $category))
            ->latest()
            ->paginate(9); // pake paginate biar ringan
        return view('galeri.index', compact('galleries'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'type' => 'required|string|in:image,video',
            'file_path' => 'required|file',
        ]);

        // Simpan file ke storage
        $path = $request->file('file_path')->store('galleries', 'public');
        // default thumbnail kalau type video
        $thumbnailPath = null;
        if ($request->type === 'video') {
            // di sini nanti kamu bisa generate thumbnail pakai ffmpeg
            $thumbnailPath = 'galleries/thumbnails/video-default.jpg';
        }

        // Simpan ke database
        $gallery = Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'type' => $request->type,
            'file_path' => $path,
            'thumbnail_path' => $thumbnailPath,
        ]);

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil ditambahkan');
    }

    // (opsional) tampilkan detail galeri per item
    public function show(Gallery $gallery)
    {
        return view('galeri.show', compact('gallery'));
    }
}
