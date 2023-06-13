<?php // require 'server_connection.php'; ?>
<?php require 'header.php'; ?>

<!-- book section -->
<section class="book_section layout_padding">
<div class="container1 tinntinn">
    <div class="heading_container">
    <h2>
      RESERVE
    </h2>
    </div>
    <?php
    // フォームが送信された場合の処理
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 入力値を取得
        $reservation_date = $_POST['reservation_date'];
        $reservation_time = $_POST['reservation_time'];
        $reservation_seat = $_POST['reservation_seat'];

        // 予約番号を生成する関数
        function generateReservationNumber() {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            $reservation_number = '';

            // 5文字のランダムな文字列を生成
            for ($i = 0; $i < 5; $i++) {
                $reservation_number .= $characters[rand(0, strlen($characters) - 1)];
            }

            return $reservation_number;
        }

        // 予約番号を生成
        $reservation_number = generateReservationNumber();

        // データベースに予約情報を追加する処理を実行することができます

        // 以下は仮のメッセージの表示です
        echo "商品予約が完了しました。";
        echo "予約番号: " . $reservation_number;
    }
?>
<div class="col-md-12">
    <div class="form_container">
    <form method="POST">
        <!-- 予約フォームの入力項目を追加してください -->
        <div class="form-group">
            <label for="reservation_date">予約日</label>
            <input type="date" name="reservation_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="reservation_time">予約時間</label>
            <input type="time" name="reservation_time" class="form-control" required>
        </div>
        <div class="form-group">
            
        </div>
        
        <div class="btn_box">
            <button type="submit">予約する</button>
        </div>
    </form>
    </div>

    <div class="col-md-6">
        <div class="map_container ">
        <div id="googleMap"></div>
        </div>
    </div>
</div>
</section>

<?php require 'footer.php'; ?>

<!-- お客さんの予約したものの情報を店舗側に送るようにする　ログインした状態のとき
    必要なもの
    　予約番号
    　予約の日時
    　予約する商品
    　顧客情報
    　商品削除

    (お客さんが予約したものを店舗側で確認できるようにする) -->