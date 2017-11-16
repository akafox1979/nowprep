<?php
/**
 * Template Name: New Emergency Card page template
 */

if(isset($_SERVER['HTTP_CF_VISITOR'])) {
    if(strpos($_SERVER['HTTP_CF_VISITOR'], 'https') === false) {
        wp_redirect('https://nowprep.com/create-pass-new/');
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
                .content-row-left {
                    display: inline-block;
                    width: 49.3% !important;
                    position: relative;
                }
                .content-row-right {
                    display: inline-block;
                    width: 49.3% !important;
                    position: relative;
                    float: right;
                }
                .content-row-float {
                    display: inline-block;
                    position: relative;
                }

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
                    background: white;
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
                    margin: 3px;
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
                    display: none;
                }

                .repeater-checkout-pass label,
                .wizard > .content > .body label {
                    display: none;
                }

                .content-row label.error,
                .content-row-left label.error,
                .content-row-right label.error,
                .wizard > .content > .body label.error {
                    /*display: inline !important;
                    margin-left: 21% !important;*/
                    margin-bottom: 0px !important;
                    position: absolute;
                    right: 5px;
                    top: 15px;
                    text-align: right;
                    color: red;
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
                    content: attr(title);
                    counter-increment: contacts;
                    text-align: center;
                    width: 100%;
                    font-size: 2em;
                    display: block;
                    /* margin: 10px 0px; */
                    color: white;
                    background: red;
                    border-top-left-radius: 0.6em;
                    border-top-right-radius: 0.6em;
                }

                div.content-repeater-contacts-new:before {
                    content: attr(title);
                    text-align: center;
                    width: 100%;
                    font-size: 2em;
                    display: block;
                    color: white;
                    background: red;
                    border-top-left-radius: 0.6em;
                    border-top-right-radius: 0.6em;
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
                    color: #999 !important;
                    font-weight: normal !important;
                    opacity: 1 !important;
                    font-family: Montserrat;
                    font-size: 15px;
                }
                *:-moz-placeholder {
                    color: #999 !important;
                    font-weight: normal !important;
                    opacity: 1 !important;
                    font-family: Montserrat;
                    font-size: 15px;
                }
                *::-moz-placeholder {
                    color: #999 !important;
                    font-weight: normal !important;
                    opacity: 1 !important;
                    font-family: Montserrat;
                    font-size: 15px;
                }
                *:-ms-input-placeholder {
                    color: #999 !important;
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
                    background-image: url('/wp-content/themes/Newspaper/assets/images/delete_button.png') !important;
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
                    background-image: url('/wp-content/themes/Newspaper/assets/images/add_contact.png') !important;
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
                    background-image: url('/wp-content/themes/Newspaper/assets/images/add_contact.png') !important;
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
                    color: red;
                }

                input {
                    background: #eeeeee !important;
                }

                .footer-content {
                    position: fixed;
                    height: 120px;
                    background-color: white;
                    bottom: 0px;
                    left: 0px;
                    right: 0px;
                    margin-bottom: 0px;
                    text-align: center;
                }
                div.wrap {
                    margin-bottom: 120px;
                }
            </style>
            <div class="wrap">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
                        <div class="multi_form_wizard">
                            <div>
                                <fieldset>
                                    <form class="repeater-contacts">
                                        <div class="group-a-content-repeater-contacts" data-repeater-list="group-a"
                                             style="display: block;position: relative;">
                                            <div class="content-repeater-contacts" title="Emergency Contact #1" data-repeater-item
                                                 style="position: relative;width: 100%;height: 100%;">
                                                <div class="content-left-items">
                                                    <div class="content-row" style="font-size: 1.2em;font-weight: bold;color: red; text-align: center;font-style: italic;">In Case of Emergency, Please Contact...</div>
                                                    <div class="content-row">
                                                        <label for="name">Contact's Name*</label>
                                                        <input name="name" type="text" maxlength="35" placeholder="Contact's Name*" onkeyup="showLabel(jQuery(this))">
                                                    </div>
                                                    <div class="content-row">
                                                        <div class="content-row-left">
                                                            <label for="tel_primary">Primary Phone</label>
                                                            <input name="tel_primary" type="text" placeholder="Primary Phone" onkeyup="showLabel(jQuery(this))">
                                                        </div>
                                                        <div class="content-row-right">
                                                            <label for="tel_secondary">Secondary Phone</label>
                                                            <input name="tel_secondary" type="text" placeholder="Secondary Phone" onkeyup="showLabel(jQuery(this))">
                                                        </div>
                                                    </div>
                                                    <div class="content-row">
                                                        <label for="home_address">Home Address</label>
                                                        <input name="home_address" placeholder="Home Address" onkeyup="showLabel(jQuery(this))" onFocus="geolocate(jQuery(this))" type="text" style="margin-bottom: 0px !important; "/>
                                                    </div>
                                                    <div class="content-row">
                                                        <label for="work_address">Work Address</label>
                                                        <input name="work_address" placeholder="Work Address" onkeyup="showLabel(jQuery(this))" onFocus="geolocate(jQuery(this))" type="text" style="margin-bottom: 0px !important; "/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="group-a-content-repeater-contacts">
                                            <div class="content-repeater-contacts-new" title="Emergency Contact #2 (Optional)">
                                                <div class="content-left-items" style="text-align: center;">
                                                    <input data-repeater-create type="button" class="add-button" value="" style="display: inline;"/>
                                                    <div style="display: inline-block;height: 20px;vertical-align: middle;font-weight: bold;color: red;">Add</div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </fieldset>
                            </div>
                        </div>
                        <div class="confirmation-page">
                            <div class="confirm_text"></div><br>
                            <div class="wizard">
                                <div class="context">
                                    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
                                    <script type="text/javascript">
                                        Stripe.setPublishableKey('pk_test_wWG5xLDf1AjUWuy2cRi8jws1');
                                    </script>
                                    <fieldset class="body cf">
                                        <div class="payment-success"></div>
                                        <div class="payment-errors"></div>
                                        <form class="repeater-checkout-pass">
                                            <div class="content-left-items">
                                                <div class="content-row" style="text-align: center;">Shipping Information</div>
                                                <div class="content-row">
                                                    <label for="ship_name">Name</label>
                                                    <input id="ship_name" name="ship_name" type="text" placeholder="Name" onkeyup="showLabel(jQuery(this))"/>
                                                </div>
                                                <div class="content-row">
                                                    <label for="ship_address_line_1">Address Line #1</label>
                                                    <input id="ship_address_line_1" name="ship_address_line_1" type="text" placeholder="Address Line #1" onkeyup="showLabel(jQuery(this))"/>
                                                </div>
                                                <div class="content-row">
                                                    <label for="ship_address_line_2">Address Line #2</label>
                                                    <input id="ship_address_line_2" name="ship_address_line_2" type="text" placeholder="Address Line #2" onkeyup="showLabel(jQuery(this))"/>
                                                </div>
                                                <div class="content-row">
                                                    <div class="content-row-float" style="width: 42%;">
                                                        <label for="ship_city">City</label>
                                                        <input id="ship_city" name="ship_city" type="text" placeholder="City" onkeyup="showLabel(jQuery(this))"/>
                                                    </div>
                                                    <div class="content-row-float" style="width: 42%;">
                                                        <label for="ship_state">State</label>
                                                        <input id="ship_state" name="ship_state" type="text" placeholder="State" onkeyup="showLabel(jQuery(this))"/>
                                                    </div>
                                                    <div class="content-row-float" style="width: 14%;">
                                                        <label for="ship_zip">Zip</label>
                                                        <input id="ship_zip" name="ship_zip" type="text" placeholder="Zip" onkeyup="showLabel(jQuery(this))"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content-left-items">
                                                <div class="content-row" style="text-align: center;">Payment Information</div>
                                                <div class="content-row">
                                                    <div class="content-row-float" style="width: 78%;">
                                                        <label for="rcp_cc">Card Number</label>
                                                        <input maxlength="20" autocomplete="off" id="rcp_cc" name="rcp_cc" type="text" placeholder="Card Number" onkeyup="showLabel(jQuery(this))"/>
                                                    </div>
                                                    <div class="content-row-float" style="width: 10%;">
                                                        <label for="rcp_ccedm">MM</label>
                                                        <input id="rcp_ccedm" name="rcp_ccedm" type="text" placeholder="MM" onkeyup="showLabel(jQuery(this))"/>
                                                    </div>
                                                    <div class="content-row-float" style="width: 10%;">
                                                        <label for="rcp_ccedy">YY</label>
                                                        <input id="rcp_ccedy" name="rcp_ccedy" type="text" placeholder="YY" onkeyup="showLabel(jQuery(this))"/>
                                                    </div>
                                                </div>
                                                <div class="content-row">
                                                    <div class="content-row-float" style="width: 78%;">
                                                        <label for="rcp_name">Name on Card</label>
                                                        <input name="rcp_name" type="text" id="rcp_name" placeholder="Name on Card"  onkeyup="showLabel(jQuery(this))"/>
                                                    </div>
                                                    <div class="content-row-float" style="width: 21%;">
                                                        <label for="rcp_cvv">CVC</label>
                                                        <input id="rcp_cvv" name="rcp_cvv" type="text" placeholder="CVC" onkeyup="showLabel(jQuery(this))"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="button" class="btn btn-info btn-md" id="ship_pass" value="ORDER NOW">
                                        </form>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="footer-content">
                            <fieldset>
                                <form class="repeater-personal">
                                    <div class="content-row">
                                        <label for="email">Your Email *</label>
                                        <input id="email" name="email" type="email" class="required" placeholder="Your Email *" onkeyup="showLabel(jQuery(this))">
                                    </div>
                                    <div class="content-row">
                                        <input type="button" class="btn btn-info btn-md" id="download_top" value="Download!">
                                    </div>
                                </form>
                            </fieldset>
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
                    jQuery('.repeater-contacts').repeater({
                        initEmpty: true,
                        isFirstItemUndeletable: true,
                        show: function () {
                            debugger;
                            if(jQuery("form.repeater-contacts").valid()) {
                                jQuery(this).slideDown(400, function () {
                                    jQuery('div[data-repeater-item]').each(function (index) {
                                        if (index > 0) {
                                            jQuery(this).attr('title', 'Emergency Contact #' + (index + 1) + " (Optional)");
                                            jQuery(".content-repeater-contacts-new").attr('title', 'Emergency Contact #' + (index + 2) + " (Optional)");
                                        }
                                    });
                                });
                            } else {
                                jQuery('div[data-repeater-item]').each(function(){
                                    if(jQuery(this).is(':hidden')) {
                                        jQuery(this).remove();
                                    }
                                });
                            }
                        },
                        hide: function (deleteElement) {
                            if (confirm('Are you sure you want to delete this element?')) {
                            }
                        },
                        ready: function (setIndexes) {
                        }
                    });
                    jQuery("form.repeater-personal").validate({
                        rules: {
                            email: {
                                required: true,
                                email: true
                            }
                        },
                        messages: {
                            email: "Please enter a valid email address",
                        }
                    });
                    jQuery("form.repeater-contacts").validate({
                        rules: {
                            "group-a[0][name]": {
                                required: true
                            },
                            "group-a[0][tel_primary]": {
                                phoneUS: true
                            },
                            "group-a[0][tel_secondary]": {
                                phoneUS: true
                            },
                            "group-a[1][name]": {
                                required: true
                            },
                            "group-a[1][tel_primary]": {
                                phoneUS: true
                            },
                            "group-a[1][tel_secondary]": {
                                phoneUS: true
                            },
                            "group-a[2][name]": {
                                required: true
                            },
                            "group-a[2][tel_primary]": {
                                phoneUS: true
                            },
                            "group-a[2][tel_secondary]": {
                                phoneUS: true
                            },
                            "group-a[3][name]": {
                                required: true
                            },
                            "group-a[3][tel_primary]": {
                                phoneUS: true
                            },
                            "group-a[3][tel_secondary]": {
                                phoneUS: true
                            },
                        },
                        messages: {
                            "group-a[0][name]": "Please enter a name",
                            "group-a[0][tel_primary]": "Please enter a valid phone number",
                            "group-a[0][tel_secondary]": "Please enter a valid phone number",
                            "group-a[1][name]": "Please enter a name",
                            "group-a[1][tel_primary]": "Please enter a valid phone number",
                            "group-a[1][tel_secondary]": "Please enter a valid phone number",
                            "group-a[2][name]": "Please enter a name",
                            "group-a[2][tel_primary]": "Please enter a valid phone number",
                            "group-a[2][tel_secondary]": "Please enter a valid phone number",
                            "group-a[3][name]": "Please enter a name",
                            "group-a[3][tel_primary]": "Please enter a valid phone number",
                            "group-a[3][tel_secondary]": "Please enter a valid phone number",
                        }
                    });

                    jQuery("form.repeater-checkout-pass").validate({
                        rules: {
                            rcp_cc: {
                                required: true,
                                creditcard: true
                            },
                            rcp_name: {
                                required: true
                            },
                            rcp_cvv: {
                                required: true,
                                digits: true
                            },
                            rcp_ccedm: {
                                required: true,
                                digits: true,
                                maxlength: 2
                            },
                            rcp_ccedy: {
                                required: true,
                                digits: true,
                                maxlength: 2
                            },
                        },
                        messages: {
                            rcp_cc: "Enter a valid card number",
                            rcp_name: "Enter a Name on Card",
                            rcp_cvv: ""
                        }
                    });

                    jQuery("#ship_pass").click(function(){
                        if(jQuery("form.repeater-checkout-pass").valid()) {
                            Stripe.card.createToken({
                                number: jQuery('#rcp_cc').val(),
                                cvc: jQuery('#rcp_cvv').val(),
                                exp_month: parseInt(jQuery('#rcp_ccedm').val()),
                                exp_year: (2000 + parseInt(jQuery('#rcp_ccedy').val())),
                                name: jQuery("#ship_name").val(),
                                address_line1: jQuery("#ship_address_line_1").val(),
                                address_line2: jQuery("#ship_address_line_2").val(),
                                address_city: jQuery("#ship_city").val(),
                                address_state: jQuery("#ship_state").val(),
                                address_zip: jQuery("#ship_zip").val(),
                                address_country: "US"
                            }, 1*100, stripeResponseHandler);
                            jQuery(this).attr("disabled", "disabled");
                            return false;
                        }
                    });

                    function stripeResponseHandler(status, response) {
                        debugger;
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
                                url: "//nowprep.com/wp-content/themes/Newspaper/wrapper/stripe_payment_new.php",
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

                    jQuery("#download_top").click(function () {
                        if(jQuery("form.repeater-personal").valid()) {
                            jQuery(".multi_form_wizard").hide();
                            jQuery(".")
                            jQuery(".confirmation-page").show();
                        }
                    });
                    jQuery("#rcp_cced").mask("99/99",{ "placeholder": "" });
                });
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNhcLWPyYGoSKdD1xHpkenk3GeiGtBgw8&libraries=places" async defer></script>
        </div><!-- #content -->
        <footer id="colophon" class="site-footer" role="contentinfo">
            <div class="wrap">
            </div><!-- .wrap -->
        </footer><!-- #colophon -->
    </div><!-- .site-content-contain -->
</div><!-- #page -->
</body>
</html>