# Modul 7 - Session, Cookies dan Database (MySQL)

Tujuan Pembelajaran: Mahasiswa mengenal dan memahami metode penyimpanan data menggunakan Session, Cookies dan Database dalam bahasa pemrograman PHP serta menggunakannya dalam pembuatan aplikasi web dinamis

## Materi

* __PERINGATAN__: kode-kode tentang Cookies dan Session merupakan __header__, artinya kode ini harus diawal sebelum ada output, __tidak boleh__ didahului output apapun (bahkan karakter spasi, titik, dsb)

### Cookies

* Untuk membantu pengguna atau user mendapatkan pengalaman yang baik ataupun untuk personalisasi, website akan menggunakan cookie yang disimpan di browser pengguna. Cookie ini berisi informasi singkat tentang user yang mana dapat dibaca oleh server untuk mengenali user (id user, nama user, dsb).

* Beberapa negara meminta agar server kita mengeset cookies harus meminta ijin dari user, sehingga pada beberapa website Anda akan melihat ada notifikasi yang menanyakan apakah Anda mengijinkan website menyimpan cookies di browser Anda atau tidak.

* Untuk membuat cookie digunakan fungsi ```setcookie(name, value, expires, path, domain, secure, httponly);``` dimana:
  - name: nama dari cookie
  - value: nilai dari cookie yang akan disimpan, diakses dengan ```$_COOKIE['nama']```.
  - expires: masa berlaku dari cookies berupa unix timestamp (jumlah detik mulai 1 January 1970 00:00:00 UTC). Jika ingin diset 5 hari kedepan maka digunakan kode: ```time() + (5 * 24 * 60 * 60)```. Jika nilai expires diset 0 maka cookie akan dihapus jika browser ditutup.
  - path: path di server dimana cookie dapat digunakan. Jika diset ```'/'``` maka berlaku pada keseluruhan path di domain tersebut
  - domain: (sub)domain dimana cookie berlaku dengan nilai defaultnya ```''```.
  - secure: apakah harus melalui HTTPS, jika diset ```TRUE``` maka cookie tidak akan dibuat jika tidak diakses melalui HTTPS
  - httponly: apakah cookie hanya diset melalui http dan tidak melalui Javascript. Jika diset ```TRUE``` maka Javascript umumnya tidak dapat membaca isi dari cookie tersebut.

### Session

* Session mirip dengan cookie namun value session tidak tersimpan di browser dan hanya dapat dibaca oleh server (PHP). Umumnya session digunakan untuk menyimpan informasi singkat tentang pengguna yang dapat diakses dari halaman manapun sehingga cocok untuk mekanisme login (autentifikasi) pengguna.

* __PERINGATAN__: Cookies dan Session bukan untuk menyimpan data yang banyak dan kompleks, jangan masukkan data yang "berat" di Session

* Untuk membuat session digunakan perintah ```session_start()``` yang kemudian nilai di session diakses dengan variabel global ```$_SESSION``` yang berupa array dengan key nama dari session.

```php
<?php 
session_start(); // start session (jangan lupa!)

// mengeset value (waktu login)
$_SESSION['id'] = 24;
$_SESSION['nama'] = 'Sanusi';

?><!DOCTYPE html>
...
```

```php
<?php
session_start();

// mengakses session yang sudah diset
if ( ! isset($_SESSION['id'])) {
  // redirect jika tidak ada session
  header('Location: /');
}

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php echo "<title>{$_SESSION['nama']}</title>" ?>
...
```

```php
<?php
session_start();

// menghapus session (waktu logout)
session_unset();
session_destroy();
```

### Database (MySQL)

* Kita akan menggunakan ekstensi MySQLi untuk melakukan operasi ke database MySQL / MariaDB. Selain MySQLi juga terdapat driver lain yang dapat digunakan yaitu PDO MySQL.

### Koneksi Database

* Kita akan menggunakan menggunakan constructor di class mysqli untuk membuat koneksi ke database seperti contoh berikut:

```php
<?php
$host = 'localhost'; // host db
$user = 'root'; // user database
$password = ''; // password database
$database = 'test'; // nama databasenya

$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_errno) {
  echo 'Koneksi MySQL gagal: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error;
}

```

### Mengeksekusi Statement

* Untuk mengeksekusi statement SQL dapat digunakan beberapa method / fungsi dan salah satunya adalah ```mysqli::query```. Contohnya adalah: ```$mysqli->query("CREATE TABLE test(id INT)")``` ketika membuat tabel atau ```$mysqli->query("INSERT INTO test(id) VALUES (1)"))``` untuk melakukan insert.

* Untuk statements yang memiliki _result set_, Anda dapat menggunakan _buffered_ dan _unbuffered_. Buffered berarti setiap ada hasil dari database akan langsung di transfer ke PHP dan disimpan di memori oleh PHP. PHP membutuhkan lebih banyak memori namun beban server database menjadi lebih sedikit. Untuk mengakses result set _buffered_ dapat dilakukan dengan seperti berikut:

```php
<?php
$mysqli = new mysqli("example.com", "user", "password", "database");
$res = $mysqli->query("SELECT id FROM test ORDER BY id ASC");

$res->data_seek(0);
while ($row = $res->fetch_assoc()) {
  echo ' id = ' . $row['id'] . PHP_EOL;
}
```

* Sedangkan result set yang _unbuffered_ berarti hasil dari database harus selesai dibaca semua sampai selesai baru dikirim ke PHP. PHP membutuhkan sedikit memori tapi beban di server database bertambah berat. Untuk mengakses result set _unbuffered_ dapat dilakukan seperti contoh berikut:

```php
<?php
$mysqli->real_query("SELECT id FROM test ORDER BY id ASC");
$res = $mysqli->use_result(); // menggunakan use_result()

while ($row = $res->fetch_assoc()) {
  echo ' id = ' . $row['id'] . PHP_EOL;
}
```

### Query Dengan Prepared Statements



### Multiple Statements


### Transaction






