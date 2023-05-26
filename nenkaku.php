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
    <div class="col-md-12">

        <div class="form_container">
        <form action="">
            <div>
            <input type="text" class="form-control" placeholder="Your Name" />
            </div>
            <div>
            <input type="text" class="form-control" placeholder="Tel" />
            </div>
            <div>
            <input type="text" class="form-control" placeholder="Email" />
            </div>
            <div class="btn_box">
            <button>
                RESERVE
            </button>
            </div>
        </form>
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