<!DOCTYPE html>
<html>
<head>
    <title> Contact form Response</title>
    <link href="form.css" rel="stylesheet" />
</head>
<body>
<form>
	<h1>Your name is:
	<?php
		// Note that this is subject to security problems
		// in practice you shouldn't just echo form inputs without cleaning them up
		echo $_REQUEST['name'];
	?>
	</h1>

	<h1>Your email address is: <?php echo $_REQUEST['email']; ?>
	</h1>

	<h1>Your comment is: <?php 	echo $_REQUEST['feedback']; ?>
	</h1>
</form>
</body>
</html>