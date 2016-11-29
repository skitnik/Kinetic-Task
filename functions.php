<?php
function db_connect(){
	// return $dbh = new PDO('mysql:host=localhost;dbname=kinetik_task', "root", "",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	return $dbh = new PDO('mysql:host=localhost;dbname=webrorco_kinetic_task', "webrorco_kinetic", "!test7test",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

function save_image(){
	$image = $_POST['canvasImage'];
	$filterImage = explode(',', $image);
	$uncodeImage = base64_decode($filterImage[1]);
	$imageName = time().".png";

	$dbh = db_connect();
	$query = $dbh->prepare("INSERT INTO images (name, image) VALUE (?,?)");
	$query->execute(array($imageName,$uncodeImage));
}

function display_images(){
	$dbh = db_connect();
	$query = $dbh->query("SELECT * FROM images");
	while($result = $query->fetch(PDO::FETCH_ASSOC)){
		$images[] = $result;
	}
	if(!empty($images)){
		return $images;
	}
	
}
function clear_previews(){
	$dbh = db_connect();
	$dbh->query("DELETE FROM images");
	header('Location:index.php');
}

?>