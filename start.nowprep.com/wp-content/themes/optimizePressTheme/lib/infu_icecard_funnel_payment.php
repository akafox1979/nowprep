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
        $ContactData = split_name($_POST["_PersonalInfoName"]);
        $contactID = 0;
        if (is_array($ContactData)) {
            //
            $infuContactData = array(
                "FirstName" => $ContactData["first_name"],
                "LastName" => $ContactData["last_name"],
                "Email" => $_POST["_PersonalInfoEmail"]
            );
            $contactID = $app->addCon($infuContactData);

            // if set contact goal execute
            if (isset($_POST['contactGoal'])) {
                $app->achieveGoal("vp389", "CompleteContactICECard", $contactID);
            }
        }
        if ($contactID != 0) {
            //fill shipping and billing addresses
            $shippingAddress["Address2Street1"] = $_POST["_AddressStreet1"];
            $shippingAddress["Address2Street2"] = $_POST["_AddressStreet2"];
            $shippingAddress["City2"] = $_POST["_City"];
            $shippingAddress["State2"] = $_POST["_State"];
            $shippingAddress["PostalCode2"] = $_POST["_PostalCode"];

            $billingAddress["StreetAddress1"] = $_POST["_AddressStreet1"];
            $billingAddress["StreetAddress2"] = $_POST["_AddressStreet2"];
            $billingAddress["City"] = $_POST["_City"];
            $billingAddress["State"] = $_POST["_State"];
            $billingAddress["PostalCode"] = $_POST["_PostalCode"];
            $billingAddress["Phone1"] = $_POST["_Phone"];

            // add shipping and billing addresses
            $contactID = $app->updateCon($contactID, $billingAddress);
            $contactID = $app->updateCon($contactID, $shippingAddress);
            $contactID = $app->updateCon($contactID,
                array (
                    "_WhoFor" => (isset($_POST["_WhoFor"]) ? $_POST["_WhoFor"] : ""),
                    "_PersonalInfoSex" => (isset($_POST["_PersonalInfoSex"]) ? $_POST["_PersonalInfoSex"] : ""),
                    "_PersonalInfoDOB" => (isset($_POST["_PersonalInfoDOB"]) ? $_POST["_PersonalInfoDOB"] : ""),
                    "_PersonalInfoName" => (isset($_POST["_PersonalInfoName"]) ? $_POST["_PersonalInfoName"] : ""),
                    "_PersonalInfoPhone" => (isset($_POST["_PersonalInfoPhone"]) ? $_POST["_PersonalInfoPhone"] : ""),
                    "_PersonalInfoEmail" => (isset($_POST["_PersonalInfoEmail"]) ? $_POST["_PersonalInfoEmail"] : ""),
                    "_PersonalInfoOther" => (isset($_POST["_PersonalInfoOther"]) ? $_POST["_PersonalInfoOther"] : ""),
                    "_ContactsAddressPrimaryName" => (isset($_POST["_ContactsAddressPrimaryName"]) ? $_POST["_ContactsAddressPrimaryName"] : ""),
                    "_ContactsAddressPrimaryRelation" => (isset($_POST["_ContactsAddressPrimaryRelation"]) ? $_POST["_ContactsAddressPrimaryRelation"] : ""),
                    "_ContactsAddressPrimaryPhone" => (isset($_POST["_ContactsAddressPrimaryPhone"]) ? $_POST["_ContactsAddressPrimaryPhone"] : ""),
                    "_ContactsAddressPrimaryEmail" => (isset($_POST["_ContactsAddressPrimaryEmail"]) ? $_POST["_ContactsAddressPrimaryEmail"] : ""),
                    "_ContactsAddressSecondaryName" => (isset($_POST["_ContactsAddressSecondaryName"]) ? $_POST["_ContactsAddressSecondaryName"] : ""),
                    "_ContactsAddressSecondaryRelation" => (isset($_POST["_ContactsAddressSecondaryRelation"]) ? $_POST["_ContactsAddressSecondaryRelation"] : ""),
                    "_ContactsAddressSecondaryPhone" => (isset($_POST["_ContactsAddressSecondaryPhone"]) ? $_POST["_ContactsAddressSecondaryPhone"] : ""),
                    "_ContactsAddressSecondaryEmail" => (isset($_POST["_ContactsAddressSecondaryEmail"]) ? $_POST["_ContactsAddressSecondaryEmail"] : ""),
                    "_ContactsAddressAddressType" => (isset($_POST["_ContactsAddressAddressType"]) ? $_POST["_ContactsAddressAddressType"] : ""),
                    "_ContactsAddressAddress" => (isset($_POST["_ContactsAddressAddress"]) ? $_POST["_ContactsAddressAddress"] : ""),
                    "_BloodType" => (isset($_POST["_BloodType"]) ? $_POST["_BloodType"] : ""),
                    "_AllergiesMedicineOptions" => (isset($_POST["_AllergiesMedicineOptions"]) ? $_POST["_AllergiesMedicineOptions"] : ""),
                    "_AllergiesMedicineOther" => (isset($_POST["_AllergiesMedicineOther"]) ? $_POST["_AllergiesMedicineOther"] : ""),
                    "_AllergiesFoodOptions" => (isset($_POST["_AllergiesFoodOptions"]) ? $_POST["_AllergiesFoodOptions"] : ""),
                    "_AllergiesFoodOther" => (isset($_POST["_AllergiesFoodOther"]) ? $_POST["_AllergiesFoodOther"] : ""),
                    "_AdditionalMedicalInformation" => (isset($_POST["_AdditionalMedicalInformation"]) ? $_POST["_AdditionalMedicalInformation"] : ""),
                    "_AdditionalMiscInformation" => (isset($_POST["_AdditionalMiscInformation"]) ? $_POST["_AdditionalMiscInformation"] : ""),
                    "_utmsource" => (isset($_POST["utm_source"]) ? $_POST["utm_source"] : ""),
                    "_utmmedium" => (isset($_POST["utm_medium"]) ? $_POST["utm_medium"] : ""),
                    "_utmcampaign" => (isset($_POST["utm_campaign"]) ? $_POST["utm_campaign"] : ""),
                    "_utmterm" => (isset($_POST["utm_term"]) ? $_POST["utm_term"] : ""),
                    "_utmcontent" => (isset($_POST["utm_content"]) ? $_POST["utm_content"] : "")
                )
            );

            $cardNumber = str_replace(" ", "", $_POST["_CardNumber"]);

            // check credit card type
            $cardType = validateCC($cardNumber);
            if (!empty($cardType)) {
                $CreditCardID = 0;
                $infuCardData = array(
                    "NameOnCard" => $_POST["_NameOnCard"],
                    "CardType" => $cardType,
                    "ContactId" => $contactID,
                    "CardNumber" => $cardNumber,
                    "ExpirationMonth" => $_POST["_ExpirationMonth"],
                    "ExpirationYear" => (($_POST["_ExpirationYear"] > 2000) ? $_POST["_ExpirationYear"] : (2000 + $_POST["_ExpirationYear"])),
                    "CVV2" => $_POST["+CVV2"]
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
                            // if set payment goal execute
                            if(isset($_POST['paymentGoal'])) {
                                $app->achieveGoal("vp389", "PurchasedICECard", $contactID);
                            }
                            echo json_encode(array("result" => 1, "text" => 'Your payment was successful.'));
                        } else {
                            echo json_encode(array("result" => 0, "ErrorText" => $resultInvoice["Message"]));
                        }
                    }
                } else {
                    echo json_encode(array("result" => 0, "ErrorText" => $checkCreditCard["Message"]));
                }
            } else {
                echo json_encode(array("result" => 0, "ErrorText" => "Not supported card type"));
            }

        }
    }
}
