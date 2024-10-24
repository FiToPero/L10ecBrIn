import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    server: {
        host: '0.0.0.0',  // Asegura que Vite esté disponible en todo el contenedor
        port: 5173,
        hmr: {
            host: 'localhost',
        },
        watch: {
            usePolling: true,  // Usa polling para vigilar los cambios en archivos dentro del contenedor
        },
    },
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
