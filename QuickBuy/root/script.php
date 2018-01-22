<?php
include 'function.php';
	// print_r($_POST);
	// die();
$obj = new dbmanager;
if (isset($_POST['order-complete'])) {
	$date =  date('Y-m-d H:i:s');
	$product = $_POST['pro'];
	$price = $_POST['price'];
	$name = $_POST['username'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['ship_address'];
	$remarks = $_POST['remarks'];
	$city = $_POST['city_name'];
	$quantity = $_POST['qdeal_qty'];
	@$porid = $_POST['proid'];

	$p 	= str_replace('₨', '', $price);
	$p 	= str_replace(',', '', $p);
	$pr =  trim($p)*$quantity;

	$inserts = array(
		'post_status' => 'wc-processing',
		'comment_status' => 'open',
		'ping_status' => 'closed',
		'post_type' => 'shop_order',
		'post_date' => $date,
		);
	$obj->insert('wp_posts', $inserts);
	$id = $obj->last_id();
// insert wp_woocommerce_order_items
	$order_insert = array(
		'order_item_name' => $product,
		'order_id' => $id,
		'order_item_type' => 'line_item',
		);
	$obj->insert('wp_woocommerce_order_items', $order_insert);
	$id_last = $obj->last_id();
// insert quantity in order item meta _line_subtotal
	$ordermeta1 = array(
		'order_item_id' => $id_last,
		'meta_key' => '_qty',
		'meta_value' => $quantity,
		);
	$obj->insert('wp_woocommerce_order_itemmeta', $ordermeta1);
	$ordermeta2 = array(
		'order_item_id' => $id_last,
		'meta_key' => '_line_total',
		'meta_value' => $pr,
		);
	$obj->insert('wp_woocommerce_order_itemmeta', $ordermeta2);
	$ordermeta3 = array(
		'order_item_id' => $id_last,
		'meta_key' => '_line_subtotal',
		'meta_value' => $pr,
		);
	$obj->insert('wp_woocommerce_order_itemmeta', $ordermeta3);
	$ordermeta4 = array(
		'order_item_id' => $id_last,
		'meta_key' => '_product_id',
		'meta_value' => $porid,
		);
	$obj->insert('wp_woocommerce_order_itemmeta', $ordermeta4);			
// ends here
	$val_2 = array(
		'post_id' => $id,
		'meta_key' => '_order_currency',
		'meta_value' => 'PKR',
		);
	$obj->insert('wp_postmeta', $val_2);
	$val_3 = array(
		'post_id' => $id,
		'meta_key' => '_prices_include_tax',
		'meta_value' => 'no',
		);
	$obj->insert('wp_postmeta', $val_3);
	$val_4 = array(
		'post_id' => $id,
		'meta_key' => '_billing_first_name',
		'meta_value' => $name,
		);
	$obj->insert('wp_postmeta', $val_4);
	$val_5 = array(
		'post_id' => $id,
		'meta_key' => '_billing_email',
		'meta_value' => $email,
		);
	$obj->insert('wp_postmeta', $val_5);
	$val_6 = array(
		'post_id' => $id,
		'meta_key' => '_billing_phone',
		'meta_value' => $phone,
		);
	$obj->insert('wp_postmeta', $val_6);
	$val_7 = array(
		'post_id' => $id,
		'meta_key' => '_billing_address_1',
		'meta_value' => $address,
		);
	$obj->insert('wp_postmeta', $val_7);
	$val_8 = array(
		'post_id' => $id,
		'meta_key' => '_billing_city',
		'meta_value' => $city,
		);
	$obj->insert('wp_postmeta', $val_8);
	$val_9 = array(
		'post_id' => $id,
		'meta_key' => '_shipping_first_name',
		'meta_value' => $name,
		);
	$obj->insert('wp_postmeta', $val_9);
	$val_10 = array(
		'post_id' => $id,
		'meta_key' => '_payment_method_title',
		'meta_value' => 'Cash on Delivery',
		);
	$obj->insert('wp_postmeta', $val_10);
	$val_11 = array(
		'post_id' => $id,
		'meta_key' => '_payment_method',
		'meta_value' => 'cod',
		);
	$obj->insert('wp_postmeta', $val_11);
	$val_12 = array(
		'post_id' => $id,
		'meta_key' => '_order_total',
		'meta_value' => $pr,
		);
	$obj->insert('wp_postmeta', $val_12);
	echo "true";
}

if (isset($_POST['newsletter'])) {
	$obj->insert('newsletter', ['email' => $_POST['newsletter'] ] );
	echo "done";
}