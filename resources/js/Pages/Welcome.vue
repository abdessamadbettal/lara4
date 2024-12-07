<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Hero from '@/Components/Home/Hero.vue';
import Trusted from '@/Components/Home/Trusted.vue';
import { ref } from 'vue';

</script>

<template>

    <Head>
        <title>Laravel Inertia Vue 3 Starter</title>
        <meta name="description"
            content="Simplify your Laravel development with Laravel Starter! Build faster and smarter with tools like Inertia.js, Vue, Tailwind, multi-language support, SEO optimization, and Filament CMS - all ready to use.">
        <meta name="keywords"
            content="Laravel, Inertia.js, Vue, TailwindCSS, multi-language, SEO, Filament CMS, Laravel Starter, SSR, Spatie, i18n">
    </Head>

    <Hero />

    <Trusted />

</template>
