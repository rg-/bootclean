<?php
$args = $args['params']; // passed from shortcode
?>
<div class="wpbc-woocommerce-products woocommerce">
<ul class="products columns-3">
  <?php
    $args = array(
      'post_type' => 'product',
      'posts_per_page' => $args['posts_per_page'],
      );
    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ) {
      while ( $loop->have_posts() ) : $loop->the_post();
        global $product;
        if ( empty( $product ) || ! $product->is_visible() ) {
          return;
        }
        ?><li <?php wc_product_class( '', $product ); ?>><?php
        do_action( 'woocommerce_before_shop_loop_item' );
        do_action( 'woocommerce_before_shop_loop_item_title' );
        do_action( 'woocommerce_shop_loop_item_title' );
        do_action( 'woocommerce_after_shop_loop_item_title' );
        do_action( 'woocommerce_after_shop_loop_item' );
        ?></li><?php
      endwhile;
    } else {
      echo __( 'No products found' );
    }
    wp_reset_postdata();
  ?>
</ul><!--/.products-->
</div>