<?php include 'wp-load.php'; ?>

<link rel="stylesheet" href="http://www.clicknbuy.com.pk/wp-content/themes/shopme/css/bootstrap.min.css">
<style>
	body{background: #e8e8e8;}
</style>
<?php
global $wpdb;
$get = $wpdb->get_results("
SELECT 
A.ID as order_id
,A.post_date as data
, od.order_item_name
, B.meta_value as b_first_name
, D.meta_value as b_address_1
, H.meta_value as b_city
, K.meta_value as b_email
, ll.meta_value as phonenumber
, odmeta.meta_value as qty
, tt.meta_value as Total
FROM wp_posts as A
LEFT JOIN wp_postmeta B
ON A.id = B.post_id AND B.meta_key = '_billing_first_name'
LEFT JOIN wp_postmeta D
ON A.id = D.post_id AND D.meta_key = '_billing_address_1'
LEFT JOIN wp_postmeta H
ON A.id = H.post_id AND H.meta_key = '_billing_city'
LEFT JOIN wp_postmeta ll
ON A.id = ll.post_id AND ll.meta_key = '_billing_phone'
LEFT JOIN wp_postmeta tt
ON A.id = tt.post_id AND tt.meta_key = '_order_total'
LEFT JOIN wp_postmeta K
ON A.id = K.post_id AND K.meta_key = '_billing_email'
LEFT JOIN `wp_woocommerce_order_items` AS `od` ON ( `od`.`order_id` = `A`.`ID` )
LEFT JOIN wp_woocommerce_order_itemmeta odmeta
ON  odmeta.order_item_id = od.order_item_id AND odmeta.meta_key = '_qty'
WHERE A.post_type = 'shop_order'
ORDER BY ID DESC

	");

	
$output = '';
$output .= '
<table class="table table-striped">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Email</th>
		<th>Phone</th>
		<th>Address</th>
		<th>City</th>
		<th>Order</th>
		<th>Quantity</th>
		<th>Total</th>
		<th>Date</th>
	</tr>
';
foreach ($get as $key) {
	$output .= '
	<tr>
		<td>'.$key->order_id.'</td>
		<td>'.$key->b_first_name.'</td>
		<td>'.$key->b_email.'</td>
		<td>'.$key->phonenumber.'</td>
		<td>'.$key->b_address_1.'</td>
		<td>'.$key->b_city.'</td>
		<td>'.$key->order_item_name.'</td>
		<td>'.$key->qty.'</td>
		<td>'.$key->Total.'</td>
		<td>'.$key->data.'</td>
	</tr>
	';
}

	$output .= '
</table>
	';


header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=download.xls");
echo $output;


