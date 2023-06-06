<?php // require 'server_connection.php'; ?>
<?php require 'header.php'; ?>
<!-- book section -->
<section class="book_section layout_padding">
<div class="container1 tinntinn">
    <div class="heading_container">
    <h2>
        New
    </h2>
    </div>

    
    <div class="col-md-12">

        <d class="form_container">
        <form action="login.php" method="post">
            <div>
            <input type="text" class="form-control" placeholder="Your Name" name="login"/>
            </div>
            <div>
            <input type="password" class="form-control" placeholder="Password" name="password"/>
            </div>
            <div>
            <input type="password" class="form-control" placeholder="Password" name="password"/>
            </div>
            <div>
              <input type="tel" class="form-control" placeholder="Phone Number" name="phone_number"/>
            </div>
        </form>
    
        <div class="col-md-12">
          
          <div class="form_container">
            <div class="btn_box">
              <a href="login.php">
                <button>
                  Regist
                </button>
              </a>
            </div>
          </div>

        </div>
    
</section>
<!-- end book section -->

<?php require 'footer.php'; ?>