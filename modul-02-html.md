# Modul 2 - Dasar HTML: Struktur, Image, Link, Table, dan Form

Tujuan Pembelajaran: Mahasiswa mengenal HTML sebagai bagian dari pemrograman web dan mampu membuat halaman web sederhana yang memuat struktur dokumen, teks, gambar, link, tabel, dan form.

## Materi

### 1) Struktur Dasar HTML

HTML (_HyperText Markup Language_) adalah bahasa markup untuk menyusun konten halaman web.

Kerangka dasar dokumen HTML:

```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

</body>
</html>
```

Keterangan singkat:
- `<!DOCTYPE html>` menandakan dokumen HTML5.
- `<head>` berisi metadata (judul halaman, charset, viewport, dll).
- `<body>` berisi konten yang ditampilkan pada browser.
- Sebagian besar tag memiliki pasangan tag tutup, misalnya `<p>...</p>`.

### 2) Inline vs Block dan Grouping Elemen

- Elemen **inline** mengisi ruang horizontal yang tersedia (contoh: `<span>`, `<img>`, `<a>`).
- Elemen **block** cenderung mengambil satu baris penuh (contoh: `<div>`, `<p>`, `<h1>`).
- Gunakan `<span>` untuk mengelompokkan konten inline, dan `<div>` untuk konten block.

Contoh:

```html
<div>
  <h2>Judul Bagian</h2>
  <p>
    Nilai kompleksitas: <span><strong>O(n<sup>2</sup>)</strong></span>
  </p>
</div>
```

> Penting: jaga **indentasi rapi** agar struktur HTML mudah dibaca dan dipelihara.

### 3) Atribut Tag, Id, dan Class

- Pola atribut umum: `<tag atribut="nilai">`.
- Contoh: `<img src="foto.jpg" alt="foto profil">`.
- `id` harus unik dalam satu dokumen.
- `class` boleh dipakai oleh banyak elemen.

### 4) URI, Path Relatif, dan Path Absolut

- URI adalah alamat resource, contoh: `https://example.com/gambar.png`.
- **Path relatif**: berdasarkan lokasi file saat ini.
  - Contoh: `image/logo.png`, `./image/logo.png`, `../assets/icon.png`.
- **Path absolut**: diawali `/` dari root website.
  - Contoh: `/image/logo.png`.

Contoh penggunaan pada gambar:

```html
<img src="image/einstein.jpg" alt="einstein">
<img src="../einstein.jpg" alt="einstein">
<img src="/image/einstein.jpg" alt="einstein">
```

### 5) Beberapa Tag Teks yang Sering Dipakai

| Tag | Fungsi |
| --- | --- |
| `<h1>` s.d. `<h6>` | Judul/heading |
| `<p>` | Paragraf |
| `<strong>` | Penekanan penting (tebal secara semantik) |
| `<em>` | Penekanan (miring secara semantik) |
| `<br>` | Pindah baris |
| `<sup>` / `<sub>` | Pangkat / indeks |
| `<!-- ... -->` | Komentar (tidak tampil di browser) |

### 6) Gambar (Image)

Tag gambar menggunakan `<img>` dengan atribut minimal:
- `src`: path/URI gambar
- `alt`: teks alternatif jika gambar gagal dimuat

Contoh:

```html
<img src="img/logo.png" alt="Logo kampus">
```

Catatan:
- Hindari ukuran file gambar terlalu besar agar halaman tidak lambat.
- Hindari _hotlinking_ (mengambil gambar langsung dari server orang lain tanpa izin).

### 7) Link dan Link Anchor

Link dasar:

```html
<a href="daftar.html">Ke halaman daftar</a>
```

Anchor dalam halaman yang sama:

```html
<a href="#q1">Lompat ke Q1</a>
...
<a id="q1">What is CSS?</a>
```

### 8) Tabel

Tag utama tabel:
- `<table>`: pembungkus tabel
- `<tr>`: baris
- `<th>`: header kolom
- `<td>`: data sel
- `<thead>`, `<tbody>`, `<tfoot>`: bagian struktur tabel

Contoh:

```html
<table border="1">
  <thead>
    <tr>
      <th>Nilai</th>
      <th>Keterangan</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>left</td>
      <td>kiri</td>
    </tr>
  </tbody>
</table>
```

Menggabung sel:
- `rowspan` untuk gabung vertikal
- `colspan` untuk gabung horizontal

### 9) Form

Form digunakan untuk mengumpulkan data pengguna dan dikirim ke server.

