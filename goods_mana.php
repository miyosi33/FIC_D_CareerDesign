<?php require 'header_mana.php'; ?>

<div class="m-5">
    <?php
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
    	echo '<th scope="col">予約ID</th><th scope="col">顧客ID</th><th scope="col">予約日時</th>';
        echo '</tr>';
        echo '</thead>';
        if (isset($_REQUEST['keyword'])) {
            $sql=$pdo->prepare('select * from purchase where name like ?');
            $sql->execute(['%'.$_REQUEST['keyword'].'%']);
        } else {
            $sql=$pdo->prepare('select * from purchase');
            $sql->execute([]);
        }
        foreach ($pdo->query('select * from purchase') as $row) {
            $id=$row['id'];
            echo '<tbody>';
        	echo '<tr>';
        	echo '<td>';
            echo '<a href="detail.php?id=', $id, '">', $row['id'], '</a>';
            echo '</td>';
        	echo '<td>', $row['customer_id'], '</td>';
            echo '<td>', $row['reservation_date'], '</td>';
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