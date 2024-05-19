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

export default {
    env: 'production',
    build: {
        tailwind: {
            css: './maizzle/src/css/tailwind.css',
            config: './maizzle/tailwind.config.js',
            compiled: ''
        },
        components: {
            folders: ['./maizzle/src/components', './maizzle/src/templates', './maizzle/src/layouts'],
        },
        layouts: {
            root: './maizzle/src/layouts',
        },
    },
    inlineCSS: {
        attributeToStyle: true,
        styleToAttribute: {
            'background-color': 'bgcolor',
        },
        applyWidthAttributes: ['table', 'td', 'th']
    },
    removeUnusedCSS: true,
    prettify: true,
    minify: true,
    shorthandCSS: true,
    safeClassNames: true,
    sixHex: true
}
  