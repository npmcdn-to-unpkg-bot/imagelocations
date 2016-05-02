<?php
/*
Template Name: Ajax-Portfolio
*/
?>
<?php
global $post;

  if (isset($_REQUEST) && $_REQUEST['action'] == 'portfolio_ajax_request_new') {

    $project_category = $_REQUEST['project_category'];
    $age = $_REQUEST['age'];

    $query_variable = '';

    if ($age > 0) {
      $query_variable = '&age=' . $age;
    } else {
      $query_variable = '&project_category=' . $project_category;
    }

    $return_html = '';

    // Let's take the data that was sent and do something with it
    if (isset($_REQUEST['project_category']) || isset($_REQUEST['age'])) {

      query_posts('post_type=portfolio' . $query_variable . '&showposts=100');

      while (have_posts()) : the_post();
	  
	   if(has_post_thumbnail()){
			   
			$return_html .= '<div class="photoGrid">';
			$href = '';

			$posts = get_field('portfolio_location');

			if ($posts):

			  foreach ($posts as $p):
				$href .= get_permalink($p);
			  endforeach;
			endif;

			$return_html .= '<a href="' . $href . '">';

			$return_html .= get_the_post_thumbnail(get_the_ID(), 'medium');

			$return_html .= '</a>';

			$return_html .= '</div>';
	   }
      endwhile;

      if ($age == 2010) {

        for ($i = $age - 1; $i > 2001; $i--) {

          query_posts('post_type=portfolio&age=' . $i . '&showposts=100');

          while (have_posts()) : the_post();
			
			if(has_post_thumbnail()){
				$return_html .= '<div class="photoGrid">';
				$href = '';

				$posts = get_field('portfolio_location');

				if ($posts):

				  foreach ($posts as $p):
					$href .= get_permalink($p);
				  endforeach;
				endif;

				$return_html .= '<a href="' . $href . '">';

				$return_html .= get_the_post_thumbnail(get_the_ID(), 'medium');

				$return_html .= '</a>';

				$return_html .= '</div>';
			}
          endwhile;
        }
      }

      echo $return_html;
    }
	
  }else if (isset($_REQUEST) && $_REQUEST['action'] == 'random_location_ajax_request') {
	  $random_html = '';


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
		
		if(is_array($post_ids) && count($post_ids) > 0){
			
			$args = array( 'post_type' => 'post', 'post__in' => $random_id, 'posts_per_page' => 5  );

			$random_locations = get_posts($args);

			if(is_array($random_locations) && count($random_locations) > 0){

				$i = 0; 
				foreach($random_locations as $post){
					
					setup_postdata($post);
				
					if($i < 2){
						
						$random_html .= '<div class="col-md-6 col-sm-6 col-xs-12 quickview">';
						  
						$image = get_field('main_image_new');
						if ($image){		
							$random_html .= '<a href="'.get_the_permalink().'">';
							$random_html .= '<img class="img-responsive" src="'.get_stylesheet_directory_uri().'/image.php?'.$image['sizes']['large'].'&height=300&width=614&cropratio=1:0.5&amp;image='.$image['sizes']['large'].'" width="100%"/>';
							$random_html .= '</a>';
						}
						  
						$random_html .= '<a href="'.get_the_permalink().'" class="text-decoration-none"><h3>'.get_the_title().'</h3></a>';
						$random_html .= '<div class="clearfix"></div></div>';
						
					}else{
					
						$random_html .= '<div class="col-md-4 col-sm-4 col-xs-12 quickview">';
						  
						$image = get_field('main_image_new');
						if ($image){		
							$random_html .= '<a href="'.get_the_permalink().'">';
							$random_html .= '<img class="img-responsive" src="'.get_stylesheet_directory_uri().'/image.php?'.$image['sizes']['large'].'&height=200&width=314&cropratio=1.50:1&amp;image='.$image['sizes']['large'].'" width="100%"/>';
							$random_html .= '</a>';
						}						  
						  
						$random_html .= '<a href="'.get_the_permalink().'" class="text-decoration-none"><h3>'.get_the_title().'</h3></a>';
						$random_html .= '<div class="clearfix"></div></div>';
						
					}
				
					$i++; 
				}

				wp_reset_postdata($post);
				echo $random_html;
			}
		}
		
  }else{
	  echo "Non Ajax Request";
  }

  // Always die in functions echoing ajax content
  die();