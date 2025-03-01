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
            <title>Lara4 - Laravel Vue Inertia Starter Kit</title>
            <meta name="description"
                content="Production-ready Laravel starter kit with Vue 3, Inertia.js, Tailwind CSS, Filament admin, and built-in SEO optimization. Start building professional web applications faster." />
            <meta name="keywords"
                content="Laravel starter kit, Vue 3, Inertia.js, TailwindCSS, Filament CMS, SEO optimization, SSR, i18n, multi-language support, Laravel boilerplate" />

            <!-- Open Graph / Facebook -->
            <meta property="og:type" content="website" />
            <meta property="og:url" content="https://lara4.com/" />
            <meta property="og:title" content="Lara4 - Laravel Vue Inertia Starter Kit" />
            <meta property="og:description"
                content="Production-ready Laravel starter kit with Vue 3, Inertia.js, Tailwind CSS, Filament admin, and built-in SEO optimization." />
            <meta property="og:image" content="https://lara4.com/favicon.png" />

            <!-- Twitter -->
            <meta property="twitter:card" content="summary_large_image" />
            <meta property="twitter:url" content="https://lara4.com/" />
            <meta property="twitter:title" content="Lara4 - Laravel Vue Inertia Starter Kit" />
            <meta property="twitter:description"
                content="Production-ready Laravel starter kit with Vue 3, Inertia.js, Tailwind CSS, Filament admin, and built-in SEO optimization." />
            <meta property="twitter:image" content="https://lara4.com/favicon.png" />
        </Head>

        <Hero />

        <Trusted />

        <BlogSection :posts="posts.data" v-if="posts.data.length > 0" />
    </GeneralLayout>

</template>
