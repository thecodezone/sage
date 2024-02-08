<?php

namespace App\View\Blocks;

use Illuminate\Support\Str;

/**
 * All public properties are available in the view as {{ $property }}
 * eg {{ $post_id }}
 */
class ShowHide extends Block
{
    public $config = [];
    public $content = '';
    public $is_preview = false;
    public $post_id = 0;
    public $wp_block = false;
    public $block = null;
    public $context = false;
    public $name = '';
    public $attributes = '';
    public $small = '';
    public $medium = '';
    public $large = '';
    public $xlarge = '';


    /**
     * Do anything on block initialization
     * These field values could have also been
     * fetched in the with() method.
     * @return void
     */
    public function init(): void
    {
        $this->small  = get_field('viewport_small');
        $this->medium = get_field('viewport_medium');
        $this->large  = get_field('viewport_large');
        $this->xlarge = get_field('viewport_xlarge');
    }

    /**
     * Return any additional data on the view
     * 'classes' could have also been set as
     * a class property in init().
     * @return array
     */
    public function with(): array
    {
        $classes = [ 'show-hide' ];

        if ($this->is_preview) {
            if (! $this->small) {
                $classes[] = 'max-sm:opacity-50';
            }

            if (! $this->medium) {
                $classes[] = 'md:opacity-50';
            }

            if (! $this->large) {
                $classes[] = 'lg:opacity-50';
            }

            if (! $this->xlarge) {
                $classes[] = 'xl:opacity-50';
            }
        } else {
            if (! $this->small) {
                $classes[] = 'max-sm:hidden';
            }

            if (! $this->medium) {
                $classes[] = 'md:hidden';
            }

            if (! $this->large) {
                $classes[] = 'lg:hidden';
            }

            if (! $this->xlarge) {
                $classes[] = 'xl:hidden';
            }
        }


        return [
            'classes' => implode(" ", $classes),
        ];
    }
}
