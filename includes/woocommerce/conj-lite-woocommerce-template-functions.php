<?php
/**
 * WooCommerce template functions.
 *
 * @requires 	WooCommerce
 * @author  	Mahdi Yazdani
 * @package 	conj-lite
 * @since 	    1.1.0
 */

/**
 * WooCommerce shop messages.
 * 
 * @uses    is_checkout()
 * @uses    conj_lite_do_shortcode()
 * @return  void
 */
if ( ! function_exists( 'conj_lite_wc_shop_messages' ) ) :
	function conj_lite_wc_shop_messages() {

		if ( ! is_checkout() ) {
			echo wp_kses_post( conj_lite_do_shortcode( 'woocommerce_messages' ) );
		} // End If Statement

	}
endif;

/**
 * Before Content.
 * Wraps all WooCommerce content in wrappers which match the theme markup.
 *
 * @return  void
 */
if ( ! function_exists( 'conj_lite_wc_wrapper_before' ) ) :
	function conj_lite_wc_wrapper_before() {

		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
		<?php

	}
endif;

/**
 * After Content.
 * Closes the wrapping divs.
 *
 * @return  void
 */
if ( ! function_exists( 'conj_lite_wc_wrapper_after' ) ) :
	function conj_lite_wc_wrapper_after() {

		?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php

	}
endif;

/**
 * Sorting wrapper.
 *
 * @return  void
 */
if ( ! function_exists( 'conj_lite_wc_sorting_wrapper' ) ) :
	function conj_lite_wc_sorting_wrapper() {

		?><div class="conj-lite-wc-sorting"><?php

	}
endif;

/**
 * Pagination.
 * WooCommerce disables the product pagination inside the woocommerce_product_subcategories() function
 * but since this method adds pagination before that function is excuted we need a separate function to
 * determine whether or not to display the pagination.
 *
 * @uses 	woocommerce_products_will_display();
 * @uses 	woocommerce_pagination();
 * @return  void
 */
if ( ! function_exists( 'conj_lite_wc_pagination' ) ) :
	function conj_lite_wc_pagination() {

		if ( woocommerce_products_will_display() ) {
			woocommerce_pagination();
		} // End If Statement

	}
endif;

/**
 * Sorting wrapper close.
 *
 * @return  void
 */
if ( ! function_exists( 'conj_lite_wc_sorting_wrapper_close' ) ) :
	function conj_lite_wc_sorting_wrapper_close() {

		?></div><!-- .conj-lite-wc-sorting -->
		<?php

	}
endif;

/**
 * Product columns wrapper.
 *
 * @return  void
 */
if ( ! function_exists( 'conj_lite_wc_product_cols_wrapper' ) ) :
	function conj_lite_wc_product_cols_wrapper() {

		// Get the default columns setting
		// this is how many products will be shown per row in loops.
		$columns = (int) ( function_exists( 'wc_get_default_products_per_row' ) )  ?  wc_get_default_products_per_row()  :  2;

		printf( '<div class="conj-lite-wc-product-columns archive-columns-%1$s">', intval( $columns ) );

	}
endif;

/**
 * Product columns wrapper close.
 *
 * @return  void
 */
if ( ! function_exists( 'conj_lite_wc_product_cols_wrapper_close' ) ) :
	function conj_lite_wc_product_cols_wrapper_close() {

		?></div><!-- .conj-lite-wc-product-columns -->
		<?php

	}
endif;

/**
 * Upsells.
 * Replace the default upsell function with our own which displays the correct number product columns.
 *
 * @uses    woocommerce_upsell_display()
 * @return  void
 */
if ( ! function_exists( 'conj_lite_wc_upsell_display' ) ) :
	function conj_lite_wc_upsell_display() {

		$columns = apply_filters( 'conj_lite_wc_upsells_columns', 3 );
		woocommerce_upsell_display( -1, $columns );

	}
endif;

/**
 * Before Content.
 * Wraps all WooCommerce product flash content in wrappers which match the theme markup.
 *
 * @return  void
 */
if ( ! function_exists( 'conj_lite_wc_product_flash_wrapper' ) ) :
	function conj_lite_wc_product_flash_wrapper() {

		?><div class="conj-lite-wc-product__flashs"><?php

	}
endif;

/**
 * After Content.
 * Closes the wrapping divs.
 *
 * @return  void
 */
if ( ! function_exists( 'conj_lite_wc_product_flash_wrapper_close' ) ) :
	function conj_lite_wc_product_flash_wrapper_close() {

		?></div><!-- .conj-lite-wc-product__flash -->
		<?php

	}
endif;

/**
 * Cart Fragments.
 * Ensure cart contents update when products are added to the cart via AJAX.
 *
 * @uses 	ob_start()
 * @uses 	ob_get_clean()
 * @uses 	conj_lite_wc_cart_link
 * @param  	array $fragments Fragments to refresh via AJAX.
 * @return 	array            Fragments to refresh via AJAX
 */
if ( ! function_exists( 'conj_lite_wc_cart_link_fragment' ) ) :
	function conj_lite_wc_cart_link_fragment( $fragments ) {

		global $woocommerce;

		ob_start();
		conj_lite_wc_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;

	}
