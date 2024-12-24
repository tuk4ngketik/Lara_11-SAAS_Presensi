import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js', 
                'resources/js/hr.js',
                'resources/js/don-maps.js',
                'resources/js/upload-base64.js',
            ],
            refresh: true,
        }),
    ],
});
