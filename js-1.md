# Modul 10 - Javascript dan Typescript

Tujuan Pembelajaran: Mahasiswa mengenal bahasa pemrograman Javascript sebagai bahasa pemrograman sisi client dan dapat menggunakannya dalam pembuatan halaman web yang interaktif

## Materi

* Javascript (disingkat "JS") adalah bahasa satu-satunya yang secara resmi berjalan di browser untuk menambah interaktifitas di halaman web. Saat ini Javascript juga dapat berjalan di lingkungan server (bukan browser) seperti di Node.JS.

* Untuk memasukkan Javascript ke halaman web dapat dilakukan dengan dua cara yaitu secara internal (script ada di halaman tersebut) atau eksternal (script ada diluar dokumen).

* Baik internal maupun eksternal, tag script biasanya diletakkan di dalam tag ```head``` atau tepat sebelum penutup tag ```body```. Contoh script internal adalah sebagai berikut:

```html
<head>
  <title>Javascript</title>
  <script>
    // kode Javascript diletakkan disini
  </script>
```

* Untuk Javascript eksternal cara memasukkannya juga menggunakan tag ```script``` namun menggunakan atribut ```src``` yang isinya url dari file Javascript yang akan dimasukkan. Pola URL sama dengan waktu memasukkan gambar atau file CSS di halaman web.

```html
<head>
  <script src="script.js" defer></script>
</head>
```

* Properti ```defer``` pada tag ```script``` eksternal berguna untuk memberitahu browser untuk menunda eksekusi Javascript dan melanjutkan memuat file lain sampai semua file dan elemen HTML selesai di render. Jika tidak ditambah ```defer``` maka browser akan "menunggu" file selesai di download. Untuk file yang besar akan menunda browser menampilkan isi dokumen dan tentu saja mempengaruhi kesan dari penggunaa karena halaman terasa "lambat"

### Variabel

* Untuk mendeklarasikan variabel digunakan kata kunci ```let``` dan ```const```. Beberapa kode (terutama kode jaman dulu) masih menggunakan kata kunci ```var```, tapi mulai sekarang kita akan menggunakan kata kunci ```let``` dan ```const```.

* Perbedaan ```let``` dan ```const``` adalah dengan let kita berasumsi bahwa nilai variabel nanti akan bisa berubah, sedangkan const kita yakin bahwa nilai variabel tidak akan pernah berubah sampai selesai

```js
let myVariable = 1;
myVariable = 2;

const myName = 'Zainul';
myName = 'Zaini'; // error, karena const tidak bisa diubah nilainya
```

* Nilai variabel bisa berupa apapun, bisa berupa String, Angka, Boolean, Array ataupun Object.

### Operator dan Struktur Kendali

* Operator yang digunakan di Javascript sama dengan operator di bahasa pemrograman C++, Java ataupun PHP. Selain itu, untuk struktur kendali seperti if, else, switch, while, for, dsb juga sama dengan di bahasa pemrograman lain.

### Array

* Array di Javascript bisa menerima apapun tipe data dan bisa campur aduk, namun untuk key harus berupa angka (tidak sepertih PHP yang bisa menggunakan key string)

```js
let sequence = [1, 1, 2, 3, 5, 8, 13];
let random = ['tree', 795, [0, 1, 2]];

console.log(random[0]); // mengakses array
console.log(sequence.length); // panjang array
sequence.push(14); // menambah elemen
```

### Fungsi (Function)

* Hampir sama dengan PHP, untuk membuat fungsi digunakan kata kunci ```function``` yang diikuti oleh nama fungsinya seperti contoh berikut:

```js
function perkalian(angka1, angka2) {
  return angka1 * angka2;
}

console.log(perkalian(4, 5)); // lihat di console browser
```

* Javascript memiliki cukup banyak fungsi bawaan yang dapat digunakan seperti ```alert()```, ```prompt()```, ```confirm()```, dsb. Selain itu juga terdapat banyak fungsi di object tertentu seperti misalkan ```filter()``` dan ```map()``` di object Array.

* Di Javascript Anda akan seringkali menemukan fungsi anonim (Closure) dinama terdapat fungsi tanpa nama yang biasanya dibuat untuk kode yang hanya satu kali saja digunakan (tidak dipakai oleh kode lain).

### Objects

* Di Javascript kita bisa langsung membuat Object tanpa harus mendefinisikan Class terlebih dahulu. Setelah object terbuat kita juga masih bisa menambahkan method atau properti secara langsung. Untuk mengakses properti dan method digunakan operator dot (titik), sama dengan Java.

### Events

* Untuk membuat halaman web yang interaktif maka Javascript memiliki beberapa cara untuk menangani event / kejadian yang dialami oleh pengguna. Contohnya adalah ketika sebuah tombol ditekan, kita dapat menambahkan _event handler_ di tombol menggunakan Javascript sehingga ketika di klik misalnya, kita dapat mengeksekusi kode atau penanganan tertentu.

```html
  <button type="button">Klik Saya!</button>

  <script>
// tambahkan event click di button
document.querySelector('button').onclick = function() {
  alert('Hai User!');
};

// const button = document.querySelector('button');
// button.addEventListener('click', function(evt) {
//   alert('Hai User!');
// });
  </script>
```



