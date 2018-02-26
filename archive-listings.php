<?php
/*
*
*  Template Name: Truck List
*
*/

get_header();

?>
<section class="pad-top-half pad-bot-half">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="title-block-wrap pad-top-hhalf">
          <div class="title-block-line1"></div>
          <div class="title-block-line2"></div>
          <div class="title-block-content">
            <div class="title-block-title-1 uppercase font-h font-weight-300">LATEST</div>
						<div class="title-block-title-2 uppercase font-h font-weight-700">Trucks</div>
          </div>
		    </div>
			</div>
			<div class="col-md-9">
				<?php
				$terms = get_terms( 'truck-type', 'hide_empty=0' );
				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
					echo '<ul class="truck-search-list">';
						foreach ( $terms as $term ) {
								$icon_url = get_term_meta( $term->term_id, '_truck_type_thumb', true );
								echo '<li id="truck-type-'.$term->slug.'" class="ease">
												<a href="'.get_home_url().'/'.get_queried_object()->post_name.'?truck-type='.$term->slug.'">
													<div class="truck-search-list-item">
														<div class="truck-search-image">
															<img class="svg-convert" src="'.$icon_url.'" alt="'.$term->name.'" />
														</div>
														<div class="truck-category uppercase font-h font-size-1 font-weight-600">'.$term->name.'</div>
													</div>
												</a>
											</li>';
						}
					echo '</ul>';
				}
				?>
			</div>
		</div>
	</div>
</section>

<div class="container">
    <div class="archive-listing-page">
        <div class="archive-listing-page_row">
            <div class="archive-listing-page_side">
							<div class="search-options-form">
								<?php stm_listings_load_template('filter/sidebar'); ?>
							</div>
							<div class="truck-post-content-wrap">
								<div class="truck-post-sidebar">
									<?php
											if(is_active_sidebar('listing-sidebar')){
											dynamic_sidebar('listing-sidebar');
											}
									?>
								</div>
							</div>
            </div>
            <div class="archive-listing-page_content">
							<div class="sort-order-line"></div>
							<?php stm_listings_load_template('filter/actions'); ?>
              <div id="listings-result">
                <?php stm_listings_load_results(); ?>
              </div>
            </div>
        </div>
    </div>
</div>

<?php

 get_footer();

?>
