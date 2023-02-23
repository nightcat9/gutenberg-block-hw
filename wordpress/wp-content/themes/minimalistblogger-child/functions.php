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
            'name'  => 'Dark Slate Gray',
            'slug'  => 'dark-slate-gray',
            'color' => '#2f4f4f',
        ),
        array(
            'name'  => 'Misty Rose',
            'slug'  => 'misty-rose',
            'color' => '#ffe4e1',
        ),
        array(
            'name'  => 'Midnight Blue',
            'slug'  => 'midnight-blue',
            'color' => '#191970',
        ),
        array(
            'name'  => 'Teal',
            'slug'  => 'teal',
            'color' => '#008080',
        ),
    ) );

    add_theme_support('editor-styles');
    add_editor_style('css/editor.css');

    add_theme_support('disable-custom-colors');

}, 100);