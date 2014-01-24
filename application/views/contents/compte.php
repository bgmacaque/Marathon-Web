<?php
    if($this->session->userdata('id_user')){
        //Connecté
        // echo 'Connecté : ' . $this->session->userdata('pseudo');
        echo '<a class="top" href="'.site_url('profil').'" id="compte">Mon compte</a>';
        echo '<a class="top" href="'.site_url('ajax/disconnect').'" id="deconnexion">Deconnexion</a>';
    }else{
        //Pas connecté
        echo '<a class="top" href="#connexion" id="connexion">Connexion</a>';
        echo '<a class="top" href="#inscription" id="inscription">Inscription</a>';
    }
?>