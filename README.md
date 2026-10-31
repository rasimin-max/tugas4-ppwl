# CampusInfo - Database Engineering dengan Laravel

Implementasi studi kasus akademik Laravel 12 untuk materi Database Engineering. Skema berisi
tujuh tabel akademik dan menggunakan tabel `users` bawaan Laravel untuk autentikasi.

## Relasi dan aturan integritas

```text
program_studis 1---* mahasiswas 1---* krs 1---* krs_details *---1 kelas_kuliahs
dosens 0..1---* kelas_kuliahs *---1 mata_kuliahs
```

- `program_studis` memiliki banyak `mahasiswas`; prodi yang masih dipakai mahasiswa tidak dapat dihapus.
- `mahasiswas` memiliki banyak KRS dan hanya boleh memiliki satu KRS per tahun akademik/semester.
- `mata_kuliahs` dan `dosens` menjadi master untuk `kelas_kuliahs`; kelas membatasi penghapusan mata kuliah, sedangkan penghapusan dosen mengosongkan `dosen_id`.
- `krs` adalah header pengambilan kelas. `krs_details` menyimpan kelas yang diambil; penghapusan KRS menghapus detailnya, dan kelas yang masih dipakai tidak dapat dihapus.
- Unique constraint pada kode/NIM/email, periode kelas, periode KRS, dan pasangan KRS-kelas menjaga data tetap konsisten.
- Index gabungan `mahasiswas(program_studi_id, angkatan)` melayani daftar mahasiswa berdasarkan prodi dan angkatan; `kelas_kuliahs(tahun_akademik, semester)` melayani daftar penawaran per periode. Unique index periode KRS juga mendukung pencarian KRS mahasiswa per semester.

## Menyiapkan aplikasi

Jalankan migration dan data contoh:

```bash
php artisan migrate
php artisan db:seed
```

Seeder membuat minimal tiga program studi, tiga dosen, tiga mata kuliah, 50 mahasiswa, enam kelas, dan satu KRS berisi tiga detail. Untuk mengulang data dari kondisi kosong gunakan `php artisan migrate:fresh --seed`; perintah `migrate:fresh` menghapus semua tabel dan data.

## Transaksi dan eager loading

`App\Services\KrsService` membuat header KRS beserta seluruh detail di dalam satu `DB::transaction()`.
Service mengembalikan relasi mahasiswa/prodi, kelas/mata kuliah, dan dosen dengan eager loading untuk
menghindari query N+1:

```php
Krs::with([
    'mahasiswa.programStudi',
    'details.kelasKuliah.mataKuliah',
    'details.kelasKuliah.dosen',
])->findOrFail($id);
```

## Pengujian

```bash
php artisan test --filter=AcademicDatabaseTest
```

Pengujian memakai SQLite in-memory, memeriksa relasi dan aturan penghapusan, memverifikasi seeder,
serta membuktikan header dan detail KRS ikut rollback jika salah satu detail gagal disimpan.
