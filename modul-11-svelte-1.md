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

### Templating di Svelte

Svelte menggunakan sintaks HTML standar yang diperluas dengan kemampuan templating dinamis menggunakan kurung kurawal `{}` dan blok logika khusus.

#### 1. Penggunaan Variabel (Interpolasi)

Di Svelte, Anda dapat langsung menyisipkan variabel atau ekspresi JavaScript ke dalam tag HTML menggunakan tanda kurung kurawal `{}`.

Contoh:
```svelte
<script>
  let nama = "Budi";
  let status = "Aktif";
</script>

<p>Halo, nama saya adalah {nama}. Status saya saat ini: {status}</p>
<p>2 + 2 = {2 + 2}</p>
```

#### 2. Kondisional dengan {#if}, {:else if}, dan {:else}

Svelte menyediakan blok `{#if}` untuk merender elemen secara kondisional berdasarkan nilai boolean atau ekspresi logika tertentu.

Contoh penggunaan `{#if}` dan `{:else}`:
```svelte
<script>
  let isLoggedIn = $state(false);
</script>

{#if isLoggedIn}
  <button onclick={() => isLoggedIn = false}>Log Out</button>
{:else}
  <button onclick={() => isLoggedIn = true}>Log In</button>
{/if}
```

Contoh penggunaan lengkap dengan `{:else if}`:
```svelte
<script>
  let nilai = $state(75);
</script>

{#if nilai >= 80}
  <p>Nilai Anda: A</p>
{:else if nilai >= 70}
  <p>Nilai Anda: B</p>
{:else}
  <p>Nilai Anda: C</p>
{/if}
```

#### 3. Iterasi dengan {#each}

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

#### 4. Konstanta Lokal dengan {@const}

Tag `{@const}` digunakan untuk mendeklarasikan konstanta lokal di dalam cakupan (*scope*) blok templating seperti `{#each}`, `{#if}`, dan lain-lain. Ini sangat berguna jika Anda ingin melakukan kalkulasi atau transformasi data yang hanya dibutuhkan di dalam blok tersebut tanpa mengotori bagian `<script>`.

Contoh penggunaan `{@const}` untuk menghitung nilai akhir mahasiswa di dalam iterasi:
```svelte
<script>
  let mahasiswa = $state([
    { id: 1, nama: "Budi", nilaiTugas: 80, nilaiUAS: 90 },
    { id: 2, nama: "Siti", nilaiTugas: 70, nilaiUAS: 75 }
  ]);
</script>

<ul>
  {#each mahasiswa as mhs}
    {@const nilaiAkhir = (mhs.nilaiTugas + mhs.nilaiUAS) / 2}
    <li>
      <strong>{mhs.nama}</strong> - Nilai Akhir: {nilaiAkhir} 
      (Status: {nilaiAkhir >= 75 ? 'Lulus' : 'Tidak Lulus'})
    </li>
  {/each}
</ul>
```

### Komponen Svelte

Aplikasi Svelte dibangun menggunakan arsitektur berbasis komponen. **Komponen** adalah bagian UI yang mandiri, dapat digunakan kembali (*reusable*), dan menggabungkan logika (JavaScript), struktur (HTML), serta gaya (CSS) dalam satu berkas `.svelte`.

#### 1. Props dengan $props

Komponen menerima data dari parent (komponen induk) melalui rune `$props`. Ini menggantikan penggunaan sintaks `export let` pada versi Svelte sebelumnya.

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

#### 2. Mengubah State Parent dari Child Component (Callback Props)

Pada Svelte 5, komunikasi dari komponen anak (*child*) ke komponen induk (*parent*) dilakukan menggunakan **fungsi callback** yang dikirimkan sebagai *props*. Komponen anak cukup memanggil fungsi callback tersebut untuk memicu perubahan *state* di komponen induk.

Contoh implementasi:

**TombolAksi.svelte** (Child Component):
```svelte
<script>
  // Menerima fungsi callback dari parent melalui $props
  let { label, onKlik } = $props();
</script>

<!-- Memanggil fungsi callback ketika tombol diklik -->
<button onclick={onKlik}>
  {label}
</button>
```

**App.svelte** (Parent Component):
```svelte
<script>
  import TombolAksi from './TombolAksi.svelte';

  let count = $state(0);

  function tambahCount() {
    count += 1;
  }
</script>

<p>Count saat ini: {count}</p>

<!-- Mengirimkan fungsi tambahCount ke child component -->
<TombolAksi label="Tambah Nilai" onKlik={tambahCount} />
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
