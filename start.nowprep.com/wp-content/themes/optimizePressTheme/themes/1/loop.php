
				<div class="older-post-list cf">
                    <?php /* Start the Loop */ ?>
                    <?php 
					global $post;
					while ( have_posts() ) : the_post();
					$class = ' no-post-thumbnail'; $image = '';
					if(has_post_thumbnail()){
						$image = '<a href="'.get_permalink().'" title="'.sprintf( esc_attr__( '%s', 'optimizepress'), the_title_attribute( 'echo=0' ) ).'" rel="bookmark" class="post-image">'.get_the_post_thumbnail( $post->ID, 'list-image' ).'</a>';
						$class = '';
					}
					 ?>
					<div class="older-post<?php echo $class ?>">
                    	<?php echo $image ?>
						<h4 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'optimizepress'), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
                        <?php the_excerpt(); ?>
						<?php op_post_meta() ?>
					</div> <!-- end .older-post -->
					<?php endwhile ?>
					<?php op_pagination() ?>
				</div>