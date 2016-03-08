<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

<!--------SKYstudio------------->
<section>
<div class="container">
	<div class="skystudio_sec">
            	<button class="btn btn-primary md-trigger" data-modal="new_video_popup"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ico_play.png" width="33" height="33" align="left" style="margin-right:10px;" />New<br />Video</button>
                
                <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Quick <br />Navigation
                <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Entrance</a></li>
                        <li><a href="#">Helipad</a></li>
                        <li><a href="#">VIP Room</a></li>
                        <li><a href="#">Main Space</a></li>                        
                    </ul>
                </div>
                
            <div class="owl-carousel moodboard-carousel droptarget1">
			
				<?php $i=2;	$image = get_field('collage_new');	$size = 'Large_Watermark'; // (thumbnail, medium, large, full or custom size) ?>

                <?php if ($image): ?>
                                
					<div class="item">
						<img id="drag_image_0" class="img-responsive" src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
                                                <a data-id="0" class="btn btn-add-moodboard" style="display: none;">Add To MoodBoard</a>
					</div>
				
				<?php $i++; endif; ?>
				
				
				<?php	
                                    $images = get_field('location_photos_new');                                                                         
                                ?>
                
				<?php if ($images): ?>
                                
					<?php foreach ($images as $image): ?>
		 
						<div class="item">
							<img id="drag_image_<?php echo $image['ID']?>" data-thumb="<?php echo $image['sizes']['thumbnail']; ?>" src="<?php echo $image['sizes']['Large_Watermark']; ?>" <?php echo $image['alt']; ?> class="img-responsive" />
                                                        <a data-id="<?php echo $image['ID']?>" class="btn btn-add-moodboard" style="display: none;">Add To MoodBoard</a>
						</div>
					<?php endforeach; ?>
					
				<?php endif; ?>
				
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-12">
					<h3><?php the_title(); ?></h3>
					<div class="link">
						
						<?php $city = get_field('city_address'); ?>
							   
					    <?php if( $city): ?>
					   
							  <a href="http://imagelocations.com/locations/?city=<?php echo urlencode($city); ?>"><?php echo $city; ?></a>
							  
						<?php endif; ?>
  
						<span> / </span>
						
						<?php $permits = get_field('permit'); ?>
						
						<?php if( $permits  ): ?>
						
							<?php foreach( $permits as $post): // variable must be called $post (IMPORTANT) ?>
						
								<?php setup_postdata($post); ?>
								
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>									
								
							<?php endforeach; ?>
							
							<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
							
						<?php endif; ?>
						
					</div>
				</div>
                
				<div class="col-md-9 col-sm-12" style="text-align:right">
                	<button class="btn btn-default md-trigger" data-modal="permit_info_popup"><i class="fa fa-check-circle"></i>Permit Info</button>
                	<button class="btn btn-default md-trigger" data-modal="modal-3"><i class="fa fa-share-alt"></i>Share</button>
                	<button class="btn btn-default md-trigger" data-modal="modal-1"><i class="fa fa-phone"></i>Contact Us</button>
                	<button class="btn btn-default open-moodboard"><i class="fa fa-star"></i>Mood Board</button>
                	<button class="btn btn-default btn-download-zip"><i class="fa fa-download"></i>Download</button>
                	<button class="btn btn-default" id="project_item_button" ><i class="fa fa-camera"></i>Projects</button>
                	<button class="btn btn-default md-trigger" data-modal="new_video_popup"><i class="fa fa-play-circle"></i>New Video</button>
                	<button class="btn btn-default md-trigger" data-modal="modal-2"><i class="fa fa-sun-o"></i>Weather</button>
                	<button class="btn btn-default md-trigger" data-modal="location_pdf_popup"><i class="fa fa-file-pdf-o"></i>Location PDF</button>
                </div>            
            </div>
    </div>
</div>
</section>
    
	
<?php $similars = get_field('similar_locations'); ?>

<?php if ($similars): ?>

<!--------SKYstudio------------->
<section>
<div class="container">
	<div class="small_sec">
    	<h3>Similar Locations</h3>
		
            <div class="owl-carousel similar_locations_slider">
			
			<?php foreach ($similars as $similar): // variable must NOT be called $post (IMPORTANT)    ?>
			
				<?php $photo = get_field('main_image_new', $similar->ID); ?>
			
				<?php if (get_post_status($similar->ID) == 'publish'): ?>
				
					<div class="item">
						<a href="<?php echo get_permalink($similar->ID); ?>" title="<?php echo get_the_title($similar->ID); ?>">
							<img src="<?php echo $photo['sizes']['thumbnail']; ?>" class="img-responsive" />
						</a>
					</div>
                
				<?php endif; ?>
				
			<?php endforeach; ?>
			
            </div>
    </div>
