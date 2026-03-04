# Modul 14 - Deployment & DevOps Dasar

Tujuan Pembelajaran: Mahasiswa mampu melakukan deployment aplikasi frontend dan backend ke layanan cloud sehingga aplikasi dapat diakses publik secara stabil dan aman.

## Materi

### 1) Konsep Deployment Aplikasi Web

Deployment adalah proses memindahkan aplikasi dari lingkungan lokal ke server online agar bisa diakses pengguna melalui internet.

Dalam proyek fullstack, ada dua komponen utama:
- **Frontend** (misalnya Svelte/Vite) untuk tampilan aplikasi.
- **Backend** (misalnya Express + database) untuk API dan logika bisnis.

Pola deployment yang umum:
- frontend di-host di platform static hosting (Vercel/Netlify),
- backend di-host di platform server hosting (Render/Railway),
- database di layanan managed database atau server terpisah.

---

### 2) Checklist Production Readiness

Sebelum deploy, pastikan:

1. **Konfigurasi environment variable** sudah dipisah dari source code.
2. **Build aplikasi sukses** tanpa error.
3. **CORS** backend mengizinkan domain frontend production.
4. Endpoint API production sudah dipakai frontend (bukan `localhost`).
5. Error handling sudah menutup informasi sensitif.
6. README setup singkat tersedia.

Contoh `.env.example` backend:

```env
PORT=3000
DB_HOST=localhost
DB_USER=root
DB_PASSWORD=your_password
DB_NAME=db_modulweb
JWT_SECRET=your_secret
FRONTEND_URL=https://nama-app.vercel.app
```

Contoh `.env` frontend (Vite):

```env
VITE_API_BASE_URL=https://your-backend.onrender.com
```

---

### 3) Build Process dan Verifikasi Lokal

Sebelum upload ke cloud, uji mode production di lokal.

Frontend:

```bash
npm run build
npm run preview
```

Backend:

```bash
npm run build
npm start
```

Hal yang dicek:
- aplikasi tetap berjalan setelah build,
- tidak ada path asset yang rusak,
- API tetap merespons normal,
- autentikasi tetap berfungsi.

---

### 4) Deployment Frontend ke Vercel/Netlify

#### A. Vercel (umum untuk Vite/Svelte)

Langkah umum:
1. Push project frontend ke GitHub.
2. Import repository ke Vercel.
3. Set **Build Command**: `npm run build`.
4. Set **Output Directory**: `dist`.
5. Tambahkan environment variable `VITE_API_BASE_URL`.
6. Deploy dan uji domain yang diberikan.

#### B. Netlify (alternatif)

Langkah umum hampir sama:
1. Import repo frontend.
2. Build command: `npm run build`.
3. Publish directory: `dist`.
4. Tambahkan environment variable.

Catatan:
- setiap kali push ke branch utama, deployment otomatis berjalan.

---

### 5) Deployment Backend ke Render/Railway

#### A. Render

Langkah umum:
1. Push project backend ke GitHub.
2. Buat **Web Service** di Render dari repository.
3. Set **Build Command**: `npm install && npm run build`.
4. Set **Start Command**: `npm start`.
5. Tambahkan semua environment variable backend.
6. Deploy lalu uji endpoint health check.

#### B. Railway

Langkah umum:
1. Buat project dari GitHub repo.
2. Tambahkan variables environment.
3. Railway biasanya auto-detect Node app.
4. Pastikan command start sesuai script.

Catatan penting backend:
- jangan hardcode port, gunakan `process.env.PORT`.
- CORS harus mengizinkan domain frontend deployment.

Contoh CORS production:

```typescript
app.use(cors({
  origin: process.env.FRONTEND_URL,
  credentials: true
}));
```

---

### 6) Integrasi Domain Frontend dan Backend

Setelah keduanya live:
- update `VITE_API_BASE_URL` frontend dengan URL backend production,
- redeploy frontend,
- uji alur end-to-end (login, list data, create/update/delete).

