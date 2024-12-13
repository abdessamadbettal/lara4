<template>
    <div class="container relative md:mt-24 mt-16">
        <div class="grid grid-cols-1 pb-6 text-center">
            <h3 class="mb-6 md:text-3xl text-2xl md:leading-normal leading-normal font-semibold">{{ $t('home.latest_blogs')
                }}</h3>

            <p class="text-slate-400 max-w-xl mx-auto">{{ $t('home.latest_blogs_text') }}</p>
        </div>

        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 mt-6 gap-6">
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
            <BlogCard v-else v-for="item in posts" :key="item.id" :item="item" />
        </div>
        <div class="mt-6 text-center">
            <Link :href="route('posts.index')" class="text-slate-400 hover:text-primary-500 inline-block cursor-pointer">{{ $t('home.see_more_posts') }}
                <i class="mdi mdi-arrow-right align-middle"></i></Link>
        </div>
    </div>
</template>

<script>
import BlogCard from '@/Components/Blog/BlogCard.vue';
import { Link } from '@inertiajs/vue3';

export default {
    name: 'BlogSection',
    components: {
        BlogCard,
        Link
    },
    props: {
        posts: {
            type: Array,
            required: true
        },
        isLoading: {
            type: Boolean,
            default: false
        }
    }
}
</script>

<style scoped></style>
