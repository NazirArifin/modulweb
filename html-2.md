# Modul 2 - Image, Link, Table & Form

Tujuan Pembelajaran: Mahasiswa mengenal HTML sebagai bagian dari pemrograman web dan dapat membuat halaman web sederhana dengan HTML

## Materi

* Sebelum memulai materi perlu diperkenalkan beberapa istilah yang akan sering digunakan dalam tag / perintah yang akan dibahas pada modul ini. Istilah-istilah tersebut adalah:

#### Atribut Tag

* Setiap tag/perintah HTML dapat ditambahkan atribut tertentu dengan pola umum ```<tagnya atributnya="value">```. Contohnya: ```<img src="file.jpg">```, ```<p class="">```, dan lain sebagainya.
* Beberapa atribut diwajibkan ada namun pada umumnya atribut pada tag bersifat opsional

#### Atribut Id dan Class

* Sebuah tag bisa ditambahkan atribut __id__ dan __class__ yang biasanya digunakan untuk mempermudah proses seleksi elemen atau kebutuhan lain.
* Nilai dalam atribut __id__ harus __unik__ pada satu dokumen/file (tidak boleh ada tag yang memiliki id yang sama), sedangkan nilai atribut __class__ bisa dimiliki oleh banyak elemen / tag

#### URI (Uniform Resource Identifier)

* URI adalah string singkat yang mengidentifikasi _resource_ atau sumber daya yang tersedia di internet secara online seperti: dokumen, gambar, file yang dapat diunduh, kotak surat elektronik, dan sumber daya lain.
* Contoh URI adalah ```https://example.com```, ```https://via.placeholder.com/150```, dan lain sebagainya.

#### Path Relatif dan Absolut

* Jika resource yang kita punya ada dalam alamat URL yang sama, maka kita dapat menggunakan dua macam cara untuk mengaksesnya yaitu dengan path relatif dan absolut
* Path relatif adalah mengakses resource dengan mempertimbangkan lokasi berkas pemanggilnya. Cirinya adalah path yang __tidak diawali__ tanda garis miring __/__ (langsung nama folder/file) atau diawali dengan tanda titik __./__ atau tanda titik dua kali __../__
* Berikut ini adalah tiga (3) contoh kasus penggunaan path relatif:

