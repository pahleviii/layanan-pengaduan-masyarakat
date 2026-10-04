<?php

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create([
            'email' => 'admin@spm.go.id',
            'password' => bcrypt('admin123'),
        ]);
    }

    public function test_guest_is_redirected_to_login(): void
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

    public function test_dashboard_renders_kpis_and_charts(): void
    {
        $this->actingAs($this->admin());
        Complaint::factory()->count(3)->create(['status' => 'pending']);
        Complaint::factory()->count(2)->create(['status' => 'selesai']);

        $response = $this->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Total Pengaduan');
        $response->assertSee('Trend Pengaduan 7 Hari');
        $response->assertSee('Recent Complaints');
    }

    public function test_kelola_filters_by_status_and_search(): void
    {
        $this->actingAs($this->admin());
        Complaint::factory()->create(['status' => 'pending', 'judul' => 'Lubang Jalan Unik']);
        Complaint::factory()->create(['status' => 'selesai', 'judul' => 'Sampah Sudah Beres']);

        $response = $this->get(route('admin.pengaduan.index', ['status' => 'pending']));

        $response->assertStatus(200);
        $response->assertSee('Lubang Jalan Unik');
        $response->assertDontSee('Sampah Sudah Beres');

        $response = $this->get(route('admin.pengaduan.index', ['q' => 'Sampah']));

        $response->assertSee('Sampah Sudah Beres');
        $response->assertDontSee('Lubang Jalan Unik');
    }

    public function test_admin_can_update_status_and_response(): void
    {
        $this->actingAs($this->admin());
        $complaint = Complaint::factory()->create(['status' => 'pending']);

        $response = $this->put(route('admin.pengaduan.update', ['ticket' => $complaint->ticket_number]), [
            'status' => 'proses',
            'admin_response' => 'Tim survei meluncur besok.',
        ]);

        $response->assertRedirect(route('admin.pengaduan.show', ['ticket' => $complaint->ticket_number]));
        $this->assertDatabaseHas('complaints', [
            'id' => $complaint->id,
            'status' => 'proses',
            'admin_response' => 'Tim survei meluncur besok.',
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

    public function test_admin_can_bulk_delete(): void
    {
        $this->actingAs($this->admin());
        $ids = Complaint::factory()->count(3)->create()->pluck('id')->toArray();

        $response = $this->delete(route('admin.pengaduan.bulk-destroy'), ['ids' => $ids]);

        $response->assertRedirect(route('admin.pengaduan.index'));
        $this->assertSame(0, Complaint::query()->whereIn('id', $ids)->count());
    }

    public function test_admin_can_logout(): void
    {
        $this->actingAs($this->admin());

        $response = $this->post(route('admin.logout'));

        $response->assertRedirect(route('admin.login'));
        $this->assertGuest();
    }
}
