<?php

class TokkoCountries
{
   var $BASE_URL = "http://tokkobroker.com/api/v1/countries/";
   var $countries = null;
   var $select_box_id = '';
   var $child = null;
   var $type='country';
   function TokkoCountries(){
       try {
           $this->countries = json_decode(file_get_contents($this->BASE_URL))->objects;
       }catch (Exception $e) {
           $this->countries = null;
       }
   }

   function deploy_select_box($id, $name, $classes, $default=null, $head_choice=''){
       $this->select_box_id = $id;
       echo '<SELECT id="'.$id.'" name="'.$name.'" class="'.$classes.'" >';
       echo "<OPTION value='0'>". $head_choice."</OPTION>";
       foreach ( $this->countries as $country){
           $selected = "";
           if ( $default == $country->id){
               $selected = "selected";
           }
           echo "<OPTION value='". $country->id ."' ". $selected .">". $country->name  ."</OPTION>";
       }
       echo '</SELECT>';
   }

}