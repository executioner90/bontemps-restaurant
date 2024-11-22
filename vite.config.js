import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue2';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue(),
    ],
    server: {
        host: 'localhost',
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
            '@': path.resolve(__dirname, 'resources/js'),
        },
    },
});
