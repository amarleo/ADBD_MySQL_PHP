-- MySQL Script generated by MySQL Workbench
-- mar 04 ene 2022 20:39:37
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS 3996491_proyecto DEFAULT CHARACTER SET utf8 ;
USE 3996491_proyecto ;

-- -----------------------------------------------------
-- Table CLIENTE
-- -----------------------------------------------------
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS CLIENTE ;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE IF NOT EXISTS CLIENTE (
  DNI VARCHAR(10) NOT NULL,
  Nombre VARCHAR(45) NOT NULL,
  Apellidos VARCHAR(45) NOT NULL,
  Email VARCHAR(45) NOT NULL,
  Telefono VARCHAR(12) NOT NULL,
  Direccion VARCHAR(45) NOT NULL,
  Codigo_postal VARCHAR(8) NOT NULL,
  Borrado TINYINT NULL,
  PRIMARY KEY (DNI),
  UNIQUE INDEX Email_UNIQUE (Email ASC),
  UNIQUE INDEX DNI_UNIQUE (DNI ASC),
  UNIQUE INDEX Telefono_UNIQUE (Telefono ASC))
  ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table PRODUCTOS
-- -----------------------------------------------------
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS PRODUCTOS ;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE IF NOT EXISTS PRODUCTOS (
  ID_Producto INT NOT NULL AUTO_INCREMENT,
  Nombre VARCHAR(45) NOT NULL,
  Familia VARCHAR(45) NOT NULL,
  Descripcion VARCHAR(45) NOT NULL,
  Dimensiones VARCHAR(45) NOT NULL,
  Peso DECIMAL(20,2) NOT NULL,
  PVP DECIMAL(20,2) NOT NULL,
  Image VARCHAR(45) NOT NULL,
  Stock INT NOT NULL,
  Borrado TINYINT NULL,
  PRIMARY KEY (ID_Producto),
  UNIQUE INDEX ID_Producto_UNIQUE (ID_Producto ASC))
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table COMPRA
-- -----------------------------------------------------
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS COMPRA ;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE IF NOT EXISTS COMPRA (
  ID_Compra INT UNSIGNED NOT NULL AUTO_INCREMENT,
  CLIENTE_DNI VARCHAR(10) NOT NULL,
  Borrado TINYINT NOT NULL,
  PRODUCTOS_ID_Producto INT NOT NULL,
  Cantidad INT NOT NULL,
  PRIMARY KEY (ID_Compra, CLIENTE_DNI),
  INDEX fk_COMPRA_CLIENTE_idx (CLIENTE_DNI ASC),
  INDEX fk_COMPRA_PRODUCTOS1_idx (PRODUCTOS_ID_Producto ASC),
  CONSTRAINT fk_COMPRA_CLIENTE
    FOREIGN KEY (CLIENTE_DNI)
    REFERENCES CLIENTE (DNI),
  CONSTRAINT fk_COMPRA_PRODUCTOS1
    FOREIGN KEY (PRODUCTOS_ID_Producto)
    REFERENCES PRODUCTOS (ID_Producto))
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- TRIGGER EMAIL
-- -----------------------------------------------------
DELIMITER |
CREATE TRIGGER TRIGGER_insert_email BEFORE INSERT ON CLIENTE 
  FOR EACH ROW BEGIN
    IF NEW.Email NOT REGEXP '^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,63}$' THEN
      SIGNAL SQLSTATE VALUE '45000'
        SET MESSAGE_TEXT = '[table:CLIENTE] - Email is not valid';
    END IF;
  END;
|
DELIMITER ;

DELIMITER ||
CREATE TRIGGER TRIGGER_insert_DNI BEFORE INSERT ON CLIENTE
  FOR EACH ROW BEGIN
    IF NEW.DNI NOT REGEXP '^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]' THEN
        SIGNAL SQLSTATE VALUE '45000'
        SET MESSAGE_TEXT = '[table:CLIENTE] - DNI is not valid';
    END IF;
  END;
||
DELIMITER ;

