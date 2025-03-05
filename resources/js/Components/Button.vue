<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    isLoading: {
        type: Boolean,
        default: false
    },
    variant: {
        type: String,
        default: 'primary'
    },
    href: {
        type: String,
        default: null
    },
    size: {
        type: String,
        default: 'md',
        validator: (value) => ['xs', 'sm', 'md', 'lg', 'xl'].includes(value)
    },
    iconLeft: {
        type: String,
        default: null
    },
    iconRight: {
        type: String,
        default: null
    },
    fullWidth: {
        type: Boolean,
        default: false
    },
    rounded: {
        type: Boolean,
        default: false
    },
    type: {
        type: String,
        default: 'button'
    },
    disabled: {
        type: Boolean,
        default: false
    },
    external: {
        type: Boolean,
        default: false
    },
    ariaLabel: {
        type: String,
        default: null
    }
});

const buttonSizeClasses = computed(() => {
    switch(props.size) {
        case 'xs': return 'px-2 py-1 text-xs';
        case 'sm': return 'px-3 py-1.5 text-xs';
        case 'lg': return 'px-5 py-2.5 text-base';
        case 'xl': return 'px-6 py-3 text-lg';
        default:   return 'px-4 py-2 text-sm'; // md - default
    }
});

const buttonClasses = computed(() => {
    const baseClasses = 'inline-flex items-center justify-center font-medium tracking-wide transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-60 disabled:cursor-not-allowed';
    const roundedClass = props.rounded ? 'rounded-full' : 'rounded-md';
    const widthClass = props.fullWidth ? 'w-full' : '';
    
    let variantClasses;
    switch (props.variant) {
        case 'danger':
            variantClasses = 'border border-transparent bg-red-600 text-white hover:bg-red-700 focus:ring-red-500 active:bg-red-800 dark:focus:ring-offset-gray-800';
            break;
        case 'success':
            variantClasses = 'border border-transparent bg-green-600 text-white hover:bg-green-700 focus:ring-green-500 active:bg-green-800 dark:focus:ring-offset-gray-800';
            break;
        case 'warning':
            variantClasses = 'border border-transparent bg-yellow-500 text-white hover:bg-yellow-600 focus:ring-yellow-500 active:bg-yellow-700 dark:focus:ring-offset-gray-800';
            break;
        case 'info':
            variantClasses = 'border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500 active:bg-blue-800 dark:focus:ring-offset-gray-800';
            break;
        case 'outline':
            variantClasses = 'border border-gray-300 bg-transparent text-gray-800 hover:bg-gray-50 focus:ring-gray-400 active:bg-gray-100 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-800 dark:focus:ring-offset-gray-800 dark:active:bg-gray-700';
            break;
        case 'secondary':
            variantClasses = 'border border-transparent bg-gray-600 text-white hover:bg-gray-700 focus:ring-gray-500 active:bg-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-offset-gray-800';
            break;
        case 'ghost':
            variantClasses = 'border border-transparent bg-transparent text-gray-700 hover:bg-gray-100 focus:ring-gray-400 active:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-800 dark:focus:ring-offset-gray-800';
            break;
        case 'link':
            variantClasses = 'border-0 bg-transparent text-blue-600 hover:text-blue-800 underline focus:ring-blue-500 dark:text-blue-400 dark:hover:text-blue-300';
            break;
        case 'primary':
        default:
            variantClasses = 'border border-transparent bg-gray-800 text-white hover:bg-gray-700 focus:ring-gray-600 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:ring-offset-gray-800';
            break;
    }

    return [baseClasses, variantClasses, buttonSizeClasses.value, roundedClass, widthClass];
});

const isActuallyDisabled = computed(() => props.disabled || props.isLoading);

const Tag = computed(() => {
    if (props.href) {
        return props.external ? 'a' : Link;
    }
    return 'button';
});

const linkProps = computed(() => {
    if (props.external && props.href) {
        return {
            href: props.href,
            target: "_blank",
            rel: "noopener noreferrer"
        };
    }
    return props.href ? { href: props.href } : {};
});

const buttonProps = computed(() => {
    if (!props.href) {
        return {
            type: props.type,
            disabled: isActuallyDisabled.value
        };
    }
    return {};
});
</script>

<template>
    <component 
        :is="Tag" 
        v-bind="props.href ? linkProps : buttonProps"
        :aria-label="ariaLabel"
        :aria-busy="isLoading"
        :class="[buttonClasses, { 'opacity-75 cursor-wait': isLoading }]"
    >
        <!-- Left Icon -->
        <span v-if="iconLeft && !isLoading" class="mr-2 -ml-1">
            <span class="w-5 h-5" v-html="iconLeft"></span>
        </span>

        <!-- Loading Spinner -->
        <svg 
            v-if="isLoading"
            class="animate-spin -ml-1 mr-2 h-4 w-4" 
            xmlns="http://www.w3.org/2000/svg" 
            fill="none" 
            viewBox="0 0 24 24"
        >
            <circle 
                class="opacity-25" 
                cx="12" 
                cy="12" 
                r="10" 
                stroke="currentColor" 
                stroke-width="4"
            ></circle>
            <path 
                class="opacity-75" 
                fill="currentColor" 
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
            ></path>
        </svg>

        <!-- Button Content -->
        <span>
            <slot v-if="!isLoading" />
            <span v-else>{{ isLoading ? 'Loading...' : '' }}</span>
        </span>

        <!-- Right Icon -->
        <span v-if="iconRight && !isLoading" class="ml-2 -mr-1">
            <span class="w-5 h-5" v-html="iconRight"></span>
        </span>
    </component>
</template>