<script setup>
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import Hero from './Components/Hero.vue';
import AzureServices from './Components/AzureServices.vue';
import Certifications from './Components/Certifications.vue';
</script>

<template>
    <div class="min-h-screen">
        <Header />

        <main>
            <Hero />
            <AzureServices />
            <Certifications />
        </main>

        <Footer />
    </div>
</template>
