<?php // require 'server_connection.php'; ?>
<?php require 'header.php'; ?>

<!-- book section -->
<section class="book_section layout_padding">
<div class="container1 tinntinn">
    <div class="heading_container">
    <h2>
      RESERVE
    </h2>
    </div>
    <div class="col-md-6">
        <div class="map_container ">
        <div id="googleMap"></div>
        </div>
    </div>
</div>
</section>

<!-- end book section -->

<?php require 'footer.php'; ?>

<!-- お客さんの予約したものの情報を店舗側に送るようにする　ログインした状態のとき
    必要なもの
    　予約番号
    　予約の日時
    　予約する商品
    　顧客情報
    　商品削除

    (お客さんが予約したものを店舗側で確認できるようにする) -->