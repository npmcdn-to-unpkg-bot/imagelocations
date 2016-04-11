<?php
/*
  Template Name: Exclusives
 */

global $deviceType;

if($deviceType == 'tablet' || $deviceType == 'phone'){
	
	if(!(isset($_GET['layout']) && $_GET['layout'] == 'fullview')){
		
		$_GET['layout'] = 'quickview';
	
	}

}

get_header();
?>
<?php if(!isset($_REQUEST['layout'])):?>
<script type="text/javascript">
    $url = 'http://'+'<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>';    
    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))
    {
            <?php if(intval(strpos($_SERVER['REQUEST_URI'],'?')) > 0):?>
                $url = $url+"&layout=quickview";    
            <?php else:?>
                $url = $url+"?layout=quickview";    
            <?php endif;?>    
            
            window.location = $url;
    }    
</script>
<?php endif;?>        

<!--------title------------->
<section>
  <div class="container">
    <div class="title_sec">
      <div class="row">

        <div class="col-md-4 col-sm-5"><h2>Exclusives</h2>
          <?php
          if (function_exists('sharing_display')) {
            sharing_display('', true);
          }
          ?>				
        </div>

        <div class="col-md-2 col-sm-1 text-right">
        </div>

		<div class="col-md-6 col-sm-6">
            <div class="row">
				<div class="col-md-4"></div>
						
				  <?php if (isset($_GET['city'])): ?>
					<div class="col-md-5 category-btn-area pd-0 col-sm-6">
						
						<a class="btn btn-primary pull-right" href="<?php
						if (isset($_GET['layout'])) {
						  echo '?layout=quickview';
						} else {
						  echo '?layout=fullview';
						}
						?>">View All Cities</a>

					</div>
				  <?php else: ?>
					<div class="col-md-5 category-btn-area pd-0 col-sm-6">
						
						<select class="form-control" id="city_selection_dropdown">

						  <option value="<?php echo site_url(); ?>/category/exclusives/<?php echo (isset($_GET['layout']) && $_GET['layout'] == 'quickview') ? '?layout=quickview' : '?layout=fullview'; ?>">All Cities</option>

						  <?php $allcities = array(); ?>
						  <?php while (have_posts()) : the_post(); ?>   
							<?php $city1 = get_field('city_address'); ?>
							<?php if ($city1): ?>
							  <?php if (!in_array($city1, $allcities)): ?>
								<option value="<?php echo site_url(); ?>/category/exclusives/?city=<?php echo urlencode($city1); ?><?php echo (isset($_GET['layout']) && $_GET['layout'] == 'quickview') ? '&layout=quickview' : '&layout=fullview'; ?>"><?php echo $city1; ?></option>
								<?php $allcities[] = $city1; ?>
							  <?php endif; ?>
							<?php endif ?>
						  <?php endwhile; ?>						

						</select> 

					</div>
				  <?php endif; ?>
		
					<div class="col-md-3 col-sm-6 mob-pd-0">
						<?php if (isset($_GET['layout']) && $_GET['layout'] == 'quickview'): ?>
						  <a href="?layout=fullview<?php
						  if (isset($_GET['city'])) {
							print ('&city=' . $_GET['city']);
						  }
						  ?>" class="btn btn-primary"> View Full View</a>
						   <?php else: ?>
						  <a href="
						  <?php
						  if (isset($_GET['city'])) {
							print ('?city=' . $_GET['city'] . '&');
						  } else {
							print ('?');
						  }
						  ?>layout=quickview" class="btn btn-primary pull-right"> View Quickview</a>
						<?php endif ?>		                    
					</div>
				
			</div>
		</div>
            
      </div>

    </div>
  </div>
</section>