DELIMITER ||
CREATE TRIGGER TRIGGER_insert_TLF BEFORE INSERT ON CLIENTE
  FOR EACH ROW BEGIN
    IF NEW.Telefono NOT REGEXP '[0-9]{9}' THEN
        SIGNAL SQLSTATE VALUE '45000'
        SET MESSAGE_TEXT = '[table:CLIENTE] - Telefono is not valid';
    END IF;
  END;
||


DELIMITER ||
CREATE TRIGGER TRIGGER_insert_CodPostal BEFORE INSERT ON CLIENTE
  FOR EACH ROW BEGIN
    IF NEW.Codigo_postal NOT REGEXP '[0-9]{5}' THEN
        SIGNAL SQLSTATE VALUE '45000'
        SET MESSAGE_TEXT = '[table:CLIENTE] - Código TRIGGER_insert_CodPostal is not valid';
    END IF;
  END;
||

DELIMITER ;

DELIMITER ||
CREATE TRIGGER TRIGGER_update_stock AFTER INSERT ON COMPRA
  FOR EACH ROW BEGIN
    DECLARE x INT;
    SELECT Stock INTO x FROM PRODUCTOS WHERE ID_Producto = NEW.PRODUCTOS_ID_Producto;
    IF (x >= NEW.Cantidad) THEN
    UPDATE PRODUCTOS
      SET PRODUCTOS.Stock = PRODUCTOS.Stock - NEW.Cantidad
      WHERE PRODUCTOS.ID_Producto = NEW.PRODUCTOS_ID_Producto;
    ELSE
      SIGNAL SQLSTATE VALUE '45000'
      SET MESSAGE_TEXT = '[table:PRODUCTOS] - There is not enough stock of this product';
    END IF;
  END;
||
DELIMITER ;

DELIMITER ||
CREATE TRIGGER TRIGGER_edit_stock BEFORE UPDATE ON COMPRA
  FOR EACH ROW BEGIN
    DECLARE x INT;
    SELECT Stock INTO x FROM PRODUCTOS WHERE ID_Producto = NEW.PRODUCTOS_ID_Producto;
    IF (x >= NEW.Cantidad) AND (NEW.Borrado = 0) THEN
    UPDATE PRODUCTOS
      SET PRODUCTOS.Stock = PRODUCTOS.Stock - NEW.Cantidad
      WHERE PRODUCTOS.ID_Producto = NEW.PRODUCTOS_ID_Producto;
    ELSEIF (NEW.Borrado = 1) THEN
      SIGNAL SQLSTATE VALUE '00'
      SET MESSAGE_TEXT = '[table:COMPRA] - Compra Deleted';
    ELSE
      SIGNAL SQLSTATE VALUE '45000'
      SET MESSAGE_TEXT = '[table:PRODUCTOS] - There is not enough stock of this product';
    END IF;
  END;
||
DELIMITER ;

-- -----------------------------------------------------
-- INSERTS CLIENTE
-- -----------------------------------------------------

INSERT INTO CLIENTE VALUES ("00000000A", "Juan", "López Gutierrez", "jlogu@gmail.com", "600600600", "Calle La Pardela", "38000", 0);
INSERT INTO CLIENTE VALUES ("11111111A", "Elizabeth", "Estévez García", "esga@gmail.com", "611611611", "Calle El Cernícalo", "38111", 0);
INSERT INTO CLIENTE VALUES ("22222222A", "Armando", "Urdaneta Muñoz", "arurmu@gmail.com", "622622622", "Calle El Vencejo", "38222", 0);
INSERT INTO CLIENTE VALUES ("33333333A", "Agustín", "Marrero Vera", "agumave@gmail.com", "633633633", "Calle La Tórtola", "38333", 0);
INSERT INTO CLIENTE VALUES ("44444444A", "Rosario", "Villalba Sáncehz", "rovisa@gmail.com", "644644644", "Calle El Cuco", "38444", 0);
INSERT INTO CLIENTE VALUES ("55555555A", "Lucía", "Santana Flores", "lusaflo@gmail.com", "655655655", "Calle El Paíño", "38555", 0);
INSERT INTO CLIENTE VALUES ("66666666A", "Darío", "Andrade Ibáñez", "dandi@gmail.com", "666666666", "Calle El Alcatraz", "38666", 0);
INSERT INTO CLIENTE VALUES ("77777777A", "Lily", "Martínez Murillo", "limarmu@gmail.com", "677677677", "Calle La Garza", "38777", 0);
INSERT INTO CLIENTE VALUES ("88888888A", "Olivia", "Espinoza Martín", "oliesma@gmail.com", "688688688", "Calle El Avetorillo", "38888", 0);
INSERT INTO CLIENTE VALUES ("99999999A", "Alejandro", "Pérez Gómez", "alpego@gmail.com", "699699699", "Calle El Martinete", "38999", 0);


