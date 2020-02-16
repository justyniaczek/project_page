CREATE TABLE customers(
id INT AUTO_INCREMENT PRIMARY KEY,
first_name VARCHAR(30),
second_name VARCHAR(30),
email VARCHAR(30),
pass VARCHAR(20),
adress VARCHAR(30),
adress2 VARCHAR(30)
);

CREATE TABLE orders(
id INT AUTO_INCREMENT PRIMARY KEY,
order_sum DOUBLE,
order_status VARCHAR(20),
fk_customers_id INT,
fk_plant_id INT,
FOREIGN KEY (fk_customers_id) REFERENCES customers(id),
FOREIGN KEY (fk_plant_id) REFERENCES plant(id)
);

CREATE TABLE plant(
id INT AUTO_INCREMENT PRIMARY KEY,
plant_name VARCHAR(30),
latino_name VARCHAR(30),
size INT,
price DOUBLE,
in_stock VARCHAR(20)
);

CREATE TABLE order_details(
id INT AUTO_INCREMENT PRIMARY KEY,
order_date DATETIME,
fk_order_id INT,
FOREIGN KEY (fk_order_id) REFERENCES orders(id)
);

INSERT INTO customers (first_name, second_name, email, adress, adress2) 
VALUES ('Boy', 'George', 'george@gmail.com', 'Kochanowskiego 2', 'Warszawa'),
       ('George', 'Michael', 'gm@gmail.com', 'Inzynierska 12', 'Gdansk'),
       ('David', 'Bowie', 'david@gmail.com', 'Warszawska 8', 'Gdynia'),
       ('Blue', 'Steele', 'blue@gmail.com', 'Turowski 21', 'Polo'),
       ('Bette', 'Davis', 'bette@aol.com', 'Rokosza 86', 'Sopot');
       
INSERT INTO plant(plant_name, latino_name, size, price, in_stock)
VALUES ('Suculent1', 'Suculentus1', 5, 10,'yes'),
		('Suculent2', 'Suculentus2', 5,15, 'yes'),
        ('Suculent3', 'Suculentus3',10 , 20,'yes');
        
INSERT INTO orders(fk_customers_id, fk_plant_id)
VALUES  (1,2),
		(1,3),
        (1,1),
        (2,1),
        (3,3);
        
show tables;

SELECT *
FROM customers 
JOIN orders ON customers.id = orders.fk_customers_id
JOIN plant ON orders.fk_plant_id = plant.id;

SELECT *
FROM customers 
JOIN orders ON customers.id = orders.fk_customers_id
JOIN plant ON orders.fk_plant_id = plant.id
WHERE customers.first_name ='Boy';