<?php if (isset($_GET['layout']) && $_GET['layout'] == 'quickview'): ?>

  <section>
    <div class="container">
      <div class="project_side_sec">		
        <div class="row">

          <?php
          /*global $query_string;

          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          query_posts($query_string . '&paged=' . $paged . '&posts_per_page=20');

          if (!have_posts()):

            /*if ($paged > 0) {
              $paged = $paged / 2;
            }

            query_posts($query_string . '&paged=' . $paged . '&posts_per_page=20');

          endif;*/

          $i = 1;
          while (have_posts()): the_post();
            ?>

            <div class="col-md-2 col-sm-3 col-xs-6 quickview ">

              <?php
              $image = get_field('main_image_new');
              $size = 'medium'; // (thumbnail, medium, large, full or custom size) 
              ?>

              <?php if ($image): ?>							

                <a href="<?php the_permalink(); ?>">
                  <?php $image_url = wp_get_attachment_image_src($image, $size); ?>                  
                    <img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo $image_url[0]; ?>&height=200&width=314&cropratio=1.50:1&amp;fixed_ratio=1&amp;image=<?php echo $image_url[0]; ?>" />
                </a>

              <?php endif; ?>
			  
                <a href="<?php the_permalink(); ?>" class="text-decoration-none" title="<?php echo get_the_title()?>">
                  <h3>
                      <?php echo ttruncat(get_the_title(), 20); ?>
                  </h3>
              </a>
              <div class="clearfix">&nbsp;</div>
            </div>

            <?php /* if ($i % 6 == 0): ?>
            </div><div class="row">
            <?php endif */ ?>

            <?php
            $i++;
          endwhile;
          ?>
        </div>
      </div>
    </div>
  </section>
<?php else: ?>

  <?php $tempCounter = 0; ?>  
  
	<div class="image_container hide"></div>
  
  <?php while (have_posts()): the_post(); ?>
	
	<?php $imgCounter = 0;?>
	
    <section>
      <div class="container">
        <div class="project_side_sec">

          <div class="swiper-container category-exclusive category-exclusive-<?php echo $tempCounter; ?>">


            <div class="swiper-wrapper">


              <?php $banner_image_1 = get_any_image_url(get_field('banner_image_1'), 'medium'); ?>
              <?php $banner_image_2 = get_any_image_url(get_field('banner_image_2'), 'medium'); ?>
              <?php $banner_image_3 = get_any_image_url(get_field('banner_image_3'), 'medium'); ?>

              <?php $banner_type = get_field('banner_type'); ?>

              <?php if ($banner_type == '1 Photo' && $banner_image_1 != ""): ?>

                <div class="swiper-slide exclusives_banner_image_1">            
                  <a href="<?php the_permalink(); ?>">
                    <img class="img-responsive" src="<?php echo $banner_image_1; ?>" />
                  </a>            
                </div>							
			  
			  <?php $imgCounter++;?>
				
              <?php elseif ($banner_type == '2 Photos' && $banner_image_1 != "" && $banner_image_2 != ""): ?>

                <div class="swiper-slide exclusives_banner_image_1">            
                  <a href="<?php the_permalink(); ?>">
                    <img class="img-responsive" src="<?php echo $banner_image_1; ?>" />
                  </a>            
                </div>				
				<?php $imgCounter++;?>
				
                <div class="swiper-slide">            
                  <a href="<?php the_permalink(); ?>">
                    <img class="img-responsive" src="<?php echo $banner_image_2; ?>" />
                  </a>            
                </div>			  
			  <?php $imgCounter++;?>
			  
              <?php elseif ($banner_type == '3 Photos' && $banner_image_1 != "" && $banner_image_2 != "" && $banner_image_3 != ""): ?>

                <div class="swiper-slide exclusives_banner_image_1">            
                  <a href="<?php the_permalink(); ?>">
                    <img class="img-responsive" src="<?php echo $banner_image_1; ?>" />
                  </a>            
                </div>							
				<?php $imgCounter++;?>
				
                <div class="swiper-slide">            
                  <a href="<?php the_permalink(); ?>">
                    <img class="img-responsive" src="<?php echo $banner_image_2; ?>" />
                  </a>            
                </div>							
				<?php $imgCounter++;?>
				
                <div class="swiper-slide">            
                  <a href="<?php the_permalink(); ?>">
                    <img class="img-responsive" src="<?php echo $banner_image_3; ?>" />
                  </a>            
                </div>							
				<?php $imgCounter++;?>
				
              <?php endif; ?>


              <?php /*
                $image = get_field('exclusive_extended');
                $size = 'full'; // (thumbnail, medium, large, full or custom size)
                ?>
                <?php if ($image): ?>
                <div class="swiper-slide">
                <a href="<?php the_permalink(); ?>">
                <?php echo wp_get_attachment_image($image, $size, false, array('class' => 'img-responsive')); ?>
                </a>
                </div>
                <?php endif; */ ?> 

              <?php
              $other_images = get_field('location_photos_new');
              $size = 'medium'; // (thumbnail, medium, large, full or custom size) 
              ?>

              <?php if ($other_images): $count = 0; ?>

                <?php foreach ($other_images as $other_image): ?>

                  <?php if ($count < 5): ?>

                    <?php $display_image = wp_get_attachment_image_src($other_image, $size); ?>

                    <?php if (is_array($display_image) && count($display_image) > 0): ?>

                      <div class="swiper-slide">            
                        <a href="<?php the_permalink(); ?>">
                          <img class="img-responsive" src="<?php echo $display_image[0]; ?>" />
                        </a>            
                      </div>                        
					
					<?php $imgCounter++;?>
                    <?php endif; ?>

                  <?php else: ?>

                    <?php $display_image = wp_get_attachment_image_src($other_image, $size); ?>

                    <?php if (is_array($display_image) && count($display_image) > 0): ?>

                      <?php /* <div class="swiper-slide empty" style="width:<?php echo $display_image[1]; ?>px !important;background:url('<?php echo get_stylesheet_directory_uri(); ?>/images/slide-loader.gif') no-repeat;background-position:center;height:auto;" data-lazy_href="<?php the_permalink(); ?>" data-lazy_src="<?php echo $display_image[0]; ?>"></div> */ ?>
                       <div class="lazy-slides" data-lazy_href="<?php the_permalink(); ?>" data-lazy_src="<?php echo $display_image[0]; ?>"></div>
					   <?php $imgCounter++;?>

                    <?php endif; ?>

                  <?php endif; ?>

                  <?php
                  $count++;
                endforeach;
                ?>

              <?php endif; ?>

            </div>

            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev swiper-button-prev-<?php echo $tempCounter; ?>"></div>
            <div class="swiper-button-next swiper-button-next-<?php echo $tempCounter; ?>"></div>                    

            <div class="swiper-scrollbar swiper-scrollbar-<?php echo $tempCounter; ?>"><div class="swiper-scrollbar-drag scrollbar-default-width"></div></div>
			<div id="swiper_slide_counter" class="swiper_slide_counter pull-right"><span class="current_slide">1</span>/<span class="total_slide"><?php echo $imgCounter; ?></span></div>

          </div>

          <div class="row">
            <div class="col-md-12 col-sm-12">
              <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                <h3><?php the_title(); ?></h3>
              </a>  

              <div class="link">

                <?php $city = get_field('city_address'); ?>

                <?php if ($city): ?>

                  <a href="/locations/?city=<?php echo urlencode($city); ?>"><?php echo $city; ?></a>

                <?php endif; ?>

                <span> / </span>

                <?php $permits = get_field('permit'); ?>

                <?php if ($permits): ?>

                  <?php foreach ($permits as $post): // variable must be called $post (IMPORTANT)      ?>

                    <?php setup_postdata($post); ?>

                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>									

                  <?php endforeach; ?>

                  <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly       ?>

                <?php endif; ?>

              </div>              
            </div>


          </div>
        </div>
      </div>
    </section>

    <?php //break; ?>

    <?php $tempCounter++; ?>
  <?php endwhile; ?>

