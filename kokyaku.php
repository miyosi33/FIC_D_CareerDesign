<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<hr>

<table>
<th>顧客ID</th><th>顧客の名前</th><th>顧客の情報</th><th>ログイン名</th><th>パスワード</th>'
<?php
$pdo=new PDO('mysql:host=localhost;dbname=kadai;charset=utf8', 
	'staff', 'password');
foreach ($pdo->query('select * from customer') as $row) {
	echo '<tr>';
	echo '<td>', $row['id'], '</td>';
	echo '<td>', $row['name'], '</td>';
    echo '<td>', $row['address'], '</td>';
    echo '<td>', $row['login'], '</td>';
    echo '<td>', $row['password'], '</td>';
	echo '</tr>';
	echo "\n";
}
?>
</table>

</body>
</html>
