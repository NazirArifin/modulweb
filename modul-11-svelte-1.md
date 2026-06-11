# Modul 11 - Frontend Framework dengan Svelte 5 (bag. 1)

Tujuan Pembelajaran: Mahasiswa mengenal Svelte 5 sebagai framework frontend modern, memahami konsep reaktivitas baru (Runes), dan mampu membangun UI modular berbasis komponen.

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

```svelte
<script>
  let count = $state(0);

  function increment() {
    count += 1;
  }
</script>

<button onclick={increment}>
  Klik: {count}
</button>
```

#### Derived State dengan $derived

Gunakan `$derived` untuk nilai yang bergantung pada state lain. Ini menggantikan sistem `$:` pada versi sebelumnya.

```svelte
<script>
  let count = $state(0);
  let doubled = $derived(count * 2);
</script>

<p>Jumlah: {count}</p>
<p>Dua kali lipat: {doubled}</p>
```

#### Props dengan $props

Komponen menerima data melalui rune `$props`. Ini lebih bersih daripada `export let`.

**UserCard.svelte**:
```svelte
<script>
  let { nama, npm } = $props();
</script>

<div class="card">
  <h3>{nama}</h3>
  <p>NPM: {npm}</p>
</div>
```

**App.svelte**:
```svelte
<script>
  import UserCard from './UserCard.svelte';
</script>

<UserCard nama="Ali" npm="2022001" />
```

#### Efek Side-effect dengan $effect

Gunakan `$effect` untuk menjalankan kode saat state berubah (misal: logging atau sinkronisasi ke storage).

```svelte
<script>
  let count = $state(0);
  
  $effect(() => {
    console.log(`Nilai count sekarang adalah: ${count}`);
  });
</script>
```

#### Contoh One-Way dan Two-Way Binding

```svelte
<script>
  let nama = $state('');
</script>

<!-- One-way binding + event listener -->
<input value={nama} oninput={(e) => nama = e.target.value} placeholder="One-way binding" />

<!-- Two-way binding -->
<input bind:value={nama} placeholder="Two-way binding" />

<p>Halo, {nama}!</p>
```

### Templating dengan {#each}

Svelte menyediakan blok `{#each}` untuk melakukan iterasi pada struktur data seperti array, dan merender daftar elemen secara berulang. Ini sangat berguna untuk menampilkan daftar data.

Contoh iterasi data mahasiswa:
```svelte
<script>
  let mahasiswa = $state([
    { id: 1, nama: "Budi", npm: "20230001" },
    { id: 2, nama: "Siti", npm: "20230002" }
  ]);
</script>

<ul>
  {#each mahasiswa as mhs}
    <li>{mhs.nama} (NPM: {mhs.npm})</li>
  {/each}
</ul>
```

## Praktikum

Kita akan membangun aplikasi **Counter Plus** yang menggunakan semua runes dasar.

1. Edit `src/App.svelte`:
```svelte
<script>
  let count = $state(0);
  let doubled = $derived(count * 2);
  let color = $state('black');

  $effect(() => {
    if (count > 10) color = 'red';
    else color = 'black';
  });
</script>

<h1 style="color: {color}">Simple Counter</h1>
<p>Count: {count}</p>
<p>Double: {doubled}</p>

<button onclick={() => count++}>Tambah</button>
<button onclick={() => count--}>Kurangi</button>
```

## Tugas

1. Buatlah komponen `MahasiswaCard.svelte` menggunakan `$props`.
2. Tampilkan daftar mahasiswa menggunakan blok `{#each}`.
3. Tambahkan fitur pencarian yang menggunakan `$state` untuk input dan `$derived` untuk hasil filter daftar mahasiswa.
4. Tambahkan tombol **Hapus** pada setiap item mahasiswa yang jika diklik akan menghapus data mahasiswa tersebut dari daftar.
5. Masukkan kode sumber `.svelte` dan screenshot aplikasi ke laporan!
