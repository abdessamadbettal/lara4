import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                tajawal: ['Tajawal', 'serif'],
            },
            borderRadius: {
                'ss-xl': '1.5rem',
                'ee-xl': '1.5rem',
              },
            colors: {
                primary: {
                    '100': '#ffefc6',
                    '200': '#ffdf88',
                    '300': '#fec84b',
                    '400': '#feb326',
                    '500': '#f88f08',
                    '600': '#dc6803',
                    '700': '#b64707',
                    '800': '#94370c',
                    '900': '#792e0e',
                },
            },
        },
    },
    plugins: [forms],
    //
};
