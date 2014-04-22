<?php
/**
 * Custom functions
 */

//Turns off Woocommerce CSS
// add_filter( 'woocommerce_enqueue_styles', '__return_false' );

add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {
	
	// Adds the new tab
	
	$tabs['test_tab'] = array(
		'title' 	=> __( 'Specifications', 'woocommerce' ),
		'priority' 	=> 50,
		'callback' 	=> 'woo_new_product_tab_content'
	);
 
	return $tabs;
 
}
function woo_new_product_tab_content() {
	echo do_shortcode(get_field('specifications'));	
}
