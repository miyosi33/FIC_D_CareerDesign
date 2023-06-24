<?php require 'header.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームから送信されたデータを取得
    $reservationDate = $_POST['reservation_date'];
    $seatType = $_POST['seat_type'];

    // データベースに座席予約情報を保存する処理を追加する
    // ここにデータベースへのデータ挿入処理を追加します

    // 予約が成功した場合の処理
    echo"<br>";
    echo"<br>";
    echo "<div class='V'><p>予約が完了しました!</p>";
    echo "<p>予約日時：" . $reservationDate . "分です</p>";
    echo "<p>選択した座席：" . $seatType . "になります。</p></div>";

    // 予約した顧客の情報を取得
    if (isset($_SESSION['customer_id'])) {
        $customerId = $_SESSION['customer_id'];
        // 顧客情報をデータベースから取得する処理を追加する
        // $conn はデータベース接続オブジェクトとして仮定します
        $sql = "SELECT name FROM customer WHERE id = $customerId";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $customerName = $row['name'];
            echo "予約した名前：" . $customer . "<br>";
        }
    } 
}
?>
<div class="button form_container">
    <a href="index.php" class="btn_box">
        <button style="margin-top: 15px;border: none;text-transform: uppercase;display: inline-block;padding: 10px 55px;background-color: #ffbe33;color: #ffffff;border-radius: 45px;-webkit-transition: all 0.3s;transition: all 0.3s;border: none;">Homeに戻る</button>
    </a>
</div>

<?php require 'footer.php'; ?>
