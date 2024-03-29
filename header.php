<?php session_start(); ?>
<?php error_reporting(0); ?>
<?php 
require 'server_connection.php'; 
// ログイン、ログアウト、新規会員登録の遷移されてきたか
if (isset($_REQUEST['command'])) {
  switch ($_REQUEST['command']) {
    // ログイン
    case 'login':
      unset($_SESSION['customer']);
      $sql=$pdo->prepare('select * from customer where name=? and password=?');
      $sql->execute([$_REQUEST['name'], hash('sha256', $_REQUEST['password'])]);
      foreach($sql as $row){
        $_SESSION['customer']=[
            'id'        => $row['id'],
            'name'      => $row['name'],
            'password'  => $row['password'],
            'address'   => $row['address']
        ];
      }
      if (!isset($_SESSION['customer'])) {
        $alert = "<script type='text/javascript'>alert('ログイン名もしくはパスワードが間違っています');</script>";
        echo $alert;
      }
      break;
    
    // ログアウト
    case 'logout':
      unset($_SESSION['customer']);
      break;

    // 新規会員登録
    case 'regist':
      if ($_REQUEST['password'] != $_REQUEST['confirm_password']) {
        $alert = "<script type='text/javascript'>alert('入力されたパスワードが一致しません');</script>";
        echo $alert;
        break;
      }
      // ログイン名の重複確認
      $sql=$pdo->prepare('select * from customer where name=?');
      $sql->execute([htmlspecialchars($_REQUEST['name'])]);
      if (empty($sql->fetchAll())) {
        // 会員情報を新規登録する
        $sql=$pdo->prepare('insert into customer values(null,?,?,?)');
        $sql->execute([
          htmlspecialchars($_REQUEST['name']),
          htmlspecialchars($_REQUEST['phone_number']),
          hash('sha256', $_REQUEST['password'])
        ]);
        break;
      } else {
        $alert = "<script type='text/javascript'>alert('使用済みのログイン名です');</script>";
        echo $alert;
      }
      break;

    // 電話番号変更
    case 'address':
      $id = $_SESSION['customer']['id'];
      $sql=$pdo->prepare('update customer set address=? where id=?');
      $sql->execute([$_REQUEST['address'], $id]);
      $_SESSION['customer']=[
        'id'      =>$id,
        'name'    =>htmlspecialchars($_REQUEST['name']),
        'password'=>hash('sha256', $_REQUEST['password']),
        'address' =>htmlspecialchars($_REQUEST['address']),
      ];
      break;

    // パスワード変更
    case 'password':
      $flag = 1;
      $id = $_SESSION['customer']['id'];
      $sql=$pdo->prepare('select * from customer where id=?');
      $sql->execute([$id]);
      foreach ($sql as $row) {
        if ($row['password'] != hash('sha256', $_REQUEST['password'])) {
          $alert = "<script type='text/javascript'>alert('パスワードが間違っています');</script>";
          echo $alert;
          $flag = 0;
        }
      }
      if ($flag) {
        if ($_REQUEST['new_password'] != $_REQUEST['confirm_new_password']) {
          $alert = "<script type='text/javascript'>alert('入力されたパスワードが一致しません');</script>";
          echo $alert;
          break;
        }
        $name = $_SESSION['customer']['name'];
        $address = $_SESSION['customer']['address'];
        $sql=$pdo->prepare('update customer set password=? where id=?');
        $sql->execute([hash('sha256', $_REQUEST['new_password']), $id]);
        $_SESSION['customer']=[
          'id'      =>$id,
          'name'    =>$name,
          'password'=>hash('sha256', $_REQUEST['new_password']),
          'address' =>$address
        ];
        break;
      }
      break;

    // カート
    case 'cart':
      $id = $_REQUEST['id'];
      if (!isset($_SESSION['product'])) {
        $_SESSION['product']=[];
      }
      $count=0;
      if (isset($_SESSION['product'][$id])) {
        $count=$_SESSION['product'][$id]['count'];
      }
      $count=$count+$_REQUEST['count'];
      if ($count > 99) {
        $count=99;
      }
      $_SESSION['product'][$id]=[
        'name' => $_REQUEST['name'],
        'price'=> $_REQUEST['price'],
        'count'=> $count
      ];
      $alert = "<script type='text/javascript'>alert('カートに追加しました');</script>";
      echo $alert;
      break;

    // カートから削除
    case 'cart_delete':
      unset($_SESSION['product'][$_REQUEST['id']]);
      break;
    
    // 購入確定
    case 'purchase':
      $purchase_id = 1;
      foreach ($pdo->query('select max(id) from purchase') as $row) {
        $purchase_id = $row['max(id)'] + 1;
      }
      $sql=$pdo->prepare('insert into purchase values(?, ?, ?)');
      if ($sql->execute([$purchase_id, $_SESSION['customer']['id'], htmlspecialchars($_REQUEST['reservation_date'])])) {
        foreach ($_SESSION['product'] as $product_id=>$product) {
          $sql=$pdo->prepare('insert into purchase_detail values(?, ?, ?)');
          $sql->execute([$purchase_id, $product_id, $product['count']]);
        }
        unset($_SESSION['product']);
      } else {
        $alert = "<script type='text/javascript'>alert('購入手続き中にエラーが発生しました。申し訳ございません。');</script>";
        echo $alert;
      }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="Shitamichi_images/logo.png" type="">
  <link href="css\login.css" rel="stylesheet" type="text/css" media="all">

  <title> ~Shitamichi's bakery~ </title>

  <!-- bootstrap core css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style2.css" rel="stylesheet" />

</head>

<body>
  <div class="sub_page">

  
  <div class="hero_area">
    <div class="bg-box">
        
    </div>
        <!-- header section strats -->
        <header class="header_section">
            <div class="container">
              <nav class="navbar navbar-expand-lg custom_nav-container fixed-top">
                <a class="navbar-brand" href="index.php">
                  <span>
                    Shitamichi's bakery
                  </span>
                </a>
      
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class=""> </span>
                </button>
    
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav  mx-auto ">
                    <li class="nav-item">
                      <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="menu.php">Menu</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="seat.php">Reservation</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="dm.php">Notice</a>
                    </li>
                  </ul>
                  <div class="user_option">
                    <?php
                    if (isset($_SESSION['customer'])) {
                      echo '<a href="account.php" class="user_link">';
                      echo '<i class="fa fa-user" aria-hidden="true"></i>';
                      echo '</a>';
                    } else {
                      echo '<a href="login.php" class="user_link">';
                      echo '<i class="fa fa-user" aria-hidden="true"></i>';
                      echo '</a>';
                    }
                    ?>
                    <a class="cart_link" href="cart.php">
                      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                        <g>
                          <g>
                            <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                         c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                          </g>
                        </g>
                        <g>
                          <g>
                            <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                         C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                         c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                         C457.728,97.71,450.56,86.958,439.296,84.91z" />
                          </g>
                        </g>
                        <g>
                          <g>
                            <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                         c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                          </g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                      </svg>
                    </a>
                    <?php
                    // ログインしているか
                    if (isset($_SESSION['customer'])) {
                      echo '<a href="account.php" class="order_online">';
                      echo 'ACCOUNT';
                      echo '</a>';
                    } else {
                      echo '<a href="login.php" class="order_online">';
                      echo 'LOGIN';
                      echo '</a>';
                    }
                    ?>
                  </div>
                </div>
              </nav>
            </div>
          </header>
          <!-- end header section -->
    </div>
  </div>
