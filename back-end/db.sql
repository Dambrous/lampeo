/* nome database --> PABSBDEC. */
-- Crea il database
CREATE DATABASE PABSBDEC;

-- Usa il database
USE PABSBDEC;

-- Crea la tabella Tipo Utente
CREATE TABLE user_type (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255)
);

-- Popolamente tabella user_type
INSERT INTO user_type (name) VALUES
('Regular'),
('Administrator');


-- Crea la tabella res_user
CREATE TABLE res_user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    surname VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_type_id INT NOT NULL,
    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_type_id) REFERENCES user_type(id)
);

-- Popolamente tabella res_user
INSERT INTO res_user (name, surname, email, password, user_type_id) VALUES
('Mason', 'Rodriguez', 'mason.rodriguez@email.com', 'luxurylamp', 1),
('Luca', 'D"Ambrosio', 'luca.dambrosio@example.com', 'admin', 2);

-- Popolamente tabella Indirizzi
CREATE TABLE shipping_address (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `cap` varchar(50) DEFAULT NULL,
  FOREIGN KEY (user_id) REFERENCES res_user(id)
);

-- Crea la tabella supplier
CREATE TABLE supplier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    website VARCHAR(255)
);

-- Popolamente tabella supplier
INSERT INTO supplier (name, website) VALUES
('LuxLight', 'www.luxlight.com'),
('EleganceLamps', 'www.elegancelamps.com'),
('CrystalLux', 'www.crystallux.com'),
('GoldenGlow', 'www.goldenglow.com'),
('LuxeDesign', 'www.luxedesign.com'),
('RoyalShine', 'www.royalshine.com'),
('GlamourLamps', 'www.glamourlamps.com'),
('EliteLux', 'www.elitelux.com'),
('OpulentLight', 'www.opulentlight.com'),
('PrestigeGlow', 'www.prestigeglow.com');

-- Crea la tabella Product Type
CREATE TABLE product_type (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255)
);

-- Popolamente tabella product_type
INSERT INTO product_type (name) VALUES
('Tavolo'),
('Parete'),
('Lampadario');

-- Crea la tabella category
CREATE TABLE category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255)
);

-- Popolamente tabella category
INSERT INTO category (name) VALUES
('Cristallo'),
('Metallo'),
('Vetro');

-- Crea la tabella product
CREATE TABLE product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    price DECIMAL(10, 2),
    description TEXT,
    supplier_id INT,
    category_id INT,
    product_type_id INT,
    image VARCHAR(255),
    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (supplier_id) REFERENCES supplier(id),
    FOREIGN KEY (category_id) REFERENCES category(id),
    FOREIGN KEY (product_type_id) REFERENCES product_type(id)
);

-- Popolamente tabella Product
INSERT INTO product (name, price, description, supplier_id, category_id, product_type_id, image) VALUES
('Lampada Sospensione Crystal', 499.99, 'Elegante lampada a sospensione in cristallo.', 1, 1, 1,'lampada1.png'),
('Lampada da Tavolo Gold', 299.99, 'Lampada da tavolo in metallo color oro.', 2, 2, 2,'lampada2.png'),
('Applique in Vetro Opalino', 149.99, 'Applique da parete con vetro opalino.', 3, 2, 3,'lampada3.png'),
('Lampada da Terra Moderna', 399.99, 'Lampada da terra moderna in acciaio inox.', 4, 2, 3,'lampada4.png'),
('Soffitto in Bronzo Antico', 599.99, 'Lampada a soffitto in bronzo antico.', 5, 2, 3,'lampada5.png'),
('Lampada da Esterno LED', 199.99, 'Lampada da esterno con illuminazione a LED.', 6, 3, 1,'lampada6.png'),
('Lampadario in Cristallo Lusso', 799.99, 'Lampadario in cristallo di lusso.', 7, 3, 1,'lampada7.png'),
('Applique Oro Rosso', 249.99, 'Applique da parete in oro rosso.', 8, 3, 1,'lampada8.png'),
('Candeliere in Argento', 349.99, 'Candeliere in argento massiccio.', 9, 1, 2,'lampada9.png'),
('Ventilatore Moderno', 699.99, 'Ventilatore da soffitto moderno con luci integrate.', 10, 1, 2,'lampada10.png');

