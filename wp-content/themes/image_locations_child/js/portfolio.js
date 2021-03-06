/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(window).load(function () {

  var ItemCounter = 0;

  var options = [
    ['recent-projects', 0],
    ['magazines', 0],
    ['motion-pictures', 0],
    ['fashion', 0],
    ['television', 0],
    ['advertising', 0],
    ['music', 0],
    ['web-series', 0],
    ['2015', '2015'],
    ['2014', '2014'],
    ['2013', '2013'],
    ['2012', '2012'],
    ['2011', '2011'],
    ['2010', '2010'],
  ];

  var OptionsTotal = options.length;

  function get_category_posts_html(project_category, age) {

    if (jQuery('.loading-div-' + project_category).size() > 0) {
      jQuery('.loading-div-' + project_category).show();
    }

    // This does the ajax request
    jQuery.ajax({
      url: 'http://imagelocations.com/ajax-load-portfolio/',
      data: {
        'action': 'portfolio_ajax_request_new',
        'project_category': project_category,
        'age': age
      },
      success: function (data) {
        jQuery('.' + project_category).html(data);


        jQuery('.' + project_category).imagesLoaded(function () {


          //jQuery('#' + project_category).waterfall();
		  
		   jQuery("#"+project_category+" img").each(function(){
			  var image = jQuery(this); 
			  if(image.context.naturalWidth == 0 || image.readyState == 'uninitialized'){  
				 jQuery(image).unbind("error").hide();
			  } 
		   }); 
		
		  
          jQuery('#' + project_category).show();

          if (jQuery('.loading-div-' + project_category).size() > 0) {
            jQuery('.loading-div-' + project_category).hide();
          }
		  		   
			jQuery('#'+project_category).photoGrid({
				itemSelector: ".photoGrid", // item selecor 
				resize: true, // automatic reload grid on window size change
				rowHeight: 280, // looks best, but needs highres thumbs
				callback: function() {
					
					if(project_category > 0){
						jQuery("#"+project_category).closest('li').find('.cd-faq-trigger').trigger('click');
						console.log('click');
					}
					
					//console.log('#'+project_category);
				} // fires when layouting grid is done
			});
		  
          ItemCounter++;
		  if(ItemCounter < OptionsTotal)
		  {
			get_category_posts_html(options[ItemCounter][0], options[ItemCounter][1]);
		  }

        });




      },
      error: function (errorThrown) {
        console.log(errorThrown);
      }
    });
  }

  get_category_posts_html(options[0][0], options[0][1]);

  // waterfall script [end]
  jQuery('.faq_sec').show();
  jQuery('#2015').hide();
  jQuery('#2014').hide();
  jQuery('#2013').hide();
  jQuery('#2012').hide();
  jQuery('#2011').hide();
  jQuery('#2010').hide();

})