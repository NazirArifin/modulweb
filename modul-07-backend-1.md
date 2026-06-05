# Modul 7 - Backend & Data Persistence (Pertemuan 1)

Tujuan Pembelajaran: Mahasiswa mampu membangun API dasar menggunakan Node.js, Express, dan TypeScript dengan struktur proyek yang rapi, pola request-response berbasis controller, koneksi database awal, schema dasar menggunakan Drizzle ORM, serta endpoint CRUD sederhana.

## Persiapan

Pastikan perangkat sudah siap:
- Node.js versi LTS
- npm
- Database MariaDB aktif (lokal atau server)
- API client (Postman/Insomnia/Thunder Client)

Inisialisasi proyek:

```bash
npm init -y
npm install express drizzle-orm mysql2 multer
npm install -D typescript ts-node tsx drizzle-kit @types/node @types/express @types/multer
npx tsc --init
```

Saran pengaturan dasar `tsconfig.json`:
- `target`: `ES2025`
- `module`: `nodenext`
- `strict`: `true`
- `rootDir`: `src`
- `outDir`: `dist`
- Tambahkan `include`: `["src/**/*.ts"]` di bagian bawah untuk memastikan semua file TypeScript di dalam folder `src` terkompilasi.

Tambahkan script di `package.json` untuk menjalankan server dan migration:

```json
  ...
  "scripts": {
    "dev": "tsx watch src/index.ts",
    "build": "tsc -p tsconfig.json",
    "start": "node dist/index.js",
    "db:generate": "drizzle-kit generate",
    "db:migrate": "drizzle-kit migrate",
    "db:seed": "tsx src/db/seeds/seedMahasiswa.ts",
    "test": "echo \"Error: no test specified\" && exit 1"
  },
  ...
```

---

## Materi

### 1) Gambaran Arsitektur Backend Sederhana

Alur umum aplikasi backend:
1. Client mengirim HTTP request.
2. Router memilih endpoint yang sesuai.
3. Controller memproses request.
4. Layer data (Drizzle + database) menangani simpan/ambil data.
5. Server mengembalikan response JSON.

Pemisahan layer ini penting agar kode mudah dirawat dan dikembangkan.

---

### 2) Struktur Proyek Express + TypeScript + Drizzle

Contoh struktur yang direkomendasikan:

```text
src/
  index.ts
  controllers/
    mahasiswaController.ts
  routes/
    mahasiswaRoutes.ts
  db/
    index.ts
    schema.ts
    seeds/
      seedMahasiswa.ts
drizzle.config.ts
```

Penjelasan singkat:
- `index.ts`: entry point aplikasi
- `routes`: definisi endpoint
- `controllers`: logika request-response
- `db/schema.ts`: definisi tabel dan tipe data
- `db/index.ts`: koneksi database dan inisialisasi Drizzle
- `db/seeds`: script data awal/dummy untuk development dan pengujian
- `drizzle.config.ts`: konfigurasi migration

---

### 3) Routing dan Request-Response Dasar

Contoh route sederhana di `index.ts`:

```typescript
import express from 'express';

const app = express();
const port = 3000;

app.get('/', (_req, res) => {
  res.json({ message: 'Hello, World!' });
});

app.listen(port, () => {
  console.log(`Server berjalan di http://localhost:${port}`);
});
```

Objek request yang sering dipakai:
- `req.params` untuk parameter URL
- `req.query` untuk query string
- `req.body` untuk data JSON

Objek response yang sering dipakai:
- `res.status(code)` untuk status HTTP
- `res.json(data)` untuk mengirim JSON

---

### 4) Pola Controller

Controller berisi logika endpoint, bukan konfigurasi server.

Contoh controller:

```typescript
import { Request, Response } from 'express';

export async function getAllMahasiswa(_req: Request, res: Response) {
  return res.json({ message: 'Daftar mahasiswa' });
}

export async function createMahasiswa(req: Request, res: Response) {
  const { nama, npm } = req.body;
  if (!nama || !npm) {
    return res.status(400).json({ message: 'nama dan npm wajib diisi' });
  }

  return res.status(201).json({ message: 'Mahasiswa dibuat', data: { nama, npm } });
}
```

Keuntungan pola ini:
- route lebih bersih,
- logika mudah diuji,
- memudahkan refactor saat aplikasi membesar.

---

### 5) Koneksi Database dengan Drizzle

Contoh file `src/db/index.ts`:

```typescript
import mysql from 'mysql2/promise';
import { drizzle } from 'drizzle-orm/mysql2';
import * as schema from './schema.js';

const pool = mysql.createPool({
  host: 'localhost',
  user: 'root',
  password: 'password',
  database: 'modul_web',
  connectionLimit: 10
});

export const db = drizzle(pool, { schema, mode: 'default' });
```

Contoh pengujian koneksi saat startup:

```typescript
import { db } from './db';
import { sql } from 'drizzle-orm';

