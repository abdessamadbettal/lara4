<template>
    <div class="flex sm:items-center">
        <div class="relative">
            <Dropdown align="right" width="28">
                <template #trigger>
                    <span class="inline-flex rounded-md">
                        <button type="button"
                            class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300">
                            {{
                                currentLanguage
                             }}

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
                    <DropdownLink v-for="lang in languages" :key="lang"
                        @click="changeLanguage(lang)" class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                        {{ lang }}
                    </DropdownLink>
                </template>
            </Dropdown>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import Dropdown from '@/Components/Forms/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const currentLanguage = ref('English')
const languages = [
    'English',
    'French',
    'Spanish',
    'German',
    'Italian',
]

function changeLanguage(lang) {
    currentLanguage.value = lang
}
</script>
