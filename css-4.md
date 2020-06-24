# Modul 6 - Animasi CSS

Tujuan Pembelajaran: Mahasiswa mengenal konsep animasi elemen HTML menggunakan CSS dan dapat menggunakan animasi dengan CSS untuk membuat tampilan di halaman web lebih menarik

## Materi

* Dengan animasi di CSS kita dapat membuat transisi perubahan suatu kondisi pada sebuah elemen ke kondisi lain dengan lebih baik.
* Kelebihan membuat animasi dengan CSS adalah lebih mudah karena tanpa harus mengetahui kode Javascript, serta animasi yang dihasilkan dapat berjalan lebih "halus" dan efisien.
* Untuk membuat animasi digunakan __```@keyframes```__ dan properti __```animation```__.

### ```@keyframes```

* Urutan animasi disimpan dalam ```@keyframes``` yang terdiri dari dua atau lebih "kondisi" dari elemen yang akan dianimasikan. Setiap keyframe akan menentukan bagaimana elemen harus ditampilkan pada kurun waktu tertentu pada urutan animasi secara keseluruhan.
* Keyframes menggunakan prosentase dari total keseluruhan animasi dimana dimulai dari 0% (animasi dimulai) sampai 100% (animasi selesai).
* Karena pentingnya posisi 0% dan 100% maka ada kata lain yang dapat digunakan yaitu __```from```__ yang berarti 0% dan __```to```__ yang berarti 100%.
* Cara pembuatan atau contoh kode pembuatan ```@keyframes``` adalah:

```css
@keyframes namaAnimasi {
  0% {
    background-color: red;
  }

  100% {
    background-color: blue;
  }
}
```

* Dengan kode diatas maka awal animasi pada ```0%``` (atau dapat ditulis dengan __```from```__) elemen memiliki background warna merah dan diakhir animasi ```100%``` (atau dapat ditulis dengan ```to```) elemen memiliki background warna biru.

### Properti ```animation```

* Properti ```animation``` berguna untuk menentukan beberapa hal antara lain durasi animasi, _timing_ dan detail animasi lainnya. Properti ini memiliki sub properti yaitu:
  - ```animation-name```: menentukan nama animasi mana yang digunakan pada ```@keyframes``` yang telah dibuat.
  - ```animation-duration```: durasi atau lama dari animasi untuk menyelesaikan satu putaran / _cycle_ animasi. contohnya: 5s (5 detik).
  - ```animation-timing-function```: mengatur _timing_ animasi, bagaimana transisi animasi pada keyframes dengan menentukan kurva akselerasi.
  - ```animation-delay```: mengatur waktu elemen diload dan animasi akan dimulai.
  - ```animation-iteration-count```: jumlah berapa kali animasi akan diulang. set ```infinite``` untuk animasi yang diulang terus menerus.
  - ```animation-direction```: mengatur apakah animasi harus berganti arah setiap kali dijalankan pada urutan atau mereset ke titik awal.
  - ```animation-fill-mode```: mengatur nilai yang digunakan animasi sebelum dan sesudah dijalankan
  - ```animation-play-state```: membuat kita dapat melanjutkan akan menghentikan sementara sebuah animasi

## Praktikum

* Ketik ulang kode yang mengubah ukuran dan background elemen ```div``` berikut:

```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Animasi CSS</title>
  <style>
:root {
  --color-1: #ff0000;
  --color-2: #ffee00;
  --width-1: 200px;
}

@keyframes ubahBackground {
  from {
    background-color: var(--color-1);
    width: var(--width-1);
  }
  50% {
    background-color: var(--color-2);
    width: 350px;
    transform: rotate(90deg);
  }
  75% {
    transform: rotate(-90deg);
  }
  to {
    background-color: var(--color-1);
    width: var(--width-1);
    transform: rotate(0deg);
  }
}

.kotak-warna {
  width: 250px;
  height: 150px;
  background-color: var(--color-1);
  overflow: hidden;
  padding: 10px;

  /** Bagian Animasi **/
  animation-name: ubahBackground;
  animation-duration: 3s;
  animation-iteration-count: infinite;
}

.container {
  width: 100%;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

@keyframes textJalan {
  from {
    margin-left: 100%;
    width: 300%;
    color: black;
  }
  to {
    margin-left: 0;
    width: 100%;
    color: rgba(0, 0, 0, .2);
  }
}

p {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;

  /** Bagian Animasi **/
  animation-name: textJalan;
  animation-duration: .5s;
  animation-iteration-count: infinite;
  animation-direction: alternate;
}
  </style>
</head>
<body>
  <div class="container">
    <div class="kotak-warna">
      <p>Lorem ipsum dolor sit amet</p>
    </div>
  </div>
</body>
</html>
```

## Tugas

- Hasil ketikan dan outputnya masukkan dalam laporan