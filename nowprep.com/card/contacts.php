<?php
/**
 * Template Name: Emergency Contact Card page template
 */

if(isset($_SERVER['HTTP_CF_VISITOR'])) {
    if(strpos($_SERVER['HTTP_CF_VISITOR'], 'https') === false) {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: https://nowprep.com/card/contacts.php');
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
    <div class="template-contact">
        <section id="cardsec-top">
            <div class="container">
                <div class="row">
                    <form class="contact-form-first" method="post" action="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/generate.php">
                        <input type="hidden" id="name" name="name" value="<?php echo $_POST['name'];?>">
                        <input type="hidden" id="email" name="email" value="<?php echo $_POST['email'];?>">
                    <div class="col-sm-5 col-xs-12">
                            <h2>Enter The Contact Info for The <span>Primary Emergency Contact</span> You Want Printed on Card:</h2>
                            <div class="ec-formsec">
                                <div class="form-logo-textsec">
                                    <div class="form-logo-pmsec"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/form-logo.png" class="img-responsive"></div>
                                    <div class="form-text-pmsec">
                                        <h3>Emergency Contact #1</h3>
                                    </div>
                                </div>

                                <div class="form-textsec">
                                    <h3>In Case of Emergency, Please Contact...</h3>
                                    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="name_fir" type="text" class="form-control" name="name_fir" placeholder="Primary Contact's Name*">
                                    </div>
                                    <div class="input-group phonenumber"> <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input id="email_fir" type="email" class="form-control" name="email_fir" placeholder="Email">
                                    </div>
                                    <div class="input-group phonenumber-alt"> <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                        <input id="phone_fir" type="text" class="form-control" name="phone_fir" placeholder="Phone">
                                    </div>
                                    <div class="input-group"> <span class="input-group-addon" style="vertical-align: top;padding-top: 14px;"><i class="glyphicon glyphicon-map-marker"></i></span>
                                        <textarea id="address_fir" type="text" class="form-control" name="address_fir" placeholder="Address" onfocus="geolocate($(this));"></textarea>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-info btn-lg">NEXT <i class="glyphicon glyphicon-arrow-right"></i></button>
                    </div><!-- Primary Emergency Contact End -->
                    <div class="col-sm-2 col-xs-12">
                        <div class="orsec"><h5><span>-OR-</span><i style="display:none;" class="fa fa-arrows-h" aria-hidden="true"></i></h5></div>
                    </div>
                    <div class="col-sm-5 col-xs-12">
                            <h2>Add <em>OPTIONAL</em> <span><u>Secondary</u> Emergency Contact</span> You Want Printed on Card:</h2>
                            <div class="ec-formsec">
                                <div class="form-logo-textsec">
                                    <div class="form-logo-pmsec"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/form-logo.png" class="img-responsive"></div>
                                    <div class="form-text-pmsec">
                                        <h3>Emergency Contact #2</h3>
                                    </div>
                                </div>

                                <div class="form-textsec">
                                    <h3>In Case of Emergency, Please Contact...</h3>
                                    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="name_sec" type="text" class="form-control" name="name_sec" placeholder="Secondary Contact's Name*">
                                    </div>
                                    <div class="input-group phonenumber"> <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input id="email_sec" type="email" class="form-control" name="email_sec" placeholder="Email">
                                    </div>
                                    <div class="input-group phonenumber-alt"> <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                        <input id="phone_sec" type="text" class="form-control" name="phone_sec" placeholder="Phone">
                                    </div>
                                    <div class="input-group"> <span class="input-group-addon" style="vertical-align: top;padding-top: 14px;"><i class="glyphicon glyphicon-map-marker"></i></span>
                                        <textarea id="address_sec" type="text" class="form-control" name="address_sec" placeholder="Address" onfocus="geolocate($(this));"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer style="margin-top: 50px;">
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
    var googleAddressData = [];

    function initAutocomplete(data_field) {

        var input_name = $(data_field).attr('name');
        var input_element = document.getElementsByName(input_name);
        var autocomplete = new google.maps.places.Autocomplete(
            (input_element[0]),
            {types: ['geocode']});

        autocomplete.addListener('place_changed', function () {
            googleAddressData.push({name: input_name, value: autocomplete.getPlace().address_components});
        });
        return autocomplete;
    }
    function geolocate(data_field) {
        var autocomplete = initAutocomplete(data_field);
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }

    $(document).ready(function() {
        $(window).scrollTop(0);
        $("#ex_date").mask("99/99",{ "placeholder": "" });

        $("form.contact-form-first").validate({
            rules: {
                email_sec: {
                    email: true
                },
                phone_sec: {
                    phoneUS: true
                },
                email_fir: {
                    email: true
                },
                phone_fir: {
                    phoneUS: true
                }

            },
            messages: {
                email_fir: "Please enter a valid email address",
                phone_fir: "Please enter a valid phone number",
                email_sec: "Please enter a valid email address",
                phone_sec: "Please enter a valid phone number",
            },
            submitHandler: function (form) {
                form.submit();
            }
        });

        $("form.contact-form-first").submit(function(){
            if($(this).valid()) {
                return true;
            }
            return false;
        });

    });


</script>
<script type="text/javascript" src="https://vp389.infusionsoft.com/app/webTracking/getTrackingCode"></script>
</body>
</html>
