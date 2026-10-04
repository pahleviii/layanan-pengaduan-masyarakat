<?php

use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InfoPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_tentang_page_renders(): void
    {
        $response = $this->get(route('tentang'));

        $response->assertStatus(200);
        $response->assertSee('Tentang Sistem Pengaduan Masyarakat');
        $response->assertSee('Visi Kami');
        $response->assertSee('Tim Kami');
    }

    public function test_kontak_page_renders(): void
    {
        $response = $this->get(route('kontak'));

        $response->assertStatus(200);
        $response->assertSee('Hubungi Kami');
        $response->assertSee('Informasi Kontak');
    }

    public function test_kontak_form_stores_message(): void
    {
        $response = $this->post(route('kontak.kirim'), [
            'nama' => 'Budi Santoso',
            'email' => 'budi.santoso@email.com',
            'telepon' => '081234567890',
            'kategori' => 'Kebersihan',
            'pesan' => 'Tumpukan sampah di pasar belum diangkut tiga hari.',
        ]);

        $response->assertRedirect(route('kontak'));
        $response->assertSessionHas('success');
        $this->assertSame(1, ContactMessage::query()->count());
    }

    public function test_kontak_form_validates_input(): void
    {
        $response = $this->post(route('kontak.kirim'), []);

        $response->assertSessionHasErrors(['nama', 'email', 'kategori', 'pesan']);
    }

    public function test_faq_page_renders_with_categories(): void
    {
        $response = $this->get(route('faq'));

        $response->assertStatus(200);
        $response->assertSee('Pertanyaan yang Sering Diajukan');
        $response->assertSee('Apa itu Sistem Pengaduan Masyarakat?');
    }

    public function test_faq_search_filters_results(): void
    {
        $response = $this->get(route('faq', ['q' => 'biaya']));

        $response->assertStatus(200);
        $response->assertSee('Apakah layanan ini dipungut biaya?');
        $response->assertDontSee('Apa itu Sistem Pengaduan Masyarakat?');
    }

    public function test_faq_category_switches_topic(): void
    {
        $response = $this->get(route('faq', ['kategori' => 'Privasi']));

        $response->assertStatus(200);
        $response->assertSee('Apakah identitas pelapor akan dirahasiakan?');
    }
}
