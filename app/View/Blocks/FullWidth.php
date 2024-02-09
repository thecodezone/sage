<?php

namespace App\View\Blocks;

use Illuminate\Support\Str;

/**
 * All public properties are available in the view as {{ $property }}
 * eg {{ $post_id }}
 */
class FullWidth extends Block
{
    public $bgType = '';
    public $bgColor = '';
    public $bgGradientColor1 = '';
    public $bgGradientColor2 = '';
    public $bgGradientAngle = '';
    public $bgImage = '';
    public $bgRepeat = '';
    public $bgPositionX = '';
    public $bgPositionY = '';
    public $bgOverflow = '';
    public $innerContainer = '';
    public $outerPadding = '';
    public $config;

    /**
     * Do anything on block initialization
     * These field values could have also been
     * fetched in the with() method.
     * @return void
     */
    public function init(): void
    {
        $this->bgType = get_field('bg_type');
        $this->bgColor = get_field('bg_color');
        $this->bgGradientColor1 = get_field('bg_gradient_color1');
        $this->bgGradientColor2 = get_field('bg_gradient_color2');
        $this->bgGradientAngle = get_field('bg_gradient_angle');
        $this->bgImage = get_field('bg_image');
        $this->bgRepeat = get_field('bg_repeat');
        $this->bgPositionX = get_field('bg_position_x');
        $this->bgPositionY = get_field('bg_position_y');
        $this->bgOverflow = get_field('bg_overflow');
        $this->innerContainer = get_field('inner_container');
        $this->outerPadding = get_field('outer_padding');
    }

    /**
     * Return any additional data on the view
     * 'classes' could have also been set as
     * a class property in init().
     * @return array
     */
    public function with(): array
    {
        $styles = '';
        if($this->bgType  == 'solid-color') {
            $styles .= 'background-color: ' . $this->bgColor . ';';
        }
        if($this->bgType == 'gradient') {
            $styles .= 'background: linear-gradient(' . $this->bgGradientAngle . 'deg, ' . $this->bgGradientColor1 . ' 0%, ' . $this->bgGradientColor2 . ' 100%);';
        }
        if($this->bgType == 'background-image') {
            $styles .= 'background-image: url(' . $this->bgImage . ');';
            $styles .= 'background-repeat: ' . $this->bgRepeat . ';';
            $styles .= 'background-position-x: ' . $this->bgPositionX . ';';
            $styles .= 'background-position-y: ' . $this->bgPositionY . ';';
        }
        if($this->bgOverflow  == 'hidden') {
            $styles .= 'overflow: hidden; padding: 0;';
        }

        return [
            'styles' => $styles,
            'inner_container' => ( !isset($this->innerContainer) || $this->innerContainer ) ? 'container mx-auto' : '',
            'outer_padding' => $this->outerPadding ? 'py-10' : '',
        ];
    }
}
