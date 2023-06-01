drop database if exists kadai;
create database kadai default character set utf8 collate utf8_general_ci;
grant all on kadai.* to 'staff'@'localhost' identified by 'password';
use kadai;

/* 商品 */
create table product (
  product_id int auto_increment primary key, 
  product_name varchar(100) not null, 
  product_price int not null,
  product_genre varchar(50) not null,
  image_path varchar(200) not null,
  product_description varchar(300) not null,
  is_featured bit not null
);

/* 顧客 */
create table customer (
  id int auto_increment primary key, 
  name varchar(100) not null, 
  address varchar(100) not null, 
  login varchar(100) not null unique, 
  password varchar(100) not null
);

/* 購入 */
create table purchase (
  id int auto_increment not null primary key, 
  customer_id int not null, 
  foreign key(customer_id) references customer(id)
);

/* 購入詳細 */
create table purchase_detail (
  purchase_id int not null, 
  product_id int not null, 
  count int not null, 
  primary key(purchase_id, product_id), 
  foreign key(purchase_id) references purchase(id), 
  foreign key(product_id) references product(product_id)
);

/* 座席予約 */
create table zasekiyoyaku (
  reservation_id int auto_increment primary key,
  reservation_datetime datetime not null,
  seat_type int not null,
  customer_id int not null,
  foreign key(customer_id) references customer(id),
  constraint check_reservation_datetime
    check (
      dayofweek(reservation_datetime) between 2 and 6
      and (
        (hour(reservation_datetime) >= 6 and hour(reservation_datetime) < 18)
        or (dayofweek(reservation_datetime) in (1, 7) and hour(reservation_datetime) >= 7 and hour(reservation_datetime) < 19)
      )
      and minute(reservation_datetime) = 0
    )
);

/* 商品予約 */
create table syouhinyoyaku (
  reservation_id int auto_increment primary key,
  reservation_datetime datetime not null,
  product_id int not null,
  customer_id int not null,
  foreign key(customer_id) references customer(id),
  foreign key(product_id) references product(product_id),
  constraint check_reservation_datetime
    check (
      dayofweek(reservation_datetime) between 2 and 6
      and (
        (hour(reservation_datetime) >= 6 and hour(reservation_datetime) < 18)
        or (dayofweek(reservation_datetime) in (1, 7) and hour(reservation_datetime) >= 7 and hour(reservation_datetime) < 19)
      )
      and minute(reservation_datetime) = 0
    )
);

insert into product values(null, 'クッキー', 120, 'food', '/path/to/image', 'クッキーの説明', 0);
insert into product values(null, 'クロワッサン', 200, 'food', '/path/to/image', 'クロワッサンの説明', 0);

insert into customer values(null, '下道', '福岡市', 'sita', 'sita');
