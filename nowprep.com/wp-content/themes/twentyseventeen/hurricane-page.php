<?php
/**
 * Template Name: Current Hurricane lists
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
                    $eqs = $wunderground->getHurricanesFromDB();
                    ?>
                    <h3 style="text-align: center;">Current Hurricanes & Storms from wunderground.com</h3>
                    <table>
                        <thead>
                        <tr>
                            <td style="width: 8%;">Number</td>
                            <td style="width: 10%;">Type</td>
                            <td style="width: 8%;">Name</td>
                            <td style="width: 54%;">Movement</td>
                            <td style="width: 20%;">Legend</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (is_array($eqs)) {
                            foreach (array_reverse($eqs) as $eq) {
                                if (is_object($eq)) {
                                    if(!$eq->getActiveFlag()) continue;
                                    ?>
                                    <tr style="<?php echo ($eq->getActiveFlag() ? '' : 'background-color: #eee;opacity: 0.45;');?>">
                                        <?php
                                        echo "<td>" . $eq->getStormNumber() . "</td>";
                                        echo "<td>" . $eq->getObject()->{'Current'}->{'Category'} . "</td>";
                                        echo "<td>" . $eq->getStormName() . "</td>";
                                        echo "<td>" . "<img src='".$eq->getCurrentPositionImageUrl()."'/>" . "</td>";
                                        echo "<td>" . $eq->getMovementLegend(). "</td>";
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