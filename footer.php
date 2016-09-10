<?php
/**
 * The footer
 *
 * @author   Fernando Tessmann
 * @since    1.0.0
 * @package  nandotess-resume
 */
?>
			</div>

			<footer id="colophon" class="site-footer" role="contentinfo">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<?php
								/**
								 * Functions hooked into nandotess_resume_footer action
								 *
								 * @hooked nandotess_resume_footer_nav_social - 10
								 */
								do_action( 'nandotess_resume_footer' );
							?>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<?php wp_footer(); ?>
	</body>
</html>
