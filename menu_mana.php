<?php session_start(); ?>


<div class="m-5">
<?php

<<<<<<< Updated upstream
    
    <?php
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
	echo '<th scope="col">ID</th><th scope="col">名前</th><th scope="col">値段</th><th scope="col">種類</th><th scope="col">説明</th><th scope="col">お勧め</th>';
    echo '</tr>';
    echo '</thead>';
    foreach ($pdo->query('select * from product') as $row) {
        echo '<tbody>';
    	echo '<tr>';
    	echo '<td>', $row['product_id'], '</td>';
    	echo '<td>', $row['product_name'], '</td>';
        echo '<td>', $row['product_price'], '</td>';
        echo '<td>', $row['product_genre'], '</td>';
        echo '<td>', $row['product_description'], '</td>';
        echo '<td>', $row['is_featured'], '</td>';
    	echo '</tr>';
    	echo "\n";
=======

$pdo = new PDO('mysql:host=localhost;dbname=kadai;charset=utf8', 'staff', 'password');

if (isset($_REQUEST['command'])) {
    switch ($_REQUEST['command']) {
        // ログイン
        case 'login':
            unset($_SESSION['admin']);

            // ユーザー名とパスワードの検証
            $sql = $pdo->prepare("select * from admin where username = ? and password = ?");
            $sql->execute([$_REQUEST['username'], $_REQUEST['password']]);
            $admin = $sql->fetch(PDO::FETCH_ASSOC);

            if ($admin) {
                require 'header_mana.php';
                echo '<table class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col">商品番号</th><th scope="col">名前</th><th scope="col">値段</th><th scope="col">種類</th><th scope="col">説明</th>';
                echo '</tr>';
                echo '</thead>';
                foreach ($pdo->query('select * from product') as $row) {
                    echo '<tbody>';
                    echo '<tr>';
                    echo '<td>', $row['product_id'], '</td>';
                    echo '<td>', $row['product_name'], '</td>';
                    echo '<td>', $row['product_price'], '</td>';
                    echo '<td>', $row['product_genre'], '</td>';
                    echo '<td>', $row['product_description'], '</td>';
                    echo '</tr>';
                    echo "\n";
                }
                echo '</tbody>';
                echo '</table>';
                $_SESSION['admin'] = $_REQUEST['username'];
            } else {
                $alert = "<script type='text/javascript'>alert('ログイン名もしくはパスワードが間違っています');</script>";
                echo $alert;
                echo '<a href="login_mana.php">ログインに戻る</a>';
            }
            break;

        // ログアウト
        case 'logout':
            unset($_SESSION['admin']);
            break;
>>>>>>> Stashed changes
    }
}
?>

</div>

</body>
</html>
