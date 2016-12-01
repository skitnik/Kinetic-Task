canvas.on('object:added',function(){
  if(!isRedoing){
    h = [];
  }
  isRedoing = false;
});

var isRedoing = false;
var h = [];

$("#undo").click(function(){
if(canvas._objects.length>0){
   h.push(canvas._objects.pop());
   canvas.renderAll();
  }
});

$("#redo").click(function(){
	if(h.length>0){
	    isRedoing = true;
	   canvas.add(h.pop());
	  }
});

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
	$("#text").css("display","inline-block");
	$("#text-color").css("display","inline-block");
	$("#text-submit").css("display","inline-block");
	
})

$("#text-submit").click(function(){
	var text = $("#text").val();
	var textColor = $("#text-color").val();
	var textElement = new fabric.IText(text, { 
	     fontFamily: 'arial black',
	     left: 800, 
	     top: 150 ,
	     fill:textColor,
	  });
	canvas.add(textElement);
});

$('#save').click(function(){
	var canvasImage = $("#canvas")[0].toDataURL('image/png');
	$.ajax({
        url: 'index.php',
        type:"POST",
        data: {canvasImage: canvasImage},
        success: function(data) {
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

$("#change-bg").change(function(){
	var color = $("#change-bg").val();
	canvas.backgroundColor = color;
	canvas.renderAll();
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

