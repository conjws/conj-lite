<?php
/**
 * The template for displaying the footer
 * Contains the closing of the #content div and all content after.
 *
 * @link 		https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @since 	    1.2.0
 * @package 	conj-lite
 * @author  	MyPreview (Github: @mahdiyazdani, @mypreview)
 */
	
					/**
					 * Functions hooked in to conj_lite_site_content_bottom action
					 *
					 * @hooked conj_lite_site_container_wrapper_close		- 5
					 */
					do_action( 'conj_lite_site_content_bottom' );
					?>
				</div><!-- #content -->

				<?php
				do_action( 'conj_lite_before_footer' ); ?>

				<footer id="colophon" class="site-footer" role="contentinfo" itemscope="itemscope" itemtype="https://schema.org/WPFooter">
					<div class="site-footer__inner">
						<div class="col-full">
							<?php
							/**
							 * Functions hooked in to conj_lite_footer action
							 *
							 * @hooked conj_lite_footer_widgets	  - 10
							 * @hooked conj_lite_credit           - 20
							 */
							do_action( 'conj_lite_footer' ); ?>
						</div><!-- .col-full -->
					</div><!-- .site-footer__inner -->
				</footer><!-- #colophon -->

				<?php
				do_action( 'conj_lite_after_footer' ); ?>
				
			</div><!-- #page -->
		</div><!-- #conj-lite-site-wrapper -->

		<?php 
		do_action( 'conj_lite_after_site' );
		wp_footer(); ?>

	</body>
</html>