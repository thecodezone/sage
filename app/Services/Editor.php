<?php

namespace App\Services;

/**
 * Block editor service
 */
class Editor
{
    protected array $blacklist = [
        'locations'
    ];

    public function __construct()
    {
        add_filter('use_block_editor_for_post_type', [$this, 'disable'], 10, 2);
    }

    /**
     * Disable the block editor
     * @param $can_edit
     * @param $post_type
     * @return bool
     */
    public function disable($can_edit, $post_type): bool
    {
        if (in_array($post_type, $this->blacklist)) {
            return false;
        }

        return $can_edit;
    }
}
