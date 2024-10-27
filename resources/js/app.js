import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { createPinia, storeToRefs } from 'pinia'
import { useLoginStore } from '@/stores/useLoginStore'
import { createI18n } from "vue-i18n"
import EN from '../../lang/en.json'
import ES from '../../lang/es.json'
import IT from '../../lang/it.json'

// const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

const pinia = createPinia()

const i18n = createI18n({
    legacy: false,
    locale: 'en',
    messages: {
        en: EN,
        es: ES,
        it: IT,
    }
})

createInertiaApp({
    title: (title) => `${title}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(pinia)
            .use(i18n)

        const storeLogin = useLoginStore()
        const { localeLang } = storeToRefs(storeLogin)
        i18n.global.locale.value = localeLang.value

        app.mount(el)
    },
    progress: {
        color: '#4B5563',
    },
})


