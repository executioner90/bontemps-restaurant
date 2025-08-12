import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue2';
import { resolve } from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue(),
    ],
    server: {
        host: 'localhost',
        watch: {
            ignored: [
                '**/vendor/**',
                '**/node_modules/**'
            ],
        },
    },
    build: {
        sourcemap: true,
        rollupOptions: {
            output: {
                format: 'esm',
                sourcemap: true, // Enable sourcemaps for output files
            },
        }
    },
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm.js',
            '@': resolve(__dirname, 'resources/js'),
        },
    },
});
