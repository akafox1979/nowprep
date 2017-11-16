<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="no-js" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
if ( is_singular() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script('comment-reply', false, array(OP_SCRIPT_BASE), OP_VERSION);
}
wp_head();
?>
</head>
<body <?php body_class((is_home()?(op_mod('feature_area')->is_enabled('home_feature')?'has-feature-area':'no-feature-area'):'')); ?>>
<?php op_in_body(); ?>
<?php
$op_fonts = new OptimizePress_Fonts;
$header_prefs = op_get_option('header_prefs');
$alongside = (op_get_option('header_prefs','menu-position') == 'alongside');
$has_nav = has_nav_menu('primary');
$img = op_theme_img('',true);
?>
<div class="wrapper">
    <div class="header">
        <nav id="nav-top" class="navigation">
            <div class="content-width cf">
                        <?php if(has_nav_menu('header_info_bar')): ?>
                <ul id="navigation-above"><?php wp_nav_menu( array( 'theme_location' => 'header_info_bar', 'items_wrap' => '%3$s', 'container' => false, 'walker' => new Op_Arrow_Walker_Nav_Menu() ) ); ?></ul>
                        <?php
                endif;
                $out = '';
                /*$fields = array('twitter'=>'Twitter','email'=>'Email','rss'=>'RSS');
                foreach($fields as $field=>$title){
                    $val = op_default_attr('info_bar',$field);
                    if($val != ''){
                        $out .= '<li style="display:none;" class="'.$field.'"><a href="'.($field=='email'?'mailto:':'').$val.'"><img src="'.$img.$field.'-19.png" alt="'.$title.'" width="19" height="38" /></a></li>';
                    }
                }
                echo empty($out) ? '' : '<ul class="blog-meta cf">'.$out.'</ul>';
                */ ?>
            </div>
        </nav>
    </div>
    <?php
        $logo = $banner_class = $style = $title = $title_str = $slogan = '';
        $title = get_bloginfo( 'name' );
        $slogan = get_bloginfo( 'description' );
        $title_str = apply_filters('bloginfo',$title,'name');
        $alt = esc_attr( $title_str );
        $title_str = ' title="'.esc_attr($title_str).'"';
    if($logoimg = op_get_option('blog_header','logo')){
        $logo = '<div class="op-logo"><a href="'.esc_url( home_url( '/' ) ).'"'.$title_str.' rel="home"><img src="'.$logoimg.'" alt="'.$alt.'" /></a></div>';
    } elseif($bannerimg = op_get_option('blog_header','bgimg')){
        $logo = '<div class="banner-logo"><a href="'.esc_url( home_url( '/' ) ).'"'.$title_str.' rel="home"><img src="'.$bannerimg.'" alt="'.$alt.'" /></a></div>';
        $banner_class = ' centered-banner';
        $alongside = false;
    } else {
        $banner_class = ' no-logo';
        $logo = '<div class="site-logo"><div class="site-title"><a href="'.esc_url( home_url( '/' ) ).'"'.$title_str.' rel="home">'.$title.'</a></div><h2 class="site-description">'.$slogan.'</h2></div>';
    }
    if($bgimg = op_get_option('blog_header','repeatbgimg')){
        $style = ' style="background:url(\''.esc_url($bgimg).'\')"';
    } elseif($bgcolor = op_get_option('blog_header','bgcolor')){
        $style = ' style="background-color:'.$bgcolor.'"';
    }
    ?>
    <div class="clear"></div>
    <?php
    if ($header_prefs['menu_position']=='alongside'){
        $op_fonts->add_font($header_prefs['alongside_nav_font_family']);
        $nav_weight = '';
        if ($header_prefs['alongside_nav_font_weight']=='300'){
            $nav_weight = 'font-weight: 300;';
        } elseif ($header_prefs['alongside_nav_font_weight']=='italic'){
            $nav_weight = 'font-style: italic;';
        } elseif (strtolower($header_prefs['alongside_nav_font_weight'])=='bold italic'){
            $nav_weight = 'font-weight: bold; font-style: italic;';
        } elseif (strtolower($header_prefs['alongside_nav_font_weight'])=='normal'){
            $nav_weight = 'font-weight: normal;';
        } elseif (strtolower($header_prefs['alongside_nav_font_weight'])=='bold'){
            $nav_weight = 'font-weight: bold;';
        }
        $nav_shadow = '';
        switch(strtolower(str_replace(' ', '', $header_prefs['alongside_nav_font_shadow']))){
            case 'dark':
                $nav_shadow = 'text-shadow: 0 1px 1px #000000, 0 1px 1px rgba(0, 0, 0, 0.5);';
                break;
            case 'light':
                $nav_shadow = 'text-shadow: 1px 1px 0px rgba(255,255,255,0.5);';
                break;
            case 'textshadow':
            case 'none':
            default:
                $nav_shadow = 'text-shadow: none;';
        }
        ?>
        <style>
            /* Alongside Dropdown BG */
            <?php if (!empty($header_prefs['alongside_dd_bg'])): ?>
                body #nav-side.navigation ul#navigation-alongside ul.sub-menu li a{
                    background-color: <?php echo $header_prefs['alongside_dd_bg']; ?>;
                }
            <?php endif; ?>

            /* Alongside Dropdown BG Hover */
            <?php if (!empty($header_prefs['alongside_dd_bg_hover'])): ?>
                body #nav-side.navigation ul#navigation-alongside ul.sub-menu li:hover>a {
                    background-color: <?php echo $header_prefs['alongside_dd_bg_hover']; ?>;
                }
            <?php endif; ?>

            /* Alongside Navigation BG Hover */
            <?php if (!empty($header_prefs['alongside_nav_bg_hover'])): ?>
                body #nav-side.navigation ul#navigation-alongside li:hover a {
                    background-color: <?php echo $header_prefs['alongside_nav_bg_hover']; ?>;
                }
            <?php endif; ?>

            /* Alongside Navigation Link */
            body #nav-side.navigation ul#navigation-alongside li a {
            <?php
                if (!empty($header_prefs['alongside_nav_link'])) {
                    echo 'color: ' . $header_prefs['alongside_nav_link'] . ';';
                }

                if (!empty($header_prefs['alongside_nav_font_family'])) {
                    echo 'font-family: ' . op_font_str($header_prefs['alongside_nav_font_family']) . ';';
                }

                if (!empty($header_prefs['alongside_nav_font_size'])) {
                    echo 'font-size: ' . $header_prefs['alongside_nav_font_size'] . 'px;';
                }

                echo $nav_shadow;
                echo $nav_weight;
            ?>
            }

            <?php if (!empty($header_prefs['alongside_nav_hover_link'])): ?>
                /* Alongside Navigation Link Hover */
                body #nav-side.navigation ul#navigation-alongside li:hover a {
                    color: <?php echo $header_prefs['alongside_nav_hover_link']?>;
                }
            <?php endif; ?>

            <?php if (!empty($header_prefs['alongside_dd_link'])): ?>
                /* Alongside Dropdown Link */
                body #nav-side.navigation ul#navigation-alongside li ul.sub-menu li a {
                    color: <?php echo $header_prefs['alongside_dd_link']?>;
                }
            <?php endif; ?>

            <?php if (!empty($header_prefs['alongside_dd_hover_link'])): ?>
                /* Alongside Dropdown Link Hover */
                body #nav-side.navigation ul#navigation-alongside li ul.sub-menu li:hover>a {
                    color: <?php echo $header_prefs['alongside_dd_hover_link']?>;
                }
            <?php endif; ?>
        </style>
        <?php
    }
    ?>
    <nav id="nav-side" class="navigation fly-to-left">
        <div<?php echo ' class="banner'.($alongside && $has_nav ? ' include-nav':'').$banner_class.'"'.$style ?>>
            <div class="content-width cf">
                        <?php echo $logo; ?>
                <?php $alongside && $has_nav && wp_nav_menu( array( 'theme_location' => 'primary', 'items_wrap' => '<ul id="navigation-alongside">%3$s</ul>', 'container' => 'false', 'walker' => new Op_Arrow_Walker_Nav_Menu() ) ); ?>
            </div>
        </div>
    </nav>
    <?php if(!$alongside && $has_nav): ?>
    <?php
    if ($header_prefs['menu_position']=='below'){
        $op_fonts->add_font($header_prefs['below_nav_font_family']);
        if (empty($header_prefs['below_bg_end'])) $header_prefs['below_bg_end'] = $header_prefs['below_bg_start'];
        if (empty($header_prefs['below_bg_hover_end'])) $header_prefs['below_bg_hover_end'] = $header_prefs['below_bg_hover_start'];
        $nav_weight = '';
        if ($header_prefs['below_nav_font_weight']=='300'){
            $nav_weight = 'font-weight: 300;';
        } elseif ($header_prefs['below_nav_font_weight']=='italic'){
            $nav_weight = 'font-style: italic;';
        } elseif (strtolower($header_prefs['below_nav_font_weight'])=='bold italic'){
            $nav_weight = 'font-weight: bold; font-style: italic;';
        } elseif (strtolower($header_prefs['below_nav_font_weight'])=='normal'){
            $nav_weight = 'font-weight: normal;';
        } elseif (strtolower($header_prefs['below_nav_font_weight'])=='bold'){
            $nav_weight = 'font-weight: bold;';
        }
        $nav_shadow = '';
        switch(strtolower(str_replace(' ', '', $header_prefs['below_nav_font_shadow']))){
            case 'dark':
                $nav_shadow = 'text-shadow: 0 1px 1px #000000, 0 1px 1px rgba(0, 0, 0, 0.5);';
                break;
            case 'light':
                $nav_shadow = 'text-shadow: 1px 1px 0px rgba(255,255,255,0.5);';
                break;
            case 'textshadow':
            case 'none':
            default:
                $nav_shadow = 'text-shadow: none;';
        }
        ?>
        <style>
            <?php if ($header_prefs['below_bg_start']): ?>
            body #nav-bottom.navigation{
                background: <?php echo $header_prefs['below_bg_start']; ?>;background: -moz-linear-gradient(top, <?php echo $header_prefs['below_bg_start']; ?> 0%, <?php echo $header_prefs['below_bg_end']; ?> 100%);background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $header_prefs['below_bg_start']; ?>), color-stop(100%,<?php echo $header_prefs['below_bg_end']; ?>));background: -webkit-linear-gradient(top, <?php echo $header_prefs['below_bg_start']; ?> 0%,<?php echo $header_prefs['below_bg_end']; ?> 100%);background: -o-linear-gradient(top, <?php echo $header_prefs['below_bg_start']; ?> 0%,<?php echo $header_prefs['below_bg_end']; ?> 100%);background: -ms-linear-gradient(top, <?php echo $header_prefs['below_bg_start']; ?> 0%,<?php echo $header_prefs['below_bg_end']; ?> 100%);background: linear-gradient(top, <?php echo $header_prefs['below_bg_start']; ?> 0%,<?php echo $header_prefs['below_bg_end']; ?> 100%));filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=<?php echo $header_prefs['below_bg_start']; ?>, endColorstr=<?php echo $header_prefs['below_bg_end']; ?>,GradientType=0 );
            }
            <?php endif; ?>

            <?php if ($header_prefs['below_bg_hover_start']): ?>
            body #nav-bottom.navigation ul#navigation-below li:hover{
                background: <?php echo $header_prefs['below_bg_hover_start']; ?>;background: -moz-linear-gradient(top, <?php echo $header_prefs['below_bg_hover_start']; ?> 0%, <?php echo $header_prefs['below_bg_hover_end']; ?> 100%);background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $header_prefs['below_bg_hover_start']; ?>), color-stop(100%,<?php echo $header_prefs['below_bg_hover_end']; ?>));background: -webkit-linear-gradient(top, <?php echo $header_prefs['below_bg_hover_start']; ?> 0%,<?php echo $header_prefs['below_bg_hover_end']; ?> 100%);background: -o-linear-gradient(top, <?php echo $header_prefs['below_bg_hover_start']; ?> 0%,<?php echo $header_prefs['below_bg_hover_end']; ?> 100%);background: -ms-linear-gradient(top, <?php echo $header_prefs['below_bg_hover_start']; ?> 0%,<?php echo $header_prefs['below_bg_hover_end']; ?> 100%);background: linear-gradient(top, <?php echo $header_prefs['below_bg_hover_start']; ?> 0%,<?php echo $header_prefs['below_bg_hover_end']; ?> 100%));filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=<?php echo $header_prefs['below_bg_hover_start']; ?>, endColorstr=<?php echo $header_prefs['below_bg_hover_end']; ?>,GradientType=0 );
            }
            <?php endif; ?>
            body #nav-bottom.navigation ul#navigation-below ul li{ /* Below Dropdown BG */
                <?php if (empty($header_prefs['below_dd_bg'])) $color = '#fff'; else $color = $header_prefs['below_dd_bg']; ?>
                background: none;
                background-image: none;
                filter: none;
                background-color: <?php echo $color; ?>;
            }
            body #nav-bottom.navigation ul#navigation-below ul li:hover{ /* Below Dropdown BG Hover */
                <?php if (empty($header_prefs['below_dd_bg_hover'])) $color = '#fff'; else $color = $header_prefs['below_dd_bg_hover']; ?>
                background: none;
                background-image: none;
                filter: none;
                background-color: <?php echo $color; ?>;
            }

            <?php
            if ($header_prefs['below_nav_link'] || $header_prefs['below_nav_font_family'] || $header_prefs['below_nav_font_size'] || $nav_shadow || $nav_weight):
                /* Below Navigation Link */
                echo 'body #nav-bottom.navigation ul#navigation-below li a{';
                    if ($header_prefs['below_nav_link']) {
                        echo 'color:' . $header_prefs['below_nav_link'] . ';';
                    }
                    if ($header_prefs['below_nav_font_family']) {
                        echo 'font-family:' . op_font_str($header_prefs['below_nav_font_family']) . ';';
                    }
                    if ($header_prefs['below_nav_font_size']) {
                        echo 'font-size:' . $header_prefs['below_nav_font_size'] . 'px;';
                    }
                    echo $nav_shadow;
                    echo $nav_weight;
                echo '}';
            endif;

            /* Below Navigation Link Hover */
            if ($header_prefs['below_nav_hover_link']):
                echo 'body #nav-bottom.navigation ul#navigation-below li:hover a{';
                    echo 'color:' . $header_prefs['below_nav_hover_link'] . ';';
                echo '}';
            endif;

            /* Below Dropdown Link */
            if ($header_prefs['below_dd_link']):
                echo 'body #nav-bottom.navigation ul#navigation-below li ul.sub-menu li a,';
                echo 'body #nav-bottom.navigation ul#navigation-below > li.menu-item > ul.sub-menu > li.menu-item > ul.sub-menu > li.menu-item a,';
                echo 'body #nav-bottom.navigation ul#navigation-below > li.menu-item > ul.sub-menu > li.menu-item > ul.sub-menu > li.menu-item > ul.sub-menu > li.menu-item a,';
                echo 'body #nav-bottom.navigation ul#navigation-below > li.menu-item > ul.sub-menu > li.menu-item > ul.sub-menu > li.menu-item > ul.sub-menu > li.menu-item > ul.sub-menu > li.menu-item a {';
                    echo 'color:' . $header_prefs['below_dd_link'] . ';';
                echo '}';
            endif;

            /* Below Dropdown Link Hover */
            if ($header_prefs['below_dd_hover_link']):
                echo 'body #nav-bottom.navigation ul#navigation-below li ul.sub-menu li:hover a,';
                echo 'body #nav-bottom.navigation ul#navigation-below > li.menu-item > ul.sub-menu > li.menu-item > ul.sub-menu > li.menu-item:hover a,';
                echo 'body #nav-bottom.navigation ul#navigation-below > li.menu-item > ul.sub-menu > li.menu-item > ul.sub-menu > li.menu-item > ul.sub-menu > li.menu-item:hover a,';
                echo 'body #nav-bottom.navigation ul#navigation-below > li.menu-item > ul.sub-menu > li.menu-item > ul.sub-menu > li.menu-item > ul.sub-menu > li.menu-item > ul.sub-menu > li.menu-item:hover a {';
                    echo 'color:' . $header_prefs['below_dd_hover_link'] . ';';
                echo '}';
            endif;
            ?>
        </style>
        <?php if ($header_prefs['below_bg_start']): ?>
            <!--[if lte IE 9]><style>body .navigation#nav-bottom{ z-index: auto; }</style><![endif]-->
        <?php endif; ?>
        <?php
    }
    ?>
    <nav id="nav-bottom" class="navigation">
            <div class="content-width cf">
                <ul id="navigation-below"><?php wp_nav_menu( array( 'theme_location' => 'primary', 'items_wrap' => '%3$s', 'container' => false,  'walker' => new Op_Arrow_Walker_Nav_Menu() ) ); ?></ul>
        </div>
    </nav>
    <?php
    endif;
    if(is_home()){
        op_mod('feature_area')->display('home_feature');
    }
    $class = op_default_attr('column_layout','option');
    $add_sidebar = true;
    if(defined('OP_SIDEBAR')){
        if(OP_SIDEBAR === false){
            $class = 'no-sidebar';
            $add_sidebar = false;
        } else {
            $class = OP_SIDEBAR;
        }
    }
    ?>
    <!-- <div class="main-content content-width cf <?php echo $class ?>">
        <div class="main-content-area-container cf">
            <?php echo $add_sidebar ? '<div class="sidebar-bg"></div>' : '' ?> !-->