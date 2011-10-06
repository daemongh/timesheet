<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>My Timesheet Project</title>
</head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/base.css'; ?>"/>
<body>

<h1>Timesheet</h1>
<form method="post" action="<?php echo site_url('/time/login'); ?>">
	<label for="username">Username</label>
	<input type="input" name="username">
	
	<label for="password">Password</label>
	<input type="password" name="password">

	<input type="submit" name="login" value="Log In">
	<a href="">Forgot Password?</a>
	<a href="">Create Account!</a>

</form>


</body>
</html>
