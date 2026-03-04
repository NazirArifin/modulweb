# Modul 7 - Backend & Data Persistence (Pertemuan 1)

Tujuan Pembelajaran: Mahasiswa mampu membangun API dasar menggunakan Node.js, Express, dan TypeScript dengan struktur proyek yang rapi, pola request-response berbasis controller, koneksi database awal, model dasar, serta endpoint CRUD sederhana.

## Persiapan

Pastikan perangkat sudah siap:
- Node.js versi LTS
- npm
- Database MariaDB aktif (lokal atau server)
- API client (Postman/Insomnia/Thunder Client)

Inisialisasi proyek:

```bash
npm init -y
npm install express sequelize mariadb
npm install -D typescript ts-node @types/node @types/express
npx tsc --init
```

Saran pengaturan dasar `tsconfig.json`:
- `target`: `ES2020`
- `module`: `ESNext`
- `strict`: `true`
- `rootDir`: `src`
- `outDir`: `dist`

---

## Materi

### 1) Gambaran Arsitektur Backend Sederhana

Alur umum aplikasi backend:
1. Client mengirim HTTP request.
2. Router memilih endpoint yang sesuai.
3. Controller memproses request.
4. Model/database menangani simpan/ambil data.
5. Server mengembalikan response JSON.

Pemisahan layer ini penting agar kode mudah dirawat dan dikembangkan.

---

### 2) Struktur Proyek Express + TypeScript

Contoh struktur yang direkomendasikan:

```text
src/
  index.ts
  database.ts
  models/
    Mahasiswa.ts
  controllers/
    mahasiswaController.ts
  routes/
    mahasiswaRoutes.ts
```

Penjelasan singkat:
- `index.ts`: entry point aplikasi
- `routes`: definisi endpoint
- `controllers`: logika request-response
- `models`: definisi entitas/tabel
- `database.ts`: konfigurasi koneksi database

---

### 3) Routing dan Request-Response Dasar

Contoh route sederhana:

```typescript
import express, { Request, Response } from 'express';

const app = express();
app.use(express.json());

app.get('/health', (req: Request, res: Response) => {
  return res.status(200).json({ message: 'API aktif' });
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

export async function getAllMahasiswa(req: Request, res: Response) {
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

### 5) Koneksi Database dari Backend

Contoh file `database.ts`:

```typescript
import { Sequelize } from 'sequelize';

export const sequelize = new Sequelize('db_modulweb', 'root', 'password', {
  host: 'localhost',
  dialect: 'mariadb',
  logging: false
});
```

Contoh pengujian koneksi saat startup:

```typescript
async function connectDatabase() {
  try {
    await sequelize.authenticate();
    console.log('Koneksi database berhasil');
  } catch (error) {
    console.error('Koneksi database gagal:', error);
    process.exit(1);
  }
}
```

---

### 6) Model Dasar dengan Sequelize

Contoh model `Mahasiswa`:

```typescript
import { DataTypes, Model, Optional } from 'sequelize';
import { sequelize } from '../database';

interface MahasiswaAttributes {
  id: number;
  nama: string;
  npm: string;
  email: string;
}

interface MahasiswaCreation extends Optional<MahasiswaAttributes, 'id'> {}

export class Mahasiswa extends Model<MahasiswaAttributes, MahasiswaCreation>
  implements MahasiswaAttributes {
  public id!: number;
  public nama!: string;
  public npm!: string;
  public email!: string;
}

Mahasiswa.init(
  {
    id: { type: DataTypes.INTEGER.UNSIGNED, autoIncrement: true, primaryKey: true },
    nama: { type: DataTypes.STRING, allowNull: false },
    npm: { type: DataTypes.STRING, allowNull: false, unique: true },
    email: { type: DataTypes.STRING, allowNull: false, validate: { isEmail: true } }
  },
  { sequelize, modelName: 'mahasiswa', tableName: 'mahasiswa' }
);
```

---

### 7) API Endpoint CRUD Sederhana

Daftar endpoint minimum:
- `GET /mahasiswa`
- `GET /mahasiswa/:id`
- `POST /mahasiswa`
- `PUT /mahasiswa/:id`
- `DELETE /mahasiswa/:id`

Contoh ringkas controller CRUD:

```typescript
import { Request, Response, NextFunction } from 'express';
import { Mahasiswa } from '../models/Mahasiswa';

export async function getAll(req: Request, res: Response, next: NextFunction) {
  try {
    const data = await Mahasiswa.findAll();
    return res.json(data);
  } catch (error) {
    return next(error);
  }
}

export async function getById(req: Request, res: Response, next: NextFunction) {
  try {
    const data = await Mahasiswa.findByPk(req.params.id);
    if (!data) return res.status(404).json({ message: 'Mahasiswa tidak ditemukan' });
    return res.json(data);
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

    const created = await Mahasiswa.create({ nama, npm, email });
    return res.status(201).json(created);
  } catch (error) {
    return next(error);
  }
}
```

---

### 8) Integrasi Route, Controller, dan Server

Contoh `routes/mahasiswaRoutes.ts`:

```typescript
import { Router } from 'express';
import * as mahasiswaController from '../controllers/mahasiswaController';

const router = Router();

router.get('/', mahasiswaController.getAll);
router.get('/:id', mahasiswaController.getById);
router.post('/', mahasiswaController.create);
router.put('/:id', mahasiswaController.update);
router.delete('/:id', mahasiswaController.remove);

export default router;
```

Contoh `index.ts`:

```typescript
import express from 'express';
import mahasiswaRoutes from './routes/mahasiswaRoutes';
import { sequelize } from './database';

const app = express();
app.use(express.json());

app.use('/mahasiswa', mahasiswaRoutes);

sequelize.sync().then(() => {
  app.listen(3000, () => {
    console.log('Server berjalan di http://localhost:3000');
  });
});
```

---

## Praktikum

### Tugas Praktikum 1 - Setup Proyek dan Struktur

1. Inisialisasi proyek Express + TypeScript.
2. Buat struktur folder `routes`, `controllers`, `models`, `database`.
3. Buat endpoint `GET /health` untuk cek server aktif.

Checklist:
- server berjalan normal
- endpoint `GET /health` mengembalikan status 200
- struktur proyek sesuai standar modul

### Tugas Praktikum 2 - Koneksi Database dan Model Dasar

1. Konfigurasikan koneksi Sequelize ke MariaDB.
2. Buat model `Mahasiswa` (nama, npm, email).
3. Jalankan `sequelize.sync()` dan verifikasi tabel terbentuk.

Checklist:
- koneksi database sukses
- tabel `mahasiswa` terbentuk
- validasi dasar model aktif

### Tugas Praktikum 3 - CRUD API Sederhana

1. Implementasi endpoint CRUD `mahasiswa`.
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
   - Sequelize + MariaDB

2. Fitur minimum:
   - endpoint CRUD `mahasiswa`
   - validasi field wajib (`nama`, `npm`, `email`)
   - cek data tidak ditemukan pada endpoint detail/update/delete

3. Struktur kode:
   - pisahkan `routes`, `controllers`, `models`, `database`
   - gunakan pola request-response yang rapi

4. Output pengumpulan:
   - source code backend,
   - dokumentasi endpoint singkat,
   - screenshot pengujian minimal 5 request.

Catatan: modul ini menjadi fondasi untuk modul minggu berikutnya (pendalaman query, relasi, dan error handling lanjutan).