</div>
</section>

<?php endif; ?>

<!----------------contact-------------------->
<section>
	<div class="contact_popup">
		<div class="md-modal md-effect-1" id="modal-1">
			<div class="md-content">
				<h3>Contact us about <?php the_title(); ?></h3>
				<div class="row md" id="contact_list">
				
					<div class="col-md-2 col-sm-4 pd user">
						<div class="view view-sixth" id="jennifer">
						<img alt="Jennifer Sanchez" src="/wp-content/uploads/2015/06/02-fd87dc84d53e369b34389a8ba20e9972.jpg" width="100%" class="img-responsive"/>
							<div class="mask">
								<h2>Jennifer Sanchez</h2>
								<p>Executive Location Agent</p>
								<div class="line"></div>
								<p><span>Email</span></p>
							</div>
						</div>
						<div class="clearfix"></div> 
                    </div>
					
					<div class="col-md-2 col-sm-4 pd user">
						<div class="view view-sixth" id="jason">
						<img alt="Jason Radspinner" src="/wp-content/uploads/2015/06/jason.radspinner-4036af3177ecd23681375306c6f0729f.jpg" width="100%" class="img-responsive"/>
							<div class="mask">
								<h2>Jason Radspinner</h2>
								<p>Executive Location Agent</p>
								<div class="line"></div>
								<p><span>Email</span></p>
							</div>
						</div>
						<div class="clearfix"></div> 
                    </div>
					
					<div class="col-md-2 col-sm-4 pd user">
						<div class="view view-sixth" id="kelsii">
						<img alt="Kelsii.Dyer" src="/wp-content/uploads/2015/05/Kelsii-Contact.jpg" width="100%" class="img-responsive"/>
							<div class="mask">
								<h2>Kelsii Dyer</h2>
								<p>Location Agent</p>
								<div class="line"></div>
								<p><span>Email</span></p>
							</div>
						</div>
						<div class="clearfix"></div> 
                    </div>
					
					<div class="col-md-2 col-sm-4 pd user">
						<div class="view view-sixth" id="alice">
						<img alt="Alice Kim" src="/wp-content/uploads/2015/09/alice.kim-dd6c3d56be2499bd550dc2a22e8af26f.jpg" width="100%" class="img-responsive"/>
							<div class="mask">
								<h2>Alice Kim</h2>
								<p>Location Agent</p>
								<div class="line"></div>
								<p><span>Email</span></p>
							</div>
						</div>
						<div class="clearfix"></div> 
                    </div>
					
					<div class="col-md-2 col-sm-4 pd user">
						<div class="view view-sixth" id="paulina">
						<img alt="Paulina Kuszta" src="/wp-content/uploads/2015/06/paulina.kuszta-345ac67e5bf4696fd5304f705e2537c4.jpg" width="100%" class="img-responsive"/>
							<div class="mask">
								<h2>Paulina Kuszta</h2>
								<p>Events Coordinator</p>
								<div class="line"></div>
								<p><span>Email</span></p>
							</div>
						</div>
						<div class="clearfix"></div> 
                    </div>
					
					
				</div>
                <div class="clearfix"></div> 
                <div class="row">
                	<div class="col-md-6">
                    	<div class="black_title">General Contact:</div>
                        <p><span><i class="fa fa-envelope"></i></span>Paul@ImageLocations.com</p>
                        <p><span><i class="fa fa-phone"></i></span>(310) 871-8004</p>
                        <p><span><i class="fa fa-map-marker"></i></span>9663 Santa Monica Blvd. Suite 842, Beverly Hills, CA 90210</p><br /><br />
                    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer_small_logo.jpg" width="209" height="79" />
                    </div>
                	<div class="col-md-6">
                    	<p>To <a id="all_agent" style="display: inline;">(Everyone)</a>:<span id="contact_person" style="color:red"></span></p>
                        <?php echo do_shortcode('[contact-form-7 id="114472" title="Location Contact"]') ?>
                    </div>                    
                </div>
                <button class="md-close1"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/close_icon_white.png" width="20" height="20" /></button>
			</div>
		</div>
		<div class="md-overlay"></div>
     </div>
</section> 

