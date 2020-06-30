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

### String

* Bagian tipe data String hampir sama dengan fungsi-fungsi yang ada di Java, namun ada satu hal penting yang perlu diketahui yaitu penggunaan back-tick __`__ (tombolnya dibawah tombol Esc) untuk membuat string. Dengan penggunaan back-tick kita bisa membuat string interpolation (dengan ```${namaVariabel}```) dan juga mendukung multiline string.

```js
const nama = 'Broto';
const usia = 28;
const pesan = `Halo, nama saya ${nama},
usia saya ${usia}
....
`;

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

### Arrow Function

* Arrow function adalah alternatif penulisan fungsi yang biasanya digunakan serta beberapa perbedaan lain seperti binding _this_.

```js
var elements = [
  'Hidrogen',
  'Helium'
];

// map array
elements.map(function(elm) {
  return elm.length;
});

// dengan arrow function
elements.map((elm) => {
  return elm.length;
});

// jika hanya satu baris dan return bisa disingkat lagi
elements.map((elm) => elm.length);
// jika hanya satu argument kurung di argumen bisa dibuang
elements.map(elm => elm.length);
```

### Objects

* Di Javascript kita bisa langsung membuat Object tanpa harus mendefinisikan Class terlebih dahulu. Setelah object terbuat kita juga masih bisa menambahkan method atau properti secara langsung. Untuk mengakses properti dan method digunakan operator dot (titik), sama dengan Java atau menggunakan kurung siku [] seperti PHP.

```js
const person = {
  name: ['Bob', 'Smith'],
  age: 32,
  gender: 'male',
  bio: function() {
    alert(this.name[0] + ' ');
  },
  greeting: function() {
    alert('Hi!');
  }
};
console.log(person.age); // dengan dot
console.log(person['gender']); // dengan kurung siku

/*
Pola umumnya adalah: { key: value }
const objectName = {
  member1Name: member1Value,
  member2Name: member2Value,
  member3Name: member3Value
};
*/
```

* Pembuat class di Javascript jika di ES5 menggunakan __function__, sedangkan di ES6 kita bisa menggunakan kata kunci __class__ seperti bahasa pemrograman lain.

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

## Praktikum

* Buat file __index.html__ dan isikan kode berikut:

```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kuis JS</title>
  <style>
body{
  font-size: 20px;
	font-family: sans-serif;
	color: #333;
}
.question{
	font-weight: 600;
}
.answers {
  margin-bottom: 20px;
}
.answers label{
  display: block;
}
#submit{
	font-family: sans-serif;
	font-size: 20px;
	background-color: #279;
	color: #fff;
	border: 0px;
	border-radius: 3px;
	padding: 20px;
	cursor: pointer;
	margin-bottom: 20px;
}
#submit:hover{
	background-color: #38a;
}
  </style>
</head>
<body>
  <div id="quiz"></div>
  <button id="submit">Submit Quiz</button>
  <div id="results"></div>

  <script src="script.js"></script>
</body>
</html>
```

* Selanjutnya buat file __script.js__ dan letakkan bersebelahan dengan file __index.html__ sebelumnya. Isi dari __script.js__ adalah:

```js
document.addEventListener('DOMContentLoaded', function() {

  const quizContainer = document.getElementById('quiz');
  const resultsContainer = document.getElementById('results');
  const submitButton = document.getElementById('submit');
  
  // daftar pertanyaan berupa object { pertanyaan: '', jawaban: {} }
  const pertanyaan = [
    {
      pertanyaan: "Siapa penemu JavaScript?",
      jawaban: {
        a: "Douglas Crockford",
        b: "Sheryl Sandberg",
        c: "Brendan Eich"
      },
      kunciJawaban: "c"
    },
    {
      pertanyaan: "Yang manakah yang merupakan JavaScript package manager?",
      jawaban: {
        a: "Node.js",
        b: "TypeScript",
        c: "npm"
      },
      kunciJawaban: "c"
    },
    {
      pertanyaan: "Tool manakah yang digunakan untuk kualitas kode Javascript yang baik?",
      jawaban: {
        a: "Angular",
        b: "jQuery",
        c: "RequireJS",
        d: "ESLint"
      },
      kunciJawaban: "d"
    }
  ];

  // fungsi membangun quiz
  function buatQuiz(){
    // variabel untuk menampung string output HTML
    const output = [];

    pertanyaan.forEach((value, key) => {
      // variabel menampung string opsion
      const opsi = [];

      for (const huruf in value.jawaban) {
        opsi.push(
          `<label>
            <input type="radio" name="question${key}" value="${huruf}">
            ${huruf} :
            ${value.jawaban[huruf]}
          </label>`
        );
      }

      // tambahkan pertanyaan
      output.push(
        `<div class="question"> ${value.pertanyaan} </div>
          <div class="answers"> ${opsi.join('')} </div>`
      );
    });

    // gabung array lalu ubah isi dari container dengan HTML baru
    quizContainer.innerHTML = output.join('');
  }

  // function menampilkan hasil
  function tampilkanHasil() {

    // kumpulkan semua jawaban
    const jawabanContainer = quizContainer.querySelectorAll('.answers');

    // jumlah jawaban benar user
    let jumlahBenar = 0;

    pertanyaan.forEach((value, key) => {

      const container = jawabanContainer[key];
      const selector = `input[name=question${key}]:checked`;
      const jawaban = (container.querySelector(selector) || {}).value;

      // jika jawaban benar
      if (jawaban == value.kunciJawaban) {
        jumlahBenar++;

        jawabanContainer[key].style.color = 'lightgreen';
      } else {
        jawabanContainer[key].style.color = 'red';
      }

    });

    jawabanContainer.innerHTML = `${jumlahBenar} dari ${pertanyaan.length}`;
  }

  // Jalankan aplikasi
  buatQuiz();

  // Event listeners
  submitButton.addEventListener('click', tampilkanHasil);

});
```

## Tugas

* Ketik ulang dan masukkan hasilnya di laporan!



