<?php
/**
 * Template Name: Emergency Card page template
 */

if(isset($_SERVER['HTTP_CF_VISITOR'])) {
	if(strpos($_SERVER['HTTP_CF_VISITOR'], 'https') === false) {
		wp_redirect('https://nowprep.com/create-pass/');
		exit();
	}
}
?>

<!DOCTYPE html>
<html class="no-js no-svg">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <meta property="og:url" content="//nowprep.com/create-pass/"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="NowPrep! Are You Ready?"/>
    <meta property="og:description" content="Are You Ready?"/>
    <meta property="og:image" content="//nowprep.com/wp-content/uploads/NowPrep_Logo_WordpressRetina-300x99.png"/>
</head>

<body>
<div id="fb-root"></div>
<script>window.twttr = (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
            t = window.twttr || {};
        if (d.getElementById(id)) return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);

        t._e = [];
        t.ready = function (f) {
            t._e.push(f);
        };

        return t;
    }(document, "script", "twitter-wjs"));</script>
<script>
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<div id="page" class="site">
    <header id="masthead" class="site-header" role="banner">

    </header><!-- #masthead -->
    <div class="site-content-contain">
        <div id="content" class="site-content">
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <script type="text/javascript"
                    src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-599aa69458276182"></script>

            <script src="//nowprep.com/wp-includes/js/jquery/jquery.js?v=<?php echo time(); ?>"
                    type="application/javascript"></script>
            <script src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/js/jquery.steps.js?v=<?php echo time(); ?>"
                    type="text/javascript"></script>
            <script
                src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/js/jquery.repeater.js?v=<?php echo time(); ?>"
                type="text/javascript"></script>
            <script
                src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/js/jquery.validate.js?v=<?php echo time(); ?>"
                type="text/javascript"></script>
            <script
                src="<?php echo  str_replace('http://','https://',get_template_directory_uri()); ?>/assets/js/additional-methods.js?v=<?php echo time(); ?>"
                type="text/javascript"></script>
            <script
                src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/js/jquery.maskedinput.js?v=<?php echo time(); ?>"
                type="text/javascript"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
            <link href="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/css/style.css?v=<?php echo time(); ?>"
                  rel="stylesheet"
                  type="text/css"/>
            <link href="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/css/steps.css?v=<?php echo time(); ?>"
                  rel="stylesheet"
                  type="text/css"/>
            <link
                href="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/css/montserrat-webfont.css?v=<?php echo time(); ?>"
                rel="stylesheet"
                type="text/css"/>
            <!--link href="<?php echo get_template_directory_uri(); ?>/assets/css/styles.css" rel="stylesheet" type="text/css"/-->
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

            <style>
                body {
                    font-family: 'Montserrat' !important;
                    background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/hex-000097.png');
                }

                table {
                    width: 100%;
                }

                thead {
                    background: #eee;
                    font-weight: bold;
                }

                tr {
                    vertical-align: top;
                }

                input {
                    height: 2.2em !important;
                }

                select:focus {
                    outline: none !important;
                    border: 1px solid #27AE60 !important;
                    box-shadow: 0 0 10px #27AE60 !important;
                }

                input:focus {
                    outline: none !important;
                    border: 1px solid #27AE60 !important;
                    box-shadow: 0 0 10px #27AE60 !important;
                }

                textarea:focus {
                    outline: none !important;
                    border: 1px solid #27AE60 !important;
                    box-shadow: 0 0 10px #27AE60 !important;
                }

                textarea {
                    width: 100%;
                }

                input[type="button"] {
                    /*height: 45px !important;*/
                }

                .content-left-items {
                    width: 100%;
                    display: inline-block;
                    border-radius: 5px;
                    -webkit-border-radius: 5px;
                    border: 1px solid gray;
                    padding: 5px;
                    margin-bottom: 5px;
                    -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
                    -moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
                    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
                }

                .content-right-items {
                    /*display: inline-block;
                    width: 9%;*/
                }

                .content-create {
                    width: 100%;
                    float: right;
                }

                input.btn {
                    display: inline-block;
                    padding: 4px 12px;
                    margin-bottom: 0;
                    font-size: 14px;
                    font-weight: normal;
                    line-height: 1.42857143;
                    text-align: center;
                    white-space: nowrap;
                    vertical-align: middle;
                    cursor: pointer;
                    -webkit-user-select: none;
                    -moz-user-select: none;
                    -ms-user-select: none;
                    user-select: none;
                    background-image: none;
                    border: 1px solid transparent;
                    border-radius: 4px;
                    -webkit-border-radius: 5px;
                    -moz-border-radius: 5px;
                    border-radius: 5px;
                    background: #27AE60;
                    color: #FFF;
                    width: 100px;
                    background: #27AE60;
                    font-weight: bold;
                    color: white;
                    border: 0 none;
                    -webkit-border-radius: 5px;
                    -moz-border-radius: 5px;
                    border-radius: 5px;
                    cursor: pointer;
                    padding: 10px 5px;
                    height: 100% !important;
                }

                input.btn-danger {
                    color: #fff;
                    background-color: #d9534f;
                    border-color: #d43f3a;
                }

                .btn:hover, .btn:focus, .btn:active, .btn.active, .btn.disabled,
                .btn[disabled] {
                    /*background-color: #B20D00;
                    *background-color: #B20D00;*/
                }

                input.btn-sm {
                    padding: 4px 10px;
                    display: block;
                    text-decoration: none;
                    -webkit-border-radius: 5px;
                    -moz-border-radius: 5px;
                    border-radius: 5px;
                    background: #B20D00;
                    color: #FFF;
                    border-radius: 5px;
                    width: 100px;
                    background: #B20D00;
                    font-weight: bold;
                    color: white;
                    border: 0 none;
                    cursor: pointer;
                    padding: 10px 5px;
                    height: 100% !important;
                }

                input.btn:hover {
                }

                input.btn-info:hover {
                }

                input.btn-info {
                    color: #fff;
                    background-color: #2B2BFF !important;
                    /*border-color: #46b8da;*/
                }

                form.repeater {
                    width: 100%;
                    height: 100%;
                    overflow-y: scroll;
                }

                fieldset {
                    width: 100%;
                    height: 100%;
                    overflow-y: scroll !important;
                    padding: 0.5%;
                    border: none !important;
                    margin: 0px 0px !important;
                }

                .wizard > .content > .body {
                    padding: 2% !important;
                }

                .content-row input, textarea {
                    /*width: 75%;
                    display: inline-block !important;*/
                }

                .content-row input {
                    height: 3.5em !important;
                    padding-top: 11px;
                }

                .content-row textarea {
                    padding-top: 30px;
                }

                .content-row input[type="checkbox"] {
                    display: inline-block !important;
                    width: auto;
                }

                .content-row {
                    position: relative;
                    margin-bottom: 2px;
                }

                .content-row label {
                    /*width: 20%;
                    text-align: right;*/
                    margin-bottom: 0px !important;
                    position: absolute;
                    top: 3px;
                    left: 7px;
                    font-weight: bold;
                    font-size: 0.8em;
                }

                .repeater-checkout-pass label,
                .wizard > .content > .body label {
                    display: none;
                }

                .repeater-checkout-pass label.error,
                .wizard > .content > .body label.error {
                    /*display: inline !important;
                    margin-left: 21% !important;*/
                    margin-bottom: 0px !important;
                    position: absolute;
                    right: 5px;
                    top: 15px;
                    text-align: right;
                    color: #8a1f11;
                }

                input, textarea {
                    margin-bottom: 0px !important;
                }

                .confirmation-page,
                .confirmation-review {
                    display: none;
                    background-color: white;
                    -webkit-border-radius: 40px;
                    -border-radius: 40px;
                    border-radius: 40px;
                    -moz-border-radius: 40px;
                }

                .confirmation-page {
                    text-align: center;
                    padding: 40px
                }

                .confirmation-page input.btn {
                    width: 140px !important;
                }

                .wizard > .content > .body label {
                    /*display: block !important;*/
                }

                select {
                    margin-bottom: 0px !important;
                    height: 4.5em;
                    width: 100%;
                }

                li.disabled {
                    display: none !important;
                }

                /*progressbar*/
                #progressbar {
                    margin: 0px;
                    background: #eee;
                    border-radius: 5px;
                    -webkit-border-radius: 5px;
                    overflow: hidden;
                    /*CSS counters to number the steps*/
                    counter-reset: step;
                    text-align: center;

                }

                #progressbar li {
                    margin: 5px 0px;
                    list-style-type: none;
                    color: black;
                    text-transform: uppercase;
                    font-size: 11px;
                    width: 20%;
                    float: left;
                    position: relative;
                }

                #progressbar li:before {
                    content: counter(step);
                    counter-increment: step;
                    width: 30px;
                    line-height: 30px;
                    display: block;
                    font-size: 14px;
                    color: white;
                    background: black;
                    border-radius: 3px;
                    margin: 0 auto 5px auto;
                    cursor: pointer;
                }

                /*progressbar connectors*/
                #progressbar li:after {
                    content: '';
                    width: 78%;
                    height: 2px;
                    background: #ccc;
                    position: absolute;
                    left: -39%;
                    top: 14px;
                    z-index: 1000;
                }

                #progressbar li:first-child:after {
                    /*connector not needed before the first step*/
                    content: none;
                }

                /*marking active/completed steps green*/
                /*The number of the step and the connector before it = green*/
                #progressbar li.active:before, #progressbar li.active:after {
                    background: #27AE60;
                    color: white;
                }

                .wizard > .content {
                    padding-top: 1em !important;
                }

                ul[role="tablist"] {
                    display: none;
                }

                ul[role="menu"] li a:focus,
                ul[role="menu"] li a:hover {
                    /*box-shadow: 0 0 0 2px transparent, 0 0 0 3px #27AE60;*/
                }

                li.non-active {
                    display: none;
                }

                .action-button {
                    width: 100px;
                    background: #27AE60;
                    font-weight: bold;
                    color: white;
                    border: 0 none;
                    border-radius: 1px;
                    cursor: pointer;
                    padding: 10px 5px;
                    margin: 10px 5px;
                }

                .action-button:hover, .action-button:focus {
                    /*box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;*/
                }

                .first-active {
                    font-size: 2em !important;
                    display: block;
                    width: 100% !important;
                }

                .first-active:before {
                    content: '' !important;
                }

                .repeater-checkout-pass input.error,
                .wizard > .content > .body input.error {
                    background: white;
                    border: 2px solid #8a1f11;
                    color: #8a1f11
                }

                .wizard > .actions a, .wizard > .actions a:hover, .wizard > .actions a:active {
                    background: #27AE60;
                    color: #FFF;
                }

                ul[role="menu"] {
                    width: 100%;
                }

                #ship_pass {
                    padding: 16px 16px !important;
                }
                #resend_now {
                    text-decoration: underline;
                }

                #ship_pass,
                #a-next ,
                #a-next:active,
                #a-next:focus {
                    text-decoration: none;
                    display: inline-block;
                    padding: 8px 16px;
                    background-color: #4CAF50 !important;
                    color: white !important;
                }

                #a-previous {
                    text-decoration: none;
                    display: inline-block;
                    padding: 8px 16px;
                    background-color: #f1f1f1 !important;
                    color: black !important;
                }

                #a-next:hover,
                #a-previous:hover,
                #ship_pass:hover {
                    background-color: #ddd !important;
                    color: black !important;
                }
                @media (hover:none), (hover:on-demand) {
                    #back_item:hover,
                    #front_item:hover {
                        color: #fff !important;
                        background-color: #4CAF50 !important
                    }
                    #a-previous:hover,
                    #a-next:hover {
                        background-color: #4caf50 !important;
                        color: #fff !important;
                    }
                }

                #a-finish,
                #a-cancel {
                }

                #a-next,
                #a-finish {
                    text-align: left;
                }

                #li-next {
                    float: right;
                }

                #li-finish {
                    float: right;
                }

                #a-next:after {
                }

                ul[role="menu"] li {
                    line-height: 2.4em;
                }

                #a-previous:after {
                }

                span.span-next {
                }

                span.span-previous {
                }

                #a-finish {
                }

                span b {
                    text-transform: none;
                    display: block;
                    font-weight: 200;
                    line-height: 1;
                    font-size: 11px;
                    font-family: sans-serif;
                }

                div.group-a-content-repeater-contacts {
                    counter-reset: contacts;
                }

                div.group-a-content-repeater-contacts > div.content-repeater-contacts:before {
                    content: 'Contact #' counter(contacts);
                    counter-increment: contacts;
                    text-align: center;
                    width: 100%;
                    font-size: 2em;
                    display: block;
                    margin: 10px 0px;
                }

                div.group-b-content-repeater-addresses {
                    counter-reset: addresses;
                }

                div.group-b-content-repeater-addresses > div.content-repeater-addresses:before {
                    content: 'Address #' counter(addresses);
                    counter-increment: addresses;
                    text-align: center;
                    width: 100%;
                    font-size: 2em;
                    display: block;
                    margin: 10px 0px;
                }

                form.repeater-plans::before {
                    content: "Your Plans & Notes";
                    text-align: center;
                    width: 100%;
                    font-size: 2em;
                    display: block;
                    margin: 10px 0px;
                }

                .site-content-contain {
                    background-color: transparent !important;
                }

                .site-footer {
                    border: none;
                }

                .span-next-empty {
                    font-size: 26px !important;
                    line-height: 33px;
                }

                .span-next-empty- .span-next {
                    font-size: 1.3em;
                }

                .span-next-empty:after {
                    font-size: 1em !important;
                }

                textarea::-webkit-input-placeholder {
                    font-style: italic !important;
                    color: #999 !important;
                    font-weight: 100 !important;
                    font-size: 14px;
                }


                *::-webkit-input-placeholder {
                    color: black !important;
                    font-weight: normal !important;
                    opacity: 1 !important;
                    font-family: Montserrat;
                    font-size: 15px;
                }
                *:-moz-placeholder {
                    color: black !important;
                    font-weight: normal !important;
                    opacity: 1 !important;
                    font-family: Montserrat;
                    font-size: 15px;
                }
                *::-moz-placeholder {
                    color: black !important;
                    font-weight: normal !important;
                    opacity: 1 !important;
                    font-family: Montserrat;
                    font-size: 15px;
                }
                *:-ms-input-placeholder {
                    color: black !important;
                    font-weight: normal !important;
                    opacity: 1 !important;
                    font-family: Montserrat;
                    font-size: 15px;
                }

                textarea:-moz-placeholder {
                    font-style: italic !important;
                    color: #999 !important;
                    font-weight: 100 !important;
                    font-size: 14px;
                }

                textarea::-moz-placeholder {
                    font-style: italic !important;
                    color: #999 !important;
                    font-weight: 100 !important;
                    font-size: 14px;
                }

                textarea:-ms-input-placeholder {
                    font-style: italic !important;
                    color: #999 !important;
                    font-weight: 100 !important;
                    font-size: 14px;
                }

                .disabled-textarea {
                    display: block !important;
                    margin-bottom: 0px !important;
                    position: absolute;
                    top: 13px !important;
                    left: 7px;
                    font-weight: normal !important;
                    font-family: Montserrat;
                    font-size: 1em !important;

                }

                #download_bottom, #download_top,
                #go_back_bottom, #go_back_top {
                    width: 130px;
                }

                .wrap {
                    padding-left: 0em;
                    padding-right: 0em;
                }

                .wizard > .content {
                    margin: .5em 0;
                }

                .share-buttons {
                    list-style: none;
                    position: relative;
                    display: inline-block;
                    vertical-align: middle;
                    width: 100%;
                    margin: 0;
                    padding: 0;
                }

                ul.share-buttons li {
                    line-height: 1.5em;
                    float: left;
                    margin: 15px 5px;
                    position: relative;
                    display: block;
                    margin: 10px 0;
                    padding: 0;
                }

                .twitter-share-button {
                    margin-bottom: 0px !important;
                    height: 21px !important;
                    margin-top: 1px;
                }

                .addthis_inline_follow_toolbox {
                    margin-top: -26px;
                }

                .actions-hidden {
                    display: none;
                }

                .w3-bar .w3-bar-item {
                    width: 50% !important;
                }
                .delete-button {
                    margin-top: 5px;
                    width: 30px !important;
                    height: 30px !important;
                    background-image: url('/wp-content/themes/Newspaper/assets/images/delete_button.png');
                    background-size: cover !important;
                    background-color: transparent !important;
                    border: none !important;
                    padding: 0px !important;
                    border-radius: 20px;
                    -webkit-border-radius: 20px;
                    -moz-border-radius: 20px
                }
                .add-button {
                    width: 30px !important;
                    height: 30px !important;
                    background-image: url('/wp-content/themes/Newspaper/assets/images/add_button.png');
                    background-size: cover !important;
                    background-color: transparent !important;
                    border: none !important;
                    padding: 0px !important;
                    border-radius: 20px;
                    -webkit-border-radius: 20px;
                    -moz-border-radius: 20px;
                    margin: 0px auto;
                }
                .delete-button:hover {
                    background-image: url('/wp-content/themes/Newspaper/assets/images/delete_button.png') !important;
                    background-size: cover !important;
                    background-color: transparent !important;
                    box-shadow: 0px 0px 9px red !important;
                    -webkit-box-shadow: 0px 0px 9px red !important;
                    -moz-box-shadow: 0px 0px 9px red !important;
                    border-radius: 20px;
                    -webkit-border-radius: 20px;
                    -moz-border-radius: 20px;
                    border: none !important;
                }
                .add-button:hover {
                    background-image: url('/wp-content/themes/Newspaper/assets/images/add_button.png') !important;
                    background-size: cover !important;
                    background-color: transparent !important;
                    box-shadow: 0px 0px 9px green !important;
                    -webkit-box-shadow: 0px 0px 9px green !important;
                    -moz-box-shadow: 0px 0px 9px green !important;
                    border-radius: 20px;
                    -webkit-border-radius: 20px;
                    -moz-border-radius: 20px;
                    border: none !important;
                }
                .wizard > .content {
                    min-height: 25em !important;
                }
                fieldset.cf {
                    padding: 0.5% 25% !important;
                }
                @media (min-width:768px) and (max-width:979px) {
                    #progressbar li:after {
                        content: '';
                        width: 78%;
                        height: 2px;
                        background: #ccc;
                        position: absolute;
                        left: -39%;
                        top: 14px;
                        z-index: 1000;
                    }
                }
                @media (max-width:320px) {
                    #progressbar li:after {
                        content: '';
                        width: 60%;
                        height: 2px;
                        background: #ccc;
                        position: absolute;
                        left: -30%;
                        top: 14px;
                        z-index: 1000;
                    }
                    fieldset.cf {
                        padding: 0.5%!important;
                    }

                }
                @media (max-width:640px) {
                    #progressbar li:after {
                        content: '';
                        width: 60%;
                        height: 2px;
                        background: #ccc;
                        position: absolute;
                        left: -30%;
                        top: 14px;
                        z-index: 1000;
                    }
                    fieldset.cf {
                        padding: 0.5%!important;
                    }
                }

                select {
                    color: black !important;
                    font-weight: normal !important;
                    opacity: 1 !important;
                    font-family: Montserrat;
                    font-size: 15px;
                }

                .payment-success {
                    display: none;
                }

                .payment-errors {
                    display: none;
                    color: #8a1f11;
                }
                
            </style>
            <div class="wrap">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
                        <ul id="progressbar">
                            <li index="0" class="active first-active">YOUR INFO</li>
                            <li index="1" class="non-active">YOUR CONTACTS</li>
                            <li index="2" class="non-active">YOUR ADDRESSES</li>
                            <li index="3" class="non-active">YOUR PLANS & NOTES</li>
                            <li index="4" class="non-active">REVIEW</li>
                        </ul>
                        <div class="multi_form_wizard">
                            <h1>YOUR INFO</h1>
                            <div>
                                <fieldset>
                                    <form class="repeater-personal">
                                        <div class="content-row form__input">
                                            <label for="name">Name *</label>
                                            <input id="name" name="name" type="text" class="required" maxlength="35"
                                                   placeholder="Name" onkeyup="showLabel(jQuery(this))">
                                        </div>
                                        <div class="content-row">
                                            <label for="email">Email *</label>
                                            <input id="email" name="email" type="email" class="required"
                                                   placeholder="Email" onkeyup="showLabel(jQuery(this))">
                                        </div>
                                        <div class="content-row">
                                            <label for="tel">Phone</label>
                                            <input id="tel" name="tel" type="tel" mask="(999) 999-9999"
                                                   placeholder="Phone" onkeyup="showLabel(jQuery(this))">
                                        </div>
                                        <div class="content-row">
                                            <label class="disabled-textarea" style="display: block;" for="info_notes">Notes
                                                & Medical Info</label>
                                            <textarea onkeyup="showLabelTextarea(jQuery(this))" id="info_notes"
                                                      name="info_notes" maxlength="200"
                                                      placeholder='For Example: Allergies, Medications, Doctor(s), Blood Type, Insurance, etc'
                                                      rows="5"></textarea>
                                        </div>
                                    </form>
                                </fieldset>
                            </div>
                            <h1>YOUR CONTACTS</h1>
                            <div>
                                <fieldset>
                                    <form class="repeater-contacts">
                                        <div class="group-a-content-repeater-contacts" data-repeater-list="group-a"
                                             style="display: block;position: relative;">
                                            <div class="content-repeater-contacts" data-repeater-item
                                                 style="position: relative;width: 100%;height: 100%;">
                                                <div class="content-left-items">
                                                    <div class="content-row">
                                                        <label for="name">Name</label>
                                                        <input id="name" name="name" type="text" maxlength="35"
                                                               placeholder="Name" onkeyup="showLabel(jQuery(this))">
                                                    </div>
                                                    <div class="content-row" style="display: inline-block;width: 49%;">
                                                        <label for="relation">Relation?</label>
                                                        <select id="relation" name="relation"
                                                                onchange="checkTypesValue(jQuery(this))">
                                                            <option value="">Relation?</option>
                                                            <option value="Parent">Parent</option>
                                                            <option value="Spouse">Spouse</option>
                                                            <option value="Child">Child</option>
                                                            <option value="Sibling">Sibling</option>
                                                            <option value="Family">Family</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                    <div class="content-row"
                                                         style=" display: inline-block; width: 49.5%;float: right;">
                                                        <label for="in_case">Emergency Contact?</label>
                                                        <select id="in_case" name="in_case" type="text"
                                                                onchange="checkTypesValue(jQuery(this))">
                                                            <option value="">Emergency Contact?</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="content-row">
                                                        <label for="email">Email</label>
                                                        <input id="email" name="email" type="email" placeholder="Email"
                                                               onkeyup="showLabel(jQuery(this))">
                                                    </div>
                                                    <div class="content-row">
                                                        <label for="tel">Phone</label>
                                                        <input id="tel" name="tel" type="text" placeholder="Phone"
                                                               onkeyup="showLabel(jQuery(this))">
                                                    </div>
                                                    <div class="content-row">
                                                        <label class="disabled-textarea" style="display: block;"
                                                               for="info_notes">Notes & Medical Info</label>
                                                        <textarea onkeyup="showLabelTextarea(jQuery(this))"
                                                                  id="info_notes"
                                                                  name="info_notes" maxlength="150"
                                                                  placeholder='For Example: Allergies, Medications, Doctor(s), Blood Type, Insurance, etc'
                                                                  rows="2"></textarea>
                                                    </div>

                                                    <div>
                                                        <input data-repeater-delete type="button" class="delete-button" value="" style="display: inline-block;height: 15px;vertical-align: middle;"/>
                                                        <div style="display: inline-block;height: 15px;vertical-align: middle;">Remove Contact</div>
                                                    </div>
                                                </div>
                                                <div class="content-right-items">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="content-create">
                                            <div style="text-align: center;">
                                                <input data-repeater-create type="button" class="add-button" value="" style="display: inline;"/>
                                                <div style="display: inline-block;height: 20px;vertical-align: middle;">Add Contact</div>
                                            </div>
                                        </div>
                                    </form>
                                </fieldset>
                            </div>
                            <h1>YOUR ADDRESSES</h1>
                            <div>
                                <fieldset>
                                    <form class="repeater-addresses">
                                        <div class="group-b-content-repeater-addresses" data-repeater-list="group-b"
                                             style="display: block;position: relative;">
                                            <div class="content-repeater-addresses" data-repeater-item
                                                 style="position: relative;width: 100%;height: 100%;">
                                                <div class="content-left-items">
                                                    <div class="content-row">
                                                        <label style="display: block;" for="type">Address Description</label>
                                                        <select id="type" name="type"
                                                                onchange="checkTypeValue(jQuery(this))">
                                                            <option value="Home">Home</option>
                                                            <option value="Work">Work</option>
                                                            <option value="School">School</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                    <div class="content-row">
                                                        <label for="type_other">Other Address type</label>
                                                        <input id="type_other" name="type_other" type="text"
                                                               placeholder="Other Address type"
                                                               onkeyup="showLabel(jQuery(this))"
                                                               style="margin-bottom: 0px !important; display:none;"/>
                                                    </div>
                                                    <div class="content-row">
                                                        <label for="address">Address</label>
                                                        <input id="address" name="address"
                                                               placeholder="Address" onkeyup="showLabel(jQuery(this))"
                                                               onFocus="geolocate(jQuery(this))" type="text"
                                                               style="margin-bottom: 0px !important; "/>
                                                    </div>
                                                    <div>
                                                        <input data-repeater-delete type="button" class="delete-button" value="" style="display: inline-block;height: 15px;vertical-align: middle;"/>
                                                        <div style="display: inline-block;height: 15px;vertical-align: middle;">Remove Address</div>
                                                    </div>
                                                </div>
                                                <div class="content-right-items">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="content-create">
                                            <div style="text-align: center;">
                                                <input data-repeater-create type="button" class="add-button" value="" style="display: inline;"/>
                                                <div style="display: inline-block;height: 20px;vertical-align: middle;">Add Address</div>
                                            </div>
                                        </div>
                                    </form>
                                </fieldset>
                            </div>
                            <h1>YOUR PLANS & NOTES</h1>
                            <div>
                                <fieldset>
                                    <form class="repeater-plans">
                                        <div class="content-row">
                                            <label class="disabled-textarea" style="display: block;" for="plans_notes">Plans
                                                & Notes</label>
                                            <textarea onkeyup="showLabelTextarea(jQuery(this))" id="plans_notes"
                                                      name="plans_notes" maxlength="300"
                                                      placeholder="For Example: Meeting Location for Local & Regional Disasters, Important Codes, Pet Information, etc." rows="5"></textarea>
                                        </div>
                                    </form>
                                </fieldset>
                            </div>
                            <h1>REVIEW</h1>
                            <div>
                                <fieldset>
                                    <span id="review_text"
                                          style="margin: 10px;text-align: center;display: block;"></span>
                                    <div class="w3-bar w3-gray">
                                        <button class="w3-bar-item w3-button w3-green" id="front_item"
                                                onclick="openElement('front_item')">Front of Card
                                        </button>
                                        <button class="w3-bar-item w3-button" id="back_item"
                                                onclick="openElement('back_item')">Back of Card
                                        </button>
                                    </div>
                                    <div class="front_item">
                                        <div class="review-tables">
                                            <canvas id="emergency_card_front" width="960" height="534"
                                                    style="border: none;display:none;"></canvas>
                                            <img id="emergency_card_img_front" src=""
                                                 style="width: 100%;height: 100%;margin: 10px 0px;display:none;"/>
                                        </div>
                                    </div>
                                    <div class="back_item" style="display:none">
                                        <div class="review-tables">
                                            <canvas id="emergency_card_back" width="960" height="533"
                                                    style="border: none;display:none;"></canvas>
                                            <img id="emergency_card_img_back" src=""
                                                 style="width: 100%;height: 100%;margin: 10px 0px;display:none;"/>
                                        </div>
                                    </div>
                                    <canvas id="emergency_card" width="960" height="1242"
                                            style="border: none; display:none;"></canvas>
                                    <img id="emergency_card_img" src=""
                                         style="width: 100%;height: 100%;margin: 10px 0px;display:none;"/>
                                </fieldset>
                            </div>
                        </div>
                        <div class="confirmation-review">
                            <h2 style="text-align: center;">Review</h2>
                            <br>
                            <!--span id="review_text"
                                  style="margin: 10px;text-align: center;display: block;"></span-->
                            <div style="text-align: center;margin-bottom: 10px;">
                                <input type="button" class="btn btn-info btn-md" id="preview_top" value="Preview"
                                       style="display: none">
                                <input type="button" class="btn btn-info btn-md" id="go_back_top" value="Go Back">
                                <input type="button" class="btn btn-info btn-md" id="download_top" value="Download!">
                            </div>
                            <div style="text-align: center;padding-bottom: 10px;">
                                <input type="button" class="btn btn-info btn-md" id="preview_bottom" value="Preview"
                                       style="display: none">
                                <input type="button" class="btn btn-info btn-md" id="go_back_bottom" value="Go Back">
                                <input type="button" class="btn btn-info btn-md" id="download_bottom" value="Download!">
                            </div>
                        </div>
                        <div class="wizard">
                            <div class="actions clearfix actions-hidden" style="display:none">
                                <ul role="menu" aria-label="Pagination">
                                    <li id="li-previous" class="" aria-disabled="false">
                                        <a href="#previous" role="menuitem" id="a-previous" class="go_back_bottom"><span
                                                class="span-previous">«&nbsp;Previous</span></a>
                                    </li>
                                    <li id="li-finish" class="" aria-disabled="false">
                                        <a href="#finish" role="menuitem" id="a-next" class="download_bottom"
                                           class="span-finish-empty"><span class="span-finish">Download!<b
                                                    id="b-finish"></b></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="confirmation-page">
                            <h2>Congratulations!</h2>
                            <br>
                            <div class="confirm_text">We've Just Emailed Your FREE Downloadable Emergency Pocket Pass to {email}</div><br>
                            <div class="wizard">Get Your Premium Wallet-Sized Pocket Pass Delivered to You!
                                <div class="context">
                                    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
                                    <script type="text/javascript">
                                        Stripe.setPublishableKey('pk_test_wWG5xLDf1AjUWuy2cRi8jws1');
                                    </script>
                                    <fieldset class="body cf">
										<style>
