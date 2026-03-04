# Modul 6 - DOM & Asynchronous JavaScript

Tujuan Pembelajaran: Mahasiswa mampu memanipulasi elemen HTML secara dinamis dan melakukan integrasi data melalui API secara asinkron (Fetch).

## Materi
- **DOM**: Cara JavaScript mengakses dan mengubah struktur HTML (`document.getElementById`, `querySelector`).
- **Events**: Menangani interaksi user (`click`, `submit`).
- **Async/Await**: Menangani proses yang memakan waktu lama.
- **Fetch API**: Mengambil data dari server tanpa refresh halaman.

## Praktikum
```javascript
async function getData() {
  const res = await fetch('https://api.github.com/users/octocat');
  const data = await res.json();
  document.getElementById('nama').innerText = data.name;
}
```

## Tugas
1. Buat aplikasi "Click Counter" sederhana.
2. Buat fitur pencarian user GitHub menggunakan Fetch API dan tampilkan fotonya di halaman web.
