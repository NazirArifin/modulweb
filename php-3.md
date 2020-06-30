# Modul 9 - Session, Cookies dan Database (MySQL)

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

while ($row = $res->fetch_assoc()) {
  echo ' id = ' . $row['id'] . PHP_EOL;
}
```

* Sedangkan result set yang _unbuffered_ berarti hasil dari database harus selesai dibaca semua sampai selesai baru dikirim ke PHP. PHP membutuhkan sedikit memori tapi beban di server database bertambah berat. Untuk mengakses result set _unbuffered_ dapat dilakukan seperti contoh berikut:

```php
<?php
$mysqli->real_query("SELECT id FROM test ORDER BY id ASC");
$res = $mysqli->use_result();

while ($row = $res->fetch_assoc()) {
  echo ' id = ' . $row['id'] . PHP_EOL;
}
```

### Query Dengan Prepared Statements

* MySQL mendukung prepared statements yang merupakan statement dengan parameter yang dapat dieksekusi berulang ulang dengan efisien. Prepared statement ketika dieksekusi terdiri dari dua tahap: _prepare_ (template dikirim ke database oleh PHP) dan _execute_ (server mengeksekusi template statement dengan menggunakan variabel yang sudah di _bind_).

```php
<?php
if ( ! ($stmt = $mysqli->prepare("INSERT INTO test(id) VALUES (?)"))) {
  echo 'Prepare gagal: (' . $mysqli->errno . ') ' . $mysqli->error;
}

$id = 1;
if ( ! $stmt->bind_param('i', $id)) {
  echo 'Binding gagal (' . $stmt->errno . ') ' . $stmt->error;
}
if ( ! $stmt->execute()) {
  echo 'Eksekusi gagal: (' . $stmt->errno . ') ' . $stmt->error;
}

for ($id = 2; $id < 5; $id++) {
  if ( ! $stmt->execute()) { // PHP hanya mengirim data, statement sudah ada
    echo 'Eksekusi gagal: (' . $stmt->errno . ') ' . $stmt->error;
  }
}

$stmt->close();

$res = $mysqli->query("SELECT id FROM test");
var_dump($res->fetch_all());
```
* Menggunakan prepared statement belum tentu efisien karena kita harus mengirim template ke server dan baru melakukan eksekusi. Jadi pastikan bahwa statement yang digunakan benar-benar lebih efisien jika menggunakan prepared statements.

* __CATATAN__: Untuk multi insert usahakan gunakan sintaks SQL multi insert seperti: ```INSERT INTO test(id) VALUES (1), (2), (3), (4)"```

### Multiple Statements

* Server database MySQL bisa diset untuk menerima multiple statements dalam satu string statement. Hal ini dapat mengurangi beban lalu lintas dari PHP ke database namun pastikan string yang dikirim ditangani dengan benar.

* Multiple statements harus dieksekusi dengan ```mysqli::multi_query()``` seperti contoh berikut:

```php
<?php
$sql = "CREATE TABLE test(id INT);";
$sql.= "INSERT INTO test(id) VALUES (1);";

if ( ! $mysqli->multi_query($sql)) {
  echo 'Multi query gagal: (' . $mysqli->errno . ') ' . $mysqli->error;
}
```

## Praktikum

* Kita akan membuat aplikasi yang menggunakan Session dan database MySQL. User dapat melakukan login, daftar, melihat home, dan melakukan logout. Pastikan server database Anda sudah dijalankan, cek di XAMPP Control Panel.

* Buat project dimanapun dan pastikan PHP development server diaktifkan dengan perintah ```php -S localhost:8080```. Di praktikum kita abaikan tampilan (CSS) karena kita akan lebih fokus ke mekanisme autentifikasi user.

* Kita akan menggunakan database ```test``` dan tabel ```user```, untuk itu import kode SQL berikut ke database Anda (bisa menggunakan phpMyAdmin):

```sql
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `test`
--

CREATE TABLE `user` (
  `ID_USER` int(11) NOT NULL,
  `EMAIL_USER` varchar(40) NOT NULL,
  `PASSWORD_USER` varchar(40) NOT NULL,
  `NAME_USER` varchar(80) NOT NULL,
  `STATUS_USER` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`ID_USER`, `EMAIL_USER`, `PASSWORD_USER`, `NAME_USER`, `STATUS_USER`) VALUES
(1, 'admin@example.com', 'password', 'Super Duper User', 1);

ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`);

ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
```

* [Download repository ini](https://github.com/NazirArifin/modulweb/archive/master.zip), lalu ekstrak, masuk ke folder __```example/phpapp```__. Tulis ulang dan pahami kode-kode PHP didalamnya dan jika ada pertanyaan silakan diajukan di edmodo.

* Untuk login gunakan email ```admin@example.com``` dan password ```password```. Pada contoh aplikasi tersebut, password tersebut di database tanpa enkripsi, namun akan lebih baik jika password yang tersimpan di database sudah terenkripsi sehingga ketika ada orang mendapatkan isi database dia tidak dapat melihat password dengan mudah.

## Tugas

* Masukkan kode PHP yang Anda tulis dan hasil screenshot aplikasi ke dalam laporan!







