<?php require 'header.php'; ?>

<section class="book_section layout_padding">
<div class="container1 tinntinn">
  <div class="heading_container">
    <h2>
        Change password
    </h2>
    <h6>
      パスワード変更
    </h6>
  </div>
    
  <div class="col-md-12">
    <div class="form_container">
      <form action="account.php" method="post">
        <input type="hidden" name="command" value="password">
        <div class="font-unset">
          <div>
            <input type="password" class="form-control" placeholder="Password" name="password" required/>
          </div>
          <div>
            <input type="password" class="form-control" placeholder="New password" name="new_password" required/>
          </div>
          <div>
            <input type="password" class="form-control" placeholder="Confirm new password" name="confirm_new_password" required/>
          </div>
        </div>

        <div class="form_container">
          <div class="btn_box">
            <button>
              <input type="submit" value="変更">
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</section>

<?php require 'footer.php'; ?>