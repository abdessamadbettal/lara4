import { createI18n } from 'vue-i18n';
import translations from './i18n/locales';

const i18n = createI18n({
    locale: 'en', // Default locale
    fallbackLocale: 'en',
    messages: translations,
});

export const setLocale = (locale) => {
    console.log('setLocale', locale);
    if (translations[locale]) {
        i18n.global.locale = locale;
    } else {
        console.error(`Locale ${locale} not found.`);
    }
};

export default i18n;
