<?php
/**
 * Template Name: Emergency Contact Card TEST page template
 */

if(isset($_SERVER['HTTP_CF_VISITOR'])) {
    if(strpos($_SERVER['HTTP_CF_VISITOR'], 'https') === false) {
        wp_redirect('https://nowprep.com/emergency-contact-card-test/');
        exit();
    }
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=320, user-scalable=no">
    <title>NowPrep</title>
    <link rel="stylesheet" href="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/css/custom.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/css/bootstrap.css?v=<?php echo time(); ?>">
    <!--link href="<?php echo '';//str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/css/progressbar.css" rel="stylesheet" type="text/css"-->
    <!--link rel="stylesheet" href="//fontawesome.io/assets/font-awesome/css/font-awesome.css"-->

    <script src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/js/jquery.min.js"></script>
    <script src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/js/jquery.maskedinput.js?v=<?php echo time(); ?>" type="text/javascript"></script>
    <script src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/js/bootstrap.min.js"></script>
    <script src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/js/jquery.validate.js?v=<?php echo time(); ?>" type="text/javascript"></script>
    <script src="<?php echo  str_replace('http://','https://',get_template_directory_uri()); ?>/assets/js/additional-methods.js?v=<?php echo time(); ?>" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js" type="text/javascript"></script>
</head>
<body>
<style>
    .template-index {}

    .template-contact,
    .template-generate,
    .template-download,
    .template-sales,
    .template-upsell {
        display: none;
    }

    label.error {
        display: none !important;
    }
    input.error {
        border: 2px solid #8a1f11;
        color: #8a1f11;
    }
    .payment-success {
        display: none;
    }

    .payment-errors {
        display: none;
        color: red;
    }
    .form-textsec input {
        border: none;
        line-height: 42px;
        background: transparent !important;
    }
    input {
        font-size: 20px !important;
    }

    span.mainphone,
    span.mailborder,
    span.nameborder {
        width: 80%;
    }
    span.mainphone {
        margin-right: 0px;
    }
    /*!
 *  Font Awesome 4.7.0 by @davegandy - http://fontawesome.io - @fontawesome
 *  License - http://fontawesome.io/license (Font: SIL OFL 1.1, CSS: MIT License)
 */
    /* FONT PATH
     * -------------------------- */
    @font-face {
        font-family: 'FontAwesome';
        src: url('<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/fonts/fontawesome-webfont.eot?v=4.7.0');
        src: url('<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/fonts/fontawesome-webfont.eot?#iefix&v=4.7.0') format('embedded-opentype'), url('<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/fonts/fontawesome-webfont.woff2?v=4.7.0') format('woff2'), url('<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/fonts/fontawesome-webfont.woff?v=4.7.0') format('woff'), url('<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/fonts/fontawesome-webfont.ttf?v=4.7.0') format('truetype'), url('<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/fonts/fontawesome-webfont.svg?v=4.7.0#fontawesomeregular') format('svg');
        font-weight: normal;
        font-style: normal;
    }
    .fa {
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    /* makes the font 33% larger relative to the icon container */
    .fa-lg {
        font-size: 1.33333333em;
        line-height: 0.75em;
        vertical-align: -15%;
    }
    .fa-2x {
        font-size: 2em;
    }
    .fa-3x {
        font-size: 3em;
    }
    .fa-4x {
        font-size: 4em;
    }
    .fa-5x {
        font-size: 5em;
    }
    .fa-fw {
        width: 1.28571429em;
        text-align: center;
    }
    .fa-ul {
        padding-left: 0;
        margin-left: 2.14285714em;
        list-style-type: none;
    }
    .fa-ul > li {
        position: relative;
    }
    .fa-li {
        position: absolute;
        left: -2.14285714em;
        width: 2.14285714em;
        top: 0.14285714em;
        text-align: center;
    }
    .fa-li.fa-lg {
        left: -1.85714286em;
    }
    .fa-border {
        padding: .2em .25em .15em;
        border: solid 0.08em #eeeeee;
        border-radius: .1em;
    }
    .fa-pull-left {
        float: left;
    }
    .fa-pull-right {
        float: right;
    }
    .fa.fa-pull-left {
        margin-right: .3em;
    }
    .fa.fa-pull-right {
        margin-left: .3em;
    }
    /* Deprecated as of 4.4.0 */
    .pull-right {
        float: right;
    }
    .pull-left {
        float: left;
    }
    .fa.pull-left {
        margin-right: .3em;
    }
    .fa.pull-right {
        margin-left: .3em;
    }
    .fa-spin {
        -webkit-animation: fa-spin 2s infinite linear;
        animation: fa-spin 2s infinite linear;
    }
    .fa-pulse {
        -webkit-animation: fa-spin 1s infinite steps(8);
        animation: fa-spin 1s infinite steps(8);
    }
    @-webkit-keyframes fa-spin {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(359deg);
            transform: rotate(359deg);
        }
    }
    @keyframes fa-spin {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(359deg);
            transform: rotate(359deg);
        }
    }
    .fa-rotate-90 {
        -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=1)";
        -webkit-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        transform: rotate(90deg);
    }
    .fa-rotate-180 {
        -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=2)";
        -webkit-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        transform: rotate(180deg);
    }
    .fa-rotate-270 {
        -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=3)";
        -webkit-transform: rotate(270deg);
        -ms-transform: rotate(270deg);
        transform: rotate(270deg);
    }
    .fa-flip-horizontal {
        -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1)";
        -webkit-transform: scale(-1, 1);
        -ms-transform: scale(-1, 1);
        transform: scale(-1, 1);
    }
    .fa-flip-vertical {
        -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=2, mirror=1)";
        -webkit-transform: scale(1, -1);
        -ms-transform: scale(1, -1);
        transform: scale(1, -1);
    }
    :root .fa-rotate-90,
    :root .fa-rotate-180,
    :root .fa-rotate-270,
    :root .fa-flip-horizontal,
    :root .fa-flip-vertical {
        filter: none;
    }
    .fa-stack {
        position: relative;
        display: inline-block;
        width: 2em;
        height: 2em;
        line-height: 2em;
        vertical-align: middle;
    }
    .fa-stack-1x,
    .fa-stack-2x {
        position: absolute;
        left: 0;
        width: 100%;
        text-align: center;
    }
    .fa-stack-1x {
        line-height: inherit;
    }
    .fa-stack-2x {
        font-size: 2em;
    }
    .fa-inverse {
        color: #ffffff;
    }
    /* Font Awesome uses the Unicode Private Use Area (PUA) to ensure screen
       readers do not read off random characters that represent icons */
    .fa-glass:before {
        content: "\f000";
    }
    .fa-music:before {
        content: "\f001";
    }
    .fa-search:before {
        content: "\f002";
    }
    .fa-envelope-o:before {
        content: "\f003";
    }
    .fa-heart:before {
        content: "\f004";
    }
    .fa-star:before {
        content: "\f005";
    }
    .fa-star-o:before {
        content: "\f006";
    }
    .fa-user:before {
        content: "\f007";
    }
    .fa-film:before {
        content: "\f008";
    }
    .fa-th-large:before {
        content: "\f009";
    }
    .fa-th:before {
        content: "\f00a";
    }
    .fa-th-list:before {
        content: "\f00b";
    }
    .fa-check:before {
        content: "\f00c";
    }
    .fa-remove:before,
    .fa-close:before,
    .fa-times:before {
        content: "\f00d";
    }
    .fa-search-plus:before {
        content: "\f00e";
    }
    .fa-search-minus:before {
        content: "\f010";
    }
    .fa-power-off:before {
        content: "\f011";
    }
    .fa-signal:before {
        content: "\f012";
    }
    .fa-gear:before,
    .fa-cog:before {
        content: "\f013";
    }
    .fa-trash-o:before {
        content: "\f014";
    }
    .fa-home:before {
        content: "\f015";
    }
    .fa-file-o:before {
        content: "\f016";
    }
    .fa-clock-o:before {
        content: "\f017";
    }
    .fa-road:before {
        content: "\f018";
    }
    .fa-download:before {
        content: "\f019";
    }
    .fa-arrow-circle-o-down:before {
        content: "\f01a";
    }
    .fa-arrow-circle-o-up:before {
        content: "\f01b";
    }
    .fa-inbox:before {
        content: "\f01c";
    }
    .fa-play-circle-o:before {
        content: "\f01d";
    }
    .fa-rotate-right:before,
    .fa-repeat:before {
        content: "\f01e";
    }
    .fa-refresh:before {
        content: "\f021";
    }
    .fa-list-alt:before {
        content: "\f022";
    }
    .fa-lock:before {
        content: "\f023";
    }
    .fa-flag:before {
        content: "\f024";
    }
    .fa-headphones:before {
        content: "\f025";
    }
    .fa-volume-off:before {
        content: "\f026";
    }
    .fa-volume-down:before {
        content: "\f027";
    }
    .fa-volume-up:before {
        content: "\f028";
    }
    .fa-qrcode:before {
        content: "\f029";
    }
    .fa-barcode:before {
        content: "\f02a";
    }
    .fa-tag:before {
        content: "\f02b";
    }
    .fa-tags:before {
        content: "\f02c";
    }
    .fa-book:before {
        content: "\f02d";
    }
    .fa-bookmark:before {
        content: "\f02e";
    }
    .fa-print:before {
        content: "\f02f";
    }
    .fa-camera:before {
        content: "\f030";
    }
    .fa-font:before {
        content: "\f031";
    }
    .fa-bold:before {
        content: "\f032";
    }
    .fa-italic:before {
        content: "\f033";
    }
    .fa-text-height:before {
        content: "\f034";
    }
    .fa-text-width:before {
        content: "\f035";
    }
    .fa-align-left:before {
        content: "\f036";
    }
    .fa-align-center:before {
        content: "\f037";
    }
    .fa-align-right:before {
        content: "\f038";
    }
    .fa-align-justify:before {
        content: "\f039";
    }
    .fa-list:before {
        content: "\f03a";
    }
    .fa-dedent:before,
    .fa-outdent:before {
        content: "\f03b";
    }
    .fa-indent:before {
        content: "\f03c";
    }
    .fa-video-camera:before {
        content: "\f03d";
    }
    .fa-photo:before,
    .fa-image:before,
    .fa-picture-o:before {
        content: "\f03e";
    }
    .fa-pencil:before {
        content: "\f040";
    }
    .fa-map-marker:before {
        content: "\f041";
    }
    .fa-adjust:before {
        content: "\f042";
    }
    .fa-tint:before {
        content: "\f043";
    }
    .fa-edit:before,
    .fa-pencil-square-o:before {
        content: "\f044";
    }
    .fa-share-square-o:before {
        content: "\f045";
    }
    .fa-check-square-o:before {
        content: "\f046";
    }
    .fa-arrows:before {
        content: "\f047";
    }
    .fa-step-backward:before {
        content: "\f048";
    }
    .fa-fast-backward:before {
        content: "\f049";
    }
    .fa-backward:before {
        content: "\f04a";
    }
    .fa-play:before {
        content: "\f04b";
    }
    .fa-pause:before {
        content: "\f04c";
    }
    .fa-stop:before {
        content: "\f04d";
    }
    .fa-forward:before {
        content: "\f04e";
    }
    .fa-fast-forward:before {
        content: "\f050";
    }
    .fa-step-forward:before {
        content: "\f051";
    }
    .fa-eject:before {
        content: "\f052";
    }
    .fa-chevron-left:before {
        content: "\f053";
    }
    .fa-chevron-right:before {
        content: "\f054";
    }
    .fa-plus-circle:before {
        content: "\f055";
    }
    .fa-minus-circle:before {
        content: "\f056";
    }
    .fa-times-circle:before {
        content: "\f057";
    }
    .fa-check-circle:before {
        content: "\f058";
    }
    .fa-question-circle:before {
        content: "\f059";
    }
    .fa-info-circle:before {
        content: "\f05a";
    }
    .fa-crosshairs:before {
        content: "\f05b";
    }
    .fa-times-circle-o:before {
        content: "\f05c";
    }
    .fa-check-circle-o:before {
        content: "\f05d";
    }
    .fa-ban:before {
        content: "\f05e";
    }
    .fa-arrow-left:before {
        content: "\f060";
    }
    .fa-arrow-right:before {
        content: "\f061";
    }
    .fa-arrow-up:before {
        content: "\f062";
    }
    .fa-arrow-down:before {
        content: "\f063";
    }
    .fa-mail-forward:before,
    .fa-share:before {
        content: "\f064";
    }
    .fa-expand:before {
        content: "\f065";
    }
    .fa-compress:before {
        content: "\f066";
    }
    .fa-plus:before {
        content: "\f067";
    }
    .fa-minus:before {
        content: "\f068";
    }
    .fa-asterisk:before {
        content: "\f069";
    }
    .fa-exclamation-circle:before {
        content: "\f06a";
    }
    .fa-gift:before {
        content: "\f06b";
    }
    .fa-leaf:before {
        content: "\f06c";
    }
    .fa-fire:before {
        content: "\f06d";
    }
    .fa-eye:before {
        content: "\f06e";
    }
    .fa-eye-slash:before {
        content: "\f070";
    }
    .fa-warning:before,
    .fa-exclamation-triangle:before {
        content: "\f071";
    }
    .fa-plane:before {
        content: "\f072";
    }
    .fa-calendar:before {
        content: "\f073";
    }
    .fa-random:before {
        content: "\f074";
    }
    .fa-comment:before {
        content: "\f075";
    }
    .fa-magnet:before {
        content: "\f076";
    }
    .fa-chevron-up:before {
        content: "\f077";
    }
    .fa-chevron-down:before {
        content: "\f078";
    }
    .fa-retweet:before {
        content: "\f079";
    }
    .fa-shopping-cart:before {
        content: "\f07a";
    }
    .fa-folder:before {
        content: "\f07b";
    }
    .fa-folder-open:before {
        content: "\f07c";
    }
    .fa-arrows-v:before {
        content: "\f07d";
    }
    .fa-arrows-h:before {
        content: "\f07e";
    }
    .fa-bar-chart-o:before,
    .fa-bar-chart:before {
        content: "\f080";
    }
    .fa-twitter-square:before {
        content: "\f081";
    }
    .fa-facebook-square:before {
        content: "\f082";
    }
    .fa-camera-retro:before {
        content: "\f083";
    }
    .fa-key:before {
        content: "\f084";
    }
    .fa-gears:before,
    .fa-cogs:before {
        content: "\f085";
    }
    .fa-comments:before {
        content: "\f086";
    }
    .fa-thumbs-o-up:before {
        content: "\f087";
    }
    .fa-thumbs-o-down:before {
        content: "\f088";
    }
    .fa-star-half:before {
        content: "\f089";
    }
    .fa-heart-o:before {
        content: "\f08a";
    }
    .fa-sign-out:before {
        content: "\f08b";
    }
    .fa-linkedin-square:before {
        content: "\f08c";
    }
    .fa-thumb-tack:before {
        content: "\f08d";
    }
    .fa-external-link:before {
        content: "\f08e";
    }
    .fa-sign-in:before {
        content: "\f090";
    }
    .fa-trophy:before {
        content: "\f091";
    }
    .fa-github-square:before {
        content: "\f092";
    }
    .fa-upload:before {
        content: "\f093";
    }
    .fa-lemon-o:before {
        content: "\f094";
    }
    .fa-phone:before {
        content: "\f095";
    }
    .fa-square-o:before {
        content: "\f096";
    }
    .fa-bookmark-o:before {
        content: "\f097";
    }
    .fa-phone-square:before {
        content: "\f098";
    }
    .fa-twitter:before {
        content: "\f099";
    }
    .fa-facebook-f:before,
    .fa-facebook:before {
        content: "\f09a";
    }
    .fa-github:before {
        content: "\f09b";
    }
    .fa-unlock:before {
        content: "\f09c";
    }
    .fa-credit-card:before {
        content: "\f09d";
    }
    .fa-feed:before,
    .fa-rss:before {
        content: "\f09e";
    }
    .fa-hdd-o:before {
        content: "\f0a0";
    }
    .fa-bullhorn:before {
        content: "\f0a1";
    }
    .fa-bell:before {
        content: "\f0f3";
    }
    .fa-certificate:before {
        content: "\f0a3";
    }
    .fa-hand-o-right:before {
        content: "\f0a4";
    }
    .fa-hand-o-left:before {
        content: "\f0a5";
    }
    .fa-hand-o-up:before {
        content: "\f0a6";
    }
    .fa-hand-o-down:before {
        content: "\f0a7";
    }
    .fa-arrow-circle-left:before {
        content: "\f0a8";
    }
    .fa-arrow-circle-right:before {
        content: "\f0a9";
    }
    .fa-arrow-circle-up:before {
        content: "\f0aa";
    }
    .fa-arrow-circle-down:before {
        content: "\f0ab";
    }
    .fa-globe:before {
        content: "\f0ac";
    }
    .fa-wrench:before {
        content: "\f0ad";
    }
    .fa-tasks:before {
        content: "\f0ae";
    }
    .fa-filter:before {
        content: "\f0b0";
    }
    .fa-briefcase:before {
        content: "\f0b1";
    }
    .fa-arrows-alt:before {
        content: "\f0b2";
    }
    .fa-group:before,
    .fa-users:before {
        content: "\f0c0";
    }
    .fa-chain:before,
    .fa-link:before {
        content: "\f0c1";
    }
    .fa-cloud:before {
        content: "\f0c2";
    }
    .fa-flask:before {
        content: "\f0c3";
    }
    .fa-cut:before,
    .fa-scissors:before {
        content: "\f0c4";
    }
    .fa-copy:before,
    .fa-files-o:before {
        content: "\f0c5";
    }
    .fa-paperclip:before {
        content: "\f0c6";
    }
    .fa-save:before,
    .fa-floppy-o:before {
        content: "\f0c7";
    }
    .fa-square:before {
        content: "\f0c8";
    }
    .fa-navicon:before,
    .fa-reorder:before,
    .fa-bars:before {
        content: "\f0c9";
    }
    .fa-list-ul:before {
        content: "\f0ca";
    }
    .fa-list-ol:before {
        content: "\f0cb";
    }
    .fa-strikethrough:before {
        content: "\f0cc";
    }
    .fa-underline:before {
        content: "\f0cd";
    }
    .fa-table:before {
        content: "\f0ce";
    }
    .fa-magic:before {
        content: "\f0d0";
    }
    .fa-truck:before {
        content: "\f0d1";
    }
    .fa-pinterest:before {
        content: "\f0d2";
    }
    .fa-pinterest-square:before {
        content: "\f0d3";
    }
    .fa-google-plus-square:before {
        content: "\f0d4";
    }
    .fa-google-plus:before {
        content: "\f0d5";
    }
    .fa-money:before {
        content: "\f0d6";
    }
    .fa-caret-down:before {
        content: "\f0d7";
    }
    .fa-caret-up:before {
        content: "\f0d8";
    }
    .fa-caret-left:before {
        content: "\f0d9";
    }
    .fa-caret-right:before {
        content: "\f0da";
    }
    .fa-columns:before {
        content: "\f0db";
    }
    .fa-unsorted:before,
    .fa-sort:before {
        content: "\f0dc";
    }
    .fa-sort-down:before,
    .fa-sort-desc:before {
        content: "\f0dd";
    }
    .fa-sort-up:before,
    .fa-sort-asc:before {
        content: "\f0de";
    }
    .fa-envelope:before {
        content: "\f0e0";
    }
    .fa-linkedin:before {
        content: "\f0e1";
    }
    .fa-rotate-left:before,
    .fa-undo:before {
        content: "\f0e2";
    }
    .fa-legal:before,
    .fa-gavel:before {
        content: "\f0e3";
    }
    .fa-dashboard:before,
    .fa-tachometer:before {
        content: "\f0e4";
    }
    .fa-comment-o:before {
        content: "\f0e5";
    }
    .fa-comments-o:before {
        content: "\f0e6";
    }
    .fa-flash:before,
    .fa-bolt:before {
        content: "\f0e7";
    }
    .fa-sitemap:before {
        content: "\f0e8";
    }
    .fa-umbrella:before {
        content: "\f0e9";
    }
    .fa-paste:before,
    .fa-clipboard:before {
        content: "\f0ea";
    }
    .fa-lightbulb-o:before {
        content: "\f0eb";
    }
    .fa-exchange:before {
        content: "\f0ec";
    }
    .fa-cloud-download:before {
        content: "\f0ed";
    }
    .fa-cloud-upload:before {
        content: "\f0ee";
    }
    .fa-user-md:before {
        content: "\f0f0";
    }
    .fa-stethoscope:before {
        content: "\f0f1";
    }
    .fa-suitcase:before {
        content: "\f0f2";
    }
    .fa-bell-o:before {
        content: "\f0a2";
    }
    .fa-coffee:before {
        content: "\f0f4";
    }
    .fa-cutlery:before {
        content: "\f0f5";
    }
    .fa-file-text-o:before {
        content: "\f0f6";
    }
    .fa-building-o:before {
        content: "\f0f7";
    }
    .fa-hospital-o:before {
        content: "\f0f8";
    }
    .fa-ambulance:before {
        content: "\f0f9";
    }
    .fa-medkit:before {
        content: "\f0fa";
    }
    .fa-fighter-jet:before {
        content: "\f0fb";
    }
    .fa-beer:before {
        content: "\f0fc";
    }
    .fa-h-square:before {
        content: "\f0fd";
    }
    .fa-plus-square:before {
        content: "\f0fe";
    }
    .fa-angle-double-left:before {
        content: "\f100";
    }
    .fa-angle-double-right:before {
        content: "\f101";
    }
    .fa-angle-double-up:before {
        content: "\f102";
    }
    .fa-angle-double-down:before {
        content: "\f103";
    }
    .fa-angle-left:before {
        content: "\f104";
    }
    .fa-angle-right:before {
        content: "\f105";
    }
    .fa-angle-up:before {
        content: "\f106";
    }
    .fa-angle-down:before {
        content: "\f107";
    }
    .fa-desktop:before {
        content: "\f108";
    }
    .fa-laptop:before {
        content: "\f109";
    }
    .fa-tablet:before {
        content: "\f10a";
    }
    .fa-mobile-phone:before,
    .fa-mobile:before {
        content: "\f10b";
    }
    .fa-circle-o:before {
        content: "\f10c";
    }
    .fa-quote-left:before {
        content: "\f10d";
    }
    .fa-quote-right:before {
        content: "\f10e";
    }
    .fa-spinner:before {
        content: "\f110";
    }
    .fa-circle:before {
        content: "\f111";
    }
    .fa-mail-reply:before,
    .fa-reply:before {
        content: "\f112";
    }
    .fa-github-alt:before {
        content: "\f113";
    }
    .fa-folder-o:before {
        content: "\f114";
    }
    .fa-folder-open-o:before {
        content: "\f115";
    }
    .fa-smile-o:before {
        content: "\f118";
    }
    .fa-frown-o:before {
        content: "\f119";
    }
    .fa-meh-o:before {
        content: "\f11a";
    }
    .fa-gamepad:before {
        content: "\f11b";
    }
    .fa-keyboard-o:before {
        content: "\f11c";
    }
    .fa-flag-o:before {
        content: "\f11d";
    }
    .fa-flag-checkered:before {
        content: "\f11e";
    }
    .fa-terminal:before {
        content: "\f120";
    }
    .fa-code:before {
        content: "\f121";
    }
    .fa-mail-reply-all:before,
    .fa-reply-all:before {
        content: "\f122";
    }
    .fa-star-half-empty:before,
    .fa-star-half-full:before,
    .fa-star-half-o:before {
        content: "\f123";
    }
    .fa-location-arrow:before {
        content: "\f124";
    }
    .fa-crop:before {
        content: "\f125";
    }
    .fa-code-fork:before {
        content: "\f126";
    }
    .fa-unlink:before,
    .fa-chain-broken:before {
        content: "\f127";
    }
    .fa-question:before {
        content: "\f128";
    }
    .fa-info:before {
        content: "\f129";
    }
    .fa-exclamation:before {
        content: "\f12a";
    }
    .fa-superscript:before {
        content: "\f12b";
    }
    .fa-subscript:before {
        content: "\f12c";
    }
    .fa-eraser:before {
        content: "\f12d";
    }
    .fa-puzzle-piece:before {
        content: "\f12e";
    }
    .fa-microphone:before {
        content: "\f130";
    }
    .fa-microphone-slash:before {
        content: "\f131";
    }
    .fa-shield:before {
        content: "\f132";
    }
    .fa-calendar-o:before {
        content: "\f133";
    }
    .fa-fire-extinguisher:before {
        content: "\f134";
    }
    .fa-rocket:before {
        content: "\f135";
    }
    .fa-maxcdn:before {
        content: "\f136";
    }
    .fa-chevron-circle-left:before {
        content: "\f137";
    }
    .fa-chevron-circle-right:before {
        content: "\f138";
    }
    .fa-chevron-circle-up:before {
        content: "\f139";
    }
    .fa-chevron-circle-down:before {
        content: "\f13a";
    }
    .fa-html5:before {
        content: "\f13b";
    }
    .fa-css3:before {
        content: "\f13c";
    }
    .fa-anchor:before {
        content: "\f13d";
    }
    .fa-unlock-alt:before {
        content: "\f13e";
    }
    .fa-bullseye:before {
        content: "\f140";
    }
    .fa-ellipsis-h:before {
        content: "\f141";
    }
    .fa-ellipsis-v:before {
        content: "\f142";
    }
    .fa-rss-square:before {
        content: "\f143";
    }
    .fa-play-circle:before {
        content: "\f144";
    }
    .fa-ticket:before {
        content: "\f145";
    }
    .fa-minus-square:before {
        content: "\f146";
    }
    .fa-minus-square-o:before {
        content: "\f147";
    }
    .fa-level-up:before {
        content: "\f148";
    }
    .fa-level-down:before {
        content: "\f149";
    }
    .fa-check-square:before {
        content: "\f14a";
    }
    .fa-pencil-square:before {
        content: "\f14b";
    }
    .fa-external-link-square:before {
        content: "\f14c";
    }
    .fa-share-square:before {
        content: "\f14d";
    }
    .fa-compass:before {
        content: "\f14e";
    }
    .fa-toggle-down:before,
    .fa-caret-square-o-down:before {
        content: "\f150";
    }
    .fa-toggle-up:before,
    .fa-caret-square-o-up:before {
        content: "\f151";
    }
    .fa-toggle-right:before,
    .fa-caret-square-o-right:before {
        content: "\f152";
    }
    .fa-euro:before,
    .fa-eur:before {
        content: "\f153";
    }
    .fa-gbp:before {
        content: "\f154";
    }
    .fa-dollar:before,
    .fa-usd:before {
        content: "\f155";
    }
    .fa-rupee:before,
    .fa-inr:before {
        content: "\f156";
    }
    .fa-cny:before,
    .fa-rmb:before,
    .fa-yen:before,
    .fa-jpy:before {
        content: "\f157";
    }
    .fa-ruble:before,
    .fa-rouble:before,
    .fa-rub:before {
        content: "\f158";
    }
    .fa-won:before,
    .fa-krw:before {
        content: "\f159";
    }
    .fa-bitcoin:before,
    .fa-btc:before {
        content: "\f15a";
    }
    .fa-file:before {
        content: "\f15b";
    }
    .fa-file-text:before {
        content: "\f15c";
    }
    .fa-sort-alpha-asc:before {
        content: "\f15d";
    }
    .fa-sort-alpha-desc:before {
        content: "\f15e";
    }
    .fa-sort-amount-asc:before {
        content: "\f160";
    }
    .fa-sort-amount-desc:before {
        content: "\f161";
    }
    .fa-sort-numeric-asc:before {
        content: "\f162";
    }
    .fa-sort-numeric-desc:before {
        content: "\f163";
    }
    .fa-thumbs-up:before {
        content: "\f164";
    }
    .fa-thumbs-down:before {
        content: "\f165";
    }
    .fa-youtube-square:before {
        content: "\f166";
    }
    .fa-youtube:before {
        content: "\f167";
    }
    .fa-xing:before {
        content: "\f168";
    }
    .fa-xing-square:before {
        content: "\f169";
    }
    .fa-youtube-play:before {
        content: "\f16a";
    }
    .fa-dropbox:before {
        content: "\f16b";
    }
    .fa-stack-overflow:before {
        content: "\f16c";
    }
    .fa-instagram:before {
        content: "\f16d";
    }
    .fa-flickr:before {
        content: "\f16e";
    }
    .fa-adn:before {
        content: "\f170";
    }
    .fa-bitbucket:before {
        content: "\f171";
    }
    .fa-bitbucket-square:before {
        content: "\f172";
    }
    .fa-tumblr:before {
        content: "\f173";
    }
    .fa-tumblr-square:before {
        content: "\f174";
    }
    .fa-long-arrow-down:before {
        content: "\f175";
    }
    .fa-long-arrow-up:before {
        content: "\f176";
    }
    .fa-long-arrow-left:before {
        content: "\f177";
    }
    .fa-long-arrow-right:before {
        content: "\f178";
    }
    .fa-apple:before {
        content: "\f179";
    }
    .fa-windows:before {
        content: "\f17a";
    }
    .fa-android:before {
        content: "\f17b";
    }
    .fa-linux:before {
        content: "\f17c";
    }
    .fa-dribbble:before {
        content: "\f17d";
    }
    .fa-skype:before {
        content: "\f17e";
    }
    .fa-foursquare:before {
        content: "\f180";
    }
    .fa-trello:before {
        content: "\f181";
    }
    .fa-female:before {
        content: "\f182";
    }
    .fa-male:before {
        content: "\f183";
    }
    .fa-gittip:before,
    .fa-gratipay:before {
        content: "\f184";
    }
    .fa-sun-o:before {
        content: "\f185";
    }
    .fa-moon-o:before {
        content: "\f186";
    }
    .fa-archive:before {
        content: "\f187";
    }
    .fa-bug:before {
        content: "\f188";
    }
    .fa-vk:before {
        content: "\f189";
    }
    .fa-weibo:before {
        content: "\f18a";
    }
    .fa-renren:before {
        content: "\f18b";
    }
    .fa-pagelines:before {
        content: "\f18c";
    }
    .fa-stack-exchange:before {
        content: "\f18d";
    }
    .fa-arrow-circle-o-right:before {
        content: "\f18e";
    }
    .fa-arrow-circle-o-left:before {
        content: "\f190";
    }
    .fa-toggle-left:before,
    .fa-caret-square-o-left:before {
        content: "\f191";
    }
    .fa-dot-circle-o:before {
        content: "\f192";
    }
    .fa-wheelchair:before {
        content: "\f193";
    }
    .fa-vimeo-square:before {
        content: "\f194";
    }
    .fa-turkish-lira:before,
    .fa-try:before {
        content: "\f195";
    }
    .fa-plus-square-o:before {
        content: "\f196";
    }
    .fa-space-shuttle:before {
        content: "\f197";
    }
    .fa-slack:before {
        content: "\f198";
    }
    .fa-envelope-square:before {
        content: "\f199";
    }
    .fa-wordpress:before {
        content: "\f19a";
    }
    .fa-openid:before {
        content: "\f19b";
    }
    .fa-institution:before,
    .fa-bank:before,
    .fa-university:before {
        content: "\f19c";
    }
    .fa-mortar-board:before,
    .fa-graduation-cap:before {
        content: "\f19d";
    }
    .fa-yahoo:before {
        content: "\f19e";
    }
    .fa-google:before {
        content: "\f1a0";
    }
    .fa-reddit:before {
        content: "\f1a1";
    }
    .fa-reddit-square:before {
        content: "\f1a2";
    }
    .fa-stumbleupon-circle:before {
        content: "\f1a3";
    }
    .fa-stumbleupon:before {
        content: "\f1a4";
    }
    .fa-delicious:before {
        content: "\f1a5";
    }
    .fa-digg:before {
        content: "\f1a6";
    }
    .fa-pied-piper-pp:before {
        content: "\f1a7";
    }
    .fa-pied-piper-alt:before {
        content: "\f1a8";
    }
    .fa-drupal:before {
        content: "\f1a9";
    }
    .fa-joomla:before {
        content: "\f1aa";
    }
    .fa-language:before {
        content: "\f1ab";
    }
    .fa-fax:before {
        content: "\f1ac";
    }
    .fa-building:before {
        content: "\f1ad";
    }
    .fa-child:before {
        content: "\f1ae";
    }
    .fa-paw:before {
        content: "\f1b0";
    }
    .fa-spoon:before {
        content: "\f1b1";
    }
    .fa-cube:before {
        content: "\f1b2";
    }
    .fa-cubes:before {
        content: "\f1b3";
    }
    .fa-behance:before {
        content: "\f1b4";
    }
    .fa-behance-square:before {
        content: "\f1b5";
    }
    .fa-steam:before {
        content: "\f1b6";
    }
    .fa-steam-square:before {
        content: "\f1b7";
    }
    .fa-recycle:before {
        content: "\f1b8";
    }
    .fa-automobile:before,
    .fa-car:before {
        content: "\f1b9";
    }
    .fa-cab:before,
    .fa-taxi:before {
        content: "\f1ba";
    }
    .fa-tree:before {
        content: "\f1bb";
    }
    .fa-spotify:before {
        content: "\f1bc";
    }
    .fa-deviantart:before {
        content: "\f1bd";
    }
    .fa-soundcloud:before {
        content: "\f1be";
    }
    .fa-database:before {
        content: "\f1c0";
    }
    .fa-file-pdf-o:before {
        content: "\f1c1";
    }
    .fa-file-word-o:before {
        content: "\f1c2";
    }
    .fa-file-excel-o:before {
        content: "\f1c3";
    }
    .fa-file-powerpoint-o:before {
        content: "\f1c4";
    }
    .fa-file-photo-o:before,
    .fa-file-picture-o:before,
    .fa-file-image-o:before {
        content: "\f1c5";
    }
    .fa-file-zip-o:before,
    .fa-file-archive-o:before {
        content: "\f1c6";
    }
    .fa-file-sound-o:before,
    .fa-file-audio-o:before {
        content: "\f1c7";
    }
    .fa-file-movie-o:before,
    .fa-file-video-o:before {
        content: "\f1c8";
    }
    .fa-file-code-o:before {
        content: "\f1c9";
    }
    .fa-vine:before {
        content: "\f1ca";
    }
    .fa-codepen:before {
        content: "\f1cb";
    }
    .fa-jsfiddle:before {
        content: "\f1cc";
    }
    .fa-life-bouy:before,
    .fa-life-buoy:before,
    .fa-life-saver:before,
    .fa-support:before,
    .fa-life-ring:before {
        content: "\f1cd";
    }
    .fa-circle-o-notch:before {
        content: "\f1ce";
    }
    .fa-ra:before,
    .fa-resistance:before,
    .fa-rebel:before {
        content: "\f1d0";
    }
    .fa-ge:before,
    .fa-empire:before {
        content: "\f1d1";
    }
    .fa-git-square:before {
        content: "\f1d2";
    }
    .fa-git:before {
        content: "\f1d3";
    }
    .fa-y-combinator-square:before,
    .fa-yc-square:before,
    .fa-hacker-news:before {
        content: "\f1d4";
    }
    .fa-tencent-weibo:before {
        content: "\f1d5";
    }
    .fa-qq:before {
        content: "\f1d6";
    }
    .fa-wechat:before,
    .fa-weixin:before {
        content: "\f1d7";
    }
    .fa-send:before,
    .fa-paper-plane:before {
        content: "\f1d8";
    }
    .fa-send-o:before,
    .fa-paper-plane-o:before {
        content: "\f1d9";
    }
    .fa-history:before {
        content: "\f1da";
    }
    .fa-circle-thin:before {
        content: "\f1db";
    }
    .fa-header:before {
        content: "\f1dc";
    }
    .fa-paragraph:before {
        content: "\f1dd";
    }
    .fa-sliders:before {
        content: "\f1de";
    }
    .fa-share-alt:before {
        content: "\f1e0";
    }
    .fa-share-alt-square:before {
        content: "\f1e1";
    }
    .fa-bomb:before {
        content: "\f1e2";
    }
    .fa-soccer-ball-o:before,
    .fa-futbol-o:before {
        content: "\f1e3";
    }
    .fa-tty:before {
        content: "\f1e4";
    }
    .fa-binoculars:before {
        content: "\f1e5";
    }
    .fa-plug:before {
        content: "\f1e6";
    }
    .fa-slideshare:before {
        content: "\f1e7";
    }
    .fa-twitch:before {
        content: "\f1e8";
    }
    .fa-yelp:before {
        content: "\f1e9";
    }
    .fa-newspaper-o:before {
        content: "\f1ea";
    }
    .fa-wifi:before {
        content: "\f1eb";
    }
    .fa-calculator:before {
        content: "\f1ec";
    }
    .fa-paypal:before {
        content: "\f1ed";
    }
    .fa-google-wallet:before {
        content: "\f1ee";
    }
    .fa-cc-visa:before {
        content: "\f1f0";
    }
    .fa-cc-mastercard:before {
        content: "\f1f1";
    }
    .fa-cc-discover:before {
        content: "\f1f2";
    }
    .fa-cc-amex:before {
        content: "\f1f3";
    }
    .fa-cc-paypal:before {
        content: "\f1f4";
    }
    .fa-cc-stripe:before {
        content: "\f1f5";
    }
    .fa-bell-slash:before {
        content: "\f1f6";
    }
    .fa-bell-slash-o:before {
        content: "\f1f7";
    }
    .fa-trash:before {
        content: "\f1f8";
    }
    .fa-copyright:before {
        content: "\f1f9";
    }
    .fa-at:before {
        content: "\f1fa";
    }
    .fa-eyedropper:before {
        content: "\f1fb";
    }
    .fa-paint-brush:before {
        content: "\f1fc";
    }
    .fa-birthday-cake:before {
        content: "\f1fd";
    }
    .fa-area-chart:before {
        content: "\f1fe";
    }
    .fa-pie-chart:before {
        content: "\f200";
    }
    .fa-line-chart:before {
        content: "\f201";
    }
    .fa-lastfm:before {
        content: "\f202";
    }
    .fa-lastfm-square:before {
        content: "\f203";
    }
    .fa-toggle-off:before {
        content: "\f204";
    }
    .fa-toggle-on:before {
        content: "\f205";
    }
    .fa-bicycle:before {
        content: "\f206";
    }
    .fa-bus:before {
        content: "\f207";
    }
    .fa-ioxhost:before {
        content: "\f208";
    }
    .fa-angellist:before {
        content: "\f209";
    }
    .fa-cc:before {
        content: "\f20a";
    }
    .fa-shekel:before,
    .fa-sheqel:before,
    .fa-ils:before {
        content: "\f20b";
    }
    .fa-meanpath:before {
        content: "\f20c";
    }
    .fa-buysellads:before {
        content: "\f20d";
    }
    .fa-connectdevelop:before {
        content: "\f20e";
    }
    .fa-dashcube:before {
        content: "\f210";
    }
    .fa-forumbee:before {
        content: "\f211";
    }
    .fa-leanpub:before {
        content: "\f212";
    }
    .fa-sellsy:before {
        content: "\f213";
    }
    .fa-shirtsinbulk:before {
        content: "\f214";
    }
    .fa-simplybuilt:before {
        content: "\f215";
    }
    .fa-skyatlas:before {
        content: "\f216";
    }
    .fa-cart-plus:before {
        content: "\f217";
    }
    .fa-cart-arrow-down:before {
        content: "\f218";
    }
    .fa-diamond:before {
        content: "\f219";
    }
    .fa-ship:before {
        content: "\f21a";
    }
    .fa-user-secret:before {
        content: "\f21b";
    }
    .fa-motorcycle:before {
        content: "\f21c";
    }
    .fa-street-view:before {
        content: "\f21d";
    }
    .fa-heartbeat:before {
        content: "\f21e";
    }
    .fa-venus:before {
        content: "\f221";
    }
    .fa-mars:before {
        content: "\f222";
    }
    .fa-mercury:before {
        content: "\f223";
    }
    .fa-intersex:before,
    .fa-transgender:before {
        content: "\f224";
    }
    .fa-transgender-alt:before {
        content: "\f225";
    }
    .fa-venus-double:before {
        content: "\f226";
    }
    .fa-mars-double:before {
        content: "\f227";
    }
    .fa-venus-mars:before {
        content: "\f228";
    }
    .fa-mars-stroke:before {
        content: "\f229";
    }
    .fa-mars-stroke-v:before {
        content: "\f22a";
    }
    .fa-mars-stroke-h:before {
        content: "\f22b";
    }
    .fa-neuter:before {
        content: "\f22c";
    }
    .fa-genderless:before {
        content: "\f22d";
    }
    .fa-facebook-official:before {
        content: "\f230";
    }
    .fa-pinterest-p:before {
        content: "\f231";
    }
    .fa-whatsapp:before {
        content: "\f232";
    }
    .fa-server:before {
        content: "\f233";
    }
    .fa-user-plus:before {
        content: "\f234";
    }
    .fa-user-times:before {
        content: "\f235";
    }
    .fa-hotel:before,
    .fa-bed:before {
        content: "\f236";
    }
    .fa-viacoin:before {
        content: "\f237";
    }
    .fa-train:before {
        content: "\f238";
    }
    .fa-subway:before {
        content: "\f239";
    }
    .fa-medium:before {
        content: "\f23a";
    }
    .fa-yc:before,
    .fa-y-combinator:before {
        content: "\f23b";
    }
    .fa-optin-monster:before {
        content: "\f23c";
    }
    .fa-opencart:before {
        content: "\f23d";
    }
    .fa-expeditedssl:before {
        content: "\f23e";
    }
    .fa-battery-4:before,
    .fa-battery:before,
    .fa-battery-full:before {
        content: "\f240";
    }
    .fa-battery-3:before,
    .fa-battery-three-quarters:before {
        content: "\f241";
    }
    .fa-battery-2:before,
    .fa-battery-half:before {
        content: "\f242";
    }
    .fa-battery-1:before,
    .fa-battery-quarter:before {
        content: "\f243";
    }
    .fa-battery-0:before,
    .fa-battery-empty:before {
        content: "\f244";
    }
    .fa-mouse-pointer:before {
        content: "\f245";
    }
    .fa-i-cursor:before {
        content: "\f246";
    }
    .fa-object-group:before {
        content: "\f247";
    }
    .fa-object-ungroup:before {
        content: "\f248";
    }
    .fa-sticky-note:before {
        content: "\f249";
    }
    .fa-sticky-note-o:before {
        content: "\f24a";
    }
    .fa-cc-jcb:before {
        content: "\f24b";
    }
    .fa-cc-diners-club:before {
        content: "\f24c";
    }
    .fa-clone:before {
        content: "\f24d";
    }
    .fa-balance-scale:before {
        content: "\f24e";
    }
    .fa-hourglass-o:before {
        content: "\f250";
    }
    .fa-hourglass-1:before,
    .fa-hourglass-start:before {
        content: "\f251";
    }
    .fa-hourglass-2:before,
    .fa-hourglass-half:before {
        content: "\f252";
    }
    .fa-hourglass-3:before,
    .fa-hourglass-end:before {
        content: "\f253";
    }
    .fa-hourglass:before {
        content: "\f254";
    }
    .fa-hand-grab-o:before,
    .fa-hand-rock-o:before {
        content: "\f255";
    }
    .fa-hand-stop-o:before,
    .fa-hand-paper-o:before {
        content: "\f256";
    }
    .fa-hand-scissors-o:before {
        content: "\f257";
    }
    .fa-hand-lizard-o:before {
        content: "\f258";
    }
    .fa-hand-spock-o:before {
        content: "\f259";
    }
    .fa-hand-pointer-o:before {
        content: "\f25a";
    }
    .fa-hand-peace-o:before {
        content: "\f25b";
    }
    .fa-trademark:before {
        content: "\f25c";
    }
    .fa-registered:before {
        content: "\f25d";
    }
    .fa-creative-commons:before {
        content: "\f25e";
    }
    .fa-gg:before {
        content: "\f260";
    }
    .fa-gg-circle:before {
        content: "\f261";
    }
    .fa-tripadvisor:before {
        content: "\f262";
    }
    .fa-odnoklassniki:before {
        content: "\f263";
    }
    .fa-odnoklassniki-square:before {
        content: "\f264";
    }
    .fa-get-pocket:before {
        content: "\f265";
    }
    .fa-wikipedia-w:before {
        content: "\f266";
    }
    .fa-safari:before {
        content: "\f267";
    }
    .fa-chrome:before {
        content: "\f268";
    }
    .fa-firefox:before {
        content: "\f269";
    }
    .fa-opera:before {
        content: "\f26a";
    }
    .fa-internet-explorer:before {
        content: "\f26b";
    }
    .fa-tv:before,
    .fa-television:before {
        content: "\f26c";
    }
    .fa-contao:before {
        content: "\f26d";
    }
    .fa-500px:before {
        content: "\f26e";
    }
    .fa-amazon:before {
        content: "\f270";
    }
    .fa-calendar-plus-o:before {
        content: "\f271";
    }
    .fa-calendar-minus-o:before {
        content: "\f272";
    }
    .fa-calendar-times-o:before {
        content: "\f273";
    }
    .fa-calendar-check-o:before {
        content: "\f274";
    }
    .fa-industry:before {
        content: "\f275";
    }
    .fa-map-pin:before {
        content: "\f276";
    }
    .fa-map-signs:before {
        content: "\f277";
    }
    .fa-map-o:before {
        content: "\f278";
    }
    .fa-map:before {
        content: "\f279";
    }
    .fa-commenting:before {
        content: "\f27a";
    }
    .fa-commenting-o:before {
        content: "\f27b";
    }
    .fa-houzz:before {
        content: "\f27c";
    }
    .fa-vimeo:before {
        content: "\f27d";
    }
    .fa-black-tie:before {
        content: "\f27e";
    }
    .fa-fonticons:before {
        content: "\f280";
    }
    .fa-reddit-alien:before {
        content: "\f281";
    }
    .fa-edge:before {
        content: "\f282";
    }
    .fa-credit-card-alt:before {
        content: "\f283";
    }
    .fa-codiepie:before {
        content: "\f284";
    }
    .fa-modx:before {
        content: "\f285";
    }
    .fa-fort-awesome:before {
        content: "\f286";
    }
    .fa-usb:before {
        content: "\f287";
    }
    .fa-product-hunt:before {
        content: "\f288";
    }
    .fa-mixcloud:before {
        content: "\f289";
    }
    .fa-scribd:before {
        content: "\f28a";
    }
    .fa-pause-circle:before {
        content: "\f28b";
    }
    .fa-pause-circle-o:before {
        content: "\f28c";
    }
    .fa-stop-circle:before {
        content: "\f28d";
    }
    .fa-stop-circle-o:before {
        content: "\f28e";
    }
    .fa-shopping-bag:before {
        content: "\f290";
    }
    .fa-shopping-basket:before {
        content: "\f291";
    }
    .fa-hashtag:before {
        content: "\f292";
    }
    .fa-bluetooth:before {
        content: "\f293";
    }
    .fa-bluetooth-b:before {
        content: "\f294";
    }
    .fa-percent:before {
        content: "\f295";
    }
    .fa-gitlab:before {
        content: "\f296";
    }
    .fa-wpbeginner:before {
        content: "\f297";
    }
    .fa-wpforms:before {
        content: "\f298";
    }
    .fa-envira:before {
        content: "\f299";
    }
    .fa-universal-access:before {
        content: "\f29a";
    }
    .fa-wheelchair-alt:before {
        content: "\f29b";
    }
    .fa-question-circle-o:before {
        content: "\f29c";
    }
    .fa-blind:before {
        content: "\f29d";
    }
    .fa-audio-description:before {
        content: "\f29e";
    }
    .fa-volume-control-phone:before {
        content: "\f2a0";
    }
    .fa-braille:before {
        content: "\f2a1";
    }
    .fa-assistive-listening-systems:before {
        content: "\f2a2";
    }
    .fa-asl-interpreting:before,
    .fa-american-sign-language-interpreting:before {
        content: "\f2a3";
    }
    .fa-deafness:before,
    .fa-hard-of-hearing:before,
    .fa-deaf:before {
        content: "\f2a4";
    }
    .fa-glide:before {
        content: "\f2a5";
    }
    .fa-glide-g:before {
        content: "\f2a6";
    }
    .fa-signing:before,
    .fa-sign-language:before {
        content: "\f2a7";
    }
    .fa-low-vision:before {
        content: "\f2a8";
    }
    .fa-viadeo:before {
        content: "\f2a9";
    }
    .fa-viadeo-square:before {
        content: "\f2aa";
    }
    .fa-snapchat:before {
        content: "\f2ab";
    }
    .fa-snapchat-ghost:before {
        content: "\f2ac";
    }
    .fa-snapchat-square:before {
        content: "\f2ad";
    }
    .fa-pied-piper:before {
        content: "\f2ae";
    }
    .fa-first-order:before {
        content: "\f2b0";
    }
    .fa-yoast:before {
        content: "\f2b1";
    }
    .fa-themeisle:before {
        content: "\f2b2";
    }
    .fa-google-plus-circle:before,
    .fa-google-plus-official:before {
        content: "\f2b3";
    }
    .fa-fa:before,
    .fa-font-awesome:before {
        content: "\f2b4";
    }
    .fa-handshake-o:before {
        content: "\f2b5";
    }
    .fa-envelope-open:before {
        content: "\f2b6";
    }
    .fa-envelope-open-o:before {
        content: "\f2b7";
    }
    .fa-linode:before {
        content: "\f2b8";
    }
    .fa-address-book:before {
        content: "\f2b9";
    }
    .fa-address-book-o:before {
        content: "\f2ba";
    }
    .fa-vcard:before,
    .fa-address-card:before {
        content: "\f2bb";
    }
    .fa-vcard-o:before,
    .fa-address-card-o:before {
        content: "\f2bc";
    }
    .fa-user-circle:before {
        content: "\f2bd";
    }
    .fa-user-circle-o:before {
        content: "\f2be";
    }
    .fa-user-o:before {
        content: "\f2c0";
    }
    .fa-id-badge:before {
        content: "\f2c1";
    }
    .fa-drivers-license:before,
    .fa-id-card:before {
        content: "\f2c2";
    }
    .fa-drivers-license-o:before,
    .fa-id-card-o:before {
        content: "\f2c3";
    }
    .fa-quora:before {
        content: "\f2c4";
    }
    .fa-free-code-camp:before {
        content: "\f2c5";
    }
    .fa-telegram:before {
        content: "\f2c6";
    }
    .fa-thermometer-4:before,
    .fa-thermometer:before,
    .fa-thermometer-full:before {
        content: "\f2c7";
    }
    .fa-thermometer-3:before,
    .fa-thermometer-three-quarters:before {
        content: "\f2c8";
    }
    .fa-thermometer-2:before,
    .fa-thermometer-half:before {
        content: "\f2c9";
    }
    .fa-thermometer-1:before,
    .fa-thermometer-quarter:before {
        content: "\f2ca";
    }
    .fa-thermometer-0:before,
    .fa-thermometer-empty:before {
        content: "\f2cb";
    }
    .fa-shower:before {
        content: "\f2cc";
    }
    .fa-bathtub:before,
    .fa-s15:before,
    .fa-bath:before {
        content: "\f2cd";
    }
    .fa-podcast:before {
        content: "\f2ce";
    }
    .fa-window-maximize:before {
        content: "\f2d0";
    }
    .fa-window-minimize:before {
        content: "\f2d1";
    }
    .fa-window-restore:before {
        content: "\f2d2";
    }
    .fa-times-rectangle:before,
    .fa-window-close:before {
        content: "\f2d3";
    }
    .fa-times-rectangle-o:before,
    .fa-window-close-o:before {
        content: "\f2d4";
    }
    .fa-bandcamp:before {
        content: "\f2d5";
    }
    .fa-grav:before {
        content: "\f2d6";
    }
    .fa-etsy:before {
        content: "\f2d7";
    }
    .fa-imdb:before {
        content: "\f2d8";
    }
    .fa-ravelry:before {
        content: "\f2d9";
    }
    .fa-eercast:before {
        content: "\f2da";
    }
    .fa-microchip:before {
        content: "\f2db";
    }
    .fa-snowflake-o:before {
        content: "\f2dc";
    }
    .fa-superpowers:before {
        content: "\f2dd";
    }
    .fa-wpexplorer:before {
        content: "\f2de";
    }
    .fa-meetup:before {
        content: "\f2e0";
    }
    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        border: 0;
    }
    .sr-only-focusable:active,
    .sr-only-focusable:focus {
        position: static;
        width: auto;
        height: auto;
        margin: 0;
        overflow: visible;
        clip: auto;
    }
