<?php require 'header.php'; ?>

<!-- アカウント情報 -->
<section class="book_section layout_padding customer_section">
    <div class="container2">
        <div class="heading_container heading_center">
            <?php
            echo '<h2>', $_SESSION['customer']['name'],'</h2>';
            ?>
        </div>
        <div class="col-md-12">
            <div class="form_container">
                <form action="account.php" method="post">
                    <input type="hidden" name="command" value="address">
                    <?php
                    $passAst = strlen($_SESSION['customer']['password']);
                    echo '<input type="hidden" name="name" value="', $_SESSION['customer']['name'], '">';
                    echo '<input type="hidden" name="password" value="', $_SESSION['customer']['password'], '">';
                    echo '<table>';
                    echo '<tr><td><label>Phone number</label></td>';
                    echo '<td><input type="text" name="address" value="', $_SESSION['customer']['address'], '" required></td>';
                    echo '<td><button type="submit">変更</button></td></tr>';
                    echo '<tr><td><label>Password</label></td>';
                    echo '<td>';
                    for ($i=0; $i<$passAst; $i++) {
                        echo '*';
                    }
                    echo '</td>';
                    echo '<td><a href="change_pass.php"><button type="button" onclick="location.href=\'change_pass.php\'">変更</button></a></td></tr>';
                    echo '</table>';
                    ?>
                </form>
            </div>
            <div class="form_container">
                <form action="login.php" method="post">
                    <input type="hidden" name="command" value="logout">
                    <div class="btn_box tinko">
                        <button><input type="submit" value="LOGOUT"></button>
                    </div>
                </form>
            </div>
            <div class="history">
                    <div class="seat_history history_div">
                        <div class="heading_container heading_center">
                            <h3>座席予約履歴</h3>
                        </div>
                        <div class="accordion" id="accordionExample">
                        <?php
                        $sql=$pdo->prepare('select * from seat_reservation where customer_id=?');
                        $sql->execute([$_SESSION['customer']['id']]);
                        $count=0;
                        foreach ($sql as $row) {
                            $count=$count+1;
                            echo '<div class="accordion-item">';
                            echo '<h2 class="accordion-header" id="heading', $count, '">';
                            echo '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"';
                            echo 'data-bs-target="#collapse', $count, '" aria-expanded="false" aria-controls="collapse', $count, '">';
                            echo $row['reservation_date'];
                            echo '</button>';
                            echo '</h2>';
                            echo '<div id="collapse', $count, '" class="accordion-collapse collapse" aria-labelledby="headingOne"';
                            echo 'data-bs-parent="#accordionExample">';
                            echo '<div class="accordion-body">';
                            echo $row['seat_type'];
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        if ($count == 0) {
                            echo '<p>座席の予約履歴はありません</p>';
                        }
                        ?>
                        </div>
                    </div>
                    <div class="product_history history_div">
                        <div class="heading_container heading_center">
                            <h3>商品予約履歴</h3>
                        </div>
                        <div class="accordion" id="accordionExample">
                        <?php
                        $tmp=$count;
                        $sql_purchase=$pdo->prepare('select * from purchase where customer_id=?');
                        $sql_purchase->execute([$_SESSION['customer']['id']]);
                        foreach ($sql_purchase as $row_purchase) {
                            $count=$count+1;
                            echo '<div class="accordion-item">';
                            echo '<h2 class="accordion-header" id="heading', $count, '">';
                            echo '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"';
                            echo 'data-bs-target="#collapse', $count, '" aria-expanded="false" aria-controls="collapse', $count, '">';
                            echo $row_purchase['reservation_date'];
                            echo '</button>';
                            echo '</h2>';
                            echo '<div id="collapse', $count, '" class="accordion-collapse collapse" aria-labelledby="heading', $count, '"';
                            echo 'data-bs-parent="#accordionExample">';
                            echo '<div class="accordion-body">';
                            echo '<table>';
                            $sql_detail=$pdo->prepare('select * from purchase_detail where purchase_id=?');
                            $sql_detail->execute([$row_purchase['id']]);
                            foreach ($sql_detail as $row_detail) {
                                $sql_last=$pdo->prepare('select * from product where product_id=?');
                                $sql_last->execute([$row_detail['product_id']]);
                                foreach ($sql_last as $row) {
                                    echo '<tr>';
                                    echo '<td>', $row['product_name'], '</td>';
                                    echo '<td>', $row_detail['count'], '</td>';
                                    echo '</tr>';
                                }    
                            }
                            echo '</table>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        if ($count == $tmp) {
                            echo '<p>商品の予約履歴はありません</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>