<?php

	$ariane = '<a href="'.site_url('accueil').'">Accueil</a>';

	if(isset($theme) && !is_null($theme) && !empty($theme)){
		$ariane.='<span> > </span><a href="'.site_url('theme').'">'.$theme->getAttr('nom_theme').'</a>';
		if(isset($resto) && !is_null($resto) && !empty($resto)){
			$ariane.='<span> > </span><a href="'.site_url('restaurant/index/'.$theme->getAttr('id_theme')).'">'.$resto->getAttr('nom_resto').'</a>';
		}
	}
	
	echo $ariane;
?>