</style>
<style>
    @charset "utf-8";
    /* CSS Document */
    @import url('https://fonts.googleapis.com/css?family=Lato:300,400,700,900');


    #myProgress {
        width: 100%;
    }

    #myBar {
        width: 0%;
        height: 30px;
        background-color:#055a90;
        text-align: right;
        padding-right: 10px;
        line-height: 30px;
        color: white;
        border-radius:5px;
    }
    .step i{
        display:none;
    }
    .step.process .fa-spinner,
    .step.complete .fa-check
    {
        display:inline-block;
    }
    .step.complete .fa-spinner{
        display:none;
    }
    .aft_complete{
        display:none;
    }








    body {
        margin: 0px!important;
        font-family: 'Lato', sans-serif !important;
        padding: 0px!important;
    }
    p {
        font-family: 'Lato', sans-serif !important;
        font-size: 16px;
        color: #000;
    }
    h1, h2, h3, h4, h5, h6 {
        font-family: 'Lato', sans-serif !important;
    }
    a:hover {
        text-decoration: none !important;
        color: #650606 !important;
    }
    .wrapper .container, .wrapper .container-fluid, footer {
        max-width: 960px !important;
    }
    .wrapper section {
        max-width: 960px;
        margin: 0 auto;
    }
    .container-pass {
        padding-left: 0px!important;
        padding-right: 0px!important
    }
    .wrapper {
        width: 100%
    }
    section#logosec {
        padding: 10px 0px;
        background: #f4f4f4;
        -webkit-box-shadow: 0px 2px 5px -1px rgba(82,82,82,1);
        -moz-box-shadow: 0px 2px 5px -1px rgba(82,82,82,1);
        box-shadow: 0px 2px 5px -1px rgba(82,82,82,1);
        margin-bottom: 6px;
    }
    img.logo {
        max-width: 210px;
        margin: 0 auto;
    }
    section#as-seen-on-sec {
        background: #f0f7fd;
    }
    .asseenlogosec {
        float: left;
        width: 100%;
    }
    img.v-card-arrow {
        width: 54px;
        position: absolute;
        left: 1px;
        top: -19px;
    }
    img.v-card-arrow.arrw {
        top: -1px;
    }
    .asseenlogosec .asseen-text {
        float: left;
        width: 34%;
        text-transform: uppercase;
        padding: 4% 0;
        font-size: 16px;
    }
    .asseen-logos {
        float: left;
        width: 66%;
        line-height: 50px;
    }
    #form-sec-home form .input-group input {
        font-size: 18px;
        height:36px;
    }
    .asseen-logos img {
        width: 16%;
        padding: 3px;
    }
    section#cardsec-top h2 {
        text-align: center;
        color: #383838;
        font-weight: 800;
        font-size: 20px;
        margin-bottom: 20px;
        line-height: 25px;
    }
    section#cardsec-top h2 span, .most-important-sec h3 span, section#customers-say h2 span, .yesnosec-popup h3 span {
        color: #e32726;
    }
    img.v-card {
        margin: 0 auto;
    }
    section.getstarted-sec {
        margin: 15px auto 15px;
    }
    .most-important-sec {
        background: #e2ebf2;
        padding: 10px;
    }
    .most-important-sec h3 {
        text-align: center;
        line-height: 28px;
        font-weight: 800;
        font-size: 23px;
        margin: 5px 0px 10px;
    }
    .money-bag-sec p {
        text-align: center;
        padding-top: 10px;
        float: left;
    }
    section.getstarted-sec ul, section#sales-sec3 ul {
        padding: 10px 0px;
        list-style: none;
        margin-bottom: 0px;
    }
    section.getstarted-sec ul li, section#sales-sec3 ul li {
        background: url(../images/tick-mark-icon.png) no-repeat;
        background-size: 24px;
        padding-left: 34px;
        background-position: 0px 6px;
        font-size: 15px;
        padding-bottom: 8px;
    }
    span.likebtn {
        width: 30px !important;
        display: inline-table;
        padding-left: 5px;
    }
    section.getstarted-sec ul li strong, section#sales-sec3 ul li strong {
        font-weight: 800;
    }
    #form-sec-home {
        background: #c90017;
        border: #000 2px solid;
        padding-bottom: 13px;
    }
    #form-sec-home form .input-group {
        border: #000 2px solid;
        margin: 12px 0px;
        border-radius: 4px;
    }
    #form-sec-home form button {
        background: #ffc900;
        background: -moz-linear-gradient(top, #ffc900 1%, #ff7c0b 100%);
        background: -webkit-linear-gradient(top, #ffc900 1%, #ff7c0b 100%);
        background: linear-gradient(to bottom, #ffc900 1%, #ff7c0b 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffc900', endColorstr='#ff7c0b', GradientType=0 );
        background: #258f20;
        background: -moz-linear-gradient(top, #48d94e 1%, #258f20 100%);
        background: -webkit-linear-gradient(top, #48d94e 1%, #258f20 100%);
        background: linear-gradient(to bottom, #48d94e 1%, #258f20 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#48d94e', endColorstr='#258f20', GradientType=0 );
        border: #95989a 2px solid;
        color: #fff;
        font-weight: 800;
        font-size: 17px;
    }
    #form-sec-home form button:hover{
        background: #58d05d;
        background: -moz-linear-gradient(top, #066102 1%, #58d05d 100%);
        background: -webkit-linear-gradient(top, #066102 1%, #58d05d 100%);
        background: linear-gradient(to bottom, #066102 1%, #58d05d 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#066102', endColorstr='#58d05d', GradientType=0 );
        color: #fff !important;
    }
    p.locksec {
        text-align: center;
        color: #fff;
        margin-bottom: 0px;
    }
    section#customers-say {
        padding: 15px 0px;
    }
    section#customers-say h2 {
        text-align: center;
        line-height: 24px;
        font-weight: 800;
        font-size: 21px;
        color: #484848;
        margin: 10px 0px 20px;
    }
    .image-with-text {
        width: 100%;
        float: left;
        padding-bottom: 10px;
        padding-top: 10px;
    }
    .man-img {
        width: 30%;
        float: left;
        padding-right: 10px;
        vertical-align: middle;
        display: table-cell;
        padding-top:8px;
    }
    .man-text {
        float: left;
        width: 70%;
    }
    p.name-man {
        color: #e32726;
        font-weight: 800;
        font-size: 14px;
    }
    .creatingcard h4 {
        color: #fff;
        text-align: center;
        line-height: 28px;
        font-weight: 800;
        font-size: 23px;
    }
    h2.secondry {
        margin-top: 0px;
    }
    section#cardsec-top h5 {
        text-align: center;
        color: #000000;
        font-weight: 800;
        font-size: 37px;
        line-height: 25px;
        border: #fff 2px solid;
        -webkit-text-stroke: 1px #ffffff;
        text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);
    }

    /* Primary Emergency Contact Css */
    .pri-datasec h3 {
        text-align: left !important;
    }
    section#emergency-contact-form {
        margin: 0 auto;
        display: table;
    }
    .ec-formsec {
        background: #e31d1a;
        border-radius: 10px;
        padding-bottom: 13px;
        margin: 0px 10px !important;
    }
    .form-logo-textsec {
        float: left;
        width: 100%;
        padding-top: 8px;
        margin-bottom: 8px;
    }
    .form-logo-textsec .form-logo-pmsec {
        float: left;
        width: 40%;
    }
    .form-logo-pmsec img {
        border-right: #fff 1px solid;
        padding-right: 5%;
        margin: 0 auto;
    }
    .form-text-pmsec {
        float: left;
        width: 60%;
    }
    .form-text-pmsec h3 {
        color: #fff;
        font-size: 15px;
        margin: 0px;
        padding: 1% 0;
        font-weight: 600;
    }
    .form-textsec {
        background: #fff;
        border-radius: 15px;
        padding: 10px;
    }
    .form-textsec h3 {
        font-size: 14px;
        text-align: center;
        margin: 0px;
        font-weight: 600;
        color: #e31d1a;
        margin-bottom: 10px;
    }
    .form-textsec .input-group {
        background: #dcf5ff !important;
        border: #ababab 1px solid;
        margin-bottom: 10px;
    }
    .form-textsec .input-group:nth-last-child(1) {
        margin-bottom: 0px;
    }
    .form-textsec span.input-group-addon {
        border: none;
        background: transparent;
        padding: 5px;
    }
    .form-textsec input {
        border: none;
        box-shadow: none;
        background: none;
        height: 45px;
        padding-left: 0px;
    }
    section#emergency-contact-form button,section#cardsec-top button, a.complete-order-btn, section#order-sec1 button,div#dwnc a {
        background: #066102;
        background: -moz-linear-gradient(top, #58d05d 1%, #066102 100%);
        background: -webkit-linear-gradient(top, #58d05d 1%, #066102 100%);
        background: linear-gradient(to bottom, #58d05d 1%, #066102 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#58d05d', endColorstr='#066102', GradientType=0 );
        border: none;
        color: #fff;
        font-weight: 800;
        font-size: 20px;
        border-radius: 20px;
        padding: 10px 43px;
        margin: 0 auto;
        display: table;
        margin-top: 15px;
        margin-bottom: 15px;
    }
    section#emergency-contact-form button:hover, a.complete-order-btn:hover, section#order-sec1 button:hover {
        background: #58d05d;
        background: -moz-linear-gradient(top, #066102 1%, #58d05d 100%);
        background: -webkit-linear-gradient(top, #066102 1%, #58d05d 100%);
        background: linear-gradient(to bottom, #066102 1%, #58d05d 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#066102', endColorstr='#58d05d', GradientType=0 );
        color: #fff !important;
    }
    section#gray-footer-logo {
        background: #e7e7e7;
        padding: 10px 0px;
    }
    section#gray-footer-logo .asseen-text {
        text-transform: none;
        font-weight: 600;
        color: #004a98;
    }
    ::-webkit-input-placeholder {font-size: 18px;}
    ::-moz-placeholder {font-size: 18px;}
    :-ms-input-placeholder {font-size: 18px;}
    :-moz-placeholder {font-size: 18px;}

    .contactpageform .form-textsec input::-webkit-input-placeholder {font-size: 11px;}
    .contactpageform .form-textsec input::-moz-placeholder {font-size: 11px;}
    .contactpageform .form-textsec input:-ms-input-placeholder {font-size: 11px;}
    .contactpageform .form-textsec input:-moz-placeholder {font-size: 11px;}


    .contactpageform .form-textsec input {
        height: 32px;padding-top: 2px;
    }
    .yesnosec-popup {
        background: #fff;
        border-radius: 10px;
        margin: 9px;
        padding: 10px;
        margin-top: 15px;
    }
    p.pricesec {
        text-align: center;
        font-size: 36px;
        color: #e32726;
        font-weight: 800;
    }
    .yesnosec-popup h3 {
        text-align: center;
        font-size: 18px;
        margin-top: 0px;
        font-weight: 800;
        line-height: 22px;
    }
    section#emergency-contact-form .modal-content {
        background: #e31d1a;
        margin-top: 40%;
    }
    section#emergency-contact-form .modal-header {
        border: none;
    }
    a.close span::before {
        color: #fff !important;
    }
    a.close {
        opacity: 1 !important;
        font-size: 26px;
        margin-top: -8px !important;
    }
    .twobuttonsec {
        text-align: center;
        padding: 20px 0px;
    }
    .twobuttonsec a {
        background: #066102;
        background: -moz-linear-gradient(top, #58d05d 1%, #066102 100%);
        background: -webkit-linear-gradient(top, #58d05d 1%, #066102 100%);
        background: linear-gradient(to bottom, #58d05d 1%, #066102 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#58d05d', endColorstr='#066102', GradientType=0 );
        border: none;
        color: #000000;
        font-weight: 800;
        font-size: 19px;
        border-radius: 20px;
        padding: 5px 35px;
        margin: 0px 5px;
    }
    /* Primary Emergency Contact Css */
    /* sales Css */
    button.sales-btn {
        padding: 10px !important;
    }
    section#cardsec-top h3 {
        text-align: center;
        color: #000000;
        font-weight: 400;
        font-size: 16px;
        margin-bottom: 20px;
        line-height: 22px;
    }
    section#cardsec-top h3 span {
        color: #e32726;
        font-weight: 800;
        font-size: 23px;
    }
    section#sales-sec2 {
        background: #00518a;
        padding: 10px 0px;
    }
    section#sales-sec2 p {
        text-align: center;
        color: #fff;
        font-size: 20px;
        font-weight: 300;
    }
    img.cardlogo {
        padding: 10px;
        width: 232px;
        margin: 0 auto;
    }
    img.security-logo {
        padding-bottom: 15px;
    }
    section#sales-sec2 a.complete-order-btn {
        margin-bottom: -32px;
    }
    section#sales-sec3 h3 {
        text-align: center;
        line-height: 24px;
        font-weight: 400;
        font-size: 21px;
        color: #000000;
        margin: 20px 0px;
    }
    section#sales-sec3 h3 span {
        font-weight: 800;
    }
    .sales-mid-img .col-xs-12 {
        padding: 0px;
    }
    p.sec4text {
        text-align: left;
        padding-top: 11px;
        font-size: 17px;
        line-height: 23px;
    }
    .nameful {
        clear: both;
        margin:2px 0;
        margin-bottom: 6px;
    }
    .form-textsec span.glyphicon:before {
        font-size: 11px !important;
        color: #e31d1a !important;
    }
    .nameful strong {
        margin-left: 6px;

        margin-right: 2px;
        color: #000;
        font-weight: 600;
        font-size: 13px;
    }
    span.nameborder {
        border-bottom: 1px solid #a9a9a9;
        width:188px;
        display: table;
        float: right;
        font-size:12px;
        margin-top: 1px;
    }
    span.mailborder {
        border-bottom: 1px solid #a9a9a9;
        width: 212px;
        display: table;
        float: right;
        font-size: 12px;
        margin-top: 1px;
    }
    span.mainphone {
        border-bottom: 1px solid #a9a9a9;
        display: table;
        float: right;
        font-size: 12px;
        margin-top: 1px;
        margin-right: 7px;
        width: 203px;
    }
    span.sendphone {
        border-bottom: 1px solid #a9a9a9;
        display: table;
        float: right;
        font-size: 12px;
        margin-top: 2px;

        width: 146px;
    }
    span.homeaddress {
        border-bottom: 1px solid #a9a9a9;
        width: 96%;
        display: table;
        float: right;
        font-size: 12px;
        margin-bottom: 6px;
    }
    .nameful .glyphicon {
        top:0;
        line-height: 0;
    }
    .clear {
        clear: both;
    }
    .borderdot {
        border-bottom: 2px dotted #e31d1a;
        margin-bottom:12px;
    }
    .nameful2 {
        width:100%;
        float: left;
        margin-bottom:6px;
    }
    .nameful3 {
        width: 100%;
        float: left;
        margin-bottom:6px;
    }
    /* sales Css */
    /* Order Css */
    section#order-sec1 h2 {
        font-size: 19px;
        font-weight: 800;
    }
    .step1-form input {
        border-radius: 10px !important;
        border: #969696 2px solid;
    }
    .step1-form .input-group {
        margin-bottom: 10px;
        width: 100%;
    }
    .step1-form .emailfild {
        float: left;
        width: 49% !important;
        margin-right: 5px;
    }
    .step1-form .phonenumber {
        float: left;
        width: 49% !important;
        margin-right: 0px !important;
    }
    .city {
        float: left;
        width: 30% !important;
        margin-right: 5px;
    }
    .state {
        float: left;
        width: 30% !important;
        margin-right: 5px;
    }
    .zipcode {
        width: 36% !important;
    }
    .ex-date {
        width: 75% !important;
        float: left;
        margin-right: 5px;
    }
    .cvv {
        width: 23% !important;
    }
    section#order-sec1 button {
        margin-bottom: 20px;
    }
    /* Order Css */
    /* progress-bar */
    .step.complete {
        color: green;
        font-size: 16px;
        display: inline-table;
        padding-bottom: 6px;
    }
    .loading_content span {
        font-size: 16px;
    }
    .step.complete i {
        padding-right: 6px;font-size: 24px;
    }
    .loading_content {
        text-align: center;
    }

    a.step_button i {
        padding-right: 11px;
        font-size: 21px;
        top: 4px;
    }
    div#dwnc a:hover {
        color: #ffffff !important;
    }

    button.downlord {
        font-size: 18px !important;
        padding: 13px 15px !important;
    }
    p.upsl-p {
        text-align: center;
    }
    img.upslimg {
        margin-bottom: 20px;
    }

    /* progress-bar */
    /* CSS Footer*/
    footer {
        border-top: #8e8e8e 2px solid;
        margin: 0 auto;
    }
    p.link-footer {
        text-align: center;
        margin-bottom: 0px;
        font-size: 14px;
        padding-top: 7px;
    }
    p.link-footer a {
        color: #000;
    }
    p.link-footer a:hover{color:#e32726 !important;}
    p.copyright {
        font-size: 12px;
        text-align: center;
        padding-top: 5px;
        padding-bottom: 2px;
    }
    .listimg {
        display: none;
    }
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    @media screen and (min-device-width:768px){
        .step.complete {
            font-size: 20px;
        }
        .step1-form .phonenumber {
            width: 50.6% !important;
        }
        .zipcode {
            width: 39% !important;
        }
        .cvv {
            width: 24% !important;
        }
        .asseenlogosec .asseen-text {
            width: 20%;
            font-size: 25px;
            font-weight: 600;
        }
        .card-new img {
            margin: 0 auto;
            width: 60%;
        }
        section#order-sec1 h2 {
            font-size: 27px;
            padding-bottom: 18px;
        }
        .asseen-logos {
            width: 80%;
        }
        .asseen-logos img {
            width: 16%;
            padding: 3px 13px;
        }
        section#cardsec-top h2 {
            font-size: 32px;
            line-height: 35px;
            padding-bottom: 10px;
        }
        #form-sec-home form {
            width: 91%;
            margin: 0 auto;
        }
        .form-control {
            height: 40px !important;
        }
        .creatingcard h4 {
            line-height: 26px;
            font-size: 22px;
            padding-bottom: 5px;
        }
        #form-sec-home form button {
            font-size: 20px;
        }
        .creatingcard {
            padding-top: 5px;
        }
        p.locksec {
            padding-bottom: 0px;
            font-size: 17px;
            padding-top: 0px;
        }
        .most-important-sec {
            padding: 25px;
        }
        .most-important-sec h3 {
            line-height: 34px;
            font-size: 30px;
        }
        section.getstarted-sec ul li {
            font-size: 21px;
            background-size: 30px;
            padding-left: 45px;
            background-position: 0px 6px;
        }
        .money-bag-sec p {
            font-size: 18px;
        }
        .money-bag-sec img {
            float: left;
        }
        .money-bag-sec {
            float: left;
            width: 47%;
            margin: 10px;
        }
        ::-webkit-input-placeholder {font-size: 20px;}
        ::-moz-placeholder {font-size: 20px;}
        :-ms-input-placeholder {font-size: 20px;}
        :-moz-placeholder {font-size: 20px;}

        .contactpageform .input-group input::-webkit-input-placeholder {font-size: 20px;}
        .contactpageform .input-group input::-moz-placeholder {font-size: 20px;}
        .contactpageform .input-group input:-ms-input-placeholder {font-size: 20px;}
        .contactpageform .input-group input:-moz-placeholder {font-size: 20px;}
        .contactpageform .input-group input{font-size:20px;}

        section#customers-say h2 {
            line-height: 24px;
            font-size: 32px;
            margin: 16px 0px 30px;
        }
        p.destion {
            font-size: 21px;
        }
        p.name-man {
            font-size: 21px;
        }
        .man-text {
            padding-top: 1%;
        }
        p.link-footer {
            margin-bottom: 2px;
            font-size: 17px;
            padding-top: 10px;
        }
        p.copyright {
            font-size: 15px;
        }
        /* Primary Emergency and Secondary Emergency Form */
        .ec-formsec {
            width: 525px !important;
        }
        .form-text-pmsec h3 {
            font-size: 19px;
            padding: 0% 0;
        }
        .form-textsec h3 {
            font-size: 18px;
        }
        .ec-formsec span.input-group-addon i {
            font-size: 18px;
        }
        span#pbar_span {
            line-height: 0px;
            margin-top:-3px;
        }
        section#sales-sec2 p {
            font-size: 24px;
        }
        section#sales-sec3 h3 {
            line-height: 25px;
            font-size: 25px;
            margin-bottom: 0px;
            text-align: left;
        }
        section.getstarted-sec ul li, section#sales-sec3 ul li {
            font-size: 20px;
        }

        .listimg {
            float: left;
            width: 50%;
            padding-right: 20px;
            padding-top: 14px;
        }
        .listline {
            float: left;
        }
        .sales-mid-img {
            display: none;
        }
        .listimg {
            display: block;
        }
        p.sec4text {
            font-size: 20px;
            line-height: 26px;
        }
        img.cardlogo {
            width: 40%;
        }
        img.security-logo {
            width: 56%;
            margin: 0 auto;
        }
        section#order-sec1 button {
            font-size: 26px !important;
            padding: 10px 15px !important;
        }
        img.upslimg {
            margin: 0 auto;
            padding-bottom: 20px;
        }
        p.upsl-p {
            font-size: 20px;
        }
        button.upsel-btn {
            font-size: 26px !important;
        }
        img.v-card-arrow {
            width: 77px;
            top: -40px;
            left: 4px;
        }
        img.v-card-arrow.arrw {
            top: -24px;
        }

    }

    @media screen and (min-device-width:300px) and (max-device-width: 767px){
        .creatingcard h4 {
            font-size: 20px;
            padding: 0px 20px;
        }
        span.nameborder {
            width:200px;
        }
        span.mailborder {
            width: 214px;
        }
        span.mainphone {
            width: 59px;
        }
        span.sendphone {
            width: 59px;
        }
        .money-bag-sec p {
            font-size: 17px;
        }
        section.getstarted-sec ul li, section#sales-sec3 ul li {
            font-size: 17px;
        }
        div#dwnc a {
            padding: 13px 27px;
        }
        p.destion {
            font-size: 16px;
        }
        .asseenlogosec .asseen-text {
            font-size: 15px;
        }
        section#cardsec-top h2 {
            font-size: 25px;
            line-height: 31px;
        }


    }
