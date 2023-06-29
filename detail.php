<?php require 'header_mana.php'; ?>

<div class="m-5">
    <?php
    $sql_detail=$pdo->prepare('select * from purchase_detail where purchase_id=?');
    $sql_detail->execute([$_REQUEST['id']]);
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<tr><th>商品</th><th>個数</th></tr>';
    echo '</tr>';
    echo '</thead>';
    foreach ($sql_detail as $row_detail) {
        $sql_a=$pdo->prepare('select * from product where product_id=?');
        $sql_a->execute([$row_detail['product_id']]);
        foreach ($sql_a as $row) {
            echo '<tr>';
            echo '<td>', $row['product_name'], '</td>';
            echo '<td>', $row_detail['count'], '</td>';
            echo '</tr>';
        }
    }
    echo '</table>';
    
    ?>
</div>