<?php

/**
 * Load Languages
 */


/**
 * Include Vafpress Framework
 */
require_once 'vafpress-framework/bootstrap.php';

/**
 * Include Custom Data Sources
 */


/**
 * Load options, metaboxes, and shortcode generator array templates.
 */

// options

// metaboxes
$tmpl_mb1  = plugin_dir_path( __FILE__ ) . '/admin/metabox/wcbox_meta.php';
$tmpl_mb8  = plugin_dir_path( __FILE__ ) . '/admin/metabox/wcbox_meta_side.php';


/**
 * Create instance of Options
 */


/**
 * Create instances of Metaboxes
 */
$mb1 = new VP_Metabox($tmpl_mb1);
$mb8 = new VP_Metabox($tmpl_mb8);



/*
 * EOF
 */