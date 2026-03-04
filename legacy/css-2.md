# Modul 4 - CSS Box Model

Tujuan Pembelajaran: Mahasiswa mengenal konsep box model di CSS dan dapat menggunakan box model CSS untuk mengatur tampilan di halaman web

## Materi

* CSS box model diasumsikan sebagai kotak membungkus sebuah elemen html. Kotak tersebut terdiri dari __margin__, __border__, dan __padding__.
* Ilustrasi dari box model dapat dilihat pada gambar berikut:

![path1](https://github.com/NazirArifin/modulweb/blob/master/img/3-1.png)

* __Margin__ adalah jarak antar elemen (area diluar yang melengkupi sebuah kotak diluar border)
* __Border__ adalah area batas sebuah kotak, berada di dalam margin dan diluar padding
* __Padding__ adalah area disekitar isi yang dibatasi oleh border.
* Setiap margin, border dan padding memiliki empat sisi secara berurutan: __top__, __right__, __bottom__, dan __left__.
* Contoh penggunaannya untuk margin dan padding hampir sama seperti berikut:

```css
h3 {
  margin-top: 2em;
  margin-right: 2%;
  margin-bottom: 40px;
  margin-left: 2%;
}
/* atau bisa ditulis ringkas menjadi */
h3 {
  margin: 2em 2% 40px 2%;
}
/* atau karena kanan kiri sama bisa ditulis menjadi */
h3 {
  margin: 2em 2% 40px;
}
```

* Berbeda dengan margin dan padding, border selain memiliki sisi juga memiliki atribut lain yaitu: __border-width__, __border-color__, __border-radius__ (membuat border melengkung), dan __border-style__.

```css
div.menu {
  border-color: orange;
  border-width: 3px;
  border-style: solid;
}
/* dapat digabung menjadi */
div.menu {
  border: 1px solid orange;
}
/* untuk sisi tertentu saja ditulis */
div.menu {
  border-top-width: 1px;
}
```

* Untuk mendefinisikan tinggi dan lebar dari box, digunakan css __width__, __min-width__, __max-width__, __height__, __min-height__, dan __max-height__ dengan nilai b. Min dan max digunakan untuk menentukan lebar dan tinggi minimal dan maksimalnya. Biasanya digunakan untuk box yang responsive atau memiliki lebar dan tinggi yang dinamis.

### Background

* Perintah css untuk background bisa menjadi sangat kompleks terutama jika kita ingin menggunakan background gambar agar sesuai dengan keinginan.
* Background warna dapat ditambahkan pada elemen dengan menggunakan perintah CSS __background-color__ yang berisi nama warna, kode heksadesimal, rgb, atau rgba (red, green, blue, alpha).

```css
p.error {
  background: red;
}
div {
  background-color: rgba(0, 0, 128, 0.4);
}
```

* Background gambar dilakukan dengan perintah __background-image__ yang berisi url dari file yang akan dijadikan gambar

```css
body {
  background-image: url('paper.gif');
}
p.lead {
  background-image: url(/img/bgdesert.jpg);
}
```

* Secara default image yang dijadikan background akan diulang jika lebarnya lebih kecil dari div atau wadah lainnya. Kita bisa menentukan gambar diulang dengan perintah __background-repeat__ yang berisi: __repeat__, __repeat-x__, __repeat-y__, __no-repeat__.
* Saat dijadikan background, gambar biasanya diletakkan di pojok kiri atas, namun kita bisa mengubahnya dengan perintah __background-position__ dengan nilai: vertical (__top__, __center__, __bottom__) horizontal (__left__, __center__, __right__)

```css
#header li a { 
  display: block; 
  background-image: url("latar_kiri.png");
  background-repeat: no-repeat top left; 
}
```

* Semua properti background bisa digabung dengan perintah __background__ seperti ```background: #ffffff url("img_tree.png") no-repeat right top;```

### Overflow

* Sebuah elemen bisa saja lebar atau tingginya melewati batas dari elemen induknya. Elemen induk dapat menentukan apa yang harus dilakukan jika elemen didalamnya melebihi lebar dan tingginya. Perintah css nya adalah __overflow__ yang isinya: __visible__ (tidak dipotong oleh induknya), __hidden__ (dipotong oleh induknya), __scroll__ (induk selalu memberikan scroll disekelilingnya), __auto__ (induk memberikan scroll hanya jika elemen didalamnya melebihi wadahnya).

### Display

* Perintah CSS __display__ bisa mengoverride box model default seperti misalnya _block_ menjadi _inline_, atau sebaliknya. Selain itu jika diberi nilai __none__ maka elemen menjadi hilang dan tidak ditampilkan di layar.
* Perbedaan dari display dan visibility adalah apakah elemen masih menggunakan _space_ ketika elemen disembunyikan.
* Nilai __inline-block__ digunakan untuk membuat elemen menjadi inline tapi kita juga dapat menentukan tinggi dan lebarnya secara eksplisit.

### Position dan z-index

* Elemen secara default diletakkan "relatif" terhadap induknya. Namun kita mengubah-ubahnya dengan perintah __position__ yang berisi __static__, __relative__, __fixed__, __absolute__, dan __sticky__. Selanjutnya elemen diatur posisinya dengan perintah __left__, __top__, __bottom__, atau __right__.
* Perintah __z-index__ digunakan untuk menentukan urutan tumpukan (layer) dari elemen dengan nilai angka 1 -  tak terhingga

### Box Shadow

* [W3C Box Shadow](https://www.w3schools.com/css/css3_shadows_box.asp)

### Media Query

* Kita bisa menentukan sebuah css digunakan untuk media apa saja, contohnya __screen__, dan __print__.
* Sedangkan media query adalah css dapat menentukan beberapa kemampuan perangkat yang membuka halaman web tersebut, antara lain: (tinggi dan lebar layar, tinggi dan lebar perangkat, orientasi layar dan resolusinya).

```css
@media screen and (min-width: 480px) {
  body {
    background-color: lightgreen;      
  }
}
/* hanya perangkat yang memiliki min layar berukuran 480px 
yang memiliki background hijau terang */
@media only screen and (max-width: 600px) {
  body {
    background-color: lightblue;      
  }
}
```

* Untuk membuat tampilan web yang responsif dan _mobile friendly_ maka pastikan Anda mengetahui cara menggunakan media query dengan baik.

## Praktikum

* Kita akan membuat menu dropdown dengan CSS, ketikkan kode html dan css berikut dan masukkan dalam laporan!

```html
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CSS Menu</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <ul>
    <li><a href="#">Home</a></li>
    <li><a href="#">About</a>
      <ul>
        <li><a href="#">History</a></li>
        <li><a href="#">Team</a></li>
        <li><a href="#">Offices</a></li>
      </ul>
    </li>
    <li><a href="#">Services</a>
      <ul>
        <li><a href="#">Web Design</a></li>
        <li><a href="#">Internet Marketing</a></li>
        <li><a href="#">Hosting</a></li>
        <li><a href="#">Domain Names</a></li>
        <li><a href="#">Broadband</a></li>
      </ul>
    </li>
  </ul>
</body>

</html>
```

```css
body { 
  margin: 20px; 
  font-family: verdana, arial, sans-serif; 
  font-size: 0.8em; 
}
ul { 
  margin: 0; 
  padding: 0; 
  list-style: none; 
  width: 150px; 
  border-bottom: 1px solid #ccc; 
}
ul li { 
  position: relative; 
}
ul li ul { 
  position: absolute; 
  left: 149px; 
  top: 0;
  display: none; 
}
ul li a { 
  display: block; 
  text-decoration: none; 
  color: #4B4B4B; 
  background: #fff; 
  padding: 5px; 
  border: 1px solid #ccc; 
  border-bottom: 0; 
  background-color: whitesmoke; 
}
ul li a:hover { 
  background-color: #ccc; 
}
li:hover ul, li.over ul { 
  display: block; 
}
```

## Tugas

* Modifikasi kode praktikum diatas, ubah sesuai keinginan Anda mulai dari warna, bentuk, ukuran, penggunaan font icon, dsb.
* Screenshot dan masukkan kodenya