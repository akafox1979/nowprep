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

/*
 * check card type by card number
 */

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

/*
 * Split full name
 */
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

$app = new iSDK;
if ($app->cfgCon("vp389")) {
    if ($_POST) {
        $ContactData = split_name($_POST["NameOnCard"]);
        $contactID = 0;
        if (is_array($ContactData)) {
            $infuContactData = array(
                "FirstName" => $ContactData["first_name"],
                "LastName" => $ContactData["last_name"],
                "Email" => $_POST["Email"]
            );
            $contactID = $app->addCon($infuContactData);
        }

        if ($contactID != 0) {
            $app->achieveGoal("vp389", "ApplyContact", $contactID);
            //fill shipping and billing addresses
            $shippingAddress["Address2Street1"] = $_POST["AddressStreet1"];
            $shippingAddress["Address2Street2"] = $_POST["AddressStreet2"];
            $shippingAddress["City2"] = $_POST["City"];
            $shippingAddress["State2"] = $_POST["State"];
            $shippingAddress["PostalCode2"] = $_POST["PostalCode"];

            $billingAddress["StreetAddress1"] = isset($_POST["BillingAddressStreet1"]) ? $_POST["BillingAddressStreet1"] : $_POST["AddressStreet1"];
            $billingAddress["StreetAddress2"] = isset($_POST["BillingAddressStreet2"]) ? $_POST["BillingAddressStreet2"] : $_POST["AddressStreet2"];
            $billingAddress["City"] = isset($_POST["BillingCity"]) ? $_POST["BillingCity"] : $_POST["City"];
            $billingAddress["State"] = isset($_POST["BillingState"]) ? $_POST["BillingState"] : $_POST["State"];
            $billingAddress["PostalCode"] = isset($_POST["BillingPostalCode"]) ? $_POST["BillingPostalCode"] : $_POST["PostalCode"];
            $billingAddress["Phone1"] = $_POST["Phone"];

            // add shipping and billing addresses
            $contactID = $app->updateCon($contactID, $billingAddress);
            $contactID = $app->updateCon($contactID, $shippingAddress);
            $contactID = $app->updateCon($contactID,
                array(
                    "_utmsource" => (isset($_POST["utm_source"]) ? $_POST["utm_source"] : ""),
                    "_utmmedium" => (isset($_POST["utm_medium"]) ? $_POST["utm_medium"] : ""),
                    "_utmcampaign" => (isset($_POST["utm_campaign"]) ? $_POST["utm_campaign"] : ""),
                    "_utmterm" => (isset($_POST["utm_term"]) ? $_POST["utm_term"] : ""),
                    "_utmcontent" => (isset($_POST["utm_content"]) ? $_POST["utm_content"] : "")
                ));
            echo json_encode(array("result" => 1, "text" => 'Contact created successful.', "contactID" => $contactID));
        } else {
            echo json_encode(array("result" => 0, "text" => 'Contact not created.'));
        }
    }

} else {
    echo json_encode(array("result" => 0, "ErrorText" => "Could not connect to server."));
}

