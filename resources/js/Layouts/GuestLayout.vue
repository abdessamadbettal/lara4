<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import GeneralLayout from '@/Layouts/GeneralLayout.vue';
</script>

<template>
        <div :dir="$page.props.dir"
            class="flex min-h-screen flex-col items-center  pt-6 sm:justify-center sm:pt-0 rounded-xl"
        >
            <div>
                <Link href="/">
                    <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
                </Link>
            </div>

            <div
                class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg dark:bg-gray-800"
            >
            <slot></slot>
            </div>
        </div>
</template>
