<template>
    <div class="min-h-screen flex flex-col bg-gray-50">
        <Navbar />
        
        <main class="flex-grow">
            <!-- Hero Section -->
            <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
                    <div class="text-center">
                        <h1 class="text-4xl md:text-5xl font-bold mb-6">
                            Sampaikan Aspirasi Anda, <br class="hidden md:block">
                            <span class="text-blue-200">Kami Siap Mendengarkan</span>
                        </h1>
                        <p class="text-xl text-blue-100 mb-8 max-w-3xl mx-auto">
                            Layanan aspirasi dan pengaduan online rakyat. Laporkan masalah di lingkungan Anda dengan mudah, cepat, dan transparan demi kemajuan bersama.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <router-link to="/complaint/form" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition shadow-lg">
                                📝 Buat Pengaduan Baru
                            </router-link>
                            <router-link to="/complaint/tracking" class="bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-800 transition border-2 border-blue-400">
                                🔍 Lacak Status Laporan
                            </router-link>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Statistics Section -->
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Total Pengaduan -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium mb-1">TOTAL PENGADUAN</p>
                                <p class="text-4xl font-bold text-gray-900">{{ stats.total }}</p>
                            </div>
                            <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Sedang Diproses -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium mb-1">SEDANG DIPROSES</p>
                                <p class="text-4xl font-bold text-gray-900">{{ stats.in_progress }}</p>
                            </div>
                            <div class="w-14 h-14 bg-orange-100 rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Selesai -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium mb-1">SELESAI</p>
                                <p class="text-4xl font-bold text-gray-900">{{ stats.resolved }}</p>
                            </div>
                            <div class="w-14 h-14 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Categories Section -->
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Kategori Pengaduan</h2>
                    <p class="text-lg text-gray-600">Pilih kategori yang sesuai dengan masalah yang ingin Anda laporkan untuk mempercepat proses penanganan oleh petugas terkait.</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    <div v-for="category in categories" :key="category.id" 
                         class="bg-white rounded-xl shadow-md hover:shadow-xl transition p-6 text-center cursor-pointer hover:-translate-y-1">
                        <div class="text-4xl mb-3">{{ category.icon }}</div>
                        <p class="font-semibold text-gray-900">{{ category.name }}</p>
                    </div>
                </div>
            </section>

            <!-- Recent Resolved Complaints -->
            <section class="bg-white py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center mb-12">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-2">Pengaduan Selesai Terbaru</h2>
                            <p class="text-gray-600">Lihat bagaimana kami menyelesaikan laporan masyarakat.</p>
                        </div>
                        <router-link to="/complaint/resolved" class="text-blue-600 font-semibold hover:text-blue-700 flex items-center">
                            Lihat Semua
                            <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </router-link>
                    </div>

                    <!-- Loading Skeleton -->
                    <SkeletonLoader v-if="loading" :count="3" />

                    <!-- Actual Content -->
                    <div v-else class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div v-for="complaint in recentResolved" :key="complaint.id" 
                             class="bg-gray-50 rounded-xl overflow-hidden hover:shadow-lg transition">
                            <img :src="complaint.image" :alt="complaint.title" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-xs text-gray-500">{{ complaint.date }}</span>
                                    <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Selesai</span>
                                </div>
                                <span class="text-xs text-blue-600 font-medium">{{ complaint.category }}</span>
                                <h3 class="text-lg font-bold text-gray-900 mt-2 mb-2">{{ complaint.title }}</h3>
                                <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ complaint.description }}</p>
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ complaint.reporter }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <Footer />
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';
import SkeletonLoader from '../components/SkeletonLoader.vue';
import apiClient from '../api/axios';

const loading = ref(true);

// Data statistik
const stats = ref({
    total: 0,
    in_progress: 0,
    resolved: 0
});

// Data kategori
const categories = ref([
    { id: 1, name: 'Jalan Rusak', icon: '🛣️' },
    { id: 2, name: 'Kebersihan', icon: '🗑️' },
    { id: 3, name: 'Lampu Jalan', icon: '💡' },
    { id: 4, name: 'Saluran Air', icon: '💧' },
    { id: 5, name: 'Fasilitas Umum', icon: '🏛️' },
    { id: 6, name: 'Lainnya', icon: '📋' }
]);

// Data pengaduan selesai terbaru
const recentResolved = ref([
    {
        id: 1,
        title: 'Perbaikan Jalan Berlubang di Jl. Sudirman',
        category: 'Jalan Rusak',
        description: 'Laporan mengenai lubang besar yang membahayakan pengendara telah selesai diperbaiki.',
        image: 'https://images.unsplash.com/photo-1615840287214-7ff58936c4cf?w=400&h=300&fit=crop',
        date: '12 Oktober 2023',
        reporter: 'Budi Santoso'
    },
    {
        id: 2,
        title: 'Pembersihan Taman Kota Sektor 5',
        category: 'Kebersihan',
        description: 'Tumpukan sampah pasca acara telah dibersihkan oleh tim kebersihan kota.',
        image: 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=400&h=300&fit=crop',
        date: '10 Oktober 2023',
        reporter: 'Siti Aminah'
    },
    {
        id: 3,
        title: 'Penggantian Lampu PJU Mati',
        category: 'Lampu Jalan',
        description: 'Lampu penerangan jalan umum di area perumahan Griya Indah sudah kembali menyala normal.',
        image: 'https://images.unsplash.com/photo-1513828583688-c52646db42da?w=400&h=300&fit=crop',
        date: '08 Oktober 2023',
        reporter: 'Ahmad Rizky'
    }
]);

// Fetch statistics from API
const fetchStatistics = async () => {
    loading.value = true;
    try {
        const response = await apiClient.get('/complaints/statistics');
        if (response.data.success) {
            stats.value = response.data.data;
        }
    } catch (error) {
        console.error('Error fetching statistics:', error);
    } finally {
        // Simulasi loading 1 detik
        setTimeout(() => {
            loading.value = false;
        }, 1000);
    }
};

// Fetch categories from API
const fetchCategories = async () => {
    try {
        const response = await apiClient.get('/categories');
        if (response.data.success) {
            const icons = ['🛣️', '🗑️', '💡', '💧', '🏛️', '📋'];
            categories.value = response.data.data.map((cat, index) => ({
                ...cat,
                icon: icons[index] || '📋'
            }));
        }
    } catch (error) {
        console.error('Error fetching categories:', error);
    }
};

onMounted(() => {
    fetchStatistics();
    fetchCategories();
});
</script>
