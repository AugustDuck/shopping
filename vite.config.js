import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/js/admin/admin-user.js',
                'resources/js/admin/admin-dashboard.js',
                'resources/js/client/client-home.js',
                'resources/js/client/client-profile.js',
                'resources/js/utils/get-api-address.js',
                'resources/js/utils/check-phone.js'
            ],
            refresh: true,
        }),
    ],
});
