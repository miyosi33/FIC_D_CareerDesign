<?php session_start(); ?>
<?php require 'header_mana.php'; ?>

<div class="m-5">

<?php
if (isset($_SESSION['admin'])) {
	echo '<table class="table">';
	echo '<thead>';
	echo '<tr>';
	echo '<th scope="col">ID</th><th scope="col">名前</th><th scope="col">値段</th><th scope="col">種類</th><th scope="col">説明</th><th scope="col">おすすめ</th><th scope="col"></th><th scope="col"></th>';
	echo '</tr>';
	echo '</thead>';
	if (isset($_REQUEST['command'])) {
		switch ($_REQUEST['command']) {

		// 追加ボタンを押したときの処理
		case 'insert':
			// 何も入力されていなかったらなにもしない
			if (empty($_REQUEST['product_name'])
			|| empty($_REQUEST['product_price'])
			|| empty($_REQUEST['product_genre'])
			|| empty($_REQUEST['product_description'])
			|| empty($_REQUEST['is_featured'])
			){
				break;
			}
			// 内容を追加
			$sql=$pdo->prepare('insert into product values(null,?,?,?,null,?,?)');
			$sql->execute(
				[htmlspecialchars($_REQUEST['product_name']),
				$_REQUEST['product_price'],
				$_REQUEST['product_genre'],
				$_REQUEST['product_description'],
				$_REQUEST['is_featured']
				]
			);
			break;
		// 更新ボタンを押したときの処理
		case 'update':
			// 何も入力されていなかったらなにもしない
			if (empty($_REQUEST['product_name'])
			|| empty($_REQUEST['product_price'])
			|| empty($_REQUEST['product_genre'])
			|| empty($_REQUEST['product_description'])
			|| empty($_REQUEST['is_featured'])
			){
				break;
			}
			// 内容を更新
			$sql=$pdo->prepare('update product set product_name=?, product_price=?, product_genre=?, product_description=?, is_featured=? where product_id=?');
			$sql->execute(
				[htmlspecialchars($_REQUEST['product_name']),
				$_REQUEST['product_price'],
				$_REQUEST['product_genre'], 
				$_REQUEST['product_description'],
				$_REQUEST['is_featured'],
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
		echo '<div class="td1">';
		echo '<td>', '<input type="text" name="is_featured" value="', $row['is_featured'], '">', '</td>';
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



	echo '<!-- 追加のフォーム -->';
	echo '<tr>';
	echo '<form action="menuedit_mana.php" method="post">';
	echo '<!-- 追加処理に進むためのコマンド -->';
	echo '<input type="hidden" name="command" value="insert">';
	echo '<td><div class="td0"></div></td>';
	echo '<td><div class="td1"><input type="text" name="product_name" require></div></td>';
	echo '<td><div class="td1"><input type="text" name="product_price" require></div></td>';
	echo '<td><div class="td1"><input type="text" name="product_genre" require></div></td>';
	echo '<td><div class="td1"><input type="text" name="product_description" require></div></td>';
	echo '<td><div class="td1"><input type="text" name="is_featured" require></div></td>';
	echo '<td><div class="td2"><input type="submit" value="追加"></div></td>';
	echo '</form>';
	echo '</tr>';
	echo '</tbody>';
	echo '</table>';

} else {
	echo '<a href="login_mana.php">ログインに戻る</a>';
}
?>

</body>
</html>
