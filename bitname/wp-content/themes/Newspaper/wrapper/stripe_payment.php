<?php

require __DIR__ . "/../classes/stripe-php-5.1.3/lib/Stripe.php";

use Stripe\Stripe;

if ($_POST) {
    Stripe::setApiKey("sk_test_wVseOZwQr6XbuKdTzxWau2Dk");
    $error = '';
    $success = '';
    try {
        if (!isset($_POST['stripeToken']))
            throw new Exception("The Stripe Token was not generated correctly");
        Stripe_Charge::create(array("amount" => intval($_POST['amount']),
            "currency" => "usd",
            "card" => $_POST['stripeToken']));
        $success = 'Your payment was successful.';
    }
    catch (Exception $e) {
        $error = $e->getMessage();
    }
}