<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 16.02.2016
 * Time: 14:31
 */

class vc_widget_sidebar extends tdc_composer_block {

	function render($atts, $content = null) {
		parent::render($atts);

		$atts = shortcode_atts(
			array(
				'title' => '',
				'sidebar_id' => '',
				'el_class' => '',
			), $atts, 'vc_widget_sidebar' );

		$sidebar_value = '';

		if ( ! ( tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax() ) ) {

			ob_start();
			dynamic_sidebar( $atts[ 'sidebar_id' ] );
			$sidebar_value = ob_get_contents();
			ob_end_clean();

			$sidebar_value = trim( $sidebar_value );
			$sidebar_value = ( '<li' === substr( $sidebar_value, 0, 3 ) ) ? '<ul>' . $sidebar_value . '</ul>' : $sidebar_value;
		}

		$output = '<div class="wpb_wrapper td_block_wrap ' . $this->get_block_classes( array( $atts['el_class'] ) ) . '" ' . $this->get_block_html_atts() . '>';

		if ( !empty($atts['title'])) {
			$output .=
				'<div class="td-block-title-wrap">
					<h4 class="block-title"><span>' . $atts['title'] . '</span></h4>
		        </div>';
		}

	    $output .= $sidebar_value .
          '</div>';

		return $output;
	}
}