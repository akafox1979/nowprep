<?php get_header();
			$class = op_default_attr('column_layout','option');
			if ( have_posts() ) : ?>
				<div class="op-page-header cf">
					<h2 class="the-title"><?php printf( __( 'Search Results for: &ldquo;%s&rdquo;', 'optimizepress'), '<span>' . get_search_query() . '</span>' ); ?></h2>
				</div>
				<?php
				op_mod('advertising')->display(array('advertising', 'pages', 'top')); ?>
			<div class="main-content content-width cf <?php echo $class ?>">
		    	<div class="main-content-area-container cf">
					<div class="sidebar-bg"></div>
                    <?php op_sidebar() ?>
                    <div class="main-content-area">
                    <?php op_theme_file('loop'); ?>
                    </div>
                </div>
            </div>
                <?php else: ?>
				<div class="op-page-header cf">
					<h2 class="the-title"><?php _e( 'Nothing Found', 'optimizepress'); ?></h2>
				</div>
				<?php op_mod('advertising')->display(array('advertising', 'pages', 'top')) ?>
			<div class="main-content content-width cf <?php echo $class ?>">
		    	<div class="main-content-area-container cf">
					<div class="sidebar-bg"></div>
                    <?php op_sidebar() ?>
                    <div class="main-content-area">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'optimizepress'); ?></p>
					<?php op_search_form() ?>
                    </div>
                </div>
            </div>
                <?php endif ?>

				<?php op_mod('advertising')->display(array('advertising', 'pages', 'bottom')) ?>
<?php get_footer(); ?>