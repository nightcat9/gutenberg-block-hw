<?php

namespace AuthorsWorkPlugin;

/**
 *
 */
class BookPostType extends Book
{
    /**
     *
     */
    const POST_TYPE = 'book';

    protected static $instance;

    protected function __construct(){
        add_action('init', array($this, 'registerBookPostType'));

        add_filter('the_content', array($this, 'bookContentTemplate'), 1);
    }

    public function registerBookPostType()
    {
        // Register Custom Post Type

        $labels = array(
            'name' => _x('Books', 'Post Type General Name', TEXT_DOMAIN),
            'singular_name' => _x('Book', 'Post Type Singular Name', TEXT_DOMAIN),
            'menu_name' => __('Books', TEXT_DOMAIN),
            'name_admin_bar' => __('Book', TEXT_DOMAIN),
            'archives' => __('Book Archives', TEXT_DOMAIN),
            'attributes' => __('Book Attributes', TEXT_DOMAIN),
            'parent_item_colon' => __('Parent Book:', TEXT_DOMAIN),
            'all_items' => __('All Books', TEXT_DOMAIN),
            'add_new_item' => __('Add New Book', TEXT_DOMAIN),
            'add_new' => __('Add New', TEXT_DOMAIN),
            'new_item' => __('New Book', TEXT_DOMAIN),
            'edit_item' => __('Edit Book', TEXT_DOMAIN),
            'update_item' => __('Update Book', TEXT_DOMAIN),
            'view_item' => __('View Book', TEXT_DOMAIN),
            'view_items' => __('View Books', TEXT_DOMAIN),
            'search_items' => __('Search Book', TEXT_DOMAIN),
            'not_found' => __('Not found', TEXT_DOMAIN),
            'not_found_in_trash' => __('Not found in Trash', TEXT_DOMAIN),
            'featured_image' => __('Featured Image', TEXT_DOMAIN),
            'set_featured_image' => __('Set featured image', TEXT_DOMAIN),
            'remove_featured_image' => __('Remove featured image', TEXT_DOMAIN),
            'use_featured_image' => __('Use as featured image', TEXT_DOMAIN),
            'insert_into_item' => __('Insert into book', TEXT_DOMAIN),
            'uploaded_to_this_item' => __('Uploaded to this book', TEXT_DOMAIN),
            'items_list' => __('Books list', TEXT_DOMAIN),
            'items_list_navigation' => __('Books list navigation', TEXT_DOMAIN),
            'filter_items_list' => __('Filter books list', TEXT_DOMAIN),
        );
        $args = array(
            'label' => __('Book', TEXT_DOMAIN),
            'description' => __('Author\'s published books', TEXT_DOMAIN),
            'labels' => $labels,
            'supports' => array('title', 'editor', 'thumbnail'),
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'page',
            'show_in_rest' => true,
        );
        register_post_type(self::POST_TYPE, $args);
    } // end registerBookPostType

    public function bookContentTemplate($content){
        $post = get_post();

        if($post->post_type == self::POST_TYPE){
            $publisher = get_post_meta($post->ID, BookMeta::PUBLISHER, true);
            $publishedDate = get_post_meta($post->ID, BookMeta::PUBLISHED_DATE, true);
            $pageCount = get_post_meta($post->ID, BookMeta::PAGE_COUNT, true);
            $price = get_post_meta($post->ID, BookMeta::PRICE, true);
            $rating = get_post_meta($post->ID, ReviewMeta::RATING, true);

            $content = '<h3 class="border-bottom py-2">Description</h3>
                        <div>' . $content . '</div>
                        <h3 class="border-bottom py-2">Details</h3>
                        <div>
                            <p>Publisher: ' . $publisher . '</p>
                            <p>Published Date: ' . $publishedDate . '</p>
                            <p>Page Count: ' . $pageCount . '</p>
                            <p>Price: ' . $price . '</p>
                        </div>';

        }

        return $content;
    }
}