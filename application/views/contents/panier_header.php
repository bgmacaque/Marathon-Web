<div id="panier-top">
<a> 
<?php 
    echo img("cart.png"); 
?>
</a>
<?php
    $panier = $this->session->userdata('panier');
    if(isset($panier) && !empty($panier) && !is_null($panier)){
        $CI =& get_instance();
        $CI->load->model('mPlat');
        $montant = 0;

        foreach ($panier as $id_plat => $quantite) {
            $plat = $CI->mPlat->findById($id_plat);
            $montant += $plat->getAttr('prix_plat') * $quantite;
        }
        echo '<span id="montantPanier">'. $montant .'</span>' . '&euro;';
    }else{
        echo '<span id="montantPanier">0 &euro;</span>';
    }
?>
</div>

<div id="panier_info">
    <h2>Panier</h2>

    <?php
    $panier = $this->session->userdata('panier');
    $plats = array();
    $montants = array();

    if(isset($panier) && !empty($panier) && !is_null($panier)){
        $CI =& get_instance();
        $CI->load->model('mPlat');
        $montant = 0;

        foreach ($panier as $id_plat => $quantite) {
            $plat = $CI->mPlat->findById($id_plat);
            $plats[$quantite] = $CI->mPlat->findById($id_plat);
            $montant += $plat->getAttr('prix_plat') * $quantite;
            $montants[] = $plat->getAttr('prix_plat') * $quantite;
        }
        echo '<span id="montantPanier">'. $montant .'</span>' . '&euro;<br />';

        $i = 0;
        foreach ($plats as $key => $value) {
            echo '<p>'.$key.' * '.$value->getAttr('nom_plat').' = '.$montants[$i].' &euro;<br /></p>';
            $i++;
        }

    }else{
        echo '<span id="montantPanier">0 &euro;</span><br />';
    }
    ?>

    <input type="button" value="Détail" id="detail_panier"/>
    <input type="button" value="Fermer" id="annuler_panier"/>
</div>