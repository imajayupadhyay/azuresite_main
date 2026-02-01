<script setup>
import { Head } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import Hero from './Components/Hero.vue';
import Features from './Components/Features.vue';
import CallToAction from './Components/CallToAction.vue';
</script>

<template>
    <div class="min-h-screen">
        <Head>
            <title>AzureSkill - Master Azure Cloud Hands-On | Free Tutorials & Certifications</title>
            <meta name="description" content="Learn Microsoft Azure with 200+ free hands-on tutorials, comprehensive guides, and certification preparation. Master Azure services from beginner to expert level." />
            <meta name="keywords" content="Azure tutorials, Azure certification, Microsoft Azure, cloud computing, Azure learning, Azure training, free Azure courses" />
        </Head>

        <Header />

        <main>
            <!-- Section 1: Hero - Modern SVG background with floating shapes -->
            <Hero />

            <!-- Section 2: Features - Card-based showcase of offerings -->
            <Features />

            <!-- Section 3: Call to Action - Stats and CTA -->
            <CallToAction />
        </main>

        <Footer />
    </div>
</template>
