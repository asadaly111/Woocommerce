<h2>Additional Information</h2>
<?php do_action( 'woocommerce_product_meta_start' ); ?>
<div class="span_4">
  <table class="shop_attributes">
    <tbody>
      <?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
      <tr>
        <td><strong style="top: 0">SKU : </strong></td>
        <td><?php echo $product->get_sku(); ?></td>
      </tr>
      <?php endif; ?>
      <tr>
        <td><strong style="top: 0">Category : </strong></td>
        <td><?php echo $product->get_categories( ', ', '' . _n( '', '', $cat_count, 'woocommerce' ) . ' ', '' ); ?></td>
      </tr>
      <tr>
        <td><strong style="top: 0">Tags : </strong></td>
        <td><?php echo $product->get_tags( ', ', '' . _n( '', '', $tag_count, 'woocommerce' ) . ' ', '' ); ?></td>
      </tr>
    </tbody>
  </table>
</div>
<?php do_action( 'woocommerce_product_meta_end' ); ?>
