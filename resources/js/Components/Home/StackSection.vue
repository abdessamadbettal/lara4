<script setup>
import { onMounted, ref } from 'vue';
import { useIntersectionObserver } from '@vueuse/core';

const stacks = [
    {
        name: 'Laravel',
        description: 'Modern PHP Framework',
        icon: '/images/tech/laravel.svg',
        color: 'text-red-500',
        bgColor: 'bg-red-50 dark:bg-red-900/20',
        link: 'https://laravel.com'
    },
    {
        name: 'Vue.js',
        description: 'Progressive JS Framework',
        icon: '/images/tech/vue.svg',
        color: 'text-green-500',
        bgColor: 'bg-green-50 dark:bg-green-900/20',
        link: 'https://vuejs.org'
    },
    {
        name: 'Inertia.js',
        description: 'Modern Monolith Builder',
        icon: '/images/tech/inertia.svg',
        color: 'text-purple-500',
        bgColor: 'bg-purple-50 dark:bg-purple-900/20',
        link: 'https://inertiajs.com'
    },
    {
        name: 'Tailwind CSS',
        description: 'Utility-First CSS',
        icon: '/images/tech/tailwind.svg',
        color: 'text-cyan-500',
        bgColor: 'bg-cyan-50 dark:bg-cyan-900/20',
        link: 'https://tailwindcss.com'
    },
    {
        name: 'Filament',
        description: 'Admin Panel & Forms',
        icon: '/images/tech/filament.svg',
        color: 'text-indigo-500',
        bgColor: 'bg-indigo-50 dark:bg-indigo-900/20',
        link: 'https://filamentphp.com'
    }
];

const target = ref(null);
const isVisible = ref(false);

const { stop } = useIntersectionObserver(
    target,
    ([{ isIntersecting }]) => {
        if (isIntersecting) {
            isVisible.value = true;
            stop();
        }
    },
    { threshold: 0.1 }
);
</script>

<template>
    <section ref="target" class="py-24 bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16"
                 :class="[isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10']"
                 style="transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1)">
                <h2 class="text-4xl font-bold mb-4 bg-gradient-to-r from-gray-900 to-gray-600 dark:from-gray-100 dark:to-gray-300 bg-clip-text text-transparent">
                    Powered by Modern Stack
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-300">
                    Built with cutting-edge technologies for optimal performance
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-8">
                <template v-for="(stack, index) in stacks" :key="stack.name">
                    <a :href="stack.link" 
                       target="_blank"
                       :class="[
                           'transform transition-all duration-500 hover:scale-105',
                           isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'
                       ]"
                       :style="{ transitionDelay: `${index * 100}ms` }"
                       class="group bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl border border-gray-100 dark:border-gray-700">
                        <div class="flex flex-col items-center space-y-4">
                            <div :class="['w-16 h-16 flex items-center justify-center rounded-full p-3 group-hover:scale-110 transition-transform duration-300', stack.bgColor]">
                                <img :src="stack.icon" :alt="stack.name" class="w-10 h-10 drop-shadow-sm">
                            </div>
                            <h3 :class="['font-bold text-xl', stack.color]">
                                {{ stack.name }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 text-center text-sm">
                                {{ stack.description }}
                            </p>
                        </div>
                    </a>
                </template>
            </div>
        </div>
    </section>
</template>

<style scoped>
.scale-up-center {
    animation: scale-up-center 0.4s cubic-bezier(0.16, 1, 0.3, 1) both;
}

@keyframes scale-up-center {
    0% {
        transform: scale(0.5);
    }
    100% {
        transform: scale(1);
    }
}
</style>