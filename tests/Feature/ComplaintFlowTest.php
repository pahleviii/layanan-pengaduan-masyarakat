<?php

namespace Tests\Feature;

use App\Models\Complaint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ComplaintFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_renders_with_stats(): void
    {
        Complaint::factory()->count(3)->create(['status' => 'selesai']);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('Sampaikan Aspirasi Anda');
        $response->assertSee('Kategori Pengaduan');
    }

    public function test_lapor_form_renders(): void
    {
        $response = $this->get(route('lapor'));

        $response->assertStatus(200);
        $response->assertSee('Buat Pengaduan Baru');
        $response->assertSee('Data Pelapor');
    }

    public function test_store_complaint_issues_ticket_and_redirects(): void
    {
        $payload = [
            'nama' => 'Budi Santoso',
            'email' => 'budi.santoso@email.com',
            'telepon' => '081234567890',
            'kategori' => 'Jalan Rusak',
            'judul' => 'Jalan berlubang di Jl. Sudirman',
            'deskripsi' => 'Ada lubang besar membahayakan pengendara.',
        ];

        $response = $this->post(route('lapor.store'), $payload);

        $complaint = Complaint::query()->first();
        $this->assertNotNull($complaint);
        $this->assertSame('pending', $complaint->status);
        $this->assertMatchesRegularExpression('/^ADU-\d{8}-\d{4}$/', $complaint->ticket_number);

        $response->assertRedirect(route('lapor.sukses', ['ticket' => $complaint->ticket_number]));
    }

    public function test_store_complaint_validates_required_fields(): void
    {
        $response = $this->post(route('lapor.store'), []);

        $response->assertSessionHasErrors(['nama', 'email', 'telepon', 'kategori', 'judul', 'deskripsi']);
    }
}
