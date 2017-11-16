<?php
/**
 * Template Name: Emergency Contact Card page template
 */



session_start();
if($_POST) {
    if (isset($_SESSION['conID']) && isset($_SESSION['creditCardID'])) {

        require_once("lib/iSDK-master/isdk.php");
        $app = new iSDK;
        if ($app->cfgCon("vp389")) {
            //create contact
            $conID = $_SESSION["conID"];
            $creditCardID = $_SESSION["creditCardID"];
            if ($creditCardID) {
                //place order
                $addedOrder = $app->placeOrder(
                    $conID,
                    0, //if != 0 auto charge enabled
                    null,
                    array(7), //product list
                    array(),
                    false,
                    array()
                );
                //array(6) { ["Message"]=> string(4) "None" ["OrderId"]=> string(1) "7" ["InvoiceId"]=> string(1) "7" ["Successful"]=> string(5) "false" ["Code"]=> string(4) "None" ["RefNum"]=> string(4) "None" }

                if (isset($addedOrder["InvoiceId"])) {
                    $resultInvoice = $app->chargeInvoice($addedOrder["InvoiceId"],"API Test Payment #2",$creditCardID,3,false);
                    //array(4) { ["Message"]=> string(57) ""Your card was declined. Your request was in live mode ()" ["Successful"]=> bool(false) ["Code"]=> string(8) "Declined" ["RefNum"]=> string(0) "" }
                    if (boolval($resultInvoice["Successful"])) {
                        header("Location: https://start.nowprep.com/wp-content/themes/optimizePressTheme/infu-thx.php");
                        exit();
                    } else {
                        var_dump($resultInvoice);
                    }
                } else {
                    var_dump($addedOrder);
                }
            }
        } else {
            echo "Not Connected...";
        }
    }
}
function get_template_directory_uri() {
    return 'https://nowprep.com/card';
}

function split_name($name) {
    $parts = array();

    while ( strlen( trim($name)) > 0 ) {
        $name = trim($name);
        $string = preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $parts[] = $string;
        $name = trim( preg_replace('#'.$string.'#', '', $name ) );
    }

    if (empty($parts)) {
        return false;
    }

    $parts = array_reverse($parts);
    $name = array();
    $name['first_name'] = $parts[0];
    $name['middle_name'] = (isset($parts[2])) ? $parts[1] : '';
    $name['last_name'] = (isset($parts[2])) ? $parts[2] : ( isset($parts[1]) ? $parts[1] : '');

    return $name;
}

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=320, user-scalable=no">
    <title>NowPrep</title>
    <link rel="icon" href="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/NowPrep_CheckFavicon_16x16d.png" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/css/bootstrap.css?v=<?php echo time(); ?>">
    <style>
        @font-face {
            font-family: 'FontAwesome';
            src: url('<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/fonts/fontawesome-webfont.eot?v=4.7.0');
            src: url('<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/fonts/fontawesome-webfont.eot?#iefix&v=4.7.0') format('embedded-opentype'), url('<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/fonts/fontawesome-webfont.woff2?v=4.7.0') format('woff2'), url('<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/fonts/fontawesome-webfont.woff?v=4.7.0') format('woff'), url('<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/fonts/fontawesome-webfont.ttf?v=4.7.0') format('truetype'), url('<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/fonts/fontawesome-webfont.svg?v=4.7.0#fontawesomeregular') format('svg');
            font-weight: normal;
            font-style: normal;
        }
    </style>
    <link href="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/css/fixes.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">

    <script src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/js/jquery.min.js?v=<?php echo time(); ?>"></script>
    <script src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/js/jquery.maskedinput.js?v=<?php echo time(); ?>" type="text/javascript"></script>

</head>
<body>
<style>

</style>
<div class="wrapper index">
    <div class="template-sales">
        <section id="final-stepsec">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-5">
                        <div id="order-sec1">
                            <div class="payment-success"></div>
                            <div class="payment-errors"></div>
                            <form id="order" class="repeater-checkout-pass" method="post">
                                    <input type="hidden" name="test" value="test">
                                    <button type="submit" class="sales-btn btn-info btn-lg">Upsell</button>
                                    <div class="col-xs-12"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/security-logo.png" class="security-logo img-responsive"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <p class="link-footer"><a href="#">About Us</a> | <a href="#">Contact Us</a> </p>
                    <p class="copyright">Copyright © 2017 NowPrep.com. All Right Reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</div>
<script>

</script>
</body>
</html>