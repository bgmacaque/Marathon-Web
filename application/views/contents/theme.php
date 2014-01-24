<?php 
if(isset($themes) && !empty($themes)){
	echo '<h2>Liste des thèmes de plats</h2>';
    //Recherche rapide
    echo '<input type="search" id="champFilter" placeholder="Rechercher"/>';
    echo '<ul id="filter">';
	foreach($themes as $th){
        echo '<li>';
    	echo '<span class="nomTheme"><a class="theme" href="'.site_url('restaurant/index/'.$th->getAttr('id_theme')).'">'.$th->getAttr('nom_theme').'</a></span><br />';
        echo '</li>';
    }

    echo '</ul>';
}
