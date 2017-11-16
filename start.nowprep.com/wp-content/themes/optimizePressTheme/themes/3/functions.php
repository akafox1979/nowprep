<?php
require_once $theme_path.'inc/feature_area.php';
require_once $theme_path.'inc/settings.php';
function theme1_setup() {
    @session_start();

    //Set the theme number for use with widgets
    $_SESSION['theme'] = 1;

    add_filter('op_edit_sections_brand', 'theme1_disable_brand_sections');

    register_nav_menu( 'header_info_bar', __( 'Blog Top Menu', 'optimizepress') );
    register_nav_menu( 'primary', __( 'Blog Primary Menu', 'optimizepress') );
    register_nav_menu( 'footer', __( 'Footer Copyright Menu', 'optimizepress') );

    $theme3ThumbnailSize =  array('width' => 630, 'height' => 315, 'crop' => true);
    $opPostThumbnailSize = apply_filters('opChangePostThumbnailSize', $theme3ThumbnailSize, $theme3ThumbnailSize);
    set_post_thumbnail_size(intval($opPostThumbnailSize['width']), intval($opPostThumbnailSize['height']), $opPostThumbnailSize['crop']);

    add_image_size( 'featured-post', 285, 175, true); // used on home page featured posts
    add_image_size( 'list-image', 182, 125, true); // used in results for search, categories etc
    add_image_size( 'small-image', 78, 55, true); // used in related posts and sidebar lists

    add_action('wp_enqueue_scripts','theme1_enqueue_scripts');

    add_filter('op_mod_advertising_sizes','theme1_advertising_sizes',10,2);
}
add_action( 'op_init_theme', 'theme1_setup' );

function theme1_advertising_sizes($size,$section_name){
    static $widths = array();
    if($section_name[0][1] == 'sidebar'){
        if(!isset($widths['sidebar'])){
            $widths['sidebar'] = op_get_column_width('main-sidebar')-44;
        }
        list($width,$height) = explode('x',$size);
        switch($section_name[1]){
            case 'grid':
                $width = floor(($widths['sidebar']/100)*47);
                break;
            default:
                $width = $widths['sidebar'];
                break;
        }
        $size = $width.'x'.$height;
    }
    return $size;
}

function theme1_enqueue_scripts(){
    wp_enqueue_script('theme1-common', OP_THEME_URL.'common'.OP_SCRIPT_DEBUG.'.js', array(OP_SCRIPT_BASE), OP_VERSION);
}

function theme1_disable_brand_sections($array){
    if(isset($array['nav_color_scheme'])){
        unset($array['nav_color_scheme']);
    }
    return $array;
}



function theme1_excerpt_more( $more ) {
    return '&hellip;';
}
add_filter( 'excerpt_more', 'theme1_excerpt_more' );


function theme1_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
        <span class="author"><?php comment_author_link(); ?></span> -
        <span class="date"><?php echo get_comment_date(get_option( 'date_format' )) ?></span>
        <span class="pingcontent"><?php comment_text() ?></span>
    <?php
            break;
        default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <div id="comment-<?php comment_ID(); ?>">
            <?php echo get_avatar( $comment, 75 ); ?>
            <div class="comment-meta cf">
                <p><?php comment_author_link() ?></p>
                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => sprintf(__( '%1$s Reply', 'optimizepress'), '<img src="'.op_theme_img('reply-icon.png',true).'" alt="'.__('Reply', 'optimizepress').'" width="13" height="9" />'), 'depth' => $depth, 'max_depth' => $args['max_depth'], 'respond_id' => 'leave-reply' ) ) ); ?>
                <span><?php comment_date() ?></span>
            </div>
            <div class="comment-content">
                <?php comment_text() ?>
                <?php edit_comment_link( __( 'Edit', 'optimizepress'), '<span class="edit-link">', '</span>' ); ?>
            </div>
            <?php if ( $comment->comment_approved == '0' ) : ?>
            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'optimizepress'); ?></em>
            <?php endif; ?>
        </div>
    <?php
            break;
    endswitch;
}

