import domReady from '@roots/sage/client/dom-ready';
import initBlocks from "@scripts/blocks.js";

/**
 * Application entrypoint
 */
domReady(async () => {
    initBlocks();
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
