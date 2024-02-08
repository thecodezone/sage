<?php

namespace App\View\Blocks;

use App\Services\Blocks;

abstract class Block
{
    public $config = [];
    public $content = '';
    public $is_preview = false;
    public $post_id = 0;
    public $wp_block = false;
    public $block = null;
    public $context = false;
    public $name = "";

    public $attributes = '';
    private $service;

    public function __construct(
        array $config = [],
        string $content = '',
        bool $is_preview = false,
        int $post_id = 0,
        $block = false,
        $context = false,
        Blocks $service = null
    ) {
        $this->config     = $config;
        $this->content    = $content;
        $this->is_preview = $is_preview;
        $this->post_id    = $post_id;
        $this->block      = $block;
        $this->context    = $context;
        $this->service    = $service;
        $this->name       = $this->service->normalizeName($this->config['name']);
        $this->template   = $this->service->blockTemplate($this->name);
        $this->attributes = 'data-block="' . $config["name"] . '"';

        $this->init();
    }

    /**
     * Do anything on block initialization
     * @return void
     */
    public function init(): void
    {
    }

    /**
     * Get all the public properties
     * of the class as an array
     * to pass to the view.
     * @return array
     */
    public function properties()
    {
        return get_object_vars($this);
    }

    /**
     * Return any additional data on the view
     * @return array
     */
    public function with(): array
    {
        return [];
    }

    /**
     * Render the block HTML
     * @return mixed
     */
    public function render()
    {
        echo $this->view(
            $this->template,
            $this->properties(),
            $this->with()
        )->render();
    }

    /**
     * Get the evaluated view contents for the given view.
     *
     * @param string|null $view
     * @param Arrayable|array $data
     * @param array $mergeData
     *
     * @return View|Factory
     */
    public function view($view = null, $data = [], $mergeData = [])
    {
        return view($view, $data, $mergeData);
    }
}
