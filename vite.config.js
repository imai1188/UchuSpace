import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/dashboard.js', 'resources/js/index-earth.js', 'resources/js/nav-particles.js' ],
            refresh: true,
        }),
    ],
    resolve: {
                    alias: {
                        '@': '/resources/js',
                    },
                },
});