<script setup>
import { ref, onMounted } from 'vue';

const isVisible = ref(false);

onMounted(() => {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    isVisible.value = true;
                }
            });
        },
        { threshold: 0.1 }
    );

    const section = document.getElementById('features-section');
    if (section) observer.observe(section);
});

const features = [
    {
        title: 'Hands-On Tutorials',
        description: 'Learn by doing with step-by-step tutorials covering all Azure services from Virtual Machines to AI & ML.',
        icon: 'tutorials',
        stats: '200+',
        statsLabel: 'Tutorials',
        gradient: 'from-blue-500 to-cyan-500',
        link: '/tutorials'
    },
    {
        title: 'Certification Prep',
        description: 'Prepare for Microsoft Azure certifications with comprehensive study guides and practice resources.',
        icon: 'certification',
        stats: '12',
        statsLabel: 'Cert Paths',
        gradient: 'from-primary-500 to-purple-500',
        link: '/certifications'
    },
    {
        title: 'Live Training',
        description: 'Join expert-led live sessions with Q&A, real-world scenarios, and hands-on labs.',
        icon: 'training',
        stats: 'Live',
        statsLabel: 'Sessions',
        gradient: 'from-orange-500 to-red-500',
        link: '/live-training'
    }
];
</script>

<template>
    <section id="features-section" class="relative py-24 bg-navy-50 overflow-hidden">
        <!-- SVG Background Pattern -->
        <div class="absolute inset-0 opacity-50">
            <svg class="absolute w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="dots" width="30" height="30" patternUnits="userSpaceOnUse">
                        <circle cx="2" cy="2" r="1" fill="rgba(91, 107, 241, 0.15)" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#dots)" />
            </svg>
        </div>

        <!-- Decorative Blobs -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary-200/30 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-200/30 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div
                class="text-center mb-16 transition-all duration-700"
                :class="isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            >
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary-100 text-primary-700 text-sm font-medium mb-4">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                    Everything You Need
                </div>
                <h2 class="text-4xl sm:text-5xl font-bold text-navy-900 mb-4">
                    Your Path to Azure Mastery
                </h2>
                <p class="text-lg text-navy-600 max-w-2xl mx-auto">
                    From beginner to expert, we provide all the resources you need to succeed with Microsoft Azure.
                </p>
            </div>

            <!-- Feature Cards -->
            <div class="grid md:grid-cols-3 gap-8">
                <a
                    v-for="(feature, index) in features"
                    :key="feature.title"
                    :href="feature.link"
                    class="group relative bg-white rounded-2xl p-8 shadow-lg shadow-navy-900/5 border border-navy-100 hover:shadow-xl hover:shadow-navy-900/10 hover:-translate-y-2 transition-all duration-500"
                    :class="isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-12'"
                    :style="{ transitionDelay: `${index * 150}ms` }"
                >
                    <!-- Gradient Border on Hover -->
                    <div
                        class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                        :class="`bg-gradient-to-br ${feature.gradient}`"
                        style="padding: 2px; mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0); mask-composite: exclude; -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0); -webkit-mask-composite: xor;"
                    ></div>

                    <!-- Icon -->
                    <div
                        class="w-14 h-14 rounded-xl flex items-center justify-center mb-6 transition-transform duration-300 group-hover:scale-110"
                        :class="`bg-gradient-to-br ${feature.gradient}`"
                    >
                        <!-- Tutorials Icon -->
                        <svg v-if="feature.icon === 'tutorials'" class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <!-- Certification Icon -->
                        <svg v-if="feature.icon === 'certification'" class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                        <!-- Training Icon -->
                        <svg v-if="feature.icon === 'training'" class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </div>

                    <!-- Content -->
                    <h3 class="text-xl font-bold text-navy-900 mb-3 group-hover:text-primary-600 transition-colors">
                        {{ feature.title }}
                    </h3>
                    <p class="text-navy-600 mb-6 leading-relaxed">
                        {{ feature.description }}
                    </p>

                    <!-- Stats -->
                    <div class="flex items-center justify-between pt-6 border-t border-navy-100">
                        <div>
                            <span
                                class="text-2xl font-bold bg-clip-text text-transparent"
                                :class="`bg-gradient-to-r ${feature.gradient}`"
                            >
                                {{ feature.stats }}
                            </span>
                            <span class="text-sm text-navy-500 ml-1">{{ feature.statsLabel }}</span>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-navy-100 flex items-center justify-center group-hover:bg-primary-100 transition-colors">
                            <svg class="w-5 h-5 text-navy-400 group-hover:text-primary-600 group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
</template>
