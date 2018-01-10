<?php
get_header();


if (have_posts()) :
 while (have_posts()) : the_post();


 endwhile;

  else:
 ?>
  <div class="text-center">
      <h2><?php esc_html_e( 'Oops!','truckindia'); ?></h2>
      <p><?php esc_html_e( 'Sorry, no posts matched your criteria.','truckindia'); ?></p>
  </div>

<?php  endif;
get_footer();

?>
