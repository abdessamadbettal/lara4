<template>
    <div class="flex sm:items-center">
        <div class="relative">
            <Dropdown align="right" width="48">
                <template #trigger>
                    <button type="button"
                        class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium leading-4 text-gray-700 transition duration-200 ease-in-out hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 active:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:border-gray-600">
                        <img loading="lazy" :src="currentLanguage.flag" alt="" class="w-5 h-4 me-2 rounded shadow-sm">
                        <span class="font-semibold">{{ currentLanguage.name }}</span>
                        <svg class="ms-2 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </template>

                <template #content>
                    <div class="py-1">
                        <DropdownLink
                            v-for="lang in languages"
                            :key="lang.code"
                            :href="getURL(lang)"
                            :class="[
                                'px-4 py-2.5 flex items-center space-x-3 transition duration-150',
                                'hover:bg-gray-50 dark:hover:bg-gray-700',
                                lang.code === currentLanguage.code ? 'bg-gray-50 dark:bg-gray-700' : ''
                            ]"
                            @click.prevent="changeLanguage(lang)"
                        >
                            <img loading="lazy" :src="lang.flag" alt="" class="w-5 h-4 rounded shadow-sm">
                            <span class="flex-1">{{ lang.name }}</span>
                            <svg v-if="lang.code === currentLanguage.code" 
                                class="h-5 w-5 text-blue-500" 
                                xmlns="http://www.w3.org/2000/svg" 
                                viewBox="0 0 20 20" 
                                fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </DropdownLink>
                    </div>
                </template>
            </Dropdown>
        </div>
    </div>
</template>

<script setup>
import { computed, ref } from 'vue';
import { router as inertiaRouter } from '@inertiajs/vue3';
import Dropdown from '@/Components/Forms/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import i18n, { setLocale } from '@/i18n';

const props = defineProps(['currentLocale']);

const languages = [
    { code: 'en', name: 'English', flag: 'https://flagcdn.com/w20/gb.png' },
    { code: 'fr', name: 'French', flag: 'https://flagcdn.com/w20/fr.png' },
    { code: 'es', name: 'Spanish', flag: 'https://flagcdn.com/w20/es.png' },
    // { code: 'ar', name: 'Arabic', flag: 'https://flagcdn.com/w20/ma.png' },
];

const currentLanguage = computed(() => {
    return languages.find(lang => lang.code === props.currentLocale);
});

const getURL = (lang) => {
    const currentPath = window.location.pathname;
    const pathSegments = currentPath.split('/').filter(Boolean); // Remove empty segments
    
    // Check if the first segment is a language code
    const isFirstSegmentLocale = languages.some(l => l.code === pathSegments[0]);
    
    if (isFirstSegmentLocale) {
        // Replace the language code
        pathSegments[0] = lang.code;
    } else {
        // Add the language code at the beginning
        pathSegments.unshift(lang.code);
    }
    
    return '/' + pathSegments.join('/');
};

const isLoading = ref(false);

async function changeLanguage(lang) {
    if (lang.code === props.currentLocale) return;
    
    isLoading.value = true;
    try {
        const newUrl = getURL(lang);
        await setLocale(lang.code);
        window.location.href = newUrl;
    } catch (error) {
        console.error('Failed to change language:', error);
    } finally {
        isLoading.value = false;
    }
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.15s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
