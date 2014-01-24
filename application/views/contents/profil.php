<?php


if(isset($erreur) && !empty($erreur)){
    echo $erreur;
}else{
    echo '<h1>Profil de ' . $user->getAttr('pseudo_user') . '</h1>';
    echo '<a class="nomLienFav" href="' . site_url('profil/favresto') . '">Favoris restaurant</a>';

    echo '<form id="form_changepass" method="POST" action="' . site_url('profil/changerPass') .'">';
    echo '<input type="password" name="pass" placeholder="Ancien pass" /><br />';
    echo '<input type="password" name="newPass" placeholder="Nouveau pass" /><br />';
    echo '<input type="password" name="confirmPass" placeholder="Confirmation pass" /><br />';
    echo '<input type="submit" value="Changer" />';
    echo '</form>';

}