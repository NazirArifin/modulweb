# Modul 11 - Frontend Framework dengan Svelte 5 (bag. 1)

Tujuan Pembelajaran: Mahasiswa mengenal Svelte 5 sebagai framework frontend modern, memahami konsep reaktivitas baru (Runes), dan mampu membangun UI modular berbasis komponen.

## Instalasi

```
npx sv create my-app
cd my-app
npm run dev
```

Dokumentasi lengkap:
- https://svelte.dev/docs/svelte/overview
- https://svelte.dev/docs/kit/introduction


## Materi

### Single Page Application (SPA)

**Single Page Application (SPA)** adalah aplikasi web yang memuat satu halaman HTML tunggal dan memperbarui konten secara dinamis tanpa perlu memuat ulang (refresh) seluruh halaman dari server. Hal ini memberikan pengalaman pengguna yang lebih cepat dan terasa mirip seperti aplikasi desktop. Svelte secara default digunakan untuk membangun SPA.

### Routing SvelteKit

Dalam SvelteKit, routing dibangun secara otomatis berdasarkan struktur folder di dalam direktori `src/routes/` (*file-system based routing*). Setiap halaman diwakili oleh berkas khusus bernama `+page.svelte`.

Untuk membuat navigasi antarhalaman yang konsisten, kita menggunakan berkas layout `+layout.svelte` untuk membungkus halaman-halaman tersebut, serta menggunakan tag tautan HTML biasa (`<a>`) untuk berpindah halaman tanpa me-refresh browser.

Contoh Struktur Routing di SvelteKit:
```text
src/
└── routes/
    ├── +layout.svelte      <-- Layout global (navigasi)
    ├── +page.svelte        <-- Halaman Home (/)
    └── profil/
        └── +page.svelte    <-- Halaman Profil (/profil)
```

1. **`src/routes/+layout.svelte` (Layout Utama):**
```svelte
<script>
  let { children } = $props();
</script>

<nav>
  <a href="/">Home</a>
  <a href="/profil">Profil</a>
</nav>

<main>
  {@render children()}
</main>
```

2. **`src/routes/+page.svelte` (Halaman Home):**
```svelte
<h1>Selamat Datang di Halaman Home</h1>
<p>Ini adalah konten halaman utama.</p>
```

3. **`src/routes/profil/+page.svelte` (Halaman Profil):**
```svelte
<h1>Halaman Profil</h1>
<p>Ini adalah konten halaman profil pengguna.</p>
```

### Reaktivitas Svelte (One-Way dan Two-Way Binding)

Svelte mendukung *one-way binding* dan *two-way binding* untuk menghubungkan data dengan elemen UI.
- **One-way binding**: Data mengalir dari state ke UI. Perubahan state akan memperbarui UI, namun perubahan di UI tidak secara otomatis mengubah state tanpa event listener (seperti `oninput`).
- **Two-way binding**: Data disinkronkan di kedua arah secara otomatis menggunakan direktif `bind:`.

Svelte 5 memperkenalkan sistem reaktivitas baru yang disebut **Runes**. Runes adalah fungsi khusus yang dipahami oleh compiler Svelte untuk menangani state, property, dan efek samping secara lebih eksplisit dan kuat.

#### State dengan $state

Svelte tidak lagi menggunakan variabel biasa untuk reaktivitas. Kita harus menggunakan rune `$state`.

Contoh penghitung Like pada postingan media sosial:
```svelte
<script>
  let likes = $state(0);

  function tambahLike() {
    likes += 1;
  }
</script>

<button onclick={tambahLike}>
  ❤️ Like: {likes}
</button>
```

#### Derived State dengan $derived

Gunakan `$derived` untuk nilai yang bergantung pada state lain. Ini menggantikan sistem `$:` pada versi sebelumnya.

Contoh menentukan status kepopuleran postingan secara otomatis berdasarkan jumlah like:
```svelte
<script>
  let likes = $state(0);
  // Status otomatis diturunkan dari jumlah likes
  let statusPopuler = $derived(likes >= 10 ? '🔥 Viral!' : '🌱 Biasa');
</script>

<button onclick={() => likes++}>❤️ Like: {likes}</button>
<p>Status Postingan: {statusPopuler}</p>
```

#### Efek Side-effect dengan $effect

Gunakan `$effect` untuk menjalankan kode saat state berubah (misal: logging, memicu animasi, atau sinkronisasi data).

Contoh mencetak log ketika postingan menjadi viral:
```svelte
<script>
  let likes = $state(0);
  
  $effect(() => {
    if (likes >= 10) {
      console.log("Selamat! Postingan Anda sudah Viral! 🎉");
    }
  });
</script>

<button onclick={() => likes++}>❤️ Like: {likes}</button>
```

#### Contoh One-Way dan Two-Way Binding

Contoh pengubahan bio akun media sosial:
```svelte
<script>
  let bio = $state('Halo dunia!');
</script>

<!-- One-way binding + event listener manual -->
<input value={bio} oninput={(e) => bio = e.target.value} placeholder="Edit Bio (One-way)" />

<!-- Two-way binding -->
<input bind:value={bio} placeholder="Edit Bio (Two-way)" />

<p>Preview Bio Anda: <em>"{bio}"</em></p>
```

