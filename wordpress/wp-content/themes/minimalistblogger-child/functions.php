<?php

function silverstein_enqueue_styles(){
    wp_dequeue_style('minimalistblogger-style');

    wp_enqueue_style('minimalistblogger-parent-style', get_template_directory_uri() . '/style.css');

    wp_enqueue_style('silverstein-child-style', get_stylesheet_uri(), ['minimalistblogger-parent-style'], '1.0.0');
}

add_action('wp_enqueue_scripts', 'silverstein_enqueue_styles');