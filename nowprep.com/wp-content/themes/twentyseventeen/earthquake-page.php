<?php
/**
 * Template Name: Earthquake lists
 */

get_header();
?>

    <style>
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

    </style>
    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <?php
                    $wunderground = new WunderGround();
                    $eqs = $wunderground->getEarthquakeFromDB();
                    ?>
                    <h3 style="text-align: center;">Earthquake from usgs.com</h3>
                    <table>
                        <thead>
                        <tr>
                            <td style="width: 10%;">Time</td>
                            <td style="width: 35%;">Title</td>
                            <td style="width: 5%;">Magnitude</td>
                            <td style="width: 30%;">Address</td>
                            <td style="width: 20%;">Zipcodes</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (is_array($eqs)) {
                            foreach ($eqs as $eq) {
                                if (is_object($eq)) {
                                    //var_dump($eq->getTimes());die();
                                    //var_dump($eq);die();
                                    ?>
                                    <tr>
                                        <?php
                                        echo "<td>" . $eq->getTimes() . "</td>";
                                        echo "<td>" . $eq->getTitle() . "</td>";
                                        echo "<td>" . $eq->getMag() . "</td>";
                                        echo "<td>" . $eq->getAddress() . "</td>";
                                        echo "<td>" . implode(', ', $eq->getZipcode()) . "</td>";
                                        ?>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                        ?>
                        </tbody>
                    </table>
            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .wrap -->
<?php
get_footer();