<?php require 'header.php'; ?>

</div>
  </div>
  <div class="hero_area">
    <div class="bg-box">
      <!--トップページの写真-->
      <img src="Shitamichi_images/Coffee-and-Pastries.jpg" alt="">
    </div>
    <!-- header section strats -->
    
    <!-- end header section -->
    
    <!-- slider section -->
    <section class="slider_section ">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h1 class="slider-title">
                      Shitamichi's bakery
                    </h1>
                    <p>
                      思わず笑顔になるおいしいコーヒーを提供しています。<br>クッキーやクロワッサン、タルトやケーキなどのお菓子と一緒にいかがでしょうか。
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h1 class="slider-title">
                      おすすめはタルト！
                    </h1>
                    <p>
                      当店のおすすめの商品はタルトです！<br>店長のこだわりのタルトは思わず笑顔になるおいしい仕上がりとなっています！
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h1 class="slider-title">
                      ～予約について～
                    </h1>
                    <p>
                      予約は座席のみ、商品のみとそれぞれ可能です。<br>座席は１人席、２人席、４人席　から選択できます。<br>予約時間は平日と土日祝で多少時間が異なります。ご了承ください。
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <ol class="carousel-indicators">
            <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
            <li data-target="#customCarousel1" data-slide-to="1"></li>
            <li data-target="#customCarousel1" data-slide-to="2"></li>
          </ol>
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>

  <!-- food section -->

  <section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Recommended menu  
        </h2>
        <h6>
          おすすめ メニュー
        </h6>
      </div>

      <div class="filters-content">
        <div class="row grid">

          <!-- 1 item -->

          <?php
            foreach($pdo->query('select * from product') as $row){
              if($row['is_featured'] == '1'){
                $id = $row['product_id'];
                echo '<div class="col-sm-6 col-lg-4 all ', $row['product_genre'], '">';
                echo '<div class="box">';
                echo '<div>';
                echo '<div class="img-box">';
                echo '<img src="product_images/', $row['product_genre'], '/', $row['image_path'], '" alt="">';
                echo '</div>';
                echo '<div class="detail-box">';
                echo '<h5>';
                echo $row['product_name'];
                echo '</h5>';
                echo '<p>';
                echo $row['product_description'];
                echo '</p>';
                echo '<div class="options">';
                echo '<h6>';
                echo $row['product_price'],'円';
                echo '</h6>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
              }
            }
          ?>

          <!-- 1 item end -->
      </div>
    </div>
    <div class="btn-box">
      <a href="menu.php">
        もっと見る
      </a>
    </div>
  </section>

  <!-- end food section -->


<?php require 'footer.php'; ?>