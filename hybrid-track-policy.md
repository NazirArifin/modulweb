# Draft Kebijakan Hybrid Track (Express + PHP)

Status: **Draft untuk ditinjau dosen**

Dokumen ini menjadi contoh kebijakan jika kelas menggunakan dua jalur implementasi backend:
- **Track A (Default):** Node.js + Express + TypeScript
- **Track B (Alternatif):** PHP (Native terstruktur atau Laravel/Lumen)

Tujuan kebijakan ini adalah menjaga **keadilan penilaian berbasis konsep**, bukan berbasis framework.

---

## 1. Prinsip Utama

1. Pembelajaran tetap berfokus pada konsep backend:
   - routing,
   - controller dan request-response,
   - validasi,
   - akses database,
   - autentikasi,
   - error handling,
   - deployment.
2. Mahasiswa boleh memilih salah satu track sesuai kesiapan.
3. Nilai ditentukan dari kualitas implementasi konsep dan kelengkapan fitur, bukan bahasa/framework yang dipakai.

---

## 2. Pilihan Track

### Track A (Default): Express
- Cocok untuk mahasiswa yang ingin jalur modern JavaScript/TypeScript.
- Stack contoh: Express + Sequelize + MariaDB + JWT.

### Track B (Alternatif): PHP
- Cocok untuk mahasiswa yang masih transisi dari PHP dasar.
- Stack contoh:
  - Opsi 1: PHP Native + PDO (terstruktur MVC ringan)
  - Opsi 2: Laravel/Lumen + Eloquent

Catatan: Dosen dapat menentukan satu opsi PHP agar evaluasi lebih konsisten.

---

## 3. Kontrak API Minimal (Wajib Sama di Dua Track)

Agar adil, kedua track harus memenuhi kontrak API yang setara.

### Endpoint Wajib (contoh entitas: mahasiswa)
- `POST /login`
- `GET /mahasiswa`
- `GET /mahasiswa/:id`
- `POST /mahasiswa`
- `PUT /mahasiswa/:id`
- `DELETE /mahasiswa/:id`

### Standar Respons
- `200` untuk sukses ambil/ubah data.
- `201` untuk sukses create.
- `400` untuk validasi gagal.
- `401` untuk tidak terautentikasi.
- `404` untuk data tidak ditemukan.
- `500` untuk error server.

### Header Auth
- Endpoint protected wajib menerima:
  - `Authorization: Bearer <token>`

---

## 4. Mapping Materi per Minggu (Backend)

| Minggu | Konsep | Track A (Express) | Track B (PHP) |
|---|---|---|---|
| 7 | Routing + CRUD dasar | `Router`, controller, model Sequelize | Router PHP/framework, controller, model/query |
| 9 | Relasi + validasi + error handling | association, validation, middleware error | relasi model/query, validator, error handler |
| 10 | Authentication & security | bcrypt + JWT middleware | password_hash + JWT/auth middleware |
| 13 | Integrasi fullstack | API + frontend integration | API + frontend integration |
| 14 | Deployment | Render/Railway | Render/Railway/shared hosting/VPS |

---

## 5. Rubrik Penilaian Netral Framework

| Aspek | Bobot | Indikator |
|---|---:|---|
| Fungsionalitas API | 40% | Endpoint sesuai kontrak, response status benar |
| Data Layer & Validasi | 25% | Struktur data rapi, validasi jalan, data konsisten |
| Security Dasar | 20% | Login, token/session, proteksi endpoint |
| Struktur & Dokumentasi | 15% | Kode terorganisir, README dan API docs jelas |

Kebijakan ini mencegah bias terhadap framework tertentu.

---

## 6. Aturan Kelas

1. Mahasiswa memilih track maksimal hingga akhir Minggu 7.
2. Setelah memilih track, perubahan track hanya boleh dengan persetujuan dosen.
3. Demo dan pengumpulan tetap satu format yang sama.
4. Pair/group project boleh beda track hanya jika API contract tetap konsisten.

---

## 7. Format Pengumpulan (Dua Track Sama)

- Repository source code backend.
- URL deployment (jika sudah tahap deploy).
- Dokumentasi endpoint (method, path, body, response).
- `.env.example`.
- Bukti uji minimal 5 skenario (sukses + gagal).

---

## 8. Contoh Pernyataan ke Mahasiswa

> Kelas ini menggunakan Express sebagai jalur utama. Namun mahasiswa yang membutuhkan jalur transisi dapat menggunakan PHP dengan syarat memenuhi API contract, fitur, dan standar kualitas yang sama. Penilaian akan berfokus pada konsep backend, bukan pada framework yang dipilih.

---

## 9. Rekomendasi Implementasi Bertahap (Opsional)

- Semester berjalan: tetap Express-first, PHP sebagai opsi transisi terbatas.
- Semester berikutnya: siapkan modul PHP track setara untuk Minggu 7, 9, 10.
- Evaluasi akhir: bandingkan kualitas output proyek dan beban pengajaran.

---

Dokumen ini adalah draft. Bagian bobot, endpoint wajib, dan batas waktu pemilihan track dapat disesuaikan kebijakan kelas.