<?php
/**
 * Template Name: Emergency Contact Card page template
 */

if(isset($_SERVER['HTTP_CF_VISITOR'])) {
    if(strpos($_SERVER['HTTP_CF_VISITOR'], 'https') === false) {
	header('HTTP/1.1 301 Moved Permanently');
        header('Location: https://nowprep.com/card/order.php');
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
    <div class="template-sales">
        <div class="card-new">
            <canvas id="emergency_card" width="1275" height="1650" style="border: none; display:none;"></canvas>
            <img id="emergency_card_img" src="" style="width: 1275px;height: 1650px;margin: 0px 0px;display:none;" />
        </div>

        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <script type="text/javascript">
            Stripe.setPublishableKey('pk_test_wWG5xLDf1AjUWuy2cRi8jws1');
        </script>
        <section id="sales-sec12">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2>Congratulations</h2>
                        <h3><strong>on Completing Your Emergency Contact Cards!</strong></h3>
                        <h4><span>FREE</span> Download Will Begin Shortly…</h4>
                    </div>
                </div>
            </div>
        </section>
        <section id="sales-sec2">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h4><strong>BEFORE YOU GO </strong> Take Advantage of This <u><em>Limited Time Offer</em></u> to Get Your <strong>Printed Emergency Pass</strong> for ONLY $9!</h4> </div>
                </div>
            </div>
        </section>
        <section id="final-stepsec">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-7">
                        <div class="payment-contantsec">
                            <div class="contantimg"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/salescard.jpg" class="img-responsive"></div>
                            <div class="listline">
                                <ul>
                                    <li><strong>Free Shipping</strong></li>
                                    <li>Made in the USA!</li>
                                    <li>Double-sided</li>
                                    <li>Durable & Waterproof</li>
                                    <li>Eco-friendly plastic</li>
                                    <li>Customized with your info</li>
                                </ul>
                                <p>With our reliance on technology at an all-time high, most are left in the dark when devices break or power goes out</p>
                                <p>Don’t miss this simple & affordable opportunity to better prepare. </p>
                                <p>Invest in your safety and preparation!</p>
                                <p>With our reliance on technology at an all-time high, most individuals are completely unprepared when their phones break or if they had to survive without electricity. This simple solution allows you to keep a physical record of your most vital info with you at all times.</p>
                                <p>Together, let’s make preparation a priority and invest in our safety!</p>
                                <p>Remember with these simple and portable cards, you’ll already be 90% more prepared for the unexpected than most Americans.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-5">
                        <div id="order-sec1">
                            <div class="payment-success"></div>
                            <div class="payment-errors"></div>
                            <form id="order" class="repeater-checkout-pass" method="post" action="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/binder.php">
                                <div class="payemt-header"><h3>FINAL STEP</h3><p>Enter Your Secure Payment Information</p></div>
                                <div class="paymentsec">
                                    <h2>Step 1: Payment Information</h2>
                                    <div class="cardlogo-lofo"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/cardlogo.png" class="cardlogo img-responsive"></div>
                                    <div class="step1-form">
                                        <div class="input-group">
                                            <input id="cardnumber" type="text" class="form-control" name="cardnumber" placeholder="Credit&nbsp;Card&nbsp;Number">
                                        </div>
                                        <div class="input-group ex-date">
                                            <input id="ex_date" type="text" class="form-control" name="ex-date" placeholder="Expiration&nbsp;Date">
                                        </div>
                                        <div class="input-group cvv">
                                            <input id="cvv" type="text" class="form-control" name="cvv" placeholder="CVV" maxlength="4">
                                            <div class="tooltip">What is this? <span class="tooltiptext"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/cvvimg.jpg" class="img-responsive"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="address-details">
                                    <h2>Step 2: Shipping Details</h2>
                                    <div class="step1-form">
                                        <div class="input-group">
                                            <input id="name" type="text" class="form-control" name="name" placeholder="Full Name*">
                                        </div>
                                        <div class="input-group emailfild">
                                            <input id="email" type="email" class="form-control" name="email" placeholder="Email">
                                        </div>
                                        <div class="input-group phonenumber">
                                            <input id="phone" type="text" class="form-control" name="phone" placeholder="Phone Number">
                                        </div>
                                        <div class="input-group addressfild" style="margin-right:5px;">
                                            <input id="address" type="text" class="form-control" name="address" placeholder="Street&nbsp;Address*">
                                        </div>
                                        <div class="input-group addressfild">
                                            <input id="address2" type="text" class="form-control" name="address2" placeholder="Street&nbsp;Address&nbsp;(Second&nbsp;Line)">
                                        </div>
                                        <div class="input-group city">
                                            <input id="city" type="text" class="form-control" name="city" placeholder="City">
                                        </div>
                                        <div class="input-group state">
                                            <input id="state" type="text" class="form-control" name="state" placeholder="State">
                                        </div>
                                        <div class="input-group zipcode">
                                            <input id="zipcode" type="text" class="form-control" name="zipcode" placeholder="Zip&nbsp;Code">
                                        </div>
                                    </div>
                                    <button type="submit" class="sales-btn btn-info btn-lg"> Yes, RUSH Me My Cards and Premium Package For JUST $9!</button>
                                    <div class="col-xs-12"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/security-logo.png" class="security-logo img-responsive"></div>
                                </div>
                                <input type="hidden" id="amount" name="amount" value="900"/>
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
<script src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/js/progressbar.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNhcLWPyYGoSKdD1xHpkenk3GeiGtBgw8&libraries=places" async defer></script>

<script>
    var name="<?php echo $_POST['name'];?>";
    var email="<?php echo $_POST['email'];?>";
    var name_fir="<?php echo $_POST['name_fir'];?>";
    var email_fir="<?php echo $_POST['email_fir'];?>";
    var phone_fir="<?php echo $_POST['phone_fir'];?>";
    var address_fir="<?php echo $_POST['address_fir'];?>";
    var name_sec="<?php echo $_POST['name_sec'];?>";
    var email_sec="<?php echo $_POST['email_sec'];?>";
    var phone_sec="<?php echo $_POST['phone_sec'];?>";
    var address_sec="<?php echo $_POST['address_sec'];?>";

    $(document).ready(function() {
        $(window).scrollTop(0);
        $("#ex_date").mask("99/99",{ "placeholder": "" });

        var c = document.getElementById("emergency_card");
        var ctx = c.getContext("2d");

        ctx.clearRect(0, 0, c.width, c.height);

        var img = new Image();
        img.onload = function () {
            ctx.drawImage(img, 0, 0);
            ctx.font = "40px Arial";
            ctx.textAlign="center";
            ctx.fillText("Congratulations " + name + "!", 637, 210);

            ctx.font = "14px Arial";
            ctx.textAlign="left";
            ctx.fillText(name_fir, 195, 1069);
            ctx.fillText(name_sec, 770, 1069);
            ctx.fillText(name_fir, 195, 1402);
            ctx.fillText(name_sec, 770, 1402);

            ctx.fillText(email_fir, 170, 1100);
            ctx.fillText(email_sec, 745, 1100);
            ctx.fillText(email_fir, 170, 1433);
            ctx.fillText(email_sec, 745, 1433);

            ctx.fillText(phone_fir.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 170, 1133);
            ctx.fillText(phone_sec.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 745, 1133);
            ctx.fillText(phone_fir.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 170, 1466);
            ctx.fillText(phone_sec.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 745, 1466);

            ctx.fillText(address_fir, 130, 1185);
            ctx.fillText(address_sec, 703, 1185);
            ctx.fillText(address_fir, 130, 1518);
            ctx.fillText(address_sec, 703, 1518);

            var canvas = document.getElementById("emergency_card");
            var imgData = canvas.toDataURL("image/png", 1.0);

            document.getElementById("emergency_card_img").src = imgData;

            var imgData = canvas.toDataURL("image/jpeg", 1.0);
            var pdf = jsPDF('p', 'mm');
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
                            'email': email,
                            'name': name,
                            'type': 'to'
                        }],
                        'autotext': 'true',
                        'subject': 'Your NowPrep Emergency Pocket Pass',
                        'html': 'Congratulations ' + name + "!<br><br>You're almost finished creating your custom <b>NowPrep Emergency Pocket Pass</b> and being <b>more disaster-ready</b> than over 60% of Americans.<br><br>Stay Prepared,<br>The NowPrep Team<br><br><br>",
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
                //form.submit();
            }
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
			debugger;
                    var responseJson = $.parseJSON(response);
                    if( responseJson.result == 0 ) {
                        $(".payment-errors").show();
                        $(".payment-errors").html(responseJson.text);
			return false;
                    }
                    if(responseJson.result == 1 ) {
                        $("form.repeater-checkout-pass").hide();
                        $(".payment-errors").hide();
                        $(".payment-success").html(responseJson.text);
                        debugger;
			window.location.href = $("form.repeater-checkout-pass").attr('action');
                    }
                    $("#ship_pass").removeAttr("disabled");
                });
            }
        }
    });


</script>
<script type="text/javascript" src="https://vp389.infusionsoft.com/app/webTracking/getTrackingCode"></script>
</body>
</html>
