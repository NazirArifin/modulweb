# Modul 10 - Authentication & Security dengan TypeScript

Tujuan Pembelajaran: Mahasiswa memahami konsep autentikasi berbasis token (JWT), keamanan password dengan hashing menggunakan TypeScript, dan mampu memproteksi endpoint API.

## Materi

### Hashing Password dengan bcrypt

Instalasi library dan tipe data:
```bash
npm install bcrypt
npm install @types/bcrypt -D
```

Penggunaan dalam TypeScript:
```typescript
import bcrypt from 'bcrypt';

const hashPassword = async (password: string): Promise<string> => {
  return await bcrypt.hash(password, 10);
};
```

### JSON Web Token (JWT)

Instalasi library dan tipe data:
```bash
npm install jsonwebtoken
npm install @types/jsonwebtoken -D
```

### Autentikasi Modern (ES6)

1. **Login**: Server memvalidasi user, lalu membuat token.
2. **Middleware**: Memverifikasi token pada setiap request yang terproteksi.

## Praktikum

Kita akan membuat fitur Login dan Middleware autentikasi.

1. **src/controllers/authController.ts**:
```typescript
import { Request, Response } from 'express';
import bcrypt from 'bcrypt';
import jwt from 'jsonwebtoken';
import User from '../models/User';

const SECRET_KEY = 'RAHASIA_NEGARA';

export const login = async (req: Request, res: Response) => {
  const { email, password } = req.body;
  const user = await User.findOne({ where: { email } });

  if (user && await bcrypt.compare(password, user.password)) {
    const token = jwt.sign({ id: user.id, email: user.email }, SECRET_KEY, { expiresIn: '1h' });
    res.json({ token });
  } else {
    res.status(401).json({ message: 'Invalid credentials' });
  }
};
```

2. **src/middleware/auth.ts**:
```typescript
import { Request, Response, NextFunction } from 'express';
import jwt from 'jsonwebtoken';

const SECRET_KEY = 'RAHASIA_NEGARA';

export const authenticateToken = (req: Request, res: Response, next: NextFunction) => {
  const token = req.headers['authorization']?.split(' ')[1];

  if (!token) return res.sendStatus(401);

  jwt.verify(token, SECRET_KEY, (err, user) => {
    if (err) return res.sendStatus(403);
    (req as any).user = user;
    next();
  });
};
```

3. Gunakan di **src/index.ts**:
```typescript
import { authenticateToken } from './middleware/auth';

app.get('/mahasiswa', authenticateToken, mhsController.getAll);
```

## Tugas

1. Buat fitur **Register** yang melakukan hashing password secara asinkron.
2. Proteksi semua route CRUD Mahasiswa (kecuali GET) menggunakan `authenticateToken`.
3. Gunakan TypeScript untuk mendefinisikan tipe data **Payload** pada JWT.
4. Masukkan kode sumber `.ts` dan screenshot bukti akses (Berhasil dengan token, Gagal tanpa token) ke laporan!
