<script setup>
import { ref } from "vue"
import Container from "@/Components/Container.vue"
import Logo from "@/Components/Icons/Logo.vue"
import IconBars from "@/Components/Icons/IconBars.vue"
import IconX from "@/Components/Icons/IconX.vue"
import Button from "@/Components/Button.vue"
import { Transition } from "vue"
import { Link } from '@inertiajs/vue3';
import ThemeSwitcher from "@/Components/ThemeSwitcher.vue"

const props = defineProps({
    menuItems: {
        type: Array,
        required: true,
        default: () => []
    },
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
})



const showMobileMenu = ref(false)

function redirect(link) {
    showMobileMenu.value = false
    window.location = link
}
</script>
<template>
    <header class=" py-6 md:py-10 sticky top-0 z-10 ">
        <Container class="relative flex items-center justify-between gap-4 text-slate-600 text-sm">

            <div class="flex items-center gap-8">
                <Link :href="route('welcome')">
                    <Logo class="h-10" />
                </Link>
                <nav class="items-center gap-3 hidden md:flex">
                    <a v-for="menu in menuItems" :key="menu.label" v-text="menu.label" :href="menu.link"
                        class="rounded-lg py-1.5 px-3 transition-colors duration-300 hover:bg-red-200 font-bold text-red-900 hover:bg-opacity-30" />
                </nav>
            </div>

            <div class="flex items-center gap-4">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Dashboard
                </Link>

                <template v-else>
                    <ThemeSwitcher />
                    <!-- <Button variant="outline" :href="route('login')" class="hidden md:inline" v-if="canLogin">
                        Login
                    </Button> -->

                    <Button :href="route('register')" v-if="canRegister">
                        Register <span v-text="'now'" class="hidden lg:inline pl-1" />
                    </Button>
                </template>

                <!-- MOBILE MENU -->
                <div class="md:hidden">
                    <button class="p-2 md:hidden relative z-10" @click.prevent="showMobileMenu = !showMobileMenu">
                        <component :is="showMobileMenu ? IconX : IconBars" class="w-5"
                            :class="{ 'text-red-500': showMobileMenu }" />
                    </button>

                    <Transition enter-from-class="opacity-0" leave-to-class="opacity-0"
                        class="transition-opacity duration-500">
                        <div v-show="showMobileMenu" @click.prevent="showMobileMenu = false"
                            class="fixed inset-0 bg-slate-200/50 backdrop-blur-sm" />
                    </Transition>

                    <Transition enter-from-class="-translate-x-full opacity-0"
                        leave-to-class="-translate-x-full opacity-0" class="transition-all duration-500">
                        <div @click.stop v-show="showMobileMenu"
                            class="p-4 absolute inset-x-4 top-14 bg-white rounded-xl shadow-lg">
                            <nav class="flex flex-col">
                                <button v-for="menu in menuItems" :key="menu.label" v-text="menu.label"
                                    @click.prevent="redirect(menu.link)"
                                    class="p-4 hover:bg-slate-100 rounded-lg text-left" />
                                <hr class="my-2" />
                                <Link class="p-4 hover:bg-slate-100 rounded-lg text-left" :href="route('login')"
                                    v-if="canLogin && !$page.props.auth.user">
                                Login
                                </Link>
                            </nav>
                        </div>
                    </Transition>
                </div>
            </div>
        </Container>
    </header>
</template>
