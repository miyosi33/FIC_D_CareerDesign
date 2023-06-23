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

/* 顧客情報 */ 
create table customer (
	id int auto_increment primary key,      
	name varchar(100) not null unique,             
	address varchar(100) not null,          
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

-- 座席予約
create table seat_reservation (
	reservation_id int auto_increment primary key,      
	reservation_date datetime not null,                 
	seat_type varchar(20) not null,                     
	seat_count int not null,                            
	customer_id int not null,                           
	foreign key (customer_id) references customer (id)
);

-- 商品予約
create table product_reservation (
	reservation_id int auto_increment primary key,      
	reservation_date datetime not null,                 
	product_id int not null,                            
	customer_id int not null,                         
	foreign key (product_id) references product (product_id),
	foreign key (customer_id) references customer (id)
);


insert into product values(null, 'クッキー', 120, 'food', '/path/to/image', 'クッキーの説明', 0);
insert into product values(null, 'クロワッサン', 200, 'food', '/path/to/image', 'クロワッサンの説明', 0);

insert into customer values(null, 'sita', '福岡市博多区中呉服町3-13', 'sita');
