# Modul 14 - Data Persistence dengan ORM & TypeScript

Tujuan Pembelajaran: Mahasiswa memahami konsep Object-Relational Mapping (ORM), mampu mengelola model dan relasi data menggunakan TypeScript, serta mengintegrasikan database dengan API Express.

## Materi

### Setup Sequelize dengan TypeScript

Kita akan menggunakan **Sequelize** sebagai ORM. Instalasi library pendukung:

```bash
npm install sequelize mariadb
npm install @types/validator -D
```

### Inisialisasi Koneksi (ES6)

Buat file `src/config/database.ts`:
```typescript
import { Sequelize } from 'sequelize';

const sequelize = new Sequelize('database', 'username', 'password', {
  host: 'localhost',
  dialect: 'mariadb',
  logging: false
});

export default sequelize;
```

### Mendefinisikan Model dengan TypeScript

Kita bisa mendefinisikan model dengan mewarisi class `Model` dari Sequelize untuk mendapatkan *type safety*.

Buat file `src/models/Mahasiswa.ts`:
```typescript
import { DataTypes, Model } from 'sequelize';
import sequelize from '../config/database';

interface MahasiswaAttributes {
  id?: number;
  nama: string;
  npm: string;
}

class Mahasiswa extends Model<MahasiswaAttributes> implements MahasiswaAttributes {
  public id!: number;
  public nama!: string;
  public npm!: string;
}

Mahasiswa.init({
  nama: { type: DataTypes.STRING, allowNull: false },
  npm: { type: DataTypes.STRING, unique: true }
}, { sequelize, modelName: 'mahasiswa' });

export default Mahasiswa;
```

### Relasi Data

```typescript
// Contoh relasi di file models/index.ts atau App
import Mahasiswa from './Mahasiswa';
import Prodi from './Prodi';

Prodi.hasMany(Mahasiswa);
Mahasiswa.belongsTo(Prodi);
```

## Praktikum

Update `src/controllers/mahasiswaController.ts` untuk menggunakan model Sequelize:

```typescript
import { Request, Response } from 'express';
import Mahasiswa from '../models/Mahasiswa';

export const getAll = async (req: Request, res: Response) => {
  const mhs = await Mahasiswa.findAll();
  res.json(mhs);
};

export const create = async (req: Request, res: Response) => {
  try {
    const newMhs = await Mahasiswa.create(req.body);
    res.status(201).json(newMhs);
  } catch (err: any) {
    res.status(400).json({ error: err.message });
  }
};
```

Update `src/index.ts` untuk sinkronisasi database:
```typescript
import sequelize from './config/database';

sequelize.sync().then(() => {
  console.log('Database synced');
  app.listen(3000);
});
```

## Tugas

1. Buat model **Prodi** (id, nama) menggunakan TypeScript.
2. Implementasikan relasi **One-to-Many** antara Prodi dan Mahasiswa.
3. Buat API endpoint untuk menampilkan data Mahasiswa beserta data Prodinya (gunakan `include`).
4. Masukkan kode sumber `.ts` dan screenshot JSON respons ke laporan!
