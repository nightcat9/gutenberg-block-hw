<?php

namespace AuthorsWorkPlugin;

class ReviewPostType extends Book
{
    const POST_TYPE = 'review';

    protected static $instance;

    protected function __construct()
    {
        add_action('init', array($this, 'registerReviewPostType'));
        add_filter('the_content', array($this, 'reviewContentTemplate'), 1);
    }

    public function registerReviewPostType()
    {
        // Register Custom Post Type

        $labels = array(
            'name'                  => _x( 'Reviews', 'Post Type General Name', 'authors-work' ),
            'singular_name'         => _x( 'Review', 'Post Type Singular Name', 'authors-work' ),
            'menu_name'             => __( 'Reviews', 'authors-work' ),
            'name_admin_bar'        => __( 'Review', 'authors-work' ),
            'archives'              => __( 'Review Archives', 'authors-work' ),
            'attributes'            => __( 'Review Attributes', 'authors-work' ),
            'parent_item_colon'     => __( 'Parent Review:', 'authors-work' ),
            'all_items'             => __( 'All Reviews', 'authors-work' ),
            'add_new_item'          => __( 'Add New Review', 'authors-work' ),
            'add_new'               => __( 'Add New', 'authors-work' ),
            'new_item'              => __( 'New Review', 'authors-work' ),
            'edit_item'             => __( 'Edit Review', 'authors-work' ),
            'update_item'           => __( 'Update Review', 'authors-work' ),
            'view_item'             => __( 'View Review', 'authors-work' ),
            'view_items'            => __( 'View Reviews', 'authors-work' ),
            'search_items'          => __( 'Search Review', 'authors-work' ),
            'not_found'             => __( 'Not found', 'authors-work' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'authors-work' ),
            'featured_image'        => __( 'Featured Image', 'authors-work' ),
            'set_featured_image'    => __( 'Set featured image', 'authors-work' ),
            'remove_featured_image' => __( 'Remove featured image', 'authors-work' ),
            'use_featured_image'    => __( 'Use as featured image', 'authors-work' ),
            'insert_into_item'      => __( 'Insert into review', 'authors-work' ),
            'uploaded_to_this_item' => __( 'Uploaded to this review', 'authors-work' ),
            'items_list'            => __( 'Reviews list', 'authors-work' ),
            'items_list_navigation' => __( 'Reviews list navigation', 'authors-work' ),
            'filter_items_list'     => __( 'Filter reviews list', 'authors-work' ),
        );
        $args = array(
            'label'                 => __( 'Review', 'authors-work' ),
            'description'           => __( 'Readers book reviews', 'authors-work' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
        );
        register_post_type( 'review', $args );
    } // end registerReviewPostType

    public function reviewContentTemplate($content){
        $post = get_post();

        if ($post->post_type == self::POST_TYPE){
            $reviewerName = get_post_meta($post->ID, ReviewMeta::REVIEWER_NAME, true);
            $location = get_post_meta($post->ID, ReviewMeta::LOCATION, true);
            $rating = get_post_meta($post->ID, ReviewMeta::RATING, true);
            $bookReviewed = get_post_meta($post->ID, ReviewMeta::BOOK_REVIEWED, true);

            $content = '<h4 class="border-bottom py-2">Reviews</h4>
                <div>' . $content . '</div>
                <div><br>
                    <p>' . $reviewerName . '</p>
                    <p>' . $location . '</p>
                    <p>' . $rating . '</p>
                    <p>' . $bookReviewed . '</p>
                </div>';
        }

        return $content;
    }
}