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
			<div class="op-page-header cf">
            	<h2 class="the-title"><?php single_post_title() ?></h2>
            </div>
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
                        <?php op_mod('advertising')->display(array('advertising', 'pages', 'top')) ?>
                        <div class="latest-post cf">
                            <?php echo $img ?>
                            <div class="single-post-content cf">
                                <?php the_content(); ?>
                                <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'optimizepress') . '</span>', 'after' => '</div>' ) ); ?>
                            </div>
                        </div>
                        <?php op_mod('advertising')->display(array('advertising', 'pages', 'bottom')) ?>
                        <?php comments_template( '', true ); ?>
                    </div>
                    <?php endwhile ?>
                <?php op_sidebar() ?>
                </div>
                <div class="clear"></div>
            </div>
<?php get_footer() ?>