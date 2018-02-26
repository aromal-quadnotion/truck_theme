<?php

get_header();

if ( have_posts() ) :

	while ( have_posts() ) : the_post();
//truck title
$truck_name = get_the_title();
$truck_name_segments = explode(' ', $truck_name, 2);
$truck_name = '<span>'.$truck_name_segments[0].'</span> '.$truck_name_segments[1];
//truck sub title get meta
$truck_sub_title = get_post_meta( get_the_ID(),'_truck_list_title',true);
//take the truck Logo
$certified_logo_1 = get_post_meta(get_the_ID(), 'certified_logo_1', true);
$certified_logo_1 = wp_get_attachment_image_src($certified_logo_1, 'full');
$certified_logo_1 = $certified_logo_1[0];
//get the Main Image
$thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full');
//get the price
$price = get_post_meta(get_the_ID(), 'price', true);
$price_delimeter = get_theme_mod('price_delimeter', ' ');
$price = number_format($price, 0, '', $price_delimeter);
$price = '<span>'.stm_get_price_currency().'</span>'.$price;
//get the car details for sidebar
$data = stm_get_single_car_listings();
$data_meta_count = 0;
$single_truck_detail = '';
foreach ($data as $data_value) {
	$data_meta = get_post_meta(get_the_ID(), $data_value['slug'], true);
$data_meta_count++;
			if ($data_meta != '' && $data_meta_count < 5) {

				$single_truck_detail .= '<div class="row">
																		<div class="col-md-6">
																			<div class="details-name">
																				<span class="font-size-1 font-h font-weight-500 uppercase">'.$data_value['single_name'].'</span>
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="details-value">
																				<span class="font-size-1 font-h font-weight-500">'.ucfirst($data_meta).'</span>
																			</div>
																		</div>
																	</div>';
			}
}
//get the car details for content area
$single_truck_details = '';
foreach ($data as $data_value) {
	$data_meta = get_post_meta(get_the_ID(), $data_value['slug'], true);

			if ($data_meta != '') {

				$single_truck_details .= '<div class="feature-tab-details">
																		<div class="row">
																			<div class="col-md-6">
																				<div class="feature-tab-details-name">
																					<span class="font-r font-weight-700">'.$data_value['single_name'].'</span>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="feature-tab-details-value">
																					<span class="font-h font-size-2 font-weight-500">'.ucfirst($data_meta).'</span>
																				</div>
																			</div>
																		</div>
																	</div>';
			}
}

//Truck brochure
$truck_brochure = get_post_meta(get_the_ID(), 'car_brochure', true);
$truck_brochure = wp_get_attachment_url($truck_brochure);
//Truck Full Feature
$truck_feature_list = '';
$truck_features = get_post_meta(get_the_id(), 'additional_features', true);
$truck_features = explode(',', $truck_features);
	foreach($truck_features as $feature) {
		 $truck_feature_list .= '<div class="font-r font-weight-700 single-truck-feature-list">
		 												 <img class="feature-list-icon" src="'.get_template_directory_uri().'/images/checklist.svg" alt="Feature Icon">
														  '.$feature.'</div>';
	}

//compare common

