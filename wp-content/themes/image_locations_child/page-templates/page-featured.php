<?php
/*
  Template Name: Featured Page
 */
get_header(); ?>

<?php while(have_posts()): the_post(); ?>
<div class="clearfix">&nbsp;</div>

<?php $fetured_section = get_field('fetured_section'); ?>
								
<?php if(is_array($fetured_section) && count($fetured_section) > 0): ?>
				
	<?php foreach($fetured_section as $section): ?>

	<?php if($section['featured_title_category'] != ""): ?>
	
	<section>
	  <div class="container">
		<div class="title_sec">
		  <div class="row">		  
			<div class="col-md-6 col-sm-6"><h2><?php echo $section['featured_title_category']; ?></h2></div>
			
			<?php if($section['view_more_link'] != ""): ?>			
				<div class="col-md-6 col-sm-6 text-right"><a href="<?php echo $section['view_more_link']; ?>" class="btn btn-primary">View More</a></div>
			<?php endif; ?>
			
		  </div>
		</div>
		<div class="clearfix">&nbsp;</div>
	  </div>
	</section>
	
	<?php endif; ?>
	
	<section>
		<div class="container">
			<div class="project_side_sec">
					
			<?php if(is_array($section['featured_row']) && count($section['featured_row']) > 0): ?>
	
				<?php foreach($section['featured_row'] as $row): ?>
				
				<div class="row md fetured_section">
				
				<?php if($section['section_type'] == 'Staff Picks'): ?>
					
					<?php $divClass = 'col-md-3 col-sm-4 col-xs-6 quickview'; ?>
					
					<?php 
						if($row['featured_row_layout'] !="" && $row['featured_row_layout'] == '1 Per Row'){
							
							$divClass = 'col-md-12 col-sm-12 col-xs-12 quickview';
						}elseif($row['featured_row_layout'] !="" && $row['featured_row_layout'] == '2 Per Row'){
							
							$divClass = 'col-md-6 col-sm-6 col-xs-6 quickview';
						}elseif($row['featured_row_layout'] !="" && $row['featured_row_layout'] == '3 Per Row'){
							
							$divClass = 'col-md-4 col-sm-4 col-xs-6 quickview';
						}elseif($row['featured_row_layout'] !="" && $row['featured_row_layout'] == '4 Per Row'){
							
							$divClass = 'col-md-3 col-sm-4 col-xs-6 quickview';
						}elseif($row['featured_row_layout'] !="" && $row['featured_row_layout'] == '5 Per Row'){
							
							$divClass = 'col-md-5ths col-sm-4 col-xs-6 quickview';
						}elseif($row['featured_row_layout'] !="" && $row['featured_row_layout'] == '6 Per Row'){
							
							$divClass = 'col-md-2 col-sm-4 col-xs-6 quickview';
						}						
					?>
					

					<div class="<?php echo $divClass; ?>">
					  <?php $image = $row['staff_image']; ?>
					  <?php if (is_array($image) && count($image) > 0): ?>
						<a href="#">
						  <img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo $image['url']; ?>&height=200&width=314&cropratio=1.50:1&amp;image=<?php echo $image['url']; ?>" width="100%"/>
						</a>
					  <?php endif; ?>						  
					  <a href="#" class="text-decoration-none"><h3><span><?php echo $row['first_title']; ?></span> | <?php echo $row['second_title']; ?></h3></a>
					  <div class="clearfix"></div>						  
					</div>
							
					
					<?php endif; ?>
				
					<?php $locations = $row['locations']; ?>

					<?php if(is_array($locations) && count($locations) > 0): ?>
						
						<?php $locationCount = 1; foreach($locations as $post): setup_postdata($post); ?>
						
							<?php /* 1 per row */ ?>
							<?php if($row['featured_row_layout'] !="" && $row['featured_row_layout'] == '1 Per Row'): ?>
								<div class="col-md-12 col-sm-12 col-xs-12 quickview">
								  <?php $image = get_field('main_image_new'); ?>
								  <?php if ($image): ?>							
									<a href="<?php the_permalink(); ?>">
									  <img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo $image['url']; ?>&height=300&width=1343&cropratio=1:0.23&amp;image=<?php echo $image['url']; ?>" width="100%"/>
									</a>
								  <?php endif; ?>						  
								  
								  <a href="<?php the_permalink(); ?>" class="text-decoration-none"><h3>
								  <?php if($section['section_type'] == 'Staff Picks'): ?>
									<span>Weekly Pick #<?php echo $locationCount."&nbsp;|&nbsp;"; ?></span>
								  <?php endif; ?>								  
								  <?php the_title(); ?></h3>
								  </a>
								  
								  <div class="clearfix"></div>						  
								</div>
							<?php endif; ?>
								
							<?php /* 2 per row */ ?>
							<?php if($row['featured_row_layout'] !="" && $row['featured_row_layout'] == '2 Per Row'): ?>
								<div class="col-md-6 col-sm-6 col-xs-6 quickview">
								  <?php $image = get_field('main_image_new'); ?>
								  <?php if ($image): ?>							
									<a href="<?php the_permalink(); ?>">
									  <img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo $image['sizes']['large']; ?>&height=300&width=614&cropratio=1:0.5&amp;image=<?php echo $image['sizes']['large']; ?>" width="100%"/>
									</a>
								  <?php endif; ?>						  
								  
								  <a href="<?php the_permalink(); ?>" class="text-decoration-none"><h3>
								  <?php if($section['section_type'] == 'Staff Picks'): ?>
									<span>Weekly Pick #<?php echo $locationCount."&nbsp;|&nbsp;"; ?></span>
								  <?php endif; ?>								  
								  <?php the_title(); ?></h3>
								  </a>
								  
								  <div class="clearfix"></div>						  
								</div>
							<?php endif; ?>
								
							<?php /* 3 per row */ ?>
							<?php if($row['featured_row_layout'] !="" && $row['featured_row_layout'] == '3 Per Row'): ?>
								<div class="col-md-4 col-sm-4 col-xs-6 quickview">
								  <?php $image = get_field('main_image_new'); ?>
								  <?php if ($image): ?>							
									<a href="<?php the_permalink(); ?>">
									  <img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo $image['sizes']['large']; ?>&height=200&width=314&cropratio=1.50:1&amp;image=<?php echo $image['sizes']['large']; ?>" width="100%"/>
									</a>
								  <?php endif; ?>						  
								  
								  <a href="<?php the_permalink(); ?>" class="text-decoration-none"><h3>
								  <?php if($section['section_type'] == 'Staff Picks'): ?>
									<span>Weekly Pick #<?php echo $locationCount."&nbsp;|&nbsp;"; ?></span>
								  <?php endif; ?>								  
								  <?php the_title(); ?></h3>
								  </a>
								  
								  <div class="clearfix"></div>						  
								</div>
							<?php endif; ?>
								
							<?php /* 4 per row */ ?>
							<?php if($row['featured_row_layout'] !="" && $row['featured_row_layout'] == '4 Per Row'): ?>
								<div class="col-md-3 col-sm-4 col-xs-6 quickview">
								  <?php $image = get_field('main_image_new'); ?>
								  <?php if ($image): ?>							
									<a href="<?php the_permalink(); ?>">
									  <img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo $image['sizes']['medium']; ?>&height=200&width=314&cropratio=1.50:1&amp;image=<?php echo $image['sizes']['medium']; ?>" width="100%"/>
									</a>
								  <?php endif; ?>						  
								  
								  <a href="<?php the_permalink(); ?>" class="text-decoration-none"><h3>
								  <?php if($section['section_type'] == 'Staff Picks'): ?>
									<span>Weekly Pick #<?php echo $locationCount."&nbsp;|&nbsp;"; ?></span>
								  <?php endif; ?>								  
								  <?php the_title(); ?></h3>
								  </a>
								  
								  <div class="clearfix"></div>						  
								</div>
							<?php endif; ?>
								
							<?php /* 5 per row */ ?>
							<?php if($row['featured_row_layout'] !="" && $row['featured_row_layout'] == '5 Per Row'): ?>
								<div class="col-md-5ths col-sm-4 col-xs-6 quickview">
								  <?php $image = get_field('main_image_new'); ?>
								  <?php if ($image): ?>							
									<a href="<?php the_permalink(); ?>">
									  <img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo $image['sizes']['medium']; ?>&height=200&width=314&cropratio=1.50:1&amp;image=<?php echo $image['sizes']['medium']; ?>" width="100%"/>
									</a>
								  <?php endif; ?>						  
								  
								  <a href="<?php the_permalink(); ?>" class="text-decoration-none"><h3>
								  <?php if($section['section_type'] == 'Staff Picks'): ?>
									<span>Weekly Pick #<?php echo $locationCount."&nbsp;|&nbsp;"; ?></span>
								  <?php endif; ?>								  
								  <?php the_title(); ?></h3>
								  </a>
								  
								  <div class="clearfix"></div>						  
								</div>
							<?php endif; ?>
								
							<?php /* 6 per row */ ?>
							<?php if($row['featured_row_layout'] !="" && $row['featured_row_layout'] == '6 Per Row'): ?>
								<div class="col-md-2 col-sm-4 col-xs-6 quickview">
								  <?php $image = get_field('main_image_new'); ?>
								  <?php if ($image): ?>							
									<a href="<?php the_permalink(); ?>">
									  <img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo $image['sizes']['medium']; ?>&height=200&width=314&cropratio=1.50:1&amp;image=<?php echo $image['sizes']['medium']; ?>" width="100%"/>
									</a>
								  <?php endif; ?>
								  
								  <a href="<?php the_permalink(); ?>" class="text-decoration-none"><h3>
								  <?php if($section['section_type'] == 'Staff Picks'): ?>
									<span>Weekly Pick #<?php echo $locationCount."&nbsp;|&nbsp;"; ?></span>
								  <?php endif; ?>								  
								  <?php the_title(); ?></h3>
								  </a>
								  
								  <div class="clearfix"></div>						  
								</div>
							<?php endif; ?>
								

								
						<?php $locationCount++; endforeach; ?>
						
					<?php wp_reset_postdata(); endif; ?>
					<div class="clearfix">&nbsp;</div>
				</div>
				
				<?php endforeach; ?>
			
			<?php endif; ?>
			
			<?php /* echo "<pre>"; ?>
			
				<?php print_r($fetured_section); ?>
			
			<?php echo "</pre>"; */ ?>
								
			
						
			</div>
					
		</div>
				
	</section>
			
	<?php endforeach; ?>
				
