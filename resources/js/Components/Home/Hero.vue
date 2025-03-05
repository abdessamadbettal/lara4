<script setup>
import Button from '@/Components/Button.vue';
import IconTextDecoration from '@/Components/Icons/IconTextDecoration.vue';
import VueTypewriterEffect from "vue-typewriter-effect";
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
    id: {
        type: String,
        default: 'hero'
    }
});

// Dynamic typewriter words based on Lara4 features
const typedStrings = [
    'Modern',
    'Powerful',
    'Multilingual',
    'SEO-Optimized'
];

// Feature indicators with proper icons
const features = [
    {
        name: 'Laravel',
        icon: 'https://cdn.simpleicons.org/laravel/FF2D20',
        color: 'text-red-500',
        bgColor: 'bg-red-50 dark:bg-red-900/20',
    },
    {
        name: 'Vue.js',
        icon: 'https://cdn.simpleicons.org/vuedotjs/4FC08D',
        color: 'text-green-500',
        bgColor: 'bg-green-50 dark:bg-green-900/20',
    },
    {
        name: 'Inertia.js',
        icon: 'https://cdn.simpleicons.org/inertia/9553E9',
        color: 'text-purple-500',
        bgColor: 'bg-purple-50 dark:bg-purple-900/20',
    },
    {
        name: 'Tailwind CSS',
        icon: 'https://cdn.simpleicons.org/tailwindcss/06B6D4',
        color: 'text-cyan-500',
        bgColor: 'bg-cyan-50 dark:bg-cyan-900/20',
    },
    {
        name: 'Filament',
        icon: 'https://cdn.simpleicons.org/filament/EF3B2D',
        color: 'text-indigo-500',
        bgColor: 'bg-indigo-50 dark:bg-indigo-900/20',
    }
];
</script>

<template>
    <div :id="id" class="relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10 dark:opacity-20">
            <div class="absolute inset-0 bg-grid-slate-100 [mask-image:linear-gradient(0deg,white,transparent)]" />
        </div>

        <!-- Hero Content -->
        <div class="relative flex flex-col justify-center items-center text-center px-6 pt-24 pb-20 lg:pt-32 lg:pb-32 mx-auto max-w-7xl">
            <!-- Main Headline -->
            <h1 class="font-bold tracking-tight text-gray-900 dark:text-white">
                <span class="block text-4xl sm:text-6xl lg:text-7xl mb-4">
                    {{ $t('home.welcome_to') }}
                </span>
                <span class="block text-4xl sm:text-6xl lg:text-7xl">
                    <span class="relative whitespace-nowrap text-[#FF2D20]">
                        <IconTextDecoration class="absolute top-2/3 left-0 h-[0.58em] w-full fill-[#FF2D20]/20" />
                        <span class="relative">Lara4</span>
                    </span>
                    <span class="text-[#FF2D20]"> - </span>
                    <VueTypewriterEffect :strings="typedStrings" :loop="true" :autoStart="true" />
                </span>
            </h1>

            <!-- Subtext -->
            <p class="mx-auto mt-8 max-w-3xl text-lg sm:text-xl text-gray-600 dark:text-gray-300 leading-relaxed">
                {{ $t('home.hero_description') }}
            </p>

            <!-- CTAs -->
            <div class="mt-12 flex flex-col sm:flex-row justify-center gap-4 sm:gap-6">
                <Button
                    :href="route('register')"
                    method="get"
                    class="group relative px-8 py-3 text-lg"
                    variant="primary"
                >
                    <span class="relative z-10">{{ $t('home.get_started') }}</span>
                </Button>
                
                <Button
                    href="https://github.com/abdessamadbettal/Lara4"
                    class="px-8 py-3 text-lg"
                    variant="outline"
                    as="a"
                    target="_blank"
                >
                    {{ $t('home.view_on_github') }}
                </Button>
            </div>

            <!-- Feature Indicators with SVG Icons -->
            <div class="mt-16 grid grid-cols-2 gap-6 sm:grid-cols-3 lg:grid-cols-5">
                <div v-for="(feature, index) in features" :key="index" 
                     class="flex flex-col items-center transform transition-all duration-300 hover:scale-110">
                    <div :class="['w-14 h-14 flex items-center justify-center rounded-full p-3 mb-3', feature.bgColor]">
                        <img :src="feature.icon" :alt="feature.name" class="w-8 h-8 drop-shadow-sm">
                    </div>
                    <span :class="['text-sm font-medium', feature.color]">{{ feature.name }}</span>
                </div>
            </div>

            <!-- Scroll indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
                <div class="animate-bounce w-6 h-10 border-2 border-gray-400 dark:border-gray-600 rounded-full flex justify-center">
                    <div class="w-1 h-3 bg-gray-400 dark:bg-gray-600 rounded-full mt-2"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.bg-grid-slate-100 {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32' width='32' height='32' fill='none' stroke='rgb(51 65 85 / 0.1)'%3E%3Cpath d='M0 .5H31.5V32'/%3E%3C/svg%3E");
}

/* Gradient Animation */
@keyframes gradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.text-gradient {
    background-size: 200% auto;
    animation: gradient 4s linear infinite;
}

/* Smooth scroll behavior */
html {
    scroll-behavior: smooth;
}

/* Enhanced hover effects */
button:hover {
    transform: translateY(-2px);
    transition: all 0.3s ease;
}

/* Feature icon animations */
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

/* Icon entry animation */
@keyframes icon-entry {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Apply animations to icons with delay */
.flex.flex-col.items-center {
    animation: icon-entry 0.5s ease-out forwards;
    opacity: 0;
}

.flex.flex-col.items-center:nth-child(1) { animation-delay: 0.3s; }
.flex.flex-col.items-center:nth-child(2) { animation-delay: 0.4s; }
.flex.flex-col.items-center:nth-child(3) { animation-delay: 0.5s; }
.flex.flex-col.items-center:nth-child(4) { animation-delay: 0.6s; }
.flex.flex-col.items-center:nth-child(5) { animation-delay: 0.7s; }

/* Responsive adjustments */
@media (max-width: 640px) {
    .grid-cols-2 {
        grid-template-columns: 1fr 1fr;
    }
}
</style>