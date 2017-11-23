<?php
global $post;
//header( 'Cache-Control: max-age=604800' );
$class = (defined('OP_LIVEEDITOR') ? ' op-live-editor' : '');
?><!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6<?php echo $class ?>" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7<?php echo $class ?>" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8<?php echo $class ?>" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html<?php echo $class == '' ? '' : ' class="' . $class . '"'; ?> <?php language_attributes(); ?>> <!--<![endif]-->
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>"/>
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <!-- Global Site Tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-100852780-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments)
        };
        gtag('js', new Date());

        gtag('config', 'UA-100852780-1');
    </script>
    <?php
    //   op_set_seo_title();
    ?>
    <?php
    if (is_singular() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply', false, array(OP_SCRIPT_BASE), OP_VERSION);
    }
    //wp_head();
    //var_dump(get_page()->post_name);
    //global $post;
    //var_dump($post->ID);



    if ($post->ID == 3985) { ?>
        <title>ReadyPower Emergency Radio - Shipping Info</title>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"/>
        <meta property="og:title" content="Prepare for Disaster with ReadyPower"/>
        <meta property="og:description"
              content="This vault will keep your life organized and valuables safe before, after and during an emergency. The NowPrep Vault holds everything you need in a disaster: legal documents to protect your home and finances, life-saving first aid instructions, and survival resources for any type of emergency."/>
        <meta property="og:image" content="https://start.nowprep.com/wp-content/uploads/71NZSW2EfpL._SL1500_.jpg"/>
        <meta property="og:image:width" content="1500"/>
        <meta property="og:image:height" content="1500"/>
    <?php } else if ($post->ID == 3840 || $post->ID == 3899 || $post->ID == 3954 || $post->ID == 3975  || $post->ID == 3997 || $post->ID == 4055 || $post->ID == 4128 || $post->ID == 4445 || $post->ID == 4460 || $post->ID == 4475 || $post->ID == 4490) { ?>
        <title>ReadyPower Emergency Radio - Order Info</title>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"/>
        <meta property="og:title" content="Prepare for Disaster with ReadyPower"/>
        <meta property="og:description"
              content="This vault will keep your life organized and valuables safe before, after and during an emergency. The NowPrep Vault holds everything you need in a disaster: legal documents to protect your home and finances, life-saving first aid instructions, and survival resources for any type of emergency."/>
        <meta property="og:image" content="https://start.nowprep.com/wp-content/uploads/71NZSW2EfpL._SL1500_.jpg"/>
        <meta property="og:image:width" content="1500"/>
        <meta property="og:image:height" content="1500"/>
    <?php } else if ($post->ID == 3683 || $post->ID == 3719 || $post->ID == 3794 || $post->ID == 3731 || $post->ID == 3480 || $post->ID == 3351 || $post->ID == 3503 || $post->ID == 3833 || $post->ID == 3836 || $post->ID == 3945 || $post->ID == 3948 || $post->ID == 3951 || $post->ID == 4047 || $post->ID == 4222 || $post->ID == 4347 || $post->ID == 4362 || $post->ID == 4385 || $post->ID == 4405 || $post->ID == 4425) { ?>
        <title>ReadyPower Emergency Radio</title>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"/>
        <meta property="og:title" content="Prepare for Disaster with ReadyPower"/>
        <meta property="og:description"
              content="This vault will keep your life organized and valuables safe before, after and during an emergency. The NowPrep Vault holds everything you need in a disaster: legal documents to protect your home and finances, life-saving first aid instructions, and survival resources for any type of emergency."/>
        <meta property="og:image" content="https://start.nowprep.com/wp-content/uploads/71NZSW2EfpL._SL1500_.jpg"/>
        <meta property="og:image:width" content="1500"/>
        <meta property="og:image:height" content="1500"/>
    <?php } else if ($post->ID == 3769 || $post->ID == 3959 || $post->ID == 4069) { ?>
        <title>ReadyPower Emergency Radio - Payment Info</title>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"/>
        <meta property="og:title" content="Prepare for Disaster with The Radio"/>
        <meta property="og:description"
              content="This vault will keep your life organized and valuables safe before, after and during an emergency. The NowPrep Vault holds everything you need in a disaster: legal documents to protect your home and finances, life-saving first aid instructions, and survival resources for any type of emergency."/>
        <meta property="og:image" content="https://start.nowprep.com/wp-content/uploads/71NZSW2EfpL._SL1500_.jpg"/>
        <meta property="og:image:width" content="1500"/>
        <meta property="og:image:height" content="1500"/>
    <?php } else if ($post->ID == 3750) { ?>
        <title>NowPrep Radio - Order Info</title>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="https://start.nowprep.com/ready-power-v3/order-info/"/>
        <meta property="og:title" content="Prepare for Disaster with The Radio"/>
        <meta property="og:description"
              content="This vault will keep your life organized and valuables safe before, after and during an emergency. The NowPrep Vault holds everything you need in a disaster: legal documents to protect your home and finances, life-saving first aid instructions, and survival resources for any type of emergency."/>
        <meta property="og:image" content="https://start.nowprep.com/wp-content/uploads/71NZSW2EfpL._SL1500_.jpg"/>
        <meta property="og:image:width" content="1500"/>
        <meta property="og:image:height" content="1500"/>
    <?php } else if ($post->ID == 3794) { ?>
        <title>NowPrep Radio</title>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="https://start.nowprep.com/ready-power-v3/"/>
        <meta property="og:title" content="Prepare for Disaster with The Radio"/>
        <meta property="og:description"
              content="This vault will keep your life organized and valuables safe before, after and during an emergency. The NowPrep Vault holds everything you need in a disaster: legal documents to protect your home and finances, life-saving first aid instructions, and survival resources for any type of emergency."/>
        <meta property="og:image" content="https://start.nowprep.com/wp-content/uploads/71NZSW2EfpL._SL1500_.jpg"/>
        <meta property="og:image:width" content="1500"/>
        <meta property="og:image:height" content="1500"/>
    <?php } else if ($post->ID == 3255 || $post->ID == 3480 || $post->ID == 3351 || $post->ID == 3503 || $post->ID == 3683 || $post->ID == 3719) { ?>
        <title>NowPrep Radio</title>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="https://start.nowprep.com/radio"/>
        <meta property="og:title" content="Prepare for Disaster with The Radio"/>
        <meta property="og:description"
              content="This vault will keep your life organized and valuables safe before, after and during an emergency. The NowPrep Vault holds everything you need in a disaster: legal documents to protect your home and finances, life-saving first aid instructions, and survival resources for any type of emergency."/>
        <meta property="og:image" content="https://start.nowprep.com/wp-content/uploads/71NZSW2EfpL._SL1500_.jpg"/>
        <meta property="og:image:width" content="1500"/>
        <meta property="og:image:height" content="1500"/>
    <?php } else if ($post->ID == 3326 || $post->ID == 3399 || $post->ID == 3540 || $post->ID == 3623 || $post->ID == 3684 || $post->ID == 3723 || $post->ID == 3731) { ?>
        <title>Order - NowPrep Radio</title>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="https://start.nowprep.com/radio/order-info"/>
        <meta property="og:title" content="Prepare for Disaster with The Radio"/>
        <meta property="og:description"
              content="This vault will keep your life organized and valuables safe before, after and during an emergency. The NowPrep Vault holds everything you need in a disaster: legal documents to protect your home and finances, life-saving first aid instructions, and survival resources for any type of emergency."/>
        <meta property="og:image" content="https://start.nowprep.com/wp-content/uploads/71NZSW2EfpL._SL1500_.jpg"/>
        <meta property="og:image:width" content="1500"/>
        <meta property="og:image:height" content="1500"/>
    <?php } else if ($post->ID == 3329 || $post->ID == 3472) { ?>
        <title>Thank You - NowPrep Radio</title>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="https://start.nowprep.com/radio/thank-you"/>
        <meta property="og:title" content="Prepare for Disaster with The Radio"/>
        <meta property="og:description"
              content="This vault will keep your life organized and valuables safe before, after and during an emergency. The NowPrep Vault holds everything you need in a disaster: legal documents to protect your home and finances, life-saving first aid instructions, and survival resources for any type of emergency."/>
        <meta property="og:image" content="https://start.nowprep.com/wp-content/uploads/71NZSW2EfpL._SL1500_.jpg"/>
        <meta property="og:image:width" content="1500"/>
        <meta property="og:image:height" content="1500"/>
    <?php } else if ($post->ID == 1712) { ?>
        <title>Thank You - NowPrep Ready Vault</title>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="https://start.nowprep.com/ready-vault/thank-you"/>
        <meta property="og:title" content="Prepare for Disaster with The NowPrep Vault"/>
        <meta property="og:description"
              content="This vault will keep your life organized and valuables safe before, after and during an emergency. The NowPrep Vault holds everything you need in a disaster: legal documents to protect your home and finances, life-saving first aid instructions, and survival resources for any type of emergency."/>
        <meta property="og:image" content="https://start.nowprep.com/wp-content/uploads/box5_metal_2-1.jpg"/>
        <meta property="og:image:width" content="1200"/>
        <meta property="og:image:height" content="667"/>
    <?php } else if ($post->ID == 2608 || $post->ID == 2826 || $post->ID == 2873 || $post->ID == 2808) { ?>
        <title>NowPrep Ready Vault</title>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="https://start.nowprep.com/ready-vault"/>
        <meta property="og:title" content="Prepare for Disaster with The NowPrep Vault"/>
        <meta property="og:description"
              content="This vault will keep your life organized and valuables safe before, after and during an emergency. The NowPrep Vault holds everything you need in a disaster: legal documents to protect your home and finances, life-saving first aid instructions, and survival resources for any type of emergency."/>
        <meta property="og:image" content="https://start.nowprep.com/wp-content/uploads/box5_metal_2-1.jpg"/>
        <meta property="og:image:width" content="1200"/>
        <meta property="og:image:height" content="667"/>
    <?php } else if ($post->ID == 1703) { ?>
        <title>Order - NowPrep Ready Vault</title>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="https://start.nowprep.com/ready-vault/order-info"/>
        <meta property="og:title" content="Prepare for Disaster with The NowPrep Vault"/>
        <meta property="og:description"
              content="This vault will keep your life organized and valuables safe before, after and during an emergency. The NowPrep Vault holds everything you need in a disaster: legal documents to protect your home and finances, life-saving first aid instructions, and survival resources for any type of emergency."/>
        <meta property="og:image" content="https://start.nowprep.com/wp-content/uploads/box5_metal_2-1.jpg"/>
        <meta property="og:image:width" content="1200"/>
        <meta property="og:image:height" content="667"/>
    <?php } else if (is_page("ice-wizard") || is_page("ice-wizard-v2") || is_page("resident") || is_page("ice-wizard-v3")) { ?>
        <title>FREE I.C.E. Card</title>
        <meta property="og:type" content="website"/>
        <meta property="og:url"
              content="https://start.nowprep.com/ice-wizard/?utm_source=facebook&utm_medium=organic-social&utm_campaign=OG_Meta"/>
        <meta property="og:title" content="FREE In Case of Emergency (I.C.E.) Card"/>
        <meta property="og:description"
              content="When &quot;SECONDS COUNT&quot; The Vital Information on this Card is used by First Responders to Protect You!"/>
        <meta property="og:image"
              content="https://start.nowprep.com/wp-content/uploads/Emergency-Card-Meta-Image-1.jpg"/>
        <meta property="og:image:width" content="1200"/>
        <meta property="og:image:height" content="628"/>
    <?php } else if (is_page("personal-info")) { ?>
        <title>I.C.E. Card - Personal Info</title>
        <meta property="og:type" content="website"/>
        <meta property="og:url"
              content="https://start.nowprep.com/ice-wizard/?utm_source=facebook&utm_medium=organic-social&utm_campaign=OG_Meta"/>
        <meta property="og:title" content="FREE In Case of Emergency (I.C.E.) Card"/>
        <meta property="og:description"
              content="When &quot;SECONDS COUNT&quot; The Vital Information on this Card is used by First Responders to Protect You!"/>
        <meta property="og:image"
              content="https://start.nowprep.com/wp-content/uploads/Emergency-Card-Meta-Image-1.jpg"/>
        <meta property="og:image:width" content="1200"/>
        <meta property="og:image:height" content="628"/>
    <?php } else if (is_page("contacts")) { ?>
        <title>I.C.E. Card - Contacts</title>
        <meta property="og:type" content="website"/>
        <meta property="og:url"
              content="https://start.nowprep.com/ice-wizard/?utm_source=facebook&utm_medium=organic-social&utm_campaign=OG_Meta"/>
        <meta property="og:title" content="FREE In Case of Emergency (I.C.E.) Card"/>
        <meta property="og:description"
              content="When &quot;SECONDS COUNT&quot; The Vital Information on this Card is used by First Responders to Protect You!"/>
        <meta property="og:image"
              content="https://start.nowprep.com/wp-content/uploads/Emergency-Card-Meta-Image-1.jpg"/>
        <meta property="og:image:width" content="1200"/>
        <meta property="og:image:height" content="628"/>
    <?php } else if (is_page("blood-type")) { ?>
        <title>I.C.E. Card - Blood Type</title>
        <meta property="og:type" content="website"/>
        <meta property="og:url"
              content="https://start.nowprep.com/ice-wizard/?utm_source=facebook&utm_medium=organic-social&utm_campaign=OG_Meta"/>
        <meta property="og:title" content="FREE In Case of Emergency (I.C.E.) Card"/>
        <meta property="og:description"
              content="When &quot;SECONDS COUNT&quot; The Vital Information on this Card is used by First Responders to Protect You!"/>
        <meta property="og:image"
              content="https://start.nowprep.com/wp-content/uploads/Emergency-Card-Meta-Image-1.jpg"/>
        <meta property="og:image:width" content="1200"/>
        <meta property="og:image:height" content="628"/>
    <?php } else if (is_page("medication-allergies")) { ?>
        <title>I.C.E. Card - Drug Allergies</title>
        <meta property="og:type" content="website"/>
        <meta property="og:url"
              content="https://start.nowprep.com/ice-wizard/?utm_source=facebook&utm_medium=organic-social&utm_campaign=OG_Meta"/>
        <meta property="og:title" content="FREE In Case of Emergency (I.C.E.) Card"/>
        <meta property="og:description"
              content="When &quot;SECONDS COUNT&quot; The Vital Information on this Card is used by First Responders to Protect You!"/>
        <meta property="og:image"
              content="https://start.nowprep.com/wp-content/uploads/Emergency-Card-Meta-Image-1.jpg"/>
        <meta property="og:image:width" content="1200"/>
        <meta property="og:image:height" content="628"/>
    <?php } else if (is_page("food-allergies")) { ?>
        <title>I.C.E. Card - Food Allergies</title>
        <meta property="og:type" content="website"/>
        <meta property="og:url"
              content="https://start.nowprep.com/ice-wizard/?utm_source=facebook&utm_medium=organic-social&utm_campaign=OG_Meta"/>
        <meta property="og:title" content="FREE In Case of Emergency (I.C.E.) Card"/>
        <meta property="og:description"
              content="When &quot;SECONDS COUNT&quot; The Vital Information on this Card is used by First Responders to Protect You!"/>
        <meta property="og:image"
              content="https://start.nowprep.com/wp-content/uploads/Emergency-Card-Meta-Image-1.jpg"/>
        <meta property="og:image:width" content="1200"/>
        <meta property="og:image:height" content="628"/>
    <?php } else if (is_page("shipping-info") || is_page("shipping-info-v3")) { ?>
        <title>I.C.E. Card - Shipping Info</title>
        <meta property="og:type" content="website"/>
        <meta property="og:url"
              content="https://start.nowprep.com/ice-wizard/?utm_source=facebook&utm_medium=organic-social&utm_campaign=OG_Meta"/>
        <meta property="og:title" content="FREE In Case of Emergency (I.C.E.) Card"/>
        <meta property="og:description"
              content="When &quot;SECONDS COUNT&quot; The Vital Information on this Card is used by First Responders to Protect You!"/>
        <meta property="og:image"
              content="https://start.nowprep.com/wp-content/uploads/Emergency-Card-Meta-Image-1.jpg"/>
        <meta property="og:image:width" content="1200"/>
        <meta property="og:image:height" content="628"/>
    <?php } else if (is_page("payment-info") || is_page("payment-info-v3")) { ?>
        <title>I.C.E. Card - Payment Info</title>
        <meta property="og:type" content="website"/>
        <meta property="og:url"
              content="https://start.nowprep.com/ice-wizard/?utm_source=facebook&utm_medium=organic-social&utm_campaign=OG_Meta"/>
        <meta property="og:title" content="FREE In Case of Emergency (I.C.E.) Card"/>
        <meta property="og:description"
              content="When &quot;SECONDS COUNT&quot; The Vital Information on this Card is used by First Responders to Protect You!"/>
        <meta property="og:image"
              content="https://start.nowprep.com/wp-content/uploads/Emergency-Card-Meta-Image-1.jpg"/>
        <meta property="og:image:width" content="1200"/>
        <meta property="og:image:height" content="628"/>
    <?php } else if (is_page("thank-you") && $post->ID != 1712) { ?>
        <title>I.C.E. Card - Thank You</title>
        <meta property="og:type" content="website"/>
        <meta property="og:url"
              content="https://start.nowprep.com/ice-wizard/?utm_source=facebook&utm_medium=organic-social&utm_campaign=OG_Meta"/>
        <meta property="og:title" content="FREE In Case of Emergency (I.C.E.) Card"/>
        <meta property="og:description"
              content="When &quot;SECONDS COUNT&quot; The Vital Information on this Card is used by First Responders to Protect You!"/>
        <meta property="og:image"
              content="https://start.nowprep.com/wp-content/uploads/Emergency-Card-Meta-Image-1.jpg"/>
        <meta property="og:image:width" content="1200"/>
        <meta property="og:image:height" content="628"/>
    <?php } else { ?>
    <?php }

    wp_head();
    ?>
    <script src="https://start.nowprep.com/wp-includes/js/jquery/jquery.js?ver=1.12.4"></script>
    <script type="text/javascript">
        window._mfq = window._mfq || [];
        (function () {
            var mf = document.createElement("script");
            mf.type = "text/javascript";
            mf.async = true;
            mf.src = "//cdn.mouseflow.com/projects/fbfafdc6-ad9b-44c2-9f23-c1b62baafb20.js";
            document.getElementsByTagName("head")[0].appendChild(mf);
        })();
    </script>

    <!-- Start Visual Website Optimizer Asynchronous Code -->
    <script type='text/javascript'>
        var _vwo_code = (function () {
            var account_id = 324028,
                settings_tolerance = 2000,
                library_tolerance = 2500,
                use_existing_jquery = false,
                /* DO NOT EDIT BELOW THIS LINE */
                f = false, d = document;
            return {
                use_existing_jquery: function () {
                    return use_existing_jquery;
                }, library_tolerance: function () {
                    return library_tolerance;
                }, finish: function () {
                    if (!f) {
                        f = true;
                        var a = d.getElementById('_vis_opt_path_hides');
                        if (a) a.parentNode.removeChild(a);
                    }
                }, finished: function () {
                    return f;
                }, load: function (a) {
                    var b = d.createElement('script');
                    b.src = a;
                    b.type = 'text/javascript';
                    b.innerText;
                    b.onerror = function () {
                        _vwo_code.finish();
                    };
                    d.getElementsByTagName('head')[0].appendChild(b);
                }, init: function () {
                    settings_timer = setTimeout('_vwo_code.finish()', settings_tolerance);
                    var a = d.createElement('style'),
                        b = 'body{opacity:0 !important;filter:alpha(opacity=0) !important;background:none !important;}',
                        h = d.getElementsByTagName('head')[0];
                    a.setAttribute('id', '_vis_opt_path_hides');
                    a.setAttribute('type', 'text/css');
                    if (a.styleSheet) a.styleSheet.cssText = b; else a.appendChild(d.createTextNode(b));
                    h.appendChild(a);
                    this.load('//dev.visualwebsiteoptimizer.com/j.php?a=' + account_id + '&u=' + encodeURIComponent(d.URL) + '&r=' + Math.random());
                    return settings_timer;
                }
            };
        }());
        _vwo_settings_timer = _vwo_code.init();
    </script>
    <!-- End Visual Website Optimizer Asynchronous Code -->
