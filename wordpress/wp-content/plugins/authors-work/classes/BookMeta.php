<?php

namespace AuthorsWorkPlugin;

class BookMeta extends Book
{
    const PUBLISHER = 'publisher';
    const PUBLISHED_DATE = 'publishedDate';
    const PAGE_COUNT = 'pageCount';
    const PRICE = 'price';

    protected static $instance;

    protected function __construct(){
        add_action('admin_init', array($this, 'registerBookMetaBoxes'));
        add_action('save_post_' . BookPostType::POST_TYPE, array($this, 'saveBookMeta'));
    }

    public function registerBookMetaBoxes()
    {
        add_meta_box('book_info_meta',
                    'Information',
                    array($this, 'book_info_MetaBox'),
                    BookPostType::POST_TYPE,
                    'normal');
    }

    public function book_info_MetaBox(){
        // get current post and meta values
        $post = get_post();
        $publisher = get_post_meta($post->ID, self::PUBLISHER, true);
        $publishedDate = get_post_meta($post->ID, self::PUBLISHED_DATE, true);
        $pageCount = get_post_meta($post->ID, self::PAGE_COUNT, true);
        $price = get_post_meta($post->ID, self::PRICE, true);
        ?>
        <p>
            <label for="publisher">Publisher:</label>
            <input type="text" name="publisher" id="publisher" value="<?= $publisher ?>">
        </p>
        <p>
            <label for="publishedDate">Published Date:</label>
            <input type="text" name="publishedDate" id="publishedDate" value="<?= $publishedDate ?>">
        </p>
        <p>
            <label for="pageCount">Page Count:</label>
            <input type="text" name="pageCount" id="pageCount" value="<?= $pageCount ?>">
        </p>
        <p>
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" value="<?= $price ?>">
        </p>
        <?php
    }

    public function saveBookMeta(){
        // get current post
        $post = get_post();

        // get and save each field individually
        if (isset($_POST['publisher'])){
            // validate/sanitize
            $publisher = sanitize_text_field($_POST['publisher']);

            // insert/update database
            update_post_meta($post->ID, self::PUBLISHER, $publisher);
        }

        if (isset($_POST['publishedDate'])){
            $publishedDate = sanitize_text_field($_POST['publishedDate']);

            update_post_meta($post->ID, self::PUBLISHED_DATE, $publishedDate);
        }

        if (isset($_POST['pageCount'])){
            $pageCount = sanitize_text_field($_POST['pageCount']);

            update_post_meta($post->ID, self::PAGE_COUNT, $pageCount);
        }

        if (isset($_POST['price'])){
            $price = sanitize_text_field($_POST['price']);

            update_post_meta($post->ID, self::PRICE, $price);
        }
    }
}