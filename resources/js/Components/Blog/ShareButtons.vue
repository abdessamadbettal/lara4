<script setup>
import { Twitter, Facebook, Linkedin, Link2 } from 'lucide-vue-next';

defineProps(['url', 'title', 'description']);

const copyToClipboard = async () => {
    try {
        await navigator.clipboard.writeText(window.location.href);
        // You might want to add a toast notification here
    } catch (err) {
        console.error('Failed to copy:', err);
    }
};
</script>

<template>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">{{ $t('share_this_post') }}</h3>
        <div class="flex gap-2">
            <a :href="`https://twitter.com/intent/tweet?url=${url}&text=${title}`" target="_blank"
                class="p-2 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-primary-500 hover:text-white transition-colors">
                <Twitter class="w-5 h-5" />
            </a>
            <a :href="`https://www.facebook.com/sharer/sharer.php?u=${url}`" target="_blank"
                class="p-2 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-primary-500 hover:text-white transition-colors">
                <Facebook class="w-5 h-5" />
            </a>
            <a :href="`https://www.linkedin.com/sharing/share-offsite/?url=${url}`" target="_blank"
                class="p-2 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-primary-500 hover:text-white transition-colors">
                <Linkedin class="w-5 h-5" />
            </a>
            <button @click="copyToClipboard"
                class="p-2 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-primary-500 hover:text-white transition-colors">
                <Link2 class="w-5 h-5" />
            </button>
        </div>
    </div>
</template>
