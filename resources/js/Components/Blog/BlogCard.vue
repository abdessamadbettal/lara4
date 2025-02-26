<template>
    <div class="group relative overflow-hidden">
        <div class="relative overflow-hidden rounded-md shadow dark:shadow-gray-800">
            <img loading="lazy" :src="item.image" class="group-hover:scale-110 group-hover:rotate-3 duration-500" alt="">
            <div class="absolute top-0 start-0 p-4 opacity-0 group-hover:opacity-100 duration-500">
                <span
                    class="bg-primary-500 text-white text-[12px] px-2.5 py-1 font-medium rounded-md h-5">
                     {{ item.category.name }}
                    </span>
            </div>
        </div>

        <div class="mt-6">
            <div class="flex mb-4">
                <span class="flex items-center text-slate-400 text-sm">
                        <Timer class="size-4 text-slate-900 dark:text-white me-1.5" />
                         {{ item.time_to_read }} {{
                    $t('min_read')
                    }}</span>
                <span class="text-slate-400 text-sm ms-3">{{ $t('by') }} <span href="#"
                        class="text-slate-900 dark:text-white font-medium">
                        {{ item.author.name }}
                    </span></span>
                </div>

                <Link :href="route('posts.show', item.slug)"
                class="text-lg text-slate-900 dark:text-white hover:text-primary-500 dark:hover:text-primary-500 font-medium duration-500 ease-in-out cursor-pointer">{{ item.name
                }}</Link>
            <p class="text-slate-400 mt-2">{{ item.excerpt }}
            </p>

            <div class="mt-3">
                <Link :href="route('posts.show', item.slug)"
                    class="hover:text-primary-500 inline-flex items-center cursor-pointer">
                    {{ $t('read_more') }}
                    <ChevronRight class="size-4 ms-1" />
                    </Link>
            </div>
        </div>
    </div>
</template>

<script>
  import { Timer, ChevronRight } from 'lucide-vue-next';
  import { Link } from '@inertiajs/vue3';
export default {
    name: 'BlogCard',
    components: {
        Timer,
        ChevronRight,
        Link
    },
    props: {
        item: {
            type: Object,
            required: true
        }
    }
}
</script>

<style scoped></style>
