import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import { glob } from 'glob';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/application.min.css',
                'resources/css/datepicker.css',
                'resources/css/myBootstrap.css',
                'resources/css/line-awesome/line-awesome.css',
                ...glob.sync('resources/css/pages/*.css'),
                ...glob.sync('resources/css/pages/*.js'),
                'resources/js/app.js',
                'resources/js/settings.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
