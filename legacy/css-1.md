# Modul 3 - Pengenalan CSS, Variable, Selector dan Pengaturan Teks

Tujuan Pembelajaran: Mahasiswa mengenal CSS sebagai bagian dari pemrograman web dan dapat menggunakan CSS untuk mengaplikasikan style pada sebuah halaman web

## Materi

### Pengenalan CSS

* CSS adalah singkatan dari _Cascading Style Sheets_ yang merupakan bahasa yang untuk mengatur tampilan dokumen HTML dengan pola utama ```selector { deklarasi; }```, dimana deklarasi merupakan sekumpulan perintah dengan bentuk ```properti: nilainya```.
* Untuk menggunakan di dokumen HTML, dapat digunakan tiga cara yaitu _inline_, _internal_ dan _eksternal_.
* Penggunaan CSS secara inline adalah dengan menempelkan langsung style CSS ke elemen yang kita maksudkan menggunakan atribut __style="kode css"__. Contohnya adalah ```<p style="font-weight: bold">tebal</p>```. Cara seperti ini lebih cepat dalam penulisan tapi akan lebih sulit dalam manajemen pengaturan CSS nya karena style CSS menempel pada masing-masing tag HTML.
* Cara penggunaan CSS yang kedua adalah secara _internal_ dimana digunakan tag ```<style>``` di dalam head. __Pastikan tag ```<style>``` hanya di dalam ```<head>``` dan bukan di dalam ```<body>```. Contohnya adalah:

```htm
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Internal CSS</title>
  <style>
    body {
      background-color: #fff;
      font-size: 0.8em;
    }
    p {
      text-align: center;
      line-height: 1.5;
    }
  </style>
</head>
```

