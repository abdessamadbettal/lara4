<script setup>
import { Head } from '@inertiajs/vue3';
import { ref, computed, onMounted, nextTick, watch } from 'vue';
import Tag from '@/Components/Blog/Tag.vue';
import GeneralLayout from '@/Layouts/GeneralLayout.vue';
import TableOfContents from '@/Components/Blog/TableOfContents.vue';
import ShareButtons from '@/Components/Blog/ShareButtons.vue';
// import AuthorCard from '@/Components/Blog/AuthorCard.vue';
// import RelatedPosts from '@/Components/Blog/RelatedPosts.vue';

const props = defineProps({
    post: Object,
    isLoading: {
        type: Boolean,
        default: false
    },
    blogs: Array,
    social: Object,
});


const post = computed(() => props.post.data);

const shareUrl = computed(() => window.location.href);
const shareData = computed(() => ({
    title: post.value?.name,
    text: post.value?.excerpt,
    url: shareUrl.value,
}));

const handleShare = async () => {
    try {
        if (navigator.share) {
            await navigator.share(shareData.value);
        }
    } catch (error) {
        console.error('Error sharing:', error);
    }
};

// Estimated read progress
const readingProgress = ref(0);
onMounted(() => {
    window.addEventListener('scroll', () => {
        const totalHeight = document.documentElement.scrollHeight - window.innerHeight;
        readingProgress.value = (window.scrollY / totalHeight) * 100;
    });
});
</script>

<template>

    <GeneralLayout>

        <Head>
            <title>{{ post?.name }}</title>
            <meta name="description" :content="post?.excerpt">
            <meta name="keywords" :content="post?.keywords">
            <meta property="og:title" :content="post?.name">
            <meta property="og:description" :content="post?.excerpt">
            <meta property="og:image" :content="post?.image">
            <meta property="og:url" :content="`/posts/${post?.slug}`">
            <meta property="og:type" content="article">
            <meta property="article:published_time" :content="post?.created_at">
            <meta property="article:author" :content="post?.author?.name">
            <meta property="article:section" :content="post?.category?.name">
            <meta property="article:tag" :content="post?.keywords">
            <meta property="article:modified_time" :content="post?.updated_at">
        </Head>

        <!-- Reading Progress Bar -->
        <div class="fixed top-0 left-0 w-full h-1 z-50">
            <div class="h-full bg-primary-500 transition-all duration-300"
                 :style="{ width: `${readingProgress}%` }">
            </div>
        </div>

        <!-- Hero Section -->
        <section class="relative min-h-[60vh] flex items-center py-12">
            <div class="absolute inset-0">
                <img :src="post?.image" 
                     :alt="post?.name"
                     class="w-full h-full object-cover"
                     loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-b from-slate-900/60 via-slate-900/80 to-slate-900"></div>
            </div>

            <div class="container relative z-10">
                <div class="max-w-3xl mx-auto text-center">
                    <!-- Category -->
                    <p 
                          class="inline-block px-4 py-1 rounded-full bg-primary-500/20 text-primary-500 mb-4">
                        {{ post?.category?.name }}
                    </p>

                    <!-- Title -->
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                        {{ post?.name }}
                    </h1>

                    <!-- Meta Info -->
                    <div class="flex flex-wrap items-center justify-center gap-4 text-white/80">
                        <div class="flex items-center">
                            <img :src="post?.author?.avatar" 
                                 :alt="post?.author?.name"
                                 class="w-8 h-8 rounded-full mr-2">
                            <span>{{ post?.author?.name }}</span>
                        </div>
                        <div class="flex items-center">
                            <Clock class="w-4 h-4 mr-2" />
                            <span>{{ post?.time_to_read }} {{ $t('min_read') }}</span>
                        </div>
                        <div>{{ new Date(post?.created_at).toLocaleDateString() }}</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="relative py-16 md:py-24">
            <div class="container">
                <div class="grid lg:grid-cols-12 gap-8">
                    <!-- Sidebar -->
                    <div class="lg:col-span-3 order-2 lg:order-1">
                        <div class="sticky top-24 space-y-8">
                            <!-- Table of Contents -->
                            <TableOfContents :content="post?.content" />
                            
                            <!-- Author Card -->
                            <!-- <AuthorCard :author="post?.author" /> -->

                            <!-- Share Buttons -->
                            <ShareButtons 
                                :url="shareUrl"
                                :title="post?.name"
                                :description="post?.excerpt"
                            />
                        </div>
                    </div>

                    <!-- Article Content -->
                    <article class="lg:col-span-9 order-1 lg:order-2">
                        <div class="prose prose-lg dark:prose-invert max-w-none">
                            <div v-html="post?.content"></div>
                        </div>

                        <!-- Tags -->
                        <div class="flex flex-wrap gap-2 mt-8">
                            <Tag v-for="tag in post?.tags"
                                 :key="tag.id"
                                 :name="tag.name"
                                 :type="tag.type" />
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!-- Related Posts -->
        <!-- <RelatedPosts 
            :posts="blogs"
            :loading="isLoading"
        /> -->
    </GeneralLayout>
</template>

<style scoped>

</style>