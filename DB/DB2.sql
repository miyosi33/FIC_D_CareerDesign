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

/* 購入 */
create table purchase (
    id int auto_increment not null primary key,     
    customer_id int not null, 						
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

-- 座席予約
create table seat_reservation (
    reservation_id int auto_increment primary key,      
    reservation_date datetime not null,                 
    seat_type varchar(20) not null,                                             
    customer_id int not null,                           
    foreign key (customer_id) references customer(id)
);

-- 商品予約
create table product_reservation (
    reservation_id int auto_increment primary key,      
    reservation_date datetime not null,                 
    product_id int not null,                            
    customer_id int not null,                         
    foreign key (product_id) references product(product_id),
    foreign key (customer_id) references customer(id)
);

insert into product values(null, 'クッキー', 120, 'food', '新商品写真/food/Cookie.jpg', '小麦の香ばしさが感じられるよう、全粒粉の生地にバターを練り込み、ソフトな食感に焼き上げたクッキーです。砂糖の一部にブラウンシュガーを使い、コクのある甘さをプラスしています。', 1);
insert into product values(null, 'クロワッサン', 200, 'food', '新商品写真/food/Croissant.jpg', '発酵バターをたっぷり使用した生地を、何層にも丁寧に織り込んで焼き上げました。サクサクとした心地よい食感が楽しめます。', 0);
insert into product values(null, 'いちごタルト', 400, 'food', '新商品写真/food/StrawberryTart.jpg', '手作りタルト生地にカスタードとクリームを合わせたフランジパーヌ、きめ細やかなスポンジ、バニラビーンズソースを使った真っ白なミルクムースを重ね、真っ赤な完熟あまおうをすき間なく敷き詰めています。', 1);
insert into product values(null, 'チョコタルト', 400, 'food', '新商品写真/food/ChocolateTart.jpg', 'ベルギー産のビターなチョコレートや北海道産生クリームなど、厳選された素材が使われています。サクサクとした食感のタルトと、とろりと濃厚な生チョコレートがとてもよく合います。', 1);
insert into product values(null, 'ショートケーキ', 400, 'food', '新商品写真/food/StrawberryCake.jpg', '使用するイチゴは国産のものにこだわっており、スポンジ生地と生クリームの甘さが、イチゴの酸味を一層引き立てています。', 0);
insert into product values(null, 'チョコケーキ', 400, 'food', '新商品写真/food/ChocolateCake.jpg', '食感、チョコレートのコク、ほどよい甘さなどにこだわったシンプルな美味しさのチョコレートケーキです。', 0);
insert into product values(null, 'サンドイッチ', 300, 'food', '新商品写真/food/Sandwich.jpg', 'ほどよいスモーク感で食べやすいハム・レタス・スライストマト・スライスチーズを全粒粉のパンでサンドしたランチなどにおすすめの食べごたえのあるサンドイッチです。', 0);
insert into product values(null, 'パンケーキ', 500, 'food', '新商品写真/food/Pancakes.jpg', ' シロップ漬けのストロベリーの甘酸っぱさとふわふわのパンケーキ・なめらかな口当たりのホイップクリームの甘さが抜群にマッチしています。', 0);
insert into product values(null, 'フレンチトースト', 250, 'food', '新商品写真/food/FrenchToast.jpg', 'パンを5㎝の厚さにスライスし、特製のカスタードソースに約12時間かけて味を染み込ませ、丁寧に焼き上げています。口にいれた瞬間に溶けてしまうよな食感がたまりません。', 0);
insert into product values(null, 'アイスレモンティー', 400, 'ice_drink', '新商品写真/drink/IceLemonTea.jpg', 'フルーティーな紅茶と新鮮なレモンの香りがさわやかで、気分をリフレッシュさせてくれる暑い日にぴったりな一杯です。', 0);
insert into product values(null, 'アイスミルクティー', 400, 'ice_drink', '新商品写真/drink/IceMilkTea.jpg', '甘いミルクを味わいながらも紅茶の香りとコクがしっかりと感じることが出来る、上品でやさしい仕上がりになっています。', 0);
insert into product values(null, 'アイスティー', 400, 'ice_drink', '新商品写真/drink/IceTea.jpg', '紅茶の高貴で上品な香りと、茶葉の豊かな風味をお楽しみ頂けるすっきりした味わいのアイスティーです。', 0);
insert into product values(null, 'レモンティー', 400, 'hot_drink', '新商品写真/drink/LemonTea.jpg', 'レモンピール・レモングラス・レモンバームなどを使った、レモンの爽やかな香りが特徴です。', 0);
insert into product values(null, 'ミルクティー', 400, 'hot_drink', '新商品写真/drink/MilkTea.jpg', 'ミルクと相性の良い茶葉をオリジナルでブレンドしています。茶葉とミルクの濃厚な風味とコクのある味わいが特徴です。', 0);
insert into product values(null, '紅茶', 400, 'hot_drink', '新商品写真/drink/Tea.jpg', '本場セイロン島のウバ茶をベースにしたオリジナルブレンド。華やかな香りとすっきりしたコクが自慢の一杯です。', 1);
insert into product values(null, 'アイスコーヒー', 350, 'ice_drink', '新商品写真/drink/IceCoffee.jpg', 'すっきりとした苦みの中に華やかな香りと深い甘みが広がる、奥行きのある味わいがお楽しみいただけます。', 0);
insert into product values(null, 'ホットコーヒー', 350, 'hot_drink', '新商品写真/drink/HotCoffee.jpg', 'ブラジル、コロンビア、グアテマラ豆などをバランスよく配合し、酸味を和らげ、柔らかな苦味とコクが感じられる飲み口に仕上げたブレンドコーヒーです。', 1);
insert into product values(null, 'アイスラテ', 400, 'ice_drink', '新商品写真/drink/IceLatte.jpg', '苦みと酸味があるエスプレッソと甘みの強いミルクが互いに引き立てあい、誰でも飲みやすく味わって飲めます。', 0);
insert into product values(null, 'ラテ', 400, 'hot_drink', '新商品写真/drink/Latte.jpg', 'リッチな風味のエスプレッソにミルクを注いだラテ。エスプレッソとの相性を追求したミルクにより、コーヒーの余韻をお楽しみいただけます。', 1);
insert into product values(null, 'アイスキャラメルラテ', 450, 'ice_drink', '新商品写真/drink/IceCaramel.jpg', 'カフェラテに加えた甘くほろ苦いキャラメルの風味が心地よく、甘くやさしい印象の味わいになった一杯です。', 0);
insert into product values(null, 'キャラメルラテ', 450, 'hot_drink', '新商品写真/drink/CaramelLatte.jpg', 'ミルクをたっぷり使用したまろやかなラテに、香り高いキャラメルソースをプラスしました。あま～いキャラメルの香りが口いっぱいに広がります。', 0);
insert into product values(null, 'アイスココア', 450, 'ice_drink', '新商品写真/drink/IceCocoa.jpg', '甘みのあるミルクと後味にカカオのほろ苦さも残る、口当たりがなめらかで深くまろやかな味わいになっています。', 0);
insert into product values(null, 'ココア', 450, 'hot_drink', '新商品写真/drink/Cocoa.jpg', 'なめらかな口当たりと濃厚なコクを感じられる、ほっとする味わいのココアです。', 0);
insert into product values(null, 'ホットチョコレート', 450, 'hot_drink', '新商品写真/drink/HotChocolate.jpg', 'ミルクのコク香るホットチョコレートに、ホイップクリームが程よく溶けた濃厚な味わいに仕上げました。', 0);
insert into product values(null, 'オレンジジュース', 300, 'ice_drink', '新商品写真/drink/OrangeJuice.jpg', '甘味と酸味のバランスがよく、豊かな風味のオレンジの特徴をそのままに、ソフトな飲み口に仕上げています。', 0);

insert into customer values(null, 'sita', '福岡市博多区中呉服町3-13', 'sita');