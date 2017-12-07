<?php

/**
* 
*/
class Botlogic {

  var $response_template = array(
    "speech" => "",
    "displayText" => "",
    "data" => array(),
    "contextOut" => "",
    "source" => "",
  );

  function __construct() {


    function find_intent($data) {
      return $data['result']['action'];
    }

    function format_reponse($speech = '', $display_text = '', $data = array(), $context_out = array(), $source = '') {
      $this->response_template = array(
        "speech" => $speech,
        "displayText" => $display_text,
        "data" => $data,
        "contextOut" => $context_out,
        "source" => $source
      );

      return $this->response_template;
    }

    function get_all_dogs() {
      $all_dog_data = file_get_contents('https://www.battersea.org.uk/kioskpets/dogs');
      $all_dogs = json_decode($all_dog_data);
      return $this->format_reponse();
    }

    function get_all_cats() {
      $all_cat_data = file_get_contents('https://www.battersea.org.uk/kioskpets/cats');
      $all_cats = json_decode($all_cat_data);
      return $this->format_reponse();
    }

  }
}