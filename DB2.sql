drop database if exists kadai;
create database kadai default character set utf8 collate utf8_general_ci;
grant all on kadai.* to 'staff'@'localhost' identified by 'password';
use kadai;

/* 商品 */
create table product (
	product_id int auto_increment primary key, 
	product_name varchar(100) not null, 
	product_price int not null,
	-- 商品ジャンル（food,ice_drink,hot_drink)
	-- 画像ファイルパスの指定
	-- 商品詳細（商品の紹介文、３００文字以内）
	-- おすすめかどうか判別する（これだけbool）
	product_genre varchar(50) not null,
	image_path varchar(200) not null,
	product_description varchar(300) not null,
	is_featured bit not null
);


/* 顧客のやつ */ 
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

-- 予約テーブル
create table yoyaku (
	-- 予約人数
	-- 予約日時（予約時間は平日6:00～18:00,土日祝7:00~19:00　予約時間は1時間、間隔は30分で予約できるようにする　例： 10:00~11:00 OK 10:30~11:30 OK 10:15~11:15 NO)
	-- 予約する商品
	-- 座席は１人席５つ、２人席３つ、４人席4つ
	-- 予約するユーザーID
	-- 予約番号（重複はしてはいけない)

)

insert into product values(null, 'クッキー', 120);
insert into product values(null, 'クロワッサン', 200);
insert into product values(null, 'いちごタルト', 400);
insert into product values(null, 'チョコタルト', 400);
insert into product values(null, 'ショートケーキ', 400);
insert into product values(null, 'チョコケーキ', 400);
insert into product values(null, 'サンドイッチ', 300);
insert into product values(null, 'パンケーキ', 500);
insert into product values(null, 'フレンチトースト', 250);
insert into product values(null, 'アイスレモンティー', 400);
insert into product values(null, 'アイスミルクティー', 400);
insert into product values(null, 'アイスティー', 400);
insert into product values(null, 'レモンティー', 400);
insert into product values(null, 'ミルクティー', 400);
insert into product values(null, '紅茶', 400);
insert into product values(null, 'アイスコーヒー', 350);
insert into product values(null, 'ホットコーヒー', 350);
insert into product values(null, 'アイスラテ', 400);
insert into product values(null, 'ラテ', 400);
insert into product values(null, 'アイスキャラメルラテ', 450);
insert into product values(null, 'キャラメルラテ', 450);
insert into product values(null, 'アイスココア', 450);
insert into product values(null, 'ココア', 450);
insert into product values(null, 'ホットチョコレート', 450);
insert into product values(null, 'オレンジジュース', 300);


insert into customer values(null, '下道', '福岡市博多区中呉服町3-13', 'sita', 'sita');
