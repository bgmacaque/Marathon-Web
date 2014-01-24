<?php

    if(!isset($_POST['nom'])){
    echo '<h2>Récapitulatif de la commande</h2>';
    $panier = $this->session->userdata('panier');
    echo '<table>';
    echo '<tr>';
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
        echo '<tr>';        
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

    

    echo '<form action="#" method="POST">';

    	echo '<fieldset><legend>Vos coordonnées personnelles</legend>';
            echo '<table>';

            echo '<tr>';
                echo '<td><label>Votre adresse </label></td>';
                echo '<td><input type="text" id="adresse" name="adresse" placeholder="Votre adresse"/></td>';
            echo '</tr>';

            echo '<tr>';
                echo '<td><label for="code_post">Votre code postal </label></td>';
                echo '<td><input type="text" name="code_post" id="code_post" size="5" maxlength="5"/></td>';
            echo '</tr>';

            echo '<tr>';
                echo '<td><label for="pays">Votre pays </label></td>';
                echo '<td><select name="pays" id="pays">';
                echo '<option value="france">France</option>';
                echo '<option value="espagne">Espagne</option>';
                echo '<option value="italie">Italie</option>';
                echo '<option value="royaume-uni">Royaume-Uni</option>';
                echo '<option value="canada">Canada</option>';
                echo '<option value="etats-unis">États-Unis</option>';
                echo '<option value="chine">Chine</option>';
                echo '<option value="japon">Japon</option></td>';
            echo '</tr>';


            echo '</table>';
    	echo '</fieldset>';

    	echo '<fieldset><legend>Votre moyen de paiement</legend>';
    		echo '<label for="bancaire">Par carte bancaire</label><input id="bancaire" type="radio" value="bancaire" name="paiement" checked/>';
    		echo '<label for="liquide">En liquide</label><input id="liquide" type="radio" value="liquide" name="paiement"/><br />';
    		echo '<label for="tel">Numéro de téléphone</label><input type="tel" name="tel" pattern="[0-9]{10}"/>';
    	echo '</fieldset>';

    	echo '<fieldset id="coordonnees_bancaires"><legend>Vos coordonnées bancaires</legend>';
    		echo '<table>';

                echo '<tr>';
                    echo '<td><label for="nom">Nom </label></td>';
                    echo '<td><input type="text" name="nom"/></td>';
                echo '</tr>';

                echo '<tr>';
                    echo '<td><label for="prenom">Prénom </label></td>';
                    echo '<td><input type="text" name="prenom"/></td>';
                echo '</tr>';

                echo '<tr>';
                    echo '<td><label for="num_carte">Numéro de carte </label></td>';
                    echo '<td><input name="num_carte" type="text" pattern="[0-9]{16}"/></td>';
                echo '</tr>';

                echo '<tr>';
                    echo '<td><label>Date d\'expiration </label></td>';
                    echo '<td><input type="text" id="date_exp"/></td>';
                echo '</tr>';

                echo '<tr>';
                    echo '<td><label>Cryptogramme visuel </label></td>';
                    echo '<td><input type="text" pattern="[0-9]{3}"/></td>';
                echo '</tr>';

    		echo '</table>';
    	echo '</fieldset>';

    	echo '<fieldset><legend>Mode de livraison</legend>';
    		echo '<label for="resto">Au restaurant </label><input type="radio" name="mode_livraison" value="resto" checked/>';
			echo '<label for="comptoir">Au comptoir </label><input type="radio" name="mode_livraison" value="comptoir"/>';
		echo '</fieldset>';	

        echo '<input type="submit" value="Commander !"/>';
    echo '</form>';
    }else{

        $complet = true;
        foreach ($_POST as $key => $value) {
            if(isset($value) && !is_null($value)){
                if(empty($value) || $value == '')
                    $complet = false;
            }
        }

        if($complet){

        echo '<h2>Commande envoyée !</h2>';
        echo '<a id="imprimer" href="javascript:window.print()">Imprimer cette page</a>';
        $panier = $this->session->userdata('panier');
        echo '<table>';
        echo '<tr>';
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
            echo '<tr>';        
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

    }else{
        echo '<p class="err">Il faut remplir tous les champs ! <br /> <a href="'.site_url('panier/commander').'">Recommencer</a></p>';
    }
    }
    
?>
