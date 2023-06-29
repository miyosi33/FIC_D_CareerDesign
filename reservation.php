<?php require 'header.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $reservationDate = $_POST['reservation_date'];
    $seatType = $_POST['seat_type'];
    $sql = $pdo->prepare("insert into seat_reservation (reservation_date, seat_type, customer_id) values (?, ?, ?)");
    // ログインしている顧客のIDを取得する
    $customerId = $_SESSION['customer']['id'];

    $sql->execute([$reservationDate, $seatType, $customerId]);
        echo "<br><br>";
        echo "<div class='V'><p>予約が完了しました!</p>";
        echo "<p>予約日時：" . $reservationDate . "です</p>";
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
