<?php
/**
* The template for displaying product content in the single-product.php template
*
* Override this template by copying it to yourtheme/woocommerce/content-single-product.php
*
		* @author 		WooThemes
	* @package 	WooCommerce/Templates
* @version     1.6.4
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<?php
	/**
	* woocommerce_before_single_product hook
	*
	* @hooked wc_print_notices - 10
	*/
	do_action( 'woocommerce_before_single_product' );
	if ( post_password_required() ) {
		echo get_the_password_form();
		return;
	}
	?>
	<section class="section_offset">
		<div class="clearfix">
			<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class('product'); ?>>
				<?php $sidebar_position = ''; ?>
				<?php if (is_product()): ?>
					<?php $sidebar_position = SHOPME_HELPER::template_layout_class('sidebar_position'); ?>
				<?php endif; ?>
				<div class="row">
					<div class="col-md-4">
						<div class="single_product images">
							<?php
						/**
						* woocommerce_before_single_product_summary hook
						*
						* @hooked woocommerce_show_product_sale_flash - 10
						* @hooked woocommerce_show_product_images - 20
						*/
						do_action( 'woocommerce_before_single_product_summary' );
						?>
					</div><!--/ .single_product-->
				</div>
				<div class="col-md-5">
					<div class="single_product_description">
						<?php
							/**
							* woocommerce_single_product_summary hook
							*
							* @hooked woocommerce_template_single_title - 5
							* @hooked woocommerce_template_single_rating - 10
							* @hooked woocommerce_template_single_price - 10
							* @hooked woocommerce_template_single_excerpt - 20
							* @hooked woocommerce_template_single_add_to_cart - 30
							* @hooked woocommerce_template_single_meta - 40
							* @hooked woocommerce_template_single_sharing - 50
							*/
							do_action( 'woocommerce_single_product_summary' );
							?>
						</div><!--/ .single_product_description-->
					</div>
					<div class="col-md-3 custom-form">
						<!-- custom form goes here -->
						<div class="myclass">
							<form method="post" class="order-form" action="<?php echo SHOPME_HOME_URL; ?>/script.php">
								<input type="hidden" name="pro">
								<input type="hidden" name="price" value="<?php echo $sale_price = get_post_meta( get_the_ID(), '_price', true); ?>">
								<h3 class="text-uppercase f-open-sans-b text-center title-primary">quick buy</h3>
								<div class="form-group quick_buy_input">
									<input type="text" name="username" class="form-control input-sm" id="username" placeholder="Full Name -  نام" required="">
								</div>
								<div class="form-group quick_buy_input">
									<input type="email" name="email" class="form-control input-sm" id="email" placeholder="Email Address -  ای میل">
								</div>
								<div class="form-group quick_buy_input">
									<input type="tel" name="phone" class="form-control input-sm" id="phone" data-mask="(___) ___-____" placeholder="Mobile Number -  موبائل فون کانمبر" required="">
								</div>
								<div class="form-group quick_buy_input">
									<textarea name="ship_address" class="form-control input-sm" id="ship_address" rows="1" placeholder="Address -  مکمل پتا " required=""></textarea>
								</div>
								<div class="form-group quick_buy_input">
									<textarea name="remarks" class="form-control input-sm" id="remarks" rows="2" placeholder="Other Instructions -  دیگر ہدایات"></textarea>
								</div>
								<div class="form-group quick_buy_input">
									<input autocomplete="off" type="text" class="form-control city_name" id="city_name" name="city_name" placeholder="City- شہر کا انتخاب کریں" required>
								</div>
								<div class="form-group quick_buy_input">
									<select id="dealLimit" name="qdeal_qty" class="form-control input-sm" required="">
										<?php $price = get_post_meta( get_the_ID(), '_price', true); ?>
										<option value="">Please Select Quantity</option>
										<option value="1,<?php echo $price; ?>">Buy 1 Pc Rs.<?php echo $price; ?></option>
										<?php
										$value = get_field( "2_pc_price" );
										if( $value ): ?>
										<option value="2,<?php echo $value; ?>"><?php echo get_field( "name_2pc" ); ?><?php echo $value; ?></option>
									<?php endif ?>
									<?php
									$value2 = get_field( "3_pc_price" );
									if( $value ): ?>
									<option value="3,<?php echo $value2; ?>"><?php echo get_field( "name_3pc" ); ?><?php echo $value2; ?></option>
								<?php endif ?>



							</select>
						</div>
						<input type="hidden" name="order-complete" value="1">
						<button type="submit" class="button">Buy Now -  خریدنے کے لئے کلک کریں</button>
					</form>
					<div class="loadfunc hide">
						<img src="<?php echo site_url(); ?>/sa/laoder.gif" alt="" class="center-block">
					</div>
					<!-- Sweat alert -->
					<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>/sa/sweetalert.css">
					<script type="text/javascript" src="http://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
					<script type="text/javascript" src="<?php echo site_url(); ?>/sa/sweetalert.min.js"></script>
					<script type="text/javascript">
						var $ = jQuery.noConflict();
						var pro = $('[itemprop="name"]').text();
						$('input[name="pro"]').val(pro);
						$(document).ready(function() {

							





jQuery('.order-form').validate({
            rules: {
                username: "required",
                phone: "required",
                phone:{
                    required:true,
                    minlength:7,
                    maxlength:12,
                    number: true,
                },
                ship_address: "required",
            },
            messages: {
                username: "Please enter your name",
                phone:"Enter your mobile Number e.g (03211250796)",
                ship_address:"Please enter your complete address",
            }
            ,
            submitHandler: function(form) {
								$('.loadfunc').removeClass('hide');
								var formData = new FormData($(form)[0]);
								var url = $(form).attr('action');
								$.ajax({
									type: 'post',
									url: url,
									contentType: false,
									processData: false,
									data: formData,
									success: function(value) {
										if (value == 'true') {
											$('.loadfunc').hide();
											swal({
												title: "Good job!",
												text: "Thank you. Your order has been received.",
												type: "success",
												closeOnConfirm: false,
												html: false
											}, function(){
												document.location = '<?php echo site_url(); ?>';
											});
										}
									}
								});
            }
        });




							// $(".order-form").submit(function ( event ) {
							// 	event.preventDefault();
							// 	$('.loadfunc').removeClass('hide');
							// 	var formData = new FormData($(this)[0]);
							// 	var url = $(this).attr('action');
							// 	$.ajax({
							// 		type: 'post',
							// 		url: url,
							// 		contentType: false,
							// 		processData: false,
							// 		data: formData,
							// 		success: function(value) {
							// 			if (value == 'true') {
							// 				$('.loadfunc').hide();
							// 				swal({
							// 					title: "Good job!",
							// 					text: "Thank you. Your order has been received.",
							// 					type: "success",
							// 					closeOnConfirm: false,
							// 					html: false
							// 				}, function(){
							// 					document.location = '<?php echo site_url(); ?>';
							// 				});
							// 			}
							// 		}
							// 	});
							// });




						});
					</script>
				</div>

			</div>
		</div>
		<!-- second row -->
		<div class="row page_wrapper sbr">
			<div class="col-md-9">
				<?php
							/**
							* woocommerce_after_single_product_summary hook
							*
							* @hooked woocommerce_output_product_data_tabs - 10
							* @hooked woocommerce_upsell_display - 15
							* @hooked woocommerce_output_related_products - 20
							*/
							do_action( 'woocommerce_after_single_product_summary' );
							?>
						</div>
						<div class="col-md-3" style="z-index: 137;">
							<div id="woocommerce_product_categories-2" data-animation="fadeInDown" class="widget animated woocommerce widget_product_categories">
								<?php dynamic_sidebar('Custom-woocomerce' ); ?>
							</div>
						</div>
					</div>
					<meta itemprop="url" content="<?php the_permalink(); ?>" />
				</div><!-- #product-<?php the_ID(); ?> -->
			</div><!--/ .clearfix-->
		</section><!--/ .section_offset-->
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('.products').owlCarousel({
					loop:true,
					margin:0,
					nav:true,
					responsive:{
						0:{
							items:1
						},
						600:{
							items:3
						},
						1000:{
							items:3
						}
					}
				});
			});
		</script>