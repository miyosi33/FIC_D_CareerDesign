drop database if exists kadai;
create database kadai default character set utf8 collate utf8_general_ci;
grant all on kadai.* to 'staff'@'localhost' identified by 'password';use kadai;

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

/* 購入 */
create table purchase (
    id int not null primary key,     
    customer_id int not null, 						
    reservation_date datetime not null,
    foreign key (customer_id) references customer(id)		
);

/* 購入詳細 */
create table purchase_detail (
    purchase_id int not null, 							
    product_id int not null, 							
    count int not null, 								
    primary key (purchase_id, product_id), 				
    foreign key (purchase_id) references purchase(id), 	
    foreign key (product_id) references product(product_id)	
);

/* 管理者 */
create table admin (
    admin_id int auto_increment primary key,
    username varchar(100) not null unique,
    password varchar(100) not null
);

insert into admin (username, password) values ('admin', 'password');

insert into product values(null, 'クッキー', 120, 'food', 'Cookie.jpg', '小麦の香ばしさが感じられるよう、全粒粉の生地にバターを練り込み、ソフトな食感に焼き上げたクッキーです。砂糖の一部にブラウンシュガーを使い、コクのある甘さをプラスしています。', 1);
