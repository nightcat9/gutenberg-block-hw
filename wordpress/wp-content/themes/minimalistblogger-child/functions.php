<?php

function silverstein_enqueue_styles(){
    wp_dequeue_style('minimalistblogger-style');

    // wp_enqueue_style('minimalistblogger-parent-style', get_template_directory_uri() . '/style.css');

    wp_enqueue_style('silverstein-child-style',
        get_stylesheet_directory_uri() . '/css/style.css',
        //['minimalistblogger-parent-style'], '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'silverstein_enqueue_styles');

add_action('after_setup_theme', function (){
    add_theme_support( 'editor-color-palette', array(
        array(
            'name'  => 'Taupe',
            'slug'  => 'taupe',
            'color' => '#50423d',
        ),
        array(
            'name'  => 'Beaver',
            'slug'  => 'beaver',
            'color' => '#8d7361',
        ),
        array(
            'name'  => 'Dun',
            'slug'  => 'dun',
            'color' => '#c9bbae',
        ),
        array(
            'name'  => 'Isabelline',
            'slug'  => 'isabelline',
            'color' => '#eeebe7',
        ),
        array(
            'name'  => 'Cool Gray',
            'slug'  => 'cool-gray',
            'color' => '#8b8da0',
        ),
    ) );

    add_theme_support('editor-styles');
    add_editor_style('css/editor.css');

    add_theme_support('disable-custom-colors');

}, 100);