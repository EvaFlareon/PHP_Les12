<?php

$connect = mysqli_connect("localhost", "root", "", "netology");

$user_filt = [];

if (!empty($_POST)) {
	if ($_POST['clear']) {
		header('Location: index.php');
	}
	if ($_POST['name'] != '') {
		$user_filt[0] = $_POST['name'];
		$sql = 'select * from books where name like "%'.$user_filt[0].'%"';
	}
	if ($_POST['author'] != '') {
		$user_filt[1] = $_POST['author'];
		$sql = 'select * from books where author like "%'.$user_filt[1].'%"';	
	}
	if ($_POST['isbn'] != '') {
		$user_filt[2] = $_POST['isbn'];
		$sql = 'select * from books where isbn like "%'.$user_filt[2].'%"';	
	}
} else {
	$sql = "select * from books";
}

$res = mysqli_query($connect, $sql);

?>

<!doctype>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Работа с БД</title>
</head>
<body>
	<form method="post" action="">
		<table>
			<tr>
				<td>id</td>
				<td>name<br><input type="text" name="name"></td>
				<td>author<br><input type="text" name="author"></td>
				<td>year</td>
				<td>isbn<br><input type="text" name="isbn"></td>
				<td>genre</td>
			</tr>
			<?php while ($data = mysqli_fetch_array($res)) { ?>
			<tr>
				<td><?php echo $data['id']; ?></td>
				<td><?php echo $data['name']; ?></td>
				<td><?php echo $data['author']; ?></td>
				<td><?php echo $data['year']; ?></td>
				<td><?php echo $data['isbn']; ?></td>
				<td><?php echo $data['genre']; ?></td>
			</tr>
			<? } ?>
		</table>
		<input type="submit" name="filt"><br>
		<input type="submit" name="clear" value="Очистить">
	</form>
</body>
</html>