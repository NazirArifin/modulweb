# Modul 4 - CSS Lanjutan: Animasi, Flexbox, dan Grid

Tujuan Pembelajaran: Mahasiswa mampu membangun layout modern dan interaktif menggunakan CSS Animation, Flexbox, dan CSS Grid, serta menerapkannya pada halaman responsif sederhana.

## Materi

### Prasyarat Singkat

Sebelum memulai modul ini, pastikan sudah memahami:
- selector CSS,
- box model,
- properti dasar teks dan warna,
- layout dasar dengan float/position (modul sebelumnya).

---

### 1) CSS Animation

Animasi CSS membuat perubahan gaya terjadi bertahap dari satu kondisi ke kondisi lain.

#### A. Komponen utama animasi

1. `@keyframes` untuk mendefinisikan fase animasi.
2. Properti `animation-*` pada elemen target.

Contoh:

```css
@keyframes fadeInUp {
  0% {
    opacity: 0;
    transform: translateY(12px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

.card {
  animation-name: fadeInUp;
  animation-duration: 0.6s;
  animation-timing-function: ease-out;
  animation-fill-mode: both;
}
```

#### B. Properti penting animasi

- `animation-name`: nama keyframes
- `animation-duration`: durasi animasi
- `animation-delay`: waktu tunggu sebelum animasi dimulai
- `animation-iteration-count`: jumlah pengulangan (`infinite` untuk terus-menerus)
- `animation-direction`: arah animasi (`normal`, `reverse`, `alternate`)
- `animation-fill-mode`: perilaku style sebelum/sesudah animasi (`forwards`, `backwards`, `both`)

Shorthand:

```css
.badge {
  animation: pulse 1.2s ease-in-out 0s infinite alternate;
}
```

#### C. Transition vs Animation

- `transition` cocok untuk perubahan akibat event (misalnya hover).
- `animation` cocok untuk urutan gerakan lebih kompleks dengan keyframes.

Contoh transition:

```css
.btn {
  background: #2563eb;
  color: #fff;
  transition: transform 0.2s ease, background-color 0.2s ease;
}

.btn:hover {
  transform: translateY(-2px);
  background-color: #1d4ed8;
}
```

---

### 2) Flexbox

Flexbox digunakan untuk layout **satu dimensi**: baris **atau** kolom.

#### A. Konsep sumbu

- **Main axis**: arah utama item (`row`/`column`)
- **Cross axis**: sumbu tegak lurus main axis

Jika `flex-direction: row`, maka:
- `justify-content` mengatur posisi horizontal
- `align-items` mengatur posisi vertikal

#### B. Properti parent (container)

- `display: flex`
- `flex-direction: row | column`
- `flex-wrap: nowrap | wrap`
- `justify-content: flex-start | center | space-between | space-around | space-evenly`
- `align-items: stretch | center | flex-start | flex-end`
- `gap`

#### C. Properti child (item)

- `flex-grow`: seberapa besar item membesar
- `flex-shrink`: seberapa besar item mengecil
- `flex-basis`: ukuran dasar item
- `flex`: shorthand (`flex: 1 1 200px`)
- `align-self`: override alignment item tertentu

Contoh navbar dan section fitur:

```css
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 16px;
}

.fitur-list {
  display: flex;
  flex-wrap: wrap;
  gap: 16px;
}

.fitur-item {
  flex: 1 1 220px;
  border: 1px solid #ddd;
  padding: 16px;
  border-radius: 10px;
}
```

---

### 3) CSS Grid

Grid digunakan untuk layout **dua dimensi** (baris dan kolom sekaligus).

#### A. Properti inti

- `display: grid`
- `grid-template-columns`
- `grid-template-rows`
- `grid-template-areas`
- `gap`

#### B. Satuan penting pada grid

- `fr` = fraksi ruang tersisa
- `repeat(n, value)` = mengulang pola kolom/baris
- `minmax(min, max)` = ukuran fleksibel dengan batas

Contoh responsive cards:

```css
.cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 16px;
}
```

Contoh layout dashboard dengan area:

