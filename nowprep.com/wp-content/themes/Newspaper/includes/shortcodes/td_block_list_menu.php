<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 19.08.2016
 * Time: 13:54
 */

class td_block_list_menu extends td_block {

	private $atts = array();

	function render($atts, $content = null){

		self::disable_loop_block_features();

		parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

		$this->atts = shortcode_atts(
			array(
				'menu_id' => ''
			), $atts);

		// For tagDiv composer add a placeholder element
		if ((td_util::tdc_is_live_editor_iframe() || td_util::tdc_is_live_editor_ajax()) && empty($this->atts['menu_id'])) {
			return  '<div class="td_block_wrap td_block_list_menu" ' . $this->get_block_html_atts() . '><div class="tdc-placeholder-title"></div></div>';
		}

		$buffy = ''; //output buffer


		$buffy .= '<div class="' . $this->get_block_classes() . ' widget" ' . $this->get_block_html_atts() . '>';

		//get the block css
		$buffy .= $this->get_block_css();

		//get the js for this block
		$buffy .= $this->get_block_js();

		// block title wrap
		$buffy .= '<div class="td-block-title-wrap">';
			$buffy .= $this->get_block_title(); //get the block title
		$buffy .= '</div>';

		$buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner">';

		$buffy .= $this->inner(wp_get_nav_menu_items($this->atts['menu_id']));  //inner content of the block
		$buffy .= '</div>';

		//get the ajax pagination for this block
		$buffy .= $this->get_block_pagination();
		$buffy .= '</div> <!-- ./block -->';
		return $buffy;
	}

	function inner($posts, $td_column_number = '') {
		$buffy = '';

		$td_block_layout = new td_block_layout();
		if (!empty($posts)) {
			$buffy .= '<ul>';

			_wp_menu_item_classes_by_context( $posts );

			foreach ($posts as $post) {
				$buffy .= '<li class="' . join( ' ', $post->classes ) . '"><a href="' . $post->url . '">' . $post->title . '</a></li>';
			}

			$buffy .= '</ul>';
		}
		$buffy .= $td_block_layout->close_all_tags();
		return $buffy;
	}
}