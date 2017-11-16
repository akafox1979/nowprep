<?php 
require __DIR__ . "/../classes/stripe-php-5.1.3/init.php";

if ($_POST) {
    \Stripe\Stripe::setApiKey("sk_test_rMIjof8elsiTuXmLzgGiVOos");
    $error = '';
    $success = '';
    try {
        if (!isset($_POST['stripeToken']))
            throw new Exception("The Stripe Token was not generated correctly");
        \Stripe\Charge::create(array("amount" => 1500,
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

