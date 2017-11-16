<?php
    $additional_wizard_class = '';
    $additional_header_class = '';

    if ($title == 'Create New Page') {
        $additional_wizard_class = ' op-bsw-wizard-full';
        $additional_header_class = ' op-bsw-header-full';
    }
?>
<!— Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MWTD78J');</script>
<!-- End Google Tag Manager -->

<div class="op-bsw-wizard<?php echo $additional_wizard_class; ?>">
    <div class="op-bsw-content cf">
        <div class="op-bsw-header cf<?php echo $additional_header_class; ?>">
            <?php
                switch(strtolower($title)){
                    case 'launch suite':
                        $logo_file = 'launchsuite';
                        break;
                    case 'theme settings':
                        $logo_file = 'blogsettings';
                        break;
                    case 'dashboard': //Uncomment once we have the dashboard logo file in place
                        $logo_file = 'dashboard';
                        break;
                    default:
                        $logo_file = 'optimizepress';
                }
            ?>
            <?php
                $host = explode('/', str_replace(array('http://', 'https://'), '', $_SERVER['HTTP_HOST']));
                $img_path = str_replace(array('http://', 'https://', $host[0]), '', op_img('', true));
                if (!file_exists($_SERVER['DOCUMENT_ROOT'].$img_path.'logo-'.$logo_file.'.png')) $logo_file = 'optimizepress';
            ?>
            <div class="op-logo"><img src="<?php op_img() ?>logo-<?php echo $logo_file; ?>.png" alt="OptimizePress" height="50" class="animated flipInY" /></div>
            <ul>
                <li><a href="<?php echo OP_SUPPORT_LINK; ?>" target="_blank"><img src="<?php echo OP_IMG ?>live_editor/le_help_bg.png" onmouseover="this.src='<?php echo OP_IMG ?>live_editor/le_help_icon.png'" onmouseout="this.src='<?php echo OP_IMG ?>live_editor/le_help_bg.png'" alt="<?php _e('Help', 'optimizepress') ?>" class="tooltip animated pulse" title="<?php _e('Help', 'optimizepress') ?>" /></a></li>
                <?php
                    //wp_enqueue_script(OP_SN.'-tooltipster', OP_JS.'tooltipster.min.js', array(OP_SN.'-noconflict-js'), OP_VERSION);
                ?>
                    <script src='<?php echo OP_JS ?>tooltipster.min.js'></script>

                <script>
                    opjq(document).ready(function($) {
                        $('.tooltip').tooltipster({animation: 'grow'});
                    });
                </script>
            </ul>
        </div> <!-- end .op-bsw-header -->
