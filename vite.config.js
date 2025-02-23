import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',],
            refresh: true,
        }),
        vue(),
    ],
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: '@import "@/resources/css/app.scss";'
            }
        }
    },
    resolve: {
        alias: {
            '@': __dirname + '/resources/js',
        },
    }
});