</head>

<?php
function split_name($name)
{
    $parts = array();

    while (strlen(trim($name)) > 0) {
        $name = trim($name);
        $string = preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $parts[] = $string;
        $name = trim(preg_replace('#' . $string . '#', '', $name));
    }

    if (empty($parts)) {
        return false;
    }

    $parts = array_reverse($parts);
    $name = array();
    $name['first_name'] = $parts[0];
    $name['middle_name'] = (isset($parts[2])) ? $parts[1] : '';
    $name['last_name'] = (isset($parts[2])) ? $parts[2] : (isset($parts[1]) ? $parts[1] : '');

    return $name;
}

require_once(get_template_directory() . "/lib/iSDK-master/isdk.php");

if (is_front_page()) {
    $_utmsource = (isset($_GET['utm_source']) ? $_GET['utm_source'] : "");
    $_utmmedium = (isset($_GET['utm_medium']) ? $_GET['utm_medium'] : "");
    $_utmcampaign = (isset($_GET['utm_campaign']) ? $_GET['utm_campaign'] : "");
    $_utmterm = (isset($_GET['utm_term']) ? $_GET['utm_term'] : "");
    $_utmcontent = (isset($_GET['utm_content']) ? $_GET['utm_content'] : "");
    ?>
    <script>
        var postData = {
            _utmsource: "<?php echo $_utmsource;?>",
            _utmmedium: "<?php echo $_utmmedium;?>",
            _utmcampaign: "<?php echo $_utmcampaign;?>",
            _utmterm: "<?php echo $_utmterm;?>",
            _utmcontent: "<?php echo $_utmcontent;?>"
        }
    </script>
    <?php
}

