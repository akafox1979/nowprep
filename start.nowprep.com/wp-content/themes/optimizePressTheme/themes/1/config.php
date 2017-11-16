<?php  if ( ! defined('OP_DIR')) exit('No direct script access allowed');
$config['name'] = __('Theme 1', 'optimizepress');
$config['screenshot'] = 'screenshot.png';
$config['screenshot_thumbnail'] = 'screenshot.png';
$config['description'] = __('Framed style blog theme with textured background', 'optimizepress');

$config['footer_prefs'] =array(
	'full_width' => 915,
	'column_margin' => 30
);

$config['default_config'] = array(
	'blog_header' => array(
		'bgcolor' => '#FFF',
	),
	'color_scheme' => 'style-1',
	
	'column_layout' => array(
		'widths' => array(
			'main-sidebar' => '309'
		)
	),
	
	'header_prefs' => array(
		'menu-position' => 'below'
	),
	
	'continue_reading' => array(
		'link_text' => __('Continue Reading &rarr;', 'optimizepress'),
	),
	
	'info_bar' => array(
		'rss' => get_bloginfo('rss2_url')
	),
	
	'sidebar_optin' => array(
		'content' => array(
			'name_default' => __('Enter your First Name...', 'optimizepress'),
			'email_default' => __('Enter your Email Address...', 'optimizepress'),
			'submit_button' => __('Get Instant Access Now', 'optimizepress'),
		)
	),
	
	'copyright_notice' => 'Copyright &copy; '.date('Y').' · OptimizePress.com · All Rights Reserved',
	
	'comments' => array(
		'facebook' => array(
			'language' => 'en_GB',
			'posts_number' => '10',
		)
	),
	
	'promotion' => array(
		'enabled' => 'Y'
	),
        
        'site_footer' => array(
            'copyright' => 'Copyright &copy; '.date('Y').' · OptimizePress.com · All Rights Reserved',
            'disclaimer' => ''
        )
);