async function connectDatabase() {
  try {
    await db.execute(sql`SELECT 1`);
    console.log('Koneksi database berhasil');
  } catch (error) {
    console.error('Koneksi database gagal:', error);
    process.exit(1);
  }
}
```

---

### 6) Schema Dasar dengan Drizzle

Contoh schema tabel `mahasiswa` di `src/db/schema.ts`:

```typescript
import { int, mysqlTable, varchar } from 'drizzle-orm/mysql-core';

export const mahasiswa = mysqlTable('mahasiswa', {
  id: int('id').autoincrement().primaryKey(),
  nama: varchar('nama', { length: 100 }).notNull(),
  npm: varchar('npm', { length: 20 }).notNull().unique(),
  email: varchar('email', { length: 100 }).notNull().unique()
});
```

Contoh `drizzle.config.ts`:

```typescript
import { defineConfig } from 'drizzle-kit';

export default defineConfig({
  schema: './src/db/schema.ts',
  out: './drizzle',
  dialect: 'mysql',
  dbCredentials: {
    host: 'localhost',
    user: 'root',
    password: 'password',
    database: 'modul_web'
  }
});
```

Jalankan migration:

```bash
npm run db:generate
npm run db:migrate
```

### 7) Seeder Data Awal

Seeder digunakan untuk mengisi data awal agar:
- pengujian endpoint lebih cepat,
- data demo seragam antar perangkat mahasiswa,
- tidak perlu input manual berulang setelah database di-reset.

Contoh file `src/db/seeds/seedMahasiswa.ts`:

```typescript
import { db } from '../index.js';
import { mahasiswa } from '../schema.js';

async function seedMahasiswa() {
  await db.insert(mahasiswa as any).values([
    { nama: 'Andi Pratama', npm: '2301001', email: 'andi@example.com' },
    { nama: 'Budi Santoso', npm: '2301002', email: 'budi@example.com' },
    { nama: 'Citra Lestari', npm: '2301003', email: 'citra@example.com' }
  ]);

  console.log('Seeder mahasiswa selesai dijalankan');
}

seedMahasiswa()
.then(() => process.exit(0))
.catch((error) => {
  console.error('Seeder gagal:', error);
  process.exit(1);
});
```

Jalankan seeder:

```bash
npm run db:seed
```

Tips penting:
- Jalankan migration terlebih dahulu sebelum seeder.
- Untuk mencegah data duplikat, gunakan email/npm unik atau bersihkan data sebelum insert.
- Simpan seeder terpisah per entitas jika proyek mulai membesar.

---

### 8) API Endpoint CRUD Sederhana

Daftar endpoint minimum:
- `GET /mahasiswa`
- `GET /mahasiswa/:id`
- `POST /mahasiswa`
- `PUT /mahasiswa/:id`
- `DELETE /mahasiswa/:id`

Contoh ringkas controller CRUD dengan Drizzle:

```typescript
import type { Request, Response, NextFunction } from 'express';
import { eq } from 'drizzle-orm';
import { db } from '../db/index.js';
import { mahasiswa } from '../db/schema.js';

function isValidEmail(email: string) {
  return /^\S+@\S+\.\S+$/.test(email);
}

export async function getAll(_req: Request, res: Response, next: NextFunction) {
  try {
    const data = await db.select().from(mahasiswa);
    return res.json(data);
  } catch (error) {
    return next(error);
  }
}

export async function getById(req: Request, res: Response, next: NextFunction) {
  try {
    const id = Number(req.params.id);
    if (Number.isNaN(id)) {
      return res.status(400).json({ message: 'id harus berupa angka' });
    }

    const data = await db.select().from(mahasiswa).where(eq(mahasiswa.id, id)).limit(1);
    if (!data[0]) {
      return res.status(404).json({ message: 'Mahasiswa tidak ditemukan' });
    }

    return res.json(data[0]);
  } catch (error) {
    return next(error);
  }
}

export async function create(req: Request, res: Response, next: NextFunction) {
  try {
    const { nama, npm, email } = req.body;

    if (!nama || !npm || !email) {
      return res.status(400).json({ message: 'nama, npm, email wajib diisi' });
    }

    if (!isValidEmail(email)) {
      return res.status(400).json({ message: 'format email tidak valid' });
    }

    await db.insert(mahasiswa).values({ nama, npm, email });
    const created = await db.select().from(mahasiswa).where(eq(mahasiswa.npm, npm)).limit(1);

    return res.status(201).json(created[0]);
  } catch (error) {
    return next(error);
  }
}

