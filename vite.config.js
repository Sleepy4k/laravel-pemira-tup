import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import FastGlob from 'fast-glob';

export default defineConfig({
    plugins: [
        laravel({
            input: FastGlob.sync([
                'resources/css/app.css',
                'resources/js/app.js',

                'resources/css/**/*.css',
                'resources/js/**/*.js',
            ], { dot: false }),
            refresh: true,
        }),
        tailwindcss({
            optimize: {
                minify: true,
            }
        }),
    ],
    optimizeDeps: {
        force: true,
    },
    build: {
        manifest: 'build-manifest.json',
        outDir: 'public/assets',
        assetsDir: 'bundle',
        chunkSizeWarningLimit: 600,
        rollupOptions: {
            output: {
                manualChunks: {
                    axios: ['axios'],
                    apexcharts: ['apexcharts'],
                    datatables: ['datatables.net', 'datatables.net-dt'],
                    datatables_buttons: ['datatables.net-buttons', 'datatables.net-buttons-dt', 'datatables.net-buttons/js/buttons.html5.js', 'datatables.net-buttons/js/buttons.print.js'],
                    datatables_responsive: ['datatables.net-responsive', 'datatables.net-responsive-dt'],
                }
            },
        },
    },
});
