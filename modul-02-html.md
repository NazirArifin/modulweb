# Modul 2 - Dasar HTML & Struktur Dokumen

Tujuan Pembelajaran: Mahasiswa memahami struktur dasar HTML, elemen semantik, pembuatan tabel, dan form untuk pengumpulan data.

## Materi

### Struktur Dasar & Tag
HTML (HyperText Markup Language) adalah bahasa standar untuk membuat halaman web. Dokumen HTML terdiri dari elemen-elemen yang ditandai dengan tag.

### Tabel
Tabel digunakan untuk menampilkan data tabular. Tag utama: `<table>`, `<tr>` (baris), `<td>` (data), dan `<th>` (header).

### Form
Form digunakan untuk interaksi pengguna. Elemen penting: `<form>`, `<input>`, `<select>`, `<textarea>`, dan `<button>`.

## Praktikum

### 1. Link & Tabel
Buat folder baru, simpan sebagai `index.html`:
```html
<!DOCTYPE html>
<html>
<head><title>Praktikum 2</title></head>
<body>
  <h1>Daftar Mahasiswa</h1>
  <table border="1">
    <tr><th>NPM</th><th>Nama</th></tr>
    <tr><td>2022001</td><td>Ali</td></tr>
  </table>
  <a href="daftar.html">Tambah Mahasiswa</a>
</body>
</html>
```

### 2. Form Input
Simpan sebagai `daftar.html`:
```html
<form action="" method="POST">
  <label>Nama:</label>
  <input type="text" name="nama"><br>
  <button type="submit">Simpan</button>
</form>
```

## Tugas
1. Gabungkan konsep tabel dan gambar: Buat tabel daftar buku yang menyertakan kolom gambar sampul.
2. Buat form bioadata lengkap (Nama, Alamat, Tgl Lahir, Jenis Kelamin, Hobi).
3. Screenshot hasil dan kumpulkan kodenya.
