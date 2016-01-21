<?php get_header(); ?>
<div class="container-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php if('posts' == get_option( 'show_on_front' )){
                    get_template_part('blog-excerpt');
                } else{

                    if(have_posts()){
                        while(have_posts()){
                            the_post(); ?>

                            <div class="content">
                                <h1><?php the_title(); ?></h1>
                                <div class="entry">
                                    <?php the_content(); ?>
                                    <?php if(comments_open()){ ?>
                                        <p class="postmetadata">
                                        <?php comments_popup_link(__('No Comments &#187;', 'lightning-monkey'), __('1 Comment &#187;', 'lightning-monkey'), __('% Comments &#187;', 'lightning-monkey')); ?>
                                        </p>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="comments-template">
                                <?php comments_template(); ?>
                            </div>

                        <?php } ?>
                    <?php } ?>

                    <?php edit_post_link(__('Edit', 'lightning-monkey')); ?>
                <?php } ?>
            </div>
            <div class="col-md-4" id="right-sidebar">
                <?php dynamic_sidebar('right-sidebar'); ?>  
            </div>
        </div>
    </div>
</div>
  
<?php get_footer(); ?>