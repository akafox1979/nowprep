<?php
/*
 * Template Name: Get PDF page template
 */


session_destroy();
function get_template_directory_uri()
{
    return 'https://nowprep.com/card';
}

require_once(get_template_directory() . "/lib/iSDK-master/isdk.php");

var_dump($_GET);

if (isset($_GET)) {
    if (is_page("get-pdf")) {
        $contactData = array(
            "mode" => "",
            "firstname" => "",
            "email" => "",
            "name1" => "",
            "name2" => "",
            "email1" => "",
            "email2" => "",
            "phone1" => "",
            "phone2" => "",
            "address1" => "",
            "address2" => ""
        );
        $contactID = 0;
        if (isset($_GET['ec'])) {
            $contactData["mode"] = "ec";
            $contactID = $_GET['ec'];
        } else if (isset($_GET['bp'])) {
            $contactData["mode"] = "bp";
            $contactID = $_GET['bp'];
        }
        if (!empty($contactID)) {
            $conID = base64_decode($contactID);
            $conID = $conID - 2000;
            if ($conID > 0) {
                $app = new iSDK;
                if ($app->cfgCon("vp389")) {
                    $returnFields = array(
                        "Email",
                        "FirstName",
                        "LastName",
                        "_Contact1Name",
                        "_Contact1Email",
                        "_Contact1Phone",
                        "_Contact1Address0",
                        "_Contact2Name",
                        "_Contact1Email0",
                        "_Contact2Phone",
                        "_Contact2Address"
                    );
                    $conDat = $app->loadCon($conID, $returnFields);
                    if (is_array($conDat)) {
                        $contactData["firstname"] = trim($conDat["FirstName"] . " " . $conDat["LastName"]);
                        $contactData["email"] = $conDat["Email"];
                        $contactData["name1"] = $conDat["_Contact1Name"];
                        $contactData["name2"] = $conDat["_Contact2Name"];
                        $contactData["email1"] = $conDat["_Contact1Email"];
                        $contactData["email2"] = $conDat["_Contact1Email0"];
                        $contactData["phone1"] = $conDat["_Contact1Phone"];
                        $contactData["phone2"] = $conDat["_Contact2Phone"];
                        $contactData["address1"] = $conDat["_Contact1Address0"];
                        $contactData["address2"] = $conDat["_Contact2Address"];
                    }
                }
            }
        } ?>
        <script>
            var postData = "<?php echo json_encode($contactData);?>";
        </script>
        <?php
    }
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=320, user-scalable=no">
    <title>NowPrep</title>
    <link rel="icon"
          href="<?php echo str_replace('http://', 'https://', get_template_directory_uri()); ?>/assets/images/NowPrep_CheckFavicon_16x16d.png"
          sizes="16x16" type="image/png">
    <link rel="stylesheet"
          href="<?php echo str_replace('http://', 'https://', get_template_directory_uri()); ?>/assets/css/bootstrap.css?v=<?php echo time(); ?>">
    <style>
        @font-face {
            font-family: 'FontAwesome';
            src: url('<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/fonts/fontawesome-webfont.eot?v=4.7.0');
            src: url('<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/fonts/fontawesome-webfont.eot?#iefix&v=4.7.0') format('embedded-opentype'), url('<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/fonts/fontawesome-webfont.woff2?v=4.7.0') format('woff2'), url('<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/fonts/fontawesome-webfont.woff?v=4.7.0') format('woff'), url('<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/fonts/fontawesome-webfont.ttf?v=4.7.0') format('truetype'), url('<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/fonts/fontawesome-webfont.svg?v=4.7.0#fontawesomeregular') format('svg');
            font-weight: normal;
            font-style: normal;
        }
    </style>
    <link href="<?php echo str_replace('http://', 'https://', get_template_directory_uri()); ?>/assets/css/fixes.css?v=<?php echo time(); ?>"
          rel="stylesheet" type="text/css">

    <script src="<?php echo str_replace('http://', 'https://', get_template_directory_uri()); ?>/assets/js/jquery.min.js?v=<?php echo time(); ?>"></script>
    <script src="<?php echo str_replace('http://', 'https://', get_template_directory_uri()); ?>/assets/js/jquery.maskedinput.js?v=<?php echo time(); ?>"
            type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js" type="text/javascript"></script>
</head>
<body>
<style>

</style>
<div class="wrapper index">
    <div class="template-sales">
        <section id="sales-sec2">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <canvas id="emergency_card" width="1275" height="1650"
                                style="border: none; display:none;"></canvas>
                        <img id="emergency_card_img" src=""
                             style="width: 1275px;height: 1650px;margin: 0px 0px;display:none;"/>
                        <h4><strong>Thank you!</strong></h4>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <p class="link-footer"><a href="#">About Us</a> | <a href="#">Contact Us</a></p>
                    <p class="copyright">Copyright © 2017 NowPrep.com. All Right Reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</div>
<script>
    jQuery(document).ready(function () {
        var c = document.getElementById("emergency_card");
        var ctx = c.getContext("2d");

        ctx.clearRect(0, 0, c.width, c.height);

        var img = new Image();
        img.onload = function () {
            ctx.drawImage(img, 0, 0);
            ctx.font = "40px Arial";
            ctx.textAlign = "center";
            ctx.fillText("Congratulations " + postData['firstname'] + "!", 637, 210);

            ctx.font = "14px Arial";
            ctx.textAlign = "left";
            ctx.fillText(postData['name1'], 195, 1069);
            ctx.fillText(postData['name2'], 770, 1069);
            ctx.fillText(postData['name1'], 195, 1402);
            ctx.fillText(postData['name2'], 770, 1402);

            ctx.fillText(postData['email1'], 170, 1100);
            ctx.fillText(postData['email2'], 745, 1100);
            ctx.fillText(postData['email1'], 170, 1433);
            ctx.fillText(postData['email2'], 745, 1433);

            ctx.fillText(postData['phone1'], 170, 1133);
            ctx.fillText(postData['phone2'], 745, 1133);
            ctx.fillText(postData['phone1'], 170, 1466);
            ctx.fillText(postData['phone2'], 745, 1466);

            ctx.fillText(postData['address1'], 130, 1185);
            ctx.fillText(postData['address2'], 703, 1185);
            ctx.fillText(postData['address1'], 130, 1518);
            ctx.fillText(postData['address2'], 703, 1518);

            var canvas = document.getElementById("emergency_card");
            var imgData = canvas.toDataURL("image/png", 1.0);

            document.getElementById("emergency_card_img").src = imgData;

            var imgData = canvas.toDataURL("image/jpeg", 1.0);
            var pdf = jsPDF('p', 'mm');
            var width = pdf.internal.pageSize.width;
            var height = pdf.internal.pageSize.height;
            pdf.addImage(imgData, 'JPG', 0, 0, width, height);
            var pdfData = btoa(pdf.output());
            debugger;
            jQuery("#downloadLink").remove();
            jQuery("body").append('<a id="downloadLink" style="display:none" href="data:application/octet-stream;charset=utf-8;base64,' + pdfData + '">Download File</a>';
            jQuery("#downloadLink").click();

        };
        img.src = 'https://start.nowprep.com/card/assets/images/ecc.png';
    });
</script>
    <script>

    jQuery(document).ready(function () {
            var c1 = document.getElementById("emergency_card");
            var ctx1 = c1.getContext("2d");
            ctx1.clearRect(0, 0, c.width, c.height);
            var img1 = new Image();
            img1.onload = function () {
                ctx1.drawImage(img, 0, 0);
                ctx1.font = "40px Arial";
                ctx1.textAlign = "center";
                ctx1.fillText("Congratulations " + postData['firstname'] + "!", 637, 210);
                ctx1.font = "14px Arial";
                ctx1.textAlign = "left";
                ctx1.fillText(postData['name1'], 195, 1069);
                ctx1.fillText(postData['name2'], 770, 1069);
                ctx1.fillText(postData['name1'], 195, 1402);
                ctx1.fillText(postData['name2'], 770, 1402);
                ctx1.fillText(postData['email1'], 170, 1100);
                ctx1.fillText(postData['email2'], 745, 1100);
                ctx1.fillText(postData['email1'], 170, 1433);
                ctx1.fillText(postData['email2'], 745, 1433);
                ctx1.fillText(postData['phone1'], 170, 1133);
                ctx1.fillText(postData['phone2'], 745, 1133);
                ctx1.fillText(postData['phone1'], 170, 1466);
                ctx1.fillText(postData['phone2'], 745, 1466);
                ctx1.fillText(postData['address1'], 130, 1185);
                ctx1.fillText(postData['address2'], 703, 1185);
                ctx1.fillText(postData['address1'], 130, 1518);
                ctx1.fillText(postData['address2'], 703, 1518);
                var canvas1 = document.getElementById("emergency_card");
                var imgData1 = canvas1.toDataURL("image/png", 1.0);
                document.getElementById("emergency_card_img").src = imgData1;
                var imgData1 = canvas.toDataURL("image/jpeg", 1.0);
                var pdf1 = jsPDF('p', 'mm');
                var width1 = pdf.internal.pageSize.width;
                var height1 = pdf.internal.pageSize.height;
                pdf1.addImage(imgData1, 'JPG', 0, 0, width1, height1);
                var pdfData1 = btoa(pdf1.output());
                debugger;
                download("data:application/pdf;base64," + pdfData1, "EmergencyCard.pdf", "application/pdf");
            };
            img1.src = 'https://start.nowprep.com/card/assets/images/ecc.png';

            var c = document.getElementById("emergency_card_back");
            var ctx = c.getContext("2d");
            ctx.clearRect(0, 0, c.width, c.height);
            var img = new Image();
            img.onload = function () {
                ctx.drawImage(img, 0, 0);
                ctx.font = "60px Arial";
                ctx.textAlign = "center";
                ctx.fillStyle = 'white';
                ctx.fillText(postData['firstname'], 1440/2, 930);
                ctx.fillText(postData['email'], 1440/2, 1010);

                ctx.font = "70px Arial";
                ctx.fillText(postData['name1'], 1440/2, 1510);
                ctx.fillText(postData['name2'], 1440/2, 1710);

                ctx.font = "bold 80px Arial";
                var phone1 = postData['phone1'].replace("(","").replace(")","").replace("-","").replace(" ","");
                var phone2 = postData['phone2'].replace("(","").replace(")","").replace("-","").replace(" ","");
                ctx.fillText(phone1.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "$1.$2.$3"), 1440/2, 1600);
                ctx.fillText(phone2.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "$1.$2.$3"), 1440/2, 1800);

                var canvas = document.getElementById("emergency_card_back");
                var imgData = canvas.toDataURL("image/png", 1.0);
                document.getElementById("emergency_card_img_back").src = imgData;
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = jsPDF('p', 'mm');
                var width = pdf.internal.pageSize.width;
                var height = pdf.internal.pageSize.height;
                pdf.addImage(imgData, 'JPG', 0, 0, width, height);
                var pdfData = btoa(pdf.output());
                debugger;
                download("data:application/pdf;base64," + pdfData, "PhoneBackground.pdf", "application/pdf");
            };
            img.src = 'https://start.nowprep.com/card/assets/images/ebp.png';

    });

