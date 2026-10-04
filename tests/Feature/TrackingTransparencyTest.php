<?php

use App\Models\Complaint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrackingTransparencyTest extends TestCase
{
    use RefreshDatabase;

    public function test_lacak_page_shows_empty_state_without_ticket(): void
    {
        $response = $this->get(route('lacak'));

        $response->assertStatus(200);
        $response->assertSee('Lacak Status Pengaduan');
        $response->assertSee('Belum ada data ditampilkan');
    }

    public function test_lacak_finds_complaint_by_ticket(): void
    {
        $complaint = Complaint::factory()->create([
            'ticket_number' => 'ADU-20231012-0001',
            'status' => 'proses',
        ]);

        $response = $this->get(route('lacak', ['ticket' => $complaint->ticket_number]));

        $response->assertStatus(200);
        $response->assertSee($complaint->ticket_number);
        $response->assertSee('Riwayat Status');
        $response->assertSee('Detail Laporan');
    }

    public function test_lacak_shows_not_found_for_unknown_ticket(): void
    {
        $response = $this->get(route('lacak', ['ticket' => 'ADU-20000101-9999']));

        $response->assertStatus(200);
        $response->assertSee('Tiket tidak ditemukan');
    }

    public function test_lacak_show_route_resolves_ticket(): void
    {
        $complaint = Complaint::factory()->create(['status' => 'selesai']);

        $response = $this->get(route('lacak.show', ['ticket' => $complaint->ticket_number]));

        $response->assertStatus(200);
        $response->assertSee($complaint->judul);
    }

    public function test_transparansi_lists_only_resolved(): void
    {
        Complaint::factory()->create(['status' => 'selesai', 'judul' => 'Sudah Beres']);
        Complaint::factory()->create(['status' => 'pending', 'judul' => 'Masih Antre']);

        $response = $this->get(route('transparansi'));

        $response->assertStatus(200);
        $response->assertSee('Pengaduan yang Telah Selesai');
        $response->assertSee('Sudah Beres');
        $response->assertDontSee('Masih Antre');
    }

    public function test_transparansi_filters_by_search_and_category(): void
    {
        Complaint::factory()->create([
            'status' => 'selesai',
            'kategori' => 'Kebersihan',
            'judul' => 'Sampah Menumpuk di Pasar',
        ]);
        Complaint::factory()->create([
            'status' => 'selesai',
            'kategori' => 'Jalan Rusak',
            'judul' => 'Jalan Berlubang',
        ]);

        $response = $this->get(route('transparansi', ['q' => 'Sampah']));

        $response->assertStatus(200);
        $response->assertSee('Sampah Menumpuk di Pasar');
        $response->assertDontSee('Jalan Berlubang');

        $response = $this->get(route('transparansi', ['kategori' => 'Jalan Rusak']));

        $response->assertStatus(200);
        $response->assertSee('Jalan Berlubang');
        $response->assertDontSee('Sampah Menumpuk di Pasar');
    }
}
