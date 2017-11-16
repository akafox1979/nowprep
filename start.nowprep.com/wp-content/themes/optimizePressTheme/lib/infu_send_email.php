
<?php

require_once(__DIR__."/iSDK-master/isdk.php");

if($_POST) {
    session_start();
    if (isset($_POST["sendemail"])) {
        if (isset($_POST['conID'])) {
            $app = new iSDK;
            if ($app->cfgCon("vp389")) {
                $conID = $_POST["conID"];
                if($conID) {
                    $returnFields = array("Email", "FirstName", "LastName");
                    $conDat = $app->loadCon($conID, $returnFields);
                    if(is_array($conDat)) {
                        $htmlContent = "";
                        $hash = 2000 + $conID;
                        $hash = base64_encode($hash);

                        $htmlContent .= "Congratulations " . ($conDat['FirstName'] . " " . $conDat['LastName']) . "!<br><br>You're almost finished creating your custom <b>NowPrep Emergency Pocket Pass</b> and being <b>more disaster-ready</b> than over 60% of Americans.<br><br>Stay Prepared,<br>The NowPrep Team<br><br>";
                        $htmlContent .= "To download the Emergency Card PDF click <a href='https://start.nowprep.com/get-pdf/?ec=" . $hash . "'>here</a>.<br>";
                        $htmlContent .= "To download Phone Background Image click <a href='https://start.nowprep.com/get-pdf/?bp=" . $hash . "'>here</a>.<br><br>";

                        $check = $app->sendEmail(
                            array($conID),
                            "info@nowprep.com",
                            "~Contact.Email~",
                            "",
                            "",
                            "HTML",
                            "Your NowPrep Emergency Pocket Pass",
                            $htmlContent,
                            "");

                        if($check) {
                            echo json_encode(array("result" => 1, "check" => $check));
                        }
                        else {
                            echo json_encode(array("result" => 0, "check" => $check));
                        }
                    }
                } else echo json_encode(array("result" => 0, "check" => "Contact ID empty"));
            } else echo json_encode(array("result" => 0, "check" => "Infusionsoft connect failed"));
        } else echo json_encode(array("result" => 0, "check" => ""));
    } else echo json_encode(array("result" => 0, "check" => ""));
} else echo json_encode(array("result" => 0, "check" => ""));

