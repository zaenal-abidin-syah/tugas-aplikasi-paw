<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<label for="nama">Nama</label>
	<input 
		type="text"
		name="nama" 
		id="nama"
		value="<?php echo isset($data['nama']) ? $data['nama'] : ''; ?>"><br><br>
	<label for="username">Username</label>
	<input 
		type="text"
		name="username" 
		id="username"
		value="<?php echo isset($data['username']) ? $data['username'] : ''; ?>"><br><br>
	<label for="email">email</label>
	<input 
		type="text"
		name="email" 
		id="email"
		value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>"><br><br>
	<label for="no_tlp">No. Telephone</label>
	<input 
		type="text"
		name="no_tlp" 
		id="no_tlp"
		value="<?php echo isset($data['no_tlp']) ? $data['no_tlp'] : ''; ?>"><br><br>
	<textarea 
		name="alamat" 
		value="<?php echo isset($data['alamat']) ? $data['alamat'] : ''; ?>">Alamat</textarea>
	<input 
		type="text"
		><br><br>
</form>