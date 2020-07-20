+function ($) {

  /* ------------------ */
  /*
   *
   * $.fn.inview_me
   * v 1.1
   *
   */ 

  $.fn.inview_me = function(options) {

      var self = $(this); 

      if(self.length==0) return;

      var defaults = {

        'offset': $('body').data('inview-me-offset') ? $('body').data('inview-me-offset') : 0,
        'offsetTop': $('body').data('inview-me-offsetTop') ? $('body').data('inview-me-offsetTop') : 0,
        'offsetBottom': $('body').data('inview-me-offsetBottom') ? $('body').data('inview-me-offsetBottom') : 0,

        'breakpoint': $('body').data('inview-me-breakpoint') ? $('body').data('inview-me-breakpoint') : 'xs',

      }; 
      var settings = $.extend(defaults, options);

      var in_viewport_window = function(me, target, is_window) { 
        var elementTop = target.offset().top;
        //target.attr('data-offsetTop', elementTop);
        if(!is_window){

        }else{

        }
        if( elementTop < target.outerHeight() ){
          return true;
        }else{
          return false;
        }
      }
      var is_oversized = function(me, target, is_window){ 
        var element = me;
        var viewport = target;
        var offset = element.attr('data-inview-me-offset') ? element.attr('data-inview-me-offset') : settings.offset; 

        var offset_bottom = offset_bottom ? offset_bottom : offset; 
        return me.outerHeight() + (offset+offset_bottom) > viewport.outerHeight() - (me.outerHeight());
      } 

      var in_viewport = function(me, target, is_window){ 
        var element = me;
        var viewport = target;
        var offset = element.attr('data-inview-me-offset') ? element.attr('data-inview-me-offset') : settings.offset; 
        var offset_top = element.attr('data-inview-me-offset-top') ? element.attr('data-inview-me-offset-top') : ( settings.offsetTop ? settings.offsetTop : offset);
        var offset_bottom = element.attr('data-inview-me-offset-bottom') ? element.attr('data-inview-me-offset-bottom') : ( settings.offsetBottom ? settings.offsetBottom : offset); 

        var elementTop = element.offset().top;
        var elementLeft = element.offset().left;
        var elementHeight = element.outerHeight(true); 
        var elementWidth = element.outerWidth(true); 

        
        var viewportTop = viewport.scrollTop();
        var viewportHeight = viewport.height();
        var viewportWidth = viewport.width(); 
        var viewporLeft = viewport.scrollLeft(); 
        
        //console.log('data-offset: '+offset);
        /*
        Take diferent approach when using window as target scroll element.
        If not using "window" as target, that is normal scroll body beheavior
        then, use a diferent calculation.
        */
        var viewportOffsetTop = 0;
        var viewportOffsetLeft = 0;
        if(!is_window){
          viewportOffsetTop = viewport.offset().top;
          viewportOffsetLeft = viewport.offset().left; 
        } 

        if(elementTop < viewportTop + (parseFloat(offset_top)) ){
          element.attr('data-element-top','true');
        }else{
          element.attr('data-element-top','false');
        }
        if(elementTop + elementHeight > viewportTop + viewportHeight + (parseFloat(offset_top)) ){
          element.attr('data-element-bottom','true');
        }else{
          element.attr('data-element-bottom','false');
        }
        if(elementTop + elementHeight > viewportTop + (parseFloat(offset_top)) ){
          element.attr('data-element-above','false'); 
        }else{
          element.attr('data-element-above','true');
        }

        if(is_window){
          return  elementTop + elementHeight > viewportTop + (parseFloat(offset_top))  && 
                  elementTop < viewportTop + viewportHeight - (parseFloat(offset_bottom))  && 
                  elementLeft + elementWidth > viewporLeft && 
                  elementLeft < viewporLeft + viewportWidth;
        } else { 
          //me.attr('data-elementTop',elementTop);
          //me.attr('data-viewportHeight',viewportHeight); 
          return  elementTop + elementHeight > viewportOffsetTop + (parseFloat(offset_top))  &&
                  elementTop < viewportHeight + viewportOffsetTop - (parseFloat(offset_bottom))  &&
                  elementLeft + elementWidth > 0 && 
                  elementLeft < viewportWidth + viewportOffsetLeft;
        } 

        
      } 

      var if_is_breakpoint = function(me){
        var this_break = settings.breakpoint;
        if( get_window_sizes('w') > bc_config.breakpoints[this_break]){
          var is_break = true;
        }else{
          var is_break = false;
        }
        return is_break;
      }

      var make_inview_me = function(me, target, is_window){  

        make_apply_inview_me_pre(me, target, is_window);

        if(is_oversized(me, target, is_window)){
          me.addClass('is_oversized');
        }else{
          me.removeClass('is_oversized');  
        }

        if( in_viewport(me, target, is_window) ){ 
           me.removeClass('not_in_viewport');
           me.addClass('in_viewport');   

           if(!me.hasClass('inview-me-once')){
            me.addClass('make_apply_inview_me');
            make_apply_inview_me(me, target, is_window);
          }
          if(me.attr('data-inview-me-once')=='true'){
            me.addClass('inview-me-once');
            normalizeCSS(me);
          } 

        }else{
           me.addClass('not_in_viewport');
           me.removeClass('in_viewport'); 

           if(!me.hasClass('inview-me-once')){
            me.removeClass('make_apply_inview_me');
            reset_apply_inview_me(me, target, is_window);
          }
        } 
        /*
        Here i could also add some other filters, like if element is no on DOM 
        or invisible.... or even if element has some class... :)
        */
        var is_viewport_window = true;

        /* So, target will work only when not "window" used. */
        if(!is_window){
          if( in_viewport_window(me, target, is_window) ){
            is_viewport_window = true;
            target.addClass('in_viewport_window');
            target.removeClass('not_in_viewport_window');
          }else{
            is_viewport_window = false;
            target.removeClass('in_viewport_window');
            target.addClass('not_in_viewport_window');
          }
        }  
        
        /* If on viewport area and also if on viewport window (only when not "window") 
        if( me.hasClass( 'in_viewport' ) && is_viewport_window ){  
          if(!me.hasClass('inview-me-once')){
            me.addClass('make_apply_inview_me');
            make_apply_inview_me(me, target, is_window);
          }
          if(me.attr('data-inview-me-once')=='true'){
            me.addClass('inview-me-once');
          } 
        }else{ 
          if(!me.hasClass('inview-me-once')){
            me.removeClass('make_apply_inview_me');
            reset_apply_inview_me(me, target, is_window);
          }
        } 
        */
      }

      var remove_inview_me = function(me, target, is_window){

        /* Needed ? */  

      }

      var reset_inview_me = function(me, target, is_window){ 
        me.addClass('not_in_viewport');
        me.removeClass('in_viewport');  
        reset_apply_inview_me(me, target, is_window);
      }

      var make_apply_inview_me_pre = function(me, target, is_window){  
        me.trigger('bc.inview.pre'); 
      }
      
      var prepare_inview_me = function(me, trigger_to, is_window){ 
        me.trigger('bc.inview.prepare');
      }

      var make_apply_inview_me = function(me, target, is_window){  
        me.addClass('apply_inview_me').trigger('bc.inview.on'); 
      }

      var reset_apply_inview_me = function(me, target, is_window){ 
        me.removeClass('apply_inview_me').trigger('bc.inview.off');  
      }

      var make_lazyload = function(me){
        if(!me.hasClass('inview-done')){
          me.addClass('inview-done'); 
 
          var parent = me.parent(); 
          var ajax_src = parent.find('.cloned').data('inview-me-src');  
          if(ajax_src){
            var temp = $("<img>");
            temp.load(ajax_src, function(){
              var new_src = $(this).attr('src');
              parent.find('.cloned').attr('src',new_src); 
              var loading = parent.find('.inview-me-loader'); 
              loading.delay(300).fadeOut(600, function(){  
                me.delay(800).fadeOut(100,function(){ me.remove();loading.remove(); }); 
                parent.removeClass('loading');
                parent.find('.cloned').addClass('loaded');
              });
            });
            temp.attr('src', ajax_src);
          }

        } 
      }

      var make_ajaxload = function(me){
        if(!me.hasClass('inview-done')){
          me.addClass('inview-done');  
          var ajax_src = me.attr('data-inview-me-ajax-src');  
          if(ajax_src){ 
            me.find('.inview-me-load-holder').fadeOut(0);
            me.find('.inview-me-load-holder').load(ajax_src, function(responseTxt, statusTxt, xhr) {
              var loading = me.find('.inview-me-loader'); 
              me.find('.inview-me-load-holder').fadeIn(600);
              loading.delay(300).fadeOut(600, function(){  
                me.find('.inview-me-load-original').remove();
                me.find('.inview-me-load').removeClass('loading');
                me.addClass('loaded');

                me.find('.inview-me-load-holder').find('[data-inview-me]').inview_me(); 
                $(window).trigger('resize');

              });
            });
          }

        } 
      }

      var make_lazybackground = function(me){
        if(!me.hasClass('inview-done')){
            me.addClass('inview-done'); 
            var ajax_src = me.attr('data-inview-me-src');
            var parent = me.parent();
            // If element is embed-responsive-item
            if(ajax_src){

              if(me.attr('data-inview-me-clone') == 'true'){
                var temp = $("<img>");
                temp.load(ajax_src, function(){
                  var new_src = $(this).attr('src'); 
   
                    parent.find('.cloned').css('background-image','url('+new_src+')');
                    var loading = parent.find('.inview-me-loader'); 
                    parent.removeClass('loading');
                    parent.find('.cloned').addClass('loaded');
                    me.delay(300).fadeOut(600, function(){  
                      me.delay(1300).fadeOut(0,function(){
                        me.remove();
                      })
                      loading.remove();
                    });
                   

                });
                temp.attr('src', ajax_src);
              }else{

                var current_img = me.css('background-image');
                var loading = me.find('.inview-me-loader');  
                // me.css('background-image','url('+ajax_src+'), '+current_img+'');
                var temp = $("<img>");
                temp.load(ajax_src, function(){
                  me.css('background-image','url('+ajax_src+')');
                  me.find('.inview-me-background-holder').delay(300).fadeOut(1600, function(){
                    me.trigger('bc.inview.lazybackground');  
                    me.find('.inview-me-background-holder').remove();
                  });
                  //console.log("---"); 
                  //console.log(ajax_src);
                  parent.removeClass('loading');
                  loading.delay(300).fadeOut(600, function(){ 
                     
                    //console.log("removed ?? ");

                    loading.remove();
                  });
                });
                temp.attr('src', ajax_src);
              }

            }

        }
      }

      var make_iniviewApply = function(me){ 
        if(me.attr('id')=='applyTest'){
          //console.log('make_iniviewApply: '+me.attr('class')); 
        }
        var elements = me.attr('data-inview-me-apply');
        var json = JSON.parse(elements);
        $.each(json, function(k, v) {
          //console.log(k); 
          //console.log(v); 
          $(k).addClass(v.addClass);
          $(k).removeClass(v.removeClass);
        });   
      }

      var reset_iniviewApply = function(me){
        if(me.attr('id')=='applyTest'){
          //console.log('reset_iniviewApply: '+me.attr('class')); 
        }
        var elements = me.attr('data-inview-me-apply');
        var json = JSON.parse(elements);
        $.each(json, function(k, v) { 
          $(k).removeClass(v.addClass);
          $(k).addClass(v.removeClass);
        });
      } 

      var normalizeCSS = function(el){
        if(el.length>0){  
            el.css({
              'animation': el.attr('data-animation') ? el.attr('data-animation') : '',
              'animation-timing-function': el.attr('data-animation-timing-function') ? el.attr('data-animation-timing-function') : '',
              'animation-duration': el.attr('data-animation-duration') ? el.attr('data-animation-duration') : '',
              'animation-delay': el.attr('data-animation-delay') ? el.attr('data-animation-delay') : '',
              'animation-iteration-count': el.attr('data-animation-iteration-count') ? el.attr('data-animation-iteration-count') : '',
              'animation-fill-mode': el.attr('data-animation-fill-mode') ? el.attr('data-animation-fill-mode') : '',
              'animation-direction': el.attr('data-animation-direction') ? el.attr('data-animation-direction') : '',
              'animation-play-state': el.attr('data-animation-play-state') ? el.attr('data-animation-play-state') : ''
            });  
            el.css({
              'transition': el.attr('data-transition') ? el.attr('data-transition') : '',
              'transition-delay': el.attr('data-transition-delay') ? el.attr('data-transition-delay') : '',
              'transition-duration': el.attr('data-transition-duration') ? el.attr('data-transition-duration') : '',
              'transition-property': el.attr('data-transition-property') ? el.attr('data-animation-iteration-count') : '',
              'transition-timing-function': el.attr('data-transition-timing-function') ? el.attr('data-transition-timing-function') : ''
            }); 
        } 
      }

      var resetCSS = function(el){
        el.css('transition-delay','');
        el.css('transition-duration','');
        el.css('animation-delay','');
        el.css('animation-duration','');
      }

      /* Fired before any action */
      self.on('bc.inview.prepare',function(e){
        e.stopPropagation();
        var me = $(this); 

        if(me.attr('data-inview-me')=='lazyload'){
          me.wrap( "<div class='inview-me-load lazyload loading'></div>").parent().append('<div class="inview-me-loader"></div>');
          var parent = me.parent(); 
          me.clone().addClass('cloned inview-me-load-element').appendTo(parent);
          me.addClass('inview-me-load-original');
        }

        if(me.attr('data-inview-me')=='ajaxload'){
          me.html( "<div class='inview-me-load ajaxload loading'><div class='inview-me-loader'></div><div class='inview-me-load-original'>"+me.html()+"</div><div class='inview-me-load-holder'></div></div>"); 
        }

        if(me.attr('data-inview-me')=='lazybackground'){
          var parent = me.parent(); 
          
          // If element is embed-responsive-item
          if(me.hasClass('embed-responsive-item')){
            parent.addClass('inview-me-load lazybackground loading');
            

            if( me.attr('data-inview-me-clone') == 'true' ){
              me.clone().addClass('cloned inview-me-load-element').appendTo(parent);
              parent.append('<div class="inview-me-loader"></div>');
            } else{
              me.append('<div class="inview-me-loader"></div>');
              me.append('<div class="inview-me-background-holder"></div>');
              var bg = me.css('background-image');
              if(me.hasClass('image-cover')){
                me.find('.inview-me-background-holder').addClass('image-cover');
              }
              me.find('.inview-me-background-holder').css('background-image', bg);
            }
            
            me.addClass('inview-me-load-original');
          }
          
        }

      }); 

      /* Fired just before bc.inview.on */
      self.on('bc.inview.pre',function(e){
        e.stopPropagation();
        var me = $(this); 
        me.css('transition-delay','');
        me.css('transition-duration','');
        me.css('animation-delay','');
        me.css('animation-duration','');
        if(me.find('[data-inview-me-addclass]')){
          me.find('[data-inview-me-addclass]').each(function(i){ 
            normalizeCSS($(this)); 
          });
        }
        if(me.find('[data-inview-me-removeclass]')){
          me.find('[data-inview-me-removeclass]').each(function(i){ 
            normalizeCSS($(this));   
          });
        }
      });

      var make_default = function(me){
        if(me.attr('data-inview-me-addclass')){
          me.addClass(me.attr('data-inview-me-addclass'));
        } 
        if(me.attr('data-inview-me-removeclass')){
          me.removeClass(me.attr('data-inview-me-removeclass'));
        }
        if(me.find('[data-inview-me-addclass]')){
          me.find('[data-inview-me-addclass]').each(function(i){ 
            normalizeCSS($(this));
            $(this).addClass($(this).attr('data-inview-me-addclass'));
          });
        }
        if(me.find('[data-inview-me-removeclass]')){
          me.find('[data-inview-me-removeclass]').each(function(i){  
            normalizeCSS($(this)); 
            $(this).removeClass($(this).attr('data-inview-me-removeclass'));
          });
        }
        if(me.attr('data-inview-me-apply')){
          make_iniviewApply(me);
        }
      }
      /* Fired once element is on viewport */
      self.on('bc.inview.on',function(e){
        e.stopPropagation();
        var me = $(this);  

        normalizeCSS(me);
        
        if(if_is_breakpoint(me)){
          make_default(me);  
        }
        
        if(me.attr('data-inview-me')=='lazyload'){
          make_lazyload(me);
        }

        if(me.attr('data-inview-me')=='ajaxload'){
          make_ajaxload(me);
        }

        if(me.attr('data-inview-me')=='lazybackground'){
          make_lazybackground(me);
        } 

      });

      var reset_default = function(me){
        if(me.attr('data-inview-me-addclass')){
          me.removeClass(me.attr('data-inview-me-addclass'));
        } 
        if(me.attr('data-inview-me-removeclass')){
          me.addClass(me.attr('data-inview-me-removeclass'));
        } 
        if(me.find('[data-inview-me-addclass]')){
          me.find('[data-inview-me-addclass]').each(function(i){ 
            $(this).removeClass($(this).attr('data-inview-me-addclass'));
          });
        }
        if(me.find('[data-inview-me-removeclass]')){
          me.find('[data-inview-me-removeclass]').each(function(i){  
            $(this).addClass($(this).attr('data-inview-me-removeclass'));
          });
        }
        if(me.attr('data-inview-me-apply')){
          reset_iniviewApply(me);
        } 
      }
      
      /* Fired once element is out of viewport */
      self.on('bc.inview.off',function(e){
        e.stopPropagation();
        var me = $(this);   

        if(if_is_breakpoint(me)){
          reset_default(me);
        } 

      }); 

      var generate_ID = function () {
        // Math.random should be unique because of its seeding algorithm.
        // Convert it to base 36 (numbers + letters), and grab the first 9 characters
        // after the decimal.
        return '_' + Math.random().toString(36).substr(2, 9);
      };

      return self.each(function(){
        var me = $(this);
        /*
        Should i use/move thing into settings and also let data-* or ? to define those things globaly
        */
        var trigger_to = $(window); 
        var is_window = true;


        var closest_target = me.closest('[data-inview-me-holder]');
        if($(closest_target).length>0){ 
          if(!$(closest_target).attr('id')){
            $(closest_target).attr('id', '_' + Math.random().toString(36).substr(2, 9) );
          }
          me.attr('data-inview-me-target', '#'+$(closest_target).attr('id'));
          $(closest_target).addClass('inview-me-holder'); 
        }

        if( me.attr('data-inview-me-target') && me.attr('data-inview-me-target') != 'window' ){ 
          trigger_to = $(me.attr('data-inview-me-target'));
          trigger_to.addClass('inview-me-holder');
          is_window = false;
        } 
        
         
        prepare_inview_me(me, trigger_to, is_window); 


        $(window).on('resize', function(e){ 
          //console.log('## on resize'); 
          make_inview_me(me, trigger_to, is_window);
        });

        trigger_to.on("scroll", function(e){
          //console.log('## on scroll'); 
          make_inview_me(me, $(this), is_window);
        }); 

        $(window).on('bc_inited', function(e){ 
          //console.log('## on bc_inited');
          make_inview_me(me, trigger_to, is_window); 
        });

      }); // return self end
  
  }

  /* $.fn.inview_me END */
  $(window).on('bc_inited',function(){
    $('[data-inview-me]').inview_me(); 
  });
  

  }(jQuery);