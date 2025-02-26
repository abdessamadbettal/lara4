<script setup>
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
        class="flex flex-col justify-center items-center text-center pt-16 pb-20 lg:pt-32 lg:pb-32">
        <h1 class="mx-auto max-w-4xl font-medium tracking-tight text-gray-900 dark:text-white text-5xl sm:text-7xl mb-6">
            {{ $t('home.welcome_to') }}
            <span class="relative whitespace-nowrap text-[#FF2D20]">
                <IconTextDecoration />
                <span class="relative">Laravel Starter</span>
            </span>
        </h1>
        <p class="mx-auto mt-6 max-w-5xl text-xl sm:text-2xl tracking-tight text-slate-700 dark:text-slate-300">
            {{ $t('home.hero_description') }}
        </p>
        <div class="mt-10 flex justify-center gap-x-6">
            <Button :href="route('register')">{{ $t('home.get_started') }}</Button>
            <Button href="https://github.com/abdessamadbettal/laravel-starter" variant="outline">
                {{ $t('home.view_on_github') }}
            </Button>
        </div>
    </div>
</template>