.repeater-checkout-pass input#rcp_name::-webkit-input-placeholder {color:#999 !important;}
.repeater-checkout-pass  input#rcp_name::-moz-placeholder          {color:#999 !important;}
.repeater-checkout-pass  input#rcp_name:-moz-placeholder           {color:#999 !important;}
.repeater-checkout-pass  input#rcp_name:-ms-input-placeholder      {color:#999 !important;}

.repeater-checkout-pass input#rcp_cc::-webkit-input-placeholder {color:#999 !important;}
.repeater-checkout-pass  input#rcp_cc::-moz-placeholder          {color:#999 !important;}
.repeater-checkout-pass  input#rcp_cc:-moz-placeholder           {color:#999 !important;}
.repeater-checkout-pass  input#rcp_cc:-ms-input-placeholder      {color:#999 !important;}

.repeater-checkout-pass input#rcp_cced::-webkit-input-placeholder {color:#999 !important;}
.repeater-checkout-pass  input#rcp_cced::-moz-placeholder          {color:#999 !important;}
.repeater-checkout-pass  input#rcp_cced:-moz-placeholder           {color:#999 !important;}
.repeater-checkout-pass  input#rcp_cced:-ms-input-placeholder      {color:#999 !important;}

.repeater-checkout-pass input#rcp_cvv::-webkit-input-placeholder {color:#999 !important;}
.repeater-checkout-pass  input#rcp_cvv::-moz-placeholder          {color:#999 !important;}
.repeater-checkout-pass  input#rcp_cvv:-moz-placeholder           {color:#999 !important;}
.repeater-checkout-pass  input#rcp_cvv:-ms-input-placeholder      {color:#999 !important;}

