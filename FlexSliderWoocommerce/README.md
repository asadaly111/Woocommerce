## Q. WooCommerce Variation Master is not working?

#### Here is the solution (You should have to use woocommerce default slider in product single page.)

### Step 1
Add these files which I mentioned in code

### Step 2 Add this snipet in footer
```javascript
<!-- FlexSlider -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/flexslider/css/flexslider.css" type="text/css" media="screen" />
<script defer src="<?php echo get_template_directory_uri(); ?>/flexslider/js/jquery.flexslider.js"></script>
<script type="text/javascript">
jQuery(window).load(function(){
		sliderreload();
});
function sliderreload() {
jQuery('.woocommerce-product-gallery').flexslider({
	selector: ".woocommerce-product-gallery__wrapper > .woocommerce-product-gallery__image",
	animation: "slide",
	controlNav: "thumbnails",
	start: function(slider){
	}
});
}
```

### Step 3
Install the pluign
WooCommerce Variation Master

### Step 4
wp-content/plugins/variation-master/assests/js/template/single/ced-vm-single-gallery.js?ver=1.2.0

Replace this file what i have provided in the folder


## Happy Coding




