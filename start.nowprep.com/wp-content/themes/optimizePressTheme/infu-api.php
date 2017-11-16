<?php
/**
 * Template Name: Emergency Contact Card page template
 */



$shippingAddress = array(
    "Address2Street1" => "",
    "Address2Street2" => "",
    "City2" => "",
    "State2" => "",
    "PostalCode2" => "",
    "Country2" => "United States"

);
$billingAddress = array(
    "StreetAddress1" => "",
    "StreetAddress2" => "",
    "City" => "",
    "State" => "",
    "PostalCode" => "",
    "Country" => "United States"
);

if($_POST) {

    $nameArray = split_name($_POST["name"]);

    $contactData = array(
        "FirstName" => $nameArray["first_name"],
        "LastName" => $nameArray["last_name"],
        "Email" => $_POST["email"]
    );

    $shippingAddress["Address2Street1"] = $_POST["address"];
    $shippingAddress["Address2Street2"] = $_POST["address2"];
    $shippingAddress["City2"] = $_POST["city"];
    $shippingAddress["State2"] = $_POST["state"];
    $shippingAddress["PostalCode2"] = $_POST["zipcode"];

    $billingAddress["StreetAddress1"] = $_POST["address"];
    $billingAddress["StreetAddress2"] = $_POST["address2"];
    $billingAddress["City"] = $_POST["city"];
    $billingAddress["State"] = $_POST["state"];
    $billingAddress["PostalCode"] = $_POST["zipcode"];
    $billingAddress["Phone1"] = $_POST["phone"];

    require_once("lib/iSDK-master/isdk.php");
    $app = new iSDK;
    if ( $app->cfgCon("vp389") ) {
        //create contact
        if(isset($_POST["conID"])) {
            $conID = $_POST["conID"];
        } else {
            $conID = $app->addCon($contactData);
            //add billing info
            $conBillingID = $app->updateCon($conID, $billingAddress);
            // add shipping info
            $conShippingID = $app->updateCon($conID, $shippingAddress);
        }
        if( $conID ) {

            if(isset($_POST["creditCardID"])) {
                $creditCardID = $_POST["creditCardID"];
            } else {
                $expirationDateParts = explode("/", $_POST["ex-date"]);

                $card = array(
                    "NameOnCard" => $_POST["name"],
                    "CardType" => "Visa",
                    "ContactId" => $conID,
                    "CardNumber" => $_POST["cardnumber"],
                    "ExpirationMonth" => $expirationDateParts[0],
                    "ExpirationYear" => (2000 + $expirationDateParts[1]),
                    "CVV2" => $_POST["cvv"]);
                //validate credit card
                $checkCreditCard = $app->validateCard($card); //array(2) { ["Message"]=> string(19) "Validated 9/21/2017" ["Valid"]=> string(4) "true" }
                if (boolval($checkCreditCard["Valid"])) {
                    //add credit card to contact
                    $creditCardID = $app->dsAdd("CreditCard", $card);
                    if ($creditCardID) {

                    } else {
                        var_dump($creditCardID);
                    }
                } else {
                    var_dump($checkCreditCard);
                }
            }
            if($creditCardID) {
                //place order
                $addedOrder = $app->placeOrder(
                    $conID,
                    0, //if != 0 auto charge enabled
                    null,
                    array(1), //product list
                    array(),
                    false,
                    array()
                );
                //array(6) { ["Message"]=> string(4) "None" ["OrderId"]=> string(1) "7" ["InvoiceId"]=> string(1) "7" ["Successful"]=> string(5) "false" ["Code"]=> string(4) "None" ["RefNum"]=> string(4) "None" }

                if(isset($addedOrder["InvoiceId"])) {
                    $resultInvoice = $app->chargeInvoice($addedOrder["InvoiceId"],"API Test Payment",$creditCardID,3,false);
                    //array(4) { ["Message"]=> string(57) ""Your card was declined. Your request was in live mode ()" ["Successful"]=> bool(false) ["Code"]=> string(8) "Declined" ["RefNum"]=> string(0) "" }
                    if (boolval($resultInvoice["Successful"])) {
			session_start();
                    	$_SESSION['conID'] = "$conID";
                    	$_SESSION['creditCardID'] = "$creditCardID";
                    	header("Location: https://start.nowprep.com/wp-content/themes/optimizePressTheme/infu-upsell.php");
                    	exit();
                    } else {
                        var_dump($resultInvoice);
                    }
                    //session_start();
                    //$_SESSION['conID'] = "$conID";
                    //$_SESSION['creditCardID'] = "$creditCardID";
                    //header("Location: https://start.nowprep.com/wp-content/themes/optimizePressTheme/infu-upsell.php");
                    //exit();
                } else {
                    var_dump($addedOrder);
                }
            }
        } else {
            var_dump($conID);
        }
    } else {
        echo "Not Connected...";
    }
} else {
    session_destroy();
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
                                <?php if($conID) {?>
                                    <input type="hidden" name="conID" value="<?php echo $conID;?>">
                                <?php }?>
                                <?php if($creditCardID) {?>
                                    <input type="hidden" name="creditCardID" value="<?php echo $creditCardID;?>">
                                <?php }?>
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
                                    <button type="submit" class="sales-btn btn-info btn-lg">Place Order</button>
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
<script>
    $(document).ready(function() {
        $("#ex_date").mask("99/99", {"placeholder": ""});
    });
</script>
</body>
</html>
