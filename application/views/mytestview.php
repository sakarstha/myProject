<!DOCTYPE html5>
<html>
	<head>
		<title> This is my page</title>
	</head>
	<body>
		<form action="$_SERVER[PHP_SELF]" method="post">
			Username: <input type="text" name="username" required="required"/></br>
			Email: <input type = "email" name="email" required="required"/></br>
			<input type = "submit" name="submit">
		
		</form>
		<?php 
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		?>

	</body>
</html>