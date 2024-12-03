import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import GeneralLayout from '@/Layouts/GeneralLayout.vue';
import { i18nVue } from 'laravel-vue-i18n'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const page = resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'));
        page.then((module) => {
            if (!module.default.layout) {
                module.default.layout = GeneralLayout;
            }
        });
        return page;
    },

    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(i18nVue, {
                lang: 'en',
                resolve: lang => require(`../../lang/${lang}.json`),
            })
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
