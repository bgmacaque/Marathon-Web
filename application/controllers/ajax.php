<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/*

    Classe permettant de gérer tous les appels ajax

*/
class Ajax extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->model('mUser');
    }

    public function index(){
        // die('No direct access allowed');
    }

    /*
        Methode permettant de connecter un utilisateur
    */
    public function connect(){
        $pseudo = $this->input->post('pseudo');
        $pass = $this->input->post('pass');
        if(!isset($pseudo) || !isset($pass) || empty($pseudo) || empty($pass)){
            echo 'incomplet';
            return;
        }
        $rech = array('pseudo_user' => $pseudo);
        $user = $this->mUser->findBy($rech);
        if(!is_null($user)){
            if($this->encrypt->decode($user->getAttr('password_user')) == $pass){
                $this->session->set_userdata('id_user', $user->getAttr('id_user'));
                $this->session->set_userdata('pseudo_user', $user->getAttr('pseudo_user'));
                echo $this->load->view('contents/compte');
                echo "<script>$('#form_connexion').hide()</script>";
                return;
            }else{
                echo 'pasbon';
                return;
            }
        }else{
            echo 'false';
            return;
        }
    }

    /*
        Methode permettant de deconnecter un utilisateur
    */
    public function disconnect(){
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('pseudo_user');
        echo '<script src="'.js_url('jQuery').'"></script>';
        echo "<script>$(function() { $(location).attr('href', '".base_url()."'); });</script>";
    }

    /*
    
        Methode permettant de vérifier si un pseudo est existant ou non

    */
    public function pseudoLibre(){
        $this->form_validation->set_rules('pseudo', 'Pseudo', 'required|min_length[1]|max_length[25|htmlspecialchars|trim');
        if($this->form_validation->run()){
            $user = Muser::findBy(array('pseudo_user' => $this->input->get('pseudo')));
            //Vérification pseudo existant ou non?
            if(!is_null($user)){
                echo 'FALSE';
            }else{
                echo 'TRUE';
            }
        }else{
            echo 'FALSE';
        }
    }

    /*
        Methode permettant d'inscrire un utilisateur
    */
    public function subscribe(){
        $pseudo = $this->input->post('pseudo');
        $pass = $this->input->post('pass');
        $pConfirm = $this->input->post('passConfirm');
        $eConfirm = $this->input->post('emailConfirm');
        $email = $this->input->post('email');
        if(!isset($pseudo) || !isset($email) || !isset($pass) || !isset($pConfirm) || !isset($eConfirm) || empty($pseudo) || empty($pass) || empty($email) || empty($pConfirm) || empty($eConfirm)){
            echo 'incomplet';
            return;
        }


        $this->load->model('mUser');
        $pseudo = $this->input->post('pseudo');
        $user = $this->mUser->findBy(array('pseudo_user' => $pseudo));
        //Vérification pseudo existant ou non?
        if(!is_null($user)){
            echo 'dejaPris';
            return;
        }else{
            $this->form_validation->set_rules('pseudo', 'Pseudo', 'required|min_length[1]|max_length[25]|trim');
            $this->form_validation->set_rules('pass', 'Pass', 'required|min_length[1]|max_length[25]|trim');
            $this->form_validation->set_rules('pass', 'Pass', 'matches[pass]required|min_length[1]|max_length[25]|trim');
            $this->form_validation->set_rules('email', 'E-Mail', 'required|min_length[1]|max_length[25]|trim');
            $this->form_validation->set_rules('emailConfirm', 'matches[email]Confirmation mail', 'required|min_length[1]|max_length[25]|trim');
            if($this->form_validation->run()){
                $user = new mUser();
                $user->setAttr('pseudo_user', $this->input->post('pseudo'));
                $passUser = $this->encrypt->encode($this->input->post('pass'));
                $user->setAttr('password_user', $passUser);
                $user->setAttr('email_user', $this->input->post('email'));
                $user->save();
                echo 'true';
                return;
            }else{
                echo 'false';
                return;
            }
        }
    }

    public function style($style){
        $this->session->set_userdata('style', $style);
    }

    
}