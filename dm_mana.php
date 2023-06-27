<?php require 'server_connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $sql = $pdo->prepare('INSERT INTO dm (title, content) VALUES (?, ?)');
    $sql->execute([$title, $content]);
}
?>
<div class="m-5">
    <?php 
    foreach( $pdo->query('select * from dm') as $row){
        echo "タイトル名:".$row["title"]."<br>";
        echo "内容:".$row["content"]."<br>";
        echo "<hr>";
    }
    ?>
    <br>
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
    <i class="fa-thin fa-envelope"></i>
</div>

</body>
</html>
