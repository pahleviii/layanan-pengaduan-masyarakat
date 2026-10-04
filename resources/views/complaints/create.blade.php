@extends('layouts.app')

@section('title', 'Buat Pengaduan Baru - Sistem Pengaduan Masyarakat')

@section('content')
<main class="flex-grow py-8 px-4 sm:px-6">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black tracking-tight text-[#0d141b] dark:text-white mb-2">Buat Pengaduan Baru</h2>
                <p class="text-slate-500 dark:text-slate-400">Silakan lengkapi formulir di bawah ini untuk menyampaikan laporan Anda.</p>
            </div>
            <div class="bg-primary/10 text-primary px-4 py-2 rounded-full text-sm font-bold whitespace-nowrap">
                Langkah 1 dari 1
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4">
                <p class="font-bold text-sm mb-2">Periksa kembali isian formulir:</p>
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('lapor.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-[#1a2634] rounded-xl shadow-sm border border-[#e7edf3] dark:border-gray-800 overflow-hidden">
            @csrf
            <div class="p-6 md:p-8 border-b border-[#e7edf3] dark:border-gray-800">
                <div class="flex items-center gap-3 mb-6">
                    <span class="material-symbols-outlined text-primary">person</span>
                    <h3 class="text-xl font-bold">Data Pelapor</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-2 md:col-span-2">
                        <label class="text-sm font-medium text-[#0d141b] dark:text-slate-200" for="nama">Nama Lengkap</label>
                        <input id="nama" name="nama" value="{{ old('nama') }}" class="w-full h-12 px-4 rounded-lg border border-[#cfdbe7] bg-[#f8fafc] dark:bg-[#24303f] dark:border-gray-700 text-base focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all placeholder:text-slate-400" placeholder="Masukkan nama lengkap sesuai KTP" type="text"/>
                        @error('nama')<span class="text-xs text-red-600">{{ $message }}</span>@enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-medium text-[#0d141b] dark:text-slate-200" for="email">Email</label>
                        <input id="email" name="email" value="{{ old('email') }}" class="w-full h-12 px-4 rounded-lg border border-[#cfdbe7] bg-[#f8fafc] dark:bg-[#24303f] dark:border-gray-700 text-base focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all placeholder:text-slate-400" placeholder="contoh@email.com" type="email"/>
                        @error('email')<span class="text-xs text-red-600">{{ $message }}</span>@enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-medium text-[#0d141b] dark:text-slate-200" for="telepon">No. Telepon</label>
                        <input id="telepon" name="telepon" value="{{ old('telepon') }}" class="w-full h-12 px-4 rounded-lg border border-[#cfdbe7] bg-[#f8fafc] dark:bg-[#24303f] dark:border-gray-700 text-base focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all placeholder:text-slate-400" placeholder="0812xxxxxxxx" type="tel"/>
                        @error('telepon')<span class="text-xs text-red-600">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <span class="material-symbols-outlined text-primary">assignment_late</span>
                    <h3 class="text-xl font-bold">Detail Pengaduan</h3>
                </div>
                <div class="flex flex-col gap-6">
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-medium text-[#0d141b] dark:text-slate-200" for="kategori">Kategori Laporan</label>
                        <div class="relative">
                            <select id="kategori" name="kategori" class="w-full h-12 px-4 appearance-none rounded-lg border border-[#cfdbe7] bg-[#f8fafc] dark:bg-[#24303f] dark:border-gray-700 text-base focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all text-[#0d141b] dark:text-white pr-10 cursor-pointer">
                                <option disabled value="" {{ old('kategori', request('kategori')) ? '' : 'selected' }}>Pilih kategori pengaduan</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat }}" {{ old('kategori', request('kategori')) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                            <span class="material-symbols-outlined absolute right-4 top-3 text-slate-500 pointer-events-none">expand_more</span>
                        </div>
                        @error('kategori')<span class="text-xs text-red-600">{{ $message }}</span>@enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-medium text-[#0d141b] dark:text-slate-200" for="judul">Judul Pengaduan</label>
                        <input id="judul" name="judul" value="{{ old('judul') }}" class="w-full h-12 px-4 rounded-lg border border-[#cfdbe7] bg-[#f8fafc] dark:bg-[#24303f] dark:border-gray-700 text-base focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all placeholder:text-slate-400" placeholder="Contoh: Jalan berlubang di Jl. Sudirman" type="text"/>
                        @error('judul')<span class="text-xs text-red-600">{{ $message }}</span>@enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex justify-between items-baseline">
                            <label class="text-sm font-medium text-[#0d141b] dark:text-slate-200" for="deskripsi">Deskripsi Lengkap</label>
                            <span class="text-xs text-slate-400" id="char-counter">0/2000 karakter</span>
                        </div>
                        <textarea id="deskripsi" name="deskripsi" maxlength="2000" class="w-full p-4 rounded-lg border border-[#cfdbe7] bg-[#f8fafc] dark:bg-[#24303f] dark:border-gray-700 text-base focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all placeholder:text-slate-400 resize-none h-32" placeholder="Jelaskan detail kejadian, lokasi, dan waktu...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')<span class="text-xs text-red-600">{{ $message }}</span>@enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-medium text-[#0d141b] dark:text-slate-200" for="foto">Bukti Foto</label>
                        <label for="foto" class="border-2 border-dashed border-[#cfdbe7] dark:border-gray-700 rounded-xl bg-slate-50 dark:bg-[#1e2936] p-8 text-center hover:bg-slate-100 dark:hover:bg-[#24303f] transition-colors cursor-pointer group block">
                            <div class="bg-white dark:bg-[#24303f] w-12 h-12 rounded-full shadow-sm flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-primary">cloud_upload</span>
                            </div>
                            <p class="text-sm font-medium text-[#0d141b] dark:text-white" id="upload-label">Klik untuk upload atau seret foto ke sini</p>
                            <p class="text-xs text-slate-500 mt-1">JPG, JPEG, PNG, WEBP (maks. 5MB)</p>
                        </label>
                        <input id="foto" name="foto" type="file" accept=".jpg,.jpeg,.png,.webp" class="hidden"/>
                        <div id="preview" class="hidden gap-3 mt-2">
                            <img id="preview-img" class="w-20 h-20 rounded-lg object-cover border border-slate-200" alt="Pratinjau foto"/>
                        </div>
                        @error('foto')<span class="text-xs text-red-600">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="px-6 md:px-8 pb-6">
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-900 rounded-lg p-4 flex gap-3 items-start">
                    <span class="material-symbols-outlined text-primary mt-0.5">lock</span>
                    <div>
                        <h4 class="text-sm font-bold text-[#0d141b] dark:text-white">Privasi Anda Terjamin</h4>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mt-0.5">Identitas pelapor akan dijaga kerahasiaannya dan tidak akan dipublikasikan kepada pihak umum sesuai dengan kebijakan privasi kami.</p>
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-8 bg-slate-50 dark:bg-[#15202b] border-t border-[#e7edf3] dark:border-gray-800 flex flex-col-reverse sm:flex-row justify-end gap-4">
                <a href="{{ route('home') }}" class="px-6 py-3 rounded-lg border border-slate-300 dark:border-gray-600 text-slate-700 dark:text-slate-200 font-bold hover:bg-white dark:hover:bg-[#1e2936] transition-colors w-full sm:w-auto text-center">
                    Batal
                </a>
                <button class="px-6 py-3 rounded-lg bg-primary hover:bg-primary/90 text-white font-bold shadow-md shadow-blue-500/20 transition-all transform active:scale-95 flex items-center justify-center gap-2 w-full sm:w-auto" type="submit">
                    <span>Kirim Pengaduan</span>
                    <span class="material-symbols-outlined text-sm">send</span>
                </button>
            </div>
        </form>
    </div>
</main>
@endsection

@push('scripts')
<script>
    const deskripsi = document.getElementById('deskripsi');
    const counter = document.getElementById('char-counter');
    const updateCounter = () => { counter.textContent = deskripsi.value.length + '/2000 karakter'; };
    deskripsi.addEventListener('input', updateCounter);
    updateCounter();

    const fotoInput = document.getElementById('foto');
    const preview = document.getElementById('preview');
    const previewImg = document.getElementById('preview-img');
    const uploadLabel = document.getElementById('upload-label');
    fotoInput.addEventListener('change', () => {
        const file = fotoInput.files[0];
        if (file) {
            previewImg.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            preview.classList.add('flex');
            uploadLabel.textContent = file.name;
        }
    });
</script>
@endpush
