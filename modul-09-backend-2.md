# Modul 9 - Backend & Data Persistence (Pertemuan 2)

Tujuan Pembelajaran: Mahasiswa mampu mengelola data aplikasi secara konsisten dari API ke database dengan fokus pada pendalaman query, relasi data, ORM, validasi, error handling, dan integrasi controller-database end-to-end.

## Materi

### 1) Review Singkat Pertemuan Sebelumnya

Pada pertemuan sebelumnya, kita sudah membangun API CRUD dasar dengan Node.js + Express + TypeScript dan menghubungkannya ke database.

Pada pertemuan ini, fokus kita adalah:
- query data yang lebih kompleks,
- relasi antar tabel,
- validasi di layer data,
- pola error handling yang konsisten,
- alur endpoint dari request sampai response.

---

### 2) Konfigurasi Koneksi ORM (Drizzle + MariaDB)

Instal dependensi utama:

```bash
npm install drizzle-orm mysql2
npm install -D drizzle-kit
```

Contoh koneksi:

```typescript
import mysql from 'mysql2/promise';
import { drizzle } from 'drizzle-orm/mysql2';
import * as schema from './schema';

const pool = mysql.createPool({
  host: 'localhost',
  user: 'root',
  password: 'password',
  database: 'db_modulweb',
  connectionLimit: 10
});

export const db = drizzle(pool, { schema, mode: 'default' });
```

Saran:
- gunakan environment variable untuk kredensial,
- gunakan migration Drizzle agar skema konsisten,
- selalu tangani error koneksi saat aplikasi startup.

---

### 3) Desain Model dan Relasi Data

Kasus: satu **Dosen** dapat mengampu banyak **MataKuliah** (One-to-Many).

#### A. Definisi schema `Dosen`

```typescript
import { int, mysqlTable, varchar } from 'drizzle-orm/mysql-core';

export const dosen = mysqlTable('dosen', {
  id: int('id').autoincrement().primaryKey(),
  nama: varchar('nama', { length: 100 }).notNull(),
  email: varchar('email', { length: 100 }).notNull().unique()
});
```

#### B. Definisi schema `MataKuliah`

```typescript
import { int, mysqlTable, varchar } from 'drizzle-orm/mysql-core';
import { dosen } from './dosen';

export const mataKuliah = mysqlTable('mata_kuliah', {
  id: int('id').autoincrement().primaryKey(),
  nama: varchar('nama', { length: 120 }).notNull(),
  sks: int('sks').notNull(),
  dosenId: int('dosen_id')
    .notNull()
    .references(() => dosen.id)
});
```

#### C. Definisi relasi

```typescript
import { relations } from 'drizzle-orm';
import { dosen } from './dosen';
import { mataKuliah } from './mataKuliah';

export const dosenRelations = relations(dosen, ({ many }) => ({
  mataKuliah: many(mataKuliah)
}));

export const mataKuliahRelations = relations(mataKuliah, ({ one }) => ({
  dosen: one(dosen, {
    fields: [mataKuliah.dosenId],
    references: [dosen.id]
  })
}));
```

Catatan:
- nama kolom foreign key sebaiknya eksplisit (mis. `dosen_id`),
- relasi Drizzle membantu query relasional lebih terstruktur,
- tetap gunakan migration agar foreign key benar-benar terbentuk di database.

---

### 4) Pendalaman Query Data

#### A. Filter, sorting, dan pagination

```typescript
import { and, asc, count, desc, like } from 'drizzle-orm';
import { db } from '../db';
import { dosen } from '../db/schema';

const page = Number(req.query.page ?? 1);
const limit = Number(req.query.limit ?? 10);
const keyword = String(req.query.q ?? '');
const sortDir = String(req.query.sortDir ?? 'asc').toLowerCase();

const conditions = keyword ? like(dosen.nama, `%${keyword}%`) : undefined;

const rows = await db
  .select({ id: dosen.id, nama: dosen.nama, email: dosen.email })
  .from(dosen)
  .where(conditions)
  .orderBy(sortDir === 'desc' ? desc(dosen.nama) : asc(dosen.nama))
  .limit(limit)
  .offset((page - 1) * limit);

const [{ total }] = await db
  .select({ total: count() })
  .from(dosen)
  .where(conditions);

return res.json({ rows, count: total, page, limit });
```

#### B. Eager loading relasi

```typescript
const dosenDenganMatkul = await db.query.dosen.findMany({
  with: {
    mataKuliah: {
      columns: { id: true, nama: true, sks: true }
    }
  }
});
```

#### C. Select atribut tertentu

```typescript
import { db } from '../db';
import { mataKuliah } from '../db/schema';
import { desc } from 'drizzle-orm';

const daftar = await db
  .select({ id: mataKuliah.id, nama: mataKuliah.nama, sks: mataKuliah.sks })
  .from(mataKuliah)
  .orderBy(desc(mataKuliah.sks));
```

---

### 5) Validasi Data di Layer Model dan Controller

Validasi tidak cukup hanya di frontend. Di backend, minimal lakukan:
- validasi format input (contoh email),
- validasi nilai (contoh sks 1-6),
- validasi relasi (dosen harus ada sebelum insert mata kuliah).

Contoh validasi sederhana di controller:

```typescript
const { nama, sks, dosenId } = req.body;

if (!nama || !sks || !dosenId) {
  return res.status(400).json({ message: 'nama, sks, dan dosenId wajib diisi' });
}

if (Number(sks) < 1 || Number(sks) > 6) {
  return res.status(400).json({ message: 'sks harus di antara 1 sampai 6' });
}
```

