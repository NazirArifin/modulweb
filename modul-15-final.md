# Modul 15 - Final Project & Presentasi

Tujuan Pembelajaran: Mahasiswa mampu menyelesaikan proyek fullstack secara utuh, melakukan penyempurnaan fitur inti, menyusun dokumentasi teknis yang rapi, serta mempresentasikan hasil implementasi dengan jelas dan terukur.

## Materi

### 1) Fokus Minggu Final

Pada minggu final, target bukan menambah banyak fitur baru, tetapi memastikan proyek:
- stabil,
- fungsional end-to-end,
- mudah dipahami dosen/penguji,
- siap dipresentasikan secara profesional.

Prioritas kerja:
1. Menyelesaikan fitur inti (MVP) yang sudah direncanakan.
2. Menutup bug penting.
3. Merapikan UX/UI ringan.
4. Menyusun dokumentasi teknis.
5. Menyiapkan demo dan presentasi.

---

### 2) Penyempurnaan Fitur Inti (MVP)

Checklist minimal MVP fullstack:
- autentikasi login berjalan,
- minimal satu entitas utama dapat dikelola (CRUD minimal 2 operasi),
- data tersimpan konsisten di database,
- frontend dan backend terhubung pada deployment production.

Prinsip penting:
- selesaikan fitur yang sudah ada sebelum menambah fitur baru,
- hindari scope creep di minggu terakhir,
- fokus pada kualitas alur utama user.

---

### 3) Perbaikan UX/UI Ringan

Perbaikan ringan yang disarankan:
- konsistensi spacing, ukuran teks, dan warna,
- state loading pada proses API,
- pesan error/sukses yang jelas,
- validasi form agar user tidak bingung,
- empty state (ketika data belum ada).

Tujuan UX minggu final:
- aplikasi mudah dipakai,
- alur fitur dapat dipahami dalam sekali coba,
- presentasi berjalan lancar tanpa kebingungan user flow.

---

### 4) Dokumentasi Teknis Wajib

Setiap tim wajib memiliki README yang menjawab minimal:

1. **Deskripsi Proyek**
	- judul proyek,
	- masalah yang diselesaikan,
	- target pengguna.

2. **Fitur Utama**
	- daftar fitur yang berhasil dibuat,
	- status fitur (selesai/sebagian).

3. **Stack Teknologi**
	- frontend,
	- backend,
	- database,
	- deployment platform.

4. **Cara Menjalankan Lokal**
	- langkah instalasi,
	- setup environment variable,
	- command run frontend/backend.

5. **Dokumentasi API Ringkas**
	- method, endpoint, body, response contoh,
	- endpoint protected dan kebutuhan token.

6. **Link Deployment**
	- URL frontend,
	- URL backend,
	- (opsional) dokumentasi tambahan/demo video.

---

### 5) Persiapan Demo dan Presentasi

Alur demo yang direkomendasikan (5-10 menit):

1. Problem statement singkat.
2. Tunjukkan arsitektur sistem (frontend-backend-database).
3. Demo login.
4. Demo fitur inti (minimal satu alur CRUD).
5. Demo error handling sederhana (misal validasi gagal).
6. Tunjukkan deployment live.
7. Ringkas kendala + solusi yang ditemukan tim.

Tips presentasi:
- siapkan akun data uji sebelum presentasi,
- siapkan plan B jika internet lambat (screenshot/video backup),
- tunjukkan pembagian peran tiap anggota tim.

---

### 6) Uji Akhir Sebelum Submit

Lakukan final QA checklist:

1. Semua endpoint penting merespons benar.
2. Login/logout berfungsi.
3. Tidak ada URL `localhost` tersisa di frontend production.
4. Tidak ada credential sensitif di repository.
5. README dan `.env.example` tersedia.
6. Tautan deployment dapat diakses.

Skenario uji minimum:
- login sukses,
- login gagal,
- tampil data,
- tambah/ubah/hapus data,
- logout.

---

## Praktikum

### Tugas Praktikum 1 - Finalisasi Fitur Inti

Target output: MVP benar-benar selesai dan bisa didemokan.

Langkah:
1. Identifikasi fitur yang wajib selesai untuk demo.
2. Kunci scope (jangan tambah fitur besar baru).
3. Selesaikan bug blocker pada alur utama.
4. Uji ulang end-to-end setelah perbaikan.

Checklist:
- alur utama aplikasi berjalan tanpa error fatal
- fitur MVP sesuai proposal
- perubahan terakhir tidak merusak fitur lain

### Tugas Praktikum 2 - Dokumentasi Proyek

Target output: dokumentasi mudah dipahami penguji.

Langkah:
1. Rapikan `README.md` proyek.
2. Tambahkan `env.example` frontend dan backend.
3. Buat ringkasan endpoint API penting.
4. Tambahkan langkah instalasi dan run lokal.

Checklist:
- orang lain bisa setup proyek dari README
- endpoint utama terdokumentasi
- tidak ada env sensitif di repo

### Tugas Praktikum 3 - Simulasi Presentasi

Target output: tim siap presentasi tepat waktu.

Langkah:
1. Buat slide ringkas (problem, solusi, arsitektur, demo).
2. Latihan demo 1 putaran penuh.
3. Tentukan pembagian bicara antar anggota tim.
4. Siapkan backup demo (video/screenshot).

Checklist:
- demo selesai dalam durasi yang ditentukan
- tiap anggota punya peran jelas
- jawaban atas pertanyaan teknis dasar sudah disiapkan

---

## Tugas (Final Submission)

Kumpulkan final project dengan komponen berikut:

1. **Repository Proyek**
	- source code frontend,
	- source code backend,
	- struktur folder rapi.

2. **Deployment**
	- URL frontend live,
	- URL backend live,
	- endpoint utama bisa diuji.

3. **Dokumentasi**
	- README lengkap,
	- `.env.example`,
	- dokumentasi API ringkas,
	- pembagian tugas anggota tim.

4. **Bukti Pengujian**
	- screenshot atau video demo,
	- minimal 5 skenario uji fitur utama.

5. **Presentasi**
	- slide presentasi,
	- demo live,
	- sesi tanya jawab.

---

## Rubrik Penilaian (Contoh)

| Aspek | Bobot | Indikator |
|---|---:|---|
| Fungsionalitas Fullstack | 30% | Login, integrasi API, fitur inti berjalan end-to-end |
| Kualitas Backend | 20% | Struktur API, validasi, error handling, konsistensi response |
| Kualitas Frontend & UX | 20% | UI rapi, alur jelas, feedback loading/error |
| Deployment & Stabilitas | 15% | Aplikasi live, konfigurasi env benar, akses publik stabil |
| Dokumentasi & Presentasi | 15% | README lengkap, demo jelas, komunikasi teknis baik |

Catatan penilaian:
- Proyek yang fiturnya banyak tetapi tidak stabil akan dinilai lebih rendah dari proyek yang fitur intinya sedikit namun berjalan baik.
- Kerapian dokumentasi memengaruhi kemudahan evaluasi dan nilai akhir.

Selamat menyelesaikan final project. Fokus pada kualitas, konsistensi, dan kesiapan presentasi.
