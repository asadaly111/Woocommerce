<?php
/**
* The template for displaying product content in the single-product.php template
*
* @version     1.6.4
*/
if ( ! defined( 'ABSPATH' ) ) {
exit;
}
?>
<?php
/**
* woocommerce_before_single_product hook.
*
* @hooked wc_print_notices - 10
*/
do_action( 'woocommerce_before_single_product' );
if ( post_password_required() ) {
echo get_the_password_form();
return;
}
global $porto_layout;
$post_class = join( ' ', get_post_class() );
if ($porto_layout === 'widewidth' || $porto_layout === 'wide-left-sidebar' || $porto_layout === 'wide-right-sidebar') {
$post_class .= 'm-t-lg m-b-xl';
if (porto_get_wrapper_type() !=='boxed')
$post_class .= ' m-r-md m-l-md';
}
?>
<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" class="<?php echo $post_class ?>">
    <div class="row">
        <div class="main-content col-md-9">
            <div class="product-summary-wrap">
                <div class="row">
                    <div class="col-md-5 summary-before">
                        <?php
                        /**
                        * woocommerce_before_single_product_summary hook.
                        *
                        * @hooked woocommerce_show_product_sale_flash - 10
                        * @hooked woocommerce_show_product_images - 20
                        */
                        do_action( 'woocommerce_before_single_product_summary' );
                        ?>
                    </div>
                    <div class="col-md-7 summary entry-summary">
                        <?php
                        /**
                        * woocommerce_single_product_summary hook.
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
                    </div>
                </div>
                </div><!-- .summary -->
            </div>
            <div class="col-md-3 sidebar right-sidebar">
                <div class="myclass">
                    <form method="post" class="innerform" action="<?php echo site_url(); ?>/script.php">
                        <input type="hidden" name="proid" value="<?php echo $post->ID; ?>">
                        <input type="hidden" name="pro">
                        <input type="hidden" name="price">
                        <h1 class="product_title entry-title csheading">quick buy</h1>
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
                            <input autocomplete="off" type="text" class="form-control city_name" id="city_name" name="city_name" placeholder="City- شہر کا انتخاب کریں" required="">
                        </div>
                        <div class="form-group quick_buy_input">
                            <select id="dealLimit" name="qdeal_qty" class="form-control input-sm" required="">
                                <option value="1">
                                    1 Deal quantity
                                </option>
                                <option value="2">
                                    2 Deal quantity
                                </option>
                                <option value="3">
                                    3 Deal quantity
                                </option>
                                <option value="4">
                                    4 Deal quantity
                                </option>
                                <option value="5">
                                    5 Deal quantity
                                </option>
                                <option value="6">
                                    6 Deal quantity
                                </option>
                                <option value="7">
                                    7 Deal quantity
                                </option>
                                <option value="8">
                                    8 Deal quantity
                                </option>
                                <option value="9">
                                    9 Deal quantity
                                </option>
                                <option value="10">
                                    10 Deal quantity
                                </option>
                            </select>
                        </div>
                        <input type="hidden" name="order-complete" value="1">
                        <button type="submit" class="button" style="width: 100%;">Buy Now -  خریدنے کے لئے کلک کریں</button>
                    </form>
                    <link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>/sa/sweetalert.css">
                    <script type="text/javascript" src="<?php echo site_url(); ?>/sa/sweetalert.min.js"></script>
                    <script type="text/javascript">
                    var $=jQuery.noConflict();
                    var pro=$('[itemprop="name"]').text();
                    $('input[name="pro"]').val(pro);
                    var price = $('meta[itemprop=price]').attr("content");
                    $('input[name="price"]').val(price);
                    $(document).ready(function(){
                    jQuery('.innerform').validate({
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
                    phone:"Enter your mobile Number e.g (03358200990)",
                    ship_address:"Please enter your complete address",
                    }
                    ,
                    submitHandler: function(form) {
                    $('.loadfunc').removeClass('hide');
                    var formData=new FormData($(form)[0]);
                    var url=$(form).attr('action');
                    $.ajax({
                    type:'post',
                    url:url,
                    contentType:false,
                    processData:false,
                    data:formData,
                    success:function(value){
                    if(value=='true'){
                    $('.loadfunc').hide();
                    swal({title:"Good job!",text:"Thank you. Your order has been received.",type:"success",closeOnConfirm:false,html:false},
                    function(){
                    document.location='<?php echo site_url();  ?>';
                    }
                    );
                    }
                    }});
                    }
                    });
                    });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <?php
    /**
    * woocommerce_after_single_product_summary hook.
    *
    * @hooked woocommerce_output_product_data_tabs - 10
    * @hooked woocommerce_upsell_display - 15
    * @hooked woocommerce_output_related_products - 20
    */
    do_action( 'woocommerce_after_single_product_summary' );
    ?>
    <meta itemprop="url" content="<?php the_permalink(); ?>" />
    </div><!-- #product-<?php the_ID(); ?> -->
    <div class="loadfunc hide">
        <img src="<?php echo site_url();  ?>/sa/loader1.gif" alt="" class="center-block">
    </div>
    <?php do_action( 'woocommerce_after_single_product' ); ?>
