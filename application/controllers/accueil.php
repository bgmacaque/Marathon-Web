<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


/*

    Classe utilisé pour gérer l'accueil

*/
class Accueil extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('muser');
    }

    public function index(){
        $data = array();
        $data['content'] = array();
        $data['js'] = 'slide';
        $data['css'] = 'slide';
        //On charge la page d'accueil
        
        //On charge le style de l'utilisateur
        // $data['style'] = 'kaced';
        $data['content'][] = 'slide';
        $data['content'][] = 'rond';
        $data['content'][] = 'middleBottom';
        //On charge le test de css
        // $data['content'][] = 'css_test';
        //On charge le lipsum
        // $data['content'][] = 'lipsum';
        // $this->session->unset_userdata('pseudo');
        $this->load->view('template', $data);
    }
}