### Templating di Svelte

Svelte menggunakan sintaks HTML standar yang diperluas dengan kemampuan templating dinamis menggunakan kurung kurawal `{}` dan blok logika khusus.

#### 1. Penggunaan Variabel (Interpolasi)

Di Svelte, Anda dapat langsung menyisipkan variabel atau ekspresi JavaScript ke dalam tag HTML menggunakan tanda kurung kurawal `{}`.

Contoh:
```svelte
<script>
  let username = "budi_developer";
  let pengikut = 1250;
</script>

<p>Username Anda: @{username}</p>
<p>Jumlah Pengikut: {pengikut}</p>
<p>Target Pengikut Baru: {pengikut + 100}</p>
```

#### 2. Kondisional dengan {#if}, {:else if}, dan {:else}

Svelte menyediakan blok `{#if}` untuk merender elemen secara kondisional berdasarkan nilai boolean atau ekspresi logika tertentu.

Contoh penggunaan `{#if}` dan `{:else}` untuk status pertemanan:
```svelte
<script>
  let sudahFollow = $state(false);
</script>

{#if sudahFollow}
  <button onclick={() => sudahFollow = false}>Unfollow</button>
{:else}
  <button onclick={() => sudahFollow = true}>Follow</button>
{/if}
```

Contoh penggunaan lengkap dengan `{:else if}` untuk tingkatan akun pengguna:
```svelte
<script>
  let statusAkun = $state("free"); // "free", "premium", atau "admin"
</script>

{#if statusAkun === "admin"}
  <p>Selamat Datang, Admin! Anda memiliki akses kontrol penuh.</p>
{:else if statusAkun === "premium"}
  <p>Akses Premium Aktif! Terima kasih telah berlangganan bebas iklan.</p>
{:else}
  <p>Anda menggunakan akun Free. Upgrade ke Premium untuk akses tanpa iklan!</p>
{/if}
```

#### 3. Iterasi dengan {#each}

Svelte menyediakan blok `{#each}` untuk melakukan iterasi pada struktur data seperti array, dan merender daftar elemen secara berulang.

Contoh menampilkan daftar menu makanan favorit:
```svelte
<script>
  let daftarMenu = $state([
    { id: 1, nama: "Nasi Goreng Special", harga: 20000 },
    { id: 2, nama: "Ayam Geprek Level 5", harga: 15000 },
    { id: 3, nama: "Sate Ayam Madura", harga: 25000 }
  ]);
</script>

<h3>Daftar Menu:</h3>
<ul>
  {#each daftarMenu as menu}
    <li>{menu.nama} - Rp {menu.harga}</li>
  {/each}
</ul>
```

#### 4. Konstanta Lokal dengan {@const}

Tag `{@const}` digunakan untuk mendeklarasikan konstanta lokal di dalam cakupan (*scope*) blok templating seperti `{#each}`, `{#if}`, dan lain-lain. Ini sangat berguna jika Anda ingin melakukan kalkulasi atau transformasi data yang hanya dibutuhkan di dalam blok tersebut tanpa mengotori bagian `<script>`.

Contoh penggunaan `{@const}` untuk menghitung harga setelah diskon di dalam iterasi:
```svelte
<script>
  let daftarMenu = $state([
    { id: 1, nama: "Nasi Goreng Special", harga: 20000, diskon: 0.1 },
    { id: 2, nama: "Ayam Geprek Level 5", harga: 15000, diskon: 0.2 },
    { id: 3, nama: "Sate Ayam Madura", harga: 25000, diskon: 0 }
  ]);
</script>

<ul>
  {#each daftarMenu as menu}
    {@const hargaDiskon = menu.harga * (1 - menu.diskon)}
    <li>
      <strong>{menu.nama}</strong> - 
      {#if menu.diskon > 0}
        <del>Rp {menu.harga}</del> menjadi <strong>Rp {hargaDiskon}</strong> (Diskon {menu.diskon * 100}%)
      {:else}
        Rp {menu.harga}
      {/if}
    </li>
  {/each}
</ul>
```

### Komponen Svelte

Aplikasi Svelte dibangun menggunakan arsitektur berbasis komponen. **Komponen** adalah bagian UI yang mandiri, dapat digunakan kembali (*reusable*), dan menggabungkan logika (JavaScript), struktur (HTML), serta gaya (CSS) dalam satu berkas `.svelte`.

#### 1. Props dengan $props

Komponen menerima data dari parent (komponen induk) melalui rune `$props`. Ini menggantikan penggunaan sintaks `export let` pada versi Svelte sebelumnya.

**SosmedCard.svelte** (Child Component):
```svelte
<script>
  let { username, caption, likes } = $props();
</script>

<div class="card">
  <h3>@{username}</h3>
  <p>{caption}</p>
  <span>❤️ {likes} Likes</span>
</div>

<style>
  .card {
    border: 1px solid #ccc;
    padding: 10px;
    margin: 10px 0;
    border-radius: 8px;
  }
</style>
```

