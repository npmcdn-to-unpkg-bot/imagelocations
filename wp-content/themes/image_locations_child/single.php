<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
get_header();
wp_enqueue_script('imagesloaded-js', '//npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js', array(), false, true);

global $post;
$location_post_slug = $post->post_name;
?>
<style>
  .sd-content > ul{ margin-left:6px !important; margin-right:-3px !important;}
  section .skystudio_sec .sharing-hidden .inner::after, section .skystudio_sec .sharing-hidden .inner::before { left: 10% !important; }

</style>
<?php while (have_posts()) : the_post(); ?>

  <!-- ------SKYstudio----------- -->
  <div class="image_container hide"></div>
  <section>
    <div class="container">

      <div class="skystudio_sec">

        <?php if (get_field("aerial_video") || get_field('wistia_aerial_video')): ?>

          <button class="btn btn-primary btn-open-fancybox" data-modal="new_video_popup" data-id="#new_video_popup1"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ico_play.png" width="33" height="33" align="left" style="margin-right:10px;" />New<br />Video</button>

        <?php endif; ?>

        <?php $images = get_field('location_photos_new'); ?>

        <?php $caption_array = array(); ?>

        <?php if ($images): ?>

          <?php
          $i = 1;
          foreach ($images as $image):
            ?>                        

            <?php if (isset($image['caption']) && $image['caption'] != ""): ?>

              <?php $caption_array[$i]['key'] = $i; ?>
              <?php $caption_array[$i]['value'] = $image['caption']; ?>

            <?php endif; ?>

            <?php
            $i++;
          endforeach;
          ?>

          <?php if (is_array($caption_array) && count($caption_array) > 0): ?>

            <div class="dropdown">

              <button class="btn btn-success dropdown-toggle btn-quick-nav-right" type="button" data-toggle="dropdown">Quick <br />Navigation <span class="caret"></span></button>

              <ul class="dropdown-menu quick-navigation">

                <?php foreach ($caption_array as $caption): ?>

                  <li><a data-slide_id="<?php echo $caption['key']; ?>"><?php echo $caption['value']; ?></a></li>

                <?php endforeach; ?>

              </ul>

            </div>

          <?php endif; ?>

        <?php endif; ?>

        <div class="swiper-container moodboard-swiper">
          <div class="swiper-wrapper" style="margin-left:4px;">
            <?php
            $i = 2;
            $image = get_field('collage_new');
            $size = 'Large_Watermark'; // (thumbnail, medium, large, full or custom size) 
            ?>

            <?php if ($image): ?>                        
              <div class="swiper-slide swiper-slide-gallery">
                <img id="drag_image_0"  class="swiper-lazy1 img-responsive" src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
                <a data-id="0" class="btn btn-add-moodboard" style="display: none;"></a>
              </div>
              <?php
              $i++;
            endif;
            ?>


            <?php
            $images = get_field('location_photos_new');
            ?>

            <?php if ($images): ?>

              <?php
              $slide_counter = 0;
              foreach ($images as $image):
                ?>                        

                <?php if ($slide_counter < 5): ?>

                  <div class="swiper-slide swiper-slide-gallery">

                    <img id="drag_image_<?php echo $image['ID'] ?>" data-thumb="<?php echo $image['sizes']['thumbnail']; ?>" src="<?php echo $image['sizes']['Large_Watermark']; ?>" <?php echo $image['alt']; ?> class="swiper-lazy1 img-responsive" />

                    <a data-id="<?php echo $image['ID'] ?>" class="btn btn-add-moodboard" style="display: none;"></a>

                  </div>                       

                <?php else: ?>

                  <div class="lazy-slides" data-a_id="<?php echo $image['ID']; ?>" data-drag_image="drag_image_<?php echo $image['ID']; ?>" data-thumb_id="<?php echo $image['sizes']['thumbnail']; ?>" data-lazy_src="<?php echo $image['sizes']['Large_Watermark']; ?>"></div>

                <?php endif; ?>

                <?php
                $slide_counter++;
              endforeach;
              ?>

            <?php endif; ?>    


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

              <?php
              $project_i = 1;
              foreach ($projects as $project):
                ?>

                <?php if (get_field('portfolio_item', $project->ID)): ?>

                  <?php
                  $project_field_i = 1;
                  while (has_sub_field('portfolio_item', $project->ID)):
                    ?>

                    <?php if (get_sub_field('project_image')): ?>

                      <div class="lazy-slides" data-a_id="<?php echo $project_i . $project_field_i; ?>" data-drag_image="drag_image_<?php echo $project_i . $project_field_i; ?>" data-thumb_id="<?php echo get_sub_field('project_image'); ?>" data-lazy_src="<?php echo get_sub_field('project_image'); ?>"></div>

                    <?php endif; ?>

                    <?php
                    $project_field_i++;
                  endwhile;
                  ?>

                <?php endif; ?>

                <?php
                $project_i++;
              endforeach;
              ?>

            <?php endif; ?>


          </div>
          <!-- Add Pagination -->
          <div class="swiper-pagination"></div>
          <!-- If we need navigation buttons -->
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>                    

          <div class="swiper-scrollbar swiper-scrollbar-moodboard"><div class="swiper-scrollbar-drag scrollbar-default-width"></div></div>

        </div>


        <div class="clearfix">&nbsp;</div>

        <div class="row">
          <div class="col-md-4 col-sm-12">
            <h3><?php the_title(); ?></h3>
            <div class="link">

              <?php $city = get_field('city_address'); ?>

              <?php if ($city): ?>

                <a href="<?php echo site_url(); ?>/locations/?city=<?php echo urlencode($city); ?>"><?php echo $city; ?></a>

              <?php endif; ?>

              <span> / </span>

              <?php $permits = get_field('permit'); ?>

              <?php if ($permits): ?>

                <?php foreach ($permits as $post): // variable must be called $post (IMPORTANT)       ?>

                  <?php setup_postdata($post); ?>

                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>									

                <?php endforeach; ?>

                <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly       ?>

              <?php endif; ?>

            </div>
          </div>

          <div class="col-md-8 col-sm-12" style="text-align:right">
            <?php
            if (function_exists('sharing_display')) {
              sharing_display('', true);
            }
            ?>
            <?php if ($permits && count($permits) > 0): ?>
              <button class="btn btn-default btn-open-fancybox" data-id="#permit_info_popup1"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/iocn_01.jpg" align="left" style="margin-right:5px;">Permit Info</button>
            <?php endif; ?>

            <button class="btn btn-default btn-open-fancybox" data-id="#contact_popup1"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/iocn_02.jpg" align="left" style="margin-right:5px;">Contact Us</button>
            <button class="btn btn-default open-moodboard"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/iocn_03.jpg" align="left" style="margin-right:5px;">Mood Board</button>
            <button class="btn btn-default btn-download-zip"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/iocn_04.jpg" align="left" style="margin-right:5px;">Download</button>

            <?php if (is_array($projects) && count($projects) > 0): ?>

              <button class="btn btn-default" id="project_item_button" ><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/iocn_05.jpg" align="left" style="margin-right:5px;">Projects</button>

            <?php endif; ?>						

            <?php if (get_field("aerial_video") || get_field('wistia_aerial_video')): ?>

              <button class="btn btn-default btn-open-fancybox" data-id="#new_video_popup1"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/iocn_06.jpg" align="left" style="margin-right:5px;">New Video</button>

            <?php endif; ?>

            <?php
            $city_address = get_field('city_address');
            if (get_loaction_city_code($city_address)):
              ?>

              <button class="btn btn-default btn-open-fancybox" data-id="#weather_popup1"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/iocn_07.jpg" align="left" style="margin-right:5px;">Weather</button>

            <?php endif; ?>

            <button class="btn btn-default btn-open-fancybox" data-id="#location_pdf_popup1"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/iocn_08.jpg" align="left" style="margin-right:5px;">Location PDF</button>
          </div>            
        </div>
      </div>
    </div>
  </section>


  <?php $similars = get_field('similar_locations'); ?>

  <?php if ($similars): ?>

    <!-- ------SKYstudio----------- -->
    <section>
      <div class="container">
        <div class="small_sec">
          <h3>Similar Locations</h3>

          <div class="swiper-container single-similar-locations">
            <div class="swiper-wrapper">                            
              <?php foreach ($similars as $similar): ?>

                <?php $photo = get_field('main_image_new', $similar->ID); ?>

                <?php if (get_post_status($similar->ID) == 'publish'): ?>

                  <div class="swiper-slide">
                    <a href="<?php echo get_permalink($similar->ID); ?>" title="<?php echo get_the_title($similar->ID); ?>">
                      <img class="swiper-lazy1 img-responsive" src="<?php echo $photo['sizes']['medium']; ?>" />                                    
                    </a>
                    <div class="similar-slider-caption">											
                      <a href="<?php echo get_permalink($similar->ID); ?>">
                        <?php echo get_the_title($similar->ID); ?>
                      </a>
                    </div>
                  </div>

                <?php endif; ?>

              <?php endforeach; ?>                            
            </div>    
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>                    



          </div>    
          <?php /*
            <div class="owl-carousel similar_locations_slider">

            <?php foreach ($similars as $similar): // variable must NOT be called $post (IMPORTANT)     ?>

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

           */ ?>



        </div>
      </div>
    </section>


    <section>
      <div class="mobile_small_Photo">
        <div class="container-fluid">
          <h3>Similar Locations</h3>
          <div class="row">

            <?php foreach ($similars as $similar): ?>

              <?php $photo = get_field('main_image_new', $similar->ID); ?>

              <?php if (get_post_status($similar->ID) == 'publish' && is_array($photo)): ?>

                <div class="col-xs-6 pd">
                  <div class="similar_photo">                    
                    <img class="swiper-lazy1 img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo $photo['sizes']['large']; ?>&height=340&width=510&cropratio=1.70:1&amp;image=<?php echo $photo['sizes']['large']; ?>" />
                    <a href="<?php echo get_the_permalink($similar->ID); ?>"><?php echo get_the_title($similar->ID); ?></a>
                  </div>
                </div>

              <?php endif; ?>

            <?php endforeach; ?>

          </div>
        </div>
      </div>
    </section>

  <?php endif; ?>

  <!----------------contact-------------------->
  <div style="display:none" >
    <div id="contact_popup1">
      <section>
        <div class="contact_popup">
          <h4 style="font-weight: 200;">Contact us about <span style="color:#000;"><?php the_title(); ?></span></h4>
          <div class="row md" id="contact_list">

            <div class="col-md-5ths col-sm-5ths col-xs-4 pd user">
              <div class="view view-sixth" id="jennifer">
                <img alt="Jennifer Sanchez" src="<?php echo get_stylesheet_directory_uri() ?>/images/contact/02.jpg" width="100%" class="img-responsive"/>
                <div class="mask">
                  <h2>Jennifer Sanchez</h2>
                  <p>Executive Location Agent</p>
                  <div class="line"></div>
                </div>
              </div>
              <div class="clearfix"></div> 
            </div>

            <div class="col-md-5ths col-sm-5ths col-xs-4 pd user">
              <div class="view view-sixth" id="jason">
                <img alt="Jason Radspinner" src="<?php echo get_stylesheet_directory_uri() ?>/images/contact/09.jpg" width="100%" class="img-responsive"/>
                <div class="mask">
                  <h2>Jason Radspinner</h2>
                  <p>Executive Location Agent</p>
                  <div class="line"></div>
                </div>
              </div>
              <div class="clearfix"></div> 
            </div>

            <div class="col-md-5ths col-sm-5ths col-xs-4 pd user">
              <div class="view view-sixth" id="kelsii">
                <img alt="Kelsii.Dyer" src="<?php echo get_stylesheet_directory_uri() ?>/images/contact/31.jpg" width="100%" class="img-responsive"/>
                <div class="mask">
                  <h2>Kelsii Dyer</h2>
                  <p>Location Agent</p>
                  <div class="line"></div>
                </div>
              </div>
              <div class="clearfix"></div> 
            </div>

            <div class="col-md-5ths col-sm-5ths col-xs-4 pd user">
              <div class="view view-sixth" id="alice">
                <img alt="Alice Kim" src="<?php echo get_stylesheet_directory_uri() ?>/images/contact/07.jpg" width="100%" class="img-responsive"/>
                <div class="mask">
                  <h2>Alice Kim</h2>
                  <p>Location Agent</p>
                  <div class="line"></div>
                </div>
              </div>
              <div class="clearfix"></div> 
            </div>

            <div class="col-md-5ths col-sm-5ths col-xs-4 pd user">
              <div class="view view-sixth" id="paulina">
                <img alt="Paulina Kuszta" src="<?php echo get_stylesheet_directory_uri() ?>/images/contact/24.jpg" width="100%" class="img-responsive"/>
                <div class="mask">
                  <h2>Paulina Kuszta</h2>
                  <p>Events Coordinator</p>
                  <div class="line"></div>
                </div>
              </div>
              <div class="clearfix"></div> 
            </div>


          </div>
          <div class="clearfix"></div> 
          <div class="row">

            <div class="col-md-6"  style="margin-top:5px;"">
              <p class="black_title" style="display:none;">To: <a id="all_agent" style="display: inline;">(Everyone) </a><span id="contact_person" style="color:red"></span></p>
              <?php echo do_shortcode('[contact-form-7 id="146778" title="Location Contact New"]') ?>
            </div>  


            <div class="col-md-6">  
              <div class="clearfix"></div> 
              <div class="black_title">General Contact:</div>
              <p><span style="margin-right:5px;"><i class="fa fa-envelope"></i></span> paul@imagelocations.com</p>
              <p><span style="margin-right:5px;"><i class="fa fa-phone"></i></span> (310) 871-8004</p>
              <p><span style="margin-right:5px;"><i class="fa fa-map-marker"></i></span> 9663 Santa Monica Blvd. Suite 842, Beverly Hills, CA 90210</p><br /><br /> <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer_logo.png" width="50%" style="float:left;" />
            </div>                  
          </div>
        </div>
      </section>
    </div>
  </div>

  <!----------------New Video Popup-------------------->
  <div style="display:none" >
    <div id="new_video_popup1">    
      <section>
        <div class="new_video_popup">
          <div class="row md">

            <?php if (get_field("aerial_video") || get_field('wistia_aerial_video')): ?>

              <?php if (get_field('wistia_aerial_video')): ?>

                <h4 style="font-weight: 200;">
                  Wistia Video of <span style="color:#000;"><?php the_title(); ?></span>
                </h4>

                <div class="clearfix">&nbsp;</div>

                <div class="col-md-12">

                  <script charset="ISO-8859-1" src="//fast.wistia.com/assets/external/E-v1.js" async></script>
                  <div class="wistia_embed wistia_async_<?php the_field("wistia_aerial_video") ?>" style="height:480px;width:100%">&nbsp;</div>

                </div>

              <?php elseif (get_field('aerial_video')): ?>				

                <h4 style="font-weight: 200;">
                  Aerial Video of <span style="color:#000;"><?php the_title(); ?></span>
                </h4>

                <div class="clearfix">&nbsp;</div>

                <div class="col-md-12">

                  <?php echo do_shortcode('[vimeo ' . get_field("aerial_video") . '  w=800&h=456]') ?>

                </div>

              <?php endif; ?>

            </div>

          <?php else: ?>

            <?php echo "<h3>No Video...</h3>"; ?>

          <?php endif; ?>

        </div>
    </div>
  </section>
  </div>
  </div>    

  <!----------------Weather-------------------->
  <div style="display:none" >
    <div id="weather_popup1">    
      <section>
        <div class="weather_popup">
          <div class="row md">
            <div class="col-md-12">
              <?php
              $city_address = get_field('city_address');
              $city_code = get_loaction_city_code($city_address);
              if ($city_code):
                ?>

                <?php echo do_shortcode("[astero id='" . $city_code . "']"); ?>

              <?php endif; ?>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

  <!----------------- moodborad------------------------>
  <section>
    <div class="mood">
      <div class="droptarget" ondrop="drop(event)" ondragover="allowDrop(event)">

        <div class="row row-submit-area">
          <div class="col-md-12 ">
            <p class="text-center">
              <span>Create Mood Board:</span> Double click on the image above to add.
              <button type="button" data-id="#location_pdf_moodboard_popup1" class="btn btn-primary btn-open-fancybox">Generate Custom PDF</button>
            </p>

          </div>
        </div>  

        <div class="photo_h clearfix clear">
          <div class="owl-carousel droppable-slider">
          </div>
        </div>        

        <div id="mood_board_popup_close" class="close"> </div>
      </div>
      <p id="demo"></p>
    </div>
  </section>

  <!----------------Location PDF -------------------->
  <div style="display:none" >
    <div id="location_pdf_popup1">    
      <section>
        <div class="location_pdf_popup">
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
        </div>
      </section>
    </div>
  </div>

  <!-----location_pdf_moodboard_popup----->
  <div style="display:none" >
    <div id="location_pdf_moodboard_popup1">    
      <section>
        <div class="location_pdf_moodboard_popup">
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

            <div class="form-group">
              <label for="Send PDF to Email">CC Email: </label>
              <input type="text" name="email_cc" class="form-control" id="email_cc" placeholder="Also Send PDF to CC Email" data-type="email">
            </div>

            <input type="hidden" name="pdf_images" id="pdf_images"/>
            <input type="hidden" name="website_url" id="website_url" value="<?php echo site_url(); ?>" />
            <input type="hidden" name="theme_path" id="theme_path" value="<?php echo get_stylesheet_directory(); ?>" />

            <button type="submit" class="btn btn-primary">Send</button>

          </form>
          <div class="clearfix"></div>
        </div>
      </section>
    </div>
  </div>

  <!----------------Permit Info Popup-------------------->
  <div style="display:none" >
    <div id="permit_info_popup1">
      <section>

        <div class="permit_info_popup">
          <div class="row md">

            <div class="col-md-12">              
              <h4 style="font-weight: 200;">
                Permit information for <span style="color:#000;"><?php the_title(); ?></span>
              </h4>
            </div>

            <?php $permits = get_field('permit'); ?>

            <?php if ($permits): ?>

              <?php foreach ($permits as $post): setup_postdata($post); // variable must be called $post (IMPORTANT)            ?>

                <?php if ($post->post_content != "") : ?>
                  <div class="col-md-12">
                    <?php the_post_thumbnail('large', array('class' => 'img-responsive', 'style' => '')); ?>  
                    <?php the_content() ?>
                  </div>
                <?php else: ?>								
                  <div class="col-md-12">
                    <?php the_post_thumbnail('large', array('class' => 'img-responsive', 'style' => 'max-width:250px;margin:20% auto;')); ?>
                  </div>
                <?php endif; ?>

              <?php endforeach; ?>

              <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly       ?>

            <?php else: ?>

              <?php echo "<h3>Permit details not available...</h3>"; ?>

            <?php endif; ?>

          </div>
        </div>
      </section>
    </div>
  </div>

  <!-- --------------Project List Popup------------------ -->

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

      <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly          ?>

    </div>

  <?php endif; ?>


  <div class="location-single-toprint">

    <div class="container">

      <div class="row">

        <div class="clearfix">&nbsp;</div>

        <div class="col-md-6">
          <a class="navbar-brand"><img alt="" src="<?php echo site_url(); ?>/wp-content/themes/image_locations_child/images/logo.jpg"></a>
        </div>

        <div class="clearfix">&nbsp;</div>

        <div class="col-md-12 col-sm-12">

          <h3><?php the_title(); ?></h3>

          <div class="link">

            <?php $city = get_field('city_address'); ?>

            <?php if ($city): ?>

              <a><?php echo $city; ?></a>

            <?php endif; ?>

            <span> / </span>

            <?php $permits = get_field('permit'); ?>

            <?php if ($permits): ?>

              <?php foreach ($permits as $post): // variable must be called $post (IMPORTANT)          ?>

                <?php setup_postdata($post); ?>

                <a><?php the_title(); ?></a>

              <?php endforeach; ?>

              <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly          ?>

            <?php endif; ?>

          </div>

        </div>

        <div class="clearfix">&nbsp;</div>

        <ul>

          <?php $images = get_field('location_photos_new'); ?>

          <?php if ($images): ?>

            <?php
            $i = 1;
            foreach ($images as $image):
              ?>                        

              <?php if ($i == 1): ?>				

                <?php $image = get_field('collage_new'); ?>

                <?php if ($image): ?>

                  <li>					  
                    <img class="img-responsive" src="<?php echo $image['sizes']['medium']; ?>" />
                  </li>

                <?php endif; ?>

              <?php else: ?>

                <li>
                  <img src="<?php echo $image['sizes']['medium']; ?>" class="img-responsive" />
                </li>                        

              <?php endif; ?>

              <?php if ($i % 3 == 0): ?>

                <div class="clearfix">&nbsp;</div>

              <?php endif; ?>

              <?php
              $i++;
            endforeach;
            ?>

          <?php endif; ?>  

          <?php if ($similars): ?>

            <?php foreach ($similars as $similar): ?>

              <?php $photo = get_field('main_image_new', $similar->ID); ?>

              <?php if (get_post_status($similar->ID) == 'publish' && is_array($photo)): ?>

                <li>
                  <img class="img-responsive" src="<?php echo $photo['sizes']['medium']; ?>" />
                </li>

              <?php endif; ?>

            <?php endforeach; ?>

          <?php endif; ?>

        </ul>

      </div>      

    </div>

  </div>

