<?php require 'header.php'; ?>

<section class="book_section layout_padding customer_section">
    <div class="container2">
        <div class="heading_container heading_center">

<?php
if (isset($_SESSION['customer'])) {
    // Assuming the database connection is established and stored in the $pdo variable

    $sql_purchase = $pdo->prepare('select * from purchase where customer_id=? order by id desc');
    $sql_purchase->execute([$_SESSION['customer']['id']]);

    if ($sql_purchase->rowCount() > 0) {
        foreach ($sql_purchase as $row_purchase) {
            $sql_detail = $pdo->prepare('SELECT * FROM purchase_detail JOIN product ON purchase_detail.product_id = product.product_id WHERE purchase_id=?');
            $sql_detail->execute([$row_purchase['id']]);

            echo '<table>';
            echo '<tr><th>商品番号</th><th>商品名</th><th>価格</th><th>個数</th><th>小計</th></tr>';
            $total = 0;
            foreach ($sql_detail as $row_detail) {
                echo '<tr>';
                echo '<td>', $row_detail['product_id'], '</td>';
                echo '<td>', $row_detail['product_name'],'</td>';
                echo '<td>', $row_detail['product_price'], '</td>';
                echo '<td>', $row_detail['count'], '</td>';
                $subtotal = $row_detail['product_price'] * $row_detail['count'];
                $total += $subtotal;
                echo "予約時刻：". $row['reservation_date'];
                echo '<td>', $subtotal, '</td>';
                echo '</tr>';
            }

            echo '<tr><td colspan="4">合計</td><td>', $total, '</td></tr>';
            echo '</table>';
            echo '<hr>';
        }
    } else {
        echo '予約履歴はありません。';
    }
}
?>

        </div>
    </div>
</section>

<?php require 'footer.php'; ?>
