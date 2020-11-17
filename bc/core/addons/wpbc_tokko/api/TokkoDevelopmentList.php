<?php

class TokkoDevelopmentList
{
  var $data = null;
  var $summary= null;
  var $auth;
  var $querystring_page_key = "tk_page";
  var $querystring_order_by_key = "tk_order_by";
  var $querystring_order_key = "tk_order";
  var $querystring_page_limit_key = "limit";
  var $BASE_URL = "http://www.tokkobroker.com/api/v1/development/";
  var $SUMMARY_URL = "http://www.tokkobroker.com/api/v1/development/summary/";
  var $SEARCH_BY_UNITS = "http://www.tokkobroker.com/api/v1/development/search_by_units/";
  var $BASE_GEO_URL = 'http://tokkobroker.com/api/v1/development/search_by_units_geo_data/?';
  var $search_data = null;
  var $default_page_limit = 20;
  var $current_search_order_by = 'id';
  var $current_search_order = 'desc';

  var $default_developmet_limit = 300;
  var $querystring_developmet_limit_key = "limit";

  function decode_search_data($search_data){
      return json_decode($bodytag = str_replace("\\", "", $search_data), true);
  }

  function set_search_data($search_data){
      if (gettype($search_data) == 'string'){
           try{
              $this->search_data = $this->decode_search_data($search_data);
          } catch (Exception $e) {
              $this->search_data = null;
          }
      }else{
          $this->search_data = $search_data;
      }
  }

  function get_search_offset(){
      return ($this->get_current_page()-1) * $this->get_current_page_limit();
  }

  function get_developmet_order_by(){ 
      $order_by = $_REQUEST[$this->querystring_order_by_key];
      if ($order_by){
          $this->current_development_order_by = $order_by;
      }else{
          $this->current_development_order_by = 'location__name';
      }
      return $this->current_development_order_by;
  }

  function get_search_order_by(){
      $order_by = $_REQUEST[$this->querystring_order_by_key];
      if ($order_by){
          $this->current_search_order_by = $order_by;
      }else{
          $this->current_search_order_by = 'id';
      }
      return $this->current_search_order_by;
  }

  function get_search_order(){
      $order = $_REQUEST[$this->querystring_order_key];
      if ($order){
          $this->current_search_order = $order;
      }else{
          $this->current_search_order = 'desc';
      }
      return $this->current_search_order;
  }

