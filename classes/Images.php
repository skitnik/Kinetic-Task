<?php
	require_once "classes/Database.php";

class Images{

	public $image;
	public $imageName;
	public $db;

	public function __construct(){
		$this->db = new Database();
	}
	public function save(){
		$this->filter();
		$this->db->insert("INSERT INTO images (name, image) VALUE (?,?)",[$this->imageName,$this->image]);
	}

	public function filter(){
		$this->image = $_POST['canvasImage'];
		$filterImage = explode(',', $this->image);
		$this->image = base64_decode($filterImage[1]);
		$this->imageName = time().".png";
	}

	public function deleteAll(){
		$this->db->delete("DELETE FROM images");
	}
}