---

### 6) Error Handling yang Konsisten

Gunakan pola middleware error agar response seragam:

```typescript
import { Request, Response, NextFunction } from 'express';

export function errorHandler(err: any, req: Request, res: Response, next: NextFunction) {
  if (err?.statusCode) {
    return res.status(err.statusCode).json({ message: err.message });
  }

  if (err?.code === 'ER_DUP_ENTRY') {
    return res.status(409).json({ message: 'Data duplikat' });
  }

  if (err?.code === 'ER_NO_REFERENCED_ROW_2') {
    return res.status(400).json({ message: 'Foreign key tidak valid' });
  }

  return res.status(500).json({ message: 'Internal server error' });
}
```

Poin penting:
- bedakan error validasi (`400`) dan konflik data (`409`),
- hindari mengirim stack trace ke client,
- log error detail di server.

---

### 7) Integrasi End-to-End Controller ke Database

Contoh endpoint membuat mata kuliah dan memuat data dosen terkait:

```typescript
import { Request, Response, NextFunction } from 'express';
import { and, eq } from 'drizzle-orm';
import { db } from '../db';
import { dosen, mataKuliah } from '../db/schema';

export async function createMataKuliah(req: Request, res: Response, next: NextFunction) {
  try {
    const { nama, sks, dosenId } = req.body;

    if (!nama || !sks || !dosenId) {
      return res.status(400).json({ message: 'nama, sks, dosenId wajib diisi' });
    }

    if (Number(sks) < 1 || Number(sks) > 6) {
      return res.status(400).json({ message: 'sks harus di antara 1 sampai 6' });
    }

    const foundDosen = await db.select().from(dosen).where(eq(dosen.id, Number(dosenId))).limit(1);
    if (!foundDosen[0]) {
      return res.status(404).json({ message: 'Dosen tidak ditemukan' });
    }

    const insertResult = await db.insert(mataKuliah).values({
      nama,
      sks: Number(sks),
      dosenId: Number(dosenId)
    });

    const insertedId = Number(insertResult[0].insertId);

    const result = await db
      .select({
        id: mataKuliah.id,
        nama: mataKuliah.nama,
        sks: mataKuliah.sks,
        dosen: {
          id: dosen.id,
          nama: dosen.nama,
          email: dosen.email
        }
      })
      .from(mataKuliah)
      .innerJoin(dosen, eq(mataKuliah.dosenId, dosen.id))
      .where(and(eq(mataKuliah.id, insertedId), eq(dosen.id, Number(dosenId))))
      .limit(1);

    return res.status(201).json(result[0]);
  } catch (err) {
    return next(err);
  }
}
```

Urutan alur endpoint:
1. Request masuk
2. Validasi payload
3. Cek relasi/aturan bisnis
4. Query ORM ke database
5. Format response sukses / error

---

## Praktikum

### Tugas Praktikum 1 - Membuat Model Relasi

1. Buat schema `Dosen` dan `MataKuliah` dengan Drizzle + TypeScript.
2. Definisikan relasi One-to-Many (foreign key `mata_kuliah.dosen_id` -> `dosen.id`).
3. Jalankan migration Drizzle dan pastikan tabel terbentuk.

Checklist:
- tabel `dosen` dan `mata_kuliah` berhasil dibuat
- kolom `dosenId` menjadi foreign key logis
- model berjalan tanpa error saat startup

### Tugas Praktikum 2 - Query Lanjutan

1. Buat endpoint daftar dosen dengan fitur:
   - filter nama (`q`),
   - sorting (`sortBy`, `sortDir`),
   - pagination (`page`, `limit`).
2. Buat endpoint daftar dosen beserta mata kuliah (`with` relasi / join).
3. Batasi atribut response agar tidak berlebihan.

Checklist:
- response memiliki `rows`, `count`, `page`, `limit`
- relasi muncul saat `include` dipakai
- query tetap rapi dan terbaca

### Tugas Praktikum 3 - Validasi dan Error Handling

1. Tambahkan validasi input pada endpoint create/update.
2. Buat middleware error handler global.
3. Uji minimal 3 skenario error:
   - field wajib kosong,
   - email duplikat,
   - foreign key tidak valid.

Checklist:
- status code sesuai kasus (`400`, `404`, `409`, `500`)
- format error konsisten JSON
- aplikasi tidak crash saat error

---

## Tugas

Bangun API mini sistem akademik dengan ketentuan berikut:

1. Entitas:
   - `Dosen` (id, nama, email)
   - `MataKuliah` (id, nama, sks, dosenId)

2. Endpoint minimum:
   - `POST /dosen`
   - `GET /dosen`
   - `GET /dosen/:id`
   - `PUT /dosen/:id`
   - `DELETE /dosen/:id`
   - `POST /mata-kuliah`
   - `GET /mata-kuliah`
   - `GET /dosen/:id/mata-kuliah`

3. Syarat teknis:
  - gunakan Drizzle ORM,
   - implementasi relasi One-to-Many,
   - validasi data pada create/update,
   - error handling terpusat,
   - dukung filter + pagination pada minimal satu endpoint list.

4. Output pengumpulan:
   - source code backend,
   - dokumentasi endpoint singkat (method, path, body, contoh response),
   - screenshot pengujian (minimal 5 endpoint).
