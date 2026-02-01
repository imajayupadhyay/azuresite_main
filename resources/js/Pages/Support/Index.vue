<script setup>
import { ref, reactive, onMounted } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';

const isHeroVisible = ref(false);
const showSuccessModal = ref(false);
const isSubmitting = ref(false);

const formData = reactive({
    name: '',
    email: '',
    category: '',
    subject: '',
    message: ''
});

onMounted(() => {
    setTimeout(() => isHeroVisible.value = true, 100);
});

const submitForm = () => {
    isSubmitting.value = true;

    router.post(route('support.store'), formData, {
        preserveScroll: true,
        onSuccess: (page) => {
            // Reset form
            formData.name = '';
            formData.email = '';
            formData.category = '';
            formData.subject = '';
            formData.message = '';
            
            // Show success modal
            setTimeout(() => {
                showSuccessModal.value = true;
            }, 100);
        },
        onFinish: () => {
            isSubmitting.value = false;
        }
    });
};

const closeModal = () => {
    showSuccessModal.value = false;
};

const quickLinks = [
    { title: 'Tutorials', description: 'Browse learning resources', icon: 'book', href: '/tutorials' },
    { title: 'Certifications', description: 'Exam preparation guides', icon: 'badge', href: '/certifications' },
    { title: 'Live Training', description: 'Join expert sessions', icon: 'video', href: '/live-training' }
];

const faqs = [
    { q: 'How do I access Azure tutorials?', a: 'Navigate to the Tutorials page from the menu. All tutorials are free with step-by-step instructions.' },
    { q: 'Do I need an Azure account?', a: 'You can browse tutorials without an account, but need an Azure subscription for hands-on practice.' },
    { q: 'Are tutorials updated regularly?', a: 'Yes! We continuously update content to reflect the latest Azure features. New tutorials added weekly.' },
    { q: 'How can I get personalized support?', a: 'Fill out the contact form or email support@azureskill.com. We respond within 24 hours.' }
];
</script>

