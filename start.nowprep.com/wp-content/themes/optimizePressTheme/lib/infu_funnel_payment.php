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

/*
 * requered POST parameters
 * infuProductID - product ID for payment
 * NameOnCard - name on card
 * CardNumber - card number
 * Expiration - ExpirationMonth / ExpirationYear
 * CVV2 - security code
 *
 *
 * not requered parameters
 * Email
 * AddressStreet1
 * AddressStreet2
 * City
 * State
 * PostalCode
 * Country - by default filled as United States
 * contactGoal - contact created goal callname from campaign (for example = CompleteContactReadyVault)
 * paymentGoal - payment product goal callname from campaign (for example = PurchasedReadyVault)
 *
 * after execution return json object on server
 * if result = 0 is error, ErrorText contains message about error
 */

$app = new iSDK;
if ($app->cfgCon("vp389")) {
    if ($_POST) {
        if (!isset($_POST["infuProductID"])) {
            echo json_encode(array("result" => 0, "ErrorText" => "Not infuProductID for payment"));
        } else if (!isset($_POST["NameOnCard"])) {
            echo json_encode(array("result" => 0, "ErrorText" => "Not set NameOnCard"));
        } else if (!isset($_POST["CardNumber"])) {
            echo json_encode(array("result" => 0, "ErrorText" => "Not set CardNumber"));
        } else if (!isset($_POST["ExpirationMonth"])) {
            echo json_encode(array("result" => 0, "ErrorText" => "Not set Expiration"));
        } else if (!isset($_POST["ExpirationYear"])) {
            echo json_encode(array("result" => 0, "ErrorText" => "Not set Expiration"));
        } else if (!isset($_POST["CVV2"])) {
            echo json_encode(array("result" => 0, "ErrorText" => "Not set CVV2"));
        } else {
            // Split fullname for creation contact
            $ContactData = split_name($_POST["NameOnCard"]);
            $contactID = 0;
            if (is_array($ContactData)) {
                //
                $infuContactData = array(
                    "FirstName" => $ContactData["first_name"],
                    "LastName" => $ContactData["last_name"],
                    "Email" => $_POST["Email"]
                );
                if(isset($_POST["contactID"])) {
                    $contactID = $_POST["contactID"];
                    $contactID = $app->updateCon($contactID, $infuContactData);
                } else {
                    $contactID = $app->addCon($infuContactData);
                }
                // if set contact goal execute
                if (isset($_POST['contactGoal'])) {
                    $app->achieveGoal("vp389", $_POST['contactGoal'], $contactID);
                }
            }
            //var_dump($contactID);
            if ($contactID != 0) {
                if(!isset($_POST["firstaid"]))
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

                //$expirationDateParts = explode("/", $_POST["Expiration"]);


                // fix card number, remove spaces
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
//var_dump($checkCreditCard);
                    if ($checkCreditCard["Valid"] == "true") {
                        //add credit card to contact
                        $CreditCardID = $app->dsAdd("CreditCard", $infuCardData);
                        //place order
//var_dump($CreditCardID);
                        $listProducts = array();
                        $infuProductQuantity = isset($_POST["infuProductQuantity"]) ? $_POST["infuProductQuantity"] : 1;
                        for ($i = 0; $i < $infuProductQuantity; $i++) {
                            array_push($listProducts, $_POST["infuProductID"]);
                        }
                        if (isset($_POST["flwProductID"])) {
                            if (!empty($_POST["flwProductID"])) {
                                array_push($listProducts, $_POST["flwProductID"]);
                                $app->achieveGoal("vp389", "Purchased-Warranties", $contactID);
                            }
                        }
                        $infuOrderData = $app->placeOrder(
                            $contactID,
                            0,
                            null,
                            $listProducts,
                            array(),
                            false,
                            array()
                        );
//var_dump($infuOrderData);
                        if (isset($infuOrderData["InvoiceId"])) {
                            $contactID = $app->updateCon($contactID,
                                array(
                                    "_OrderNumber" => $infuOrderData["OrderId"]
                                ));


                            $returnFields = array('InvoiceTotal');
                            $query = array('Id' => $infuOrderData["InvoiceId"]);
                            $invoices = $app->dsQuery("Invoice", 10, 0, $query, $returnFields);
                            $totalPurchases = 0;
                            foreach ($invoices as $value) {
                                $totalPurchases = $totalPurchases + $value['InvoiceTotal'];
                            }

                            // pay invoice
                            $infuInvoiceData = $app->chargeInvoice($infuOrderData["InvoiceId"], "NOWPREP, LLC", $CreditCardID, 5, false);
                            if (boolval($infuInvoiceData["Successful"])) {
                                // if set payment goal execute
                                if (isset($_POST['paymentGoal'])) {
                                    if(!isset($_POST["firstaid"]))
                                        $app->achieveGoal("vp389", "ApplyContactPurchase", $contactID);
                                    $app->achieveGoal("vp389", $_POST['paymentGoal'], $contactID);
                                }
                                echo json_encode(array("result" => 1, "text" => 'Your payment was successful.', "total" => $totalPurchases, "contactID" => $contactID, "creditCardID" => $CreditCardID));
                            } else {
                                echo json_encode(array("result" => 0, "ErrorText" => $infuInvoiceData["Message"], "total" => $totalPurchases, "contactID" => $contactID, "creditCardID" => $CreditCardID));
                            }
                        }
                    } else {
                        echo json_encode(array("result" => 0, "ErrorText" => $checkCreditCard["Message"]));
                    }
                } else {
                    echo json_encode(array("result" => 0, "ErrorText" => "Not supported card type"));
                }

            } else {
                echo json_encode(array("result" => 0, "ErrorText" => "Contact not created"));
            }
        }
    }

} else {
    echo json_encode(array("result" => 0, "ErrorText" => "Could not connect to server."));
}

