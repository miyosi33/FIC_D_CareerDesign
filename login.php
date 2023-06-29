<?php require 'header.php'; ?>


<section class="book_section layout_padding">
<div class="container1 tinntinn">
    <div class="heading_container">
    <h2>
      Login
    </h2>
    <h6>
      ログイン
    </h6>
    </div>
    <div class="col-md-12">

        <div class="form_container">
          <form action="index.php" method="post">
            <input type="hidden" name="command" value="login">
            <div class="font-unset">
              <div>
                <input type="text" class="form-control" placeholder="Your Name" name="name" required/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password" required/>
              </div>
            </div>
            <a class="btn_box">
              <button><input type="submit" value="ログイン"></button>
            </a>
          </form>
        </div>
        <div class="heading_container chinchin">
          <h2>
            Register now
          </h2>
          <h6>
            新規会員登録
          </h6>
        </div>
          <div class="col-md-12">
            <div class="form_container">
              <div class="btn_box">
                <a href="new.php">
                  <button>
                    会員登録
                  </button>
                </a>
              </div>
            </div>

          </div>
</div>
</section>

<?php require 'footer.php'; ?>