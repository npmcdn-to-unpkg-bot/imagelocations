<?php
$segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));

$first_page_url = site_url() . "/permits/" . $segments[1] . "/1";

 
global $deviceType;

/*if($deviceType == 'tablet' || $deviceType == 'phone'){
	
	if(!(isset($_GET['layout']) && $_GET['layout'] == 'fullview')){
		
		$_GET['layout'] = 'quickview';
	
	}

}
*/
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

        <div class="col-md-8 col-sm-7"><h2>Permit | 
            <?php if (has_post_thumbnail()): ?> 

              <?php the_post_thumbnail('thumbnail', array('class', 'img-responsive single-permit-logo')); ?>        

            <?php endif; ?>

          </h2></div>

		<div class="col-md-4 col-sm-5 text-right">
		  <?php if (isset($_GET['layout']) && $_GET['layout'] == 'quickview'): ?>
			<a href="?layout=fullview" class="btn btn-primary pull-right"> View Full View</a>
			 <?php else: ?>
			<a href="?layout=quickview" class="btn btn-primary pull-right"> View Quickview</a>
		  <?php endif ?>							
                  <div class="clearfix">&nbsp;</div>
		</div>
			
      </div>

    </div>
  </div>
</section>

<?php
$id = get_the_ID();
$paged = ( get_query_var('page') ) ? absint(get_query_var('page')) : 1;



global $wp_query;

echo ' ';

$posts = get_posts(array(
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => 'permit',
            'value' => '"' . $id . '"',
            'compare' => 'LIKE'
        )
    )
        ));


// echo "Total: ".count($posts);exit;

$total_records = is_object($posts) || is_array($posts) ? count($posts) : 0;

$posts_per_page = 10;

if ($total_records > 0) {
  if (fmod($total_records, $posts_per_page) == 0)
    $num_pages = floor($total_records / $posts_per_page);
  else
    $num_pages = floor($total_records / $posts_per_page) + 1;
}
else {
  $num_pages = 0;
}

$wp_query->max_num_pages = $num_pages;


$posts = get_posts(array(
    'posts_per_page' => $posts_per_page,
    'paged' => $paged,
    'meta_query' => array(
        array(
            'key' => 'permit', // name of custom field
            'value' => '"' . $id . '"', // matches exaclty "123", not just 123. This prevents a match for "1234", 
            'compare' => 'LIKE'
        )
    )
        ));



if ($posts):  ?>
  
<?php if (isset($_GET['layout']) && $_GET['layout'] == 'quickview'): ?>

  <section>
    <div class="container">
      <div class="project_side_sec">		
        <div class="row">
			
			<?php $i=1; foreach ($posts as $post): setup_postdata($post); ?>
			
            <div class="col-md-2 col-sm-3 col-xs-6 quickview">

              <?php
              $image = get_field('main_image_new');
              $size = 'medium'; // (thumbnail, medium, large, full or custom size)  
              ?>

              <?php if ($image): ?>							

                <a href="<?php the_permalink(); ?>">
                  
				  <img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo $image['sizes']['medium']; ?>&height=200&width=314&cropratio=1.50:1&amp;fixed_ratio=1&amp;image=<?php echo $image['sizes']['medium']; ?>" />

                </a>								

              <?php endif; ?>			
              
			  <a href="<?php the_permalink(); ?>" class="text-decoration-none"><h3><?php the_title(); ?></h3></a>
			  
            </div>

            <?php if ($i % 6 == 0): ?>
<!--            </div><div class="row">-->
            <?php endif ?>

            <?php
            $i++;
          endforeach;
          ?>
        </div>
      </div>
    </div>
  </section>

