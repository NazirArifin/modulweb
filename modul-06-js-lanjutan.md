# Modul 6 - JavaScript Lanjutan (ES6+, Async, Fetch, Local Storage, JSON)

Tujuan Pembelajaran: Mahasiswa mampu mengambil dan menampilkan data dari API dengan pendekatan JavaScript modern (ES6+), memahami asynchronous JavaScript, serta memanfaatkan JSON dan local storage.

## Materi

### 1) ES6+ Features

Fitur ES6+ yang sering digunakan:
- `let` dan `const`
- Arrow function
- Template literal
- Destructuring
- Spread/rest operator

Contoh:

```javascript
const user = { nama: "Alya", umur: 21 };
const { nama, umur } = user;

const nilai = [80, 85, 90];
const semuaNilai = [...nilai, 95];

const sapa = (namaUser) => `Halo, ${namaUser}`;
```

### 2) Asynchronous JavaScript

Asynchronous JavaScript menangani proses yang membutuhkan waktu (misalnya akses API).

Konsep utama:
- Promise (`then`, `catch`)
- `async/await`

```javascript
function tungguData() {
  return new Promise((resolve) => {
    setTimeout(() => resolve("Data siap"), 1000);
  });
}
```

### 3) Fetch API

`fetch()` digunakan untuk request HTTP dari browser.

```javascript
async function getUser() {
  const response = await fetch("https://api.github.com/users/octocat");
  const data = await response.json();
  return data;
}
```

### 4) JSON

JSON (_JavaScript Object Notation_) adalah format pertukaran data.

Konversi data:
- `JSON.stringify(obj)` untuk object → string
- `JSON.parse(str)` untuk string → object

```javascript
const dataMahasiswa = { nama: "Budi", angkatan: 2023 };
const jsonString = JSON.stringify(dataMahasiswa);
const kembaliObjek = JSON.parse(jsonString);
```

### 5) Local Storage

`localStorage` menyimpan data di browser secara persisten.

```javascript
localStorage.setItem("tema", "dark");
const tema = localStorage.getItem("tema");
localStorage.removeItem("tema");
```

---

## Praktikum

### Tugas Praktikum 1 - ES6+ dan JSON

1. Buat array object data mahasiswa.
2. Gunakan destructuring untuk mengambil properti tertentu.
3. Simpan data ke format JSON string dan kembalikan lagi ke object.

### Tugas Praktikum 2 - Async/Await dan Fetch API

1. Ambil data user dari API publik (misalnya GitHub Users API).
2. Tampilkan `name`, `login`, dan `avatar` ke halaman.
3. Tangani error dengan `try...catch`.

Contoh dasar:

```javascript
async function loadProfile(username) {
  try {
    const response = await fetch(`https://api.github.com/users/${username}`);
    if (!response.ok) throw new Error("User tidak ditemukan");

    const data = await response.json();
    document.getElementById("nama").textContent = data.name || "-";
    document.getElementById("username").textContent = data.login;
    document.getElementById("avatar").src = data.avatar_url;
  } catch (error) {
    alert(error.message);
  }
}
```

### Tugas Praktikum 3 - Local Storage

1. Buat fitur input catatan singkat.
2. Saat tombol simpan ditekan, simpan catatan ke `localStorage`.
3. Saat halaman dimuat ulang, catatan sebelumnya otomatis ditampilkan kembali.

---

## Tugas

1. Buat mini app “Profil GitHub Favorit”:
   - user memasukkan username GitHub,
   - aplikasi mengambil data via `fetch`,
   - menampilkan avatar, nama, dan bio.
2. Simpan username terakhir yang dicari ke `localStorage` agar otomatis muncul saat reload.
3. Gunakan minimal 2 fitur ES6+ (misalnya arrow function, template literal, destructuring).
4. Kumpulkan source code dan screenshot hasil eksekusi.
