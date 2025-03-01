<script setup>
import { computed } from 'vue';
import BlogCard from './BlogCard.vue';

const props = defineProps({
    posts: {
        type: Array,
        required: true
    },
    loading: {
        type: Boolean,
        default: false
    }
});

const relatedPosts = computed(() => props.posts.slice(0, 3));
</script>

<template>
    <section v-if="posts.length > 0" class="bg-gray-50 dark:bg-gray-900 py-16">
        <div class="container">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">
                {{ $t('related_posts') }}
            </h2>

            <div v-if="loading" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div v-for="i in 3" :key="i" class="animate-pulse">
                    <div class="bg-gray-200 dark:bg-gray-800 rounded-xl h-[400px]"></div>
                </div>
            </div>

            <div v-else class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <BlogCard 
                    v-for="post in relatedPosts" 
                    :key="post.id" 
                    :item="post"
                />
            </div>
        </div>
    </section>
</template>