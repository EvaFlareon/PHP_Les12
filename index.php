<?php

$connect = mysqli_connect("localhost", "root", "", "netology");

if (!empty($_POST)) {
	if ($_POST['clear']) {
		header('Location: index.php');
	}
	
	$k = 0;
	$sql = "select * from books";
	$user_str_filt = 'select * from books where ';

	foreach ($_POST as $title => $value) {
		if ($value === '' || $value === 'Отправить') {
			continue;
		} else {
			$k++ ;
			if ($k == 1) {
				$sql = $user_str_filt.$title.' like "%'.$value.'%"';
			}
			if ($k > 1) {
				$sql = $sql." AND ".$title.' like "%'.$value.'%"';
			}
		}
	}
} else {
	$sql = "select * from books";
}

echo $sql;

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
				<td>name<br><input type="text" name="name" value="<?= $_POST['name']; ?>"></td>
				<td>author<br><input type="text" name="author" value="<?= $_POST['author']; ?>"></td>
				<td>year</td>
				<td>isbn<br><input type="text" name="isbn" value="<?= $_POST['isbn']; ?>"></td>
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
