<?php
class RecentBookWidget extends WP_Widget
{
    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'fh-recent-book-widget',
            'description' => 'Recent books widget!',
        );
        parent::__construct( 'fh_recent_book_widget', 'My recent books widget', $widget_ops );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {
        // outputs the content of the widget
        echo $args['before_widget'];

        $queryObj = new WP_Query(
            array(
                'post_type' => 'book',
                'posts_per_page' => 5,
                'order' => 'DESC',
                'post_status' => 'publish',
                'orderby' => 'date',
            ),
        );

        // the loop
        if($queryObj->have_posts()){
            echo "<ul>";
            while($queryObj->have_posts()){
                $queryObj->the_post(); // retrieves post from the database into the "current post"
                echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() .'</a></li>';
            }
            echo "</ul>";
        }
        wp_reset_postdata();

        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {
        // outputs the options form on admin
        $book = $instance['book'] ?? 0;
        ?>
        <p>
            <label for="<?= $this->get_field_id('book') ?>">Book</label>
            <?php wp_dropdown_categories([
                'id' => $this->get_field_id('book'),
                'name' => $this->get_field_name('book'),
                'class' => 'widefat',
                'selected' => $book
            ])
            ?>
        </p>
        <?php
    }


    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
        $instance = [];

        $instance['book'] = strip_tags($new_instance['book']);

        return $instance;
    }
}