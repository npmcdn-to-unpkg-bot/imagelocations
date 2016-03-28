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
			<div class="col-md-6 col-sm-6 text-right"><a href="<?php echo $section['view_more_link']; ?>" class="btn btn-primary">View More</a></div>
		  </div>
		</div>
		<div class="clearfix">&nbsp;</div>
	  </div>
	</section>
	
	<?php endif; ?>
	
	<section>
		<div class="container">
			<div class="project_side_sec">
				
			<div class="row md fetured_section">
					
			
			<?php $locations = $section['locations']; ?>
			
			<?php if(is_array($locations) && count($locations) > 0): ?>
				
				<?php foreach($locations as $post): setup_postdata($post); ?>
				
					<?php /* 1 per row */ ?>
					<?php if($section['featured_row_layout'] !="" && $section['featured_row_layout'] == '1 per row'): ?>
						<div class="col-md-12 col-sm-12 col-xs-12 quickview">
						  <?php $image = get_field('main_image_new'); ?>
						  <?php if ($image): ?>							
							<a href="<?php the_permalink(); ?>">
							  <img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo $image['url']; ?>&height=300&width=1343&cropratio=1:0.23&amp;image=<?php echo $image['url']; ?>" width="100%"/>
							</a>
						  <?php endif; ?>						  
						  <a href="<?php the_permalink(); ?>" class="text-decoration-none"><h3><?php the_title(); ?></h3></a>						  
						  <div class="clearfix"></div>						  
						</div>
					<?php endif; ?>
						
					<?php /* 2 per row */ ?>
					<?php if($section['featured_row_layout'] !="" && $section['featured_row_layout'] == '2 per row'): ?>
						<div class="col-md-6 col-sm-6 col-xs-6 quickview">
						  <?php $image = get_field('main_image_new'); ?>
						  <?php if ($image): ?>							
							<a href="<?php the_permalink(); ?>">
							  <img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo $image['sizes']['large']; ?>&height=300&width=614&cropratio=1:0.5&amp;image=<?php echo $image['sizes']['large']; ?>" width="100%"/>
							</a>
						  <?php endif; ?>						  
						  <a href="<?php the_permalink(); ?>" class="text-decoration-none"><h3><?php the_title(); ?></h3></a>						  
						  <div class="clearfix"></div>						  
						</div>
					<?php endif; ?>
						
					<?php /* 3 per row */ ?>
					<?php if($section['featured_row_layout'] !="" && $section['featured_row_layout'] == '3 per row'): ?>
						<div class="col-md-4 col-sm-4 col-xs-6 quickview">
						  <?php $image = get_field('main_image_new'); ?>
						  <?php if ($image): ?>							
							<a href="<?php the_permalink(); ?>">
							  <img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo $image['sizes']['medium']; ?>&height=200&width=314&cropratio=1.50:1&amp;image=<?php echo $image['sizes']['medium']; ?>" width="100%"/>
							</a>
						  <?php endif; ?>						  
						  <a href="<?php the_permalink(); ?>" class="text-decoration-none"><h3><?php the_title(); ?></h3></a>						  
						  <div class="clearfix"></div>						  
						</div>
					<?php endif; ?>
						
					<?php /* 4 per row */ ?>
					<?php if($section['featured_row_layout'] !="" && $section['featured_row_layout'] == '4 per row'): ?>
						<div class="col-md-3 col-sm-4 col-xs-6 quickview">
						  <?php $image = get_field('main_image_new'); ?>
						  <?php if ($image): ?>							
							<a href="<?php the_permalink(); ?>">
							  <img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo $image['sizes']['medium']; ?>&height=200&width=314&cropratio=1.50:1&amp;image=<?php echo $image['sizes']['medium']; ?>" width="100%"/>
							</a>
						  <?php endif; ?>						  
						  <a href="<?php the_permalink(); ?>" class="text-decoration-none"><h3><?php the_title(); ?></h3></a>						  
						  <div class="clearfix"></div>						  
						</div>
					<?php endif; ?>
						
					<?php /* 5 per row */ ?>
					<?php if($section['featured_row_layout'] !="" && $section['featured_row_layout'] == '5 per row'): ?>
						<div class="col-md-5ths col-sm-4 col-xs-6 quickview">
						  <?php $image = get_field('main_image_new'); ?>
						  <?php if ($image): ?>							
							<a href="<?php the_permalink(); ?>">
							  <img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo $image['sizes']['medium']; ?>&height=200&width=314&cropratio=1.50:1&amp;image=<?php echo $image['sizes']['medium']; ?>" width="100%"/>
							</a>
						  <?php endif; ?>						  
						  <a href="<?php the_permalink(); ?>" class="text-decoration-none"><h3><?php the_title(); ?></h3></a>						  
						  <div class="clearfix"></div>						  
						</div>
					<?php endif; ?>
						
					<?php /* 6 per row */ ?>
					<?php if($section['featured_row_layout'] !="" && $section['featured_row_layout'] == '6 per row'): ?>
						<div class="col-md-2 col-sm-4 col-xs-6 quickview">
						  <?php $image = get_field('main_image_new'); ?>
						  <?php if ($image): ?>							
							<a href="<?php the_permalink(); ?>">
							  <img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo $image['sizes']['medium']; ?>&height=200&width=314&cropratio=1.50:1&amp;image=<?php echo $image['sizes']['medium']; ?>" width="100%"/>
							</a>
						  <?php endif; ?>						  
						  <a href="<?php the_permalink(); ?>" class="text-decoration-none"><h3><?php the_title(); ?></h3></a>						  
						  <div class="clearfix"></div>						  
						</div>
					<?php endif; ?>
						

						
				<?php endforeach; ?>
				
			<?php endif; ?>
			
			
			<?php wp_reset_postdata(); ?>
								
			</div>
						
			</div>
					
		</div>
				
	</section>
			
	<?php endforeach; ?>
				
<?php endif; ?>


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