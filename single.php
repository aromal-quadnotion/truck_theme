<?php
get_header(); ?>

    <div class="container">
      <div class="mar-top-half mar-bot-half">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); the_content(); // displays whatever you wrote in the wordpress editor
        endwhile;
        endif; //ends the loop
      ?>
    </div>
  </div>

<?php
get_footer(); ?>
