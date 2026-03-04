# Modul 13 - Fullstack Project: Integrasi Frontend & Backend

Tujuan Pembelajaran: Mahasiswa mampu membangun aplikasi fullstack sederhana dengan mengintegrasikan frontend (Svelte) dan backend (Express), termasuk alur login, konsumsi API, serta persiapan deployment.

## Materi

### 1) Gambaran Arsitektur Fullstack

Pada tahap ini, frontend dan backend tidak lagi diuji terpisah, melainkan dijalankan sebagai satu alur fitur.

Alur umum:
1. User berinteraksi lewat UI (frontend).
2. Frontend mengirim request HTTP ke backend.
3. Backend memproses request, mengakses database, lalu mengembalikan response JSON.
4. Frontend menampilkan hasil/feedback ke user.

Contoh pembagian tanggung jawab:
- Frontend: tampilan, state UI, validasi ringan, navigasi.
- Backend: autentikasi, validasi utama, aturan bisnis, akses database.

---

### 2) Integrasi Frontend ↔ Backend

#### A. CORS pada backend

Jika frontend dan backend berjalan di origin berbeda, backend harus mengizinkan origin frontend.

```typescript
import cors from 'cors';

app.use(cors({
	origin: 'http://localhost:5173',
	credentials: true
}));
```

#### B. Base URL API pada frontend

Gunakan base URL agar endpoint mudah dikelola:

```javascript
const API_BASE = 'http://localhost:3000';

export async function getMahasiswa() {
	const res = await fetch(`${API_BASE}/mahasiswa`);
	if (!res.ok) throw new Error('Gagal mengambil data');
	return res.json();
}
```

#### C. Gunakan environment variable

- Frontend (Vite): `VITE_API_BASE_URL`
- Backend: `PORT`, `DB_HOST`, `DB_USER`, `DB_PASSWORD`, `JWT_SECRET`

Contoh frontend:

```javascript
const API_BASE = import.meta.env.VITE_API_BASE_URL;
```

---

### 3) Login Flow (JWT) End-to-End

Flow login yang direkomendasikan:
1. User isi email/password pada frontend.
2. Frontend kirim `POST /login`.
3. Backend verifikasi kredensial dan kirim token JWT.
4. Frontend simpan token (state + localStorage).
5. Token dikirim pada request endpoint terproteksi (`Authorization: Bearer <token>`).

Contoh request login:

```javascript
async function login(email, password) {
	const res = await fetch(`${API_BASE}/login`, {
		method: 'POST',
		headers: { 'Content-Type': 'application/json' },
		body: JSON.stringify({ email, password })
	});

	if (!res.ok) throw new Error('Email atau password salah');
	const data = await res.json();
	localStorage.setItem('token', data.token);
	return data;
}
```

Contoh request terproteksi:

```javascript
async function getProtectedData() {
	const token = localStorage.getItem('token');

	const res = await fetch(`${API_BASE}/mahasiswa`, {
		headers: { Authorization: `Bearer ${token}` }
	});

	if (!res.ok) throw new Error('Unauthorized');
	return res.json();
}
```

---

### 4) API Integration Pattern di Frontend

Pola sederhana yang disarankan:
- `loading`: tampilkan indikator proses
- `success`: tampilkan data
- `error`: tampilkan pesan yang ramah pengguna

Contoh struktur state:

```javascript
let state = {
	loading: false,
	error: '',
	data: []
};
```

Prinsip penting:
- Selalu cek `response.ok`.
- Tangani error `try...catch`.
- Jangan langsung menampilkan pesan error mentah dari server tanpa filter.

---

### 5) Sinkronisasi Fitur End-to-End

Agar integrasi stabil, cocokkan kontrak API antara frontend dan backend:

- Method: `GET/POST/PUT/DELETE`
- Path: `/mahasiswa`, `/mahasiswa/:id`
- Body request: field wajib dan format
- Response: bentuk JSON konsisten
- Status code: `200`, `201`, `400`, `401`, `404`, `500`

Contoh response sukses:

```json
{
	"message": "Data berhasil diambil",
	"data": [
		{ "id": 1, "nama": "Budi" }
	]
}
```

Contoh response error:

```json
{
	"message": "Validasi gagal",
	"errors": ["nama wajib diisi"]
}
```

---

### 6) Persiapan Deployment Dasar

Walau deployment detail dibahas minggu 14, pada minggu ini aplikasi sebaiknya sudah **deployment-ready**:

- gunakan `.env` untuk konfigurasi sensitif,
- hindari hardcode URL lokal di source produksi,
- pastikan script `build` dan `start` berjalan,
- uji mode production build minimal sekali.

Contoh script backend:

```json
{
	"scripts": {
		"dev": "ts-node src/index.ts",
		"build": "tsc",
		"start": "node dist/index.js"
	}
}
```

---

## Praktikum

### Tugas Praktikum 1 - Menyatukan Proyek Frontend & Backend

Target output: frontend dapat memanggil endpoint backend secara sukses.

Langkah:
1. Jalankan backend (`localhost:3000`) dan frontend (`localhost:5173`).
2. Aktifkan CORS di backend.
3. Buat service API di frontend (`api.js`/`api.ts`) untuk endpoint list data.
4. Tampilkan data backend di halaman frontend.

Checklist:
- request API berhasil
- data tampil di UI
- tidak ada error CORS

### Tugas Praktikum 2 - Login dan Akses Endpoint Terproteksi

Target output: user bisa login dan mengakses data terproteksi.

Langkah:
1. Buat form login di frontend.
2. Kirim kredensial ke endpoint `/login`.
3. Simpan token ke state + localStorage.
4. Gunakan token saat memanggil endpoint protected.
5. Tambahkan fitur logout (hapus token dan redirect).

Checklist:
- login sukses menghasilkan token
- endpoint protected bisa diakses setelah login
- logout mengembalikan user ke mode guest

### Tugas Praktikum 3 - Integrasi CRUD End-to-End

Target output: minimal 1 entitas dapat di-CRUD dari frontend ke backend.

Langkah:
1. Buat halaman list data.
2. Tambahkan form create dan update.
3. Tambahkan aksi delete dengan konfirmasi.
4. Tampilkan notifikasi sukses/gagal.
5. Tangani loading dan error state.

Checklist:
- create/update/delete benar-benar mengubah data server
- UI otomatis refresh setelah aksi
- status error ditampilkan dengan jelas

---

## Tugas

Buat mini aplikasi fullstack sederhana dengan ketentuan berikut:

1. Fitur wajib:
	 - login,
	 - menampilkan data dari API,
	 - minimal 2 operasi CRUD (misal create + delete),
	 - logout.

2. Ketentuan teknis:
	 - frontend dan backend terpisah project/folder,
	 - autentikasi menggunakan JWT,
	 - endpoint protected hanya bisa diakses setelah login,
	 - gunakan environment variable untuk konfigurasi utama.

3. Kualitas implementasi:
	 - response API konsisten,
	 - error handling end-to-end (frontend dan backend),
	 - struktur folder rapi dan mudah dipahami.

4. Output pengumpulan:
	 - source code frontend + backend,
	 - file `.env.example`,
	 - dokumentasi singkat setup project,
	 - screenshot/rekaman uji fitur login + integrasi API.

Catatan: Modul ini menjadi jembatan menuju Modul 14 (deployment) dan Modul 15 (final project).
