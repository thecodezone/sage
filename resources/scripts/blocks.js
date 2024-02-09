
/**
 * Do whatever we need tgo do to setup each block
 */
export default function() {
    /**
     * For each instance of the show hide block,
     * dynamically import the block's JS and CSS
     */
    onBlock('cz/show-hide', async (el) => {
        import("@blocks/show-hide/show-hide.scss");
        const {block} = await import("@blocks/show-hide/show-hide.js");
        block(el);
    });

    //cz full-width
    onBlock('cz/full-width', async (el) => {
        import("@blocks/full-width/full-width.scss");
        const {block} = await import("@blocks/full-width/full-width.js");
        block(el);
    });
}

/**
 * Do whatever we need to do when a block is added or updated in the editor
 * @param name
 * @param callback
 */
export function onBlock (name, callback) {
    onRender(name, callback);
    onPreview(name, callback);
}


/**
 * Call a function for each instance of a block on a page
 * @param name
 * @param callback
 */
export function onRender(name, callback) {
    if (window.acf) {
        return;
    }
    document.querySelectorAll(`[data-block="${name}"]`)
        .forEach((el) => callback(el));
}

/**
 * Do whatever we need to do when a block is added or updated in the editor
 * @param name
 * @param callback
 */
export function onPreview (name, callback) {
    if (!window.acf) {
        return;
    }
    window.acf.addAction(`render_block_preview/type=${name}`, (block) => {
        callback(block[0])
    })
}