-- -----------------------------------------------------
-- INSERTS PRODUCTO
-- -----------------------------------------------------

INSERT INTO PRODUCTOS (Nombre, Familia, Descripcion, Dimensiones, Peso, PVP, Image, Stock, Borrado) VALUES ("Corsair Gaming Bundle 4 in 1", "Periféricos", "Teclado, Cascos, alfombrilla y Ratón", "48 x 166 x 34", 1, 99.98, "url", 15, 0);
INSERT INTO PRODUCTOS (Nombre, Familia, Descripcion, Dimensiones, Peso, PVP, Image, Stock, Borrado) VALUES ("Intel Core i7-11700k", "Componentes", "Procesador de 11ª gen de Intel", "4 x 4 x 0.5", 0.8, 375.11, "url", 7, 0);
INSERT INTO PRODUCTOS (Nombre, Familia, Descripcion, Dimensiones, Peso, PVP, Image, Stock, Borrado) VALUES ("Razar Kraken Auriculares", "Periféricos", "Auriculares de la marca Razer", "3 x 3 x 0.4", 0.3, 39.98, "url", 11, 0);
INSERT INTO PRODUCTOS (Nombre, Familia, Descripcion, Dimensiones, Peso, PVP, Image, Stock, Borrado) VALUES ("Lenovo Smart Tab M10 FHD", "Tablets", "Tablet de la marca Lenovo", "15 x 24 x 0.8", 0.46, 213.58, "url", 8, 0);
INSERT INTO PRODUCTOS (Nombre, Familia, Descripcion, Dimensiones, Peso, PVP, Image, Stock, Borrado) VALUES ("Nanocable USB 3.1 Gen2 a USB-C", "Cables", "Ideal para conectar dispositivos", "1.5", 0.1, 5.14, "url", 25, 0);
INSERT INTO PRODUCTOS (Nombre, Familia, Descripcion, Dimensiones, Peso, PVP, Image, Stock, Borrado) VALUES ("Xiaomi Mi Electric Scooter 3 Negro", "Patinetes", "Patinete eléctrico de la marca Xiaomi", "1 x 0.9 x 0.3", 13.2, 419.0, "url", 10, 0);
INSERT INTO PRODUCTOS (Nombre, Familia, Descripcion, Dimensiones, Peso, PVP, Image, Stock, Borrado) VALUES ("MSI MAG CH120 Chair", "Sillas", "Silla gaming negra", "0.6 x 0.5 x 0.1", 27, 264.99, "url", 13, 0);
INSERT INTO PRODUCTOS (Nombre, Familia, Descripcion, Dimensiones, Peso, PVP, Image, Stock, Borrado) VALUES ("Xiaomi Redmi PoweBanck 20000mAh", "Accesorios", "Powerbank de carga rápida color negro", "0.7 x 0.2 x 0.1", 0.3, 18.6, "url", 2, 0);
INSERT INTO PRODUCTOS (Nombre, Familia, Descripcion, Dimensiones, Peso, PVP, Image, Stock, Borrado) VALUES ("Avermedia Live Streamer Nexus", "Periféricos", "Centro de control para Streamings", "0.1 x 0.2 x 0.09", 0.85, 368.06, "url", 5, 0);
INSERT INTO PRODUCTOS (Nombre, Familia, Descripcion, Dimensiones, Peso, PVP, Image, Stock, Borrado) VALUES ("Innjoo BlackEye 4K Dron", "Drones", "Un dron de color plateado", "0.4 x 0.39 x 0.4", 0.16, 138.54, "url", 12, 0);
INSERT INTO PRODUCTOS (Nombre, Familia, Descripcion, Dimensiones, Peso, PVP, Image, Stock, Borrado) VALUES ("Samsung UE65 65 pulgadas LED UltraHD 4k", "Televisores", "Un televisor perfecto", "1.4 x 0.05 x 0.8", 20.9, 619, "url", 5, 0);
INSERT INTO PRODUCTOS (Nombre, Familia, Descripcion, Dimensiones, Peso, PVP, Image, Stock, Borrado) VALUES ("Xiaomi Mi Range Extender PRo amplificador", "Redes", "Repetidor con velocidad de 300Mbps", "0.08 x 0.05 x 0.07", 0.4, 8.39, "url", 3, 0);
INSERT INTO PRODUCTOS (Nombre, Familia, Descripcion, Dimensiones, Peso, PVP, Image, Stock, Borrado) VALUES ("Netatmo NTH01-ES-EC", "Smarthome", "Termostato wifi inteligente", "0.08 x 0.02 x 0.08", 0.25, 172.92, "url", 12, 0);

