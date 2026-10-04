<?php

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminModuleTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create([
            'email' => 'admin@spm.go.id',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);
    }

    public function test_guest_is_redirected_from_admin_area(): void
    {
        $this->get(route('admin.dashboard'))->assertRedirect(route('admin.login'));
        $this->get(route('admin.pengaduan.index'))->assertRedirect(route('admin.login'));
    }

    public function test_login_page_renders(): void
    {
        $response = $this->get(route('admin.login'));

        $response->assertStatus(200);
        $response->assertSee('Login Administrator');
    }

    public function test_admin_can_login_with_valid_credentials(): void
    {
        $this->admin();

        $response = $this->post(route('admin.login.store'), [
            'email' => 'admin@spm.go.id',
            'password' => 'admin123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticated();
    }

    public function test_login_fails_with_wrong_password(): void
    {
        $this->admin();

        $response = $this->post(route('admin.login.store'), [
            'email' => 'admin@spm.go.id',
            'password' => 'salah',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_dashboard_renders_with_stats(): void
    {
        $this->actingAs($this->admin());
        Complaint::factory()->count(3)->create(['status' => 'pending']);

        $response = $this->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Dashboard');
        $response->assertSee('Pengaduan per Kategori');
        $response->assertSee('Trend Pengaduan 7 Hari');
        $response->assertSee('Recent Complaints');
    }

    public function test_kelola_lists_and_filters_by_status(): void
    {
        $this->actingAs($this->admin());
        Complaint::factory()->create(['status' => 'pending', 'judul' => 'Laporan Menunggu']);
        Complaint::factory()->create(['status' => 'selesai', 'judul' => 'Laporan Beres']);

        $response = $this->get(route('admin.pengaduan.index', ['status' => 'pending']));

        $response->assertStatus(200);
        $response->assertSee('Laporan Menunggu');
        $response->assertDontSee('Laporan Beres');
    }

    public function test_kelola_searches_by_ticket_name_and_title(): void
    {
        $this->actingAs($this->admin());
        $found = Complaint::factory()->create(['nama' => 'NamaUnik Sekali']);
        Complaint::factory()->create(['nama' => 'Orang Lain']);

        $response = $this->get(route('admin.pengaduan.index', ['q' => 'NamaUnik']));

        $response->assertStatus(200);
        $response->assertSee($found->ticket_number);
        $response->assertDontSee('Orang Lain');
    }

    public function test_admin_can_update_status_and_response(): void
    {
        $this->actingAs($this->admin());
        $complaint = Complaint::factory()->create(['status' => 'pending']);

        $response = $this->put(route('admin.pengaduan.update', ['ticket' => $complaint->ticket_number]), [
            'status' => 'proses',
            'admin_response' => 'Tim kami menindaklanjuti.',
        ]);

        $response->assertRedirect(route('admin.pengaduan.show', ['ticket' => $complaint->ticket_number]));
        $this->assertDatabaseHas('complaints', [
            'id' => $complaint->id,
            'status' => 'proses',
            'admin_response' => 'Tim kami menindaklanjuti.',
        ]);
    }

    public function test_admin_can_delete_complaint(): void
    {
        $this->actingAs($this->admin());
        $complaint = Complaint::factory()->create();

        $response = $this->delete(route('admin.pengaduan.destroy', ['ticket' => $complaint->ticket_number]));

        $response->assertRedirect(route('admin.pengaduan.index'));
        $this->assertDatabaseMissing('complaints', ['id' => $complaint->id]);
    }

    public function test_admin_can_bulk_delete_complaints(): void
    {
        $this->actingAs($this->admin());
        $items = Complaint::factory()->count(3)->create();

        $response = $this->delete(route('admin.pengaduan.bulk-destroy'), [
            'ids' => $items->pluck('id')->take(2)->all(),
        ]);

        $response->assertRedirect(route('admin.pengaduan.index'));
        $this->assertSame(1, Complaint::query()->count());
    }

    public function test_admin_can_view_complaint_detail(): void
    {
        $this->actingAs($this->admin());
        $complaint = Complaint::factory()->create(['status' => 'pending']);

        $response = $this->get(route('admin.pengaduan.show', ['ticket' => $complaint->ticket_number]));

        $response->assertStatus(200);
        $response->assertSee($complaint->ticket_number);
        $response->assertSee('Tindak Lanjut');
        $response->assertSee('Danger Zone');
    }

    public function test_admin_can_logout(): void
    {
        $this->actingAs($this->admin());

        $response = $this->post(route('admin.logout'));

        $response->assertRedirect(route('admin.login'));
        $this->assertGuest();
    }
}
