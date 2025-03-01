<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps(['content']);
const headings = ref([]);

onMounted(() => {
    const article = document.querySelector('article');
    if (article) {
        headings.value = Array.from(article.querySelectorAll('h2, h3'))
            .map(heading => ({
                id: heading.id,
                text: heading.textContent,
                level: parseInt(heading.tagName.charAt(1)),
            }));
    }
});
</script>

<template>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">{{ $t('table_of_contents') }}</h3>
        <nav class="space-y-2">
            <a v-for="heading in headings"
               :key="heading.id"
               :href="`#${heading.id}`"
               class="block text-sm text-gray-600 dark:text-gray-300 hover:text-primary-500 transition-colors"
               :class="{ 'pl-4': heading.level === 3 }">
                {{ heading.text }}
            </a>
        </nav>
    </div>
</template>