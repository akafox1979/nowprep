<?php
/*
    Our portfolio:  http://themeforest.net/user/tagDiv/portfolio
    Thanks for using our theme!
    tagDiv - 2017
*/


/**
 * Load the speed booster framework + theme specific files
 */

// load the deploy mode
require_once('td_deploy_mode.php');

// load the config
require_once('includes/td_config.php');
add_action('td_global_after', array('td_config', 'on_td_global_after_config'), 9); //we run on 9 priority to allow plugins to updage_key our apis while using the default priority of 10


// load the wp booster
require_once('includes/wp_booster/td_wp_booster_functions.php');


require_once('includes/td_css_generator.php');
require_once('includes/shortcodes/td_misc_shortcodes.php');
require_once('includes/widgets/td_page_builder_widgets.php'); // widgets


/*
 * mobile theme css generator
 * in wp-admin the main theme is loaded and the mobile theme functions are not included
 * required in td_panel_data_source
 * @todo - look for a more elegant solution(ex. generate the css on request)
 */
require_once('mobile/includes/td_css_generator_mob.php');


/* ----------------------------------------------------------------------------
 * Woo Commerce
 */

// breadcrumb
add_filter('woocommerce_breadcrumb_defaults', 'td_woocommerce_breadcrumbs');
function td_woocommerce_breadcrumbs() {
    return array(
        'delimiter' => ' <i class="td-icon-right td-bread-sep"></i> ',
        'wrap_before' => '<div class="entry-crumbs" itemprop="breadcrumb">',
        'wrap_after' => '</div>',
        'before' => '',
        'after' => '',
        'home' => _x('Home', 'breadcrumb', 'woocommerce'),
    );
}

// use own pagination
if (!function_exists('woocommerce_pagination')) {
    // pagination
    function woocommerce_pagination() {
        echo td_page_generator::get_pagination();
    }
}

// Override theme default specification for product 3 per row


// Number of product per page 8
add_filter('loop_shop_per_page', create_function('$cols', 'return 4;'));

if (!function_exists('woocommerce_output_related_products')) {
    // Number of related products
    function woocommerce_output_related_products() {
        woocommerce_related_products(array(
            'posts_per_page' => 4,
            'columns' => 4,
            'orderby' => 'rand',
        )); // Display 4 products in rows of 1
    }
}




/* ----------------------------------------------------------------------------
 * bbPress
 */
// change avatar size to 40px
function td_bbp_change_avatar_size($author_avatar, $topic_id, $size) {
    $author_avatar = '';
    if ($size == 14) {
        $size = 40;
    }
    $topic_id = bbp_get_topic_id( $topic_id );
    if ( !empty( $topic_id ) ) {
        if ( !bbp_is_topic_anonymous( $topic_id ) ) {
            $author_avatar = get_avatar( bbp_get_topic_author_id( $topic_id ), $size );
        } else {
            $author_avatar = get_avatar( get_post_meta( $topic_id, '_bbp_anonymous_email', true ), $size );
        }
    }
    return $author_avatar;
}
add_filter('bbp_get_topic_author_avatar', 'td_bbp_change_avatar_size', 20, 3);
add_filter('bbp_get_reply_author_avatar', 'td_bbp_change_avatar_size', 20, 3);
add_filter('bbp_get_current_user_avatar', 'td_bbp_change_avatar_size', 20, 3);



//add_action('shutdown', 'test_td');

function test_td () {
    if (!is_admin()){
        td_api_base::_debug_get_used_on_page_components();
    }

}


/**
 * tdStyleCustomizer.js is required
 */
