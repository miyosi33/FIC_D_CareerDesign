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
            <label for="reservation_date">予約日時:</label>
            <input type="datetime-local" id="reservation_date" name="reservation_date" required>
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
  <?php require 'footer.php'; ?>
