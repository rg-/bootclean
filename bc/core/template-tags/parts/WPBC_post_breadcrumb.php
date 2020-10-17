<?php
function WPBC_post_breadcrumb($args=''){

  $args = wp_parse_args( $args, apply_filters('wpbc/filter/post_breadcrumb/args', $args) ); 

  $usehome = isset($args['usehome']) ? $args['usehome'] : true;
  $addclass = isset($args['addclass']) ? $args['addclass'] : '';
  $after_home = isset($args['after_home']) ? $args['after_home'] : '';  
  $delimiter = isset($args['delimiter']) ? $args['delimiter'] : '&#8250;';
  $quote = isset($args['quote']) ? $args['quote'] : '&#39;';
  $homename = isset($args['homename']) ? $args['homename'] : __('Home', 'bootclean'); //text for the 'Home' link
  $title_cats = isset($args['title_cats']) ? $args['title_cats'] : __('Archive', 'bootclean');
  $title_search = isset($args['title_search']) ? $args['title_search'] : __('Search Results', 'bootclean');
  $title_tags = isset($args['title_tags']) ? $args['title_tags'] : __('Tagged as', 'bootclean');
  $title_author = isset($args['title_author']) ? $args['title_author'] : __('Article', 'bootclean');
  $title_404 = isset($args['title_404']) ? $args['title_404'] : __('Error 404', 'bootclean');
  $title_page = isset($args['title_page']) ? $args['title_page'] : __('Page', 'bootclean'); 
  $currentBefore = isset($args['currentBefore']) ? $args['currentBefore'] : '<span class="current">';
  $currentAfter = isset($args['currentAfter']) ? $args['currentAfter'] : '</span>';
 
  if ( /*!is_home() && !is_front_page() &&*/ !is_attachment() || is_paged() ) {
 
    echo '<div class="breadcrumb '.$addclass.'">';
 
    global $post;
    $home = esc_url( home_url() );
  if($usehome){
    if($after_home){
      echo '<a href="' . $home . '">' . $homename . '</a> ' . $delimiter . ' ' . $after_home . ' ' . $delimiter . ' ';
    }else{
      echo '<a href="' . $home . '">' . $homename . '</a> ' . $delimiter . ' ';
    }
  }
 
    if ( is_category() || is_tax() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore . $title_cats .' '. $quote;
      single_cat_title();
      echo $quote . $currentAfter;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;
 
    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;
 
    } elseif ( is_single() ) {
    
      $cat = get_the_category(); $cat = $cat[0];
      if ( $cat->parent != 0 ) {
        $parent_category = get_category( $cat->parent );
        echo get_category_parents($parent_category, TRUE, ' ' . $delimiter . ' ' ); 
      } else {
        the_category($delimiter);
        echo $delimiter; 
      }
       
      echo $currentBefore;
      the_title();
      echo $currentAfter;
     
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_search() ) {
      echo $currentBefore . $title_search .' '. $quote . get_search_query() . $quote . $currentAfter;
 
    } elseif ( is_tag() ) {
      echo $currentBefore . $title_tags . ' ' . $quote;
      single_tag_title();
      echo $quote . $currentAfter;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . $title_author . ' ' . $quote . $userdata->display_name . $quote . $currentAfter;
 
    } elseif ( is_404() ) {
      echo $currentBefore . $title_404 . ' ' . $currentAfter;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo ' '. $title_page . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
}