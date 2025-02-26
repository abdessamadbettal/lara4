<script setup>
import { ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    isLoading: {
        type: Boolean,
        default: false
    },
    variant: {
        type: String,
        default: 'primary'
    },
    href: {
        type: String,
        default: null
    }
});

const buttonClasses = computed(() => {
    switch (props.variant) {
        case 'danger':
            return 'inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 active:bg-red-700 dark:focus:ring-offset-gray-800';
        case 'outline':
            return 'inline-flex items-center rounded-md border border-gray-800 bg-transparent px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-800 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-200 dark:border-gray-200 dark:text-gray-200 dark:hover:bg-gray-700 dark:focus:ring-offset-gray-800 dark:active:bg-gray-600';
        default:
            return 'inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300';
    }
});
</script>
<template>
    <component :is="href ? Link : 'button'" :href="href" :disabled="isLoading"
        :class="[buttonClasses, { 'opacity-25': isLoading }]">
        <slot v-if="!isLoading" />
        <span v-else>Loading...</span>
    </component>
</template>
