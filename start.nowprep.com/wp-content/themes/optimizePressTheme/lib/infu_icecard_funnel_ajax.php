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
                $app->achieveGoal("vp389", "CRICECard", $contactID);
                $hash = 2000 + $contactID;
                $hash = base64_encode($hash);

                $urlPDF = "https://start.nowprep.com/get-pdf/?ecc=" . $hash;
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
        } else if (isset($_POST['step2'])) {
            if (isset($_POST['conID'])) {
                $ContactData = split_name($_POST["_PersonalInfoName"]);
                $infuContactData = array(
                    "FirstName" => $ContactData["first_name"],
                    "LastName" => $ContactData["last_name"],
                    "Email" => $_POST["_PersonalInfoEmail"]
                );
                $contactID = $app->updateCon($_POST['conID'], $infuContactData);
                $_PersonalInfoPhone = "";
                if (isset($_POST["_PersonalInfoPhone"])) {
                    $_PersonalInfoPhone = fix_phone_format($_POST["_PersonalInfoPhone"]);
                }
                if ($contactID) {
                    $hash = 2000 + $contactID;
                    $hash = base64_encode($hash);

                    $urlPDF = "https://start.nowprep.com/get-pdf/?ecc=" . $hash;
                    $urlImage = "https://start.nowprep.com/get-pdf/?bpc=" . $hash;

                    $contactID = $app->updateCon($contactID,
                        array(
                            "Phone1" => (isset($_POST["_PersonalInfoPhone"]) ? $_POST["_PersonalInfoPhone"] : ""),
                            "_WhoFor" => (isset($_POST["_WhoFor"]) ? $_POST["_WhoFor"] : ""),
                            "_PersonalInfoSex" => (isset($_POST["_PersonalInfoSex"]) ? $_POST["_PersonalInfoSex"] : ""),
                            "_PersonalInfoDOB" => (isset($_POST["_PersonalInfoDOB"]) ? $_POST["_PersonalInfoDOB"] : ""),
                            "_PersonalInfoName" => (isset($_POST["_PersonalInfoName"]) ? $_POST["_PersonalInfoName"] : ""),
                            "_PersonalInfoPhone" => $_PersonalInfoPhone,
                            "_PersonalInfoEmail" => (isset($_POST["_PersonalInfoEmail"]) ? $_POST["_PersonalInfoEmail"] : ""),
                            "_PersonalInfoOther" => (isset($_POST["_PersonalInfoOther"]) ? $_POST["_PersonalInfoOther"] : ""),
                            "_PDFFileURL" => $urlPDF,
                            "_ImageFileURL" => $urlImage
                        ));
                    $app->achieveGoal("vp389", "CRICECard", $contactID);


                    echo json_encode(array("result" => 1, "text" => 'success', "conID" => $contactID));
                } else {
                    echo json_encode(array("result" => 0, "text" => 'Error creation contact'));
                }
            }
        } else if (isset($_POST['step3'])) {
            if (isset($_POST['conID'])) {
                $_ContactsAddressPrimaryPhone = "";
                if(isset($_POST["_ContactsAddressPrimaryPhone"])) {
                    $_ContactsAddressPrimaryPhone = fix_phone_format($_POST["_ContactsAddressPrimaryPhone"]);
                }
                $_ContactsAddressSecondaryPhone = "";
                if(isset($_POST["_ContactsAddressSecondaryPhone"])) {
                    $_ContactsAddressSecondaryPhone = fix_phone_format($_POST["_ContactsAddressSecondaryPhone"]);
                }

                $contactID = $app->updateCon($_POST['conID'],
                    array(
                        "_ContactsAddressPrimaryName" => (isset($_POST["_ContactsAddressPrimaryName"]) ? $_POST["_ContactsAddressPrimaryName"] : ""),
                        "_ContactsAddressPrimaryRelation" => (isset($_POST["_ContactsAddressPrimaryRelation"]) ? $_POST["_ContactsAddressPrimaryRelation"] : ""),
                        "_ContactsAddressPrimaryPhone" => $_ContactsAddressPrimaryPhone,
                        "_ContactsAddressPrimaryEmail" => (isset($_POST["_ContactsAddressPrimaryEmail"]) ? $_POST["_ContactsAddressPrimaryEmail"] : ""),
                        "_ContactsAddressSecondaryName" => (isset($_POST["_ContactsAddressSecondaryName"]) ? $_POST["_ContactsAddressSecondaryName"] : ""),
                        "_ContactsAddressSecondaryRelation" => (isset($_POST["_ContactsAddressSecondaryRelation"]) ? $_POST["_ContactsAddressSecondaryRelation"] : ""),
                        "_ContactsAddressSecondaryPhone" => $_ContactsAddressSecondaryPhone,
                        "_ContactsAddressSecondaryEmail" => (isset($_POST["_ContactsAddressSecondaryEmail"]) ? $_POST["_ContactsAddressSecondaryEmail"] : ""),
                        "_ContactsAddressAddressType" => (isset($_POST["_ContactsAddressAddressType"]) ? $_POST["_ContactsAddressAddressType"] : ""),
                        "_ContactsAddressAddress" => (isset($_POST["_ContactsAddressAddress"]) ? $_POST["_ContactsAddressAddress"] : "")
                    ));
                $app->achieveGoal("vp389", "CCICECard", $contactID);

                echo json_encode(array("result" => 1, "text" => 'success', "conID" => $contactID));
            } else {
                echo json_encode(array("result" => 0, "text" => 'Error updating contact'));
            }
        } else if (isset($_POST['step4'])) {
            if (isset($_POST['conID'])) {
                $contactID = $app->updateCon($_POST['conID'],
                    array(
                        "_BloodType" => (isset($_POST["_BloodType"]) ? $_POST["_BloodType"] : ""),
                    ));
                echo json_encode(array("result" => 1, "text" => 'success', "conID" => $contactID));
            } else {
                echo json_encode(array("result" => 0, "text" => 'Error updating contact'));
            }
        } else if (isset($_POST['step5'])) {
            if (isset($_POST['conID'])) {
                $contactID = $app->updateCon($_POST['conID'],
                    array(
                        "_AllergiesMedicineOptions" => (isset($_POST["_AllergiesMedicineOptions"]) ? $_POST["_AllergiesMedicineOptions"] : ""),
                        "_AllergiesMedicineOther" => (isset($_POST["_AllergiesMedicineOther"]) ? $_POST["_AllergiesMedicineOther"] : ""),
                    ));
                echo json_encode(array("result" => 1, "text" => 'success', "conID" => $contactID));
            } else {
                echo json_encode(array("result" => 0, "text" => 'Error updating contact'));
            }
        } else if (isset($_POST['step6'])) {
            $infuContactData = array(
                "FirstName" => "",
                "LastName" => "",
                "Email" => ""
            );
            $contactID = $app->addCon($infuContactData);
            //if (isset($_POST['conID'])) {
            if($contactID) {
                $contactID = $app->updateCon($contactID,
                    array(
                        "_AllergiesFoodOptions" => (isset($_POST["_AllergiesFoodOptions"]) ? $_POST["_AllergiesFoodOptions"] : ""),
                        "_AllergiesFoodOther" => (isset($_POST["_AllergiesFoodOther"]) ? $_POST["_AllergiesFoodOther"] : ""),
                        "_utmsource" => (isset($_POST["utm_source"]) ? $_POST["utm_source"] : ""),
                        "_utmmedium" => (isset($_POST["utm_medium"]) ? $_POST["utm_medium"] : ""),
                        "_utmcampaign" => (isset($_POST["utm_campaign"]) ? $_POST["utm_campaign"] : ""),
                        "_utmterm" => (isset($_POST["utm_term"]) ? $_POST["utm_term"] : ""),
                        "_utmcontent" => (isset($_POST["utm_content"]) ? $_POST["utm_content"] : "")
                    ));
                $app->achieveGoal("vp389", "AFICECard", $contactID);
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
                                $app->achieveGoal("vp389", "PICECard", $contactID);
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
