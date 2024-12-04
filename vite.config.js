import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/style_admin.scss', 
                'resources/css/style_main.scss', 
                'resources/css/template_admin.css', 

                'resources/js/app_admin.js',
                'resources/js/app_main.js',
                'resources/js/template_admin.js'
            
            ],
            refresh: true,
        }),
    ],
});
