<?php get_header(); ?>

<div class="container-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-8" id="blog-excerpt-container">
				<?php get_template_part('blog-excerpt'); ?>
			</div>
			<div class="col-md-4" id="right-sidebar">
				<?php dynamic_sidebar('right-sidebar'); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>