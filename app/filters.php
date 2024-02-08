<?php

/**
 * Theme filters.
 */

namespace App;

use App\Services\Editor;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return '&hellip;';
});

add_action('after_setup_theme', function () {
    new Editor();
});
