$('#clear').click(function(){
	canvas.clear();
})

$("#add-rect").click(function(){
	var rectangle = new fabric.Rect({
		left: 100,
		top: 150,
		fill: 'gray',
		width: 150,
		height: 150
	});
	canvas.add(rectangle);
});

$("#add-circle").click(function(){
	var circle = new fabric.Circle({
		left: 500,
		top: 50,
		fill: 'gray',
		radius: 60,	
	});
	canvas.add(circle);
});

$("#add-text").click(function(){
	var text = prompt("Enter some text");
	var textElement = new fabric.IText(text, { 
	     fontFamily: 'arial black',
	     left: 800, 
	     top: 150 ,
	  });
	canvas.add(textElement);
})

$('#save').click(function(){
	var img = $("#canvas")[0].getContext('2d');
	var canvasImage = $("#canvas")[0].toDataURL('image/png');
	$.ajax({
        url: 'index.php',
        type:"POST",
        data: {canvasImage: canvasImage},
        success: function(data) {
           // alert(data);
           display_preview();
        }
    });
});

$('.img-preview').click(function(){
	canvas.clear();
	var imagePath = $(this).attr('src');
	fabric.Image.fromURL(imagePath,function(oImg){
		oImg.scaleToWidth(500);
    	oImg.scaleToHeight(500);
		canvas.add(oImg);
	});
});

$("#change-bg").click(function(){
	var color = prompt("Enter color name");
	$("#canvas").css("background-color",color);
});

function display_preview(){
	$.ajax({
        url: 'preview.php',
        type:"POST",
        data: {preview: "preview"},
        success: function(data) {
           $(".preview").html('');
           $(".preview").html(data);
        }
    });
}

