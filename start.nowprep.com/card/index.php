<?php
/**
 * Template Name: Emergency Contact Card page template
 */

if(isset($_SERVER['HTTP_CF_VISITOR'])) {
    if(strpos($_SERVER['HTTP_CF_VISITOR'], 'https') === false) {
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: https://nowprep.com/card/');
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
    <div class="template-index">
        <section class="sec1home">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="sec1leftsec">
                            <img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/homepageimgtop.png" class="newsec1img img-responsive" style="z-index: 99;position: relative;top: 50px;"> <img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/arrow.png" class="tophome img-responsive">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="sec1-form-text">
                            <h3>100% FREE</h3>
                            <p>Emergency Contact Card is a Life Saver!</p>
                        </div>
                        <div id="form-sec-home" class="form-sec-home-top">
                            <form class="repeater-contacts-top" action="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/contacts.php" method="post">
                                <div class="creatingcard">
                                    <h4>To begin creating YOUR card, just enter your name and email below</h4>
                                </div>
                                <div class="input-group">
                                    <input id="name" type="text" class="form-control" name="name" placeholder="Enter Your Full Name">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> </div>
                                <div class="input-group">
                                    <input id="email" type="email" class="form-control" name="email" placeholder="Enter Your Email Address">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span> </div>
                                <button id="submit_button_top" type="submit" class="btn-primary btn-lg btn-block">YES! Download My FREE Emergency Card INSTANTLY!</button>
                                <p class="locksec"><i class="glyphicon glyphicon-lock"></i> We respect your privacy</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="getstarted-sec">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="most-important-sec">
                            <h3>60 Seconds out of your day could be the single <em>most important</em> thing you do this year... Don't put this off. </h3>
                            <h3><span>Get Started Now!</span></h3>
                        </div>

                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-10">
                        <div class="homelist-1">
                            <ul>
                                <li><strong>Protect your loved ones</strong> and yourself with this simple tool.</li>
                                <li><strong>Easy to use wizard</strong> will have you better prepared in <em>less than 60 seconds</em>.</li>
                                <li><strong>Keep for yourself</strong> OR simply share with your spouse, children, and other family or friends.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 mob">
                        <div class="money-bag-sec"> <img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/home-right-card.png" class="img-responsive"> </div>
                    </div>
                    <div class="col-sm-6">
                        <p class="money-bagsecmain">NowPrep empowers the community with knowledge, tools, and products to provide confidence through safety, organization, and preparation..</p>
                    </div>
                    <div class="col-sm-6 dok">
                        <div class="money-bag-sec"> <img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/home-right-card.png" class="img-responsive"> </div>
                    </div>
                </div>
                <div class="row childw" style="padding-top: 89px;">
                    <div class="col-sm-6">
                        <div class="money-bag-sec childme"> <img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/childman.png" class="img-responsive"> </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="money-bag-sec">
                            <p class="money-mainbagsec">NowPrep’s Emergency Contact Card provides the ultimate preparation resource for individuals and families.  Soon we will also offer curated alerts, news, and instructional content as well as both free and discounted products, services and tools, because knowledge and preparation can grant peace of mind and ultimately save lives.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="form-sec-home" class="form-sec-home-bottom twoform">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="customer-say">
                            <h2>What Our <span>Users</span> Say:</h2>
                            <div class="testmonila-footer">
                                <div class="pertestmo1"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/richard-d.png" class="img-responsive"></div>
                                <div class="pertestmo1"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/david-n.png" class="img-responsive"></div>
                                <div class="pertestmo1"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/barbara.png" class="img-responsive"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <form class="repeater-contacts-bottom" action="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/contacts.php" method="post">
                            <div class="creatingcard">
                                <h4>To begin creating YOUR card, just enter your name and email below</h4>
                            </div>
                            <div class="input-group">
                                <input id="name" type="text" class="form-control" name="name" placeholder="Enter Your Full Name">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> </div>
                            <div class="input-group">
                                <input id="email" type="email" class="form-control" name="email" placeholder="Enter Your Email Address">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span> </div>
                            <button id="submit_button_bottom" type="submit" class="btn-primary btn-lg btn-block">YES! Download My FREE Emergency Card INSTANTLY!</button>
                            <p class="locksec"><i class="glyphicon glyphicon-lock"></i> We respect your privacy</p>
                        </form>
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

        $("form.repeater-contacts-top").validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                name: "Please enter your name",
                email: "Please enter a valid email address"
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
        $("form.repeater-contacts-bottom").validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                name: "Please enter your name",
                email: "Please enter a valid email address"
            },
            submitHandler: function (form) {
                form.submit();
            }
        });

        $("form#userinfo").validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                name: "Please enter your name",
                email: "Please enter a valid email address"
            },
            submitHandler: function (form) {
                return false;
            }
        });

        $("form.contact-form-first").validate({
            rules: {
                email: {
                    email: true
                },
                phone: {
                    phoneUS: true
                }
            },
            messages: {
                email: "Please enter a valid email address",
                phone: "Please enter a valid phone number",
            },
            submitHandler: function (form) {
                return false;
            }
        });
        $("form.contact-form-second").validate({
            rules: {
                email: {
                    email: true
                },
                phone: {
                    phoneUS: true
                }
            },
            messages: {
                email: "Please enter a valid email address",
                phone: "Please enter a valid phone number",
            },
            submitHandler: function (form) {
                return false;
            }
        });
        $("form#completed-contact1").validate({
            rules: {
                email: {
                    email: true
                },
                phone: {
                    phoneUS: true
                }
            },
            messages: {
                email: "Please enter a valid email address",
                phone: "Please enter a valid phone number",
            },
            submitHandler: function (form) {
                return false;
            }
        });
        $("form#completed-contact2").validate({
            rules: {
                email: {
                    email: true
                },
                phone: {
                    phoneUS: true
                }
            },
            messages: {
                email: "Please enter a valid email address",
                phone: "Please enter a valid phone number",
            },
            submitHandler: function (form) {
                return false;
            }
        });
        $("form.repeater-checkout-pass").validate({
            rules: {
                name: {
                    required: true
                },
                address: {
                    required: true
                },
                cardnumber: {
                    required: true,
                    creditcard: true
                },
                cvv: {
                    required: true,
                    digits: true
                },
                ex_date: {
                    required: true,
                    maxlength: 5
                }
            },
            messages: {
                cardnumber: "Enter a valid card number",
                name: "Enter a Name on Card",
                cvv: ""
            },
            submitHandler: function (form) {
                return false;
            }
        });

        $("form.repeater-contacts-bottom,form.repeater-contacts-top").submit(function(){
            if($(this).valid()) {
                return true;
            }
            return false;
        });
        $("form.contact-form-first,form.contact-form-second").submit(function(){
            if($(this).valid()) {
                $(".template-contact").hide();
                if($("form.repeater-contacts-top input#name").val() != "") {
                    $(".step_2").html("<i class='fa fa-spinner fa-spin process'></i><i class='fa fa-check complete'></i>Congratulations " + $("form.repeater-contacts-top input#name").val() + "!");
                }
                else if($("form.repeater-contacts-bottom input#name").val() != "") {
                    $(".step_2").html("<i class='fa fa-spinner fa-spin process'></i><i class='fa fa-check complete'></i>Congratulations " + $("form.repeater-contacts-bottom input#name").val() + "!");
                }
                $(window).scrollTop(0);

                $(".d-name").html("&nbsp;");
                $(".d-email").html("&nbsp;");
                $(".d-phone").html("&nbsp;");
                $(".d-address").html("&nbsp;");

                $(".template-generate").show();

                var elem = document.getElementById("myBar");
                var width = 0;
                var id = setInterval(frame, 50);

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
                            $(".d-name").html($("form.contact-form-first input#name").val());
                            $(".d-email").html($("form.contact-form-first input#email").val());
                            $(".d-phone").html($("form.contact-form-first input#phone").val().replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"));
                            $(".d-address").html($("form.contact-form-first textarea#address_fir").val());
                        }
                    }
                }


            }
            return false;
        });

        $("a.step_button").click(function(){
            $(".template-generate").hide();
            var toEmail = "";
            var toName = "";

            if($("form.repeater-contacts-top input#name").val() != "") {
                $("#ecc_name").html($("form.repeater-contacts-top input#name").val());
                toName = $("form.repeater-contacts-top input#name").val();
            }
            else if($("form.repeater-contacts-bottom input#name").val() != "") {
                $("#ecc_name").html($("form.repeater-contacts-bottom input#name").val());
                toName = $("form.repeater-contacts-bottom input#name").val();
            }
            if($("form.repeater-contacts-top input#email").val() != "") {
                $("#ecc_email").html($("form.repeater-contacts-top input#email").val());
                toEmail = $("form.repeater-contacts-top input#email").val();
            }
            else if($("form.repeater-contacts-bottom input#email").val() != "") {
                $("#ecc_email").html($("form.repeater-contacts-bottom input#email").val());
                toEmail = $("form.repeater-contacts-bottom input#email").val();
            }

            $(window).scrollTop(0);
            $(".template-sales").show();

            var c = document.getElementById("emergency_card");
            var ctx = c.getContext("2d");

            ctx.clearRect(0, 0, c.width, c.height);

            var img = new Image();
            img.onload = function () {
                ctx.drawImage(img, 0, 0);
                ctx.font = "40px Arial";
                ctx.textAlign="center";
                ctx.fillText("Congratulations " + toName + "!", 637, 210);

                ctx.font = "14px Arial";
                ctx.textAlign="left";
                ctx.fillText($("form.contact-form-first input#name").val(), 195, 1069);
                ctx.fillText($("form.contact-form-second input#name").val(), 770, 1069);
                ctx.fillText($("form.contact-form-first input#name").val(), 195, 1402);
                ctx.fillText($("form.contact-form-second input#name").val(), 770, 1402);

                ctx.fillText($("form.contact-form-first input#email").val(), 170, 1100);
                ctx.fillText($("form.contact-form-second input#email").val(), 745, 1100);
                ctx.fillText($("form.contact-form-first input#email").val(), 170, 1433);
                ctx.fillText($("form.contact-form-second input#email").val(), 745, 1433);

                ctx.fillText($("form.contact-form-first input#phone").val().replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 170, 1133);
                ctx.fillText($("form.contact-form-second input#phone").val().replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 745, 1133);
                ctx.fillText($("form.contact-form-first input#phone").val().replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 170, 1466);
                ctx.fillText($("form.contact-form-second input#phone").val().replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 745, 1466);

                ctx.fillText($("form.contact-form-first textarea#address_fir").val(), 130, 1185);
                ctx.fillText($("form.contact-form-second textarea#address_sec").val(), 703, 1185);
                ctx.fillText($("form.contact-form-first textarea#address_fir").val(), 130, 1518);
                ctx.fillText($("form.contact-form-second textarea#address_sec").val(), 703, 1518);

                var canvas = document.getElementById("emergency_card");
                var imgData = canvas.toDataURL("image/png", 1.0);

                document.getElementById("emergency_card_img").src = imgData;

                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = jsPDF('p', 'mm');
                //pdf.canvas.height = 1650;
                //pdf.canvas.width = 1275;
                var width = pdf.internal.pageSize.width;
                var height = pdf.internal.pageSize.height;
                pdf.addImage(imgData, 'JPG', 0, 0, width, height);
                var pdfData = btoa(pdf.output());
                $.ajax({
                    type: "POST",
                    url: "https://mandrillapp.com/api/1.0/messages/send.json",
                    data: {
                        'key': 'o2DFojQBRFj71A665qf6Fg',

                        'message': {
                            'from_email': 'info@nowprep.com',
                            "from_name": "The NowPrep Team",
                            'to': [{
                                'email': toEmail,
                                'name': toName,
                                'type': 'to'
                            }],
                            'autotext': 'true',
                            'subject': 'Your NowPrep Emergency Pocket Pass',
                            'html': 'Congratulations ' + toName + "!<br><br>You're almost finished creating your custom <b>NowPrep Emergency Pocket Pass</b> and being <b>more disaster-ready</b> than over 60% of Americans.<br><br>Stay Prepared,<br>The NowPrep Team<br><br><br>",
                            "attachments": [
                                {
                                    "type": "application/pdf",
                                    "name": "EmergencyPocketPass.pdf",
                                    "content": pdfData
                                }
                            ],
                        }
                    }
                }).done(function (response) {
                    if ((response[0].status == "sent") || (response[0].status == "queued")) {
                        debugger;
                    } else if (response[0].status == "error") {
                    } else if (response[0].status == "rejected") {
                    }

                });

            };
            img.src = '<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/ecc.png';
        });

        $(".downlord").each(function(){
            $(this).click(function(){
                if($("form#userinfo").valid() && $("form#completed-contact1").valid() && $("form#completed-contact2").valid()) {
                    $(".template-download").hide();
                    $(window).scrollTop(0);
                    $(".template-sales").show();

                    var c = document.getElementById("emergency_card");
                    var ctx = c.getContext("2d");

                    ctx.clearRect(0, 0, c.width, c.height);

                    var img = new Image();
                    img.onload = function () {
                        ctx.drawImage(img, 0, 0);
                        ctx.font = "40px Arial";
                        ctx.textAlign="center";
                        if($("form#userinfo input#name").val() != "") {
                            ctx.fillText("Congratulations " + $("form#userinfo input#name").val() + "!", 637, 210);
                        }

                        ctx.font = "14px Arial";
                        ctx.textAlign="left";

                        ctx.fillText($("form#completed-contact1 input#name1").val(), 195, 1069);
                        ctx.fillText($("form#completed-contact2 input#name2").val(), 770, 1069);
                        ctx.fillText($("form#completed-contact1 input#name1").val(), 195, 1402);
                        ctx.fillText($("form#completed-contact2 input#name2").val(), 770, 1402);

                        ctx.fillText($("form#completed-contact1 input#email1").val(), 170, 1100);
                        ctx.fillText($("form#completed-contact2 input#email2").val(), 745, 1100);
                        ctx.fillText($("form#completed-contact1 input#email1").val(), 170, 1433);
                        ctx.fillText($("form#completed-contact2 input#email2").val(), 745, 1433);

                        ctx.fillText($("form#completed-contact1 input#phone1").val().replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 170, 1133);
                        ctx.fillText($("form#completed-contact2 input#phone2").val().replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 745, 1133);
                        ctx.fillText($("form#completed-contact1 input#phone1").val().replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 170, 1466);
                        ctx.fillText($("form#completed-contact2 input#phone2").val().replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 745, 1466);

                        ctx.fillText($("form#completed-contact1 input#address1").val(), 130, 1185);
                        ctx.fillText($("form#completed-contact2 input#address2").val(), 703, 1185);
                        ctx.fillText($("form#completed-contact1 input#address1").val(), 130, 1518);
                        ctx.fillText($("form#completed-contact2 input#address2").val(), 703, 1518);

                        var canvas = document.getElementById("emergency_card");
                        var imgDataPNG = canvas.toDataURL("image/png", 1.0);

                        document.getElementById("emergency_card_img").src = imgDataPNG;

                        var imgData = canvas.toDataURL("image/jpeg", 1.0);
                        var pdf = jsPDF('p', 'mm');
                        //pdf.canvas.height = 1650;
                        //pdf.canvas.width = 1275;
                        var width = pdf.internal.pageSize.width;
                        var height = pdf.internal.pageSize.height;
                        pdf.addImage(imgData, 'JPG', 0, 0, width, height);
                        var pdfData = btoa(pdf.output());
                        $.ajax({
                            type: "POST",
                            url: "https://mandrillapp.com/api/1.0/messages/send.json",
                            data: {
                                'key': 'o2DFojQBRFj71A665qf6Fg',

                                'message': {
                                    'from_email': 'info@nowprep.com',
                                    "from_name": "The NowPrep Team",
                                    'to': [{
                                        'email': $("form#userinfo input#email").val(),
                                        'name': $("form#userinfo input#name").val(),
                                        'type': 'to'
                                    }],
                                    'autotext': 'true',
                                    'subject': 'Your NowPrep Emergency Pocket Pass',
                                    'html': 'Congratulations ' + $("form#userinfo input#name").val() + "!<br><br>You're almost finished creating your custom <b>NowPrep Emergency Pocket Pass</b> and being <b>more disaster-ready</b> than over 60% of Americans.<br><br>Stay Prepared,<br>The NowPrep Team<br><br><br>",
                                    "attachments": [
                                        {
                                            "type": "application/pdf",
                                            "name": "EmergencyPocketPass.pdf",
                                            "content": pdfData
                                        }
                                    ],
                                }
                            }
                        }).done(function (response) {
                            if ((response[0].status == "sent") || (response[0].status == "queued")) {
                            } else if (response[0].status == "error") {
                            } else if (response[0].status == "rejected") {
                            }

                        });

                    };
                    img.src = '<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/ecc.png';
                }
            });
        });

        $("form.emergency-contact-form-pdf").submit(function(){
            $(".template-download").hide();
            $(window).scrollTop(0);
            $(".template-sales").show();
            return false;
        });

        $("form.repeater-checkout-pass").submit(function(){
            if($(this).valid()) {
                var dataExp = $("#ex_date").val().split('/');
                Stripe.card.createToken({
                    number: $('#cardnumber').val(),
                    cvc: $('#cvv').val(),
                    exp_month: parseInt(dataExp[0]),
                    exp_year: (2000 + parseInt(dataExp[1])),
                    name: $("#name").val(),
                    address_line1: $("#address").val(),
                    address_line2: $("#address2").val(),
                    address_city: $("#city").val(),
                    address_state: $("#state").val(),
                    address_zip: $("#zipcode").val(),
                    address_country: "US"
                }, 1*100, stripeResponseHandler);
            }
        })
        function stripeResponseHandler(status, response) {
            if (response.error) {
                $(".payment-errors").show();
                $(".payment-errors").html(response.error.message);
            } else {
                var token = response.id;
                $("form.repeater-checkout-pass").append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                $(".payment-errors").hide();
                $.ajax({
                    type: "POST",
                    url: "//nowprep.com/wp-content/themes/Newspaper/wrapper/stripe_payment_ecc.php",
                    data: $("form.repeater-checkout-pass").serializeArray()
                }).done(function (response) {
                    var responseJson = $.parseJSON(response);
                    if( responseJson.result == 0 ) {
                        $(".payment-errors").show();
                        $(".payment-errors").html(responseJson.text);
                    }
                    if(responseJson.result == 1 ) {
                        $("form.repeater-checkout-pass").hide();
                        $(".payment-errors").hide();
                        $(".payment-success").show();
                        $(".payment-success").html(responseJson.text);
                        $(".template-sales").hide();
                        $(window).scrollTop(0);
                        $(".template-upsell").show();
                    }
                    $("#ship_pass").removeAttr("disabled");
                });
            }
        }

        $("span.backbutton a").click(function () {
            debugger;
            if($(".template-index").is(":visible")) {
                $("span.backbutton").hide();
                return false;
            } else if($(".template-contact").is(":visible")) {
                $("span.backbutton").show();
                $(".template-contact").hide();
                $(".template-index").show();
                return false;
            } else if($(".template-generate").is(":visible")) {
                $("span.backbutton").show();
                $(".template-generate").hide();
                $(".template-contact").show();
                return false;
            } else if($(".template-download").is(":visible")) {
                //$("span.backbutton").show();
                //$(".template-download").hide();
                //$(".template-generate").show();
                return false;
            } else if($(".template-sales").is(":visible")) {
                $("span.backbutton").show();
                $(".template-sales").hide();
                //$(".template-download").show();
                $(".template-generate").show();
                return false;
            } else if($(".template-upsell").is(":visible")) {
                $("span.backbutton").show();
                $(".template-upsell").hide();
                $(".template-sales").show();
                return false;
            }
        })
    });


</script>
<script type="text/javascript" src="https://vp389.infusionsoft.com/app/webTracking/getTrackingCode"></script>
</body>
</html>