  function do_search($limit=null, $order_by=null, $order=null, $search_data=null){
      if ($search_data == null){
            try{
                $this->search_data = $this->decode_search_data($_REQUEST['data']);
            } catch (Exception $e) {
                $this->search_data = null;
            }
      }else{
            $this->set_search_data($search_data);
      }

      if ($this->search_data == null){
            echo "No search parameters were given";
        }else{
            try {
                if (!$limit){ $limit = $this->get_current_page_limit(); }
                if (!$order_by){ $order_by = $this->get_search_order_by();}
                if (!$order){ $order = $this->get_search_order();}

                $url = $this->SEARCH_BY_UNITS . "?order_by=" . $order_by ."&order=". $order ."&format=json&key=". $this->auth->key ."&lang=". $this->auth->get_language() ."&limit=". $limit ."&offset=" . $this->get_search_offset() . "&data=" . json_encode($this->search_data);
                $cp = curl_init();
                curl_setopt($cp, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($cp, CURLOPT_URL, $url);
                curl_setopt($cp, CURLOPT_TIMEOUT, 60);
                $this->data = json_decode(curl_exec($cp));
                curl_close($cp);
            } catch (Exception $e) {
                $this->data = null;
                echo "Error executing query.";
            }
        }
  }

  function get_development_list($limit=null, $order_by=null, $filters_array=null){
      try {
          if (!$limit){ $limit = $this->get_developmet_limit(); }
          if (!$order_by){ $order_by = $this->get_developmet_order_by();}  

          $url = $this->BASE_URL . "?format=json&limit=".$limit."&order_by=".$order_by."&key=". $this->auth->key ."&lang=".$this->auth->get_language();

          if($filters_array){
            foreach($filters_array as $filter){
               $url = $url."&".$filter["key"]."=".$filter["value"];
            }
          }

          $url = $url."&offset=".$this->get_offset();

          $cp = curl_init();
          curl_setopt($cp, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($cp, CURLOPT_URL, $url);
          curl_setopt($cp, CURLOPT_TIMEOUT, 60);
          $this->data = json_decode(curl_exec($cp));
          curl_close($cp);
      } catch (Exception $e) {
              $this->data = null;
      }
  }

  

  function TokkoDevelopmentList($auth=null){
          $this->auth = $auth;
  }

  function get_result_count(){
      if ($this->data == null){
          return 0;
      }else{
          return $this->data->meta->total_count;
      }
  }

  function get_developments(){
        $developments = array();
        if ($this->data == null){
            return $developments;
        }else{
            foreach ($this->data->objects as $devel) {
                array_push($developments, new TokkoDevelopment('object', $devel));
            }
            return $developments;
        }
  }

  function get_geo_data(){
      if ($this->search_data == null){
          echo "No search parameters were given";
      }else{
          try {
              if ($this->geo_data){
                  return $this->geo_data->objects;
              }
              $this->geo_data = json_decode(file_get_contents($this->BASE_GEO_URL . "format=json&key=". $this->auth->key ."&lang=". $this->auth->get_language() ."&data=" . json_encode($this->search_data)));
              return $this->geo_data->objects;
          } catch (Exception $e) {
              $this->geo_data = null;
              echo "Error executing query.";
          }
      }
  }


    function get_result_page_count(){
        if ($this->data == null){
            return 0;
        }else{
            return ceil($this->data->meta->total_count/$this->data->meta->limit);
        }
    }

  function get_developmet_limit(){
      if ($_REQUEST[$this->querystring_developmet_limit_key]){
          return intval($_REQUEST[$this->querystring_developmet_limit_key]);
      }else{
          return $this->default_developmet_limit;
      }
  }

  function get_current_page_limit(){
      if ($_REQUEST[$this->querystring_page_limit_key]){
          return intval($_REQUEST[$this->querystring_page_limit_key]);
      }else{
          return $this->default_page_limit;
      }
  }

  function get_offset(){
    return ($this->get_current_page()-1) * $this->get_current_page_limit();
  }

  function get_current_page(){
      if ($_REQUEST[$this->querystring_page_key]){
          return intval($_REQUEST[$this->querystring_page_key]);
      }else{
          return 1;
      }
  }

  function get_previous_page_or_null(){
      return $this->get_current_page() > 1 ? $this->get_current_page()-1 : null;
  }

  function get_next_page_or_null(){
      return $this->get_current_page() < $this->get_result_page_count() ? $this->get_current_page()+1 : null;
  }

  function get_url_for_page($page,$request=true){
    if($request){
      $url_for_page = strtok($_SERVER["REQUEST_URI"],'?')."?page=".$page."&limit=".$this->get_current_page_limit();
    }else{
      $url_for_page = "&page=".$page."&limit=".$this->get_current_page_limit();
    }

      if($_REQUEST['type']){
        $url_for_page = $url_for_page."&type=".$_REQUEST['type'];
      }

      if($_REQUEST['custom_tags']){
        $url_for_page = $url_for_page ."&custom_tags=".$_REQUEST['custom_tags'];
      }
      return $url_for_page;
  }

  function deploy_google_map($api_google='AIzaSyCTyr98mlkJl0GLTVc8WmBI5X0UZJshOm4', $container_id='map',$icon_url=null, $classes="", $must_deploy_js=true, $must_deploy_container=true, $infowindow_url=null, $infoowindow_method='click', $locations=null){

      if($must_deploy_container){
        echo '<div id="'.$container_id.'"';
        if($classes != "" && $classes != null){
          echo 'class="'.$classes.'"';
        }
        echo ' ></div>';
      }

      echo 'var mapOptions = {';
      echo 'center: new google.maps.LatLng(-34.58, -58.45),';
      echo 'zoom: 13';
      echo '};';

      echo 'var map = new google.maps.Map(document.getElementById("'.$container_id.'"), mapOptions);';

      echo 'var markers = {};';
      echo 'var open_window = null;';
      echo 'var current_id = null;';

      echo 'var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",';
      echo 'new google.maps.Size(40, 37),';
      echo 'new google.maps.Point(0, 0),';
      echo 'new google.maps.Point(12, 35));';

      if($icon_url){
        echo 'var pinImage_red = new google.maps.MarkerImage("'.$icon_url.'",';
        echo 'new google.maps.Size(21, 34),';
        echo 'new google.maps.Point(0,0),';
        echo 'new google.maps.Point(10, 34));';
      }

      echo 'function add_new_marker(id, lat,lng){';
      echo 'var latLng = new google.maps.LatLng(lat, lng);';
      echo 'marker = new google.maps.Marker({';
        echo 'position: latLng,';
        echo 'animation: google.maps.Animation.DROP,';
        echo 'shadow: pinShadow,';
        if($icon_url){
          echo 'icon: pinImage_red,';
        }
   	echo 'map: map,';
        echo 'draggable: false,';
        echo 'visible: true';
        echo '});';

      echo 'markers[id] = {"marker": marker, "info": null};';

      if($infowindow_url){
        echo 'google.maps.event.addListener(markers[id].marker, "'.$infoowindow_method.'", function() {';
          echo 'if (open_window) { open_window.close();}';
          echo 'if (!markers[id].info) {';
          echo 'infoWindow = new google.maps.InfoWindow({';
          echo 'content:"<div style=\'width:250px; height:120px; text-align:center\' id=\'development_tooltip_"+id+"\' class=\'infowindow-main-div\'><span>Cargando...</span></div>"';
          echo '});';
          echo 'var jqxhr = $.ajax("'.$infowindow_url.'?id="+id)';
            echo '.done(function(result) {';
            echo '$("#development_tooltip_"+id).html(result);';
            echo 'markers[id]["info"] = new google.maps.InfoWindow({';
              echo 'content:"<div id=\'development_tooltip_"+id+"\' class=\'infowindow-main-div\'>"+result+"</div>"';
            echo '});';
          echo '});';
    
          echo 'markers[id]["info"] = infoWindow;';
          echo '}';
          echo 'markers[id].info.open(map,markers[id].marker);';
          echo 'open_window = markers[id].info;';
        echo '});';
      }
    echo '}';

    foreach($locations as $location){
      if($location["lat"] && $location["long"]){
        echo 'add_new_marker("'.$location["id"].'", "'.$location["lat"].'", "'.$location["long"].'");';
      }
    }
  }

  function fill_summary(){
    $url = $this->SUMMARY_URL . "?format=json&key=". $this->auth->key ."&lang=".$this->auth->get_language();
    echo $url;
    $cp = curl_init();
    curl_setopt($cp, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($cp, CURLOPT_URL, $url);
    curl_setopt($cp, CURLOPT_TIMEOUT, 60);
    $this->summary = json_decode(curl_exec($cp));
    curl_close($cp);
  }

}