<?php

require_once(__DIR__ . "/iSDK-master/isdk.php");

function split_name()
{
    $name = array();
    $name['first_name'] = "";
    $name['middle_name'] = "";
    $name['last_name'] = "";

    return $name;
}

$app = new iSDK;
if ($app->cfgCon("vp389")) {
    if ($_POST) {
        $ContactData = split_name();
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
            echo json_encode(array("result" => 1, "text" => 'Contact created successful.', "contactID" => $contactID));
        } else {
            echo json_encode(array("result" => 0, "text" => 'Contact not created.'));
        }
    }

} else {
    echo json_encode(array("result" => 0, "ErrorText" => "Could not connect to server."));
}

