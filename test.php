<?php
$_POST['text'] = $_POST['text'] ?? "Rien"
?>
<!DOCTYPE html>
<html>
<head>
	<title>Yes</title>
</head>
<body>
	<?= $_POST['text'] ?>
	<form method="post">
		<input type="text" name="text" placeholder="hihi">
		<input type="submit">
	</form>
</body>
</html>