-- Crea la tabella sale_order
CREATE TABLE sale_order (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    date_order DATE,
    shipping_address VARCHAR(55),
    country VARCHAR(255),
    province VARCHAR(255),
    city VARCHAR(255),
    zip VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES res_user(id)
);

-- Popola la tabella sale_order con dati di esempio
INSERT INTO sale_order (user_id, date_order, shipping_address, country, province, city, zip) VALUES
(1, '2023-09-13', 'Via Roma 123', 'Italia', 'Lombardia', 'Milano', '20100'),
(2, '2023-09-14', '123 Main St', 'Stati Uniti', 'California', 'Los Angeles', '90001'),
(1, '2023-09-15', '15 Rue de la Paix', 'Francia', 'Île-de-France', 'Parigi', '75001'),
(1, '2023-09-16', 'Kurfürstendamm 234', 'Germania', 'Berlino', 'Berlino', '10117'),
(1, '2023-09-17', 'Calle Gran Vía 456', 'Spagna', 'Madrid', 'Madrid', '28001'),
(1, '2023-09-18', 'Rua Augusta 789', 'Portogallo', 'Lisbona', 'Lisbona', '1000-045'),
(1, '2023-09-19', 'Strada Victoriei 567', 'Romania', 'Bucarest', 'Bucarest', '010098'),
(1, '2023-09-20', 'Hofweg 789', 'Paesi Bassi', 'Amsterdam', 'Amsterdam', '1012'),
(1, '2023-09-21', 'Karl Johans gate 12', 'Norvegia', 'Oslo', 'Oslo', '0154'),
(2, '2023-09-22', '5 Downing Street', 'Regno Unito', 'Inghilterra', 'Londra', 'SW1A 2AA');

-- Crea la tabella sale_order-item
CREATE TABLE order_item (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT,
    FOREIGN KEY (order_id) REFERENCES sale_order(id),
    FOREIGN KEY (product_id) REFERENCES product(id)
);

-- Popolamente tabella order_item
INSERT INTO order_item (order_id, product_id, quantity) VALUES
(1, 1, 2),
(1, 3, 1),
(2, 2, 1),
(2, 5, 3),
(3, 4, 2),
(3, 6, 1),
(4, 7, 1),
(4, 9, 2),
(5, 8, 1),
(5, 10, 1),
(6, 1, 1),
(6, 2, 1),
(7, 3, 2),
(7, 4, 1),
(8, 5, 2),
(8, 6, 1),
(9, 7, 1),
(9, 8, 1),
(10, 9, 2),
(10, 10, 1);

-- Crea la tabella cart (carrello)
CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id VARCHAR(255)
);

-- Crea la tabella Cart_item (elemento del carrello)
CREATE TABLE cart_item (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cart_id INT,
    product_id INT,
    quantity INT CHECK (quantity >= 0),
    FOREIGN KEY (cart_id) REFERENCES cart(id),
    FOREIGN KEY (product_id) REFERENCES product(id)
);

-- Popolamente tabella Nazioni
CREATE TABLE res_country (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    code VARCHAR(255)
);

-- Inserisci l'Italia come unico Paese
INSERT INTO res_country (name, code) VALUES 
('Italy', 'IT');

-- Popolamente tabella Province
CREATE TABLE res_province (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    code VARCHAR(255),
    country_id INT,
    FOREIGN KEY (country_id) REFERENCES res_country(id)
);

