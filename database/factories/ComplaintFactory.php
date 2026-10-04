<?php

namespace Database\Factories;

use App\Models\Complaint;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Complaint>
 */
class ComplaintFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $kategori = $this->faker->randomElement([
            'Jalan Rusak',
            'Kebersihan',
            'Lampu Jalan',
            'Saluran Air',
            'Fasilitas Umum',
            'Lainnya',
        ]);

        return [
            'ticket_number' => 'ADU-'.now()->format('Ymd').'-'.str_pad((string) $this->faker->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
            'nama' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'telepon' => '0812'.$this->faker->numerify('########'),
            'kategori' => $kategori,
            'judul' => $this->faker->sentence(6),
            'deskripsi' => $this->faker->paragraph(3),
            'foto_path' => null,
            'status' => $this->faker->randomElement(['pending', 'proses', 'selesai', 'selesai', 'selesai']),
        ];
    }
}
