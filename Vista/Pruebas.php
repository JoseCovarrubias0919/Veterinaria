<!DOCTYPE html>
<html>
<head>
	<title>Hola mundo en HTML y PHP</title>
</head>
<body>
	<form method="post">
		<input type="submit" name="submit" value="Presionar para decir Hola mundo">
	</form>

	<?php
		if(isset($_POST['submit'])){
			echo "Hola mundo";
		}
	?>
</body>
</html>
