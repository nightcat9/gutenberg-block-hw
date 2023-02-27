<?php
/**
 * Hindsight Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hindsight
 */

add_action( 'wp_enqueue_scripts', 'twentytwenty_parent_theme_enqueue_styles' );

/**
 * Enqueue scripts and styles.
 */
function twentytwenty_parent_theme_enqueue_styles() {
	// wp_enqueue_style( 'twentytwenty-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'hindsight-style',
		get_stylesheet_directory_uri() . '/css/style.css',
		// [ 'twentytwenty-style' ]
	);
}

// add/remove theme functions
add_action('after_setup_theme', function (){
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => 'Primary Blue', // user sees in editor
			'slug'  => 'primary-blue', // used for the class on the front-end
			'color' => '#0000ff', // what is shown in the color picker
		),
		array(
			'name'  => 'Warning',
			'slug'  => 'warning',
			'color' => '#ff0000',
		),
		array(
			'name'  => 'Success',
			'slug'  => 'success',
			'color' => '#00ff00',
		),
		array(
			'name'  => 'Purple',
			'slug'  => 'purple',
			'color' => '#b491c8',
		),
		array(
			'name'  => 'Gray',
			'slug'  => 'gray',
			'color' => '#707070',
		),
	) );

	add_theme_support('editor-styles');
	add_editor_style('css/editor.css');

	add_theme_support('disable-custom-colors');

}, 100);
