<?php

if(isset($cartes) && !empty($cartes)){
    foreach ($cartes->result() as $carte) {
        echo $carte->nom_resto . '<br />';
    }
}