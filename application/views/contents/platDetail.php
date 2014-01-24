<?php

if(isset($erreur) && empty($erreur)){
    echo $erreur;
}else{
    if(isset($plat) && !empty($plat)){
        echo '<h1>' . $plat->getAttr('nom_plat') . ', prix : '. $plat->getAttr('prix_plat') .'&euro;</h1>';
        echo '<form class="form_ajouter_panier" method="POST" action="' . site_url('panier/ajouter') .'">';
        echo '<input type="hidden" name="id_plat" value="'. $plat->getAttr('id_plat') .'" />';
        echo '<input type="number" name="quantite" min="0"/>';
        echo '<input type="submit" value="Ajouter au panier" />';
        echo '</form>'; 
        echo '<p>' . $plat->getAttr('description_plat') . '</p>';
        // echo img('grandes/' . $plat->getAttr('photo_plat'));
    }

    echo '<div id="commentaires">';
    if(!is_null($comments)){
        foreach($comments as $comment){
            echo '<p>Note : ' . $comment->getAttr('valeur_note') . '<br /> ' . $comment->getAttr('content_comment') . '</p>';
        }   
    }else{
        echo 'Pas de commentaires';
    }
    echo '</div>';
    //Commentaire
    echo '<form id="form_ajouter_comment" method="POST" action="' . site_url('plat/addComment') . '">';
    echo '<input type="hidden" name="id_plat" value="' . $plat->getAttr('id_plat') . '" />';
    echo '<input type="hidden" id="valeur_note" name="valeur_note" value="1" />';
    echo 'Note: ';
    for($i = 1 ; $i < 6 ; $i++){
        if($i == 1){
            echo '<span class="note noteSelected" idStar="'.$i.'">&#9733;</span>';
        }else{
           echo '<span class="note noteNotSelected" idStar="'.$i.'">&#9733;</span>';
        }
    }
    echo '<br />';
    echo '<textarea name="contenu" placeholder="Contenu"></textarea><br />';
    echo '<input type="submit" value="Ajouter" />';    
    echo '</form>';
}