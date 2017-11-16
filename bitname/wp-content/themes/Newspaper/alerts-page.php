<?php
/**
 * Template Name: Alerts lists
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
                    $alerts = $wunderground->getAlertsFromDB();
                    ?>
                    <h3 style="text-align: center;">Alerts from wunderground.com</h3>
                    <table>
                        <thead>
                        <tr>
                            <td style="width: 5%;">Type</td>
                            <td style="width: 10%;">Description</td>
                            <td style="width: 15%;">Date</td>
                            <td style="width: 15%;">Expires</td>
                            <td style="width: 45%;">Message</td>
                            <td style="width: 10%;">Zipcodes</td>
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
                                        echo "<td><span class='short-message'>" . substr($alert->getMessage(),0,150) . " ... <a href='#' class='show-more'>More</a></span><span class='full-message'>" . $alert->getMessage() . " <a href='#' class='hide-more'>Less</a></span></td>";
                                        echo "<td>" . implode(',', $alert->getZipcodes()) . "</td>";
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
<script>
    jQuery(document).ready(function () {
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
    });
</script>
<?php
get_footer();