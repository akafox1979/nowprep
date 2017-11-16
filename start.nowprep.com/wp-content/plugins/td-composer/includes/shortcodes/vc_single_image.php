<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 03.02.2017
 * Time: 16:06
 */

class vc_single_image extends tdc_composer_block {

	function render($atts, $content = null) {
		parent::render($atts);

		$atts = shortcode_atts(
			array(
				'image' => '',
				'image_url' => '#',
				'open_in_new_window' => '',
				'height' => '200',
				'alignment' => 'center',
				'style' => '',
				'el_class' => '',
			), $atts, 'vc_single_image' );

		//$inline_css = ( (float) $atts['height'] >= 0.0 ) ? ' style="height: ' . esc_attr( $atts['height'] ) . '"' : '';


		$image_height = '';
		if( ! empty( $atts['height'] ) ) {
			$image_height = ' height: ' . $atts['height'] . 'px;';
		}

		$target = '';
		if ( '' !== $atts['open_in_new_window'] ) {
			$target = ' target="_blank" ';
		}

		$background_position = ' background-position: center center;';
		if ( '' !== $atts['alignment'] ) {
			$background_position = ' background-position: center ' . $atts['alignment'] . ';';
		}


		$editing_class = '';
		if (tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax()) {
			$editing_class = 'tdc-editing-vc_single_image';
		}

		$buffer = '<div class="wpb_wrapper td_block_single_image td_block_wrap ' . $this->get_block_classes( array( $atts['el_class'], $editing_class, 'td-single-image-' . $atts['style'] ) ) . '">';
		$buffer .= '<a style="background-image: url(\'' . wp_get_attachment_url($atts[ 'image' ]) . '\');' . $image_height . $background_position . '" href="' . esc_url($atts[ 'image_url' ]) . '" ' . $target . ' rel="bookmark"></a>';
		$buffer .= $this->get_block_css() . '</div>';

		return  $buffer;
	}
}