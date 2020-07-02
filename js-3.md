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

