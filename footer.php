<?php
/**
 * The footer.
 *
 * @package nandotess-resume
 */

?>
			</div><!-- #content -->

			<footer class="site-footer">
				<div class="grid">
					<div class="col-1-1">
						<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'nandotess-resume' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'nandotess-resume' ), 'WordPress' ); ?></a>
						<span class="sep"> | </span>
						<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'nandotess-resume' ), 'nandotess-resume', '<a href="http://www.fernandotessmann.com" rel="designer">Fernando Tessmann</a>' ); ?>
					</div>
				</div>
			</footer><!-- .site-footer -->
		</div><!-- #page -->

		<?php wp_footer(); ?>
	</body>
</html>
