<?php
global $post;
get_header() ?>


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
					<h2 class="the-title"><?php the_title(); ?></h2>
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
<?php get_footer() ?>