<?php


if(isset($erreur) && !empty($erreur)){
    echo '<span id="erreur">'.$erreur.'</span>';
}else{
    echo '<table>';
    echo '<tr>';
    echo '<th>Supprimer</th>';
    echo '<th>Theme</th>';
    echo '<th>Restaurant</th>';
    echo '<th>Plat</th>';
    echo '<th>Quantité</th>';
    echo '<th>P.U.</th>';
    echo '<th>Total</th>';
    echo '</tr>';
    $montantTot = 0;
    $nombre = 0;
    foreach ($panier as $key => $value) {
        echo '<tr class="lignePlat" idPlat="'. $panierInfo[$key]['plat']->getAttr('id_plat') .'">';
        echo '<td>';
        echo '<form class="form_supprimer_panier" method="post" action="' . site_url('panier/supprimer') . '">';
        echo '<input type="hidden" name="id_plat" value="' . $key . '" />';
        echo '<input type="submit" value="Supprimer" />';
        echo '</form>';
        echo '</td>';        
        echo '<td>' . $panierInfo[$key]['theme']->getAttr('nom_theme') . '</td>';
        echo '<td>' . $panierInfo[$key]['resto']->getAttr('nom_resto') . '</td>';
        echo '<td>' . $panierInfo[$key]['plat']->getAttr('nom_plat') . '</td>';
        echo '<td>' . $value . '</td>';
        echo '<td>' . $panierInfo[$key]['plat']->getAttr('prix_plat') . '</td>';
        $montant = $panierInfo[$key]['plat']->getAttr('prix_plat') * $value ;
        echo '<td>' . $montant . '</td>';
        $montantTot += $montant;
        $nombre += $value;
        echo '</tr>';
    }
    echo '<tr></tr>';
    echo '<tr><td></td><td></td><td></td><td>Commande totale</td><td>'.$nombre.'</td><td></td><td>'.$montantTot.'</td></tr>';
    echo '</table>';
    echo '<a href="'.site_url('panier/commander').'">Commander</a>';
}