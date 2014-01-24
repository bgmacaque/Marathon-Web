<?php


class Profil extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('mUser');
        $this->load->library('encrypt');
    }

    public function index(){
        $data = array();
        $id_user = $this->session->userdata('id_user');
        if(!isset($id_user)){
            $data['erreur'] = 'Vous n\'êtes pas connecté';
        }else{
            $user = $this->mUser->findById($id_user);
            if(is_null($user)){
                $data['erreur'] = 'Vous n\'existez pas dans notre base :O ';
            }else{
                $data['user'] = $user;
            }
        }
        $data['css'] = 'compte';
        $data['content'] = array();
        $data['content'][] = 'profil';

        $this->load->view('template', $data);
    }

    public function changerPass(){
        $pass = $this->input->post('pass');
        $newPass = $this->input->post('newPass');
        $confirmPass = $this->input->post('confirmPass');
        if(!isset($pass) || empty($pass) || !isset($newPass) || empty($newPass) || !isset($confirmPass) || empty($confirmPass)){
            echo 'false';
            return;
        }
        $id_user = $this->session->userdata('id_user');
        if(!isset($id_user)){
            echo 'false';
            return;
        }else{
            $user = $this->mUser->findById($id_user);
            $oldPass = $this->encrypt->decode($user->getAttr('password_user'));
            if($oldPass == $pass){
                if($newPass == $confirmPass){
                    $newPass = $this->encrypt->encode($newPass);
                    $user->setAttr('password_user', $newPass);
                    $user->save();
                    echo 'true';
                    return;
                }else{
                    echo 'false';
                    return;
                }
            }else{
                echo 'false';
                return;
            }
        }
    }

    public function addFavResto(){
        $id_resto = $this->input->post('id_resto');
        if(!isset($id_resto) || empty($id_resto)){
            echo 'false';
            return;
        }
        $id_user = $this->session->userdata('id_user');
        if(!isset($id_user) || empty($id_user)){
            echo 'false';
            return; 
        }else{
            $this->load->model('mFavresto');
            $favDeja = $this->mFavresto->findAllBy(array('id_resto' => $id_resto, 'id_user' => $id_user));
            if(!is_null($favDeja)){
                echo 'deja';
                return ;
            }
            $fav = new mFavresto();
            $fav->setAttr('id_resto', $id_resto);
            $fav->setAttr('id_user', $id_user);
            $fav->save();
            echo 'true';
            return;
        }
    }

    public function favresto(){
        $data = array();
        $data['content'] = array();
        $data['content'][] = 'favResto';
        $data['css'] = 'favResto';
        $id_user = $this->session->userdata('id_user');
        if(!isset($id_user)){
            $data['erreur'] = 'Vous n\'êtes pas connecté';
        }else{
            $this->load->model('mFavresto');
            $favoris = $this->mFavresto->findAllBy(array('id_user' => $id_user));
            if(is_null($favoris)){
                $data['erreur'] = 'Vous n\'avez aucun favoris';
            }else{
                $data['favoris'] = $favoris;
                $data['favorisInfos'] = array();
                $this->load->model('mRestaurant');
                foreach ($favoris as $key => $value) {
                    $data['favorisInfos'][$key] = $this->mRestaurant->findById($value->getAttr('id_resto'));
                }
            }
        }
        $this->load->view('template', $data);
    }

    public function favorisPlats(){
    }

}