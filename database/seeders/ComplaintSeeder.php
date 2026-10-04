<?php

namespace Database\Seeders;

use App\Models\Complaint;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Complaint::query()->exists()) {
            return;
        }

        Complaint::query()->create([
            'ticket_number' => 'ADU-20231012-0001',
            'nama' => 'Budi Santoso',
            'email' => 'budi.santoso@email.com',
            'telepon' => '081234567890',
            'kategori' => 'Jalan Rusak',
            'judul' => 'Perbaikan Jalan Berlubang di Jl. Sudirman',
            'deskripsi' => 'Laporan mengenai lubang besar yang membahayakan pengendara telah selesai diperbaiki oleh dinas terkait.',
            'status' => 'selesai',
        ]);

        Complaint::query()->create([
            'ticket_number' => 'ADU-20231010-0002',
            'nama' => 'Siti Aminah',
            'email' => 'siti.aminah@email.com',
            'telepon' => '081234567891',
            'kategori' => 'Kebersihan',
            'judul' => 'Pembersihan Taman Kota Sektor 5',
            'deskripsi' => 'Tumpukan sampah pasca acara akhir pekan telah dibersihkan oleh tim kebersihan kota.',
            'status' => 'selesai',
        ]);

        Complaint::query()->create([
            'ticket_number' => 'ADU-20231008-0003',
            'nama' => 'Ahmad Rizky',
            'email' => 'ahmad.rizky@email.com',
            'telepon' => '081234567892',
            'kategori' => 'Lampu Jalan',
            'judul' => 'Penggantian Lampu PJU Mati',
            'deskripsi' => 'Lampu penerangan jalan umum di area perumahan Griya Indah sudah kembali menyala normal.',
            'status' => 'selesai',
        ]);

        Complaint::factory()->count(9)->create();
    }
}