<?php endwhile; ?>

<div id="AjaxLoaderDivForZip" style="display: none;z-index:9999999 !important;">
  <div style="width:100%; height:100%; left:0px; top:0px; position:fixed; opacity:0; filter:alpha(opacity=40); background:#000000;z-index:999999999;">
  </div>
  <div style="float:left;width:100%; left:0px; top:50%; text-align:center; position:fixed; padding:0px; z-index:999999999;">
    <center>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ajax-loader.gif">
    </center>
  </div>
</div>

<form id="zip-frm" method="post">
  <input type="hidden" name="images" id="images" />
  <input type="hidden" name="url" id="zip_url" />
  <input type="hidden" name="path" id="zip_path" />
  <input type="hidden" name="location_slug" value="<?php echo $location_post_slug; ?>" />
</form>

<script>

  jQuery(function ($) {

    jQuery('#pdf_generate_form').submit(function () {

      var arr = '';
      var i = 0;
      jQuery('.moodboard-swiper .swiper-slide').each(function ()
      {
        var my_img = jQuery(this).children('img').attr('src');
        arr += my_img + ',';
        i++;
      });

      jQuery('#pdf_generate_form #pdf_images').val(arr);

      if (jQuery(this).parsley('isValid'))
      {
        jQuery('.md-pdf-location-close').trigger('click');
      }
    });

    jQuery('#pdf_generate_moodboard').submit(function () {

      var arr = '';
      var i = 0;
      jQuery('.mood .item img.mood-img').each(function ()
      {
        var my_img = jQuery(this).attr('src');
        arr += my_img + ',';
        i++;
      });

      if (arr == "")
      {
        jQuery.bootstrapGrowl("Please select minimum 1 image", {type: 'danger'});
        return false;
      }

      jQuery('#pdf_generate_moodboard #pdf_images').val(arr);

      if (jQuery(this).parsley('isValid'))
      {
        jQuery('.md-pdf-location-close').trigger('click');
      }
    });

  });

</script>

<?php get_footer(); ?>