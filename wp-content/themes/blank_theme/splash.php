<?php
/*
Template Name: Splash
*/
/*


written by sam galison, void design. licensed under a Creative Commons
Attribution-NonCommercial-ShareAlike 3.0 Unported License, 2012.


*/
get_header(); ?>

<style>
body { background: url(/bgimages/background1.jpg) no-repeat fixed center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		}
		
		
input::-webkit-input-placeholder, textarea::-webkit-input-placeholder {
 	color: #636363;
}
input {
	background: #FFF;
}
input:-moz-placeholder, textarea:-moz-placeholder {
 	color: #636363;
}

</style>

<body style="overflow: hidden;">

<script type="text/template" id="form_template">
  <input type="text" id="name_input" placeholder="enter your name"/>
  <input type="text" id="email_input" placeholder="enter your email"/>
</script>



<div id="snavbar">
<nav>
	<ul>
 	<?php 
		$parents = get_pages('exclude=5&parent=0&sort_column=menu_order');
		$parentcount = count($parents);
		$counter = 0;
 	?>
	
	<?php
		foreach ( $parents as $page ) {
			$counter++;
			$link = get_page_link( $page->ID );
			$title = $page->post_title;	
			echo '<li>';
			echo '<a href="' . $link . '">' . $title . '</a>';
			$children = get_pages('child_of='.$page->ID.'&parent='.$page->ID);
			if( count( $children ) != 0 ) {
				echo '<ul>';
				foreach ($children as $page) {
					$link = get_page_link( $page->ID );
					$title = $page->post_title;	
					echo '<li>';
					echo '<a href="' . $link . '">' . $title . '</a>';
					echo '</li>';
					}
					echo '</ul>';
			}
			echo '</li>';
			if ($counter != $parentcount) { //if it's not the last one
				echo '<li>&bull;</li>';
			}
		}
	?>
</ul>
</nav>	
</div>




</body>
</html>