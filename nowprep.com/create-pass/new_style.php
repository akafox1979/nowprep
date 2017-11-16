<?php
/**
 * Template Name: Multi Form page template
 */

function get_template_directory_uri()
{
    return '';
}

?>

<!DOCTYPE html>
<html class="no-js no-svg">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>

</head>

<body>
<div id="page" class="site">
    <header id="masthead" class="site-header" role="banner">

    </header><!-- #masthead -->
    <div class="site-content-contain">
        <div id="content" class="site-content">

            <script src="<?php echo get_template_directory_uri(); ?>assets/js/jquery/jquery.js" type="application/javascript"></script>
            <script src="<?php echo get_template_directory_uri(); ?>assets/js/jquery.steps.js" type="text/javascript"></script>
            <script src="<?php echo get_template_directory_uri(); ?>assets/js/jquery.repeater.js" type="text/javascript"></script>
            <script src="<?php echo get_template_directory_uri(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
            <script src="<?php echo get_template_directory_uri(); ?>assets/js/additional-methods.js" type="text/javascript"></script>
            <script src="<?php echo get_template_directory_uri(); ?>assets/js/jquery.maskedinput.js" type="text/javascript"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
            <link href="<?php echo get_template_directory_uri(); ?>assets/css/style.css" rel="stylesheet" type="text/css"/>
            <link href="<?php echo get_template_directory_uri(); ?>assets/css/steps.css" rel="stylesheet" type="text/css"/>
            <style>
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

                textarea {
                    width: 100%;
                }

                input[type="button"] {
                    height: 45px !important;
                }

                .content-left-items {
                    width: 100%;
                    display: inline-block;
                    border-radius: 5px;
                    -webkit-border-radius: 5px;
                    border: 1px solid gray;
                    padding: 5px;
                    margin-bottom: 5px;
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
                    padding: 6px 12px;
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
                }

                input.btn-danger {
                    color: #fff;
                    background-color: #d9534f;
                    border-color: #d43f3a;
                }

                input.btn-sm {
                    padding: 5px 10px;
                    font-size: 12px;
                    line-height: 1.5;
                    border-radius: 3px;
                }

                input.btn-info {
                    color: #fff;
                    background-color: #5bc0de;
                    border-color: #46b8da;
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
                }

                .content-row input, textarea {
                    /*width: 75%;
                    display: inline-block !important;*/
                }

                .content-row input[type="checkbox"] {
                    display: inline-block !important;
                    width: auto;
                }

                .content-row label {
                    /*width: 20%;
                    text-align: right;*/
                    margin-bottom: 0px !important;
                }

                label.error {
                    /*display: inline !important;
                    margin-left: 21% !important;*/
                    margin-bottom: 0px !important;
                }

                input, textarea {
                    margin-bottom: 0px !important;
                }

                .confirmation-review {
                    display: none;
                }

                .wizard > .content > .body label {
                    display: block !important;
                }

                select {
                    margin-bottom: 0px !important;
                }
                li.disabled {
                    display: none !important;
                }


                /*progressbar*/
                #progressbar {
                    margin-bottom: 30px;
                    overflow: hidden;
                    /*CSS counters to number the steps*/
                    counter-reset: step;
                    text-align: center;

                }
                #progressbar li {
                    list-style-type: none;
                    color: black;
                    text-transform: uppercase;
                    font-size: 9px;
                    width: 25%;
                    float: left;
                    position: relative;
                }
                #progressbar li:before {
                    content: counter(step);
                    counter-increment: step;
                    width: 20px;
                    line-height: 20px;
                    display: block;
                    font-size: 10px;
                    color: white;
                    background: black;
                    border-radius: 3px;
                    margin: 0 auto 5px auto;

                }
                /*progressbar connectors*/
                #progressbar li:after {
                    content: '';
                    width: 89%;
                    height: 2px;
                    background: #ccc;
                    position: absolute;
                    left: -45%;
                    top: 9px;
                    z-index: 1000;
                }
                #progressbar li:first-child:after {
                    /*connector not needed before the first step*/
                    content: none;
                }
                /*marking active/completed steps green*/
                /*The number of the step and the connector before it = green*/
                #progressbar li.active:before,  #progressbar li.active:after{
                    background: #27AE60;
                    color: white;
                }

                .wizard > .content {
                    padding-top: 1em !important;
                }
                ul[role="tablist"] {
                    display: none;
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
                    box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
                }
            </style>
            <div class="wrap">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
                        <ul id="progressbar">
                            <li index="0" class="active">YOUR INFO</li>
                            <li index="1" class="non-active">YOUR CONTACTS</li>
                            <li index="2" class="non-active">YOUR ADDRESSES</li>
                            <li index="3" class="non-active">YOUR PLANS & NOTES</li>
                        </ul>
                        <div class="multi_form_wizard">
                            <h1>YOUR INFO</h1>
                            <div>
                                <fieldset>
                                    <form class="repeater-personal">
                                        <div class="content-row">
                                            <label for="name">Name *</label>
                                            <input id="name" name="name" type="text" class="required" maxlength="35">
                                        </div>
                                        <div class="content-row">
                                            <label for="email">Email *</label>
                                            <input id="email" name="email" type="email" class="required">
                                        </div>
                                        <div class="content-row">
                                            <label for="tel">Phone</label>
                                            <input id="tel" name="tel" type="tel" mask="(999) 999-9999">
                                        </div>
                                        <div class="content-row">
                                            <label for="info_notes">Notes & Medical Info</label>
                                            <textarea id="info_notes" name="info_notes" maxlength="200"
                                                      rows="5"></textarea>
                                        </div>
                                    </form>
                                </fieldset>
                            </div>
                            <h1>YOUR CONTACTS</h1>
                            <div>
                                <fieldset>
                                    <form class="repeater-contacts">
                                        <div data-repeater-list="group-a" style="display: block;position: relative;">
                                            <div data-repeater-item
                                                 style="position: relative;width: 100%;height: 100%;">
                                                <div class="content-left-items">
                                                    <div class="content-row">
                                                        <label for="name">Name</label>
                                                        <input id="name" name="name" type="text" maxlength="35">
                                                    </div>
                                                    <div class="content-row">
                                                        <label for="relation">Relation</label>
                                                        <select id="relation" name="relation">
                                                            <option value="">Please select</option>
                                                            <option value="Parent">Parent</option>
                                                            <option value="Spouse">Spouse</option>
                                                            <option value="Child">Child</option>
                                                            <option value="Sibling">Sibling</option>
                                                            <option value="Family">Family</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                    <div class="content-row">
                                                        <label for="in_case">Emergency Contact</label>
                                                        <select id="in_case" name="in_case" type="text">
                                                            <option value="">Please select</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="content-row">
                                                        <label for="email">Email</label>
                                                        <input id="email" name="email" type="email">
                                                    </div>
                                                    <div class="content-row">
                                                        <label for="tel">Phone</label>
                                                        <input id="tel" name="tel" type="text">
                                                    </div>
                                                    <div class="content-row">
                                                        <label for="info_notes">Medical Info/Notes</label>
                                                        <textarea id="info_notes" name="info_notes" maxlength="150"
                                                                  rows="2"></textarea>
                                                    </div>
                                                    <input data-repeater-delete type="button"
                                                           class="btn btn-danger btn-sm" value="Delete"
                                                           style="float:right; margin-top: 5px;"/>
                                                </div>
                                                <div class="content-right-items">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="content-create">
                                            <input data-repeater-create type="button" class="btn btn-info btn-md"
                                                   value="Add contact"/>
                                        </div>
                                    </form>
                                </fieldset>
                            </div>
                            <h1>YOUR ADDRESSES</h1>
                            <div>
                                <fieldset>
                                    <form class="repeater-addresses">
                                        <div data-repeater-list="group-b" style="display: block;position: relative;">
                                            <div data-repeater-item
                                                 style="position: relative;width: 100%;height: 100%;">
                                                <div class="content-left-items">
                                                    <div class="content-row">
                                                        <label for="type">Type</label>
                                                        <input id="type" name="type" type="text"
                                                               style="margin-bottom: 0px !important; "/>
                                                    </div>
                                                    <div class="content-row">
                                                        <label for="address">Address</label>
                                                        <input id="address" name="address"
                                                               placeholder="Enter your address"
                                                               onFocus="geolocate(jQuery(this))" type="text"
                                                               style="margin-bottom: 0px !important; "/>
                                                    </div>
                                                    <input data-repeater-delete type="button"
                                                           class="btn btn-danger btn-sm" value="Delete"
                                                           style="float:right; margin-top: 5px;"/>
                                                </div>
                                                <div class="content-right-items">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="content-create">
                                            <input data-repeater-create type="button" class="btn btn-info btn-md"
                                                   value="Add address"/>
                                        </div>
                                    </form>
                                </fieldset>
                            </div>
                            <h1>YOUR PLANS & NOTES</h1>
                            <div>
                                <fieldset>
                                    <form class="repeater-plans">
                                        <div class="content-row">
                                            <label for="plans_notes">Plans & Notes</label>
                                            <textarea id="plans_notes" name="plans_notes" maxlength="300"
                                                      rows="5"></textarea>
                                        </div>
                                    </form>
                                </fieldset>
                            </div>
                        </div>
                        <div class="confirmation-review">
                            <h2 style="text-align: center;">Review</h2>
                            <br>
                            <span id="review_text"
                                  style="width: 100%;margin: 10px;text-align: center;display: block;"></span>
                            <div style="text-align: center;">
                                <input type="button" class="btn btn-info btn-md" id="preview_top" value="Preview"
                                       style="display: none">
                                <input type="button" class="btn btn-info btn-md" id="go_back_top" value="Go Back">
                                <input type="button" class="btn btn-info btn-md" id="download_top" value="Download!">
                            </div>
                            <div class="review-tables">
                                <!--h3 style="text-align: center;">PERSONAL INFO</h3>
                                <table>
                                    <thead>
                                    <tr>
                                        <td style="width: 30%;">Name</td>
                                        <td style="width: 30%;">Email</td>
                                        <td style="width: 10%;">Phone</td>
                                        <td style="width: 30%;">Medical Info/Notes</td>
                                    </tr>
                                    </thead>
                                    <tbody class="personal-table-preview">
                                    </tbody>
                                </table>
                                <br>
                                <h3 style="text-align: center;">CONTACTS</h3>
                                <table>
                                    <thead>
                                    <tr>
                                        <td style="width: 20%;">Name</td>
                                        <td style="width: 10%;">Relation</td>
                                        <td style="width: 10%;">Emergency Contact</td>
                                        <td style="width: 20%;">Email</td>
                                        <td style="width: 20%;">Phone</td>
                                        <td style="width: 20%;">Medical Info/Notes</td>
                                    </tr>
                                    </thead>
                                    <tbody class="contacts-table-preview">
                                    </tbody>
                                </table>
                                <br>
                                <h3 style="text-align: center;">ADDRESSES</h3>
                                <table>
                                    <thead>
                                    <tr>
                                        <td style="width: 10%;">Type</td>
                                        <td style="width: 90%;">Address</td>
                                    </tr>
                                    </thead>
                                    <tbody class="addresses-table-preview">
                                    </tbody>
                                </table>
                                <br>
                                <h3 style="text-align: center;">PLANS & NOTES</h3>
                                <table>
                                    <thead>
                                        <td style="width: 100%;">Plan & Note</td>
                                    </thead>
                                    <tbody class="plans-table-preview">
                                    </tbody>
                                </table>
                                <br>
                                <br-->
                                <canvas id="emergency_card" width="960" height="1125"
                                        style="border: none;display: none;"></canvas>
                                <img id="emergency_card_img" src="" style="width: 100%;height: 100%;margin: 10px 0px;"/>
                            </div>
                            <div style="text-align: center;">
                                <input type="button" class="btn btn-info btn-md" id="preview_bottom" value="Preview"
                                       style="display: none">
                                <input type="button" class="btn btn-info btn-md" id="go_back_bottom" value="Go Back">
                                <input type="button" class="btn btn-info btn-md" id="download_bottom" value="Download!">
                            </div>
                        </div>
                    </main><!-- #main -->
                </div><!-- #primary -->
            </div><!-- .wrap -->
            <script>
                var current_fs, next_fs, previous_fs; //fieldsets
                var left, opacity, scale; //fieldset properties which we will animate
                var animating; //flag to prevent quick multi-click glitches

                var infos = ['Your Info','Your Contacts','Your Addresses','Your Plans & Notes'];



                var placeSearch;
                var json = "";
                var wizard;
                var data = {};
                var googleAddressData = [];
                var toEmail = "";
                var toName = "";
                function initAutocomplete(data_field) {

                    var input_name = jQuery(data_field).attr('name');
                    var input_element = document.getElementsByName(input_name);
                    var autocomplete = new google.maps.places.Autocomplete(
                        (input_element[0]),
                        {types: ['geocode']});

                    autocomplete.addListener('place_changed', function () {
                        googleAddressData.push({name: input_name, value : autocomplete.getPlace().address_components});
                        //debugger;
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
                            }
                            if (returnValue) {
                                data['personal'] = jQuery("form.repeater-personal").serializeArray();
                                data['contacts'] = jQuery("form.repeater-contacts").serializeArray();
                                data['addresses'] = jQuery("form.repeater-addresses").serializeArray();
                                data['plans'] = jQuery("form.repeater-plans").serializeArray();
                                debugger;
                                data['google_address'] = googleAddressData;
                                json = JSON.stringify(data);
                                jQuery(".multi_form_wizard").hide();
                                jQuery("#progressbar").hide();
                                jQuery(".confirmation-review").show();
                                jQuery("#preview_top").click();
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
                            }
                            if(returnValue) {
                                if (newIndex > currentIndex) {
                                    jQuery('li[index="' + newIndex + '"]').addClass('active');
                                    jQuery('li[index="' + newIndex + '"]').removeClass('non-active');
                                }
                                if (newIndex < currentIndex) {
                                    jQuery('li[index="' + currentIndex + '"]').removeClass('active');
                                    jQuery('li[index="' + currentIndex + '"]').addClass('non-active');
                                }
                            }
                            return returnValue;
                        }
                    });
                    jQuery('.repeater-contacts').repeater({
                        initEmpty: true,
                        show: function () {
                            jQuery(this).slideDown();
                        },
                        hide: function (deleteElement) {
                            if (confirm('Are you sure you want to delete this element?')) {
                                jQuery(this).slideUp(deleteElement);
                            }
                        },
                        ready: function (setIndexes) {
                        },
                        isFirstItemUndeletable: true
                    });
                    jQuery('.repeater-addresses').repeater({
                        initEmpty: true,
                        show: function () {
                            jQuery(this).slideDown();

                        },
                        hide: function (deleteElement) {
                            if (confirm('Are you sure you want to delete this element?')) {
                                jQuery(this).slideUp(deleteElement);
                            }
                        },
                        ready: function (setIndexes) {
                        },
                        isFirstItemUndeletable: true
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
                    jQuery("form.repeater-addresses").validate({
                        submitHandler: function (form) {
                            return false;
                        }
                    });
                    /*jQuery("form.repeater-plans").validate({
                     rules: {
                     plans_notes: "required"
                     },
                     messages: {
                     plans_notes: "Please enter Plans & Notes"
                     }
                     });*/
                    jQuery("#preview_top,#preview_bottom").click(function () {
                        //jQuery(".review-tables").show();
                        var c = document.getElementById("emergency_card");
                        var ctx = c.getContext("2d");
                        var img = new Image();
                        img.onload = function () {
                            ctx.drawImage(img, 0, 0);
                            jQuery.each(data, function (index, valueData) {
                                if (index == 'personal') {
                                    var strTable = "<tr>";
                                    var iCount = 1;
                                    jQuery.each(valueData, function (index, value) {
                                        ctx.font = "25px Arial";
                                        if (value.name == 'name') {
                                            toName = value.value;
                                            ctx.fillText(value.value, 85, 190);
                                        }
                                        if (value.name == 'email') {
                                            toEmail = value.value;
                                            if (value.value.length > 0) {
                                                jQuery('#review_text').html("Please review the contents of your NowPrep Emergency Prep Pass below.<br>Once ready, click 'Download' to have your pass emailed to this address: " + value.value + ".<br>If you need to correct this address or any of the other content, just click 'Go Back' and make any necessary updates.<br>");
                                            }
                                            else {
                                                jQuery('#review_text').html("Please review the contents of your NowPrep Emergency Prep Pass below.<br> Once ready, click 'Download' to have your pass emailed to this address: (empty).<br>If you need to correct this address or any of the other content, just click 'Go Back' and make any necessary updates.<br>");
                                            }
                                        }
                                        if (value.name == 'tel')
                                            ctx.fillText(value.value.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 85, 265);
                                        if (value.name == 'info_notes') {
                                            var lines = split_lines(ctx, 400, "25px Arial", value.value);
                                            for (var j = 0; j < lines.length; ++j) {
                                                ctx.fillText(lines[j], 85, 345 + 25 * j);
                                            }
                                        }
                                        strTable = strTable + "<td>" + value.value + "</td>";
                                        iCount++;
                                    });
                                    strTable = strTable + "</tr>";
                                    jQuery(".personal-table-preview").html(strTable);
                                } else if (index == 'contacts') {
                                    var strTable = "<tr>";
                                    var iCount = 0;
                                    jQuery.each(valueData, function (index, value) {
                                        //debugger;
                                        if (index > (5 + iCount * 6)) {
                                            strTable = strTable + "</tr><tr>";
                                            iCount++;
                                        }
                                        ctx.font = "18px Arial";
                                        if (value.name == ('group-a[' + iCount + '][name]')) {
                                            ctx.fillText(value.value, 80 + (220) * iCount, 735);
                                        }
                                        if (value.name == ('group-a[' + iCount + '][relation]')) {
                                            ctx.fillText(value.value, 80 + (220) * iCount, 785);
                                        }
                                        if (value.name == ('group-a[' + iCount + '][tel]')) {
                                            ctx.fillText(value.value.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 80 + (220) * iCount, 835);
                                        }
                                        if (value.name == ('group-a[' + iCount + '][info_notes]')) {
                                            var lines = split_lines(ctx, 175, "13px Arial", value.value);
                                            for (var j = 0; j < lines.length; ++j) {
                                                ctx.fillText(lines[j], 80 + (220) * iCount, 880 + 13 * j);
                                            }
                                        }

                                        if (value.name == ('group-a[' + iCount + '][in_case]')) {
                                            //debugger;
                                            if (value.value == "Yes") {
                                                var imageObject = new Image();
                                                imageObject.src = 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAASABIAAD/4QBYRXhpZgAATU0AKgAAAAgAAwEGAAMAAAABAAIAAAESAAMAAAABAAEAAIdpAAQAAAABAAAAMgAAAAAAAqACAAQAAAABAAAAnaADAAQAAAABAAAADwAAAAD/4QkhaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJYTVAgQ29yZSA1LjQuMCI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiLz4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8P3hwYWNrZXQgZW5kPSJ3Ij8+AP/tADhQaG90b3Nob3AgMy4wADhCSU0EBAAAAAAAADhCSU0EJQAAAAAAENQdjNmPALIE6YAJmOz4Qn7/4gzoSUNDX1BST0ZJTEUAAQEAAAzYYXBwbAIQAABtbnRyUkdCIFhZWiAH4QAHABIACwALAB9hY3NwQVBQTAAAAABBUFBMAAAAAAAAAAAAAAAAAAAAAAAA9tYAAQAAAADTLWFwcGwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABFkZXNjAAABUAAAAGJkc2NtAAABtAAAAb5jcHJ0AAADdAAAACN3dHB0AAADmAAAABRyWFlaAAADrAAAABRnWFlaAAADwAAAABRiWFlaAAAD1AAAABRyVFJDAAAD6AAACAxhYXJnAAAL9AAAACB2Y2d0AAAMFAAAADBuZGluAAAMRAAAAD5jaGFkAAAMhAAAACxtbW9kAAAMsAAAAChiVFJDAAAD6AAACAxnVFJDAAAD6AAACAxhYWJnAAAL9AAAACBhYWdnAAAL9AAAACBkZXNjAAAAAAAAAAhEaXNwbGF5AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAbWx1YwAAAAAAAAAiAAAADGhySFIAAAAWAAABqGtvS1IAAAAWAAABqG5iTk8AAAAWAAABqGlkAAAAAAAWAAABqGh1SFUAAAAWAAABqGNzQ1oAAAAWAAABqGRhREsAAAAWAAABqHVrVUEAAAAWAAABqGFyAAAAAAAWAAABqGl0SVQAAAAWAAABqHJvUk8AAAAWAAABqG5sTkwAAAAWAAABqGhlSUwAAAAWAAABqGVzRVMAAAAWAAABqGZpRkkAAAAWAAABqHpoVFcAAAAWAAABqHZpVk4AAAAWAAABqHNrU0sAAAAWAAABqHpoQ04AAAAWAAABqHJ1UlUAAAAWAAABqGZyRlIAAAAWAAABqG1zAAAAAAAWAAABqGNhRVMAAAAWAAABqHRoVEgAAAAWAAABqGVzWEwAAAAWAAABqGRlREUAAAAWAAABqGVuVVMAAAAWAAABqHB0QlIAAAAWAAABqHBsUEwAAAAWAAABqGVsR1IAAAAWAAABqHN2U0UAAAAWAAABqHRyVFIAAAAWAAABqGphSlAAAAAWAAABqHB0UFQAAAAWAAABqABEAEUATABMACAAVQAyADcAMQA1AEgAAHRleHQAAAAAQ29weXJpZ2h0IEFwcGxlIEluYy4sIDIwMTcAAFhZWiAAAAAAAADz2AABAAAAARYIWFlaIAAAAAAAAG/QAAA3qQAAAKdYWVogAAAAAAAAYWAAALhzAAAVI1hZWiAAAAAAAAAlpQAAD+QAAL1jY3VydgAAAAAAAAQAAAAABQAKAA8AFAAZAB4AIwAoAC0AMgA2ADsAQABFAEoATwBUAFkAXgBjAGgAbQByAHcAfACBAIYAiwCQAJUAmgCfAKMAqACtALIAtwC8AMEAxgDLANAA1QDbAOAA5QDrAPAA9gD7AQEBBwENARMBGQEfASUBKwEyATgBPgFFAUwBUgFZAWABZwFuAXUBfAGDAYsBkgGaAaEBqQGxAbkBwQHJAdEB2QHhAekB8gH6AgMCDAIUAh0CJgIvAjgCQQJLAlQCXQJnAnECegKEAo4CmAKiAqwCtgLBAssC1QLgAusC9QMAAwsDFgMhAy0DOANDA08DWgNmA3IDfgOKA5YDogOuA7oDxwPTA+AD7AP5BAYEEwQgBC0EOwRIBFUEYwRxBH4EjASaBKgEtgTEBNME4QTwBP4FDQUcBSsFOgVJBVgFZwV3BYYFlgWmBbUFxQXVBeUF9gYGBhYGJwY3BkgGWQZqBnsGjAadBq8GwAbRBuMG9QcHBxkHKwc9B08HYQd0B4YHmQesB78H0gflB/gICwgfCDIIRghaCG4IggiWCKoIvgjSCOcI+wkQCSUJOglPCWQJeQmPCaQJugnPCeUJ+woRCicKPQpUCmoKgQqYCq4KxQrcCvMLCwsiCzkLUQtpC4ALmAuwC8gL4Qv5DBIMKgxDDFwMdQyODKcMwAzZDPMNDQ0mDUANWg10DY4NqQ3DDd4N+A4TDi4OSQ5kDn8Omw62DtIO7g8JDyUPQQ9eD3oPlg+zD88P7BAJECYQQxBhEH4QmxC5ENcQ9RETETERTxFtEYwRqhHJEegSBxImEkUSZBKEEqMSwxLjEwMTIxNDE2MTgxOkE8UT5RQGFCcUSRRqFIsUrRTOFPAVEhU0FVYVeBWbFb0V4BYDFiYWSRZsFo8WshbWFvoXHRdBF2UXiReuF9IX9xgbGEAYZRiKGK8Y1Rj6GSAZRRlrGZEZtxndGgQaKhpRGncanhrFGuwbFBs7G2MbihuyG9ocAhwqHFIcexyjHMwc9R0eHUcdcB2ZHcMd7B4WHkAeah6UHr4e6R8THz4faR+UH78f6iAVIEEgbCCYIMQg8CEcIUghdSGhIc4h+yInIlUigiKvIt0jCiM4I2YjlCPCI/AkHyRNJHwkqyTaJQklOCVoJZclxyX3JicmVyaHJrcm6CcYJ0kneierJ9woDSg/KHEooijUKQYpOClrKZ0p0CoCKjUqaCqbKs8rAis2K2krnSvRLAUsOSxuLKIs1y0MLUEtdi2rLeEuFi5MLoIuty7uLyQvWi+RL8cv/jA1MGwwpDDbMRIxSjGCMbox8jIqMmMymzLUMw0zRjN/M7gz8TQrNGU0njTYNRM1TTWHNcI1/TY3NnI2rjbpNyQ3YDecN9c4FDhQOIw4yDkFOUI5fzm8Ofk6Njp0OrI67zstO2s7qjvoPCc8ZTykPOM9Ij1hPaE94D4gPmA+oD7gPyE/YT+iP+JAI0BkQKZA50EpQWpBrEHuQjBCckK1QvdDOkN9Q8BEA0RHRIpEzkUSRVVFmkXeRiJGZ0arRvBHNUd7R8BIBUhLSJFI10kdSWNJqUnwSjdKfUrESwxLU0uaS+JMKkxyTLpNAk1KTZNN3E4lTm5Ot08AT0lPk0/dUCdQcVC7UQZRUFGbUeZSMVJ8UsdTE1NfU6pT9lRCVI9U21UoVXVVwlYPVlxWqVb3V0RXklfgWC9YfVjLWRpZaVm4WgdaVlqmWvVbRVuVW+VcNVyGXNZdJ114XcleGl5sXr1fD19hX7NgBWBXYKpg/GFPYaJh9WJJYpxi8GNDY5dj62RAZJRk6WU9ZZJl52Y9ZpJm6Gc9Z5Nn6Wg/aJZo7GlDaZpp8WpIap9q92tPa6dr/2xXbK9tCG1gbbluEm5rbsRvHm94b9FwK3CGcOBxOnGVcfByS3KmcwFzXXO4dBR0cHTMdSh1hXXhdj52m3b4d1Z3s3gReG54zHkqeYl553pGeqV7BHtje8J8IXyBfOF9QX2hfgF+Yn7CfyN/hH/lgEeAqIEKgWuBzYIwgpKC9INXg7qEHYSAhOOFR4Wrhg6GcobXhzuHn4gEiGmIzokziZmJ/opkisqLMIuWi/yMY4zKjTGNmI3/jmaOzo82j56QBpBukNaRP5GokhGSepLjk02TtpQglIqU9JVflcmWNJaflwqXdZfgmEyYuJkkmZCZ/JpomtWbQpuvnByciZz3nWSd0p5Anq6fHZ+Ln/qgaaDYoUehtqImopajBqN2o+akVqTHpTilqaYapoum/adup+CoUqjEqTepqaocqo+rAqt1q+msXKzQrUStuK4trqGvFq+LsACwdbDqsWCx1rJLssKzOLOutCW0nLUTtYq2AbZ5tvC3aLfguFm40blKucK6O7q1uy67p7whvJu9Fb2Pvgq+hL7/v3q/9cBwwOzBZ8Hjwl/C28NYw9TEUcTOxUvFyMZGxsPHQce/yD3IvMk6ybnKOMq3yzbLtsw1zLXNNc21zjbOts83z7jQOdC60TzRvtI/0sHTRNPG1EnUy9VO1dHWVdbY11zX4Nhk2OjZbNnx2nba+9uA3AXcit0Q3ZbeHN6i3ynfr+A24L3hROHM4lPi2+Nj4+vkc+T85YTmDeaW5x/nqegy6LzpRunQ6lvq5etw6/vshu0R7ZzuKO6070DvzPBY8OXxcvH/8ozzGfOn9DT0wvVQ9d72bfb794r4Gfio+Tj5x/pX+uf7d/wH/Jj9Kf26/kv+3P9t//9wYXJhAAAAAAADAAAAAmZmAADypwAADVkAABPQAAAKDnZjZ3QAAAAAAAAAAQABAAAAAAAAAAEAAAABAAAAAAAAAAEAAAABAAAAAAAAAAEAAG5kaW4AAAAAAAAANgAAqUAAAFUAAABNQAAAnQAAACZAAAAPQAAAUEAAAFRAAAIzMwACMzMAAjMzAAAAAAAAAABzZjMyAAAAAAABC7cAAAWW///zVwAABykAAP3X///7t////aYAAAPaAADA9m1tb2QAAAAAAAAQrAAA0GUwOVJT1SGfAAAAAAAAAAAAAAAAAAAAAAD/wAARCAAPAJ0DASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9sAQwACAgICAgIDAgIDBAMDAwQFBAQEBAUHBQUFBQUHCAcHBwcHBwgICAgICAgICgoKCgoKCwsLCwsNDQ0NDQ0NDQ0N/9sAQwECAgIDAwMGAwMGDQkHCQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0N/90ABAAK/9oADAMBAAIRAxEAPwD7k/af/ac8UfDbxba+C1SxaG01Sw1rzdG1NvtsmnWE0cstlfQ7Fa3e4IxwzI8ZwQRuB+0fhN4x1D4geA9N8Y6kNMR9UEk0cek3f263jhLsI0M+FDSooAlAACyBh2rP8T/BX4d+J2imk0q30+5TXbLxFNc2EEMM11e2Uqyg3DeWfNWXbtkDZLKTyDgj0DRfD+heHLWSx8P6fa6bbSzy3Lw2kKQxtNM26SQqgA3Oxyx6k9a8vC4fFQxE6lWd4vZf12Pvc9zrIcRkeGwWAwzhiIP35/zaJPS7td277dL2Plr9mu8128+IvxqTV9a1LU4LLxY9nZ217cvPDaRK002IEckRA+cEIXA2RxjHGa574mWfiz4w/tCXfwftPFur+D9H8P8AhZNXjbSJntpbu/up/LWSRo3jaSKJcAJkDcG5BOa9e0v9nbwrpEfxGjtdZ13/AIuZNLPqLfao0aykladi1kY4VKEefgGTzCVRFbIUg5Pjb9mTw54zXw/ef8JL4i0vW9B0hNCbW7S6jOoajYALuS8kkicSuzAuXAX53YkEYA5amFxH1ZUeW9ndq+65npf7nf5HvUeIMnWd1MxjW5XKEYRl7K/JJUoLn5dnqpRta+vMj6HtLWa302GxnuZLmWOBYnuXwskrqoUyNtAUMx5OABnoK/Mf9je88d+JvHg1DWPF/jS+g0z+047iHVLqW90W9jifyIkVpZG23KMRI2AfukDaCa+4Ne+DFlrPiPw94ktPE3iPSX8Oac2mQ2tlflba4iZSoe4RlYySDglifmKruztFecfC/wDZK8KfCrxPpvifSPFnii+OlvcyRWF5dW/2F5LuNo5GkiitoyzHduyGB3AE5GQaxeHxNXE0pRjaMXrrutPy1Obh/OMowOS5hhp171a8Vb93s17RON9Uua8dVa1+8T59/as8XeK9C+POnabpGv8Ai+zhn8KNc2en+GJ52MmqQzzfZy1qhMciSNhZi6MCoANeoad8evjj4c13wl8JvEHgSHXvGOreHrfUZbltUg09JJU3LdNKqwvGhTZkhcZY4VQOR9Bat8GvD+sfF/R/jRNqGpRavo2ntpsdnFJELGWFvOOZVMRlLZmz8sqqSiZBwcu1b4O6BrHxg0X40z6jqUWr6Hp0mmQWcUkQsJIZBOGMiGFpS2ZyfllUEomR8pzn9Qxcas6sJtXl5fD1eqauumn5na+LMgq5fhcBisPGfsqMrtqSftrS5I3g4vlvbmfM0/Jq58z+FfjJqvgrSvjp41n8LzS6n4Z1u1u9Q019VLpKZI4oZXjlZJFjEVtGrBFU5ChBjjF//hr3xHY3V+Nf8CQWVlo/9gXWp3Ka0JPs+neIZI44JlX7IvmSoZAWjyq4/wCWld/qn7KHhHVZPHRk8UeKIYviFcC41eCG6tFjGJWkCRA2hwgDeX85dvLAGcjNdT4y/Zy8AeMtP8R6fM15p6+JdL0bSZ2s3jUwxaFO1xavFvjf59xVX37gUjUADkmKeGzKMOWErWv21bcmunonsa1M44Lq1lPF0efmcLte1ThFRoRkl76va1Zx0b+G7asjlfin+0kvwt+JWleDdQ0zT7nTb2SwiuLldVVdQgF9MIfN+wrC58qMkElpELjO3pzCfj58QdR+MHib4UeF/AkOot4XaCW6vX1ZIQbS4hWSOQRtDku7NtCAnGCSemXeM/2SPBPjPUNQ1K48R+JbCTV20+bUPs1zaSG5uNMVUt52kubSeZXUIvyo6x8DCCu08GfArQ/h98QfEXxU03V9b1bWPEFoILu2vZrZoJDF5fllQsEThwItqlpCoDNkc5GrhmUqrTlaN+lrpa6benQ85Yjg6ll6lCnz11SatJVEnUvTtJ2mktPaLR8vwuy1S4P4eftQp8Q9d8A+HbLw3JaXviqLWpdXikuwzaL/AGOzxFWHlqZvNmUKDhNqsDgnIHOfFCLxH8V/2kbT4Jp4n1jwvoGleEH8SSPodw1ndXV492LZA8qEExxqwYLgjIbuQVT9nX4ZaivxY8c/GnVtDl8OQaw72umaZc3NvdTQy3Evn6nIWtmkQJJcopT593LjaF2Z9a+K37P2g/E/xFpvjODW9X8LeItNtZNPGp6LMkU01lK25oJN6OCoJYoRggsc54AinHF18JzVfefNt8N0tPLdrm17+h3YnE8P5TxA4YK1OPspJS/iqFWd5LrJP2cZKleN9Y82ru35745+POtfCCUfD/TdMk8dal4S8LprviHVb29TT2NrE3lAqqRTmS6l2NIykIoGDuJYgL4v/ae1rTtc07S/BHg9NdttU8GJ42gubrUxYYsjkyIyCCc70TYeCdxbHGMnT179knwRqun6dp+la5rmiC38Pr4X1Ga0mgkm1XSl+bZcmeCRBKXLN5saIfmYYxtC+i3fwL8EXXiqPxSPtUHkeEpPBkNhE6LZxabK24lFKGQShfkB37dv8OeapUsybklLlWltnZerV353+RyvH8GwhTnOk6k7T5rqceaWlm1GaSu7uKg0lHSWp8vSftCfF/xd8UPhS/gzSY7bQvF2ly6gdLmuoQLxNq/aTLK0LPH9kXLxFNpkPBBHB9b1v9pN9C+Pen/CO507TZtN1C+i0xb221MTX8VzPbecjTWixYiQyDytrS7sYk6HbUp/ZO8HQaL4P03S/EviXTr3wRHcwaXq1tc2wvfIumDNE5a1MRVcAJtjUgDknJyn/DJvg4eMLfxcniPxChtfEUXilLJZrQwtqUezc0kjWjXLrIE2upm5UkAjNY06OaRW922nutraq3TXt5W6s78RmHBFeSTpqMI0qsIpRmpcznJ05tqXvNRcbc3XmUtFFJtt8d/iR4w1rX7f4XfD4a3omi32oaMurXOqw2nmalYIN2bdl3C3Mp2B1dnI+YqvaT9kTx18RviH8KE8QfEN1u5DfXcNnqJZBPeRxTSI5kiiijjjETgxKV++FyQO/eeEfgtZeBvGuseKfDPiPWbPTdc1C41a88Pb7eTTHvrtcTyjzIHuEDviTakygMMD5PkFr4U/B7TPhFHrGn+HtY1O40jUrx7u00u6aJrbTPMkklkjttsSvtd5TkuzHCrzkEt24eji1XjUqybXvJrS3SzVunrr8rnz+a5lw+8sr4PAUoRk/ZShK1Rz0U1UjJyk0pXkm+VKnJJ/aUbf/9k=';
                                                ctx.drawImage(imageObject, 65 + (220) * iCount, 685);
                                            }
                                        }

                                        strTable = strTable + "<td>" + value.value + "</td>";
                                    });
                                    strTable = strTable + "</tr>";
                                    jQuery(".contacts-table-preview").html(strTable);
                                } else if (index == 'addresses') {
                                    var strTable = "<tr>";
                                    var iCount = 0;
                                    jQuery.each(valueData, function (index, value) {
                                        if (index > (1 + iCount * 2)) {
                                            strTable = strTable + "</tr><tr>";
                                            iCount++;
                                        }
                                        ctx.font = "18px Arial";
                                        if (iCount == 0) {
                                            if (value.name == ('group-b[' + iCount + '][type]')) {
                                                ctx.fillText(value.value, 512, 190);
                                            }
                                            if (value.name == ('group-b[' + iCount + '][address]')) {
                                                var lines = split_lines(ctx, 180, "18px Arial", value.value);
                                                for (var j = 0; j < lines.length; ++j) {
                                                    ctx.fillText(lines[j], 512, 255 + 18 * j);
                                                }
                                            }
                                        }
                                        if (iCount == 1) {
                                            if (value.name == ('group-b[' + iCount + '][type]')) {
                                                ctx.fillText(value.value, 730, 190);
                                            }
                                            if (value.name == ('group-b[' + iCount + '][address]')) {
                                                var lines = split_lines(ctx, 180, "18px Arial", value.value);
                                                for (var j = 0; j < lines.length; ++j) {
                                                    ctx.fillText(lines[j], 730, 255 + 18 * j);
                                                }
                                            }
                                        }
                                        if (iCount == 2) {
                                            if (value.name == ('group-b[' + iCount + '][type]')) {
                                                ctx.fillText(value.value, 510, 375);
                                            }
                                            if (value.name == ('group-b[' + iCount + '][address]')) {
                                                var lines = split_lines(ctx, 180, "18px Arial", value.value);
                                                for (var j = 0; j < lines.length; ++j) {
                                                    ctx.fillText(lines[j], 510, 440 + 18 * j);
                                                }
                                            }
                                        }
                                        if (iCount == 3) {
                                            if (value.name == ('group-b[' + iCount + '][type]')) {
                                                ctx.fillText(value.value, 730, 375);
                                            }
                                            if (value.name == ('group-b[' + iCount + '][address]')) {
                                                var lines = split_lines(ctx, 180, "18px Arial", value.value);
                                                for (var j = 0; j < lines.length; ++j) {
                                                    ctx.fillText(lines[j], 730, 440 + 18 * j);
                                                }
                                            }
                                        }


                                        strTable = strTable + "<td>" + value.value + "</td>";
                                    });
                                    strTable = strTable + "</tr>";
                                    jQuery(".addresses-table-preview").html(strTable);
                                } else if (index == 'plans') {
                                    var strTable = "<tr>";
                                    jQuery.each(valueData, function (index, value) {
                                        var lines = split_lines(ctx, 850, "18px Arial", value.value);
                                        for (var j = 0; j < lines.length; ++j) {
                                            ctx.fillText(lines[j], 60, 1020 + 19 * j);
                                        }
                                        strTable = strTable + "<td>" + value.value + "</td>";
                                    });
                                    strTable = strTable + "</tr>";
                                    jQuery(".plans-table-preview").html(strTable);
                                }
                                var canvas = document.getElementById("emergency_card");
                                var imgData = canvas.toDataURL("image/png", 1.0);

                                document.getElementById("emergency_card_img").src = imgData;
                            });
                        };
                        img.src = 'assets/images/em_960.jpg';


                    });
                    jQuery("#go_back_top,#go_back_bottom").click(function () {
                        jQuery(".multi_form_wizard").show();
                        jQuery("#progressbar").show();
                        
                        jQuery('li[index="0"]').addClass('active');
                        jQuery('li[index="1"]').removeClass('active');
                        jQuery('li[index="1"]').addClass('non-active');
                        jQuery('li[index="2"]').removeClass('active');
                        jQuery('li[index="2"]').addClass('non-active');
                        jQuery('li[index="3"]').removeClass('active');
                        jQuery('li[index="3"]').addClass('non-active');

                        jQuery(".confirmation-review").hide();
                        jQuery("#steps-uid-0-t-0").click();
                    });
                    jQuery("#download_top,#download_bottom").click(function () {

                       /* var canvas = document.getElementById("emergency_card");
                        var imgData = canvas.toDataURL("image/jpeg", 1.0);
                        var pdf = new jsPDF('p', 'mm');
                        var width = pdf.internal.pageSize.width;
                        var height = pdf.internal.pageSize.height;
                        pdf.addImage(imgData, 'JPG', 0, 0, width, height);
                        debugger;
                        var pdfData = btoa(pdf.output());
                        jQuery.ajax({
                            type: "POST",
                            url: "https://mandrillapp.com/api/1.0/messages/send.json",
                            data: {
                                'key': 'o2DFojQBRFj71A665qf6Fg',

                                'message': {
                                    'from_email': 'info@nowprep.com',
                                    'to': [{
                                        'email': toEmail,
                                        'name': toName,
                                        'type': 'to'
                                    }],
                                    'autotext': 'true',
                                    'subject': 'NowPrep Emergency Pocket Pass',
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
                                alert("Email successfully sent.")
                            } else if (response[0].status == "error") {
                                alert(response[0].message);
                            } else if (response[0].status == "rejected") {
                                alert(response[0].reject_reason);
                            }

                        });*/

                        jQuery.ajax({
                            type: "POST",
                            url: "//nowprep.com/create-pass/mailchimp.php",
                            data: data
                        }).done(function(response) {
                            debugger;
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
                    //jQuery(this).mask('(999) 999-9999');
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