if (empty($_COOKIE['compare_ids'])) {
		$_COOKIE['compare_ids'] = array();
}
$truck_in_compare = $_COOKIE['compare_ids'];
$show_compare = get_theme_mod('show_compare', true);
?>

	<section class="single-truck-title-section pad-top-half pad-bot-min">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-9">
							<h2 class="single-truck-title font-h red font-weight-700 uppercase"><?php echo $truck_name; ?></h2>
							<h6 class="single-truck-sub-title font-size-1 font-h font-weight-700 uppercase"><?php echo esc_html($truck_sub_title) ?></h6>
						</div>
						<div class="col-md-3">
							<div class="single-truck-logo"><img src="<?php echo esc_url($certified_logo_1); ?>" class="img-responsive dp-in"/></div>
						</div>
					</div>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</section>

	<section class="single-truck-content-section">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="single-truck-image-block mar-bot-hhalf">
						<div class="single-truck-full-carousel owl-carousel owl-theme">
							<div class="single-truck-image">
								<img src="<?php echo esc_url($thumbnail_src[0]); ?>" alt="Truck Image">
							</div>
							<?php
						    $gallery = get_post_meta(get_the_id(), 'gallery', true);
						    if (!empty($gallery)) {
						      foreach ($gallery as $gallery_image) {
						        $src = wp_get_attachment_image_src($gallery_image, 'full');
						            ?>
						              <div class="single-truck-image">
						                      <img src="<?php echo esc_url($src[0]); ?>"
						                           alt="<?php echo get_the_title(get_the_ID()) . ' ' . esc_html__('full', 'stm_vehicles_listing'); ?>"/>

						              </div>
						            <?php
						      }
						    }
						  ?>
						</div>
					</div>
					<div class="single-truck-images-thumbnail mar-bot-hhalf">
						<div class="single-truck-thumb-carousel owl-carousel owl-theme">
							<div class="image-thumbnail">
						      <a href="javascript:void(0)">
						          <img src="<?php echo esc_url($thumbnail_src[0]); ?>"
						               alt="<?php echo get_the_title(get_the_ID()) . ' ' . esc_html__('full', 'stm_vehicles_listing'); ?>"/>
						      </a>
						  </div>
						  <?php
						    $gallery = get_post_meta(get_the_id(), 'gallery', true);
						    if (!empty($gallery)) {
						      foreach ($gallery as $gallery_image) {
						        $src = wp_get_attachment_image_src($gallery_image, 'full');
						            ?>
						              <div class="image-thumbnail">
						                  <a href="javascript:void(0)">
						                      <img src="<?php echo esc_url($src[0]); ?>"
						                           alt="<?php echo get_the_title(get_the_ID()) . ' ' . esc_html__('full', 'stm_vehicles_listing'); ?>"/>
						                  </a>
						              </div>
						            <?php
						      }
						    }
						  ?>
						</div>
					</div>
					<div class="single-truck-details-tabs pad-bot-half">
						<section class="wrapper">
							<div class="single-truck-compare-button">
								<?php if (!empty($show_compare) and $show_compare): ?>
				                <?php if (in_array(get_the_ID(), $truck_in_compare)): ?>
				                    <a
				                        href="#"
				                        class="car-action-unit add-to-compare active"
				                        title="<?php esc_html_e('Remove from compare', 'stm_vehicles_listing'); ?>"
				                        data-id="<?php echo esc_attr(get_the_ID()); ?>"
				                        data-title="<?php echo esc_attr(get_the_title()); ?>">
				                    </a>
				                <?php else: ?>
				                    <a
				                        href="#"
				                        class="car-action-unit add-to-compare"
				                        title="<?php esc_html_e('Add to compare', 'stm_vehicles_listing'); ?>"
				                        data-id="<?php echo esc_attr(get_the_ID()); ?>"
				                        data-title="<?php echo esc_attr(get_the_title()); ?>">
				                    </a>
				                <?php endif; ?>

				        <?php endif; ?>
							</div>
							<ul class="tabs">
								<li>Overview</li>
								<li class="active">Tech Spec</li>
								<li>Features</li>
								<li>Variants</li>
								<li>Buy Insurance</li>
								<li>Find Spares</li>
							</ul>

							<ul class="tab__content">
								<li>
									<div class="content__wrapper">
										<div class="single-truck-description">
											<?php the_content(); ?>
										</div>
									</div>
								</li>
								<li class="active">
									<div class="content__wrapper">
										<?php echo $single_truck_details; ?>
									</div>
								</li>
								<li>
									<div class="content__wrapper">
										<?php echo $truck_feature_list; ?>
									</div>
								</li>
								<li>
									<div class="content__wrapper">4</div>
								</li>
								<li>
									<div class="content__wrapper">5</div>
								</li>
								<li>
									<div class="content__wrapper">6</div>
								</li>
							</ul>
						</section>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="col-md-4">
					<div class="single-truck-price white font-h font-weight-600 text-center">
						<?php echo $price; ?>
					</div>
					<a class="white uppercase font-h font-weight-700" href="#">
						<div class="single-truck-apply-finance text-center">
							apply for finance
						</div>
					</a>
					<div class="single-truck-dealer-brochure font-size-1 font-h font-weight-600">
						<a class="single-truck-talk-to-dealer-btn" href="#">Talk To A Dealer</a>
						<a class="single-truck-download-brochure-btn stm-brochure" href="<?php echo esc_url($truck_brochure); ?>">Download Brochure</a>
						<div class="clearfix"></div>
					</div>
					<div class="single-truck-details">
						<?php echo $single_truck_detail; ?>
					</div>
					<div class="truck-finance-calculator-wrap">
						<div class="truck-finance-title">
							<div class="">Financing <span>Calculator</span></div>
						</div>
						<div class="truck-finance-inputs">
							<div class="truck-finance-input-title">Vehicle Price</div>
							<input type="text" id="prncipleAmount" name="prncipleAmount" required class="form-control"/>
							<div class="row">
								<div class="col-md-6">
									<div class="truck-finance-input-title">Interest Rate</div>
									<input type="text" id="InterestRate" name="InterestRate" required class="form-control"/>
								</div>
								<div class="col-md-6">
									<div class="truck-finance-input-title">Tenure</div>
									<input type="text" id="emiMonth" name="emiMonth" required class="form-control"/>
								</div>
							</div>
							<div class="truck-finance-input-title">Down Payment</div>
							<input type="text" id="downPaymeny" name="downPaymeny" required class="form-control"/>
							<div class="row">
								<div class="col-md-6"></div>
								<div class="col-md-6">
									<div class="truck-finance-popup">
										<a href="javascript:void(0)" id="truck-finance-button"><div class="truck-finance-button"> Calculate </div></a>
									</div>
								</div>
							</div>
							<div class="finance-result-wrap">
								<div class="finance-result">
									<div class="finance-result-title">Monthly EMI</div>
									<div id="result" class="finance-result-amount"></div>
									<div class="finance-result-title">Total Interest Payment</div>
									<div id="total-interest" class="finance-result-amount"></div>
									<div class="finance-result-title">Total Amount to Pay</div>
									<div id="total-amount" class="finance-result-amount"></div>
								</div>
							</div>
						</div>
					</div>
					<!-- used for cf7 start-->
					<div class="truck-post-content-wrap">
						<div class="truck-post-sidebar">
							<?php
									if(is_active_sidebar('single-sidebar')){
									dynamic_sidebar('single-sidebar');
									}
							?>
						</div>
					</div>
					<!-- used for cf7 end-->
				</div>
			</div>
		</div>
	</section>


	<section class="related-truck-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="title-block-wrap mar-top-half mar-bot-half">
            <div class="title-block-line1"></div>
            <div class="title-block-line2"></div>
            <div class="title-block-content">
              <p class="title-common uppercase font-h font-weight-300"><span>Related</span> Trucks</p>
            </div>
          </div>
					<div class="related-truck-wrap owl-carousel owl-theme">


						<?php
							$related_trucks_list = '';
							$related_trucks_loop = new WP_Query(
								array(
									'post_type' => 'listings',
									'posts_per_page' => -1,
									'post_status' => 'publish',
									'post__not_in' => array( get_the_ID() ),
									'orderby' => 'rand',
								)
							);
								if ( $related_trucks_loop->have_posts() )
									while ( $related_trucks_loop->have_posts() ) :
										$related_trucks_loop->the_post();
										$thumb_image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
										$title = get_the_title();
										$price = get_post_meta(get_the_ID(), 'price', true);
										$price_delimeter = get_theme_mod('price_delimeter', ' ');
										$price = number_format($price, 0, '', $price_delimeter);
										$related_truck_sub_title = get_post_meta( get_the_ID(),'_truck_list_title',true);
										//compare Button
										$show_compare = get_theme_mod('show_listing_compare', true);

										if (!empty($show_compare) and $show_compare){
											if (in_array(get_the_ID(), $truck_in_compare)){
												$compare_option = '<a
															                href="#"
															                class="add-to-compare active"
															                title="Remove from compare"
															                data-id="'.esc_attr(get_the_ID()).'"
															                data-title="'.esc_attr(get_the_title()).'">
															                <i class="fa fa-plus"></i>
															            </a>';
											}
											else{
												$compare_option = '<a
															                href="#"
															                class="add-to-compare"
															                title="Add to compare"
															                data-id="'.esc_attr(get_the_ID()).'"
															                data-title="'.esc_attr(get_the_title()).'">
															                <i class="fa fa-plus"></i>
															            </a>';
											}
										}
										$related_trucks_list .= '<div class="related-truck-carousel">
																								<div class="related-truck-compare">
																									<div class="stm_compare_unit">
																										'.$compare_option.'
																									</div>
																								</div>
																								<div class="related-truck-image" style="background-image: url('.$thumb_image_url.');">
																									<a href="#">
																									<div class="middle">
																										<div class="text font-size-2 font-h font-weight-700 uppercase">CONTACT DEALER</div>
																									</div>
																									</a>
																								</div>
																								<div class="related-truck-title font-h font-size-2 font-weight-500 uppercase">
																									<a href="'.get_the_permalink().'">'.$title.'</a>
																								</div>
																								<div class="related-truck-sub-title">
																								 <h6 class="font-h font-size-1 font-weight-500">'.$related_truck_sub_title.'</h6>
																								</div>
																								<div class="related-truck-price font-r">
																									<span>From</span>Rs. '.$price.'
																								</div>
																							</div>';
										endwhile;
										?>
								 <!-- Output	 -->
								 <?php echo $related_trucks_list; ?>



					</div>
				</div>
			</div>
		</div>
	</section>


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



<?php

	 endwhile;
        endif; //ends the loop

get_footer();


?>