-- -----------------------------------------------------
-- INSERTS COMPRA
-- -----------------------------------------------------

INSERT INTO COMPRA (CLIENTE_DNI, Borrado, PRODUCTOS_ID_Producto, Cantidad) VALUES ("00000000A", 0 , 11, 1);
INSERT INTO COMPRA (CLIENTE_DNI, Borrado, PRODUCTOS_ID_Producto, Cantidad) VALUES ("00000000A", 0 , 8, 2);
INSERT INTO COMPRA (CLIENTE_DNI, Borrado, PRODUCTOS_ID_Producto, Cantidad) VALUES ("11111111A", 0 , 12, 3);
INSERT INTO COMPRA (CLIENTE_DNI, Borrado, PRODUCTOS_ID_Producto, Cantidad) VALUES ("11111111A", 0 , 13, 8);
INSERT INTO COMPRA (CLIENTE_DNI, Borrado, PRODUCTOS_ID_Producto, Cantidad) VALUES ("22222222A", 0 , 4, 5);
INSERT INTO COMPRA (CLIENTE_DNI, Borrado, PRODUCTOS_ID_Producto, Cantidad) VALUES ("33333333A", 0 , 2, 1);
INSERT INTO COMPRA (CLIENTE_DNI, Borrado, PRODUCTOS_ID_Producto, Cantidad) VALUES ("33333333A", 0 , 3, 2);
INSERT INTO COMPRA (CLIENTE_DNI, Borrado, PRODUCTOS_ID_Producto, Cantidad) VALUES ("33333333A", 0 , 9, 2);
INSERT INTO COMPRA (CLIENTE_DNI, Borrado, PRODUCTOS_ID_Producto, Cantidad) VALUES ("44444444A", 0 , 10, 4);
INSERT INTO COMPRA (CLIENTE_DNI, Borrado, PRODUCTOS_ID_Producto, Cantidad) VALUES ("55555555A", 0 , 5, 20);
INSERT INTO COMPRA (CLIENTE_DNI, Borrado, PRODUCTOS_ID_Producto, Cantidad) VALUES ("66666666A", 0 , 6, 10);
INSERT INTO COMPRA (CLIENTE_DNI, Borrado, PRODUCTOS_ID_Producto, Cantidad) VALUES ("77777777A", 0 , 1, 10);
INSERT INTO COMPRA (CLIENTE_DNI, Borrado, PRODUCTOS_ID_Producto, Cantidad) VALUES ("77777777A", 0 , 3, 5);
INSERT INTO COMPRA (CLIENTE_DNI, Borrado, PRODUCTOS_ID_Producto, Cantidad) VALUES ("77777777A", 0 , 9, 2);
INSERT INTO COMPRA (CLIENTE_DNI, Borrado, PRODUCTOS_ID_Producto, Cantidad) VALUES ("88888888A", 0 , 11, 2);
INSERT INTO COMPRA (CLIENTE_DNI, Borrado, PRODUCTOS_ID_Producto, Cantidad) VALUES ("99999999A", 0 , 7, 2);