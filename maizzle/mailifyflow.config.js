/** @type {import('@maizzle/framework').Config} */

/*
|-------------------------------------------------------------------------------
| Production config                       https://maizzle.com/docs/environments
|-------------------------------------------------------------------------------
|
| This is where you define settings that optimize your emails for production.
| These will be merged on top of the base config.js, so you only need to
| specify the options that are changing.
|
*/

import path from 'path'; // for Node.js environment

// Dynamically get root path based on environment
let rootPath;
if (typeof window === 'undefined') {
    // Node.js environment
    const fileURL = import.meta.url;
    rootPath = path.dirname(new URL(fileURL).pathname);
} else {
    // Browser environment
    rootPath = window.location.origin;
}

export default {
    env: 'production',
    build: {
        components: {
            folders: [
                `${rootPath}/src/components`,
                `${rootPath}/src/templates`,
                `${rootPath}/src/layouts`
            ],
        },
        layouts: {
            root: `${rootPath}/src/layouts`,
        },
        posthtml: {
            options: {
                directives: [
                { name: '?php', start: '<', end: '>' }
                ]
            }
        }
    },
    inlineCSS: {
        styleToAttribute: {
            'background-color': 'bgcolor',
        },
        applyWidthAttributes: ['table', 'td', 'th'],
        applyHeightAttributes: ['table', 'td', 'th']
    },
    removeUnusedCSS: true,
    prettify: true,
    minify: true,
    shorthandCSS: true,
    safeClassNames: true,
    sixHex: true
}
  