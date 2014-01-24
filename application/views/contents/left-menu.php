<div id="sidr" class="sidr">
  <!-- Your content -->
  <ul>
    <li><a href="<?php echo site_url("theme")?>" >Thèmes</a></li>
    <li><a href="<?php echo site_url('restaurant')?>">Restaurants</a></li>
    <li><a href="<?php echo site_url('plat')?>">Plats</a></li>

    <?php
    $id_user = $this->session->userdata('id_user');
    if(isset($id_user) && !empty($id_user)){
        ?>
        <li><a href="<?php echo site_url('profil/favresto')?>">Favoris</a></li>
        <?php
    }
    //Meilleur restaurant
        $CI =& get_instance();
        $CI->load->model('mRestaurant');
        $CI->load->model('mPlat');
        $CI->load->model('mComment');
        $meilleurNote = 0;
        $restos = $CI->mRestaurant->findAll();
        foreach ($restos as $key => $value) {
            $plats = $CI->mPlat->findAllBy(array('id_resto' => $value->getAttr('id_resto')));
            $somme = 0;
            $nombre = 0;
            $this->load->model('mComment');
            foreach ($plats as $cle => $plat) {
                $comments = $CI->mComment->findAllBy(array('id_plat' => $plat->getAttr('id_plat')));
                if(!is_null($comments) && !empty($comments)){
                    foreach ($comments as $cleComment => $comment) {
                        $somme += $comment->getAttr('valeur_note');
                        $nombre++;
                    }
                }
            }
            $note = 0;
            if($nombre != 0){
                $note = $somme / $nombre;
            }
            if($note != 0){
                if($note >= $meilleurNote){
                    $meilleurNote = $note;
                    $idResto = $value->getAttr('id_resto');
                }
            }
        }
        echo '<li><a href="' . site_url('restaurant/carteComplete/' . $idResto) . '">Meilleur restaurant</a></li>';
    ?>
  </ul>
</div>