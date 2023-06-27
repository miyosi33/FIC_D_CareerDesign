<?php require 'server_connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>本棚/全ての本</title>
    <link rel="stylesheet" href="test21.css">
    <link rel="stylesheet" href="testdiv1.css">
</head>
<body>

<div class="kuuu">

</div>
<nav class="menu">
    <ul>
        <li><a href="honndana.php">本棚</a></li>
        <li><a href="insert-input-pro.php">本の追加</a></li>
        <li><a href="update-input-pro.php">本の編集</a></li>
        <li><a href="delete-input-pro.php">本の削除</a></li>
        <li><a href="logout-input-pro.php">ログアウト</a></li>
    </ul>
</nav>
<hr>
<?php session_start(); ?>
<?php
if (isset($_SESSION['customer'])) {
	echo '<table>';
	echo '<th>タイトル</th><th>所持数</th><th>出版社</th><th>作者</th>';
	$sql=$pdo->prepare('select * from mybook, library '.
		'where customer_id=? and library_id=id');
	$sql->execute([$_SESSION['customer']['id']]);
	foreach ($sql as $row) {
		$id=$row['id'];
		echo '<tr>';
		// echo '<td>', $id, '</td>';
		echo '<td>', $row['name'], '</td>';
		echo '<td>', $row['latest'], '</td>';
        echo '<td>', $row['company'], '</td>';
        echo '<td>', $row['authorname'], '</td>';
		echo '</tr>';
	}
	echo '</table>';
} else {
	echo 'お気に入りを表示するには、ログインしてください。';
}
?>

</body>
</html>
