# Modul 5 - JavaScript Fundamentals

Tujuan Pembelajaran: Mahasiswa memahami sintaks dasar JavaScript, struktur kontrol, dan fungsi untuk logika pemrograman di sisi client.

## Materi
JavaScript adalah bahasa pemrograman yang berjalan di browser.
- **Variabel**: `let`, `const`.
- **Tipe Data**: String, Number, Boolean, Array, Object.
- **Kontrol**: `if/else`, `for`, `while`.
- **Fungsi**: Function declaration dan Arrow functions (`=>`).

## Praktikum
```javascript
let prodi = "Informatika";
const mahasiswa = ["Ali", "Budi", "Cici"];

function sapa(nama) {
  return `Halo, ${nama}!`;
}

console.log(sapa(mahasiswa[0]));
```

## Tugas
1. Buat fungsi untuk menghitung rata-rata nilai mahasiswa dari sebuah array.
2. Gunakan loop untuk menampilkan nama-nama mahasiswa yang lulus (nilai > 70).
