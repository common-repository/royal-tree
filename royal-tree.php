<?php

/*
Plugin Name: Royal Tree
Plugin URI: http://wordpress.org/plugins/royal-tree
Description: This plugin allows you to add one or more menu as tree using shortcodes.
Version: 1.0.0
Author: Mehdi Akram
Author URI: http://shamokaldarpon.com
Last updated: 26/02/2014
*/

	
function royal_tree_css() {
	?>
	<style type="text/css">
/*Now the CSS*/
.tree * {margin: 0; padding: 0;}

.tree ul {
	padding-top: 20px; position: relative;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

.tree li {
	float: left; text-align: center;
	list-style-type: none;
	position: relative;
	padding: 20px 5px 0 5px;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

/*We will use ::before and ::after to draw the connectors*/

.tree li::before, .tree li::after{
	content: '';
	position: absolute; top: 0; right: 50%;
	border-top: 1px solid #8dc63f;
	width: 50%; height: 20px;
}
.tree li::after{
	right: auto; left: 50%;
	border-left: 1px solid #8dc63f;
}

/*We need to remove left-right connectors from elements without 
any siblings*/
.tree li:only-child::after, .tree li:only-child::before {
	display: none;
}

/*Remove space from the top of single children*/
.tree li:only-child{ padding-top: 0;}

/*Remove left connector from first child and 
right connector from last child*/
.tree li:first-child::before, .tree li:last-child::after{
	border: 0 none;
}

/*Adding back the vertical connector to the last nodes*/
.tree li:last-child::before{
	border-right: 1px solid #8dc63f;
	border-radius: 0 5px 0 0;
	-webkit-border-radius: 0 5px 0 0;
	-moz-border-radius: 0 5px 0 0;
}
.tree li:first-child::after{
	border-radius: 5px 0 0 0;
	-webkit-border-radius: 5px 0 0 0;
	-moz-border-radius: 5px 0 0 0;
}

/*Time to add downward connectors from parents*/
.tree ul::before{
	content: '';
	position: absolute; top: 0; left: 50%;
	border-left: 1px solid #8dc63f;
	width: 0; height: 20px;
}

.tree li a{
	border: 1px solid #8dc63f;
	padding: 1em 0.75em;
	text-decoration: none;
	color: #666767;
	font-family: arial, verdana, tahoma;
	font-size: 0.85em;
	display: inline-block;
  
  /*
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
  */
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

/* -------------------------------- */
/* Now starts the vertical elements */
/* -------------------------------- */

.tree ul.vertical, ul.vertical ul {
  padding-top: 0px;
  left: 50%;
}

/* Remove the downward connectors from parents */
.tree ul ul.vertical::before {
	display: none;
}

.tree ul.vertical li {
	float: none;
  text-align: left;
}

.tree ul ul.vertical li::before {
  right: auto;
  border: none;
}

.tree ul.vertical li::after{
	display: none;
}

.tree ul.vertical li a{
	padding: 10px 0.75em;
  margin-left: 16px;
}

.tree ul.vertical li::before {
  top: -20px;
  left: 0px;
	border-bottom: 1px solid #8dc63f;
	border-left: 1px solid #8dc63f;
	width: 20px; height: 60px;
}

.tree ul.vertical li:first-child::before {
  top: 0px;
  height: 40px;
}

/* Lets add some extra styles */

div.tree > ul > li > ul > li > a {
  width: 11em;
}

div.tree > ul > li > a {
  font-size: 1em;
  font-weight: bold;
}


/* ------------------------------------------------------------------ */
/* Time for some hover effects                                        */
/* We will apply the hover effect the the lineage of the element also */
/* ------------------------------------------------------------------ */
.tree li a:hover, .tree li a:hover+ul li a {
	background: #8dc63f;
	color: white;
  /* border: 1px solid #aaa; */
}
/*Connector styles on hover*/
.tree li a:hover+ul li::after, 
.tree li a:hover+ul li::before, 
.tree li a:hover+ul::before, 
.tree li a:hover+ul ul::before{
	border-color:  #aaa;
}
	</style>
	<?php

}
add_action('init','royal_tree_css');

function royal_tree($atts, $content = null) {
	extract(shortcode_atts(array(  
		'menu'            => '', 
		'menu_id'         => '',
		'color'           => '#8dc63f',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'depth'           => 0,
		'walker'          => '',
		'theme_location'  => ''), 
		$atts));
 
 
	return wp_nav_menu( array( 
		'menu'            => $menu, 
		'menu_class'      => 'tree', 
		'menu_id'         => $menu_id,
		'echo'            => false,
		'fallback_cb'     => $fallback_cb,
		'before'          => $before,
		'after'           => $after,
		'link_before'     => $link_before,
		'link_after'      => $link_after,
		'depth'           => $depth,
		'walker'          => $walker,
		'theme_location'  => $theme_location));
		
}
//Create the shortcode
add_shortcode("royal_tree", "royal_tree");



?>