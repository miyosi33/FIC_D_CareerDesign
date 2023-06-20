<?php require 'header1.php'; ?>
  <section class="book_section layout_padding">
    <div class="container1 tinntinn">
      <div class="heading_container">
        <h2>座席予約</h2>
        <?php
        // ログイン状態の確認や他の必要な処理を追加する
        ?>
      </div>
      <div class="col-md-6">
        <form action="reservation_process.php" method="post">
          <div class="form-group">
            <label for="reservation_date">予約日時:</label>
            <input type="datetime-local" id="reservation_date" name="reservation_date" required>
          </div>
          <div class="kintama">
          
          </div>
          <div class="form-group">
          <label for="seat_type">座席の種類:</label>
              <select id="seat_type" name="seat_type" required>
              <option value="1人席">1人席</option>
              <option value="2人席">2人席</option>
              <option value="4人席">4人席</option>
              </select>
          </div>
          <button type="submit">予約する</button>
        </form>
      </div>
    </div>
  </section>
  <!-- 他の必要なHTMLやJavaScriptのコードを追加 -->
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
  <?php require 'footer1.php'; ?>