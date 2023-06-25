<?php require 'header.php'; ?>

<section class="book_section layout_padding">
    <div class="heading_container">
        <h2>My cart</h2>
        <?php
        if (isset($_SESSION["customer"])) {

            $cartItems = $_SESSION["cart_items"];
            if (!empty($cartItems)) {
                echo "<div class='cart_items_container'>";
                foreach ($cartItems as $cartItem) {
                    echo "<div class='cart_item'>";
                    echo "<div class='cart_item_details'>";
                    echo "<h3>" . $cartItem['product_name'] . "</h3>";
                    echo "<p>Price: " . $cartItem['product_price'] . "円</p>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "<p>カートに商品がありません。</p>";
            }
        } else {
            echo "<div class='Y'><p>ログインしていません。<br>
                現在はログインしている方のみ予約できるようになっています。<br>会員登録無しでの予約につきましてはもうしばらくお待ちください。<br>
                下のボタンから会員登録、またはログインしてください</p></div>";
            echo "<div class='button2 form_container'>
                <a href='new.php'><button>
                    会員登録をする
                </button></a>
            </div>";
            echo "<div class='button2 form_container'>
                <a href='login.php'><button>
                    ログインする
                </button></a>
            </div>";
        }
        ?>
    </div>
    <?php if (isset($_SESSION["customer"])) : ?>
        <div class="col-md-6">
            <form action="Syoyaku.php" method="post">
                <div class="form-group">
                    <label for="reservation_date">予約日時:</label>
                    <input type="datetime-local" id="reservation_date" name="reservation_date" required>
                </div>
                <div class="form-group">
                    <label for="">予約する商品</label>
                    <!-- カート内の商品を選択するセレクトボックス -->
                    <select name="selected_product" id="selected_product" required>
                        <option value="" disabled selected>商品を選択してください</option>
                        <?php
                        foreach ($cartItems as $cartItem) {
                            echo "<option value='" . $cartItem['product_id'] . "'>" . $cartItem['product_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <buttton type="submit">予約する</button>
            </form>
        </div>
    <?php endif; ?>
</section>

<script>
    const reservationDateInput = document.getElementById('reservation_date');
    const reservationTimeStart = 6; // 平日の予約開始時間（時）
    const reservationTimeEnd = 18; // 平日の予約終了時間（時）
    const weekendReservationTimeStart = 7; // 土日祝の予約開始時間（時）
    const weekendReservationTimeEnd = 19; // 土日祝の予約終了時間（時）
    const reservationInterval = 15; // 予約時間帯の間隔（分）

    reservationDateInput.addEventListener('input', function() {
        const selectedDate = new Date(this.value);
        const dayOfWeek = selectedDate.getDay();
        const hour = selectedDate.getHours();
        const minutes = selectedDate.getMinutes();

        // 平日の予約時間帯制限
        if (dayOfWeek >= 1 && dayOfWeek <= 5) {
            if (hour < reservationTimeStart || hour > reservationTimeEnd) {
                this.setCustomValidity('予約は平日' + reservationTimeStart + ':00~' + reservationTimeEnd + ':00の間で行ってください');
            } else if (minutes % reservationInterval !== 0) {
                this.setCustomValidity('予約時間帯は' + reservationInterval + '分刻みで選択してください');
            } else {
                this.setCustomValidity('');
            }
        }
        // 土日祝の予約時間帯制限
        else if (dayOfWeek === 0 || dayOfWeek === 6) {
            if (hour < weekendReservationTimeStart || hour > weekendReservationTimeEnd) {
                this.setCustomValidity('予約は土日祝' + weekendReservationTimeStart + ':00~' + weekendReservationTimeEnd + ':00の間で行ってください');
            } else if (minutes % reservationInterval !== 0) {
                this.setCustomValidity('予約時間帯は' + reservationInterval + '分刻みで選択してください');
            } else {
                this.setCustomValidity('');
            }
        }
    });
</script>
<?php require 'footer.php'; ?>
