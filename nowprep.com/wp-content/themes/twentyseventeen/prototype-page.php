<?php
/**
 * Template Name: Prototype
 */

get_header();
?>

    <style>
        body {
            width: 960px;
            margin: 0 auto;
        }

        table {
            width: 100%;
        }

        thead {
            background: #eee;
        }

        tr {
            vertical-align: top;
        }
    </style>
    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <form action="/" method="post">
                    <Label>ZIP Code</Label><input type="text" name="zipcode" pattern="[0-9]{5}"
                                                  title="Five digit zip code"
                                                  value="<?php echo $_POST['zipcode']; ?>"/>
                    <input type="submit">
                </form>

                <?php
                $zipcode = $_POST['zipcode'];
                if (!empty($zipcode)) {
                    $wunderground = new WunderGround();
                    $weather = $wunderground->getWeatherFromZipCode($zipcode);
                    $alerts = $wunderground->getAlertsFromZipCode($zipcode);
                    $state = $wunderground->getStateByZip($zipcode);
                    $county = $wunderground->getCountyByZip($zipcode);

                    $disasters = null;
                    echo "ZipCode: " . $zipcode . "<br>";
                    if (is_array($state)) {
                        echo "Error: " . $state['error_msg'] . "<br>";
                    } else {
                        echo "State By ZipCode: " . $state . "<br>";
                        if (!empty($county)) {
                            echo "County By ZipCode: " . $county . "<br>";
                            $disasters = $wunderground->getDisastersFromCounty($county, $zipcode);
                        } else
                            $disasters = $wunderground->getDisastersFromState($state, $zipcode);
                    }

                    if (is_array($weather)) {
                        echo "Error: " . $weather['error_msg'] . "<br>";
                    } else {
                        echo "Current Temp in F: " . $weather->getTemp_F() . "<br>";
                    }
                    ?>
                    <br><br>
                    <img
                        src="http://api.wunderground.com/api/cb1edad023dd52f0/radar/q/<?php echo $zipcode; ?>.gif?width=960&height=280&newmaps=1&timelabel=1"/>
                    <br><br>
                    Alerts by zipcode from wunderground.com
                    <br><br>
                    <table>
                        <thead>
                        <tr>
                            <td style="width: 10%;">Type</td>
                            <td style="width: 15%;">Type Description</td>
                            <td style="width: 15%;">Date</td>
                            <td style="width: 15%;">Expires</td>
                            <td style="width: 45%;">Message</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (is_array($alerts)) {
                            foreach ($alerts as $alert) {
                                if (is_object($alert)) { ?>
                                    <tr>
                                        <?php
                                        echo "<td>" . $alert->getType() . "</td>";
                                        echo "<td>" . $alert->getTypeDescription() . "</td>";
                                        echo "<td>" . $alert->getDate() . "</td>";
                                        echo "<td>" . $alert->getExpires() . "</td>";
                                        echo "<td>" . $alert->getMessage() . "</td>";
                                        ?>
                                    </tr>
                                    <?php
                                } else {
                                    echo "Error: " . $alerts['error_msg'] . "<br>";
                                    break;
                                }
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    <br><br>
                    Historical Disaster Declarations by <?php echo(empty($county) ? 'state' : 'county'); ?> from Fema.gov
                    <br><br>
                    <?php

                    ?>
                    <table>
                        <thead>
                        <tr>
                            <td style="width: 15%;">Disaster Type</td>
                            <td style="width: 15%;">Incident Type</td>
                            <td style="width: 30%;">Title</td>
                            <td style="width: 20%;">Incident Begin Date</td>
                            <td style="width: 20%;">Incident End Date</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($disasters != null) {
                            foreach (array_reverse($disasters) as $disaster) {
                                if (is_object($disaster)) {
                                    ?>
                                    <tr>
                                        <?php
                                        echo "<td>" . $disaster->getType() . "</td>";
                                        echo "<td>" . $disaster->getIncidentType() . "</td>";
                                        echo "<td>" . $disaster->getTitle() . "</td>";
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
                    <?php
                    $alerts = array();
                    $disasters = array();
                }
                ?>
            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .wrap -->

<?php
get_footer();