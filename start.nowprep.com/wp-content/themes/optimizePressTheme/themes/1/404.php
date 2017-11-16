<?php get_header() ?>

                    <div class="main-content-area">
                        <h2 class="the-title"><?php _e( '404: Oops, this page couldn&rsquo;t be found.', 'optimizepress'); ?></h2>
                        <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'optimizepress'); ?></p>
                        <div class="search">
                        <?php op_search_form() ?>
                        </div>

                        <?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) ); ?>
                    </div>
                    <?php op_sidebar() ?>
<?php get_footer() ?>