</style>
<div class="wrapper index">
    <section id="logosec">
        <div class="container">
            <div class="row"> <img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/nowprep-logo.png" class="logo img-responsive"> </div>
        </div>
    </section>
    <div class="template-index">
        <section id="as-seen-on-sec">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="asseenlogosec">
                            <div class="asseen-text">As Seen On:</div>
                            <div class="asseen-logos"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/cnbc-logo.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/abc-logo.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/msn-logo.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/cnn-logo.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/wsj-logo.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/ocbs-logo.png"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="cardsec-top">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2><span>100% FREE</span> Emergency Contact Card is a Life Saver!</h2>
                    </div>
                    <div class="col-sm-6"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/widewhitereflective.png" class="v-card img-responsive"> </div>
                    <div class="col-sm-6">
                        <div id="form-sec-home" class="form-sec-home-top">
                            <form class="repeater-contacts-top">
                                <div class="creatingcard">
                                    <h4>To begin creating YOUR card, just enter your name and email below</h4>
                                </div>
                                <div class="input-group">
                                    <input id="name" type="text" class="form-control" name="name" placeholder="Enter Your Full Name">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> </div>
                                <div class="input-group">
                                    <input id="email" type="email" class="form-control" name="email" placeholder="Enter Your Email Address">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span> </div>
                                <button id="submit_button_top" type="submit" class="btn-primary btn-lg btn-block">YES! Download My FREE Emergency Card INSTANTLY!</button>
                                <p class="locksec"><i class="glyphicon glyphicon-lock"></i> We respect your privacy</p>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/arrow.png" class="v-card-arrow img-responsive"></div>
                </div>
            </div>
        </section>
        <section class="getstarted-sec">
            <div class="container most-important-sec">
                <div class="row">
                    <div class="col-xs-12">
                        <h3>60 Seconds out of your day could be the single <em>most important</em> thing you do this year... Don't put this off. </h3>
                        <h3><span>Get Started Now!</span></h3>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ul>
                            <li><strong>Protect your loved ones</strong> and yourself with this simple tool.</li>
                            <li><strong>Easy to use wizard</strong> will have you better prepared in <em>less than 60 seconds</em>.</li>
                            <li><strong>Keep for yourself</strong> OR simply share with your spouse, children, and other family or friends.</li>
                        </ul>
                    </div>
                    <div class="col-xs-12">
                        <div class="money-bag-sec">
                            <img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/money-bag.jpg" class="img-responsive">
                            <p>NowPrep empowers the community with knowledge, tools, and products to provide confidence through safety, organization, and preparation.</p>
                        </div>
                        <div class="money-bag-sec">
                            <img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/childandpa.png" class="img-responsive">
                            <p>NowPrep’s Emergency Contact Card provides the ultimate preparation resource for individuals and families.  Soon we will also offer curated alerts, news, and instructional content as well as both free and discounted products, services and tools, because knowledge and preparation can grant peace of mind and ultimately save lives.</p>
                        </div>
                    </div>
                    <div class="col-xs-12"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/arrow.png" class="v-card-arrow arrw img-responsive"></div>
                </div>
            </div>
        </section>
        <section id="form-sec-home" class="form-sec-home-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <form class="repeater-contacts-bottom">
                            <div class="creatingcard">
                                <h4>To begin creating YOUR card, just enter your name and email below</h4>
                            </div>
                            <div class="input-group">
                                <input id="name" type="text" class="form-control" name="name" placeholder="Enter Your Full Name">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> </div>
                            <div class="input-group">
                                <input id="email" type="email" class="form-control" name="email" placeholder="Enter Your Email Address">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span> </div>
                            <button id="submit_button_bottom" type="submit" class="btn-primary btn-lg btn-block">YES! Download My FREE Emergency Card INSTANTLY!</button>
                            <p class="locksec"><i class="glyphicon glyphicon-lock"></i> We respect your privacy</p>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section id="customers-say">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2>What Our <span>Users</span> Say:</h2>
                    </div>
                    <div class="testmonialsec">
                        <div class="col-xs-12">
                            <!-- Testmonial one by one -->
                            <div class="image-with-text">
                                <div class="man-img"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/Richard.jpg" class="img-responsive"></div>
                                <div class="man-text">
                                    <p class="destion">“It’s simple, free, and even if you don't want to think about it...it’s good to be ready for the worst.”</p>
                                    <p class="name-man">- Richard C. <span class="likebtn"><a href="#"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/likebtn.png" class="img-responsive"></a></span></p>
                                </div>
                            </div>
                            <!-- Testmonial End -->
                            <!-- Testmonial one by one -->
                            <div class="image-with-text">
                                <div class="man-img"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/David.jpg" class="img-responsive"></div>
                                <div class="man-text">
                                    <p class="destion">"I gave one of these cards to my daughter with me and my wife's contact information. It feels good to know she has a physical copy of our information if god forbid anything were to happen."</p>
                                    <p class="name-man">- David N. <span class="likebtn"><a href="#"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/likebtn.png" class="img-responsive"></a></span></p>
                                </div>
                            </div>
                            <!-- Testmonial End -->
                            <!-- Testmonial one by one -->
                            <div class="image-with-text">
                                <div class="man-img"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/Barbara.jpg" class="img-responsive"></div>
                                <div class="man-text">
                                    <p class="destion">"It's a good idea, it's FREE, and it could be life saving. There is literally not a single good reason not to prepare for the unexpected."</p>
                                    <p class="name-man">- Barbara M. <span class="likebtn"><a href="#"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/likebtn.png" class="img-responsive"></a></span></p>
                                </div>
                            </div>
                            <!-- Testmonial End -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="template-contact">
        <section id="cardsec-top">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2>Enter The Contact Info for The <span>Primary Emergency Contact</span> You Want Printed on Card:</h2>
                    </div>
                </div>
            </div>
        </section>
        <section id="emergency-contact-form" class="emergency-contact-form-top" >
            <form class="contact-form-first">
                <div class="container ec-formsec">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-logo-textsec">
                                <div class="form-logo-pmsec"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/form-logo.png" class="img-responsive"></div>
                                <div class="form-text-pmsec">
                                    <h3>Emergency Contact #1</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-textsec">
                                <h3>In Case of Emergency, Please Contact...</h3>
                                <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="name" type="text" class="form-control" name="name" placeholder="Enter Your Primary Contact’s Full Name*">
                                </div>
                                <div class="input-group phonenumber"> <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input id="email" type="email" class="form-control" name="email" placeholder="Email">
                                </div>
                                <div class="input-group phonenumber-alt"> <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                    <input id="phone" type="text" class="form-control" name="phone" placeholder="Phone">
                                </div>
                                <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                    <input id="address_fir" type="text" class="form-control" name="address_fir" placeholder="Address" onfocus="geolocate($(this));">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-info btn-lg">NEXT <i class="glyphicon glyphicon-forward"></i></button>
            </form>
        </section>
        <section id="cardsec-top">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h5>-OR-</h5>
                        <h2 class="secondry">Add <em>OPTIONAL</em><br><span><u>Secondary</u> Emergency Contact</span> You Want Printed on Card:</h2>
                    </div>
                </div>
            </div>
        </section>
        <section id="emergency-contact-form" class="emergency-contact-form-bottom">
            <form class="contact-form-second">
                <div class="container ec-formsec">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-logo-textsec">
                                <div class="form-logo-pmsec"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/form-logo.png" class="img-responsive"></div>
                                <div class="form-text-pmsec">
                                    <h3>Emergency Contact #2</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-textsec">
                                <h3>In Case of Emergency, Please Contact...</h3>
                                <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="name" type="text" class="form-control" name="name" placeholder="Enter Your Secondary Contact’s Full Name*">
                                </div>
                                <div class="input-group phonenumber"> <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input id="email" type="email" class="form-control" name="email" placeholder="Email">
                                </div>
                                <div class="input-group phonenumber-alt"> <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                    <input id="phone" type="text" class="form-control" name="phone" placeholder="Phone">
                                </div>
                                <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                    <input id="address_sec" type="text" class="form-control" name="address_sec" placeholder="Address" onfocus="geolocate($(this));">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-info btn-lg">NEXT <i class="glyphicon glyphicon-forward"></i></button>
            </form>
        </section>
        <section id="cardsec-top">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12"> <img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/visiting-card.png" class="v-card img-responsive"> </div>
                </div>
            </div>
            <br/>
        </section>
        <section id="gray-footer-logo">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="asseenlogosec">
                            <div class="asseen-text">As Seen On:</div>
                            <div class="asseen-logos"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/cnbc.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/abc.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/msn.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/cnn.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/wsj.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/ocbs.png"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="template-generate">
        <section id="progress-bar">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div style="min-height:300px;">
                            <div class="dummy_div" style="width:100%; padding-bottom:4%"></div>
                            <div id="myProgress">
                                <div id="myBar">0%</div>
                            </div>
                            <br>
                            <div class="process_section loading_content">
                            <span class="step step_1"><i class="fa fa-spinner fa-spin process"></i><i
                                    class="fa fa-check complete"></i>Checking your information...</span>
                                <br>
                                <span class="step step_2"><i class="fa fa-spinner fa-spin process"></i><i
                                        class="fa fa-check complete"></i>Generating your emergency card......</span>
                                <br>
                                <span class="step step_3"><i class="fa fa-spinner fa-spin process"></i><i
                                        class="fa fa-check complete"></i>Congratulations {NAME}!</span>
                                <br>
                                <div class="aft_complete">
                                    <div id="dwnc" style="cursor: pointer;"><a class="step_button steppad step_button_1 next">Download
                                            Your Card <i class="glyphicon glyphicon-forward"></i></a>
                                        <div class="card-new">
                                            <canvas id="emergency_card" width="1275" height="1650"
                                                    style="border: none; display:none;"></canvas>
                                            <img id="emergency_card_img" src="" style="width: 1275px;height: 1650px;margin: 0px 0px;display:none;" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
        </section>
        <section id="gray-footer-logo">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="asseenlogosec">
                            <div class="asseen-text">As Seen On:</div>
                            <div class="asseen-logos"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/cnbc.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/abc.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/msn.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/cnn.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/wsj.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/ocbs.png"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="template-download">
        <section id="cardsec-top">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 style="color:#000;">Confirm or Modify Your Details Below Then <span>DOWNLOAD INTANTLY</span>!</h2>
                    </div>
                </div>
            </div>
        </section>
        <section id="emergency-contact-form">
            <form id="userinfo" class="contactpageform">
                <div class="container ec-formsec">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-logo-textsec">
                                <div class="form-logo-pmsec"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/form-logo.png" class="img-responsive"></div>
                                <div class="form-text-pmsec">
                                    <h3 style="padding-left: 10px;">User Info</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-textsec">
                                <h3>In Case of Emergency, Please Contact...</h3>
                                <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="name" type="text" class="form-control" name="name" placeholder="Enter Your Full Name">
                                </div>
                                <div class="input-group phonenumber"> <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input id="email" type="email" class="form-control" name="email" placeholder="Enter Your Email Address">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn-info btn-lg downlord">DOWNLOAD INSTANTLY <i class="glyphicon glyphicon-download"></i></button>
            </form>
        </section>
        <section id="emergency-contact-form">
            <form id="completed-contact1" class="contactpageform">
                <div class="container ec-formsec">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-logo-textsec">
                                <div class="form-logo-pmsec"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/form-logo.png" class="img-responsive"></div>
                                <div class="form-text-pmsec">
                                    <h3>Completed Contact #1</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-textsec">
                                <h3>In Case of Emergency, Please Contact...</h3>
                                <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="name1" type="text" class="form-control" name="name1" placeholder="Enter Your Primary Contact’s Full Name*">
                                </div>
                                <div class="input-group phonenumber"> <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input id="email1" type="email" class="form-control" name="email1" placeholder="Email">
                                </div>
                                <div class="input-group phonenumber-alt"> <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                    <input id="phone1" type="number" class="form-control" name="phone1" placeholder="Phone">
                                </div>
                                <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                    <input id="address1" type="text" class="form-control" name="address1" placeholder="Address" onfocus="geolocate($(this));">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn-info btn-lg downlord">DOWNLOAD INSTANTLY <i class="glyphicon glyphicon-download"></i></button>
            </form>
        </section>
        <section id="emergency-contact-form">
            <form id="completed-contact2" class="contactpageform">
                <div class="container ec-formsec">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-logo-textsec">
                                <div class="form-logo-pmsec"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/form-logo.png" class="img-responsive"></div>
                                <div class="form-text-pmsec">
                                    <h3>Completed Contact #2</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-textsec">
                                <h3>In Case of Emergency, Please Contact...</h3>
                                <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="name2" type="text" class="form-control" name="name2" placeholder="Enter Your Secondary Contact’s Full Name*">
                                </div>
                                <div class="input-group phonenumber"> <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input id="email2" type="email" class="form-control" name="email2" placeholder="Email">
                                </div>
                                <div class="input-group phonenumber-alt"> <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                    <input id="phone2" type="number" class="form-control" name="phone2" placeholder="Phone">
                                </div>
                                <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                    <input id="address2" type="text" class="form-control" name="address2" placeholder="Address" onfocus="geolocate($(this));">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn-info btn-lg downlord">DOWNLOAD INSTANTLY <i class="glyphicon glyphicon-download"></i></button>
            </form>
        </section>
        <section id="gray-footer-logo">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="asseenlogosec">
                            <div class="asseen-text">As Seen On:</div>
                            <div class="asseen-logos"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/cnbc.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/abc.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/msn.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/cnn.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/wsj.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/ocbs.png"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="template-sales">
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <script type="text/javascript">
            Stripe.setPublishableKey('pk_test_wWG5xLDf1AjUWuy2cRi8jws1');
        </script>
        <section id="sales-sec2">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <p>Now take advantage of a <em>Limited Time Offer</em> to get our <strong>Emergency Contact Card Premium Package</strong>! It’s a simple & affordable way to better prepare.</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="sales-sec3">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="listimg"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/happy_family.jpg" class="img-responsive"></div>
                        <div class="listline">
                            <h3>This <span>Premium Package</span> Includes:</h3>
                            <ul>
                                <li>2x Waterproof <strong>Wallet-Size Cards</strong></li>
                                <li><em>Easy-to-Follow</em> Disaster Planning Guide</li>
                                <li>In-Depth <strong>Emergency Contacts Log</strong></li>
                                <li><strong>BONUS</strong> Life-Saving First-Aid Tips!</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid sales-mid-img">
                <div class="row">
                    <div class="col-xs-12"> <img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/happy_family.jpg" class="img-responsive"> </div>
                </div>
            </div>
        </section>
        <section id="sales-sec4">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <p class="sec4text">With our reliance on technology at an all-time high, most individuals are completely unprepared when their phones break. This simple solution allows you to keep a physical record of your most vital info.</p>
                        <p class="sec4text">Together, we can make safety and preparation a reality!</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="order-sec1">
            <div class="payment-success"></div>
            <div class="payment-errors"></div>
            <form id="order" class="repeater-checkout-pass">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <h2>Step 1: Payment Information</h2>
                            <div class="col-xs-12"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/cardlogo.png" class="cardlogo img-responsive"></div>
                            <div class="step1-form">
                                <div class="input-group">
                                    <input id="cardnumber" type="text" class="form-control" name="cardnumber" placeholder="Credit&nbsp;Card&nbsp;Number">
                                </div>
                                <div class="input-group ex-date">
                                    <input id="ex_date" type="text" class="form-control" name="ex-date" placeholder="Expiration&nbsp;Date">
                                </div>
                                <div class="input-group cvv">
                                    <input id="cvv" type="text" class="form-control" name="cvv" placeholder="CVV" maxlength="4">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <h2>Step 2: Shipping Details</h2>
                            <div class="step1-form">
                                <div class="input-group">
                                    <input id="name" type="text" class="form-control" name="name" placeholder="Full Name*">
                                </div>
                                <div class="input-group emailfild">
                                    <input id="email" type="email" class="form-control" name="email" placeholder="Email">
                                </div>
                                <div class="input-group phonenumber">
                                    <input id="phone" type="text" class="form-control" name="phone" placeholder="Phone Number">
                                </div>
                                <div class="input-group">
                                    <input id="address" type="text" class="form-control" name="address" placeholder="Street&nbsp;Address*
