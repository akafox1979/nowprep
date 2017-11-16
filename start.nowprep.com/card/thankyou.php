<?php

if(isset($_SERVER['HTTP_CF_VISITOR'])) {
    if(strpos($_SERVER['HTTP_CF_VISITOR'], 'https') === false) {
	header('HTTP/1.1 301 Moved Permanently');
        header('Location: https://nowprep.com/card/thankyou.php');
        exit();
    }
}

function get_template_directory_uri() {
    return 'https://nowprep.com/card';
}
session_start();
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
    <script src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/js/bootstrap.min.js?v=<?php echo time(); ?>"></script>
    <script src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/js/jquery.validate.js?v=<?php echo time(); ?>" type="text/javascript"></script>
    <script src="<?php echo  str_replace('http://','https://',get_template_directory_uri()); ?>/assets/js/additional-methods.js?v=<?php echo time(); ?>" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js" type="text/javascript"></script>
</head>
<body>
<style>

</style>
<div class="wrapper index">
    <section id="logosec">
        <div class="container">
            <div class="row"><span class="backbutton" style="display: none;"><a href="#"><i class="glyphicon glyphicon-circle-arrow-left"></i></a></span></div>
            <div class="row"> <img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/nowprep-logo.png" class="logo img-responsive"> </div>
        </div>
    </section>
    <div class="template-thankyou">
        <section id="cardsec-top">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2>Thank you</h2>
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
<script src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/js/progressbar.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNhcLWPyYGoSKdD1xHpkenk3GeiGtBgw8&libraries=places" async defer></script>

<script>
</script>
<script type="text/javascript" src="https://vp389.infusionsoft.com/app/webTracking/getTrackingCode"></script>
</body>
</html>
