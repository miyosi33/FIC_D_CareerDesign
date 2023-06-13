drop database if exists kadai;
create database kadai default character set utf8 collate utf8_general_ci;
grant all on kadai.* to 'staff'@'localhost' identified by 'password';
use kadai;

/* 商品 */
create table product (
	product_id int auto_increment primary key, 				--商品ID
	product_name varchar(100) not null, 					--商品の名称
	product_price int not null,								--商品の値段
	product_genre varchar(50) not null, 					--商品のジャンル（food,hot,ice)
	image_path varchar(200) not null,						--画像のファイルパス
	product_description varchar(300) not null,				--商品の詳細情報
	is_featured bit not null								--bitで商品がおすすめであるかどうか 1がオススメ商品
);

/* 顧客 */
create table customer (
	id int auto_increment primary key, 						--顧客ID
	name varchar(100) not null, 							--顧客の名前
	address varchar(100) not null, 							--顧客の情報
	login varchar(100) not null unique, 					--ログイン名
	password varchar(100) not null 							--パスワード
);

/* 購入 */
create table purchase (
	id int auto_increment not null primary key, 			--購入ID
	customer_id int not null, 								--購入を行った顧客のID
	foreign key(customer_id) references customer(id)		--外部キー　customerテーブルのid列を参照
);

/* 購入詳細 */
create table purchase_detail (
	purchase_id int not null, 								--購入ID
	product_id int not null, 								--商品ID
	count int not null, 									--個数
	primary key(purchase_id, product_id), 					--主キー
	foreign key(purchase_id) references purchase(id), 		--列を参照する外部キー制約
	foreign key(product_id) references product(product_id)	--productテーブルのproduct_id列を参照する外部キー制約
);

/* 座席予約 */
create table zasekiyoyaku (
	reservation_id int auto_increment primary key, 			--予約ID
	reservation_datetime datetime not null,					--予約日時
	seat_type int not null, 								--座席の種類
	customer_id int not null,								--顧客ID
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
	reservation_id int auto_increment primary key, 			--予約ID
	reservation_datetime datetime not null,					--予約日時
	product_id int not null,								--商品ID
	customer_id int not null,								--顧客ID
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