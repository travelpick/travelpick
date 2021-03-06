<div id="et_main_map"></div>

<script type="text/javascript">
	(function($){
		var $et_main_map = $( '#et_main_map' );

		et_active_marker = null;

		<?php 
				if (isset($_GET['post_type']) && ($_GET['post_type']=='listing'))
				{
					?>
					jQuery('#et-list-view.et-normal-listings').find('.et-date').click();
					<?php 
				}
		?>		

		$et_main_map.gmap3({
			map:{
				options:{
<?php
while ( have_posts() ) : the_post();
	$et_location_lat = get_post_meta( get_the_ID(), '_et_listing_lat', true );
	$et_location_lng = get_post_meta( get_the_ID(), '_et_listing_lng', true );

				if ( '' != $et_location_lat && '' != $et_location_lng )
					printf( 'center: [%s, %s],', $et_location_lat, $et_location_lng );

	break;
endwhile;
rewind_posts();
?>
					zoom:<?php
							if ( is_home() || is_front_page() )
								echo esc_js( et_get_option( 'explorable_homepage_zoom_level', 3 ) );
							else
								echo esc_js( et_get_option( 'explorable_default_zoom_level', 5 ) ); ?>,
					mapTypeId: google.maps.MapTypeId.<?php echo esc_js( strtoupper( et_get_option( 'explorable_map_type', 'Roadmap' ) ) ); ?>,
					mapTypeControl: true,
					mapTypeControlOptions: {
						position : google.maps.ControlPosition.LEFT_CENTER,
						style : google.maps.MapTypeControlStyle.DROPDOWN_MENU
					},
					streetViewControlOptions: {
						position: google.maps.ControlPosition.LEFT_CENTER
					},
					navigationControl: false,
					scrollwheel: true,
					streetViewControl: true,
					zoomControl: false
				}
			}
		});

		function et_add_marker( marker_order, marker_lat, marker_lng, marker_description ){
			var marker_id = 'et_marker_' + marker_order;

			$et_main_map.gmap3({
				marker : {
					id : marker_id,
					latLng : [marker_lat, marker_lng],
					options: {
						icon : "<?php echo get_template_directory_uri(); ?>/images/red-marker.png"
					},
					events : {
						click: function( marker ){
							if ( et_active_marker ){
								et_active_marker.setAnimation( null );
								et_active_marker.setIcon( '<?php echo get_template_directory_uri(); ?>/images/red-marker.png' );
							}
							et_active_marker = marker;

							marker.setAnimation( google.maps.Animation.BOUNCE);
							marker.setIcon( '<?php echo get_template_directory_uri(); ?>/images/blue-marker.png' );
							$(this).gmap3("get").panTo( marker.position );

							$.fn.et_simple_slider.external_move_to( marker_order );
						},
						mouseover: function( marker ){
							$( '#' + marker_id ).css( { 'display' : 'block', 'opacity' : 0 } ).stop(true,true).animate( { bottom : '15px', opacity : 1 }, 500 );
						},
						mouseout: function( marker ){
							$( '#' + marker_id ).stop(true,true).animate( { bottom : '50px', opacity : 0 }, 500, function() {
								$(this).css( { 'display' : 'none' } );
							} );
						}
					}
				},
				overlay : {
					latLng : [marker_lat, marker_lng],
					options : {
						content : marker_description,
						offset : {
							y:-42,
							x:-122
						}
					}
				}
			});
		}

<?php
$i = 0;
while ( have_posts() ) : the_post();
	$et_location_lat = get_post_meta( get_the_ID(), '_et_listing_lat', true );
	$et_location_lng = get_post_meta( get_the_ID(), '_et_listing_lng', true );

	$et_location_rating = '<div class="location-rating"></div>';
	if ( ( $et_rating = et_get_rating() ) && 0 != $et_rating )
		$et_location_rating = '<div class="location-rating"><span class="et-rating"><span style="' . sprintf( 'width: %dpx;', esc_attr( $et_rating * 17 ) ) . '"></span></span></div>';

	if ( '' != $et_location_lat && '' != $et_location_lng ) {
?>
			et_add_marker( <?php printf( '%1$d, %2$s, %3$s, \'<div id="et_marker_%1$d" class="et_marker_info"><div class="location-description"> <div class="location-title"> <h2>%4$s</h2> <div class="listing-info"><p>%5$s</p></div> </div> ' . $et_location_rating . ' </div> <!-- .location-description --> </div> <!-- .et_marker_info -->\'',
				$i,
				esc_html( $et_location_lat ),
				esc_html( $et_location_lng ),
				get_the_title(),
				wp_strip_all_tags( addslashes( get_the_term_list( get_the_ID(), 'listing_type', '', ', ' ) ) )
			); ?> );
<?php
	}

	$i++;
endwhile;

rewind_posts();
?>
		})(jQuery)
	</script>

