<?php
/*
Template Name: Full Width Template
*/
?>
<?php get_header(); ?>
<div class="container-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">     
                <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
                    <div class="content">
                        <h1><?php the_title(); ?></h1>
                        <?php the_content(); ?>
                    </div>
                    <div class="comments-template">
                        <?php comments_template(); ?>
                    </div>
                     <?php edit_post_link('Edit'); ?>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
  
<?php get_footer(); ?>