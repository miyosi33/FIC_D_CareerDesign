<?php require 'header.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームから送信されたデータを取得
    $reservationDate = $_POST['reservation_date'];
    $seatType = $_POST['seat_type'];

    // データベースに座席予約情報を保存する処理
    $servername = "localhost";
    $username = "staff";
    $password = "password";
    $dbname = "kadai";

    // データベースに接続
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("データベースへの接続に失敗しました: " . $conn->connect_error);
    }

    // 会員名を取得するクエリを実行
    $customerId = 1;  // 会員のIDを指定する（ここでは仮に1としています）
    $customerQuery = "SELECT name FROM customer WHERE id = $customerId";
    $customerResult = $conn->query($customerQuery);
    if ($customerResult->num_rows > 0) {
        $customerRow = $customerResult->fetch_assoc();
        $customerName = $customerRow["name"];
    } else {
        $customerName = "不明な会員";
    }

    // 予約情報をデータベースに挿入するクエリを実行
    $insertQuery = "INSERT INTO seat_reservation (reservation_date, seat_type, seat_count, customer_id) VALUES ('$reservationDate', '$seatType', 1, $customerId)";
    if ($conn->query($insertQuery) === TRUE) {
        // 予約が成功した場合の処理
        echo "<div class='V'><p>予約が完了しました!</p>";
        echo "<p>予約日時：" . $reservationDate . "です</p>";
        echo "<p>選択した座席：" . $seatType . "になります。</p>";
        echo "<p>会員名：" . $customerName . "</p></div>";
    } else {
        echo "予約の保存中にエラーが発生しました: " . $conn->error;
    }

    // データベース接続を閉じる
    $conn->close();
}

?>

<?php require 'footer.php'; ?>

データベースに座席予約情報を保存する処理とデータの挿入処理を追加
echoの部分で予約した会員の名前を表示