.repeater-checkout-pass input#shipping_address::-webkit-input-placeholder {color:#999 !important;}
.repeater-checkout-pass  input#shipping_address::-moz-placeholder          {color:#999 !important;}
.repeater-checkout-pass  input#shipping_address:-moz-placeholder           {color:#999 !important;}
.repeater-checkout-pass  input#shipping_address:-ms-input-placeholder      {color:#999 !important;}
										</style>
                                        <div class="payment-success"></div>
                                        <div class="payment-errors"></div>
                                        <form class="repeater-checkout-pass">
                                            <div class="content-left-items">
                                                <div class="content-row">
                                                    <label style="display: block;" for="rcp_name">Name</label>
                                                    <input name="rcp_name" type="text" id="rcp_name" placeholder="Credit Card Name"  onkeyup="showLabel(jQuery(this))"/>
                                                </div>
                                                <div class="content-row">
                                                    <label for="rcp_cc">Credit Card Number</label>
                                                    <input maxlength="20" autocomplete="off" id="rcp_cc" name="rcp_cc" type="text" placeholder="Credit Card Number" onkeyup="showLabel(jQuery(this))"/>
                                                </div>
                                                <div class="content-row">
                                                    <label for="rcp_cced">Credit Card Expiration Date</label>
                                                    <input id="rcp_cced" name="rcp_cced" type="text" placeholder="Credit Card Expiration Date" onkeyup="showLabel(jQuery(this))"/>
                                                </div>
                                                <div class="content-row">
                                                    <label for="rcp_cvv">Credit Card CVV</label>
                                                    <input id="rcp_cvv" name="rcp_cvv" type="text" placeholder="Credit Card CVV" onkeyup="showLabel(jQuery(this))"/>
                                                </div>
                                                <div class="content-row">
                                                    <label for="shipping_address">Shipping Address</label>
                                                    <input id="shipping_address" name="shipping_address" placeholder="Shipping Address" onkeyup="showLabel(jQuery(this))" onFocus="geolocate(jQuery(this))" type="text" />
                                                </div>
                                            </div>
                                            <input type="button" class="btn btn-info btn-md" id="ship_pass" value="Ship Pass to Me">
                                        </form>
                                    </fieldset>
                                </div>
                            </div>
                            <br>
                            <div>
                                <div>Help Your Friends & Family Prepare Too!</div>
                                <ul class="share-buttons">
                                    <li style="width: 100%;">
                                        <a href="https://www.facebook.com/sharer.php?u=https://nowprep.com/create-pass/">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/share-on-facebook.png">
                                        </a>
                                    </li>
                                    <li style="width: 100%;">
                                        <a href="https://twitter.com/share?url=https://nowprep.com/create-pass/&text=Create%20Your%20Free%20Emergency%20Prep%20Pass!%0AGet%20Started%20Here%20-%3E%20&hashtags=family,emergency,survival">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/share-on-twitter.png">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <br>
                            <div>Didn't Receive Our Email? Please Allow Up to 5 Minutes for Delivery. <a id="resend_now" style="cursor: pointer;" >Resend Email Now</a></div><br>
                        </div>
                    </main><!-- #main -->
                </div><!-- #primary -->
            </div><!-- .wrap -->
            <script>
                var current_fs, next_fs, previous_fs;
                var left, opacity, scale;
                var animating;

                var infos = ['Your Info', 'Your Contacts', 'Your Addresses', 'Your Plans & Notes'];

                var placeSearch;
                var json = "";
                var wizard;
                var data = {};
                var googleAddressData = [];
                var toEmail = "";
                var toName = "";

                function openElement(elementID) {
                    jQuery(".w3-bar-item").each(function () {
                        jQuery(this).removeClass("w3-green");
                        jQuery("." + jQuery(this).attr("id")).hide();
                    });
                    jQuery("#" + elementID).addClass("w3-green");
                    jQuery("." + elementID).show();

                }

                function showLabel(data_field) {
                    if (jQuery(data_field).val() != "")
                        jQuery(data_field).prev().attr('style', 'display: block !important;');
                    else jQuery(data_field).prev().attr('style', '')
                }
                function showLabelTextarea(data_field) {
                    if (jQuery(data_field).val() != "") {
                        jQuery(data_field).prev().removeClass('disabled-textarea');
                        jQuery(data_field).prev().attr('style', 'display: block !important;');
                    }
                    else {
                        jQuery(data_field).prev().attr('style', '');
                        jQuery(data_field).prev().addClass('disabled-textarea');
                    }
                }

                function checkTypeValue(data_field) {
                    showLabel(data_field);
                    if (jQuery(data_field).val() == "Other") {
                        jQuery(data_field).parent().next().children().next().show();
                        jQuery(data_field).parent().next().children().next().focus();
                    } else {
                        jQuery(data_field).parent().next().children().next().hide();
                        jQuery(data_field).focus();
                    }
                }

                function checkTypesValue(data_field) {
                    if (jQuery(data_field).val() != "") {
                        showLabel(data_field);
                    } else {
                        showLabel(data_field);
                    }
                }

                function initAutocomplete(data_field) {

                    var input_name = jQuery(data_field).attr('name');
                    var input_element = document.getElementsByName(input_name);
                    var autocomplete = new google.maps.places.Autocomplete(
                        (input_element[0]),
                        {types: ['geocode']});

                    autocomplete.addListener('place_changed', function () {
                        googleAddressData.push({name: input_name, value: autocomplete.getPlace().address_components});
                    });
                    return autocomplete;
                }
                function geolocate(data_field) {
                    var autocomplete = initAutocomplete(data_field);
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function (position) {
                            var geolocation = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };
                            var circle = new google.maps.Circle({
                                center: geolocation,
                                radius: position.coords.accuracy
                            });
                            autocomplete.setBounds(circle.getBounds());
                        });
                    }
                }
                jQuery(document).ready(function () {

                    jQuery("#rcp_cced").mask("99/99",{ "placeholder": "" });

                    wizard = jQuery(".multi_form_wizard").steps({
                        onFinishing: function (event, currentIndex) {
                            var returnValue = true;
                            if (currentIndex == 0) {
                                returnValue = jQuery("form.repeater-personal").valid();
                            } else if (currentIndex == 1) {
                                returnValue = jQuery("form.repeater-contacts").valid();
                            } else if (currentIndex == 2) {
                                returnValue = jQuery("form.repeater-addresses").valid();
                            } else if (currentIndex == 3) {
                                returnValue = jQuery("form.repeater-plans").valid();
                            } else if (currentIndex == 4) {
                                returnValue = true;
                            }
                            if (returnValue) {
                                data['personal'] = jQuery("form.repeater-personal").serializeArray();
                                data['contacts'] = jQuery("form.repeater-contacts").serializeArray();
                                data['addresses'] = jQuery("form.repeater-addresses").serializeArray();
                                data['plans'] = jQuery("form.repeater-plans").serializeArray();
                                data['google_address'] = googleAddressData;
                                json = JSON.stringify(data);
                            }
                            return returnValue;
                        },
                        onStepChanging: function (event, currentIndex, newIndex) {
                            var returnValue = true;
                            if (currentIndex == 0) {
                                returnValue = jQuery("form.repeater-personal").valid();
                            } else if (currentIndex == 1) {
                                returnValue = jQuery("form.repeater-contacts").valid();
                            } else if (currentIndex == 2) {
                                returnValue = jQuery("form.repeater-addresses").valid();
                            } else if (currentIndex == 3) {
                                returnValue = jQuery("form.repeater-plans").valid();
                            } else if (currentIndex == 3 && newIndex == 4) {
                                data['personal'] = jQuery("form.repeater-personal").serializeArray();
                                data['contacts'] = jQuery("form.repeater-contacts").serializeArray();
                                data['addresses'] = jQuery("form.repeater-addresses").serializeArray();
                                data['plans'] = jQuery("form.repeater-plans").serializeArray();
                                data['google_address'] = googleAddressData;
                                json = JSON.stringify(data);
                                jQuery(".actions").hide();
                                jQuery(".actions-hidden").show();
                                jQuery("#preview_top").click();
                            }
                            if (returnValue) {
                                if (newIndex < currentIndex) {
                                    if (newIndex == 0) {
                                        jQuery('li[index="0"]').addClass('active');
                                        jQuery('li[index="' + currentIndex + '"]').removeClass('active');
                                    } else {
                                        jQuery('li[index="' + currentIndex + '"]').removeClass('active');
                                    }
                                }
                                if (newIndex > currentIndex) {
                                    if (newIndex == 1) {
                                        jQuery('li[index="0"]').removeClass('first-active');
                                        jQuery('li[index="1"]').removeClass('active');
                                        jQuery('li[index="2"]').removeClass('active');
                                        jQuery('li[index="3"]').removeClass('active');
                                        jQuery('li[index="4"]').removeClass('active');
                                        jQuery('li[index="1"]').removeClass('non-active');
                                        jQuery('li[index="2"]').removeClass('non-active');
                                        jQuery('li[index="3"]').removeClass('non-active');
                                        jQuery('li[index="4"]').removeClass('non-active');
                                    }
                                    jQuery('li[index="' + newIndex + '"]').addClass('active');
                                }
                                jQuery(".actions").show();
                                jQuery(".actions-hidden").hide();

                                if (currentIndex == 3 && newIndex == 4) {
                                    data['personal'] = jQuery("form.repeater-personal").serializeArray();
                                    data['contacts'] = jQuery("form.repeater-contacts").serializeArray();
                                    data['addresses'] = jQuery("form.repeater-addresses").serializeArray();
                                    data['plans'] = jQuery("form.repeater-plans").serializeArray();
                                    data['google_address'] = googleAddressData;
                                    json = JSON.stringify(data);
                                    jQuery(".actions").hide();
                                    jQuery(".actions-hidden").show();
                                    jQuery("#preview_top").click();
                                }
                            }
                            return returnValue;
                        },
                        onStepChanged: function(event, currentIndex, priorIndex) {
                            if(currentIndex == 0) {
                                jQuery(".wizard > .content").attr("style","min-height: " + (jQuery("form.repeater-personal").height()+100) + "px !important;");
                            } else if(currentIndex == 1) {
                                jQuery(".wizard > .content").attr("style","min-height: " + (jQuery("form.repeater-contacts").height()+100) + "px !important;");
                            } else if(currentIndex == 2) {
                                jQuery(".wizard > .content").attr("style","min-height: " + (jQuery("form.repeater-addresses").height()+100) + "px !important;");
                            } else if(currentIndex == 3) {
                                jQuery(".wizard > .content").attr("style","min-height: " + (jQuery("form.repeater-plans").height()+100) + "px !important;");
                            } else if(currentIndex == 4) {

                            }
                        },
                    });
                    jQuery('.repeater-contacts').repeater({
                        initEmpty: true,
                        isFirstItemUndeletable: true,
                        show: function () {
                            jQuery(this).slideDown(400, function(){
                                jQuery(".wizard > .content").attr("style","min-height: " + (jQuery(this).parent().height()+100) + "px !important;");
                            });
                        },
                        hide: function (deleteElement) {
                            if (confirm('Are you sure you want to delete this element?')) {
                                jQuery(this).slideUp(deleteElement, function(){
                                    jQuery(".wizard > .content").attr("style","min-height: " + (jQuery(this).parent().height()+100) + "px !important;");
                                });;
                            }
                        },
                        ready: function (setIndexes) {
                        }
                    });
                    jQuery('.repeater-addresses').repeater({
                        initEmpty: true,
                        isFirstItemUndeletable: true,
                        show: function () {
                            jQuery(this).slideDown(400, function(){
                                jQuery(".wizard > .content").attr("style","min-height: " + (jQuery(this).parent().height()+100) + "px !important;");
                                var iCount = jQuery("select#type").length;
                                if(iCount == 1) {
                                    jQuery("select[name='group-b[0][type]']").val("Home");
                                } else if(iCount == 2) {
                                    jQuery("select[name='group-b[1][type]']").val("Work");
                                } else if(iCount == 3) {
                                    jQuery("select[name='group-b[2][type]']").val("School");
                                } else if(iCount == 4) {
                                    jQuery("select[name='group-b[3][type]']").val("Other");
                                    jQuery("input[name='group-b[3][type_other]']").show();
                                }
                            });
                        },
                        hide: function (deleteElement) {
                            if (confirm('Are you sure you want to delete this element?')) {
                                jQuery(this).slideUp(deleteElement,function(){
                                    jQuery(".wizard > .content").attr("style","min-height: " + (jQuery(this).parent().height()+100) + "px !important;");
                                });
                            }
                        },
                        ready: function (setIndexes) {
                        }
                    });

                    jQuery("form.repeater-personal").validate({
                        rules: {
                            name: "required",
                            email: {
                                required: true,
                                email: true
                            },
                            tel: {
                                phoneUS: true
                            }
                        },
                        messages: {
                            name: "Please enter your name",
                            email: "Please enter a valid email address",
                            tel: "Please enter a valid phone number",
                            info_notes: "Please enter Medical Info/Notes"
                        }
                    });
                    jQuery("form.repeater-contacts").validate({
                        rules: {
                            "group-a[0][email]": {
                                email: true
                            },
                            "group-a[1][email]": {
                                email: true
                            },
                            "group-a[2][email]": {
                                email: true
                            },
                            "group-a[3][email]": {
                                email: true
                            },
                            "group-a[0][tel]": {
                                phoneUS: true
                            },
                            "group-a[1][tel]": {
                                phoneUS: true
                            },
                            "group-a[2][tel]": {
                                phoneUS: true
                            },
                            "group-a[3][tel]": {
                                phoneUS: true
                            }
                        },
                        messages: {
                            email: "Please enter a valid email address",
                            tel: "Please enter a valid phone number",
                        }
                    });
                    jQuery("form.repeater-checkout-pass").validate({
                        rules: {
                            rcp_name: "required",
                            rcp_cc: {
                                required: true,
                                creditcard: true
                            },
                            rcp_cced: {
                                required: true,
                                maxlength: 5
                            },
                            rcp_cvv: {
                                required: true,
                                digits:true,
                                maxlength: 3
                            },
                            shipping_address: "required"
                        },
                        messages: {
                            rcp_name: "Please enter Credit Card Name",
                            rcp_cc: "Please enter Credit Card Number",
                            rcp_cced: "Please enter Credit Card Expiration Date",
                            rcp_cvv: "Please enter Credit Card CVV",
                            shipping_address: "Please enter Shipping Address"
                        }
                    });
                    jQuery("#ship_pass").click(function(){
                        if(jQuery("form.repeater-checkout-pass").validate()) {
                            var exp_date = jQuery('#rcp_cced').val().split('/');
                            Stripe.card.createToken({
                                number: jQuery('#rcp_cc').val(),
                                cvc: jQuery('#rcp_cvv').val(),
                                exp_month: parseInt(exp_date[0]),
                                exp_year: (2000+parseInt(exp_date[1]))
                            }, 1*100, stripeResponseHandler);
                            jQuery(this).attr("disabled", "disabled");
                            return false;
                        }
                    });
                    function stripeResponseHandler(status, response) {
                        if (response.error) {
                            jQuery("#ship_pass").removeAttr("disabled");
                            jQuery(".payment-errors").show();
                            jQuery(".payment-errors").html(response.error.message);
                        } else {
                            var token = response.id;
                            jQuery("form.repeater-checkout-pass").append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                            jQuery(".payment-errors").hide();
                            jQuery.ajax({
                                type: "POST",
                                url: "<?php echo get_template_directory_uri()?>/wrapper/stripe_payment.php",
                                data: jQuery("form.repeater-checkout-pass").serializeArray()
                            }).done(function (response) {
                                debugger;
                                var responseJson = jQuery.parseJSON(response);
                                if( responseJson.result == 0 ) {
                                    jQuery(".payment-errors").show();
                                    jQuery(".payment-errors").html(responseJson.text);
                                }
                                if(responseJson.result == 1 ) {
                                    jQuery("form.repeater-checkout-pass").hide();
                                    jQuery(".payment-errors").hide();
                                    jQuery(".payment-success").show();
                                    jQuery(".payment-success").html(responseJson.text);
                                }

                                jQuery("#ship_pass").removeAttr("disabled");
                            });
                        }
                    }
                    jQuery("form.repeater-addresses").validate({
                        submitHandler: function (form) {
                            return false;
                        }
                    });
                    jQuery("#preview_top,#preview_bottom").click(function () {
                        var cf = document.getElementById("emergency_card_front");
                        var ctxf = cf.getContext("2d");
                        var imgF = new Image();

                        var cb = document.getElementById("emergency_card_back");
                        var ctxb = cb.getContext("2d");
                        var imgB = new Image();

                        var c = document.getElementById("emergency_card");
                        var ctx = c.getContext("2d");
                        var img = new Image();

                        imgF.onload = function () {
                            ctxf.drawImage(imgF, 0, 0);
                            imgB.onload = function () {
                                ctxb.drawImage(imgB, 0, 0);
                                img.onload = function () {
                                    ctx.drawImage(img, 0, 0);
                                    jQuery.each(data, function (index, valueData) {
                                        if (index == 'personal') {
                                            var iCount = 1;
                                            jQuery.each(valueData, function (index, value) {
                                                ctx.font = "30px Arial";
                                                ctx.fillStyle = 'white';
                                                ctxf.font = "25px Arial";

                                                if (value.name == 'name') {
                                                    toName = value.value;
                                                    jQuery("#rcp_name").val(value.value);
                                                    showLabel(jQuery("#rcp_name"));
                                                    ctx.textAlign="center";
                                                    ctx.fillText("Congratulations " + value.value + "!", 480, 45);
                                                    ctxf.fillText(value.value, 85, 190);
                                                }
                                                if (value.name == 'email') {
                                                    toEmail = value.value;
                                                    if (value.value.length > 0) {
                                                        jQuery('.confirm_text').html("We've Just Emailed Your FREE Downloadable Emergency Pocket Pass to " + value.value + ".");
                                                        jQuery('#review_text').html("Please Review the Front and Back of Your NowPrep Emergency Prep Pass Below.<br>Go Back to Any of the Sections to Edit Your Information.<br>Once Ready, Proceed to 'Download' to Have Pass Emailed to: " + value.value + ".<br>");
                                                    }
                                                    else {
                                                        jQuery('#review_text').html("Please Review the Front and Back of Your NowPrep Emergency Prep Pass Below.<br>Go Back to Any of the Sections to Edit Your Information.<br>Once Ready, Proceed to 'Download' to Have Pass Emailed to: (empty).<br>");
                                                    }
                                                }
                                                if (value.name == 'tel') {
                                                    ctxf.fillText(value.value.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 85, 265);
                                                }
                                                if (value.name == 'info_notes') {
                                                    var linesF = split_lines(ctxf, 400, "25px Arial", value.value);
                                                    for (var j = 0; j < linesF.length; ++j) {
                                                        ctxf.fillText(linesF[j], 85, 345 + 25 * j);
                                                    }
                                                }
                                                iCount++;
                                            });
                                        } else if (index == 'contacts') {
                                            var iCount = 0;
                                            jQuery.each(valueData, function (index, value) {
                                                if (index > (5 + iCount * 6)) {
                                                    iCount++;
                                                }
                                                ctx.font = "18px Arial";
                                                ctxb.font = "18px Arial";
                                                if (value.name == ('group-a[' + iCount + '][name]')) {
                                                    var linesB = split_lines(ctx, 175, "18px Arial", value.value);
                                                    for (var j = 0; j < linesB.length; ++j) {
                                                        ctxb.fillText(linesB[j], 80 + (220) * iCount, 735 - 590 + 18 * j);
                                                    }
                                                }
                                                if (value.name == ('group-a[' + iCount + '][relation]')) {
                                                    ctxb.fillText(value.value, 80 + (220) * iCount, 785 - 590);
                                                }
                                                if (value.name == ('group-a[' + iCount + '][tel]')) {
                                                    ctxb.fillText(value.value.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 80 + (220) * iCount, 835 - 590);
                                                }
                                                if (value.name == ('group-a[' + iCount + '][info_notes]')) {
                                                    var linesB = split_lines(ctx, 155, "13px Arial", value.value);
                                                    for (var j = 0; j < linesB.length; ++j) {
                                                        ctxb.fillText(linesB[j], 80 + (220) * iCount, 880 - 590 + 13 * j);
                                                    }
                                                }

                                                if (value.name == ('group-a[' + iCount + '][in_case]')) {
                                                    if (value.value == "Yes") {
                                                        var imageObject = new Image();
                                                        imageObject.src = 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAASABIAAD/4QBYRXhpZgAATU0AKgAAAAgAAwEGAAMAAAABAAIAAAESAAMAAAABAAEAAIdpAAQAAAABAAAAMgAAAAAAAqACAAQAAAABAAAAnaADAAQAAAABAAAADwAAAAD/4QkhaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJYTVAgQ29yZSA1LjQuMCI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiLz4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8P3hwYWNrZXQgZW5kPSJ3Ij8+AP/tADhQaG90b3Nob3AgMy4wADhCSU0EBAAAAAAAADhCSU0EJQAAAAAAENQdjNmPALIE6YAJmOz4Qn7/4gzoSUNDX1BST0ZJTEUAAQEAAAzYYXBwbAIQAABtbnRyUkdCIFhZWiAH4QAHABIACwALAB9hY3NwQVBQTAAAAABBUFBMAAAAAAAAAAAAAAAAAAAAAAAA9tYAAQAAAADTLWFwcGwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABFkZXNjAAABUAAAAGJkc2NtAAABtAAAAb5jcHJ0AAADdAAAACN3dHB0AAAD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';
                                                        ctxb.drawImage(imageObject, 65 + (220) * iCount, 685-590);
                                                    }
                                                }
                                            });
                                        } else if (index == 'addresses') {
                                            var iCount = 0;
                                            jQuery.each(valueData, function (index, value) {
                                                if (index > (2 + iCount * 3)) {
                                                    iCount++;
                                                }
                                                ctx.font = "18px Arial";
                                                ctxf.font = "18px Arial";
                                                if (iCount == 0) {
                                                    if (value.name == ('group-b[' + iCount + '][type]')) {
                                                        if (value.value == "Other") {
                                                            ctxf.fillText(jQuery("input[name='" + 'group-b[' + iCount + '][type_other]' + "']").val(), 512, 190);
                                                        } else {
                                                            ctxf.fillText(value.value, 512, 190);
                                                        }
                                                    }
                                                    if (value.name == ('group-b[' + iCount + '][address]')) {
                                                        jQuery("#shipping_address").val(value.value);
                                                        showLabel(jQuery("#shipping_address"));
                                                        var linesF = split_lines(ctxf, 180, "18px Arial", value.value.replace(", United States",""));
                                                        for (var j = 0; j < linesF.length; ++j) {
                                                            ctxf.fillText(linesF[j], 512, 255 + 18 * j);
                                                        }
                                                    }
                                                }
                                                if (iCount == 1) {
                                                    if (value.name == ('group-b[' + iCount + '][type]')) {
                                                        if (value.value == "Other") {
                                                            ctxf.fillText(jQuery("input[name='" + 'group-b[' + iCount + '][type_other]' + "']").val(), 730, 190);
                                                        } else {
                                                            ctxf.fillText(value.value, 730, 190);
                                                        }
                                                    }
                                                    if (value.name == ('group-b[' + iCount + '][address]')) {
                                                        var linesF = split_lines(ctxf, 180, "18px Arial", value.value.replace(", United States",""));
                                                        for (var j = 0; j < linesF.length; ++j) {
                                                            ctxf.fillText(linesF[j], 730, 255 + 18 * j);
                                                        }
                                                    }
                                                }
                                                if (iCount == 2) {
                                                    if (value.name == ('group-b[' + iCount + '][type]')) {
                                                        if (value.value == "Other") {
                                                            ctxf.fillText(jQuery("input[name='" + 'group-b[' + iCount + '][type_other]' + "']").val(), 510, 375);
                                                        } else {
                                                            ctxf.fillText(value.value, 510, 375);
                                                        }
                                                    }
                                                    if (value.name == ('group-b[' + iCount + '][address]')) {
                                                        var linesF = split_lines(ctxf, 180, "18px Arial", value.value.replace(", United States",""));
                                                        for (var j = 0; j < linesF.length; ++j) {
                                                            ctxf.fillText(linesF[j], 510, 440 + 18 * j);
                                                        }
                                                    }
                                                }
                                                if (iCount == 3) {
                                                    if (value.name == ('group-b[' + iCount + '][type]')) {
                                                        if (value.value == "Other") {
                                                            ctxf.fillText(jQuery("input[name='" + 'group-b[' + iCount + '][type_other]' + "']").val(), 730, 375);
                                                        } else {
                                                            ctxf.fillText(value.value, 730, 375);
                                                        }
                                                    }
                                                    if (value.name == ('group-b[' + iCount + '][address]')) {
                                                        var linesF = split_lines(ctxf, 180, "18px Arial", value.value.replace(", United States",""));
                                                        for (var j = 0; j < linesF.length; ++j) {
                                                            ctxf.fillText(linesF[j], 730, 440 + 18 * j);
                                                        }
                                                    }
                                                }
                                            });
                                        } else if (index == 'plans') {
                                            var strTable = "<tr>";
                                            jQuery.each(valueData, function (index, value) {
                                                var linesB = split_lines(ctxb, 850, "18px Arial", value.value);
                                                for (var j = 0; j < linesB.length; ++j) {
                                                    ctxb.fillText(linesB[j], 60, 430 + 19 * j);
                                                }
                                            });
                                        }
                                        var canvas = document.getElementById("emergency_card");
                                        var imgData = canvas.toDataURL("image/png", 1.0);

                                        document.getElementById("emergency_card_img").src = imgData;

                                        var canvasF = document.getElementById("emergency_card_front");
                                        var imgDataF = canvasF.toDataURL("image/png", 1.0);

                                        document.getElementById("emergency_card_img_front").src = imgDataF;

                                        var canvasB = document.getElementById("emergency_card_back");
                                        var imgDataB = canvasB.toDataURL("image/png", 1.0);

                                        document.getElementById("emergency_card_img_back").src = imgDataB;
                                        jQuery('#emergency_card_front').hide();
                                        jQuery('#emergency_card_back').hide();
                                        jQuery('#emergency_card_img_front').show();
                                        jQuery('#emergency_card_img_back').show();
                                        var imgTF = new Image;
                                        imgTF.onload = function(){
                                            ctx.drawImage(imgTF, 60, 699, 410, 230);
                                            ctx.drawImage(imgTF, 60, 939, 410, 230);
                                            jQuery(".wizard > .content").attr("style","min-height: " + (jQuery("#emergency_card_img_front").height()+230) + "px !important;");
                                        };
                                        imgTF.src = imgDataF;
                                        var imgTB = new Image;
                                        imgTB.onload = function(){
                                            ctx.drawImage(imgTB, 485, 699, 410, 230);
                                            ctx.drawImage(imgTB, 485, 939, 410, 230);
                                        };
                                        imgTB.src = imgDataB;

                                    });
                                };
                                img.src = '<?php echo get_template_directory_uri(); ?>/assets/images/emc_960.png';

                            }
                            imgB.src = "<?php echo get_template_directory_uri(); ?>/assets/images/em_960_b.png";
                        }
                        imgF.src = "<?php echo get_template_directory_uri(); ?>/assets/images/em_960_f.png";

                    });
                    jQuery("#go_back_top,.go_back_bottom").click(function () {
                        jQuery(".wizard > .actions").show();
                        jQuery(".wizard > .actions-hidden").hide();
                        jQuery("#steps-uid-0-t-3").click();
                    });
                    jQuery("#download_top,.download_bottom,#resend_now").click(function () {

                        var canvas = document.getElementById("emergency_card");
                        var imgData = canvas.toDataURL("image/jpeg", 1.0);
                        var pdf = new jsPDF('p', 'mm');
                        var width = pdf.internal.pageSize.width;
                        var height = pdf.internal.pageSize.height;
                        pdf.addImage(imgData, 'JPG', 0, 0, width, height);
                        var pdfData = btoa(pdf.output());
                        jQuery.ajax({
                            type: "POST",
                            url: "https://mandrillapp.com/api/1.0/messages/send.json",
                            data: {
                                'key': 'o2DFojQBRFj71A665qf6Fg',

                                'message': {
                                    'from_email': 'info@nowprep.com',
									"from_name": "The NowPrep Team",
                                    'to': [{
                                        'email': toEmail,
                                        'name': toName,
                                        'type': 'to'
                                    }],
                                    'autotext': 'true',
                                    'subject': 'Your NowPrep Emergency Pocket Pass',
                                    'html': 'Congratulations ' + toName + "!<br><br>You're almost finished creating your custom <b>NowPrep Emergency Pocket Pass</b> and being <b>more disaster-ready</b> than over 60% of Americans.<br><br>Stay Prepared,<br>The NowPrep Team<br><br><br>",
                                    "attachments": [
                                        {
                                            "type": "application/pdf",
                                            "name": "EmergencyPocketPass.pdf",
                                            "content": pdfData
                                        }
                                    ],
                                }
                            }
                        }).done(function (response) {
                            if ((response[0].status == "sent") || (response[0].status == "queued")) {
                                jQuery(".multi_form_wizard").hide();
                                jQuery("#progressbar").hide();
                                jQuery(".wizard > .actions-hidden").hide();
                                jQuery(".confirmation-page").show();
                            } else if (response[0].status == "error") {
                                alert(response[0].message);
                            } else if (response[0].status == "rejected") {
                                alert(response[0].reject_reason);
                            }

                        });

                        jQuery.ajax({
                            type: "POST",
                            url: "<?php echo get_template_directory_uri(); ?>/wrapper/mailchimp.php",
                            data: data
                        }).done(function (response) {
                        });
                    });

                });
                var split_lines = function (ctx, mw, font, text) {
                    mw = mw - 10;
                    ctx.font = font;
                    var words = text.split(' ');
                    var new_line = words[0];
                    var lines = [];
                    for (var i = 1; i < words.length; ++i) {
                        if (ctx.measureText(new_line + " " + words[i]).width < mw) {
                            new_line += " " + words[i];
                        } else {
                            lines.push(new_line);
                            new_line = words[i];
                        }
                    }
                    lines.push(new_line);
                    return lines;
                }
                jQuery('input[type="tel"]').each(function () {
                });
                jQuery("#progressbar li").each(function () {
                    jQuery(this).click(function () {
                        jQuery("#steps-uid-0-t-" + jQuery(this).attr("index")).click();
                    });
                });
            </script>
            <script
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNhcLWPyYGoSKdD1xHpkenk3GeiGtBgw8&libraries=places"
                async defer></script>
        </div><!-- #content -->
        <footer id="colophon" class="site-footer" role="contentinfo">
            <div class="wrap">
            </div><!-- .wrap -->
        </footer><!-- #colophon -->
    </div><!-- .site-content-contain -->
</div><!-- #page -->
</body>
</html>