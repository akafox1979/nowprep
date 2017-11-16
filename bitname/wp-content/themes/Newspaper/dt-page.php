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
            else $radius = 0;

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
                    vertical-align: top;
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
                }
                div.td-container {
                    padding: 10px;
                    background: #eeeeee;
                }
            </style>
            <div class="td-container">
                <div id="primary" class="content-area">
                    <div id="demo" style="margin-top: 10px;"></div>
                    <main id="main" class="site-main" role="main">
                        <br><br>
                        <form id="search" action="/threat-analyzer/" method="post">
                            <Label style="display: inline-block;">ZIP Code: </Label>
                            <input style="width: 40%;display: inline-block;" type="text" name="zipcode"
                                   pattern="[0-9]{5}"
                                   title="Five digit zip code"
                                   value="<?php echo $zipcode; ?>"/>
                            <Label style="display: inline-block;">Radius in miles: </Label>
                            <input style="width: 10%;display: inline-block;" type="number" name="radius"
                                   min="0" max="100" step="0.5"
                                   value="<?php echo $radius; ?>"/><br><br>
                            <Label style="display: inline-block;">Date start: </Label><input type="text" id="date_start"
                                                                                             name="date_start"
                                                                                             style="width: 20%;display: inline-block;"
                                                                                             value="<?php echo $date_start; ?>">
                            <Label style="display: inline-block;">Date end: </Label><input type="text" id="date_end"
                                                                                           name="date_end"
                                                                                           style="width: 20%;display: inline-block;"
                                                                                           value="<?php echo $date_end; ?>">
                            <input type="submit">
                        </form>
                        <br><br>
                        <div class="loader"></div>
                        <div class="loaded-data">
                            <?php
                            if (!empty($zipcode)) {
                                $wunderground = new WunderGround();
                                $zip_coord = $wunderground->getCoordByZip($zipcode);
                                $zip_info = $wunderground->getInfoByZip($zipcode);

                                echo "County - " . $zip_info['county_name'] . "<br>";
                                echo "State - " . $zip_info['state_name'] . " (" . $zip_info['state_code'] . ")" . "<br>";
                                ?>

                                <br><br>
                                <h1 class="total-data"></h1>
                                <br>
                                <div id="map"></div>
                                <!--img
                        src="//api.wunderground.com/api/cb1edad023dd52f0/radar/q/<?php //echo $zipcode; ?>.gif?width=960&height=280&newmaps=1&timelabel=1&radius=<?php //echo $radius;?>"/-->
                                <br>
                                <?php
                                $eqs = $wunderground->getEarthquakeFromDBByZip($zipcode, $radius, $date_start, $date_end);
                                if (count($eqs) > 0) {
                                    ?>
                                    <h3 style="text-align: center;">Earthquake from usgs.com <span
                                            class="total-data-items">(<?php echo count($eqs); ?> Earthquakes)</span>
                                    </h3>
                                    <table>
                                        <thead>
                                        <tr>
                                            <td style="width: 30%;">Time</td>
                                            <td style="width: 65%;">Title</td>
                                            <td style="width: 5%;">Magnitude</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (is_array($eqs)) {
                                            $markers_array = array();
                                        foreach ($eqs as $eq) {
                                        if (is_object($eq)) {
                                            $total_data_count++;
                                            array_push($markers_array, array('title' => $eq->getTitle(), 'coord' => $eq->getCoordinates()));
                                            ?>
                                            <tr>
                                                <?php
                                                echo "<td>" . $eq->getTimes() . "</td>";
                                                echo "<td>" . $eq->getTitle() . "</td>";
                                                echo "<td>" . $eq->getMag() . "</td>";
                                                ?>
                                            </tr>
                                        <?php
                                        }
                                        }
                                        ?>
                                            <script>
                                                myLatlng = <?php echo json_encode($markers_array);?>;
                                            </script>
                                            <?php
                                        }

                                        ?>
                                        </tbody>
                                    </table>
                                    <br><br>
                                    <?php
                                }
                                $alerts = $wunderground->getAlertsFromDBByZip($zipcode, $radius, $date_start, $date_end);
                                if (count($alerts) > 0) {
                                    ?>
                                    <h3 style="text-align: center;">Alerts from wunderground.com <span
                                            class="total-data-items">(<?php echo count($alerts); ?> Alerts)</span></h3>
                                    <table>
                                        <thead>
                                        <tr>
                                            <td style="width: 5%;">Type</td>
                                            <td style="width: 10%;">Description</td>
                                            <td style="width: 15%;">Date</td>
                                            <td style="width: 15%;">Expires</td>
                                            <td style="width: 55%;">Message</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (is_array($alerts)) {
                                            foreach ($alerts as $alert) {
                                                if (is_object($alert)) {
                                                    $total_data_count++; ?>
                                                    <tr>
                                                        <?php
                                                        echo "<td>" . $alert->getType() . "</td>";
                                                        echo "<td>" . $alert->getTypeDescription() . "</td>";
                                                        echo "<td>" . $alert->getDate() . "</td>";
                                                        echo "<td>" . $alert->getExpires() . "</td>";
                                                        echo "<td><span class='short-message'>" . substr($alert->getMessage(), 0, 150) . " ... <a href='#' class='show-more'>More</a></span><span class='full-message'>" . $alert->getMessage() . " <a href='#' class='hide-more'>Less</a></span></td>";
                                                        ?>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <br><br>
                                    <?php
                                }
                                $disasterTypes = $wunderground->getDisasterTypesByZip($zipcode);
                                foreach ($disasterTypes as $disasterType) {
                                    $disasters = $wunderground->getDisastersByType($disasterType, $zipcode, $radius, $date_start, $date_end);
                                    if (count($disasters) > 0) {
                                        ?>
                                        <h3 style="text-align: center;"><?php echo $disasterType; ?> <span
                                                class="total-data-items">(<?php echo count($disasters); ?> <?php echo $disasterType; ?>
                                                )</span></h3>
                                        <table>
                                            <thead>
                                            <tr>
                                                <td style="width: 10%;">Incident Type</td>
                                                <td style="width: 30%;">Title</td>
                                                <td style="width: 20%;">County</td>
                                                <td style="width: 20%;">Incident Begin Date</td>
                                                <td style="width: 20%;">Incident End Date</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if ($disasters != null) {
                                                foreach ($disasters as $disaster) {
                                                    if (is_object($disaster)) {
                                                        $total_data_count++;
                                                        ?>
                                                        <tr>
                                                            <?php
                                                            echo "<td>" . $disaster->getIncidentType() . "</td>";
                                                            echo "<td>" . $disaster->getTitle() . "</td>";
                                                            echo "<td>" . $disaster->getDeclaredCountyArea() . "</td>";
                                                            echo "<td>" . $disaster->getIncidentBeginDate() . "</td>";
                                                            echo "<td>" . $disaster->getIncidentEndDate() . "</td>";
                                                            ?>
                                                        </tr>
                                                        <?php
                                                    } else {
                                                        echo "Error: " . $disasters['error_msg'] . "<br>";
                                                        break;
                                                    }
                                                }
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <br><br>
                                        <?php
                                    }
                                }
                                ?>
                                <?php
                                $alerts = array();
                                $disasters = array();
                            }
                            ?>
                        </div>
                    </main><!-- #main -->
                </div><!-- #primary -->
            </div><!-- .wrap -->
            <script>

                jQuery("#search").submit(function (event) {
                    jQuery('.loaded-data').empty();
                    jQuery('.loader').show();
                    event.preventDefault();
                    var form = jQuery(this);

                    var serializedData = jQuery(form).serialize();
                    jQuery("#search :input").attr("disabled", "disabled");
                    var request = jQuery.ajax({
                        url: "<?php echo str_replace('http://', 'https://', get_template_directory_uri()); ?>/wrapper/function_aj.php",
                        type: "POST",
                        datatype: "html",
                        data: serializedData
                    });

                    request.done(function (response, textStatus, jqXHR) {
                        debugger;
                        jQuery('.loaded-data').append(response);
                        initMap();
                    });

                    request.fail(function (jqXHR, textStatus, errorThrown) {
                        debugger;
                    });

                    request.always(function () {
                        debugger;
                        jQuery('.loader').hide();
                        jQuery("#search :input").removeAttr("disabled");
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
                            debugger;
                            infoWindow.setPosition(pos);
                            infoWindow.setContent('Location found.');
                            infoWindow.open(map);
                            map.setCenter(pos);
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