if (isset($_GET)) {
    if (is_page("get-pdf")) {
        $contactData = array(
            "mode" => "",
            "firstname" => "",
            "email" => "",
            "name1" => "",
            "name2" => "",
            "email1" => "",
            "email2" => "",
            "phone1" => "",
            "phone2" => "",
            "address1" => "",
            "address2" => ""
        );
        $contactID = 0;
        if (isset($_GET['ec'])) {
            $contactData["mode"] = "ec";
            $contactID = $_GET['ec'];
        } else if (isset($_GET['bp'])) {
            $contactData["mode"] = "bp";
            $contactID = $_GET['bp'];
        } else if (isset($_GET['ecc'])) {
            $contactData["mode"] = "ecc";
            $contactID = $_GET['ecc'];
        } else if (isset($_GET['ecs'])) {
            $contactData["mode"] = "ecs";
            $contactID = $_GET['ecs'];
        } else if (isset($_GET['bpc'])) {
            $contactData["mode"] = "bpc";
            $contactID = $_GET['bpc'];
        }
//var_dump($contactData["mode"]);die();
        if (!empty($contactID)) {
            $conID = base64_decode($contactID);
            $conID = $conID - 2000;
            if ($conID > 0) {
                $app = new iSDK;
                if ($app->cfgCon("vp389")) {
                    if ($contactData["mode"] == "ec" || $contactData["mode"] == "bp") {
                        $returnFields = array(
                            "Email",
                            "FirstName",
                            "LastName",
                            "_Contact1Name",
                            "_Contact1Email",
                            "_Contact1Phone",
                            "_Contact1Address0",
                            "_Contact2Name",
                            "_Contact1Email0",
                            "_Contact2Phone",
                            "_Contact2Address"
                        );
                        $conDat = $app->loadCon($conID, $returnFields);
                        if (is_array($conDat)) {
                            $contactData["conID"] = $conID;
                            $contactData["firstname"] = trim((is_null($conDat["FirstName"]) ? "" : $conDat["FirstName"]) . " " . (is_null($conDat["LastName"]) ? "" : $conDat["LastName"]));
                            $contactData["email"] = (is_null($conDat["Email"]) ? "" : $conDat["Email"]);
                            $contactData["name1"] = (is_null($conDat["_Contact1Name"]) ? "" : $conDat["_Contact1Name"]);
                            $contactData["name2"] = (is_null($conDat["_Contact2Name"]) ? "" : $conDat["_Contact2Name"]);
                            $contactData["email1"] = (is_null($conDat["_Contact1Email"]) ? "" : $conDat["_Contact1Email"]);
                            $contactData["email2"] = (is_null($conDat["_Contact1Email0"]) ? "" : $conDat["_Contact1Email0"]);
                            $contactData["phone1"] = (is_null($conDat["_Contact1Phone"]) ? "" : $conDat["_Contact1Phone"]);
                            $contactData["phone2"] = (is_null($conDat["_Contact2Phone"]) ? "" : $conDat["_Contact2Phone"]);
                            $contactData["address1"] = (is_null($conDat["_Contact1Address0"]) ? "" : $conDat["_Contact1Address0"]);
                            $contactData["address2"] = (is_null($conDat["_Contact2Address"]) ? "" : $conDat["_Contact2Address"]);
                        }
                    } else {
                        if ($contactData["mode"] == "ecc" || $contactData["mode"] == "ecs") {
                            $returnFields = array(
                                "Email",
                                "FirstName",
                                "LastName",
                                "_WhoFor",
                                "_PersonalInfoSex",
                                "_PersonalInfoDOB",
                                "_PersonalInfoName",
                                "_PersonalInfoPhone",
                                "_PersonalInfoEmail",
                                "_PersonalInfoOther",
                                "_ContactsAddressPrimaryName",
                                "_ContactsAddressPrimaryRelation",
                                "_ContactsAddressPrimaryPhone",
                                "_ContactsAddressPrimaryEmail",
                                "_ContactsAddressSecondaryName",
                                "_ContactsAddressSecondaryRelation",
                                "_ContactsAddressSecondaryPhone",
                                "_ContactsAddressSecondaryEmail",
                                "_ContactsAddressAddressType",
                                "_ContactsAddressAddress",
                                "_BloodType",
                                "_AllergiesMedicineOptions",
                                "_AllergiesMedicineOther",
                                "_AllergiesFoodOptions",
                                "_AllergiesFoodOther",
                                "_AdditionalMedicalInformation",
                                "_AdditionalMiscInformation"
                            );
                            $conDat = $app->loadCon($conID, $returnFields);
                            if (is_array($conDat)) {
                                $contactData["conID"] = $conID;
                                $contactData["firstname"] = trim((is_null($conDat["FirstName"]) ? "" : $conDat["FirstName"]) . " " . (is_null($conDat["LastName"]) ? "" : $conDat["LastName"]));

                                $contactData["Email"] = (is_null($conDat["Email"]) ? "" : $conDat["Email"]);
                                $contactData["_WhoFor"] = (is_null($conDat["_WhoFor"]) ? "" : $conDat["_WhoFor"]);
                                $contactData["_PersonalInfoSex"] = (is_null($conDat["_PersonalInfoSex"]) ? "" : $conDat["_PersonalInfoSex"]);

                                $contactData["_PersonalInfoDOB"] = (is_null($conDat["_PersonalInfoDOB"]) ? "" : $conDat["_PersonalInfoDOB"]);
                                $contactData["_PersonalInfoName"] = (is_null($conDat["_PersonalInfoName"]) ? "" : $conDat["_PersonalInfoName"]);
                                $contactData["_PersonalInfoPhone"] = (is_null($conDat["_PersonalInfoPhone"]) ? "" : $conDat["_PersonalInfoPhone"]);
                                $contactData["_PersonalInfoEmail"] = (is_null($conDat["_PersonalInfoEmail"]) ? "" : $conDat["_PersonalInfoEmail"]);
                                $contactData["_PersonalInfoOther"] = (is_null($conDat["_PersonalInfoOther"]) ? "" : $conDat["_PersonalInfoOther"]);
                                $contactData["_ContactsAddressPrimaryName"] = (is_null($conDat["_ContactsAddressPrimaryName"]) ? "" : $conDat["_ContactsAddressPrimaryName"]);
                                $contactData["_ContactsAddressPrimaryRelation"] = (is_null($conDat["_ContactsAddressPrimaryRelation"]) ? "" : $conDat["_ContactsAddressPrimaryRelation"]);
                                $contactData["_ContactsAddressPrimaryPhone"] = (is_null($conDat["_ContactsAddressPrimaryPhone"]) ? "" : $conDat["_ContactsAddressPrimaryPhone"]);
                                $contactData["_ContactsAddressPrimaryEmail"] = (is_null($conDat["_ContactsAddressPrimaryEmail"]) ? "" : $conDat["_ContactsAddressPrimaryEmail"]);
                                $contactData["_ContactsAddressSecondaryName"] = (is_null($conDat["_ContactsAddressSecondaryName"]) ? "" : $conDat["_ContactsAddressSecondaryName"]);
                                $contactData["_ContactsAddressSecondaryRelation"] = (is_null($conDat["_ContactsAddressSecondaryRelation"]) ? "" : $conDat["_ContactsAddressSecondaryRelation"]);
                                $contactData["_ContactsAddressSecondaryPhone"] = (is_null($conDat["_ContactsAddressSecondaryPhone"]) ? "" : $conDat["_ContactsAddressSecondaryPhone"]);
                                $contactData["_ContactsAddressSecondaryEmail"] = (is_null($conDat["_ContactsAddressSecondaryEmail"]) ? "" : $conDat["_ContactsAddressSecondaryEmail"]);
                                $contactData["_ContactsAddressAddressType"] = (is_null($conDat["_ContactsAddressAddressType"]) ? "" : $conDat["_ContactsAddressAddressType"]);
                                $contactData["_ContactsAddressAddress"] = (is_null($conDat["_ContactsAddressAddress"]) ? "" : $conDat["_ContactsAddressAddress"]);
                                $contactData["_BloodType"] = (is_null($conDat["_BloodType"]) ? "" : $conDat["_BloodType"]);
                                $contactData["_AllergiesMedicineOptions"] = (is_null($conDat["_AllergiesMedicineOptions"]) ? "" : $conDat["_AllergiesMedicineOptions"]);
                                $contactData["_AllergiesMedicineOther"] = (is_null($conDat["_AllergiesMedicineOther"]) ? "" : $conDat["_AllergiesMedicineOther"]);
                                $contactData["_AllergiesFoodOptions"] = (is_null($conDat["_AllergiesFoodOptions"]) ? "" : $conDat["_AllergiesFoodOptions"]);
                                $contactData["_AllergiesFoodOther"] = (is_null($conDat["_AllergiesFoodOther"]) ? "" : $conDat["_AllergiesFoodOther"]);
                                $contactData["_AdditionalMedicalInformation"] = (is_null($conDat["_AdditionalMedicalInformation"]) ? "" : $conDat["_AdditionalMedicalInformation"]);
                                $contactData["_AdditionalMiscInformation"] = (is_null($conDat["_AdditionalMiscInformation"]) ? "" : $conDat["_AdditionalMiscInformation"]);

                            }
                        } else {
                            $returnFields = array(
                                "Email",
                                "FirstName",
                                "LastName",
                                "_ContactsAddressPrimaryName",
                                "_ContactsAddressPrimaryEmail",
                                "_ContactsAddressPrimaryPhone",
                                "_ContactsAddressAddress",
                                "_ContactsAddressSecondaryName",
                                "_ContactsAddressSecondaryEmail",
                                "_ContactsAddressSecondaryPhone",
                                "_ContactsAddressAddress"
                            );
                            $conDat = $app->loadCon($conID, $returnFields);
                            if (is_array($conDat)) {
                                $contactData["conID"] = $conID;
                                $contactData["firstname"] = trim((is_null($conDat["FirstName"]) ? "" : $conDat["FirstName"]) . " " . (is_null($conDat["LastName"]) ? "" : $conDat["LastName"]));
                                $contactData["email"] = (is_null($conDat["Email"]) ? "" : $conDat["Email"]);
                                $contactData["name1"] = (is_null($conDat["_ContactsAddressPrimaryName"]) ? "" : $conDat["_ContactsAddressPrimaryName"]);
                                $contactData["name2"] = (is_null($conDat["_ContactsAddressSecondaryName"]) ? "" : $conDat["_ContactsAddressSecondaryName"]);
                                $contactData["email1"] = (is_null($conDat["_ContactsAddressPrimaryEmail"]) ? "" : $conDat["_ContactsAddressPrimaryEmail"]);
                                $contactData["email2"] = (is_null($conDat["_ContactsAddressSecondaryEmail"]) ? "" : $conDat["_ContactsAddressSecondaryEmail"]);
                                $contactData["phone1"] = (is_null($conDat["_ContactsAddressPrimaryPhone"]) ? "" : $conDat["_ContactsAddressPrimaryPhone"]);
                                $contactData["phone2"] = (is_null($conDat["_ContactsAddressSecondaryPhone"]) ? "" : $conDat["_ContactsAddressSecondaryPhone"]);

                                $contactData["phone1"] = str_replace("+1", "", $contactData["phone1"]);
                                $contactData["phone2"] = str_replace("+1", "", $contactData["phone2"]);

                                $contactData["address1"] = (is_null($conDat["_ContactsAddressAddress"]) ? "" : $conDat["_ContactsAddressAddress"]);
                                $contactData["address2"] = (is_null($conDat["_ContactsAddressAddress"]) ? "" : $conDat["_ContactsAddressAddress"]);
                            }
                        }
                    }
                }
            }
        } ?>
        <script>
            var postData = <?php echo json_encode($contactData);?>;
        </script>
        <?php
    }
}

