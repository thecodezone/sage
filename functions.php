<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

define('WP_AUTOLOAD_BLOCK_TYPES', false);

if (! file_exists($composer = __DIR__.'/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

if (! function_exists('\Roots\bootloader')) {
    wp_die(
        __('You need to install Acorn to use this theme.', 'sage'),
        '',
        [
            'link_url' => 'https://roots.io/acorn/docs/installation/',
            'link_text' => __('Acorn Docs: Installation', 'sage'),
        ]
    );
}

\Roots\bootloader()->boot();

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['setup', 'filters'])
    ->each(function ($file) {
        if (! locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });



// Set Excerpt word count
add_filter( 'excerpt_length', function(){
    return 15;
}, 999 );




function cz_generate_excerpt($text, $query, $length) {

    $words = explode(' ', $text);
    $total_words = count($words);
    $i =null;
    if ($total_words > $length) {

        $queryLow = array_map('strtolower', $query);
        $wordsLow = array_map('strtolower', $words);

        for ($i=0; $i <= $total_words; $i++) {

            foreach ($queryLow as $queryItem) {
                if (is_numeric($i) && isset($wordsLow[$i])) {
                    if (preg_match("/\b$queryItem\b/", $wordsLow[$i])) {
                        $posFound = $i;
                        break;
                    }
                }
            }

            if (isset($posFound)) {
                break;
            }
        }

        if ($i > ($length+($length/2))) {
            $i = $i - ($length/2);
        } else {
            $i = 0;
        }

    }

    $cutword = array_splice($words,$i,$length);
    $excerpt = implode(' ', $cutword);

    $keys = implode('|', $query);
    $excerpt = preg_replace('/(' . $keys .')/iu', '<strong class="search-markup">\0</strong>', $excerpt);
    $excerptRet = '<p>';
    if ($i !== 0) {
        $excerptRet .= '... ';
    }
    $excerptRet .= $excerpt . ' ...</p>';

    return $excerptRet;

}

// Highlight search keyword
function cz_search_excerpt_highlight() {

    # Length in word count
    $excerptLength = 32;

    $text = strip_shortcodes(wp_strip_all_tags( get_the_content()) );

    # Filter double quotes from query. They will
    # work on the results side but won't help with
    # text highlighting and displaying.
    $query=get_search_query(false);
    $query=str_replace('"','',$query);
    $query=esc_html($query);

    $query = explode(' ', $query);

    echo cz_generate_excerpt($text, $query, $excerptLength);

}
