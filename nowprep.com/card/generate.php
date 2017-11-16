<?php
/**
 * Template Name: Emergency Contact Card page template
 */
if(isset($_SERVER['HTTP_CF_VISITOR'])) {
    if(strpos($_SERVER['HTTP_CF_VISITOR'], 'https') === false) {
	header('HTTP/1.1 301 Moved Permanently');
        header('Location: https://nowprep.com/card/generate.php');
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
    <div class="template-generate">
        <section id="progress-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div style="">
                            <div class="dummy_div" style="width:100%; padding-bottom:4%"></div>
                            <div id="myProgress">
                                <div id="myBar">0%</div>
                            </div>
                            <br>
                            <form class="download_data" method="post" action="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/order.php">
                                <input type="hidden" id="name" name="name" value="<?php echo $_POST['name'];?>">
                                <input type="hidden" id="email" name="email" value="<?php echo $_POST['email'];?>">
                                <input type="hidden" id="name_fir" name="name_fir" value="<?php echo $_POST['name_fir'];?>">
                                <input type="hidden" id="email_fir" name="email_fir" value="<?php echo $_POST['email_fir'];?>">
                                <input type="hidden" id="phone_fir" name="phone_fir" value="<?php echo $_POST['phone_fir'];?>">
                                <input type="hidden" id="address_fir" name="address_fir" value="<?php echo $_POST['address_fir'];?>">
                                <input type="hidden" id="name_sec" name="name_sec" value="<?php echo $_POST['name_sec'];?>">
                                <input type="hidden" id="email_sec" name="email_sec" value="<?php echo $_POST['email_sec'];?>">
                                <input type="hidden" id="phone_sec" name="phone_sec" value="<?php echo $_POST['phone_sec'];?>">
                                <input type="hidden" id="address_sec" name="address_sec" value="<?php echo $_POST['address_sec'];?>">

                                <div class="process_section loading_content"> <span class="step step_1"><i class="fa fa-spinner fa-spin process"></i><i
                                        class="fa fa-check complete"></i>Generating your emergency card......</span> <br>
                                <span class="step step_2"><i class='fa fa-spinner fa-spin process'></i><i class='fa fa-check complete'></i>Congratulations <?php echo $_POST['name'];?>!</span> <br>
                                <div class="aft_complete">
                                    <div id="dwnc" style="cursor: pointer;">
                                        <a class="step_button steppad step_button_1 next">Download Your Card <i class="glyphicon glyphicon-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div id="emergency-contact-form" class="ec-card-sec">
                            <div class="ec-formsec ec-card">
                                <div class="ec-formsec12">
                                    <div class="col-xs-12">
                                        <div class="form-logo-textsec">
                                            <div class="form-logo-pmsec"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/form-logo.png" class="img-responsive"></div>
                                            <div class="form-text-pmsec">
                                                <h3>Emergency Contact</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-textsec">
                                            <h3>In Case of Emergency, Please Contact...</h3>
                                            <div class="borderdot"></div>
                                            <div class="nameful"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><strong>Full Name</strong><span class="nameborder d-name"></span></div>
                                            <div class="nameful"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><strong>Email</strong><span class="mailborder d-email"></span></div>
                                            <div class="nameful"> <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span><strong>Phone</strong><span class="mainphone d-phone"></span> </div>
                                            <div class="nameful"><span class="glyphicon glyphicon-home" aria-hidden="true"></span><strong>Address</strong><span class="homeaddress d-address"></span></div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
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


    $(document).ready(function() {
        $(window).scrollTop(0);

        var elem = document.getElementById("myBar");
        var width = 0;
        var id = setInterval(frame, 50);
        var name_fir="<?php echo $_POST['name_fir'];?>";
        var email_fir="<?php echo $_POST['email_fir'];?>";
        var phone_fir="<?php echo $_POST['phone_fir'];?>";
        var address_fir="<?php echo $_POST['address_fir'];?>";

        function frame() {
            if (width >= 100) {
                clearInterval(id);
                $(".step_3").addClass("complete");
                $(".aft_complete").show();

            } else {
                width++;
                elem.style.width = width + '%';
                elem.innerHTML = width * 1 + '%';
                if (width > 0 && width < 30) {
                    $(".step_1").addClass("process");
                }
                if (width == 30) {
                    $(".step_1").removeClass("process");
                    $(".step_1").addClass("complete");
                    $(".step_2").addClass("process");
                }
                if (width == 100) {
                    $(".step_2").removeClass("process");
                    $(".step_2").addClass("complete");
                    //$(".step_3").addClass("process");
                    $(".d-name").html(name_fir);
                    $(".d-email").html(email_fir);
                    $(".d-phone").html(phone_fir.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"));
                    $(".d-address").html(address_fir);
                }
            }
        }

        $("a.step_button").click(function(){
            $(".download_data").submit();
        });


    });


</script>
<script type="text/javascript" src="https://vp389.infusionsoft.com/app/webTracking/getTrackingCode"></script>
</body>
</html>
