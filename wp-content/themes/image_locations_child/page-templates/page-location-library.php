<?php
/*
  Template Name: Location Library
 */
get_header();
?>


<!--------location library------------->
<section>
    <div class="container">
        <div id="location_library" class="location_sec">
            <div class="row">
                <!--------left------------->
                <div class="col-md-3 col-sm-4">
                    <div class="leftside">
                        <a href="javascript:void(0);" data-target="" class="location-hash-link btn btn-primary red_text">Exclusives<i class="fa fa-angle-right"></i></a>
                        <a href="javascript:void(0);" data-target="featured_categories_anchor" class="location-hash-link btn btn-primary">Featured<i class="fa fa-angle-right"></i></a>
                        <a href="javascript:void(0);" data-target="all_ctegories_anchor" class="location-hash-link btn btn-primary">All Categories<i class="fa fa-angle-right"></i></a>
                        <div class="link_left categories_sm_links">
                            <ul>
                                <?php
                                $args = array(
                                    'orderby' => 'name',
                                    'order' => 'ASC',
                                    'exclude' => '11839',
                                );
                                ?>

                                <?php $categories = get_categories($args); ?>

                                <?php foreach ($categories as $category): ?>

                                    <?php
                                    if (is_numeric($category->name[0])):

                                        echo '<li><a href="' . get_category_link($category->term_id) . '" title="' . sprintf(__("View all posts in %s"), $category->name) . '" ' . '><span>›</span>' . $category->name . '</a></li>';

                                    else:

                                        foreach (range('A', 'Z') as $i) {

                                            if (strpos($category->name[0], $i) !== FALSE) {

                                                if ($category->name[0] == $current_letter) {

                                                    echo '<li><a href="' . get_category_link($category->term_id) . '" title="' . sprintf(__("View all posts in %s"), $category->name) . '" ' . '><span>›</span>' . $category->name . '</a></li>';
                                                } else {

                                                    echo '<li><a href="' . get_category_link($category->term_id) . '" title="' . sprintf(__("View all posts in %s"), $category->name) . '" ' . '><span>›</span>' . $category->name . '</a></li>';
                                                }
                                                $current_letter = $category->name[0];
                                            }
                                        }

                                    endif;
                                    ?>

                                <?php endforeach; ?>

                            </ul>
                        </div>
                        <div id="abcd">
                            <ul>
                                <?php 
                                    $azRange = range('A', 'Z');
                                    foreach ($azRange as $letter)
                                    {
                                        ?>
                                        <li><a href="javascript:void(0);" class="location-hash-link" data-target="<?php echo $letter;?>"><?php echo $letter;?></a></li>
                                        <?php 
                                    }    
                                ?>                                                                                                
                            </ul>
                        </div>                        
                        <div class="clearfix"></div>
                    </div>

                </div>
                <!--------right------------->
                <div class="col-md-9 col-sm-8">
                    <div class="right_photo">

                        <?php query_posts('category_name=Exclusives&showposts=20'); ?>

                        <?php if (have_posts()) : ?>

                            <div class="row md">	

                                <?php $i = 1;
                                while (have_posts()) : the_post(); ?>

                                    <div class="col-md-3 col-sm-6 pd">
										<a href="<?php echo get_the_permalink(); ?>">
                                        <?php
                                        $image_main = get_field('main_image_new');
                                        $size_main = 'medium'; // (thumbnail, medium, large, full or custom size)
                                        $image_library = get_field('location_library_image');
                                        $size_library = 'medium'; // (thumbnail, medium, large, full or custom size)
                                        ?>

                                        <?php if ($image_library): ?>

                                            <?php $image_src = wp_get_attachment_image_src($image_library, $size_library, false, array('class' => 'img-responsive')); ?>
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo $image_src; ?>&height=211&width=141&cropratio=1.70:1&amp;image=<?php echo $image_src[0]; ?>" class="img-responsive" />

                                        <?php elseif ($image_main): ?>

                                            <?php $image_src = wp_get_attachment_image_src($image_main, $size_main, false, array('class' => 'img-responsive')); ?>
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo $image_src; ?>&height=211&width=141&cropratio=1.70:1&amp;image=<?php echo $image_src[0]; ?>" class="img-responsive" />

										<?php endif; ?>

                                        <div class="text_caption">
                                            <p><?php echo the_title(); ?></p>
                                        </div>
									
										</a>
										
                                    </div>

        <?php if ($i % 4 == 0): ?>

                                        <div class="clearfix"></div>

                                    <?php endif; ?>

        <?php $i++;
    endwhile; ?>                                                                                                                  

                                <div class="col-md-3 col-sm-6 pd">
                                    <a href="/zen-garden/">                                        
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo site_url().'/wp-content/uploads/2015/05/Garden-06k-FrontBanner_12-513x340.jpg'; ?>&height=211&width=141&cropratio=1.70:1&amp;image=<?php echo site_url().'/wp-content/uploads/2015/05/Garden-06k-FrontBanner_12-513x340.jpg'; ?>" class="img-responsive" />
                                        <div class="text_caption">
                                            <p>Zen Garden</p>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3 col-sm-6 pd">
                                    <a href="/mansion-31/">                                        
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo site_url().'/wp-content/uploads/2015/09/Mansion-31-FrontBanner_11-513x340.jpg'; ?>&height=211&width=141&cropratio=1.70:1&amp;image=<?php echo site_url().'/wp-content/uploads/2015/09/Mansion-31-FrontBanner_11-513x340.jpg'; ?>" class="img-responsive" />
                                        <div class="text_caption">
                                            <p>Palisades Ranch</p>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3 col-sm-6 pd">
                                    <a href="/exotic-1/">                                        
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo site_url().'/wp-content/uploads/2015/05/Exotic-01c-FrontBanner_13-605x340.jpg'; ?>&height=211&width=141&cropratio=1.70:1&amp;image=<?php echo site_url().'/wp-content/uploads/2015/05/Exotic-01c-FrontBanner_13-605x340.jpg'; ?>" class="img-responsive" />
                                        <div class="text_caption">
                                            <p>Exotic 1</p>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3 col-sm-6 pd">
                                    <a href="/category/exclusives/">                                        
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo site_url().'/wp-content/uploads/2015/05/Retro-06f-up_013-513x340.jpg'; ?>&height=211&width=141&cropratio=1.70:1&amp;image=<?php echo site_url().'/wp-content/uploads/2015/05/Retro-06f-up_013-513x340.jpg'; ?>" class="img-responsive" />
                                        <div class="text_caption">
                                            <p>See More Exclusives</p>
                                        </div>
                                    </a>
                                </div>

                            </div>

    <?php wp_reset_query();
