<?php
require_once "classes/Database.php";

if(isset($_POST['preview'])){
	// $images = display_images();
	$db = new Database();
	$allImages = $db->getRows("SELECT * FROM images");
	if(!empty($allImages)){
		foreach($allImages as $image){
			echo "<img class='img-preview' src='data:image/png;base64,". base64_encode($image['image']) ."'/>";
		}
	}
}

?>
<script>
	$('.img-preview').click(function(){
	canvas.clear();
	var imagePath = $(this).attr('src');
	fabric.Image.fromURL(imagePath,function(oImg){
		oImg.scaleToWidth(500);
    	oImg.scaleToHeight(500);
		canvas.add(oImg);
	});
});
</script>