INSERT INTO res_province (name, code, country_id)
VALUES
('Agrigento', 'AG', 1),
('Alessandria', 'AL', 1),
('Ancona', 'AN', 1),
('Aosta - Aoste', 'AO', 1),
('Arezzo', 'AR', 1),
('Ascoli Piceno', 'AP', 1),
('Asti', 'AT', 1),
('Avellino', 'AV', 1),
('Bari', 'BA', 1),
('Belluno', 'BL', 1),
('Benevento', 'BN', 1),
('Bergamo', 'BG', 1),
('Biella', 'BI', 1),
('Bologna', 'BO', 1),
('Bolzano - Bozen', 'BZ', 1),
('Brescia', 'BS', 1),
('Brindisi', 'BR', 1),
('Cagliari', 'CA', 1),
('Caltanissetta', 'CL', 1),
('Campobasso', 'CB', 1),
('Carbonia Iglesias', 'CI', 1),
('Caserta', 'CE', 1),
('Catania', 'CT', 1),
('Catanzaro', 'CZ', 1),
('Chieti', 'CH', 1),
('Como', 'CO', 1),
('Cosenza', 'CS', 1),
('Cremona', 'CR', 1),
('Crotone', 'KR', 1),
('Cuneo', 'CN', 1),
('Enna', 'EN', 1),
('Fermo', 'FM', 1),
('Ferrara', 'FE', 1),
('Firenze', 'FI', 1),
('Foggia', 'FG', 1),
("Forli\'Cesena", 'FC', 1),
('Frosinone', 'FR', 1),
('Genova', 'GE', 1),
('Gorizia', 'GO', 1),
('Grosseto', 'GR', 1),
('Imperia', 'IM', 1),
('Isernia', 'IS', 1),
('La Spezia', 'SP', 1),
('Latina', 'LT', 1),
('Lecce', 'LE', 1),
('Lecco', 'LC', 1),
('Livorno', 'LI', 1),
('Lodi', 'LO', 1),
("L'Aquila", 'AQ', 1),
('Macerata', 'MC', 1),
('Mantova', 'MN', 1),
('Massa-Carrara', 'MS', 1),
('Matera', 'MT', 1),
('Medio Campidano', 'SU', 1),
('Messina', 'ME', 1),
('Milano', 'MI', 1),
('Modena', 'MO', 1),
('Napoli', 'NA', 1),
('Novara', 'NO', 1),
('Nuoro', 'NU', 1),
('Olbia Tempio', 'OT', 1),
('Oristano', 'OR', 1),
('Padova', 'PD', 1),
('Palermo', 'PA', 1),
('Parma', 'PR', 1),
('Pavia', 'PV', 1),
('Perugia', 'PG', 1),
('Pesaro E Urbino', 'PU', 1),
('Pescara', 'PE', 1),
('Piacenza', 'PC', 1),
('Pisa', 'PI', 1),
('Pistoia', 'PT', 1),
('Potenza', 'PZ', 1),
('Ragusa', 'RG', 1),
('Ravenna', 'RA', 1),
('Reggio Di Calabria', 'RC', 1),
("Reggio Nell'Emilia", 'RE', 1),
('Rieti', 'RI', 1),
('Rimini', 'RN', 1),
('Roma', 'RM', 1),
('Rovigo', 'RO', 1),
('Salerno', 'SA', 1),
('Sassari', 'SS', 1),
('Savona', 'SV', 1),
('Siena', 'SI', 1),
('Siracusa', 'SR', 1),
('Sondrio', 'SO', 1),
('Sud Sardegna', 'SU', 1),
('Taranto', 'TA', 1),
('Teramo', 'TE', 1),
('Terni', 'TR', 1),
('Torino', 'TO', 1),
('Trapani', 'TP', 1),
('Trento', 'TN', 1),
('Treviso', 'TV', 1),
('Trieste', 'TS', 1),
('Udine', 'UD', 1),
('Varese', 'VA', 1),
('Venezia', 'VE', 1),
('Verbano-Cusio-Ossola', 'VB', 1),
('Vercelli', 'VC', 1),
('Verona', 'VR', 1),
('Vibo Valentia', 'VV', 1),
('Vicenza', 'VI', 1),
('Viterbo', 'VT', 1);

-- LOAD DATA INFILE 'C:\xampp\htdocs\proecommerce\back-end\data\province.csv'
-- INTO TABLE res_province
-- FIELDS TERMINATED BY ';'
-- LINES TERMINATED BY '\n'
-- IGNORE 1 LINES;

-- Popolamente tabella Città
CREATE TABLE res_city (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    code VARCHAR(255),
    province_id INT,
    FOREIGN KEY (province_id) REFERENCES res_province(id)
);
