<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>

    <Head>
        <title>About - My app</title>
        <meta name="description" content="This is a page specific description" />
        <meta name="keywords" content="about, my app" />
        <!-- og -->
        <meta property="og:title" content="About - My app" />
        <meta property="og:description" content="This is a page specific description" />
        <meta property="og:image" content="https://example.com/image.jpg" />
        <meta property="og:url" content="https://example.com/about" />
        <!-- twitter -->
        <meta property="twitter:title" content="About - My app" />
        <meta property="twitter:description" content="This is a page specific description" />
        <meta property="twitter:image" content="https://example
        .com/image.jpg" />
        <meta property="twitter:url" content="https://example.com/about" />

        <!-- crawler -->
        <meta name="robots" content="index, follow" />
        <meta name="author" content="John Doe" />
        <meta name="publisher" content="John Doe" />
        <meta name="distribution" content="global" />
        <meta name="rating" content="general" />
        <meta name="revisit-after" content="7 days" />
        <meta name="language" content="en" />
        <meta name="coverage" content="Worldwide" />
        <meta name="category" content="Business" />
        <meta name="subtitle" content="This is a subtitle" />
        <meta name="target" content="all" />
        <meta name="HandheldFriendly" content="True" />
        <meta name="MobileOptimized" content="320" />
        <meta name="theme-color" content="#000000" />
        <meta name="referrer" content="no-referrer-when-downgrade" />
        <meta name="format-detection" content="telephone=no" />
        <meta name="format-detection" content="address=no" />
        <meta name="format-detection" content="email=no" />
        <meta name="format-detection" content="date=no" />
        <meta name="format-detection" content="time=no" />
        <meta name="format-detection" content="url=no" />
    </Head>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                posts
            </h2>

        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <Link
                            :href="route('posts.show' , 1)"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Post
                        </Link>
                        <Link
                            :href="route('posts.create')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Create Post
                        </Link>

                        <Link
                            :href="route('posts.edit' , 1)"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Edit Post
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