Checklist pengujian cepat:
1. Frontend bisa dibuka publik.
2. Endpoint backend bisa diakses publik.
3. Login berhasil dan token dipakai untuk endpoint protected.
4. CRUD dari frontend benar-benar mengubah data backend.

---

### 7) Troubleshooting Umum Saat Deployment

Masalah yang sering terjadi:

1. **CORS error**
	- penyebab: origin frontend belum diizinkan di backend.
	- solusi: update `FRONTEND_URL` + konfigurasi cors.

2. **Build failed**
	- penyebab: versi Node tidak cocok, dependency kurang.
	- solusi: cek log build, sesuaikan versi Node dan package.

3. **API masih mengarah localhost**
	- penyebab: env frontend belum diperbarui.
	- solusi: update `VITE_API_BASE_URL` lalu redeploy.

4. **Error 500 pada backend**
	- penyebab: env database salah / koneksi DB gagal.
	- solusi: cek credentials, host, dan log server.

5. **JWT invalid di production**
	- penyebab: `JWT_SECRET` berbeda antar environment.
	- solusi: pastikan secret konsisten di service backend.

---

### 8) Pengenalan Docker Dasar (Opsional)

Docker membungkus aplikasi dan dependensinya ke dalam container agar lingkungan eksekusi konsisten.

Contoh Dockerfile backend sederhana:

```dockerfile
FROM node:20-alpine
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build
CMD ["npm", "start"]
```

Docker bersifat opsional di modul ini, namun penting untuk deployment yang lebih terstandar.

---

## Praktikum

### Tugas Praktikum 1 - Persiapan Deployment

Target output: project siap deploy dengan konfigurasi rapi.

Langkah:
1. Buat `.env.example` untuk frontend dan backend.
2. Pastikan script `build` dan `start` berfungsi.
3. Tambahkan endpoint health check backend (`GET /health`).
4. Uji build production di lokal.

Checklist:
- `.env.example` tersedia
- build sukses
- health check aktif

### Tugas Praktikum 2 - Deploy Frontend

Target output: frontend live di Vercel atau Netlify.

Langkah:
1. Deploy frontend ke Vercel/Netlify.
2. Set environment variable `VITE_API_BASE_URL`.
3. Uji halaman utama dan fitur login.

Checklist:
- URL frontend dapat diakses publik
- tidak ada broken asset
- request API terkirim ke backend production

### Tugas Praktikum 3 - Deploy Backend

Target output: backend live di Render atau Railway.

Langkah:
1. Deploy backend ke Render/Railway.
2. Set environment variable backend (`PORT`, DB, JWT, FRONTEND_URL).
3. Uji endpoint `GET /health` dan endpoint protected.
4. Integrasikan dengan frontend yang sudah live.

Checklist:
- URL backend aktif
- endpoint API merespons benar
- CORS tidak bermasalah

---

## Tugas

Deploy mini aplikasi fullstack Anda ke internet dengan ketentuan berikut:

1. **Frontend**
	- deploy ke Vercel atau Netlify,
	- gunakan env `VITE_API_BASE_URL`.

2. **Backend**
	- deploy ke Render atau Railway,
	- gunakan environment variable untuk semua konfigurasi sensitif,
	- sediakan endpoint health check.

3. **Integrasi End-to-End**
	- login harus berfungsi di domain production,
	- minimal 1 fitur CRUD harus berjalan dari frontend ke backend,
	- tampilkan error yang ramah pengguna jika request gagal.

4. **Output Pengumpulan**
	- URL frontend live,
	- URL backend live,
	- repository source code,
	- `.env.example` frontend & backend,
	- screenshot pengujian minimal 5 skenario (login sukses/gagal, list data, create/update/delete, logout).

Catatan: Modul ini menyiapkan proyek Anda untuk finalisasi pada Modul 15 (Final Project & Presentasi).
