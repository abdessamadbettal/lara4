<script setup>
import Header from '@/Components/Layout/Header.vue';
import Footer from '@/Components/Layout/Footer.vue';
import { ref } from 'vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

const menuItems = ref([
    { label: 'home.features', link: "/#features" },
    { label: 'home.blogs', link: route('posts.index') },
    { label: 'home.documentation', link: "/#documentation" },
]);

</script>

<template>

    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50" :dir="$page.props.dir">
        <img loading="lazy" id="background" class="absolute -left-20 top-0 max-w-[877px]"
            src="https://laravel.com/assets/img/welcome/background.svg" />
        <div
            class="relative flex min-h-screen flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <Header :menuItems="menuItems" :canLogin="canLogin" :canRegister="canRegister"  />
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">

                <main class="mt-6">
                    <slot></slot>

                </main>

                <Footer :laravelVersion="laravelVersion" :phpVersion="phpVersion" :menuItems="menuItems" />

            </div>
        </div>
    </div>
</template>
