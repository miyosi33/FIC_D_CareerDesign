<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<div class="m-5">

<?php
echo '<table class="table">';
echo '<thead>';
echo '<tr>';
echo '<th scope="col">商品番号</th><th scope="col">名前</th><th scope="col">値段</th><th scope="col">種類</th><th scope="col">説明</th><th scope="col"></th><th scope="col"></th>';
echo '</tr>';
echo '</thead>';
$pdo=new PDO('mysql:host=localhost;dbname=kadai;charset=utf8', 
	'staff', 'password');

if (isset($_REQUEST['command'])) {
	switch ($_REQUEST['command']) {

	// 追加ボタンを押したときの処理
	case 'insert':
		// 何も入力されていなかったらなにもしない
		if (empty($_REQUEST['product_name'])){
			break;
		}
		// 内容を追加
		$sql=$pdo->prepare('insert into product values(null,?,?,?,?)');
		$sql->execute(
			[htmlspecialchars($_REQUEST['product_name']),
			$_REQUEST['product_price'],
			$_REQUEST['product_genre'],
			$_REQUEST['product_description']]
		);
		break;
	// 更新ボタンを押したときの処理
	case 'update':
		// 何も入力されていなかったらなにもしない
		if (empty($_REQUEST['product_name'])){
			break;
		}
		// 内容を更新
		$sql=$pdo->prepare('update product set product_name=?, product_price=?, product_genre=?, product_description=? where product_id=?');
		$sql->execute(
			[htmlspecialchars($_REQUEST['product_name']),
			$_REQUEST['product_price'],
			$_REQUEST['product_genre'], 
            $_REQUEST['product_description'],
			$_REQUEST['product_id']]
		);
		break;
	// 削除ボタンを押したときの処理
	case 'delete':
		// 内容を削除
		$sql=$pdo->prepare('delete from product where product_id=?');
		$sql->execute([$_REQUEST['product_id']]);
		break;
	}
}

foreach ($pdo->query('select * from product') as $row) {
    echo '<tbody>';
    echo '<tr>';
	// 更新のフォーム
	echo '<form class="ib" action="menuedit_mana.php" method="post">';
	// 更新処理に進むためのコマンド
	echo '<input type="hidden" name="command" value="update">';
	echo '<td>', '<input type="hidden" name="product_id" value="', $row['product_id'], '">';
	echo '<div class="td0">';
	echo $row['product_id'];
	echo '</div> ';
	echo '<div class="td1">';
	echo '<td>', '<input type="text" name="product_name" value="', $row['product_name'], '">', '</td>';
	echo '</div> ';
	echo '<div class="td1">';
	echo '<td>', '<input type="text" name="product_price" value="', $row['product_price'], '">', '</td>';
	echo '</div> ';
	echo '<div class="td1">';
	echo '<td>', '<input type="text" name="product_genre" value="', $row['product_genre'], '">', '</td>';
	echo '</div> ';
    echo '<div class="td1">';
	echo '<td>', '<input type="text" name="product_description" value="', $row['product_description'], '">', '</td>';
	echo '</div> ';
    
	echo '<div class="td2">';
	echo '<td>', '<input type="submit" value="更新">', '</td>';
    
	echo '</div> ';
	echo '</form> ';
	
	// 削除のフォーム
	echo '<form class="ib" action="menuedit_mana.php" method="post">';
	// 削除処理に進むためのコマンド
	echo '<input type="hidden" name="command" value="delete">';
	echo '<input type="hidden" name="product_id" value="', $row['product_id'], '">';
	echo '<td><input type="submit" value="削除">', '</td>';

	echo '</form>';
    echo '</tr>';
	echo "\n";
}

?>
<!-- 追加のフォーム -->
<tr>
<form action="menuedit_mana.php" method="post">
<!-- 追加処理に進むためのコマンド -->
<input type="hidden" name="command" value="insert">
<td><div class="td0"></div></td>
<td><div class="td1"><input type="text" name="product_name"></div></td>
<td><div class="td1"><input type="text" name="product_price"></div></td>
<td><div class="td1"><input type="text" name="product_genre"></div></td>
<td><div class="td1"><input type="text" name="product_description"></div></td>
<td><div class="td2"><input type="submit" value="追加"></div></td>
</form>
</tr>
</tbody>
</table>



</body>
</html>
