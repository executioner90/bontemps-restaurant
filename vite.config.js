import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue2';

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
        },
    },
});
