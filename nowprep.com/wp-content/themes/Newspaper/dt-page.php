<?php
/**
 * Template Name: Disaster Tools page template
 */

if (isset($_SERVER['HTTP_CF_VISITOR'])) {
    if (strpos($_SERVER['HTTP_CF_VISITOR'], 'https') === false) {
        wp_redirect('https://nowprep.com/threat-analyzer/');
        exit();
    }
}
?>
<!DOCTYPE html>
<html class="no-js no-svg">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <meta property="og:url" content="//nowprep.com/threat-analyzer/"/>
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

            <script type="text/javascript"
                    src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-599aa69458276182"></script>

            <script src="//nowprep.com/wp-includes/js/jquery/jquery.js?v=<?php echo time(); ?>"
                    type="application/javascript"></script>

            <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <script
                src="<?php echo str_replace('http://', 'https://', get_template_directory_uri()); ?>/assets/js/jquery.steps.js?v=<?php echo time(); ?>"
                type="text/javascript"></script>
            <script
                src="<?php echo str_replace('http://', 'https://', get_template_directory_uri()); ?>/assets/js/jquery.repeater.js?v=<?php echo time(); ?>"
                type="text/javascript"></script>
            <script
                src="<?php echo str_replace('http://', 'https://', get_template_directory_uri()); ?>/assets/js/jquery.validate.js?v=<?php echo time(); ?>"
                type="text/javascript"></script>
            <script
                src="<?php echo str_replace('http://', 'https://', get_template_directory_uri()); ?>/assets/js/additional-methods.js?v=<?php echo time(); ?>"
                type="text/javascript"></script>
            <script
                src="<?php echo str_replace('http://', 'https://', get_template_directory_uri()); ?>/assets/js/jquery.maskedinput.js?v=<?php echo time(); ?>"
                type="text/javascript"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
            <link
                href="<?php echo str_replace('http://', 'https://', get_template_directory_uri()); ?>/style.css?v=<?php echo time(); ?>"
                rel="stylesheet"
                type="text/css"/>
            <link
                href="<?php echo str_replace('http://', 'https://', get_template_directory_uri()); ?>/assets/css/style.css?v=<?php echo time(); ?>"
                rel="stylesheet"
                type="text/css"/>
            <link
                href="<?php echo str_replace('http://', 'https://', get_template_directory_uri()); ?>/assets/css/steps.css?v=<?php echo time(); ?>"
                rel="stylesheet"
                type="text/css"/>
            <link
                href="<?php echo str_replace('http://', 'https://', get_template_directory_uri()); ?>/assets/css/montserrat-webfont.css?v=<?php echo time(); ?>"
                rel="stylesheet"
                type="text/css"/>
            <!--link href="<?php echo get_template_directory_uri(); ?>/assets/css/styles.css" rel="stylesheet" type="text/css"/-->
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <?php
            $total_data_count = 0;
            if (isset($_POST['zipcode']))
                $zipcode = $_POST['zipcode'];
            else if (isset($_GET['zip']))
                $zipcode = $_GET['zip'];
            else $zipcode = "";

            if (isset($_POST['radius']))
                $radius = $_POST['radius'];
            else if (isset($_GET['radius']))
                $radius = $_GET['radius'];
            else $radius = 10;

            if (isset($_POST['date_start']))
                $date_start = $_POST['date_start'];
            else if (isset($_GET['date_start']))
                $date_start = $_GET['date_start'];
            else $date_start = date('m/01/Y');

            if (isset($_POST['date_end']))
                $date_end = $_POST['date_end'];
            else if (isset($_GET['date_end']))
                $date_end = $_GET['date_end'];
            else $date_end = date('m/t/Y');

            $zip_coord = array('longitude' => 0, 'latitude' => 0);

            ?>
            <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

            <script>
                var myLatlng = [];
                var coord = [];
            </script>
            <style>
                #map {
                    height: 600px;
                }

                table {
                    width: 100%;
                    font-size: 0.6em;
                }

                thead {
                    background: #eee;
                    font-weight: bold;
                }

                tr {
                    vertical-align: middle;
                }

                .full-message {
                    display: none;
                }

                .show-more, .hide-more {
                    text-transform: uppercase;
                    font-weight: bold;
                    color: #3c763d;
                }

                .total-data-items,
                .total-data {
                    color: red;
                    text-align: center;
                    font-weight: bold;
                }

                .loader {
                    display: none;
                    border: 16px solid #f3f3f3; /* Light grey */
                    border-top: 16px solid #3498db; /* Blue */
                    border-radius: 50%;
                    width: 120px;
                    height: 120px;
                    animation: spin 2s linear infinite;
                    margin: 10px auto;
                }

                @keyframes spin {
                    0% {
                        transform: rotate(0deg);
                    }
                    100% {
                        transform: rotate(360deg);
                    }
                }
                input {
                    height: 3em !important;
					margin-bottom: 0px !important;
                }
                div.td-container {
                    padding: 10px;
                    background: #dddddd;
border-radius: 10px;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
                }
				
            </style>
            <div class="td-container" style="color: black;">
                <div id="primary" class="content-area" style=" position: relative;">
                    <div id="demo" style="margin-top: 10px;"></div>
                    <main id="main" class="site-main" role="main">
                        <br><br>
                        <form id="search" action="/threat-analyzer/" method="post" style="float: right; text-align: right; position: absolute; top: 0px; right: 0px;">
                            <Label style="display: inline-block;">ZIP Code: </Label>
                            <input style="width: 100px;display: inline-block;" type="text" name="zipcode"
                                   pattern="[0-9]{5}"
                                   title="Five digit zip code"
                                   value="<?php echo $zipcode; ?>"/><br>
                            <Label style="display: inline-block;">Radius in miles: </Label>
                            <input style="width: 100px;display: inline-block;" type="number" name="radius"
                                   min="0" max="100" step="0.5"
                                   value="<?php echo $radius; ?>"/><br>
                            <Label style="display: inline-block;">Date start: </Label>
                            <input type="text" id="date_start"
                                 name="date_start"
                                 style="width: 100px;display: inline-block;"
                                 value="<?php echo $date_start; ?>"><br>
                            <Label style="display: inline-block;">Date end: </Label>
                            <input type="text" id="date_end"
                               name="date_end"
                               style="width: 100px;display: inline-block;"
                               value="<?php echo $date_end; ?>"><br>
                            <input type="submit">
                        </form>
                        <br><br>
                        <div class="loader"></div>
                        <div class="loaded-data-st1">
                        </div>
                        <div class="loaded-data-st2">
                        </div>
                    </main><!-- #main -->
                </div><!-- #primary -->
            </div><!-- .wrap -->
            <script>

                jQuery("#search").submit(function (event) {
                    jQuery('.loaded-data-st1').empty();
                    jQuery('.loaded-data-st2').empty();
                    jQuery('.loader').show();
                    event.preventDefault();
                    var form = jQuery(this);

                    var serializedData = jQuery(form).serialize();
                    var serializedDataST1 = serializedData + "&st=1";
                    jQuery("#search :input").attr("disabled", "disabled");
                    jQuery.ajax({
                        url: "<?php echo str_replace('http://', 'https://', get_template_directory_uri()); ?>/wrapper/function_aj.php",
                        type: "POST",
                        datatype: "html",
                        data: serializedDataST1,
                        timeout: 60000
                    }).done(function (response, textStatus, jqXHR) {
                        jQuery('.loaded-data-st1').append(response);
                        jQuery('.loader').hide();
                        jQuery('.loader').show();
                        var serializedDataST2 = serializedData + "&st=2";
                        jQuery.ajax({
                            url: "<?php echo str_replace('http://', 'https://', get_template_directory_uri()); ?>/wrapper/function_aj.php",
                            type: "POST",
                            datatype: "html",
                            data: serializedDataST2,
                            timeout: 60000
                        }).done(function (response, textStatus, jqXHR) {
                            jQuery('.loaded-data-st2').append(response);
                        }).fail(function (jqXHR, textStatus, errorThrown) {
                            jQuery('.loader').hide();
                            jQuery("#search :input").removeAttr("disabled");
                        }).always(function () {
                            jQuery('.loader').hide();
                            jQuery("#search :input").removeAttr("disabled");
                        });
                    }).fail(function (jqXHR, textStatus, errorThrown) {
                        jQuery('.loader').hide();
                        jQuery("#search :input").removeAttr("disabled");
                    }).always(function () {
                    });

                });

                function initMap() {
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 8,
                        center: {lat: parseFloat(coord.latitude), lng: parseFloat(coord.longitude)},
                        mapTypeId: 'terrain'
                    });

                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function (position) {
                            var pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };
//                            debugger;
//                            infoWindow.setPosition(pos);
//                            infoWindow.setContent('Location found.');
//                            infoWindow.open(map);
//                            map.setCenter(pos);
                        }, function () {
                        });
                    } else {
                    }

                    var cityCircle = new google.maps.Circle({
                        strokeColor: '#0000FF',
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: '#0000FF',
                        fillOpacity: 0.35,
                        map: map,
                        center: {lat: parseFloat(coord.latitude), lng: parseFloat(coord.longitude)},
                        radius: 2 * 1609.34
                    });

                    for (var mark in myLatlng) {
                        var cityCircle = new google.maps.Circle({
                            strokeColor: '#00FF00',
                            strokeOpacity: 0.8,
                            strokeWeight: 2,
                            fillColor: '#00FF00',
                            fillOpacity: 0.35,
                            map: map,
                            center: {lat: myLatlng[mark].coord[1], lng: myLatlng[mark].coord[0]},
                            radius: myLatlng[mark].coord[2] * 1609.34
                        });

                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(myLatlng[mark].coord[1], myLatlng[mark].coord[0]),
                            title: myLatlng[mark].title
                        });
                        marker.setMap(map);
                    }

                }
                jQuery(document).ready(function () {

                    jQuery("#date_start").datepicker({gotoCurrent: true});
                    jQuery("#date_end").datepicker({gotoCurrent: true});

                    jQuery(".show-more").click(function () {
                        jQuery(this).parent().hide();
                        jQuery(this).parent().parent().find('.full-message').each(function () {
                            jQuery(this).show();
                        })
                    });
                    jQuery(".hide-more").click(function () {
                        jQuery(this).parent().hide();
                        jQuery(this).parent().parent().find('.short-message').each(function () {
                            jQuery(this).show();
                        })
                    });
                    jQuery(".total-data").text(<?php echo $total_data_count;?>+" Total Incidences");
                    getLocation();

                });
            </script>
            <script>
                var x = document.getElementById("demo");
                function getLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showPosition);
                    } else {
                        x.innerHTML = "Geolocation is not supported by this browser.";
                    }
                }
                function showPosition(position) {
                    jQuery('.loader').show();
                    var requestData = jQuery.ajax({
                        url: "https://maps.googleapis.com/maps/api/geocode/json?latlng="+position.coords.latitude+","+position.coords.longitude+"&sensor=true",
                        type: "GET"
                    });

                    requestData.done(function (response, textStatus, jqXHR) {
                        response.results.forEach(function(item, index, arr){
                            var addressCurrent = item.formatted_address;
                            //debugger;
                            if(index == 0) {
                                var addressCountry = "";
                                var addressLevel1 = "";
                                var addressLevel2 = "";
                                var addressLocality = "";
                                var addressRoute = "";
                                var addressStreetNumber = "";
                                var addressPostalCode = "";

                                item.address_components.forEach(function(item, index, arr){
                                    if(jQuery.inArray("country",item.types) != -1) {
                                        addressCountry = item.short_name;
                                    } else if(jQuery.inArray("administrative_area_level_1",item.types) != -1) {
                                        addressLevel1 = item.short_name;
                                    } else if(jQuery.inArray("administrative_area_level_2",item.types) != -1) {
                                        addressLevel2 = item.short_name;
                                    } else if(jQuery.inArray("locality",item.types) != -1) {
                                        addressLocality = item.short_name;
                                    } else if(jQuery.inArray("postal_code",item.types) != -1) {
                                        addressPostalCode = item.short_name;
                                        jQuery("input[name='zipcode']").val(addressPostalCode);
                                    } else if(jQuery.inArray("route",item.types) != -1) {
                                        addressRoute = item.short_name;
                                    } else if(jQuery.inArray("street_number",item.types) != -1) {
                                        addressStreetNumber = item.short_name;
                                    }
                                });
                                if(addressCurrent.length != 0) {
                                    addressCurrent = addressRoute + ", " + addressStreetNumber + ", " + addressLocality + ", " + addressLevel2 + ", " + addressCountry;
                                }
                                jQuery("#demo").html("Current position: " + addressCurrent);
                                jQuery('.loader').hide();
                                jQuery("#search :input").removeAttr("disabled");
                                jQuery("#search").submit();
                            }
                        });
                    });

                    requestData.fail(function (jqXHR, textStatus, errorThrown) {
                        jQuery('.loader').hide();
                        jQuery("#search :input").removeAttr("disabled");
                    });
                }
            </script>
            <script async defer
                    src="//maps.googleapis.com/maps/api/js?key=AIzaSyAu2K7RRO_gYzm6ZorcdrTZNNWUXwDrDL0&callback=initMap">
            </script>
        </div><!-- #content -->
        <footer id="colophon" class="site-footer" role="contentinfo">
            <div class="wrap">
            </div><!-- .wrap -->
        </footer><!-- #colophon -->
    </div><!-- .site-content-contain -->
</div><!-- #page -->
</body>
</html>