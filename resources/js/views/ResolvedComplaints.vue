<template>
    <div class="min-h-screen flex flex-col bg-gray-50">
        <Navbar />
        
        <main class="flex-grow py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-4xl font-bold text-gray-900 mb-3">Pengaduan yang Telah Selesai</h1>
                    <p class="text-lg text-gray-600">Transparansi publik untuk laporan masyarakat yang telah berhasil ditindaklanjuti dan diselesaikan oleh pihak terkait.</p>
                </div>

                <!-- Filter Bar -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Search -->
                        <div class="md:col-span-1">
                            <input 
                                v-model="filters.search"
                                @input="debouncedFetch"
                                type="text" 
                                placeholder="Cari nomor tiket atau judul..."
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            >
                        </div>

                        <!-- Date Range -->
                        <div>
                            <select 
                                v-model="filters.dateRange"
                                @change="fetchComplaints"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            >
                                <option value="">Semua Tanggal</option>
                                <option value="7days">7 Hari Terakhir</option>
                                <option value="30days">30 Hari Terakhir</option>
                                <option value="3months">3 Bulan Terakhir</option>
                            </select>
                        </div>

                        <!-- Category Filter Tabs -->
                        <div class="md:col-span-2">
                            <div class="flex gap-2 overflow-x-auto pb-2">
                                <button 
                                    @click="selectCategory('')"
                                    :class="filters.category_id === '' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                                    class="px-4 py-2 rounded-lg font-medium whitespace-nowrap transition"
                                >
                                    Semua
                                </button>
                                <button 
                                    v-for="cat in categories" 
                                    :key="cat.id"
                                    @click="selectCategory(cat.id)"
                                    :class="filters.category_id === cat.id ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                                    class="px-4 py-2 rounded-lg font-medium whitespace-nowrap transition"
                                >
                                    {{ cat.name }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Results Count -->
                <div class="flex justify-between items-center mb-6">
                    <p class="text-gray-600">
                        Menampilkan <span class="font-semibold">{{ pagination.total }}</span> pengaduan yang telah selesai
                    </p>
                </div>

                <!-- Loading Skeleton -->
                <SkeletonLoader v-if="loading" :count="9" />

                <!-- Complaints Grid -->
                <div v-else-if="complaints.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <div 
                        v-for="complaint in complaints" 
                        :key="complaint.id"
                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition cursor-pointer group"
                    >
                        <!-- Image -->
                        <div class="relative h-48 overflow-hidden bg-gray-200">
                            <img 
                                v-if="complaint.photo"
                                :src="`http://127.0.0.1:8000/${complaint.photo}`" 
                                :alt="complaint.title"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                            >
                            <div v-else class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <span class="absolute top-3 right-3 px-3 py-1 bg-green-600 text-white text-xs font-semibold rounded-full flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Selesai
                            </span>
                        </div>

                        <!-- Content -->
                        <div class="p-5">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-xs text-blue-600 font-semibold bg-blue-50 px-3 py-1 rounded-full">
                                    {{ complaint.ticket_number }}
                                </span>
                                <span class="text-xs text-gray-500">{{ formatDate(complaint.updated_at) }}</span>
                            </div>

                            <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition">
                                {{ complaint.title }}
                            </h3>

                            <span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 text-xs font-medium rounded-full mb-3">
                                {{ complaint.category.name }}
                            </span>

                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                {{ complaint.description }}
                            </p>

                            <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ complaint.name }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-else class="text-center py-16">
                    <svg class="w-32 h-32 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada pengaduan yang diselesaikan</h3>
                    <p class="text-gray-600">Data pengaduan selesai akan muncul di sini.</p>
                </div>

                <!-- Pagination -->
                <div v-if="pagination.last_page > 1" class="flex justify-center items-center gap-2">
                    <button 
                        @click="changePage(pagination.current_page - 1)"
                        :disabled="pagination.current_page === 1"
                        class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>

                    <button 
                        v-for="page in displayedPages" 
                        :key="page"
                        @click="changePage(page)"
                        :class="pagination.current_page === page ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'"
                        class="px-4 py-2 border border-gray-300 rounded-lg font-medium transition"
                    >
                        {{ page }}
                    </button>

                    <button 
                        @click="changePage(pagination.current_page + 1)"
                        :disabled="pagination.current_page === pagination.last_page"
                        class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </main>

        <Footer />
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';
import SkeletonLoader from '../components/SkeletonLoader.vue';
import apiClient from '../api/axios';

const loading = ref(true);
const complaints = ref([]);
const categories = ref([]);

// Filters
const filters = ref({
    search: '',
    category_id: '',
    dateRange: ''
});

// Pagination
const pagination = ref({
    current_page: 1,
    last_page: 1,
    total: 0
});

let debounceTimeout = null;

const debouncedFetch = () => {
    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(() => {
        fetchComplaints();
    }, 500);
};

// Fetch resolved complaints
const fetchComplaints = async (page = 1) => {
    loading.value = true;
    try {
        const params = {
            page,
            search: filters.value.search,
            category_id: filters.value.category_id,
            date_range: filters.value.dateRange
        };

        const response = await apiClient.get('/complaints/resolved', { params });
        
        if (response.data.success) {
            complaints.value = response.data.data.data;
            pagination.value = {
                current_page: response.data.data.current_page,
                last_page: response.data.data.last_page,
                total: response.data.data.total
            };
        }
    } catch (error) {
        console.error('Error fetching resolved complaints:', error);
    } finally {
        loading.value = false;
    }
};

// Fetch categories
const fetchCategories = async () => {
    try {
        const response = await apiClient.get('/categories');
        if (response.data.success) {
            categories.value = response.data.data;
        }
    } catch (error) {
        console.error('Error fetching categories:', error);
    }
};

const selectCategory = (categoryId) => {
    filters.value.category_id = categoryId;
    fetchComplaints();
};

const changePage = (page) => {
    if (page >= 1 && page <= pagination.value.last_page) {
        fetchComplaints(page);
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
};

const displayedPages = computed(() => {
    const pages = [];
    const maxDisplayed = 5;
    const current = pagination.value.current_page;
    const last = pagination.value.last_page;
    
    let start = Math.max(1, current - 2);
    let end = Math.min(last, start + maxDisplayed - 1);
    
    if (end - start < maxDisplayed - 1) {
        start = Math.max(1, end - maxDisplayed + 1);
    }
    
    for (let i = start; i <= end; i++) {
        pages.push(i);
    }
    
    return pages;
});

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'short',
        year: 'numeric'
    });
};

onMounted(() => {
    fetchCategories();
    fetchComplaints();
});
</script>
