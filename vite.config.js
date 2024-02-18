import { defineConfig } from 'vite';
import leaf from '@leafphp/vite-plugin';

export default defineConfig(({ command, mode, isSsrBuild, isPreview }) => {
  if (command === 'serve') {
    // Development mode
    return {
      plugins: [
        leaf({
          input: ['app/views/js/app.js', 'app/views/css/app.css'],
          refresh: true,
        }),
      ],
    }
  } else {
    // Production mode
    return {
      build: {
        outDir: "./app/build/build",
      },
      plugins: [
        leaf({
          input: ['app/views/js/app.js', 'app/views/css/app.css'],
          refresh: true,
        }),
      ],
    }
  }
});
