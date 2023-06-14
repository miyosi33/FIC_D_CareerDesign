<?php require 'header.php'; ?>
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
            <label for="reservation_date">予約日付:</label>
            <input type="date" id="reservation_date" name="reservation_date" required>
          </div>
          <div class="form-group">
            <label for="reservation_time">予約時間:</label>
            <select id="reservation_time" name="reservation_time" required>
              <?php
                $count = 0;
                for ($hour = 6; $hour <= 18; $hour++) {
                  for ($minute = 0; $minute <= 45; $minute += 15) {
                    $formattedHour = str_pad($hour, 2, "0", STR_PAD_LEFT);
                    $formattedMinute = str_pad($minute, 2, "0", STR_PAD_LEFT);
                    $displayTime = $formattedHour . ':' . $formattedMinute;
                    echo '<option value="' . $displayTime . '">' . $displayTime . '</option>';
                    $count++;
                    if ($count % 6 === 0) {
                      echo '</optgroup><optgroup>';
                    }
                  }
                }
              ?>
            </select>
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
    const reservationTimeSelect = document.getElementById('reservation_time');

    // 分の選択肢を制限する
    reservationTimeSelect.addEventListener('change', function() {
      const selectedMinute = parseInt(this.value.split(':')[1]);
      const minuteOptions = Array.from(this.querySelectorAll('option'));

      minuteOptions.forEach(option => {
        const optionValue = parseInt(option.value.split(':')[1]);
        if (![0, , 30].includes(optionValue)) {
          option.style.display = 'none';
        } else {
          option.style.display = '';
        }
      });
    });
  </script>
  <?php require 'footer.php'; ?>
