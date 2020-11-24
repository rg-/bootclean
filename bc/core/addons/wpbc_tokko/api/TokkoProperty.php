<?php

class TokkoProperty
{
   var $data = null;
   var $language = "es_ar";
   var $BASE_URL = "http://www.tokkobroker.com/api/v1/property/";
   function TokkoProperty($get_type, $data, $auth=null){
       if ($get_type == 'object'){
           $this->data = $data;
       }
       try {
           if ($get_type == 'id'){
               $url = $this->BASE_URL . $data . "/?format=json&key=". $auth->key ."&lang=".$auth->get_language(); 

               $cp = curl_init();
               curl_setopt($cp, CURLOPT_RETURNTRANSFER, 1);
               curl_setopt($cp, CURLOPT_URL, $url);
               curl_setopt($cp, CURLOPT_TIMEOUT, 60);
               $this->data = json_decode(curl_exec($cp));
               curl_close($cp);

               $this->language = $auth->get_language();
           }
           if ($get_type == 'reference_code'){
               $url = $this->BASE_URL . "?format=json&reference_code=". urlencode($data) ."&key=". $auth->key ."&lang=".$auth->get_language();

               $cp = curl_init();
               curl_setopt($cp, CURLOPT_RETURNTRANSFER, 1);
               curl_setopt($cp, CURLOPT_URL, $url);
               curl_setopt($cp, CURLOPT_TIMEOUT, 60);
               $this->data = json_decode(curl_exec($cp))->objects[0];
               curl_close($cp);

               $this->language = $auth->get_language();
           }
           if ($get_type == 'development__id'){
               $url = $this->BASE_URL . "?format=json&development__id=". $data ."&key=". $auth->key ."&lang=".$auth->get_language();

               $cp = curl_init();
               curl_setopt($cp, CURLOPT_RETURNTRANSFER, 1);
               curl_setopt($cp, CURLOPT_URL, $url);
               curl_setopt($cp, CURLOPT_TIMEOUT, 60);
               $this->data = json_decode(curl_exec($cp));
               curl_close($cp);

               $this->language = $auth->get_language();
           }

           

        } catch (Exception $e) {
               $this->data = null;
        }
   }

   function get_development_properties(){
      if ($this->data == null){
           return array();
       }else{
           try{
               return $this->data;
           }catch (Exception $e) {
               echo "Invalid search";
           }
       }
   }

   function get_field($field){
       if ($this->data == null){
           return "No property";
       }else{
           try{
               return $this->data->$field;
           }catch (Exception $e) {
               echo "Invalid field";
           }
       }
   }

   function get_age(){
    if ($this->data == null){
         return "No property";
     }else{
      $age = $this->data->age; 
      if($age==0){
        $age = 'A ESTRENAR';
      }elseif($age=='-1'){
        $age = 'EN CONSTRUCCIÓN';
      }else{
        if($age==1){
          $age = $age.' AÑO';
        }else{
          $age = $age.' AÑOS';
        } 
      }
     }
     return $age;
   }

   function has_tag_by_id($tag_id){
       $has_tag = false;
       if ($this->data == null){
           echo "No property";
       }else{
           foreach ( $this->data->tags as $tag){
               if ($tag->id == $tag_id){
                   $has_tag = true;
                   break;
               }
           }
       }
       return $has_tag;
   }

   function get_tags_by_type($type){
        /*
        
        1 - Servicios
        2 - Ambientes
        3 - Adicionales

        */

       $tag_list = array();
       foreach ( $this->data->tags as $tag){
           if ($tag->type == $type){
               array_push($tag_list, $tag);
           }
       }
       return $tag_list;
   }

   function get_custom_tags(){
       $tag_list = array();
       foreach ( $this->data->custom_tags as $tag){
           array_push($tag_list, $tag);
       }
       return $tag_list;
   }

   function get_cover_picture(){
       $cover_picture = null;
       if ($this->data == null){
           echo "No property";
       }else{
           foreach ( $this->data->photos as $photo){
               if ($photo->is_front_cover){
                   $cover_picture = $photo;
               }
           }
       }
       return $cover_picture;
   }

   function get_pictures(){
       $pictures = array();
       if ($this->data == null){
           echo "No property";
       }else{
           foreach ( $this->data->photos as $photo){
               if (empty($photo->is_front_cover)){
                   $pictures[] = $photo;
               }
           }
       }
       return $pictures;
   }

