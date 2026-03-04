# Modul 3 - CSS Dasar, Selector, Box Model, dan Layout Dasar

Tujuan Pembelajaran: Mahasiswa mampu membuat styling dasar halaman web dengan CSS, menggunakan selector dengan tepat, memahami box model, serta menerapkan layout dasar menggunakan `float` dan `position`.

## Materi

### 1) Pengenalan CSS Dasar

CSS (_Cascading Style Sheets_) digunakan untuk mengatur tampilan elemen HTML.

Cara menulis CSS:
- **Inline**: langsung di atribut `style`.
- **Internal**: di dalam tag `<style>` pada dokumen HTML.
- **External**: file `.css` terpisah (paling disarankan).

Contoh file CSS eksternal:

```css
body {
  font-family: Arial, sans-serif;
  background-color: #f7f7f7;
  color: #222;
}
```

### 2) Selector

Selector digunakan untuk memilih elemen yang akan diberi style.

Jenis selector dasar:
- Selector tag: `p`, `h1`, `table`
- Selector class: `.judul`, `.btn`
- Selector id: `#header`
- Selector gabungan sederhana: `nav a`, `.card p`

Contoh:

```css
h1 {
  color: navy;
}

.highlight {
  background-color: yellow;
}

#hero-title {
  text-transform: uppercase;
}
```

### 3) Box Model

Setiap elemen HTML dianggap sebagai kotak yang terdiri dari:
- `content`
- `padding`
- `border`
- `margin`

Contoh:

```css
.card {
  width: 280px;
  padding: 16px;
  border: 1px solid #333;
  margin: 12px;
  background-color: white;
}
```

### 4) Layout Dasar: Float dan Position

#### Float

`float` digunakan untuk membuat elemen berada di kiri/kanan sehingga konten lain mengalir di sekitarnya.

```css
.sidebar {
  float: left;
  width: 30%;
}

.content {
  float: left;
  width: 70%;
}

.clear {
  clear: both;
}
```

#### Position

`position` mengatur cara elemen ditempatkan:
- `static` (default)
- `relative`
- `absolute`
- `fixed`
- `sticky`

```css
.badge {
  position: absolute;
  top: 8px;
  right: 8px;
}
```

---

## Praktikum

### Tugas Praktikum 1 - Styling Dasar dan Selector

1. Buat file `style.css` lalu terapkan ke file HTML yang sudah dibuat sebelumnya.
2. Terapkan minimal:
   - selector tag untuk `body` dan `h1`
   - selector class untuk menandai paragraf penting
   - selector id untuk satu judul utama

Contoh awal:

```css
body {
  font-family: Verdana, sans-serif;
  line-height: 1.5;
}

.penting {
  color: #b00020;
  font-weight: bold;
}

#judul-utama {
  color: #1e40af;
}
```

### Tugas Praktikum 2 - Box Model

1. Buat komponen kartu sederhana (`.kartu`).
2. Atur `width`, `padding`, `border`, dan `margin`.
3. Bandingkan tampilan sebelum/sesudah properti box model diterapkan.

Contoh:

```css
.kartu {
  width: 260px;
  padding: 12px;
  border: 2px solid #444;
  margin: 16px 0;
  border-radius: 8px;
}
```

### Tugas Praktikum 3 - Layout Dasar Float dan Position

1. Buat layout dua kolom dengan `float` (`sidebar` dan `content`).
2. Tambahkan elemen label kecil pada pojok kartu menggunakan `position: absolute`.
3. Gunakan `clear` agar elemen footer tidak naik ke atas kolom.

---

## Tugas

1. Buat halaman profil sederhana (1 halaman HTML + 1 file CSS) yang memuat:
   - heading dan paragraf,
   - minimal 3 jenis selector,
   - 1 komponen berbasis box model,
   - layout 2 kolom menggunakan `float`,
   - minimal 1 elemen dengan `position`.
2. Tulis komentar singkat pada bagian CSS penting.
3. Kumpulkan source code dan screenshot hasil tampilan.
