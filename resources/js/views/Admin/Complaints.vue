<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Navbar -->
        <nav class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center gap-8">
                        <router-link to="/admin/dashboard" class="text-xl font-bold text-gray-900">
                            Dashboard Admin
                        </router-link>
                        <router-link to="/admin/complaints" class="text-blue-600 font-medium">
                            Kelola Pengaduan
                        </router-link>
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
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Kelola Pengaduan</h1>
                <p class="text-gray-600">Lihat dan update status pengaduan masyarakat</p>
            </div>

            <!-- Filters -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Pengaduan</label>
                        <input 
                            v-model="filters.search"
                            @input="debouncedFetch"
                            type="text"
                            placeholder="Cari berdasarkan tiket, judul, atau nama..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select 
                            v-model="filters.status"
                            @change="fetchComplaints"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                            <option value="all">Semua Status</option>
                            <option value="pending">Pending</option>
                            <option value="in_progress">Diproses</option>
                            <option value="resolved">Selesai</option>
                            <option value="rejected">Ditolak</option>
                        </select>
                    </div>

                    <!-- Category Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select 
                            v-model="filters.category_id"
                            @change="fetchComplaints"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                            <option value="">Semua Kategori</option>
                            <option v-for="cat in categories" :key="cat.id" :value="cat.id">
                                {{ cat.name }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Loading State -->
            <div v-if="loading" class="text-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div>
                <p class="text-gray-600 mt-4">Memuat data...</p>
            </div>

            <!-- Complaints Table -->
            <div v-else-if="complaints.length > 0" class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Tiket</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelapor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="complaint in complaints" :key="complaint.id" class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">{{ complaint.ticket_number }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ complaint.title }}</div>
                                    <div class="text-sm text-gray-500 truncate max-w-xs">{{ complaint.description }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-900">{{ complaint.category.name }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ complaint.name }}</div>
                                    <div class="text-sm text-gray-500">{{ complaint.email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span :class="getStatusClass(complaint.status)" class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full">
                                        {{ getStatusText(complaint.status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ formatDate(complaint.created_at) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button 
                                        @click="openDetailModal(complaint)"
                                        class="text-blue-600 hover:text-blue-900"
                                    >
                                        Detail →
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-gray-50 px-6 py-4 flex items-center justify-between border-t border-gray-200">
                    <div class="text-sm text-gray-700">
                        Menampilkan {{ pagination.from }} - {{ pagination.to }} dari {{ pagination.total }} pengaduan
                    </div>
                    <div class="flex gap-2">
                        <button 
                            @click="changePage(pagination.current_page - 1)"
                            :disabled="!pagination.prev_page_url"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            ← Sebelumnya
                        </button>
                        <button 
                            @click="changePage(pagination.current_page + 1)"
                            :disabled="!pagination.next_page_url"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            Selanjutnya →
                        </button>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-else class="bg-white rounded-xl shadow-sm p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada pengaduan</h3>
                <p class="mt-2 text-sm text-gray-500">Belum ada pengaduan yang sesuai dengan filter yang dipilih.</p>
            </div>
        </div>

        <!-- Detail Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" @click.self="closeModal">
            <div class="relative top-20 mx-auto p-8 w-full max-w-3xl">
                <div class="bg-white rounded-xl shadow-2xl">
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between p-6 border-b">
                        <h3 class="text-2xl font-bold text-gray-900">Detail Pengaduan</h3>
                        <button @click="closeModal" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Content -->
                    <div class="p-6 max-h-96 overflow-y-auto">
                        <div class="grid grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">No. Tiket</label>
                                <p class="text-sm text-gray-900 font-semibold">{{ selectedComplaint?.ticket_number }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                <p class="text-sm text-gray-900">{{ selectedComplaint?.category.name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pelapor</label>
                                <p class="text-sm text-gray-900">{{ selectedComplaint?.name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <p class="text-sm text-gray-900">{{ selectedComplaint?.email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                                <p class="text-sm text-gray-900">{{ selectedComplaint?.phone }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                                <p class="text-sm text-gray-900">{{ formatDate(selectedComplaint?.created_at) }}</p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Pengaduan</label>
                            <p class="text-sm text-gray-900">{{ selectedComplaint?.title }}</p>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ selectedComplaint?.description }}</p>
                        </div>

                        <div v-if="selectedComplaint?.photo" class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto</label>
                            <img :src="`http://127.0.0.1:8000/${selectedComplaint.photo}`" alt="Foto pengaduan" class="w-full rounded-lg">
                        </div>

                        <!-- Update Status Form -->
                        <div class="border-t pt-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Update Status</h4>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                    <select 
                                        v-model="updateForm.status"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    >
                                        <option value="pending">Pending</option>
                                        <option value="in_progress">Sedang Diproses</option>
                                        <option value="resolved">Selesai</option>
                                        <option value="rejected">Ditolak</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Admin</label>
                                    <textarea 
                                        v-model="updateForm.admin_note"
                                        rows="4"
                                        placeholder="Tambahkan catatan atau alasan perubahan status..."
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex items-center justify-end gap-4 p-6 border-t bg-gray-50">
                        <button 
                            @click="closeModal"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100"
                        >
                            Batal
                        </button>
                        <button 
                            @click="updateStatus"
                            :disabled="updating"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:bg-gray-400 flex items-center gap-2"
                        >
                            <svg v-if="updating" class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>{{ updating ? 'Menyimpan...' : 'Simpan Perubahan' }}</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { useToast } from 'vue-toastification';
import apiClient from '../../api/axios';

const router = useRouter();
const toast = useToast();

const user = ref(null);
const complaints = ref([]);
const categories = ref([]);
const loading = ref(false);
const showModal = ref(false);
const selectedComplaint = ref(null);
const updating = ref(false);

const filters = reactive({
    search: '',
    status: 'all',
    category_id: ''
});

const updateForm = reactive({
    status: '',
    admin_note: ''
});

const pagination = reactive({
    current_page: 1,
    from: 0,
    to: 0,
    total: 0,
    prev_page_url: null,
    next_page_url: null
});

let debounceTimeout = null;

const debouncedFetch = () => {
    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(() => {
        fetchComplaints();
    }, 500);
};

const fetchComplaints = async (page = 1) => {
    loading.value = true;
    try {
        const params = {
            page,
            ...filters
        };
        
        const response = await apiClient.get('/admin/complaints', { params });
        
        if (response.data.success) {
            complaints.value = response.data.data.data;
            
            // Update pagination
            Object.assign(pagination, {
                current_page: response.data.data.current_page,
                from: response.data.data.from,
                to: response.data.data.to,
                total: response.data.data.total,
                prev_page_url: response.data.data.prev_page_url,
                next_page_url: response.data.data.next_page_url
            });
        }
    } catch (error) {
        console.error('Error fetching complaints:', error);
        alert('Gagal memuat data pengaduan');
    } finally {
        loading.value = false;
    }
};

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

const changePage = (page) => {
    fetchComplaints(page);
};

const openDetailModal = (complaint) => {
    selectedComplaint.value = complaint;
    updateForm.status = complaint.status;
    updateForm.admin_note = complaint.admin_note || '';
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    selectedComplaint.value = null;
};

const updateStatus = async () => {
    updating.value = true;
    try {
        const response = await apiClient.put(`/admin/complaints/${selectedComplaint.value.id}`, updateForm);
        
        if (response.data.success) {
            toast.success('Status pengaduan berhasil diupdate! ✓');
            closeModal();
            fetchComplaints(pagination.current_page);
        }
    } catch (error) {
        console.error('Error updating status:', error);
        toast.error('Gagal update status pengaduan');
    } finally {
        updating.value = false;
    }
};

const handleLogout = async () => {
    try {
        await apiClient.post('/logout');
        toast.info('Anda telah logout');
    } catch (error) {
        console.error('Logout error:', error);
    } finally {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        delete apiClient.defaults.headers.common['Authorization'];
        router.push('/admin/login');
    }
};

const getStatusClass = (status) => {
    const classes = {
        'pending': 'bg-yellow-100 text-yellow-800',
        'in_progress': 'bg-blue-100 text-blue-800',
        'resolved': 'bg-green-100 text-green-800',
        'rejected': 'bg-red-100 text-red-800'
    };
    return classes[status] || 'bg-gray-100 text-gray-800';
};

const getStatusText = (status) => {
    const texts = {
        'pending': 'Pending',
        'in_progress': 'Diproses',
        'resolved': 'Selesai',
        'rejected': 'Ditolak'
    };
    return texts[status] || 'Unknown';
};

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    });
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
    
    // Fetch data
    fetchComplaints();
    fetchCategories();
});
</script>
