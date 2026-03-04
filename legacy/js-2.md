# Modul 11 - Manipulasi DOM

Tujuan Pembelajaran: Mahasiswa mengenal Document Object Model menggunakan Javascript dan dapat memanfaatkan akses DOM untuk halaman web yang lebih interaktif

## Materi

* DOM (Document Object Model) adalah interface pemrograman yang menyajikan dan berinteraksi dengan dokumen HTML atau XML. DOM adalah model dari dokumen yang dimuat dalam browser dan dan disimpan sebagai pohon simpul (node tree), dimana setiap simpul merepresentasikan bagian dari dokumen (elemen, text, atau komentar).

![dom](https://github.com/NazirArifin/modulweb/blob/master/img/11-1.png)

### DOM API Selector

* Dengan method-method di selector API kita dapat secara cepat mengambil ```Element``` dari dokumen (DOM) berdasarkan string selector yang kita tentukan.

```js
const special = document.querySelectorAll('p.warning, p.note');
```

* Method selector menerima satu atau lebih selector yang dipisahkan tanda koma __,__ untuk menentukan elemen mana yang akan diambil. Contohnya pada kode diatas, kita mengambil semua elemen ```<p>``` yang memiliki nama class ```warning``` atau ```note``` (hasilnya berbentuk Array elemen).

* Untuk mengambil satu aja elemen yang sesuai kita gunakan method ```querySelector()``` seperti contoh berikut:

```js
const el = document.querySelector('#container');
```

* Selain menggunakan querySelector, untuk mendapatkan elemen dengan nama ID tertentu kita dapat menggunakan method ```getElementById```, ```getElementsByClassName``` seperti contoh berikut:

```js
const elm = document.getElementById('content');
```

### Tipe Data DOM

* Terdapat beberapa tipe data yang digunakan dalam DOM yang dapat dioperasikan yaitu:

  - ```Document```: Object dari ```document```
  - ```Node```: Setiap elemen di dokumen
  - ```Element```: Tipe ini berdasarkan pada Node
  - ```NodeList```: Array dari Node
  - ```Attribute```: Atribut dari Node

### Mengubah Elemen

* Setelah mendapatkan elemen dengan beberapa method selector, kita dapat melakukan operasi apapun pada elemen tersebut. Operasi tersebut seperti mengubah isinya, mengganti style, atau mengubah atribut yang dimilikinya.

  - ```elm.innerHTML = html```: mengubah/mengganti isi dari elemen
  - ```elm.attribute = value```: mengubah nilai baru
  - ```elm.style.property = value```: mengubah style value
  - ```elm.setAttribute(attribute, value)```: mengubah atribut

* Menggunakan ```innerHTML``` merupakan cara yang simple dan cepat, tapi jika Anda ingin mengubah dom secara lebih detail pada operasi simpulnya, maka Anda dapat menggunakan beberapa method berikut:

  - ```document.createElement(element)```: membuat elemen baru
  - ```document.removeChild(element)```: membuang elemen
  - ```document.appendChild(element)```: menambahkan elemen
  - ```document.replaceChild(new, old)```: mengganti elemen

### DOM Events

* Kode JavaScript dapat dieksekusi ketika sebuah event terjadi seperti klik, mouseover, keyboard ditekan, form di submit, dsb.

```js
document.getElementById('tombol').onclick = function(evt) {
  evt.target.textContent = 'SUDAH DIKLIK';
};
```

* Selain menggunakan event method seperti contoh diatas, kita juga dapat menggunakan method ```addEventListener()``` dengan rincian argumen sebagai berikut:

```js
element.addEventListener(event, function, useCapture);
// event: click, mousedown, dsb
// function: fungsi yang dieksekusi ketika event terjadi
// useCapture: berisi boolean, apakah menggunakan bubbling atau event capture
```

* Contoh penggunaannya adalah seperti berikut:

```js
const elm = document.getElementById('tombol');
elm.addEventListener('click', function() { alert('Hello World!'); });
```

* Dengan event listener Anda dapat menambahkan event sebanyak apapun pada sebuah elemen tanpa menindih event listener sebelumnya. Sedangkan untuk membuat eventListener Anda dapat menggunakan method ```removeEventListener(event, function)```;

### DOM Navigation

* Karena DOM disusun dalam bentuk pohon node, maka kita bisa menjelajahi setiap node yang digambarkan dengan hubungan pohon silsilah keluarga (parent, child, sibling).

* Setiap node memiliki properti berikut, dan jika tidak ada node pada properti tersebut maka nilainya adalah ```null```. Properti tersebut adalah:

  - ```parentNode```: node induknya
  - ```childNodes[nomor]```: node anaknya (bisa lebih dari 1)
  - ```firstChild```: node anak pertama
  - ```lastChild```
  - ```nextSibling```: node tetangga berikutnya
  - ```previousSibling```

## Praktikum

* Ketik ulang kode berikut:

```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document Object Model</title>
  <style>
#box {
  width: 300px;
  height: 300px;
  overflow: hidden;
  background-color: #7fff00;
  margin: 20px 0px;
  padding: 10px;
}
#box p {
  font-family: 'Courier New', Courier, monospace;
  font-size: 65px;
  text-align: center;
  font-weight: bold;
}

@keyframes background {
  from { background-color: #7fff00; }
  to { background-color: white; }
}

#box {
  transition: background 1s;
}

#button {
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
  </style>
</head>
<body>
  
  <div id="box">
    <p>#7fff00</p>
  </div>

  <button type="button" id="button">UBAH WARNA</button>

  <script>
// div #box
const box = document.getElementById('box');

// #box p
const p = box.querySelector('p');

// fungsi mengenerate warna
function generateRandomColor() {
  return '#' + Math.floor(Math.random() * 16777215).toString(16);
}

document.getElementById('button').addEventListener('click', e => {
  const color = generateRandomColor();
  box.style.background = color;
  p.innerHTML = color;
});
  </script>
</body>
</html>
```

## Tugas

* Masukkan hasil ketikan dan hasil aplikasi ke dalam laporan!




