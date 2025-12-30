<template>
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo & Brand -->
                <router-link to="/" class="flex items-center gap-3 hover:opacity-80 transition">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-gray-900 hidden sm:block">Sistem Pengaduan Masyarakat</span>
                </router-link>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <router-link 
                        to="/" 
                        class="text-gray-700 hover:text-blue-600 font-medium transition"
                        active-class="text-blue-600"
                    >
                        Beranda
                    </router-link>
                    <router-link 
                        to="/about" 
                        class="text-gray-700 hover:text-blue-600 font-medium transition"
                        active-class="text-blue-600"
                    >
                        Tentang
                    </router-link>
                    <router-link 
                        to="/faq" 
                        class="text-gray-700 hover:text-blue-600 font-medium transition"
                        active-class="text-blue-600"
                    >
                        FAQ
                    </router-link>
                    <router-link 
                        to="/contact" 
                        class="text-gray-700 hover:text-blue-600 font-medium transition"
                        active-class="text-blue-600"
                    >
                        Hubungi
                    </router-link>
                </div>

                <!-- CTA Buttons -->
                <div class="flex items-center gap-3">
                    <router-link 
                        to="/complaint/form"
                        class="hidden sm:flex items-center gap-2 bg-blue-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-blue-700 transition shadow-sm"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Buat Pengaduan
                    </router-link>

                    <router-link 
                        to="/admin/login"
                        class="hidden sm:flex text-gray-600 hover:text-blue-600 font-medium transition"
                    >
                        Masuk
                    </router-link>

                    <!-- Mobile Menu Button -->
                    <button 
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition"
                    >
                        <svg v-if="!mobileMenuOpen" class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg v-else class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div 
            v-show="mobileMenuOpen"
            class="md:hidden border-t border-gray-200 bg-white"
        >
            <div class="px-4 py-3 space-y-3">
                <router-link 
                    to="/" 
                    @click="mobileMenuOpen = false"
                    class="block text-gray-700 hover:text-blue-600 font-medium py-2 transition"
                    active-class="text-blue-600"
                >
                    Beranda
                </router-link>
                <router-link 
                    to="/about" 
                    @click="mobileMenuOpen = false"
                    class="block text-gray-700 hover:text-blue-600 font-medium py-2 transition"
                    active-class="text-blue-600"
                >
                    Tentang
                </router-link>
                <router-link 
                    to="/faq" 
                    @click="mobileMenuOpen = false"
                    class="block text-gray-700 hover:text-blue-600 font-medium py-2 transition"
                    active-class="text-blue-600"
                >
                    FAQ
                </router-link>
                <router-link 
                    to="/contact" 
                    @click="mobileMenuOpen = false"
                    class="block text-gray-700 hover:text-blue-600 font-medium py-2 transition"
                    active-class="text-blue-600"
                >
                    Hubungi
                </router-link>
                
                <!-- Mobile CTA -->
                <div class="pt-3 border-t border-gray-200 space-y-2">
                    <router-link 
                        to="/complaint/form"
                        @click="mobileMenuOpen = false"
                        class="flex items-center justify-center gap-2 bg-blue-600 text-white px-4 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition w-full"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Buat Pengaduan
                    </router-link>
                    <router-link 
                        to="/admin/login"
                        @click="mobileMenuOpen = false"
                        class="block text-center text-gray-600 hover:text-blue-600 font-medium py-2 transition"
                    >
                        Masuk ke Admin
                    </router-link>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { ref } from 'vue';

const mobileMenuOpen = ref(false);
</script>