<!----------------New Video Popup-------------------->
<section>
	<div class="new_video_popup">
		<div class="md-modal md-effect-1" id="new_video_popup">
			<div class="md-content">
				<div class="row md">
				
				<?php if(get_field("aerial_video")): ?>
				
					<h3>Aerial Video of <strong><?php the_title(); ?></strong></h3>
					<div class="clearfix">&nbsp;</div>
					<div class="col-md-12">
						<?php echo do_shortcode('[vimeo ' . get_field("aerial_video") . '  w=800&h=456]') ?>
					</div>
				
				<?php else: ?>
				
					<?php echo "<h3>No Video...</h3>"; ?>
				
				<?php endif; ?>
				
				</div>
			<button class="md-close1"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/close_icon_white.png" width="20" height="20" /></button>
			</div>
		</div>
		<div class="md-overlay"></div>
     </div>
</section>

<!----------------Weather-------------------->
<section>
	<div class="weather_popup">
		<div class="md_modal_weather md-effect-1" id="modal-2">
			<div class="md-content">
				<div class="row md">
					<div class="col-md-12">
						<?php echo do_shortcode( "[astero id='24734']" ); ?>
					</div>
				</div>
			<button class="md-close1"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/close_icon_white.png" width="20" height="20" /></button>
			</div>
		</div>
		<div class="md-overlay"></div>
     </div>
</section>


<!----------------share-------------------->
<section>
	<div class="share_popup">
		<div class="md_modal_share md-effect-1" id="modal-3">
			<div class="md-content">
				<h4>Send to Email Address</h4>
                <input type="text" class="form-control" placeholder="Email" />
                <div class="btn btn-primary">Send</div>
                <div class="clearfix"></div>
                <button class="md-close1"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/close_icon_white.png" width="20" height="20" /></button>
			</div>
		</div>
		<div class="md-overlay"></div>
     </div>
</section> 

<!----------------- moodborad------------------------>
<section>
	<div class="mood">
            <div class="droptarget" ondrop="drop(event)" ondragover="allowDrop(event)">
                <div class="photo_h">
                    <div class="owl-carousel droppable-slider">
                    </div>
                </div>        
                <div class="row row-submit-area">
                        <div class="col-md-4 col-md-offset-4">
                            <button type="button" data-modal="location_pdf_moodboard_popup" class="btn btn-primary md-trigger">Generate Custom PDF</button>
                        </div>
                </div>      
                <div class="close"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/close_icon_white.png" width="20" height="20"></div>
            </div>
            <p id="demo"></p>
        </div>
</section>

<!----------------Location PDF -------------------->
<section>
	<div class="location_pdf_popup">
		<div class="md-modal md-effect-1" id="location_pdf_popup">
			<div class="md-content">
				
				<h4>Generate Custom PDF</h4>
				
				<form id="pdf_generate_form" method="POST" action="<?php echo get_stylesheet_directory_uri(); ?>/actionpdf.php" target="_blank" class="form-parlsey">
				
					  <div class="form-group">
						<label for="PDF Title">PDF Title: </label>
						<input type="text" name="pdf_nam" class="form-control" id="pdf_nam" placeholder="PDF Title" data-required="true">
					  </div>
					  
					  <div class="form-group">
						<label for="Send PDF to Email">Send PDF to Email: </label>
						<input type="text" name="email_add" class="form-control" id="email_add" placeholder="Send PDF to Email" data-required="true" data-type="email">
					  </div>
					 
					 <input type="hidden" name="pdf_images" id="pdf_images"/>
					 <input type="hidden" name="website_url" id="website_url" value="<?php echo site_url(); ?>" />
					 <input type="hidden" name="theme_path" id="theme_path" value="<?php echo get_stylesheet_directory(); ?>" />
					 
					<button type="submit" class="btn btn-primary">Send</button>
					
				</form>
				
                <div class="clearfix"></div>
                <button class="md-close1 md-pdf-location-close"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/close_icon_white.png" width="20" height="20" /></button>
			</div>
		</div>
		<div class="md-overlay"></div>
     </div>
</section>

