<?php
/**
 * @package WordPress
 * @subpackage Classic_Theme
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title>
	<?php bloginfo('name'); ?>
	<?php wp_title('&nbsp;&bull;&nbsp;', true, 'left'); ?>
	</title>

	<?php
	$bgstring = "background";
	$randval = rand(1, 7);
	$bgstring .= $randval;
	$bgstring .= ".jpg";
	?>
	
	<style type="text/css" media="screen">
		@import url( <?php echo get_stylesheet_uri(); ?> );
		
		
		<?php echo 
		'body { background: url(/bgimages/' . $bgstring . ') no-repeat fixed center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		}
		'; ?>
		
	</style>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_get_archives(array('type' => 'monthly', 'format' => 'link')); ?>
	<?php //comments_popup_script(); // off by default ?>
	<?php wp_head(); ?>
	
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script src="http://ajax.cdnjs.com/ajax/libs/underscore.js/1.1.4/underscore-min.js"></script>
<script src="http://ajax.cdnjs.com/ajax/libs/backbone.js/0.3.3/backbone-min.js"></script>
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.min.js"></script>
	
</head>

<body <?php body_class(); ?>>

<div id="content">
<!-- end header -->
