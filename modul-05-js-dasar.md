# Modul 5 - JavaScript Dasar (Behavior Layer)

Tujuan Pembelajaran: Mahasiswa mampu menambahkan interaksi dinamis pada halaman web menggunakan JavaScript dasar meliputi variabel, tipe data, function, DOM manipulation, event handling, dan validasi form sederhana.

## Materi

### 1) Variabel dan Tipe Data

JavaScript berjalan di browser untuk mengatur perilaku halaman web.

Deklarasi variabel:
- `let` untuk nilai yang dapat berubah
- `const` untuk nilai tetap

Tipe data dasar:
- `String`, `Number`, `Boolean`
- `Array`, `Object`
- `null` dan `undefined`

Contoh:

```javascript
let nama = "Budi";
const umur = 20;
const aktif = true;
const hobi = ["membaca", "futsal"];
const mahasiswa = { nim: "2211001", prodi: "Informatika" };
```

### 2) Function

Function digunakan untuk membungkus logika agar dapat dipakai ulang.

```javascript
function sapa(nama) {
  return `Halo, ${nama}!`;
}

const hitungLuas = (panjang, lebar) => panjang * lebar;
```

### 3) DOM Manipulation

DOM (_Document Object Model_) memungkinkan JavaScript membaca/mengubah elemen HTML.

Contoh operasi DOM:
- `document.getElementById()`
- `document.querySelector()`
- mengubah `textContent`, `innerHTML`, `style`, dan atribut

```javascript
const judul = document.getElementById("judul");
judul.textContent = "Belajar JavaScript Dasar";
```

### 4) Event Handling

Event digunakan untuk merespons aksi pengguna seperti klik tombol atau submit form.

```javascript
const tombol = document.querySelector("#btnKlik");
tombol.addEventListener("click", function () {
  alert("Tombol diklik");
});
```

### 5) Validasi Form Dasar

Validasi dilakukan sebelum data dikirim agar input lebih aman dan konsisten.

Contoh validasi sederhana:
- Nama tidak boleh kosong
- Password minimal 6 karakter
- Email harus mengandung `@`

```javascript
const form = document.getElementById("formDaftar");

form.addEventListener("submit", function (event) {
  const namaInput = document.getElementById("nama").value.trim();
  const emailInput = document.getElementById("email").value.trim();

  if (namaInput === "" || !emailInput.includes("@")) {
    event.preventDefault();
    alert("Nama dan email wajib valid.");
  }
});
```

---

## Praktikum

### Tugas Praktikum 1 - Variabel, Tipe Data, dan Function

1. Buat file `latihan-js-1.js`.
2. Definisikan minimal 3 variabel dengan tipe data berbeda.
3. Buat function untuk menghitung nilai akhir mahasiswa dari 3 komponen nilai.
4. Tampilkan hasilnya di console.

### Tugas Praktikum 2 - DOM Manipulation dan Event

1. Buat file HTML berisi judul, paragraf, dan tombol.
2. Saat tombol diklik, ubah teks judul dan warna paragraf.
3. Tambahkan tombol kedua untuk mengembalikan kondisi awal.

### Tugas Praktikum 3 - Form Validation Dasar

1. Buat form sederhana berisi `nama`, `email`, dan `password`.
2. Cegah submit jika ada field kosong.
3. Tampilkan pesan kesalahan dengan JavaScript.

---

## Tugas

1. Buat halaman registrasi sederhana (HTML + JS) dengan ketentuan:
   - validasi nama wajib diisi,
   - validasi email mengandung `@`,
   - validasi password minimal 6 karakter.
2. Tambahkan interaksi tombol untuk menampilkan ringkasan data yang valid pada elemen `<div>` di halaman.
3. Kumpulkan source code dan screenshot hasil uji validasi (kasus valid dan tidak valid).
