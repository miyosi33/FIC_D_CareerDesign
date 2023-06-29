<?php require "header.php"; ?>

<section class="book_section layout_padding">
  <div class="heading_container">
    <h2>座席予約</h2>
    <?php
    // ログイン状態の確認や他の必要な処理を追加する
    if (isset($_SESSION["customer"])) {
      // ログインしているので予約できる。 27行以降の処理をする
    } else {
      echo "<div class='Y'><p>ログインしていません。<br>
      現在はログインしている方のみ予約できるようになっています。<br>会員登録無しでの予約につきましてはもうしばらくお待ちください。<br>
      下のボタンから会員登録、またはログインしてください！</p></div>";
      echo '<div class="button2 form_container">';
      echo '<a href="login.php"><button class="gan">';
      echo 'ログインする';
      echo '</button></a>';
      echo '<a href="new.php"><button class="gan">';
      echo '会員登録をする';
      echo '</button></a>';
      echo '</div>';
    }
    ?>
  </div>
  <?php if (isset($_SESSION["customer"])) : ?>
    <div class="col-md-6 form_container">
      <div class="Y">
        <p>予約できる日時は平日6:00am～6:00pm,<br>土日祝7:00am～7:00pmで15分刻みとなります。<br>
            予約は1日前からとなっており、<br>当日予約は受け付けておりません。</p></div>
      <form action="reservation.php" method="post">
        <div class="form-group">
          <label for="reservation_date">予約日時:</label>
          <input type="datetime-local" id="reservation_date" name="reservation_date" required min="<?php echo date('Y-m-d\TH:i', strtotime('+1 days')); ?>">
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
  <?php endif; ?>
</section>

<!-- 予約日時のJavaScriptのコードを追加 -->
<script>
  const Date = document.getElementById("reservation_date");
  const TimeStart = 6; // 平日の予約開始時間（時）
  const TimeEnd = 18; // 平日の予約終了時間（時）
  const TimeStart2 = 7; // 土日祝の予約開始時間（時）
  const TimeEnd2 = 19; // 土日祝の予約終了時間（時）
  const Interval = 15; // 予約時間帯の間隔（分）

    Date.addEventListener("input", function() {
    const selectedDate = new Date(this.value);
    const dayOfWeek = selectedDate.getDay();
    const hour = selectedDate.getHours();
    const minutes = selectedDate.getMinutes();
      
    // 平日の予約時間帯制限
    if (dayOfWeek >= 1 && dayOfWeek <= 5) {
      if (hour < TimeStart || hour > TimeEnd) {
        this.setCustomValidity("予約は平日" + TimeStart + ":00~" + TimeEnd + ":00の間で行ってください");
      } else if (minutes % Interval !== 0) {
        this.setCustomValidity("予約時間帯は" + Interval + "分刻みで選択してください");
      } else {
        this.setCustomValidity("");
      }
    }
    // 土日祝の予約時間帯制限
    else if (dayOfWeek === 0 || dayOfWeek === 6) {
      if (hour < TimeStart2 || hour > TimeEnd2) {
        this.setCustomValidity("予約は土日祝" + TimeStart2 + ":00~" + TimeEnd2 + ":00の間で行ってください");
      } else if (minutes % Interval !== 0) {
        this.setCustomValidity("予約時間帯は" + Interval + "分刻みで選択してください");
      } else {
        this.setCustomValidity("");
      }
    }
  });
</script>

<?php require "footer1.php"; ?>