</script>

<script>

    function ecc() {
        var c = document.getElementById("emergency_card");
        var ctx = c.getContext("2d");
        ctx.clearRect(0, 0, c.width, c.height);
        var img = new Image();
        img.onload = function () {
            ctx.drawImage(img, 0, 0);
            ctx.font = "40px Arial";
            ctx.textAlign = "center";
            ctx.fillText("Congratulations " + postData['firstname'] + "!", 637, 210);
            ctx.font = "14px Arial";
            ctx.textAlign = "left";
            ctx.fillText(postData['name1'], 195, 1069);
            ctx.fillText(postData['name2'], 770, 1069);
            ctx.fillText(postData['name1'], 195, 1402);
            ctx.fillText(postData['name2'], 770, 1402);
            ctx.fillText(postData['email1'], 170, 1100);
            ctx.fillText(postData['email2'], 745, 1100);
            ctx.fillText(postData['email1'], 170, 1433);
            ctx.fillText(postData['email2'], 745, 1433);
            ctx.fillText(postData['phone1'], 170, 1133);
            ctx.fillText(postData['phone2'], 745, 1133);
            ctx.fillText(postData['phone1'], 170, 1466);
            ctx.fillText(postData['phone2'], 745, 1466);
            ctx.fillText(postData['address1'], 130, 1185);
            ctx.fillText(postData['address2'], 703, 1185);
            ctx.fillText(postData['address1'], 130, 1518);
            ctx.fillText(postData['address2'], 703, 1518);
            var canvas = document.getElementById("emergency_card");
            var imgData = canvas.toDataURL("image/png", 1.0);
            document.getElementById("emergency_card_img").src = imgData;
            var imgData = canvas.toDataURL("image/jpeg", 1.0);
            var pdf = jsPDF('p', 'mm');
            var width = pdf.internal.pageSize.width;
            var height = pdf.internal.pageSize.height;
            pdf.addImage(imgData, 'JPG', 0, 0, width, height);
            var pdfData = btoa(pdf.output());
            debugger;
            download("data:application/pdf;base64," + pdfData, "EmergencyCard.pdf", "application/pdf");
        };
        img.src = 'https://start.nowprep.com/card/assets/images/ecc.png';
    }
    function bp() {
        var c = document.getElementById("emergency_card_back");
        var ctx = c.getContext("2d");
        ctx.clearRect(0, 0, c.width, c.height);
        var img = new Image();
        img.onload = function () {
            ctx.drawImage(img, 0, 0);
            ctx.font = "60px Arial";
            ctx.textAlign = "center";
            ctx.fillStyle = 'white';
            ctx.fillText(postData['firstname'], 1440/2, 930);
            ctx.fillText(postData['email'], 1440/2, 1010);

            ctx.font = "70px Arial";
            ctx.fillText(postData['name1'], 1440/2, 1510);
            ctx.fillText(postData['name2'], 1440/2, 1710);

            ctx.font = "bold 80px Arial";
            var phone1 = postData['phone1'].replace("(","").replace(")","").replace("-","").replace(" ","");
            var phone2 = postData['phone2'].replace("(","").replace(")","").replace("-","").replace(" ","");
            ctx.fillText(phone1.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "$1.$2.$3"), 1440/2, 1600);
            ctx.fillText(phone2.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "$1.$2.$3"), 1440/2, 1800);

            var canvas = document.getElementById("emergency_card_back");
            var imgData = canvas.toDataURL("image/png", 1.0);
            document.getElementById("emergency_card_img_back").src = imgData;
            var imgData = canvas.toDataURL("image/jpeg", 1.0);
            var pdf = jsPDF('p', 'mm');
            var width = pdf.internal.pageSize.width;
            var height = pdf.internal.pageSize.height;
            pdf.addImage(imgData, 'JPG', 0, 0, width, height);
            var pdfData = btoa(pdf.output());
            debugger;
            download("data:application/pdf;base64," + pdfData, "PhoneBackground.pdf", "application/pdf");
        };
        img.src = 'https://start.nowprep.com/card/assets/images/ebp.png';
    }

    jQuery(document).ready(function () {
        jQuery("a#downloadfiles").click(function(){
            ecc();
            bp();
        });
    });

</script>
<script type='text/javascript' src='https://start.nowprep.com/wp-includes/js/admin-bar.min.js?ver=4.8.2'></script>


</body>
</html>