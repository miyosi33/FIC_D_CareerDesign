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
                    echo '<td><input type="text" name="address" value="', $_SESSION['customer']['address'], '"></td>';
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
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>