```css
.dashboard {
  display: grid;
  grid-template-columns: 240px 1fr;
  grid-template-areas:
    "header header"
    "sidebar content"
    "footer footer";
  gap: 12px;
}

.header { grid-area: header; }
.sidebar { grid-area: sidebar; }
.content { grid-area: content; }
.footer { grid-area: footer; }
```

---

### 4) Responsiveness (Media Query)

Media query membuat layout menyesuaikan ukuran layar.

```css
@media (max-width: 768px) {
  .navbar {
    flex-direction: column;
    align-items: flex-start;
  }

  .dashboard {
    grid-template-columns: 1fr;
    grid-template-areas:
      "header"
      "content"
      "sidebar"
      "footer";
  }
}
```

---

### 5) Best Practice Singkat

- Gunakan `transition` untuk interaksi kecil (hover/focus), bukan animasi panjang berulang tanpa alasan.
- Hindari animasi berlebihan agar tetap nyaman dibaca.
- Prioritaskan `transform` dan `opacity` untuk animasi yang lebih ringan.
- Atur `gap` konsisten agar jarak antar elemen seragam.
- Selalu uji di desktop dan mobile.

---

## Praktikum

### Tugas Praktikum 1 - Animasi dan Transition

Target output: tombol interaktif + card yang muncul halus saat halaman dibuka.

Langkah:
1. Buat file `latihan-animasi.html` dan `latihan-animasi.css`.
2. Tambahkan 1 tombol dan 1 card.
3. Terapkan `transition` pada tombol saat hover.
4. Terapkan `@keyframes` pada card.
5. Tambahkan `animation-delay` minimal pada satu elemen.

Checklist:
- ada penggunaan `transition`
- ada penggunaan `@keyframes`
- tidak ada animasi yang terlalu cepat (minimal 0.2s)

### Tugas Praktikum 2 - Layout Flexbox

Target output: halaman dengan navbar dan 3-6 kartu fitur yang rapi.

Langkah:
1. Buat navbar (logo kiri, menu kanan) menggunakan flex.
2. Buat section fitur menggunakan flex + `flex-wrap`.
3. Terapkan `gap` dan alignment yang konsisten.
4. Tambahkan media query agar menu/fitur menumpuk di layar kecil.

Checklist:
- memakai `justify-content` dan `align-items`
- item tetap rapi saat lebar layar berubah
- tidak ada elemen saling menimpa

### Tugas Praktikum 3 - Layout Grid

Target output: mini dashboard dengan header, sidebar, content, footer.

Langkah:
1. Gunakan `grid-template-areas` untuk memetakan area.
2. Tambahkan section kartu di area content dengan grid responsif.
3. Uji tampilan desktop dan mobile (lebar < 768px).

Checklist:
- layout area berfungsi sesuai rancangan
- ada penggunaan `repeat`/`minmax`/`fr`
- mobile layout tetap terbaca dengan baik

---

## Tugas

Buat satu halaman landing page produk sederhana (1 HTML + 1 CSS) dengan ketentuan:

1. **Hero Section (Flexbox)**
   - berisi judul, deskripsi, tombol aksi, dan gambar ilustrasi,
   - menggunakan flex untuk menyusun konten kiri/kanan.

2. **Feature Section (Grid)**
   - minimal 6 kartu fitur,
   - menggunakan grid responsif (`auto-fit` atau media query).

3. **Animasi dan Interaksi**
   - minimal 1 `@keyframes` pada elemen masuk,
   - minimal 1 `transition` pada hover tombol/kartu.

4. **Responsif**
   - pada mobile, layout hero menjadi 1 kolom,
   - teks tetap terbaca, tidak overflow.

5. **Kerapian Kode**
   - gunakan indentasi rapi,
   - beri komentar pada bagian CSS penting,
   - kelompokkan style per section.

Output pengumpulan:
- source code (HTML + CSS),
- 2 screenshot: tampilan desktop dan mobile,
- catatan singkat (3-5 kalimat) tentang bagian tersulit yang dikerjakan.
