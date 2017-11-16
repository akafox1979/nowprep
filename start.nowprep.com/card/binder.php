<?php
/**
 * Template Name: Emergency Contact Card page template
 */

if(isset($_SERVER['HTTP_CF_VISITOR'])) {
    if(strpos($_SERVER['HTTP_CF_VISITOR'], 'https') === false) {
	header('HTTP/1.1 301 Moved Permanently');
        header('Location: https://nowprep.com/card/binder.php');
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
    <div class="template-upsell">
        <section id="cardsec-top">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2><span>WAIT!</span> YOU NEED TO FINISH THE JOB!</h2>
                        <p class="upsl-p">COMPLETE YOUR PREPARATION WITH OUR NEW, CUSTOM DESIGNED, EMERGENCY ACTION BINDER.</p>
                        <p class="upsl-p">If you thought the Emergency Contact Card was important, well you’re right!. But it’s only the 1st step. This Binder will take your Preparation and Organization to the next Level.</p>
                    </div>
                    <div class="col-xs-12"> <img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/upsal-bg.jpg" class="upslimg img-responsive"> </div>
                    <div class="col-sm-6">
                        <div class="listline">
                            <h3>The BINDER includes:</h3>
                            <ul>
                                <li>Emergency Communication Plan</li>
                                <li>Family Emergency Guide</li>
                                <li>Alert Tips and Warnings</li>
                                <li>Document Protection</li>
                                <li>Shareable plan organizers</li>
                            </ul>
                            <p class="sec4text">WITHOUT THIS BINDER, YOU’RE ONLY HALF READY FOR AN EMERGENCY –Go all the way and give yourself the peace of mind knowing you’re fully prepared for the unexpected.</p>
                            <p class="sec4text">This 1 of a kind Binder was painstakingly created to organize and store all of your important documents and information in a safe place.</p>
                            <p class="sec4text">It’s simple to use, will get and keep you organized, and is available today at 50% OFF the List price for existing NowPrep customers.</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="listline">
                            <h3>Remember that the BINDER features all of the following:</h3>
                            <ul>
                                <li>Flexible labeling</li>
                                <li>Custom Designed Sections</li>
                                <li>Stores all your Important Documents in a Safe Place.</li>
                                <li>Water Resistant and Fire Retardant material</li>
                                <li>Grab and Go Design for Portability</li>
                                <li>Easy to Use Emergency Action Plan Template</li>
                            </ul>
                            <p class="sec4text">TAKE ADVANTAGE OF THIS SPECIAL DISCOUNT AND ORDER TODAY AT <span>50% OFF!</span> </p>
                            <p class="sec4text">If you’re like most people, then you have your “stuff” all over the place.  Maybe you have a special drawer at home, or a filing cabinet in your closet where you put your papers.  But what would happen if you had to evacuate your home in 15 minutes?   Are you confident that you would be able to take everything that you need?</p>
                            <p class="sec4text">Rest assured, with this 1 of a kind binder, you will be.  All your important documents and information like your social security card, birth certificate, insurance and banking info will be stored in a single organized place.</p>
                            <p class="sec4text">This Binder is like a customized Vault, only it’s portable and in the event of emergency you will know you’re prepared for whatever comes your way.</p>
                            <p class="sec4text">Don’t leave your preparation to chance.  Order Today!</p>
                        </div>
                    </div>
                    <form method="post" action="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/thankyou.php">
                        <button type="submit" class="upsel-btn btn-info btn-lg">SEND ME MY PREMIUM PREP BINDER KIT FOR JUST <span style="text-decoration:line-through;">$150</span> $75 <i class="glyphicon-glyphicon-arrow-right"></i></button>
                    </form>
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
