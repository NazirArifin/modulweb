# Modul 17 - Frontend Framework dengan Svelte 5 (bag. 2)

Tujuan Pembelajaran: Mahasiswa memahami konsep Single Page Application (SPA), mampu melakukan integrasi dengan API external menggunakan Svelte 5, dan mengelola state global.

## Materi

### Integrasi API dengan $effect

Dalam Svelte 5, kita sering menggunakan $effect untuk menangani sinkronisasi data atau pengambilan data saat komponen dimuat.

```svelte
<script>
  let mhs = $state([]);

  $effect(() => {
    fetch('http://localhost:3000/mahasiswa')
      .then(res => res.json())
      .then(data => mhs = data);
  });
</script>

<ul>
  {#each mhs as item}
    <li>{item.nama}</li>
  {/each}
</ul>
```

### State Management (Shared State)

Svelte 5 memungkinkan kita membuat state yang bisa dibagikan antar komponen cukup dengan mengekspor variabel `$state` dari file `.js` atau `.ts`.

**src/lib/auth.svelte.js**:
```javascript
export const auth = $state({
  token: '',
  isLoggedIn: false
});

export function login(token) {
  auth.token = token;
  auth.isLoggedIn = true;
}
```

**App.svelte**:
```svelte
<script>
  import { auth } from './lib/auth.svelte.js';
</script>

{#if auth.isLoggedIn}
  <p>Selamat datang!</p>
{:else}
  <p>Silakan login.</p>
{/if}
```

## Praktikum

Kita akan mengintegrasikan frontend Svelte dengan backend Express + TypeScript yang telah dibuat.

1. Gunakan `svelte-spa-router` untuk navigasi.
2. Buat file `src/routes/Home.svelte`:
```svelte
<script>
  import { auth } from '../lib/auth.svelte.js';
  let data = $state([]);

  $effect(() => {
    fetch('http://localhost:3000/mahasiswa', {
      headers: { 'Authorization': `Bearer ${auth.token}` }
    })
    .then(res => res.json())
    .then(val => data = val);
  });
</script>

<h1>Daftar Mahasiswa</h1>
{#each data as mhs}
  <p>{mhs.nama} - {mhs.npm}</p>
{/each}
```

## Tugas

1. Sempurnakan fitur Login: Buat form yang mengirim email/password ke API, simpan tokennya ke dalam shared state (`auth.svelte.js`).
2. Implementasikan fitur Logout yang menghapus token dari state.
3. Tambahkan fitur hapus mahasiswa: Berikan tombol "Hapus" pada daftar, dan panggil API `DELETE` dengan menyertakan token di header.
4. Masukkan kode sumber dan screenshot interaksi aplikasi ke laporan!
