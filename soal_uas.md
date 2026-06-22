# 📝 Panduan & Soal Ujian Akhir Semester (UAS) - Pemrograman Web
**Sifat Ujian:** Proyek Kelompok (Pengerjaan Mandiri Terjadwal)  
**Bobot Nilai:** 40% dari Nilai Akhir Mata Kuliah  
**Stack Teknologi:** Javascript Fullstack (Svelte + Express.js + Relational Database)  
**Batas Kelompok:** 2 Anggota per kelompok  

---

## 1. Deskripsi Proyek UAS
Mahasiswa diminta untuk merancang dan membangun sebuah **Aplikasi Web Fullstack Dinamis Sederhana**. Aplikasi wajib dibangun dari nol menggunakan kombinasi Svelte di sisi frontend dan Express.js di sisi backend.

---

## 2. Cakupan Teknis & Pemetaan Materi (Minggu 2–14)
Proyek UAS harus membuktikan penguasaan terhadap seluruh materi kuliah yang telah diajarkan dengan rincian pemetaan sebagai berikut:

| No | Modul / Materi | Deskripsi Implementasi Wajib dalam Proyek |
|---|---|---|
| **1** | **HTML & CSS Lanjutan** | - UI harus menggunakan tag HTML5 Semantik secara benar (`<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, `<footer>`).<br>- Layout responsif (*Mobile-First* atau *Responsive Web Design*) menggunakan **CSS Flexbox** dan **CSS Grid** tanpa framework CSS eksternal.<br>- Menyediakan transisi/animasi CSS halus untuk meningkatkan *user experience* (misal: *hover state*, transisi *modal*, *loading spinner*). |
| **2** | **JavaScript & Asynchronous JS** | - Manipulasi DOM yang efisien dan bersih.<br>- Komunikasi asinkron menggunakan **Fetch API** (`async/await`) untuk pertukaran data berformat JSON dengan backend.<br>- Penanganan *Local Storage* atau *Session Storage* (misalnya untuk menyimpan *state* tema atau *session token* sementara). |
| **3** | **Backend & Data Persistence** | - Membangun server RESTful API menggunakan **Node.js** dan **Express**.<br>- Penerapan arsitektur kode terpisah yang rapi (Router, Controller, Model/Service).<br>- Menghubungkan API dengan database relasional (MariaDB) menggunakan Query Builder atau ORM (Drizzle ORM) dengan relasi data (minimal *One-to-Many* atau *Many-to-Many*). |
| **4** | **Authentication & Security** | - Sistem registrasi dan login user yang aman.<br>- Pengamanan password dengan hashing satu arah menggunakan **bcrypt** sebelum disimpan ke database.<br>- Pembatasan akses menggunakan **JSON Web Tokens (JWT)** yang dikirim melalui *Header Authorization* (`Authorization: Bearer <token>`) atau HTTP-only Cookies.<br>- Implementasi middleware autentikasi untuk memproteksi endpoint API yang sensitif. |
| **5** | **Frontend Framework (Svelte)** | - Membagi antarmuka menjadi komponen-komponen Svelte yang modular dan *reusable*.<br>- Mengelola *state* komponen dengan reaktivitas lokal Svelte, serta menggunakan *Svelte Store* jika terdapat data global yang perlu diakses lintas komponen.<br>- Penerapan *client-side routing* untuk pengalaman Single Page Application (SPA). |
| **6** | **Fullstack Integration & Deployment** | - Integrasi *end-to-end* dengan penanganan CORS yang benar pada Express. |

---

## 3. Kebijakan Anti-AI & Anti-Vibecoding (Orisinalitas Kode)
Untuk memastikan mahasiswa benar-benar memahami kode dan tidak sekadar melakukan *copy-paste* buta atau menggunakan AI generator (*vibecoding*), diterapkan 3 lapis sistem verifikasi:

### A. Analisis Riwayat Commit Git (Git History Analysis)
- Proyek wajib dikerjakan menggunakan Git dan di-host di GitHub.
- **Commit minimal per anggota adalah 5 commit** yang bermakna (menunjukkan progres bertahap, bukan *bulk commit* sekaligus di akhir).
- Setiap anggota wajib melakukan commit dari akun GitHub pribadinya.
- Log commit harus mencerminkan pembagian tugas yang logis (misal: Anggota A membuat skema DB & router backend, Anggota B mengerjakan komponen frontend, Anggota C mengerjakan integrasi Auth & deployment).

### B. Modifikasi Kode Langsung (Live Modification)
- Penguji akan memberikan **tugas modifikasi kecil** secara langsung saat presentasi yang wajib diselesaikan dalam waktu **5–10 menit tanpa bantuan AI**.
- Contoh modifikasi:
  - *Frontend:* Mengubah validasi form agar tidak menerima karakter tertentu, atau mengubah tata letak CSS Flexbox menjadi grid pada komponen tertentu.
  - *Backend:* Menambahkan field validasi baru di request body, atau mengubah respons format error dari middleware.
- Gagal menyelesaikan modifikasi langsung ini menandakan kurangnya penguasaan teknis atas kode yang dikumpulkan, dan nilai individu untuk aspek ini akan bernilai **nol (0)**.

---

## 4. Rubrik Penilaian UAS
Penilaian UAS dibagi menjadi dua bagian utama: **Bobot Proyek Kelompok (40%)** dan **Bobot Pemahaman Individu (60%)**.

```
Nilai UAS Akhir = (Nilai Proyek Kelompok * 40%) + (Nilai Pemahaman Individu * 60%)
```

### A. Komponen Penilaian Proyek Kelompok (40%)
| Aspek Penilaian | Bobot | Indikator Kinerja Utama (KPI) |
|---|---:|---|
| **Fungsionalitas Fullstack & DB** | 20% | Aplikasi berjalan stabil tanpa error fatal; seluruh fitur CRUD berjalan baik; skema database relasional dirancang dengan benar dan konsisten. |
| **Kualitas UI/UX & Responsivitas** | 20% | Antarmuka rapi, konsisten, responsif di mobile/desktop, serta memiliki *loading/error feedback state* yang baik untuk interaksi API. |

### B. Komponen Penilaian Pemahaman Individu (60%)
| Aspek Penilaian | Bobot | Indikator Kinerja Utama (KPI) |
|---|---:|---|
| **Oral Defense (Tanya Jawab Kode)** | 30% | Mahasiswa mampu menjelaskan baris kode miliknya secara logis, fasih, dan memahami konsep dasar (routing, state, database query, authentication). |
| **Live Modification** | 20% | Mahasiswa mampu memodifikasi kode proyek secara langsung sesuai instruksi penguji dalam batas waktu yang ditentukan tanpa bantuan AI generator. |
| **Kontribusi Git & Kolaborasi** | 10% | Pembagian tugas tercermin secara adil melalui log commit Git yang konsisten, bertahap, dan deskriptif dari akun mahasiswa bersangkutan. |

---

## 5. Dokumen & Format Pengumpulan
Setiap kelompok wajib mengumpulkan tautan pengumpulan paling lambat pada hari H pelaksanaan UAS dengan melampirkan berkas berikut:

1. **Tautan Repositori GitHub**
   - Repositori harus bersifat Publik.
   - Struktur repositori monorepo terpisah (misal folder `/frontend` dan `/backend`) atau repositori terpisah yang saling bertautan di README.
2. **File README.md Proyek** yang berisi:
   - Judul Proyek dan Deskripsi Masalah yang diselesaikan.
   - Tabel Anggota Kelompok beserta pembagian tugas konkretnya.
   - Dokumentasi Skema Database (diagram relasi tabel/ERD atau daftar tabel).
   - Dokumentasi Ringkas Endpoint API (Method, Endpoint Path, Payload Body, dan Format Respons).
   - Cara menjalankan aplikasi secara lokal.
3. **File `.env.example`**
   - Contoh konfigurasi environment variables untuk frontend dan backend tanpa menyertakan credential asli.
4. **Video Demo Singkat (Maksimal 5 Menit)**
   - Menunjukkan alur utama aplikasi (login, CRUD, logout) sebagai cadangan jika terjadi kendala teknis saat presentasi live.

---
> **"Ketik kode Anda sendiri, pahami setiap barisnya. Developer sejati dihargai dari pemahamannya, bukan sekadar menekan tombol generate."**
