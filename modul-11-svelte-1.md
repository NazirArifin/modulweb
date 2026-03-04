# Modul 11 - Frontend Framework dengan Svelte 5 (bag. 1)

Tujuan Pembelajaran: Mahasiswa mengenal Svelte 5 sebagai framework frontend modern, memahami konsep reaktivitas baru (Runes), dan mampu membangun UI modular berbasis komponen.

## Materi

### Apa itu Svelte 5 & Runes?

Svelte 5 memperkenalkan sistem reaktivitas baru yang disebut **Runes**. Runes adalah fungsi khusus yang dipahami oleh compiler Svelte untuk menangani state, property, dan efek samping secara lebih eksplisit dan kuat.

### State dengan $state

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

### Derived State dengan $derived

Gunakan `$derived` untuk nilai yang bergantung pada state lain. Ini menggantikan sistem `$:` pada versi sebelumnya.

```svelte
<script>
  let count = $state(0);
  let doubled = $derived(count * 2);
</script>

<p>Jumlah: {count}</p>
<p>Dua kali lipat: {doubled}</p>
```

### Props dengan $props

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

### Efek Side-effetto dengan $effect

Gunakan `$effect` untuk menjalankan kode saat state berubah (misal: logging atau sinkronisasi ke storage).

```svelte
<script>
  let count = $state(0);
  
  $effect(() => {
    console.log(`Nilai count sekarang adalah: ${count}`);
  });
</script>
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
4. Masukkan kode sumber `.svelte` dan screenshot aplikasi ke laporan!
