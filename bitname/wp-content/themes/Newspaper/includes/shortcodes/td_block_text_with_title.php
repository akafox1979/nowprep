<?php

class td_block_text_with_title extends td_block {

	/**
	 * Disable loop block features. This block does not use a loop and it dosn't need to run a query.
	 */
	function __construct() {
		parent::disable_loop_block_features();
	}


    function render($atts, $content = null) {
        parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query

	    $atts = shortcode_atts(
			array(
				'content' => __('Html code here! Replace this with any non empty text and that\'s it.', TD_THEME_NAME ),
				'el_class' => '',
			), $atts, 'td_block_text_with_title' );

		if ( is_null( $content ) || empty( $content ) ) {
			$content = $atts[ 'content' ];
		}

        $buffy = '';
        $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

		    //get the block js
		    $buffy .= $this->get_block_css();

            $buffy .= $this->get_block_title();
            $buffy .= '<div class="td_mod_wrap">';
                //only run the filter if we have visual composer
	            if ( ! ( td_util::tdc_is_live_editor_iframe() || td_util::tdc_is_live_editor_ajax() ) ) {
	                if (function_exists('wpb_js_remove_wpautop')) {
			            $buffy .= wpb_js_remove_wpautop( $content );
		            } else {
			            $buffy .= do_shortcode( shortcode_unautop( $content ) );
		            }
	            } else {
		            $buffy .= $content;   //no visual composer
	            }
	    $buffy .= '</div>';
        $buffy .= '</div>';

        return $buffy;
    }
}