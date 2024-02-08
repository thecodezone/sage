<?php

namespace App\View;

use Illuminate\View\Factory;

class ViewFactory extends Factory
{
    /**
     * Adding support for some additional extensions needed for blocks.
     *
     * @var array
     */
    protected $extensions = [
        'blade.php' => 'blade',
        'php' => 'php',
        'css' => 'file',
        'html' => 'file',
        'scss' => 'file',
        'js' => 'file',
    ];
}