![path1](https://github.com/NazirArifin/modulweb/blob/master/img/2-1.png)

* Kode HTML di file __index.html__ untuk menampilkan gambar __einstein.jpg__ adalah:

```html
<img src="image/einstein.jpg" alt="einstein">
<!-- atau dengan ./ -->
<img src="./image/einstein.jpg" alt="einstein">
```

![path2](https://github.com/NazirArifin/modulweb/blob/master/img/2-2.png)

* Kode HTML di file __newsimage.html__ untuk menampilkan gambar __einstein.jpg__ adalah:

```html
<img src="../einstein.jpg" alt="einstein">
```

![path3](https://github.com/NazirArifin/modulweb/blob/master/img/2-3.png)

* Kode HTML di file __subnews.html__ untuk menampilkan gambar __einstein.jpg__ adalah:

```html
<img src="../../einstein.jpg" alt="einstein">
```

---

* Path absolut adalah mengakses resource dengan menggunakan alamat absolut resource tujuan dan mengabaikan lokasi berkas pemanggil. Cirinya adalah diawali dengan tanda garis miring __/__ 
* Untuk beberapa kasus, penggunaan path absolut lebih dianjurkan karena kita tidak perlu mengubah path jika berkas pemanggilnya dipindah ke lokasi lain
* Kode HTML di file __subnews.html__ untuk menampilkan gambar __einstein.jpg__ menggunakan absolute path adalah:

```html
<img src="/image/einstein.jpg" alt="einstein">
<!-- perhatikan path diawali dengan tanda garis miring / tanpa titik -->
```

* __PENTING__: Path relatif dan absolut tidak hanya untuk mengakses gambar seperti pada contoh diatas, tapi juga digunakan untuk mengakses berkas html lain atau resource lainnya

### Image / Gambar

* Untuk menambahkan gambar pada halaman web, digunakan tag ```<img>``` dengan atribut ```src``` yang berisi path / URI dari file gambar yang akan dimasukkan serta ```alt``` yang berisi teks jika gambar tidak dapat dimunculkan oleh browser.
* Contoh penggunaannya adalah: ```<img src="logo.png" alt="logo">```
* Penggunaan path di atribut ```src``` sama dengan pada contoh di bagian [__Path Relatif dan Absolut__](#path-relatif-dan-absolut).
* __INFORMASI__: Pastikan file gambar yang Anda gunakan tidak terlalu besar dan juga tidak terlalu kecil. File yang terlalu besar akan memperlambat munculnya gambar dan boros bandwidth, sedangkan gambar yang terlalu kecil menyebabkan tampilan nampak kurang bagus.

#### Bandwidth Stealing (Hot Linking)?

* Istilah bandwith stealing adalah jika kita menggunakan gambar dari situs lain pada halaman web yang kita buat. Gambar yang dikirim oleh server lain ke halaman kita tentu akan mengurangi kuota bandwidth server tersebut sesuai ukuran file yang kita ambil.
* Untuk etika, usahakan jangan menampilkan gambar dari server lain tanpa seijin pemilik web, jika kita suka sebuah gambar, download file tersebut dan letakkan di server kita sendiri.
* __INFORMASI__ : bandwidth stealing bisa dicegah dengan file __.htaccess__

### Link Anchor

* Elemen dapat diberi "jangkar" sehingga kita dapat langsung menuju ke dokumen tersebut dengan menggunakan link.

## Praktikum

#### Tugas 1:

* Ketikkan kode berikut ini dan tampilkan hasilnya pada laporan: (*simpan dengan nama file __index.html__)

```html
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Link Anchor</title>
</head>

<body>
  <a href="#q1" name="top">What is CSS</a><br />
  <a href="index.html#q2">What can I do with CSS</a><br />
  <a href="#q3">What is difference between CSS and HTML?</a><br /><br /><br />
  <a name="q1"><strong>What is CSS</strong></a>
  <p>Maybe you already heard about CSS without really knowing what it is. In this lesson you will learn more about what
    CSS is and what it can do for you.
    CSS is an acronym for Cascading Style Sheets.</p>

  <a name="q2"><strong>What can I do with CSS?</strong></a>
  <p>CSS is a style language that defines layout of HTML documents. For example, CSS covers fonts, colours, margins,
    lines, height, width, background images, advanced positions and many other things. Just wait and see!</p>

  <a name="q3"><strong>What is the difference between CSS and HTML?</strong></a>
  <p>HTML is used to structure content. CSS is used for formatting structured content.</p>
  <a href="#top">kembali keatas</a>
</body>

</html>
```
* Pada kode diatas bagian ```<a href="#q1">``` merujuk pada bagian dengan name ```q1```. Jika beda file atau server perlakuannya juga sama, contohnya: ```http://example.com/index.html#faq``` maka akan menuju situs example.com dan mengarah pada anchor dengan name ```faq```.

---

* Ciri utama dari halaman web adalah kita bisa pindah-pindah dokumen dengan hanya mengklik sebuah link. Link bisa diaplikasikan pada beberapa elemen seperti teks, gambar dan elemen lain. Perintah dari pembuatan link adalah sama dengan pembuatan link anchor, contohnya: ```<a href="target_dokumen_yang_dituju">teks/gambar</a>```
* Pastikan bahwa Anda tidak lupa memberi tutup tag ```</a>``` karena pasangan ini digunakan untuk membatasi bagian mana saja yang mengandung link atau bagian mana saja yang bisa diklik.
* Pada umumnya teks yang mengandung link ditampilkan dengan garis bawah dan warna standarnya adalah biru muda (sebelum diklik) dan ungu (setelah diklik).
* Penentuan value di atribut ```href``` pada link mengikuti pola path di bagian [__Path Relatif dan Absolut__](#path-relatif-dan-absolut)

### Table

* Untuk menampilkan data agar nampak lebih terstruktur salah satunya adalah dengan menggunakan tabel (table). Berikut ini beberapa tag yang digunakan dalam pembuatan tabel:

| Tag                          | Keterangan                                                   |
| ---------------------------- | ------------------------------------------------------------ |
| ```<tr>```                   | Table Row, berfungsi menyatakan baris dalam tabel            |
| ```<td>```                   | Table Data, menyatakan isi / data dari tabel                 |
| ```<th>```                   | Table Header, menyatakan judul kolom (defaultnya tampil tebal) |
| ```<thead>```, ```<tfoot>``` | Menyatakan bagian head dan foot dari tabel                   |
| ```<tbody>```                | Menyatakan bagian tubuh / isi dari tabel                     |

* Berikut ini contoh sederhana pembuatan tabel menggunakan tag-tag diatas:

```html
  <table>
    <thead>
      <tr>
        <th>Nilai</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>left</td>
        <td>kiri</td>
      </tr>
    </tbody>
  </table>
```

#### Menggabung sel (merge)

* Untuk menggabung sel digunakan atribut __rowspan__ dan __colspan__ yang berisi angka tanpa satuan yang menandakan berapa jumlah sel yang digabung. Atribut ini digunakan pada tag ```th``` dan ```td```. Contohnya ```<td rowspan=2">``` yang berarti menggabung sel tersebut dengan sel dibawahnya.

## Praktikum

#### Tugas 2:

* Ketikkan kode berikut dibawah kode sebelumnya di [Tugas 1](#tugas-1) dan simpan.

```html
  <p>Sebelum:</p>
  <table summary="contoh rowspan colspan1" border="1" width="100%">
    <tr>
      <td width="25%">1</td>
      <td width="25%">2</td>
      <td width="25%">3</td>
      <td width="25%">4</td>
    </tr>
    <tr>
      <td width="25%">5</td>
      <td width="25%">6</td>
      <td width="25%">7</td>
      <td width="25%">8</td>
    </tr>
  </table>
  <p>Sesudah:</p>
  <table summary="contoh rowspan colspan2" border="1" width="100%">
    <tr>
      <td width="25%" rowspan="2">Sel 1 - 5 digabung</td>
      <td width="25%">2</td>
      <td width="25%">3</td>
      <td width="25%">4</td>
    </tr>
    <tr>
      <td colspan="3">Sel 6 - 7 - 8 digabung</td>
    </tr>
  </table>
```

### Form

* Form biasa digunakan untuk mengumpulkan informasi dari pengguna. Dengan form ini maka server dapat menerima informasi dari pengguna melalui kontrol seperti checkbox, radio button, list menu dan lain sebagainya.
* Form diproses oleh bahasa pemrograman sisi server seperti PHP (kita bahas PHP nanti)
* Beberapa tag yang sering digunakan adalah sebagai berikut:

| Tag              | Keterangan                                                   |
| ---------------- | ------------------------------------------------------------ |
| ```<form>```     | Membungkus semua input dengan form, beberapa properti yang sering digunakan adalah ```method``` dan ```action``` |
| ```<fieldset>``` | Mengelompokkan beberapa input                                |
| ```<legend>```   | Keterangan dari fieldset                                     |
| ```<input>```    | Terdiri dari beberapa jenis input yaitu text, password, email, radio, checkbox, file, number, dsb dengan fungsinya masing-masing |
| ```<select>```   | Input berupa list dropdown yang bisa dipilih satu atau lebih dengan atribut ```multiple``` |
| ```<textarea>``` | Input text multi baris                                       |
| ```<button>```   | Tombol dengan beberapa macam jenis seperti submit, reset, button, dsb |

* Setiap input, select, dan textarea biasanya memiliki atribut ```name``` yang akan diproses oleh bahasa pemrograman sisi server

## Praktikum

#### Tugas 3:

* Ketikkan kode berikut ini setelah kode sebelumnya pada tugas 2 dan simpan

```html
  <form method="post" action="">
    <fieldset>
      <legend>Masukkan data dengan tepat</legend>
      Nama : <input type="text" name="nama" maxlength="30">
      <br>
      Password : <input type="password" name="password" maxlength="6">
      <br>Jenis Kelamin :<br>
      <input type="radio" name="jenis kelamin" value="l" checked="checked"> Laki-laki
      <br>
      <input type="radio" name="jenis kelamin" value="p"> Perempuan
      <br>Hobi :<br>
      <input type="checkbox" name="hobi1" value="mancing" checked="checked"> Mancing
      <br>
      <input type="checkbox" name="hobi2" value="berburu"> Berburu
      <br>Pilih Kota :<br>
      <select name="kota">
        <option value="jakarta">Jakarta</option>
        <option value="surabaya" selected="selected">Surabaya</option>
      </select>
      <br>Pesan :<br>
      <textarea name="pesan" rows="3" cols="30">Tulis pesan disini</textarea>
      <br>Upload Foto :</br>
      <input type="file" name="file user" size="25">
    </fieldset>
    <fieldset>
      <legend>Selesai</legend>
      <input type="submit" value="SUBMIT"> &nbsp;
      <input type="reset" value="CANCEL">
    </fieldset>
  </form>
```

## Tugas

* Buat 2 file html dengan rincian:
* __index.html__ berisi table berisi data siswa minimal 4 kolom / field (nis, nama, alamat, email), dan setiap baris siswa memiliki foto (*sembarang)
* __daftar.html__ berisi form mendaftar
* Di file index.html terdapat link yang jika diklik pindah halaman ke daftar.html dan sebaliknya di daftar terdapat link yang jika diklik pindah ke halaman index.html
* Usahakan beri keterangan pada kode, per baris bila diperlukan!