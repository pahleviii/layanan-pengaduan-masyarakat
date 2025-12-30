<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Navbar -->
        <nav class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold text-gray-900">Dashboard Admin</h1>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-600">{{ user?.name }}</span>
                        <button 
                            @click="handleLogout"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition"
                        >
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Total Pengaduan</p>
                            <p class="text-3xl font-bold text-gray-900">{{ stats.total }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Pending</p>
                            <p class="text-3xl font-bold text-yellow-600">{{ stats.pending }}</p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Diproses</p>
                            <p class="text-3xl font-bold text-blue-600">{{ stats.in_progress }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Selesai</p>
                            <p class="text-3xl font-bold text-green-600">{{ stats.resolved }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl shadow-lg p-8 text-white mb-8">
                <h2 class="text-2xl font-bold mb-2">Selamat Datang, {{ user?.name }}! 👋</h2>
                <p class="text-blue-100 mb-6">Kelola pengaduan masyarakat dengan mudah dan efisien.</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <router-link to="/admin/complaints" class="bg-white/10 backdrop-blur-sm hover:bg-white/20 rounded-lg p-4 transition">
                        <div class="flex items-center gap-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <div>
                                <p class="font-semibold">Kelola Pengaduan</p>
                                <p class="text-sm text-blue-100">Lihat & update status</p>
                            </div>
                        </div>
                    </router-link>

                    <div class="bg-white/10 backdrop-blur-sm hover:bg-white/20 rounded-lg p-4 transition cursor-pointer">
                        <div class="flex items-center gap-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <div>
                                <p class="font-semibold">Laporan</p>
                                <p class="text-sm text-blue-100">Statistik lengkap</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/10 backdrop-blur-sm hover:bg-white/20 rounded-lg p-4 transition cursor-pointer">
                        <div class="flex items-center gap-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <div>
                                <p class="font-semibold">Pengguna</p>
                                <p class="text-sm text-blue-100">Kelola admin</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coming Soon Notice -->
            <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                <div class="max-w-md mx-auto">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Fitur Admin Lengkap Segera Hadir</h3>
                    <p class="text-gray-600 mb-4">Halaman Kelola Pengaduan, Detail, dan fitur lainnya akan dikembangkan besok!</p>
                    <p class="text-sm text-gray-500">Progress: <span class="font-semibold text-blue-600">70% Complete</span></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import apiClient from '../../api/axios';

const router = useRouter();

const user = ref(null);
const stats = ref({
    total: 0,
    pending: 0,
    in_progress: 0,
    resolved: 0
});

const fetchStatistics = async () => {
    try {
        const response = await apiClient.get('/complaints/statistics');
        if (response.data.success) {
            stats.value = response.data.data;
        }
    } catch (error) {
        console.error('Error fetching statistics:', error);
    }
};

const handleLogout = async () => {
    try {
        await apiClient.post('/logout');
    } catch (error) {
        console.error('Logout error:', error);
    } finally {
        // Clear local storage
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        delete apiClient.defaults.headers.common['Authorization'];
        
        // Redirect to login
        router.push('/admin/login');
    }
};

onMounted(() => {
    // Get user from localStorage
    const userStr = localStorage.getItem('user');
    if (userStr) {
        user.value = JSON.parse(userStr);
    }
    
    // Set axios auth header
    const token = localStorage.getItem('token');
    if (token) {
        apiClient.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    }
    
    // Fetch statistics
    fetchStatistics();
});
</script>
