<?php require_once "functions.php";
	if(isset($_POST['canvasImage'])){
		save_image();
	}
	if(isset($_POST['clearAll'])){
		clear_previews();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Task</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.7.0/fabric.min.js"></script>
	<style>
	 #canvas{
	    border: 2px solid black;
	 }
	 .img-preview{
	 	width: 150px;
	 	height: 120px;
	 	border: 2px solid black;
	 	margin: 5px;
	 }
	 .img-preview:hover{
	 	cursor: pointer;
	 }
	 form{
	 	margin-top: 10px;
	 }
	</style>
</head>
<body>
		<div class="preview">
		<?php
		$images = display_images();
			if(!empty($images)){
				foreach($images as $image){
					echo "<img class='img-preview' src='data:image/png;base64,". base64_encode($image['image']) ."'/>";
				}
			}
		?>
		</div>
		<canvas id="canvas" height="450px" width="1370px"></canvas>
		<form method="POST">
			<input type="button" name="save" id="save" value="Save"></input>
			<input type="button" name="add-rect" id="add-rect" value="Add Rectangle"></input>
			<input type="button" name="add-circle" id="add-circle" value="Add Circle"></input>
			<input type="button" name="add-text" id="add-text" value="Add Text"></input>
			<input type="button" name="change-bg" id="change-bg" value="Change canvas background"></input>
			<input type="button" name="clear" id="clear" value="Clear canvas"></input>
			<button type="sumbit" name="clearAll" id="clearAll">Delete previews</button>
		</form>
<script>
var canvas = new fabric.Canvas('canvas');
</script>
<script src="ajax.js"></script>
</body>
</html>