$config['color_schemes'] = array(
	'style-1' => array(
		'preview' => array(
			'image' => $theme_url.'previews/color_scheme1.jpg',
			'width' => 230,
			'height' => 132,
		),
		'colors' => array(
			'start' => '#3089b6',
			'end' => '#0a1f29',
			'top_nav_color' => '#0a1f29',
			'link_color' => '#FFFFFF',
		)
	),
	'style-2' => array(
		'preview' => array(
			'image' => $theme_url.'previews/color_scheme2.jpg',
			'width' => 230,
			'height' => 132,
		),
		'colors' => array(
			'start' => '#868d96',
			'end' => '#585f68',
			'top_nav_color' => '#4d5259',
			'link_color' => '#FFFFFF',
		)
	),
	'style-3' => array(
		'preview' => array(
			'image' => $theme_url.'previews/color_scheme3.jpg',
			'width' => 230,
			'height' => 132,
		),
		'colors' => array(
			'start' => '#252525',
			'end' => '#121212',
			'top_nav_color' => '#1c1c1c',
			'link_color' => '#FFFFFF',
		)
	),
	'style-4' => array(
		'preview' => array(
			'image' => $theme_url.'previews/color_scheme4.jpg',
			'width' => 230,
			'height' => 132,
		),
		'colors' => array(
			'start' => '#0d5966',
			'end' => '#07272c',
			'top_nav_color' => '#0d5966',
			'link_color' => '#FFFFFF',
		)
	),
	'style-5' => array(
		'preview' => array(
			'image' => $theme_url.'previews/color_scheme5.jpg',
			'width' => 230,
			'height' => 132,
		),
		'colors' => array(
			'start' => '#0d4166',
			'end' => '#072236',
			'top_nav_color' => '#0d4166',
			'link_color' => '#FFFFFF',
		)
	),
	'style-6' => array(
		'preview' => array(
			'image' => $theme_url.'previews/color_scheme6.jpg',
			'width' => 230,
			'height' => 132,
		),
		'colors' => array(
			'start' => '#893400',
			'end' => '#511c00',
			'top_nav_color' => '#893400',
			'link_color' => '#FFFFFF',
		)
	),
	'style-7' => array(
		'preview' => array(
			'image' => $theme_url.'previews/color_scheme7.jpg',
			'width' => 230,
			'height' => 132,
		),
		'colors' => array(
			'start' => '#007489',
			'end' => '#003d51',
			'top_nav_color' => '#007489',
			'link_color' => '#FFFFFF',
		)
	),
	'style-8' => array(
		'preview' => array(
			'image' => $theme_url.'previews/color_scheme8.jpg',
			'width' => 230,
			'height' => 132,
		),
		'colors' => array(
			'start' => '#6b2b8c',
			'end' => '#391756',
			'top_nav_color' => '#6b2b8c',
			'link_color' => '#FFFFFF',
		)
	),
	'style-9' => array(
		'preview' => array(
			'image' => $theme_url.'previews/color_scheme9.jpg',
			'width' => 230,
			'height' => 132,
		),
		'colors' => array(
			'start' => '#448c2b',
			'end' => '#245617',
			'top_nav_color' => '#448c2b',
			'link_color' => '#FFFFFF',
		)
	),
	'style-10' => array(
		'preview' => array(
			'image' => $theme_url.'previews/color_scheme10.jpg',
			'width' => 230,
			'height' => 132,
		),
		'colors' => array(
			'start' => '#8c2b2b',
			'end' => '#561717',
			'top_nav_color' => '#8c2b2b',
			'link_color' => '#FFFFFF',
		)
	),
	'style-11' => array(
		'preview' => array(
			'image' => $theme_url.'previews/color_scheme11.jpg',
			'width' => 230,
			'height' => 132,
		),
		'colors' => array(
			'start' => '#504038',
			'end' => '#2a221e',
			'top_nav_color' => '#504038',
			'link_color' => '#FFFFFF',
		)
	),
	'style-12' => array(
		'preview' => array(
			'image' => $theme_url.'previews/color_scheme12.jpg',
			'width' => 230,
			'height' => 132,
		),
		'colors' => array(
			'start' => '#586749',
			'end' => '#2f3727',
			'top_nav_color' => '#586749',
			'link_color' => '#FFFFFF',
		)
	),
	'style-13' => array(
		'preview' => array(
			'image' => $theme_url.'previews/color_scheme13.jpg',
			'width' => 230,
			'height' => 132,
		),
		'colors' => array(
			'start' => '#5b7089',
			'end' => '#303b51',
			'top_nav_color' => '#5b7089',
			'link_color' => '#FFFFFF',
		)
	),
	'style-14' => array(
		'preview' => array(
			'image' => $theme_url.'previews/color_scheme14.jpg',
			'width' => 230,
			'height' => 132,
		),
		'colors' => array(
			'start' => '#34393f',
			'end' => '#1c1e21',
			'top_nav_color' => '#34393f',
			'link_color' => '#FFFFFF',
		)
	),
	'style-15' => array(
		'preview' => array(
			'image' => $theme_url.'previews/color_scheme15.jpg',
			'width' => 230,
			'height' => 132,
		),
		'colors' => array(
			'start' => '#656c75',
			'end' => '#35393e',
			'top_nav_color' => '#656c75',
			'link_color' => '#FFFFFF',
		)
	),
	'style-16' => array(
		'preview' => array(
			'image' => $theme_url.'previews/color_scheme16.jpg',
			'width' => 230,
			'height' => 132,
		),
		'colors' => array(
			'start' => '#002048',
			'end' => '#001126',
			'top_nav_color' => '#002048',
			'link_color' => '#FFFFFF',
		)
	),
	'style-17' => array(
		'preview' => array(
			'image' => $theme_url.'previews/color_scheme17.jpg',
			'width' => 230,
			'height' => 132,
		),
		'colors' => array(
			'start' => '#b74900',
			'end' => '#952700',
			'top_nav_color' => '#b74900',
			'link_color' => '#FFFFFF',
		)
	)
);
$config['nav_color_schemes'] = array(
	'dark' => array(
		'image' => $theme_url.'previews/nav_color_scheme1.png',
		'width' => 230,
		'height' => 174,
	),
	'light' => array(
		'image' => $theme_url.'previews/nav_color_scheme2.png',
		'width' => 230,
		'height' => 174,
	)
);
$config['layouts'] = array(
	'width' => 975,
	'layouts' => array(
		'sidebar-right' => array(
			'preview' => array(
				'image' => $theme_url.'previews/sidebar-right.jpg',
				'width' => 230,
				'height' => 174
			),
			'widths' => array(
				'main-sidebar' => array(
					'title' => __('Main Sidebar', 'optimizepress'),
					'width' => '309',
					'min' => '230',
					'max' => '400'
				)
			)
		),
		'sidebar-left' => array(
			'preview' => array(
				'image' => $theme_url.'previews/sidebar-left.jpg',
				'width' => 230,
				'height' => 174
			),
			'widths' => array(
				'main-sidebar' => array(
					'title' => __('Main Sidebar', 'optimizepress'),
					'width' => '309',
					'min' => '230',
					'max' => '400'
				)
			)
		)
	)
);

