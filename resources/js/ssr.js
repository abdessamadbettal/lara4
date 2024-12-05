import { createInertiaApp } from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import { renderToString } from '@vue/server-renderer';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createSSRApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import i18n, { setLocale } from '@/i18n';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel Starter';

createServer((page) =>
    createInertiaApp({
        page,
        render: renderToString,
        title: (title) => `${title} - ${appName}`,
        resolve: (name) =>
            resolvePageComponent(
                `./Pages/${name}.vue`,
                import.meta.glob('./Pages/**/*.vue'),
            ),
        setup({ App, props, plugin }) {
            // Set locale dynamically from page props
            const currentLocale = props.initialPage.props.currentLocale || 'fr';
            setLocale(currentLocale);

            return createSSRApp({ render: () => h(App, props) })
                .use(i18n) // Add i18n to the SSR app
                .use(plugin) // Add Inertia plugin
                .use(ZiggyVue, {
                    ...page.props.ziggy,
                    location: new URL(page.props.ziggy.location),
                });
        },
    }),
);
