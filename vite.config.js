import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';
import { readdirSync } from 'fs';
import { resolve } from 'path';

export default defineConfig({
  base: './', // Utiliser un chemin relatif pour les assets
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
    rollupOptions: {
      output: {
        assetFileNames: 'assets/[name].[hash][extname]', // Organiser les assets
        chunkFileNames: 'assets/[name].[hash].js',
        entryFileNames: 'assets/[name].[hash].js',
      },
    },
  },
});
