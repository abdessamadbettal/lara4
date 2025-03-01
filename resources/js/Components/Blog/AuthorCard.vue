<script setup>
import { Github, Twitter, Linkedin, Globe } from 'lucide-vue-next';

const props = defineProps({
    author: {
        type: Object,
        required: true
    }
});

const socialIcons = {
    github: Github,
    twitter: Twitter,
    linkedin: Linkedin,
    website: Globe
};
</script>

<template>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
        <div class="flex items-center gap-4 mb-4">
            <img 
                :src="author.avatar" 
                :alt="author.name"
                class="w-16 h-16 rounded-full object-cover"
            />
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ author.name }}
                </h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ author.title || $t('author') }}
                </p>
            </div>
        </div>

        <p v-if="author.bio" class="text-gray-600 dark:text-gray-400 text-sm mb-4">
            {{ author.bio }}
        </p>

        <div v-if="author.social_links" class="flex gap-2">
            <a v-for="(url, platform) in author.social_links"
               :key="platform"
               :href="url"
               target="_blank"
               rel="noopener noreferrer"
               class="p-2 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 hover:bg-primary-500 hover:text-white transition-colors duration-300"
            >
                <component :is="socialIcons[platform]" class="w-4 h-4" />
            </a>
        </div>
    </div>
</template>