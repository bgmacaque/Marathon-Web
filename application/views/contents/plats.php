<?php


echo '<input type="search" id="champFilter" placeholder="Recherche"/>';

echo '<ul id="filter">';
foreach($plats as $plat){
    echo '<li class="plat" style="background: url(\''.base_url().'assets/img/petites/' . $plat->getAttr('photo_plat').'\')">';
    $nom = substr($plat->getAttr('nom_plat'), 0, 10);
    echo '<span class="nomPlat"><a href="' . site_url('plat/detail/' . $plat->getAttr('id_plat')) . '">' . $nom . '</a></span><br />';
    echo '</li>';
}

echo '</ul>';