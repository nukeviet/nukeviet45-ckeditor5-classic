import { build } from 'vite';
import terser from '@rollup/plugin-terser';
import BannerInjection from 'vite-plugin-banner-injection';
import fs from 'fs';
import path from 'path';

const year = new Date().getFullYear();
const CK_BANNER = `/**
 * @license Copyright (c) 2003-${year}, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-licensing-options
 *
 * This package is built for use with NukeViet CMS.
 * For more information, please visit https://github.com/nukeviet/nukeviet45-ckeditor5-classic
 */
`;

async function run() {
  // Build Ckeditor
  await build({
    build: {
      lib: {
        entry: './src/main.js',
        name: 'ClassicEditor',
        fileName: () => 'ckeditor.js',
        formats: ['umd']
      },
      rollupOptions: {
        plugins: [
          terser({
            format: {
              comments: false
            }
          }),
          BannerInjection({
            banner: CK_BANNER
          })
        ]
      }
    }
  });

  // Build ngôn ngữ
  const dir = './src/translations';
  for (const file of fs.readdirSync(dir)) {
    if (file.endsWith('.js')) {
      await build({
        build: {
          outDir: 'dist/language',
          emptyOutDir: false,
          rollupOptions: {
            input: path.join(dir, file),
            output: {
              format: 'umd',
              entryFileNames: file
            },
            plugins: [
              terser({
                format: {
                  comments: false
                }
              }),
              BannerInjection({
                banner: CK_BANNER
              })
            ]
          },
        },
      });
    }
  }
}

run();
