  /*
   *
   * $.fn.is_inview
   * v 1.3
   *
   */ 
/*   
  Applys when

    'bc.inview.on'
    'bc.inview.partial'
    'bc.inview.off' 

  is inview base constructor for extend

*/

+function ($) {
  
  function inviewMe_lazybackground(ele){ 

    if( ele.attr('data-is-inview-lazybackground') && !ele.hasClass('isv-lazysrc-loaded') ){ 
      ele.addClass('isv-lazysrc-loading');
      var lazysrc_url = ele.attr('data-is-inview-lazybackground'); 
      var loading = ele.find('.isv-lazysrc-loader'); 
      loading.fadeIn(0); 
      var temp = $("<img>");
      temp.load(lazysrc_url, function(){
        ele.removeClass('isv-lazysrc-loading'); 
        ele.addClass('isv-lazysrc-loaded');
        var new_src = $(this).attr('src'); 
        var orig_src = ele.css('background-image'); 
        // Prevent flickering once css changes
        ele.css('background-image', 'url('+new_src+'), '+orig_src+'');  
        loading.delay(300).fadeOut(600, function(){
          // Remove the previous double background-image definition 
          ele.css('background-image', 'url('+new_src+')');  
          loading.remove(); 
        }); 
      });
      temp.attr('src', lazysrc_url); 
    }
  }
  
  $('[data-is-inview]').on('bc.inview.on', function(){ 
     inviewMe_lazybackground($(this));
     $(this).find('[data-is-inview-lazybackground]').each(function(){
      inviewMe_lazybackground($(this));
     });
  });
  $('[data-is-inview]').on('bc.inview.partial', function(){
    if($(this).attr('data-is-inview')!='detect-partial'){
       inviewMe_lazybackground($(this));
       $(this).find('[data-is-inview-lazybackground]').each(function(){
        inviewMe_lazybackground($(this));
       });
    }  
  }); 
  $('[data-is-inview]').on('bc.inview.off', function(){ 
     
  }); 

  $('[data-is-inview-lazybackground]').each(function(){
    $(this).prepend('<span class="isv-lazysrc-loader"/>'); 
  });

}(jQuery);