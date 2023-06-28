<?php require 'header_mana.php'; ?>

<div class="m-5">

    <?php
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
	echo '<th scope="col">予約番号</th><th scope="col">日時</th><th scope="col">予約席</th><th scope="col">顧客ID</th>';
    echo '</tr>';
    echo '</thead>';
    foreach ($pdo->query('select * from seat_reservation') as $row) {
        echo '<tbody>';
    	echo '<tr>';
    	echo '<td>', $row['reservation_id'], '</td>';
    	echo '<td>', $row['reservation_date'], '</td>';
        echo '<td>', $row['seat_type'], '</td>';
        echo '<td>', $row['customer_id'], '</td>';
    	echo '</tr>';
    	echo "\n";
    }
    echo '</tbody>';
    echo '</table>';
    ?>
</table>
</div>

</body>
</html>
