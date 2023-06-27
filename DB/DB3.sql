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
	product_description varchar(500) not null,  
	is_featured bit not null                    
);

/* 顧客情報 */ 
create table customer (
	id int auto_increment primary key,      
	name varchar(100) not null unique,             
	address varchar(100) not null,          
	password varchar(100) not null          
);


/* DMは発送 */
create table dm (
    dm_id int auto_increment primary key,
    title varchar(100) not null,
    content varchar(500) not null
);


insert into product values(null, 'クッキー', 120, 'food', 'Cookie.jpg', '小麦の香ばしさが感じられるよう、全粒粉の生地にバターを練り込み、ソフトな食感に焼き上げたクッキーです。砂糖の一部にブラウンシュガーを使い、コクのある甘さをプラスしています。', 1);

insert into customer values(null, 'sita', '福岡市博多区中呉服町3-13', 'sita');

insert into dm (title, content) values ('重要なお知らせ', 'これは重要なお知らせです。');
