<?php require 'header.php'; ?>

<!-- アカウント情報 -->
<section class="book_section layout_padding customer_section">
    <div class="container2">
        <div class="col-md-12">
            <?php
            $dmList = $pdo->query('SELECT * FROM dm ORDER BY dm_id DESC')->fetchAll();
            foreach ($dmList as $row) {
                echo '<div class="accordion" id="accordionExample">';
                echo '<div class="accordion-item">';
                echo '<h3 class="accordion-header" id="heading' . $row["dm_id"] . '">';
                echo '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $row["dm_id"] . '" aria-expanded="false" aria-controls="collapse' . $row["dm_id"] . '">';
                echo 'タイトル名: ' . $row["title"].'<br>日時:'.date('Y-m-d H:i', strtotime($row["TimeStamp_id"]));
                echo '</button>';
                echo '</h3>';
                echo '<div id="collapse' . $row["dm_id"] . '" class="accordion-collapse collapse" aria-labelledby="heading' . $row["dm_id"] . '" data-bs-parent="#accordionExample">';
                echo '<div class="accordion-body">';
                echo '内容: ' . $row["content"] . '<br>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo "<br>";
            }
            ?>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>
