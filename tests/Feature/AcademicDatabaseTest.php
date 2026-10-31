<?php

namespace Tests\Feature;

use App\Models\Dosen;
use App\Models\KelasKuliah;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\ProgramStudi;
use App\Services\KrsService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AcademicDatabaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_krs_creation_is_atomic_and_returns_eager_loaded_relations(): void
    {
        [$mahasiswa, $kelas] = $this->academicRecords();

        $krs = app(KrsService::class)->createForMahasiswa(
            $mahasiswa,
            '2026/2027',
            'ganjil',
            $kelas->pluck('id')->all(),
        );

        $this->assertSame('draft', $krs->status);
        $this->assertCount(3, $krs->details);
        $this->assertTrue($krs->relationLoaded('mahasiswa'));
        $this->assertTrue($krs->mahasiswa->relationLoaded('programStudi'));
        $this->assertTrue($krs->details->first()->kelasKuliah->relationLoaded('mataKuliah'));
        $this->assertTrue($krs->details->first()->kelasKuliah->relationLoaded('dosen'));

        $krs->delete();

        $this->assertDatabaseCount('krs_details', 0);
    }

    public function test_failed_krs_detail_rolls_back_the_header_and_prior_details(): void
    {
        [$mahasiswa, $kelas] = $this->academicRecords();

        try {
            app(KrsService::class)->createForMahasiswa(
                $mahasiswa,
                '2026/2027',
                'ganjil',
                [$kelas[0]->id, $kelas[0]->id],
            );

            $this->fail('A duplicate KRS detail should violate the unique constraint.');
        } catch (QueryException) {
            $this->assertDatabaseCount('krs', 0);
            $this->assertDatabaseCount('krs_details', 0);
        }
    }

    public function test_database_seeder_builds_valid_academic_test_data(): void
    {
        $this->seed();

        $this->assertDatabaseCount('program_studis', 3);
        $this->assertDatabaseCount('dosens', 3);
        $this->assertDatabaseCount('mata_kuliahs', 3);
        $this->assertDatabaseCount('mahasiswas', 50);
        $this->assertDatabaseCount('kelas_kuliahs', 6);
        $this->assertDatabaseCount('krs', 1);
        $this->assertDatabaseCount('krs_details', 3);
    }

    public function test_deleting_a_program_studi_used_by_a_student_is_restricted(): void
    {
        [$mahasiswa] = $this->academicRecords();

        $this->expectException(QueryException::class);

        $mahasiswa->programStudi->delete();
    }

    /**
     * @return array{Mahasiswa, Collection<int, KelasKuliah>}
     */
    private function academicRecords(): array
    {
        $programStudi = ProgramStudi::factory()->create();
        $dosen = Dosen::factory()->create();
        $mahasiswa = Mahasiswa::factory()->for($programStudi)->create();
        $mataKuliah = MataKuliah::factory()->create();

        $kelas = collect(['A', 'B', 'C'])
            ->map(fn (string $namaKelas): KelasKuliah => KelasKuliah::factory()
                ->for($mataKuliah)
                ->for($dosen)
                ->create(['nama_kelas' => $namaKelas]));

        return [$mahasiswa, $kelas];
    }
}
