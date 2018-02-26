<?php
/*
*
*  Template Name: Truck Compare
*
*/
get_header();

if (empty($_COOKIE['compare_ids'])) {
		$compare_ids = array();
} else {
		$compare_ids = $_COOKIE['compare_ids'];
}
$filter_options = stm_get_single_car_listings();

// $empty_cars = 3 - count($compare_ids);
// $counter = 0;

$truck_1_compare_title = '<div class="col-md-3">
														<div class="truck-compare-common">
															<div class="truck-compare-common-image">
																<img src="'.get_template_directory_uri().'/images/truck-compare-page-icon.png" alt="" />
															</div>
															<div class="truck-compare-common-text font-h font-weight-600 font-size-2 uppercase">
																<a class="ease" href="'.get_home_url().'/listings">add to compare</a>
															</div>
														</div>
													</div>';
$truck_2_compare_title = '<div class="col-md-3">
														<div class="truck-compare-common">
															<div class="truck-compare-common-image">
																<img src="'.get_template_directory_uri().'/images/truck-compare-page-icon.png" alt="" />
															</div>
															<div class="truck-compare-common-text font-h font-weight-600 font-size-2 uppercase">
																<a class="ease" href="'.get_home_url().'/listings">add to compare</a>
															</div>
														</div>
													</div>';
$truck_3_compare_title = '<div class="col-md-3">
														<div class="truck-compare-common">
															<div class="truck-compare-common-image">
																<img src="'.get_template_directory_uri().'/images/truck-compare-page-icon.png" alt="" />
															</div>
															<div class="truck-compare-common-text font-h font-weight-600 font-size-2 uppercase">
																<a class="ease" href="'.get_home_url().'/listings">add to compare</a>
															</div>
														</div>
													</div>';

$truck_1_compare_details = array();
$truck_2_compare_details = array();
$truck_3_compare_details = array();

$truck_1_name = '';
$truck_2_name = '';
$truck_3_name = '';

$truck_compare_parts = array();
if(!empty($compare_ids)) {
	if (!empty($filter_options)){
					foreach ($filter_options as $filter_option){
						if ($filter_option['slug'] != 'price') {
							$compare_option = get_post_meta(get_the_id(), $filter_option['slug'], true);
							array_push($truck_compare_parts,$filter_option['single_name']);
						}
					}
	}
}