Tag penting:
- `<form method="..." action="...">`
- `<input>` (text, password, radio, checkbox, file, dll)
- `<select>` dan `<option>`
- `<textarea>`
- `<button>` atau `<input type="submit">`
- `<fieldset>` dan `<legend>` untuk pengelompokan

---

## Praktikum

> Simpan semua file pada folder yang sama agar path relatif mudah digunakan.

### Tugas Praktikum 1 - Struktur HTML + Tag Dasar

Buat file `latihan-1.html` dengan isi berikut:

```html
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Latihan HTML Dasar</title>
</head>
<body>
  <h1>HTML Dasar</h1>
  <hr>
  <!-- Contoh paragraf dengan beberapa tag teks -->
  <p>
    <strong>HyperText Markup Language</strong> adalah <em>bahasa markup</em>
    untuk menyusun halaman web.<br>
    Contoh notasi: O(n<sup>2</sup>) dan H<sub>2</sub>O.
  </p>
  <p><small>&copy; 2026 - Praktikum Web</small></p>
</body>
</html>
```

### Tugas Praktikum 2 - Link Anchor + Tabel

Lanjutkan dengan file `latihan-2.html`:

```html
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Anchor dan Tabel</title>
</head>
<body>
  <a href="#q1" id="top">What is CSS</a><br>
  <a href="#q2">What can I do with CSS?</a><br>
  <a href="#q3">Difference between CSS and HTML?</a><br><br>

  <h3 id="q1">What is CSS?</h3>
  <p>CSS adalah bahasa untuk mengatur tampilan dokumen HTML.</p>

  <h3 id="q2">What can I do with CSS?</h3>
  <p>CSS mengatur warna, ukuran, jarak, layout, dan banyak aspek visual.</p>

  <h3 id="q3">Difference between CSS and HTML?</h3>
  <p>HTML menyusun struktur konten, CSS mengatur tampilannya.</p>

  <a href="#top">Kembali ke atas</a>

  <h2>Contoh Tabel Merge</h2>
  <table border="1" width="100%">
    <tr>
      <td rowspan="2">Sel 1 dan 5 digabung</td>
      <td>2</td>
      <td>3</td>
      <td>4</td>
    </tr>
    <tr>
      <td colspan="3">Sel 6,7,8 digabung</td>
    </tr>
  </table>
</body>
</html>
```

### Tugas Praktikum 3 - Form Lengkap

Buat file `latihan-3.html`:

```html
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form HTML</title>
</head>
<body>
  <form method="post" action="">
    <fieldset>
      <legend>Masukkan data dengan tepat</legend>

      Nama: <input type="text" name="nama" maxlength="30"><br>
      Password: <input type="password" name="password" maxlength="6"><br>

      Jenis Kelamin:<br>
      <input type="radio" name="jenis_kelamin" value="l" checked> Laki-laki<br>
      <input type="radio" name="jenis_kelamin" value="p"> Perempuan<br>

      Hobi:<br>
      <input type="checkbox" name="hobi_mancing" value="mancing" checked> Mancing<br>
      <input type="checkbox" name="hobi_berburu" value="berburu"> Berburu<br>

      Pilih Kota:<br>
      <select name="kota">
        <option value="jakarta">Jakarta</option>
        <option value="surabaya" selected>Surabaya</option>
      </select><br>

      Pesan:<br>
      <textarea name="pesan" rows="3" cols="30">Tulis pesan di sini</textarea><br>

      Upload Foto:<br>
      <input type="file" name="file_user">
    </fieldset>

    <fieldset>
      <legend>Selesai</legend>
      <input type="submit" value="SUBMIT">
      <input type="reset" value="CANCEL">
    </fieldset>
  </form>
</body>
</html>
```

---

## Tugas Akhir Modul

Buat **2 file HTML** berikut:

1. `index.html`
   - Berisi tabel data siswa minimal 4 kolom: **NIS, Nama, Alamat, Email**.
   - Setiap baris siswa memiliki kolom **foto** (boleh gambar bebas).
   - Tambahkan link ke halaman `daftar.html`.

2. `daftar.html`
   - Berisi form pendaftaran siswa (minimal: NIS, Nama, Alamat, Email, Jenis Kelamin).
   - Tambahkan tombol submit dan reset.
   - Tambahkan link kembali ke halaman `index.html`.

Ketentuan:
- Gunakan struktur HTML lengkap (`<!DOCTYPE html>`, `head`, `body`).
- Gunakan path gambar/link dengan benar (relatif atau absolut sesuai kebutuhan).
- Kode harus **rapi dan tertib indentasi**.
- Beri komentar pada bagian penting kode jika diperlukan.