">
                                </div>
                                <div class="input-group">
                                    <input id="address2" type="text" class="form-control" name="address2" placeholder="Street&nbsp;Address&nbsp;(Second&nbsp;Line)">
                                </div>
                                <div class="input-group city">
                                    <input id="city" type="text" class="form-control" name="city" placeholder="City">
                                </div>
                                <div class="input-group state">
                                    <input id="state" type="text" class="form-control" name="state" placeholder="State">
                                </div>
                                <div class="input-group zipcode">
                                    <input id="zipcode" type="text" class="form-control" name="zipcode" placeholder="Zip&nbsp;Code">
                                </div>
                            </div>
                            <button type="submit" class="sales-btn btn-info btn-lg"> Yes, RUSH Me My Cards and Premium Package For JUST $9!</button>
                        </div>
                        <div class="col-xs-12"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/security-logo.png" class="security-logo img-responsive"></div>
                    </div>
                </div>
                <input type="hidden" id="amount" name="amount" value="900"/>
            </form>
        </section>
    </div>
    <div class="template-upsell">
        <section id="cardsec-top">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2><span>WAIT!</span> YOU NEED TO FINISH THE JOB!</h2>
                        <p class="upsl-p">COMPLETE YOUR PREPARATION WITH OUR NEW, CUSTOM DESIGNED, EMERGENCY ACTION BINDER.</p>
                        <p class="upsl-p">If you thought the Emergency Contact Card was important, well you’re right!. But it’s only the 1<sup>st</sup> step. This Binder will take your Preparation and Organization to the next Level.</p>
                    </div>
                    <div class="col-xs-12"> <img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/upsal-bg.jpg" class="upslimg img-responsive"> </div>
                    <div class="col-xs-12">
                        <p class="upsl-p">WITHOUT THIS BINDER, YOU’RE ONLY HALF READY FOR AN EMERGENCY –Go all the way and give yourself the peace of mind knowing you’re prepared for the unexpected.</p>
                        <p class="upsl-p">This 1 of a kind Binder was painstakingly created to store all of your important documents and information in a safe place.</p>
                        <p class="upsl-p">It’s simple to use, will get and keep you organized, and is available today at 50% OFF the List price for existing NowPreppers.</p>
                        <h2>AKE ADVANTAGE OF THIS SPECIAL DISCOUNT AND ORDER TODAY AT <span>50% OFF!</span></h2>
                    </div>
                    <form method="post" action="/emergency-contact-card/">
                        <button type="submit" class="upsel-btn btn-info btn-lg">SEND ME MY PREMIUM PREP BINDER AT JUST $75 <i class="glyphicon glyphicon-forward"></i></button>
                    </form>
                </div>
            </div>
        </section>
        <section id="gray-footer-logo">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="asseenlogosec">
                            <div class="asseen-text">As Seen On:</div>
                            <div class="asseen-logos"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/cnbc.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/abc.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/msn.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/cnn.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/wsj.png"><img src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/images/ocbs.png"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <p class="link-footer"><a href="#">About Us</a> | <a href="#">Contact Us</a> </p>
                    <p class="copyright">Copyright © 2017 NowPrep.com. All Right Reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</div>

