<html>
<head>
<title>Add Delete Image via jQuery AJAX</title>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript">
$(document).ready(function (e) {
	$("#uploadForm").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "upload.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {
			$("#targetLayer").html(data);
		    },
		  	error: function(){} 	        
	   });
	}));	
});
function deleteImage(path) {
	$.ajax({
		url: "delete.php",
		type: "POST",
		data:  {'path':path},
		success: function(data){
			$("#targetLayer").html('<div class="no-image">No Image</div>');
		},
		error: function(){} 	        
	});
}
</script>
<style>
body {
font-family: Arial;
font-size: 14px;
}
.bgColor {
width: 440px;
height:100px;
background-color: #c8f5ff;
color: #000;
padding: 2px;
}
.bgColor label{
font-weight: bold;
color: #A0A0A0;
}
#targetLayer{
float:left;
width:100px;
height:100px;
text-align:center;
font-weight: bold;
color: #C0C0C0;
background-color: #F0E8E0;
position:relative;
}
#uploadFormLayer{
float:right;
padding: 10px;
}
.btnSubmit {
background-color: #3FA849;
padding:4px;
border: #3FA849 1px solid;
color: #FFFFFF;
}
.inputFile {
padding: 3px;
background-color: #FFFFFF;
}

.image-container {
	display:inline-block;
	position:relative;
}
.image-delete {
	position: absolute;
    right: 30px;
    top: 30px;
    border: #FFF 4px solid;
    border-radius: 50%;
    padding: 7px 10px;
    display: none;
    cursor: pointer;
    opacity: 0.6;
    color: #FFF
}
.no-image {
	display: inline-block;
    position: absolute;
    right: 18px;
    top: 40px;
}
</style>
</head>
<body>
<div class="bgColor">
<form id="uploadForm" action="upload.php" method="post">
<div id="targetLayer"><div class="no-image">No Image</div></div>
<div id="uploadFormLayer">
<label>Upload Image File:</label><br/>
<input name="userImage" type="file" class="inputFile" />
<input type="submit" value="Submit" class="btnSubmit" />
</form>
</div>
</div>
</body>
</html>