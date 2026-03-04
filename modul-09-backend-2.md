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

### 2) Konfigurasi Koneksi ORM (Sequelize + MariaDB)

Instal dependensi utama:

```bash
npm install sequelize mariadb
```

Contoh koneksi:

```typescript
import { Sequelize } from 'sequelize';

export const sequelize = new Sequelize('db_modulweb', 'root', 'password', {
  host: 'localhost',
  dialect: 'mariadb',
  logging: false
});
```

Saran:
- gunakan environment variable untuk kredensial,
- matikan `logging` saat produksi,
- selalu tangani error koneksi saat aplikasi startup.

---

### 3) Desain Model dan Relasi Data

Kasus: satu **Dosen** dapat mengampu banyak **MataKuliah** (One-to-Many).

#### A. Definisi model `Dosen`

```typescript
import { DataTypes, Model, Optional } from 'sequelize';
import { sequelize } from '../database';

interface DosenAttributes {
  id: number;
  nama: string;
  email: string;
}

interface DosenCreation extends Optional<DosenAttributes, 'id'> {}

export class Dosen extends Model<DosenAttributes, DosenCreation>
  implements DosenAttributes {
  public id!: number;
  public nama!: string;
  public email!: string;
}

Dosen.init(
  {
    id: { type: DataTypes.INTEGER.UNSIGNED, autoIncrement: true, primaryKey: true },
    nama: { type: DataTypes.STRING, allowNull: false },
    email: { type: DataTypes.STRING, allowNull: false, unique: true, validate: { isEmail: true } }
  },
  { sequelize, modelName: 'dosen', tableName: 'dosen' }
);
```

#### B. Definisi model `MataKuliah`

```typescript
import { DataTypes, Model, Optional } from 'sequelize';
import { sequelize } from '../database';

interface MataKuliahAttributes {
  id: number;
  nama: string;
  sks: number;
  dosenId: number;
}

interface MataKuliahCreation extends Optional<MataKuliahAttributes, 'id'> {}

export class MataKuliah extends Model<MataKuliahAttributes, MataKuliahCreation>
  implements MataKuliahAttributes {
  public id!: number;
  public nama!: string;
  public sks!: number;
  public dosenId!: number;
}

MataKuliah.init(
  {
    id: { type: DataTypes.INTEGER.UNSIGNED, autoIncrement: true, primaryKey: true },
    nama: { type: DataTypes.STRING, allowNull: false },
    sks: { type: DataTypes.INTEGER.UNSIGNED, allowNull: false, validate: { min: 1, max: 6 } },
    dosenId: { type: DataTypes.INTEGER.UNSIGNED, allowNull: false }
  },
  { sequelize, modelName: 'mata_kuliah', tableName: 'mata_kuliah' }
);
```

#### C. Definisi relasi

```typescript
import { Dosen } from './dosen';
import { MataKuliah } from './mataKuliah';

Dosen.hasMany(MataKuliah, { foreignKey: 'dosenId', as: 'mataKuliah' });
MataKuliah.belongsTo(Dosen, { foreignKey: 'dosenId', as: 'dosen' });
```

Catatan:
- `as` harus konsisten saat dipakai di query `include`.
- gunakan `foreignKey` yang eksplisit agar mudah dibaca.

---

### 4) Pendalaman Query Data

#### A. Filter, sorting, dan pagination

```typescript
import { Op } from 'sequelize';
import { Dosen } from '../models/dosen';

const page = Number(req.query.page ?? 1);
const limit = Number(req.query.limit ?? 10);
const keyword = String(req.query.q ?? '');

const data = await Dosen.findAndCountAll({
  where: {
    nama: { [Op.like]: `%${keyword}%` }
  },
  order: [['nama', 'ASC']],
  limit,
  offset: (page - 1) * limit
});
```

#### B. Eager loading relasi

```typescript
const dosenDenganMatkul = await Dosen.findAll({
  include: [
    {
      association: 'mataKuliah',
      attributes: ['id', 'nama', 'sks']
    }
  ]
});
```

#### C. Select atribut tertentu

```typescript
const daftar = await MataKuliah.findAll({
  attributes: ['id', 'nama', 'sks'],
  order: [['sks', 'DESC']]
});
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
  if (err.name === 'SequelizeValidationError') {
    return res.status(400).json({ message: 'Validasi gagal', details: err.errors });
  }

  if (err.name === 'SequelizeUniqueConstraintError') {
    return res.status(409).json({ message: 'Data duplikat', details: err.errors });
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
import { Dosen } from '../models/dosen';
import { MataKuliah } from '../models/mataKuliah';

export async function createMataKuliah(req: Request, res: Response, next: NextFunction) {
  try {
    const { nama, sks, dosenId } = req.body;

    if (!nama || !sks || !dosenId) {
      return res.status(400).json({ message: 'nama, sks, dosenId wajib diisi' });
    }

    const dosen = await Dosen.findByPk(dosenId);
    if (!dosen) {
      return res.status(404).json({ message: 'Dosen tidak ditemukan' });
    }

    const created = await MataKuliah.create({ nama, sks, dosenId });
    const result = await MataKuliah.findByPk(created.id, {
      include: [{ association: 'dosen', attributes: ['id', 'nama', 'email'] }]
    });

    return res.status(201).json(result);
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

1. Buat model `Dosen` dan `MataKuliah` dengan Sequelize + TypeScript.
2. Definisikan relasi One-to-Many (`Dosen.hasMany`, `MataKuliah.belongsTo`).
3. Lakukan `sequelize.sync()` dan pastikan tabel terbentuk.

Checklist:
- tabel `dosen` dan `mata_kuliah` berhasil dibuat
- kolom `dosenId` menjadi foreign key logis
- model berjalan tanpa error saat startup

### Tugas Praktikum 2 - Query Lanjutan

1. Buat endpoint daftar dosen dengan fitur:
   - filter nama (`q`),
   - sorting (`sortBy`, `sortDir`),
   - pagination (`page`, `limit`).
2. Buat endpoint daftar dosen beserta mata kuliah (`include`).
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
   - gunakan Sequelize ORM,
   - implementasi relasi One-to-Many,
   - validasi data pada create/update,
   - error handling terpusat,
   - dukung filter + pagination pada minimal satu endpoint list.

4. Output pengumpulan:
   - source code backend,
   - dokumentasi endpoint singkat (method, path, body, contoh response),
   - screenshot pengujian (minimal 5 endpoint).
