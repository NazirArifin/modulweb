# Modul 12 - Frontend Framework dengan Svelte 5 (bag. 2)

Tujuan Pembelajaran: Mahasiswa memahami konsep Single Page Application (SPA), mampu melakukan integrasi dengan API external menggunakan Svelte 5, dan mengelola state global.

## Materi

### Persiapan

Pastikan server backend Express + TypeScript sudah berjalan di `http://localhost:3000`. Tambahkan CORS middleware jika belum ada:

```sh
npm install cors
```

tambahkan kode berikut di `src/index.ts`:


```typescript
import cors from 'cors';
app.use(cors());
```

### Integrasi API dengan $effect

Dalam Svelte 5, kita sering menggunakan $effect untuk menangani sinkronisasi data atau pengambilan data saat komponen dimuat.

```svelte
<script lang="ts">
  type Mahasiswa = {
    npm: string;
    nama: string;
    email: string;
  };

  let mhs = $state<Mahasiswa[]>([]);

  async function loadMahasiswa() {
    try {
      const res = await fetch('http://localhost:3000/mahasiswa');
      const data = await res.json();
      mhs = data;
    } catch (error) {
      console.error('Gagal memuat data mahasiswa:', error);
    }
  }

  $effect(() => {
    loadMahasiswa();
  });
</script>

<div class="mx-auto max-w-7xl space-y-4 px-4 py-6 sm:px-6 lg:px-8">

  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-bold">
      Daftar Mahasiswa
    </h1>
    <button
      type="button"
      class="rounded-md bg-blue-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-600"
    >
      Tambah Mahasiswa
    </button>
  </div>

  <div class="mt-4 overflow-x-auto rounded-lg border border-slate-200 shadow-sm">
    <table class="min-w-full divide-y divide-slate-200 bg-white text-sm">
      <thead class="bg-slate-100 text-left text-slate-700">
        <tr>
          <th class="px-4 py-3 font-semibold">No</th>
          <th class="px-4 py-3 font-semibold">NPM</th>
          <th class="px-4 py-3 font-semibold">Nama</th>
          <th class="px-4 py-3 font-semibold">Email</th>
          <th class="px-4 py-3 font-semibold">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-100">
        {#each mhs as item, i (item.npm)}
          <tr class="hover:bg-slate-50">
            <td class="px-4 py-3 text-slate-600">{i + 1}</td>
            <td class="px-4 py-3 font-medium text-slate-900">{item.npm}</td>
            <td class="px-4 py-3 text-slate-800">{item.nama}</td>
            <td class="px-4 py-3 text-slate-700">{item.email}</td>
            <td class="px-4 py-3">
              <div class="flex items-center gap-2">
                <button
                  type="button"
                  class="rounded-md bg-amber-500 px-3 py-1.5 text-xs font-semibold text-white transition hover:bg-amber-600"
                >
                  Edit
                </button>
                <button
                  type="button"
                  class="rounded-md bg-rose-500 px-3 py-1.5 text-xs font-semibold text-white transition hover:bg-rose-600"
                >
                  Hapus
                </button>
              </div>
            </td>
          </tr>
        {/each}
      </tbody>
    </table>
  </div>

</div>
```

### Edit dan Hapus Data Mahasiswa

Setelah data berhasil ditampilkan, langkah berikutnya adalah mengubah data yang sudah ada (`PUT` atau `PATCH`) dan menghapus data (`DELETE`).

Prinsipnya:
- Tombol **Edit** mengisi form dengan data yang dipilih.
- Tombol **Hapus** memanggil API dengan method `DELETE`.
- Setelah operasi berhasil, kita panggil kembali fungsi `loadMahasiswa()` agar tabel selalu terbaru.

Kita akan menggunakan beberapa state untuk menyimpan data mahasiswa, form input, dan mode operasi (create/edit).

```svelte
  let formOpen = $state(true);
	let editingId = $state<number | null>(null);

  // Form state
	let formNama = $state('');
	let formNpm = $state('');
	let formEmail = $state('');
	let formErrors = $state<{ nama?: string; npm?: string; email?: string }>({});
	let submitting = $state(false);
```

kemudian tambahkan form input di atas tabel data mahasiswa

```svelte
  {#if formOpen}
    <form
      class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm" id="student-form"
      onsubmit={(e) => {
        e.preventDefault();
        submitForm();
        formOpen = false;
      }}
    >
      
      <div class="grid gap-4 md:grid-cols-2">
        <div>
          <label for="nama" class="mb-1 block text-sm font-medium text-slate-700">Nama</label>
          <input
            id="nama"
            type="text"
            bind:value={formNama}
            placeholder="Masukkan nama"
            class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
          />
          {#if formErrors.nama}
            <p class="mt-1 text-sm text-red-600">{formErrors.nama}</p>
          {/if}
        </div>
        <div>
          <label for="npm" class="mb-1 block text-sm font-medium text-slate-700">NPM</label>
          <input
            id="npm"
            type="text"
            bind:value={formNpm}
            placeholder="Contoh: 1234567890"
            class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
          />
          {#if formErrors.npm}
            <p class="mt-1 text-sm text-red-600">{formErrors.npm}</p>
          {/if}
        </div>
        <div class="md:col-span-2">
          <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email</label>
          <input
            id="email"
            type="email"
            bind:value={formEmail}
            placeholder="contoh@email.com"
            class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
          />
          {#if formErrors.email}
            <p class="mt-1 text-sm text-red-600">{formErrors.email}</p>
          {/if}
        </div>
      </div>

      <div class="mt-4 flex justify-end gap-2">
        <button
          type="button"
          onclick={() => (formOpen = false)}
          class="rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50"
        >
          Batal
        </button>
        <button
          type="submit"
          disabled={submitting}
          class="rounded-md bg-blue-500 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-600"
        >
          Simpan
        </button>
      </div>
    </form>
  {/if}
```

