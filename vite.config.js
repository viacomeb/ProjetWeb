import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';
import { readdirSync } from 'fs';
import { resolve } from 'path';

export default defineConfig({
  server: {
    https: true,
    host: 'workngo.westeurope.cloudapp.azure.com',
    strictPort: true,
    port: 5173,
    hmr: {
      protocol: 'wss',
      host: 'workngo.westeurope.cloudapp.azure.com',
    },
  },
  plugins: [
    laravel({
      input: [
        'resources/css/admin_dashboard.css',
        'resources/css/dashboard.css',
        'resources/css/home.css',
        'resources/css/login.css',
        'resources/css/style.css',
        'resources/js/admin_dashboard.js',
        'resources/js/app.js',
        'resources/js/auth.js',
        'resources/js/dashboard.js',
      ],
      refresh: true,
    }),
    tailwindcss(),
    vue(),
  ],
  build: {
    outDir: 'public/build', // Définir le dossier de sortie
    assetsDir: 'assets', // Définir où les assets seront stockés
  },
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources/js'),
    },
  },
});
