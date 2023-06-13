<?php require 'header.php'; ?>

<section class="book_section layout_padding">
    <div class="container1 tinntinn">
        <div class="heading_container">
            <h2>座席予約</h2>
        </div>
        
        <?php
        // 座席予約の設定
        // -- 予約人数
        // -- 予約日時（予約時間は平日6:00～18:00,土日祝7:00~19:00
        // -- 予約する商品
        // -- 座席は１人席５つ、２人席３つ、４人席4つ
        // -- 予約するユーザーID
        // -- 予約番号（重複はしてはいけない）

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
            echo "座席予約が完了しました。";
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
                        <select name="reservation_time" class="form-control" required>
                            <?php
                            // 予約可能な時間帯を生成（15分刻み）
                            $start_time = strtotime('6:00');
                            $end_time = strtotime('19:00');
                            $interval = 15 * 60; // 15分を秒に変換
                            for ($time = $start_time; $time <= $end_time; $time += $interval) {
                                $formatted_time = date('H:i', $time);
                                echo "<option value=\"$formatted_time\">$formatted_time</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="reservation_seat">予約座席</label>
                        <select name="reservation_seat" class="form-control" required>
                            <option value="1">1人席</option>
                            <option value="2">2人席</option>
                            <option value="4">4人席</option>
                        </select>
                    </div>
                    
                    <div class="btn_box">
                        <button type="submit">予約する</button>
                    </div>
                </form>
            </div>
    
            <div class="col-md-6">
            </div>
        </div>
    </div>
</section>
予約時間は平日（月曜日～金曜日）は6:00～18:00,土曜日と日曜日7:00~19:00の間にしたい

<?php require 'footer.php'; ?>
