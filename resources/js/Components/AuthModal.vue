<script setup>
import { ref } from 'vue';

const props = defineProps({
    isOpen: {
        type: Boolean,
        default: false
    }
});

const emit = defineEmits(['close']);

const activeTab = ref('login');
const loginForm = ref({
    email: '',
    password: '',
    remember: false
});

const signupForm = ref({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false
});

const handleLogin = () => {
    console.log('Login:', loginForm.value);
    // Handle login logic here
    alert('Login functionality - Connect to your backend');
};

const handleSignup = () => {
    console.log('Signup:', signupForm.value);
    // Handle signup logic here
    alert('Signup functionality - Connect to your backend');
};

const closeModal = () => {
    emit('close');
};
</script>

<template>
    <!-- Modal Overlay -->
    <transition
        enter-active-class="transition-opacity duration-300"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition-opacity duration-200"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div 
            v-if="isOpen"
            @click="closeModal"
            class="fixed inset-0 bg-navy-900/80 backdrop-blur-sm z-50 flex items-center justify-center p-4"
        >
            <!-- Modal Container -->
            <transition
                enter-active-class="transition-all duration-300 ease-out"
                enter-from-class="opacity-0 scale-95 translate-y-4"
                enter-to-class="opacity-100 scale-100 translate-y-0"
                leave-active-class="transition-all duration-200 ease-in"
                leave-from-class="opacity-100 scale-100 translate-y-0"
                leave-to-class="opacity-0 scale-95 translate-y-4"
            >
                <div 
                    v-if="isOpen"
                    @click.stop
                    class="relative w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden"
                >
                    <!-- Close Button -->
                    <button
                        @click="closeModal"
                        class="absolute top-4 right-4 z-10 p-2 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <!-- Header with Logo -->
                    <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-8 pt-8 pb-6">
                        <div class="flex items-center space-x-3 mb-4">
                            <svg class="w-10 h-10" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M38.5 28c2.5 0 4.5-2 4.5-4.5 0-2.2-1.6-4-3.7-4.4-.3-4.4-4-7.9-8.5-7.9-3.1 0-5.8 1.6-7.3 4.1-0.7-0.3-1.4-0.4-2.2-0.4-3.2 0-5.8 2.6-5.8 5.8 0 0.5 0.1 1 0.2 1.5C13.2 22.9 11.5 24.9 11.5 27.3c0 2.8 2.3 5.2 5.2 5.2h21.8z" 
                                      fill="white"/>
                            </svg>
                            <div>
                                <span class="text-2xl font-bold text-white">AzureSkill</span>
                                <p class="text-xs text-primary-100">Cloud Learning Platform</p>
                            </div>
                        </div>
                        
                        <!-- Tab Switcher -->
                        <div class="flex bg-white/20 backdrop-blur-lg rounded-xl p-1">
                            <button
                                @click="activeTab = 'login'"
                                class="flex-1 py-2.5 rounded-lg font-semibold text-sm transition-all duration-300"
                                :class="activeTab === 'login' 
                                    ? 'bg-white text-primary-700 shadow-lg' 
                                    : 'text-white hover:bg-white/10'"
                            >
                                Login
                            </button>
                            <button
                                @click="activeTab = 'signup'"
                                class="flex-1 py-2.5 rounded-lg font-semibold text-sm transition-all duration-300"
                                :class="activeTab === 'signup' 
                                    ? 'bg-white text-primary-700 shadow-lg' 
                                    : 'text-white hover:bg-white/10'"
                            >
                                Sign Up
                            </button>
                        </div>
                    </div>

                    <!-- Forms Container -->
                    <div class="p-8">
                        <!-- Login Form -->
                        <transition
                            enter-active-class="transition-all duration-300 ease-out"
                            enter-from-class="opacity-0 translate-x-4"
                            enter-to-class="opacity-100 translate-x-0"
                            leave-active-class="transition-all duration-200 ease-in"
                            leave-from-class="opacity-100 translate-x-0"
                            leave-to-class="opacity-0 -translate-x-4"
                            mode="out-in"
                        >
                            <form v-if="activeTab === 'login'" @submit.prevent="handleLogin" class="space-y-4">
                                <!-- Email -->
                                <div>
                                    <label class="block text-sm font-semibold text-navy-900 mb-2">Email Address</label>
                                    <input 
                                        v-model="loginForm.email"
                                        type="email" 
                                        required
                                        placeholder="you@example.com"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all"
                                    />
                                </div>

                                <!-- Password -->
                                <div>
                                    <label class="block text-sm font-semibold text-navy-900 mb-2">Password</label>
                                    <input 
                                        v-model="loginForm.password"
                                        type="password" 
                                        required
                                        placeholder="Enter your password"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all"
                                    />
                                </div>

                                <!-- Remember & Forgot -->
                                <div class="flex items-center justify-between">
                                    <label class="flex items-center">
                                        <input 
                                            v-model="loginForm.remember"
                                            type="checkbox" 
                                            class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                                        />
                                        <span class="ml-2 text-sm text-navy-700">Remember me</span>
                                    </label>
                                    <a href="#" class="text-sm font-semibold text-primary-600 hover:text-primary-700">
                                        Forgot password?
                                    </a>
                                </div>

                                <!-- Submit Button -->
                                <button 
                                    type="submit"
                                    class="w-full px-6 py-3.5 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-500 hover:to-primary-600 text-white font-semibold rounded-xl transition-all duration-300 hover:scale-105 shadow-lg"
                                >
                                    Login to Your Account
                                </button>

                                <!-- Social Login -->
                                <div class="relative my-6">
                                    <div class="absolute inset-0 flex items-center">
                                        <div class="w-full border-t border-gray-300"></div>
                                    </div>
                                    <div class="relative flex justify-center text-sm">
                                        <span class="px-4 bg-white text-gray-500">Or continue with</span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <button type="button" class="flex items-center justify-center px-4 py-2.5 border-2 border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                        </svg>
                                        <span class="ml-2 text-sm font-medium text-gray-700">Google</span>
                                    </button>
                                    <button type="button" class="flex items-center justify-center px-4 py-2.5 border-2 border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                                        </svg>
                                        <span class="ml-2 text-sm font-medium text-gray-700">GitHub</span>
                                    </button>
                                </div>
                            </form>

                            <!-- Signup Form -->
                            <form v-else @submit.prevent="handleSignup" class="space-y-4">
                                <!-- Name -->
                                <div>
                                    <label class="block text-sm font-semibold text-navy-900 mb-2">Full Name</label>
                                    <input 
                                        v-model="signupForm.name"
                                        type="text" 
                                        required
                                        placeholder="John Doe"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all"
                                    />
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block text-sm font-semibold text-navy-900 mb-2">Email Address</label>
                                    <input 
                                        v-model="signupForm.email"
                                        type="email" 
                                        required
                                        placeholder="you@example.com"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all"
                                    />
                                </div>

                                <!-- Password -->
                                <div>
                                    <label class="block text-sm font-semibold text-navy-900 mb-2">Password</label>
                                    <input 
                                        v-model="signupForm.password"
                                        type="password" 
                                        required
                                        placeholder="Create a strong password"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all"
                                    />
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label class="block text-sm font-semibold text-navy-900 mb-2">Confirm Password</label>
                                    <input 
                                        v-model="signupForm.password_confirmation"
                                        type="password" 
                                        required
                                        placeholder="Confirm your password"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all"
                                    />
                                </div>

                                <!-- Terms -->
                                <div>
                                    <label class="flex items-start">
                                        <input 
                                            v-model="signupForm.terms"
                                            type="checkbox" 
                                            required
                                            class="w-4 h-4 mt-1 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                                        />
                                        <span class="ml-2 text-sm text-navy-700">
                                            I agree to the 
                                            <a href="#" class="text-primary-600 hover:text-primary-700 font-semibold">Terms of Service</a> 
                                            and 
                                            <a href="#" class="text-primary-600 hover:text-primary-700 font-semibold">Privacy Policy</a>
                                        </span>
                                    </label>
                                </div>

                                <!-- Submit Button -->
                                <button 
                                    type="submit"
                                    class="w-full px-6 py-3.5 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-500 hover:to-primary-600 text-white font-semibold rounded-xl transition-all duration-300 hover:scale-105 shadow-lg"
                                >
                                    Create Your Account
                                </button>

                                <!-- Social Login -->
                                <div class="relative my-6">
                                    <div class="absolute inset-0 flex items-center">
                                        <div class="w-full border-t border-gray-300"></div>
                                    </div>
                                    <div class="relative flex justify-center text-sm">
                                        <span class="px-4 bg-white text-gray-500">Or sign up with</span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <button type="button" class="flex items-center justify-center px-4 py-2.5 border-2 border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                        </svg>
                                        <span class="ml-2 text-sm font-medium text-gray-700">Google</span>
                                    </button>
                                    <button type="button" class="flex items-center justify-center px-4 py-2.5 border-2 border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                                        </svg>
                                        <span class="ml-2 text-sm font-medium text-gray-700">GitHub</span>
                                    </button>
                                </div>
                            </form>
                        </transition>
                    </div>
                </div>
            </transition>
        </div>
    </transition>
</template>
