<?php session_start(); ?>
<?php require 'header_mana.php'; ?>

<div class="m-5">

    
    <?php
    if (isset($_SESSION['admin'])) {
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">顧客ID</th><th scope="col">顧客の名前</th><th scope="col">顧客の情報</th><th scope="col">パスワード</th>';
        echo '</tr>';
        echo '</thead>';
        foreach ($pdo->query('select * from customer') as $row) {
            echo '<tbody>';
            echo '<tr>';
            echo '<td>', $row['id'], '</td>';
            echo '<td>', $row['name'], '</td>';
            echo '<td>', $row['address'], '</td>';
            echo '<td>', $row['password'], '</td>';
            echo '</tr>';
            echo "\n";
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<a href="login_mana.php">ログインに戻る</a>';
    }
    ?>
</table>
</div>

</body>
</html>
