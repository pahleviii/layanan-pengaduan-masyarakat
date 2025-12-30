<template>
    <div class="min-h-screen flex flex-col bg-gray-50">
        <Navbar />
        
        <main class="flex-grow py-12">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">Lacak Status Pengaduan</h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Pantau perkembangan laporan Anda dengan memasukkan nomor tiket pengaduan yang Anda terima.
                    </p>
                </div>

                <!-- Search Box -->
                <div class="max-w-2xl mx-auto mb-12">
                    <form @submit.prevent="searchComplaint" class="flex gap-3">
                        <div class="flex-1 relative">
                            <input 
                                v-model="ticketNumber"
                                type="text" 
                                placeholder="Masukkan Nomor Tiket (Contoh: TKT-2023-001)"
                                class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-lg"
                            >
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <button 
                            type="submit"
                            class="px-8 py-4 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 transition"
                        >
                            Lacak
                        </button>
                    </form>
                </div>

                <!-- Empty State -->
                <div v-if="!searched" class="text-center py-16">
                    <svg class="w-32 h-32 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Masukkan nomor tiket untuk melacak pengaduan Anda</h3>
                    <p class="text-gray-600">Nomor tiket dikirimkan saat Anda membuat pengaduan.</p>
                </div>

                <!-- Complaint Detail (After Search) -->
                <div v-if="searched && complaint" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Left Column: Main Content -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Ticket Header -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Nomor Tiket</p>
                                    <h2 class="text-2xl font-bold text-blue-600">{{ complaint.ticket }}</h2>
                                    <p class="text-sm text-gray-500 mt-1">Terakhir diperbarui: {{ complaint.updated_at }}</p>
                                </div>
                                <span :class="getStatusClass(complaint.status)" class="px-4 py-2 rounded-full text-sm font-semibold">
                                    {{ getStatusText(complaint.status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Lampiran Foto -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Lampiran Foto</h3>
                            <img :src="complaint.photo" :alt="complaint.title" class="w-full h-96 object-cover rounded-lg mb-3">
                            <button class="text-blue-600 hover:text-blue-700 flex items-center text-sm font-medium">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                Lihat Lokasi di Peta
                            </button>
                        </div>

                        <!-- Detail Laporan -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Detail Laporan
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">KATEGORI</p>
                                    <div class="flex items-center">
                                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                                            {{ complaint.category }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">TANGGAL DIBUAT</p>
                                    <p class="font-medium text-gray-900">{{ complaint.created_at }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">JUDUL LAPORAN</p>
                                    <p class="font-semibold text-gray-900 text-lg">{{ complaint.title }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">DESKRIPSI LENGKAP</p>
                                    <p class="text-gray-700 leading-relaxed">{{ complaint.description }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">LOKASI</p>
                                    <p class="text-gray-700">{{ complaint.location }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Admin Response -->
                        <div v-if="complaint.admin_note" class="bg-blue-50 border-l-4 border-blue-600 rounded-lg p-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3 flex-1">
                                    <h3 class="text-sm font-semibold text-blue-900 mb-1">Tanggapan Admin</h3>
                                    <p class="text-sm text-gray-600 mb-2">{{ complaint.admin_note_date }}</p>
                                    <p class="text-gray-800 italic">"{{ complaint.admin_note }}"</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Sidebar -->
                    <div class="space-y-6">
                        <!-- Riwayat Status -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-6">Riwayat Status</h3>
                            
                            <div class="space-y-6">
                                <div v-for="(status, index) in complaint.timeline" :key="index" class="relative">
                                    <!-- Timeline dot -->
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <div :class="status.completed ? 'bg-blue-600' : 'bg-gray-300'" 
                                                 class="w-10 h-10 rounded-full flex items-center justify-center">
                                                <svg v-if="status.completed" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                <div v-else class="w-3 h-3 bg-white rounded-full"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="ml-4 flex-1">
                                            <p :class="status.completed ? 'text-gray-900 font-semibold' : 'text-gray-500'" 
                                               class="text-sm">
                                                {{ status.label }}
                                            </p>
                                            <p class="text-xs text-gray-500 mt-1">{{ status.date }}</p>
                                            <p v-if="status.note" class="text-xs text-gray-600 mt-1">{{ status.note }}</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Timeline line -->
                                    <div v-if="index < complaint.timeline.length - 1" 
                                         :class="status.completed ? 'bg-blue-600' : 'bg-gray-300'"
                                         class="absolute left-5 top-10 w-0.5 h-8">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Estimasi -->
                        <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl shadow-md p-6 text-white">
                            <div class="flex items-start mb-3">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <h3 class="font-bold mb-2">Estimasi Pengerjaan</h3>
                                    <p class="text-sm text-blue-100">Berdasarkan kategori laporan, estimasi penyelesaian adalah <strong>3-5 hari kerja</strong>.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Download/Print -->
                        <button class="w-full px-4 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                            </svg>
                            Cetak / Download PDF
                        </button>
                    </div>
                </div>

                <!-- Not Found -->
                <div v-if="searched && !complaint" class="text-center py-16">
                    <svg class="w-24 h-24 mx-auto text-red-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Pengaduan Tidak Ditemukan</h3>
                    <p class="text-gray-600 mb-4">Nomor tiket yang Anda masukkan tidak valid atau tidak ditemukan di sistem.</p>
                    <button @click="resetSearch" class="text-blue-600 hover:text-blue-700 font-semibold">
                        ← Coba Lagi
                    </button>
                </div>
            </div>
        </main>

        <Footer />
    </div>
</template>

<script setup>
import { ref } from 'vue';
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';
import apiClient from '../api/axios';

const ticketNumber = ref('');
const searched = ref(false);
const complaint = ref(null);
const loading = ref(false);

// Search complaint by ticket number
const searchComplaint = async () => {
    if (!ticketNumber.value) {
        alert('Masukkan nomor tiket terlebih dahulu');
        return;
    }

    loading.value = true;
    searched.value = true;
    complaint.value = null;
    
    try {
        const response = await apiClient.get(`/complaints/ticket/${ticketNumber.value}`);
        
        if (response.data.success) {
            const data = response.data.data;
            
            // Transform data untuk UI
            complaint.value = {
                ticket: data.ticket_number,
                status: data.status,
                title: data.title,
                category: data.category.name,
                description: data.description,
                location: 'Lokasi akan ditampilkan di sini',
                photo: data.photo ? `http://127.0.0.1:8000/${data.photo}` : 'https://via.placeholder.com/800x500?text=No+Image',
                created_at: new Date(data.created_at).toLocaleDateString('id-ID', { 
                    day: 'numeric', 
                    month: 'long', 
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                }),
                updated_at: new Date(data.updated_at).toLocaleDateString('id-ID', { 
                    day: 'numeric', 
                    month: 'long', 
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                }),
                admin_note: data.admin_note,
                admin_note_date: data.admin_note ? new Date(data.updated_at).toLocaleDateString('id-ID') : null,
                timeline: generateTimeline(data)
            };
        }
    } catch (error) {
        console.error('Error fetching complaint:', error);
        complaint.value = null;
    } finally {
        loading.value = false;
    }
};

// Generate timeline based on status
const generateTimeline = (data) => {
    const timeline = [
        {
            label: 'Laporan Diterima',
            date: new Date(data.created_at).toLocaleDateString('id-ID', { 
                day: 'numeric', 
                month: 'long', 
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            }),
            note: 'Laporan Anda telah berhasil masuk ke sistem kami.',
            completed: true
        }
    ];

    if (data.status === 'in_progress' || data.status === 'resolved') {
        timeline.push({
            label: 'Sedang Diproses',
            date: new Date(data.updated_at).toLocaleDateString('id-ID', { 
                day: 'numeric', 
                month: 'long', 
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            }),
            note: 'Laporan sedang ditindaklanjuti oleh pihak terkait.',
            completed: true
        });
    }

    if (data.status === 'resolved') {
        timeline.push({
            label: 'Selesai',
            date: new Date(data.updated_at).toLocaleDateString('id-ID', { 
                day: 'numeric', 
                month: 'long', 
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            }),
            note: 'Pengaduan telah diselesaikan.',
            completed: true
        });
    } else {
        timeline.push({
            label: data.status === 'in_progress' ? 'Dalam Proses' : 'Menunggu',
            date: 'Menunggu penyelesaian',
            completed: false
        });
    }

    return timeline;
};

const resetSearch = () => {
    searched.value = false;
    complaint.value = null;
    ticketNumber.value = '';
};

const getStatusClass = (status) => {
    const classes = {
        'pending': 'bg-yellow-100 text-yellow-700',
        'in_progress': 'bg-blue-100 text-blue-700',
        'resolved': 'bg-green-100 text-green-700',
        'rejected': 'bg-red-100 text-red-700'
    };
    return classes[status] || 'bg-gray-100 text-gray-700';
};

const getStatusText = (status) => {
    const texts = {
        'pending': 'Pending',
        'in_progress': 'Sedang Diproses',
        'resolved': 'Selesai',
        'rejected': 'Ditolak'
    };
    return texts[status] || 'Unknown';
};
</script>
