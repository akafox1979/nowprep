
<?php

require_once(__DIR__."/iSDK-master/isdk.php");

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

function validateCC($cc_num) {

    $AmericanExpress = "/^([34|37]{2})([0-9]{13})$/";//American Express
    $DiscoverCard = "/^([6011]{4})([0-9]{12})$/";//Discover Card
    $MasterCard = "/^([51|52|53|54|55]{2})([0-9]{14})$/";//MasterCard
    $Visa = "/^([4]{1})([0-9]{12,15})$/";//Visa

    if (preg_match($AmericanExpress,$cc_num)) {
        return "American Express";
    } else if (preg_match($DiscoverCard,$cc_num)) {
        return "Discover";
    } else if (preg_match($Visa,$cc_num)) {
        return "Visa";
    } else if (preg_match($MasterCard,$cc_num)) {
        return "MasterCard";
    } else {
        return "";
    }
}

if($_POST) {
    session_start();
    if(isset($_POST["upsell"])) {
        if (isset($_POST['conID']) && isset($_POST['creditCardID'])) {
            $app = new iSDK;
            if ($app->cfgCon("vp389")) {
                $conID = $_POST["conID"];
                $creditCardID = $_POST["creditCardID"];
                if ($creditCardID) {
                    $addedOrder = $app->placeOrder(
                        $conID,
                        0, //if != 0 auto charge enabled
                        null,
                        array(5), //product = Ready Vault
                        array(),
                        false,
                        array()
                    );

                    if (isset($addedOrder["InvoiceId"])) {
                        $resultInvoice = $app->chargeInvoice($addedOrder["InvoiceId"],"NOWPREP, LLC",$creditCardID,5,false);
                        if (boolval($resultInvoice["Successful"])) {
                            echo json_encode(array("result" => 1, "text" => 'Your payment was successful.', "conID" => $conID, "creditCardID" => $creditCardID));
                        } else {
                            echo json_encode(array("result" => 0, "text" => $resultInvoice["Message"]));
                        }
                    } else {
                        //echo json_encode(array("result" => 0, "text" => $addedOrder["Message"]));
                    }
                }

            }
        }
    } else {
        if (isset($_POST['conID'])) {
            $conID = $_POST['conID'];
            if ($conID) {
                $app = new iSDK;
                if ($app->cfgCon("vp389")) {
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

                    //add billing info
                    $conBillingID = $app->updateCon($conID, $billingAddress);
                    // add shipping info
                    $conShippingID = $app->updateCon($conID, $shippingAddress);

                    $expirationDateParts = explode("/", $_POST["ex-date"]);

                    $cardNumber = str_replace(" ","",$_POST["cardnumber"]);

                    $cardType = validateCC($cardNumber);

                    $card = array(
                        "NameOnCard" => $_POST["firstname"],
                        "CardType" => $cardType,
                        "ContactId" => $conID,
                        "CardNumber" => $cardNumber,
                        "ExpirationMonth" => $expirationDateParts[0],
                        "ExpirationYear" => (2000 + $expirationDateParts[1]),
                        "CVV2" => $_POST["cvv"]);

                    //validate credit card
                    $checkCreditCard = $app->validateCard($card); //array(2) { ["Message"]=> string(19) "Validated 9/21/2017" ["Valid"]=> string(4) "true" }
                    if ($checkCreditCard["Valid"] == "true") {
                        //add credit card to contact
                        $creditCardID = $app->dsAdd("CreditCard", $card);
                        if ($creditCardID) {
                            //place order
                            $addedOrder = $app->placeOrder(
                                $conID,
                                0, //if != 0 auto charge enabled
                                null,
                                array(3), //product = Emergency Prep Pass
                                array(),
                                false,
                                array()
                            );
                            if (isset($addedOrder["InvoiceId"])) {
                                $resultInvoice = $app->chargeInvoice($addedOrder["InvoiceId"], "NOWPREP, LLC", $creditCardID, 5, false);
                                if (boolval($resultInvoice["Successful"])) {
				    $app->achieveGoal("vp389", "Purchased Tripwire", $conID);
                                    echo json_encode(array("result" => 1, "text" => 'Your payment was successful.',"conID" => $conID, "creditCardID" => $creditCardID));
                                } else {
                                    echo json_encode(array("result" => 0, "text" => $resultInvoice["Message"]));
                                }
                            } else {

                            }
                        } else {
                        }
                    } else {
                        echo json_encode(array("result" => 0, "text" => $checkCreditCard["Message"]));
                    }
                }
            }
        }
    }
}
/*require __DIR__ . "/stripe-php-5.1.3/init.php";

if ($_POST) {
    \Stripe\Stripe::setApiKey("sk_test_rMIjof8elsiTuXmLzgGiVOos");
    $error = '';
    $success = '';
    try {
        if (!isset($_POST['stripeToken']))
            throw new Exception("The Stripe Token was not generated correctly");
        \Stripe\Charge::create(array("amount" => intval($_POST['amount']),
            "currency" => "usd",
            "card" => $_POST['stripeToken']));
        $success = 'Your payment was successful.';
        echo json_encode(array("result" => 1, "text" => $success));
    }
    catch (Exception $e) {
        $error = $e->getMessage();
        echo json_encode(array("result" => 0, "text" => $error));
    }
}
*/

