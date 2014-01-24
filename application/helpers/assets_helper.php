<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    
    if ( ! function_exists('css_url')){
        function css_url($nom){
            return base_url() . 'assets/css/' . $nom . '.css';
        }
    }

    if ( ! function_exists('theme_url')){
        function theme_url($nom){
            return base_url() . 'assets/css/themes/' . $nom . '.css';
        }
    }

    if( ! function_exists('js')){
        function js($nom){
            return '<script type="text/javascript" src="' . js_url($nom) . '"></script>';
        }
    }
    
    if ( ! function_exists('js_url')){

        function js_url($nom){
            return base_url() . 'assets/js/' . $nom . '.js';
        }
    
    }
    
    if ( ! function_exists('img_url')){
        function img_url($nom){
            return base_url() . 'assets/img/' . $nom;
        }
    }
    
    if ( ! function_exists('img')){
        function img($nom, $alt = ''){
            return '<img src="' . img_url($nom) . '" alt="' . $alt . '" />';
        }
    }

    if( ! function_exists('echo_js')){
        function echo_js($js){
            if(is_array($js)){
                foreach ($js as $value) {
                    echo '<script type="text/javascript" src="' . js_url($value) . '"></script>';
                }    
            }else{
                echo '<script type="text/javascript" src="' . js_url($js) . '"></script>';
            }
        }
    }

    if( ! function_exists('echo_css')){
        function echo_css($css){
            if(is_array($css)){
                foreach ($css as $value) {
                    echo '<link rel="stylesheet" type="text/css" href="' .  css_url($value) . '" />';
                }    
            }else{
                echo '<link rel="stylesheet" type="text/css" href="' .  css_url($css) . '" />';
            }
        }
    }


    if( ! function_exists('echo_content')){
        function echo_content($content){
            $CI =& get_instance();
            if(is_array($content)){
                foreach ($content as $value){ 
                    $CI->load->view('contents/' . $value . '.php'); 
                }
            }else{
                $CI->load->view('contents/' . $content . '.php');
            }
        }
    }