<?php
/**
 * The footer.
 *
 * @package nandotess-resume
 */

?>
			</div>

			<footer id="footer" class="footer">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'social',
									'menu_class' => 'nav navbar-nav',
									'container' => false,
								) );
							?>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<?php wp_footer(); ?>
	</body>
</html>
