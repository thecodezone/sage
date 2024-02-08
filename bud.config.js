import {bud} from '@roots/bud'


/**
 * Development server settings
 *
 * @see {@link https://bud.js.org/docs/bud.setUrl}
 * @see {@link https://bud.js.org/docs/bud.setProxyUrl}
 * @see {@link https://bud.js.org/docs/bud.watch}
 */
bud
    .setUrl('http://localhost:3000')
    .setProxyUrl('https://sage-starter.ddev.site')
    .watch(['resources/views', 'app', 'blocks']);

/**
 * Configuration which runs multiple instances of bud.
 *
 * Each can be uniquely configured.
 * ```
 */
await Promise.all([
    /**
     * Make `theme` workspace in `./theme` and setup entrypoints
     * Files will be output to `./public`
     */
    bud.make({
            label: 'theme',
            basedir: bud.path('.'),
            dependsOn: []
        }, async theme =>
            theme
                .setPublicPath( '/wp-content/themes/sage/public')
                .alias('@blocks', bud.path('resources/blocks'))
                .entry('editor', ['@scripts/editor', '@styles/editor'])
                .entry('app', ['@scripts/app', '@styles/app'])
                .assets(['images'])
    ),
])


/**
 * Generate WordPress `theme.json`
 *
 * @note This overwrites `theme.json` on every build.
 *
 * @see {@link https://bud.js.org/extensions/sage/theme.json}
 * @see {@link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json}
 */
bud.wpjson
    .set('settings.color.custom', false)
    .set('settings.color.customDuotone', false)
    .set('settings.color.customGradient', false)
    .set('settings.color.defaultDuotone', false)
    .set('settings.color.defaultGradients', false)
    .set('settings.color.defaultPalette', false)
    .set('settings.color.duotone', [])
    .set('settings.custom.spacing', {})
    .set('settings.custom.typography.font-size', {})
    .set('settings.custom.typography.line-height', {})
    .set('settings.spacing.padding', true)
    .set('settings.spacing.units', ['px', '%', 'em', 'rem', 'vw', 'vh'])
    .set('settings.typography.customFontSize', false)
    .useTailwindColors()
    .useTailwindFontFamily()
    .useTailwindFontSize()
    .enable();
