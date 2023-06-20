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
	echo '<th scope="col">顧客ID</th><th scope="col">顧客の名前</th><th scope="col">顧客の情報</th><th scope="col">ログイン名</th><th scope="col">パスワード</th>';
    echo '</tr>';
    echo '</thead>';
    $pdo=new PDO('mysql:host=localhost;dbname=kadai;charset=utf8', 
    	'staff', 'password');
    foreach ($pdo->query('select * from customer') as $row) {
        echo '<tbody>';
    	echo '<tr>';
    	echo '<td>', $row['id'], '</td>';
    	echo '<td>', $row['name'], '</td>';
        echo '<td>', $row['address'], '</td>';
        echo '<td>', $row['login'], '</td>';
        echo '<td>', $row['password'], '</td>';
    	echo '</tr>';
    	echo "\n";
    }
    echo '</tbody>';
    echo '</table>';
    ?>
</table>
</div>

</body>
</html>
