<?php

/**
 * Define constants
 */

define( 'THEME_URI', get_template_directory_uri() );
define( 'THEME_DIR', get_template_directory() );

// innc theme init
require THEME_DIR . '/lib/init/theme-support.php';
require THEME_DIR . '/lib/init/assets.php';
require THEME_DIR . '/lib/init/custom-post-types.php';
require THEME_DIR . '/lib/init/taxonomies.php';
require THEME_DIR . '/lib/init/navigation.php';
require THEME_DIR . '/lib/init/actions-filters.php';

// metaboxes
require THEME_DIR . '/lib/meta-boxes/meta-boxes.php';

//functions
require THEME_DIR . '/lib/helpers.php';

// modules
require THEME_DIR . '/lib/modules/program.php';
require THEME_DIR . '/lib/modules/speakers.php';
require THEME_DIR . '/lib/modules/video.php';
require THEME_DIR . '/lib/modules/photos.php';
