<?php

class TokkoAuth
{
    var $key=null;
    var $querystring_lang_key = "lang";
    var $default_lang = "es_ar";
    var $current_lang = "es_ar";

    function TokkoAuth($key, $lang="es_ar"){
        $this->key = $key;
        $this->default_lang = $lang;
    }

    function get_language(){
        //$lang = $_REQUEST[$this->querystring_lang_key];
        if (isset($_REQUEST[$this->querystring_lang_key])){
            $this->current_lang = $_REQUEST[$this->querystring_lang_key];
        }else{
            $this->current_lang = $this->default_lang;
        }
        return $this->current_lang;
    }
}