if (TD_DEBUG_LIVE_THEME_STYLE) {
    add_action('wp_footer', 'td_theme_style_footer');
    // new live theme demos
    function td_theme_style_footer() {
        ?>
        <div id="td-theme-settings" class="td-live-theme-demos td-theme-settings-small">
            <div class="td-skin-body">
                <div class="td-skin-wrap">
                    <div class="td-skin-container td-skin-buy"><a target="_blank" href="http://themeforest.net/item/newspaper/5489609?ref=tagdiv">BUY NEWSPAPER NOW!</a></div>
                    <div class="td-skin-container td-skin-header">GET AN AWESOME START!</div>
                    <div class="td-skin-container td-skin-desc">With easy <span>ONE CLICK INSTALL</span> and fully customizable options, our demos are the best start you'll ever get!!</div>
                    <div class="td-skin-container td-skin-content">
                        <div class="td-demos-list">
                            <?php
                            $td_demo_names = array();

                            foreach (td_global::$demo_list as $demo_id => $stack_params) {
                                $td_demo_names[$stack_params['text']] = $demo_id;
                                ?>
                                <div class="td-set-theme-style"><a href="<?php echo td_global::$demo_list[$demo_id]['demo_url'] ?>" class="td-set-theme-style-link td-popup td-popup-<?php echo $td_demo_names[$stack_params['text']] ?>" data-img-url="<?php echo td_global::$get_template_directory_uri ?>/demos_popup/large/<?php echo $demo_id; ?>.jpg"><span></span></a></div>
                            <?php } ?>
                            <div class="td-set-theme-style-empty"><a href="#" class="td-popup td-popup-empty1"></a></div>
                            <div class="td-set-theme-style-empty"><a href="#" class="td-popup td-popup-empty2"></a></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="td-skin-scroll"><i class="td-icon-read-down"></i></div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="td-set-hide-show"><a href="#" id="td-theme-set-hide"></a></div>
            <div class="td-screen-demo" data-width-preview="380"></div>
        </div>
        <?php
    }

}

//td_demo_state::update_state("art_creek", 'full');

//print_r(td_global::$all_theme_panels_list);

add_action('wp_head', 'wp_add_ga');
function wp_add_ga() { ?>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-100852780-1', 'auto');
        ga('send', 'pageview');

    </script>
<?php }

require_once(get_template_directory().'/config/config.php');
require_once(get_template_directory().'/classes/class.WunderGround.php');


function hook_update_fema_function() {
    ini_set('memory_limit', '512M');
    global $wpdb;

    $return_disasters = array();
    $return_disaster_numbers = array();
    $wunderground = new WunderGround();
    if ($wpdb) {
        $date = date("Y-m-d");
        $mod_date = strtotime($date . "- 1 days");
        write_cron_log("Fema", "Start update");
        $json_string = file_get_contents(API_FEMA_ENDPOINT_WITHOUT_FILTER . "'" . date("Y-m-d", $mod_date) . "T00:00:00.000z'");
        //$json_string = file_get_contents("https://www.fema.gov/api/open/v1/DisasterDeclarationsSummaries.json");
        //$json_string = "[" . str_replace("}{", "},{", $json_string) . "]";
        $parsed_json = json_decode($json_string);
        $iCountAll = count($parsed_json);
        $iCount = 0;
        write_cron_log("Fema", sprintf("Load from server %d item(s) ",$iCountAll));
        foreach ($parsed_json as $disaster_json) {
            $disaster = null;
            $disaster = new FemaDisaster();
            if ($disaster) {
                $zipcodes = array();
                $disaster->initFemaDisaster($disaster_json);
                //write_cron_log("Fema", $disaster_json);
                //write_cron_log("Fema", sprintf("Checks Disaster with type: %s and #: %s ",$disaster_json->{'disasterType'},$disaster_json->{'disasterNumber'}));
                $iCount++;
                //echo "==================================================\n";
                //echo "Item : " . $iCount . " of " . $iCountAll . "\n";
                //echo "State = " . $disaster->getState() . " County = " . trim(str_replace('(County)', '', $disaster->getDeclaredCountyArea())) . "\n";
                $county_names = $wpdb->_real_escape(trim(str_replace('(County)', '', $disaster->getDeclaredCountyArea())));
                $county_names = $wpdb->_real_escape(trim(str_replace('(Parish)', 'Parish', $county_names)));
                $county_names = $wpdb->_real_escape(trim(str_replace('(Borough)', 'Borough', $county_names)));

                $sqlGetZipsList = "SELECT postal_code FROM zips WHERE state_code='" . $disaster->getState() . "' AND county_name LIKE '" . $county_names . "%'";
                $ZipsList = $wpdb->get_results($sqlGetZipsList, ARRAY_A);
                if (count($ZipsList) != 0) {
                    foreach ($ZipsList as $row) {
                        array_push($zipcodes, $row['postal_code']);
                    }
                }
//echo "ZIP Codes for county = " . join(',',$zipcodes). "\n";
//if($disaster->getState() != $state) continue;
//if(!in_array($disaster->getDisasterNumber(), $return_disaster_numbers))
                {
                    if ($wpdb) {
                        $sqlCheckDisaster = "SELECT id,zipcodes FROM fema WHERE id='" . $disaster->getId() . "'";
                        $disasterRow = $wpdb->get_results($sqlCheckDisaster, ARRAY_A);
                        if (count($disasterRow) == 0) {
                            //echo "DisasterNumber = " . $disaster->getDisasterNumber() . " not found, insert \n";
                            $sqlInsertDisaster = "INSERT INTO fema(
                                                    type,
                                                    disasterNumber,
                                                    state,
                                                    declarationDate,
                                                    disasterType,
                                                    incidentType,
                                                    title,
                                                    incidentBeginDate,
                                                    incidentEndDate,
                                                    disasterCloseOutDate,
                                                    placeCode,
                                                    declaredCountyArea,
                                                    lastRefresh,
                                                    hash,
                                                    id,
                                                    zipcodes,
                                                    object)
                                                    VALUES (
                                                    '" . $wpdb->_real_escape($disaster->getType()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getDisasterNumber()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getState()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getDeclarationDate()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getDisasterType()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getIncidentType()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getTitle()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getIncidentBeginDate()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getIncidentEndDate()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getDisasterCloseOutDate()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getPlaceCode()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getDeclaredCountyArea()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getLastRefresh()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getHash()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getId()) . "',
                                                    '" . json_encode($zipcodes) . "',
                                                    '" . json_encode($disaster_json) . "'
                                                    )";
//var_dump($sqlInsertDisaster);
                            $disasterInsertRow = $wpdb->get_results($sqlInsertDisaster, ARRAY_A);
                        } else {
                            $idfema = "";
                            foreach ($disasterRow as $row) {
                                $idfema = $row['id'];
                                $zipcodes1 = json_decode($row['zipcodes']);
                                if (is_array($zipcodes1)) {
                                    foreach ($zipcodes1 as $zip1) {
                                        if (!in_array($zip1, $zipcodes)) {
                                            array_push($zipcodes, $zip1);
                                        }
                                    }
                                }
                            }
                            if (is_array($zipcodes)) {
//if (!in_array($zipcode, $zipcodes)) {
//    array_push($zipcodes, $zipcode);
//}
                                $sqlUpdateDisaster = "UPDATE fema
SET placeCode = '" . $wpdb->_real_escape($disaster->getPlaceCode()) . "',
zipcodes ='" . json_encode($zipcodes) . "',
object = '" . json_encode($disaster_json) . "'
WHERE id='" . $idfema . "'";
                                //echo "DisasterNumber = " . $disaster->getDisasterNumber() . " found DBID = " . $idfema . ", update\n";
                                $disasterUpdateRow = $wpdb->get_results($sqlUpdateDisaster, ARRAY_A);
                            }
                        }
                    }
                }
                if (!in_array($disaster->getDisasterNumber(), $return_disaster_numbers)) {
                    array_push($return_disaster_numbers, $disaster->getDisasterNumber());
                    array_push($return_disasters, $disaster);
                }
//$disasterRow->free_result();
            }
            $disaster_json = null;
        }
        write_cron_log("Fema", " Finish update");

    }

}

