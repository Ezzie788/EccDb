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
	?>
	<div class="clear"></div>
	<div id="<?php echo esc_attr( $id ) ?>" class="responsive-post-slider21 responsive-slider clearfix loading" data-lg="<?php echo esc_attr( $columns ); ?>" data-md="<?php echo esc_attr( $columns1 ); ?>" data-sm="<?php echo esc_attr( $columns2 ); ?>" data-xs="<?php echo esc_attr( $columns3 ); ?>" data-mobile="<?php echo esc_attr( $columns4 ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>" data-scroll="<?php echo esc_attr( $scroll ); ?>" data-interval="<?php echo esc_attr( $interval ); ?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-dots="false">
		<div class="resp-slider-container">
			<?php if( $title2 != '' ){?>
			<div class="box-title">
				<h3 class="custom-font"><span><?php echo ( $title2 != '' ) ? $title2 : $term_name; ?></span></h3>
			<?php if( $description != '' ){	echo '<div class="description">'.$description.'</div>'; } ?>
			</div>
			<?php } ?> 
			<div class="slider responsive">
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
									
										echo get_the_post_thumbnail( $post->ID, 'large' ) ? get_the_post_thumbnail( $post->ID, 'large'): '<img src="'.get_template_directory_uri().'/assets/img/placeholder/'.'large'.'.png" alt="No thumb">';		
								}else{
									echo '<img src="'.get_template_directory_uri().'/assets/img/placeholder/'.'large'.'.png" alt="No thumb">';
								}
							?></a>
								<div class="entry-date">
									<span class="days"><?php echo get_the_date( 'd', $post->ID );?></span>
									<span class="month"><?php echo get_the_date( 'M', $post->ID );?></span>
								</div>
							</div>
							<?php } ?>
							<div class="entry-content">
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
								<div class="item-title">
									<h4 class="custom-font"><a href="<?php echo get_permalink($post->ID)?>"><?php echo $post->post_title;?></a></h4>
								</div>
								<div class="entry-meta">
									<div class="entry-author"><span><?php echo esc_html_e('posted by ','sw_core'); ?></span><?php the_author_posts_link(); ?></div>
									<span class="entry-comment"><?php echo get_post()->comment_count; echo ( get_post()->comment_count > 1) ? esc_html_e( ' comments','sw_core' ): esc_html_e(' comment', 'sw_core')?></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
				<?php }?>
			</div>
		</div>
	</div>
	<?php } ?>