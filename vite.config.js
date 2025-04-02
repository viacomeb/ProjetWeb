import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';
import { readdirSync } from 'fs';
import { resolve } from 'path';

// Fonction pour récupérer tous les fichiers d'un répertoire avec une extension donnée
function getFiles(dir, ext) {
  return readdirSync(resolve(__dirname, dir))
    .filter((file) => file.endsWith(ext))
    .map((file) => `${dir}/${file}`);
}

export default defineConfig({
  plugins: [
    laravel({
      input: [
        ...getFiles('resources/css', '.css'),
        ...getFiles('resources/js', '.js'),
      ],
      refresh: true,
    }),
    tailwindcss(),
    vue(),
  ],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources/js'),
    },
  },
});