   function get_available_operations($args=array()){

      $legally_checked = !empty($args['legally_checked']) ? $args['legally_checked'] : null;

      $show_only = !empty($args['show_only']) ? $args['show_only'] : null;

       $operations = array();
       if ($this->data == null){
           echo "No property";
       }else{
           foreach ( $this->data->operations as $operation){
               if ($operation->prices){
                   $prices = array();
                   foreach ($operation->prices as $price){
                       $currency_type = "$";
                       if($price->currency == "USD"){$currency_type = 'u$s';}
                       array_push($prices, $currency_type." ".number_format($price->price, 0, ',', '.'));
                   }

                   if( $show_only ){
                      if(in_array($operation->operation_type, $show_only)){
                        array_push($operations, $operation->operation_type . " " . implode("/", $prices) );
                      }
                    } else {

                     if(!$legally_checked){ 

                      array_push($operations, $operation->operation_type . " " . implode("/", $prices) );
                       
                     }else{
                       if($operation->operation_type == "Venta"){
                         if($this->data->legally_checked == "Si"){
                           array_push($operations, $operation->operation_type . " " . implode("/", $prices) );
                         }
                       }else{
                         array_push($operations, $operation->operation_type . " " . implode("/", $prices));
                       }
                     }

                   }
               }
           }
       }
       return $operations;
   }

   function get_available_prices($operations=array("Sale", "Rent", "Temporary rent", "Venta", "Alquiler", "Alquiler temporario")){
       $prices = array();
       if ($this->data == null){
           echo "No property";
       }else{
           foreach ( $this->data->operations as $operation){
               if (in_array($operation->operation_type, $operations)){
                   foreach ($operation->prices as $price){
                       $currency_type = "$";
                       if($price->currency == "USD"){$currency_type = 'u$s';}
                       array_push($prices,$currency_type." ".number_format($price->price, 0, ',', '.'));
                   }
                }
           }
       }
       return $prices;
   }

   function get_available_operations_names($operations=array("Sale", "Rent", "Temporary rent", "Venta", "Alquiler", "Alquiler temporario")){ 
       $operations_ret = array();
       if ($this->data == null){
           echo "No property";
       }else{
           foreach ( $this->data->operations as $operation){
               if ($operation->prices && in_array($operation->operation_type, $operations)){
                   array_push($operations_ret, $operation->operation_type);
               }
           }
       }
       return $operations_ret;
   }

   function get_available_operations_object(){

      $lang = $this->language;

      if( $lang == 'en' ){
        $operations_object = array(
          array(
            'id' => 1,
            'name' => 'Sale'
          ),
          array(
            'id' => 2,
            'name' => 'Rent'
          ),
          array(
            'id' => 3,
            'name' => 'Temporary Rent'
          ),
        );
      } else {
        $operations_object = array(
          array(
            'id' => 1,
            'name' => 'Venta'
          ),
          array(
            'id' => 2,
            'name' => 'Alquiler'
          ),
          array(
            'id' => 3,
            'name' => 'Alquiler Temporario'
          ),
        );
      }

      $temp = array();
      foreach ( $this->data->operations as $operation){

        foreach($operations_object as $k=>$v){
          if( $operation->operation_type == $v['name'] ){
            $temp[] = $v;
          }
        }

      }

      return $temp;

   }

   function is_sale(){
      $operations_object = $this->get_available_operations_object();
      foreach ($operations_object as $key => $value) {
        if($value['id'] == 1){
          return true;
        }
      }
   }
   function is_rent(){
      $operations_object = $this->get_available_operations_object();
      foreach ($operations_object as $key => $value) {
        if($value['id'] == 2){
          return true;
        }
      }
   }
   function is_temporary_rent(){
      $operations_object = $this->get_available_operations_object();
      foreach ($operations_object as $key => $value) {
        if($value['id'] == 3){
          return true;
        }
      }
   }

   function get_available_prices_by_operation($ope){
       $prices = array();
       if ($this->data == null){
           echo "No property";
       }else{
           foreach ( $this->data->operations as $operation){
               if($operation->operation_type == $ope){
                   foreach ($operation->prices as $price){
                       $currency_type = "$";
                       if($price->currency == "USD"){$currency_type = 'u$s';}
                       array_push($prices,$currency_type." ".number_format($price->price, 0, ',', '.'));
                   }
               }
           }
       return $prices;
       }
   }

   function get_operations(){
      $operations = array();
       if ($this->data == null){
           echo "No property";
       }else{
        return $this->data->operations;
       }
   }

   function get_operation($operation_type, $currency){
       $operations = array();
       if ($this->data == null){
           echo "No property";
       }else{
           foreach ( $this->data->operations as $operation){
               if ($operation->operation_type == $operation_type){
                   $prices = array();
                   foreach ($operation->prices as $price){
                       if ($price->currency == $currency){
                           array_push($prices, $price->price . " " . $price->currency);
                           break;
                       }
                   }
                   array_push($operations, $operation->operation_type . " (" . implode("/", $prices) . ")");
                   break;
               }
           }
       }
       return $operations;
   }
}