* Perhatikan kode diatas, tag ```<style>``` harus diletakkan di dalam ```<head>``` dan di dalam tag ```<style>``` kita deklarasikan ruleset untuk dokumen html tersebut.
* Ruleset / kode CSS memiliki pola umum: __```selector { style; style; }```__ yaitu _selector_ dikuti perintah css yang dibungkus dengan kurung kurawal. Setiap perintah dipisahkan dengan titik koma __;__ dan agar lebih mudah dibaca ditambah dengan pindah baris bila diperlukan. 
* Contohnya untuk mengubah warna _background_ body menjadi putih digunakan perintah ```body { background-color: #ffffff; }```, dimana kode ```#ffffff``` merupakan kode heksadesimal dari warna putih.
* __INFORMASI__: untuk warna dasar seperti putih, hitam, merah, kuning, hijau, biru, dsb, Anda tidak perlu menghafal kode heksadesimalnya, tapi bisa langsung menggunakan nama warna dalam bahasa Inggris, contoh: ```p { background-color: white; }```.
*  Cara penggunaan CSS yang ketiga dan hal ini sangat dianjurkan adalah menyimpan kode CSS ke file tersendiri dengan ekstensi file __namafile.css__ yang kemudian dapat dimasukkan ke dokumen html manapun menggunakan perintah / tag ```<link rel="stylesheet" href="lokasi file css">```
*  Atribut href berisi path atau url dari file css yang ingin kita masukkan dan untuk lokal path cara memasukkannya bisa menggunakan relatif dan absolut path seperti dibahas pada [modul sebelumnya](https://github.com/NazirArifin/modulweb/blob/master/html-2.md#path-relatif-dan-absolut).
*  Untuk membuat komentar di CSS sama dengan komentar multi baris di C++ yaitu dimulai dengan __/*__ dan diakhiri dengan __*/__ 

### Variabel

* Sebuah halaman web yang kompleks biasanya memiliki banyak data style yang diulang-ulang, contohnya warna yang sama digunakan untuk tag yang berbeda pada tempat yang berbeda. Seandainya ada perubahan warna, maka perlu dicari dan diganti sebanyak elemen yang menggunakan warna tersebut. Dengan variabel kita dapat menyimpan sebuah nilai dan kemudian dapat digunakan diberbagai tempat.
* Pembuatan variabel dilakukan dengan menggunakan tanda minus / _hypen_ sebanyak dua kali dan diikuti dengan nama variabel yang diinginkan. Penulisannya harus dalam ruleset CSS yang biasanya di ```:root``` _pseudo-class_ sehingga dapat digunakan secara global di dokumen HTML.
* Untuk mengakses variabel digunakan fungsi ```var()``` sehingga contoh lengkap penggunaannya di file css adalah: 
```css
:root {
  --warna-utama: green;
}

a, strong {
  color: var(--warna-utama);
}
```
### Selector

* Dengan _selector_ kita menentukan bagian html mana saja yang terkena style yang kita buat. Beberapa selector  yang sering digunakan adalah:

| Jenis           | Keterangan                                                   | Contoh                     |
| --------------- | ------------------------------------------------------------ | -------------------------- |
| Universal       | Memilih semua elemen di dokumen                              | * { .. }                   |
| Elemen          | Memilih semua elemen / tag tertentu                          | p { .. }, strong { .. }    |
| Class           | Memilih semua tag dengan class tertentu                      | .error { .. }, .big { .. } |
| ID              | Memilih elemen dengan id tertentu                            | #top { .. }                |
| Atribut         | Memilih semua elemen yang memiliki atribut tertentu          | [attr] { .. }              |
| List            | Memilih beberapa elemen dengan pemisah koma __,__            | div, span { .. }           |
| Turunan         | Digunakan spasi untuk memilih __semua elemen turunan__       | p strong { .. }            |
| Anak            | Memilih elemen __satu tingkat__ dibawah elemen tertentu dengan simbol __>__ | ul.list > li { .. }        |
| Saudara         | Memilih elemen yang memiliki orang tua / parent yang sama dengan simbol __~__ | p ~ blockquote { .. }      |
| Saudara Sebelah | Memilih elemen yang tepat bersebelahan dan memiliki parent yang sama dengan simbol __+__ | #top + p { .. }            |
| Pseudo class    | Memilih elemen berdasarkan kondisi / informasi tertentu dengan simbol __:__ Daftar lengkapnya dapat dilihat di: [Index Pseudo-Class](https://developer.mozilla.org/en-US/docs/Web/CSS/Pseudo-classes) | a:hover, a:visited { .. }  |
| Pseudo element  | Simbol __::__ untuk memilih bagian yang tidak ada di HTML. Daftar lengkapnya dapat dilihat di [Index Pseudo Element](https://developer.mozilla.org/en-US/docs/Web/CSS/Pseudo-elements) | p::first-line { .. }       |

### Pengaturan Teks
* __color__: Warna teks diubah dengan menggunakan ```color: warna``` dimana warna dapat berupa kode heksadesimal, nama warna, rgb(r, g, b) dan rgba(r, g, b, a). Contohnya: ```.error { color: red; }```
* __text-align__: Perataan teks kiri, kanan, tengah atau rata kanan kiri dapat dilakukan dengan menggunakan ```text-align: jenis``` dimana jenis bisa berupa nilai ```left, center, right, justify```. Contohnya: ```p.lead { text-align: center; }``` 
* __text-decoration__: Dekorasi teks digunakan untuk menambah atau membuat dekorasi default yang sudah ada dengan menggunakan ```text-decoration: jenis``` dimana jenisnya bisa berupa nilai ```overline, line-through, underline, none```. Contohnya: ```a { text-decoration: none; }```
* __text-transformation__: Mengubah teks apakah menggunakan kapital atau huruf kecil dengan menggunakan ```text-transform: nilai``` dimana nilai berupa ```uppercase, lowercase, capitalize```. Contohnya: ```h3 { text-transform: uppercase; }```
* __text-indent__, __letter-spacing__, __line-height__, __word-spacing__: Mengatur jarak menjorok teks, jarak antar huruf, jarak antar baris, dan jarak antar kata dilakukan perintah ```text-indent: nilai```, ```letter-spacing: nilai```, ```line-height: nilai``` dan ```word-spacing: nilai``` dimana nilainya bisa berupa satuan __px__, __cm__, __em__, __rem__, dan lain sebagainya. Contohnya: ```h1 { letter-spacing: 3px; }```

### Font

* Secara umum font digolongkan dalam tiga jenis utama yaitu __serif__ (font dengan "kaki"), __sans-serif__ (font tanpa "kaki"), dan __monospace__ (lebar tiap huruf sama).
* Di dalam font umum terdapat banyak font khusus yang disebut __font-family__ seperti Arial, Times New Roman, Tahoma, Courier New dan lain sebagainya
* Penggunaan font di css dilakukan dengan menggunakan perintah ```font-family: namafont``` dimana namafont juga lebih dari satu kata harus dibungkus tanda petik __"__.
* Perintah font-family juga bisa diberi nilai berupa list dengan pemisah koma __,__ yang menunjukkan prioritas font yang akan digunakan. Contohnya: ```p { font-family: 'Segoe UI', Tahoma, Arial, sans-serif; }```
* __INFORMASI__: tidak semua font terpasang di komputer client yang melihat web yang Anda buat, jadi usahakan selalu berikan list font yang "aman" yang umumnya ada di hampir semua komputer.
* __font-style__: Mengubah style dari font dengan menggunakan ```font-style: nilai``` dimana nilainya bisa berupa ```italic, normal```.
* __font-weight__: Mengubah ketebalan huruf dengan menggunakan ```font-weight: nilai``` dimana nilainya bisa berupa ```100-900, lighter, light, normal, bold, bolder```. Contohnya: ```h4 { font-weight: 500; }```
* __font-size__: Mengubah ukuran huruf dengan menggunakan perintah ```font-size: nilai``` dimana nilainya sama dengan pemberian nilai di pemberian jarak huruf (px, em, dsb).

### Google Font

* Google dan beberapa website lain menyediakan file font yang bisa langsung dirujuk dengan css untuk mengubah font di halaman web kita.
* Cara menggunakannya adalah cukup memasukkan css eksternal dari google di halaman web kita dan kemudian menggunakan font-family yang tersedia di style yang kita buat.

```htm
<!DOCTYPE html>
<html>
<head>
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<style>
body {
    font-family: 'Poppins';
    font-size: 22px;
}
</style>
</head>
<body>

<h1>Poppins</h1>

</body>
</html>
```

* Kekurangan dari penggunaan google font secara langsung adalah jika koneksi internet tidak ada atau lambat maka font yang kita minta bisa gagal ditampilkan.
* Salah satu caranya adalah menggunakan tool yang mengunduh font dan kemudian diletakkan di lokal folder sehingga dapat diakses kapanpun. Contoh toolnya adalah: [webfont-helper](https://google-webfonts-helper.herokuapp.com/fonts)

## Tugas

* Tulis kode HTML dasar berikut:

```html
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eksternal CSS</title>
</head>
<body>

<h1>This is a Heading</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <span>Ut enim ad minim veniam</span>, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <strong>Duis</strong> aute irure dolor in reprehenderit in voluptate <span>velit esse cillum dolore eu fugiat</span> nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt <em>mollit</em> anim id est laborum</p>
<h4>Closing statements</h4>

</body>
</html>
```

* Tambahkan beberapa kode HTML dan beberapa file CSS dan font dengan ketentuan sbb:

1. Gunakan CSS eksternal, dan masukkan ke kode HTML diatas
2. Semua elemen harus menggunakan font-family __'Poppins'__
3. Gunakan minimal 7 css pengaturan teks pada halaman HTML diatas (misalkan paragraf menjorok 20px, h1 tercetak miring, dsb)
4. Gunakan setidaknya  satu css pseudo elemen pada dokumen diatas

* Di laporan praktikum, kode sumber masukkan di bagian Praktikum sedangkan screen shot hasil + penjelasannya masukkan dalam bagian Tugas