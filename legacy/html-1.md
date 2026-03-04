# Modul 1 - Pengenalan, Struktur Dasar dan Elemen HTML

Tujuan Pembelajaran: Mahasiswa mengenal HTML sebagai bagian dari pemrograman web dan dapat membuat halaman web sederhana dengan HTML

## Materi

### Struktur Dasar HTML
* HTML singkatan dari _Hypertext Markup Language_ adalah bahasa markup yang digunakan untuk memasukkan _content_ ke sebuah halaman web.

* HTML terdiri dari sekumpulan ___tag___ atau perintah yang dibungkus dengan tanda __<__ dan ditutup dengan tanda __>__. Contohnya adalah: `<html>`, `<body>`, dan lain sebagainya.

* Perintah atau tag HTML sangatlah banyak dan masing-masing tag memiliki kegunaan masing-masing. Beberapa tag memiliki tutup / _close tag_ (`body`, `head`, dsb) dan beberapa tag lain tidak memiliki tutup (`img`, `br`, dsb).

* Kerangka umum dari dokumen HTML adalah sebagai berikut:

  ```html
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  </head>
  <body>
    
  </body>
  </html>
  ```
  
* Dimulai dengan tag `DOCTYPE`, diikuti `html` yang didalamnya terdapat tag `head` dan `body`.

* Perhatikan bahwa tag `html`, `head`, dan `body` memiliki tutup tag yang cara penulisannya hampir sama dengan tag buka namun terdapat tanda __/__ , contohnya `</html>`, `</head>` dan `</body>`. Pastikan Anda tidak lupa memberikan tag tutup untuk setiap tag buka yang anda buat.

* Perhatikan pula bahwa terdapat contoh tag yang tidak memiliki tag tutup yaitu tag `meta`.

### Inline dan Block

* Secara umum, elemen html dibagi menjadi dua macam yaitu elemen yang inline dan block.
* Elemen yang _inline_ akan berusaha mengisi ruang kosong disebelah elemen lain hingga tidak ada ruang yang tersisa secara horizontal. Contoh elemen yang inline adalah ```<img>```, ```span```, dan lain sebagainya. Rata-rata elemen untuk teks merupakan elemen yang _inline_. 
* Elemen yang _block_ akan berusaha untuk pindah baris berikutnya meskipun ada ruang disekitar elemen sebelumnya. Contoh elemen block adalah ```<p>```, ```<div>```, ```<h1>``` dan lain sebagainya.
* Sifat elemen yang inline dan block dapat diubah dengan menggunakan CSS. 

### Grouping (Mengelompokkan Elemen)

* Elemen-elemen HTML dapat dikelompokkan dengan tujuan tertentu menggunakan tag span dan div. Tag span dan div tidak memiliki efek apapun pada tampilan dan dapat digunakan sebanyak yang Anda perlukan.

* Untuk mengelompokkan tag yang _inline_ digunakan perintah __span__, contohnya: 

```html
    <p>
      <span>
        Notasi: <strong>O(n<sup>2</sup>)</strong>
      </span>
    </p>
```

* Sedangkan untuk mengelompokkan tag yang _block_ digunakan perintah __div__, contohnya:

```html
  <div>
    <h2>Heading Level 2</h2>
    <hr>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
  </div>
```

#### _*Penting!_
* __Selalu usahakan tertib indentasi pada kode yang Anda ketikkan agar struktur HTML Anda lebih mudah dipahami__.
* Contoh kode yang kurang tepat (tidak tertib indentasi):

```html
  <body>
<div>
<p><small>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</small></p>
  </div>
</body>
```

* Contoh kode yang benar (tertib indentasi):
```html
<body>
  <div>
    <p>
      <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</small>
    </p>
  </div>
</body>
```

### Beberapa Tag HTML

* Pada umumnya nama tag html merupakan singkatan dari elemen yang ingin dimasukkan. Berikut ini adalah beberapa contoh tag html yang berhubungan dengan menampilkan teks:

| Tag           | Keterangan                                            | Contoh Penggunaan              |
| ------------- | ----------------------------------------------------- | ------------------------------ |
| ```<h1..6>``` | Heading dengan level 1 sampai 6 (umumnya untuk judul) | ```<h1>heading level 1</h1>``` |
| ```<p>```     | Paragraf (menyatakan teks sebagai paragraf)           | ```<p>lorem ipsum</p>```       |
| ```<em>``` | Emphasis (memberi tekanan teks tersebut)              | ```<em>lorem</em>```           |
| ```<strong>``` | Menandakan teks penting | ```<strong>penting</strong>``` |
| ```<code>``` | Teks akan dianggap sebagai kode | ```<code><?php  ?></code>``` |
| ```<i>``` | Italic, teks menjadi miring | ```<i>italic</i>``` |
| ```<b>``` | Bold, teks menjadi tebal | ```<b>bold</b>``` |
| ```<del>``` | Deleted, teks dicoret | ```<del>salah</del>``` |
| ```<small>``` | Teks menjadi lebih kecil | ```<small>kecil</small>``` |
| ```<sup>``` dan ```<sub>``` | Superscript dan subscript, misalnya untuk menuliskan pangkat | ```n<sup>2</sup>``` ```H<sub>2</sub>O``` |
| ```<!-- comment -->``` | Membuat komentar di HTML, tidak akan ditampilkan di browser | ```<!-- ini komentar -->``` |
| ```<br>``` | Break row, pindah baris | ```1<br>2``` |
| ```&entity;``` | HTML entity, biasanya untuk menampilkan simbol dan karakter yang digunakan html seperti <, >, spasi, dll. [daftar html entity](https://html.spec.whatwg.org/multipage/named-characters.html#named-character-references) | ``` nbsp; &lt; &deg; &copy; |

## Praktikum

* Ketik kode HTML berikut sebagai latihan dan pengenalan perintah-perintah HTML dan simpan dalam file html. 

```html
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HTML</title>
</head>

<body>
  <h1>HTML</h1>
  <hr>
  <!-- pengantar html -->
  <p>
    <strong><i>Hypertext Markup Language</i></strong> (HTML) adalah sebuah <em>bahasa markah</em> <del>jalan</del> yang
    digunakan untuk membuat sebuah halaman web, menampilkan berbagai informasi di dalam sebuah penjelajah web Internet
    dan pemformatan hiperteks sederhana yang ditulis dalam berkas format ASCII agar dapat menghasilkan tampilan wujud
    yang terintegrasi.
    <br>
    Bermula dari sebuah bahasa yang sebelumnya banyak digunakan di dunia penerbitan dan percetakan yang disebut dengan
    SGML (<i>Standard Generalized Markup Language</i>), HTML adalah sebuah standar yang digunakan secara luas untuk
    menampilkan halaman web. <sup>[1]</sup>
  </p>
  <h4>Sumber:</h4>
  <p>&copy; Wikipedia. 2020 &mdash; Indonesia</p>
</body>

</html>
```



## Tugas

* Buat file __index.html__ dan isi dokumen html tersebut dengan menggunakan beberapa tag yang dijelaskan di modul ini (minimal 7 tag dan beri penjelasannya)!
* __Tugas dengan kode yang tidak rapi indentasinya tidak akan saya beri nilai!__
* Kumpulkan di class edmodo yang telah dibuat untuk praktikum pemrograman web.
