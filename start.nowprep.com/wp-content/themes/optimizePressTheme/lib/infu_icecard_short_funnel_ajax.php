<?php

require_once(__DIR__ . "/iSDK-master/isdk.php");

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

function validateCC($cc_num)
{

    $AmericanExpress = "/^([34|37]{2})([0-9]{13})$/";//American Express
    $DiscoverCard = "/^([6011]{4})([0-9]{12})$/";//Discover Card
    $MasterCard = "/^([51|52|53|54|55]{2})([0-9]{14})$/";//MasterCard
    $Visa = "/^([4]{1})([0-9]{12,15})$/";//Visa

    if (preg_match($AmericanExpress, $cc_num)) {
        return "American Express";
    } else if (preg_match($DiscoverCard, $cc_num)) {
        return "Discover";
    } else if (preg_match($Visa, $cc_num)) {
        return "Visa";
    } else if (preg_match($MasterCard, $cc_num)) {
        return "MasterCard";
    } else {
        return "";
    }
}

function split_name($name)
{
    $parts = array();

    while (strlen(trim($name)) > 0) {
        $name = trim($name);
        $string = preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $parts[] = $string;
        $name = trim(preg_replace('#' . $string . '#', '', $name));
    }

    if (empty($parts)) {
        return false;
    }

    $parts = array_reverse($parts);
    $name = array();
    $name['first_name'] = $parts[0];
    $name['middle_name'] = (isset($parts[2])) ? $parts[1] : '';
    $name['last_name'] = (isset($parts[2])) ? $parts[2] : (isset($parts[1]) ? $parts[1] : '');

    return $name;
}

function fix_phone_format( $unformatedPhone ) {

    $formatedPhone = $unformatedPhone;
    $formatedPhone = str_replace("(","", $formatedPhone);
    $formatedPhone = str_replace(")","", $formatedPhone);
    $formatedPhone = str_replace("-","", $formatedPhone);
    $formatedPhone = str_replace(" ","", $formatedPhone);
    $formatedPhone = "+1" . $formatedPhone;
    return $formatedPhone;
}

$app = new iSDK;
if ($app->cfgCon("vp389")) {
    if ($_POST) {
        if (isset($_POST['lander'])) {
            $infuContactData = array(
                "FirstName" => "",
                "LastName" => "",
                "Email" => ""
            );
            $contactID = $app->addCon($infuContactData);
            if($contactID) {
                $contactID = $app->updateCon($contactID,
                    array(
                        "_utmsource" => (isset($_POST["utm_source"]) ? $_POST["utm_source"] : ""),
                        "_utmmedium" => (isset($_POST["utm_medium"]) ? $_POST["utm_medium"] : ""),
                        "_utmcampaign" => (isset($_POST["utm_campaign"]) ? $_POST["utm_campaign"] : ""),
                        "_utmterm" => (isset($_POST["utm_term"]) ? $_POST["utm_term"] : ""),
                        "_utmcontent" => (isset($_POST["utm_content"]) ? $_POST["utm_content"] : "")
                    ));
                $app->achieveGoal("vp389", "CRSICECard", $contactID);
                $hash = 2000 + $contactID;
                $hash = base64_encode($hash);

                $urlPDF = "https://start.nowprep.com/get-pdf/?ecs=" . $hash;
                $urlImage = "https://start.nowprep.com/get-pdf/?bpc=" . $hash;

                $contactID = $app->updateCon($contactID,
                    array(
                        "_PDFFileURL" => $urlPDF,
                        "_ImageFileURL" => $urlImage
                    ));
                echo json_encode(array("result" => 1, "text" => 'success', "conID" => $contactID));
            } else {
                echo json_encode(array("result" => 0, "text" => 'Error updating contact'));
            }
        } else if (isset($_POST['step7'])) {
            if (isset($_POST['conID'])) {
                $ContactData = split_name($_POST["_PersonalInfoName"]);
                $infuContactData = array(
                    "FirstName" => $ContactData["first_name"],
                    "LastName" => $ContactData["last_name"],
                    "Email" => $_POST["_PersonalInfoEmail"],
                    "_PersonalInfoName" => (isset($_POST["_PersonalInfoName"]) ? $_POST["_PersonalInfoName"] : ""),
                    "_PersonalInfoEmail" => (isset($_POST["_PersonalInfoEmail"]) ? $_POST["_PersonalInfoEmail"] : "")
                );
                $shippingAddress["Address2Street1"] = $_POST["AddressStreet1"];
                $shippingAddress["Address2Street2"] = $_POST["AddressStreet2"];
                $shippingAddress["City2"] = $_POST["City"];
                $shippingAddress["State2"] = $_POST["State"];
                $shippingAddress["PostalCode2"] = $_POST["PostalCode"];

                $contactID = $app->updateCon($_POST['conID'], $infuContactData);
                $contactID = $app->updateCon($_POST['conID'], $shippingAddress);

                echo json_encode(array("result" => 1, "text" => 'success', "conID" => $contactID));
            } else {
                echo json_encode(array("result" => 0, "text" => 'Error updating contact'));
            }
        } else if (isset($_POST['step8'])) {
            if (isset($_POST['conID'])) {
                $contactID = $_POST['conID'];
                $cardNumber = str_replace(" ", "", $_POST["CardNumber"]);

                // check credit card type
                $cardType = validateCC($cardNumber);
                if (!empty($cardType)) {
                    $CreditCardID = 0;
                    $infuCardData = array(
                        "NameOnCard" => $_POST["NameOnCard"],
                        "CardType" => $cardType,
                        "ContactId" => $contactID,
                        "CardNumber" => $cardNumber,
                        "ExpirationMonth" => $_POST["ExpirationMonth"],
                        "ExpirationYear" => (($_POST["ExpirationYear"] > 2000) ? $_POST["ExpirationYear"] : (2000 + $_POST["ExpirationYear"])),
                        "CVV2" => $_POST["CVV2"]
                    );
                    //validate credit card
                    $checkCreditCard = $app->validateCard($infuCardData);
                    if ($checkCreditCard["Valid"] == "true") {
                        //add credit card to contact
                        $CreditCardID = $app->dsAdd("CreditCard", $infuCardData);
                        //place order
                        $infuOrderData = $app->placeOrder(
                            $contactID,
                            0,
                            null,
                            array($_POST['_infuProductID']),
                            array(),
                            false,
                            array()
                        );
                        if (isset($infuOrderData["InvoiceId"])) {
                            // pau invoice
                            $infuInvoiceData = $app->chargeInvoice($infuOrderData["InvoiceId"], "NOWPREP, LLC", $CreditCardID, 5, false);
                            if (boolval($infuInvoiceData["Successful"])) {
                                $app->achieveGoal("vp389", "PSICECard", $contactID);
                                echo json_encode(array("result" => 1, "text" => 'Your payment was successful.'));
                            } else {
                                echo json_encode(array("result" => 0, "text" => $infuInvoiceData["Message"]));
                            }
                        }
                    } else {
                        echo json_encode(array("result" => 0, "text" => $checkCreditCard["Message"]));
                    }
                } else {
                    echo json_encode(array("result" => 0, "text" => 'Not supported card type'));
                }
            } else {
                echo json_encode(array("result" => 0, "text" => 'Error updating contact'));
            }
        }
    }
}