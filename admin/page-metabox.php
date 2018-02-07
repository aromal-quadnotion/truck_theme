<?php



add_action( 'cmb2_admin_init', 'truckindia_page_metabox' );
/**
 * Hook in and add a page metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function truckindia_page_metabox() {
	$prefix = 'truckindia_page_';

	/**
	 * Sample metabox to pagenstrate each field type included
	 */
	$cmb_page = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Page Option', 'cmb2' ),
		'object_types'  => array( 'page' ), // Post type

	) );


	$cmb_page->add_field( array(
		'name' => esc_html__( 'Hide Page Header', 'cmb2' ),
		'desc' => esc_html__( '', 'cmb2' ),
		'id'   => $prefix . 'hide_page_header',
		'type' => 'checkbox',
	) );

	$cmb_page->add_field( array(
		'name' => esc_html__( 'page short description', 'cmb2' ),
		'desc' => esc_html__( 'type your name here', 'cmb2' ),
		'id'   => $prefix . 'textmedium1',
		'type' => 'text_medium',
	) );

	$cmb_page->add_field( array(
		'name'       => esc_html__( 'Developed By', 'cmb2' ),
		'desc'       => esc_html__( '', 'cmb2' ),
		'id'         => $prefix . 'readonly',
		'type'       => 'text_medium',
		'default'    => esc_attr__( 'Aromal', 'cmb2' ),
		'save_field' => false, // Disables the saving of this field.
		'attributes' => array(
			'disabled' => 'disabled',
			'readonly' => 'readonly',
		),
	) );


}




add_action( 'cmb2_init', 'quadnotion_portfolio_metabox' );
/**
 * Hook in and add a metabox that only appears on the page
 */
function quadnotion_portfolio_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'quadnotion_post_';

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$portfolio_meta = new_cmb2_box( array(
		'id'           => $prefix . 'portfolio_metabox',
		'title'        => esc_html__( 'Portfolio Options', 'cmb2' ),
		'object_types' => array( 'quadnotion-portfolio' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
	) );


	$portfolio_meta->add_field( array(
	'name'    => esc_html__('Category:'),
	'desc'    => '',
	'id'      => $prefix . 'category',
	'type'    => 'text_medium'
) );



	$portfolio_meta->add_field( array(
	'name'    => 'Select Layout',
	'id'      => $prefix . 'layout',
	'type'    => 'radio_inline',
	'options' => array(
		'one-half' => __( 'One Half', 'cmb2' ),
		'one-third'   => __( 'One Third', 'cmb2' ),
		'two-third'     => __( 'Two third', 'cmb2' ),
	),
	'default' => 'one-half',
) );

}
