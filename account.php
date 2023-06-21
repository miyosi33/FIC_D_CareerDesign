<?php require 'server_connection.php'; ?>
<?php require 'header.php'; ?>

<!-- アカウント情報 -->
<?php
echo '<p style="font-size: 100px">アカウント情報表示</p>';
?>

<form action="login.php" method="post">
    <input type="hidden" name="command" value="logout">
    <input type="submit" value="ログアウト（仮）">
</form>

<?php require 'footer.php'; ?>