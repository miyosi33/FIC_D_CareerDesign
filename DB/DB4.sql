drop database if exists kadai;
create database kadai default character set utf8 collate utf8_general_ci;
grant all on kadai.* to 'staff'@'localhost' identified by 'password';
use kadai;

/* 商品 */
create table product (
	product_id int auto_increment primary key,  --商品ID
	product_name varchar(100) not null,         --商品名
	product_price int not null,                 --商品価格
	product_genre varchar(50) not null,         --商品のジャンル
	image_path varchar(200) not null,           -- 商品の画像パス
	product_description varchar(300) not null,  --商品の説明
	is_featured bit not null                    --オススメ商品か判定（１がオススメ、０は普通）
);

/* 顧客情報 */ 
create table customer (
	id int auto_increment primary key,      -- 顧客ID
	name varchar(100) not null,             --顧客名
	address varchar(100) not null,          --住所
	login varchar(100) not null unique,     --ログイン名
	password varchar(100) not null          --パスワード
);

/* 購入 */
create table purchase (
	id int auto_increment not null primary key,     -- 購入ID
	customer_id int not null, 								
	foreign key(customer_id) references customer(id)		--購入を行った顧客のID（customerテーブルのid列を参照)
);

/* 購入詳細 */
create table purchase_detail (
	purchase_id int not null, 							--購入ID	
	product_id int not null, 							--商品ID
	count int not null, 								--購入する商品の数
	primary key(purchase_id, product_id), 				--主キー: (purchase_id, product_id)
	foreign key(purchase_id) references purchase(id), 	--外部キー: purchaseテーブルのid列を参照、productテーブルのproduct_id列を参照
	foreign key(product_id) references product(product_id)	
);

-- 座席予約
create table seat_reservation (
	reservation_id int auto_increment primary key,      --予約ID
	reservation_date datetime not null,                 --予約日時
	seat_type varchar(20) not null,                     --座席の種類
	seat_count int not null,                            --座席の数
	customer_id int not null,                           --予約を行った顧客のID（customerテーブルのid列を参照）
	reservation_number varchar(100) not null unique,    -- 予約番号
	foreign key (customer_id) references customer (id)
);

-- 商品予約
create table product_reservation (
	reservation_id int auto_increment primary key,      --予約ID
	reservation_date datetime not null,                 --予約日時
	product_id int not null,                            --商品ID
	customer_id int not null,                           --予約を行った顧客のID（customerテーブルのid列を参照）
	reservation_number varchar(100) not null unique,    -- 予約番号
	foreign key (product_id) references product (product_id),--外部キー: productテーブルのproduct_id列を参照、customerテーブルのid列を参照
	foreign key (customer_id) references customer (id)z
);


insert into product values(null, 'クッキー', 120, 'food', '/path/to/image', 'クッキーの説明', 0);
insert into product values(null, 'クロワッサン', 200, 'food', '/path/to/image', 'クロワッサンの説明', 0);

insert into customer values(null, '下道', '福岡市博多区中呉服町3-13', 'sita', 'sita');
