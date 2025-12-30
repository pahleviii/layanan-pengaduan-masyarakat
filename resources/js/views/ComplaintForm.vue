<template>
    <div class="min-h-screen flex flex-col bg-gray-50">
        <Navbar />
        
        <main class="flex-grow py-12">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Buat Pengaduan Baru</h1>
                    <p class="text-gray-600">Sampaikan keluhan Anda dan kami akan memproses dengan cepat</p>
                </div>

                <!-- Form Card -->
                <div class="bg-white rounded-xl shadow-md p-8">
                    <form @submit.prevent="handleSubmit" class="space-y-6">
                        <!-- Nama Lengkap -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="name"
                                v-model="form.name"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Masukkan nama lengkap Anda"
                            >
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="email"
                                id="email"
                                v-model="form.email"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="nama@email.com"
                            >
                        </div>

                        <!-- Nomor Telepon -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Nomor Telepon <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="tel"
                                id="phone"
                                v-model="form.phone"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="08xxxxxxxxxx"
                            >
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                Kategori Pengaduan <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="category"
                                v-model="form.category_id"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            >
                                <option value="">Pilih kategori</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>

                        <!-- Judul -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Judul Pengaduan <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="title"
                                v-model="form.title"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Ringkasan singkat masalah Anda"
                            >
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Detail Pengaduan <span class="text-red-500">*</span>
                            </label>
                            <textarea
                                id="description"
                                v-model="form.description"
                                required
                                rows="5"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-none"
                                placeholder="Jelaskan masalah Anda secara detail..."
                            ></textarea>
                        </div>

                        <!-- Upload Foto -->
                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">
                                Foto Pendukung <span class="text-gray-500 text-xs">(Opsional, Maks. 2MB)</span>
                            </label>
                            <input
                                type="file"
                                id="photo"
                                @change="handleFileChange"
                                accept="image/*"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            >
                            
                            <!-- Photo Preview -->
                            <div v-if="photoPreview" class="mt-4">
                                <img :src="photoPreview" alt="Preview" class="rounded-lg max-h-64 object-cover">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end gap-4 pt-4">
                            <router-link
                                to="/"
                                class="px-6 py-3 text-gray-700 hover:text-gray-900 font-medium transition"
                            >
                                Batal
                            </router-link>
                            <button
                                type="submit"
                                :disabled="submitting"
                                class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2"
                            >
                                <svg v-if="submitting" class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>{{ submitting ? 'Mengirim...' : 'Kirim Pengaduan' }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <Footer />
    </div>
</template>

<script setup>
import { reactive, ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { useToast } from 'vue-toastification';
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';
import apiClient from '../api/axios';

const router = useRouter();
const toast = useToast();

const form = reactive({
    name: '',
    email: '',
    phone: '',
    category_id: '',
    title: '',
    description: '',
    photo: null
});

const categories = ref([]);
const photoPreview = ref(null);
const submitting = ref(false);

const fetchCategories = async () => {
    try {
        const response = await apiClient.get('/categories');
        if (response.data.success) {
            categories.value = response.data.data;
        }
    } catch (error) {
        console.error('Error fetching categories:', error);
        toast.error('Gagal memuat kategori');
    }
};

const handleFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        if (file.size > 2048000) {
            toast.warning('Ukuran foto maksimal 2MB');
            event.target.value = '';
            return;
        }
        form.photo = file;
        photoPreview.value = URL.createObjectURL(file);
    }
};

const handleSubmit = async () => {
    submitting.value = true;

    const formData = new FormData();
    formData.append('name', form.name);
    formData.append('email', form.email);
    formData.append('phone', form.phone);
    formData.append('category_id', form.category_id);
    formData.append('title', form.title);
    formData.append('description', form.description);
    if (form.photo) {
        formData.append('photo', form.photo);
    }

    try {
        const response = await apiClient.post('/complaints', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });

        if (response.data.success) {
            toast.success('Pengaduan berhasil dikirim! 🎉');
            
            setTimeout(() => {
                toast.info(`Nomor Tiket: ${response.data.data.ticket_number}`);
            }, 500);

            // Reset form
            form.name = '';
            form.email = '';
            form.phone = '';
            form.category_id = '';
            form.title = '';
            form.description = '';
            form.photo = null;
            photoPreview.value = null;

            // Redirect
            setTimeout(() => {
                router.push('/complaint/tracking');
            }, 2000);
        }
    } catch (error) {
        console.error('Error submitting complaint:', error);
        toast.error(error.response?.data?.message || 'Gagal mengirim pengaduan. Silakan coba lagi.');
    } finally {
        submitting.value = false;
    }
};

onMounted(() => {
    fetchCategories();
});
</script>
