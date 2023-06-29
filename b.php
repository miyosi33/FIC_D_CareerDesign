<?php
$nextDay = date('Y-m-d', strtotime('+1 day'));
$nextDayTime = date('H:i', strtotime('+1 day'));
echo '<div class="form-group">';
                echo '<label for="reservation_date">予約日時:</label>';
                echo '<input type="datetime-local" id="reservation_date" name="reservation_date" required $nextDay.'T'.$nextDayTime;>';
                echo '</div>';
                ?>

<?php



<?php
$nextDay = date('Y-m-d', strtotime('+1 day'));
$nextDayTime = date('H:i', strtotime('+1 day'));
?>

<?php echo '<div class="form-group">'; ?>
  <?php echo '<label for="reservation_date">予約日時:</label>'; ?>
  <?php echo '<input type="datetime-local" id="reservation_date" name="reservation_date" required min="' . $nextDay . 'T' . $nextDayTime . '">'; ?>
<?php echo '</div>'; ?>
