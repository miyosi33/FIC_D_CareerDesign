<?php require 'header.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームから送信されたデータを取得
    $reservationDate = $_POST['reservation_date'];
    $product_id = $_POST['product_id'];

    // データベースに座席予約情報を保存する処理を追加する
    // ここにデータベースへのデータ挿入処理を追加します
    $pdo = new PDO('mysql:host=localhost;dbname=kadai;charset=utf8', 'staff', 'password');

    $sql = $pdo->prepare("INSERT INTO seat_reservation (reservation_date, product_id, customer_id) VALUES (?, ?, ?)");

    // 予約が成功した場合の処理
    echo"<br>";
    echo"<br>";
    echo "<div class='V'><p>予約が完了しました!</p>";
    echo "<p>予約日時：" . $reservationDate . "分です</p>";
    echo "予約した商品はマイページから確認してください。"
    echo $product_id;

}
?>

<section class="book_section">
    <div class="button form_container">
        <a href="index.php" class="btn_box">
            <button>Homeに戻る</button>
        </a>
    </div>
</section>

<?php require 'footer.php'; ?>