if (isset($_POST)) {
if (!isset($_POST["productLander_oi"])) { ?>
    <script>
        var productData = {
            infuProductID: "<?php echo isset($_POST["infuProductID"]) ? $_POST["infuProductID"] : "";?>",
            infuProductPrice: "<?php echo isset($_POST["infuProductPrice"]) ? $_POST["infuProductPrice"] : "";?>",
            infuProductShippingPrice: "<?php echo isset($_POST["infuProductShippingPrice"]) ? $_POST["infuProductShippingPrice"] : "";?>",
            infuProductImage: "<?php echo isset($_POST["infuProductImage"]) ? $_POST["infuProductImage"] : "";?>",
            contactGoal: "<?php echo isset($_POST["contactGoal"]) ? $_POST["contactGoal"] : "";?>",
            paymentGoal: "<?php echo isset($_POST["paymentGoal"]) ? $_POST["paymentGoal"] : "PurchasedRadio";?>"
        };
    </script>
<?php }
if (isset($_POST["upsell"])) { ?>
    <script>
        var orderTotal = "<?php echo $_POST['total'];?>";
        var contactID = "<?php echo $_POST['contactID'];?>";
        var creditCardID = "<?php echo $_POST['creditCardID'];?>";
    </script>
<?php
}
if (isset($_POST["thx"])) { ?>
    <script>
        <?php
        if (isset($_POST['addtowish'])) {
                ?>
            var orderTotal = "<?php echo $_POST['total'];?>";
            var addtowish = "<?php echo $_POST['addtowish'];?>";
            debugger;
            if(typeof(addtowish)!=='undefined'){
                fbq('track','AddToWishlist',{currency:'USD',value:parseFloat(orderTotal)});
            }
            <?php
        } else if (isset($_POST['total'])) {
        ?>
        var orderTotal = "<?php echo $_POST['total'];?>";
        debugger;
        if(typeof(orderTotal)!=='undefined'){
            fbq('track','Purchase',{currency:'USD',value:parseFloat(orderTotal)});
            window._vis_opt_queue=window._vis_opt_queue||[];
            window._vis_opt_queue.push(function(){_vis_opt_revenue_conversion(parseFloat(orderTotal));});
        }
        <?php } ?>
    </script>
<?php
} else if (isset($_POST["productLander"])) { ?>
<?php
} else if (isset($_POST["productLander_oi"])) { ?>
    <script>
        var productData = {
            infuProductID: "<?php echo isset($_POST["infuProductID"]) ? $_POST["infuProductID"] : "";?>",
            infuProductPrice: "<?php echo isset($_POST["infuProductPrice"]) ? $_POST["infuProductPrice"] : "";?>",
            infuProductShippingPrice: "<?php echo isset($_POST["infuProductShippingPrice"]) ? $_POST["infuProductShippingPrice"] : "";?>",
            infuProductImage: "<?php echo isset($_POST["infuProductImage"]) ? $_POST["infuProductImage"] : "";?>",
            contactGoal: "<?php echo isset($_POST["contactGoal"]) ? $_POST["contactGoal"] : "";?>",
            paymentGoal: "<?php echo isset($_POST["paymentGoal"]) ? $_POST["paymentGoal"] : "";?>",
            flwProductID: "<?php echo isset($_POST["flwProductID"]) ? $_POST["flwProductID"] : "";?>",
            AddressStreet1: "<?php echo isset($_POST["AddressStreet1"]) ? $_POST["AddressStreet1"] : "";?>",
            AddressStreet2: "<?php echo isset($_POST["AddressStreet2"]) ? $_POST["AddressStreet2"] : "";?>",
            City: "<?php echo isset($_POST["City"]) ? $_POST["City"] : "";?>",
            State: "<?php echo isset($_POST["State"]) ? $_POST["State"] : "";?>",
            PostalCode: "<?php echo isset($_POST["PostalCode"]) ? $_POST["PostalCode"] : "";?>",
            BillingAddressStreet1: "<?php echo isset($_POST["BillingAddressStreet1"]) ? $_POST["BillingAddressStreet1"] : "";?>",
            BillingAddressStreet2: "<?php echo isset($_POST["BillingAddressStreet2"]) ? $_POST["BillingAddressStreet2"] : "";?>",
            BillingCity: "<?php echo isset($_POST["BillingCity"]) ? $_POST["BillingCity"] : "";?>",
            BillingState: "<?php echo isset($_POST["BillingState"]) ? $_POST["BillingState"] : "";?>",
            BillingPostalCode: "<?php echo isset($_POST["BillingPostalCode"]) ? $_POST["BillingPostalCode"] : "";?>",
            Phone: "<?php echo isset($_POST["Phone"]) ? $_POST["Phone"] : "";?>",
            NameOnCard: "<?php echo isset($_POST["NameOnCard"]) ? $_POST["NameOnCard"] : "";?>",
            Email: "<?php echo isset($_POST["Email"]) ? $_POST["Email"] : "";?>",
            CardNumber: "<?php echo isset($_POST["CardNumber"]) ? $_POST["CardNumber"] : "";?>",
            ExpirationMonth: "<?php echo isset($_POST["ExpirationMonth"]) ? $_POST["ExpirationMonth"] : "";?>",
            ExpirationYear: "<?php echo isset($_POST["ExpirationYear"]) ? $_POST["ExpirationYear"] : "";?>",
            CVV2: "<?php echo isset($_POST["CVV2"]) ? $_POST["CVV2"] : "";?>",
            contactID: "<?php echo isset($_POST["contactID"]) ? $_POST["contactID"] : "";?>"
        };
    </script>
<?php
} else if (isset($_POST["conID"])) {
$app = new iSDK;
if ($app->cfgCon("vp389")) {
$returnFields = array("Email", "_PersonalInfoName");
$conDat = $app->loadCon($_POST["conID"], $returnFields);
if (is_array($conDat)) { ?>
    <script>
        var conDat = {FullName: "<?php echo $conDat["_PersonalInfoName"]?>", Email: "<?php echo $conDat["Email"]?>"};
    </script>
<?php
} else { ?>
    <script>
        var conDat = {FullName: "<?php echo $conDat["_PersonalInfoName"]?>", Email: "<?php echo $conDat["Email"]?>"};
    </script>
<?php
}
}
?>
    <script>
        var conID = "<?php echo $_POST["conID"];?>";
    </script>
<?php
} else {
?>
    <script>
        var conID = "0";
    </script>
<?php
}
if (is_page("contacts")) {
$conID = "";
$app = new iSDK;
if ($app->cfgCon("vp389")) {
    $nameArray = split_name($_POST["firstname"]);
    $contactData = array(
        "FirstName" => $nameArray["first_name"],
        "LastName" => $nameArray["last_name"],
        "Email" => $_POST["email"]
    );
    $conID = $app->addCon($contactData);
    if ($conID) {
        $app->achieveGoal("vp389", "CompleteReg", $conID);
    }
}
?>
    <script>
        var postData = {
            conID: "<?php echo $conID;?>",
            firstname: "<?php echo $_POST["firstname"]?>",
            email: "<?php echo $_POST["email"]?>",
            _utmsource: "<?php echo $_POST["_utmsource"]?>",
            _utmmedium: "<?php echo $_POST["_utmmedium"]?>",
            _utmcampaign: "<?php echo $_POST["_utmcampaign"]?>",
            _utmterm: "<?php echo $_POST["_utmterm"]?>",
            _utmcontent: "<?php echo $_POST["_utmcontent"]?>"
        }
    </script>
<?php
} else if (is_page("generate")) {
$conID = "";
$app = new iSDK;
if ($app->cfgCon("vp389")) {
    $conID = (isset($_POST['conID']) ? $_POST['conID'] : "");
    if ($conID != "") {
        $customFieldsUpdate = array(
            "_Contact1Name" => $_POST["name1"],
            "_Contact1Email" => $_POST["email1"],
            "_Contact1Phone" => $_POST["phone1"],
            "_Contact1Address0" => $_POST["address1"],
            "_Contact2Name" => $_POST["name2"],
            "_Contact1Email0" => $_POST["email2"],
            "_Contact2Phone" => $_POST["phone2"],
            "_Contact2Address" => $_POST["address2"]
        );
        //add Custom Fields
        $conUpdatedID = $app->updateCon($conID, $customFieldsUpdate);
        // add UTM Data
        $hash = 2000 + $conID;
        $hash = base64_encode($hash);

        $urlPDF = "https://start.nowprep.com/get-pdf/?ec=" . $hash;
        $urlImage = "https://start.nowprep.com/get-pdf/?bp=" . $hash;
        $conUpdatedID = $app->updateCon($conID,
            array(
                "_utmsource" => $_POST["_utmsource"],
                "_utmmedium" => $_POST["_utmmedium"],
                "_utmcampaign" => $_POST["_utmcampaign"],
                "_utmterm" => $_POST["_utmterm"],
                "_utmcontent" => $_POST["_utmcontent"],
                "_PDFFileURL" => $urlPDF,
                "_ImageFileURL" => $urlImage
            ));
        $app->achieveGoal("vp389", "CompleteContacts", $conID);
    }
}
?>
    <script>
        var postData = {
            conID: "<?php echo $conID;?>",
            firstname: "<?php echo $_POST["firstname"]?>",
            email: "<?php echo $_POST["email"]?>",
            name1: "<?php echo $_POST["name1"]?>",
            email1: "<?php echo $_POST["email1"]?>",
            phone1: "<?php echo $_POST["phone1"]?>",
            address1: "<?php echo $_POST["address1"]?>",
            name2: "<?php echo $_POST["name2"]?>",
            email2: "<?php echo $_POST["email2"]?>",
            phone2: "<?php echo $_POST["phone2"]?>",
            address2: "<?php echo $_POST["address2"]?>",
            _utmsource: "<?php echo $_POST["_utmsource"]?>",
            _utmmedium: "<?php echo $_POST["_utmmedium"]?>",
            _utmcampaign: "<?php echo $_POST["_utmcampaign"]?>",
            _utmterm: "<?php echo $_POST["_utmterm"]?>",
            _utmcontent: "<?php echo $_POST["_utmcontent"]?>"
        }
    </script>
<?php
} else if (is_page("pocket-pass")) {
?>
    <script>
        var postData = {
            conID: "<?php echo $_POST["conID"]?>",
            firstname: "<?php echo $_POST["firstname"]?>",
            email: "<?php echo $_POST["email"]?>",
            name1: "<?php echo $_POST["name1"]?>",
            email1: "<?php echo $_POST["email1"]?>",
            phone1: "<?php echo $_POST["phone1"]?>",
            address1: "<?php echo $_POST["address1"]?>",
            name2: "<?php echo $_POST["name2"]?>",
            email2: "<?php echo $_POST["email2"]?>",
            phone2: "<?php echo $_POST["phone2"]?>",
            address2: "<?php echo $_POST["address2"]?>"
        }
    </script>
<?php
} else if (is_page("ready-vault")) {
?>
    <script>
        var postData = {
            conID: "<?php echo $_POST["conID"]?>",
            creditCardID: "<?php echo $_POST["creditCardID"]?>"
        }
    </script>
    <?php
} else if (is_page("thank-you")) {
} else {
}
} else {
}
?>

