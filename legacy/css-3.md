# Modul 5 - CSS Flexbox

Tujuan Pembelajaran: Mahasiswa mengenal konsep flex box di CSS dan dapat menggunakan CSS flex box untuk mengatur tampilan di halaman web

## Materi

* Flexbox Layout bertujuan untuk mempermudah dan menyediakan cara yang lebih efisien untuk meletakkan, meratakan, dan mendistribusikan jarak antar elemen dalam sebuah wadah / _container_ bahkan ketika lebar / tinggi elemen tidak diketahui (karena ini disebut dengan flex)
* Dengan flexbox kita dapat memberikan kemampuan pada  _container_ untuk mengubah lebar dan tinggi dari elemen-elemen yang ada di dalamnya agar dapat menangani semua jenis ukuran layar.
* Flexbox berdasarkan pada arah (_direction_), berbeda dengan box model umum yang didasarkan pada konsep __block__ dan __inline__.

* Flexbox diaplikasi pada ___flex container___ / wadah / induk elemen dan pada ___flex item___.
* Flex item akan ditampilkan berdasarkan arah utama (__main axis__) dan arah menyilang (__cross axis__) dan kedua arah dapat dimulai dari awal __start__ sampai ke akhir __end__.
* __PENTING__: Untuk membuat sebuah container menjadi flexbox maka digunakan perintah css (jangan sampai lupa perintah ini):

```css
div {
  display: flex;
}
```

### Daftar Perintah untuk Container (Parent)

* __flex-direction__: digunakan untuk menentukan item diletakkan secara berurutan dengan nilai:

  - _row_: (default) berjajar horizontal, dari kiri ke kanan (untuk setting ltr) atau kanan kiri (untuk setting rtl)
  - _row-reverse_: kebalikan dari row
  - _column_: berjajar vertical dari atas ke bawah
  - _column-reverse_: kebalikan dari column

