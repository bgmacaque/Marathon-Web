<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Restaurant extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('mRestaurant');
    }

    //Param : id du theme
    public function index($theme = ''){
        $data = array();
        $data['content'] = array();
        $data['css'] = array();
        $data['note_moy'] = array();

        $data['css'][] = 'restaurant';
        $this->load->model('mPlat');
        if($theme == ''){
            //Charger tous les restaurants
            $restos = $this->mRestaurant->findAll();
            $data['restos'] = $restos;
            $nbPlats = array(); 
                foreach ($restos as $key => $value) {
                    $plats = $this->mPlat->findAllBy(array('id_resto' => $value->getAttr('id_resto')));
                    $nbPlats[$key] = count($plats);
                    $somme = 0;
                    $nombre = 0;
                    $this->load->model('mComment');
                    foreach ($plats as $cle => $plat) {
                        $comments = $this->mComment->findAllBy(array('id_plat' => $plat->getAttr('id_plat')));
                        if(!is_null($comments) && !empty($comments)){
                            foreach ($comments as $cleComment => $comment) {
                                $somme += $comment->getAttr('valeur_note');
                                $nombre++;
                            }
                        }
                    }
                    if($nombre == 0){
                        $data['note_moy'][$key] = 'Pas de note';
                    }else{
                        $data['note_moy'][$key] = $somme / $nombre;
                    }
                }
                $data['nbPlats'] = $nbPlats;
        }else{
            //Charger les restos du theme si le theme existe, sinon message erreur
            $this->load->model('mTheme');
            $restos = $this->mRestaurant->findAllBy(array('id_theme' => $theme));
            $data['theme'] = $this->mTheme->findById($theme);

            if(is_null($restos)){
                $data['erreur'] = 'Ce thème n\'existe pas';

            }else{
                $data['restos'] = $restos;

                $nbPlats = array(); 
                foreach ($restos as $key => $value) {
                    $plats = $this->mPlat->findAllBy(array('id_resto' => $value->getAttr('id_resto')));
                    $nbPlats[$key] = count($plats);
                    $somme = 0;
                    $nombre = 0;
                    $this->load->model('mComment');
                    foreach ($plats as $cle => $plat) {
                        $comments = $this->mComment->findAllBy(array('id_plat' => $plat->getAttr('id_plat')));
                        if(!is_null($comments) && !empty($comments)){
                            foreach ($comments as $cleComment => $comment) {
                                $somme += $comment->getAttr('valeur_note');
                                $nombre++;
                            }
                        }
                    }
                    if($nombre == 0){
                        $data['note_moy'][$key] = 'Pas de note';
                    }else{
                        $data['note_moy'][$key] = $somme / $nombre;
                    }
                }
                $data['nbPlats'] = $nbPlats;
            }
        }
        $this->load->model('mTheme');
        $data['theme'] = $this->mTheme->findById($theme);
        $data['content'][] = 'restaurant';
        $this->load->view('template', $data);
    }

    //Param : id du restaurant
    public function cartes($nombre = 4, $offset = 0){
        $data = array();
        $data['content'] = array();
        $data['content'] = 'carteResto';
        $cartes = $this->mRestaurant->cartes($nombre, $offset);
        $data['cartes'] = $cartes;
        $this->load->view('contents/carteResto', $data);
    }

    public function carteComplete($idresto = ''){
        $data = array();
        $data['content'] = array();
        $data['css'] = array();
        $data['css'][] = 'carteComplete';
        if($idresto == ''){
            $data['erreur'] = 'Ce restaurant n\'existe pas';
        }else{
            $resto = $this->mRestaurant->findById($idresto);
            $this->load->model('mPlat');
            if(is_null($resto)){
                $data['erreur'] = 'Ce restaurant n\'existe pas';
            }else{
                $plats = $this->mPlat->findAllBy(array('id_resto' => $idresto));
                $this->load->model('mTheme');
                $theme = $this->mTheme->findById($resto->getAttr('id_theme'));
                $data['resto'] = $resto;
                $data['plats'] = $plats;
                $somme = 0;
                $nombre = 0;
                $this->load->model('mComment');
                foreach ($plats as $key => $plat) {
                    $comments = $this->mComment->findAllBy(array('id_plat' => $plat->getAttr('id_plat')));
                    if(!is_null($comments) && !empty($comments)){
                        foreach ($comments as $key => $comment) {
                            $somme += $comment->getAttr('valeur_note');
                            $nombre++;
                        }
                    }
                }
                if($nombre == 0){
                    $data['note_moy'] = ' pas de note';
                }else{
                    $data['note_moy'] = $somme / $nombre;
                }
                $data['theme'] = $theme;
                $data['js'] = 'speedSearch';
            }
        }
        $data['content'][] = 'carteComplete';
        $this->load->view('template', $data);
    }

    public function aDescription($idresto = ''){
        $data = array();
        $data['content'] = array();
        if($idresto == ''){
            $data['erreur'] = 'Le restaurant n\'existe pas';
        }else{
            $resto = $this->mRestaurant->findById($idresto);
            if(is_null($resto)){
                $data['erreur'] = 'Le restaurant n\'existe pas';
            }else{
                $data['resto'] = $resto;
            }
        }
        $this->load->view('contents/descriptionResto', $data);
    }


    public function enregistrement(){
        $data = array();
        $data['content'] = array();
        $data['content'][] = 'enregistrement_resto';

        $this->load->view('template', $data);
    }

    public function nbPlats($idresto = ''){
        $data = array();
        $data['content'] = array();
        //Pas de paramètre
        if($idresto == ''){
            $data['erreur'] = 'Ce restaurant n\'existe pas';
        }else{
            $this->load->model('mPlat');
            $nbPlats = $this->mPlat->findAllBy(array('id_resto' => $idresto));
            $data['nbPlats'] = $nbPlats;
            $data['resto'] = $this->mRestaurant->findById($idresto);
        }
        $this->load->view('template', $data);
    }
}
