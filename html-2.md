# Modul 2 - Image, Link, Table & Form

Tujuan Pembelajaran: Mahasiswa mengenal HTML sebagai bagian dari pemrograman web dan dapat membuat halaman web sederhana dengan HTML

## Materi

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

![path1](E:\Kuliah Ajar\Praktikum\Pemrograman Web\img\2-1.png)

* Kode HTML di file __index.html__ untuk menampilkan gambar __einstein.jpg__ adalah:

```html
<img src="image/einstein.jpg" alt="einstein">
<!-- atau dengan ./ -->
<img src="./image/einstein.jpg" alt="einstein">
```

![path2](E:\Kuliah Ajar\Praktikum\Pemrograman Web\img\2-2.png)

* Kode HTML di file __newsimage.html__ untuk menampilkan gambar __einstein.jpg__ adalah:

```html
<img src="../einstein.jpg" alt="einstein">
```

![path3](E:\Kuliah Ajar\Praktikum\Pemrograman Web\img\2-3.png)

* Kode HTML di file __subnews.html__ untuk menampilkan gambar __einstein.jpg__ adalah:

```html
<img src="../../einstein.jpg" alt="einstein">
```

---

* Path absolute adalah mengakses resource dengan menggunakan alamat absolut resource tujuan dan mengabaikan lokasi berkas pemanggil. Cirinya adalah diawali dengan tanda garis miring __/__ 
* Untuk beberapa kasus, penggunaan path absolut lebih dianjurkan karena kita tidak perlu mengubah path jika berkas pemanggilnya dipindah ke lokasi lain
* Kode HTML di file __subnews.html__ untuk menampilkan gambar __einstein.jpg__ menggunakan absolute path adalah:

```html

```



### Image / Gambar

* Untuk menambahkan gambar pada halaman web, digunakan tag ```<img>``` dengan atribut ```src``` yang berisi path / URI dari file gambar yang akan dimasukkan serta ```alt``` yang berisi teks jika gambar tidak dapat dimunculkan oleh browser.
* Contoh penggunaannya adalah: ```<img src="logo.png" alt="logo">```