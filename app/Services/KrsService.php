<?php

namespace App\Services;

use App\Models\Krs;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;

class KrsService
{
    /**
     * @param  list<int>  $kelasIds
     */
    public function createForMahasiswa(
        Mahasiswa $mahasiswa,
        string $tahunAkademik,
        string $semester,
        array $kelasIds,
    ): Krs {
        return DB::transaction(function () use ($mahasiswa, $tahunAkademik, $semester, $kelasIds): Krs {
            $krs = $mahasiswa->krs()->create([
                'tahun_akademik' => $tahunAkademik,
                'semester' => $semester,
                'status' => 'draft',
            ]);

            foreach ($kelasIds as $kelasId) {
                $krs->details()->create([
                    'kelas_kuliah_id' => $kelasId,
                ]);
            }

            return $krs->load([
                'mahasiswa.programStudi',
                'details.kelasKuliah.mataKuliah',
                'details.kelasKuliah.dosen',
            ]);
        });
    }
}
