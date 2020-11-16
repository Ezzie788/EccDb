<?php 
/**
	* Layout Countdown Default
	* @version     1.0.0
**/


$term_name = esc_html__( 'All Categories', 'sw_woocommerce' );
$default = array(
	'post_type' => 'product',	
	'meta_query' => array(		
		array(
			'key' => '_sale_price',
			'value' => 0,
			'compare' => '>',
			'type' => 'DECIMAL(10,5)'
		),
		array(
			'key' => '_sale_price_dates_from',
			'value' => time(),
			'compare' => '<',
			'type' => 'NUMERIC'
		),
		array(
			'key' => '_sale_price_dates_to',
			'value' => 0,
			'compare' => '>',
			'type' => 'NUMERIC'
		)
	),
	'orderby' => $orderby,
	'order' => $order,
	'post_status' => 'publish',
	'showposts' => $numberposts	
);
if( $category != '' ){
	
	if ( class_exists('Vc_Manager') ) {
		
	$term = get_term_by( 'slug', $category, 'product_cat' );
	if( $term ) :
		$term_name = $term->name;
	endif; 
	
	$default['tax_query'] = array(
		array(
			'taxonomy'  => 'product_cat',
			'field'     => 'slug',
			'terms'     => $category ));
	}else{
		$term = get_term_by( 'id', $category, 'product_cat' );
		if( $term ) :
			$term_name = $term->name;
		endif; 
	
		$default['tax_query'] = array(
			array(
				'taxonomy'  => 'product_cat',
				'field'     => 'id',
				'terms'     => $category ));
		}
}
$id = 'sw_countdown_'.$this->generateID();
$list = new WP_Query( $default );
if ( $list -> have_posts() ){ ?>
	<div id="<?php echo $category.'_'.$id; ?>" class="sw-woo-container-slider responsive-slider countdown-slider6 loading" data-lg="<?php echo esc_attr( $columns ); ?>" data-md="<?php echo esc_attr( $columns1 ); ?>" data-sm="<?php echo esc_attr( $columns2 ); ?>" data-xs="<?php echo esc_attr( $columns3 ); ?>" data-mobile="<?php echo esc_attr( $columns4 ); ?>" data-md="<?php echo esc_attr( $columns1 ); ?>" data-sm="<?php echo esc_attr( $columns2 ); ?>" data-xs="<?php echo esc_attr( $columns3 ); ?>" data-mobile="<?php echo esc_attr( $columns4 ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>" data-scroll="<?php echo esc_attr( $scroll ); ?>" data-dots="false" data-speed="<?php echo esc_attr( $speed ); ?>" data-scroll="<?php echo esc_attr( $scroll ); ?>" data-interval="<?php echo esc_attr( $interval ); ?>"  data-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-circle="false">       
		<?php if( $title1 != '' ){?>
			<div class="box-title">
				<h3 class="custom-font"><span><?php echo ( $title1 != '' ) ? $title1 : ''; ?></span></h3>
			</div>
		<?php } ?>
		<div class="resp-slider-container">
			<div class="slider responsive">	
			<?php 
				$count_items = 0;
				$count_items = ( $numberposts >= $list->found_posts ) ? $list->found_posts : $numberposts;
				$i = 0;
				while($list->have_posts()): $list->the_post();					
				global $product, $post;
				$class = ( $product->get_price_html() ) ? '' : 'item-nonprice';
				$start_time = get_post_meta( $post->ID, '_sale_price_dates_from', true );
				$countdown_time = get_post_meta( $post->ID, '_sale_price_dates_to', true );	
				$forginal_price = get_post_meta( $post->ID, '_regular_price', true );	
				$fsale_price = get_post_meta( $post->ID, '_sale_price', true );	
				$symboy = get_woocommerce_currency_symbol( get_woocommerce_currency() );
				$date = sw_timezone_offset( $countdown_time );
				if( $i % $item_row == 0 ){
			?>
				<div class="item item-countdown product <?php echo esc_attr( $class )?>" id="<?php echo 'product_'.$id.$post->ID; ?>">
				<?php } ?>
					<div class="item-wrap">
						<div class="item-detail">
							<div class="item-img products-thumb">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php 
										$id = get_the_ID();
										if ( has_post_thumbnail() ){
											echo get_the_post_thumbnail( $post->ID, 'shop_catalog' ) ? get_the_post_thumbnail( $post->ID, 'shop_catalog' ): '<img src="'.get_template_directory_uri().'/assets/img/placeholder/'.'large'.'.png" alt="No thumb">';		
										}else{
											echo '<img src="'.get_template_directory_uri().'/assets/img/placeholder/'.'large'.'.png" alt="No thumb">';
										}
										?>
									</a>
									<?php
											$product_type = ( sw_woocommerce_version_check( '3.0' ) ) ? $product->get_type() : $product->product_type;
											echo sw_label_new();
											if( $product_type != 'variable' ) {
												$forginal_price 	= get_post_meta( $post->ID, '_regular_price', true );	
												$fsale_price 		= get_post_meta( $post->ID, '_sale_price', true );
												if( $fsale_price > 0 && $product->is_on_sale() ){ 
													$sale_off = 100 - ( ( $fsale_price/$forginal_price ) * 100 ); 
													$html = '<div class="sale-off ' . esc_attr( ( sw_label_new() != '' ) ? 'has-newicon' : '' ) .'">';
													$html .= ''.round( $sale_off ).'% '. esc_html__('off','sw_woocommerce');
													$html .= '</div>';
													echo apply_filters( 'sw_label_sales', $html );
												} 
											}else{
												echo '<div class="' . esc_attr( ( sw_label_new() != '' ) ? 'has-newicon' : '' ) .'">';
												wc_get_template( 'single-product/sale-flash.php' );
												echo '</div>';
											}
									?>
								<!-- add to cart, wishlist, compare -->
								<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>		
							</div>
							<div class="item-content">
								<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php sw_trim_words( get_the_title(), $title_length ); ?></a></h4>
								<!-- rating  -->
								<?php 
								$rating_count = $product->get_rating_count();
								$review_count = $product->get_review_count();
								$average      = $product->get_average_rating();
								?>
								<div class="reviews-content">
									<div class="star"><?php echo ( $average > 0 ) ?'<span style="width:'. ( $average*13 ).'px"></span>' : ''; ?></div><div class="rating-count">(<?php echo $rating_count; ?>)</div>
								</div>									
								<!-- end rating  -->
								<!-- Price -->
								<?php if ( $price_html = $product->get_price_html() ){?>
								<div class="item-price">
									<span>
										<?php echo $price_html; ?>
									</span>
								</div>
								<?php } ?>
								<?php if( $date ) : ?>
								<div class="count-left">
									<p><?php esc_html_e( 'Deal ends in:', 'sw_woocommerce' ) ?></p>
								</div>
								<div class="product-countdown2" data-date="<?php echo esc_attr( sw_timezone_offset( $date ) ); ?>"  data-starttime="<?php echo esc_attr( $start_time ); ?>"></div>		
								<?php endif; ?>
							</div>															
						</div>
					</div>
				<?php if( ( $i+1 ) % $item_row == 0 || ( $i+1 ) == $count_items ){?> </div><?php } ?>
			<?php $i ++; endwhile; wp_reset_postdata();?>
			</div>
		</div>            
	</div>
<?php
	} 
?>