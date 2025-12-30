<template>
    <div class="min-h-screen flex flex-col bg-gray-50">
        <Navbar />
        
        <main class="flex-grow">
            <!-- Hero Section -->
            <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <div class="inline-block bg-white/10 px-4 py-2 rounded-full text-sm font-medium mb-4">
                        Informasi Publik
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">
                        Tentang Sistem Pengaduan Masyarakat
                    </h1>
                    <p class="text-xl text-blue-100 max-w-3xl mx-auto mb-8">
                        Membangun pelayanan publik yang transparan, responsif, dan akuntabel. Kami hadir untuk menjembatani aspirasi Anda demi kemajuan bersama.
                    </p>
                    <button class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition shadow-lg">
                        Pelajari Lebih Lanjut ↓
                    </button>
                </div>
            </section>

            <!-- Statistics Section -->
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
                    <div class="bg-white rounded-xl shadow-lg p-8 text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <p class="text-4xl font-bold text-gray-900 mb-2">15,000+</p>
                        <p class="text-gray-600">Laporan Diterima</p>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-8 text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-4xl font-bold text-gray-900 mb-2">24 Jam</p>
                        <p class="text-gray-600">Rata-rata Respon</p>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-8 text-center">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-4xl font-bold text-gray-900 mb-2">98%</p>
                        <p class="text-gray-600">Tingkat Kepuasan</p>
                    </div>
                </div>
            </section>

            <!-- Vision & Mission Section -->
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="text-center mb-12">
                    <h2 class="text-sm font-semibold text-blue-600 uppercase tracking-wide mb-2">NILAI-NILAI UTAMA</h2>
                    <h3 class="text-3xl font-bold text-gray-900">Visi & Misi Kami</h3>
                    <p class="text-gray-600 mt-4 max-w-2xl mx-auto">
                        Kami berkomitmen untuk memberikan pelayanan terbaik dengan prinsip transparansi dan akuntabilitas tinggi.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Visi Kami -->
                    <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
                        <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Visi Kami</h4>
                        <p class="text-gray-600 leading-relaxed">
                            Menjadi platform digital terdepan yang mengembangkan transparansi masyarakat secara real-time demi mewujudkan pelayanan publik yang prima dan inklusif.
                        </p>
                    </div>

                    <!-- Misi Kami -->
                    <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
                        <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Misi Kami</h4>
                        <p class="text-gray-600 leading-relaxed">
                            Memberikan respon cepat, menyediakan pelacakan status laporan yang transparan, dan memastikan solusi tuntas bagi setiap laporan yang masuk ke sistem kami.
                        </p>
                    </div>

                    <!-- Nilai Dasar -->
                    <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
                        <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Nilai Dasar</h4>
                        <p class="text-gray-600 leading-relaxed">
                            Menunjung tinggi integritas, kecepatan respon tanpa kompromi, dan koordinasi dalam penanganan setiap laporan yang masuk ke sistem kami.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Team Section -->
            <section class="bg-white py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">Tim Kami</h2>
                        <p class="text-gray-600 max-w-2xl mx-auto">
                            Dikelola oleh para profesional yang berdedikasi untuk melayani masyarakat.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                        <!-- Team Member 1 -->
                        <div class="text-center">
                            <div class="w-32 h-32 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 mx-auto mb-4 flex items-center justify-center text-white text-3xl font-bold">
                                BS
                            </div>
                            <h4 class="font-bold text-gray-900 mb-1">Budi Santoso</h4>
                            <p class="text-sm text-blue-600 mb-2">Kepala Dinas</p>
                        </div>

                        <!-- Team Member 2 -->
                        <div class="text-center">
                            <div class="w-32 h-32 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 mx-auto mb-4 flex items-center justify-center text-white text-3xl font-bold">
                                SA
                            </div>
                            <h4 class="font-bold text-gray-900 mb-1">Siti Aminah</h4>
                            <p class="text-sm text-blue-600 mb-2">Koordinator Layanan</p>
                        </div>

                        <!-- Team Member 3 -->
                        <div class="text-center">
                            <div class="w-32 h-32 rounded-full bg-gradient-to-br from-green-400 to-green-600 mx-auto mb-4 flex items-center justify-center text-white text-3xl font-bold">
                                RP
                            </div>
                            <h4 class="font-bold text-gray-900 mb-1">Reza Pratama</h4>
                            <p class="text-sm text-blue-600 mb-2">Manager IT</p>
                        </div>

                        <!-- Team Member 4 -->
                        <div class="text-center">
                            <div class="w-32 h-32 rounded-full bg-gradient-to-br from-pink-400 to-pink-600 mx-auto mb-4 flex items-center justify-center text-white text-3xl font-bold">
                                DK
                            </div>
                            <h4 class="font-bold text-gray-900 mb-1">Dewi Kusuma</h4>
                            <p class="text-sm text-blue-600 mb-2">Humas & Komunikasi</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="bg-gradient-to-r from-blue-600 to-blue-800 py-16">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 class="text-3xl font-bold text-white mb-4">
                        Siap Melaporkan Masalah di Lingkungan Anda?
                    </h2>
                    <p class="text-xl text-blue-100 mb-8">
                        Jangan ragu untuk menyampaikan aspirasi. Identitas Anda aman dan kami siap menindaklanjuti.
                    </p>
                    <router-link 
                        to="/complaint/form"
                        class="inline-flex items-center bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition shadow-lg"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Buat Pengaduan Sekarang
                    </router-link>
                </div>
            </section>
        </main>

        <Footer />
    </div>
</template>

<script setup>
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';
</script>
