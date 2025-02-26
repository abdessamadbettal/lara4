<script setup>
import { Head } from '@inertiajs/vue3';
import { ref, computed, onMounted, nextTick, watch } from 'vue';
import Tag from '@/Components/Blog/Tag.vue';
import GeneralLayout from '@/Layouts/GeneralLayout.vue';

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

        <section class="relative table w-full items-center py-12">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-900/60 via-slate-900/80 to-slate-900"></div>
            <div class="container relative">
                <div class="grid grid-cols-1 pb-8 text-center mt-10">
                    <h3 class="text-4xl leading-normal tracking-wider font-semibold text-white">
                        <span>{{ post?.name }}</span>
                    </h3>

                    <ul class="list-none mt-6">
                        <li class="inline-block text-white/50 mx-5">
                            <span class="text-white block">{{ $t('author') }} :</span>
                            <span class="block">
                                <span>{{ post?.author?.name }}</span>
                            </span>
                        </li>
                        <li class="inline-block text-white/50 mx-5">
                            <span class="text-white block">{{ $t('date') }} :</span>
                            <span class="block">
                                <span>{{ new Date(post?.created_at).toLocaleDateString() }}</span>
                            </span>
                        </li>
                        <li class="inline-block text-white/50 mx-5">
                            <span class="text-white block">{{ $t('time') }} :</span>
                            <span class="block">
                                <span>{{ post?.time_to_read }} {{ $t('min_read') }}</span>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="absolute text-center z-10 bottom-5 start-0 end-0 mx-3">
                <ul class="tracking-[0.5px] mb-0 inline-block">
                    <li
                        class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out text-white/50 hover:text-white">
                        <router-link to="/">{{ $t('home') }}</router-link>
                    </li>
                    <li class="inline-block text-base text-white/50 mx-0.5 ltr:rotate-0 rtl:rotate-180">
                        <i class="mdi mdi-chevron-right"></i>
                    </li>
                    <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out text-white"
                        aria-current="page">
                        {{ $t('blog_detail') }}
                    </li>
                </ul>
            </div>
        </section>

        <section class="relative md:py-24 py-16">
            <div class="container">
                <div class="grid md:grid-cols-12 grid-cols-1 gap-6">
                    <div class="lg:col-span-8 md:col-span-6">
                        <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-800">
                            <img loading="lazy" :src="post.image" alt="">

                            <div class="p-6">
                                <div v-html="post.content" id="content"></div>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    <Tag v-for="tag in post?.tags" :key="tag.id" :name="tag.name" :type="tag.type" />
                                </div>
                            </div>
                        </div>


                        <!-- <ContactForm /> -->
                    </div>

                    <div class="lg:col-span-4 md:col-span-6">
                        <div class="sticky top-20">
                            <h5
                                class="text-lg font-medium bg-gray-50 dark:bg-slate-800 shadow dark:shadow-gray-800 rounded-md p-2 text-center">
                                {{ $t('author') }}
                            </h5>
                            <div class="text-center mt-8">
                                <img loading="lazy" :src="post?.author?.avatar"
                                    class="h-20 w-20 mx-auto rounded-full shadow mb-4" alt="">

                                <a href=""
                                    class="text-lg font-medium hover:text-primary-500 transition-all duration-500 ease-in-out h5">
                                    {{ post?.author?.name }}
                                </a>
                                <p class="text-slate-400">{{ post?.author?.role }}</p>
                            </div>

                            <h5
                                class="text-lg font-medium bg-gray-50 dark:bg-slate-800 shadow dark:shadow-gray-800 rounded-md p-2 text-center mt-8">
                                {{ $t('social_sites') }}
                            </h5>
                            <ul class="list-none text-center mt-8 space-x-0.5">
                                <li v-for="social in social?.socials" :key="social.url" class="inline">
                                    <Skeleton v-if="isSocialLoading" width="40px" height="40px" />
                                    <a v-else :href="social.url" target="_blank"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle text-base border border-gray-100 dark:border-gray-800 rounded-md text-slate-400 hover:border-red-500 hover:text-white hover:bg-primary-500">
                                        <i :data-feather="social.icon" class="size-4" :title="social.name"></i>
                                    </a>
                                </li>
                            </ul><!--end icon-->
                        </div>
                    </div>
                </div>
            </div>

            <div class="container lg:mt-24 mt-16">
                <div class="grid grid-cols-1 mb-6 text-center">
                    <h3 class="font-semibold text-3xl leading-normal">{{ $t('related_blogs') }}</h3>
                </div><!--end grid-->

                <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-6 pt-6">
                    <div v-for="item in blogs" :key="item" class="group relative overflow-hidden">
                        <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-800">
                            <Skeleton v-if="isLoading" width="100%" height="200px" />
                            <img loading="lazy" v-else :src="item?.image"
                                class="group-hover:scale-110 group-hover:rotate-3 duration-500" alt="">
                        </div>

                        <div class="mt-6">
                            <div class="flex mb-4">
                                <span class="flex items-center text-slate-400 text-sm">
                                    <i data-feather="clock" class="size-4 text-slate-900 dark:text-white me-1.5"></i>
                                    <Skeleton v-if="isLoading" width="50px" height="20px" />
                                    <span v-else>{{ item.time_to_read }} {{ $t('min_read') }}</span>
                                </span>
                                <span class="text-slate-400 text-sm ms-3">
                                    {{ $t('by') }}
                                    <Skeleton v-if="isLoading" width="100px" height="20px" />
                                    <a v-else href=""
                                        class="text-slate-900 dark:text-white hover:text-primary-500 dark:hover:text-primary-500 font-medium">
                                        {{ item.author.name }}
                                    </a>
                                </span>
                            </div>

                            <Skeleton v-if="isLoading" width="200px" height="20px" />
                            <router-link v-else :to="`/post/${item.slug}`"
                                class="text-lg font-medium hover:text-primary-500 duration-500 ease-in-out">
                                {{ item?.title }}
                            </router-link>
                            <p class="text-slate-400 mt-2">{{ item?.category?.name }}</p>

                            <div class="mt-3">
                                <router-link :to="{ name: 'post', params: { slug: item?.slug } }"
                                    class="hover:text-primary-500 inline-flex items-center">{{ $t('read_more') }} <i
                                        data-feather="chevron-right" class="size-4 ms-1"></i></router-link>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </section>
    </GeneralLayout>

</template>
