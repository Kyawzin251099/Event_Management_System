import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';
import path from 'path'

export default defineConfig({
    plugins: [
        laravel({
           input: ["resources/css/app.scss",'resources/js/app.js','resources/js/bootstrap.js'],
           refresh: true,
        }),
    ]
});