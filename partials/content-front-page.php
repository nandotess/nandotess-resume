<?php
/**
 * Homepage sections: Widgets
 *
 * @package nandotess-resume
 */
?>

<section id="about" class="section about">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="thumbnail">
						<?php the_post_thumbnail( 'medium', array( 'class' => 'img-responsive' ) ); ?>
					</div>
				<?php endif; ?>

				<h1 class="section-title"><?php bloginfo( 'name' ); ?></h1>

				<?php
					$description = get_bloginfo( 'description', 'display' );

					if ( $description || is_customize_preview() ) : ?>
						<h2 class="section-description"><?php echo $description; /* WPCS: xss ok. */ ?></h2>
					<?php endif;
				?>

				<div class="section-full-description">
					<?php the_content(); ?>
				</div>

				<div class="section-buttons">
					<a href="#" class="btn btn-default btn-lg">Download CV</a>
					<a href="#" class="btn btn-primary btn-lg">Contact me</a>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="homepage-sidebar">
	<?php
		if ( is_active_sidebar( 'homepage-sidebar' ) ) {
			// dynamic_sidebar( 'homepage-sidebar' );
		}
	?>

	<div class="widget widget_skills">
		<section id="skills" class="section skills">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2 class="section-title">Skills</h2>
						<p class="section-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non augue eleifend, placerat nulla eget, sollicitudin nisl. Mauris auctor porttitor est, ut tempus risus sodales id. Morbi suscipit in arcu id tempor. Nam eleifend lobortis elit, vitae pellentesque neque ultricies sed. In sed magna interdum, dapibus neque non, pharetra lorem. Nullam venenatis libero nec fermentum convallis. Aenean posuere tortor ultricies risus feugiat, id placerat risus pharetra. Quisque porta ipsum id sodales rhoncus.</p>
					</div>
				</div>
			</div>
		</section>
	</div>

	<div class="widget widget_works">
		<section id="works" class="section works">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2 class="section-title">Works</h2>
						<p class="section-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non augue eleifend, placerat nulla eget, sollicitudin nisl. Mauris auctor porttitor est, ut tempus risus sodales id. Morbi suscipit in arcu id tempor. Nam eleifend lobortis elit, vitae pellentesque neque ultricies sed. In sed magna interdum, dapibus neque non, pharetra lorem. Nullam venenatis libero nec fermentum convallis. Aenean posuere tortor ultricies risus feugiat, id placerat risus pharetra. Quisque porta ipsum id sodales rhoncus.</p>
					</div>
				</div>
			</div>
		</section>
	</div>

	<div class="widget widget_portfolio">
		<section id="portfolio" class="section portfolio">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2 class="section-title">Portfolio</h2>
						<p class="section-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non augue eleifend, placerat nulla eget, sollicitudin nisl. Mauris auctor porttitor est, ut tempus risus sodales id. Morbi suscipit in arcu id tempor. Nam eleifend lobortis elit, vitae pellentesque neque ultricies sed. In sed magna interdum, dapibus neque non, pharetra lorem. Nullam venenatis libero nec fermentum convallis. Aenean posuere tortor ultricies risus feugiat, id placerat risus pharetra. Quisque porta ipsum id sodales rhoncus.</p>
					</div>
				</div>
			</div>
		</section>
	</div>

	<div class="widget widget_education">
		<section id="education" class="section education">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2 class="section-title">Education</h2>
						<p class="section-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non augue eleifend, placerat nulla eget, sollicitudin nisl. Mauris auctor porttitor est, ut tempus risus sodales id. Morbi suscipit in arcu id tempor. Nam eleifend lobortis elit, vitae pellentesque neque ultricies sed. In sed magna interdum, dapibus neque non, pharetra lorem. Nullam venenatis libero nec fermentum convallis. Aenean posuere tortor ultricies risus feugiat, id placerat risus pharetra. Quisque porta ipsum id sodales rhoncus.</p>
					</div>
				</div>
			</div>
		</section>
	</div>

	<div class="widget widget_contact">
		<section id="contact" class="section contact">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2 class="section-title">Contact</h2>
						<p class="section-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non augue eleifend, placerat nulla eget, sollicitudin nisl. Mauris auctor porttitor est, ut tempus risus sodales id. Morbi suscipit in arcu id tempor. Nam eleifend lobortis elit, vitae pellentesque neque ultricies sed. In sed magna interdum, dapibus neque non, pharetra lorem. Nullam venenatis libero nec fermentum convallis. Aenean posuere tortor ultricies risus feugiat, id placerat risus pharetra. Quisque porta ipsum id sodales rhoncus.</p>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
