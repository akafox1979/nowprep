<?php
global $post;
get_header();
			$class = op_default_attr('column_layout','option');
			$add_sidebar = true;
			if(defined('OP_SIDEBAR')){
				if(OP_SIDEBAR === FALSE){
					$class = 'no-sidebar';
					$add_sidebar = false;
				} else {
					$class = OP_SIDEBAR;
				}
			}
			?>
			<div class="main-content content-width cf <?php echo $class ?>">
		    	<div class="main-content-area-container cf">
	    	        <?php echo $add_sidebar ? '<div class="sidebar-bg"></div>' : '' ?>

                    <?php while ( have_posts() ) : the_post();
                    $img = '';
                    if(is_singular() && has_post_thumbnail($post->ID)){
                        $img = '<div class="post-image">'.get_the_post_thumbnail($post->ID,'post-thumbnail').'</div>';
                    }
                    ?>
                    <div id="post-<?php the_ID() ?>" <?php post_class('main-content-area'.($img==''?' no-post-image':'')) ?>>
                        <?php op_mod('advertising')->display(array('advertising', 'post_page', 'top')) ?>

                        <div class="latest-post cf">
                        <h1 class="the-title"><?php the_title(); ?></h1>
                            <div class="cf post-meta-container">
                                <?php ('post' == get_post_type()) && op_post_meta() ?>
                                <p class="post-meta date-extra"><?php the_time(get_option('date_format')) ?></p>
                            </div>
                            <?php echo $img ?>
							<?php op_mod('sharing')->display('sharing') ?>
                            <div class="single-post-content cf">
                                <?php the_content(); ?>
                                <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'optimizepress') . '</span>', 'after' => '</div>' ) ); ?>
                            </div>
                        </div> <!-- end .latest-post -->

                        <?php op_mod('advertising')->display(array('advertising', 'post_page', 'bottom')) ?>

                        <?php op_mod('related_posts')->display('related_posts',array('before'=>'<div class="related-posts cf"><h3 class="section-header"><span>'.__('RELATED POSTS', 'optimizepress').'</span></h3>','after'=>'</div>','ulclass'=>'cf')) ?>
                        <?php
                            // Get Author Data
                            $author             = get_the_author();
                            $author_description = get_the_author_meta( 'description' );
                            $author_url         = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
                            $author_avatar      = get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wpex_author_bio_avatar_size', 75 ) );

                            // Only display if author has a description
                            if ( $author_description ) : ?>

                                <div class="op-author-info clr" style="">
                                <h5><?php _e('About The Author', 'optimizepress'); ?></h5>
                                    <h4 class="heading"><a href="<?php echo $author_url; ?>"><span><?php printf( __( '%s', 'text_domain' ), $author ); ?></span></a></h4>
                                    <div class="op-author-info-inner clr">
                                        <?php if ( $author_avatar ) { ?>
                                            <div class="op-author-avatar clr">
                                                <a href="<?php echo $author_url; ?>" rel="author">
                                                    <?php echo $author_avatar; ?>
                                                </a>
                                            </div><!-- .author-avatar -->
                                        <?php } ?>
                                        <div class="op-author-description">
                                            <p><?php echo $author_description; ?></p>
                                        </div><!-- .author-description -->
                                        <div class="cf"></div>
                                    </div><!-- .author-info-inner -->
                                </div><!-- .author-info -->

                        <?php endif; ?>
                        <?php comments_template( '', true ); ?>
                    </div>
                    <?php endwhile ?>
                    <?php op_sidebar() ?>
                </div>
                <div class="clear"></div>
            </div>


<?php get_footer() ?>