<div id="et-slider-wrapper" class="et-map-post">
	<div id="et-map-slides">

<?php
	$i = 1;
	while ( have_posts() ) : the_post();
		$thumb = '';
		$width = (int) apply_filters( 'et_map_image_width', 480 );
		$height = (int) apply_filters( 'et_map_image_height', 240 );
		$classtext = '';
		$titletext = get_the_title();
		$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'MapIndex' );
		$thumb = $thumbnail["thumb"];
?>
		<div class="et-map-slide<?php if ( 1 == $i ) echo esc_attr( ' et-active-map-slide' ); ?>">
		<?php if ( ''!= $thumb ) { ?>
			<div class="thumbnail">
				<?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext ); ?>
				<div class="et-description">
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<?php if ( ( $et_description = get_post_meta( get_the_ID(), '_et_listing_description', true ) ) && '' != $et_description ) : ?>
					<p><?php echo esc_html( $et_description ); ?></p>
				<?php endif; ?>
				<?php if ( ( $et_rating = et_get_rating() ) && 0 != $et_rating ) : ?>
					<span class="et-rating"><span style="<?php printf( 'width: %dpx;', esc_attr( $et_rating * 21 ) ); ?>"></span></span>
				<?php endif; ?>
				</div>
			<?php
				printf( '<div class="et-date-wrapper"><span class="et-date">%s<span>%s</span></span></div>',
					get_the_time( _x( 'F j', 'Location date format first part', 'Explorable' ) ),
					get_the_time( _x( 'Y', 'Location date format second part', 'Explorable' ) )
				);
			?>
			</div>
		<?php } ?>

		<?php if ( ( $et_location_address = get_post_meta( get_the_ID(), '_et_listing_custom_address', true ) ) && '' != $et_location_address ) : ?>
			<div class="et-map-postmeta"><?php echo esc_html( $et_location_address ); ?></div>
		<?php endif; ?>

			<div class="et-place-content">
				<div class="et-place-text-wrapper">
					<div class="et-place-main-text">
						<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
						<div class="viewport">
							<div class="overview">
							<?php
								if ( has_excerpt() )
									the_excerpt();
								else
									the_content( '' );
							?>
							</div>
						</div>
					</div> <!-- .et-place-main-text -->
				</div> <!-- .et-place-text-wrapper -->
				<a class="more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'More Information', 'Explorable' ); ?><span>&raquo;</span></a>
			</div> <!-- .et-place-content -->
		</div> <!-- .et-map-slide -->
<?php
	$i++;
	endwhile;

	rewind_posts();
?>
	</div> <!-- #et-map-slides -->
</div> <!-- .et-map-post -->


<?php
	$listing_types_args = array( 'hide_empty' => 1 );
	$listing_locations_args = array( 'hide_empty' => 1 );
	$listing_types = get_terms( 'listing_type', apply_filters( 'listing_types_args', $listing_types_args ) );
	$listing_locations = get_terms( 'listing_location', apply_filters( 'listing_locations_args', $listing_locations_args ) );
?>

