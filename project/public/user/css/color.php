<?php
header ("Content-Type:text/css");
$color = "#746EF1"; // Change your Color Here

function checkhexcolor($color) {
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if( isset( $_GET[ 'color' ] ) AND $_GET[ 'color' ] != '' ) {
    $color = "#".$_GET[ 'color' ];
}

if( !$color OR !checkhexcolor( $color ) ) {
    $color = "#746EF1";
}


function hex2rgba( $color, $opacity) {

    if ($color[0] == '#') {
        $color = substr($color, 1);
    }
    if (strlen($color) == 6) {
        list($r, $g, $b) = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        list($r, $g, $b) = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return false;
    }
    $r = hexdec($r);
    $g = hexdec($g);
    $b = hexdec($b);
    $rgb = 'rgba('.$r. ',' .$g .',' .$b. ',' . $opacity.')';

    return $rgb;
}


?>

.nav-transparent .nav-container .navbar-collapse .navbar-nav > li:before,
.single-work .common-icon-circle.bg-pink:after,
.single-work:hover .common-icon-circle.bg-pink,
.btn-basic,
.video-play-btn i,
.single-pricing-wrap .price,
.single-pricing-wrap ul li a:before,
.back-to-top,
.check-profit-area form .title h5,
.btn-white:active, .btn-white:focus, .btn-white:hover,
.transaction-table .table tbody tr td:before,
.nav-transparent .nav-container .navbar-collapse .navbar-nav > li:after{
background : <?php echo  $color ?>;
}

.navbar-area .nav-container .navbar-collapse .navbar-nav > li:hover,
.section-title .subtitle,
.pricing-tab .nav-tabs .nav-item,
.single-pricing-wrap:hover .price,
.social-area li a,
.btn-white,
.widget.footer-widget .widget-title span.dot,
.social-area li a:hover i,
.transaction-table .table tbody tr:hover td,
.single-fact-count:hover h2,
.transaction-table .table thead th,
.navbar-area .nav-container .navbar-collapse .navbar-nav > li:hover > a,
.navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu li a i,
.navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:hover{
color : <?php echo  $color ?> !important;
}

.btn-plus,

.bg-gradient{
background: linear-gradient(104deg, <?php echo $color ?> 0%, #762dc4 100%) !important;
}


.social-area li a{
border: 1px solid <?php echo  $color ?> !important;
}

.btn-white:active, .btn-white:focus, .btn-white:hover{
color : white !important;
}