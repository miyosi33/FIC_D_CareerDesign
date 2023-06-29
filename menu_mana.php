<?php require 'header_mana.php'; ?>

<div class="m-5">

    
    <?php
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
	echo '<th scope="col">ID</th><th scope="col">名前</th><th scope="col">値段</th><th scope="col">種類</th><th scope="col">説明</th><th scope="col">お勧め</th>';
    echo '</tr>';
    echo '</thead>';
    foreach ($pdo->query('select * from product') as $row) {
        echo '<tbody>';
    	echo '<tr>';
    	echo '<td>', $row['product_id'], '</td>';
    	echo '<td>', $row['product_name'], '</td>';
        echo '<td>', $row['product_price'], '</td>';
        echo '<td>', $row['product_genre'], '</td>';
        echo '<td>', $row['product_description'], '</td>';
        echo '<td>', $row['is_featured'], '</td>';
    	echo '</tr>';
    	echo "\n";
    }
    echo '</tbody>';
    echo '</table>';
    ?>

</div>

</body>
</html>
