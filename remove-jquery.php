<?php
/**
 * Plugin Name:       Remove jQuery
 * Plugin URI:        https://github.com/jonathanbell/remove-jquery-wordpress-plugin
 * Description:       Removes jQuery from your WordPress site with no explanation.
 * Version:           0.0.1-alpha
 * Author:            Jonathan Bell
 * Author URI:        http://30.jonathanbell.ca
 */

// Remove jQuery Migrate.
function remove_jquery_dequeue_jquery_migrate($scripts) {
  if (is_admin()) {
    return;
  }
  if (!empty($scripts->registered['jquery'])) {
    $jquery_dependencies = $scripts->registered['jquery']->deps;
    $scripts->registered['jquery']->deps = array_diff($jquery_dependencies, array('jquery-migrate'));
  }
}
add_action('wp_default_scripts', 'remove_jquery_dequeue_jquery_migrate');

// Remove jQuery.
// https://stackoverflow.com/a/27048128/1171790
function remove_jquery() {
  if (is_admin()) {
    return;
  }
  wp_dequeue_script('jquery');
  wp_deregister_script('jquery');
}
add_filter('wp_enqueue_scripts', 'remove_jquery', PHP_INT_MAX - 1);
