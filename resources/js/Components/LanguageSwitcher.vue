<template>
    <div class="flex sm:items-center">
        <div class="relative">
            <Dropdown align="right" width="28">
                <template #trigger>
                    <span class="inline-flex rounded-md">
                        <button type="button"
                            class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300">
                            <img :src="currentLanguage.flag" alt="" class="w-4 h-4 me-2">
                            <span class="uppercase">{{ currentLanguage.code }}</span>

                            <svg class="-me-0.5 ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </span>
                </template>

                <template #content>
                    <DropdownLink v-for="lang in languages" :key="lang.code" :href="getLanguageUrl(lang.code)"
                        class="px-4 py-2 hover:bg-gray-100 cursor-pointer flex" @click="changeLanguage(lang)">
                        <img :src="lang.flag" alt="" class="w-4 h-4 me-2">
                        {{ lang.name }}
                    </DropdownLink>
                </template>
            </Dropdown>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { router as inertiaRouter } from '@inertiajs/vue3'
import Dropdown from '@/Components/Forms/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const languages = [
    { code: 'en', name: 'English', flag: 'https://flagcdn.com/w20/gb.png' },
    { code: 'fr', name: 'French', flag: 'https://flagcdn.com/w20/fr.png' },
    { code: 'es', name: 'Spanish', flag: 'https://flagcdn.com/w20/es.png' },
    { code: 'de', name: 'German', flag: 'https://flagcdn.com/w20/de.png' },
    { code: 'it', name: 'Italian', flag: 'https://flagcdn.com/w20/it.png' },
    { code: 'ar', name: 'Arabic', flag: 'https://flagcdn.com/w20/ma.png' },
]

const currentLanguage = ref(languages[0])

function getLanguageUrl(langCode) {
    const currentPath = window.location.pathname
    if (/^\/[a-z]{2}\//.test(currentPath)) {
        return currentPath.replace(/^\/[a-z]{2}/, `/${langCode}`)
    } else {
        return `/${langCode}${currentPath}`
    }
}

function changeLanguage(lang) {
    currentLanguage.value = lang
    const newPath = getLanguageUrl(lang.code)
    inertiaRouter.visit(newPath)
}
</script>