if (!empty($compare_ids) or count($compare_ids) != 0) {
		$args = array(
				'post_type' => 'listings',
				'post_status' => 'publish',
				'posts_per_page' => 3,
				'post__in' => $compare_ids,
		);
	$compares = new WP_Query($args);
	$master_count_flag = 0;


	if ($compares->have_posts()) {
		while ($compares->have_posts()) {
			$compares->the_post();
			$master_count_flag ++;

// 1

			if (!empty($filter_options)) {
				if($master_count_flag == 1) {
					$thumb_image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
					$price = get_post_meta(get_the_ID(), 'price', true);
					$price_delimeter = get_theme_mod('price_delimeter', ' ');
					$price = number_format($price, 0, '', $price_delimeter);
					$truck_1_name = get_the_title();
					$truck_1_compare_title = '<div class="col-md-3">
																			<div class="truck-compare-common">
																				<div class="truck-compare-image"  style="background-image: url('.$thumb_image_url.');">
																				</div>
																				<div class="truck-compare-title font-r font-weight-700">
																					<h4>'.$truck_1_name.'</h4>
																				</div>
																			</div>
																			<div class="truck-compare-price font-r font-weight-700">
																				Rs. '.$price.'
																			</div>
																			<div class="truck-compare-button text-center">
																				<a class="uppercase ease font-h font-size-1 font-weight-500" href="#">Contact dealer</a>
																			</div>
																		</div>';
					foreach ($filter_options as $filter_option) {
						if ($filter_option['slug'] != 'price') {
							$compare_option = get_post_meta(get_the_id(), $filter_option['slug'], true);

								if (!empty($compare_option)) {
									//if numeric get value from meta
									if (!empty($filter_option['numeric']) and $filter_option['numeric']) {
											array_push($truck_1_compare_details,$compare_option);
									} else {
											//not numeric, get category name by meta
											$data_meta_array = explode(',', $compare_option);
											$datas = array();

											if (!empty($data_meta_array)) {
													foreach ($data_meta_array as $data_meta_single) {
															$data_meta = get_term_by('slug', $data_meta_single, $filter_option['slug']);
															if (!empty($data_meta->name)) {
																	$datas[] = esc_attr($data_meta->name);
															}
													}
											}
											if (!empty($datas)) {
													array_push($truck_1_compare_details, implode(', ', $datas));
											} else {
													array_push($truck_1_compare_details,"Nil");
											}
										}
							} else {
									array_push($truck_1_compare_details,"Nil");
							}
						}
					}
				}

//2

				if($master_count_flag == 2) {
					$thumb_image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
					$price = get_post_meta(get_the_ID(), 'price', true);
					$price_delimeter = get_theme_mod('price_delimeter', ' ');
					$price = number_format($price, 0, '', $price_delimeter);
					$truck_2_name = get_the_title();
					$truck_2_compare_title = '<div class="col-md-3">
																			<div class="truck-compare-common">
																				<div class="truck-compare-image"  style="background-image: url('.$thumb_image_url.');">
																				</div>
																				<div class="truck-compare-title font-r font-weight-700">
																					<h4>'.$truck_2_name.'</h4>
																				</div>
																			</div>
																			<div class="truck-compare-price font-r font-weight-700">
																				Rs. '.$price.'
																			</div>
																			<div class="truck-compare-button text-center">
																				<a class="uppercase ease font-h font-size-1 font-weight-500" href="#">Contact dealer</a>
																			</div>
																		</div>';
					foreach ($filter_options as $filter_option) {
						if ($filter_option['slug'] != 'price') {
							$compare_option = get_post_meta(get_the_id(), $filter_option['slug'], true);

								if (!empty($compare_option)) {
									//if numeric get value from meta
									if (!empty($filter_option['numeric']) and $filter_option['numeric']) {
											array_push($truck_2_compare_details,$compare_option);
									} else {
											//not numeric, get category name by meta
											$data_meta_array = explode(',', $compare_option);
											$datas = array();

											if (!empty($data_meta_array)) {
													foreach ($data_meta_array as $data_meta_single) {
															$data_meta = get_term_by('slug', $data_meta_single, $filter_option['slug']);
															if (!empty($data_meta->name)) {
																	$datas[] = esc_attr($data_meta->name);
															}
													}
											}
											if (!empty($datas)) {
													array_push($truck_2_compare_details, implode(', ', $datas));
											} else {
													array_push($truck_2_compare_details,"Nil");
											}
										}
							} else {
									array_push($truck_2_compare_details,"Nil");
							}
						}
					}
				}

//3
				if($master_count_flag == 3) {
					$thumb_image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
					$price = get_post_meta(get_the_ID(), 'price', true);
					$price_delimeter = get_theme_mod('price_delimeter', ' ');
					$price = number_format($price, 0, '', $price_delimeter);
					$truck_3_name = get_the_title();
					$truck_3_compare_title = '<div class="col-md-3">
																			<div class="truck-compare-common">
																				<div class="truck-compare-image"  style="background-image: url('.$thumb_image_url.');">
																				</div>
																				<div class="truck-compare-title font-r font-weight-700">
																					<h4>'.$truck_3_name.'</h4>
																				</div>
																			</div>
																			<div class="truck-compare-price font-r font-weight-700">
																				Rs. '.$price.'
																			</div>
																			<div class="truck-compare-button text-center">
																				<a class="uppercase ease font-h font-size-1 font-weight-500" href="#">Contact dealer</a>
																			</div>
																		</div>';
					foreach ($filter_options as $filter_option) {
						if ($filter_option['slug'] != 'price') {
							$compare_option = get_post_meta(get_the_id(), $filter_option['slug'], true);

								if (!empty($compare_option)) {
									//if numeric get value from meta
									if (!empty($filter_option['numeric']) and $filter_option['numeric']) {
											array_push($truck_3_compare_details,$compare_option);
									} else {
											//not numeric, get category name by meta
											$data_meta_array = explode(',', $compare_option);
											$datas = array();

											if (!empty($data_meta_array)) {
													foreach ($data_meta_array as $data_meta_single) {
															$data_meta = get_term_by('slug', $data_meta_single, $filter_option['slug']);
															if (!empty($data_meta->name)) {
																	$datas[] = esc_attr($data_meta->name);
															}
													}
											}
											if (!empty($datas)) {
													array_push($truck_3_compare_details, implode(', ', $datas));
											} else {
													array_push($truck_3_compare_details,"Nil");
											}
										}
							} else {
									array_push($truck_3_compare_details,"Nil");
							}
						}
					}
				}
			}
		}
	}
}
?>
<section class="truck-compare-prev-block pad-top-half pad-bot-half">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="title-block-wrap pad-top-hhalf pad-bot-half">
          <div class="title-block-line1"></div>
          <div class="title-block-line2"></div>
          <div class="title-block-content">
            <div class="title-block-title-1 uppercase font-h font-weight-300">Compare</div>
						<div class="title-block-title-2 uppercase font-h font-weight-700">Trucks</div>
          </div>
		    </div>
			</div>
				<?php echo $truck_1_compare_title; ?>
				<?php echo $truck_2_compare_title; ?>
				<?php echo $truck_3_compare_title; ?>

		</div>
	</div>
