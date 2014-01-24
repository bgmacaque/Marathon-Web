<?php

class Plat extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('mPlat');
	}

	public function index($idplat = ''){
		$data = array();
		$data['content'] = array();
		$data['content'][] = 'plats';
		$data['js'] = array();
		$data['js'][] = 'plat';
		$data['js'][] = 'speedSearch';
		$data['css'] = array();
		$data['css'][] = 'plats';
		$data['css'][] = 'responsive';
		//Affichage de tous les plats
		if($idplat == ''){
			$data['plats'] = $this->mPlat->findAll();
			$this->load->view('template', $data);

		//Affichage d'un plat en détail (AJAX)
		}else{
			$pl = $this->mPlat->findAllBy(array('id_plat' => $idplat));
			$this->load->view('detail_plat', $data);
		}
	}


	public function addComment(){
		$contenu = $this->input->post('contenu');
		$valeur_note = $this->input->post('valeur_note');
		$id_plat = $this->input->post('id_plat');
		if(!isset($contenu) || empty($contenu) || !isset($contenu) || empty($contenu)){
			echo 'false';
			return ;
		}

		$this->load->model('mComment');
		$comment = new mComment();
		$comment->setAttr('content_comment', $contenu);
		$comment->setAttr('date_comment', time());
		$comment->setAttr('id_plat', $id_plat);
		$comment->setAttr('valeur_note', $valeur_note);
		$comment->save();
		$commentaires = $this->mComment->findAllBy(array('id_plat' => $id_plat));
		$data = array();
		$data['comments'] = $commentaires;
		$this->load->view('contents/comment', $data);
		return;
	}

	public function detail($id_plat = ''){
		$data = array();
		if($id_plat == ''){
			$data['erreur'] = 'Ce plat n\'existe pas'; 
		}else{
			$plat = $this->mPlat->findById($id_plat);
			if(is_null($plat)){
				$data['erreur'] = 'Ce plat n\'existe pas';
			}else{
				$data['css'] = 'notePlat';
				$data['plat'] = $plat;
				$this->load->model('mComment');
				$this->load->model('mNote');
				$comments = $this->mComment->findAllBy(array('id_plat' => $id_plat));
				$data['comments'] = $comments;
				if(!is_null($comments)){

					$somme = 0;
					$nombre = 0;

					foreach ($comments as $comment) {
						$somme += $comment->getAttr('valeur_note');
						$nombre++;
					}
					if($nombre != 0){
						$moy = $somme / $nombre;
						$data['moy'] = $moy;
					}
				}
			}
		}
		$data['content'] = 'platDetail';
		$this->load->view('template', $data);
	}

	public function removeComment(){

	}

	public function addNote(){
		$idplat = $this->input->post('id_plat');
		$note = $this->input->post('note');
		if(!isset($idplat) || empty($idplat) || !isset($note) || empty($note)){
			echo 'false';
			return;
		}
		$this->load->model('mNote');
		$note = new mNote();
		echo 'Yeah';
		return ;
	}
}