# Modul 4 - CSS Modern (Flexbox & Animasi)

Tujuan Pembelajaran: Mahasiswa mampu menggunakan Flexbox untuk layout responsif dan menambahkan animasi CSS untuk meningkatkan UX.

## Materi

### Flexbox Layout
Flexbox mempermudah pengaturan elemen dalam satu dimensi (baris atau kolom).
- `display: flex;` (pada parent)
- `justify-content`: perataan horizontal.
- `align-items`: perataan vertikal.

### Animasi CSS
Menggunakan `@keyframes` untuk transisi status elemen.
```css
@keyframes muncul {
  from { opacity: 0; }
  to { opacity: 1; }
}
```

## Praktikum

### 1. Navbar Responsif (Flexbox)
```css
.navbar {
  display: flex;
  justify-content: space-between;
  background: #333;
  color: white;
  padding: 1rem;
}
```

### 2. Animasi Sederhana
```css
.tombol:hover {
  animation: goyang 0.5s infinite;
}
```

## Tugas
1. Buat layout landing page sederhana dengan Header, Main Content, Sidebar, dan Footer menggunakan Flexbox.
2. Tambahkan efek animasi saat mouse diarahkan ke elemen tertentu.
3. Pastikan layout berubah (menjadi kolom) saat dibuka di perangkat mobile (Media Query).
