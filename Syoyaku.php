<?php require 'header.php'; ?>

<section class="book_section layout_padding customer_section">
    <div class="container">
        <div class="heading_container V">
            <h2>予約が完了しました！</h2>
            <?php
            echo '<p>予約日時：', $_REQUEST['reservation_date'], '</p>';
            ?>
            <p>予約履歴はアカウントページからご確認ください</p>
            <div class="button form_container">
                <a href="index.php" class="btn_box">
                    <button>Home</button>
                </a>
            </div>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>