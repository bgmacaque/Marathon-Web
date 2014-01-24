<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Panier extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('mPlat');
    }

    //Affiche tous les articles du panier
    public function index(){
        $data = array();
        $data['content'] = array();
        $data['content'][] = 'panier';
        $data['css'] = array();
        $data['css'][] = 'panier';
        $data['css'][] = 'panierPage';
        $panier = $this->session->userdata('panier');
        $this->load->model('mRestaurant');
        $this->load->model('mTheme');
        if(isset($panier) && !empty($panier)){
            $data['panier'] = $panier;
            $data['panierInfo'] = array();
            foreach ($panier as $key => $value) {
                $data['panierInfo'][$key] = array();
                $data['panierInfo'][$key]['plat'] = $this->mPlat->findById($key);
                $resto = $this->mRestaurant->findById($data['panierInfo'][$key]['plat']->getAttr('id_resto'));
                $data['panierInfo'][$key]['resto'] = $resto;
                $idtheme = $resto->getAttr('id_theme');
                $data['panierInfo'][$key]['theme'] = $this->mTheme->findById($idtheme);
            }
        }else{
            $data['erreur'] = '<h1>Vous avez faim? Remplissez-donc votre panier!</h1>';
        }
        $this->load->view('template', $data);
    }

    public function commander(){
        $data = array();
        $data['content'] = array();
        $data['content'][] = 'commander';
        $data['js'] = array('picker', 'picker.date', 'picker.time');
        $data['css'] = array('datepicker', 'commander', 'panier');

        $panier = $this->session->userdata('panier');
        $this->load->model('mRestaurant');
        $this->load->model('mTheme');
        if(isset($panier) && !empty($panier)){
            $data['panier'] = $panier;
            $data['panierInfo'] = array();
            foreach ($panier as $key => $value) {
                $data['panierInfo'][$key] = array();
                $data['panierInfo'][$key]['plat'] = $this->mPlat->findById($key);
                $resto = $this->mRestaurant->findById($data['panierInfo'][$key]['plat']->getAttr('id_resto'));
                $data['panierInfo'][$key]['resto'] = $resto;
                $idtheme = $resto->getAttr('id_theme');
                $data['panierInfo'][$key]['theme'] = $this->mTheme->findById($idtheme);
            }
        }else{
            $data['erreur'] = 'Votre panier est vide';
        }

        $this->load->view('template', $data);
    }

    //Retour true si bon
    public function supprimer(){
        $id_plat = $this->input->post('id_plat');
        if(!isset($id_plat) || empty($id_plat)){
            echo 'false';
            return;
        }
        $panier = $this->session->userdata('panier');
        if(array_key_exists($id_plat, $panier)){
            unset($panier[$id_plat]);
            $this->session->set_userdata('panier', $panier);
            echo $id_plat;
            return;
        }else{
            echo 'false';
            return;
        }
    }

    //Retourne le montant si tout est bon
    public function ajouter(){
        $id_plat = $this->input->post('id_plat');
        $quantite = $this->input->post('quantite');
        if(!isset($id_plat) || !isset($quantite) || empty($id_plat) || empty($quantite)){
            echo 'false';
            return;
        }
        $panier = $this->session->userdata('panier');
        //Déjà dedans
        if(array_key_exists($id_plat, $panier)){
            $quantite = $panier[$id_plat] + $quantite;
            $panier[$id_plat] = $quantite;
            $this->session->set_userdata('panier', $panier);
        }else{
            //Pas dedans
            $panier[$id_plat] = $quantite;
            $this->session->set_userdata('panier', $panier);
        }
        //Echo du montant
        $montant = 0;
        foreach ($panier as $id_plat_panier => $quantite_panier) {
            $plat = $this->mPlat->findById($id_plat_panier);
            $montant += $plat->getAttr('prix_plat') * $quantite_panier;
        }

        echo $montant;
    }
}