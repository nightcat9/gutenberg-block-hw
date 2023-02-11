<?php
/**
 * @wordpress-plugin
 * Plugin Name: Author's Work
 * Description: Plugin to showcase an author's publications
 * Author: Felicia Hoeft
 * Version: 1.0.0
 * Text Domain: authors-work
 */

namespace AuthorsWorkPlugin;

//define('TEXT_DOMAIN', 'authors-work');
const TEXT_DOMAIN = 'authors-work';

require_once plugin_dir_path( __FILE__ ) . "/classes/RecentBookWidget.php";
add_action('widgets_init', function (){
    register_widget('RecentBookWidget');
});
// include class files
include __DIR__ . '/classes/Book.php';
include __DIR__ . '/classes/BookPostType.php';
include __DIR__ . '/classes/BookGenreTaxonomy.php';
include __DIR__ . '/classes/BookMeta.php';
include __DIR__ . '/classes/ReviewPostType.php';
include __DIR__ . '/classes/ReviewMeta.php';

// instantiate classes
BookPostType::getInstance();
BookGenreTaxonomy::getInstance();
BookMeta::getInstance();
ReviewPostType::getInstance();
ReviewMeta::getInstance();

function activate_plugin(){
    $bookPostType = BookPostType::getInstance();
    $bookPostType->registerBookPostType();

    BookGenreTaxonomy::getInstance()->registerBookGenreTaxonomy();

    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'AuthorsWorkPlugin\activate_plugin');

add_action('widgets_init', function (){
    register_widget('RecentBookWidget');
});