<?php endif; ?>


<section>
  <div class="container">
	<div class="title_sec">
	  <div class="row">		  
		<div class="col-md-6 col-sm-6"><h2>5 Random Locations</h2></div>		
		<div class="col-md-6 col-sm-6 text-right"><button id="random_location_section_button" class="btn btn-primary"><i class="fa fa-refresh"></i>&nbsp;Refresh</button></div>
	  </div>
	</div>
	<div class="clearfix">&nbsp;</div>
  </div>
</section>

<section>
	<div class="container">
		<div class="project_side_sec">

			<div class="row md fetured_section" id="random_location_section">
			
				<?php /*
					$ids = get_posts( array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'suppress_filters' => false,
					'posts_per_page' => -1
					) );
					
					$post_ids = wp_list_pluck( $ids, 'ID' );
					$random_ids = array_rand($post_ids,5);
					$random_id = array();
					foreach($random_ids as $id){
						$random_id[] = $post_ids[$id];
					}
				?>
				
				<?php $args = array( 'post_type' => 'post', 'post__in' => $random_id  ); ?>
				
				<?php $random_locations = get_posts($args); ?>
				
				<?php if(is_array($random_locations) && count($random_locations) > 0): ?>
				
					<?php $i = 0; foreach($random_locations as $post): setup_postdata($post); ?>
					
						<?php if($i < 2): ?>
					
							<div class="col-md-6 col-sm-6 col-xs-12 quickview">
							  <?php $image = get_field('main_image_new'); ?>
							  <?php if ($image): ?>							
								<a href="<?php the_permalink(); ?>">
								  <img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo $image['sizes']['large']; ?>&height=300&width=614&cropratio=1:0.5&amp;image=<?php echo $image['sizes']['large']; ?>" width="100%"/>
								</a>
							  <?php endif; ?>						  
							  
							  <a href="<?php the_permalink(); ?>" class="text-decoration-none"><h3><?php the_title(); ?></h3></a>							  
							  <div class="clearfix"></div>						  
							</div>
						
						<?php else: ?>
						
							<div class="col-md-4 col-sm-4 col-xs-12 quickview">
							  <?php $image = get_field('main_image_new'); ?>
							  <?php if ($image): ?>							
								<a href="<?php the_permalink(); ?>">
								  <img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo $image['sizes']['large']; ?>&height=200&width=314&cropratio=1.50:1&amp;image=<?php echo $image['sizes']['large']; ?>" width="100%"/>
								</a>
							  <?php endif; ?>						  
							  
							  <a href="<?php the_permalink(); ?>" class="text-decoration-none"><h3><?php the_title(); ?></h3></a>							  
							  <div class="clearfix"></div>						  
							</div>
							
						<?php endif; ?>
					
					<?php $i++; endforeach; ?>
				
				<?php wp_reset_query(); endif; */ ?>
				
				</div>
				
		</div>
	</div>
			
</section>

<section>
	<div class="container">
		<div class="about_sec">
		
			<div class="row">
				<?php the_content(); ?>
			</div>
			
		</div>
	</div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>