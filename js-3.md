# Modul 12 - Promise & Request HTTP Asinkron

Tujuan Pembelajaran: Mahasiswa mengenal konsep asinkron dan menggunakan Promise dan Request HTTP Asinkron untuk membuat halaman web yang lebih dinamis dan interaktif

## Materi

### Promise

* __```Promise```__ digunakan untuk komputasi asinkron dan terselesaikan nanti dan tidak dapat ditentukan berapa lama komputasi dikerjakan.

* Untuk membuat Promise digunakan perintah seperti berikut:

```js
new Promise((resolve, reject) => { ... });
```

* Parameter yang dimasukkan ke dalam Promise adalah fungsi dengan argumen ```resolve``` dan ```reject```. Fungsi tersebut akan melakukan pekerjaan asinkron dan ketika selesai maka akan dipanggil fungsi ```resolve``` atau ```reject``` tergantung pada kondisi yang ada.

* State atau kondisi dalam Promise dibagi menjadi 3 yaitu:
  - __pending__: awal eksekusi, status menunggu diselesaikan
  - __sukses (fulfilled)__: komputasi diselesaikan dengan sukses
  - __gagal (rejected)__: komputasi selesai namun gagal

* Promise dan memberikan hasil berupa apapun dan ketika selesai maka akan ditangani dengan method ```then```. Sedangkan untuk menangani gagal digunakan method ```catch```.

```js
const p1 = new Promise((resolve, reject) => {
  console.info('Promise dimulai');
  setTimeout(() => {
    const number = Math.floor(Math.random() * 100);
    console.log(number);
    if (number < 50) {
      reject(false);
    } else {
      resolve(true); // true bisa diganti value apapun
    }
  }, 3000);
});

// panggil promise
p1.then(val => {
  console.warn('Promise selesai dengan sukses');
}).catch(err => {
  console.error('Promise selesai namun gagal');
});
```

* Pada kode diatas, terdapat skenario sebuah komputasi yang dikerjakan selama 3 detik (3000 milisecond) yang menghitung angka acak antara 0-99, jika dibawah 50 Promise akan mereject (selesai tapi gagal) dan jika diatas 50 Promise akan meresolve (selesai dan sukses).

### Async Await

* Ketika menangani Promise, kita akan sering menggunakan rangkaian kata kunci ```then``` dan ```catch```. Namun kita juga dapat menghindari pola penulisan tersebut menjadi lebih bersih menggunakan Async dan await.

```js
function resolveSetelahNDetik() {
  return new Promise((resolve, reject) => {
    const number = Math.floor(Math.random() * 11);
    setTimeout(() => {
      resolve(number);
    }, number * 1000);
  });
}

async function callAsync() {
  const result = await resolveSetelahNDetik();
  console.log(`Selesai dalam ${result} detik`);
}

console.info('Eksekusi dimulai');
callAsync(); // panggil fungsi
console.info('Dieksekusi diluar Promise');
```

* Untuk menggunakan kata kunci ```await``` kita harus "membungkus" kode dalam fungsi Async. Hal ini untuk agak membingungkan pada awalnya namun secara umum penggunaan asyc await dapat digunakan untuk menghindari penggunaan kata kunci ```then``` sehingga mempermudah pembacaan kode

### Fetch

* Kita dapat mengirimkan request HTTP secara asinkron menggunakan ```fetch``` di Javascript. Request yang asinkron membuat aplikasi web kita menjadi lebih interaktif karena kita dapat meminta data ke server tanpa user harus mereload ulang halaman webnya. Request asinkron sering disebut dengan AJAX = Asynchronous JavaScript And XML.

```js
async function loadMahasiswa() {
  const response = await fetch(
    'https://api.unira.ac.id/v1/mahasiswa?limit=5&prodi=52&filter[nim]=2018520'
  );
  return response.json(); // return json() -> Promise
}

loadMahasiswa().then(data => {
  console.table(data.data);
});
```

