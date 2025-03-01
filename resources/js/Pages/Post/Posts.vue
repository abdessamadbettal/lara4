<script setup>
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import BlogCard from '@/Components/Blog/BlogCard.vue';
import Pagination from '@/Components/Pagination.vue';
import GeneralLayout from '@/Layouts/GeneralLayout.vue';

const props = defineProps({
    posts: {
        type: Object,
        required: true
    },
    isLoading: {
        type: Boolean,
        default: false
    },
    currentLocale: {
        type: String,
        required: true
    },
    filters: {
        type: Object,
        default: () => ({})
    }
});

// SEO Translations
const translations = {
    title: {
        en: 'Blog Posts - Lara4',
        fr: 'Articles de Blog - Lara4',
        es: 'Artículos del Blog - Lara4'
    },
    description: {
        en: 'Discover our latest articles about Laravel, Vue.js, and web development best practices',
        fr: 'Découvrez nos derniers articles sur Laravel, Vue.js et les meilleures pratiques de développement web',
        es: 'Descubre nuestros últimos artículos sobre Laravel, Vue.js y las mejores prácticas de desarrollo web'
    }
};

// Computed properties for SEO
const pageTitle = computed(() => translations.title[props.currentLocale]);
const pageDescription = computed(() => translations.description[props.currentLocale]);
const canonicalUrl = computed(() => {
    if (typeof window !== 'undefined') {
        return `${window.location.origin}/${props.currentLocale}/posts`;
    }
    return `https://lara4.com/${props.currentLocale}/posts`;
});

</script>

<template>
    <GeneralLayout>
        <Head>
            <!-- Basic Meta Tags -->
            <title>{{ pageTitle }}</title>
            <meta name="description" :content="pageDescription">
            <meta name="robots" content="index, follow">
            
            <!-- Open Graph / Facebook -->
            <meta property="og:type" content="website">
            <meta property="og:title" :content="pageTitle">
            <meta property="og:description" :content="pageDescription">
            <meta property="og:url" :content="canonicalUrl">
            <meta property="og:site_name" content="Lara4">
            <meta property="og:locale" :content="currentLocale">
            
            <!-- Twitter -->
            <meta name="twitter:card" content="summary_large_image">
            <meta name="twitter:title" :content="pageTitle">
            <meta name="twitter:description" :content="pageDescription">
            
            <!-- Canonical and Alternate Languages -->
            <link rel="canonical" :href="canonicalUrl">
            <link rel="alternate" hreflang="x-default" href="https://lara4.com/en/posts">
            <link rel="alternate" hreflang="en" href="https://lara4.com/en/posts">
            <link rel="alternate" hreflang="fr" href="https://lara4.com/fr/posts">
            <link rel="alternate" hreflang="es" href="https://lara4.com/es/posts">
            
            <!-- JSON-LD Schema -->
            <!-- <script type="application/ld+json" v-text="JSON.stringify(blogSchema)"></script> -->
        </Head>

        <section class="relative md:py-24 py-16">
            <div class="container relative">
                <!-- Optional: Breadcrumbs for SEO -->
                <nav aria-label="Breadcrumb" class="mb-8">
                    <ol class="flex items-center space-x-2 text-sm">
                        <li>
                            <Link :href="route('welcome')" class="text-gray-500 hover:text-primary-500">
                                {{ $t('home') }}
                            </Link>
                        </li>
                        <li class="text-gray-300">/</li>
                        <li class="text-gray-900 dark:text-white">
                            {{ $t('blog') }}
                        </li>
                    </ol>
                </nav>

                <!-- Main Content -->
                <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6">
                    <template v-if="isLoading">
                        <div v-for="n in 3" :key="n" class="group relative overflow-hidden">
                            <Skeleton width="100%" height="200px" />
                            <div class="mt-6">
                                <Skeleton width="70%" height="20px" />
                                <Skeleton width="50%" height="20px" class="mt-2" />
                                <Skeleton width="90%" height="20px" class="mt-2" />
                            </div>
                        </div>
                    </template>

                    <template v-else>
                        <BlogCard 
                            v-for="post in posts.data" 
                            :key="post.id" 
                            :item="post" 
                        />
                    </template>
                </div>

                <!-- Pagination -->
                <Pagination 
                    v-if="posts.meta" 
                    class="mt-6" 
                    :meta="posts.meta" 
                />
            </div>
        </section>
    </GeneralLayout>
</template>