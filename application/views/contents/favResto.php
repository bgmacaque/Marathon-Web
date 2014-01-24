<?php


if(isset($erreur) && !empty($erreur)){
    echo $erreur;
}else{
    foreach ($favoris as $key => $favori) {
        echo '<a class="nomFav" href="' . site_url('restaurant/carteComplete/' . $favori->getAttr('id_resto')) . '">' . $favorisInfos[$key]->getAttr('nom_resto') .'</a>';
        echo '<br />';
    }
}