function theme1_widgets_init(){
    register_sidebar( array(
        'name' => __( 'Sidebar', 'optimizepress'),
        'id' => 'main-sidebar',
        'description' => __( 'An optional widget area for your sidebar', 'optimizepress'),
        'before_widget' => '<div id="%1$s" class="sidebar-section widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );

    register_sidebar( array(
        'name' => __( 'Sub Footer Section', 'optimizepress'),
        'id' => 'sub-footer-sidebar',
        'description' => __( 'An optional widget area for your site footer', 'optimizepress'),
        'before_widget' => '<div id="%1$s" class="col widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );

}
add_action( 'op_init_theme', 'theme1_widgets_init' );

function theme1_generate_sidebar_tabs($set=1){
    $tabs = array();
    switch($set){
        case 1:
            $tabs = array(

            );
            break;
        case 2:
            $tabs = array(

            );
            break;
    }
    $out = '';
    $tab_html = '';
    $class = ' class="selected"';
    foreach($tabs as $name => $tab){
        if(isset($tab[1]) && is_callable($tab[1])){
            $args = array();
            if(isset($tab[2])){
                $args = $tab[2];
            }
            $content = call_user_func_array($tab[1],$args);
            if(!empty($content)){
                $tab_html .= '<li'.$class.'><a href="#'.$name.'">'.$tab[0].'</a></li>';
                $out .= $content;
                $class = '';
            }
        }
    }
    if(!empty($tab_html)): ?>
<div class="sidebar-section">
    <div class="minipost-area">
        <ul class="tabs cf"><?php echo $tab_html ?></ul>
        <div class="minipost-area-content">
            <?php echo $out ?>
        </div>
    </div>
</div>
<?php
    endif;
}

function theme1_popular_posts($options=array()){
    global $wpdb;
    return theme1_posts_list("SELECT ID,comment_count FROM ".$wpdb->posts." WHERE post_type='post' AND post_status='publish' AND comment_count >= 1 ORDER BY comment_count DESC LIMIT 5",$options);
}
function theme1_list_tags($options=array()){
    $defaults = array(
        'before' => '', 'after' => '', 'echo' => false, 'ulclass' => ''
    );
    $options = wp_parse_args($options,$defaults);
    extract($options);
    $ulclass = $ulclass == '' ? '' : ' class="'.$ulclass.'"';

    $terms = get_terms('post_tag',array( 'taxonomy' => 'post_tag', 'orderby' => 'count', 'order' => 'DESC' ));
    if(count($terms) > 0){
        $out = '';
        foreach($terms as $term){
            $link_start = '<a href="'.get_term_link($term).'" title="'.sprintf(__('View all posts filed under %s', 'optimizepress'), $term->name).'">';
            $out .= '<li><h4>'.$link_start.$term->name.'</a></h4><p>'.$link_start.sprintf(_n('1 Article','%1$s Articles',$term->count, 'optimizepress'), number_format_i18n( $term->count )).'</a></p></li>';
        }
        $out = $before.'<ul'.$ulclass.'>'.$out.'</ul>'.$after;
        if(!$echo){
            return $out;
        }
        echo $out;
    }
}
function theme1_posts_list($sql,$options=array()){
    global $wpdb;

    $defaults = array(
        'before' => '', 'after' => '', 'echo' => false, 'ulclass' => ''
    );
    $options = wp_parse_args($options,$defaults);
    extract($options);
    $ulclass = $ulclass == '' ? '' : ' class="'.$ulclass.'"';
    $posts = $wpdb->get_results($sql);
    $html = '';
    if(count($posts) > 0){
        foreach($posts as $post){
            $img = '';
            $class = 'no-image';
            $permalink = get_permalink($post->ID);
            $title = get_the_title($post->ID);
            $link_start = '<a href="'.$permalink.'" title="'.sprintf( esc_attr__( '%s', 'optimizepress'), esc_attr($title) ).'" rel="bookmark">';
            if(has_post_thumbnail($post->ID)){
                $img = $link_start.get_the_post_thumbnail($post->ID,'small-image').'</a>';
                $class = '';
            }
            $class = $class == '' ? '' : ' class="'.$class.'"';
            $cn = $post->comment_count;
            $html .= '
    <li'.$class.'>'.$img.'<h4>'.$link_start.theme1_truncate_title(get_the_title($post->ID)).'</a></h4><p><a href="'.get_comments_link($post->ID).'">'.sprintf(_n('1 Comment','%1$s Comments',$cn, 'optimizepress'), number_format_i18n( $cn )).'</a></p></li>';
        }
        $html = $before.'<ul'.$ulclass.'>'.$html.'</ul>'.$after;
    }
    if(!$echo){
        return $html;
    }
    echo $html;
}
function theme1_recent_comments($options=array()){
    global $wpdb;
    $defaults = array(
        'before' => '', 'after' => '', 'echo' => false, 'ulclass' => ''
    );
    $options = wp_parse_args($options,$defaults);
    extract($options);
    $ulclass = $ulclass == '' ? '' : ' class="'.$ulclass.'"';
    $out = '';
    $comments = get_comments(array('number' => 5, 'status' => 'approve'));
    if($comments){
        foreach($comments as $comment){
            $post = get_post($comment->comment_post_ID);
            $atag = '<a href="'.get_comment_link($comment->comment_ID).'" title="'.sprintf(__('%1$s on %2$s', 'optimizepress'),wp_filter_nohtml_kses($comment->comment_author),$post->post_title).'">';
            $out .= '
    <li>
        '.$atag.get_avatar($comment, 60).'</a>
        <h4>'.$atag.wp_filter_nohtml_kses($comment->comment_author).': '.substr( wp_filter_nohtml_kses( $comment->comment_content ), 0, 50 ).'...</a></h4>
    </li>';
        }
    }
    if(!empty($out)){
        $html = $before.'<ul'.$ulclass.'>'.$out.'</ul>'.$after;
    }
    if(!$echo){
        return $html;
    }
    echo $html;
}
function theme1_recent_posts($options=array()){
    global $wpdb;
    return theme1_posts_list("SELECT ID,comment_count FROM ".$wpdb->posts." WHERE post_type='post' AND post_status='publish' ORDER BY post_date DESC LIMIT 5",$options);
}
function theme1_category_panel($options=array()){
    $defaults = array(
        'before' => '', 'after' => '', 'echo' => false, 'ulclass' => ''
    );
    $options = wp_parse_args($options,$defaults);
    extract($options);
    $ulclass = $ulclass == '' ? '' : ' class="'.$ulclass.'"';

    $html = '';
    $out = wp_list_categories(array(
        'echo' => 0,
        'title_li' => '',
        'sort_column' => 'name',
        'show_count' => 1,
        'walker' => new Theme1_Category_Walker()
    ));
    if(!empty($out)){
        $html = $before.'<ul'.$ulclass.'>'.$out.'</ul>'.$after;
    }
    if(!$echo){
        return $html;
    }
    echo $html;
}
function theme1_archives_panel($options=array()){
    $defaults = array(
        'before' => '', 'after' => '', 'echo' => false, 'ulclass' => ''
    );
    $options = wp_parse_args($options,$defaults);
    extract($options);
    $ulclass = $ulclass == '' ? '' : ' class="'.$ulclass.'"';
    $out = wp_get_archives('echo=0&type=monthly');
    if(!empty($out)){
        $html = $before.'<ul'.$ulclass.'>'.$out.'</ul>'.$after;
    }
    if(!$echo){
        return $html;
    }
    echo $html;
}
function theme1_pages_panel($options=array()){
    $defaults = array(
        'before' => '', 'after' => '', 'echo' => false, 'ulclass' => ''
    );
    $options = wp_parse_args($options,$defaults);
    extract($options);
    $ulclass = $ulclass == '' ? '' : ' class="'.$ulclass.'"';
    $out = wp_list_pages(array('title_li' => '', 'echo' => 0, 'sort_column' => 'menu_order'));
    if(!empty($out)){
        $html = $before.'<ul'.$ulclass.'>'.$out.'</ul>'.$after;
    }
    if(!$echo){
        return $html;
    }
    echo $html;
}


function theme1_color_scheme_fields($color_fields){
    $color_fields = array(
        'start' => array(
            'name' => __('Feature Area Gradient Start Colour', 'optimizepress'),
            'help' => __('Select or enter a colour for the top of the feature area gradient', 'optimizepress'),
        ),
        'end' => array(
            'name' => __('Feature Area Gradient End Colour', 'optimizepress'),
            'help' => __('Select or enter a colour for the bottom of the feature area gradient', 'optimizepress'),
        ),
        'headline_title' => array(
            'name' => __('Page/Category Headline Text Colour', 'optimizepress'),
        )
        /*'top_nav_font' => array(
            'name' => __('Top Navigation Font', 'optimizepress'),
            'help' => __('Choose the font you would like to use for the top navigation bar', 'optimizepress'),
            'type' => 'font'
        ),
        'top_nav_color' => array(
            'name' => __('Top Navigation Background Color', 'optimizepress'),
            'help' => __('Select or enter a colour for the top navigation bar background colour', 'optimizepress'),
        ),
        'link_color' => array(
            'name' => __('Top Navigation Link Color', 'optimizepress'),
            'help' => __('Select or enter a colour for the text link in the top navigation bar', 'optimizepress'),
        ),
        'top_nav_hover_link' => array(
            'name' => __('Navigation Hover Link Text', 'optimizepress'),
            'help' => __('Choose the hover colour for the main text links on your navigation bar', 'optimizepress'),
        ),
        'top_nav_dd_link' => array(
            'name' => __('Dropdown Link Text', 'optimizepress'),
            'help' => __('Choose the colour for the dropdown text links on your navigation bar', 'optimizepress'),
        ),
        'top_nav_dd_hover_link' => array(
            'name' => __('Dropdown Hover Link Text', 'optimizepress'),
            'help' => __('Choose the hover colour for the dropdown text links on your navigation bar', 'optimizepress'),
        ),
        'top_nav_dd' => array(
            'name' => __('Dropdown Background', 'optimizepress'),
            'help' => __('Choose the colour foryour dropdown menu.', 'optimizepress'),
        ),
        'top_nav_dd_hover' => array(
            'name' => __('Dropdown Background Hover', 'optimizepress'),
            'help' => __('Choose the colour for the background on your dropdown menu.', 'optimizepress'),
        )*/
    );
    return $color_fields;
}
add_filter('op_color_scheme_fields','theme1_color_scheme_fields');

function theme1_truncate_title($title,$length=38,$more_text='&hellip;'){
    if(strlen($title) > $length){
        $parts = explode(' ',$title);
        $plength = count($parts);
        $title = '';
        $i = 0;
        while(strlen($title) < $length && $i < $plength){
            if(strlen($parts[$i]) + strlen($title) > $length){
                return $title.$more_text;
            } else {
                $title .= ' '.$parts[$i];
                $i++;
            }
        }
        return $title.$more_text;
    } else {
        return $title;
    }
}


function theme1_output_css($css=''){
    $op_fonts = new OptimizePress_Fonts;
    if(($start = op_get_option('color_scheme_fields','start')) && ($end = op_get_option('color_scheme_fields','end'))){
        $css .= '
.featured-panel {
    background: '.$end.';
    background: -moz-linear-gradient(top, '.$start.' 0%, '.$end.' 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.$start.'), color-stop(100%,'.$end.'));
    background: -webkit-linear-gradient(top, '.$start.' 0%,'.$end.' 100%);
    background: -o-linear-gradient(top, '.$start.' 0%,'.$end.' 100%);
    background: -ms-linear-gradient(top, '.$start.' 0%,'.$end.' 100%);
    background: linear-gradient(top, '.$start.' 0%,'.$end.' 100%));
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\''.$start.'\', endColorstr=\''.$end.'\',GradientType=0 );
}

.op-page-header{
    background: '.$end.';
    background: -moz-linear-gradient(top, '.$start.' 0%, '.$end.' 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.$start.'), color-stop(100%,'.$end.'));
    background: -webkit-linear-gradient(top, '.$start.' 0%,'.$end.' 100%);
    background: -o-linear-gradient(top, '.$start.' 0%,'.$end.' 100%);
    background: -ms-linear-gradient(top, '.$start.' 0%,'.$end.' 100%);
    background: linear-gradient(top, '.$start.' 0%,'.$end.' 100%));
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\''.$start.'\', endColorstr=\''.$end.'\',GradientType=0 );
}';
    }
    if($top_nav_font = op_get_option('color_scheme_fields', 'top_nav_font')){
        $op_fonts->add_font($top_nav_font['font_family']);
        $nav_weight = '';
        if ($top_nav_font['font_weight']=='300'){
            $nav_weight = 'font-weight: 300;';
        } elseif ($top_nav_font['font_weight']=='italic'){
            $nav_weight = 'font-style: italic;';
        } elseif (strtolower($top_nav_font['font_weight'])=='bold italic'){
            $nav_weight = 'font-weight: bold; font-style: italic;';
        } elseif (strtolower($top_nav_font['font_weight'])=='normal'){
            $nav_weight = 'font-weight: normal;';
        } elseif (strtolower($top_nav_font['font_weight'])=='bold'){
            $nav_weight = 'font-weight: bold;';
        }
        $nav_shadow = '';
        switch(strtolower(str_replace(' ', '', $top_nav_font['font_shadow']))){
            case 'light':
                $nav_shadow = 'text-shadow: 1px 1px 0px rgba(255,255,255,0.5);';
                break;
            case 'dark':
                $nav_shadow = 'text-shadow: 0 1px 1px #000000, 0 1px 1px rgba(0, 0, 0, 0.5);';
                break;
            case 'textshadow':
            case 'none':
            default:
                $nav_shadow = 'text-shadow: none;';
        }
        $css .= ' body #nav-top.navigation,body #nav-top.navigation ul li a {';

        if (!empty($top_nav_font['font_family'])) {
            $css .= ' font-family: ' . op_font_str($top_nav_font['font_family']) . ';';
        }
        if (!empty($top_nav_font['font_size'])) {
            $css .= ' font-size: ' . $top_nav_font['font_size'] . 'px;';
        }
        $css .= $nav_shadow . $nav_weight;
        $css .= '}';
    }
    if($top_nav = op_get_option('color_scheme_fields','top_nav_color')){
        $css .= '
body #nav-top.navigation,body #nav-top.navigation ul ul li { background-color: '.$top_nav.' }';
    }
    if($link_color = op_get_option('color_scheme_fields','link_color')){
        $css .= '
body #nav-top.navigation ul#navigation-above li a{ color: '.$link_color.' }';
    }
    if($top_nav_hover_link = op_get_option('color_scheme_fields','top_nav_hover_link')){
        $css .= '
body #nav-top.navigation ul#navigation-above li:hover a{ color: '.$top_nav_hover_link.' }';
    }
    if($top_nav_dd = op_get_option('color_scheme_fields','top_nav_dd')){
        $css .= '
body #nav-top.navigation ul#navigation-above li ul.sub-menu a { background-color: '.$top_nav_dd.' }';
    }
    if($top_nav_dd_hover = op_get_option('color_scheme_fields','top_nav_dd_hover')){
        $css .= '
body #nav-top.navigation ul#navigation-above li ul.sub-menu li:hover a { background-color: '.$top_nav_dd_hover.' }';
    }
    if($top_nav_dd_link = op_get_option('color_scheme_fields','top_nav_dd_link')){
        $css .= '
body #nav-top.navigation ul#navigation-above li ul.sub-menu li a { color: '.$top_nav_dd_link.' }';
    }
    if($top_nav_dd_hover_link = op_get_option('color_scheme_fields','top_nav_dd_hover_link')){
        $css .= '
body #nav-top.navigation ul#navigation-above li ul.sub-menu li:hover a { color: '.$top_nav_dd_hover_link.' }';
    }
    if($headline = op_get_option('color_scheme_fields','headline_title')){
        $css .= '
.op-page-header h2,.op-page-header h2 a, .op-page-header h2 span { color: '.$headline.' }';
    }

    if($layouts = op_theme_config('header_prefs','menu-positions')){
        $cur_layout = op_get_current_item($layouts,op_default_option('header_prefs','menu-position'));
        $layout = $layouts[$cur_layout];
        if(isset($layout['link_color']) && $layout['link_color'] === true){
            if($link_color = op_get_option('header_prefs','link_color')){
                $css .= '
'.$layout[(op_default_option('header_prefs','color_dropdowns')=='Y'?'dropdown_selector':'link_selector')].' { color: '.$link_color.' }';
            }
        }
    }
    $widths = theme1_column_widths();
    if(isset($widths['main-sidebar']) && $widths['main-sidebar'] != 309){
        $css .= '
.main-content .main-sidebar, .main-content .sidebar-bg { width:'.$widths['main-sidebar'].'px }'.(isset($widths['main-content'])?'
.main-content-area { width:'.$widths['main-content'].'px }':'');
    }
    if(($cols = op_get_option('footer_prefs','value')) && ($widths = op_get_option('footer_prefs','widths'))){
        if($cols > 1){
            $cols = $cols > 4 ? 4 : $cols;
            $cols++;
            for($i=1;$i<$cols;$i++){
                $int = intval(op_get_var($widths,$i,0));
                if($int > 0){
                    $css .= '
.sub-footer .col:nth-child('.$i.'){width:'.$int.'px}';
                }
            }
        } else {
            $css .= '
.sub-footer .col{width:'.op_theme_config('footer_prefs','full_width').'px;margin-right:0}';
        }
    }
    return $css;
}
add_filter('op_output_css','theme1_output_css');

function theme1_column_widths($widths=array()){
    static $newwidths;
    if(!isset($newwidths)){
        $newwidths = array(
            'main-sidebar' => op_get_column_width('main-sidebar')
        );
        if(defined('OP_SIDEBAR') && OP_SIDEBAR === false){
            $newwidths['main-content'] = 975;
            $newwidths['content-area'] = 915;
        } else {
            $newwidths['main-content'] = ((975-$newwidths['main-sidebar'])-36);
            $newwidths['content-area'] = $newwidths['main-content'];
        }
    }
    return $newwidths;
}
add_filter('op_column_widths','theme1_column_widths');

function theme1_nav_objects($menu_items,$args){
    $keys = array();
    $parent_ids = array();
    foreach($menu_items as $key => $item){
        $keys[$item->ID] = $key;
        if($item->menu_item_parent > 0 && isset($keys[$item->menu_item_parent])){
            $parent_ids[$keys[$item->menu_item_parent]] = true;
        }
    }
    $parent_ids = array_keys($parent_ids);
    foreach($parent_ids as $id){
        array_push($menu_items[$id]->classes,'menu-parent');
    }
    return $menu_items;
}

add_filter('wp_nav_menu_objects','theme1_nav_objects',10,2);

class Theme1_Category_Walker extends Walker_Category {

    function start_el(&$output, $category, $depth = 0, $args = array(), $current_object_id = 0) {
        extract($args);
        $cat_name = esc_attr( $category->name );
        $cat_name = apply_filters( 'list_cats', $cat_name, $category );
        $link = '<a href="' . esc_attr( get_term_link($category) ) . '" ';
        if ( $use_desc_for_title == 0 || empty($category->description) )
            $link .= 'title="' . esc_attr( sprintf(__( 'View all posts filed under %s' ), $cat_name) ) . '"';
        else
            $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
        $link .= '>';
        $link .= $cat_name . '</a>';

        if ( !empty($feed_image) || !empty($feed) ) {
            $link .= ' ';

            if ( empty($feed_image) )
                $link .= '(';

            $link .= '<a href="' . get_term_feed_link( $category->term_id, $category->taxonomy, $feed_type ) . '"';

            if ( empty($feed) ) {
                $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s' ), $cat_name ) . '"';
            } else {
                $title = ' title="' . $feed . '"';
                $alt = ' alt="' . $feed . '"';
                $name = $feed;
                $link .= $title;
            }

            $link .= '>';

            if ( empty($feed_image) )
                $link .= $name;
            else
                $link .= "<img src='$feed_image'$alt$title" . ' />';

            $link .= '</a>';

            if ( empty($feed_image) )
                $link .= ')';
        }

        if ( !empty($show_count) )
            $link .= ' <span>' . intval($category->count) . '</span>';

        if ( !empty($show_date) )
            $link .= ' ' . gmdate('Y-m-d', $category->last_update_timestamp);

        if ( 'list' == $args['style'] ) {
            $output .= "\t<li";
            $class = 'cat-item cat-item-' . $category->term_id;
            if ( !empty($current_category) ) {
                $_current_category = get_term( $current_category, $category->taxonomy );
                if ( $category->term_id == $current_category )
                    $class .=  ' current-cat';
                elseif ( $category->term_id == $_current_category->parent )
                    $class .=  ' current-cat-parent';
            }
            $output .=  ' class="' . $class . '"';
            $output .= ">$link\n";
        } else {
            $output .= "\t$link<br />\n";
        }
    }
}
function theme1_reinit_theme(){
    op_delete_option('header_prefs');
    op_delete_option('footer_prefs','widths');
}
add_action(OP_SN.'-reinit_theme','theme1_reinit_theme');