<link rel="stylesheet" type="text/css" href="http://www.ourstore.com.pk/sa/sweetalert.css">
<script type="text/javascript" src="http://www.ourstore.com.pk/sa/sweetalert.min.js"></script>
<script type="text/javascript" src="http://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript">
    jQuery(document).on('click', '.quickbuy', function(event) {
        event.preventDefault();
        jQuery('.quickbuybutnopen').trigger('click');
        var img  = jQuery(this).parent().find('.inner >').attr('src');
        var title  = jQuery(this).parent().parent().find('.product-loop-title').text();
        var price  = jQuery(this).parent().parent().find('.price ins.not').text();
        if (price == '') {
            price  = jQuery(this).parent().parent().find('.price').text();
        }
        var idpro = jQuery(this).data('proid');
        jQuery('input[name="proid"]').val(idpro);
        jQuery('input[name="pro"]').val(title);
        jQuery('input[name="price"]').val(price);
        jQuery('#fetchcontent1').attr('src', img);
        jQuery('#fetchcontent2').html('<h3>'+title+'</h3>');
    });
    jQuery(document).ready(function(){
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
                phone:"Enter your mobile Number e.g (03358200990)",
                ship_address:"Please enter your complete address",
            }
            ,
            submitHandler: function(form) {
                jQuery('.loadfunc').removeClass('hide');
                var formData=new FormData(jQuery(form)[0]);
                var url=jQuery(form).attr('action');
                jQuery.ajax({
                    type:'post',
                    url:url,
                    contentType:false,
                    processData:false,
                    data:formData,
                    success:function(value){
                        console.log(value);
                        if(value=='true'){
                            jQuery('.loadfunc').hide();
                            swal({title:"Good job!",text:"Thank you. Your order has been received.",type:"success",closeOnConfirm:false,html:false},
                                function(){
                                    document.location='http://www.ourstore.com.pk';
                                }
                                );
                        }
                    }});
            }
        });
        jQuery("#newsletter").submit(function(event){
            event.preventDefault();
            jQuery('.loadfunc').removeClass('hide');
            var formData=new FormData(jQuery(this)[0]);
            var url=jQuery(this).attr('action');
            jQuery.ajax({
                type:'post',
                url:url,
                contentType:false,
                processData:false,
                data:formData,
                success:function(value){
                    console.log(value);
                    if(value=='done'){
                        jQuery('.loadfunc').hide();
                        swal({title:"Good job!",text:"Thank you. You have successfully subscribe our Website Wewsletter",type:"success",closeOnConfirm:false,html:false},
                            function(){
                                document.location='http://www.ourstore.com.pk';
                            }
                            );
                    }
                }});
        });
    });
</script>
