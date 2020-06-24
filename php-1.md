# Modul 7 - PHP & Templating

Tujuan Pembelajaran: Mahasiswa mengenal bahasa pemrograman PHP sebagai salah satu bahasa pemrograman sisi server dan dapat menggunakannya dalam pembuatan halaman web yang dinamis

## Persiapan

* Versi PHP yang digunakan adalah minimal PHP versi 5.6 (dianjurkan versi 7.2 keatas)
* Instalasi dapat dilakukan menggunakan paket XAMPP dan pastikan yang digunakan adalah yang terbaru sehingga mendapatkan PHP versi yang terbaru
* Kita menggunakan "development server" di PHP, sehingga kita dapat membuat _project_ web di folder manapun tanpa harus diletakkan di "htdocs"
* Untuk menggunakan development server, pastikan Anda sudah memasukkan path / lokasi file "__php.exe__" ke Windows environment
* Untuk memulai server, ketikkan perintah berikut di command prompt (console):

```sh
php -S localhost:8080
```
* Bagian localhost adalah host (bisa diganti dengan alamat IP agar dapat diakses dalam jaringan), dan 8080 adalah port yang akan digunakan (defaultnya adalah 80, tapi biasanya sudah digunakan oleh Apache)

![php dev server](https://github.com/NazirArifin/modulweb/blob/master/img/7-1.png)

## Materi

* PHP merupakan kepanjangan rekursif dari: "__PHP__: Hypertext Preprocessor" yang dibuat oleh Rasmus Lerdorf yang digunakan sebagai bahasa pemrograman sisi server.
* PHP dapat bekerja secara langsung dengan HTML dan bahasa ini sangat mudah dipelajari sehingga terlalu sering digunakan oleh programmer pemula (akibatnya kualitas kode yang dihasilkan sangat buruk)
* PHP biasanya disimpan dalam file dengan ekstensi __.php__ dan isinya dimulai dengan tanda ```<?php``` dan opsional ditutup dengan ```?>```. Contoh kode PHP sederhana adalah (simpan dalam file __index.php__):

```php
<?php
echo 'Hello World!';

```

* Jalankan development server dan akses url: [__http://localhost:8080__](http://localhost:8080) dengan browser, dan Anda akan melihat teks "Hello World" di layar browser Anda.
* Penutup ```?>``` hanya digunakan jika setelah kode PHP masih ada output teks lain, tapi jika satu file hanya berisi kode PHP saja maka Anda bisa mengabaikan penutup ```?>```.

```php
<body>

<?php
echo "My first PHP script!";
/* PHP harus ditutup dengan ?> karena setelah PHP ada text <body> */
?>

</body>
```

### Variabel

* Untuk membuat variabel di PHP, digunakan tambahan karakter ```$``` diawal nama karakter. Contohnya adalah: ```$nama = 'Husni';```
* Variabel di PHP bersifat dinamis, kita tidak perlu menentukan tipe datanya karena PHP akan menebak tipe data berdasarkan penggunakan variabel tersebut. __PERINGATAN__: karena tipe data tidak secara eksplisit dinyatakan maka variabel akan susah ditebak dan rawan terjadi kesalahan.

```php
<?php
$nomor = 19;
$label = '1';
echo $nomor + $label; // outputnya adalah 20, string '1' otomatis 1
```

#### Variabel Variabel

* Variabel variabel adalah kita merujuk sebuah variabel menggunakan namanya yang berupa string, umumnya digunakan saat nama variabel dibuat secara dinamis. Contohnya:

```php
<?php
$kota = 'Malang';
$nama = 'kota';
echo $$nama; // outputnya adalah: Malang
```

### String

* Berbeda dengan Java, untuk menggabungkan dua string digunakan tanda titik __.__ dan bukan tanda plus __+__. Contohnya: ```echo 'Hello' . ' ' . 'World!';```
* String interpolation hanya terjadi pada string yang menggunakan double quote __"__, dimana kita dapat memasukkan nilai variabel pada string secara langsung. Contohnya:

```php
<?php
$nama = 'Ali';
$usia = 29;
$kota = 'Malang';
$label = 'kota';
echo "Nama saya $nama berusia $usia di ${$label}"; // Nama saya Ali berusia 29 di Malang
```

* Jika tidak membutuhan interpolation maka lebih baik gunakan single quote __'__ karena akan mempercepat PHP karena PHP tidak perlu memparsing string dan mencari variabel didalamnya.

### Array

* Karena tipe data di PHP tidak kaku maka pembuatan array sangatlah mudah dan semua array bisa menampung semua tipe data (array campur aduk). Selain itu PHP juga memiliki kelebihan dengan penggunaan string sebagai key dari array.

```php
<?php
$a = [];
$a[] = 1; // menambah elemen array a dengan 1
array_push($a, 2, 3); // menambah elemen dengan fungsi array_push
$a['dua'] = 4; // key array dengan string
$a[] = 'lima'; // campur array dengan string

var_dump($a);
```

* Banyak fungsi yang berhubungan dengan array seperti di [Array Functions](https://www.php.net/manual/en/ref.array.php), namun ada beberapa fungsi yang sering digunakan antara lain __count__, __in_array__, __sort__, dll.

### Loop, Kondisi, dll

* Mirip dengan C++ dengan perbedaan pada penggunaan variabel dimana PHP tidak menggunakan tipe data (int, bool, float, dsb) dan nama variabel ditambah ```$``` diawal nama variabel.

### Fungsi

* Fungsi adalah blok kode yang mengerjakan sesuatu dan mungkin juga meminta input dan menghasilkan output. Pembuatan fungsi di PHP dimulai dengan kata kunci __```function```__ diikuti nama fungsinya. Contohnya adalah:

```php
<?php
declare(strict_types=1);
// PHP 7 memiliki strict_type untuk fungsi

function addInt(int $a, int $b): int {
  return $a + $b;
}

echo addInt(7, 3); // outputnya 10
echo addInt(5, '1'); // Fatal error, argument 2 type harus int
```

* PHP memiliki fungsi bawaan (_built in_) yang __SANGAT BANYAK__, sehingga untuk mempermudah pekerjaan Anda maka Anda harus lebih banyak mengetahui fungsi-fungsi yang ada dalam PHP.

### Class dan Object

* Pembuatan Class dan Object hampir sama dengan Java dengan perbedaan pada pembuatan properti. Contoh pembuatan class adalah seperti berikut:

```php
<?php 
declare(strict_types=1);

class Animal {
  private $bloodColor = 'red';
  protected $name = 'Lion';
  protected $location = 'cage';
  public $children = [
    'anie'
  ];

  // constructor
  public function __construct() {}

  // public method
  public function whoAmI(): string {
    return "Hi, I am {$this->name} live in {$this->location} has " . count($this->children) . ' child(s)';
  }
}

$ana = new Animal();
echo $ana->whoAmI(); // Hi, I am Lion live in cage has 1 child(s)
```

* Pada umumnya satu deklarasi class diletakkan pada satu file tersendiri dan untuk membedakan antar class biasanya digunakan namespace.

### Include, Require, Autoload

* Untuk aplikasi yang kompleks, kita biasanya membagi-bagi kode menjadi beberapa file yang berisi kode yang menangani hal tertentu / khusus. Untuk memasukkan kode di file lain, PHP memiliki beberapa fungsi yaitu:
  - ```include```: memasukkan kode dari file lain, contohnya: ```include 'file.php'; // atau include('file.php')```. Jika ada error PHP akan memunculkan peringatan namun tetap melanjutkan eksekusi kode berikutnya.
  - ```include_once```: sama dengan include, namun jika tanpa sengaja kita memasukkan file berkali-kali maka PHP hanya memproses satu kali saja
  - ```require```: sama dengan include, namun jika waktu memasukkan kode dari file lain ada error maka program akan berhenti mengeksekusi kode berikutnya
  - ```require_once```: sama dengan require, namun PHP hanya memasukkan kode satu kali saja

* Jika Anda memiliki file-file yang berisi class-class tersendiri, maka Anda dapat menggunakan fungsi ```spl_autoload_register``` yang dapat digunakan untuk melakukan include secara otomatis.

## Praktikum

* Ketik ulang dan pahami konsep dari kode PHP berikut: (letakkan di folder khusus, tidak harus di htdocs!)

* Aplikasi web yang baik adalah yang memisahkan antara _logic_ (alur / otak) dengan _view_ (tampilan). Pemisahan ini akan mempermudah dalam pengembangan dan perawatan aplikasi terutama jika aplikasi sudah semakin kompleks.

* Untuk menerapkan konsep pemisahaan logic dan view maka kita akan menggunakan beberapa file php. File pertama yang kita buat berisi class manajemen view (tampilan), simpan dengan nama file "__MyView.php__":

```php
<?php
declare(strict_types=1);

class MyView {
  // lokasi folder template, semua file template kita letakkan disini
  protected $template_dir = 'templates/';
  protected $vars = [];
  
  // constructor, opsional bisa digunakan untuk mengeset folder template
  public function __construct(string $template_dir = '') {
    if ( ! empty($template_dir)) {
      // cek direktori template ada
      $this->template_dir = $template_dir;
    }
  }
  
  // tampilkan ke browser
  public function render(string $template_file) {
    if (file_exists($this->template_dir . $template_file)) {
      include $this->template_dir . $template_file;
    } else {
      throw new Exception('Tidak file template yang sesuai');
    }
  }

  // setter untuk $vars
  public function __set($name, $value) {
    $this->vars[$name] = $value;
  }

  // getter untuk $vars
  public function __get($name) {
    return $this->vars[$name];
  }
}
```

* File __index.php__ kita akan jadikan pusat kendali aplikasi (_controller_) dengan isi file seperti berikut:
```php
<?php
// spl_autoload_register
spl_autoload_register(function($class_name) {
  include $class_name . '.php';
});

// view baru
$view = new MyView();
$view->mahasiswa = [
  'Suli', 'Zulkifli', 'Sholeh', 'Idris'
];

// tampilkan di browser
try {
  $view->render('mahasiswa.php');
} catch(Exception $e) {
  echo '<h3>Error: ' . $e->getMessage() . '</h3>';
}
```

* Selanjutnya kita buat satu contoh template, buat file dengan nama "__mahasiswa.php__" dan letakkan dalam folder "__templates__" (buat foldernya jika belum ada). Isi dari file __mahasiswa.php__ adalah:

```php
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Mahasiswa</title>
</head>
<body>
  <h3>Nama mahasiswa:</h3>
  <table border="1">
    <tbody>
      <?php foreach($this->vars['mahasiswa'] as $mahasiswa): ?>  
      <tr>
        <td><?php echo $mahasiswa ?></td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</body>
</html>
```

* Buka halaman index (pastikan development server sudah dijalankan) dan jika berhasil Anda akan melihat tabel yang berisi nama-nama mahasiswa yang sudah kita masukkan dalam array di _object_ ```$view```

## Tugas

- Hasil ketikan dan outputnya masukkan dalam laporan















