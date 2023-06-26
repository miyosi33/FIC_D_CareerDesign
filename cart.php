<?php require 'header.php'; ?>

<section class="book_section layout_padding">
<div class="heading_container">
    <h2>Cart</h2>
    <?php
        if (!empty($_SESSION['product'])) {
          echo '<table>';
          foreach ($_SESSION['product'] as $id=>$product) {
            echo '<form action="cart.php" method="post">';
            echo '<input type="hidden" name="command" value="cart_delete">';
            echo '<input type="hidden" name="id" value="', $id, '">';
            echo '<tr>';
            echo '<td>', $product['name'], '</td>';
            echo '<td>', $product['price'], '</td>';
            echo '<td>', $product['count'], '</td>';
            echo '<td><button type="submit">カートから削除</button></td>';
            echo '</tr>';
            echo '</form>';
          }
          echo '</table>';
          if (isset($_SESSION['customer'])) {
            echo '<div class="col-md-6 form_container">';
            echo '<form action="Syoyaku.php" method="post">';
            echo '<div class="form-group">';
            echo '<label for="reservation_date">予約日時:</label>';
            echo '<input type="datetime-local" id="reservation_date" name="reservation_date" required>';
            echo '</div>';
            echo '<buttton type="submit">予約する</button>';
            echo '</form>';
            echo '</div>';
          } else {
            echo '<div class="col-md-6">';
            echo '<p>予約するにはログインする必要があります</p>';
            echo '<div class="button2 form_container">';
            echo '<a href="login.php"><button class="gan">';
            echo 'ログインする';
            echo '</button></a>';
            echo '<a href="new.php"><button class="gan">';
            echo '会員登録をする';
            echo '</button></a>';
            echo '</div>';
            echo '</div>';

          }
        } else {
          echo 'カートに商品がありません';
        }
    ?>   
</div>
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

<!-- お客さんの予約したものの情報を店舗側に送るようにする　ログインした状態のとき
予約した商品の一覧の表示(個数)

    (お客さんが予約したものを店舗側で確認できるようにする) -->



