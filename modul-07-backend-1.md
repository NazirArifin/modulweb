# Modul 13 - Backend dengan Node.js, Express & TypeScript (bag. 1)

Tujuan Pembelajaran: Mahasiswa mengenal Node.js, framework Express, dan TypeScript, memahami struktur proyek backend modern, dan dapat membangun API sederhana menggunakan ES6 Modules.

## Persiapan

* Pastikan **Node.js** (LTS) sudah terinstal. Cek dengan `node -v`.
* Kita akan menggunakan **TypeScript** untuk keamanan tipe data dan **ES6 Modules** (`import`/`export`).
* Buat folder proyek, lalu inisialisasi:
```bash
npm init -y
npm install express
npm install typescript ts-node @types/node @types/express -D
```
* Inisialisasi konfigurasi TypeScript:
```bash
npx tsc --init
```
* Edit `tsconfig.json`, pastikan `"target": "ES6"` dan `"module": "ESNext"`.

## Materi

### Mengapa TypeScript & ES6?

1. **TypeScript**: Menambahkan "type checking" pada JavaScript, mencegah error umum seperti salah panggil fungsi atau property yang tidak ada.
2. **ES6 Modules**: Standar modern untuk membagi kode menjadi file-file (`import` dari pada `require`).

### Struktur Dasar Express dengan TypeScript

Buat file `src/index.ts`:

```typescript
import express, { Request, Response } from 'express';

const app = express();
const port = 3000;

app.use(express.json());

app.get('/', (req: Request, res: Response) => {
  res.send('Selamat Datang di API Mahasiswa (TypeScript)!');
});

app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`);
});
```

### Request & Response Types

Dalam TypeScript, kita bisa mendefinisikan tipe data untuk Request dan Response:
* `Request`: Mengambil data dari client (`req.params`, `req.body`, `req.query`).
* `Response`: Mengirim balik data ke client (`res.json`, `res.status`).

Contoh Interface untuk data:
```typescript
interface Mahasiswa {
  id: number;
  nama: string;
  npm: string;
}
```

## Praktikum

Kita akan membangun API CRUD sederhana dengan pola Controller.

1. **src/controllers/mahasiswaController.ts**:
```typescript
import { Request, Response } from 'express';

interface Mahasiswa {
  id: number;
  nama: string;
  npm: string;
}

let dataMahasiswa: Mahasiswa[] = [
  { id: 1, nama: 'Ali', npm: '2022001' }
];

export const getAll = (req: Request, res: Response) => {
  res.json(dataMahasiswa);
};

export const create = (req: Request, res: Response) => {
  const newMhs: Mahasiswa = {
    id: dataMahasiswa.length + 1,
    ...req.body
  };
  dataMahasiswa.push(newMhs);
  res.status(201).json(newMhs);
};
```

2. **src/index.ts**:
```typescript
import express from 'express';
import * as mhsController from './controllers/mahasiswaController';

const app = express();
app.use(express.json());

app.get('/mahasiswa', mhsController.getAll);
app.post('/mahasiswa', mhsController.create);

app.listen(3000, () => console.log('Server running on port 3000'));
```

3. Jalankan dengan: `npx ts-node src/index.ts`.

## Tugas

1. Tambahkan fitur **Update** dan **Delete** pada `mahasiswaController.ts` dengan menyertakan tipe data TypeScript yang sesuai.
2. Gunakan **Interface** untuk mendefinisikan struktur data mahasiswa.
3. Masukkan kode sumber `.ts` dan screenshot pengujian API ke laporan!