function hook_update_eq_function() {

    global $wpdb;
    $wunderground = new WunderGround();
    if( $wpdb) {
        $sqlGetConfig = "SELECT usgs_date, DATE_ADD(usgs_date, INTERVAL -1 DAY) as usgs_date_start, DATE_ADD(usgs_date, INTERVAL 1 DAY) as usgs_date_end FROM data_config";
        $config = $wpdb->get_results($sqlGetConfig, ARRAY_A);
        $date_start = null;
        $date_end = null;
        $date = null;
        if (count($config) != 0) {
            foreach ($config as $row) {
                $date_start = $row['usgs_date_start'];
                $date_end = $row['usgs_date_end'];
                $date = $row['usgs_date'];
            }
            //echo "Date start: " . $date_start . "\n";
            //echo "Date end: " . $date_end . "\n";
            write_cron_log("Earthquakes", "Start update");
            if(($date_start != null) && ($date_end != null)) {
                $eqs = $wunderground->getUSGSData($date_start,$date_end);
                if ($eqs != null) {
                    write_cron_log("Earthquakes", sprintf("Load from server %d item(s)", count($eqs)));
                    $sqlSetConfig = "UPDATE data_config SET usgs_date = NOW()";
                    $configSets = $wpdb->query($sqlSetConfig);
                    write_cron_log("Earthquakes", "Finish update");
                }
            }
        }
    }
}

function hook_update_ch_function() {
    global $wpdb;
    $wunderground = new WunderGround();
    if( $wpdb) {
        write_cron_log("Hurricanes", "Start update");
        $eqs = $wunderground->getCurrentHurricanes();
        write_cron_log("Hurricanes", sprintf("Load from server %d item(s)", count($eqs)));
        write_cron_log("Hurricanes", "Finish update");
    }
}

