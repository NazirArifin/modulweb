# Modul 4 - CSS Lanjutan: Animasi, Flexbox, dan Grid

Tujuan Pembelajaran: Mahasiswa mampu membangun layout modern dan interaktif menggunakan CSS Animation, Flexbox, dan CSS Grid.

## Materi

### 1) CSS Animation

Animasi CSS dapat dibuat dengan `@keyframes` dan properti `animation`.

Contoh:

```css
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(8px); }
  to { opacity: 1; transform: translateY(0); }
}

.card {
  animation: fadeIn 0.6s ease-out;
}
```

### 2) Flexbox

Flexbox efektif untuk layout satu dimensi (baris/kolom).

Properti inti:
- pada parent: `display: flex`, `flex-direction`, `justify-content`, `align-items`, `gap`
- pada child: `flex`, `align-self`

Contoh:

```css
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 16px;
}
```

### 3) CSS Grid

Grid cocok untuk layout dua dimensi (baris dan kolom).

Properti inti:
- `display: grid`
- `grid-template-columns`
- `grid-template-rows`
- `gap`

Contoh:

```css
.layout {
  display: grid;
  grid-template-columns: 1fr 2fr;
  gap: 16px;
}
```

---

## Praktikum

### Tugas Praktikum 1 - Efek Animasi

1. Buat satu tombol dan satu kartu konten.
2. Beri efek `hover` pada tombol.
3. Terapkan animasi `fadeIn` pada kartu saat halaman dimuat.

### Tugas Praktikum 2 - Layout Flexbox

1. Buat navbar dengan logo di kiri dan menu di kanan.
2. Buat section daftar fitur menggunakan flex dengan 3 item sejajar.
3. Ubah menjadi satu kolom pada layar kecil menggunakan media query.

### Tugas Praktikum 3 - Layout Grid

1. Buat layout dashboard sederhana: header, sidebar, content, footer.
2. Gunakan `grid-template-areas` atau `grid-template-columns`.
3. Pastikan jarak antarblok rapi menggunakan `gap`.

---

## Tugas

1. Buat halaman landing page sederhana dengan ketentuan:
   - bagian hero menggunakan Flexbox,
   - bagian daftar konten/kartu menggunakan Grid,
   - minimal satu animasi CSS (`@keyframes` atau transisi).
2. Tambahkan media query agar tampilan tetap nyaman di layar kecil.
3. Kumpulkan source code dan screenshot hasil tampilan.
