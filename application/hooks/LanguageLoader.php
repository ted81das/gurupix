<?php
class LanguageLoader
{

   function initialize() {

       $ci =& get_instance();

       $ci->load->helper('language');

       $siteLang = $ci->session->userdata('site_lang');
        print_r( $siteLang);die;
       if ($siteLang) {

           $ci->lang->load('information',$siteLang);

       } else {

           $ci->lang->load('information','english');

       }

   }

}