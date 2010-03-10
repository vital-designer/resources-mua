<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery.sifr.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery.flash.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery.cookie-text-size.js"></script>

<script type="text/javascript">
$(function () {
	$.sifr({path:'<?php bloginfo('template_url');?>/fonts'});
	$('h2 a, #respond h3, .title, #comments').sifr({font:'jellyka', before: function() {
		$('.post h2 a, h2.title').css("letter-spacing", -4);
		$('.post h2 a, h2.title').css("word-spacing", -5);
	}

	});
	$('#sidebar ul li h2').sifr({font:'fertigo_18'});
});
$(function() { cookieResize('#fontSize a', 'normal'); });


</script>
</head>
<body>

<div id="page">
<div id="wrapper">
	<div id="masthead">
    	<img class="logo" src="<?php bloginfo('template_url');?>/images/mastheadLeft.jpg" />
        <h1>
        <a href="<?php echo get_option('home'); ?>/"><b><?php bloginfo('name'); ?></b><img src="<?php bloginfo('template_url');?>/images/h1.png" alt="title" /></a>
        </h1>
        <p><?php bloginfo('description'); ?></p>
        <?php get_search_form(); ?>
            
            <div id="fontSize">
            	         
            	<a href="#" class="normal">Normal</a>
            	<a href="#" class="medium">Medium</a>
            	<a href="#" class="big">Big</a>
            </div>
            
            <a href="<?php bloginfo('rss2_url'); ?>" id="rss">RSS</a>
            <a href="#" id="contact">Contact</a>
      
    </div>
    
	<div id="content">
    	<span id="top"></span> 
        <div id="posts">