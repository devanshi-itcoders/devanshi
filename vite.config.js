import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    plugins: [
      // viteStaticCopy({
      //   targets: [
      //     {
      //       src: 'resources/images',
      //       dest: 'bundle'
      //     }
      //   ]
      // }),
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/sass/senang.scss',
                'resources/sass/senang_order.scss',
                'resources/sass/wizard.scss',
                'resources/plugins/richtexteditor/rte_theme_default.css',
                'resources/js/app.js',
                'resources/js/qrcode.min.js',
                'resources/js/senang.js',
                'resources/js/senang_order.js',
                // 'resources/plugins/richtexteditor/rte.js',
                // 'resources/plugins/richtexteditor/plugins/all_plugins.js'
            ],
            refresh: true,
        }),
    ],
});