![flex-direction](https://github.com/NazirArifin/modulweb/blob/master/img/flex-direction.png)

* flex-wrap: defaultnya semua elemen dalam container sebanyak apapun akan dipaksa pas satu baris. Anda dapat mengubah agar pindah baris atau tidak dengan beberapa nilai:

  - _nowrap_: (default) semua item disejajarkan dalam satu baris
  - _wrap_: item-item akan dibungkus menjadi beberapa baris bila lebih dari satu baris secara berurutan
  - _wrap_reverse_: sama dengan wrap tapi item diletakkan secara berkebalikan

![flex-wrap](https://github.com/NazirArifin/modulweb/blob/master/img/flex-wrap.png)

* flex-flow: gabungan dari __flex-direction__ dan __flex-flow__, dengan nilai defaultnya adalah __row nowrap__.

* __justify-content__: digunakan untuk mengatur perataan (_alignment_) dari elemen-elemen dalam _container_ berdasarkan pada __main axis__.  Nilainya antara lain:

  - _flex-start_: (default) semua item rata awal dari wadah (biasanya kiri)
  - _flex-end_: semua item rata akhir dari wadah (biasanya kanan)
  - _center_: di tengah
  - _space-between_: semua item didistribusikan dengan adanya jarak antar item, item pertama di awal baris dan item terakhir di akhir baris
  - _space-around_: jarak didistribusikan pada sisi kanan kiri dari item
  - _space-evenly_: jarak antara dua item sama

![justify-content](https://github.com/NazirArifin/modulweb/blob/master/img/justify-content.png)

* __align-items__: mengatur bagaimana item di tampilkan berdasarkan __cross axis__ (justify-content versi cross axis). Nilainya antara lain:

  - _stretch_: (default) item "ditarik" agar tingginya memenuhi wadah / _container_ (tetap mempertimbangkan perintah height/max-height)
  - _flex-start_: diletakkan diawal cross axis
  - _flex-end_: diletakkan diakhir cross axis
  - _center_: diletakkan ditengah
  - _baseline_: disejajarkan berdasarkan baseline

![align-items](https://github.com/NazirArifin/modulweb/blob/master/img/align-items.png)

* align-content: mengatur jarak atau peletakan item-item yang terdapat __lebih dari satu__ baris (Tidak ada efek jika hanya ada satu baris item-item). Nilainya antara lain:

  - _flex-start_: baris-baris diletakkan diawal container
  - _flex-end_: baris-baris diletakkan diakhir container
  - _center_: diletakkan di tengah
  - _space-between_: ada jarak antar item dengan baris pertama menempel awal container sedangkan baris terakhir menempel akhir dari container
  - _space-around_: ada jarak yang sama antar baris
  - _space-evenly_: ada jarak yang sama antar seluruh baris
  - _stretch_: (default) dimana baris ditarik untuk memenuhi seluruh container

![align-content](https://github.com/NazirArifin/modulweb/blob/master/img/align-content.png)

### Daftar Perintah untuk Item (Child)

* __order__: defaultnya item ditampilkan berurutan sesuai kode HTMLnya, tapi Anda bisa mengubah urutannya dengan perintah ini. Nilainya berupa angka yang menentukan urutan dari item (defaulnya 0).

![order](https://github.com/NazirArifin/modulweb/blob/master/img/order.png)

* __flex-grow__: digunakan untuk menentukan kemampuan item untuk meluas jika diperlukan. Nilainya berupa angka yang jika semua item diberi angka 1 maka _container_ akan dibagi rata untuk semua child.

![flex-grow](https://github.com/NazirArifin/modulweb/blob/master/img/flex-grow.png)

* __flex-shrink__: menentukan kemampun item untuk menyusut jika diperlukan. Nilainya berupa angka

* __flex-basis__: menentukan ukuran default sebelum dilakukan distribusi lebar/tinggi. Nilainya bisa berupa nilai yang sama ketika mengeset width atau height di box model. Nilainya juga bisa berupa beberapa kata kunci seperti: _auto_ (default), _content_ (berdasarkan isi dari item)

* __flex__: gabungan dari flex-grow, flex-shrink dan flex-basis

* __align-selt__: untuk memodifikasi perintah _alignment_ dari container (seperti align-items) dan berlaku untuk item itu saja. Nilainya sama dengan nilai di perintah align-items.

![align-self](https://github.com/NazirArifin/modulweb/blob/master/img/align-self.png)

## Praktikum

* Ketikkan kode HTML, CSS berikut dan tampilkan hasilnya di laporan
* Usahakan jangan copy paste, ketik satu persatu dan pahami, tugas UAS salah satunya adalah melakukan desain dengan flexbox layout!

```htm
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>CSS FlexBox</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div style="background:yellow;padding:5px">
      <h4 style="text-align:center">
        Ubah ukuran layar untuk melihat efek responsive
      </h4>
    </div>

    <div class="header">
      <h1>Websiteku</h1>
      <p>Dengan <b>flexible</b> layout.</p>
    </div>

    <div class="navbar">
      <a href="#">Link</a>
      <a href="#">Link</a>
      <a href="#">Link</a>
      <a href="#">Link</a>
    </div>

    <div class="row">
      <div class="side">
        <h2>About Me</h2>
        <h5>Photo of me:</h5>
        <div class="fakeimg" style="height:200px;">Image</div>
        <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
        <h3>More Text</h3>
        <p>Lorem ipsum dolor sit ame.</p>
        <div class="fakeimg" style="height:60px;">Image</div>
        <br />
        <div class="fakeimg" style="height:60px;">Image</div>
        <br />
        <div class="fakeimg" style="height:60px;">Image</div>
      </div>
      <div class="main">
        <h2>TITLE HEADING</h2>
        <h5>Title description, Dec 7, 2017</h5>
        <div class="fakeimg" style="height:200px;">Image</div>
        <p>Some text..</p>
        <p>
          Sunt in culpa qui officia deserunt mollit anim id est laborum
          consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
          labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
          exercitation ullamco.
        </p>
        <br />
        <h2>TITLE HEADING</h2>
        <h5>Title description, Sep 2, 2017</h5>
        <div class="fakeimg" style="height:200px;">Image</div>
        <p>Some text..</p>
        <p>
          Sunt in culpa qui officia deserunt mollit anim id est laborum
          consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
          labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
          exercitation ullamco.
        </p>
      </div>
    </div>

    <div class="footer">
      <h2>Footer</h2>
    </div>
    
    <!-- kode diambil dari https://www.w3schools.com/css/tryit.asp?filename=trycss3_flexbox_website2 -->
  </body>
</html>
```

```css
body {
  font-family: Arial;
  margin: 0;
}

.header {
  padding: 60px;
  text-align: center;
  background: #1abc9c;
  color: white;
}

.navbar {
  display: flex;
  background-color: #333;
}

.navbar a {
  color: white;
  padding: 14px 20px;
  text-decoration: none;
  text-align: center;
}

.navbar a:hover {
  background-color: #ddd;
  color: black;
}

.row {
  display: flex;
  flex-wrap: wrap;
}

.side {
  flex: 30%;
  background-color: #f1f1f1;
  padding: 20px;
}

.main {
  flex: 70%;
  background-color: white;
  padding: 20px;
}

.fakeimg {
  background-color: #aaa;
  width: 100%;
  padding: 20px;
}

.footer {
  padding: 20px;
  text-align: center;
  background: #ddd;
}

/* Responsive layout - when the screen is less than 700px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 700px) {
  .row,
  .navbar {
    flex-direction: column;
  }
}
```

## Tugas

* Menggunakan kode HTML berikut:

```html
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Layout Simple</title>
  </head>
  <body>
    <div class="container">
      <header>
        <h3>Header</h3>
      </header>
      <div class="hero">
        <p>Hero</p>
      </div>
      <div class="main-content">
        <div class="content">
          <p>Content</p>
        </div>
        <aside>
          <p>Sidebar</p>
        </aside>
      </div>
      <footer>
        <p>Footer</p>
      </footer>
    </div>
  </body>
</html>
```

* Tambahkan CSS eksternal, gunakan flexbox layout untuk membuat tampilan  seperti dibawah dengan ketentuan: 

  - Untuk layar kecil, sidebar dan content harus lebarnya full satu layar, sedangkan untuk layar menengah keatas sidebar dan content tampil bersebelahan
  - Untuk layar kecil, sidebar harus muncul lebih dulu di browser dibandingkan content (urutannya dibalik)
  - Selamat mengerjakan

![tugas](https://github.com/NazirArifin/modulweb/blob/master/img/tugas-3.png)