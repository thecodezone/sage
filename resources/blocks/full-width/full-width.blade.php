@php

$template = array (
    array( 'core/paragraph', array(
        'content' => 'Add content here',
    )),
);
@endphp

@if ($is_preview)
    <div class="block-preview">
    <label><small>{{ strtoupper($config['title']) }}</small></label>

    @endif

        <div
            id="{{ $config['anchor'] ?? $config['id'] ?? '' }}"
            class="cz-block cz-full-width full-width {{ $outer_padding }}{{ $config['className'] ?? '' }}"
            {!! $attributes !!}
            data-block-id="{{ $config['id'] ?? '' }}" 
            style="{{ $styles }}">
            <div class="{{ $inner_container }}">
                <InnerBlocks  template="{!! esc_attr(wp_json_encode($template)) !!}"  />
            </div>
        </div>

@if ($is_preview)
    </div>
@endif
