<?php

require_once(__DIR__ . "/iSDK-master/isdk.php");


$app = new iSDK;
if ($app->cfgCon("vp389")) {
    if ($_POST) {
        if (isset($_POST['contactID']) && isset($_POST['creditCardID'])) {
            $app = new iSDK;
            if ($app->cfgCon("vp389")) {
                $contactID = $_POST["contactID"];
                $creditCardID = $_POST["creditCardID"];
                if ($creditCardID) {
                    $addedOrder = $app->placeOrder(
                        $contactID,
                        0, //if != 0 auto charge enabled
                        null,
                        array($_POST['productID']), //need change product ID
                        array(),
                        false,
                        array()
                    );

                    if (isset($addedOrder["InvoiceId"])) {
                        $contactID = $app->updateCon($contactID,
                            array(
                                "_OrderNumber" => $addedOrder["OrderId"]
                            ));
                        $returnFields = array('InvoiceTotal');
                        $query = array('Id' => $addedOrder["InvoiceId"]);
                        $invoices = $app->dsQuery("Invoice", 10, 0, $query, $returnFields);
                        $totalPurchases = 0;
                        foreach ($invoices as $value) {
                            $totalPurchases = $totalPurchases + $value['InvoiceTotal'];
                        }
                        $resultInvoice = $app->chargeInvoice($addedOrder["InvoiceId"],"NOWPREP, LLC",$creditCardID,5,false);
                        if (boolval($resultInvoice["Successful"])) {
                            $app->achieveGoal("vp389", "PurchasedFirstAID", $contactID);
                            echo json_encode(array("result" => 1, "text" => 'Your payment was successful.', "total" => $totalPurchases, "contactID" => $contactID, "creditCardID" => $creditCardID));
                        } else {
                            echo json_encode(array("result" => 0, "ErrorText" => $resultInvoice["Message"], "total" => $totalPurchases, "contactID" => $contactID, "creditCardID" => $creditCardID));
                        }
                    } else {
                    }
                }

            }
        }
    }

} else {
    echo json_encode(array("result" => 0, "ErrorText" => "Could not connect to server."));
}

