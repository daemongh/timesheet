<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>My Timesheet Project</title>
</head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/base.css'; ?>"/>
<body>

<h1>Manage Projects</h1>
<form method="post">
<label for="username">Username</label>
<input name="username" type="text">
<label for="email">Email Address</label>
<input name="email" type="text">
<label for="password">Password</label>
<input name="password" type="password">
<label for="confirmPassword">Confirm Password</label>
<input name="confirmPassword" type="password">

<input type="button" name="submit" value="Create Account">
</form>
</body>
</html>
