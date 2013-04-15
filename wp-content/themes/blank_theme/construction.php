<?php
/*
Template Name: Construction
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>The Bellflower Project</title>
<style type="text/css">
body {
	background: url(/bg.png) no-repeat fixed center;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
	margin:0;
}

#construction {
	position:absolute;
	
	width: 40%;
	left: 10%;
	top: 20%;
	
	background: rgba(255,255,255,0.9);
	font: normal normal 8pt/1.5em Lucida Console, Monaco, Courier, monospace;
	letter-spacing: .1em;
	padding: 50px;
	border: 1px solid #666;
	
	-webkit-transition:opacity .25s ease-in-out;  
   	-moz-transition:opacity .25s ease-in-out;  
   	-o-transition:opacity .25s ease-in-out;  
   	transition:opacity .25s ease-in-out;
}

a { color: #f00;
	font: normal normal 8pt/1.5em Lucida Console, Monaco, Courier, monospace;
	text-decoration: none;
	-webkit-transition:color .25s ease-in-out;  
   	-moz-transition:color .25s ease-in-out;  
   	-o-transition:color .25s ease-in-out;  
   	transition:color .25s ease-in-out; }

a:hover { color: #00f; }

#construction:hover {
	background: rgba(255,255,255,1);
	border: 1px solid #000;
}

input::-webkit-input-placeholder, textarea::-webkit-input-placeholder {
 	color: #999;
 	text-align: center;
}
input:-moz-placeholder, textarea:-moz-placeholder {
 	color: #999	;
 	text-align: center;
}
input:focus::-webkit-input-placeholder { opacity: 0.7; }
input:focus:-moz-placeholder { opacity: 0.7; }

input {
	background: rgba(255,255,255,0);
	font: normal normal 7pt/2em Lucida Console, Monaco, Courier, monospace;
	letter-spacing: .2em;
	padding: .5em 4em;
	margin-right: 8em;
}
</style>
<!--
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script src="http://ajax.cdnjs.com/ajax/libs/underscore.js/1.1.4/underscore-min.js"></script>
<script src="http://ajax.cdnjs.com/ajax/libs/backbone.js/0.3.3/backbone-min.js"></script>
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.min.js"></script>
-->
<script src="<?php bloginfo('template_directory');?>/js/jquery.min.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/underscore-min.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/backbone-min.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/jquery-ui.min.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/landing_models.js"></script>
</head>

<body style="overflow: hidden">

<script type="text/template" id="subscribe_template">
	<input type="text" id="name_input" placeholder="your name"/>
	<input type="text" id="email_input" placeholder="your email"/>
</script>
<script type="text/template" id="subscribe_content">
	<p>Welcome to the future online home of the Bellflower project, a joint project between <a href="http://www.samgalison.com">Sam Galison</a>, <a href="http://www.dylanbutman.com">Dylan Butman</a>, and Christy Spackman! We're right in the middle of building the site, so please check back soon.</p>
	<p>The Bellflower project is a solar-powered array of kinetic and musical sculptures. It will be installed in the park on Mercer st. and West 4th st. in downtown Manhattan in the spring of 2013. The image you see here is a top view of one of the Bellflowers, of which there will eventually be seven or eight. The petals of each flower - built from sustainable bamboo plywood - will house solar panels, providing enough energy for the flowers to open during the day, play music, and close at night. The music of the flowers will be a chorus of chimes, whose melodies and chords will vary according to environmental conditions, creating an immersive, sculptural concert.</p>
	<p>If you'd like to join our mailing list, give us your name and email and we'll sign you up.</p>
	</br>
	<p>- Sam & Dylan</p>
	</br>
</script>

<script type="text/template" id="unsubscribe_template">
 	<input type="text" id="email_input" placeholder="your email"/>
</script>
<script type="text/template" id="unsubscribe_content">
	<p>Sad to see you go! Enter your email, and we'll take you off our list.</p>
	</br>
</script>

<div id="construction">
    <div id="content_container"> </div>
    <div id="form_container"></div>
</div>

<script type="text/javascript">
$(function() {	
	var AppRouter = Backbone.Router.extend({
		routes: {
			"unsubscribe": "unsubscribe", 
			"*actions": "defaultRoute"
		}
	});
	var app_router = new AppRouter;
	
	app_router.on('route:unsubscribe', function() {
		console.log("unsubscribe");
		content_view = new ContentView({ el: $("#content_container"), isUnsubscribe: true });
		form_view = new FormView({ el: $("#form_container"), isUnsubscribe: true });
		this.navigate("unsubscribe");
	});
	
	app_router.on('route:defaultRoute', function(actions) {
		console.log('default route'); //subscribe
		content_view = new ContentView({ el: $("#content_container") });
		form_view = new FormView({ el: $("#form_container") });
		this.navigate("");
	});
	
	Backbone.history.start();
});
</script>
</script>


</body>
</html>
