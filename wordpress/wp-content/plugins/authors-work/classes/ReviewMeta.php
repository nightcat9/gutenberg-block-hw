<?php

namespace AuthorsWorkPlugin;

class ReviewMeta extends Book
{
    const REVIEWER_NAME = 'reviewerName';
    const LOCATION = 'location';
    const RATING = 'rating';
    const BOOK_REVIEWED = 'bookReviewed';

    protected static $instance;

    protected function __construct(){
        add_action('admin_init', array($this, 'registerReviewMetaBoxes'));
        add_action('save_post_' . ReviewPostType::POST_TYPE, array($this, 'saveReviewMeta'));
    }

    public function registerReviewMetaBoxes()
    {
        add_meta_box('review_meta',
                    'Review',
                    array($this, 'review_MetaBox'),
                    ReviewPostType::POST_TYPE,
                    'normal');
    }

    public function review_MetaBox(){
        // get current post and meta values
        $post = get_post();
        $reviewerName = get_post_meta($post->ID, self::REVIEWER_NAME, true);
        $location = get_post_meta($post->ID, self::LOCATION, true);
        $rating = get_post_meta($post->ID, self::RATING, true);
        $bookReviewed = get_post_meta($post->ID, self::BOOK_REVIEWED, true);
        ?>
        <p>
            <label for="reviewerName">Your Name:</label>
            <input type="text" name="reviewerName" id="reviewerName" value="<?= $reviewerName ?>">
        </p>
        <p>
            <label for="location">Location (City, State):</label>
            <input type="text" name="location" id="location" value="<?= $location ?>">
        </p>
        <p>
            <label for="rating">Rating:</label>
            <select name="rating" id="rating" value="<?= $rating ?>">
                <option value="&starf;">&starf;</option>
                <option value="&starf;&starf;">&starf;&starf;</option>
                <option value="&starf;&starf;&starf;">&starf;&starf;&starf;</option>
                <option value="&starf;&starf;&starf;&starf;">&starf;&starf;&starf;&starf;</option>
                <option value="&starf;&starf;&starf;&starf;&starf;">&starf;&starf;&starf;&starf;&starf;</option>
            </select>
        </p>
        <?php
        wp_dropdown_pages([
                'post_type' => BookPostType::POST_TYPE,
                'name' => 'page_id',
                'show_option_none' => 'no books',
                'hierarchical' => false,
        ]);

        ?>
        <?php
    }

    public function saveReviewMeta(){
        // get current post
        $post = get_post();

        // get and save each field individually
        if (isset($_POST['reviewerName'])){
            // validate/sanitize
            $reviewerName = sanitize_text_field($_POST['reviewerName']);

            // insert/update database
            update_post_meta($post->ID, self::REVIEWER_NAME, $reviewerName);
        }

        if (isset($_POST['location'])){
            $location = sanitize_text_field($_POST['location']);

            update_post_meta($post->ID, self::LOCATION, $location);
        }

        if (isset($_POST['rating'])){
            $rating = sanitize_text_field($_POST['rating']);

            update_post_meta($post->ID, self::RATING, $rating);
        }
        if (isset($_POST['bookReviewed'])){
            $bookReviewed = sanitize_text_field($_POST['bookReviewed']);

            update_post_meta($post->ID, self::BOOK_REVIEWED, $bookReviewed);
        }
    }
}