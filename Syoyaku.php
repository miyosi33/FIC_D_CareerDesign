<?php require 'header.php'; ?>

<?php
// 予約が成功した場合の処理
echo"<br>";
echo"<br>";
echo "<div class='V'><p>予約が完了しました!</p>";
echo "<p>予約日時：" . $_REQUEST['reservation_date'] . "分です</p>";
echo "予約した商品はマイページから確認してください。";
echo $purchase_id;
?>

<section class="book_section">
    <div class="button form_container">
        <a href="index.php" class="btn_box">
            <button>Homeに戻る</button>
        </a>
    </div>
</section>

<?php require 'footer.php'; ?>
