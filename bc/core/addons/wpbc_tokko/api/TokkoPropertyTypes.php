<?php

class TokkoPropertyTypes
{
   var $BASE_URL = "http://tokkobroker.com/api/v1/property_type/";
   var $auth = null;
   var $property_types = array();
   
   function TokkoPropertyTypes($auth, $filter=null){
       try {
           $this->auth = $auth;
           $data = json_decode(file_get_contents($this->BASE_URL . "?lang=". $this->auth->get_language() . "&limit=100&key=". $this->auth->key))->objects;
           
           if ($filter){
               foreach ($data as $property_type){
                   if (in_array($property_type->id, $filter)){
                       array_push($this->property_types, $property_type);
                   }
               }
           }else{
               $this->property_types = $data;
           }
       }catch (Exception $e) {
           $this->property_types = null;
       }
   }

   function deploy_selection($id, $selection_text='', $classes="", $default=null, $type="select"){
       switch ($type) {
       case "select":
           echo '<select id="'.$id.'" name="'.$id.'" class="'.$classes.'">';
           echo "<option value='0'>". $selection_text."</option>";
           foreach ($this->property_types as $property_type){
               $selected = "";
               if ( $default == $property_type->id){
                   $selected = "selected";
               }
               echo "<option value='". $property_type->id ."' ". $selected .">". $property_type->name ."</option>";
           }
           echo '</select>';
           break;
       case "checkbox":
           echo $selection_text;
           foreach ($this->property_types as $property_type){
               $selected = "";
               if (in_array($property_type->id, $default)){
                   $selected = "checked";
               }
               echo '<input type="checkbox" id="'.$id.'" name="'.$id.'" value="'.$property_type->id.'" '.$selected.'> ' .$property_type->name . '&nbsp;&nbsp;';
           }
           break;
       }
   }

}