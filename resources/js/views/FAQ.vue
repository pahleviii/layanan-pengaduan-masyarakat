<template>
    <div class="min-h-screen flex flex-col bg-gray-50">
        <Navbar />
        
        <main class="flex-grow">
            <!-- Hero Section with Search -->
            <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">Pertanyaan yang Sering Diajukan</h1>
                    <p class="text-xl text-blue-100 mb-8">
                        Temukan jawaban cepat seputar proses pengaduan, pelacakan status, dan privasi data Anda di sini.
                    </p>
                    
                    <!-- Search Bar -->
                    <div class="relative max-w-2xl mx-auto">
                        <input 
                            v-model="searchQuery"
                            type="text"
                            placeholder="Cari pertanyaan atau topik (misal: cara melacak)..."
                            class="w-full px-6 py-4 pr-32 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-300"
                        >
                        <button class="absolute right-2 top-2 bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                            Cari
                        </button>
                    </div>
                </div>
            </section>

            <!-- Statistics Section -->
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-gray-900 mb-1">50+</p>
                        <p class="text-sm text-gray-600">Pertanyaan Terjawab</p>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-gray-900 mb-1">5</p>
                        <p class="text-sm text-gray-600">Kategori Topik</p>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-gray-900 mb-1">10k+</p>
                        <p class="text-sm text-gray-600">Pengguna Terbantu</p>
                    </div>
                </div>
            </section>

            <!-- Category Tabs -->
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Kategori Topik</h2>
                <div class="flex flex-wrap gap-3 mb-8">
                    <button 
                        v-for="category in categories" 
                        :key="category.id"
                        @click="activeCategory = category.id"
                        :class="[
                            'px-6 py-2 rounded-full font-medium transition',
                            activeCategory === category.id 
                                ? 'bg-blue-600 text-white' 
                                : 'bg-white text-gray-700 hover:bg-gray-100'
                        ]"
                    >
                        {{ category.name }}
                    </button>
                </div>

                <!-- FAQ Accordion -->
                <div class="space-y-4">
                    <div 
                        v-for="(faq, index) in filteredFAQs" 
                        :key="index"
                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition"
                    >
                        <button 
                            @click="toggleFAQ(index)"
                            class="w-full text-left px-6 py-5 flex items-center justify-between hover:bg-gray-50 transition"
                        >
                            <span class="font-semibold text-gray-900 pr-4">{{ faq.question }}</span>
                            <svg 
                                :class="['w-5 h-5 text-gray-500 transition-transform', { 'rotate-180': openFAQ === index }]"
                                fill="none" 
                                stroke="currentColor" 
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div 
                            v-show="openFAQ === index"
                            class="px-6 pb-5 text-gray-600 border-t border-gray-100"
                        >
                            <p class="pt-4">{{ faq.answer }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Still Have Questions CTA -->
            <section class="bg-gradient-to-r from-blue-600 to-blue-800 py-16">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 class="text-3xl font-bold text-white mb-4">Masih Butuh Bantuan?</h2>
                    <p class="text-xl text-blue-100 mb-8">
                        Jika pertanyaan Anda belum terjawab di atas, tim dukungan kami siap membantu Anda menyelesaikan masalah.
                    </p>
                    <router-link 
                        to="/contact"
                        class="inline-flex items-center bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition shadow-lg"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        Hubungi Kami
                    </router-link>
                </div>
            </section>
        </main>

        <Footer />
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';

const searchQuery = ref('');
const activeCategory = ref('all');
const openFAQ = ref(null);

const categories = [
    { id: 'all', name: 'Semua' },
    { id: 'general', name: 'Umum' },
    { id: 'submission', name: 'Proses Pengaduan' },
    { id: 'tracking', name: 'Lacak Status' },
    { id: 'privacy', name: 'Privasi' },
    { id: 'technical', name: 'Teknis' }
];

const faqs = [
    {
        category: 'general',
        question: 'Apa itu Sistem Pengaduan Masyarakat?',
        answer: 'Sistem Pengaduan Masyarakat adalah platform digital resmi yang disediakan oleh pemerintah untuk memudahkan warga dalam menyampaikan keluhan, saran, atau laporan terkait pelayanan publik. Sistem ini dirancang untuk transparansi dan percepatan penyelesaian masalah di lingkungan masyarakat.'
    },
    {
        category: 'submission',
        question: 'Bagaimana cara membuat pengaduan baru?',
        answer: 'Klik menu "Buat Pengaduan" di halaman utama, isi formulir dengan data lengkap (nama, email, kategori, deskripsi masalah), unggah foto jika ada, lalu klik "Kirim Pengaduan". Anda akan mendapatkan nomor tiket untuk melacak status.'
    },
    {
        category: 'submission',
        question: 'Apakah identitas pelapor akan dirahasiakan?',
        answer: 'Ya, identitas pelapor dijaga kerahasiaannya sesuai dengan kebijakan privasi kami. Data pribadi Anda hanya digunakan untuk keperluan verifikasi dan komunikasi terkait penanganan pengaduan, tidak akan dipublikasikan atau disalahgunakan.'
    },
    {
        category: 'tracking',
        question: 'Bagaimana cara melacak status pengaduan saya?',
        answer: 'Masuk ke halaman "Lacak Status", masukkan nomor tiket yang Anda terima saat membuat pengaduan, lalu klik "Lacak Pengaduan". Anda akan melihat status terkini (Pending, Diproses, Selesai) beserta catatan dari admin jika ada.'
    },
    {
        category: 'tracking',
        question: 'Berapa lama waktu yang dibutuhkan untuk memproses pengaduan?',
        answer: 'Estimasi waktu penanganan bervariasi tergantung kategori dan tingkat kompleksitas masalah. Rata-rata pengaduan diproses dalam 3-7 hari kerja. Pengaduan darurat akan diprioritaskan dan direspon dalam 24 jam.'
    },
    {
        category: 'submission',
        question: 'Apa saja kategori pengaduan yang tersedia?',
        answer: 'Kategori meliputi: Jalan Rusak, Kebersihan, Lampu Jalan, Saluran Air, Fasilitas Umum, dan Lainnya. Pilih kategori yang paling sesuai agar laporan Anda ditangani oleh unit yang tepat.'
    },
    {
        category: 'tracking',
        question: 'Apakah saya akan mendapat notifikasi jika status berubah?',
        answer: 'Saat ini sistem belum mendukung notifikasi otomatis via email/SMS. Anda perlu melacak status secara manual menggunakan nomor tiket. Fitur notifikasi sedang dalam pengembangan dan akan segera tersedia.'
    },
    {
        category: 'privacy',
        question: 'Apakah layanan ini dipungut biaya?',
        answer: 'Tidak, layanan pengaduan ini sepenuhnya GRATIS. Kami tidak memungut biaya apapun untuk proses pelaporan, pemrosesan, atau penyelesaian pengaduan masyarakat.'
    },
    {
        category: 'technical',
        question: 'Format file apa yang didukung untuk upload foto?',
        answer: 'Sistem mendukung format JPG, JPEG, dan PNG dengan ukuran maksimal 2MB per file. Pastikan foto jelas dan relevan dengan pengaduan Anda untuk mempercepat proses verifikasi.'
    },
    {
        category: 'technical',
        question: 'Bagaimana jika saya lupa nomor tiket pengaduan?',
        answer: 'Jika Anda lupa nomor tiket, silakan hubungi tim dukungan kami melalui halaman "Hubungi Kami" dengan menyertakan informasi seperti nama lengkap, email, dan perkiraan tanggal pengaduan dibuat. Tim kami akan membantu menemukan nomor tiket Anda.'
    },
    {
        category: 'general',
        question: 'Apakah pengaduan saya pasti akan ditindaklanjuti?',
        answer: 'Semua pengaduan yang masuk akan diverifikasi dan ditinjau oleh petugas terkait. Pengaduan yang valid dan sesuai kewenangan akan segera ditindaklanjuti. Pengaduan yang tidak relevan atau di luar kewenangan akan diberikan penjelasan dan arahan yang tepat.'
    },
    {
        category: 'privacy',
        question: 'Bagaimana keamanan data pribadi saya dijamin?',
        answer: 'Kami menggunakan enkripsi SSL dan protokol keamanan standar industri untuk melindungi data pribadi Anda. Data hanya diakses oleh petugas berwenang dan tidak akan dibagikan ke pihak ketiga tanpa persetujuan Anda, kecuali diwajibkan oleh hukum.'
    }
];

const filteredFAQs = computed(() => {
    let filtered = faqs;
    
    // Filter by category
    if (activeCategory.value !== 'all') {
        filtered = filtered.filter(faq => faq.category === activeCategory.value);
    }
    
    // Filter by search query
    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase();
        filtered = filtered.filter(faq => 
            faq.question.toLowerCase().includes(query) || 
            faq.answer.toLowerCase().includes(query)
        );
    }
    
    return filtered;
});

const toggleFAQ = (index) => {
    openFAQ.value = openFAQ.value === index ? null : index;
};
</script>
