<?php
<<<<<<< HEAD
get_header();


if(have_posts()):

      while (have_posts()) : the_post();
          the_content();
      endwhile;
  endif;


get_footer();

?>
=======
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
>>>>>>> 465c9bc3c1a97516f2b3e95f779fc59b489dae6c