$config['header_prefs'] = array(
	'menu-positions' => array(
		'alongside' => array(
			'title' => __('Logo With Alongside Navigation', 'optimizepress'),
			'preview' => array(
				'image' => $theme_url.'previews/navpos_alongside.png',
				'width' => 477,
				'height' => 71
			),
			'link_color' => true,
			'link_selector' => '.banner .nav > li > a',
			'dropdown_selector' => '.banner .nav a',
		),
		'below' => array(
			'title' => __('Banner/Header with navigation below', 'optimizepress'),
			'preview' => array(
				'image' => $theme_url.'previews/navpos_below.png',
				'width' => 477,
				'height' => 115
			),
		)
	)
);


$config['modules'] = array('advertising', 'comments', 'continue_reading', 'feature_area', 'sharing',
						   'promotion', 'related_posts', 'scripts', 'seo', 'signup_form', 'video');
						   


$advertising = array(
	'home_page' => array(
		'title' => __('Blog Home Page', 'optimizepress'),
		'options' => array(
			'top' => __('Banner above homepage content', 'optimizepress'),
			'middle' => array(
				'title' => __('Banner within homepage content', 'optimizepress'),
				'before_ad' => '<div class="in-page-ad mid-page">'
			),
			'bottom' => array(
				'title' => __('Banner beneath homepage content', 'optimizepress'),
				'before_ad' => '<div class="in-page-ad end-page">'
			)
		)
	),
	'post_page' => array(
		'title' => __('Post Pages', 'optimizepress'),
		'options' => array(
			'top' => array(
				'title' => __('Banner on top of post content', 'optimizepress'),
				'before_ad' => '<div class="in-page-ad top-ad">'
			),
			'bottom' => __('Banner beneath post content', 'optimizepress'),
		)
	),
	'pages' => array(
		'title' => __('Pages', 'optimizepress'),
		'options' => array(
			'top' => __('Banner on top of page content', 'optimizepress'),
			'bottom' => __('Banner beneath page content', 'optimizepress'),
		)
	),
	'sidebar' => array(
		'title' => __('Side Bar', 'optimizepress'),
		'options' => array(
			'grid' => array(
				'title' => __('Sidebar grid of ads', 'optimizepress'),
				'type' => 'multi',
				'max' => 4,
				'size' => '125x125',
				'before_ad' => '<div class="sidebar-ads three-ads">',
				'after_ad' => "</div>",
			),
			'rectangular' => array(
				'title' => __('Rectangular ad below grid', 'optimizepress'),
				'size' => '265x125',
				'before_ad' => '<div class="sidebar-ads single-ad rectangular-ad">',
				'after_ad' => "</div>",
			),
			'large_ad1' => array(
				'title' => __('Large Ad 1', 'optimizepress'),
				'size' => '250x250',
				'before_ad' => '<div class="sidebar-section sidebar-ads single-ad">',
				'after_ad' => "</div>",
			),
			'large_ad2' => array(
				'title' => __('Large Ad 2', 'optimizepress'),
				'size' => '250x250',
				'before_ad' => '<div class="sidebar-section sidebar-ads single-ad">',
				'after_ad' => "</div>",
			),
		)
	)
);
$config['mod_options'] = array(
	'advertising' => $advertising,
);

$config['help_videos'] = array(
	'theme' => array(
		'url' => 'http://d376poxu706s4t.cloudfront.net/contextual_update-001.mp4',
		'length' => '0:10 mins',
		'width' => '600',
		'height' => '338',
	),
);