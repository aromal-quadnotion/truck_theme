<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category Designova
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */




add_action( 'cmb2_init', 'oscar_register_page_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function oscar_register_page_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_oscar_';
	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_page = new_cmb2_box( array(
		'id'            => $prefix . 'page_metabox',
		'title'         => esc_html__( 'Page Options', 'oscar' ),
		'object_types'  => array( 'page', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		'cmb_styles'    => true, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	$cmb_page->add_field( array(
	    'name'    => esc_html__('Hide Deafult Page Title', 'oscar'),
	    'desc' 	  => esc_html__( 'If on, the default page title will not be displayed.', 'oscar' ),
	    'id'      => $prefix . 'show_title',
	    'type'    => 'checkbox',
	    'default' => oscar_set_checkbox_default( true ),
	    
	) );
	
}




add_action( 'cmb2_init', 'oscar_portfolio_metabox' );
/**
 * Hook in and add a metabox that only appears on the page
 */
function oscar_portfolio_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_oscar_';

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$portfolio_meta = new_cmb2_box( array(
		'id'           => $prefix . 'portfolio_metabox',
		'title'        => esc_html__( 'Project Options', 'oscar' ),
		'object_types' => array( 'oscar-portfolio' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
	) );

	

	$portfolio_meta->add_field( array(
		'name'    => esc_html__( 'Thumbnail Image', 'oscar' ),
		'desc'    => esc_html__( 'Select image from media library/Upload new image.<br/> Use image of width 1200px for better appearance in larger displays.', 'oscar' ),
		'id'      => $prefix . 'portfolio_thumb',
		'type'    => 'file',
		'allow'   => array( 'attachment' ),
		"options" => array(
				        "url" => false
				     )
	) );

	

	$portfolio_meta->add_field( array(
	    'name'    => 'Portfolio Type',
	    'id'      => $prefix . 'portfolio_type',
	    'type'    => 'radio',
	    'options' => array(
	        'lightbox_single_image' => esc_html__( 'Lightbox Single Image', 'oscar' ),
	        'lightbox_image_gallery'   => esc_html__( 'Lightbox Image Gallery', 'oscar' ),
	        'lightbox_yt_video'   => esc_html__( 'Lightbox Youtube Video', 'oscar' ),
	        'lightbox_vimeo_video'   => esc_html__( 'Lightbox Vimeo Video', 'oscar' ),
	        'external_link'   => esc_html__( 'Link to External Page', 'oscar' ),
	    ),
	    'default' => 'lightbox_single_image'
	    
	) );


	$portfolio_meta->add_field( array(
		'name'    => esc_html__( 'Lightbox Image', 'oscar' ),
		'desc'    => esc_html__( 'Select image from media library/Upload new image.', 'oscar' ),
		'id'      => $prefix . 'portfolio_lightbox_image',
		'type'    => 'file',
		'allow'   => array( 'attachment' ),
		"options" => array(
				        "url" => false
				     ),
		'attributes'  => array(
	        'data-rel' => 'lightbox_single_image'
	    )
	) );



	$portfolio_meta->add_field( array(
		'name'    => esc_html__( 'Lightbox Gallery Images', 'oscar' ),
		'desc'    => esc_html__( 'Upload or add multiple images.', 'oscar' ),
		'id'      => $prefix . 'portfolio_lightbox_gallery_images',
		'type'    => 'file_list',
		'allow'   => array( 'attachment' ),
		"options" => array(
				        "url" => false
				     ),
		'preview_size' => array( 200, 200 ),
		'attributes'  => array(
	        'data-rel' => 'lightbox_image_gallery'
	    )
	) );
	

	$portfolio_meta->add_field( array(
		'name' => esc_html__( 'Video Link', 'oscar' ),
		'desc' => esc_html__( '', 'oscar' ),
		'id'   => $prefix . 'lightbox_yt_video',
		'type' => 'oembed',
		'attributes'  => array(
	        'data-rel' => 'lightbox_yt_video'
	    )
	) );


	$portfolio_meta->add_field( array(
		'name' => esc_html__( 'Video Link', 'oscar' ),
		'desc' => esc_html__( '', 'oscar' ),
		'id'   => $prefix . 'lightbox_vimeo_video',
		'type' => 'oembed',
		'attributes'  => array(
	        'data-rel' => 'lightbox_vimeo_video'
	    )
	) );


	$portfolio_meta->add_field( array(
		'name' => esc_html__( 'External URL', 'oscar' ),
		'desc' => esc_html__( 'Provide the external link', 'oscar' ),
		'id'   => $prefix . 'project_link',
		'type' => 'text',
		'attributes'  => array(
	        'data-rel' => 'external_link'
	    )
	) );
	

	$portfolio_meta->add_field( array(
	    'name' => 'Open link in a new window/tab',
	    'desc' => 'if checked, the link will be opened in a new tab or window (optional)',
	    'id' => $prefix . 'project_link_new_tab',
	    'type' => 'checkbox',
	    'attributes'  => array(
	        'data-rel' => 'external_link'
	    )
	) );

}




