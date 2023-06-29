<?php require 'server_connection.php';?>
<?php require 'header_mana.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php

// 削除ボタンがクリックされた場合の処理
if (isset($_GET['delete'])) {
    $deleteId = $_GET['delete'];
    $sql = $pdo->prepare('delete from dm where dm_id = ?');
    $sql->execute([$deleteId]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $sql = $pdo->prepare('insert into dm (title, content, TimeStamp_id) values (?, ?, current_timestamp)');
    $sql->execute([$title, $content]);
}

?>
<div class="m-5">
    <?php 
    foreach ($pdo->query('SELECT * FROM dm ORDER BY dm_id DESC') as $row) {
        echo '<div>';
        echo '<h5>' . $row["title"] . '</h5>';
        echo '<p>' . $row["content"] . '</p>';
        echo '<p>' . date('Y-m-d H:i', strtotime($row["TimeStamp_id"])) . '</p>';
        echo '<a href="?delete=' . $row["dm_id"] . '">削除</a>';
        echo '</div>';
        echo '<hr>';
    }
    ?>

<form method="POST" action="">
        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">内容</label>
            <textarea class="form-control" id="content" name="content" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">追加</button>
    </form>
</div>


</body>
</html>
