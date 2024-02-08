<?php

use App\Services\Blocks;

function cz_render_block(
    array $config = [],
    string $content = '',
    bool $is_preview = false,
    int $post_id = 0,
    $block = false,
    $context = false
)
{
    $service = app(Blocks::class);
    $service->render($config, $content, $is_preview, $post_id, $block, $context);
}

function cz_block_path( $block = null ): string|bool {
    $parts = [
        'resources/blocks',
        $block,
    ];
    return base_path(implode('/', $parts));
}

function cz_block_url( $block = null ): string|bool {
    $parts = [
        'resources/blocks',
        $block,
    ];
    return app_url(implode('/', $parts));
}

/*
 *
 * check to make sure ACF is enabled
 *
 */
function cz_acf_is_on(){
    if (class_exists('ACF')) {
        return true;
    }
    return false;
}


