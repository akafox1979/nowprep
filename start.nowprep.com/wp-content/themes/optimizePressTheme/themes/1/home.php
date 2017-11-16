<?php get_header() ?>
           	
			<div class="main-content-area">
            	<?php op_mod('advertising')->display(array('advertising', 'home_page', 'top')) ?>
				<?php
				if( have_posts() ):
					if(is_paged()):
						op_theme_file('loop');
					else:
				$postslist = new WP_Query( array( 'posts_per_page' => 1 ) );
				if ($postslist->have_posts()):
				foreach ($postslist->posts as $post) :  setup_postdata($post);
				$has_img = has_post_thumbnail();
				 ?>
				<div class="latest-post<?php echo $has_img ? '':' no-post-image' ?>">
					<h3 class="section-header"><span><?php _e('LATEST POST', 'optimizepress') ?></span></h3>
                   	<?php if($has_img): ?>
                    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', 'optimizepress'), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="post-image"><?php the_post_thumbnail( ); ?></a>
					<?php endif ?>
					<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'optimizepress'), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                    <?php the_excerpt() ?>
					<?php op_post_meta() ?>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>
				<div class="clear"></div>

				<?php 
				$postslist = new WP_Query( array( 'posts_per_page' => 4, 'tag' => 'featured') );
				if($postslist->have_posts()):?>
				<div class="featured-posts cf">
					<h3 class="section-header"><span><?php _e('FEATURED POSTS', 'optimizepress') ?></span></h3>
                    <div class="post-content-container">
						<?php foreach ($postslist->posts as $post) :  setup_postdata($post);
						$has_img = has_post_thumbnail(); ?>
                        <div class="post-content cf<?php echo $has_img ? '':' no-post-image' ?>">
                            <?php if($has_img): ?>
                            <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', 'optimizepress'), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="post-image"><?php the_post_thumbnail( 'featured-post' ); ?></a>
                            <?php endif ?>
                            <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'optimizepress'), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                            <?php the_excerpt() ?>
                            <?php op_post_meta() ?>
                        </div>
                        <?php endforeach ?>
                    </div>
				</div>
                <?php endif ?>
				
				
            	<?php op_mod('advertising')->display(array('advertising', 'home_page', 'middle')) ?>
				
				
				<div class="older-post-list cf"><?php
				$postslist = new WP_Query( array( 'posts_per_page' => (get_option('posts_per_page')-1), 'offset' => 1 ) );
				if ($postslist->have_posts()):
				foreach ($postslist->posts as $post) :  setup_postdata($post); ?>
					<?php 
					$class = ' no-post-thumbnail'; $image = ''; $has_img = false;
					if(has_post_thumbnail()){
						$class = '';
						$has_img = true;
					}
					?>
					<div class="older-post<?php echo $class ?>">
                    	<?php if($has_img): ?>
	                    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', 'optimizepress'), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="post-image"><?php the_post_thumbnail( 'list-image' ); ?></a>
                    <?php endif ?>
                        <?php echo $image ?>
                        <h4><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'optimizepress'), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
						<?php the_excerpt() ?>
						<?php op_post_meta() ?>
					</div>
				<?php endforeach ?>
				<?php endif;?>
				<?php op_pagination() ?>
				</div> <!-- end .older-post-list -->
				<?php endif; endif ?>
            	<?php op_mod('advertising')->display(array('advertising', 'home_page', 'bottom')) ?>
				

				
			</div> <!-- end .main-content-area -->
			<?php op_sidebar() ?>
<?php get_footer() ?>