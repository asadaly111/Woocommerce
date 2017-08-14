<!--
completion
How to programmatically detect that a WooCommerce order has completed. In essence, “On order complete”. Easily detect all the status changes an order can go through with actions.

I’ve spent half a day trying to get this working properly. If you want to detect a WooCommerce order being completed in your plugin or theme so as to take an action, you can do so using the woocommerce_order_status_completed action. On order complete I want to change some metadata on some posts automatically, here’s how it’s done:
-->


function mysite_woocommerce_order_status_completed( $order_id ) {
    error_log( "Order complete for order $order_id", 0 );
}
add_action( 'woocommerce_order_status_completed', 'mysite_woocommerce_order_status_completed', 10, 1 );

HOOKS
woocommerce_order_status_pending
woocommerce_order_status_failed
woocommerce_order_status_on-hold
woocommerce_order_status_processing
woocommerce_order_status_completed
woocommerce_order_status_refunded
woocommerce_order_status_cancelled

Here they are again as actions:

function mysite_pending($order_id) {
    error_log("$order_id set to PENDING");
}
function mysite_failed($order_id) {
    error_log("$order_id set to FAILED");
}
function mysite_hold($order_id) {
    error_log("$order_id set to ON HOLD");
}
function mysite_processing($order_id) {
    error_log("$order_id set to PROCESSING");
}
function mysite_completed($order_id) {
    error_log("$order_id set to COMPLETED");
}
function mysite_refunded($order_id) {
    error_log("$order_id set to REFUNDED");
}
function mysite_cancelled($order_id) {
    error_log("$order_id set to CANCELLED");
}

add_action( 'woocommerce_order_status_pending', 'mysite_pending', 10, 1);
add_action( 'woocommerce_order_status_failed', 'mysite_failed', 10, 1);
add_action( 'woocommerce_order_status_on-hold', 'mysite_hold', 10, 1);
// Note that it's woocommerce_order_status_on-hold, and NOT on_hold.
add_action( 'woocommerce_order_status_processing', 'mysite_processing', 10, 1);
add_action( 'woocommerce_order_status_completed', 'mysite_completed', 10, 1);
add_action( 'woocommerce_order_status_refunded', 'mysite_refunded', 10, 1);
add_action( 'woocommerce_order_status_cancelled', 'mysite_cancelled', 10, 1);



Another useful action is woocommerce_payment_complete, called after the payment has been taken for an order. This is useful if you want to perform some automated task after payment has been taken:



function mysite_woocommerce_payment_complete( $order_id ) {
    error_log( "Payment has been received for order $order_id" );
}
add_action( 'woocommerce_payment_complete', 'mysite_woocommerce_payment_complete', 10, 1 );
