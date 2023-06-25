<?php require 'header.php'; ?>

<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted form data
    $reservationDate = $_POST['reservation_date'];
    $seatType = $_POST['seat_type'];

    // Database connection parameters
    $host = 'your_host';
    $database = 'your_database';
    $username = 'your_username';
    $password = 'your_password';

    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);

    // Prepare the SQL statement
    $stmt = $pdo->prepare("INSERT INTO reservations (reservation_date, seat_type) VALUES (?, ?)");

    // Execute the SQL statement with the form data
    $stmt->execute([$reservationDate, $seatType]);

    // Check if the reservation was successfully inserted
    if ($stmt->rowCount() > 0) {
        echo "<br><br>";
        echo "<div class='V'><p>予約が完了しました!</p>";
        echo "<p>予約日時：" . $reservationDate . "分です</p>";
        echo "<p>選択した座席：" . $seatType . "になります。</p></div>";
    } else {
        echo "<br><br>";
        echo "<div class='X'><p>予約の保存中にエラーが発生しました。</p></div>";
    }
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
