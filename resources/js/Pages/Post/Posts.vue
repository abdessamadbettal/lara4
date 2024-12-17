<template>
    <GeneralLayout>
        <Head title="All Posts" />
        <section class="relative md:py-24 py-16">
            <div class="container relative">
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
                        <BlogCard v-for="post in posts.data" :key="post.id" :item="post" />
                </template>
                </div>
            </div>
        </section>
    </GeneralLayout>
    <Pagination class="mt-6" :meta="posts.meta" />


</template>
<script>
import { Head, Link } from '@inertiajs/vue3';
import BlogCard from '@/Components/Blog/BlogCard.vue';
import Pagination from '@/Components/Pagination.vue';
import GeneralLayout from '@/Layouts/GeneralLayout.vue';
export default {
    name: 'Posts',
    components: {
        BlogCard,
        Pagination,
        Head,
        GeneralLayout
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
    },
    methods: {
        scrollToTop() {
            window.scrollTo(0, 0);
        }
    }
}
</script>
