# Modul 9 - Backend & Data Persistence with MariaDB

Tujuan Pembelajaran: Mahasiswa mampu menggunakan MariaDB melalui Sequelize ORM dengan TypeScript dan mengelola data relasional.

## Materi

### Setup MariaDB & Sequelize
Kita menggunakan **MariaDB** sebagai database server.
```bash
npm install sequelize mariadb
```

### Database Configuration
```typescript
import { Sequelize } from 'sequelize';

const sequelize = new Sequelize('database', 'username', 'password', {
  host: 'localhost',
  dialect: 'mariadb',
  logging: false
});

export default sequelize;
```

## Praktikum
Gunakan model yang telah dibuat sebelumnya, namun pastikan koneksi mengarah ke instance MariaDB lokal/server.

## Tugas
1. Migrasikan database SQLite sebelumnya ke MariaDB.
2. Implementasikan relasi One-to-Many antara tabel **Dosen** dan **MataKuliah**.
3. Buat API untuk menampilkan data Dosen beserta daftar mata kuliah yang diampu.
