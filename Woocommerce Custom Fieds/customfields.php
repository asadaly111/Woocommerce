// ***********************************
// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );

// Save Fields
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );


function woo_add_custom_general_fields() {

  global $woocommerce, $post;
  
  echo '<div class="options_group">'; 


// Text Field
woocommerce_wp_text_input( 
	array( 
		'id'          => '_text_field', 
		'label'       => __( 'My Text Field', 'woocommerce' ), 
		'placeholder' => 'http://',
		'desc_tip'    => 'true',
		'description' => __( 'Enter the custom value here.', 'woocommerce' ) 
	)
);

// Number Field
woocommerce_wp_text_input( 
	array( 
		'id'                => '_number_field', 
		'label'             => __( 'My Number Field', 'woocommerce' ), 
		'placeholder'       => '', 
		'description'       => __( 'Enter the custom value here.', 'woocommerce' ),
		'type'              => 'number', 
		'custom_attributes' => array(
				'step' 	=> 'any',
				'min'	=> '0'
			) 
	)
);

// Textarea
woocommerce_wp_textarea_input( 
	array( 
		'id'          => '_textarea', 
		'label'       => __( 'My Textarea', 'woocommerce' ), 
		'placeholder' => '', 
		'description' => __( 'Enter the custom value here.', 'woocommerce' ) 
	)
);


// Select
woocommerce_wp_select( 
array( 
	'id'      => '_select', 
	'label'   => __( 'My Select Field', 'woocommerce' ), 
	'options' => array(
		'one'   => __( 'Option 1', 'woocommerce' ),
		'two'   => __( 'Option 2', 'woocommerce' ),
		'three' => __( 'Option 3', 'woocommerce' )
		)
	)
);

// Checkbox
woocommerce_wp_checkbox( 
array( 
	'id'            => '_checkbox', 
	'wrapper_class' => 'show_if_simple', 
	'label'         => __('My Checkbox Field', 'woocommerce' ), 
	'description'   => __( 'Check me!', 'woocommerce' ) 
	)
);


 
  echo '</div>';
	
}



// Product Select
?>



<?php

function woo_add_custom_general_fields_save( $post_id ){
	
	// Text Field
	$woocommerce_text_field = $_POST['_text_field'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_text_field', esc_attr( $woocommerce_text_field ) );
		
	// Number Field
	$woocommerce_number_field = $_POST['_number_field'];
	if( !empty( $woocommerce_number_field ) )
		update_post_meta( $post_id, '_number_field', esc_attr( $woocommerce_number_field ) );
		
	// Textarea
	$woocommerce_textarea = $_POST['_textarea'];
	if( !empty( $woocommerce_textarea ) )
		update_post_meta( $post_id, '_textarea', esc_html( $woocommerce_textarea ) );
		
	// Select
	$woocommerce_select = $_POST['_select'];
	if( !empty( $woocommerce_select ) )
		update_post_meta( $post_id, '_select', esc_attr( $woocommerce_select ) );
		
	// Checkbox
	$woocommerce_checkbox = isset( $_POST['_checkbox'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, '_checkbox', $woocommerce_checkbox );
	
	// Custom Field
	$custom_field_type =  array( esc_attr( $_POST['_field_one'] ), esc_attr( $_POST['_field_two'] ) );
	update_post_meta( $post_id, '_custom_field_type', $custom_field_type );
	
	// Hidden Field
	$woocommerce_hidden_field = $_POST['_hidden_field'];
	if( !empty( $woocommerce_hidden_field ) )
		update_post_meta( $post_id, '_hidden_field', esc_attr( $woocommerce_hidden_field ) );
		
	// Product Field Type
	$product_field_type =  $_POST['product_field_type'];
	update_post_meta( $post_id, '_product_field_type_ids', $product_field_type );
	
}


 ?>
