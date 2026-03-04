import express, { Request, Response, NextFunction } from 'express';
import bcrypt from 'bcrypt';
import jwt from 'jsonwebtoken';
import { sequelize, User, Mahasiswa } from './database.js';

const app = express();
const SECRET_KEY = 'SANGAT_RAHASIA';

app.use(express.json());

// Middleware Autentikasi
const authenticate = (req: Request, res: Response, next: NextFunction) => {
  const token = req.headers['authorization']?.split(' ')[1];
  if (!token) return res.status(401).json({ message: 'Unauthorized' });

  jwt.verify(token, SECRET_KEY, (err, decoded) => {
    if (err) return res.status(403).json({ message: 'Invalid Token' });
    (req as any).user = decoded;
    next();
  });
};

// Route: Register
app.post('/register', async (req: Request, res: Response) => {
  try {
    const { email, password } = req.body;
    const hashedPassword = await bcrypt.hash(password, 10);
    const user = await User.create({ email, password: hashedPassword });
    res.status(201).json({ id: user.id, email: user.email });
  } catch (err: any) {
    res.status(400).json({ error: err.message });
  }
});

// Route: Login
app.post('/login', async (req: Request, res: Response) => {
  const { email, password } = req.body;
  const user = await User.findOne({ where: { email } });
  if (user && await bcrypt.compare(password, user.password)) {
    const token = jwt.sign({ id: user.id, email: user.email }, SECRET_KEY);
    res.json({ token });
  } else {
    res.status(401).json({ message: 'Invalid Credentials' });
  }
});

// Route: CRUD Mahasiswa (Terproteksi)
app.get('/mahasiswa', authenticate, async (req: Request, res: Response) => {
  const data = await Mahasiswa.findAll();
  res.json(data);
});

app.post('/mahasiswa', authenticate, async (req: Request, res: Response) => {
  try {
    const mhs = await Mahasiswa.create(req.body);
    res.status(201).json(mhs);
  } catch (err: any) {
    res.status(400).json({ error: err.message });
  }
});

// Jalankan Server
const PORT = 3000;
sequelize.sync().then(() => {
  app.listen(PORT, () => {
    console.log(`Example app listening at http://localhost:${PORT}`);
  });
});
