<template>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-blue-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <!-- Card -->
            <div class="bg-white rounded-2xl shadow-2xl p-8">
                <!-- Logo/Icon -->
                <div class="flex justify-center mb-6">
                    <div class="w-16 h-16 bg-blue-600 rounded-xl flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Title -->
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Login Administrator</h2>
                    <p class="text-gray-600">Sistem Pengaduan Masyarakat</p>
                </div>

                <!-- Error Message -->
                <div v-if="errorMessage" class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <p class="text-sm">{{ errorMessage }}</p>
                </div>

                <!-- Form -->
                <form @submit.prevent="handleLogin">
                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <input 
                                v-model="form.email"
                                type="email" 
                                placeholder="admin@example.com"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required
                            >
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input 
                                v-model="form.password"
                                :type="showPassword ? 'text' : 'password'" 
                                placeholder="••••••••"
                                class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required
                            >
                            <button 
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center"
                            >
                                <svg v-if="!showPassword" class="w-5 h-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <svg v-else class="w-5 h-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center mb-6">
                        <input 
                            v-model="form.remember"
                            type="checkbox" 
                            id="remember"
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                        >
                        <label for="remember" class="ml-2 text-sm text-gray-700">Ingat Saya</label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit"
                        :disabled="loading"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition disabled:bg-gray-400 disabled:cursor-not-allowed flex items-center justify-center"
                    >
                        <svg v-if="loading" class="animate-spin h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span v-if="!loading">Masuk →</span>
                        <span v-else>Loading...</span>
                    </button>
                </form>

                <!-- Back to Home -->
                <div class="mt-6 text-center">
                    <router-link to="/" class="text-sm text-gray-600 hover:text-blue-600">
                        ← Kembali ke Beranda
                    </router-link>
                </div>
            </div>

            <!-- Footer -->
            <p class="text-center text-gray-600 text-sm mt-8">Sistem Pengaduan Masyarakat © 2025</p>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import { useRouter } from 'vue-router';
import { useToast } from 'vue-toastification';
import apiClient from '../../api/axios';

const router = useRouter();
const toast = useToast();

const form = reactive({
    email: '',
    password: '',
    remember: false
});

const showPassword = ref(false);
const loading = ref(false);
const errorMessage = ref('');

const handleLogin = async () => {
    loading.value = true;
    errorMessage.value = '';

    try {
        const response = await apiClient.post('/login', {
            email: form.email,
            password: form.password
        });

        if (response.data.success) {
            // Save token to localStorage
            localStorage.setItem('token', response.data.data.token);
            localStorage.setItem('user', JSON.stringify(response.data.data.user));

            // Set axios default header
            apiClient.defaults.headers.common['Authorization'] = `Bearer ${response.data.data.token}`;

            // Success toast
            toast.success(`Selamat datang, ${response.data.data.user.name}! 👋`);

            // Redirect to admin dashboard
            setTimeout(() => {
                router.push('/admin/dashboard');
            }, 500);
        }
    } catch (error) {
        console.error('Login error:', error);
        const message = error.response?.data?.message || 'Terjadi kesalahan saat login';
        errorMessage.value = message;
        toast.error(message);
    } finally {
        loading.value = false;
    }
};
</script>
