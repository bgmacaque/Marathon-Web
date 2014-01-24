
<form id="form_connexion" method="post" action="<?php echo site_url('ajax/connect') ?>" class="popup connexion">
    <h2>Connexion</h2>
    <input type="text" name="pseudo" placeholder="Pseudonyme" /><br />
    <input type="password" name="pass" placeholder="Password" /><br />
    <input type="submit" value="Se connecter" />
    <input id="annuler_co" type="button" value="Annuler"/>
</form>



<form id="form_subscribe" method="post" class="popup inscription" action="<?php echo site_url('ajax/subscribe'); ?>">
    <h2>Inscription</h2>
    <input type="text" name="pseudo" placeholder="Pseudonyme"/><br />
    <input type="password" name="pass"  placeholder="Password" /><br />
    <input type="password" name="passConfirm"  placeholder="Confirmation password"/><br />
    <input type="mail" name="email" placeholder="E-mail"/><br />
    <input type="mail" name="emailConfirm" placeholder="Confirmation E-mail"/><br />
    <input type="submit" id="inscrire" value="S'incrire" />
    <input type="button" id="annuler_inscr" value="Annuler"/>
</form>