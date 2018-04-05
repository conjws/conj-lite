<?php
/**
 * WooCommerce hooks
 *
 * @author  	Mahdi Yazdani
 * @package 	conjws
 * @since 	    1.0.0
 */

/**
 * Layout
 *
 * @see  conjws_lite_wc_shop_messages()
 * @see  conjws_lite_wc_wrapper_before()
 * @see  conjws_lite_wc_wrapper_after()
 * @see  conjws_lite_wc_sorting_wrapper()
 * @see  conjws_lite_wc_pagination()
 * @see  conjws_lite_wc_sorting_wrapper_close()
 * @see  conjws_lite_wc_product_cols_wrapper()
 * @see  conjws_lite_wc_product_cols_wrapper_close()
 */
remove_action( 'woocommerce_before_main_content', 		'woocommerce_output_content_wrapper',			  	10 );
remove_action( 'woocommerce_before_main_content', 		'woocommerce_breadcrumb',                   		20 );
remove_action( 'woocommerce_after_main_content', 		'woocommerce_output_content_wrapper_end', 		  	10 );
remove_action( 'woocommerce_after_shop_loop',     		'woocommerce_pagination',                   	  	10 );
remove_action( 'woocommerce_before_shop_loop',    		'woocommerce_result_count',                 	  	20 );
remove_action( 'woocommerce_before_shop_loop',    		'woocommerce_catalog_ordering',             	  	30 );

add_action( 'conjws_lite_site_content_top', 			'woocommerce_breadcrumb',			    			10 );
add_action( 'conjws_lite_site_content_top', 			'conjws_lite_wc_shop_messages',						15 );

add_action( 'woocommerce_before_main_content', 			'conjws_lite_wc_wrapper_before',			    	10 );
add_action( 'woocommerce_after_main_content', 			'conjws_lite_wc_wrapper_after',						10 );

add_action( 'woocommerce_before_shop_loop', 			'conjws_lite_wc_sorting_wrapper',  		     		 9 );
add_action( 'woocommerce_before_shop_loop', 			'woocommerce_catalog_ordering',  		     		10 );
add_action( 'woocommerce_before_shop_loop', 			'woocommerce_result_count',  		     			20 );
add_action( 'woocommerce_before_shop_loop', 			'conjws_lite_wc_pagination',  						30 );
add_action( 'woocommerce_before_shop_loop', 			'conjws_lite_wc_sorting_wrapper_close', 	    	31 );
add_action( 'woocommerce_before_shop_loop', 			'conjws_lite_wc_product_cols_wrapper',  	    	40 );

add_action( 'woocommerce_after_shop_loop', 				'conjws_lite_wc_sorting_wrapper',   	 	     	9 );
add_action( 'woocommerce_after_shop_loop', 				'woocommerce_catalog_ordering',      			    10 );
add_action( 'woocommerce_after_shop_loop', 				'woocommerce_result_count',       				    20 );
add_action( 'woocommerce_after_shop_loop', 				'woocommerce_pagination',       			 	    30 );
add_action( 'woocommerce_after_shop_loop', 				'conjws_lite_wc_sorting_wrapper_close', 	    	31 );
add_action( 'woocommerce_after_shop_loop', 				'conjws_lite_wc_product_cols_wrapper_close', 		40 );

/**
 * Products
 *
 * @see  conjws_lite_wc_upsell_display()
 * @see  conjws_lite_wc_product_flash_wrapper()
 * @see  woocommerce_show_product_loop_sale_flash()
 * @see  conjws_lite_wc_product_flash_wrapper_close()
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display',  	 			 	15 );
add_action( 'woocommerce_after_single_product_summary',    'conjws_lite_wc_upsell_display',  	 			15 );
remove_action( 'woocommerce_before_shop_loop_item_title',  'woocommerce_show_product_loop_sale_flash', 	 	10 );

add_action( 'woocommerce_after_shop_loop_item_title',      'conjws_lite_wc_product_flash_wrapper',  	 	 6 );
add_action( 'woocommerce_after_shop_loop_item_title',      'conjws_lite_wc_product_flash_wrapper_close', 	 6 );

add_action( 'woocommerce_before_single_product_summary',   'conjws_lite_wc_product_flash_wrapper',  	 	 9 );
add_action( 'woocommerce_before_single_product_summary',   'conjws_lite_wc_product_flash_wrapper_close', 	11 );

/**
 * Cart fragment
 *
 * @see conjws_lite_wc_cart_link_fragment()
 */
if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments',	 	'conjws_lite_wc_cart_link_fragment',	 		10, 1 );
} else {
	add_filter( 'add_to_cart_fragments', 				 	'conjws_lite_wc_cart_link_fragment',	 		10, 1 );
}

/**
 * Header
 *
 * @see  conjws_lite_wc_search_field()
 * @see  conjws_lite_wc_header_cart()
 */
add_action( 'conjws_lite_header',							'conjws_lite_wc_search_field',						40 );
add_action( 'conjws_lite_header', 							'conjws_lite_wc_header_cart',    					50 );

/**
 * Checkout
 *
 * @see  conjws_lite_wc_checkout_order_review_wrapper()
 * @see  conjws_lite_wc_checkout_order_review_heading()
 * @see  conjws_lite_wc_checkout_order_review_wrapper_close()
 */
add_action( 'woocommerce_checkout_before_order_review',		'conjws_lite_wc_checkout_order_review_wrapper',   	   1 );
add_action( 'woocommerce_checkout_order_review',			'conjws_lite_wc_checkout_order_review_heading',   	   1 );
add_action( 'woocommerce_checkout_after_order_review',		'conjws_lite_wc_checkout_order_review_wrapper_close',  99 );