function hook_update_wund_function() {
//return;
    global $wpdb;
    $wunderground = new WunderGround();
    if( $wpdb) {
        write_cron_log("Alerts", "Start update");
        $sqlGetConfig = "SELECT wund_count FROM data_config";
        $config = $wpdb->get_results($sqlGetConfig,ARRAY_A);
        if(count($config) != 0) {
            $iCountWund = 0;
            foreach ($config as $row) {
                $iCountWund = $row['wund_count'];
            }

            $sqlGetZips = "SELECT * FROM zips WHERE w_update = 0 ORDER BY postal_code ASC";
            $zipcodes = $wpdb->get_results($sqlGetZips, ARRAY_A);
            if (count($zipcodes) != 0) {
                //echo "======================================== \n";
                //echo "Zipcodes left : " . $zipcodes->num_rows . "\n";
                $iCount = 0;
                foreach ($zipcodes as $row) {
                    if ($iCount == $iCountWund)
                        break;

                    $zipcode = $row['postal_code'];
                    if (!empty($zipcode)) {
                        $iCount++;
                        echo "======================================== \n";
                        $alerts = $wunderground->getAlertsFromZipCode($zipcode);
                        write_cron_log("Alerts", sprintf("Load from server for zip(%s) %d item(s) ",$zipcode, count($alerts)));
                        $disasters = null;
                        //echo "ZipCode: " . $zipcode . "\n";
                        if (empty($row['state_name'])) {
                        } else {
                            //echo "State By ZipCode: " . $row['state_name'] . "(" . $row['state_code'] . ")" . "\n";
                        }

                        if (is_array($alerts)) {
                            foreach ($alerts as $alert) {
                                if (is_object($alert)) {
                                    //echo "Alerts count: " . count($alerts) . "\n";
                                    break;
                                } else {
                                    //echo "Error: " . $alerts['error_msg'] . "\n";
                                    break;
                                }
                            }
                        }
                        if ($disasters != null) {
                            foreach (array_reverse($disasters) as $disaster) {
                                if (is_object($disaster)) {
                                    //echo "Disasters count: " . count($disasters) . "\n";
                                    break;
                                } else {
                                    //echo "Error: " . $disasters['error_msg'] . "\n";
                                    break;
                                }
                            }
                        }
                        $alerts = array();
                        $disasters = array();
                        $sqlSetFemaZips = "UPDATE zips SET w_update = 1 WHERE postal_code = '" . $zipcode . "'";
                        $zipcodesSet = $wpdb->query($sqlSetFemaZips);
                        //$zipcodesSet->free_result();

                        //echo "======================================== \n";
                    }
                }
            } else {
                $sqlClearFemaZips = "UPDATE zips SET w_update = 0 WHERE w_update = 1";
                $zipcodesClear = $wpdb->query($sqlClearFemaZips);
            }
        }
        write_cron_log("Alerts", "Finish update");
    }

}

function add_cron_hook_update_fema( $schedules ) {
    $schedules['hook_update_fema'] = array(
        'interval' => 600,
        'display'  => esc_html__( 'Update data every 10 min' ),
    );

    return $schedules;
}
add_filter( 'cron_schedules', 'add_cron_hook_update_fema' );

function add_cron_update_wund_partial( $schedules ) {
    $schedules['update_wund_partial'] = array(
        'interval' => 900,
        'display'  => esc_html__( 'Update data every 15 min' ),
    );

    return $schedules;
}
add_filter( 'cron_schedules', 'add_cron_update_wund_partial' );

function my_activation() {
    if (! wp_next_scheduled ( 'hook_update_usgs' )) {
        wp_schedule_event(time(), 'twicedaily', 'hook_update_usgs');
    }
    if (! wp_next_scheduled ( 'hook_update_fema' )) {
        wp_schedule_event(time(), 'hook_update_fema', 'hook_update_fema');
    }
    if (! wp_next_scheduled ( 'hook_update_wund' )) {
        wp_schedule_event(time(), 'update_wund_partial', 'hook_update_wund');
    }

}

my_activation();

add_action( 'hook_update_fema', 'hook_update_fema_function' );
add_action( 'hook_update_wund', 'hook_update_wund_function' );
add_action( 'hook_update_usgs', 'hook_update_eq_function' );
add_action( 'hook_update_usgs', 'hook_update_ch_function');

function write_cron_log($task, $message) {
    if( function_exists( 'log_error' )) {

        log_notice(sprintf("%s : %s : %s", (new \DateTime())->format('Y-m-d H:i:s'), $task, $message));

    }
}