<section>
	<div class="location_pdf_moodboard_popup">
		<div class="md-modal md-effect-1" id="location_pdf_moodboard_popup" style="z-index: 99999;">
			<div class="md-content">
				
				<h4>Generate Custom PDF</h4>
				
				<form id="pdf_generate_moodboard" method="POST" action="<?php echo get_stylesheet_directory_uri(); ?>/actionpdf.php" target="_blank" class="form-parlsey-2">
				
					  <div class="form-group">
						<label for="PDF Title">PDF Title: </label>
						<input type="text" name="pdf_nam" class="form-control" id="pdf_nam" placeholder="PDF Title" data-required="true">
					  </div>
					  
					  <div class="form-group">
						<label for="Send PDF to Email">Send PDF to Email: </label>
						<input type="text" name="email_add" class="form-control" id="email_add" placeholder="Send PDF to Email" data-required="true" data-type="email">
					  </div>
					 
					 <input type="hidden" name="pdf_images" id="pdf_images"/>
					 <input type="hidden" name="website_url" id="website_url" value="<?php echo site_url(); ?>" />
					 <input type="hidden" name="theme_path" id="theme_path" value="<?php echo get_stylesheet_directory(); ?>" />
					 
					<button type="submit" class="btn btn-primary">Send</button>
					
				</form>
				
                <div class="clearfix"></div>
                <button class="md-close1 md-pdf-location-close"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/close_icon_white.png" width="20" height="20" /></button>
			</div>
		</div>
		<div class="md-overlay"></div>
     </div>
</section>

<!----------------Permit Info Popup-------------------->
<section>
	<div class="permit_info_popup">
		<div class="md-modal md-effect-1" id="permit_info_popup">
			<div class="md-content">
				<div class="row md">
				
				<div class="col-md-12">
					<h4>Permit information for <?php the_title(); ?></h4>
				</div>
				
				<?php	$permits = get_field('permit'); ?>
                    
				<?php if ($permits): ?>
				
					<?php foreach ($permits as $post): setup_postdata($post); // variable must be called $post (IMPORTANT)   ?>
					
						<?php if ($post->post_content != "") : ?>
						
							<div class="col-md-12">
								<?php the_content() ?>
							</div>
					
						<?php endif; ?>
					
					<?php endforeach; ?>
					
					<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly  ?>
				
				<?php else: ?>
				
					<?php echo "<h3>Permit details not available...</h3>"; ?>
				
				<?php endif; ?>
				
				</div>
			<button class="md-close1"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/close_icon_white.png" width="20" height="20" /></button>
			</div>
		</div>
		<div class="md-overlay"></div>
     </div>
</section>


<?php
	/*
	 *  Query posts for a relationship value.
	 *  This method uses the meta_query LIKE to match the string "123" to the database value a:1:{i:0;s:3:"123";} (serialized array)
	 */

	$projects = get_posts(array(
		'post_type' => 'portfolio',
		'numberposts' => 100,
		'meta_query' => array(
			array(
				'key' => 'portfolio_location', // name of custom field
				'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
				'compare' => 'LIKE'
			)
		)
	));
?>

<?php if ($projects): ?>

<div class="col-md-12" style="display:none !important;">

		<?php foreach ($projects as $project): ?>

			<?php $photo = get_field('photo', $project->ID); ?>
			
			<?php 						
			/*
			 *  Loop through nested Repeater fields (From another $post ID)
			 */
			?>
			
			<?php if (get_field('portfolio_item', $project->ID)): ?>
				
				 <?php while (has_sub_field('portfolio_item', $project->ID)): ?>
				 
					<?php if (get_sub_field('project_image')): ?>
							
						<a class="portfolio_item_fancybox" rel="gallery" href="<?php echo get_sub_field('project_image'); ?>"></a>
						
					<?php endif; ?>
					
				<?php endwhile; ?>
			
			<?php endif; ?>
			
		<?php endforeach; ?>
		
	<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly    ?>

</div>

<?php endif; ?>


<?php endwhile; ?>


<script>
    
	jQuery(function ($) {
		
		jQuery('#pdf_generate_form').submit(function() {
			
			var arr = '';
			var i = 0;
			jQuery('.moodboard-carousel .item').each(function ()
			{
				var my_img = jQuery(this).children('img').attr('src');
				arr += my_img + ',';
				i++;
			});	
			
			jQuery('#pdf_generate_form #pdf_images').val(arr);
			
			if(jQuery(this).parsley('isValid'))
			{
				jQuery('.md-pdf-location-close').trigger('click');
			}
		});
                
		jQuery('#pdf_generate_moodboard').submit(function() {
			
			var arr = '';
			var i = 0;
			jQuery('.mood .item img.mood-img').each(function ()
			{
				var my_img = jQuery(this).attr('src');
				arr += my_img + ',';
				i++;
			});	
                        
                        if(arr == "")
                        {                            
                            jQuery.bootstrapGrowl("Please select minimum 1 image", {type: 'danger'});
                            return false;
                        }
			
			jQuery('#pdf_generate_moodboard #pdf_images').val(arr);
			
			if(jQuery(this).parsley('isValid'))
			{
				jQuery('.md-pdf-location-close').trigger('click');
			}
		});
		
	});
											
</script>

<?php get_footer(); ?>