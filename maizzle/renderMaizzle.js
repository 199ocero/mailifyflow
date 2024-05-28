import Maizzle from '@maizzle/framework';
import maizzleConfig from './mailifyflow.config.js';
import tailwindConfig from './tailwind.config.js';

// Extract arguments from the command line
const args = process.argv.slice(2);
const title = args[0];
const preheader = args[1];
const content = args[2];
const bodyClass = args[3];

const html = `---
title: ${ title }
preheader: ${ preheader }
bodyClass: ${ bodyClass }
---

<x-main>
  <div class="font-sans bg-neutral-50 sm:px-4">
    ${ content }
  </div>
</x-main>

`
Maizzle.render(
  html,
  {
    maizzle: maizzleConfig,
    tailwind: {
      css: '@tailwind utilities;',
      config: tailwindConfig,
    },
  }
)
.then(({html}) => {
  process.stdout.write(html);
})
.catch(error => {
  process.stderr.write(error.message);
  process.exit(1);
});