**App.svelte** (Parent Component):
```svelte
<script>
  import SosmedCard from './SosmedCard.svelte';
</script>

<SosmedCard username="budi_dev" caption="Lagi belajar Svelte 5 seru banget! 🚀" likes={42} />
```

#### 2. Mengubah State Parent dari Child Component (Callback Props)

Pada Svelte 5, komunikasi dari komponen anak (*child*) ke komponen induk (*parent*) dilakukan menggunakan **fungsi callback** yang dikirimkan sebagai *props*. Komponen anak cukup memanggil fungsi callback tersebut untuk memicu perubahan *state* di komponen induk.

Contoh implementasi:

**TombolLike.svelte** (Child Component):
```svelte
<script>
  let { apaSudahLiked, onToggleLike } = $props();
</script>

<button onclick={onToggleLike} class:liked={apaSudahLiked}>
  {apaSudahLiked ? '❤️ Liked!' : '🤍 Like'}
</button>

<style>
  button {
    background-color: #f1f2f6;
    color: black;
    border-radius: 5px;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
  }

  button.liked {
    background-color: #ff4757;
    color: white;
  }
</style>
```

**App.svelte** (Parent Component):
```svelte
<script>
  import TombolLike from './TombolLike.svelte';

  let liked = $state(false);
  let totalLikes = $state(150);

  function toggleLike() {
    liked = !liked;
    if (liked) {
      totalLikes += 1;
    } else {
      totalLikes -= 1;
    }
  }
</script>

<div class="post">
  <h3>Postingan Hari Ini</h3>
  <p>Belajar programming itu seru kalau banyak praktek langsung!</p>
  <p>Jumlah Like: {totalLikes}</p>

  <!-- Mengirim state dan fungsi callback ke child -->
  <TombolLike apaSudahLiked={liked} onToggleLike={toggleLike} />
</div>

<style>
  .post {
    border: 1px solid #ddd;
    padding: 15px;
    border-radius: 8px;
  }
</style>
```

## Praktikum

Kita akan membangun aplikasi **Tinder Makanan Sederhana (Food Tinder)** yang menggunakan semua runes dasar.

1. Edit `src/App.svelte`:
```svelte
<script>
  let index = $state(0);
  let likedCount = $state(0);
  let status = $state('Silakan pilih makanan Anda!');
  
  let daftarMakanan = [
    { nama: 'Nasi Goreng', img: '🍳' },
    { nama: 'Ayam Geprek', img: '🍗' },
    { nama: 'Bakso Sapi', img: '🍜' },
    { nama: 'Sate Ayam', img: '🍢' }
  ];
  
  let selesai = $derived(index >= daftarMakanan.length);
  
  $effect(() => {
    if (selesai) {
      status = `Selesai! Anda menyukai ${likedCount} dari ${daftarMakanan.length} makanan.`;
    }
  });

  function swipeRight() {
    likedCount += 1;
    index += 1;
  }

  function swipeLeft() {
    index += 1;
  }
  
  function reset() {
    index = 0;
    likedCount = 0;
    status = 'Silakan pilih makanan Anda!';
  }
</script>

<h1>Food Tinder App 🍔</h1>
<p>Status: {status}</p>

{#if !selesai}
  <div class="card">
    <div class="emoji">{daftarMakanan[index].img}</div>
    <h3>{daftarMakanan[index].nama}</h3>
    
    <button onclick={swipeLeft} class="btn-skip">🙅 Skip</button>
    <button onclick={swipeRight} class="btn-suka">❤️ Suka</button>
  </div>
{:else}
  <button onclick={reset} class="btn-reset">Ulangi Pilihan</button>
{/if}

<style>
  .card {
    border: 2px solid orange;
    padding: 20px;
    text-align: center;
    font-size: 1.5rem;
    max-width: 300px;
    border-radius: 10px;
  }

  .emoji {
    font-size: 3rem;
  }

  .btn-skip {
    background: red;
    color: white;
    border: none;
    padding: 10px 15px;
    margin: 5px;
    border-radius: 5px;
    cursor: pointer;
  }

  .btn-suka {
    background: green;
    color: white;
    border: none;
    padding: 10px 15px;
    margin: 5px;
    border-radius: 5px;
    cursor: pointer;
  }

  .btn-reset {
    padding: 10px 15px;
    cursor: pointer;
  }
</style>
```

## Tugas

1. Buatlah komponen `MakananCard.svelte` menggunakan `$props` untuk menampilkan detail makanan.
2. Tampilkan daftar semua makanan yang disukai menggunakan blok `{#each}`.
3. Tambahkan fitur pencarian makanan menggunakan `$state` untuk input pencarian dan `$derived` untuk memfilter makanan berdasarkan nama.
4. Tambahkan tombol **Hapus** pada setiap item makanan favorit yang disukai yang jika diklik akan menghapusnya dari daftar favorit.
5. Masukkan kode sumber `.svelte` dan screenshot aplikasi ke laporan!
