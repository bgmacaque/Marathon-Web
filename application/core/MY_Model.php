<?php

//Classe de model genérique
class MY_Model extends CI_Model {
    //liste des attributs et nom de la table
    protected $liste, $name;
    
    public function __construct(){
        parent::__construct();

        $this->name = self::getName();
        if($this->name != "y_model"){
            $liste = self::getListe();
            foreach($liste as $column)
                $this->liste[$column] = "";
        }
    }

    /**
    *   Getter generique
    *
    *   fonction d'acces aux attributs d'un objet.
    *   Recoit en parametre le nom de l'attribut accede
    *   et retourne sa valeur.
    *  
    *   @param String $attr_name attribute name 
    *   @return mixed
    **/
    public function getAttr($attr_name) {
        if (array_key_exists($attr_name, $this->liste)) 
            return ($this->liste[$attr_name]); 
        $emess = __CLASS__ . ": unknown member $attr_name (getAttr)";
        throw new Exception($emess, 45);
    }

    // public function __get($attr_name){
    //     return $this->getAttr($attr_name);
    // }

    // public function __set($attr_name, $attr_val){
    //     return $this->setAttr($attr_name, $attr_val);
    // }

    /**
    *   Setter generique
    *
    *   fonction de modification des asttributs d'un objet.
    *   Recoit en parametre le nom de l'attribut modifie et la nouvelle valeur
    *  
    *   @param String $attr_name attribute name 
    *   @param mixed $attr_val attribute value
    *   @return mixed new attribute value
    **/
    public function setAttr($attr_name, $attr_val) {
        if (array_key_exists($attr_name, $this->liste)) {
            $this->liste[$attr_name] = $attr_val;

            return $this->liste[$attr_name];
        } 
        
        $emess = __CLASS__ . ": unknown member $attr_name (setAttr)";
        throw new Exception($emess, 45);

    }

    /**
    *   Fonction pour remplir les valeurs depuis un formulaire
    **/
    public function setValues($data = array()){
        if(empty($data))
            $data = $_POST;
        foreach($data as $key => $value){
            try {
                $this->setAttr($key, $value);
            } catch(Exception $e) { }
        }
    }
    
    /**
    *   Sauvegarde dans la base
    *
    *   Enregistre l'etat de l'objet dans la table
    *
    *   Si l'objet possede un identifiant : mise à jour de la ligne correspondante
    *   sinon : insertion dans une nouvelle ligne
    *
    *   @return int le nombre de lignes touchees
    **/
    public function save() {
        reset($this->liste);
        //si il y a un id on met à jour
        $id = current($this->liste);
        if (!empty($id))
            return $this->update();
        //sinon on insert dans la base
        return $this->insert();
    }


    /**
    *   Insertion dans la base
    *
    *   Insère l'objet comme une nouvelle ligne dans la table
    *
    *   @return int nombre de lignes insérées
    **/                                 
    private function insert() {
        $this->db->insert($this->name, array_slice($this->liste, 1)); 

        reset($this->liste);
        $this->liste[key($this->liste)] = $this->db->insert_id();
        
        return $this->db->affected_rows();
    }

    /**
    *   Mise a jour de la ligne courante
    *   
    *   Sauvegarde l'objet courant dans la base en faisant un update
    *
    *   @return int nombre de lignes mises à jour
    **/
    private function update() {
        reset($this->liste);
        $this->db->where(key($this->liste), current($this->liste));
        $this->db->update($this->name, array_slice($this->liste, 1));
        
        return $this->db->affected_rows();
    }


    /**
    *   Suppression dans la base
    *
    *   Supprime la ligne dans la table corrsepondant à l'objet courant
    *   L'objet doit posséder un OID
    *
    *   @return int nombre de lignes effacées
    **/
    public function delete() {
        reset($this->liste);
        $this->where(key($this->liste), current($this->liste));
        $this->db->remove($name);
        
        return $this->db->affected_rows();
    }

    /**
    *   Retourne la liste des attibruts
    *
    *   @return liste des attibuts de la table
    **/
    public static function getListe(){
        $CI =& get_instance();
        $name = substr(strtolower(get_called_class()), 1);

        $query = $CI->db->query("SHOW COLUMNS FROM {$name}");
        $liste = array();
        foreach($query->result() as $row)
            $liste[] = $row->Field;

        return $liste;
    }


    /**
    *   Retourne le nom de la table
    **/
    public static function getName(){
        return substr(strtolower(get_called_class()), 1);
    }

    /**
    *   Retourne un élement en fonction de son id
    **/
    public static function findById($id){
        $CI =& get_instance();

        $liste = self::getListe();
        reset($liste);
        $query = $CI->db->get_where(self::getName(), array(current($liste) => $id));
        if($query->num_rows() == 1){
            $r = new ReflectionClass(get_called_class());
            $classe = $r->newInstanceArgs();
            $row = $query->row();
            foreach($liste as $attr)
                $classe->setAttr($attr, $row->$attr);

            return $classe;
        }
    }

    /**
    *   Retourne un élement en fonction du tableau passé en paramétre
    **/
    public static function findBy($elements){
        $CI =& get_instance();

        $liste = self::getListe();
        $query = $CI->db->get_where(self::getName(), $elements);
        if($query->num_rows() == 1){
            $r = new ReflectionClass(get_called_class());
            $classe = $r->newInstanceArgs();
            $row = $query->row();
            foreach($liste as $attr)
                $classe->setAttr($attr, $row->$attr);

            return $classe;
        }
    }

    /**
    *   Retourne les élement en fonction des tableaux passés en paramétre
    **/
    public static function findAllBy($elements, $ordre = array()){
        $CI =& get_instance();

        $liste = self::getListe();
        $CI->db->from(self::getName());
        $CI->db->where($elements);
        if(!empty($ordre))
            foreach($ordre as $cle => $ordre)
                $CI->db->order_by($cle, $ordre);
        $query = $CI->db->get();
        if($query->num_rows() >= 1){
            $retour = array();
            foreach ($query->result() as $row){
                $r = new ReflectionClass(get_called_class());
                $classe = $r->newInstanceArgs();
                foreach($liste as $attr)
                    $classe->setAttr($attr, $row->$attr);
                $retour[] = $classe;
            }
            return $retour;
        }
    }

    /**
    *   Retourne les élement en fonction du tableau passé en paramétre
    **/
    public static function findAll($ordre = array()){
        $CI =& get_instance();

        $liste = self::getListe();
        $CI->db->from(self::getName());
        if(!empty($ordre))
            foreach($ordre as $cle => $ordre)
                $CI->db->order_by($cle, $ordre);
        
        $query = $CI->db->get();
        if($query->num_rows() >= 1){
            $retour = array();
            foreach ($query->result() as $row){
                $r = new ReflectionClass(get_called_class());
                $classe = $r->newInstanceArgs();
                foreach($liste as $attr)
                    $classe->setAttr($attr, $row->$attr);
                $retour[] = $classe;
            }
            return $retour;
        }
    }
}
