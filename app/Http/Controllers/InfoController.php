<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InfoController extends Controller
{
    public function tentang(): View
    {
        $totalLaporan = Complaint::query()->count();

        return view('info.tentang', compact('totalLaporan'));
    }

    public function kontak(): View
    {
        return view('info.kontak', [
            'categories' => ComplaintController::CATEGORIES,
        ]);
    }

    public function kirimPesan(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'telepon' => ['nullable', 'string', 'max:30'],
            'kategori' => ['required', 'string', 'in:'.implode(',', ComplaintController::CATEGORIES)],
            'pesan' => ['required', 'string', 'max:2000'],
        ]);

        ContactMessage::query()->create($validated);

        return redirect()
            ->route('kontak')
            ->with('success', 'Pesan Anda telah terkirim. Tim kami akan menghubungi Anda maksimal 2x24 jam kerja.');
    }

    public function faq(Request $request): View
    {
        $query = trim((string) $request->query('q', ''));
        $kategori = (string) $request->query('kategori', 'Umum');

        $all = $this->faqs();

        $categories = array_keys($all);

        if (! in_array($kategori, $categories, true)) {
            $kategori = 'Umum';
        }

        $items = $all[$kategori];

        if ($query !== '') {
            $matched = [];
            foreach ($all as $cat => $list) {
                foreach ($list as $item) {
                    if (stripos($item['q'], $query) !== false || stripos($item['a'], $query) !== false) {
                        $matched[] = $item + ['kategori' => $cat];
                    }
                }
            }

            return view('info.faq', [
                'items' => $matched,
                'categories' => $categories,
                'kategori' => null,
                'query' => $query,
                'searching' => true,
            ]);
        }

        return view('info.faq', [
            'items' => $items,
            'categories' => $categories,
            'kategori' => $kategori,
            'query' => $query,
            'searching' => false,
        ]);
    }

    /**
     * @return array<string, list<array{q: string, a: string}>>
     */
    private function faqs(): array
    {
        return [
            'Umum' => [
                [
                    'q' => 'Apa itu Sistem Pengaduan Masyarakat?',
                    'a' => 'Sistem Pengaduan Masyarakat adalah platform digital resmi yang disediakan oleh pemerintah untuk memudahkan warga dalam menyampaikan keluhan, saran, atau laporan terkait pelayanan publik. Sistem ini dirancang untuk transparansi dan percepatan penyelesaian masalah di lingkungan masyarakat.',
                ],
                [
                    'q' => 'Apakah layanan ini dipungut biaya?',
                    'a' => 'Tidak. Seluruh layanan pengaduan masyarakat ini tidak dipungut biaya apapun (gratis). Jika ada oknum yang meminta biaya atas nama layanan ini, mohon segera laporkan melalui kategori "Lainnya" dengan judul mengandung kata pungli.',
                ],
                [
                    'q' => 'Siapa saja yang dapat membuat pengaduan?',
                    'a' => 'Seluruh warga dapat membuat pengaduan tanpa harus mendaftar akun. Cukup isi data pelapor, detail laporan, dan lampirkan foto bukti untuk mempercepat verifikasi.',
                ],
            ],
            'Proses Pengaduan' => [
                [
                    'q' => 'Bagaimana cara membuat pengaduan?',
                    'a' => 'Buka halaman Buat Pengaduan, isi data pelapor (nama, email, telepon), pilih kategori, tulis judul dan deskripsi lengkap, lampirkan foto bukti, lalu klik Kirim Pengaduan. Anda akan menerima nomor tiket untuk melacak status laporan.',
                ],
                [
                    'q' => 'Berapa lama waktu yang dibutuhkan untuk memproses pengaduan?',
                    'a' => 'Waktu pemrosesan bervariasi tergantung pada kompleksitas masalah dan instansi terkait. Namun, secara umum, verifikasi awal dilakukan dalam 1x24 jam kerja. Anda akan mendapatkan estimasi waktu penyelesaian setelah status laporan berubah menjadi "Diproses".',
                ],
                [
                    'q' => 'Apa saja kategori pengaduan yang tersedia?',
                    'a' => 'Kategori yang tersedia adalah Jalan Rusak, Kebersihan, Lampu Jalan, Saluran Air, Fasilitas Umum, dan Lainnya. Pilih kategori yang paling sesuai agar laporan diteruskan ke dinas yang tepat.',
                ],
            ],
            'Lacak Status' => [
                [
                    'q' => 'Bagaimana cara melacak status pengaduan saya?',
                    'a' => 'Buka halaman Lacak Pengaduan, masukkan nomor tiket yang Anda terima saat melapor (contoh: ADU-20231012-0001), lalu klik Lacak. Status laporan akan ditampilkan beserta riwayat penanganannya.',
                ],
                [
                    'q' => 'Apa arti setiap status pengaduan?',
                    'a' => 'Menunggu Verifikasi: laporan baru masuk dan antre verifikasi admin. Diproses: laporan valid dan sedang ditindaklanjuti dinas terkait. Selesai: penanganan tuntas. Ditolak: laporan tidak valid atau duplikat, disertai alasan tertulis dari admin.',
                ],
                [
                    'q' => 'Saya lupa atau kehilangan nomor tiket, bagaimana solusinya?',
                    'a' => 'Hubungi kami melalui halaman Kontak dengan menyertakan nama, email, dan perkiraan tanggal pelaporan. Tim kami akan membantu menemukan nomor tiket Anda setelah verifikasi identitas.',
                ],
            ],
            'Privasi' => [
                [
                    'q' => 'Apakah identitas pelapor akan dirahasiakan?',
                    'a' => 'Ya. Identitas pelapor dijaga kerahasiaannya dan tidak dipublikasikan kepada pihak umum sesuai kebijakan privasi kami. Data pribadi hanya dapat diakses oleh petugas berwenang untuk keperluan verifikasi dan tindak lanjut.',
                ],
                [
                    'q' => 'Apakah foto yang saya unggah ditampilkan ke publik?',
                    'a' => 'Foto bukti hanya digunakan untuk keperluan verifikasi dan penanganan oleh petugas. Foto laporan yang berstatus selesai dapat ditampilkan di galeri transparansi publik tanpa menyertakan identitas pelapor.',
                ],
            ],
            'Teknis' => [
                [
                    'q' => 'Format dan ukuran foto apa yang didukung?',
                    'a' => 'Foto bukti mendukung format JPG, JPEG, PNG, dan WEBP dengan ukuran maksimal 5MB per berkas. Pastikan foto jelas dan menunjukkan kondisi yang dilaporkan.',
                ],
                [
                    'q' => 'Saya mengalami kendala teknis pada website, ke mana melapor?',
                    'a' => 'Sampaikan kendala teknis melalui formulir di halaman Kontak dengan kategori "Lainnya" dan jelaskan kendala yang dialami (misalnya halaman error, gagal unggah foto). Tim IT kami akan menindaklanjuti.',
                ],
            ],
        ];
    }
}
