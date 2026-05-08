# Modul 6 - JavaScript Lanjutan (ES6+, Async, Fetch, Local Storage, JSON)

Tujuan Pembelajaran: Mahasiswa mampu mengambil dan menampilkan data dari API dengan pendekatan JavaScript modern (ES6+), memahami asynchronous JavaScript, serta memanfaatkan JSON dan local storage.

## Materi

### 1) ES6+ Features

Fitur ES6+ (ECMAScript 2015+) membawa perubahan besar pada cara kita menulis JavaScript agar lebih efisien dan mudah dibaca.

#### a. Arrow Function
Arrow function adalah cara singkat untuk menulis fungsi menggunakan tanda panah (`=>`).

- **Sintaks Dasar**:
  ```javascript
  const tambah = (a, b) => {
    return a + b;
  };
  ```
- **Implicit Return**: Jika hanya satu baris, kurung kurawal dan kata kunci `return` bisa dihapus.
  ```javascript
  const kali = (a, b) => a * b;
  const sapa = nama => `Halo, ${nama}`; // Jika satu parameter, kurung bisa dihapus
  ```

#### b. Destructuring
Memungkinkan kita "membongkar" nilai dari array atau properti dari objek ke dalam variabel tersendiri dengan cara yang lebih ringkas.

- **Object Destructuring**:
  ```javascript
  const mhs = { nama: "Alya", umur: 21, prodi: "Informatika" };
  
  // Mengambil properti langsung sebagai variabel
  const { nama, prodi } = mhs;
  console.log(nama); // "Alya"
  
  // Alias dan Default Value
  const { nama: namaLengkap, gender = "Perempuan" } = mhs;
  ```
- **Array Destructuring**:
  ```javascript
  const warna = ["merah", "hijau", "biru"];
  const [satu, dua] = warna;
  console.log(satu); // "merah"
  ```

#### c. Spread Operator (`...`)
Digunakan untuk menyebarkan (expand) elemen array atau properti objek ke tempat lain.

- **Pada Array**: Digunakan untuk menyalin atau menggabungkan array.
  ```javascript
  const angka = [1, 2, 3];
  const angkaBaru = [...angka, 4, 5]; // [1, 2, 3, 4, 5]
  ```
- **Pada Objek**: Sangat berguna untuk mengupdate data tanpa mengubah objek asli (Immutability).
  ```javascript
  const user = { id: 1, nama: "Budi" };
  const updateEmail = { ...user, email: "budi@mail.com" }; 
  // Hasil: { id: 1, nama: "Budi", email: "budi@mail.com" }
  ```

#### d. Template Literals
Menggunakan backtick (`` ` ``) untuk menyisipkan variabel langsung di dalam string.
```javascript
const matkul = "Web";
console.log(`Selamat belajar ${matkul}`);
```

### 2) Asynchronous JavaScript

JavaScript secara default bersifat *synchronous* (menjalankan baris kode satu per satu). Namun, untuk proses yang memakan waktu (seperti mengambil data dari internet), kita membutuhkan *asynchronous* agar browser tidak "hang" atau membeku saat menunggu proses selesai.

#### a. Konsep Promise
`Promise` adalah objek yang mewakili keberhasilan atau kegagalan dari sebuah operasi asynchronous. 
Analogi: Anda memesan makanan (Promise), Anda menunggu (Pending), makanan datang (Fulfilled/Resolved), atau stok habis (Rejected).

- **Cara membuat Promise**:
  ```javascript
  const janjiLari = new Promise((resolve, reject) => {
    let selesai = true;
    if (selesai) resolve("Lari selesai!");
    else reject("Gagal lari.");
  });
  ```
- **Menggunakan Promise (.then & .catch)**:
  ```javascript
  janjiLari
    .then(result => console.log(result)) // Jika berhasil
    .catch(error => console.error(error)); // Jika gagal
  ```

#### b. Async / Await
`async/await` adalah cara penulisan kode asynchronous yang membuatnya terlihat dan terbaca seperti kode *synchronous*. Ini dibangun di atas Promise agar lebih rapi.

- **`async`**: Digunakan sebelum deklarasi fungsi untuk menandakan bahwa fungsi tersebut mengembalikan Promise.
- **`await`**: Digunakan di dalam fungsi async untuk menghentikan sementara eksekusi sampai Promise selesai (settled).

**Contoh Perbandingan**:

1. **Menggunakan Promise Biasa**:
   ```javascript
   function ambilData() {
     fetch("https://api.github.com/users/octocat")
       .then(res => res.json())
       .then(data => console.log(data))
       .catch(err => console.log(err));
   }
   ```

2. **Menggunakan Async / Await (Lebih Rapi)**:
   ```javascript
   async function ambilData() {
     try {
       const response = await fetch("https://api.github.com/users/octocat");
       const data = await response.json();
       console.log(data);
     } catch (error) {
       console.error("Terjadi error:", error);
     }
   }
   ```

> [!TIP]
> Selalu gunakan `try...catch` saat menggunakan `async/await` untuk menangani error jika request gagal.

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