Kita akan menambahkan beberapa fungsi untuk menangani submit form.

```svelte
  function startEdit(item?: Mahasiswa) {
		editingId = item?.id || null;
		formNama = item?.nama || '';
		formNpm = item?.npm || '';
		formEmail = item?.email || '';
		formErrors = {};
		formOpen = true;

		// Scroll form into view
		const formEl = document.getElementById('student-form');
		if (formEl) {
			formEl.scrollIntoView({ behavior: 'smooth' });
		}
	}
  
  function resetForm() {
		editingId = null;
		formNama = '';
		formNpm = '';
		formEmail = '';
		formErrors = {};
		formOpen = false;
	}
  
  function validateForm() {
		const errors: { nama?: string; npm?: string; email?: string } = {};
		if (!formNama.trim()) {
			errors.nama = 'Nama wajib diisi';
		}

		if (!formNpm.trim()) {
			errors.npm = 'NPM wajib diisi';
		} else if (!/^\d+$/.test(formNpm)) {
			errors.npm = 'NPM harus berupa angka';
		}

		if (!formEmail.trim()) {
			errors.email = 'Email wajib diisi';
		} else if (!/^\S+@\S+\.\S+$/.test(formEmail)) {
			errors.email = 'Format email tidak valid';
		}

		formErrors = errors;
		return Object.keys(errors).length === 0;
	}

	async function submitForm() {
		if (!validateForm()) return;

		submitting = true;
		const bodyData = { nama: formNama, npm: formNpm, email: formEmail };

		try {
			let url = 'http://localhost:3000/mahasiswa';
			let method = 'POST';

			if (editingId !== null) {
				url = `http://localhost:3000/mahasiswa/${editingId}`;
				method = 'PUT';
			}

			const res = await fetch(url, {
				method,
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify(bodyData)
			});

			const result = await res.json();

			if (!res.ok) {
				throw new Error(result.message || 'Gagal memproses data');
			}

			alert(result.message || 'Data berhasil disimpan');
			resetForm();
			await loadMahasiswa();
		} catch (error: any) {
			alert(error.message || 'Terjadi kesalahan saat memproses data');
		} finally {
			submitting = false;
		}
	}
```

Untuk mengaktifkan tombol Edit dan Hapus, kita ubah sedikit bagian aksi pada tabel mahasiswa dan tombol tambah mahasiswa.

```svelte
  <button
      type="button"
      onclick={() => {
        if (formOpen) {
          formOpen = false;
        } else {
          startEdit();
        }
      }}
      class="rounded-md bg-blue-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-600"
    >
      {formOpen ? 'Tutup Form' : 'Tambah Mahasiswa'}
    </button>
```

```svelte
  <button
    type="button"
    class="rounded-md bg-amber-500 px-3 py-1.5 text-xs font-semibold text-white transition hover:bg-amber-600"
    onclick={() => startEdit(item)}
  >
    Edit
  </button>
```

Berikutnya untuk fitur hapus, kita tambahkan fungsi `deleteMahasiswa` dan panggil pada tombol Hapus.

```svelte
  async function deleteMahasiswa(id: number) {
		if (!confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?')) return;

		try {
			const res = await fetch(`http://localhost:3000/mahasiswa/${id}`, {
				method: 'DELETE'
			});

			const result = await res.json();
			if (!res.ok) throw new Error(result.message || 'Gagal menghapus data');

			await loadMahasiswa();
			alert('Data mahasiswa berhasil dihapus');
		} catch (error: any) {
			alert(error.message || 'Terjadi kesalahan saat menghapus data');
		}
	}
```

lalu ubah tombol Hapus menjadi seperti berikut:


```svelte
  <button
    type="button"
    class="rounded-md bg-rose-500 px-3 py-1.5 text-xs font-semibold text-white transition hover:bg-rose-600"
    onclick={() => deleteMahasiswa(item.id)}
  >
    Hapus
  </button>
```

## Tugas

1. Sempurnakan fitur Login: buat form yang mengirim email/password ke API, lalu simpan token ke dalam `localStorage` atau shared state.
2. Implementasikan fitur Logout yang menghapus token dari state dan mengembalikan tampilan ke kondisi awal.
3. Tambahkan halaman /dosen dan /matakuliah dengan struktur dan fungsionalitas serupa seperti halaman mahasiswa. Pastikan untuk menyesuaikan endpoint API yang digunakan.
4. Buat validasi form yang lebih lengkap, misalnya memastikan email memiliki format yang benar
5. Tampilkan pesan sukses/gagal menggunakan `alert()` atau notifikasi sederhana agar user mengetahui hasil operasi.
6. Masukkan kode sumber beserta screenshot interaksi aplikasi (login, tambah/edit, hapus, dan logout) ke dalam laporan.