<div id="filter-bar">
	<div class="container" style="width:100%;text-align:center;">
		<form method="get" id="et-filter-map" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="text-align:left;">
			<?php
			foreach( get_taxonomies( array( 'show_ui' => true, 'public' => true, 'object_type'=>array('listing') ), 'objects' ) as $taxonomy ) {
				$etName = $taxonomy->name;//str_ireplace("_", "-", $taxonomy->name);
				echo '<a href="#" class="filter-type '.esc_html($etName).'"><span class="et_explorable_filter_text">'.esc_html( $taxonomy->label).'</span><span class="et_filter_arrow"></span></a>';
			}
			?>		

			<button id="et-filter"><?php esc_html_e( 'Filter', 'Explorable' ); ?></button>
			<input type="hidden" value="" name="s" />
			<input type="hidden" value="listing" name="post_type" />

			<?php
			$taxOptions = get_option( STAXO_OPTION );
		    $taxOpt = array();
		    foreach( (array) $taxOptions['taxonomies'] as $taxo )
		    {
		    	$taxOpt[$taxo['name']] = array(
		    		'required'=>isset($taxo['required']) ? $taxo['required'] : 1,
		    	);
		    }			
			foreach( get_taxonomies( array( 'show_ui' => true, 'public' => true, 'object_type'=>array('listing') ), 'objects' ) as $taxonomy ) {
				
				$etName = $taxonomy->name;
				$required = 0;
				if ($taxOpt[$etName]['required'])
				{
					$required=1;
				}
				
				
				if (!$required)
				{
					echo '<select multiple name="et-'.$etName.'[]" id="et-'.$etName.'" data-filter="et-ab-select" data-required='.$required.'  data-link-name="'.esc_html($etName).'" style="display:none">';					
				}
				else 
				{
					echo '<select name="et-'.$etName.'" id="et-'.$etName.'" data-filter="et-ab-select" data-required='.$required.'  data-link-name="'.esc_html($etName).'" style="display:none">';					
				}

				echo '<option value="none">'.esc_html( $taxonomy->label).'</option>';
				
				$items_args = array( 'hide_empty' => 1 );
				$items = get_terms( $taxonomy->name, apply_filters( $taxonomy->name.'_args', $items_args ) );
				
				if ( $items ) {
					foreach( $items as $item ) {
						
						$selectedMulti = "";
						if ( isset( $_GET['et-'.$etName] ) && 'none' != $_GET['et-'.$etName])
						{
							if ($taxOpt[$etName]['required'])
							{
								$selectedMulti = selected( intval( $_GET['et-'.$etName] ), $item->term_id, false );
							}
							else
							{
								foreach($_GET['et-'.$etName] as $vl)
								{
									$selectedMulti = selected( intval( $vl ), $item->term_id, false );
									if ($selectedMulti)
										break;
								}								
							}						
						}
						
						printf( '<option value="%d"%s>%s</option>',
							esc_attr( $item->term_id ),
							$selectedMulti,
							esc_html( $item->name )
						);
					}
				}				
				echo '</select>';
			}
			?>	
			
			<button id="et-filter" class="filter-reset"><?php esc_html_e( 'Reset', 'Explorable' ); ?></button>

		</form>
	</div> <!-- .container -->
</div> <!-- #filter-bar -->

<?php 
	$classs = "";
	if (isset($_GET['post_type']) && ($_GET['post_type']=='listing'))
	{
		$classs = 'et-listview-open';
	}
?>

<div id="et-list-view" class="et-normal-listings <?php echo $classs;?>">
	<h2 id="listing-results"><?php esc_html_e( 'Listing Results', 'Explorable' ); ?></h2>

	<div id="et-listings">
		<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
		<div class="viewport">
			<div class="overview">
				<ul>
<?php
				$i = 1;
				while ( have_posts() ) : the_post();
					$thumb = '';
					$width = (int) apply_filters( 'et_listing_results_image_width', 60 );
					$height = (int) apply_filters( 'et_listing_results_image_height', 60 );
					$classtext = '';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'ListingIndex' );
					$thumb = $thumbnail["thumb"];
					
					$url = get_post_meta( get_the_ID(), "URL");
?>
					<li class="<?php if ( 1 == $i ) echo esc_attr( 'et-active-listing ' ); ?>clearfix">
						<div class="listing-image">
							<?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext ); ?>
						</div> <!-- .listing-image -->
						<div class="listing-text">
							<h3><a class="post-link" href="<?php echo reset($url)?>"><?php the_title(); ?></a></h3>
										
							<?php 
								//���� �� �����
								/*
								foreach( get_taxonomies( array( 'show_ui' => true, 'object_type'=>array('listing') ), 'objects' ) as $taxonomy ) {
									$etName = $taxonomy->name;
									echo '<p>', wp_strip_all_tags( get_the_term_list( get_the_ID(), $etName, esc_html( $taxonomy->label).": ", ", ") ), '</p>';
								}*/
								
							?>	
							
						<?php if ( ( $et_rating = et_get_rating() ) && 0 != $et_rating ) : ?>
							<span class="et-rating"><span style="<?php printf( 'width: %dpx;', esc_attr( $et_rating * 17 ) ); ?>"></span></span>
						<?php endif; ?>
						</div> <!-- .listing-text -->
						<a href="<?php the_permalink(); ?>" class="et-mobile-link"><?php esc_html_e( 'Read more', 'Explorable' ); ?></a>
					</li>
<?php
					$i++;
				endwhile;
?>
				</ul>
			</div> <!-- .overview -->
		</div> <!-- .viewport -->
	</div> <!-- #et-listings -->
</div> <!-- #et-list-view -->	