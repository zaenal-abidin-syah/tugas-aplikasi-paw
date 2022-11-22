<table>
	<tr>
		<th>Username</th>
		<th>Password</th>
		<th></th>
	</tr>
<?php foreach ($data as $value): ?>
	<tr>
		<td><?php echo $value['username'] ?></td>
		<td><?php echo $value['password'] ?></td>
		<td>
			<a href="detail.php?username=<?php echo $value['username'] ?>">Detail</a>
			<a href="edit.php?username=<?php echo $value['username'] ?>">Edit</a>
			<a href="delete.php?username=<?php echo $value['username'] ?>">Delete</a>
		</td>
	</tr>
<?php endforeach ?>
</table>