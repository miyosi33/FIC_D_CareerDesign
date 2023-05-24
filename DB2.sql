-- Customers テーブルの作成
CREATE TABLE Customers (
	customer_id INT PRIMARY KEY,
	name VARCHAR(50),
	contact VARCHAR(50)
);

-- Seats テーブルの作成
CREATE TABLE Seats (
	seat_id INT PRIMARY KEY,
	seat_number VARCHAR(10),
	seat_type VARCHAR(20),
	status VARCHAR(20)
);

-- Reservations テーブルの作成
CREATE TABLE Reservations (
	reservation_id INT PRIMARY KEY,
	customer_id INT,
	seat_id INT,
	reservation_date DATETIME,
	FOREIGN KEY (customer_id) REFERENCES Customers(customer_id),
	FOREIGN KEY (seat_id) REFERENCES Seats(seat_id)
);

-- Customers テーブルへのデータ挿入の例
INSERT INTO Customers (customer_id, name, contact)
VALUES (1, 'John Doe', 'john@example.com');

-- Seats テーブルへのデータ挿入の例
INSERT INTO Seats (seat_id, seat_number, seat_type, status)
VALUES (1, 'A1', 'General', 'Available'),
		(2, 'A2', 'General', 'Available'),
        (3, 'B1', 'Premium', 'Available');

-- Reservations テーブルへのデータ挿入の例
INSERT INTO Reservations (reservation_id, customer_id, seat_id, reservation_date)
VALUES (1, 1, 1, '2023-05-19 10:00:00');

-- 予約の確認の例
SELECT * FROM Reservations WHERE customer_id = 1;

-- 予約の更新の例
UPDATE Reservations SET reservation_date = '2023-05-19 14:00:00' WHERE reservation_id = 1;

-- 予約のキャンセルの例
DELETE FROM Reservations WHERE reservation_id = 1;
