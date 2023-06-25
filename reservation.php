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
