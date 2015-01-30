<?php

/**
 * @file header.php
 * A header file converted from the WordPress Whiteboard theme framework.
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/ 1999/xhtml">
<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  
  <?php print $scripts; ?>
  
  <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
  <script type="text/javascript"><?php /* Needed to avoid Flash of Unstyled Content in IE */ ?> </script>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<meta name="viewport" content="width=device-width; initial-scale=1"/><?php /* Add "maximum-scale=1" to fix the Mobile Safari auto-zoom bug on orientation changes, but keep in mind that it will disable user-zooming completely. Bad for accessibility. */ ?>
	<?php /* The HTML5 Shim is required for older browsers, mainly older versions IE */ ?>
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
  <script type="text/javascript" charset="utf-8">
  /*$(window).load(function() {
    $('.flexslider').flexslider();
  });*/
  
  $(window).load(function() {
    //Only run on the recipe page
        $('.flexslider').flexslider({
            animation: ('ontouchstart' in document.documentElement) ? "slide" : "fade",
            animationDuration: ('ontouchstart' in document.documentElement) ? 300 : 800,
            controlsContainer: '#slider-nav-container',
        animationLoop: true,
        controlNav: false,
        start: function(slider) {
          slider.removeClass('loading');
        }
      });
      });
      
      
      Drupal.behaviors.myModuleBehavior = function (context) {
        // put all your jQuery goodness in here.
        
        
        $('#donate_button').click(function () {
                var donation = parseInt($('#donation').val());

                donation += 10;

                if(donation > 20)
                    $('#decrease_button').css({display : 'block'});

                $('#donation').val(donation);
                
               // $('#donation_disp').val(donation);
            });

            $('#decrease_button').click(function () {
                var donation = parseInt($('#donation').val());

                donation -= 10;

                if(donation == 20)
                    $('#decrease_button').css({display : 'none'});

                $('#donation').val(donation);
                //$('#donation_disp').html(donation);
            });
    }
</script>
</head>

<body class="<?php print $body_classes; ?>">
<div class="hide">
	<p><a href="#content">Skip to Content</a></p><?php /* used for accessibility, particularly for screen reader applications */ ?>
</div><!--.none-->
<div id="main"><!-- this encompasses the entire Web site -->
        
        <div id="topmenu">
            <div id="topmenu-nav">
                <?php if (isset($secondary_links)) {
                    print theme("links", $secondary_links, array("class" => "navmenu secondary-links"));
                } ?>
                <div id="top_search">
                        
                        <?php //if(!$user->uid) {?>
                            <!--<div style="position:absolute;float:left;margin-left:600px;margin-top:3px;"><a href="/user/login">Login</a> / <a href="/user/register">Create account</a></div>-->
                        <?php //} else { ?>
                            <!--<div style="position:absolute;float:left;margin-left:700px;margin-top:3px;"><a href="/logout">Logout</a></div>-->
                        <?php //} ?>
                        <div id="search_left_border"></div>
                        <?php print $header_search;?>
                </div>
            </div>
        </div>
        <div id="topnav">
            <div id="topnav-nav">
                <?php if (isset($primary_links)) {
                    print theme("links", $primary_links, array("class" => "navmenu primary-links"));
                } ?>
            </div>
        </div>
	<div id="header">
            <header>
		<div class="container">
                        <div id="header-logo">
                            <a href="/"><div style="width:280px;height:200px;position:absolute;margin-top:30px;margin-left:20px;"></div></a>
                            <a href="/about"><div style="width:150px;height:30px;position:absolute;margin-top:180px;margin-left:320px;"></div></a>
                            <?php //if(!$user->uid) {?>
                                <div id="register-button"><a href="/user/register"><img src="/<?php print path_to_theme(); ?>/images/drupalcamp-register.png" border="0"></a></div>
                            <?php //} else {?>
                                <!--<div id="register-button"><a href="/program/session-schedule/your-schedule"><img src="/<?php print path_to_theme(); ?>/images/btn_schedule.png" border="0"></a></div>-->
                            <?php //} ?>
                        </div>
                        <?php 
                            if(drupal_is_front_page())
                                print $speakers_slider; 
                        ?>
                </div><!--.container-->                
            </header>
        </div><!--#header-->
	<div class="container">