<?php endif; ?>


<!--------pagination section------------->
<section>
  <div class="container">
    <div class="buttom_pagi_sec">
      <div class="row">
        <div class="col-md-8 col-sm-12">  

          <?php /* Display navigation to next/previous pages when applicable */ ?>
          <?php if (function_exists('reverie_pagination')) { ?>
            <?php reverie_pagination(); ?>
          <?php } else if (is_paged()) { ?>
            <nav id="post-nav">
              <div class="post-previous">
                <?php next_posts_link(__('&larr; Older posts', 'reverie')); ?>
              </div>
              <div class="post-next">
                <?php previous_posts_link(__('Newer posts &rarr;', 'reverie')); ?>
              </div>
            </nav>
          <?php } ?>  

        </div>
        <div class="col-md-4 col-sm-12">
          <?php if (isset($_GET['layout']) && $_GET['layout'] == 'quickview'): ?>
            <a href="?layout=fullview<?php
            if (isset($_GET['city'])) {
              print ('&city=' . $_GET['city']);
            }
            ?>" class="btn btn-primary pull-right"> View Full View</a>
             <?php else: ?>
            <a href="
            <?php
            if (isset($_GET['city'])) {
              print ('?city=' . $_GET['city'] . '&');
            } else {
              print ('?');
            }
            ?>layout=quickview" class="btn btn-primary pull-right"> View Quickview</a>
          <?php endif ?>		
        </div>
      </div>
    </div>
  </div>
</section>


<?php get_footer(); ?>