</section>

<?php
 if(!empty($compare_ids))
	{
	 ?>
		<section class="truck-compare-listing-wrap pad-top-half pad-bot-half">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<table class="table">
							<tr class=row>
								<th class=col-md-3>Truck Name</th>
								<th class=col-md-3><?php echo $truck_1_name; ?></th>
								<th class=col-md-3><?php echo $truck_2_name; ?></th>
								<th class=col-md-3><?php echo $truck_3_name; ?></th>
							</tr>
							<?php
							$output = '';

							$list_items_count = count($truck_compare_parts);

							for($i = 0; $i < $list_items_count; $i++){
								$main_label = $truck_compare_parts[$i];

								$truck_1_label_value = '';
								if(!empty($truck_1_compare_details[$i]))
									$truck_1_label_value = $truck_1_compare_details[$i];

								$truck_2_label_value = '';
								if(!empty($truck_2_compare_details[$i]))
									$truck_2_label_value = $truck_2_compare_details[$i];

								$truck_3_label_value = '';
								if(!empty($truck_3_compare_details[$i]))
									$truck_3_label_value = $truck_3_compare_details[$i];

								$output .= '<tr class="row"><td class="col-md-3">'.$main_label.'</td>
																		  <td class="col-md-3">'.$truck_1_label_value.'</td>
																		  <td class="col-md-3">'.$truck_2_label_value.'</td>
																		  <td class="col-md-3">'.$truck_3_label_value.'</td></tr>';
							}

							echo $output;
							 ?>
						 </table>
					</div>
				</div>
			</div>
		</section>
<?php
	}
?>



	 <section class="related-truck-section">
	 	<div class="container">
	 		<div class="row">
	 			<div class="col-md-12">
	 				<div class="title-block-wrap mar-top-half mar-bot-half">
	 					<div class="title-block-line1"></div>
	 					<div class="title-block-line2"></div>
	 					<div class="title-block-content">
	 						<p class="title-common uppercase font-h font-weight-300"><span>Latest</span> Trucks</p>
	 					</div>
	 				</div>
	 				<div class="related-truck-wrap owl-carousel owl-theme">


	 					<?php
	 						$latest_trucks_list = '';
	 						$latest_trucks_loop = new WP_Query(
	 							array(
	 								'post_type' => 'listings',
	 								'posts_per_page' => 8,
	 								'post_status' => 'publish',
	 								'post__not_in' => $compare_ids,
	 								'orderby' => 'DEC',
	 							)
	 						);
	 							if ( $latest_trucks_loop->have_posts() )
	 								while ( $latest_trucks_loop->have_posts() ) :
	 									$latest_trucks_loop->the_post();
	 									$thumb_image_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
	 									$title = get_the_title();
	 									$price = get_post_meta(get_the_ID(), 'price', true);
	 									$price_delimeter = get_theme_mod('price_delimeter', ' ');
	 									$price = number_format($price, 0, '', $price_delimeter);
	 									$latest_truck_sub_title = get_post_meta( get_the_ID(),'_truck_list_title',true);
	 									//compare Button
	 									$show_compare = get_theme_mod('show_listing_compare', true);

	 									if (!empty($show_compare) and $show_compare){
	 										if (in_array(get_the_ID(), $compare_ids)){
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
	 									$latest_trucks_list .= '<div class="related-truck-carousel">
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
	 																							 <h6 class="font-h font-size-1 font-weight-500">'.$latest_truck_sub_title.'</h6>
	 																							</div>
	 																							<div class="related-truck-price font-r">
	 																								<span>From</span>Rs. '.$price.'
	 																							</div>
	 																						</div>';
	 									endwhile;
	 									?>
	 							 <!-- Output	 -->
	 							 <?php echo $latest_trucks_list; ?>
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
	 						<div class="title-block-title-1 uppercase font-h font-weight-300">Find</div>
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

 get_footer();

?>
