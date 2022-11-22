<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<label for="username">Username</label>
	<input 
		type="text"
		name="username" 
		id="username"
		value="<?php echo isset($data['username']) ? $data['username'] : ''; ?>"><br><br>
	<label for="password">password</label>
	<input 
		type="password" 
		name="password" 
		id="password"
		value="<?php echo isset($data['password']) ? $data['password'] : ''; ?>"><br><br>
</form>