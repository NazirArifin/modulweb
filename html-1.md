# Modul 1 - Pengenal, Struktur Dasar dan Elemen HTML

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

### Beberapa Tag HTML

* Pada umumnya nama tag html merupakan singkatan dari elemen yang ingin dimasukkan. Berikut ini adalah beberapa contoh 