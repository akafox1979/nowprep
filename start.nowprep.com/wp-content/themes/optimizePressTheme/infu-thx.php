<?php
/**
 * Template Name: Emergency Contact Card page template
 */



session_destroy();
function get_template_directory_uri() {
    return 'https://nowprep.com/card';
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
        <section id="sales-sec2">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h4><strong>Thank you!</strong></h4>
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
