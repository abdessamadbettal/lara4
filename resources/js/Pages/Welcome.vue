<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Hero from '@/Components/Home/Hero.vue';
import Trusted from '@/Components/Home/Trusted.vue';
import BlogSection from '@/Components/Blog/BlogSection.vue';
import GeneralLayout from '@/Layouts/GeneralLayout.vue';

const props = defineProps({
    posts: {
        type: Array,
        required: true
    }
});

</script>

<template>
  <GeneralLayout>

      <Head>
          <title>Laravel Inertia Vue 3 Starter</title>
        <meta name="description"
        content="Simplify your Laravel development with Lara4! Build faster and smarter with tools like Inertia.js, Vue, Tailwind, multi-language support, SEO optimization, and Filament CMS - all ready to use.">
        <meta name="keywords"
        content="Laravel, Inertia.js, Vue, TailwindCSS, multi-language, SEO, Filament CMS, Lara4, SSR, Spatie, i18n">
    </Head>

    <Hero />

    <Trusted />

    <BlogSection :posts="posts.data" />
</GeneralLayout>

</template>
