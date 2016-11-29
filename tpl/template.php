<?php 

$post_selector_pseudo_query = $instance['post'];
// Process the post selector pseudo query.
$processed_query = siteorigin_widget_post_selector_process_query( $post_selector_pseudo_query );

// Use the processed post selector query to find posts.
$query_result = new WP_Query( $processed_query );

// Loop through the posts and do something with them.
if($query_result->have_posts()) : ?>
	<?php $loop_count = 0; ?>
	<?php while($query_result->have_posts() && $loop_count == 0) : $query_result->the_post(); ?>
		<?php $apt_product_obj = new WC_Product(get_the_ID()); ?>
		<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="content-item -apt_countdown_deal -product" style="background-image:url(<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' )[0] ?>)">
				<a href="<?php echo esc_url( get_permalink( $apt_product_obj->id ) ); ?>" title="<?php echo esc_attr( $apt_product_obj->get_title() ); ?>">
					<div class="info">
						<h2 itemprop="name" class="entry-title product-title"><?php echo $apt_product_obj->get_title(); ?></h2>
						<?php if ( ! empty( $show_rating ) ) : ?>
							<?php echo $apt_product_obj->get_rating_html(); ?>
						<?php endif; ?>

						<div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
							<p class="price"><?php echo $apt_product_obj->get_price_html(); ?></p>
						</div>

						<div class="apt_countdown clearfix">
							<div class="apt_countdown_days">
								<div class="apt_countdown_number">00</div>
								<div class="apt_countdown_label">Days</div>
							</div>
							<div class="apt_countdown_hours">
								<div class="apt_countdown_number">00</div>
								<div class="apt_countdown_label">Hours</div>
							</div>
							<div class="apt_countdown_minutes">
								<div class="apt_countdown_number">00</div>
								<div class="apt_countdown_label">Mins</div>
							</div>
							<div class="apt_countdown_seconds">
								<div class="apt_countdown_number">00</div>
								<div class="apt_countdown_label">Secs</div>
							</div>
						</div>

						<meta itemprop="url" content="<?php the_permalink(); ?>" />
					</div><!--info-->
				</a>
			</div>
		</div>
		<script type="text/javascript">
			(function($){
				/**
				 * =====================================================
				 * 		Setup target date
				 * =====================================================
				 */
				var target_date_string = "<?php echo date_i18n( 'Y-m-d', get_post_meta(get_the_ID(), '_sale_price_dates_to', true)); ?>";
				if(!target_date_string) return;
				var $apt_countdown = $(".apt_countdown:last");
				var target_date = new Date( target_date_string ).getTime();
				var countdown = document.getElementById( 'countdown' );

				/**
				 * =====================================================
				 * 		Core Script
				 * =====================================================
				 */

				// variables for time units
				var days, hours, minutes, seconds;

				// update the tag with id "countdown" every 1 second
				setInterval( function () {

					// find the amount of "seconds" between now and target
					var current_date = new Date().getTime();
					var seconds_left = (target_date - current_date) / 1000;

					// do some time calculations
					days = parseInt(seconds_left / 86400);
					seconds_left = seconds_left % 86400;

					hours = parseInt(seconds_left / 3600);
					seconds_left = seconds_left % 3600;

					minutes = parseInt(seconds_left / 60);
					seconds = parseInt(seconds_left % 60);

					// update countdown elements
					$apt_countdown.find(".apt_countdown_days").find(".apt_countdown_number").text(pad(days, 2));
					$apt_countdown.find(".apt_countdown_hours").find(".apt_countdown_number").text(pad(hours, 2));
					$apt_countdown.find(".apt_countdown_minutes").find(".apt_countdown_number").text(pad(minutes, 2));
					$apt_countdown.find(".apt_countdown_seconds").find(".apt_countdown_number").text(pad(seconds, 2));

				}, 1000 );
				function pad(str, max) {
					str = str.toString();
					return str.length < max ? pad("0" + str, max) : str;
				}
			})(jQuery);
		</script>
		<?php $loop_count++; ?>
	<?php endwhile; wp_reset_postdata(); ?>
<?php endif; ?>