* Kode diatas adalah fungsi ```fetch``` yang digunakan untuk mengambil data JSON (JavaScript Object Notation) yang ada di server ```api.unira.ac.id``` menggunakan method ```GET```. Jika dijalankan di browser Anda akan melihat data mahasiswa dengan NPM yang mirip __2018520__.

## Praktikum

* Dengan menggunakan kode dari Praktikum [Modul 8](https://github.com/NazirArifin/modulweb/blob/master/php-2.md), kita akan memodifikasi file form htmlnya dengan menggunakan JavaScript sehingga tanpa pindah halaman kita bisa mengirim data form dan file ke server.

* Berikut adalah kode file __form.php__:

```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendaftaran Beasiswa</title>
  <style>
body {
  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
}
.container {
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}
.container form {
  padding: 20px 20px 10px 20px;
  background-color: coral;
  border-radius: 4px;
  min-width: 450px;
}
ul li {
  font-size: 12px;
  color: maroon;
  font-weight: bold;
}
h3 {
  text-align: center;
  font-size: 22px;
}
.input-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}
label {
  font-size: 12px;
  padding-top: 10px;
}
input {
  width: 300px;
  padding: 10px 7px;
  border-radius: 4px;
  border: 1px solid orangered;
}
button {
  padding: 10px 15px;
  border-radius: 4px;
  border: 2px solid orangered;
}
  </style>
</head>
<body>
  <div class="container">
    <form action="/daftar" method="post" enctype="multipart/form-data">
      <h3>FORM PENDAFTARAN MAHASISWA</h3>
      <div class="error">
        <ul>
          <li>Email tidak valid</li>
        </ul>
      </div>
      <hr>
      <div class="input-row">
        <label for="nama">Nama:</label>
        <div class="input">
          <input type="text" name="nama" id="nama" minlength="3" maxlength="60" required>
        </div>
      </div>
      <div class="input-row">
        <label for="email">Email:</label>
        <div class="input">
          <input type="email" name="email" id="email" minlength="5" maxlength="60" required>
        </div>
      </div>
      <div class="input-row">
        <label for="foto">Foto:</label>
        <div class="input">
          <input type="file" accept=".jpg,.jpeg,.png" name="foto" id="foto" required>
        </div>
      </div>
      <div class="input-row">
        <label for=""> </label>
        <div class="input">
          <button type="submit">DAFTAR BEASISWA</button>
        </div>
      </div>
    </form>
  </div>

  <script>
document.addEventListener('DOMContentLoaded', () => {
  // tambahkan event click di button
  document.querySelector('button').addEventListener('click', event => {
    // cegah submit
    event.preventDefault();

    const input = document.querySelectorAll('input');
    // check input nama 
    if ( ! input[0].checkValidity()) {
      return alert('Nama tidak valid!');
    }
    // check email
    if ( ! input[1].checkValidity()) {
      return alert('Email tidak valid!');
    }
    // check file
    if ( ! input[2].checkValidity()) {
      return alert('File tidak valid!');
    }

    // data yang akan dikirim, karena ada File maka gunakan FormData
    const formData = new FormData();
    formData.append('nama', input[0].value);
    formData.append('email', input[1].value);
    formData.append('foto', input[2].files[0]);

    // kirim ke server, tampilkan animasi atau teks loading bila perlu
    // event.target.innerHTML = 'LOADING...';
    fetch('/daftar', {
      method: 'POST',
      redirect: 'manual',
      body: formData
    }).then(response => {
      // sukses, munculkan pesan
      // event.target.innerHTML = 'DAFTAR BEASISWA';
      // kosongkan lagi input
      alert('Data tersimpan!');
    }).catch(error => {
      console.error('Error: ', error);
    });
  });
});
  </script>
</body>
</html>
```

* Kode __index.php__ dapat Anda ambil dari modul 8. Jika sukses maka file akan berhasil diupload dan tersimpan di folder __upload__.

## Tugas

* Ketik ulang dan masukkan hasilnya ke laporan!

