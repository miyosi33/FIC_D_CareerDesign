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
    <div class="form_container">
      <form action="login.php" method="post">
        <input type="hidden" name="command" value="regist">
        <div>
          <input type="text" class="form-control" placeholder="Login Name" name="name"/>
        </div>
        <div>
          <input type="tel" class="form-control" placeholder="Phone Number" name="phone_number"/>
        </div>
        <div>
          <input type="password" class="form-control" placeholder="Password" name="password"/>
        </div>
        <div>
          <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password"/>
        </div>
        

        <div class="form_container">
          <div class="btn_box">
            <button>
              <input type="submit" value="REGIST">
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</section>
<!-- end book section -->

<?php require 'footer.php'; ?>