<form class="cf searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
   	<div>
        <label class="assistive-text" for="s"><?php _e('Search for:', 'optimizepress') ?></label>
        <div class="search-text-input">
        	<input type="text" value="<?php the_search_query() ?>" name="s" id="s" />
        </div>
        <input type="submit" id="searchsubmit" value="<?php esc_attr_e('Search', 'optimizepress') ?>" />
    </div>
</form>