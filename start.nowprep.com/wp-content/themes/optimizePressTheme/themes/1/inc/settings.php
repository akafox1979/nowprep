<?php
function op_theme1_modules($sections){
	$sections = array_merge(array(
		'home_feature' => array(
			'title' => __('Homepage Feature Area', 'optimizepress'),
			'module' => 'feature_area',
			'options' => array(
				'before' => '
<div class="featured-panel">
	<div class="content-width cf">',
				'after' => '
	</div>
</div>'
			),
		),
		'advertising' => array(
			'title' => __('Advertising', 'optimizepress'),
			'module' => 'advertising',
			'options' => op_theme_config('mod_options','advertising')
		),
		'sidebar_optin' => array(
			'title' => __('Side Bar Optin', 'optimizepress'),
			'module' => 'signup_form',
			'options' => op_theme_config('mod_options','sidebar_optin')
		)
	),$sections);
	return $sections;
}
add_filter('op_edit_sections_modules', 'op_theme1_modules');
