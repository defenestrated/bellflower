<?php
/**
 * @package WordPress
 */

/*--------------------- get category level -------------------------*/

function get_category_level(){
$current_category = get_query_var('cat');
$my_category  = get_categories('hide_empty=0&include='.$current_category);
$cat_depth=0;

 if ($my_category[0]->category_parent == 0){
 	$cat_depth = 0;
 	} 
 else {

	 while( $my_category[0]->category_parent != 0 ) {
	  $my_category = get_categories('hide_empty=0&include='.$my_category[0]->category_parent);
	  $cat_depth++;
	  }
  
  }
  return $cat_depth;
}
/*------------------------------------------------------------------*/



/*---------------- single page navigation function -----------------*/

function spit_up_custom_nav($type) {
	$pcount = wp_count_posts($type)->publish;

	if ($pcount > 1 ) {
		previous_post_link('%link', 'prev');
		echo " ";			
		next_post_link('%link', 'next');
		echo '<br/><br/>';
	}
	if ($type === 'archive_post') {
		echo '<a href="/plusdores/archive/">back to "archive"</a>';
	}
	else if ($type === 'press_post') {
		echo '<a href="/plusdores/press/">back to "press"</a>';
	}
	
}
/*------------------------------------------------------------------*/

/*------------------------- get copyright  -------------------------*/

function get_copyright() {
echo '<div id="copyright">all material &copy; <a href="http://www.alanmillerpr.com" title="home">Alan Miller PR</a>.</div>';
}

/*------------------------------------------------------------------*/


/*----------------------- custom post types ------------------------*/

add_action( 'init', 'create_post_type' );

function create_post_type() {
	register_post_type( 'client',
		array(
			'labels' => array(
				'name' => __( 'Clients' ),
				'singular_name' => __( 'Client' ),
				'add_new_item' => _x('Add New Client', 'client')
			),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'clients'),
		'menu_position' => 5,
		'supports' => array( 'title', 'editor', 'thumbnail' )
		)
	);
}


/*------------------------------------------------------------------*/


/*----------------------- gallery rewrite --------------------------*/

function gallery_redux($output, $attr) {
    global $post;

    static $instance = 0;
    $instance++;


    /**
     *  will remove this since we don't want an endless loop going on here
     */
    // Allow plugins/themes to override the default gallery template.
    //$output = apply_filters('post_gallery', '', $attr);

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'dl',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'columns'    => 4,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $gallery_style = $gallery_div = '';
    if ( apply_filters( 'use_default_gallery_style', true ) )
        /**
         * KILL CSS
         */
        /*
        $gallery_style = "
        <style type='text/css'>
            #{$selector} {
                margin: auto;
            }
            #{$selector} .gallery-item {
                float: {$float};
                margin-top: 10px;
                text-align: center;
                width: {$itemwidth}%;
            }
            #{$selector} img {
                border: 2px solid #cfcfcf;
            }
            #{$selector} .gallery-caption {
                margin-left: 0;
            }
        </style>
        <!-- see gallery_shortcode() in wp-includes/media.php -->";
        */
    $size_class = sanitize_html_class( $size );
    $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
    $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

        $output .= "<{$itemtag} class='gallery-item'>";
        $output .= "
            <{$icontag} class='gallery-icon'>
                $link
            </{$icontag}>";
                if ( $captiontag && trim($attachment->post_excerpt) ) {
            $output .= "
            	<a href=". get_attachment_link($id) .">
                <{$captiontag} class='wp-caption-text gallery-caption'>
                " . wptexturize($attachment->post_excerpt) . "
                </{$captiontag}></a>";
        }
        $output .= "</{$itemtag}>";
        if ( $columns > 0 && ++$i % $columns == 0 )
            $output .= '<br style="clear: both" />';
    }

    /**
     * this is the extra br you want to remove so we change it to jus closing div tag
     * #3 in question
     */
    /*$output .= "
            <br style='clear: both;' />
        </div>\n";
     */

    $output .= "</div>\n";
    return $output;
}
add_filter("post_gallery", "gallery_redux",10,2);
/*------------------------------------------------------------------*/



/*----------------------------- misc -------------------------------*/

add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '',
		'after_title' => '',
	));
	
add_filter( 'show_admin_bar', '__return_false' );

/*------------------------------------------------------------------*/

?>