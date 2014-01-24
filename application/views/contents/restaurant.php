<?php


if(isset($erreur) && !empty($erreur)){
    echo $erreur;
}else{
    if(isset($restos) && !empty($restos)){
        foreach ($restos as $key => $resto) {
            echo '<div class="resto">';
            $urlCarte = site_url('restaurant/carteComplete/' . $resto->getAttr('id_resto')); 
            $url = site_url('restaurant/aDescription/' . $resto->getAttr('id_resto'));
            echo '<span url="'. $url . '" class="lien lienRestaurant" >';
            echo $resto->getAttr('nom_resto') . ' </span><br/>&#9733; ' . round($note_moy[$key], 2) . ' <br /><a href="'. $urlCarte .'">Carte</a><br/>';  
            echo 'Nombre de plats : ' . $nbPlats[$key] . '</div>';
        }
    }
}