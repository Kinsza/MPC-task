<?php

define( 'miyovite_VERSION', wp_get_theme()->version );
define( 'miyovite_DIR', __DIR__ );
define( 'miyovite_URL', get_template_directory_uri() );

foreach(glob( __DIR__ .'/srcwp/*.php') as $file) {
    include_once $file;
}