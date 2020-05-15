# Modul 5 - CSS Flexbox

Tujuan Pembelajaran: Mahasiswa mengenal konsep flex box di CSS dan dapat menggunakan CSS flex box untuk mengatur tampilan di halaman web

## Materi

* Flexbox Layout bertujuan untuk mempermudah dan menyediakan cara yang lebih efisien untuk meletakkan, meratakan, dan mendistribusikan jarak antar elemen dalam sebuah wadah / _container_ bahkan ketika lebar / tinggi elemen tidak diketahui (karena ini disebut dengan flex)
* Dengan flexbox kita dapat memberikan kemampuan pada  _container_ untuk mengubah lebar dan tinggi dari elemen-elemen yang ada di dalamnya agar dapat menangani semua jenis ukuran layar.
* Flexbox berdasarkan pada arah (_direction_), berbeda dengan box model umum yang didasarkan pada konsep __block__ dan __inline__.

* Flexbox diaplikasi pada ___flex container___ / wadah / induk elemen dan pada ___flex item___.
* Flex item akan ditampilkan berdasarkan arah utama (__main axis__) dan arah menyilang (__cross axis__) dan kedua arah dapat dimulai dari awal __start__ sampai ke akhir __end__.
* Untuk membuat sebuah container menjadi flexbox maka digunakan perintah css:

```css
div {
  display: flex;
}
```

### Daftar Perintah untuk Container (Parent)

* __flex-direction__: digunakan untuk menentukan item diletakkan secara berurutan dengan nilai:

  - _row_: (default) berjajar horizontal, dari kiri ke kanan (untuk setting ltr) atau kanan kiri (untuk setting rtl)
  - _row-reverse_: kebalikan dari row
  - _column_: berjajar vertical dari atas ke bawah
  - _column-reverse_: kebalikan dari column

![flex-direction](https://github.com/NazirArifin/modulweb/blob/master/img/flex-direction.png)

* flex-wrap: defaultnya semua elemen dalam container sebanyak apapun akan dipaksa pas satu baris. Anda dapat mengubah agar pindah baris atau tidak dengan beberapa nilai:

  - _nowrap_: (default) semua item disejajarkan dalam satu baris
  - _wrap_: item-item akan dibungkus menjadi beberapa baris bila lebih dari satu baris secara berurutan
  - _wrap_reverse_: sama dengan wrap tapi item diletakkan secara berkebalikan

![flex-wrap](https://github.com/NazirArifin/modulweb/blob/master/img/flex-wrap.png)

* flex-flow: gabungan dari __flex-direction__ dan __flex-flow__, dengan nilai defaultnya adalah __row nowrap__.

* __justify-content__: digunakan untuk mengatur perataan (_alignment_) dari elemen-elemen dalam _container_ berdasarkan pada __main axis__.  Nilainya antara lain:

  - _flex-start_: (default) semua item rata awal dari wadah (biasanya kiri)
  - _flex-end_: semua item rata akhir dari wadah (biasanya kanan)
  - _center_: di tengah
  - _space-between_: semua item didistribusikan dengan adanya jarak antar item, item pertama di awal baris dan item terakhir di akhir baris
  - _space-around_: jarak didistribusikan pada sisi kanan kiri dari item
  - _space-evenly_: jarak antara dua item sama

![justify-content](https://github.com/NazirArifin/modulweb/blob/master/img/justify-content.png)

* __align-items__: mengatur bagaimana item di tampilkan berdasarkan __cross axis__ (justify-content versi cross axis). Nilainya antara lain:

  - _stretch_: (default) item "ditarik" agar tingginya memenuhi wadah / _container_ (tetap mempertimbangkan perintah height/max-height)
  - _flex-start_: diletakkan diawal cross axis
  - _flex-end_: diletakkan diakhir cross axis
  - _center_: diletakkan ditengah
  - _baseline_: disejajarkan berdasarkan baseline

![align-items](https://github.com/NazirArifin/modulweb/blob/master/img/align-items.png)

* align-content: mengatur jarak atau peletakan item-item yang terdapat __lebih dari satu__ baris (Tidak ada efek jika hanya ada satu baris item-item). Nilainya antara lain:

  - _flex-start_: baris-baris diletakkan diawal container
  - _flex-end_: baris-baris diletakkan diakhir container
  - _center_: diletakkan di tengah
  - _space-between_: ada jarak antar item dengan baris pertama menempel awal container sedangkan baris terakhir menempel akhir dari container
  - _space-around_: ada jarak yang sama antar baris
  - _space-evenly_: ada jarak yang sama antar seluruh baris
  - _stretch_: (default) dimana baris ditarik untuk memenuhi seluruh container

![align-content](https://github.com/NazirArifin/modulweb/blob/master/img/align-content.png)

## Praktikum







## Tugas