endif;

/**
 * Display WooCommerce product search field.
 *
 * @see 	https://docs.woocommerce.com/document/woocommerce-product-search/api/#section-2
 * @uses 	conj_lite_do_shortcode()
 * @uses 	woocommerce_product_search();
 * @return  void
 */
if ( ! function_exists( 'conj_lite_wc_search_field' ) ) :
	function conj_lite_wc_search_field() {

		?>
		<div class="site-wc-search">
			<?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>
		</div>
		<?php

	}
endif;

/**
 * Cart Link.
 * Displayed a link to the cart including the number of items present and the cart total.
 *
 * @uses 	get_cart_subtotal()
 * @uses 	get_cart_contents_count()
 * @return  void
 */
if ( ! function_exists( 'conj_lite_wc_cart_link' ) ) :
	function conj_lite_wc_cart_link() {

		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'conj-lite' ); ?>">
			<?php /* translators: number of items in the mini cart. */ ?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'conj-lite' ), WC()->cart->get_cart_contents_count() ) );?></span>
		</a>
		<?php

	}
endif;

/**
 * Display Header Cart.
 *
 * @uses 	is_cart()
 * @uses 	the_widget()
 * @uses 	conj_lite_wc_cart_link()
 * @return  void
 */
if ( ! function_exists( 'conj_lite_wc_header_cart' ) ) :
	function conj_lite_wc_header_cart() {

		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		} // End If Statement
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>"><?php conj_lite_wc_cart_link(); ?></li>
			<li><?php the_widget( 'WC_Widget_Cart', 'title=' ); ?></li>
		</ul>
		<?php

	}
endif;

/**
 * Used to wrap the "#order_review" tag.
 *
 * @uses 	get_theme_mod()
 * @uses 	conj_is_not_checkout_page()
 * @return  void
 */
if ( ! function_exists( 'conj_lite_wc_checkout_order_review_wrapper' ) ) :
	function conj_lite_wc_checkout_order_review_wrapper() {

		?><div class="conj-lite-wc-checkout-order-review__wrapper"><?php

	}
endif;

/**
 * Prepends a heading tag to the "#order_review" container.
 *
 * @return  void
 */
if ( ! function_exists( 'conj_lite_wc_checkout_order_review_heading' ) ) :
	function conj_lite_wc_checkout_order_review_heading() {

		?><h3 class="conj-lite-wc-checkout-order-review__heading"><?php esc_html_e( 'Your order', 'conj-lite' ); ?></h3><?php

	}
endif;

/**
 * Used to close the wrapper of "#order_review" tag.
 *
 * @return  void
 */
if ( ! function_exists( 'conj_lite_wc_checkout_order_review_wrapper_close' ) ) :
	function conj_lite_wc_checkout_order_review_wrapper_close() {

		?></div><!-- .conj-lite-wc-checkout-order-review__wrapper -->
		<?php

	}
endif;

/**
 * Display Featured and On-Sale Products.
 * Check for featured products then on-sale products and use the appropiate shortcode.
 * If neither exist, it can fallback to show recently added products.
 *
 * @param 	integer $per_page total products to display.
 * @param 	integer $columns columns to arrange products in to.
 * @param 	boolean $recent_fallback Should the function display recent products as a fallback when there are no featured or on-sale products?.
 * @uses  	wc_get_featured_product_ids()
 * @uses  	wc_get_product_ids_on_sale()
 * @uses  	conj_lite_do_shortcode()
 * @return 	void
 */
if ( ! function_exists( 'conj_lite_wc_promoted_products' ) ) :
	function conj_lite_wc_promoted_products( $per_page = '4', $columns = '2', $recent_fallback = TRUE ) {

		if ( wc_get_featured_product_ids() ) {
			/* translators: 1: Opening heading tag, 2: Closing heading tag. */
			printf( wp_kses_post( '%1$sFeatured Products%2$s', 'conj-lite' ), '<h2>', '</h2>' );

			echo wp_kses_post( conj_lite_do_shortcode( 'featured_products', array(
				'per_page' => $per_page,
				'columns' => $columns
			) ) );
		} elseif ( wc_get_product_ids_on_sale() ) {
			/* translators: 1: Opening heading tag, 2: Closing heading tag. */
			printf( wp_kses_post( '%1$sOn Sale Now%2$s', 'conj-lite' ), '<h2>', '</h2>' );

			echo wp_kses_post( conj_lite_do_shortcode( 'sale_products', array(
				'per_page' => $per_page,
				'columns' => $columns
			) ) );
		} elseif ( $recent_fallback ) {
			/* translators: 1: Opening heading tag, 2: Closing heading tag. */
			printf( wp_kses_post( '%1$sNew In Store%2$s', 'conj-lite' ), '<h2>', '</h2>' );

			echo wp_kses_post( conj_lite_do_shortcode( 'recent_products', array(
				'per_page' => $per_page,
				'columns' => $columns,
			) ) );
		} // End If Statement

	}
endif;