endif; ?>
                        <div class="clearfix" id="featured_categories_anchor">&nbsp;</div>    
                        <h1>Featured Categories </h1>

						<?php $featured_categories = get_field('featured_categories'); ?>
						
						<?php /*echo "<pre>"; ?>
						
							<?php print_r($featured_categories); ?>
						
						<?php echo "</pre>"; */ ?>
						
						<?php if(is_array($featured_categories) && count($featured_categories) > 0): ?>
							
							<div class="row md">
							
							<?php foreach($featured_categories as $fc): ?>
							
								<div class="col-md-3 col-sm-6 pd">
								
									 <a href="<?php echo isset($fc['link_url'])? $fc['link_url'] : '#'; ?>"> 
									 
										<?php if(is_array($fc['image']) && count($fc['image']) > 0): ?>
									 
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo $fc['image']['sizes']['large']; ?>&height=211&width=141&cropratio=1.70:1&amp;image=<?php echo $fc['image']['sizes']['large']; ?>" class="img-responsive" alt="<?php echo $fc['image']['alt']; ?>" />
											
										<?php endif; ?>
											
										<div class="text_caption">
											<p><?php echo isset($fc['name'])? $fc['name'] : ''; ?></p>
										</div>
										
									 </a>
								
								</div>
									
							<?php endforeach; ?>
						
							</div>
						
							<div class="clearfix">&nbsp;</div>
						
						<?php endif; ?>
						      
							  
							  
                    
                        
						<div class="clearfix" id="all_ctegories_anchor">&nbsp;</div>
                        <h1>All Categories</h1>

                        <div class="row md">

                            <?php $temp_array = array(); ?> 

                            <?php                             
                            $i = 1;
                            $id_attr = '';
                            $old_id = '';
                            $new_id = '';
                            foreach (get_categories('orderby=name&exclude=11839') as $cat) : ?>

                                <?php                               
                                $char = strtoupper(substr(trim($cat->cat_name), 0, 1));
                                $new_id = $char;
                                if (!in_array($char, $temp_array)) 
                                {
                                    array_push($temp_array, $char);
                                    $id_attr = 'id="' . $char . '"';
                                }
                                ?> 

                                <div class="col-md-3 col-sm-6 pd" id="<?php if($new_id != $old_id){$old_id = $new_id;echo $old_id;}?>">					  
                                    <?php $category_image = get_field('category_image', 'category_' . $cat->term_id); ?>
                                    <a href="<?php echo get_category_link($cat->term_id); ?>" class="<?php echo $cat->cat_name; ?>">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/image.php?<?php echo $category_image['sizes']['large']; ?>&height=211&width=141&cropratio=1.70:1&amp;image=<?php echo $category_image['sizes']['large']; ?>" class="img-responsive" alt="" />
                                        <div class="text_caption">
                                            <p><?php echo $cat->cat_name; ?></p>
                                        </div>
                                    </a>																
                                </div>

                                <?php if ($i % 4 == 0): ?>
                                    <div class="clearfix"></div>
    <?php endif; ?>

    <?php $i++;
endforeach; ?>						

                        </div>

                    </div>
                </div>        


            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>