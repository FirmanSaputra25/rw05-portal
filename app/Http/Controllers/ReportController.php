<?php

// app/Http/Controllers/ReportController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function create()
    {
        return view('report.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'phone' => 'nullable|max:20',
            'message' => 'required|max:1000',
        ]);

        $report = Report::create($request->only('name', 'phone', 'message'));

        // Format pesan WhatsApp
        $phoneAdmin = '6289626078285'; // Ganti dengan nomor WA admin (format internasional tanpa +)
        $text = "Aduan Baru dari:\n";
        $text .= "Nama: {$report->name}\n";
        if ($report->phone) {
            $text .= "No. HP: {$report->phone}\n";
        }
        $text .= "Pesan:\n{$report->message}";

        $whatsappUrl = "https://wa.me/{$phoneAdmin}?text=" . urlencode($text);

        // Redirect ke WhatsApp
        return redirect($whatsappUrl);
    }
}