export async function update(req: Request, res: Response, next: NextFunction) {
  try {
    const id = Number(req.params.id);
    if (Number.isNaN(id)) {
      return res.status(400).json({ message: 'id harus berupa angka' });
    }

    const { nama, npm, email } = req.body;
    if (!nama || !npm || !email) {
      return res.status(400).json({ message: 'nama, npm, email wajib diisi' });
    }

    if (!isValidEmail(email)) {
      return res.status(400).json({ message: 'format email tidak valid' });
    }

    const existing = await db.select().from(mahasiswa).where(eq(mahasiswa.id, id)).limit(1);
    if (!existing[0]) {
      return res.status(404).json({ message: 'Mahasiswa tidak ditemukan' });
    }

    await db.update(mahasiswa).set({ nama, npm, email }).where(eq(mahasiswa.id, id));
    const updated = await db.select().from(mahasiswa).where(eq(mahasiswa.id, id)).limit(1);
    return res.json(updated[0]);
  } catch (error) {
    return next(error);
  }
}

export async function remove(req: Request, res: Response, next: NextFunction) {
  try {
    const id = Number(req.params.id);
    if (Number.isNaN(id)) {
      return res.status(400).json({ message: 'id harus berupa angka' });
    }

    const existing = await db.select().from(mahasiswa).where(eq(mahasiswa.id, id)).limit(1);
    if (!existing[0]) {
      return res.status(404).json({ message: 'Mahasiswa tidak ditemukan' });
    }

    await db.delete(mahasiswa).where(eq(mahasiswa.id, id));
    return res.json({ message: 'Mahasiswa berhasil dihapus' });
  } catch (error) {
    return next(error);
  }
}
```

---

### 9) Integrasi Route, Controller, dan Server

Contoh `routes/mahasiswaRoutes.ts`:

```typescript
import { Router } from 'express';
import multer from 'multer';
import * as mahasiswaController from '../controllers/mahasiswaController';

const router: Router = Router();
const upload = multer();

router.get('/', mahasiswaController.getAll);
router.get('/:id', mahasiswaController.getById);
router.post('/', upload.none(), mahasiswaController.create);
router.put('/:id', upload.none(), mahasiswaController.update);
router.delete('/:id', mahasiswaController.remove);

export default router;
```

Contoh `index.ts`:

```typescript
import express from 'express';
import { sql } from 'drizzle-orm';
import mahasiswaRoutes from './routes/mahasiswaRoutes.js';
import { db } from './db/index.js';

const app = express();
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

app.get('/health', async (_req, res) => {
  try {
    await db.execute(sql`SELECT 1`);
    return res.json({ status: 'ok' });
  } catch {
    return res.status(500).json({ status: 'error' });
  }
});

app.use('/mahasiswa', mahasiswaRoutes);

app.listen(3000, () => {
  console.log('Server berjalan di http://localhost:3000');
});
```

---

## Praktikum

### Tugas Praktikum 1 - Setup Proyek dan Struktur

1. Inisialisasi proyek Express + TypeScript + Drizzle.
2. Buat struktur folder `routes`, `controllers`, `db`.
3. Buat endpoint `GET /health` untuk cek server aktif.

Checklist:
- server berjalan normal
- endpoint `GET /health` mengembalikan status 200
- struktur proyek sesuai standar modul

### Tugas Praktikum 2 - Koneksi Database dan Schema Dasar

1. Konfigurasikan koneksi Drizzle ke MariaDB.
2. Buat schema tabel `mahasiswa` (nama, npm, email).
3. Jalankan migration Drizzle dan verifikasi tabel terbentuk.
4. Buat dan jalankan seeder untuk minimal 3 data mahasiswa.

Checklist:
- koneksi database sukses
- tabel `mahasiswa` terbentuk
- migration berhasil dijalankan
- data awal berhasil masuk melalui seeder

### Tugas Praktikum 3 - CRUD API Sederhana

1. Implementasi endpoint CRUD `mahasiswa` dengan Drizzle.
2. Pisahkan route dan controller.
3. Uji endpoint menggunakan Postman/Insomnia.

Checklist:
- `GET`, `POST`, `PUT`, `DELETE` berjalan
- status code sesuai (`200`, `201`, `400`, `404`)
- response JSON konsisten

---

## Tugas

Buat API sederhana manajemen mahasiswa dengan ketentuan berikut:

1. Teknologi:
   - Node.js + Express + TypeScript
   - Drizzle ORM + MariaDB

2. Fitur minimum:
   - endpoint CRUD `mahasiswa`
   - validasi field wajib (`nama`, `npm`, `email`)
   - cek data tidak ditemukan pada endpoint detail/update/delete

3. Struktur kode:
   - pisahkan `routes`, `controllers`, `db`
   - gunakan pola request-response yang rapi
   - gunakan migration Drizzle untuk pembentukan tabel

4. Output pengumpulan:
   - source code backend,
   - dokumentasi endpoint singkat,
   - screenshot pengujian minimal 5 request.

Catatan: modul ini menjadi fondasi untuk modul minggu berikutnya (pendalaman query, relasi, dan error handling lanjutan).
