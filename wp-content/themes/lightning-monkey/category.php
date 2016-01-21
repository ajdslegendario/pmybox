<?php get_header(); ?>
<div class="container-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-8" id="blog-excerpt-container">
            <?php $date_format = get_option( 'date_format' ); ?>
            <?php /* If this is a category archive */ if (is_category()) { ?>
              <h1 class="archive-header"><?php echo __('Archive for the', 'lightning-monkey'); ?> &#8216;<?php single_cat_title(); ?>&#8217; <?php echo __('Category:', 'lightning-monkey'); ?></h1>
            <?php } ?>
          
            <?php get_template_part('blog-excerpt'); ?>
    </div>
     <div class="col-md-4" id="right-sidebar">
          <?php dynamic_sidebar('right-sidebar'); ?>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>