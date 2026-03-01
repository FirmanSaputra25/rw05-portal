# 🏛️ Portal RW 05 - Digitalisasi Lingkungan Harmonis

Portal RW 05 adalah platform web modern yang dirancang untuk mendigitalisasi layanan, informasi, dan interaksi warga di lingkungan RW 05. Dibangun dengan estetika premium dan fokus pada kemudahan penggunaan bagi seluruh lapisan usia warga.

---

## ✨ Fitur Utama

-   **📰 Berita Terkini**: Informasi terbaru seputar kegiatan dan perkembangan di lingkungan RW 05.
-   **🏥 Jadwal Posyandu & Posbindu**: Kalender digital untuk layanan kesehatan balita, ibu hamil, dan lansia.
-   **📅 Agenda Warga**: Pengumuman acara komunitas, kerja bakti, dan rapat rutin dengan penekanan visual pada kegiatan krusial.
-   **📣 Layanan Pengaduan**: Form pelaporan aspirasi, saran, dan keluhan warga secara langsung ke pengurus.
-   **📸 Galeri Kegiatan**: Dokumentasi foto dan video momen kebersamaan warga dengan pemutar media premium.
-   **🌍 Warta Indonesia**: Integrasi berita nasional terkini melalui RSS Antara News.
-   **🛡️ Panel Admin (Filament)**: Manajemen konten yang mudah digunakan bagi pengurus RW untuk mengelola berita, agenda, dan galeri.

---

## 🛠️ Teknologi yang Digunakan

-   **Framework**: [Laravel 12+](https://laravel.com)
-   **Admin Panel**: [Filament v3](https://filamentphp.com)
-   **Frontend**: PHP Blade, Bootstrap 5, Bootstrap Icons
-   **Styling**: Custom Vanilla CSS (Modern Premium Aesthetic)
-   **Database**: MySQL / MariaDB

---

## 🚀 Cara Instalasi Lokal

1.  **Clone Repository**
    ```bash
    git clone https://github.com/FirmanSaputra25/rw05-portal.git
    cd rw05-portal
    ```

2.  **Instalasi Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Konfigurasi Environment**
    Salin file `.env.example` menjadi `.env` dan sesuaikan pengaturan database Anda.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Migrasi Database**
    ```bash
    php artisan migrate
    ```

5.  **Jalankan Aplikasi**
    ```bash
    php artisan serve
    npm run dev
    ```

---

## 📸 Tampilan Antarmuka

Aplikasi ini didesain dengan prinsip **Mobile First**, memastikan warga dapat mengakses informasi dengan nyaman melalui smartphone mereka dengan navigasi bawah yang statis dan intuitif.

---

## 🤝 Kontribusi

Aplikasi ini dikembangkan untuk kebutuhan internal RW 05. Jika Anda ingin memberikan saran atau kontribusi kode, dipersilakan untuk mengajukan *Pull Request*.

---

**Dikelola oleh Pengurus & Karang Taruna RW 05**  
"Membangun Lingkungan yang Harmonis, Transparan, dan Terdigitalisasi."