<template>
    <div class="min-h-screen bg-navy-50">
        <Head>
            <title>Support - Get Help | AzureSkill</title>
            <meta name="description" content="Get help with Azure tutorials, certifications, and technical issues. Contact our support team." />
        </Head>

        <Header />

        <!-- Hero Section -->
        <section class="relative pt-32 pb-20 overflow-hidden bg-gradient-to-br from-navy-950 via-primary-900 to-navy-900">
            <!-- Grid Background -->
            <div class="absolute inset-0">
                <svg class="absolute w-full h-full opacity-20" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="support-grid" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#support-grid)" />
                </svg>
            </div>

            <!-- Orbs -->
            <div class="absolute top-10 left-10 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-10 right-10 w-80 h-80 bg-primary-500/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

            <div class="relative w-full px-6 lg:px-12 xl:px-20">
                <div
                    class="text-center transition-all duration-700"
                    :class="isHeroVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                >
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-6">
                        <svg class="w-4 h-4 text-green-400 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        <span class="text-sm text-primary-100">We typically respond within 24 hours</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-4">
                        How can we
                        <span class="bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">help</span>?
                    </h1>
                    <p class="text-lg text-primary-200/80 max-w-xl mx-auto">
                        Get in touch with our team or explore our resources
                    </p>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <div class="w-full px-6 lg:px-12 xl:px-20 py-16">
            <div class="max-w-6xl mx-auto">
                <!-- Quick Links -->
                <div class="grid md:grid-cols-3 gap-6 mb-16">
                    <a
                        v-for="link in quickLinks"
                        :key="link.title"
                        :href="link.href"
                        class="group bg-white rounded-2xl p-6 border border-navy-100 hover:border-primary-300 hover:shadow-xl hover:-translate-y-1 transition-all duration-300"
                    >
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <svg v-if="link.icon === 'book'" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <svg v-else-if="link.icon === 'badge'" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                            <svg v-else class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-navy-900 mb-1 group-hover:text-primary-600 transition-colors">{{ link.title }}</h3>
                        <p class="text-sm text-navy-500">{{ link.description }}</p>
                    </a>
                </div>

                <!-- Modern Contact Form Container -->
                <div class="relative">
                    <!-- Decorative Background Elements -->
                    <div class="absolute -top-10 -left-10 w-40 h-40 bg-primary-500/10 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-10 -right-10 w-60 h-60 bg-blue-500/10 rounded-full blur-3xl"></div>

                    <!-- Main Form Card -->
                    <div class="relative bg-white rounded-3xl shadow-2xl shadow-navy-200/50 overflow-hidden border border-navy-100">
                        <div class="grid lg:grid-cols-5">
                            <!-- Left Side - Form -->
                            <div class="lg:col-span-3 p-8 lg:p-12">
                                <div class="mb-8">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-primary-50 text-primary-600 text-xs font-semibold mb-4">
                                        <span class="w-2 h-2 bg-primary-500 rounded-full mr-2 animate-pulse"></span>
                                        Get in Touch
                                    </span>
                                    <h2 class="text-3xl font-bold text-navy-900 mb-2">Send us a message</h2>
                                    <p class="text-navy-500">We'd love to hear from you. Fill out the form below.</p>
                                </div>

                                <form @submit.prevent="submitForm" class="space-y-6">
                                    <div class="grid sm:grid-cols-2 gap-6">
                                        <!-- Name Field -->
                                        <div class="group">
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                    <svg class="w-5 h-5 text-navy-300 group-focus-within:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                </div>
                                                <input
                                                    v-model="formData.name"
                                                    type="text"
                                                    required
                                                    placeholder="Your name"
                                                    class="w-full pl-12 pr-4 py-4 bg-navy-50/50 border-2 border-transparent rounded-2xl text-navy-900 placeholder-navy-400 focus:bg-white focus:border-primary-500 focus:shadow-lg focus:shadow-primary-500/10 outline-none transition-all duration-300"
                                                />
                                            </div>
                                        </div>

                                        <!-- Email Field -->
                                        <div class="group">
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                    <svg class="w-5 h-5 text-navy-300 group-focus-within:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                                <input
                                                    v-model="formData.email"
                                                    type="email"
                                                    required
                                                    placeholder="you@example.com"
                                                    class="w-full pl-12 pr-4 py-4 bg-navy-50/50 border-2 border-transparent rounded-2xl text-navy-900 placeholder-navy-400 focus:bg-white focus:border-primary-500 focus:shadow-lg focus:shadow-primary-500/10 outline-none transition-all duration-300"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Category Field -->
                                    <div class="group">
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg class="w-5 h-5 text-navy-300 group-focus-within:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                                </svg>
                                            </div>
                                            <select
                                                v-model="formData.category"
                                                required
                                                class="w-full pl-12 pr-4 py-4 bg-navy-50/50 border-2 border-transparent rounded-2xl text-navy-900 focus:bg-white focus:border-primary-500 focus:shadow-lg focus:shadow-primary-500/10 outline-none transition-all duration-300 appearance-none cursor-pointer"
                                            >
                                                <option value="">Select a category</option>
                                                <option value="technical">Technical Support</option>
                                                <option value="account">Account & Billing</option>
                                                <option value="tutorials">Tutorial Help</option>
                                                <option value="certification">Certifications</option>
                                                <option value="labs">Hands-on Labs</option>
                                                <option value="feedback">Feedback & Suggestions</option>
                                            </select>
                                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                                <svg class="w-5 h-5 text-navy-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Subject Field -->
                                    <div class="group">
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg class="w-5 h-5 text-navy-300 group-focus-within:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                                </svg>
                                            </div>
                                            <input
                                                v-model="formData.subject"
                                                type="text"
                                                required
                                                placeholder="Brief subject of your inquiry"
                                                class="w-full pl-12 pr-4 py-4 bg-navy-50/50 border-2 border-transparent rounded-2xl text-navy-900 placeholder-navy-400 focus:bg-white focus:border-primary-500 focus:shadow-lg focus:shadow-primary-500/10 outline-none transition-all duration-300"
                                            />
                                        </div>
                                    </div>

                                    <!-- Message Field -->
                                    <div class="group">
                                        <div class="relative">
                                            <div class="absolute top-4 left-0 pl-4 pointer-events-none">
                                                <svg class="w-5 h-5 text-navy-300 group-focus-within:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                                </svg>
                                            </div>
                                            <textarea
                                                v-model="formData.message"
                                                required
                                                rows="4"
                                                placeholder="How can we help you?"
                                                class="w-full pl-12 pr-4 py-4 bg-navy-50/50 border-2 border-transparent rounded-2xl text-navy-900 placeholder-navy-400 focus:bg-white focus:border-primary-500 focus:shadow-lg focus:shadow-primary-500/10 outline-none transition-all duration-300 resize-none"
                                            ></textarea>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <button
                                        type="submit"
                                        :disabled="isSubmitting"
                                        class="group relative w-full px-8 py-4 bg-gradient-to-r from-primary-600 to-blue-600 text-white font-semibold rounded-2xl transition-all duration-300 hover:shadow-xl hover:shadow-primary-500/30 disabled:opacity-70 disabled:cursor-not-allowed overflow-hidden"
                                    >
                                        <span class="relative z-10 flex items-center justify-center">
                                            <svg v-if="isSubmitting" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            <span>{{ isSubmitting ? 'Sending...' : 'Send Message' }}</span>
                                            <svg v-if="!isSubmitting" class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                            </svg>
                                        </span>
                                        <div class="absolute inset-0 bg-gradient-to-r from-primary-500 to-blue-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    </button>
                                </form>
                            </div>

                            <!-- Right Side - Contact Info & Visual -->
                            <div class="lg:col-span-2 bg-gradient-to-br from-navy-900 via-primary-900 to-navy-950 p-8 lg:p-12 text-white relative overflow-hidden">
                                <!-- Background Pattern -->
                                <div class="absolute inset-0 opacity-10">
                                    <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                                        <defs>
                                            <pattern id="contact-dots" width="20" height="20" patternUnits="userSpaceOnUse">
                                                <circle cx="2" cy="2" r="1" fill="white"/>
                                            </pattern>
                                        </defs>
                                        <rect width="100%" height="100%" fill="url(#contact-dots)" />
                                    </svg>
                                </div>

                                <!-- Floating Orb -->
                                <div class="absolute top-1/2 right-0 w-40 h-40 bg-primary-500/30 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>

                                <div class="relative z-10 h-full flex flex-col">
                                    <div class="mb-8">
                                        <h3 class="text-xl font-bold mb-2">Contact Information</h3>
                                        <p class="text-primary-200 text-sm">We typically respond within 24 hours</p>
                                    </div>

                                    <div class="space-y-6 flex-grow">
                                        <a href="mailto:support@azureskill.com" class="flex items-center group">
                                            <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center mr-4 group-hover:bg-white/20 transition-colors">
                                                <svg class="w-5 h-5 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-xs text-primary-300 mb-0.5">Email</p>
                                                <p class="font-medium group-hover:text-primary-300 transition-colors">support@azureskill.com</p>
                                            </div>
                                        </a>

                                        <a href="#" class="flex items-center group">
                                            <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center mr-4 group-hover:bg-white/20 transition-colors">
                                                <svg class="w-5 h-5 text-primary-300" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-xs text-primary-300 mb-0.5">Twitter</p>
                                                <p class="font-medium group-hover:text-primary-300 transition-colors">@AzureSkill</p>
                                            </div>
                                        </a>

                                        <div class="flex items-center">
                                            <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center mr-4">
                                                <svg class="w-5 h-5 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-xs text-primary-300 mb-0.5">Response Time</p>
                                                <p class="font-medium">Within 24 hours</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Decorative Icon -->
                                    <div class="mt-auto pt-8">
                                        <div class="flex items-center justify-center opacity-20">
                                            <svg class="w-32 h-32" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ Section Below -->
                <div class="mt-16">
                    <div class="text-center mb-10">
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-navy-100 text-navy-600 text-xs font-semibold mb-4">
                            FAQ
                        </span>
                        <h2 class="text-3xl font-bold text-navy-900 mb-2">Frequently Asked Questions</h2>
                        <p class="text-navy-500">Quick answers to common questions</p>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div
                            v-for="(faq, index) in faqs"
                            :key="index"
                            class="group bg-white rounded-2xl p-6 border border-navy-100 hover:border-primary-200 hover:shadow-xl hover:shadow-navy-100/50 transition-all duration-300"
                        >
                            <div class="flex items-start">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-blue-500 flex items-center justify-center mr-4 flex-shrink-0 group-hover:scale-110 transition-transform">
                                    <span class="text-white font-bold text-sm">{{ index + 1 }}</span>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-navy-900 mb-2 group-hover:text-primary-600 transition-colors">{{ faq.q }}</h3>
                                    <p class="text-navy-600 text-sm leading-relaxed">{{ faq.a }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Modal -->
        <Teleport to="body">
            <transition
                enter-active-class="transition-all duration-300 ease-out"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="transition-all duration-200 ease-in"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div v-if="showSuccessModal" class="fixed inset-0 z-50 flex items-center justify-center p-4">
                    <!-- Backdrop -->
                    <div class="absolute inset-0 bg-navy-950/60 backdrop-blur-sm" @click="closeModal"></div>

                    <!-- Modal -->
                    <transition
                        enter-active-class="transition-all duration-300 ease-out delay-100"
                        enter-from-class="opacity-0 scale-95 translate-y-4"
                        enter-to-class="opacity-100 scale-100 translate-y-0"
                        leave-active-class="transition-all duration-200 ease-in"
                        leave-from-class="opacity-100 scale-100"
                        leave-to-class="opacity-0 scale-95"
                    >
                        <div v-if="showSuccessModal" class="relative bg-white rounded-3xl p-8 max-w-md w-full shadow-2xl">
                            <!-- Close Button -->
                            <button
                                @click="closeModal"
                                class="absolute top-4 right-4 text-navy-400 hover:text-navy-600 transition-colors"
                            >
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>

                            <!-- Content -->
                            <div class="text-center">
                                <!-- Success Icon -->
                                <div class="w-20 h-20 mx-auto mb-6 relative">
                                    <div class="absolute inset-0 bg-green-100 rounded-full animate-ping opacity-25"></div>
                                    <div class="relative w-20 h-20 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center shadow-lg shadow-green-500/30">
                                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                </div>

                                <h3 class="text-2xl font-bold text-navy-900 mb-2">Message Sent!</h3>
                                <p class="text-navy-600 mb-6">
                                    Thank you for reaching out. Our team will get back to you within 24 hours.
                                </p>

                                <!-- Divider -->
                                <div class="border-t border-navy-100 pt-6 mb-6">
                                    <p class="text-sm text-navy-500">
                                        In the meantime, explore our resources:
                                    </p>
                                </div>

                                <!-- Quick Actions -->
                                <div class="flex gap-3">
                                    <a
                                        href="/tutorials"
                                        class="flex-1 px-4 py-3 bg-navy-100 hover:bg-navy-200 text-navy-700 font-medium rounded-xl transition-colors text-sm"
                                    >
                                        Browse Tutorials
                                    </a>
                                    <button
                                        @click="closeModal"
                                        class="flex-1 px-4 py-3 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-500 hover:to-primary-600 text-white font-medium rounded-xl transition-all text-sm"
                                    >
                                        Done
                                    </button>
                                </div>
                            </div>
                        </div>
                    </transition>
                </div>
            </transition>
        </Teleport>

        <Footer />
    </div>
</template>
