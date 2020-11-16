<?php 
	/**
		** Theme: Responsive Slider
		** Author: Smartaddons
		** Version: 1.0
	**/
	$default = array(
		'category' => $category, 
		'orderby' => $orderby,
		'order' => $order, 
		'numberposts' => $numberposts,
	);
	$list = get_posts($default);
	do_action( 'before' ); 
	$id = 'sw_reponsive_post_slider_'.rand().time();
	if ( count($list) > 0 ){
	$i = 0;
?>
<div class="clear"></div>
<div id="<?php echo esc_attr( $id ) ?>" class="responsive-post-slider9 clearfix" data-lg="<?php echo esc_attr( $columns ); ?>" data-md="<?php echo esc_attr( $columns1 ); ?>" data-sm="<?php echo esc_attr( $columns2 ); ?>" data-xs="<?php echo esc_attr( $columns3 ); ?>" data-mobile="<?php echo esc_attr( $columns4 ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>" data-scroll="<?php echo esc_attr( $scroll ); ?>" data-interval="<?php echo esc_attr( $interval ); ?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>">
	<div class="resp-slider-container">
		<?php if( $title2 != '' ) { ?>
			<div class="box-title">
			<?php echo ( $title2 != '' ) ? '<h3><span>'. esc_html( $title2 ) .'</span></h3>' : ''; ?>
			<a class="overall pull-right" href="<?php echo esc_url( get_category_link( $category ) );?>"><span><?php echo esc_html__('Overall','sw_core'); ?></span></a>
			</div>
		<?php } ?>
		<div class="slider">
			<div class="wrap-content">
				<?php foreach ($list as $post){ ?>
					<?php if($post->post_content != Null) { ?>
						<div class="item widget-pformat-detail">
							<div class="item-inner">								
								<div class="item-detail">
									<?php if ( has_post_thumbnail( $post->ID ) ){ ?>
									<div class="img_over">
										<a href="<?php echo get_permalink($post->ID)?>" >
											<?php 
										if ( has_post_thumbnail( $post->ID ) ){
											
												echo get_the_post_thumbnail( $post->ID, 'emarket_blog-responsive3' ) ? get_the_post_thumbnail( $post->ID, 'emarket_blog-responsive3' ): '<img src="'.get_template_directory_uri().'/assets/img/placeholder/'.'large'.'.png" alt="No thumb">';		
										}else{
											echo '<img src="'.get_template_directory_uri().'/assets/img/placeholder/'.'large'.'.png" alt="No thumb">';
										}
									?></a>
									</div>
									<?php } ?>
									<div class="entry-content">
										<div class="item-title">
											<h4><a href="<?php echo get_permalink($post->ID)?>"><?php echo $post->post_title;?></a></h4>
										</div>
										<div class="entry-cat">
												<?php 
													$categories = wp_get_post_categories( $post->ID );
													$category_color = '';													
													foreach($categories as $category){
														$category_color =  get_term_meta( $category, 'ets_cat_color2', true );
													  echo '<a data-color="'.esc_attr( $category_color ).'"href="' . get_category_link($category) . '">' . get_cat_name($category) . '</a>';
													}
												?>
										</div>
										<div class="entry-date">
											<span class="entry-day"><?php echo get_the_date( 'j', $post->ID );?></span>
											<span class="entry-month"><?php echo get_the_date( 'M', $post->ID );?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				<?php $i++; } ?>
				<a class="more-cat" href="<?php echo esc_url( get_category_link( $category ) );?>"><span><?php echo esc_html__('More games','sw_core'); ?></span></a>
			</div>
		</div>
	</div>
</div>
<?php } ?>