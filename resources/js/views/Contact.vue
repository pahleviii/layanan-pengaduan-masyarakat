<template>
    <div class="min-h-screen flex flex-col bg-gray-50">
        <Navbar />
        
        <main class="flex-grow">
            <!-- Hero Section -->
            <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">Hubungi Kami</h1>
                    <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                        Kami siap mendengar aspirasi, keluhan, dan saran Anda. Hubungi kami melalui formulir di bawah ini atau kunjungi kantor pelayanan kami.
                    </p>
                </div>
            </section>

            <!-- Contact Form & Info Section -->
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 -mt-12">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Contact Form -->
                    <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Formulir Pengaduan & Kontak</h2>
                        <p class="text-gray-600 mb-6">
                            Silakan isi formulir di bawah ini dengan data yang valid agar kami dapat segera memproses permintaan Anda.
                        </p>

                        <form @submit.prevent="handleSubmit">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <!-- Nama Lengkap -->
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                                    <input 
                                        v-model="form.name"
                                        type="text"
                                        placeholder="Contoh: Budi Santoso"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        required
                                    >
                                </div>

                                <!-- Alamat Email -->
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Alamat Email</label>
                                    <input 
                                        v-model="form.email"
                                        type="email"
                                        placeholder="nama@email.com"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <!-- Nomor Telepon -->
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Nomor Telepon</label>
                                    <input 
                                        v-model="form.phone"
                                        type="tel"
                                        placeholder="+62 812-3456-7890"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        required
                                    >
                                </div>

                                <!-- Kategori Pengaduan -->
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Kategori Pengaduan</label>
                                    <select 
                                        v-model="form.category"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        required
                                    >
                                        <option value="">Pilih kategori</option>
                                        <option value="pengaduan">Pengaduan</option>
                                        <option value="pertanyaan">Pertanyaan Umum</option>
                                        <option value="saran">Saran & Masukan</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Pesan Pengaduan -->
                            <div class="mb-6">
                                <label class="block text-gray-700 font-medium mb-2">Pesan Pengaduan</label>
                                <textarea 
                                    v-model="form.message"
                                    rows="6"
                                    placeholder="Jelaskan detail pengaduan Anda secara lengkap..."
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required
                                ></textarea>
                            </div>

                            <!-- Submit Button -->
                            <button 
                                type="submit"
                                :disabled="submitting"
                                class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition disabled:bg-gray-400 flex items-center justify-center"
                            >
                                <svg v-if="submitting" class="animate-spin h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span v-if="!submitting">Kirim Pesan →</span>
                                <span v-else>Mengirim...</span>
                            </button>
                        </form>
                    </div>

                    <!-- Contact Information -->
                    <div class="lg:col-span-1 space-y-6">
                        <!-- Alamat Kantor -->
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="font-bold text-gray-900 mb-1">Alamat Kantor</h3>
                                    <p class="text-sm text-gray-600">Jl. Merdeka Raya No. 45, Gedung Pelayanan Publik Lt. 1, Jakarta Pusat, 10110</p>
                                </div>
                            </div>
                        </div>

                        <!-- Telepon & Hotline -->
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="font-bold text-gray-900 mb-1">Telepon & Hotline</h3>
                                    <p class="text-sm text-gray-600">(021) 555-0123 (Kantor)</p>
                                    <p class="text-sm text-gray-600">112 (Darurat)</p>
                                </div>
                            </div>
                        </div>

                        <!-- Email Resmi -->
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="font-bold text-gray-900 mb-1">Email Resmi</h3>
                                    <p class="text-sm text-gray-600">pengaduan@pemerintah.go.id</p>
                                </div>
                            </div>
                        </div>

                        <!-- Jam Operasional -->
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="font-bold text-gray-900 mb-2">Jam Operasional</h3>
                                    <div class="space-y-1">
                                        <p class="text-sm text-gray-600">Senin - Jumat: <span class="font-semibold text-green-600">08:00 - 16:00 WIB</span></p>
                                        <p class="text-sm text-gray-600">Sabtu - Minggu: <span class="font-semibold text-red-600">Tutup</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Map Section -->
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6 border-b">
                        <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Lihat di Peta
                        </h2>
                    </div>
                    <div class="h-96 bg-gray-200">
                        <!-- Google Maps Embed (ganti dengan URL embed map yang sebenarnya) -->
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.8195613!3d-6.1753924!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f432d4e7e5b1%3A0x3f9c9f8f2f8f2f8f!2sJakarta!5e0!3m2!1sen!2sid!4v1234567890"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                        ></iframe>
                    </div>
                </div>
            </section>

            <!-- FAQ Quick Links -->
            <section class="bg-white py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">Pertanyaan Umum (FAQ)</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="bg-gray-50 rounded-xl p-6 hover:shadow-lg transition cursor-pointer">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <h3 class="font-bold text-gray-900 mb-2">Cara Melacak Tiket?</h3>
                            <p class="text-sm text-gray-600">Panduan memeriksa status laporan Anda.</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-6 hover:shadow-lg transition cursor-pointer">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="font-bold text-gray-900 mb-2">Waktu Respons?</h3>
                            <p class="text-sm text-gray-600">Estimasi waktu penanganan pengaduan.</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-6 hover:shadow-lg transition cursor-pointer">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <h3 class="font-bold text-gray-900 mb-2">Kerahasiaan Data?</h3>
                            <p class="text-sm text-gray-600">Kebijakan privasi pelapor.</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-6 hover:shadow-lg transition cursor-pointer">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h3 class="font-bold text-gray-900 mb-2">Bantuan Teknis?</h3>
                            <p class="text-sm text-gray-600">Hubungi admin untuk masalah website.</p>
                        </div>
                    </div>

                    <div class="text-center mt-12">
                        <router-link to="/faq" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-700">
                            Lihat Semua FAQ
                            <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </router-link>
                    </div>
                </div>
            </section>
        </main>

        <Footer />
    </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';

const form = reactive({
    name: '',
    email: '',
    phone: '',
    category: '',
    message: ''
});

const submitting = ref(false);

const handleSubmit = () => {
    submitting.value = true;
    
    // Simulate API call
    setTimeout(() => {
        alert('Pesan Anda telah terkirim! Kami akan segera menghubungi Anda.');
        
        // Reset form
        form.name = '';
        form.email = '';
        form.phone = '';
        form.category = '';
        form.message = '';
        
        submitting.value = false;
    }, 2000);
};
</script>
