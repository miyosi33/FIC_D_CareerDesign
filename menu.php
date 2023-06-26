<?php require 'header.php'; ?>

  <!-- food section -->

  <section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Menu
        </h2>
      </div>

      <ul class="filters_menu">
        <li class="active" data-filter="*">All</li>
        <li data-filter=".food">Food</li>
        <li data-filter=".ice_drink">Ice Drink</li>
        <li data-filter=".hot_drink">Hot Drink</li>
      </ul>

      <div class="filters-content">
        <div class="row grid">
            <!-- 1 item -->

          <?php
            foreach($pdo->query('select * from product') as $row){
              $id = $row['product_id'];
              echo '<div class="col-sm-6 col-lg-4 all ', $row['product_genre'], '">';
              echo '<div class="box">';
              echo '<div>';
              echo '<div class="img-box">';
              echo '<img src="product_images/', $row['product_genre'], '/', $row['image_path'], '">';
              echo '</div>';
              echo '<div class="detail-box">';
              echo '<h5>', $row['product_name'], '</h5>';
              echo '<p>', $row['product_description'], '</p>';
              echo '<div class="quanity-div">';
              echo '<form action="cart.php" class="quanity-form">';
              echo '<input type="hidden" name="command" value="cart">';
              echo '<input type="hidden" name="id" value="', $id, '">';
              echo '<input type="hidden" name="name" value="', $row['product_name'], '">';
              echo '<input type="hidden" name="price" value="', $row['product_price'], '">';
              echo '<label class="quanity-label">';
              echo '<input type="number" name="count" value=1 required>';
              echo '個</label>';
              echo '</div>';
              echo '<div class="options">';
              echo '<h6>';
              echo $row['product_price'], '円';
              echo '</h6>';
              echo '<a href="">';
              echo '<button type="submit" class="cart_input">';
              echo '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">';
              echo '<g>';
              echo '<g>';
              echo '<path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />';
              echo '</g>';
              echo '</g>';
              echo '<g>';
              echo '<g>';
              echo '<path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4C457.728,97.71,450.56,86.958,439.296,84.91z" />';
              echo '</g>';
              echo '</g>';
              echo '<g>';
              echo '<g>';
              echo '<path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />';
              echo '</g>';
              echo '</g>';
              echo '<g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>';
              echo '</svg>';
              echo '</button>';
              echo '</a>';
              echo '</form>';
              echo '</div></div></div></div></div>';
            }
          ?>
          <!-- 1 item end -->          
        </div>
      </div>
    </div>
  </section>

  <!-- end food section -->

<?php require 'footer.php'; ?>