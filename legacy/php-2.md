# Modul 8 - Memproses Form, Upload File, Manajemen File

Tujuan Pembelajaran: Mahasiswa mengenal dan memahami PHP dalam menangani form, dan manajemen berkas serta dapat menggunakannya dalam pembuatan aplikasi web dinamis

## Materi

* Setelah pada materi [Pembuatan Form di HTML](https://github.com/NazirArifin/modulweb/blob/master/html-2.md) kita dapat membuat form dan menampilkannnya ke pengguna, maka sekarang kita akan menggunakan PHP untuk memproses data form yang dikirim oleh pengguna melalui browser.

### Method, Encoding Type

* Dalam tag (perintah) HTML ```<form>```, kita dapat menentukan method yang digunakan saat mengirim data dalam form, umumnya method yang digunakan adalah __GET__ dan __POST__. Contohnya adalah: ```<form method="post">...</form>```

* Dengan method __GET__, value dari input akan ditampilkan pada __URL__ berupa _URL query_ dengan pola: ```http(s)://domain/file?param=value&param2=value2&...```. _URL query_ ada dibagian setelah karakter tanda tanya __?__ yang berbentuk pasangan key=value

* Dengan method __POST__, value dari input tidak akan dimunculkan di __URL__ sehingga pengguna tidak melihat isi dari input yang baru saja dia masukkan

* Kita dapat menentukan tipe encoding dari input yang kita masukkan menggunakan properti __enctype__ pada tag ```<form>```. Contohnya: ```<form method="POST" enctype="application/x-www-form-urlencoded">...</form>```. Beberapa nilai yang dapat digunakan yaitu:
  - application/x-www-form-urlencoded: (default), value dari input akan di encoding agar aman melewati transportasi url.
  - multipart/form-data: tidak ada character yang diencode, digunakan untuk mengupload file
  - text/plain: spasi diubah menjadi +, namun karakter lainnya tidak diubah

* Untuk menentukan URL / file yang memproses formulir, dapat didefinisikan di properti ```action``` di tag ```<form>...</form>```. Contohnya adalah: ```<form method="POST" enctype="multipart/form-data" action="/daftar.php">``` yang berarti kita user men _submit_ form, browser akan mengirim form ke __daftar.php__.

* Jika bagian __action__ dikosongkan, maka browser akan mengirimkan data pada url atau file saat ini.

### Input Name

* Bagian terpenting yang harus ada di input dalam form (input, textarea, select) adalah properti __name__ dimana nilai dari name ini akan dapat dibaca oleh PHP. Pastikan Anda memberi name yang berbeda karena jika sama value sebelumnya akan tertindih value yang baru.

* Jika Anda ingin mengirimkan array ke PHP menggunakan form maka name yang digunakan harus berbentuk: ```name="variabel[]"```

```html
...
  <form action="" method="post">
    <input type="text" name="nama" id="nama">
    Sekolah: <select name="sekolah" id="sekolah">
      <option value="sd">SD</option>
      <option value="smp">SMP</option>
      <option value="sma">SMA</option>
    </select>
    Hobi: 
    <input type="checkbox" name="hobi[]" value="mancing" id="hobi1"> Mancing
    <input type="checkbox" name="hobi[]" value="hiking" id="hobi2"> Hiking
    <input type="checkbox" name="hobi[]" value="surfing" id="hobi3"> Surfing
    <input type="submit" value="SIMPAN">
  </form>
...
```

### $_POST, $_GET dan $_REQUEST

* Jika kita menggunakan method __GET__ maka PHP dapat "membaca" input dari formulir di variabel global ```$_GET``` yang berisi array dengan key berupa __name__ pada input. Contohnya adalah: ```$_GET['nama']```, ```$_GET['sekolah']```, dsb

* __CATATAN__: kita dapat membuat atau mengganti variabel $_GET secara langsung dengan mengetikkan data ke address bar di browser. $_GET ini pada umumnya digunakan untuk mengakses data dengan kondisi tertentu, misalnya: ```https://api.unira.ac.id/v1/mhs?prodi=52&nim=201852```

![php dev server](https://github.com/NazirArifin/modulweb/blob/master/img/8-1.png)

* Sedangkan jika kita menggunakan method __POST__ maka PHP dapat membaca input dari form pada variabel global ```$_POST```.

```php
<?php
if (isset($_POST) && ! empty($_POST)) {
  var_dump($_POST);

}
?><!DOCTYPE html>
<html lang="en">
...
```

* Dengan ```$_REQUEST``` merupakan gabungan dari ```$_GET``` dan ```$_POST```, yang mana kita tidak mempedulikan input dikirim dengan GET / POST karena keduanya akan tetap masuk ke ```$_REQUEST```.

### Validasi Input

* Untuk membersihkan kode HTML yang mungkin secara sengaja dikirim oleh user (seperti tag script, dll), dapat digunakan fungsi ```htmlspecialchars($input)```, ```htmlentities($input)```, dan ```strip_tags($input)```

* PHP menyediakan beberapa filter dan validasi yang dapat digunakan untuk memvalidasi apakah string valid atau tidak. Fungsi yang digunakan adalah ```filter_var($var, FILTER_FLAG)``` dimana terdapat beberapa filter flag yang dapat digunakan. Contoh penggunaannya adalah: ```filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);``` yang akan mereturn data yang sukses difilter jika valid atau ```FALSE``` jika tidak valid.

* Beberapa filter yang dapat Anda gunakan adalah:
  - ```FILTER_VALIDATE_BOOLEAN```: validasi boolean
  - ```FILTER_VALIDATE_DOMAIN```: validasi nama domain web
  - ```FILTER_VALIDATE_EMAIL```: validasi email
  - ```FILTER_VALIDATE_INT``` dan ```FILTER_VALIDATE_FLOAT```: validasi integer dan float
  - ```FILTER_VALIDATE_IP``` dan ```FILTER_VALIDATE_MAC```: validasi alamat IP (v4 ataupun v6) dan alamat MAC perangkat
  - ```FILTER_VALIDATE_URL```: validasi alamat url
  - ```FILTER_VALIDATE_REGEXP```: validasi berdasarkan Regular Expression

```php
<?php
// validasi alamat email
if ( ! filter_var('bob@example.com', FILTER_VALIDATE_EMAIL)) {
  die('Alamat email tidak valid!');
}

// validasi alamat url
if ( ! filter_var('http://example.com', FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)) {
  die('Alamat URL tidak valid!');
}
```

### Upload File

* Untuk dapat mengupload file, method yang digunakan adalah __POST__ dan pada tag ```<form>``` digunakan ```enctype=""multipart/form-data"```. Jika Anda lupa menentukan ```enctype``` maka file tidak akan dapat diupload dan di proses oleh PHP.

```html
<form enctype="multipart/form-data" action="__URL__" method="POST">
  <!-- MAX_FILE_SIZE harus sebelum input file -->
  <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
  Send this file: <input name="userfile" type="file" />
  <input type="submit" value="Kirim File" />
</form>
```

* File yang diupload akan dapat dibaca oleh PHP pada variabel global ```$_FILES[userfile]``` yang berisi array seperti berikut:

  - ```$_FILES['userfile']['name']```: nama file dari komputer user
  - ```$_FILES['userfile']['size']```: ukuran file dalam bytes
  - ```$_FILES['userfile']['tmp_name']```: lokasi file temp file saat ini (jika tidak dipindah PHP akan menghapus file temp)
  - ```$_FILES['userfile']['error']```: berisi kode error yang terjadi saat upload

* Untuk memindahkan file temp ke folder yang sebenarnya kita maksudkan (semua file upload akan diletakkan di temp dulu, terserah kita apakah akan dipindah atau dibiarkan) digunakan fungsi ```move_uploaded_file```.

```php
<?php
$upload_dir = '/upload'; // folder tujuan, pastikan ada
$upload_file = $upload_dir . basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $upload_file)) {
  echo 'File sukses diupload';
} else {
  echo 'Gagal upload file';
}
```

### Manajemen File dan Folder

* Untuk membaca isi file ada beberapa fungsi yang dapat digunakan, antara lain: ```file_get_contents($namafile)```, ```file($namafile)``` (output berupa array perbaris), dan ```fread```. Fungsi lengkapnya terdapat di [File System](https://www.php.net/manual/en/ref.filesystem.php)

* Untuk manajemen direktori / folder dapat dilihat di [Directory](https://www.php.net/manual/en/ref.dir.php)

## Praktikum

* Kita akan membuat aplikasi sederhana dengan form yang bisa mengirim data dan mengupload file dan menampilkan hasilnya. Ketik ulang kode berikut ini, pahami dan pelajari. Jika ada pertanyaan dapat di tanyakan di diskusi tugas.

* Buat form html dan simpan dengan nama __form.php__, pastikan development server sudah dijalankan!

```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendaftaran Beasiswa</title>
  <style>
body {
  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
}
.container {
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}
.container form {
  padding: 20px 20px 10px 20px;
  background-color: coral;
  border-radius: 4px;
  min-width: 450px;
}
ul li {
  font-size: 12px;
  color: maroon;
  font-weight: bold;
}
h3 {
  text-align: center;
  font-size: 22px;
}
.input-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}
label {
  font-size: 12px;
  padding-top: 10px;
}
input {
  width: 300px;
  padding: 10px 7px;
  border-radius: 4px;
  border: 1px solid orangered;
}
button {
  padding: 10px 15px;
  border-radius: 4px;
  border: 2px solid orangered;
}
  </style>
</head>
<body>
  <div class="container">
    <form action="/daftar" method="post" enctype="multipart/form-data">
      <h3>FORM PENDAFTARAN MAHASISWA</h3>
      <div class="error">
        <ul>
          <li>Email tidak valid</li>
        </ul>
      </div>
      <hr>
      <div class="input-row">
        <label for="nama">Nama:</label>
        <div class="input">
          <input type="text" name="nama" id="nama" minlength="3" maxlength="60" required>
        </div>
      </div>
      <div class="input-row">
        <label for="email">Email:</label>
        <div class="input">
          <input type="email" name="email" id="email" minlength="5" maxlength="60" required>
        </div>
      </div>
      <div class="input-row">
        <label for="foto">Foto:</label>
        <div class="input">
          <input type="file" accept=".jpg,.jpeg,.png" name="foto" id="foto" required>
        </div>
      </div>
      <div class="input-row">
        <label for=""> </label>
        <div class="input">
          <button type="submit">DAFTAR BEASISWA</button>
        </div>
      </div>
    </form>
  </div>
</body>
</html>
```

* Seperti pada modul sebelumnya, kita akan menggunakan __index.php__ sebagai controller yang menentukan tampilan mana yang harus dimuat dan tampilkan ke pengguna. Buat file __index.php__ jika belum ada dan isikan dengan kode berikut:

```php
<?php 
// include file yang didefinisikan di url
$url = ltrim($_SERVER['REQUEST_URI'], '/');
switch ($url) {
  case 'form': // url: localhost:8080/form, muat form.php
    
    include 'form.php'; break;
  
  default:
    echo '<h3>Not Found!</h3>';
}
```

* Sekarang akses alamat url [http://localhost:8080/form](http://localhost:8080/form) di browser Anda, dan jika benar maka Anda akan melihat tampilan form yang telah kita buat di file __form.php__.

* Berikutnya adalah buat kode yang memproses inputan form, menvalidasi dan juga memproses file yang diupload. Dikarenakan di form bagian __action__ diarahkan ke url __/daftar__, maka di index.php akan kita modifikasi 

* Dikarenakan kodenya tidak terlalu banyak dan tidak spesifik maka kita bisa langsung masukkan index.php, namun jika kodenya sudah cukup kompleks dan spesifik maka kita seharusnya membuat Class khusus.

* Berikut kode __index.php__ yang sudah kita modifikasi:

```php
<?php 
// include file yang didefinisikan di url
$url = ltrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

switch ($url) {
  // tampilkan form
  case 'form':
    include 'form.php'; break;
  
  // memproses form
  case 'daftar':
    // array error menampung kesalahan
    $errors = [];

    // validasi input di $_POST
    if (isset($_POST) && ! empty($_POST)) {
      // extract array $_POST -> $_POST['nama'] -> $nama
      extract($_POST);
      
      // validasi nama
      if (isset($nama)) {
        if (strlen($nama) < 3) { // nama minimal 3 karakter
          $errors[] = 'Nama minimal 3 karakter';
        }
      } else {
        $errors[] = 'Nama tidak diisi';
      }

      // validasi email
      if (isset($email)) {
        if ( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $errors[] = 'Email tidak valid';
        }
      } else {
        $errors[] = 'Email tidak diisi';
      }
    } else {
      $errors[] = 'Invalid Request';
    }

    // validasi dan upload
    if (isset($_FILES['foto'])) {
      // validasi berdasarkan ekstensi (meskipun kurang bagus)
      $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
      $folder = 'upload';

      if ( ! in_array($ext, ['jpg', 'jpeg', 'png'])) {
        $errors[] = 'Bukan file jpg / png';
        @unlink($_FILES['foto']['tmp_name']); // hapus tmp
      } else {
        // pindah ke folder "upload", jika belum ada maka buat dulu
        if ( ! is_dir($folder)) {
          mkdir($folder);
        }
        // nama file diganti huruf acak
        $filename = uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['foto']['tmp_name'], $folder . '/' . $filename);
      }
    }

    // jika ada errors, redirect
    if (count($errors) > 0) {
      @unlink($folder . '/' . $filename);
      header('Location: /form?' . http_build_query(['errors' => $errors]));
    } else {
      // sukses, tugasnya, tampilkan hasil upload disini
      // ...................
    }

    break;
  case '';
    echo '<a href="/form">Formulir Pendaftaran</a>';
    break;
  
  default:
    echo '<h3>Not Found!</h3>';
}
```

## Tugas

* Ketik ulang, dan tampilkan hasil upload ke browser (ada data nama, email dan muncul foto hasil upload dengan tag ```<img src="">```) lalu kode dan hasilnya dimasukkan ke laporan!