<script src="<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/ecc/js/progressbar.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNhcLWPyYGoSKdD1xHpkenk3GeiGtBgw8&libraries=places" async defer></script>

<script>
	window.onbeforeunload = function() {
        return "Are You Sure You Want To Leave?";
    }
    var googleAddressData = [];

    function initAutocomplete(data_field) {

        var input_name = $(data_field).attr('name');
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

    $(document).ready(function() {
        if (window.history && window.history.pushState) {
            window.history.pushState('', null, './');
            $(window).on('popstate', function() {
                $(window).unload();
                //return false;
            });
        }
        $(window).scrollTop(0);
        $("#ex_date").mask("99/99",{ "placeholder": "" });

        $("form.repeater-contacts-top").validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                name: "Please enter your name",
                email: "Please enter a valid email address"
            },
            submitHandler: function (form) {
                return false;
            }
        });
        $("form.repeater-contacts-bottom").validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                name: "Please enter your name",
                email: "Please enter a valid email address"
            },
            submitHandler: function (form) {
                return false;
            }
        });

        $("form#userinfo").validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                name: "Please enter your name",
                email: "Please enter a valid email address"
            },
            submitHandler: function (form) {
                return false;
            }
        });

        $("form.contact-form-first").validate({
            rules: {
                email: {
                    email: true
                },
                phone: {
                    phoneUS: true
                }
            },
            messages: {
                email: "Please enter a valid email address",
                phone: "Please enter a valid phone number",
            },
            submitHandler: function (form) {
                return false;
            }
        });
        $("form.contact-form-second").validate({
            rules: {
                email: {
                    email: true
                },
                phone: {
                    phoneUS: true
                }
            },
            messages: {
                email: "Please enter a valid email address",
                phone: "Please enter a valid phone number",
            },
            submitHandler: function (form) {
                return false;
            }
        });
        $("form#completed-contact1").validate({
            rules: {
                email: {
                    email: true
                },
                phone: {
                    phoneUS: true
                }
            },
            messages: {
                email: "Please enter a valid email address",
                phone: "Please enter a valid phone number",
            },
            submitHandler: function (form) {
                return false;
            }
        });
        $("form#completed-contact2").validate({
            rules: {
                email: {
                    email: true
                },
                phone: {
                    phoneUS: true
                }
            },
            messages: {
                email: "Please enter a valid email address",
                phone: "Please enter a valid phone number",
            },
            submitHandler: function (form) {
                return false;
            }
        });
        $("form.repeater-checkout-pass").validate({
            rules: {
                name: {
                    required: true
                },
                address: {
                    required: true
                },
                cardnumber: {
                    required: true,
                    creditcard: true
                },
                cvv: {
                    required: true,
                    digits: true
                },
                ex_date: {
                    required: true,
                    maxlength: 5
                }
            },
            messages: {
                cardnumber: "Enter a valid card number",
                name: "Enter a Name on Card",
                cvv: ""
            },
            submitHandler: function (form) {
                return false;
            }
        });

        $("form.repeater-contacts-bottom,form.repeater-contacts-top").submit(function(){
            if($(this).valid()) {
                $(".template-index").hide();
                $(window).scrollTop(0);
                $(".template-contact").show();
            }
            return false;
        });
        $("form.contact-form-first,form.contact-form-second").submit(function(){
            if($(this).valid()) {
                $(".template-contact").hide();
                if($("form.repeater-contacts-top input#name").val() != "") {
                    $(".step_3").html("Congratulations " + $("form.repeater-contacts-top input#name").val() + "!");
                }
                else if($("form.repeater-contacts-bottom input#name").val() != "") {
                    $(".step_3").html("Congratulations " + $("form.repeater-contacts-bottom input#name").val() + "!");
                }
                $(window).scrollTop(0);
                $(".template-generate").show();

                var elem = document.getElementById("myBar");
                var width = 0;
                var id = setInterval(frame, 50);

                function frame() {
                    if (width >= 100) {
                        clearInterval(id);
                        $(".step_3").addClass("complete");
                        $(".aft_complete").show();

                    } else {
                        width++;
                        elem.style.width = width + '%';
                        elem.innerHTML = width * 1 + '%';
                        if (width > 0 && width < 30) {
                            $(".step_1").addClass("process");
                        }
                        if (width == 30) {
                            $(".step_1").removeClass("process");
                            $(".step_1").addClass("complete");
                            $(".step_2").addClass("process");
                        }
                        if (width == 60) {
                            $(".step_2").removeClass("process");
                            $(".step_2").addClass("complete");
                            $(".step_3").addClass("process");
                        }
                    }
                }

                var c = document.getElementById("emergency_card");
                var ctx = c.getContext("2d");
                var img = new Image();
                img.onload = function () {
                    ctx.drawImage(img, 0, 0);
                    ctx.font = "40px Arial";
                    ctx.textAlign="center";
                    if($("form.repeater-contacts-top input#name").val() != "") {
                        ctx.fillText("Congratulations " + $("form.repeater-contacts-top input#name").val() + "!", 637, 210);
                    }
                    else if($("form.repeater-contacts-bottom input#name").val() != "") {
                        ctx.fillText("Congratulations " + $("form.repeater-contacts-bottom input#name").val() + "!", 637, 210);
                    }

                    ctx.font = "14px Arial";
                    ctx.textAlign="left";
                    ctx.fillText($("form.contact-form-first input#name").val(), 195, 1069);
                    ctx.fillText($("form.contact-form-second input#name").val(), 770, 1069);
                    ctx.fillText($("form.contact-form-first input#name").val(), 195, 1402);
                    ctx.fillText($("form.contact-form-second input#name").val(), 770, 1402);

                    ctx.fillText($("form.contact-form-first input#email").val(), 170, 1100);
                    ctx.fillText($("form.contact-form-second input#email").val(), 745, 1100);
                    ctx.fillText($("form.contact-form-first input#email").val(), 170, 1433);
                    ctx.fillText($("form.contact-form-second input#email").val(), 745, 1433);

                    ctx.fillText($("form.contact-form-first input#phone").val().replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 170, 1133);
                    ctx.fillText($("form.contact-form-second input#phone").val().replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 745, 1133);
                    ctx.fillText($("form.contact-form-first input#phone").val().replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 170, 1466);
                    ctx.fillText($("form.contact-form-second input#phone").val().replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 745, 1466);


                    ctx.fillText($("form.contact-form-first input#address_fir").val(), 130, 1185);
                    ctx.fillText($("form.contact-form-second input#address_sec").val(), 703, 1185);
                    ctx.fillText($("form.contact-form-first input#address_fir").val(), 130, 1518);
                    ctx.fillText($("form.contact-form-second input#address_sec").val(), 703, 1518);

                    var canvas = document.getElementById("emergency_card");
                    var imgData = canvas.toDataURL("image/png", 1.0);

                    document.getElementById("emergency_card_img").src = imgData;

                    jQuery('#emergency_card_img').show();
                };
                img.src = '<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/ecc.png';

            }
            return false;
        });

        $("a.step_button").click(function(){
            $(".template-generate").hide();
            var toEmail = "";
            var toName = "";

            if($("form.repeater-contacts-top input#name").val() != "") {
                $("#ecc_name").html($("form.repeater-contacts-top input#name").val());
                toName = $("form.repeater-contacts-top input#name").val();
            }
            else if($("form.repeater-contacts-bottom input#name").val() != "") {
                $("#ecc_name").html($("form.repeater-contacts-bottom input#name").val());
                toName = $("form.repeater-contacts-bottom input#name").val();
            }
            if($("form.repeater-contacts-top input#email").val() != "") {
                $("#ecc_email").html($("form.repeater-contacts-top input#email").val());
                toEmail = $("form.repeater-contacts-top input#email").val();
            }
            else if($("form.repeater-contacts-bottom input#email").val() != "") {
                $("#ecc_email").html($("form.repeater-contacts-bottom input#email").val());
                toEmail = $("form.repeater-contacts-bottom input#email").val();
            }

            $("form#userinfo input#name").val(toName);
            $("form#userinfo input#email").val(toEmail);

            $("form#completed-contact1 input#name1").val($("form.contact-form-first input#name").val());
            $("form#completed-contact1 input#email1").val($("form.contact-form-first input#email").val());
            $("form#completed-contact1 input#phone1").val($("form.contact-form-first input#phone").val());
            $("form#completed-contact1 input#address1").val($("form.contact-form-first input#address_fir").val());

            $("form#completed-contact2 input#name2").val($("form.contact-form-second input#name").val());
            $("form#completed-contact2 input#email2").val($("form.contact-form-second input#email").val());
            $("form#completed-contact2 input#phone2").val($("form.contact-form-second input#phone").val());
            $("form#completed-contact2 input#address2").val($("form.contact-form-second input#address_sec").val());
            $(window).scrollTop(0);
            $(".template-download").show();

        });

        $(".downlord").each(function(){
            $(this).click(function(){
                if($("form#userinfo").valid() && $("form#completed-contact1").valid() && $("form#completed-contact2").valid()) {
                    $(".template-download").hide();
                    $(window).scrollTop(0);
                    $(".template-sales").show();

                    var c = document.getElementById("emergency_card");
                    var ctx = c.getContext("2d");

                    ctx.clearRect(0, 0, c.width, c.height);

                    var img = new Image();
                    img.onload = function () {
                        ctx.drawImage(img, 0, 0);
                        ctx.font = "40px Arial";
                        ctx.textAlign="center";
                        if($("form#userinfo input#name").val() != "") {
                            ctx.fillText("Congratulations " + $("form#userinfo input#name").val() + "!", 637, 210);
                        }

                        ctx.font = "14px Arial";
                        ctx.textAlign="left";

                        ctx.fillText($("form#completed-contact1 input#name1").val(), 195, 1069);
                        ctx.fillText($("form#completed-contact2 input#name2").val(), 770, 1069);
                        ctx.fillText($("form#completed-contact1 input#name1").val(), 195, 1402);
                        ctx.fillText($("form#completed-contact2 input#name2").val(), 770, 1402);

                        ctx.fillText($("form#completed-contact1 input#email1").val(), 170, 1100);
                        ctx.fillText($("form#completed-contact2 input#email2").val(), 745, 1100);
                        ctx.fillText($("form#completed-contact1 input#email1").val(), 170, 1433);
                        ctx.fillText($("form#completed-contact2 input#email2").val(), 745, 1433);

                        ctx.fillText($("form#completed-contact1 input#phone1").val().replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 170, 1133);
                        ctx.fillText($("form#completed-contact2 input#phone2").val().replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 745, 1133);
                        ctx.fillText($("form#completed-contact1 input#phone1").val().replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 170, 1466);
                        ctx.fillText($("form#completed-contact2 input#phone2").val().replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3"), 745, 1466);

                        ctx.fillText($("form#completed-contact1 input#address1").val(), 130, 1185);
                        ctx.fillText($("form#completed-contact2 input#address2").val(), 703, 1185);
                        ctx.fillText($("form#completed-contact1 input#address1").val(), 130, 1518);
                        ctx.fillText($("form#completed-contact2 input#address2").val(), 703, 1518);

                        var canvas = document.getElementById("emergency_card");
                        var imgDataPNG = canvas.toDataURL("image/png", 1.0);

                        document.getElementById("emergency_card_img").src = imgDataPNG;

                        var imgData = canvas.toDataURL("image/jpeg", 1.0);
                        var pdf = jsPDF('p', 'mm');
                        //pdf.canvas.height = 1650;
                        //pdf.canvas.width = 1275;
                        var width = pdf.internal.pageSize.width;
                        var height = pdf.internal.pageSize.height;
                        pdf.addImage(imgData, 'JPG', 0, 0, width, height);
                        var pdfData = btoa(pdf.output());
                        $.ajax({
                            type: "POST",
                            url: "https://mandrillapp.com/api/1.0/messages/send.json",
                            data: {
                                'key': 'o2DFojQBRFj71A665qf6Fg',

                                'message': {
                                    'from_email': 'info@nowprep.com',
                                    "from_name": "The NowPrep Team",
                                    'to': [{
                                        'email': $("form#userinfo input#email").val(),
                                        'name': $("form#userinfo input#name").val(),
                                        'type': 'to'
                                    }],
                                    'autotext': 'true',
                                    'subject': 'Your NowPrep Emergency Pocket Pass',
                                    'html': 'Congratulations ' + $("form#userinfo input#name").val() + "!<br><br>You're almost finished creating your custom <b>NowPrep Emergency Pocket Pass</b> and being <b>more disaster-ready</b> than over 60% of Americans.<br><br>Stay Prepared,<br>The NowPrep Team<br><br><br>",
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
                            } else if (response[0].status == "error") {
                            } else if (response[0].status == "rejected") {
                            }

                        });

                    };
                    img.src = '<?php echo str_replace('http://','https://',get_template_directory_uri()); ?>/assets/images/ecc.png';
                }
            });
        });

        $("form.emergency-contact-form-pdf").submit(function(){
            $(".template-download").hide();
            $(window).scrollTop(0);
            $(".template-sales").show();
            return false;
        });

        $("form.repeater-checkout-pass").submit(function(){
            if($(this).valid()) {
                var dataExp = $("#ex_date").val().split('/');
                Stripe.card.createToken({
                    number: $('#cardnumber').val(),
                    cvc: $('#cvv').val(),
                    exp_month: parseInt(dataExp[0]),
                    exp_year: (2000 + parseInt(dataExp[1])),
                    name: $("#name").val(),
                    address_line1: $("#address").val(),
                    address_line2: $("#address2").val(),
                    address_city: $("#city").val(),
                    address_state: $("#state").val(),
                    address_zip: $("#zipcode").val(),
                    address_country: "US"
                }, 1*100, stripeResponseHandler);
            }
        })
        function stripeResponseHandler(status, response) {
            if (response.error) {
                $(".payment-errors").show();
                $(".payment-errors").html(response.error.message);
            } else {
                var token = response.id;
                $("form.repeater-checkout-pass").append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                $(".payment-errors").hide();
                $.ajax({
                    type: "POST",
                    url: "//nowprep.com/wp-content/themes/Newspaper/wrapper/stripe_payment_ecc.php",
                    data: $("form.repeater-checkout-pass").serializeArray()
                }).done(function (response) {
                    var responseJson = $.parseJSON(response);
                    if( responseJson.result == 0 ) {
                        $(".payment-errors").show();
                        $(".payment-errors").html(responseJson.text);
                    }
                    if(responseJson.result == 1 ) {
                        $("form.repeater-checkout-pass").hide();
                        $(".payment-errors").hide();
                        $(".payment-success").show();
                        $(".payment-success").html(responseJson.text);
                        $(".template-sales").hide();
                        $(window).scrollTop(0);
                        $(".template-upsell").show();
                    }
                    $("#ship_pass").removeAttr("disabled");
                });
            }
        }
    });
</script>
</body>
</html>