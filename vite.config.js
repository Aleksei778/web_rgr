import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/styles.css',
                'resources/css/news.css',
                'resources/css/stylesprofile.css',
                'resources/css/auth.css',
                'resources/css/app.css',
                'resources/css/property.css',
                'resources/css/requests.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
