<?php

namespace App\Services;

use App\View\Blocks\GenericBlock;
use Illuminate\Support\Str;

class Blocks
{
    /**
     * Get all the blocks
     * @return array
     */
    public function blockPaths(): array
    {
        return array_filter(glob(stripslashes(base_path('/resources/blocks/*'))), 'is_dir');
    }

    /**
     * Get all the block names
     * @return array
     */
    public function blocks(): array
    {
        return array_map(function ($path) {
            return basename($path);
        }, $this->blockPaths());
    }

    /**
     * Register all block folders
     */
    public function registerBlocks(): void
    {
        foreach ($this->blocks() as $block) {
            $this->registerBlock(
                $block
            );
        }
    }

    /**
     * Stripe everything before the slash
     * @return void
     */
    public function normalizeName(string $name): string
    {
        return Str::after($name, '/');
    }

    /**
     * Render a block
     *
     * @param array $config
     * @param string $content
     * @param bool $is_preview
     * @param int $post_id
     * @param $block
     * @param $context
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function render(
        array $config = [],
        string $content = '',
        bool $is_preview = false,
        int $post_id = 0,
        $block = false,
        $context = false
    ) {
        do_action('cz_block_render', $config['name'], $is_preview);

        $name = $this->normalizeName($config['name']);

        $namespace = $this->blockHasClass($name) ? $this->blockNamespace($name) : GenericBlock::class;
        $block = app()->make($namespace, [
            'config' => $config,
            'content' => $content,
            'is_preview' => $is_preview,
            'post_id' => $post_id,
            'block' => $block,
            'context' => $context,
        ]);

        $block->render();

        do_action('cz_block_rendered', $config['name'], $is_preview);
    }

    /**
     * Check if a block folder has a block.json file
     */
    public function blockHasJson(string $name): bool
    {
        return !!cz_block_path($name . '/block.json');
    }

    /**
     * Get the namespace of a block.
     *
     * @param string $name
     * @return string
     */
    public function blockNamespace(string $name): string
    {
        return 'App\\View\\Blocks\\' . Str::studly($name);
    }

    /**
     * Check if a block has a class
     */
    public function blockHasClass(string $name): bool
    {
        return class_exists(
            $this->blockNamespace($name)
        );
    }

    /**
     * Return the block view
     */
    public function blockTemplate(string $name): string
    {
        $name = $this->normalizeName($name);
        return 'blocks::' . $this->normalizeName($name) . '.' . $name;
    }

    /**
     * Return the template for a block
     * @param string $name
     * @return string
     */
    public function blockView(string $name): string
    {
        return $this->blockTemplate($name);
    }

    /**
     * Register a block folder
     */
    public function registerBlock(string $name): void
    {
        if (!$this->blockHasJson($name)) {
            return;
        }

        register_block_type(cz_block_path($name . '/block.json'), [
            "style" => "cz-blocks-style",
        ]);
    }
}
