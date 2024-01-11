<?php 
	session_start();
	if(isset($_SESSION['usuario'])){		
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>inicio</title>
	
</head>
<body>


</body>
</html>
<?php 
	}else{
		header("location:../index.php");
	}
    
 ?>