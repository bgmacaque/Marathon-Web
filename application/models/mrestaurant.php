<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class mRestaurant extends MY_Model{

    public function cartes($nombre, $offset){
        $table = $this->getName();
        $query = $this->db->get($table, $nombre, $offset);
        return $query;
    }

}