<?php else: ?>

  <?php $tempCounter = 0; ?>  
  
  	<div class="image_container hide"></div>

  <?php foreach ($posts as $post): setup_postdata($post); ?>
	
	<?php $imgCounter = 0;?>
	
    <section>
      <div class="container">
        <div class="project_side_sec">

          <div class="swiper-container single-permits single-permits-<?php echo $tempCounter; ?>">

            <div class="swiper-wrapper">

    <?php $banner_image_1 = get_any_image_url(get_field('banner_image_1'), 'medium'); ?>
              <?php $banner_image_2 = get_any_image_url(get_field('banner_image_2'), 'medium'); ?>
              <?php $banner_image_3 = get_any_image_url(get_field('banner_image_3'), 'medium'); ?>

              <?php $banner_type = get_field('banner_type'); ?>

              <?php if ($banner_type == '1 Photo' && $banner_image_1 != ""): ?>

                <div class="swiper-slide">            
                  <a href="<?php the_permalink(); ?>">
                    <img class="img-responsive" src="<?php echo $banner_image_1; ?>" />
                  </a>            
                </div>							
				<?php $imgCounter++;?>
				
    <?php elseif ($banner_type == '2 Photos' && $banner_image_1 != "" && $banner_image_2 != ""): ?>

                <div class="swiper-slide">            
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

                <div class="swiper-slide">            
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

              <?php
              $other_images = get_field('location_photos_new');
              $size = 'medium'; // (thumbnail, medium, large, full or custom size) 
              ?>

              <?php if ($other_images): $count = 0; ?>

                <?php foreach ($other_images as $other_image): ?>

                  <?php if ($count < 5): ?>

                    <?php $display_image = wp_get_attachment_image_src($other_image['ID'], $size); ?>

                    <?php if (is_array($display_image) && count($display_image) > 0): ?>

                      <div class="swiper-slide">            
                        <a href="<?php the_permalink(); ?>">
                          <img class="img-responsive" src="<?php echo $display_image[0]; ?>" />
                        </a>            
                      </div>                        
					<?php $imgCounter++;?>
					
					<?php endif; ?>

                  <?php else: ?>

                    <?php  $display_image = wp_get_attachment_image_src($other_image['ID'], $size); ?>

                    <?php if (is_array($display_image) && count($display_image) > 0): ?>

                      <?php /* <div class="swiper-slide empty" style="width:<?php echo $display_image[1]; ?>px !important;background:url('<?php echo get_stylesheet_directory_uri(); ?>/images/slide-loader.gif') no-repeat;background-position:center;height:auto;"></div>
                        <div class="lazy-slides" data-lazy_href="<?php the_permalink(); ?>" data-lazy_src="<?php echo $display_image[0]; ?>"></div> */ ?>

                      <div class="lazy-slides" data-lazy_href="<?php the_permalink(); ?>" data-lazy_src="<?php echo $display_image[0]; ?>"></div>
                  	  <?php $imgCounter++;?>
					
					<?php endif; ?>

                  <?php endif; ?>

                  <?php $count++;
                endforeach; ?>

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

                <?php $permits = get_field('permit'); ?>

                <?php if ($permits): ?>

                  <?php foreach ($permits as $post): // variable must be called $post (IMPORTANT)    ?>

                    <?php setup_postdata($post); ?>

                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>									

                  <?php endforeach; ?>

                  <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly     ?>

                <?php endif; ?>

                <span> / </span>			

                <?php $city = get_field('city_address'); ?>

                <?php if ($city): ?>

                  <a href="/locations/?city=<?php echo urlencode($city); ?>"><?php echo $city; ?></a>

                <?php endif; ?>

              </div>
			  
            </div>



          </div>
        </div>
      </div>
    </section>

    <?php //break;  ?>

    <?php $tempCounter++; ?>

  <?php endforeach; ?>

<?php endif; ?>

  <!--------pagination section------------->
  <section>
    <div class="container">
      <div class="buttom_pagi_sec">
        <div class="row">
          <div class="col-md-8 col-sm-12 permits-links">  

            <?php if (function_exists('child_theme_pagination_home')): ?>

              <?php child_theme_pagination_home(); ?> 	

            <?php endif; ?>		

          </div>
		  
		 <div class="col-md-4 col-sm-12">
          <?php if (isset($_GET['layout']) && $_GET['layout'] == 'quickview'): ?>
            <a href="?layout=fullview" class="btn btn-primary pull-right"> View Full View</a>
             <?php else: ?>
            <a href="?layout=quickview" class="btn btn-primary pull-right"> View Quickview</a>
          <?php endif ?>		
        </div>
		
        </div>
      </div>
    </div>
  </section>

  <script>
    jQuery(function ($) {

      $(document).ready(function () {

  <?php if (isset($segments[2]) && $segments[2] == 2): ?>
          // alert("here");    
          $('.prev.page-numbers').attr('href', '<?php echo $first_page_url; ?>');
  <?php endif; ?>


        $('.page-numbers').each(function () {

          // alert($.trim($(this).text()))
          if ($.trim($(this).text()) == 1)
          {
            $(this).attr('href', '<?php echo $first_page_url; ?>');
          }

        })

      });


    });
  </script>

<?php endif; ?>

<?php get_footer(); ?>