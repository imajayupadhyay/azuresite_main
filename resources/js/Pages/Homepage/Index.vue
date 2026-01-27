<script setup>
import { Head } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import Hero from './Components/Hero.vue';
import AzureServices from './Components/AzureServices.vue';
import Certifications from './Components/Certifications.vue';
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
            <Hero />
            <AzureServices />
            <Certifications />
        </main>

        <Footer />
    </div>
</template>
