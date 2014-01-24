<?php


if(isset($erreur) && !empty($erreur)){
    echo $erreur;
}else{
    echo '<a href="' . site_url('restaurant') . '">Retour à la liste des restaurants</a>';


    //Faire affichage des trucs du resto
    echo '<h1>' . $resto->getAttr('nom_resto') . ', note moyenne : ' . round($note_moy, 2);
    echo '<form id="form_ajouter_favresto" method="POST" action="'.site_url('profil/addFavResto').'">';
    echo '<input type="hidden" name="id_resto" value="' . $resto->getAttr('id_resto') . '" />';
    echo '<input type="submit" value="Ajouter à mes favoris" />';
    echo '</form>';
    echo '</h1>';
    echo '<p>' . $resto->getAttr('description_resto') . '</p>';
    echo '<h2>Specialite ';
    echo  $theme->getAttr('nom_theme') . '</h2>';

    //Affichage de la carte
    echo '<input type="search" id="champFilter" placeholder="Rechercher"/>';

    if(isset($resto) && !empty($resto) && isset($plats) && !empty($plats)){
        // echo '<h1>Plats du restaurant ' . $resto->getAttr('nom_resto') . '</h1>';
        echo '<ul id="filter">';
        foreach ($plats as $key => $plat) {
            echo '<li>';
            echo '<a href="'.site_url('plat/detail/'.$plat->getAttr('id_plat')) . '">' . $plat->getAttr('nom_plat') . '</a> ' . $plat->getAttr('prix_plat') . '&euro;';
            echo '<form class="form_ajouter_panier" method="POST" action="' . site_url('panier/ajouter') .'">';
            echo '<input type="hidden" name="id_plat" value="'. $plat->getAttr('id_plat') .'" />';
            echo '<input type="number" name="quantite" min="0"/>';
            echo '<input type="submit" value="Ajouter au panier" />';
            echo '</form>'; 
            echo '</li>';
            echo '<br />';
        }
        echo '</ul>';
    }
}