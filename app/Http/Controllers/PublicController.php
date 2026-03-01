<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Event;
use App\Models\Schedule;
use App\Models\Comment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PublicController extends Controller
{
    public function newsIndex()
    {
        $news = News::latest()->paginate(5);

        // Logika Sangat Cepat: Jangan biarkan API melambatkan loading web!
        $nationalNews = Cache::remember('national_news_direct_antara', 3600, function () {
            try {
                // Timeout di-set HANYA 3 detik. Kalau lebih dari 3 detik tidak berhasil, yaudah kosongi aja.
                $response = Http::timeout(3)->get('https://www.antaranews.com/rss/top-news.xml');
                if ($response->successful()) {
                    $xml = simplexml_load_string($response->body(), 'SimpleXMLElement', LIBXML_NOCDATA);
                    $items = [];
                    foreach ($xml->channel->item as $item) {
                        $items[] = [
                            'title' => (string)$item->title,
                            'link' => (string)$item->link,
                            'pubDate' => (string)$item->pubDate,
                            'thumbnail' => (string)($item->enclosure['url'] ?? 'https://via.placeholder.com/400x200?text=Antara+News'),
                        ];
                        if (count($items) >= 6) break;
                    }
                    return $items;
                }
            } catch (\Exception $e) {}
            return [];
        });

        // Ambil max 2 agenda terdekat dari tabel events
        $announcements = Event::orderBy('date', 'asc')
            ->take(2)
            ->get();
            
        // Ambil Jadwal Posyandu (Cari yang mendatang, kalau gak ada ambil yang paling baru diinput)
        $nextPosyandu = Schedule::where('type', 'posyandu')
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date', 'asc')
            ->first();
            
        if (!$nextPosyandu) {
            $nextPosyandu = Schedule::where('type', 'posyandu')
                ->orderBy('date', 'desc')
                ->first();
        }

        return view('public.news-index', compact('news', 'announcements', 'nationalNews', 'nextPosyandu'));
    }

    public function newsDetail($id)
    {
        $news = News::findOrFail($id);

        // Ambil 5 berita terbaru selain berita yang sedang dibuka
        $relatedNews = News::where('id', '!=', $news->id)
            ->latest()
            ->take(5)
            ->get();

        return view('public.news-detail', compact('news', 'relatedNews'));
    }



    public function scheduleIndex()
    {
        $posyanduSchedules = Schedule::where('type', 'posyandu')->orderBy('date')->get();
        $posbinduSchedules = Schedule::where('type', 'posbindu')->orderBy('date')->get();

        return view('public.schedule-index', compact('posyanduSchedules', 'posbinduSchedules'));
    }
    public function storeComment(Request $request, $newsId)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'comment' => 'required|string|max:500',
        ]);

        $news = News::findOrFail($newsId);

        $news->comments()->create([
            'name' => $request->name,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil dikirim!');
    }
    // Contoh di controller NewsController@show
    public function show($id)
    {
        $news = News::with('comments')->findOrFail($id);

        // Cari berita terkait berdasarkan kategori atau tag yang sama misalnya
        // Contoh asumsi $news->category_id ada:
        $relatedNews = News::where('category_id', $news->category_id)
            ->where('id', '!=', $news->id)
            ->latest()
            ->take(5)
            ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }

    public function nationalNews()
    {
        // Logika Sangat Cepat untuk halaman penuh
        $news = Cache::remember('national_news_page_direct', 3600, function () {
            try {
                // Timeout di-set HANYA 3 detik.
                $response = Http::timeout(3)->get('https://www.antaranews.com/rss/top-news.xml');
                if ($response->successful()) {
                    $xml = simplexml_load_string($response->body(), 'SimpleXMLElement', LIBXML_NOCDATA);
                    $items = [];
                    foreach ($xml->channel->item as $item) {
                        $items[] = [
                            'title' => (string)$item->title,
                            'link' => (string)$item->link,
                            'pubDate' => (string)$item->pubDate,
                            'thumbnail' => (string)($item->enclosure['url'] ?? 'https://via.placeholder.com/400x200?text=Antara+News'),
                            'description' => (string)$item->description,
                        ];
                    }
                    return $items;
                }
            } catch (\Exception $e) {}
            return [];
        });

        return view('public.national-news', compact('news'));
    }
}
