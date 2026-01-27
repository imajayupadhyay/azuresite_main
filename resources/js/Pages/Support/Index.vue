<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import SupportCategories from './Components/SupportCategories.vue';
import ContactForm from './Components/ContactForm.vue';

const selectedCategory = ref(null);
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-primary-50/30">
        <Head>
            <title>Support & Help Center - Azure Learning Support | AzureSkill</title>
            <meta name="description" content="Get help with Azure tutorials, certifications, and technical issues. Browse our knowledge base, contact support, and find answers to frequently asked questions." />
            <meta name="keywords" content="Azure support, Azure help, technical support, FAQ, contact support, help center, Azure assistance" />
        </Head>
        
        <Header />
        
        <!-- Hero Section -->
        <div class="relative pt-24 pb-12 bg-white overflow-hidden">
            <!-- Background Elements -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <!-- Subtle Gradient Orbs -->
                <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-gradient-to-br from-primary-100/40 to-primary-200/20 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-gradient-to-tr from-primary-50/60 to-navy-100/30 rounded-full blur-3xl"></div>
                
                <!-- Dotted Pattern -->
                <svg class="absolute inset-0 w-full h-full opacity-[0.03]" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="support-dots" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
                            <circle cx="2" cy="2" r="1" fill="#1e293b"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#support-dots)"/>
                </svg>

                <!-- Geometric Shapes -->
                <svg class="absolute top-32 right-[15%] w-24 h-24 opacity-[0.04]" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="40" stroke="#0078d4" stroke-width="1" fill="none"/>
                    <circle cx="50" cy="50" r="30" stroke="#0078d4" stroke-width="1" fill="none"/>
                </svg>

                <!-- Cloud SVG -->
                <svg class="absolute top-40 left-[10%] w-16 h-16 text-primary-200/20" viewBox="0 0 200 200">
                    <path d="M140 110c15 0 27-12 27-27 0-13-9-24-22-26-2-26-24-47-50-47-18 0-35 10-43 25-4-2-8-2-13-2-19 0-35 15-35 35 0 3 1 6 1 9C8 79 1 91 1 104c0 17 14 31 31 31h108z" fill="currentColor"/>
                </svg>

                <!-- Floating Elements -->
                <div class="absolute top-48 right-[25%] w-12 h-12 bg-gradient-to-br from-primary-100/50 to-primary-200/30 rounded-xl border border-primary-200/40 animate-float-1 rotate-12"></div>
                <div class="absolute bottom-32 left-[20%] w-10 h-10 bg-gradient-to-br from-navy-100/50 to-navy-200/30 rounded-lg border border-navy-200/40 animate-float-2 -rotate-6"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center">
                <!-- Badge -->
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-primary-50 to-primary-100 border border-primary-200 mb-6">
                    <svg class="w-4 h-4 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span class="text-sm font-semibold text-primary-700">We're here to help</span>
                </div>

                <h1 class="text-4xl sm:text-5xl font-bold text-navy-900 mb-4">How can we help you?</h1>
                <p class="text-xl text-navy-600 mb-8">Search our knowledge base or get in touch with our support team</p>
                
                <!-- Search Bar -->
                <div class="max-w-2xl mx-auto">
                    <div class="relative">
                        <input 
                            type="text" 
                            placeholder="Search for help articles, tutorials, FAQs..." 
                            class="w-full pl-12 pr-4 py-4 text-lg border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-200 outline-none transition-all shadow-lg"
                        />
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
            <!-- Support Categories -->
            <SupportCategories @category-select="selectedCategory = $event" />

            <!-- Contact Form Section -->
            <ContactForm />

            <!-- FAQ Section -->
            <div class="mt-16">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold text-navy-900 mb-3">Frequently Asked Questions</h2>
                    <p class="text-lg text-navy-600">Quick answers to common questions</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- FAQ Item -->
                    <div class="bg-white rounded-2xl border-2 border-gray-200 p-6 hover:border-primary-300 hover:shadow-lg transition-all duration-300">
                        <h3 class="text-lg font-bold text-navy-900 mb-3 flex items-start">
                            <svg class="w-6 h-6 text-primary-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            How do I access Azure tutorials?
                        </h3>
                        <p class="text-navy-600 ml-9">
                            Simply navigate to the Tutorials page from the menu. Browse by category and click on any tutorial to start learning. All tutorials are free and include step-by-step instructions.
                        </p>
                    </div>

                    <div class="bg-white rounded-2xl border-2 border-gray-200 p-6 hover:border-primary-300 hover:shadow-lg transition-all duration-300">
                        <h3 class="text-lg font-bold text-navy-900 mb-3 flex items-start">
                            <svg class="w-6 h-6 text-primary-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Do I need an Azure account?
                        </h3>
                        <p class="text-navy-600 ml-9">
                            While you can browse and learn from our tutorials without an account, you'll need an active Azure subscription to practice hands-on with real Azure services.
                        </p>
                    </div>

                    <div class="bg-white rounded-2xl border-2 border-gray-200 p-6 hover:border-primary-300 hover:shadow-lg transition-all duration-300">
                        <h3 class="text-lg font-bold text-navy-900 mb-3 flex items-start">
                            <svg class="w-6 h-6 text-primary-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Are tutorials updated regularly?
                        </h3>
                        <p class="text-navy-600 ml-9">
                            Yes! We continuously update our tutorials to reflect the latest Azure features and best practices. New tutorials are added weekly.
                        </p>
                    </div>

                    <div class="bg-white rounded-2xl border-2 border-gray-200 p-6 hover:border-primary-300 hover:shadow-lg transition-all duration-300">
                        <h3 class="text-lg font-bold text-navy-900 mb-3 flex items-start">
                            <svg class="w-6 h-6 text-primary-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            How can I get personalized support?
                        </h3>
                        <p class="text-navy-600 ml-9">
                            Fill out the contact form below or email us at support@azureskill.com. Our team typically responds within 24 hours during business days.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Additional Resources -->
            <div class="mt-16 bg-gradient-to-br from-primary-50 to-navy-50 rounded-3xl p-8 border-2 border-primary-200">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-navy-900 mb-3">Still need help?</h2>
                    <p class="text-lg text-navy-600">Explore these additional resources</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <a href="#" class="bg-white rounded-2xl p-6 text-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border-2 border-transparent hover:border-primary-300">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-navy-900 mb-2">Documentation</h3>
                        <p class="text-sm text-navy-600">Browse our comprehensive guides and documentation</p>
                    </a>

                    <a href="#" class="bg-white rounded-2xl p-6 text-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border-2 border-transparent hover:border-primary-300">
                        <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-navy-900 mb-2">Community Forum</h3>
                        <p class="text-sm text-navy-600">Connect with other learners and share knowledge</p>
                    </a>

                    <a href="#" class="bg-white rounded-2xl p-6 text-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border-2 border-transparent hover:border-primary-300">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-navy-900 mb-2">Video Tutorials</h3>
                        <p class="text-sm text-navy-600">Watch step-by-step video guides on YouTube</p>
                    </a>
                </div>
            </div>
        </div>

        <Footer />
    </div>
</template>

<style scoped>
@keyframes float-1 {
    0%, 100% { transform: translateY(0px) translateX(0px) rotate(12deg); }
    33% { transform: translateY(-20px) translateX(10px) rotate(15deg); }
    66% { transform: translateY(-10px) translateX(-10px) rotate(9deg); }
}

@keyframes float-2 {
    0%, 100% { transform: translateY(0px) translateX(0px) rotate(-6deg); }
    33% { transform: translateY(-15px) translateX(-15px) rotate(-9deg); }
    66% { transform: translateY(-25px) translateX(5px) rotate(-3deg); }
}

.animate-float-1 {
    animation: float-1 20s ease-in-out infinite;
}

.animate-float-2 {
    animation: float-2 18s ease-in-out infinite;
}
</style>