<body <?php body_class(); ?>>
<?php op_in_body(); ?>
<div class="container main-content">
    <?php
    op_page_header();
    $GLOBALS['op_feature_area']->load_feature();
    op_page_feature_title();
    echo $GLOBALS['op_content_layout'];
    op_page_footer();
    ?>
</div><!-- container -->
<script type="text/javascript" src="https://vp389.infusionsoft.com/app/webTracking/getTrackingCode"></script>
<?php if (is_page("ready-vault") || is_page("order-info") || is_page("ready-vault/thank-you") || $post->ID == 2826 || $post->ID == 2873 || $post->ID == 2808 || $post->ID == 3255 || $post->ID == 3326 || $post->ID == 3329 || $post->ID == 3480 || $post->ID == 3351 || $post->ID == 3503 || $post->ID == 3399 || $post->ID == 3472 || $post->ID == 3540 || $post->ID == 3623 || $post->ID == 3683 || $post->ID == 3684 || $post->ID == 3719 || $post->ID == 3723 || $post->ID == 3731 || $post->ID == 3769 || $post->ID == 3750 || $post->ID == 3794 || $post->ID == 3833 || $post->ID == 3840 || $post->ID == 3836 || $post->ID == 3899 || $post->ID == 3959 || $post->ID == 3954 || $post->ID == 3945 || $post->ID == 3985 || $post->ID == 3975 || $post->ID == 3948 || $post->ID == 3997 || $post->ID == 3951 || $post->ID == 4047 || $post->ID == 4069 || $post->ID == 4055 || $post->ID == 4128  || $post->ID == 4222 || $post->ID == 4147 || $post->ID == 4347 || $post->ID == 4362 || $post->ID == 4385 || $post->ID == 4405 || $post->ID == 4425 || $post->ID == 4445 || $post->ID == 4460 || $post->ID == 4475 || $post->ID == 4490) { ?>
    <script src="https://start.nowprep.com/wp-content/themes/optimizePressTheme/lib/infu_base_all.js?ver=<?php echo time(); ?>"></script>
<?php } else if (is_page("ice-wizard-v3") || is_page("shipping-info-v3") || is_page("payment-info-v3")) { ?>
    <script src="https://start.nowprep.com/wp-content/themes/optimizePressTheme/lib/infu_icecard_short_funnel_ajax.js?ver=<?php echo time(); ?>"></script>
<?php } else { ?>
    <script src="https://start.nowprep.com/wp-content/themes/optimizePressTheme/lib/infu_icecard_funnel_ajax.js?ver=<?php echo time(); ?>"></script>
<?php }
op_footer() ?>
<?php
if($post->ID == 4047 || $post->ID == 4362 || $post->ID == 4385 || $post->ID == 4405 || $post->ID == 4425) {?>
        <link rel="stylesheet" type="text/css" href="<?php echo site_url()."/wp-content/themes/optimizePressTheme/ready-power.css";?>"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.4/jquery.touchSwipe.min.js"></script>
        <script type="text/javascript" src="<?php echo site_url()."/wp-content/themes/optimizePressTheme/ready-power.js?v=".time();?>"></script>
    <?php }?>
</body>
</html>
