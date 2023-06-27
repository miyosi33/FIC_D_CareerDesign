<?php require 'header.php'; ?>

<!-- アカウント情報 -->
<section class="book_section layout_padding customer_section">
    <div class="container2">
        <div class="col-md-12">
        <?php 
    foreach( $pdo->query('select * from dm') as $row){
        echo "タイトル名:".$row["title"]."<br>";
        echo "内容:".$row["content"]."<br>";
        echo "<hr>";
    }
    ?>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>