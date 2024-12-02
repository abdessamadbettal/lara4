<script setup>
import { defineProps } from 'vue';
import Button from '@/Components/Button.vue';
import IconTextDecoration from '@/Components/Icons/IconTextDecoration.vue';

const props = defineProps({
    id: {
        type: String,
        default: 'hero'
    }
});
</script>
<template>
    <div :id="id"
        class="flex flex-col justify-center items-center min-h-screen text-center pt-16 pb-20 lg:pt-32 lg:pb-32">
        <h1 class="mx-auto max-w-4xl font-medium tracking-tight text-gray-900 text-5xl sm:text-7xl mb-6">
            Welcome to
            <span class="relative whitespace-nowrap text-[#FF2D20]">
                <IconTextDecoration />
                <span class="relative">Laravel Starter</span>
            </span>
        </h1>
        <p class="mx-auto mt-6 max-w-5xl text-xl sm:text-2xl tracking-tight text-slate-700">
            If you are a Laravel developer and your priority is simplicity and faster development, you are in the right place. This starter project includes everything you need, including Inertia.js with Vue for the frontend, multi-language support, SSR, SEO-friendly features, and Filament as a CMS with all the tools you need to manage your website settings, activity log, translations, and more. Additionally, it includes all the recommended packages that can be useful for any project
        </p>
        <div class="mt-10 flex justify-center gap-x-6">
            <Button href="/register">Get Started</Button>
            <Button href="https://github.com/abdessamadbettal/laravel-starter" variant="outline">
                View on GitHub
            </Button>
        </div>
    </div>
</template>
