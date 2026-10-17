<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function test_dashboard_shows_student_statistics_and_recent_students(): void
    {
        $response = $this->withoutVite()->get(route('dashboard'));

        $response->assertOk()
            ->assertViewIs('dashboard')
            ->assertViewHas('statistics', fn (array $statistics): bool => count($statistics) === 4)
            ->assertViewHas('students', fn (array $students): bool => count($students) === 5)
            ->assertSee('Dashboard Mahasiswa')
            ->assertSee('CampusInfo')
            ->assertSee('Profil Rasimin')
            ->assertSee('Selamat datang, Rasimin')
            ->assertSee('Alya Putri Ramadhani')
            ->assertSee('2024101001')
            ->assertSee('Informatika')
            ->assertSee('Aktif')
            ->assertSee('Cuti')
            ->assertSee('Nonaktif')
            ->assertSee('Mahasiswa terbaru');
    }

    public function test_student_list_page_shows_all_students_and_active_navigation(): void
    {
        $response = $this->withoutVite()->get(route('mahasiswa.index'));

        $response->assertOk()
            ->assertViewHas('students', fn (array $students): bool => count($students) === 5)
            ->assertSee('Data Mahasiswa')
            ->assertSee('Alya Putri Ramadhani')
            ->assertSee('Bima Aditya Pratama')
            ->assertSee('aria-current="page"', false);
    }

    public function test_table_keeps_its_structure_when_showing_an_empty_state(): void
    {
        $html = Blade::render(<<<'BLADE'
            <x-table>
                <x-slot:head><th scope="col">Nama mahasiswa</th></x-slot:head>
                <tr>
                    <td>
                        <x-empty-state title="Belum ada mahasiswa" description="Coba lagi nanti" />
                    </td>
                </tr>
            </x-table>
            BLADE);

        $this->assertStringContainsString('<table', $html);
        $this->assertStringContainsString('Belum ada mahasiswa', $html);
        $this->assertStringContainsString('Coba lagi nanti', $html);
    }
}
