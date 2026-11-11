<?php

// CPT TAXONOMY

include( 'configure/cpt-taxonomy.php' );

// Utilities

include( 'configure/utilities.php' );

// CONFIG

include( 'configure/configure.php' );

// EDITOR

include( 'configure/editor.php' );

// JAVASCRIPT & CSS

include( 'configure/js-css.php' );

// SHORTCODES

include( 'configure/shortcodes.php' );

// ACF

include( 'configure/acf.php' );

// PLUGIN SETUP

include( 'configure/plugins.php' );

// HOOKS ADMIN

if(is_admin()) {
	include( 'configure/admin.php' );
}

/**
 * LA Junta Archive — Discover Artists Filters
 */

function la_junta_enqueue_artist_filters() {

    if (!is_page('discover-artists')) {
        return;
    }

    $script = 'assets/js/discover-artists.js';
    $script_path = get_theme_file_path($script);

    if (!file_exists($script_path)) {
        return;
    }

    wp_enqueue_script(
        'la-junta-artist-filters',
        get_theme_file_uri($script),
        [],
        (string) filemtime($script_path),
        [
            'in_footer' => true,
            'strategy'  => 'defer',
        ]
    );
}

add_action(
    'wp_enqueue_scripts',
    'la_junta_enqueue_artist_filters'
);
