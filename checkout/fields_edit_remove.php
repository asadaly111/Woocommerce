//All fields can be edit or remove

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

function custom_override_checkout_fields( $fields ) {
	unset($fields['billing']['billing_last_name']);//lastname
	unset($fields['billing']['billing_company']);//billingcompnay
	unset($fields['billing']['billing_country']);//country
	unset($fields['billing']['billing_state']);//province
	$fields['billing']['billing_first_name']['label'] = 'Name';

	echo "<pre>";
	print_r($fields);

	return $fields;
}

