<?php
/**
 * Displays the footer widget area
 *
 * @package WordPress
 * @subpackage palichka
 * @since 1.0.0
 */

if ( is_active_sidebar( 'main-content' ) ) : ?>

	<aside class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Main text', 'palichka' ); ?>">
		<?php
		if ( is_active_sidebar( 'main-content' ) ) {
			?>
					<div class="widget-column footer-widget-1">
					<?php dynamic_sidebar( 'main-content' ); ?>
					</div>
				<?php
		}
		?>
	</aside><!-- .widget-area -->

<?php endif; ?>