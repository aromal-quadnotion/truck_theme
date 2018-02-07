<?php
get_header();

if ( have_posts() ) :
	// Start the Loop.
	while ( have_posts() ) : the_post();
// $post_image = get_the_post_thumbnail_url( get_the_ID(), 'large' );
// var_dump($post_image);
?>

    <section class="truck-post-title-wrap" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>')">
      <div class="truck-post-title-bg"></div>
      <div class="container pad-top-half pad-bot-half">
        <div class="row">
          <div class="col-md-8">
            <div class="truck-post-title-line1"></div>
            <div class="truck-post-title-line2"></div>
            <div class="truck-post-title">
              <span class="font-size-8 white uppercase font-h font-weight-600"><?php echo get_the_title(); ?></span>
            </div>
            <div class="truck-post-date-and-author">
                <span class="truck-post-title-date font-size-2 font-h font-weight-300"><img class="font-size-1 white" src="<?php echo esc_url(get_template_directory_uri())?>/images/blog-page-icon.png" alt="blog date icon" />
                <?php echo get_the_time('d M, Y'); ?></span>
                <span class="truck-post-title-author font-size-2 font-h font-weight-300"><img class="font-size-1" src="<?php echo esc_url(get_template_directory_uri())?>/images/author-icon.png" alt="blog author" />
                <?php echo ucfirst(get_the_author()); ?></span>
            </div>
          </div>
          <div class="col-md-4"></div>
        </div>
        </div>
      </div>
    </section>
    <div class="container pad-top-hhalf">
      <div class="row">
        <div class="col-md-12">
          <div class="truck-post-breadcrumb"><?php get_breadcrumb(); ?></div>
        </div>
      </div>
    </div>
    <section class="truck-post-content-wrap">
      <div class="container pad-top-hhalf pad-bot-hhalf">
        <div class="row">
          <div class="col-md-9">
            <div class="truck-post-content">
              <?php the_content(); ?>
            </div>
            <div class="truck-post-tags pad-top-half pad-bot-hhalf">
    	        <?php the_tags(' ', ' ', ''); ?>
    	      </div>
          </div>
          <div class="col-md-3">
            <div class="truck-post-sidebar">
              <?php
                  if(is_active_sidebar('post-page-sidebar')){
                  dynamic_sidebar('post-page-sidebar');
                  }
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>



<?php   endwhile;
        endif; //ends the loop

get_footer(); ?>
