import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import swc from 'vite-plugin-swc';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        swc(),
    ],
});
